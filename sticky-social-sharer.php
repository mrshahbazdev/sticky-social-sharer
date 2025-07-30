<?php
/**
 * Plugin Name:       Sticky Social Sharer
 * Plugin URI:        https://github.com/mrshahbazdev/sticky-social-sharer
 * Description:       A lightweight, responsive, and sticky social sharing plugin with shortcode support.
 * Version:           1.2.1
 * Author:            Mr Shahbaz
 * Author URI:        https://github.com/mrshahbazdev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sticky-social-sharer
 * Tags:              social share, social icons, sticky icons, shortcode, floating icons, responsive share, facebook, x, pinterest
 */

// Direct access ko rokein
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Default settings define karein
function sss_get_default_settings() {
    return [
        'enable_sticky' => 'on',
        'position'      => 'left',
        'networks'      => [
            'facebook'  => 'on',
            'x'         => 'on',
            'linkedin'  => 'on',
            'whatsapp'  => 'on',
            'pinterest' => 'off',
            'reddit'    => 'off',
            'telegram'  => 'off',
        ],
    ];
}

// All available social networks ki list
function sss_get_all_networks() {
    return [
        'facebook'  => 'Facebook',
        'x'         => 'X',
        'linkedin'  => 'LinkedIn',
        'whatsapp'  => 'WhatsApp',
        'pinterest' => 'Pinterest',
        'reddit'    => 'Reddit',
        'telegram'  => 'Telegram',
    ];
}

// CSS aur JS files ko enqueue karein
function sss_enqueue_assets() {
    wp_enqueue_style('sss-style', plugin_dir_url(__FILE__) . 'style.css', [], '1.2.1');
    wp_enqueue_script('sss-script', plugin_dir_url(__FILE__) . 'script.js', [], '1.2.1', true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', [], '6.5.2');
}
add_action('wp_enqueue_scripts', 'sss_enqueue_assets');

// Social icons ka HTML generate karne wala function
function sss_generate_icons_html($is_shortcode = false) {
    $options = get_option('sss_settings', sss_get_default_settings());
    $enabled_networks = isset($options['networks']) ? $options['networks'] : [];
    
    $html = '';
    
    foreach (sss_get_all_networks() as $key => $name) {
        if (!empty($enabled_networks[$key]) && $enabled_networks[$key] === 'on') {
            // Icon class ke liye special logic
            $icon_class = $key;
            if ($key === 'linkedin') {
                $icon_class = 'linkedin-in';
            } elseif ($key === 'x') {
                $icon_class = 'x-twitter';
            }

            $html .= sprintf(
                '<a href="#" class="sss-icon sss-%s" target="_blank" aria-label="Share on %s"><i class="fab fa-%s"></i></a>',
                esc_attr($key),
                esc_attr($name),
                esc_attr($icon_class)
            );
        }
    }

    if (empty($html)) {
        return '';
    }

    $container_class = $is_shortcode ? 'sss-shortcode-container' : 'sss-container sss-position-' . esc_attr($options['position']);
    
    return '<div class="' . $container_class . '">' . $html . '</div>';
}

// Sticky icons ko footer mein add karein
function sss_add_sticky_icons_to_footer() {
    $options = get_option('sss_settings', sss_get_default_settings());
    if (!empty($options['enable_sticky']) && $options['enable_sticky'] === 'on') {
        echo sss_generate_icons_html(false);
    }
}
add_action('wp_footer', 'sss_add_sticky_icons_to_footer');

// Shortcode [sticky_social_sharer] ko register karein
function sss_shortcode_handler($atts) {
    return sss_generate_icons_html(true);
}
add_shortcode('sticky_social_sharer', 'sss_shortcode_handler');


// ***********************************************
// * ADMIN SETTINGS PAGE CODE
// ***********************************************

function sss_add_admin_menu() {
    add_options_page('Sticky Social Sharer Settings', 'Sticky Social Sharer', 'manage_options', 'sticky-social-sharer', 'sss_settings_page_html');
}
add_action('admin_menu', 'sss_add_admin_menu');

function sss_settings_init() {
    register_setting('sss_settings_group', 'sss_settings', 'sss_sanitize_settings');
}
add_action('admin_init', 'sss_settings_init');

function sss_sanitize_settings($input) {
    $defaults = sss_get_default_settings();
    $output = [];

    $output['enable_sticky'] = (isset($input['enable_sticky']) && $input['enable_sticky'] === 'on') ? 'on' : 'off';
    $output['position'] = (isset($input['position']) && in_array($input['position'], ['left', 'right'])) ? $input['position'] : $defaults['position'];
    
    $output['networks'] = [];
    foreach (array_keys(sss_get_all_networks()) as $network) {
        $output['networks'][$network] = (isset($input['networks'][$network]) && $input['networks'][$network] === 'on') ? 'on' : 'off';
    }

    return $output;
}

function sss_settings_page_html() {
    if (!current_user_can('manage_options')) return;

    $options = get_option('sss_settings', sss_get_default_settings());
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php settings_fields('sss_settings_group'); ?>
            
            <h2>Main Settings</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Sticky Icons</th>
                    <td>
                        <label>
                            <input type="checkbox" name="sss_settings[enable_sticky]" <?php checked(isset($options['enable_sticky']) ? $options['enable_sticky'] : 'off', 'on'); ?> />
                            <span>Enable the floating social icon bar on the side of the screen.</span>
                        </label>
                    </td>
                </tr>
                <tr valign="top" id="sss-position-setting">
                    <th scope="row">Sticky Bar Position</th>
                    <td>
                        <fieldset>
                            <label><input type="radio" name="sss_settings[position]" value="left" <?php checked($options['position'], 'left'); ?> /> Left Side</label><br />
                            <label><input type="radio" name="sss_settings[position]" value="right" <?php checked($options['position'], 'right'); ?> /> Right Side</label>
                        </fieldset>
                    </td>
                </tr>
            </table>

            <h2>Display Icons</h2>
            <p>Select which social sharing icons you want to display. These settings apply to both the sticky bar and the shortcode.</p>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Choose Networks</th>
                    <td>
                        <fieldset>
                        <?php foreach (sss_get_all_networks() as $key => $name): ?>
                            <label style="margin-right: 20px; display: inline-block; width: 120px;">
                                <input type="checkbox" name="sss_settings[networks][<?php echo esc_attr($key); ?>]" <?php checked(isset($options['networks'][$key]) ? $options['networks'][$key] : 'off', 'on'); ?> />
                                <?php echo esc_html($name); ?>
                            </label>
                        <?php endforeach; ?>
                        </fieldset>
                    </td>
                </tr>
            </table>

            <h2>Shortcode Usage</h2>
            <p>To display the social sharing icons anywhere inside a post, page, or widget, use the following shortcode:</p>
            <p><input type="text" value="[sticky_social_sharer]" readonly onfocus="this.select();" style="width: 200px; text-align: center;"></p>

            <?php submit_button('Save Changes'); ?>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const enableCheckbox = document.querySelector('input[name="sss_settings[enable_sticky]"]');
            const positionRow = document.getElementById('sss-position-setting');

            function togglePosition() {
                if (!positionRow || !enableCheckbox) return;
                positionRow.style.display = enableCheckbox.checked ? '' : 'none';
            }
            
            togglePosition();
            enableCheckbox.addEventListener('change', togglePosition);
        });
    </script>
    <?php
}