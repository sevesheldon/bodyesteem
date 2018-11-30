<?php
/**
 * Homepage Settings
 *
 * @package The Affair
 */

/**
 * Removes default WordPress Static Front Page section
 * and re-adds it in our own panel with the same parameters.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_reorder_customizer_settings( $wp_customize ) {

	// Get current front page section parameters.
	$static_front_page = $wp_customize->get_section( 'static_front_page' );

	// Remove existing section, so that we can later re-add it to our panel.
	$wp_customize->remove_section( 'static_front_page' );

	// Re-add static front page section with a new name, but same description.
	$wp_customize->add_section( 'static_front_page', array(
		'title'           => esc_html__( 'Static Front Page', 'the-affair' ),
		'priority'        => 20,
		'description'     => $static_front_page->description,
		'panel'           => 'homepage_settings',
		'active_callback' => $static_front_page->active_callback,
	) );
}
add_action( 'customize_register', 'csco_reorder_customizer_settings' );

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'checkbox',
		'settings'        => 'static_homepage_header',
		'label'           => esc_html__( 'Display page header on homepage', 'the-affair' ),
		'section'         => 'static_front_page',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'checkbox',
		'settings'        => 'static_posts_header',
		'label'           => esc_html__( 'Display page header on posts page', 'the-affair' ),
		'section'         => 'static_front_page',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

Kirki::add_panel(
	'homepage_settings', array(
		'title'    => esc_html__( 'Homepage Settings', 'the-affair' ),
		'priority' => 50,
	)
);

Kirki::add_section(
	'homepage_layout', array(
		'title'    => esc_html__( 'Homepage Layout', 'the-affair' ),
		'priority' => 15,
		'panel'    => 'homepage_settings',
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'home_page_layout',
		'label'    => esc_html__( 'Page Layout', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => 'boxed',
		'priority' => 10,
		'choices'  => array(
			'fullwidth' => esc_html__( 'Fullwidth', 'the-affair' ),
			'boxed'     => esc_html__( 'Boxed', 'the-affair' ),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'home_layout',
		'label'    => esc_html__( 'Homepage Layout', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => 'full',
		'priority' => 10,
		'choices'  => array(
			'full'    => esc_html__( 'Full Layout', 'the-affair' ),
			'list'    => esc_html__( 'List Layout', 'the-affair' ),
			'grid'    => esc_html__( 'Grid Layout', 'the-affair' ),
			'masonry' => esc_html__( 'Masonry Layout', 'the-affair' ),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'home_sidebar',
		'label'    => esc_html__( 'Sidebar', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => 'right',
		'priority' => 10,
		'choices'  => array(
			'right'    => esc_attr__( 'Right Sidebar', 'the-affair' ),
			'left'     => esc_attr__( 'Left Sidebar', 'the-affair' ),
			'disabled' => esc_attr__( 'No Sidebar', 'the-affair' ),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'multicheck',
		'settings' => 'home_post_meta',
		'label'    => esc_attr__( 'Post Meta', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => array( 'category', 'author', 'date', 'shares', 'views', 'reading_time' ),
		'priority' => 10,
		'choices'  => apply_filters( 'csco_post_meta_choices', array(
			'category'     => esc_html__( 'Category', 'the-affair' ),
			'author'       => esc_html__( 'Author', 'the-affair' ),
			'date'         => esc_html__( 'Date', 'the-affair' ),
			'shares'       => esc_html__( 'Shares', 'the-affair' ),
			'views'        => esc_html__( 'Views', 'the-affair' ),
			'comments'     => esc_html__( 'Comments', 'the-affair' ),
			'reading_time' => esc_html__( 'Reading Time', 'the-affair' ),
		) ),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'home_more_button',
		'label'    => esc_html__( 'Display View Post button', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'home_pagination_type',
		'label'    => esc_html__( 'Pagination', 'the-affair' ),
		'section'  => 'homepage_layout',
		'default'  => 'load-more',
		'priority' => 10,
		'choices'  => array(
			'standard'  => esc_html__( 'Standard', 'the-affair' ),
			'load-more' => esc_html__( 'Load More Button', 'the-affair' ),
			'infinite'  => esc_html__( 'Infinite Load', 'the-affair' ),
		),
	)
);

Kirki::add_section(
	'hero', array(
		'title'    => esc_html__( 'Hero Section', 'the-affair' ),
		'panel'    => 'homepage_settings',
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'hero',
		'label'    => esc_html__( 'Display hero section', 'the-affair' ),
		'section'  => 'hero',
		'default'  => false,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'hero_height',
		'label'           => esc_html__( 'Hero Height', 'the-affair' ),
		'description'     => esc_html__( 'Input height in pixels. To fit viewport height input calc(100vh - 60px).', 'the-affair' ),
		'section'         => 'hero',
		'default'         => '420px',
		'priority'        => 10,
		'output'          => array(
			array(
				'element'  => '.section-hero',
				'property' => 'min-height',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'radio',
		'settings'        => 'hero_location',
		'label'           => esc_html__( 'Display Location', 'the-affair' ),
		'section'         => 'hero',
		'default'         => 'front_page',
		'priority'        => 10,
		'choices'         => array(
			'front_page' => esc_html__( 'Homepage', 'the-affair' ),
			'home'       => esc_html__( 'Posts page', 'the-affair' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'radio',
		'settings'        => 'hero_alignment',
		'label'           => esc_html__( 'Alignment', 'the-affair' ),
		'section'         => 'hero',
		'default'         => 'center',
		'priority'        => 10,
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'the-affair' ),
			'center' => esc_html__( 'Center', 'the-affair' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'select',
	'settings'        => 'hero_background',
	'label'           => esc_html__( 'Background', 'the-affair' ),
	'section'         => 'hero',
	'default'         => 'color',
	'priority'        => 10,
	'choices'         => array(
		'image' => esc_html__( 'Image', 'the-affair' ),
		'video' => esc_html__( 'Video', 'the-affair' ),
		'color' => esc_html__( 'Solid Color', 'the-affair' ),
		'none'  => esc_html__( 'None', 'the-affair' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'image',
		'settings'        => 'hero_background_image',
		'label'           => esc_html__( 'Background Image', 'the-affair' ),
		'section'         => 'hero',
		'priority'        => 10,
		'choices'         => array(
			'save_as' => 'id',
		),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_background',
				'operator' => '==',
				'value'    => 'image',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'slider',
		'settings'        => 'hero_image_opacity',
		'label'           => esc_html__( 'Image Opacity', 'the-affair' ),
		'section'         => 'hero',
		'default'         => 1,
		'choices'         => array(
			'min'  => '0.1',
			'max'  => '1',
			'step' => '0.1',
		),
		'transport'       => 'auto',
		'output'          => apply_filters( 'csco_hero_image_opacity', array(
			array(
				'element'  => '.section-hero .cs-overlay-background img',
				'property' => 'opacity',
			),
		) ),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_background',
				'operator' => '==',
				'value'    => 'image',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'color',
		'settings'        => 'hero_background_color',
		'label'           => esc_html__( 'Background Color', 'the-affair' ),
		'section'         => 'hero',
		'default'         => '#F8F8F8',
		'priority'        => 10,
		'output'          => apply_filters( 'csco_hero_background_color', array(
			array(
				'element'  => '.section-hero',
				'property' => 'background-color',
			),
		) ),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'hero_background',
					'operator' => '==',
					'value'    => 'color',
				),
				array(
					'setting'  => 'hero_background',
					'operator' => '==',
					'value'    => 'image',
				),
			),
		),
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'select',
	'settings'        => 'hero_background_video_source',
	'label'           => esc_html__( 'Video Source', 'the-affair' ),
	'description'     => esc_html__( 'Please note, that iOS doesn\'t support background videos, therefore make sure that you\'ve uploaded a Background Image as a fallback.', 'the-affair' ),
	'section'         => 'hero',
	'default'         => 'hosted',
	'priority'        => 10,
	'choices'         => array(
		'hosted' => esc_html__( 'YouTube or Vimeo', 'the-affair' ),
		'self'   => esc_html__( 'Self-Hosted', 'the-affair' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'hero_background',
			'operator' => '==',
			'value'    => 'video',
		),
	),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'text',
	'settings'        => 'hero_background_video_hosted',
	'label'           => esc_html__( 'YouTube or Vimeo Video URL', 'the-affair' ),
	'section'         => 'hero',
	'default'         => 'https: //youtu.be/ctvlUvN6wSE',
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'hero_background',
			'operator' => '==',
			'value'    => 'video',
		),
		array(
			'setting'  => 'hero_background_video_source',
			'operator' => '==',
			'value'    => 'hosted',
		),
	),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'upload',
	'settings'        => 'hero_background_video_self',
	'label'           => esc_html__( 'Background Video', 'the-affair' ),
	'description'     => esc_html__( 'The only supported file format is mp4.', 'the-affair' ),
	'section'         => 'hero',
	'mime_type'       => 'video',
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'hero_background',
			'operator' => '==',
			'value'    => 'video',
		),
		array(
			'setting'  => 'hero_background_video_source',
			'operator' => '==',
			'value'    => 'self',
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'image',
		'settings'        => 'hero_background_video_poster',
		'label'           => esc_html__( 'Video Poster', 'the-affair' ),
		'section'         => 'hero',
		'priority'        => 10,
		'choices'         => array(
			'save_as' => 'id',
		),
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_background',
				'operator' => '==',
				'value'    => 'video',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'number',
		'settings'        => 'hero_background_video_start',
		'label'           => esc_html__( 'Video Start Time', 'the-affair' ),
		'section'         => 'hero',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_background',
				'operator' => '==',
				'value'    => 'video',
			),
			array(
				'setting'  => 'hero_background_video_source',
				'operator' => '==',
				'value'    => 'hosted',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'number',
		'settings'        => 'hero_background_video_end',
		'label'           => esc_html__( 'Video End Time', 'the-affair' ),
		'section'         => 'hero',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_background',
				'operator' => '==',
				'value'    => 'video',
			),
			array(
				'setting'  => 'hero_background_video_source',
				'operator' => '==',
				'value'    => 'hosted',
			),
		),
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'select',
	'settings'        => 'hero_content',
	'label'           => esc_html__( 'Content', 'the-affair' ),
	'section'         => 'hero',
	'default'         => 'text',
	'priority'        => 10,
	'choices'         => array(
		'image' => esc_html__( 'Image', 'the-affair' ),
		'text'  => esc_html__( 'Text', 'the-affair' ),
		'none'  => esc_html__( 'None', 'the-affair' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'image',
	'settings'        => 'hero_logo',
	'label'           => esc_html__( 'Logo Image', 'the-affair' ),
	'description'     => esc_html__( 'Logo image will be displayed in its original image dimensions. For support of Retina screens, please upload the 2x version of your logo via Media Library with ', 'the-affair' ) . '<code>@2x</code>' . esc_html__( ' suffix. For example.', 'the-affair' ) . '<code>logo-homepage@2x</code>',
	'section'         => 'hero',
	'default'         => '',
	'priority'        => 10,
	'choices'         => array(
		'save_as' => 'id',
	),
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'hero_content',
			'operator' => '==',
			'value'    => 'image',
		),
	),
));


Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'dimension',
	'settings'        => 'hero_logo_width',
	'label'           => esc_html__( 'Logo Width', 'the-affair' ),
	'section'         => 'hero',
	'default'         => 'auto',
	'output'          => array(
		array(
			'element'  => '.section-hero .logo-image',
			'property' => 'width',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'hero',
			'operator' => '==',
			'value'    => true,
		),
		array(
			'setting'  => 'hero_content',
			'operator' => '==',
			'value'    => 'image',
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'              => 'text',
		'settings'          => 'hero_title',
		'label'             => esc_html__( 'Title', 'the-affair' ),
		'section'           => 'hero',
		'default'           => get_bloginfo( 'name' ),
		'priority'          => 10,
		'sanitize_callback' => 'wp_kses_post',
		'active_callback'   => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_content',
				'operator' => '==',
				'value'    => 'text',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'textarea',
		'settings'        => 'hero_lead',
		'label'           => esc_html__( 'Lead', 'the-affair' ),
		'section'         => 'hero',
		'default'         => get_bloginfo( 'description' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'hero_content',
				'operator' => '==',
				'value'    => 'text',
			),
		),
	)
);

Kirki::add_section(
	'featured_posts', array(
		'title'    => esc_html__( 'Featured Posts', 'the-affair' ),
		'panel'    => 'homepage_settings',
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'featured_posts',
		'label'    => esc_html__( 'Display featured posts', 'the-affair' ),
		'section'  => 'featured_posts',
		'default'  => false,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'radio',
		'settings'        => 'featured_posts_location',
		'label'           => esc_html__( 'Display Location', 'the-affair' ),
		'section'         => 'featured_posts',
		'default'         => 'front_page',
		'priority'        => 10,
		'choices'         => array(
			'front_page' => esc_html__( 'Homepage', 'the-affair' ),
			'home'       => esc_html__( 'Posts page', 'the-affair' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'featured_posts',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'show_on_front',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'number',
	'settings'        => 'featured_posts_number',
	'label'           => esc_html__( 'Number of Slides', 'the-affair' ),
	'section'         => 'featured_posts',
	'default'         => 5,
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'featured_posts',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'select',
	'settings'        => 'featured_posts_columns',
	'label'           => esc_html__( 'Number of Columns', 'the-affair' ),
	'section'         => 'featured_posts',
	'default'         => '3',
	'priority'        => 10,
	'choices'         => array(
		'1' => '1',
		'2' => '2',
		'3' => '3',
	),
	'active_callback' => array(
		array(
			'setting'  => 'featured_posts',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'featured_posts_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'the-affair' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'the-affair' ),
		'section'         => 'featured_posts',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'featured_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'featured_posts_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'the-affair' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'the-affair' ),
		'section'         => 'featured_posts',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'featured_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'featured_posts_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'the-affair' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs. For example: 12, 34, 145. Leave empty for all posts.', 'the-affair' ),
		'section'         => 'featured_posts',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'featured_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

if ( class_exists( 'Post_Views_Counter' ) ) {

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'radio',
			'settings'        => 'featured_posts_orderby',
			'label'           => esc_html__( 'Order posts by', 'the-affair' ),
			'section'         => 'featured_posts',
			'default'         => 'date',
			'priority'        => 10,
			'choices'         => array(
				'date'       => esc_html__( 'Date', 'the-affair' ),
				'post_views' => esc_html__( 'Views', 'the-affair' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'featured_posts',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'text',
			'settings'        => 'featured_posts_time_frame',
			'label'           => esc_html__( 'Filter by Time Frame', 'the-affair' ),
			'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'the-affair' ),
			'section'         => 'featured_posts',
			'default'         => '',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'featured_posts',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'featured_posts_orderby',
					'operator' => '==',
					'value'    => 'post_views',
				),
			),
		)
	);

}

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'checkbox',
		'settings'        => 'featured_posts_exclude',
		'label'           => esc_html__( 'Exclude featured posts from the main archive', 'the-affair' ),
		'section'         => 'featured_posts',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'featured_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
