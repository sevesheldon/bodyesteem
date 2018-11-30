<?php
/**
 * The template part for displaying siblingcategories.
 *
 * @package The Affair
 */

$queried_object = get_queried_object();

$args = apply_filters( 'csco_siblingcategories_args', array(
	'parent' => $queried_object->parent,
) );

$categories = get_categories( $args );

if ( $categories ) {
?>
<section class="siblingcategories">
	<ul class="cs-nav cs-nav-pills">
	<?php
	foreach ( $categories as $category ) {
		// Translators: category name.
		$title  = sprintf( esc_html__( 'View all posts in %s', 'the-affair' ), $category->name );
		$status = $queried_object->term_id === $category->term_id ? 'active' : null;
		$link   = get_category_link( $category->term_id )
		?>
			<li class="cs-nav-item">
				<a class="cs-nav-link <?php echo esc_attr( $status ); ?>" data-toggle="pill" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $title ); ?>">
					<?php echo esc_html( $category->name ); ?>
				</a>
			</li>
		<?php
	}
	?>
	</ul>
</section>
<?php
}
