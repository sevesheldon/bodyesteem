<?php
/**
 * Colors
 *
 * @package The Affair
 */

Kirki::add_section(
	'colors', array(
		'title'    => esc_html__( 'Colors', 'the-affair' ),
		'priority' => 20,
	)
);

/**
 * -------------------------------------------------------------------------
 * Base
 * -------------------------------------------------------------------------
 */

Kirki::add_section(
	'colors_base', array(
		'title'    => esc_html__( 'Base', 'the-affair' ),
		'panel'    => 'colors',
		'priority' => 10,
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_primary',
		'label'     => esc_html__( 'Primary Color', 'the-affair' ),
		'section'   => 'colors',
		'priority'  => 10,
		'default'   => '#000000',
		'transport' => 'auto',
		'output'    => apply_filters( 'csco_color_primary', array(
			array(
				'element'  => 'a:hover, .content a, .entry-content a, .meta-category a, blockquote: before',
				'property' => 'color',
			),
			array(
				'element'  => 'button, .button, input[type = "button"], input[type = "reset"], input[type = "submit"], .toggle-search.toggle-close, .cs-overlay-entry .post-categories a:hover, .cs-list-articles > li > a:hover:before, .cs-widget-posts .post-number, .pk-badge-primary, .pk-bg-primary, .pk-button-primary, .pk-button-primary:hover, h2.pk-heading-numbered:before',
				'property' => 'background-color',
			),
		) ),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_overlay',
		'label'     => esc_html__( 'Overlay Color', 'the-affair' ),
		'section'   => 'colors',
		'priority'  => 10,
		'default'   => 'rgba( 0, 0, 0, 0.4 )',
		'transport' => 'auto',
		'choices'     => array(
			'alpha' => true,
		),
		'output'    => apply_filters( 'csco_color_overlay', array(
			array(
				'element'  => '.cs-overlay .cs-overlay-background:after, .pk-bg-overlay, .pk-widget-author-with-bg .pk-widget-author-container',
				'property' => 'background-color',
			),
		) ),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'color',
		'settings' => 'color_navbar_bg',
		'label'    => esc_html__( 'Navigation Bar Background', 'the-affair' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'priority' => 10,
		'output'   => array(
			array(
				'element'  => '.navbar-primary, .offcanvas-header',
				'property' => 'background-color',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'     => 'color',
		'settings' => 'color_navbar_submenu',
		'label'    => esc_html__( 'Navigation Submenu Background', 'the-affair' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'priority' => 10,
		'output'   => array(
			array(
				'element'  => '.navbar-nav .sub-menu, .navbar-nav .cs-mega-menu-has-categories .cs-mm-categories',
				'property' => 'background-color',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_cover_bg_brand',
		'label'     => esc_html__( 'Brand Cover Background Color', 'the-affair' ),
		'section'   => 'colors',
		'default'   => '#C3C9C8',
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '.cover-brand',
				'property' => 'background-color',
				'suffix'   => ' !important',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_cover_bg_primary',
		'label'     => esc_html__( 'Primary Cover Background Color', 'the-affair' ),
		'section'   => 'colors',
		'default'   => '#B7B9BC',
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '.cover-primary',
				'property' => 'background-color',
				'suffix'   => ' !important',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_cover_bg_secondary',
		'label'     => esc_html__( 'Secondary Cover Background Color', 'the-affair' ),
		'section'   => 'colors',
		'default'   => '#D1D0CA',
		'priority'  => 10,
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '.cover-secondary',
				'property' => 'background-color',
				'suffix'   => ' !important',
			),
		),
	)
);

Kirki::add_field(
	'csco_theme_mod', array(
		'type'      => 'color',
		'settings'  => 'color_footer_bg',
		'label'     => esc_html__( 'Footer Background', 'the-affair' ),
		'section'   => 'colors',
		'default'   => '#000000',
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-footer',
				'property' => 'background-color',
			),
		),
	)
);
