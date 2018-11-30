<?php
/**
 * Customizer Functions
 *
 * @package The Affair
 */

/**
 * Include Kirki
 */

// Include Kirki if it exists as a part of the theme and if the Kirki Toolkit plugin is not active.
if ( locate_template( 'inc/kirki/kirki.php' ) && ! class_exists( 'Kirki' ) ) {
	include_once get_template_directory() . '/inc/kirki/kirki.php';
}

// Skip if Kirki is not installed.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Kirki Config
 *
 * @param array $config is an array of Kirki configuration parameters.
 */
function csco_kirki_config( $config ) {

	// Disable Kirki preloader styles.
	$config['disable_loader'] = true;

	// Set correct path for Kirki library.
	$config['url_path'] = get_template_directory_uri() . '/inc/kirki/';

	return $config;

}
add_filter( 'kirki/config', 'csco_kirki_config' );

/**
 * Remove AMP link.
 */
function csco_admin_remove_amp_link(){
	remove_action( 'admin_menu', 'amp_add_customizer_link' );
}
add_action( 'after_setup_theme', 'csco_admin_remove_amp_link', 20 );

/**
 * Remove AMP panel.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_customizer_remove_amp_panel( $wp_customize ) {
	$wp_customize->remove_panel( 'amp_panel' );
}
add_action( 'customize_register', 'csco_customizer_remove_amp_panel', 1000 );

/**
 * Register Theme Mods
 */
Kirki::add_config(
	'csco_theme_mod', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);

/**
 * Site Identity.
 */
require get_template_directory() . '/inc/theme-mods/site-identity.php';

/**
 * Colors.
 */
require get_template_directory() . '/inc/theme-mods/colors.php';

/**
 * Typography.
 */
require get_template_directory() . '/inc/theme-mods/typography.php';

/**
 * Header Settings.
 */
require get_template_directory() . '/inc/theme-mods/header-settings.php';

/**
 * Footer Settings.
 */
require get_template_directory() . '/inc/theme-mods/footer-settings.php';

/**
 * Homepage Settings.
 */
require get_template_directory() . '/inc/theme-mods/homepage-settings.php';

/**
 * Archive Settings.
 */
require get_template_directory() . '/inc/theme-mods/archive-settings.php';

/**
 * Category Settings.
 */
require get_template_directory() . '/inc/theme-mods/category-settings.php';

/**
 * Posts Settings.
 */
require get_template_directory() . '/inc/theme-mods/post-settings.php';

/**
 * Pages Settings.
 */
require get_template_directory() . '/inc/theme-mods/page-settings.php';

/**
 * Miscellaneous Settings.
 */
require get_template_directory() . '/inc/theme-mods/miscellaneous-settings.php';
