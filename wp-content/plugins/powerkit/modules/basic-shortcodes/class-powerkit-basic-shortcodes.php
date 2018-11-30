<?php
/**
 * Basic Shortcodes
 *
 * @package    Powerkit
 * @subpackage Modules
 */

/**
 * Init module
 */
class Powerkit_Basic_Shortcodes extends Powerkit_Module {

	/**
	 * Register module
	 */
	public function register() {
		$this->name     = esc_html__( 'Basic Shortcodes', 'powerkit' );
		$this->desc     = esc_html__( 'Basic shortcodes with a shortcode generator right in the WordPress editor.', 'powerkit' );
		$this->slug     = 'basic_shortcodes';
		$this->type     = 'default';
		$this->category = 'basic';
		$this->priority = 80;
		$this->public   = true;
		$this->enabled  = true;

		$this->links = array(
			array(
				'name'   => esc_html__( 'View documentation', 'powerkit' ),
				'url'    => powerkit_get_setting( 'documentation' ) . '/content-presentation/basic-shortcodes/',
				'target' => '_blank',
			),
		);
	}

	/**
	 * Initialize module
	 */
	public function initialize() {

		/* Load the required dependencies for this module */

		// Helpers Functions for the module.
		require_once dirname( __FILE__ ) . '/helpers/helper-basic-shortcodes.php';

		// Admin and public area.
		require_once dirname( __FILE__ ) . '/admin/class-powerkit-basic-shortcodes-admin.php';
		require_once dirname( __FILE__ ) . '/public/class-powerkit-basic-shortcodes-public.php';

		// Include default templates.
		powerkit_basic_shortcodes_autoload( dirname( __FILE__ ) . '/templates' );

		new Powerkit_Basic_Shortcodes_Admin( $this->slug );
		new Powerkit_Basic_Shortcodes_Public( $this->slug );
	}
}

new Powerkit_Basic_Shortcodes();
