<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Sparkle Themes
 *
 * @subpackage appzend
 *
 * @since 1.0.0
 *
 */

if ( ! function_exists( 'appzend_post_meta' ) ){
    /**
     * Post Meta Function
     *
     * @since 1.0.0
    */
    function appzend_post_meta() { 
        
        $postdate = get_theme_mod( 'appzend_post_date_options', 'on' );
        $postcomment = get_theme_mod( 'appzend_post_comments_options', 'on' );
        $postauthor = get_theme_mod( 'appzend_post_author_options', 'on' );

      ?>

        <div class="site-entry-meta metainfo">
            <?php
                if( !empty( $postdate ) && $postdate == 'on' ) { appzend_posted_on(); }
                if( !empty( $postauthor ) && $postauthor == 'on' ) { appzend_posted_by(); }
                if( !empty( $postcomment ) && $postcomment == 'on' ) { appzend_comments(); }
            ?>
        </div><!-- .entry-meta -->
       <?php
    }
}
add_action( 'appzend_post_meta', 'appzend_post_meta' , 10 );


if( ! function_exists( 'appzend_post_format_media' ) ) :

    /**
     * Posts format declaration function.
     *
     * @since 1.0.0
     */
    function appzend_post_format_media( $postformat ) {

        if( is_singular( ) ){

          $imagesize = 'post-thumbnail';

        }else{

            $imagesize = '';
        }

        if( $postformat == "gallery" ) {

            $gallery                = get_post_gallery( get_the_ID(), false );
            $gallery_attachment_ids = explode( ',', $gallery['ids'] );
            
            if( is_array( $gallery ) ){ ?>

                <div class="postgallery-carousel cS-hidden">
                    <?php foreach ( $gallery_attachment_ids as $gallery_attachment_id ) { ?>
                        <div class="list">
                            <?php echo wp_get_attachment_image( $gallery_attachment_id, $imagesize ); // WPCS xss ok. ?>
                        </div>
                    <?php } ?>
                </div>

            <?php }else{  ?>

                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

        <?php } }else if( $postformat == "video" ){
            
            $get_content  = apply_filters( 'the_content', get_the_content() );
            $get_video    = get_media_embedded_in_content( $get_content, array( 'video', 'object', 'embed', 'iframe' ) );

            if( !empty( $get_video ) ){ ?>

                <div class="video">
                    <?php echo $get_video[0]; // WPCS xss ok. ?>
                </div>

        <?php }else{ ?>

                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

        <?php  } }else if( $postformat == "audio" ){

            $get_content  = apply_filters( 'the_content', get_the_content() );
            $get_audio    = get_media_embedded_in_content( $get_content, array( 'audio', 'iframe' ) );

            if( !empty( $get_audio ) ){ ?>

                <div class="audio">
                    <?php echo $get_audio[0]; // WPCS xss ok. ?>
                </div>

        <?php }else{  ?>

                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

        <?php } }else if( $postformat == "quote" ) { ?>

                <div class="post-format-media-quote">
                    <blockquote>
                        <?php the_content(); ?>
                    </blockquote>
                </div>

        <?php }else{ ?>

                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

        <?php }

    }

endif;


if ( ! function_exists( 'appzend_footer_copyright' ) ){

    /**
     * Footer Copyright Information
     *
     * @since 1.0.0
     */
    function appzend_footer_copyright() {

        echo esc_html( apply_filters( 'appzend_copyright_text', $content = esc_html__('Copyright  &copy; ','appzend') . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) .' - ' ) );

        printf( ' WordPress Theme : by %1$s', '<a href=" ' . esc_url('#') . ' " rel="designer">'.esc_html__('Sparkle Themes','appzend').'</a>' );
    }
}
add_action( 'appzend_copyright', 'appzend_footer_copyright', 5 );


