<?php
/**
 * The Affair functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The Affair
 */

if ( ! function_exists( 'csco_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function csco_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on The Affair, use a find and replace
		 * to change 'the-affair' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'the-affair', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Register custom thumbnail sizes.
		add_image_size( 'cs-small', 80, 80, true );
		add_image_size( 'cs-intermediate', 155, 120, true );
		add_image_size( 'cs-thumbnail-uncropped', 480, 0, false );
		add_image_size( 'cs-thumbnail-landscape', 640, 420, true );
		add_image_size( 'cs-thumbnail-portrait', 320, 420, true );
		add_image_size( 'cs-thumbnail-square', 480, 480, true );
		add_image_size( 'cs-medium-uncropped', 640, 0, false );
		add_image_size( 'cs-medium-landscape', 880, 580, true );
		add_image_size( 'cs-medium-portrait', 440, 580, true );
		add_image_size( 'cs-medium-square', 660, 660, true );
		add_image_size( 'cs-large-uncropped', 960, 0, false );
		add_image_size( 'cs-large-landscape', 1280, 840, true );
		add_image_size( 'cs-large-portrait', 640, 840, true );
		add_image_size( 'cs-large-square', 960, 960, true );
		add_image_size( 'cs-extra-large', 1920, 0, false );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'the-affair' ),
			'mobile'  => esc_html__( 'Mobile', 'the-affair' ),
			'footer'  => esc_html__( 'Footer', 'the-affair' ),
		) );

		// Supported Formats.
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

		// Supported Powerkit Formats UI.
		add_theme_support( 'powerkit-post-format-ui' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add editor style.
		add_editor_style( array(
			'/css/editor-style.css',
		) );
	}
endif;
add_action( 'after_setup_theme', 'csco_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function csco_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'csco_content_width', 680 );
}
add_action( 'after_setup_theme', 'csco_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function csco_widgets_init() {

	$tag = apply_filters( 'csco_section_title_tag', 'h5' );

	register_sidebar(
		array(
			'name'          => esc_html__( 'Default Sidebar', 'the-affair' ),
			'id'            => 'sidebar-main',
			'before_widget' => '<div class="widget %1$s %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<' . $tag . ' class="title-block title-widget">',
			'after_title'   => '</' . $tag . '>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Off-Canvas', 'the-affair' ),
			'id'            => 'sidebar-offcanvas',
			'before_widget' => '<div class="widget %1$s %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<' . $tag . ' class="title-block title-widget">',
			'after_title'   => '</' . $tag . '>',
		)
	);
}

add_action( 'widgets_init', 'csco_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function csco_enqueue_scripts() {

	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	// Register vendor scripts.
	wp_register_script( 'colcade', get_template_directory_uri() . '/js/colcade.js', array( 'jquery' ), '0.2.0', true );
	wp_register_script( 'object-fit-images', get_template_directory_uri() . '/js/ofi.min.js', array(), '3.2.3', true );
	wp_register_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	wp_register_script( 'vide', get_template_directory_uri() . '/js/jquery.vide.min.js', array( 'jquery' ), '0.5.1', true );
	wp_register_script( 'jarallax', get_template_directory_uri() . '/js/jarallax.min.js', array( 'jquery' ), '1.10.3', true );
	wp_register_script( 'jarallax-video', get_template_directory_uri() . '/js/jarallax-video.min.js', array( 'jquery' ), '1.0.1', true );

	// Register theme scripts.
	wp_register_script( 'csco-scripts', get_template_directory_uri() . '/js/scripts.js', array(
		'jquery',
		'imagesloaded',
		'owl',
		'colcade',
		'object-fit-images',
		'vide',
		'jarallax',
		'jarallax-video',
	), $version, true );

	// Enqueue theme scripts.
	wp_enqueue_script( 'csco-scripts' );

	// Enqueue comment reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register theme styles.
	wp_register_style( 'csco-styles', get_template_directory_uri() . '/style.css', array(), $version );

	// Enqueue theme styles.
	wp_enqueue_style( 'csco-styles' );

	// Add RTL support.
	wp_style_add_data( 'csco-styles', 'rtl', 'replace' );

	// Dequeue Contact Form 7 styles.
	wp_dequeue_style( 'contact-form-7' );
}
add_action( 'wp_enqueue_scripts', 'csco_enqueue_scripts' );

