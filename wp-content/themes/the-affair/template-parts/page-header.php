<?php
/**
 * The template part for displaying page header.
 *
 * @package The Affair
 */

$header_overlay = false;

if ( is_page() ) {
	$header_overlay = has_post_thumbnail() ? true : $header_overlay;
} else {
	$header_overlay = true;
}
?>

<header class="page-header <?php echo (bool) $header_overlay ? 'page-header-overlay cs-bg-dark' : ''; ?>">
	<?php
	$attachment_size = 'boxed' === csco_get_page_layout() ? 'cs-large-uncropped' : 'cs-extra-large';

	if ( is_category() ) {
		$image_id = get_term_meta( get_query_var( 'cat' ), 'csco_header_image', true );

		if ( 'image' === get_theme_mod( 'hero_background' ) && $image_id ) {
			?>
			<div class="cs-overlay-background cs-parallax-image">
				<?php echo wp_get_attachment_image( $image_id, $attachment_size ); ?>
			</div>
			<?php
		}
	}

	if ( is_page() && has_post_thumbnail() ) {
		$image_id = get_post_thumbnail_id();
		?>
		<div class="cs-overlay-background cs-parallax-image">
			<?php echo wp_get_attachment_image( $image_id, $attachment_size ); ?>
		</div>
		<?php
	}

	do_action( 'csco_page_header_before' );
	?>

	<div class="page-header-container">
		<?php
		do_action( 'csco_page_header_start' );

		if ( is_author() ) {

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			csco_archive_post_count();
			csco_archive_post_description();

		} elseif ( is_archive() ) {

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			csco_archive_post_count();
			csco_archive_post_description();

		} elseif ( is_page() ) {

			?>
			<div class="page-title-block">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
			<?php

		} elseif ( is_search() ) {

			?>
			<p class="page-subtitle"><?php esc_html_e( 'Search Results For', 'the-affair' ); ?></p>
			<h1 class="page-title"><?php echo get_search_query(); ?></h1>
			<?php
			csco_archive_post_count();

		} elseif ( is_404() ) {
			?>
			<div class="page-title-block">
				<p class="page-subtitle"><?php esc_html_e( '404', 'the-affair' ); ?></p>
				<h1 class="page-title"><?php esc_html_e( 'Page not found', 'the-affair' ); ?></h1>
			</div>
			<?php
		}

		do_action( 'csco_page_header_end' );
		?>
	</div>

	<?php do_action( 'csco_page_header_after' ); ?>
</header>
