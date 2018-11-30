<?php
/**
 * The template part for displaying post author section.
 *
 * @package The Affair
 */

$authors = array();

if ( csco_coauthors_enabled() ) {
	$authors = get_coauthors();
}

?>

<?php do_action( 'csco_author_before' ); ?>

<section class="post-author">

	<?php
	if ( $authors ) {
		foreach ( $authors as $author ) {
			csco_post_author( $author->ID );
		}
	} else {
		// Get the default WP author details.
		csco_post_author();
	}
	?>

</section>

<?php do_action( 'csco_author_after' ); ?>
