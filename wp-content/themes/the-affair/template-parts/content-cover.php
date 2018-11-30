
<?php
/**
 * Template part content cover
 *
 * @package The Affair
 */

$class       = 'cs-merge-init';
$post_type   = get_post_type();
$post_format = get_post_format();

// Filter post format.
$post_format = in_array( $post_format, array( 'video', 'gallery' ), true ) ? $post_format : 'standard';

// Starting thumbnail orientation.
$thumbnail_orientation = null;

// If post has no thumbnail use the default width.
if ( ! has_post_thumbnail() ) {
	$thumbnail_orientation = 'cs-thumbnail-portrait';
}

// Overwriting orientation Video post format.
if ( in_array( $post_format, array( 'video' ), true ) ) {
	$thumbnail_orientation = 'cs-thumbnail-landscape';
}

// Get thumbnail data.
$thumbnail_data = csco_attachment_orientation_data( get_post_thumbnail_id(), true, $thumbnail_orientation );

// Getting image orientation and setting width of columns.
if ( 'standard' !== $post_format ) {
	$class .= ' cs-thumbnail-landscape';
} else {
	if ( 'landscape' === $thumbnail_data['orientation'] ) {
		$class .= ' cs-thumbnail-landscape';
	} elseif ( 'square' === $thumbnail_data['orientation'] ) {
		$class .= ' cs-cover-square';
	} else {
		$class .= ' cs-cover-large';
	}
}

// Content Background.
$color_class = csco_get_cover_background();
?>

<div class="cs-cover <?php echo esc_attr( $class ); ?> cs-cover-<?php echo esc_attr( $post_format ); ?>">

	<header class="cover-header entry-header <?php echo esc_attr( $color_class ); ?>">

		<?php do_action( 'csco_singular_entry_header_start' ); ?>

		<?php
		if ( is_singular() ) {
			if ( 'post' === $post_type ) {
				csco_get_post_meta( 'category', false, false, true, 'post_meta' );
			}

			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === $post_type ) {
				csco_get_post_meta( array( 'author', 'date', 'shares', 'comments', 'views', 'reading_time' ), false, true, true, 'post_meta' );
			}
		} else {
			// Post Category.
			if ( 'post' === $post_type ) {
				csco_get_post_meta( 'category', false, false, true, true );
			}

			// Post Title.
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			// Post Meta.
			if ( 'post' === $post_type ) {
				csco_get_post_meta( array( 'author', 'date', 'shares', 'comments' ), false, true, true, true );
			}

			// View Post.
			if ( get_theme_mod( csco_get_archive_option( 'more_button' ), true ) ) {
				?>
				<div class="entry-more-button">
					<a class="entry-more" href="<?php echo esc_url( get_permalink() ); ?>">
						<?php esc_html_e( 'View Post', 'the-affair' ); ?>
					</a>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'csco_singular_entry_header_end' ); ?>

	</header>

	<div class="cover-container">
		<?php
		// Post thumbnail.
		if ( 'standard' === $post_format ) {
		?>
			<div class="cover-item cover-thumbnail" data-merge="2">
				<figure class="cs-cover-overlay-background">
					<?php
						the_post_thumbnail( $thumbnail_data['size'], array(
							'class' => 'pk-lazyload-disabled',
						) );
					?>
				</figure>

				<?php if ( ! is_singular() ) { ?>
					<div class="cover-meta">
						<?php csco_get_post_meta( array( 'views', 'reading_time' ), false, false, true, true ); ?>
					</div>
					<a href="<?php the_permalink(); ?>"></a>
				<?php } ?>
			</div>
		<?php
		// Oembed item.
		} elseif ( 'video' === $post_format ) {

			$oembed_url = get_post_meta( get_the_ID(), 'powerkit_post_format_video', true );
			?>
			<div class="cover-item cover-video" data-merge="2">
				<div class="cs-embed cs-embed-responsive">
					<?php echo wp_oembed_get( $oembed_url ); // XSS. ?>
				</div>
			</div>
			<?php
		}
		?>

		<?php
		// Gallery items.
		if ( 'gallery' === $post_format ) {
			$attachments = get_post_meta( get_the_ID(), 'powerkit_post_format_gallery', true );

			if ( $attachments ) {
				?>
				<div class="cs-merge-carousel" data-columns="2">
					<?php

					foreach ( $attachments as $attachment ) {
						$attachment_data = csco_attachment_orientation_data( $attachment, false );

						$merge = 'portrait' === $attachment_data['orientation'] ? 1 : 2;
						?>
							<div class="owl-slide owl-image cover-item cover-gallery" data-merge="<?php echo esc_attr( $merge ); ?>">
								<figure class="cs-cover-overlay-background"><?php echo wp_get_attachment_image( $attachment, $attachment_data['size'] ); ?></figure>
							</div>
						<?php
					}

					if ( ! is_singular() ) {
						$merge = 'landscape' === $attachment_data['orientation'] ? 2 : 1;
					?>
						<div class="owl-slide cover-item cover-content" data-merge="<?php echo esc_attr( $merge ); ?>">
							<div class="cover-content-wrap">
								<?php
								// Post Meta.
								csco_get_post_meta( array( 'views', 'reading_time' ), true, false, true, true );

								// View Post.
								if ( get_theme_mod( csco_get_archive_option( 'more_button' ), true ) ) {
									?>
									<div class="entry-more-button">
										<a class="entry-more" href="<?php echo esc_url( get_permalink() ); ?>">
											<?php esc_html_e( 'View Post', 'the-affair' ); ?>
										</a>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					<?php
					}
					?>
				</div>
				<div class="owl-nav"></div>
				<div class="owl-dots"></div>
				<?php
			}
		}
		?>
	</div>

</div>
