<?php
/**
 * Template part for displaying creative posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Monstroid2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item creative-item' ); ?>>

	<div class="creative-item__content">

		<header class="entry-header">
			<h2 class="entry-title"><?php 
				monstroid2_sticky_label();
				the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
			?></h2>
		</header><!-- .entry-header -->

		<?php monstroid2_post_excerpt(); ?>

	</div>

	<footer class="entry-footer">
		<div class="entry-meta">
			<div>
				<?php
					monstroid2_posted_by();
					monstroid2_posted_in( array(
						'prefix'    => __( 'In', 'monstroid2' ),
					) );
					monstroid2_posted_on( array(
						'prefix' => __( 'Posted', 'monstroid2' )
					) );
					monstroid2_post_tags( array(
						'prefix' => __( 'Tags:', 'monstroid2' )
					) );
					monstroid2_post_comments( array(
						'postfix' => __( 'Comment(s)', 'monstroid2' )
					) );
				?>
			</div>
			<?php
				monstroid2_post_link();
			?>
		</div>
		<?php monstroid2_edit_link(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
