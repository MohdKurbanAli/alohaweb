<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package appzend
 */

$postformat = get_post_format();
$post_description = get_theme_mod( 'appzend_post_description_options', 'excerpt' );
$post_content_type 	= apply_filters( 'appzend_post_content_type', $post_description );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>

	<?php
        appzend_post_format_media( $postformat );
	?>

	<div class="box">

		<?php 

		the_title( '<h3 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 

		if ( 'post' === get_post_type() ) :
			?>
			<div class="site-entry-meta metainfo">
				<?php
					appzend_posted_on();
					appzend_posted_by();
					appzend_comments();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
		
		<div class="entry-content">
			<?php
				if( is_single( ) ){

					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'appzend' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

				}else{

					if ( 'excerpt' === $post_content_type ) {

						the_excerpt();

					} elseif ( 'content' === $post_content_type ) {

						the_content( sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'appzend' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						) );
					}
				}
			?>
		</div>

		<div class="btns text-center">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">
				<span><?php echo esc_html( get_theme_mod( 'appzend_post_continue_reading_text', 'Continue Reading' ) ); ?></span>
			</a>
		</div>
		
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
