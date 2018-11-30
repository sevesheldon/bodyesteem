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
class Powerkit_Pinterest_Public extends Powerkit_Module_Public {

	/**
	 * Initialize
	 */
	public function initialize() {
		add_filter( 'script_loader_tag', array( $this, 'powerkit_pinterest_js_attributes' ), 10, 2 );
	}

	/**
	 * Add custom js attributes.
	 *
	 * @since 1.0.0
	 * @param string $tag    The <script> tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 */
	public function powerkit_pinterest_js_attributes( $tag, $handle ) {
		if ( 'powerkit-pinterest' !== $handle ) {
			return $tag;
		}
		return str_replace( ' src', ' async="async" defer="defer" src', $tag );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		// Styles.
		wp_enqueue_style( 'powerkit-pinterest', plugin_dir_url( __FILE__ ) . 'css/public-powerkit-pinterest.css', array(), powerkit_get_setting( 'version' ), 'all' );

		// Add RTL support.
		wp_style_add_data( 'powerkit-pinterest', 'rtl', 'replace' );

		// Scripts.
		wp_enqueue_script( 'powerkit-pinterest', '//assets.pinterest.com/js/pinit.js', array( 'jquery', 'imagesloaded' ), false, true );

		// PinIt.
		wp_enqueue_script( 'powerkit-pin-it', plugin_dir_url( __FILE__ ) . 'js/public-powerkit-pin-it.js', array( 'jquery', 'imagesloaded' ), powerkit_get_setting( 'version' ), true );

		$image_selectors   = get_option( 'powerkit_pinit_image_selectors', array( '.entry-content img' ) );
		$exclude_selectors = get_option( 'powerkit_pinit_exclude_selectors', array() );

		$image_selectors   = powerkit_pinit_process_selectors( $image_selectors );
		$exclude_selectors = powerkit_pinit_process_selectors( $exclude_selectors );

		$image_selectors   = apply_filters( 'powerkit_pinit_image_selectors', $image_selectors );
		$exclude_selectors = apply_filters( 'powerkit_pinit_exclude_selectors', $exclude_selectors );

		wp_localize_script( 'powerkit-pin-it', 'powerkit_pinit_localize', array(
			'image_selectors'   => implode( ',', $image_selectors ),
			'exclude_selectors' => implode( ',', $exclude_selectors ),
			'only_hover'        => get_option( 'powerkit_pinit_only_hover', true ),
		) );
	}
}
