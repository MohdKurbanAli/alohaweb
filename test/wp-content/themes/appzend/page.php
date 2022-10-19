<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package appzend
 */

global $post;
$page_meta = get_post_meta( $post->ID, 'post_meta', true );
if( isset($page_meta['sidebar_layout']) && $page_meta['sidebar_layout'] ) {
	$post_sidebar = $page_meta['sidebar_layout'];
} else {
	$post_sidebar = get_theme_mod( 'appzend_default_page_sidebar','right' );
}

get_header(); ?>

<div class="container">
	<div class="site-wrapper">	
		<div id="primary" class="content-area <?php echo esc_attr( $post_sidebar ); ?>">
			<main id="main" class="site-main">
				<div class="articlesListing">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
					?>
				</div><!-- Articales Listings -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer();
