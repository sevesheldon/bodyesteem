<?php
/**
 * The template for displaying comments
 *
 * @package The Affair
 */

?>

<?php do_action( 'csco_comments_before' ); ?>

<section id="comments" class="post-comments <?php echo get_theme_mod( 'post_comments_simple', false ) ? 'post-comments-simple' : ''; ?> ">

	<div class="comments-container">

		<?php if ( have_comments() ) { ?>

			<?php $tag = apply_filters( 'csco_section_title_tag', 'h3' ); ?>
			<<?php echo esc_html( $tag ); ?> class="title-block">
				<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					esc_html_e( 'One comment', 'the-affair' );
				} else {
					/* translators: 1: number of comments */
					printf( esc_html( _n( '%s comment', '%s comments', $comments_number, 'the-affair' ) ), intval( number_format_i18n( $comments_number ) ) );
				}
				?>
			</<?php echo esc_html( $tag ); ?>>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 60,
					)
				);
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation(); ?>

		<?php } // End if(). ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'the-affair' ); ?></p>
		<?php } ?>

		<?php
		$tag = apply_filters( 'csco_section_title_tag', 'h5' );
		comment_form(
			array(
				'title_reply_before' => '<' . $tag . ' id="reply-title" class="title-block title-comment-reply">',
				'title_reply_after'  => '</' . $tag . '>',
				'class_form'         => 'comment-form cs-input-easy-group',
			)
		);
		?>
	</div>

</section><!-- .comments-area -->

<?php if ( ! get_theme_mod( 'post_comments_simple', false ) ) : ?>
	<section class="post-comments-show">
		<button><?php esc_html_e( 'View Comments', 'the-affair' ); ?> (<?php echo intval( get_comments_number() ); ?>)</button>
	</section>
<?php endif; ?>

<?php do_action( 'csco_comments_after' ); ?>
