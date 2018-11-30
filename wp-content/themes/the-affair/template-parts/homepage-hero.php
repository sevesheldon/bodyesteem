<?php
/**
 * Template part for displaying hero section
 *
 * @package The Affair
 */

do_action( 'csco_hero_before' );

$class = 'section-hero cs-overlay';

// Add class if background color is dark.
if ( 'image' === get_theme_mod( 'hero_background', 'color' ) || 'color' === get_theme_mod( 'hero_background', 'color' ) ) {
	if ( ! csco_hex_is_light( get_theme_mod( 'hero_background_color', '#F8F8F8' ) ) ) {
		$class .= ' cs-bg-dark';
	}
}

// Add class for center alignment.
if ( 'center' === get_theme_mod( 'hero_alignment', 'center' ) ) {
	$class .= ' cs-text-center';
}

// Set Attachment size.
if ( 'boxed' === csco_get_page_layout() ) {
	$attachment_size = 'cs-large-uncropped';
} else {
	$attachment_size = 'cs-extra-large';
}

// Logo.
$logo_id = get_theme_mod( 'hero_logo' );

// Background Image.
$bg_image_id = get_theme_mod( 'hero_background_image' );

// Background Video.

$bg_video_poster_id = get_theme_mod( 'hero_background_video_poster', false );
$bg_video_source    = get_theme_mod( 'hero_background_video_source', 'hosted' );
$bg_video_hosted    = get_theme_mod( 'hero_background_video_hosted', 'https: //youtu.be/ctvlUvN6wSE' );
$bg_video_start     = get_theme_mod( 'hero_background_video_start', 0 );
$bg_video_end       = get_theme_mod( 'hero_background_video_end', 0 );
$bg_video_self      = get_theme_mod( 'hero_background_video_self', '' );

$bg_video_poster = wp_get_attachment_image_url( $bg_video_poster_id, $attachment_size );
?>

<div class="<?php echo esc_attr( $class ); ?>">

	<?php

	do_action( 'csco_hero_start' );

	if ( 'image' === get_theme_mod( 'hero_background', 'color' ) && $bg_image_id ) {
		?>
		<div class="cs-overlay-background cs-parallax-image">
			<?php
			echo wp_get_attachment_image( $bg_image_id, $attachment_size, false, array(
				'class' => 'pk-lazyload-disabled',
				'sizes' => '100vw',
			) );
			?>
		</div>
		<?php
	}
	?>

	<?php if ( 'video' === get_theme_mod( 'hero_background', 'color' ) ) { ?>

		<?php if ( 'hosted' === $bg_video_source && '' !== $bg_video_hosted ) { ?>

			<div class="cs-overlay-background cs-parallax-video cs-video-hosted" data-video="<?php echo esc_attr( $bg_video_hosted ); ?>" data-video-start="<?php echo esc_attr( $bg_video_start ); ?>" data-video-end="<?php echo esc_attr( $bg_video_end ); ?>">
				<?php if ( $bg_video_poster ) : ?>
					<img src="<?php echo esc_url( $bg_video_poster ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php endif; ?>
			</div>

		<?php } elseif ( 'self' === $bg_video_source && '' !== $bg_video_self ) { ?>

			<div class="cs-overlay-background cs-video-self" data-vide-bg="mp4: <?php echo esc_url( $bg_video_self ); ?>" data-vide-options="posterType: none, loop: true, muted: true, position: 50% 50%">
				<?php if ( $bg_video_poster ) : ?>
					<img src="<?php echo esc_url( $bg_video_poster ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php endif; ?>
			</div>

		<?php } ?>

	<?php } ?>

	<div class="cs-overlay-content">

		<div class="cs-container">

			<div class="hero-content">

				<?php if ( 'text' === get_theme_mod( 'hero_content', 'text' ) ) : ?>

					<?php
					$title = get_theme_mod( 'hero_title', get_bloginfo( 'name' ) );
					if ( $title ) {
					?>
						<h1 class="hero-title"><?php echo wp_kses( $title, 'post' ); ?></h1>
					<?php } ?>

					<?php
					$lead = get_theme_mod( 'hero_lead', get_bloginfo( 'description' ) );
					if ( $lead ) {
					?>
						<div class="hero-description"><?php echo do_shortcode( $lead ); ?></div>
					<?php } ?>

				<?php endif; ?>

				<?php
				if ( 'image' === get_theme_mod( 'hero_content', 'text' ) && $logo_id ) {
					csco_get_retina_image( $logo_id, array(
						'class' => 'logo-image',
						'alt'   => get_bloginfo( 'name' ),
					) );
				}
				?>
			</div>

		</div>

	</div>

	<?php do_action( 'csco_hero_end' ); ?>

</div>

<?php

do_action( 'csco_hero_after' );
