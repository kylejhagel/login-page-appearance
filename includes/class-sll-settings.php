<?php
/**
 * Admin settings for Simple WP Login Page.
 *
 * @package Site_Login_Logo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SLL_Settings {
	const OPTION_NAME = 'sll_options';
	const PAGE_SLUG   = 'site-login-logo';

	/**
	 * Registers admin hooks.
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ) );
		add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Creates the initial settings without overwriting existing values.
	 */
	public static function activate() {
		add_option( self::OPTION_NAME, self::get_defaults() );
	}

	/**
	 * Returns default plugin settings.
	 *
	 * @return array
	 */
	public static function get_defaults() {
		return array(
			'enabled'              => 1,
			'logo_source'          => 'site_logo',
			'custom_logo_id'       => 0,
			'background_enabled'   => 0,
			'background_color'     => '#f0f0f1',
			'logo_width'           => 280,
			'logo_link'            => 'home',
			'form_style_enabled'   => 0,
			'link_style_enabled'   => 0,
			'link_color'           => '#0a4f42',
			'link_hover_color'     => '#a9533a',
			'link_focus_color'     => '#0a4f42',
			'nav_alignment'        => 'left',
			'back_link_alignment' => 'left',
		);
	}

	/**
	 * Returns saved settings merged with defaults.
	 *
	 * @return array
	 */
	public static function get_options() {
		$options = get_option( self::OPTION_NAME, array() );

		return wp_parse_args( is_array( $options ) ? $options : array(), self::get_defaults() );
	}

	/**
	 * Adds Settings > Login Page.
	 */
	public static function add_settings_page() {
		add_options_page(
			__( 'Simple WP Login Page', 'wp-site-login-logo' ),
			__( 'Login Page', 'wp-site-login-logo' ),
			'manage_options',
			self::PAGE_SLUG,
			array( __CLASS__, 'render_settings_page' )
		);
	}

	/**
	 * Registers the plugin option and settings fields.
	 */
	public static function register_settings() {
		register_setting(
			'sll_settings_group',
			self::OPTION_NAME,
			array(
				'type'              => 'array',
				'sanitize_callback' => array( __CLASS__, 'sanitize_options' ),
				'default'           => self::get_defaults(),
			)
		);

		add_settings_section(
			'sll_logo_section',
			__( 'Login branding settings', 'wp-site-login-logo' ),
			array( __CLASS__, 'render_section_description' ),
			self::PAGE_SLUG
		);

		add_settings_field( 'sll_enabled', __( 'Login logo', 'wp-site-login-logo' ), array( __CLASS__, 'render_enabled_field' ), self::PAGE_SLUG, 'sll_logo_section' );
		add_settings_field( 'sll_logo_source', __( 'Logo source', 'wp-site-login-logo' ), array( __CLASS__, 'render_logo_source_field' ), self::PAGE_SLUG, 'sll_logo_section' );
		add_settings_field( 'sll_custom_logo', __( 'Custom logo', 'wp-site-login-logo' ), array( __CLASS__, 'render_custom_logo_field' ), self::PAGE_SLUG, 'sll_logo_section' );
		add_settings_field( 'sll_background', __( 'Login background', 'wp-site-login-logo' ), array( __CLASS__, 'render_background_field' ), self::PAGE_SLUG, 'sll_logo_section' );
		add_settings_field( 'sll_logo_width', __( 'Logo width', 'wp-site-login-logo' ), array( __CLASS__, 'render_logo_width_field' ), self::PAGE_SLUG, 'sll_logo_section' );
		add_settings_field( 'sll_logo_link', __( 'Logo link', 'wp-site-login-logo' ), array( __CLASS__, 'render_logo_link_field' ), self::PAGE_SLUG, 'sll_logo_section' );

		add_settings_section(
			'sll_appearance_section',
			__( 'Login form appearance', 'wp-site-login-logo' ),
			array( __CLASS__, 'render_appearance_section_description' ),
			self::PAGE_SLUG
		);

		add_settings_field( 'sll_form_style', __( 'Form styling', 'wp-site-login-logo' ), array( __CLASS__, 'render_form_style_field' ), self::PAGE_SLUG, 'sll_appearance_section' );
		add_settings_field( 'sll_link_style', __( 'Login links', 'wp-site-login-logo' ), array( __CLASS__, 'render_link_style_field' ), self::PAGE_SLUG, 'sll_appearance_section' );
		add_settings_field( 'sll_link_alignment', __( 'Link alignment', 'wp-site-login-logo' ), array( __CLASS__, 'render_link_alignment_field' ), self::PAGE_SLUG, 'sll_appearance_section' );
	}

	/**
	 * Sanitizes all plugin settings.
	 *
	 * @param mixed $input Submitted option values.
	 * @return array
	 */
	public static function sanitize_options( $input ) {
		$input               = is_array( $input ) ? $input : array();
		$defaults            = self::get_defaults();
		$source              = isset( $input['logo_source'] ) ? sanitize_key( $input['logo_source'] ) : $defaults['logo_source'];
		$link                = isset( $input['logo_link'] ) ? sanitize_key( $input['logo_link'] ) : $defaults['logo_link'];
		$width               = isset( $input['logo_width'] ) ? absint( $input['logo_width'] ) : $defaults['logo_width'];
		$background_color    = isset( $input['background_color'] ) ? sanitize_hex_color( $input['background_color'] ) : $defaults['background_color'];
		$link_color          = isset( $input['link_color'] ) ? sanitize_hex_color( $input['link_color'] ) : $defaults['link_color'];
		$link_hover_color    = isset( $input['link_hover_color'] ) ? sanitize_hex_color( $input['link_hover_color'] ) : $defaults['link_hover_color'];
		$link_focus_color    = isset( $input['link_focus_color'] ) ? sanitize_hex_color( $input['link_focus_color'] ) : $defaults['link_focus_color'];
		$nav_alignment       = isset( $input['nav_alignment'] ) ? sanitize_key( $input['nav_alignment'] ) : $defaults['nav_alignment'];
		$back_link_alignment = isset( $input['back_link_alignment'] ) ? sanitize_key( $input['back_link_alignment'] ) : $defaults['back_link_alignment'];
		$alignments          = array( 'left', 'center', 'right' );

		if ( ! $background_color ) {
			$background_color = $defaults['background_color'];
		}

		if ( ! $link_color ) {
			$link_color = $defaults['link_color'];
		}

		if ( ! $link_hover_color ) {
			$link_hover_color = $defaults['link_hover_color'];
		}

		if ( ! $link_focus_color ) {
			$link_focus_color = $defaults['link_focus_color'];
		}

		return array(
			'enabled'             => empty( $input['enabled'] ) ? 0 : 1,
			'logo_source'         => in_array( $source, array( 'site_logo', 'custom' ), true ) ? $source : $defaults['logo_source'],
			'custom_logo_id'      => isset( $input['custom_logo_id'] ) ? absint( $input['custom_logo_id'] ) : 0,
			'background_enabled'  => empty( $input['background_enabled'] ) ? 0 : 1,
			'background_color'    => $background_color,
			'logo_width'          => max( 80, min( 400, $width ) ),
			'logo_link'           => in_array( $link, array( 'home', 'wordpress' ), true ) ? $link : $defaults['logo_link'],
			'form_style_enabled'  => empty( $input['form_style_enabled'] ) ? 0 : 1,
			'link_style_enabled'  => empty( $input['link_style_enabled'] ) ? 0 : 1,
			'link_color'          => $link_color,
			'link_hover_color'    => $link_hover_color,
			'link_focus_color'    => $link_focus_color,
			'nav_alignment'       => in_array( $nav_alignment, $alignments, true ) ? $nav_alignment : $defaults['nav_alignment'],
			'back_link_alignment' => in_array( $back_link_alignment, $alignments, true ) ? $back_link_alignment : $defaults['back_link_alignment'],
		);
	}

	/**
	 * Loads assets only on this plugin's settings screen.
	 *
	 * @param string $hook_suffix Current admin page hook.
	 */
	public static function enqueue_assets( $hook_suffix ) {
		if ( 'settings_page_' . self::PAGE_SLUG !== $hook_suffix ) {
			return;
		}

		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'sll-admin', SLL_PLUGIN_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), SLL_VERSION );
		wp_enqueue_script( 'sll-admin-media', SLL_PLUGIN_URL . 'assets/js/admin-media.js', array( 'jquery', 'wp-color-picker' ), SLL_VERSION, true );
		wp_localize_script(
			'sll-admin-media',
			'sllAdmin',
			array(
				'frameTitle'  => __( 'Choose a login logo', 'wp-site-login-logo' ),
				'frameButton' => __( 'Use this logo', 'wp-site-login-logo' ),
				'siteLogoUrl' => self::get_attachment_url( absint( get_theme_mod( 'custom_logo', 0 ) ) ),
				'noLogoText'  => __( 'No logo is currently available for this source.', 'wp-site-login-logo' ),
			)
		);
	}

	/**
	 * Returns a preview-safe attachment URL.
	 *
	 * @param int $attachment_id Attachment ID.
	 * @return string
	 */
	private static function get_attachment_url( $attachment_id ) {
		$url = $attachment_id ? wp_get_attachment_image_url( $attachment_id, 'medium' ) : '';

		return $url ? esc_url_raw( $url ) : '';
	}

	public static function render_section_description() {
		echo '<p>' . esc_html__( 'Use the active theme’s Site Logo or a Media Library image, and optionally override the login-page background color.', 'wp-site-login-logo' ) . '</p>';
	}

	public static function render_appearance_section_description() {
		echo '<p>' . esc_html__( 'Optionally apply the Yoga Class Today form treatment and control the login navigation links without changing WordPress login markup.', 'wp-site-login-logo' ) . '</p>';
	}

	public static function render_enabled_field() {
		$options = self::get_options();
		?>
		<label>
			<input type="checkbox" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[enabled]" value="1" <?php checked( 1, $options['enabled'] ); ?>>
			<?php esc_html_e( 'Replace the default WordPress login logo', 'wp-site-login-logo' ); ?>
		</label>
		<?php
	}

	public static function render_logo_source_field() {
		$options = self::get_options();
		?>
		<fieldset id="sll-logo-source">
			<label>
				<input type="radio" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[logo_source]" value="site_logo" <?php checked( 'site_logo', $options['logo_source'] ); ?>>
				<?php esc_html_e( 'Use the current Site Logo', 'wp-site-login-logo' ); ?>
			</label><br>
			<label>
				<input type="radio" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[logo_source]" value="custom" <?php checked( 'custom', $options['logo_source'] ); ?>>
				<?php esc_html_e( 'Choose a different Media Library image', 'wp-site-login-logo' ); ?>
			</label>
		</fieldset>
		<?php
	}

	public static function render_custom_logo_field() {
		$options           = self::get_options();
		$custom_logo_url   = self::get_attachment_url( $options['custom_logo_id'] );
		$site_logo_url     = self::get_attachment_url( absint( get_theme_mod( 'custom_logo', 0 ) ) );
		$preview_url       = 'custom' === $options['logo_source'] ? $custom_logo_url : $site_logo_url;
		$preview_is_hidden = empty( $preview_url );
		?>
		<div class="sll-media-control">
			<input type="hidden" id="sll-custom-logo-id" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[custom_logo_id]" value="<?php echo esc_attr( $options['custom_logo_id'] ); ?>" data-custom-logo-url="<?php echo esc_url( $custom_logo_url ); ?>">
			<div class="sll-logo-preview" aria-live="polite"<?php echo ! empty( $options['background_enabled'] ) ? ' style="background-color: ' . esc_attr( $options['background_color'] ) . ';"' : ''; ?>>
				<img id="sll-logo-preview-image" src="<?php echo esc_url( $preview_url ); ?>" alt="<?php esc_attr_e( 'Login logo preview', 'wp-site-login-logo' ); ?>" <?php echo $preview_is_hidden ? 'hidden' : ''; ?>>
				<p id="sll-logo-preview-empty" <?php echo $preview_is_hidden ? '' : 'hidden'; ?>><?php esc_html_e( 'No logo is currently available for this source.', 'wp-site-login-logo' ); ?></p>
			</div>
			<p>
				<button type="button" class="button" id="sll-select-logo"><?php esc_html_e( 'Choose image', 'wp-site-login-logo' ); ?></button>
				<button type="button" class="button-link-delete" id="sll-remove-logo" <?php echo empty( $options['custom_logo_id'] ) ? 'hidden' : ''; ?>><?php esc_html_e( 'Remove custom image', 'wp-site-login-logo' ); ?></button>
			</p>
			<p class="description"><?php esc_html_e( 'The custom image is used only when “Choose a different Media Library image” is selected.', 'wp-site-login-logo' ); ?></p>
		</div>
		<?php
	}

	/**
	 * Outputs the independent login background controls.
	 */
	public static function render_background_field() {
		$options = self::get_options();
		?>
		<div id="sll-background-control" class="sll-background-control<?php echo empty( $options['background_enabled'] ) ? ' sll-background-control--disabled' : ''; ?>">
			<label class="sll-background-toggle">
				<input type="checkbox" id="sll-background-enabled" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[background_enabled]" value="1" <?php checked( 1, $options['background_enabled'] ); ?>>
				<?php esc_html_e( 'Override the default WordPress login background color', 'wp-site-login-logo' ); ?>
			</label>
			<div class="sll-background-picker">
				<label for="sll-background-color"><?php esc_html_e( 'Background color', 'wp-site-login-logo' ); ?></label><br>
				<input type="text" id="sll-background-color" class="sll-color-field" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[background_color]" value="<?php echo esc_attr( $options['background_color'] ); ?>" data-default-color="#f0f0f1">
			</div>
			<p class="description"><?php esc_html_e( 'Uncheck the override to return control of the background to WordPress. Confirm that the selected color maintains sufficient contrast with the login-page text and links.', 'wp-site-login-logo' ); ?></p>
		</div>
		<?php
	}

	public static function render_logo_width_field() {
		$options = self::get_options();
		?>
		<input type="number" class="small-text" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[logo_width]" value="<?php echo esc_attr( $options['logo_width'] ); ?>" min="80" max="400" step="1"> px
		<p class="description"><?php esc_html_e( 'Maximum width between 80 and 400 pixels. Default: 280.', 'wp-site-login-logo' ); ?></p>
		<?php
	}

	public static function render_logo_link_field() {
		$options = self::get_options();
		?>
		<select name="<?php echo esc_attr( self::OPTION_NAME ); ?>[logo_link]">
			<option value="home" <?php selected( 'home', $options['logo_link'] ); ?>><?php esc_html_e( 'Site homepage', 'wp-site-login-logo' ); ?></option>
			<option value="wordpress" <?php selected( 'wordpress', $options['logo_link'] ); ?>><?php esc_html_e( 'WordPress.org (default)', 'wp-site-login-logo' ); ?></option>
		</select>
		<?php
	}

	public static function render_form_style_field() {
		$options = self::get_options();
		?>
		<label>
			<input type="checkbox" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[form_style_enabled]" value="1" <?php checked( 1, $options['form_style_enabled'] ); ?>>
			<?php esc_html_e( 'Use the softened YCT form and input styling', 'wp-site-login-logo' ); ?>
		</label>
		<p class="description"><?php esc_html_e( 'Applies rounded fields, softer borders and shadows, and a visible focus ring to WordPress login, registration, and password forms.', 'wp-site-login-logo' ); ?></p>
		<?php
	}

	public static function render_link_style_field() {
		$options = self::get_options();
		?>
		<div id="sll-link-control" class="sll-link-control<?php echo empty( $options['link_style_enabled'] ) ? ' sll-link-control--disabled' : ''; ?>">
			<label class="sll-control-toggle">
				<input type="checkbox" id="sll-link-style-enabled" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[link_style_enabled]" value="1" <?php checked( 1, $options['link_style_enabled'] ); ?>>
				<?php esc_html_e( 'Override the lost-password and back-to-site link styles', 'wp-site-login-logo' ); ?>
			</label>
			<div class="sll-link-dependent sll-color-grid">
				<label for="sll-link-color">
					<?php esc_html_e( 'Link color', 'wp-site-login-logo' ); ?><br>
					<input type="text" id="sll-link-color" class="sll-link-color-field" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[link_color]" value="<?php echo esc_attr( $options['link_color'] ); ?>" data-default-color="#0a4f42">
				</label>
				<label for="sll-link-hover-color">
					<?php esc_html_e( 'Hover color', 'wp-site-login-logo' ); ?><br>
					<input type="text" id="sll-link-hover-color" class="sll-link-color-field" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[link_hover_color]" value="<?php echo esc_attr( $options['link_hover_color'] ); ?>" data-default-color="#a9533a">
				</label>
				<label for="sll-link-focus-color">
					<?php esc_html_e( 'Keyboard focus color', 'wp-site-login-logo' ); ?><br>
					<input type="text" id="sll-link-focus-color" class="sll-link-color-field" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[link_focus_color]" value="<?php echo esc_attr( $options['link_focus_color'] ); ?>" data-default-color="#0a4f42">
				</label>
			</div>
			<p class="description"><?php esc_html_e( 'These colors target links inside #nav and #backtoblog, including hover and keyboard-focus states.', 'wp-site-login-logo' ); ?></p>
		</div>
		<?php
	}

	public static function render_link_alignment_field() {
		$options    = self::get_options();
		$alignments = array(
			'left'   => __( 'Left', 'wp-site-login-logo' ),
			'center' => __( 'Center', 'wp-site-login-logo' ),
			'right'  => __( 'Right', 'wp-site-login-logo' ),
		);
		?>
		<div class="sll-link-dependent sll-alignment-grid<?php echo empty( $options['link_style_enabled'] ) ? ' sll-link-dependent--disabled' : ''; ?>">
			<label for="sll-nav-alignment">
				<?php esc_html_e( 'Lost-password/navigation links', 'wp-site-login-logo' ); ?><br>
				<select id="sll-nav-alignment" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[nav_alignment]">
					<?php foreach ( $alignments as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $options['nav_alignment'] ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label for="sll-back-link-alignment">
				<?php esc_html_e( 'Back-to-site link', 'wp-site-login-logo' ); ?><br>
				<select id="sll-back-link-alignment" name="<?php echo esc_attr( self::OPTION_NAME ); ?>[back_link_alignment]">
					<?php foreach ( $alignments as $value => $label ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $options['back_link_alignment'] ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		</div>
		<p class="description"><?php esc_html_e( 'Alignment is responsive-safe and does not use absolute positioning or custom offsets.', 'wp-site-login-logo' ); ?></p>
		<?php
	}

	/**
	 * Outputs the settings screen.
	 */
	public static function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		?>
		<div class="wrap sll-settings-wrap">
			<h1><?php esc_html_e( 'Simple WP Login Page', 'wp-site-login-logo' ); ?></h1>
			<?php settings_errors(); ?>
			<form action="options.php" method="post">
				<?php
				settings_fields( 'sll_settings_group' );
				do_settings_sections( self::PAGE_SLUG );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}
