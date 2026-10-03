# WordPress.org release checklist

Use this checklist before every public release or WordPress.org submission. Passing these checks reduces avoidable review issues but does not guarantee directory acceptance; the WordPress.org Plugins Team performs the final review.

## Current guidance

- Review the current [Detailed Plugin Guidelines](https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/).
- Review relevant sections of the [Plugin Handbook](https://developer.wordpress.org/plugins/), especially security, privacy, internationalization, and directory requirements.
- Update the official [Plugin Check](https://wordpress.org/plugins/plugin-check/) plugin before running it so the scan uses its current implementation.
- Resolve all errors. Review every warning individually and document any warning intentionally retained.
- Check the proposed plugin name and slug for restricted terms before renaming files, text domains, or repositories.

## Identity and packaging

- Confirm the plugin name, directory, main file, text domain, and WordPress.org slug agree.
- Confirm the plugin URI and source-code links are current and public.
- Keep the `Version:` header, `Stable tag`, changelog, and release tag synchronized.
- Confirm the ZIP contains one correctly named plugin directory and excludes development-only files and generated clutter.
- Confirm the production package contains no hidden files such as `.gitignore` or `.distignore`, and no version-control directories.
- Confirm licensing and third-party assets are GPL-compatible and documented.

## Code quality and security

- Run Plugin Check against the packaged release, not only the working directory.
- Run PHP syntax checks on every PHP file using the oldest and newest supported PHP versions.
- Run WordPress Coding Standards checks when the project tooling supports them.
- Verify capability checks and nonces protect administrative actions.
- Validate and sanitize input, and escape output as late as practical.
- Confirm direct file access is blocked where appropriate.
- Confirm the plugin does not load executable code from third-party services.
- Document any external service, data collection, telemetry, or privacy impact and require consent where applicable.

## WordPress behavior

- Test activation, deactivation, upgrade, and uninstall behavior without losing data unexpectedly.
- Test against the minimum and current supported WordPress and PHP versions.
- Test single-site behavior and document multisite limitations.
- Confirm settings use stable option keys when display names, filenames, or slugs change.
- Confirm all user-facing strings use the exact plugin text domain and are translatable.
- Test keyboard access, visible focus, labels, contrast, error messaging, and responsive layouts.
- Test with `WP_DEBUG` enabled and confirm no warnings, notices, or deprecated calls are produced.

## Final review

- Install the final ZIP on a clean WordPress site.
- Run Plugin Check one final time on that installed copy.
- Review `readme.txt` rendering, installation steps, screenshots, FAQ, and changelog.
- Compare the release diff with the previous version and verify that only intended files changed.
