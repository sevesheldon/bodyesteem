<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package The Affair
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'csco_site_before' ); ?>

<div id="page" class="site">

	<?php do_action( 'csco_site_start' ); ?>

	<div class="site-inner">

		<?php do_action( 'csco_header_before' ); ?>

		<header id="masthead" class="site-header">

			<?php do_action( 'csco_header_start' ); ?>

			<?php $scheme = csco_light_or_dark( get_theme_mod( 'color_navbar_bg', '#FFFFFF' ), null, ' cs-bg-navbar-dark' ); ?>

			<nav class="navbar navbar-primary">

				<?php do_action( 'csco_navbar_start' ); ?>

				<div class="navbar-wrap <?php echo esc_attr( $scheme ); ?>">

					<div class="navbar-left">
						<?php if ( csco_offcanvas_exists() ) { ?>
							<button type="button" class="toggle-offcanvas">
								<i class="cs-icon cs-icon-menu"></i>
							</button>
						<?php } ?>
					</div><!-- .navbar-left -->

					<div class="cs-container navbar-container">

						<div class="navbar-content navbar-content-<?php echo esc_attr( get_theme_mod( 'header_alignment', 'right' ) ); ?>">

							<?php do_action( 'csco_navbar_content_start' ); ?>

							<?php
							$logo_id = get_theme_mod( 'logo' );

							if ( $logo_id ) {
								?>
								<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ) ); ?>
								</a>
								<?php
							} else {
								?>
								<a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								<?php
							}
							?>

							<?php
							if ( has_nav_menu( 'primary' ) ) {
								$submenu_scheme = csco_light_or_dark( get_theme_mod( 'color_navbar_submenu', '#FFFFFF' ), null, ' cs-navbar-nav-submenu-dark' );

								wp_nav_menu( array(
									'menu_class'      => sprintf( 'navbar-nav %s', $submenu_scheme ),
									'theme_location'  => 'primary',
									'container'       => '',
									'container_class' => '',
								) );
							}
							?>

							<?php do_action( 'csco_navbar_content_end' ); ?>

						</div><!-- .navbar-content -->

					</div><!-- .navbar-container -->

					<div class="navbar-right">
						<?php
						if ( get_theme_mod( 'header_search_button', true ) ) {
							?>
							<button type="button" class="open-search">
								<i class="cs-icon cs-icon-search"></i>
							</button>
							<?php
						}
						?>
					</div><!-- .navbar-right -->

				</div><!-- .navbar-wrap -->

				<?php do_action( 'csco_navbar_end' ); ?>

			</nav><!-- .navbar -->

			<?php do_action( 'csco_header_end' ); ?>

		</header><!-- #masthead -->

		<?php do_action( 'csco_header_after' ); ?>

		<?php do_action( 'csco_site_content_before' ); ?>

		<div class="site-content">

			<?php do_action( 'csco_site_content_start' ); ?>

			<div class="cs-container site-container">

				<?php do_action( 'csco_main_content_before' ); ?>

				<div id="content" class="main-content">

					<?php do_action( 'csco_main_content_start' ); ?>
