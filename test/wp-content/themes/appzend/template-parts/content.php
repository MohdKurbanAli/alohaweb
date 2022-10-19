<?php
/**
 * Template part for displaying posts
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

		the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 

		if( is_single( ) ){
			
			if ( 'post' === get_post_type() ) : ?>

				<div class="site-entry-meta metainfo">
					<?php
						appzend_posted_on();
						appzend_posted_by();
						appzend_comments();
					?>
				</div><!-- .entry-meta -->
				
		<?php endif;  }else{ if ( 'post' === get_post_type() ){ do_action( 'appzend_post_meta', 10 ); } } ?>
		
		<div class="entry-content">
			<?php
				if( is_single( ) ){

					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Read More <span class="screen-reader-text"> "%s"</span>', 'appzend' ),
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
								__( 'Read More <span class="screen-reader-text"> "%s"</span>', 'appzend' ),
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

		<?php if( ! is_single( ) ){ if ( 'excerpt' === $post_content_type ) { ?>
	        <div class="btns">
				<a href="<?php the_permalink(); ?>" class="btn btn-primary">
					<span><?php echo esc_html( get_theme_mod( 'appzend_post_continue_reading_text', 'Read More' ) ); ?></span>
				</a>
			</div>
		<?php } } ?>
	</div>

	<?php if( is_single( ) ){ if (!empty(get_the_tags())){ ?>
		<div class="posts-tag">        
			<?php the_tags( '<ul><li><i class="fa fa-tag"></i></li><li>', '</li><li>', '</li></ul>' ); ?>
		</div>
	<?php } } ?>

</article><!-- #post-<?php the_ID(); ?> -->
