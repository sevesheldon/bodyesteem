<?php
/**
 * Theme Demos
 *
 * @package The Affair
 */

/**
 * Theme Demos
 */
function csco_theme_demos() {
	$demos = array(
		// Theme mods imported with every demo.
		'common_mods' => array(),
		// Specific demos.
		'demos' => array(
			'the-affair' => array(
				'name' => 'The Affair',
				'preview_image_url' => '/images/theme-demos/the-affair.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_footer_bg' => '#ffffff',
					'color_overlay' => 'rgba(30,30,30,0.4)',
					'featured_posts' => true,
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Karla',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_headings' =>
					array (
						'font-family' => 'Karla',
						'line-height' => '1',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '-0.05em',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'mrporterlive',
					'footer_social_links_scheme' => 'light',
					'footer_title' => 'The Affair',
					'header_alignment' => 'center',
					'hero' => true,
					'hero_background' => 'image',
					'hero_background_color' => '#0c0c0c',
					'hero_content' => 'text',
					'hero_title' => 'The Affair',
					'hero_image_opacity' => 0.7,
					'hero_lead' => 'Creative Blog &amp; Magazine',
					'home_page_layout' => 'boxed',
					'home_pagination_type' => 'load-more',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'right',
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'fullwidth',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',

				),
				'mods_typekit' => array(
					'font_menu' =>
					array (
						'font-family' => 'europa',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.6875rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'europa',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.6875rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'europa',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '0.625rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'europa',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '.875rem',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'europa',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.6875rem',
						'letter-spacing' => '0.25em',
						'text-transform' => 'uppercase',
						'color' => '#5b6166',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
				),
			),
			'steal-my-style' => array(
				'name' => 'Steal My Style',
				'preview_image_url' => '/images/theme-demos/steal-my-style.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_cover_bg_brand' => '#eff4f4',
					'color_cover_bg_primary' => '#f7f2f2',
					'color_cover_bg_secondary' => '#eceff3',
					'color_footer_bg' => '#f7f2f2',
					'color_overlay' => 'rgba(33,32,32,0.43)',
					'color_primary' => '#e6d0d0',
					'effects_navbar_scroll' => false,
					'featured_posts' => false,
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Lora',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'noellekramer',
					'footer_social_links_scheme' => 'light-rounded',
					'footer_title' => 'The Affair',
					'hero' => true,
					'hero_background' => 'image',
					'hero_background_color' => '#0a0a0a',
					'hero_content' => 'text',
					'hero_title' => 'Steal My Style',
					'hero_image_opacity' => 0.8,
					'home_layout' => 'list',
					'home_page_layout' => 'boxed',
					'home_pagination_type' => 'standard',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'right',
					'navbar_sticky' => false,
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'boxed',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
					'sticky_sidebar_method' => 'stick-to-top',
				),
				'mods_typekit' => array(
					'font_headings' =>
					array (
						'font-family' => 'europa',
						'line-height' => '1',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '-0.0125em',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_menu' =>
					array (
						'font-family' => 'europa',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'europa',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '13px',
						'letter-spacing' => '.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'europa',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '0.75rem',
						'letter-spacing' => '0.025em',
						'text-transform' => 'capitalize',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'europa',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '15px',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'europa',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '12px',
						'letter-spacing' => '2px',
						'text-transform' => 'uppercase',
						'color' => '#000000',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
				),
			),
			'gizele-boldrin' => array(
				'name' => 'Gizele Boldrin',
				'preview_image_url' => '/images/theme-demos/gizele-boldrin.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_cover_bg_brand' => '#ffffff',
					'color_cover_bg_primary' => '#f0eae5',
					'color_navbar_submenu' => '#f8f8f6',
					'color_primary' => '#000000',
					'featured_posts' => false,
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Lora',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'thehautepursuit',
					'footer_social_links_scheme' => 'light',
					'footer_title' => 'The Affair',
					'header_search_button' => true,
					'header_social_links_scheme' => 'light',
					'hero' => true,
					'hero_background' => 'video',
					'hero_background_color' => '#0c0c0c',
					'hero_background_video_hosted' => 'https://www.youtube.com/watch?v=adkppas3SRs',
					'hero_content' => 'image',
					'hero_height' => 'calc(100vh - 60px)',
					'hero_image_opacity' => 0.8,
					'hero_lead' => '',
					'home_page_layout' => 'fullwidth',
					'home_pagination_type' => 'infinite',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'disabled',
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'boxed',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
				),
				'mods_typekit' => array(
					'font_headings' =>
					array (
						'font-family' => 'freight-big-pro',
						'line-height' => '1',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_menu' =>
					array (
						'font-family' => 'brandon-grotesque',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.075em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'brandon-grotesque',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'brandon-grotesque',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '.6875rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'brandon-grotesque',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'brandon-grotesque',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.25em',
						'text-transform' => 'uppercase',
						'color' => '#000000',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
				),
			),
			'salt-pepper' => array(
				'name' => 'Salt & Pepper',
				'preview_image_url' => '/images/theme-demos/salt-and-pepper.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_cover_bg_brand' => '#e6e9e6',
					'color_cover_bg_primary' => '#eaefea',
					'color_footer_bg' => '#eff0ef',
					'color_navbar_bg' => '#809785',
					'color_navbar_submenu' => '#ffffff',
					'color_overlay' => 'rgba(89,89,89,0.59)',
					'color_primary' => '#96b49b',
					'effects_navbar_scroll' => false,
					'featured_posts' => false,
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Lora',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_headings' =>
					array (
						'font-family' => 'Barlow Semi Condensed',
						'line-height' => '1',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '0.025em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
					'font_menu' =>
					array (
						'font-family' => 'Barlow Semi Condensed',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'Barlow Semi Condensed',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.25em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'Barlow Semi Condensed',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '.875rem',
						'letter-spacing' => '0.025em',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'Barlow',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '.875rem',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'Barlow Semi Condensed',
						'variant' => '600',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.25em',
						'text-transform' => 'uppercase',
						'color' => '#353535',
						'font-backup' => '',
						'font-weight' => 600,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'food52',
					'footer_social_links_scheme' => 'bold-rounded',
					'footer_title' => 'Salt &amp; Pepper',
					'header_search_button' => true,
					'hero' => false,
					'hero_background' => 'image',
					'hero_background_color' => '#0c0c0c',
					'hero_image_opacity' => 1.0,
					'home_layout' => 'grid',
					'home_page_layout' => 'fullwidth',
					'home_pagination_type' => 'load-more',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'disabled',
					'navbar_sticky' => true,
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'fullwidth',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
				),
			),
			'amber-decor' => array(
				'name' => 'Amber Decor',
				'preview_image_url' => '/images/theme-demos/amber-decor.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_cover_bg_brand' => '#e1deda',
					'color_cover_bg_primary' => '#0e273e',
					'color_cover_bg_secondary' => '#e3e5e0',
					'color_footer_bg' => '#0e273e',
					'color_navbar_bg' => '#0e273e',
					'color_navbar_submenu' => '#0c0c0c',
					'color_overlay' => 'rgba(50,50,66,0.3)',
					'color_primary' => '#0e273e',
					'effects_parallax' => false,
					'featured_posts' => true,
					'featured_posts_columns' => '2',
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Lora',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_headings' =>
					array (
						'font-family' => 'Playfair Display',
						'line-height' => '1',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '-0.0125em',
						'text-transform' => 'capitalize',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'hmhome',
					'footer_social_links_scheme' => 'light',
					'footer_title' => 'Amber Decor',
					'header_alignment' => 'right',
					'header_search_button' => false,
					'header_social_links_scheme' => 'light-rounded',
					'hero' => false,
					'hero_background' => 'image',
					'hero_background_color' => '#0c0c0c',
					'hero_height' => 'calc(100vh - 60px)',
					'hero_image_opacity' => 0.7,
					'home_layout' => 'list',
					'home_more_button' => true,
					'home_page_layout' => 'fullwidth',
					'home_pagination_type' => 'standard',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'right',
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'fullwidth',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
				),
				'mods_typekit' => array(
					'font_menu' =>
					array (
						'font-family' => 'proxima-nova',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '12px',
						'letter-spacing' => '1px',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'proxima-nova',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'proxima-nova',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '0.625rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'proxima-nova',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '14px',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'proxima-nova',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '12px',
						'letter-spacing' => '2px',
						'text-transform' => 'uppercase',
						'color' => '#000000',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
				),
			),
			'wandering-gal' => array(
				'name' => 'Wandering Gal',
				'preview_image_url' => '/images/theme-demos/wandering-gal.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_cover_bg_brand' => '#f0f0e9',
					'color_cover_bg_primary' => '#eaebef',
					'color_cover_bg_secondary' => '#f3f3f1',
					'color_footer_bg' => '#20242b',
					'color_navbar_bg' => '#ffffff',
					'color_navbar_submenu' => '#20242b',
					'color_overlay' => 'rgba(48,48,48,0.62)',
					'color_primary' => '#97a3b8',
					'featured_posts' => false,
					'featured_posts_columns' => '1',
					'featured_posts_exclude' => true,
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'beautifulmatters',
					'footer_social_links_scheme' => 'light-rounded',
					'footer_title' => 'The Affair',
					'header_alignment' => 'left',
					'header_social_links_scheme' => 'light',
					'hero' => true,
					'hero_background' => 'color',
					'hero_background_color' => '#f8f8f8',
					'hero_content' => 'text',
					'hero_title' => 'Wandering Gal',
					'hero_height' => '200px',
					'hero_image_opacity' => 0.9,
					'hero_lead' => 'Creative Blog &amp; Magazine',
					'home_layout' => 'grid',
					'home_page_layout' => 'boxed',
					'home_pagination_type' => 'infinite',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'shares',
						4 => 'views',
						5 => 'reading_time',
					),
					'home_sidebar' => 'disabled',
					'navbar_sticky' => false,
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'fullwidth',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
					'post_subscribe' => false,
				),
				'mods_typekit' => array(
					'font_base' =>
					array (
						'font-family' => 'futura-pt',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1.25rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_headings' =>
					array (
						'font-family' => 'futura-pt',
						'line-height' => '1',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '-0.0125em',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
					'font_menu' =>
					array (
						'font-family' => 'futura-pt',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'futura-pt',
						'variant' => '700',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 700,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'futura-pt',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => '600',
						'font-size' => '.625rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 600,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'futura-pt',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'futura-pt',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1.125rem',
						'letter-spacing' => '-0.0125em',
						'text-transform' => 'none',
						'color' => '#000000',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
				),
			),
			'hardly-visible' => array(
				'name' => 'Hardly Visible',
				'preview_image_url' => '/images/theme-demos/hardly-visible.jpg',
				'mods' => array(
					'archive_page_layout' => 'boxed',
					'archive_sidebar' => 'disabled',
					'category_siblingcategories' => true,
					'color_footer_bg' => '#f4f4f4',
					'color_navbar_bg' => '#f4f4f4',
					'color_overlay' => 'rgba(118,130,141,0.4)',
					'color_primary' => '#898989',
					'featured_posts' => true,
					'featured_posts_columns' => '1',
					'featured_posts_exclude' => true,
					'font_base' =>
					array (
						'font-family' => 'Source Sans Pro',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '1rem',
						'letter-spacing' => '0px',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_headings' =>
					array (
						'font-family' => 'Source Sans Pro',
						'line-height' => '1',
						'variant' => '300',
						'subsets' =>
						array (
							'latin',
						),
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 300,
						'font-style' => 'normal',
					),
					'footer_instagram_recent' => true,
					'footer_instagram_user_id' => 'minimaliststyle',
					'footer_social_links_scheme' => 'light',
					'footer_title' => 'Hardly Visible',
					'hero' => false,
					'hero_background' => 'image',
					'hero_background_color' => '#0c0c0c',
					'hero_image_opacity' => 1.0,
					'home_page_layout' => 'boxed',
					'home_pagination_type' => 'load-more',
					'home_post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
						3 => 'views',
						4 => 'reading_time',
					),
					'home_sidebar' => 'disabled',
					'page_layout' => 'fullwidth',
					'page_sidebar' => 'disabled',
					'post_layout' => 'boxed',
					'post_meta' =>
					array (
						0 => 'category',
						1 => 'author',
						2 => 'date',
					),
					'post_sidebar' => 'disabled',
					'sticky_sidebar_method' => 'stick-to-bottom',
				),
				'mods_typekit' => array(
					'font_menu' =>
					array (
						'font-family' => 'runda',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.75rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_primary' =>
					array (
						'font-family' => 'runda',
						'variant' => '500',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.675rem',
						'letter-spacing' => '0.125em',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 500,
						'font-style' => 'normal',
					),
					'font_secondary' =>
					array (
						'font-family' => 'runda',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '0.675rem',
						'letter-spacing' => '0px',
						'text-transform' => 'uppercase',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_submenu' =>
					array (
						'font-family' => 'runda',
						'subsets' =>
						array (
							'latin',
						),
						'variant' => 'regular',
						'font-size' => '.875rem',
						'letter-spacing' => '0px',
						'text-transform' => 'none',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
					'font_title_block' =>
					array (
						'font-family' => 'runda',
						'variant' => 'regular',
						'subsets' =>
						array (
							'latin',
						),
						'font-size' => '0.75rem',
						'letter-spacing' => '0.25em',
						'text-transform' => 'uppercase',
						'color' => '#000000',
						'font-backup' => '',
						'font-weight' => 400,
						'font-style' => 'normal',
					),
				),
			),
		),
	);
	return $demos;
}
add_filter( 'csco_theme_demos', 'csco_theme_demos' );
