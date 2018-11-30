<?php
/**
 * Archive Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'archive_settings', array(
		'title'    => esc_html__( 'Archive Settings', 'the-affair' ),
		'priority' => 50,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'archive_page_layout',
		'label'    => esc_html__( 'Page Layout', 'the-affair' ),
		'section'  => 'archive_settings',
		'default'  => 'fullwidth',
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
		'settings' => 'archive_layout',
		'label'    => esc_html__( 'Archive Layout', 'the-affair' ),
		'section'  => 'archive_settings',
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
		'settings' => 'archive_sidebar',
		'label'    => esc_html__( 'Sidebar', 'the-affair' ),
		'section'  => 'archive_settings',
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
		'settings' => 'archive_post_meta',
		'label'    => esc_attr__( 'Post Meta', 'the-affair' ),
		'section'  => 'archive_settings',
		'default'  => array( 'category', 'author', 'date', 'shares' ),
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
		'settings' => 'archive_more_button',
		'label'    => esc_html__( 'Display View Post button', 'the-affair' ),
		'section'  => 'archive_settings',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'radio',
		'settings' => 'archive_pagination_type',
		'label'    => esc_html__( 'Pagination', 'the-affair' ),
		'section'  => 'archive_settings',
		'default'  => 'standard',
		'priority' => 10,
		'choices'  => array(
			'standard'  => esc_html__( 'Standard', 'the-affair' ),
			'load-more' => esc_html__( 'Load More Button', 'the-affair' ),
			'infinite'  => esc_html__( 'Infinite Load', 'the-affair' ),
		),
	)
);