/**
 * Exclude Featured Posts from the Main Query
 *
 * @param array $query Default query.
 */
function csco_exclude_featured_posts_from_homepage_query( $query ) {

	if ( false === get_theme_mod( 'featured_posts', false ) ) {
		return $query;
	}

	if ( false === get_theme_mod( 'featured_posts_exclude', false ) ) {
		return $query;
	}

	if ( is_admin() || ! ( $query->get( 'page_id' ) === get_option( 'page_on_front' ) || $query->is_home ) ) {
		return $query;
	}

	if ( $query->get( 'page_id' ) === get_option( 'page_on_front' ) && 'page' === get_option( 'show_on_front', 'posts' ) && 'home' === get_theme_mod( 'featured_posts_location', 'front_page' ) ) {
		return $query;
	}

	if ( $query->is_home && 'page' === get_option( 'show_on_front', 'posts' ) && 'front_page' === get_theme_mod( 'featured_posts_location', 'front_page' ) ) {
		return $query;
	}

	if ( ! $query->is_main_query() ) {
		return $query;
	}

	$posts_number = get_theme_mod( 'featured_posts_number', 5 );

	$post_ids = csco_get_filtered_posts_ids( null, $posts_number );

	if ( count( (array) $post_ids ) < $posts_number ) {
		return $query;
	}

	$query->set( 'post__not_in', $post_ids );

	return $query;
}

add_action( 'pre_get_posts', 'csco_exclude_featured_posts_from_homepage_query' );

/**
 * Exclude Trending Posts from category the Main Query
 *
 * @param array $query Default query.
 */
function csco_exclude_trending_posts_from_category_query( $query ) {

	if ( false === get_theme_mod( 'category_trending_posts', true ) ) {
		return $query;
	}

	if ( false === get_theme_mod( 'category_trending_posts_exclude', false ) ) {
		return $query;
	}

	if ( is_admin() || ! $query->is_category ) {
		return $query;
	}

	if ( ! $query->is_main_query() ) {
		return $query;
	}

	$posts_number = get_theme_mod( 'category_trending_posts_number', 5 );

	$post_ids = csco_get_filtered_posts_ids( 'category_trending', $posts_number, true );

	if ( count( (array) $post_ids ) < $posts_number ) {
		return $query;
	}

	$query->set( 'post__not_in', $post_ids );

	return $query;
}

add_action( 'pre_get_posts', 'csco_exclude_trending_posts_from_category_query' );

/**
 *
 * Template Functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Filters.
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Woocommerce.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Customizer Functions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Gallery.
 */
require get_template_directory() . '/inc/gallery.php';

/**
 * Actions.
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Partials.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Meta Boxes.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom post meta function.
 */
require get_template_directory() . '/inc/post-meta.php';

/**
 * Mega menu.
 */
require get_template_directory() . '/inc/mega-menu.php';

/**
 * Load More.
 */
require get_template_directory() . '/inc/load-more.php';

/**
 * Load Nextpost.
 */
require get_template_directory() . '/inc/load-nextpost.php';

/**
 * Custom Content.
 */
require get_template_directory() . '/inc/custom-content.php';

/**
 * Powerkit fuctions.
 */
require get_template_directory() . '/inc/powerkit.php';

/**
 * Plugins.
 */
require get_template_directory() . '/inc/plugins.php';

/**
 * Deprecated.
 */
require get_template_directory() . '/inc/deprecated.php';

/**
 * One Click Demo Import.
 */
require get_template_directory() . '/inc/demo-import/ocdi-filters.php';

/**
 * Customizer demos.
 */
require get_template_directory() . '/inc/demo-import/customizer-demos.php';

/**
 * Theme demos.
 */
require get_template_directory() . '/inc/demo-import/theme-demos.php';
