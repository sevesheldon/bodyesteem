<?php
/**
 * Footer Settings
 *
 * @package The Affair
 */

Kirki::add_section(
	'footer', array(
		'title'    => esc_html__( 'Footer Settings', 'the-affair' ),
		'priority' => 40,
	)
);


if ( csco_powerkit_module_enabled( 'instagram_integration' ) ) {
	Kirki::add_field(
		'csco_theme_mod', array(
			'type'     => 'checkbox',
			'settings' => 'footer_instagram_recent',
			'label'    => esc_html__( 'Display Recent Instagram Photos', 'the-affair' ),
			'section'  => 'footer',
			'default'  => false,
			'priority' => 10,
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'text',
			'settings'        => 'footer_instagram_user_id',
			'label'           => esc_attr__( 'User ID', 'the-affair' ),
			'section'         => 'footer',
			'default'         => '',
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'footer_instagram_recent',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);
}

Kirki::add_field(
	'csco_theme_mod', array(
		'type'              => 'text',
		'settings'          => 'footer_title',
		'label'             => esc_attr__( 'Title', 'the-affair' ),
		'section'           => 'footer',
		'default'           => get_bloginfo( 'desription' ),
		'priority'          => 10,
		'sanitize_callback' => 'wp_kses_post',
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'              => 'textarea',
		'settings'          => 'footer_copyright',
		'label'             => esc_attr__( 'Copyright', 'the-affair' ),
		'section'           => 'footer',
		/* translators: %s: Author name. */
		'default'           => sprintf( esc_html__( 'Designed & Developed by %s', 'the-affair' ), '<a href="https://codesupply.co/">Code Supply Co.</a>' ),
		'priority'          => 10,
		'sanitize_callback' => 'wp_kses_post',
	)
);

if ( csco_powerkit_module_enabled( 'social_links' ) ) {
	Kirki::add_field(
		'csco_theme_mod', array(
			'type'     => 'checkbox',
			'settings' => 'footer_social_links',
			'label'    => esc_html__( 'Display social links', 'the-affair' ),
			'section'  => 'footer',
			'default'  => false,
			'priority' => 10,
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'select',
			'settings'        => 'footer_social_links_scheme',
			'label'           => esc_html__( 'Color scheme', 'the-affair' ),
			'section'         => 'footer',
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
					'setting'  => 'footer_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);

	Kirki::add_field(
		'csco_theme_mod', array(
			'type'            => 'number',
			'settings'        => 'footer_social_links_maximum',
			'label'           => esc_html__( 'Maximum Number of Social Links', 'the-affair' ),
			'section'         => 'footer',
			'default'         => 5,
			'priority'        => 10,
			'active_callback' => array(
				array(
					'setting'  => 'footer_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
		)
	);
}
