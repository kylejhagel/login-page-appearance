<?php
/**
 * Login-screen branding behavior.
 *
 * @package Site_Login_Logo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SLL_Login_Branding {
	/**
	 * Registers login hooks.
	 */
	public static function init() {
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'enqueue_login_styles' ) );
		add_filter( 'login_headerurl', array( __CLASS__, 'filter_header_url' ) );
		add_filter( 'login_headertext', array( __CLASS__, 'filter_header_text' ) );
	}

	/**
	 * Gets the configured logo attachment ID.
	 *
	 * @return int
	 */
	private static function get_logo_id() {
		$options = SLL_Settings::get_options();

		if ( empty( $options['enabled'] ) ) {
			return 0;
		}

		if ( 'custom' === $options['logo_source'] ) {
			return absint( $options['custom_logo_id'] );
		}

		return absint( get_theme_mod( 'custom_logo', 0 ) );
	}

	/**
	 * Whether a usable custom login logo is active.
	 *
	 * @return bool
	 */
	private static function has_logo() {
		$logo_id = self::get_logo_id();

		return $logo_id > 0 && wp_attachment_is_image( $logo_id );
	}

	/**
	 * Enqueues tightly scoped login-page CSS and the selected logo URL.
	 */
	public static function enqueue_login_styles() {
		$options   = SLL_Settings::get_options();
		$logo_id   = self::get_logo_id();
		$logo_url  = $logo_id && wp_attachment_is_image( $logo_id ) ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
		$css_rules = array();

		if ( $logo_url ) {
			$width       = max( 80, min( 400, absint( $options['logo_width'] ) ) );
			$url         = str_replace( array( '"', "\r", "\n" ), array( '\\"', '', '' ), esc_url_raw( $logo_url ) );
			$css_rules[] = 'body.login #login h1 a { background-image: url("' . $url . '"); max-width: ' . $width . 'px; }';
		}

		if ( ! empty( $options['background_enabled'] ) ) {
			$background_color = sanitize_hex_color( $options['background_color'] );

			if ( $background_color ) {
				$css_rules[] = 'body.login { background-color: ' . $background_color . '; }';
			}
		}

		if ( empty( $css_rules ) ) {
			return;
		}

		if ( $logo_url ) {
			wp_enqueue_style( 'sll-login', SLL_PLUGIN_URL . 'assets/css/login.css', array(), SLL_VERSION );
		} else {
			wp_register_style( 'sll-login', false, array(), SLL_VERSION );
			wp_enqueue_style( 'sll-login' );
		}

		wp_add_inline_style(
			'sll-login',
			implode( "\n", $css_rules )
		);
	}

	/**
	 * Sends the logo to the site homepage when configured.
	 *
	 * @param string $url Existing login header URL.
	 * @return string
	 */
	public static function filter_header_url( $url ) {
		$options = SLL_Settings::get_options();

		if ( self::has_logo() && 'home' === $options['logo_link'] ) {
			return home_url( '/' );
		}

		return $url;
	}

	/**
	 * Uses the site name as accessible logo link text.
	 *
	 * @param string $text Existing login header text.
	 * @return string
	 */
	public static function filter_header_text( $text ) {
		if ( self::has_logo() ) {
			$site_name = get_bloginfo( 'name' );

			if ( $site_name ) {
				return $site_name;
			}
		}

		return $text;
	}
}
