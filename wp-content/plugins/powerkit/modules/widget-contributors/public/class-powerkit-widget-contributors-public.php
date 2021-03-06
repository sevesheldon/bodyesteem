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
class Powerkit_Widget_Contributors_Public extends Powerkit_Module_Public {

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		wp_enqueue_style( 'powerkit-widget-сontributors', plugin_dir_url( __FILE__ ) . 'css/public-powerkit-widget-contributors.css', array(), powerkit_get_setting( 'version' ), 'all' );

		// Add RTL support.
		wp_style_add_data( 'powerkit-widget-сontributors', 'rtl', 'replace' );
	}
}
