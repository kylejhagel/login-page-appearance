=== Site Login Logo ===
Contributors: kylehagel
Tags: login, logo, branding, custom logo, login form
Requires at least: 6.2
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Customize the WordPress login logo, background, form appearance, and navigation links.

== Description ==

Site Login Logo provides a focused Settings > Login Logo screen for controlling the logo shown above the WordPress login form, the login-page background, and optional form and navigation-link styling.

Features include:

* Enable or disable login-logo replacement.
* Dynamically use the current Site Logo configured by the active theme.
* Optionally choose a separate image from the WordPress Media Library.
* Preview the selected logo source before saving.
* Optionally override the login-page background with a solid color.
* Use the native WordPress color picker and preview the background behind the logo.
* Set the logo width from 80 to 400 pixels.
* Link the logo to the site homepage or retain the WordPress.org default.
* Use the site name as accessible link text when a custom logo is active.
* Fall back to the standard WordPress logo when the selected image is missing.
* Apply an optional softened form preset based on the Yoga Class Today form system.
* Style lost-password and back-to-site links with independent normal, hover, and keyboard-focus colors.
* Align the login navigation and back-to-site links independently without absolute positioning.

The plugin stores Media Library attachment IDs rather than image URLs. When Site Logo is selected, changing the theme's Site Logo automatically updates the login screen.

== Installation ==

1. Upload the `site-login-logo` folder to `/wp-content/plugins/`, or install the ZIP through Plugins > Add New > Upload Plugin.
2. Activate Site Login Logo.
3. Go to Settings > Login Logo.
4. Confirm the logo source and save the settings.

== Frequently Asked Questions ==

= Where does the Site Logo come from? =

The plugin reads the active theme's standard WordPress `custom_logo` setting. In most themes, this is configured under Appearance > Customize > Site Identity or the Site Editor.

= What happens if the selected logo is removed? =

The plugin leaves the default WordPress login logo in place.

= Does this redesign the login form? =

Only when the optional form preset is enabled. The preset softens the WordPress login, registration, and password forms with rounded fields, subtle borders and shadows, and visible focus rings. It does not replace WordPress login markup or load Tailwind or Flowbite assets.

= Does it support multisite network-wide settings? =

No. The plugin stores settings per site.

== Changelog ==

= 1.2.0 =
* Added optional YCT-inspired styling for WordPress login, registration, and password forms.
* Added configurable normal, hover, and keyboard-focus colors for login navigation links.
* Added independent left, center, or right alignment for navigation and back-to-site links.
* Scoped all appearance rules with conditional login body classes.

= 1.1.0 =
* Added an independent login-page background color override.
* Added the native WordPress color picker.
* Added live background color rendering to the logo preview.
* Added a safe return to the WordPress-controlled background when the override is disabled.

= 1.0.0 =
* Initial release.
* Added dynamic Site Logo support.
* Added optional Media Library logo override and preview.
* Added logo width and link destination settings.
* Added accessible site-name link text and safe WordPress-logo fallback.
