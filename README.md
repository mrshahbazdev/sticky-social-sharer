# Sticky Social Sharer for WordPress

![License](https://img.shields.io/badge/license-GPL--2.0%20or%20later-blue.svg)
![WordPress Plugin Version](https://img.shields.io/badge/version-1.1.0-brightgreen.svg)
![Tested up to](https://img.shields.io/badge/WordPress-6.8-blue.svg)

**Sticky Social Sharer** is a lightweight and fully responsive WordPress plugin that adds elegant, floating social sharing icons to your website. Boost your content's visibility by making it easy for visitors to share your posts on popular social networks.

The plugin provides a clean, sticky icon bar that remains visible as users scroll. It's designed to be unobtrusive on desktops and seamlessly adapts to a sleek, accessible bottom bar on mobile devices.

## Screenshot

![Sticky Social Sharer Screenshot](screenshot-1.png "Desktop and Mobile View of the Plugin")
*(**Action Required:** Add a file named `screenshot-1.png` to your plugin folder to display a preview here.)*

## Key Features

* **Sticky & Floating:** Icons stay fixed on the screen, encouraging more shares.
* **Position Control:** Easily set the icon bar to appear on the **left** or **right** side of the screen from the admin settings.
* **Fully Responsive:** Delivers a great user experience on desktops, tablets, and mobile devices.
* **Lightweight & Fast:** Built for performance, ensuring it won't slow down your site.
* **Popular Networks Included:** Comes with share links for Facebook, Twitter, LinkedIn, and WhatsApp.
* **Simple Setup:** No complex configurations needed. Just install, activate, and you're ready to go!

## Installation

1.  **Download:** Download the latest release as a `.zip` file from the [GitHub repository](https://github.com/mrshahbazdev/sticky-social-sharer/releases).
2.  **Go to WordPress Admin:** Log in to your WordPress dashboard and navigate to `Plugins > Add New`.
3.  **Upload Plugin:** Click the `Upload Plugin` button at the top of the page.
4.  **Choose & Install:** Select the downloaded `.zip` file and click `Install Now`.
5.  **Activate:** Once the installation is complete, click `Activate Plugin`.

## Configuration

After activation, you can configure the plugin's settings:
1.  Navigate to `Settings > Sticky Social Sharer` in your WordPress dashboard.
2.  Under the "Icon Position" section, choose either `Left Side` or `Right Side`.
3.  Click `Save Changes`. The new position will be applied instantly to your live site.

## Frequently Asked Questions (FAQ)

**Q: How do I change the position of the icons?**
A: You can easily switch the position between left and right by going to `Settings > Sticky Social Sharer` in your admin dashboard.

**Q: Can I add more social networks (e.g., Pinterest, Reddit)?**
A: This feature is not available via the settings panel in the current version. However, you can extend the functionality by modifying the `sss_add_social_share_html()` function in the `sticky-social-sharer.php` file.

**Q: The icons are not appearing. What should I do?**
A: First, try clearing your browser cache and any caching plugins you might be using. If the issue persists, it could be a conflict with your theme or another plugin. Try deactivating other plugins one by one to identify the source of the conflict.

## Changelog

### Version 1.1.0
* **Feature:** Added a settings page in the admin panel to control icon position (left/right).
* **Improvement:** Refactored CSS to dynamically apply position based on user settings.
* **Docs:** Updated `README.md` with configuration instructions.

### Version 1.0.0
* Initial release.
* Sticky social sharing icons for Facebook, Twitter, LinkedIn, and WhatsApp.
* Fully responsive design for mobile devices.

## Credits

Developed and maintained by **Mr. Shahbaz**.
* **GitHub Profile:** [mrshahbazdev](https://github.com/mrshahbazdev)
* **Project Repository:** [Sticky Social Sharer](https://github.com/mrshahbazdev/sticky-social-sharer)