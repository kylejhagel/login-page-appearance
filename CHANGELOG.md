# Changelog

All notable changes to Simple WP Login Page are documented in this file.

The format follows [Keep a Changelog](https://keepachangelog.com/en/1.1.0/), and this project uses [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2026-10-01

### Added

- Optional YCT-inspired form treatment for WordPress login, registration, and password forms.
- Configurable normal, hover, and keyboard-focus colors for login navigation links.
- Independent left, center, or right alignment for the navigation and back-to-site link groups.
- Conditional login body classes that isolate logo, form, and link appearance rules.

### Changed

- Renamed the plugin to Simple WP Login Page to reflect its broader login-screen modernization scope.
- Renamed the plugin folder, main file, settings-page slug, and translation text domain to `simple-wp-login-page`.
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
