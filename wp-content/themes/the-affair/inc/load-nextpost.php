<?php
/**
 * Load Load Next Post via AJAX.
 *
 * @package The Affair
 */

/**
 * Retrieve next post that is adjacent to current post.
 *
 * @param string $layout  The name of layout.
 * @param string $sidebar The name of sidebar.
 */
function csco_nextpost_get_id( $layout, $sidebar ) {
	global $post;

	$next_post = false;

	if ( null === $sidebar ) {
		return;
	}

	$in_same_term = get_theme_mod( 'post_load_nextpost_same_category', false );

	$object_next_post = get_next_post( $in_same_term );

	if ( isset( $object_next_post->ID ) ) {

		$post = get_post( $object_next_post->ID );

		setup_postdata( $post );

		$next_post_layout  = csco_get_page_layout();
		$next_post_sidebar = csco_get_page_sidebar();

		if ( $layout === $next_post_layout && $sidebar === $next_post_sidebar ) {
			$next_post = $object_next_post->ID;
		} else {
			$next_post = csco_nextpost_get_id( $layout, $sidebar );
		}
	}

	wp_reset_postdata();

	return $next_post;
}

/**
 * Localize the main theme scripts.
 */
function csco_nextpost_more_js() {
	if ( ! csco_get_state_load_nextpost() ) {
		return;
	}

	if ( ! is_singular( 'post' ) ) {
		return false;
	}

	$ajax_type = version_compare( get_bloginfo( 'version' ), '4.7', '>=' ) ? 'ajax_restapi' : 'ajax';
	$ajax_type = apply_filters( 'ajax_load_nextpost_method', $ajax_type );

	$layout  = csco_get_page_layout();
	$sidebar = csco_get_page_sidebar();

	$args = array(
		'type'         => $ajax_type,
		'layout'       => $layout,
		'sidebar'      => $sidebar,
		'not_in'       => (array) get_the_ID(),
		'next_post'    => csco_nextpost_get_id( $layout, $sidebar ),
		'current_user' => get_current_user_id(),
		'nonce'        => wp_create_nonce( 'csco-load-nextpost-nonce' ),
		'rest_url'     => esc_url( get_rest_url( null, '/csco/v1/more-nextpost' ) ),
		'url'          => admin_url( 'admin-ajax.php' ),
	);

	wp_localize_script( 'csco-scripts', 'csco_ajax_nextpost', $args );
}

add_action( 'wp_enqueue_scripts', 'csco_nextpost_more_js' );

/**
 * Get More Post
 */
