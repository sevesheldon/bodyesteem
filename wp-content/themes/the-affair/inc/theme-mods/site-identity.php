<?php
/**
 * Site Identity
 *
 * @package The Affair
 */

Kirki::add_field(
	'csco_theme_mod', array(
		'type'        => 'image',
		'settings'    => 'logo',
		'label'       => esc_html__( 'Logo', 'the-affair' ),
		'description' => esc_html__( 'The main logo of your website. Logo image will be displayed in its original image dimensions. For support of Retina screens, please upload the 2x version of your logo via Media Library with ', 'the-affair' ) . '<code>@2x</code>' . esc_html__( ' suffix. For example.', 'the-affair' ) . '<code>logo@2x.png</code>',
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 0,
		'choices'     => array(
			'save_as' => 'id',
		),
	)
);
