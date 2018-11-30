<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The Affair
 */

global $wp_query;

$post_type = get_post_type();

// Var Archive type.
$archive_layout = get_theme_mod( csco_get_archive_option( 'layout' ), 'full' );

// Content Background.
$color_class = csco_get_cover_background();
?>

<div class="post-outer <?php echo esc_attr( $color_class ); ?>">

	<?php
	$orientation = 'cs-ratio-landscape';

	$attachment_size = 'cs-thumbnail-landscape';

	if ( 'fullwidth' === csco_get_page_layout() ) {
		$attachment_size = 'cs-large-landscape';
	} elseif ( 'disabled' === csco_get_page_sidebar() ) {
		$attachment_size = 'cs-medium-landscape';
	}

	if ( 'masonry' === $archive_layout ) {
		$attachment_size = 'cs-thumbnail-uncropped';

		if ( 'fullwidth' === csco_get_page_layout() ) {
			$attachment_size = 'cs-large-uncropped';
		} elseif ( 'disabled' === csco_get_page_sidebar() ) {
			$attachment_size = 'cs-medium-uncropped';
		}

		$orientation = null;
	}
	?>

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-inner post-inner-thumbnail">
		<div class="entry-thumbnail">
			<div class="cs-overlay cs-overlay-entry cs-overlay-hover cs-overlay-ratio cs-bg-dark <?php echo esc_attr( $orientation ); ?>">
				<div class="cs-overlay-background">
					<?php the_post_thumbnail( $attachment_size ); ?>
				</div>
				<?php if ( 'post' === $post_type ) { ?>
				<div class="cs-overlay-content">
					<?php csco_get_post_meta( 'category', false, false, true, true ); ?>
					<?php csco_get_post_meta( array( 'views', 'reading_time', 'comments' ), false, false, true, true ); ?>
					<?php csco_the_post_format_icon(); ?>
				</div>
				<?php } ?>
				<a href="<?php the_permalink(); ?>" class="cs-overlay-link"></a>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="post-inner post-inner-content">
		<header class="entry-header">
			<?php

			// Post Title.
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			// Post Meta.
			if ( 'post' === $post_type ) {
				csco_get_post_meta( array( 'author', 'date', 'shares' ), false, true, true, true );
			}
			?>
		</header><!-- .entry-header -->

		<div class="entry-excerpt">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-excerpt -->

		<?php
		if ( get_theme_mod( csco_get_archive_option( 'more_button' ), true ) ) {
			?>
			<div class="entry-more-button">
				<a class="entry-more" href="<?php echo esc_url( get_permalink() ); ?>">
					<?php esc_html_e( 'View Post', 'the-affair' ); ?>
				</a>
			</div><!-- .entry-more-button -->
			<?php
		}
		?>

	</div><!-- .post-inner -->

</div><!-- .post-outer -->
