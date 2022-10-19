<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package appzend
 */

global $post;
$post_meta = array();
if($post) $post_meta = get_post_meta( $post->ID, 'post_meta', true );
if( is_page() ){

	if( isset($post_meta['sidebar_layout']) && $post_meta['sidebar_layout'] ) {
		$post_sidebar = $post_meta['sidebar_layout'];
	} else {
		$post_sidebar = get_theme_mod( 'appzend_default_page_sidebar','right' );
	}

}elseif( is_home() ){

	$post_sidebar = get_theme_mod( 'appzend_index_blog_sidebar','right' );

}elseif( is_category() || is_tag() || is_attachment() || is_author() || is_archive() ){

	$post_sidebar = get_theme_mod( 'appzend_archive_sidebar','right' );

}elseif( is_search() ){

	$post_sidebar = get_theme_mod( 'appzend_search_sidebar','right' );

}
elseif( is_page_template( 'template-blog.php' ) ){

	$post_sidebar = get_theme_mod( 'appzend_blog_template_sidebar','right' );

}elseif( is_single() ){

	if( is_array( $post_meta ) ) {
		$post_sidebar = $post_meta['sidebar_layout'];
	} else {
		$post_sidebar = get_theme_mod( 'appzend_default_page_sidebar','right' );
	}

}else{
	
	$post_sidebar = get_theme_mod( 'appzend_default_page_sidebar','right' );

	if(!$post_sidebar){

		$post_sidebar = 'right';
	}
}

if ( $post_sidebar ==  'no' ) {
	return;
}

if( $post_sidebar == 'right' && is_active_sidebar('sidebar-1')){ ?>
		
		<aside id="secondary" class="widget-area right" role="complementary">

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

		</aside><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'left' && is_active_sidebar('sidebar-2')){ ?>

		<aside id="secondary" class="widget-area left" role="complementary">

			<?php dynamic_sidebar( 'sidebar-2' ); ?>

		</aside><!-- #secondary -->
	<?php
}