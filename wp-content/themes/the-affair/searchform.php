<?php
/**
 * The template for displaying search form.
 *
 * @package The Affair
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only"><?php esc_html_e( 'Search for:', 'the-affair' ); ?></label>
	<div class="cs-input-group">
		<input type="search" value="<?php the_search_query(); ?>" name="s" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod( 'search_placeholder', __( 'Search The Affair', 'the-affair' ) ) ); ?>" required>
		<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'the-affair' ); ?></button>
	</div>
</form>
