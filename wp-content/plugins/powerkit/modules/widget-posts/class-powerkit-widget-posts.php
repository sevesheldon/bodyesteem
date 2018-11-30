<?php
/**
 * Posts Widget
 *
 * @package    Powerkit
 * @subpackage Modules
 */

/**
 * Init module
 */
class Powerkit_Widget_Posts extends Powerkit_Module {

	/**
	 * Register module
	 */
	public function register() {
		$this->name     = esc_html__( 'Featured Posts Widget', 'powerkit' );
		$this->desc     = esc_html__( 'Display a list of posts in your sidebar, including post meta and preview image in multiple available layouts.', 'powerkit' );
		$this->slug     = 'widget_posts';
		$this->type     = 'default';
		$this->category = 'widget';
		$this->priority = 170;
		$this->public   = true;
		$this->enabled  = true;
		$this->links    = array(
			array(
				'name'   => esc_html__( 'View documentation', 'powerkit' ),
				'url'    => powerkit_get_setting( 'documentation' ) . '/widgets/featured-posts-widget/',
				'target' => '_blank',
			),
		);
	}

	/**
	 * Initialize module
	 */
	public function initialize() {
		// Helpers Functions for the module.
		require_once dirname( __FILE__ ) . '/helpers/helper-powerkit-posts.php';

		// The classes responsible for defining all actions.
		require_once dirname( __FILE__ ) . '/public/class-powerkit-widget-posts-init.php';

		// Admin and public area.
		require_once dirname( __FILE__ ) . '/public/class-powerkit-widget-posts-public.php';

		new Powerkit_Widget_Posts_Public( $this->slug );
	}
}

new Powerkit_Widget_Posts();
