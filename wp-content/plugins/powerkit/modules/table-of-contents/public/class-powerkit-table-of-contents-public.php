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
class Powerkit_Table_Of_Contents_Public extends Powerkit_Module_Public {

	/**
	 * Initialize
	 */
	public function initialize() {
		// Apply toc to content.
		add_filter( 'the_content', array( $this, 'the_content' ), 999 );
	}

	/**
	 * Filters the post content.
	 *
	 * @param string $content The content.
	 */
	public function the_content( $content ) {
		if ( ! is_singular() ) {
			return $content;
		}

		$toc = powerkit_toc_process( $content );

		if ( isset( $toc['content'] ) && $toc['content'] ) {
			$content = $toc['content'];
		}

		return $content;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		if ( is_singular() ) {
			wp_enqueue_script( 'powerkit-table-of-contents', plugin_dir_url( __FILE__ ) . 'js/public-powerkit-table-of-contents.js', array( 'jquery' ), powerkit_get_setting( 'version' ), true );
			wp_enqueue_style( 'powerkit-table-of-contents', plugin_dir_url( __FILE__ ) . 'css/public-powerkit-table-of-contents.css', array(), powerkit_get_setting( 'version' ), 'all' );

			// Add RTL support.
			wp_style_add_data( 'powerkit-table-of-contents', 'rtl', 'replace' );
		}
	}
}
