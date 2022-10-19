<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package appzend
 */


get_header(); ?>

<div class="container"> 
	<div class="site-wrapper"> 
		<div id="primary" class="content-area no">
			<main id="main" class="site-main">
				<div class="articlesListing blogitemlist">	
					<section class="error-404 not-found">
				
						<header class="page-header">
							<h1><?php esc_html_e('404','appzend'); ?></h1>
							<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'appzend' ); ?></h2>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'appzend' ); ?></p>							
						</div><!-- .page-content -->

						<div class="backhome">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" type="button">
								<span><?php esc_html_e('Back To Home','appzend'); ?></span>
							</a>
						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</div><!-- Articales Listings -->

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div>

<?php get_footer();