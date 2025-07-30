<?php
/**
 * Plugin Name:       Sticky Social Sharer
 * Plugin URI:        https://github.com/mrshahbazdev/sticky-social-sharer
 * Description:       A lightweight, responsive, and sticky social sharing plugin for WordPress. Adds sharing icons to the left or right of your website.
 * Version:           1.1.0
 * Author:            Mr Shahbaz
 * Author URI:        https://github.com/mrshahbazdev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sticky-social-sharer
 * Tags:              social share, social icons, sticky icons, floating icons, responsive share, facebook, twitter, linkedin, whatsapp
 */

// Direct access ko rokein
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

 
function sss_enqueue_assets() {
    wp_enqueue_style( 'sss-style', plugin_dir_url( __FILE__ ) . 'style.css', [], '1.1.0' );
    wp_enqueue_script( 'sss-script', plugin_dir_url( __FILE__ ) . 'script.js', [], '1.1.0', true );
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', [], '6.5.2' );
}
add_action( 'wp_enqueue_scripts', 'sss_enqueue_assets' );



function sss_add_social_share_html() {
    
    $position = get_option('sss_position_setting', 'left');


    echo '
    <div class="sss-container sss-position-' . esc_attr($position) . '">
        <a href="#" class="sss-icon sss-facebook" target="_blank" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="sss-icon sss-twitter" target="_blank" aria-label="Share on Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="sss-icon sss-linkedin" target="_blank" aria-label="Share on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="sss-icon sss-whatsapp" target="_blank" aria-label="Share on WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>
    ';
}
add_action( 'wp_footer', 'sss_add_social_share_html' );


 
function sss_add_admin_menu() {
    add_options_page(
        'Sticky Social Sharer Settings', // Page Title
        'Sticky Social Sharer',          // Menu Title
        'manage_options',                // Capability
        'sticky-social-sharer',          // Menu Slug
        'sss_settings_page_html'         // Function 
    );
}
add_action('admin_menu', 'sss_add_admin_menu');


// 2. Apni setting ko WordPress mein register karein
function sss_settings_init() {
    register_setting(
        'sss_settings_group',      
        'sss_position_setting'    
    );
}
add_action('admin_init', 'sss_settings_init');


 
function sss_settings_page_html() {
 
    if (!current_user_can('manage_options')) {
        return;
    }

 
    $current_position = get_option('sss_position_setting', 'left');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
 
            settings_fields('sss_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Icons ki Position</th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="radio" name="sss_position_setting" value="left" <?php checked($current_position, 'left'); ?> />
                                <span>Left Side</span>
                            </label>
                            <br />
                            <label>
                                <input type="radio" name="sss_position_setting" value="right" <?php checked($current_position, 'right'); ?> />
                                <span>Right Side</span>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <?php
 
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}
