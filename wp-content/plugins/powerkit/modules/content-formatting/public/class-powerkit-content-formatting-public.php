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
class Powerkit_Content_Formatting_Public extends Powerkit_Module_Public {
	/**
	 * Initialize
	 */
	public function initialize() {
		add_filter( 'after_setup_theme', array( $this, 'setup_theme' ), 10, 1 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	public function setup_theme() {
		add_editor_style( array(
			plugin_dir_url( __FILE__ ) . 'css/public-powerkit-content-formatting.css',
		) );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'powerkit-content-formatting', plugin_dir_url( __FILE__ ) . 'css/public-powerkit-content-formatting.css', array(), powerkit_get_setting( 'version' ), 'all' );

		// Add RTL support.
		wp_style_add_data( 'powerkit-content-formatting', 'rtl', 'replace' );
	}
}
