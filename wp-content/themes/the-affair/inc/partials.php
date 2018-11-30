<?php
/**
 * These functions are used to load template parts (partials) or actions when used within action hooks,
 * and they probably should never be updated or modified.
 *
 * @package The Affair
 */

/**
 * Off-canvas
 */
function csco_offcanvas() {
	get_template_part( 'template-parts/offcanvas' );
}

/**
 * Header Social Links
 */
function csco_header_social_links() {

	if ( ! get_theme_mod( 'header_social_links', false ) ) {
		return;
	}

	if ( ! csco_powerkit_module_enabled( 'social_links' ) ) {
		return;
	}

	$bg_scheme = csco_light_or_dark( get_theme_mod( 'color_navbar_bg', '#FFFFFF' ), null, ' cs-bg-dark' );

	$scheme  = get_theme_mod( 'header_social_links_scheme', 'light' );
	$maximum = get_theme_mod( 'header_social_links_maximum', 3 );
	?>
	<div class="navbar-social-links <?php echo esc_attr( $bg_scheme ); ?>">
		<?php powerkit_social_links( false, false, true, 'nav', $scheme, 'mixed', $maximum ); ?>
	</div>
	<?php
}

/**
 * Post Sidebar Details
 */
function csco_post_sidebar_details() {
	if ( ! is_single() ) {
		return;
	}

	if ( 'disabled' !== csco_get_page_sidebar() ) {
		return;
	}
	if ( 'fullwidth' !== csco_get_page_layout() ) {
		return;
	}

	if ( in_array( 'author', (array) get_theme_mod( 'post_meta', array( 'author' ) ), true ) ) {
		get_template_part( 'template-parts/post-author' );
	}

	if ( in_array( 'category', (array) get_theme_mod( 'post_meta', array( 'category' ) ), true ) ) {
	?>
	<section class="post-details-category">
		<?php csco_get_post_meta( 'category' ); ?>
	</section>
	<?php
	}
}

/**
 * Post Author
 */
function csco_post_author_container() {
	if ( ! is_single() ) {
		return;
	}
	if ( 'disabled' === csco_get_page_sidebar() && 'boxed' !== csco_get_page_layout() ) {
		return;
	}
	if ( in_array( 'author', (array) get_theme_mod( 'post_meta', array( 'author' ) ), true ) ) {
		get_template_part( 'template-parts/post-author' );
	}
}

/**
 * Post Subscribe
 */
function csco_post_subscribe() {
	if ( ! is_single() ) {
		return;
	}
	if ( false === get_theme_mod( 'post_subscribe', false ) ) {
		return;
	}
	if ( function_exists( 'powerkit_module_enabled' ) && powerkit_module_enabled( 'opt_in_forms' ) ) {

		get_template_part( 'template-parts/post-subscribe' );
	}
}

/**
 * Comments Template
 */
function csco_comments_template() {
	if ( ! ( comments_open() || get_comments_number() ) ) {
		return;
	}

	if ( post_password_required() ) {
		return;
	}

	comments_template();
}

/**
 * Site Search
 */
function csco_site_search() {
	get_template_part( 'template-parts/site-search' );
}

/**
 * Page Header
 */
function csco_page_header() {
	if ( ! ( is_archive() || is_page() || is_search() || is_404() ) ) {
		return;
	}
	if ( is_front_page() && (int) get_the_ID() === (int) get_option( 'page_on_front' ) && ! get_theme_mod( 'static_homepage_header', false ) ) {
		return;
	}
	if ( is_home() && (int) get_the_ID() === (int) get_option( 'page_on_front' ) && ! get_theme_mod( 'static_posts_header', false ) ) {
		return;
	}
	get_template_part( 'template-parts/page-header' );
}

/**
 * Yoast SEO Breadcrumbs
 */
function csco_breadcrumbs() {
	if ( ! function_exists( 'yoast_breadcrumb' ) || is_front_page() ) {
		return;
	}
	yoast_breadcrumb( '<section class="cs-breadcrumbs" id="breadcrumbs">', '</section>' );
}

/**
 * Sibling Categories
 */
function csco_siblingcategories() {

	if ( false === get_theme_mod( 'category_siblingcategories', true ) ) {
		return;
	}

	if ( ! is_category() ) {
		return;
	}

	get_template_part( 'template-parts/siblingcategories' );
}

/**
 * Homepage Hero Section
 */
function csco_homepage_hero() {

	if ( false === get_theme_mod( 'hero', false ) ) {
		return;
	}

	if ( ! ( is_front_page() || is_home() ) ) {
		return;
	}

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $paged ) {
		return;
	}

	if ( is_front_page() && 'page' === get_option( 'show_on_front', 'posts' ) && 'home' === get_theme_mod( 'hero_location', 'front_page' ) ) {
		return;
	}

	if ( is_home() && 'page' === get_option( 'show_on_front', 'posts' ) && 'front_page' === get_theme_mod( 'hero_location', 'front_page' ) ) {
		return;
	}

	get_template_part( 'template-parts/homepage-hero' );
}

/**
 * Homepage Posts Section
 */
function csco_homepage_posts() {

	if ( false === get_theme_mod( 'featured_posts', false ) ) {
		return;
	}

	if ( ! ( is_front_page() || is_home() ) ) {
		return;
	}

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $paged ) {
		return;
	}

	if ( is_front_page() && 'page' === get_option( 'show_on_front', 'posts' ) && 'home' === get_theme_mod( 'featured_posts_location', 'front_page' ) ) {
		return;
	}

	if ( is_home() && 'page' === get_option( 'show_on_front', 'posts' ) && 'front_page' === get_theme_mod( 'featured_posts_location', 'front_page' ) ) {
		return;
	}

	get_template_part( 'template-parts/homepage-posts' );
}

/**
 * Category Trending Posts Section
 */
function csco_category_trending() {

	if ( false === get_theme_mod( 'category_trending_posts', true ) ) {
		return;
	}

	if ( ! is_category() ) {
		return;
	}

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

	if ( 1 !== $paged ) {
		return;
	}

	get_template_part( 'template-parts/category-trending' );
}

/**
 * Display Recent Instagram Photos
 */
function csco_instagram_recent() {

	if ( false === get_theme_mod( 'footer_instagram_recent', false ) ) {
		return;
	}

	if ( function_exists( 'powerkit_instagram_get_recent' ) ) {
		?>
		<div class="instagram-timeline">
			<?php
				powerkit_instagram_get_recent( array(
					'user_id' => get_theme_mod( 'footer_instagram_user_id' ),
					'number'  => 6,
					'columns' => 6,
					'size'    => 'small',
					'target'  => '_blank',
				), 'csco_instagram_recent' );
			?>
		</div>
		<?php
	}
}

/**
 * Related Posts
 */
function csco_related_posts() {
	if ( ! is_single() ) {
		return;
	}
	if ( false === get_theme_mod( 'related', true ) ) {
		return;
	}
	get_template_part( 'template-parts/related-posts' );
}

/**
 * Meet Team
 */
function csco_meet_team() {
	if ( is_page_template( 'template-meet-team.php' ) ) {
		get_template_part( 'template-parts/meet-team' );
	}
}
