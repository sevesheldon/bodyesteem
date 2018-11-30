<?php
/**
 * The public-facing functionality of the module.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Powerkit
 * @subpackage Modules/public
 */

/**
 * The public-facing functionality of the module.
 */
class Powerkit_Share_Buttons_Public extends Powerkit_Module_Public {

	/**
	 * Initialize
	 */
	public function initialize() {
		add_filter( 'the_content', array( $this, 'the_post_content' ) );
		add_filter( 'kses_allowed_protocols', array( $this, 'allow_protocols' ) );
		add_filter( 'powerkit_share_buttons_locations', array( $this, 'locations_default' ) );
		add_filter( 'powerkit_share_buttons_color_layouts', array( $this, 'layouts_default' ) );
		add_filter( 'powerkit_share_buttons_color_schemes', array( $this, 'schemes_default' ) );
	}

	/**
	 * Allow protocols for esc_url.
	 *
	 * @param array $protocols Array of allowed protocols.
	 */
	public function allow_protocols( $protocols ) {

		array_push( $protocols, 'fb-messenger', 'whatsapp', 'viber', 'tg' );

		return $protocols;
	}

	/**
	 * Filter output buttons in post content.
	 *
	 * @param string $content List of Locations.
	 */
	public function the_post_content( $content ) {
		// Check AMP endpoint.
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			return $content;
		}

		if ( is_singular( 'post' ) && is_single( get_the_ID() ) ) {
			ob_start();
				powerkit_share_buttons_location( 'before-content' );
			$before_shares = ob_get_clean();

			ob_start();
				powerkit_share_buttons_location( 'after-content' );
			$after_shares = ob_get_clean();

			// Clearfix.
			if ( $after_shares ) {
				$after_shares = '<div class="pk-clearfix"></div>' . $after_shares;
			}

			// Concatenation.
			$content = $before_shares . $content . $after_shares;
		}

		return $content;
	}

	/**
	 * Filter Register Locations
	 *
	 * @since    1.0.0
	 * @access   private
	 *
	 * @param array $locations List of Locations.
	 */
	public function locations_default( $locations = array() ) {
		$locations = array(
			'after-content'  => array(
				'shares'   => array( 'facebook', 'twitter', 'pinterest', 'mail' ),
				'name'     => 'After Post Content',
				'location' => 'after-content',
				'mode'     => 'mixed',
				'before'   => '',
				'after'    => '',
				'display'  => true,
				'fields'   => array(
					'display_total' => true,
					'display_count' => true,
				),
			),
			'before-content' => array(
				'shares'   => array( 'facebook', 'twitter', 'pinterest', 'mail' ),
				'name'     => 'Before Post Content',
				'location' => 'before-content',
				'mode'     => 'mixed',
				'before'   => '',
				'after'    => '',
				'fields'   => array(
					'display_total' => true,
					'display_count' => true,
				),
			),
		);

		return $locations;
	}

	/**
	 * Filter Register Layouts
	 *
	 * @param array $layouts List of Layouts.
	 */
	public function layouts_default( $layouts = array() ) {
		$layouts['default'] = array(
			'name' => 'First Two Large Buttons',
		);

		$layouts['equal'] = array(
			'name' => 'Equal Width Buttons',
		);

		$layouts['simple'] = array(
			'name' => 'Simple Buttons',
		);

		return $layouts;
	}

	/**
	 * Filter Register Schemes
	 *
	 * @param array $schemes List of Schemes.
	 */
	public function schemes_default( $schemes = array() ) {
		$schemes['default'] = array(
			'name' => 'Default',
		);

		$schemes['bold-bg'] = array(
			'name' => 'Bold Background',
		);

		$schemes['bold'] = array(
			'name' => 'Bold',
		);

		return $schemes;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'powerkit-share-buttons', plugin_dir_url( __FILE__ ) . 'css/public-powerkit-share-buttons.css', array(), powerkit_get_setting( 'version' ), 'all' );

		// Add RTL support.
		wp_style_add_data( 'powerkit-share-buttons', 'rtl', 'replace' );
	}
}
