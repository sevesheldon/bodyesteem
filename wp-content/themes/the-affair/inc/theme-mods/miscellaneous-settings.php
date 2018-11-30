<?php
/**
 * Miscellaneous Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'miscellaneous', array(
		'title'    => esc_html__( 'Miscellaneous Settings', 'the-affair' ),
		'priority' => 60,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'text',
		'settings' => 'search_placeholder',
		'label'    => esc_html__( 'Search Form Placeholder', 'the-affair' ),
		'section'  => 'miscellaneous',
		'default'  => esc_html__( 'Search The Affair', 'the-affair' ),
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'sticky_sidebar',
		'label'    => esc_html__( 'Sticky Sidebar', 'the-affair' ),
		'section'  => 'miscellaneous',
		'default'  => true,
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'radio',
		'settings'        => 'sticky_sidebar_method',
		'label'           => esc_html__( 'Sticky Method', 'the-affair' ),
		'section'         => 'miscellaneous',
		'default'         => 'stick-to-bottom',
		'priority'        => 10,
		'choices'         => array(
			'stick-to-top'    => esc_html__( 'Sidebar top edge', 'the-affair' ),
			'stick-to-bottom' => esc_html__( 'Sidebar bottom edge', 'the-affair' ),
			'stick-last'      => esc_html__( 'Last widget top edge', 'the-affair' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'sticky_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'checkbox',
		'settings' => 'effects_parallax',
		'label'    => esc_html__( 'Enable Parallax', 'the-affair' ),
		'section'  => 'miscellaneous',
		'default'  => true,
		'priority' => 10,
	)
);