/**
 * Breadcrumbs Section.
*/
if (! function_exists( 'appzend_breadcrumbs' ) ):

    function appzend_breadcrumbs() {

        ?>

            <section class="breadcrumb">
                <div class="container">
                    <div class="breadcrumb_wrapper">
                        <?php
                            if (is_single() || is_page()) {

                                the_title('<h2 class="entry-title">', '</h2>');

                            } elseif (is_archive()) {

                                the_archive_title('<h2 class="page-title">', '</h2>');

                            } elseif (is_search()) { ?>

                                <h2 class="page-title">
                                    <?php printf(esc_html__('Search Results for:', 'appzend'), '%s', '<span>' . get_search_query() . '</span>'); ?>
                                </h2>

                            <?php } elseif (is_404()) {

                                echo '<h2 class="entry-title">' . esc_html('404 Error', 'appzend') . '</h2>';

                            } elseif (is_home()) {

                            $page_for_posts_id = get_option('page_for_posts');
                            $page_title = get_the_title($page_for_posts_id);

                        ?>
                                <h2 class="entry-title"><?php echo esc_html($page_title); ?></h2>

                        <?php }else{ ?>

                                <h2 class="entry-title"><?php echo esc_html($page_title); ?></h2>

                        <?php } ?>

                            <nav id="breadcrumb" class="cp-breadcrumb">
                                <?php
                                    breadcrumb_trail(array(
                                        'container' => 'div',
                                        'show_browse' => false,
                                    ));
                                ?>
                            </nav>
                    </div>
                </div>
            </section>
        <?php
    }
endif;
add_action('appzend_breadcrumbs', 'appzend_breadcrumbs', 100);




/**
 * page title
 */
if(!function_exists('get_appzend_headline')):
    function get_appzend_headline($section = false){
        if(!$section) return;
        $super_title = get_theme_mod($section.'_super_title');
        $title = get_theme_mod($section.'_title');
        $sub_title = get_theme_mod($section.'_sub_title'); ?>
        

        <div class="headlines">
            <?php if($super_title): ?>
                <h4><?php echo esc_html($super_title); ?></h4>
            <?php endif; ?>
            <?php if($title): ?>
                <h2><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            
            <?php if($sub_title): ?>
                <p><?php echo esc_html($sub_title); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
endif;

/**
 * Dynamic class generate for alignment
 */
if(!function_exists('get_zppzend_alignment_class')){
    function get_zppzend_alignment_class($align){
        if($align){
            $align = json_decode($align);
            if(is_object($align)){
                $css = $align->desktop;
                if($align->tablet) $css .= " tablet-".$align->tablet ;
                if($align->mobile) $css .=  " mobile-".$align->mobile;
                
                return $css;
            }
        }
        return 'text-center';
    }
}

if ( ! function_exists( 'appzend_get_nav_menus' ) ) :

	/**
	 * Get Nav Menus Array
	 *
	 * @since AppZend 1.0.0
	 *
	 * @param null
	 * @return array $nav_menus
	 *
	 */
	function appzend_get_nav_menus( $options = array() ) {
		$appzend_get_nav_menus = array();
		$nav_menus              = wp_get_nav_menus();
		foreach ( $nav_menus as $menu ) {
			$appzend_get_nav_menus[ $menu->term_id ] = ucwords( $menu->name );
		}
		return apply_filters( 'appzend_get_nav_menus', $appzend_get_nav_menus );
	}
endif;

if(! function_exists('appzend_text_alignment_class')){
    function appzend_text_alignment_class(){
        return array(
            'text-left' => __("Left", 'appzend'),
            'text-center' => __("Center", 'appzend'),
            'text-right' => __("Right", 'appzend'),
        );
    }
}
if(!function_exists('appzend_body_class')){
    function appzend_body_class( $classes ) {
        $classes[] = 'site-layout-'.get_theme_mod( 'appzend_site_layout', 'full_width');
        return $classes;
    }
    add_filter( 'body_class', 'appzend_body_class');
}
if( !function_exists('appzend_woocommerce_category')){
	function appzend_woocommerce_category(){
		$taxonomy     = 'product_cat';
		$empty        = 1;
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = 0;
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty
		);
		$woocommerce_categories = array();
		$woocommerce_categories_obj = get_categories( $args );
		foreach( $woocommerce_categories_obj as $category ) {
			$woocommerce_categories[$category->term_id] = $category->name;
		}
		return $woocommerce_categories;
	}
}