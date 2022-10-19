<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package appzend
 */

$post_sidebar =  get_theme_mod( 'appzend_archive_sidebar','right' );

get_header(); 

?>

<div class="container"> 
	<div class="site-wrapper"> 
		<div id="primary" class="content-area <?php echo esc_attr( $post_sidebar ); ?>">
			<main id="main" class="site-main">
				<div class="articlesListing blogitemlist">	
					<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/

								get_template_part( 'template-parts/content', get_post_format() );
								
							endwhile;

							the_posts_pagination( 
								array(
									'prev_text' => esc_html__( 'Prev', 'appzend' ),
									'next_text' => esc_html__( 'Next', 'appzend' ),
								)
							);

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
					?>
				</div><!-- Articales Listings -->

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer();