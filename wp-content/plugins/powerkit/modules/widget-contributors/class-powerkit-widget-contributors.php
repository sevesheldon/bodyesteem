<?php
/**
 * Contributors Widget
 *
 * @package    Powerkit
 * @subpackage Modules
 */

/**
 * Init module
 */
class Powerkit_Widget_Contributors extends Powerkit_Module {

	/**
	 * Register module
	 */
	public function register() {
		$this->name     = esc_html__( 'Contributors Widget', 'powerkit' );
		$this->desc     = esc_html__( 'Display a list of your site authors (contributors) in your sidebar, including author name, bio,  and avatar in multiple available layouts.', 'powerkit' );
		$this->slug     = 'widget_сontributors';
		$this->type     = 'default';
		$this->category = 'widget';
		$this->priority = 150;
		$this->public   = true;
		$this->enabled  = true;
		$this->links    = array(
			array(
				'name'   => esc_html__( 'View documentation', 'powerkit' ),
				'url'    => powerkit_get_setting( 'documentation' ) . '/widgets/contributors-widget/',
				'target' => '_blank',
			),
		);
	}

	/**
	 * Initialize module
	 */
	public function initialize() {
		// The classes responsible for defining all actions.
		require_once dirname( __FILE__ ) . '/public/class-powerkit-widget-contributors-init.php';

		// Admin and public area.
		require_once dirname( __FILE__ ) . '/public/class-powerkit-widget-contributors-public.php';

		new Powerkit_Widget_Contributors_Public( $this->slug );
	}
}

new Powerkit_Widget_Contributors();
