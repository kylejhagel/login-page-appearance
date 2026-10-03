=== Login Page Appearance ===
Contributors: kylehagel
Tags: login, logo, branding, custom logo, login form
Requires at least: 6.2
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Modernize the default WordPress login screen with simple branding and form appearance controls.

== Description ==

Login Page Appearance provides focused controls for modernizing the default WordPress login screen without replacing WordPress authentication or loading a full design framework.

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
* Optionally set a responsive login-page width between 320 and 640 pixels.
* Optionally place the login navigation and back-to-site links in a responsive split row.
* Style lost-password and back-to-site links with independent normal, hover, and keyboard-focus colors.
* Align the login navigation and back-to-site links independently without absolute positioning.

The plugin stores Media Library attachment IDs rather than image URLs. When Site Logo is selected, changing the theme's Site Logo automatically updates the login screen.

== Installation ==

1. Upload the `login-page-appearance` folder to `/wp-content/plugins/`, or install the ZIP through Plugins > Add New > Upload Plugin.
2. Activate Login Page Appearance.
3. Go to Settings > Login Page.
4. Confirm the logo source and save the settings.

== Frequently Asked Questions ==

= Where does the Site Logo come from? =

The plugin reads the active theme's standard WordPress `custom_logo` setting. In most themes, this is configured under Appearance > Customize > Site Identity or the Site Editor.

= What happens if the selected logo is removed? =

The plugin leaves the default WordPress login logo in place.

= Does this redesign the login form? =

Only when the optional appearance controls are enabled. The form preset adds rounded fields, subtle borders and shadows, and visible focus rings. The independent width control can widen the complete login wrapper while retaining responsive side spacing. These options do not load Tailwind or Flowbite assets.

= How does the split login-link layout work? =

When enabled, a small footer script moves WordPress's existing login navigation and back-to-site elements into a flexible two-column wrapper. It does not replace the links or their content. The layout returns to a single column on narrow screens and safely leaves the default markup unchanged if either link is unavailable.

= Does it support multisite network-wide settings? =

No. The plugin stores settings per site.

== Changelog ==

= 1.2.0 =
* Added optional YCT-inspired styling for WordPress login, registration, and password forms.
* Added an optional responsive login-page width control with a 320-to-640-pixel range.
* Added an optional responsive split-row layout for the login navigation and back-to-site links.
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
