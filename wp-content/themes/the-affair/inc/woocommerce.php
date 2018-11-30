<?php
/**
 * WooCommerce compatibility functions.
 *
 * @package The Affair
 */

if ( class_exists( 'WooCommerce' ) ) {

	/**
	 * Add support WooCommerce.
	 */
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	/**
	 * Disable shop page title.
	 */
	add_filter( 'woocommerce_show_page_title', function( $default ) {
		if ( is_shop() && has_post_thumbnail( wc_get_page_id( 'shop' ) ) ) {
			return false;
		}
		return $default;
	} );

	/**
	 * Add css selectors to output of kirki.
	 */
	csco_kirki_rules_output( 'csco_color_primary', array(
		'.woocommerce div.product form.cart button[name="add-to-cart"]',
		'.woocommerce div.product form.cart button[type="submit"]',
		'.woocommerce .widget_shopping_cart .buttons a',
		'.woocommerce .wc-proceed-to-checkout a.checkout-button.alt',
		'.woocommerce ul.products li.product .onsale',
		'.woocommerce #respond input#submit',
		'.woocommerce span.onsale',
		'.woocommerce-cart .return-to-shop a.button',
		'.woocommerce-checkout #payment .button.alt',
	), 1 );

	csco_kirki_rules_output( 'csco_color_primary', array(
		'.woocommerce .woocommerce-pagination .page-numbers li > a:hover',
		'.woocommerce li.product .price a:hover',
		'.woocommerce .star-rating',
	) );

	csco_kirki_rules_output( 'csco_font_headings', array(
		'.woocommerce ul.cart_list li a',
		'.woocommerce ul.product_list_widget li a',
		'.woocommerce div.product .woocommerce-tabs ul.tabs li',
		'.woocommerce.widget_products span.product-title',
		'.woocommerce.widget_recently_viewed_products span.product-title',
		'.woocommerce.widget_recent_reviews span.product-title',
		'.woocommerce.widget_top_rated_products span.product-title',
		'.woocommerce-loop-product__title',
		'.woocommerce table.shop_table th',
		'.woocommerce-tabs .panel h2',
		'.related.products > h2',
		'.upsells.products > h2',
	) );

	csco_kirki_rules_output( 'csco_font_secondary', array(
		'.nav-cart .cart-quantity',
		'.widget_shopping_cart .quantity',
		'.woocommerce .widget_layered_nav_filters ul li a',
		'.woocommerce.widget_layered_nav_filters ul li a',
		'.woocommerce.widget_products ul.product_list_widget li',
		'.woocommerce.widget_recently_viewed_products ul.product_list_widget li',
		'.woocommerce.widget_recent_reviews ul.product_list_widget li',
		'.woocommerce.widget_top_rated_products ul.product_list_widget li',
		'.woocommerce .widget_price_filter .price_slider_amount',
		'.woocommerce .woocommerce-result-count',
		'.woocommerce ul.products li.product .price',
		'.woocommerce .woocommerce-breadcrumb',
		'.woocommerce .product_meta',
		'.woocommerce span.onsale',
		'.woocommerce-page .woocommerce-breadcrumb',
	) );

	csco_kirki_rules_output( 'csco_font_primary', array(
		'.woocommerce #respond input#submit',
		'.woocommerce a.button',
		'.woocommerce button.button',
		'.woocommerce input.button',
		'.woocommerce #respond input#submit.alt',
		'.woocommerce a.button.alt',
		'.woocommerce button.button.alt',
		'.woocommerce input.button.alt',
		'.woocommerce-pagination',
		'.woocommerce nav.woocommerce-pagination .page-numbers li > a',
		'.woocommerce ul.products li.product .button',
		'.woocommerce li.product .price',
	) );

	csco_kirki_rules_output( 'csco_font_title_block', array(
		'.woocommerce .woocommerce-tabs .panel h2',
		'.woocommerce .related.products > h2',
		'.woocommerce .upsells.products > h2 ',
		'.woocommerce ul.order_details li',
		'.woocommerce-order-details .woocommerce-order-details__title',
		'.woocommerce-customer-details .woocommerce-column__title',
		'.woocommerce-account .addresses .title h3',
		'.woocommerce-checkout h3',
		'.woocommerce-EditAccountForm legend',
		'.cross-sells > h2',
		'.cart_totals > h2',
	) );

	csco_kirki_rules_output( 'csco_misc_border_radius', array(
		'.widget_product_search .woocommerce-product-search',
		'.widget_product_search .woocommerce-product-search input[type="search"]',
		'.woocommerce-checkout input[id="coupon_code"]',
		'.woocommerce-cart input[id="coupon_code"]',
		'.woocommerce div.product form.cart input.qty',
		'.woocommerce #respond input#submit',
		'.woocommerce a.button',
		'.woocommerce button.button',
		'.woocommerce input.button',
		'.woocommerce #respond input#submit.alt',
		'.woocommerce a.button.alt',
		'.woocommerce button.button.alt',
		'.woocommerce input.button.alt',
	) );

	/**
	 * Add fields to WooCommerce.
	 */
	function csco_wc_add_fields_customizer() {
		Kirki::add_field(
			'csco_theme_mod', array(
				'type'     => 'checkbox',
				'settings' => 'woocommerce_product_catalog_cart',
				'label'    => esc_html__( 'Display add to cart buttom', 'the-affair' ),
				'section'  => 'woocommerce_product_catalog',
				'default'  => false,
				'priority' => 10,
			)
		);

		Kirki::add_section(
			'woocommerce_product_page', array(
				'title'    => esc_html__( 'Product Page', 'the-affair' ),
				'panel'    => 'woocommerce',
				'priority' => 30,
			)
		);

		Kirki::add_field(
			'csco_theme_mod', array(
				'type'     => 'radio',
				'settings' => 'woocommerce_product_page_layout',
				'label'    => esc_html__( 'Default Page Layout', 'the-affair' ),
				'section'  => 'woocommerce_product_page',
				'default'  => 'fullwidth',
				'priority' => 5,
				'choices'  => array(
					'fullwidth' => esc_html__( 'Fullwidth', 'the-affair' ),
					'boxed'     => esc_html__( 'Boxed', 'the-affair' ),
				),
			)
		);

		Kirki::add_field(
			'csco_theme_mod', array(
				'type'     => 'radio',
				'settings' => 'woocommerce_product_page_sidebar',
				'label'    => esc_html__( 'Default Sidebar', 'the-affair' ),
				'section'  => 'woocommerce_product_page',
				'default'  => 'right',
				'priority' => 5,
				'choices'  => array(
					'right'    => esc_attr__( 'Right Sidebar', 'the-affair' ),
					'left'     => esc_attr__( 'Left Sidebar', 'the-affair' ),
					'disabled' => esc_attr__( 'No Sidebar', 'the-affair' ),
				),
			)
		);

		Kirki::add_section(
			'woocommerce_product_misc', array(
				'title'    => esc_html__( 'Miscellaneous', 'the-affair' ),
				'panel'    => 'woocommerce',
				'priority' => 50,
			)
		);

		Kirki::add_field(
			'csco_theme_mod', array(
				'type'     => 'checkbox',
				'settings' => 'woocommerce_header_hide_icon',
				'label'    => esc_html__( 'Hide Cart Icon in Header', 'the-affair' ),
				'section'  => 'woocommerce_product_misc',
				'default'  => false,
				'priority' => 10,
			)
		);
	}
	add_action( 'init', 'csco_wc_add_fields_customizer' );

	/**
	 * Woocommerce loop add to cart
	 */
	function csco_wc_shop_loop_item() {
		if ( ! get_theme_mod( 'woocommerce_product_catalog_cart', false ) ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		}
	}
	add_action( 'template_redirect', 'csco_wc_shop_loop_item' );

	/**
	 * Woocommerce gallery image width
	 */
	function csco_wc_gallery_thumbnail_image_width() {
		add_theme_support( 'woocommerce', array( 'gallery_thumbnail_image_width' => 300 ) );
	}
	add_action( 'template_redirect', 'csco_wc_gallery_thumbnail_image_width' );

	/**
	 * Enqueues WooCommerce assets.
	 */
	function csco_wc_enqueue_scripts() {
		$theme = wp_get_theme();

		$version = $theme->get( 'Version' );

		// Register WooCommerce styles.
		wp_register_style( 'csco_css_wc', get_template_directory_uri() . '/css/woocommerce.css', array(), $version );

		// Enqueue WooCommerce styles.
		wp_enqueue_style( 'csco_css_wc' );
	}
	add_action( 'wp_enqueue_scripts', 'csco_wc_enqueue_scripts' );

	/**
	 * PinIt exclude selectors
	 *
	 * @param string $selectors List selectors.
	 */
	function csco_wc_pinit_exclude_selectors( $selectors ) {
		$selectors[] = '.woocommerce .products img';
		$selectors[] = '.woocommerce-product-gallery img';

		return $selectors;
	}
	add_filter( 'powerkit_pinit_exclude_selectors', 'csco_wc_pinit_exclude_selectors' );

	/**
	 * Get Page Layout
	 *
	 * @param string $layout Page layout.
	 */
	function csco_wc_get_page_layout( $layout ) {

		if ( is_woocommerce() || is_product_category() || is_product_tag() || is_cart() || is_checkout() ) {

			global $post;

			if ( is_shop() ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}

			// Get layout for current post.
			$layout = get_post_meta( $post_id, 'csco_singular_layout', true );

			if ( ! $layout || 'default' === $layout ) {

				$layout = 'fullwidth';

				if ( is_product() ) {
					$layout = get_theme_mod( 'woocommerce_product_page_layout', 'fullwidth' );
				}
			}
		} elseif ( is_account_page() ) {

			$layout = 'fullwidth';

		}

		return $layout;

	}
	add_filter( 'csco_page_layout', 'csco_wc_get_page_layout' );

	/**
	 * Get Page Sidebar
	 *
	 * @param string $sidebar Page sidebar.
	 */
	function csco_wc_get_page_sidebar( $sidebar ) {

		if ( is_woocommerce() || is_product_category() || is_product_tag() || is_cart() || is_checkout() ) {

			global $post;

			if ( is_shop() ) {
				$post_id = wc_get_page_id( 'shop' );
			} else {
				$post_id = $post->ID;
			}

			// Get sidebar for current post.
			$sidebar = get_post_meta( $post_id, 'csco_singular_sidebar', true );

			if ( ! $sidebar || 'default' === $sidebar ) {

				$sidebar = 'disabled';

				if ( is_product() ) {
					$sidebar = get_theme_mod( 'woocommerce_product_page_sidebar', 'right' );
				}
			}
		} elseif ( is_account_page() ) {

			$sidebar = 'disabled';

		}

		return $sidebar;

	}
	add_filter( 'csco_page_sidebar', 'csco_wc_get_page_sidebar' );

	/**
	 * Check if there enable a sidebar for display.
	 *
	 * @param bool   $is_active_sidebar Whether or not the sidebar should be considered "active".
	 * @param string $index             Sidebar name, id or number to check.
	 */
	function csco_wc_is_active_sidebar_woocommerce( $is_active_sidebar, $index ) {

		if ( 'sidebar-woocommerce' === $index && 'disabled' === csco_get_page_sidebar() ) {
			return false;
		}

		return $is_active_sidebar;
	}
	add_filter( 'is_active_sidebar', 'csco_wc_is_active_sidebar_woocommerce', 10, 2 );

	/**
	 * Register WooCommerce Sidebar
	 */
	function csco_wc_widgets_init() {

		$tag = apply_filters( 'csco_section_title_tag', 'h5' );

		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce', 'the-affair' ),
				'id'            => 'sidebar-woocommerce',
				'before_widget' => '<div class="widget %1$s %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<' . $tag . ' class="title-block title-widget">',
				'after_title'   => '</' . $tag . '>',
			)
		);
	}
	add_action( 'widgets_init', 'csco_wc_widgets_init' );

	/**
	 * Overwrite Default Sidebar
	 *
	 * @param string $sidebar Sidebar slug.
	 */
	function csco_wc_sidebar( $sidebar ) {
		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
			return 'sidebar-woocommerce';
		}
		return $sidebar;
	}

	add_filter( 'csco_sidebar', 'csco_wc_sidebar' );

	/**
	 * Add cart to header
	 */
	function csco_wc_nav_cart() {
		if ( ! get_theme_mod( 'woocommerce_header_hide_icon', false ) ) {

			$quantity = intval( WC()->cart->get_cart_contents_count() );
			?>
			<a class="nav-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'the-affair' ); ?>">
				<i class="cs-icon cs-icon-bag"></i>
				<?php if ( $quantity ) { ?>
					<span class="cart-quantity"><?php echo esc_html( $quantity ); ?></span>
				<?php } ?>
			</a>
			<?php
		}
	}
	add_action( 'csco_navbar_content_end', 'csco_wc_nav_cart', 15 );

	/**
	 * Add location for update nav cart
	 *
	 * @param array $fragments The cart fragments.
	 */
	function csco_wc_update_nav_cart( $fragments ) {

		ob_start();

		csco_wc_nav_cart();

		$fragments['a.nav-cart'] = ob_get_clean();

		return $fragments;

	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'csco_wc_update_nav_cart', 10, 1 );

	/**
	 * Toc exclude selectors.
	 *
	 * @param string $selectors The selectors.
	 */
	function csco_wc_toc_exclude( $selectors ) {
		$selectors .= '|.woocommerce-loop-product__title';

		return $selectors;
	}
	add_filter( 'pk_toc_exclude', 'csco_wc_toc_exclude' );

	/**
	 * WC Breadcrumbs
	 */
	function csco_wc_breadcrumbs() {
		$display_options = get_option( 'wpseo_titles' );

		if ( ! isset( $display_options['breadcrumbs-enable'] ) ) {
			$display_options['breadcrumbs-enable'] = false;
		}

		if ( function_exists( 'yoast_breadcrumb' ) && $display_options['breadcrumbs-enable'] ) {
			yoast_breadcrumb( '<section class="cs-breadcrumbs" id="breadcrumbs">', '</section>' );
		} else {
			woocommerce_breadcrumb();
		}
	}

	/**
	 * WC Header SEO Breadcrumbs
	 */
	function csco_wc_header_breadcrumbs() {
		if ( is_product_taxonomy() || is_product() || is_cart() || is_checkout() || is_account_page() ) {
			csco_wc_breadcrumbs();
		}
	}
	add_action( 'csco_page_header_start', 'csco_wc_header_breadcrumbs' );

	/**
	 * WC Shop SEO Breadcrumbs
	 */
	function csco_wc_shop_breadcrumbs() {
		if ( is_shop() && ! has_post_thumbnail( wc_get_page_id( 'shop' ) ) ) {
			csco_wc_breadcrumbs();
		}
	}
	add_action( 'woocommerce_before_main_content', 'csco_wc_shop_breadcrumbs' );

	/**
	 * Remove default breadcrumbs
	 */
	function csco_wc_remove_breadcrumbs() {
		// Remove theme default breadcrumbs.
		if ( is_shop() || is_product_taxonomy() || is_product() || is_cart() || is_checkout() || is_account_page() ) {
			remove_action( 'csco_page_header_start', 'csco_breadcrumbs' );
		}
		// Remove woocommerce default breadcrumbs.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
	add_action( 'template_redirect', 'csco_wc_remove_breadcrumbs' );

	/**
	 * WooCommerce page header.
	 */
	function csco_wc_page_header() {
		$shop_id = wc_get_page_id( 'shop' );

		if ( is_shop() && has_post_thumbnail( $shop_id ) ) {
		?>
			<header class="page-header page-header-overlay cs-bg-dark shop-header">
				<?php
				$attachment_size = 'boxed' === csco_get_page_layout() ? 'cs-large-uncropped' : 'cs-extra-large';
				?>
				<div class="cs-overlay-background cs-parallax-image">
					<?php echo get_the_post_thumbnail( $shop_id, $attachment_size ); ?>
				</div>

				<div class="page-header-container ">
					<?php csco_wc_breadcrumbs(); ?>

					<div class="page-title-block">
						<h1 class="page-title">
							<?php echo get_the_title( $shop_id ); ?>
						</h1>
					</div>
				</div>
			</header>
		<?php
		}
	}
	add_action( 'woocommerce_before_main_content', 'csco_wc_page_header' );

	// Remove default wrappers.
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	/**
	 * Wrapper Start
	 */
	function csco_wc_wrapper_start() {
		?>
		<div id="primary" class="content-area woocommerce-area">
		<main id="main" class="site-main">
			<div class="post-wrap">
				<div class="post-container">
		<?php
	}
	add_action( 'woocommerce_before_main_content', 'csco_wc_wrapper_start', 1 );

	/**
	 * Wrapper End
	 */
	function csco_wc_wrapper_end() {
		?>
				</div>
			</div>
		</main>
		</div>
		<?php
	}
	add_action( 'woocommerce_after_main_content', 'csco_wc_wrapper_end', 999 );
}
