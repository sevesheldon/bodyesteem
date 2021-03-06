<?php
/**
 * Rollback Action.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nonce   = 'upgrade-plugin_' . $this->plugin_slug;
$url     = 'index.php?page=wp-rollback&plugin_file=' . esc_url( $args['plugin_file'] ) . 'action=upgrade-plugin';
$plugin  = $this->plugin_slug;
$version = $args['plugin_version'];

// Theme rollback.
if ( ! empty( $_GET['theme_file'] ) && file_exists( WP_CONTENT_DIR . '/themes/' . $_GET['theme_file'] ) ) {

	// Theme specific vars.
	$nonce   = 'upgrade-theme_' . $_GET['theme_file'];
	$url     = 'index.php?page=wp-rollback&theme_file=' . $args['theme_file'] . 'action=upgrade-theme';
	$version = $_GET['theme_version'];
	$theme   = $_GET['theme_file'];

	$upgrader = new WP_Rollback_Theme_Upgrader( new Theme_Upgrader_Skin( compact( 'title', 'nonce', 'url', 'theme', 'version' ) ) );

	$upgrader->rollback( $_GET['theme_file'] );

} elseif ( ! empty( $_GET['plugin_file'] ) && file_exists( WP_PLUGIN_DIR . '/' . $_GET['plugin_file'] ) ) {
	// This is a plugin rollback.
	$upgrader = new WP_Rollback_Plugin_Upgrader( new Plugin_Upgrader_Skin( compact( 'title', 'nonce', 'url', 'plugin', 'version' ) ) );

	$upgrader->rollback( $this->plugin_file );
} else {
	_e( 'This rollback request is missing a proper query string. Please contact support.', 'wp-rollback' );
}

