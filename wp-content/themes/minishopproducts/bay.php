<?php
/**
 * Template Name: bay
 *
 * @package WordPress
 *
 */
?>

<?php

get_header();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-4 col-md-4 col-sm-4 col-xs-12' ); ?> >
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured' ); ?></span>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>
		<!-- .entry-header -->


		<div class="entry-content">
			<?php echo do_shortcode( "[page_bay]" ); ?>
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
<?php

get_footer();
?>