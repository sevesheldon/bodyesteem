<?php
/**
 * Category Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'category_settings', array(
		'title'    => esc_html__( 'Category Settings', 'the-affair' ),
		'priority' => 50,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'category_trending_posts',
		'label'    => esc_html__( 'Display featured posts', 'the-affair' ),
		'section'  => 'category_settings',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'text',
	'settings'        => 'category_trending_posts_title',
	'label'           => esc_html__( 'Section Title', 'the-affair' ),
	'section'         => 'category_settings',
	'default'         => esc_html__( 'Trending Posts', 'the-affair' ),
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'category_trending_posts',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'number',
	'settings'        => 'category_trending_posts_number',
	'label'           => esc_html__( 'Maximum Number', 'the-affair' ),
	'section'         => 'category_settings',
	'default'         => 5,
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'category_trending_posts',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'category_trending_posts_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'the-affair' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'the-affair' ),
		'section'         => 'category_settings',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'category_trending_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'text',
		'settings'        => 'category_trending_posts_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'the-affair' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs. For example: 12, 34, 145. Leave empty for all posts.', 'the-affair' ),
		'section'         => 'category_settings',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'category_trending_posts',
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
			'settings'        => 'category_trending_posts_orderby',
			'label'           => esc_html__( 'Order posts by', 'the-affair' ),
			'section'         => 'category_settings',
			'default'         => 'date',
			'priority'        => 10,
			'choices'         => array(
				'date'       => esc_html__( 'Date', 'the-affair' ),
				'post_views' => esc_html__( 'Views', 'the-affair' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'category_trending_posts',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'text',
			'settings'        => 'category_trending_posts_time_frame',
			'label'           => esc_html__( 'Filter by Time Frame', 'the-affair' ),
			'description'     => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'the-affair' ),
			'section'         => 'category_settings',
			'default'         => '',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'category_trending_posts',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'category_trending_posts_orderby',
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
		'settings'        => 'category_trending_posts_exclude',
		'label'           => esc_html__( 'Exclude featured posts from the category archive', 'the-affair' ),
		'section'         => 'category_settings',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'category_trending_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'category_siblingcategories',
		'label'    => esc_html__( 'Display sibling categories', 'the-affair' ),
		'section'  => 'category_settings',
		'default'  => true,
		'priority' => 10,
	)
);
