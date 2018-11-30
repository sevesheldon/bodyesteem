<?php
/**
 * All core theme actions.
 *
 * Please do not modify this file directly.
 * You may remove actions in your child theme by using remove_action().
 *
 * Please see /framework/partials.php for the list of partials,
 * added to actions.
 *
 * @package The Affair
 */

/**
 * Body
 */

add_action( 'csco_site_before', 'csco_offcanvas' );

/**
 * Header
 */

add_action( 'csco_navbar_content_end', 'csco_header_social_links', 10 );

/**
 * Main
 */
add_action( 'csco_main_start', 'csco_homepage_hero' );
add_action( 'csco_main_start', 'csco_homepage_posts' );
add_action( 'csco_main_start', 'csco_page_header' );

/**
 * Main Content
 */

add_action( 'csco_page_header_start', 'csco_breadcrumbs' );

/**
 * Category
 */

add_action( 'csco_page_header_end', 'csco_siblingcategories', 10 );
add_action( 'csco_main_start', 'csco_category_trending', 20 );

/**
 * Post
 */
add_action( 'csco_post_content_before', 'csco_wrap_entry_content', 10 );
add_action( 'csco_post_content_after', 'csco_wrap_entry_content', 10 );
add_action( 'csco_post_entry_content_end', 'csco_page_pagination', 10 );
add_action( 'csco_post_entry_content_end', 'csco_post_author_container', 20 );
add_action( 'csco_post_entry_content_end', 'csco_post_subscribe', 30 );
add_action( 'csco_post_entry_content_end', 'csco_post_tags', 40 );
add_action( 'csco_post_after', 'csco_comments_template', 10 );
add_action( 'csco_post_sidebar_start', 'csco_post_sidebar_details', 10 );
add_action( 'csco_post_wrap_end', 'csco_related_posts', 10 );

/**
 * Page
 */
add_action( 'csco_page_entry_content_end', 'csco_page_pagination', 10 );
add_action( 'csco_page_after', 'csco_comments_template', 10 );

/**
 * Template Page
 */
add_action( 'csco_page_content_end', 'csco_meet_team', 10 );


/**
 * Footer
 */
add_action( 'csco_footer_before', 'csco_instagram_recent' );
add_action( 'csco_footer_after', 'csco_site_search' );