function csco_load_nextpost() {
	global $csco_related_not_in;
	global $wp_query;
	global $post;
	global $more;

	// Check Nonce.
	wp_verify_nonce( null );

	$not_in    = array();
	$next_post = null;
	$layout    = null;
	$sidebar   = null;

	if ( isset( $_POST['not_in'] ) ) { // Input var ok.
		$not_in = (array) array_map( 'sanitize_key', wp_unslash( $_POST['not_in'] ) );  // Input var ok.
	}

	if ( isset( $_POST['layout'] ) ) { // Input var ok.
		$layout = sanitize_text_field( wp_unslash( $_POST['layout'] ) ); // Input var ok.
	}

	if ( isset( $_POST['sidebar'] ) ) { // Input var ok.
		$sidebar = sanitize_text_field( wp_unslash( $_POST['sidebar'] ) ); // Input var ok.
	}

	if ( isset( $_POST['next_post'] ) ) { // Input var ok.
		$post_id = (int) $_POST['next_post'];  // Input var ok.
	}

	if ( isset( $_POST['current_user'] ) ) { // Input var ok.
		wp_set_current_user( (int) $_POST['current_user'] ); // Input var ok.
	}

	// Get Post.
	ob_start();

	if ( isset( $post_id ) ) {

		// Add post id for filter.
		array_push( $not_in, (string) $post_id );

		// Set global filter.
		$csco_related_not_in = $not_in;

		// Query Args.
		$args = array(
			'p' => $post_id,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) :

			while ( $query->have_posts() ) :
				$query->the_post();

				// Set wp_query data.
				$wp_query              = $query;
				$wp_query->is_single   = true;
				$wp_query->is_singular = true;

				// Set global more.
				$more = 1;
				?>
				<div class="cs-nextpost-section" data-title="<?php echo esc_attr( get_the_title() ); ?>"
					data-url="<?php echo esc_url( get_permalink() ); ?>">

					<?php do_action( 'csco_load_nextpost_before' ); ?>

					<div class="cs-read-next">
						<?php esc_html_e( 'Read Next', 'the-affair' ); ?>
						<i class="cs-icon cs-icon-arrow-down"></i>
					</div>

					<?php
					// Include singular template.
					do_action( 'csco_post_wrap_start' );
					?>

						<div class="post-container">

							<?php do_action( 'csco_post_before' ); ?>

								<article id="post-<?php the_ID(); ?>">

									<?php get_template_part( 'template-parts/content-cover' ); ?>

									<?php do_action( 'csco_post_content_before' ); ?>

										<div class="entry-content">

											<?php do_action( 'csco_post_entry_content_start' ); ?>

											<div class="content">
												<?php do_action( 'csco_post_content_start' ); ?>

												<?php the_content(); ?>

												<?php do_action( 'csco_post_content_end' ); ?>
											</div>

											<?php do_action( 'csco_post_entry_content_end' ); ?>

										</div>

									<?php do_action( 'csco_post_content_after' ); ?>

								</article>

							<?php do_action( 'csco_post_after' ); ?>

						</div>
					<?php
					do_action( 'csco_post_wrap_end' );

					// Set next post.
					$next_post = csco_nextpost_get_id( $layout, $sidebar );
					?>

					<?php do_action( 'csco_load_nextpost_after' ); ?>
				</div>
				<?php

			endwhile;

		endif;

		wp_reset_postdata();
	}

	$content = ob_get_clean();

	if ( ! $content ) {
		$next_post = null;
	}

	// Return Result.
	$result = array(
		'not_in'    => $not_in,
		'next_post' => $next_post,
		'content'   => $content,
	);

	return $result;
}

/**
 * AJAX Load Nextpost
 */
function csco_ajax_load_nextpost() {

	// Check Nonce.
	check_ajax_referer( 'csco-load-nextpost-nonce', 'nonce' );

	// Get Post.
	$data = csco_load_nextpost();

	// Return Result.
	wp_send_json_success( $data );

}

add_action( 'wp_ajax_csco_ajax_load_nextpost', 'csco_ajax_load_nextpost' );
add_action( 'wp_ajax_nopriv_csco_ajax_load_nextpost', 'csco_ajax_load_nextpost' );


/**
 * Nextpost API Response
 *
 * @param array $request REST API Request.
 */
function csco_load_nextpost_restapi( $request ) {

	// Get Data.
	$data = array(
		'success' => true,
		'data'    => csco_load_nextpost(),
	);

	// Return Result.
	return rest_ensure_response( $data );
}

/**
 * Register REST Nextpost Routes
 */
function csco_register_nextpost_route() {

	register_rest_route(
		'csco/v1', '/more-nextpost', array(
			'methods'  => WP_REST_Server::CREATABLE,
			'callback' => 'csco_load_nextpost_restapi',
		)
	);
}
add_action( 'rest_api_init', 'csco_register_nextpost_route' );

/**
 * Filter all auto load posts from related.
 *
 * @param object $data The query.
 */
function csco_nextpost_filter_related( $data ) {
	global $csco_related_not_in;

	if ( ! is_single() ) {
		return $data;
	}

	if ( isset( $data->query_vars['query_type'] ) && 'related' === $data->query_vars['query_type'] ) {
		// Exclude next post.
		if ( csco_get_state_load_nextpost() ) {
			$next_post = csco_nextpost_get_id( csco_get_page_layout(), csco_get_page_sidebar() );

			$data->query_vars['post__not_in'][] = $next_post ? $next_post : false;
		}

		// Exclude loaded posts.
		$data->query_vars['post__not_in'] = array_merge(
			(array) $data->query_vars['post__not_in'],
			(array) $csco_related_not_in
		);
	}

	return $data;
}
add_action( 'pre_get_posts', 'csco_nextpost_filter_related' );
