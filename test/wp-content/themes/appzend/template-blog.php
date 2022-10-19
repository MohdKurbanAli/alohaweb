<?php
/**
 * The template for displaying  page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Appzend
 *
 * Template Name: Blog Template
 */

$post_sidebar =  get_theme_mod( 'appzend_blog_template_sidebar','right' );
$blog = get_theme_mod('appzend_blogtemplate_postcat');

$blog_cat_id = explode(',', $blog);

$args = array(
    'post_type' => 'post',
    'paged'     => get_query_var( 'paged' ),					            
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $blog_cat_id
        ),
    ),
);

get_header(); ?>

<div class="container"> 
	<div class="site-wrapper"> 
		<div id="primary" class="content-area <?php echo esc_attr( $post_sidebar ); ?>">
			<main id="main" class="site-main">
				<div class="articlesListing blogitemlist">	
					<?php
                        query_posts( $args );

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

		<?php if($post_sidebar != 'no') get_sidebar(); ?>
	</div>
</div>

<?php get_footer();