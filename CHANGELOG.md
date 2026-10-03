# Changelog

All notable changes to Login Page Appearance are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2026-10-01

### Added

- Optional YCT-inspired form treatment for WordPress login, registration, and password forms.
- Optional responsive login-page width control with a configurable 320-to-640-pixel range.
- Optional responsive split-row layout for the login navigation and back-to-site links.
- Reversible Restore WordPress defaults action that disables every override while retaining configured values.
- Configurable normal, hover, and keyboard-focus colors for login navigation links.
- Independent left, center, or right alignment for the navigation and back-to-site link groups.
- Conditional login body classes that isolate logo, form, and link appearance rules.
- A WordPress.org release checklist covering current Plugin Check, directory guidance, security, accessibility, internationalization, compatibility, and packaging reviews.

### Changed

- Added consistent separation between the password field and login actions in the softened form preset.
- Renamed the plugin to Login Page Appearance to reflect its broader login-screen modernization scope.
- Renamed the plugin folder, main file, settings-page slug, and translation text domain to `login-page-appearance`.
- Updated the declared WordPress compatibility through version 7.1.
- Removed the development-only `.gitignore` file from the plugin source so production scans do not include a prohibited hidden file.
- The login stylesheet now loads whenever a logo, form, or link appearance feature needs it.
- Logo sizing rules are scoped to an active custom logo so form-only styling cannot reshape the default WordPress logo.

## [1.1.0] - 2026-08-21

### Added

- Independent login-page background color override.
- Native WordPress color picker on the Login Logo settings screen.
- Live background color rendering behind the logo preview.
- Safe return to the WordPress-controlled background when the override is disabled.

## [1.0.0] - 2026-08-04

### Added

- Settings → Login Logo administration screen.
- Enable or disable control for login-logo replacement.
- Dynamic use of the active theme's WordPress Site Logo.
- Optional Media Library image override stored by attachment ID.
- Logo preview and Media Library selection controls.
- Configurable logo width between 80 and 400 pixels.
- Site homepage or default WordPress.org logo-link behavior.
- Site name as accessible login-logo link text.
- Automatic fallback to the standard WordPress logo when no valid image is available.
