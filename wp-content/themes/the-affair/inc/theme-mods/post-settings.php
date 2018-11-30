<?php
/**
 * Post Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'post_settings', array(
		'title'    => esc_html__( 'Post Settings', 'the-affair' ),
		'priority' => 50,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'post_layout',
		'label'    => esc_html__( 'Default Page Layout', 'the-affair' ),
		'section'  => 'post_settings',
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
		'settings' => 'post_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'the-affair' ),
		'section'  => 'post_settings',
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
		'settings' => 'post_meta',
		'label'    => esc_attr__( 'Post Meta', 'the-affair' ),
		'section'  => 'post_settings',
		'default'  => array( 'category', 'author', 'date' ),
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

if ( csco_powerkit_module_enabled( 'opt_in_forms' ) ) {

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'     => 'checkbox',
			'settings' => 'post_subscribe',
			'label'    => esc_html__( 'Display subscribe section', 'the-affair' ),
			'section'  => 'post_settings',
			'default'  => false,
			'priority' => 10,
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'checkbox',
			'settings'        => 'post_subscribe_name',
			'label'           => esc_html__( 'Display first name field', 'the-affair' ),
			'section'         => 'post_settings',
			'default'         => false,
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'post_subscribe',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'text',
			'settings'        => 'post_subscribe_title',
			'label'           => esc_html__( 'Title', 'the-affair' ),
			'section'         => 'post_settings',
			'default'         => esc_html__( 'Sign Up for Our Newsletters', 'the-affair' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'post_subscribe',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'textarea',
			'settings'        => 'post_subscribe_text',
			'label'           => esc_html__( 'Text', 'the-affair' ),
			'section'         => 'post_settings',
			'default'         => esc_html__( 'Get notified of the best deals on our WordPress themes.', 'the-affair' ),
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'post_subscribe',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);
}


Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'post_tags',
		'label'    => esc_html__( 'Display tags', 'the-affair' ),
		'section'  => 'post_settings',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'post_comments_simple',
		'label'    => esc_html__( 'Display comments without the View Comments button', 'the-affair' ),
		'section'  => 'post_settings',
		'default'  => false,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'related',
		'label'    => esc_html__( 'Display related section', 'the-affair' ),
		'section'  => 'post_settings',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field( 'csco_theme_mod', array(
	'type'            => 'text',
	'settings'        => 'post_related_title',
	'label'           => esc_html__( 'Related Section Title', 'the-affair' ),
	'section'         => 'post_settings',
	'default'         => esc_html__( 'You May also Like', 'the-affair' ),
	'priority'        => 10,
	'active_callback' => array(
		array(
			'setting'  => 'related',
			'operator' => '==',
			'value'    => true,
		),
	),
));

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'number',
		'settings'        => 'post_related_number',
		'label'           => esc_html__( 'Maximum Number of Related Posts', 'the-affair' ),
		'section'         => 'post_settings',
		'default'         => 6,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'related',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'        => 'text',
		'settings'    => 'post_related_time_frame',
		'label'       => esc_html__( 'Time Frame', 'expertly' ),
		'description' => esc_html__( 'Add period of posts in English. For example: &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'expertly' ),
		'section'     => 'post_settings',
		'default'     => '',
		'priority'    => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'post_load_nextpost',
		'label'    => esc_html__( 'Enable the Auto Load Next Post feature', 'the-affair' ),
		'section'  => 'post_settings',
		'default'  => false,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_same_category',
		'label'           => esc_html__( 'Auto load posts from the same category only', 'the-affair' ),
		'section'         => 'post_settings',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
