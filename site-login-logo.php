<?php
/**
 * Plugin Name:       WP Site Login Logo
 * Plugin URI:        https://yogaclassestoday.com/
 * Description:       Customizes the WordPress login logo, background, form appearance, and navigation links.
 * Version:           1.2.0
 * Requires at least: 6.2
 * Requires PHP:      7.4
 * Author:            Kyle Hagel
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       site-login-logo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SLL_VERSION', '1.2.0' );
define( 'SLL_PLUGIN_FILE', __FILE__ );
define( 'SLL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SLL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once SLL_PLUGIN_DIR . 'includes/class-sll-settings.php';
require_once SLL_PLUGIN_DIR . 'includes/class-sll-login-branding.php';

/**
 * Starts the plugin after WordPress has loaded active plugins.
 */
function sll_initialize_plugin() {
	SLL_Settings::init();
	SLL_Login_Branding::init();
}
add_action( 'plugins_loaded', 'sll_initialize_plugin' );

register_activation_hook( __FILE__, array( 'SLL_Settings', 'activate' ) );
