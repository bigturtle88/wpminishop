<?php
/**
 * Template Name: result
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



	<?php echo do_shortcode( "[page_result]" ); ?>

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links "><span class="page-links-title ">' . __( 'Pages:' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
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
