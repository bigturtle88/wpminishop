<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<?php get_header(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-4 col-md-4 col-sm-4 col-xs-12' ); ?> >
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>


	<div class="entry-content">
		<a href="<?= home_url( '/bay' ) ?>">
			<button class="btn btn-default"> Заказать</button>
		</a>


	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">

		<?php
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

		?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->
