<?php
/**
 * The public-facing functionality of the module.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Powerkit
 * @subpackage Modules/public
 */

/**
 * The public-facing functionality of the module.
 */
class Powerkit_Typekit_Fonts_Public extends Powerkit_Module_Public {

	/**
	 * Initialize
	 */
	public function initialize() {
		add_filter( 'language_attributes', array( $this, 'html_attributes' ), 10, 2 );
		add_filter( 'powerkit_fonts_list', array( $this, 'typekit_fonts' ), 20 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'init', array( $this, 'kirki_support' ) );
	}

	/**
	 * Add typekit fonts
	 *
	 * @since 1.0.0
	 * @param array $fonts List fonts.
	 */
	public function typekit_fonts( $fonts ) {

		if ( is_customize_preview() ) {

			$token = get_option( 'powerkit_typekit_fonts_token' );
			$kit   = get_option( 'powerkit_typekit_fonts_kit' );

			if ( $token && $kit ) {

				$data = wp_cache_get( 'powerkit_typekit_fonts_kit_cache' );

				if ( ! $data ) {
					$typekit = new Powerkit_Typekit_Api();

					$data = $typekit->get( $kit, $token );

					wp_cache_set( 'powerkit_typekit_fonts_kit_cache', $data );
				}

				if ( $data && isset( $data['kit']['families'] ) && $data['kit']['families'] ) {

					$fonts['families']['typekit'] = array(
						'text'     => esc_html__( 'Typekit', 'powerkit' ),
						'children' => array(),
					);

					foreach ( $data['kit']['families'] as $item ) {
						$id = $item['slug'];

						$fonts['families']['typekit']['children'][] = array(
							'id'   => $item['slug'],
							'text' => $item['name'],
						);

						$fonts['variants'][ $id ] = powerkit_typekit_font_variations_format( $item['variations'] );
					}
				}
			}
		}

		return $fonts;
	}

	/**
	 * Filters the language attributes for display in the html tag.
	 *
	 * @param string $output A space-separated list of language attributes.
	 * @param string $doctype The type of html document (xhtml|html).
	 */
	public function html_attributes( $output, $doctype ) {
		$token = get_option( 'powerkit_typekit_fonts_token' );
		$kit   = get_option( 'powerkit_typekit_fonts_kit' );

		if ( $token && $kit && ! is_admin() ) {
			$output .= ' class="wf-loading"';
		}

		return $output;
	}

	/**
	 * Add support Kirki.
	 */
	public function kirki_support() {
		if ( class_exists( 'Kirki' ) ) {
			$configs = (array) Kirki::$config;

			foreach ( $configs as $config_id => $args ) {
				add_filter( "kirki_{$config_id}_dynamic_css", array( $this, 'kirki_dynamic_css' ) );
			}
		}
	}

	/**
	 * Change font-family stack.
	 *
	 * @param string $style The dynamic css.
	 */
	public function kirki_dynamic_css( $style ) {
		$token = get_option( 'powerkit_typekit_fonts_token' );
		$kit   = get_option( 'powerkit_typekit_fonts_kit' );

		if ( $token && $kit ) {
			$typekit = new Powerkit_Typekit_Api();

			$typekit_data = $typekit->get( $kit, $token );
			if ( isset( $typekit_data['kit']['families'] ) && $typekit_data['kit']['families'] ) {
				foreach ( $typekit_data['kit']['families'] as $family ) {
					$slug  = sprintf( 'font-family:%s', $family['slug'] );
					$stack = sprintf( 'font-family:%s', $family['css_stack'] );
					// Replace font slug to css stack.
					$style = str_replace( $slug, $stack, $style );
				}
			}
		}

		return $style;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function wp_enqueue_scripts() {
		$token = get_option( 'powerkit_typekit_fonts_token' );
		$kit   = get_option( 'powerkit_typekit_fonts_kit' );

		if ( $token && $kit ) {
			wp_enqueue_script( 'powerkit-typekit', plugin_dir_url( __FILE__ ) . 'js/public-powerkit-typekit.js', array( 'jquery' ), powerkit_get_setting( 'version' ), true );

			wp_localize_script( 'powerkit-typekit', 'powerkit_typekit', array(
				'kit' => $kit,
			) );
		}
	}
}
