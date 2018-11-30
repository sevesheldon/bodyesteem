<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The Affair
 */

$sidebar = apply_filters( 'csco_sidebar', 'sidebar-main' );

if ( is_active_sidebar( $sidebar ) ) { ?>

	<aside id="secondary" class="widget-area sidebar-area">
		<div class="sidebar sidebar-1">
			<?php do_action( 'csco_sidebar_start' ); ?>
			<?php dynamic_sidebar( $sidebar ); ?>
			<?php do_action( 'csco_sidebar_end' ); ?>
		</div>
		<div class="sidebar sidebar-2"></div>
		<div class="sidebar sidebar-3"></div>
	</aside><!-- .widget-area -->

<?php
}
