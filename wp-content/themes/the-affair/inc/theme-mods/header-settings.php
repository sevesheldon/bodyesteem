<?php
/**
 * Header Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'header', array(
		'title'    => esc_html__( 'Header Settings', 'the-affair' ),
		'priority' => 40,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'        => 'checkbox',
		'settings'    => 'navbar_sticky',
		'label'       => esc_html__( 'Make navigation bar sticky', 'the-affair' ),
		'description' => esc_html__( 'Enabling this option will make navigation bar visible when scrolling.', 'the-affair' ),
		'section'     => 'header',
		'default'     => true,
		'priority'    => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'            => 'checkbox',
		'settings'        => 'effects_navbar_scroll',
		'label'           => esc_html__( 'Enable the smart sticky feature', 'the-affair' ),
		'description'     => esc_html__( 'Enabling this option will reveal navigation bar when scrolling up and hide it when scrolling down.', 'the-affair' ),
		'section'         => 'header',
		'default'         => true,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'navbar_sticky',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'select',
		'settings' => 'header_alignment',
		'label'    => esc_html__( 'Content Position', 'the-affair' ),
		'section'  => 'header',
		'default'  => 'right',
		'priority' => 10,
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'the-affair' ),
			'center' => esc_html__( 'Center', 'the-affair' ),
			'right'  => esc_html__( 'Right', 'the-affair' ),
		),
	)
);

if ( csco_powerkit_module_enabled( 'social_links' ) ) {
	Kirki::add_field(
		'csco_theme_mod', array(
			'type'     => 'checkbox',
			'settings' => 'header_social_links',
			'label'    => esc_html__( 'Display social links', 'the-affair' ),
			'section'  => 'header',
			'default'  => false,
			'priority' => 10,
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'select',
			'settings'        => 'header_social_links_scheme',
			'label'           => esc_html__( 'Color scheme', 'the-affair' ),
			'section'         => 'header',
			'default'         => 'light',
			'priority'        => 10,
			'choices'         => array(
				'light'         => esc_html__( 'Light', 'the-affair' ),
				'bold'          => esc_html__( 'Bold', 'the-affair' ),
				'light-rounded' => esc_html__( 'Light Rounded', 'the-affair' ),
				'bold-rounded'  => esc_html__( 'Bold Rounded', 'the-affair' ),
			),
			'active_callback' => array(
				array(
					'setting'  => 'header_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'number',
			'settings'        => 'header_social_links_maximum',
			'label'           => esc_html__( 'Maximum Number of Social Links', 'the-affair' ),
			'section'         => 'header',
			'default'         => 3,
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'header_social_links',
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
		'settings' => 'header_search_button',
		'label'    => esc_html__( 'Display search button', 'the-affair' ),
		'section'  => 'header',
		'default'  => true,
		'priority' => 10,
	)
);
