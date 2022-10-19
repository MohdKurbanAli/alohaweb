<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package appzend
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function appzend_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'appzend_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function appzend_woocommerce_scripts() {
	wp_enqueue_style( 'appzend-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'appzend-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'appzend_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );
/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function appzend_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'appzend_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function appzend_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'appzend_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'appzend_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function appzend_woocommerce_wrapper_before() {
		?>
		<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="articlesListing">	
					<div class="article">
						<div class="box">
							

				
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'appzend_woocommerce_wrapper_before' );

if ( ! function_exists( 'appzend_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function appzend_woocommerce_wrapper_after() {
		?>

						</div> <!-- box-->
					</div><!-- article-->
				</div><!-- articlelisting -->
			</main><!-- #main -->
		</div><!-- primary --> 
		<?php get_sidebar(); ?>
		</div> <!-- container -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'appzend_woocommerce_wrapper_after' );
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'appzend_woocommerce_header_cart' ) ) {
			appzend_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'appzend_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function appzend_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		appzend_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'appzend_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'appzend_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function appzend_woocommerce_cart_link() {
		$icon         = get_theme_mod('appzend-cart-icon', 'fas fa-cart-arrow-down');
		?>
		<div class="shopcart-dropdown block-cart-link spel-cart">
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr_e( 'View your shopping cart', 'appzend' ); ?>">
			<div class="site-cart-items-wrap">
				<div class="cart-icon <?php echo esc_attr($icon); ?>">
					<span class="count"><?php echo intval( WC()->cart->cart_contents_count ); ?></span>
				</div>
			</div>
		</a>
		<?php
	}
}

if ( ! function_exists( 'appzend_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function appzend_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php appzend_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}

	add_action('appzend_woocommerce_header_cart', 'appzend_woocommerce_header_cart');
}

/**
 * Sparkle Tabs Category Products Ajax Function
*/
if (!function_exists('appzend_tabs_ajax_action')) {

    function appzend_tabs_ajax_action() {

        $cat_slug       = $_POST['category_slug'];
        $product_number = $_POST['product_num'];
        $layout         = $_POST['layout']; //'grid';
        $column_number  = $_POST['column']; //3;

        ob_start(); ?>
        <?php
            $product_args = array(
                'post_type' => 'product',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $cat_slug
                    )),
                'posts_per_page' => $product_number
            );

            $query = new WP_Query($product_args);

            if ($query->have_posts()) {
                while ($query->have_posts()) { $query->the_post();
                    wc_get_template_part('content', 'product');
                }
            }
            wp_reset_postdata();
        ?>
            
        <?php
            $sparkle_html = ob_get_contents();
            ob_get_clean();
            echo $sparkle_html;
            die();
    }
}
add_action('wp_ajax_appzend_tabs_ajax_action', 'appzend_tabs_ajax_action');
add_action('wp_ajax_nopriv_appzend_tabs_ajax_action', 'appzend_tabs_ajax_action');

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

function appzend_woocommerce_template_loop_product_thumbnail(){ 
    $icon_hover_style = get_theme_mod('appzend_woo_product_hover_icon_position', 'left');
    ?>

    <div class="product_wrapper">

        <div class="content-product-imagin"></div>

        <div class="store_products_item">
            <div class="store_products_item_body">
                <?php
                    global $post, $product, $product_label_custom; 

                    $sale_class = '';
                    if( $product->is_on_sale() == 1 ){
                        $sale_class = 'new_sale';
                    }
                ?>
                <div class="flash <?php echo esc_attr( $sale_class ); ?>">
                    <?php 
						appzend_sale_percentage_loop();
                        if( get_theme_mod('appzend_catelog_enable_new_tag', true)):
                            $newness_days = 7;
                            $created = strtotime( $product->get_date_created() );
                            if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
                                appzend_flash_sale_new_tag();
                            }
                        endif;
                        

                        if ( $product->is_on_sale() && get_theme_mod('appzend_catelog_enable_sales_tag', true) ) :

                            echo apply_filters( 'woocommerce_sale_flash', appzend_flash_sale_tag(), $post, $product );
                        
                        endif;
                    ?>
                </div>

                <a href="<?php the_permalink(); ?>" class="store_product_item_link">
                    <?php 
                    if(has_post_thumbnail(  ) ): 
                        the_post_thumbnail('woocommerce_thumbnail'); #Products Thumbnail 
                    else:
                        
                    endif;
                    ?>
                </a>
            </div>
        </div>

  	<?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'appzend_woocommerce_template_loop_product_thumbnail', 10 );

/**
 * Links 
 */
if(!function_exists('appzend_add_to_cart_links')){
	function appzend_add_to_cart_links(){ ?>
		<div class="store_products_items_info hoverstyletwo">
			<?php if( function_exists( 'appzend_quickview' ) || function_exists( 'appzend_add_compare_link' ) || function_exists( 'appzend_wishlist_products' ) ): ?>
			<div class="appzend-buttons-wrapper">
				<?php if(function_exists( 'appzend_quickview' )) { ?>
					<div class="products_item_info">
						<?php  appzend_quickview(); ?>
					</div>
				<?php } ?>

				<?php if(function_exists( 'appzend_add_compare_link' )) { ?>
					<div class="products_item_info">
						<?php  appzend_add_compare_link(); ?>
					</div>
				<?php } ?>

				<?php if(function_exists( 'appzend_wishlist_products' )) { ?>
					<div class="products_item_info">
						<?php  appzend_wishlist_products(); ?>
					</div>
				<?php } ?>
			</div>
			<?php endif; ?>

			<div class="appzend-add-to-cart">
				<span class="products_item_info"> 
					<?php
						/**
						 * woocommerce_template_loop_add_to_cart
						*/
						woocommerce_template_loop_add_to_cart();
					?>
				</span>
			</div>

		</div>
		
		<?php
	}
	add_action( 'woocommerce_after_shop_loop_item', 'appzend_add_to_cart_links', 10 );
}

/**
 * Percentage calculation function area
*/
if( !function_exists ('appzend_sale_percentage_loop') ){
	/**
     * Woocommerce Products Discount Show
     *
     * @since 1.0.0
    */
	function appzend_sale_percentage_loop() {

        if( !get_theme_mod('appzend_catelog_enable_discount', true) ) return;

		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				
				$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
			
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {

                    $variation = wc_get_product( $child_id );
                    
                    if( !$variation ) continue;

					$price = $variation->get_regular_price();

					$sale = $variation->get_sale_price();

					$percentage = '';

					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}
            
            
            

            $color = get_theme_mod('appzend_catelog_discount_tag_text_color', '#ffffff');
            $bg_color = get_theme_mod('appzend_catelog_discount_tag_bg_color', '#ffc60a');
            
            $style = "style='color: $color; background-color: $bg_color;'";

            echo "<span class='on_sale' ". $style. ">" . esc_html( round( - $max_percentage ) ) . esc_html__("%", 'appzend')."</span>";
		
		}

	}
}
/**
 * Add the link to quickview function area
*/
if (defined('YITH_WCQV')) {
    function appzend_quickview() {
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action('woocommerce_after_shop_loop_item', array($quick_view, 'yith_add_quick_view_button'), 15);
        $label = esc_html(get_option('yith-wcqv-button-label'));
        echo '<a href="#" class="link-quickview yith-wcqv-button" data-product_id="' . intval( $product->get_id() ) . '">
			<span class="sparkle-tooltip-label">'.esc_html__('Quick view', 'appzend').'</span>
			<i class="far fa-eye"></i>
		</a>';
    }
}
/**
 * Add the link to compare function area
*/
if (defined('YITH_WOOCOMPARE')) {

    function appzend_add_compare_link($product_id = false, $args = array()) {
        extract($args);
        if (!$product_id) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        $is_button = !isset($button_or_link) || !$button_or_link ? get_option('yith_woocompare_is_button') : $button_or_link;

        if (!isset($button_text) || $button_text == 'default') {
            $button_text = get_option('yith_woocompare_button_text', esc_html__('Compare', 'appzend'));
            yit_wpml_register_string('Plugins', 'plugin_yit_compare_button_text', $button_text);
            $button_text = yit_wpml_string_translate('Plugins', 'plugin_yit_compare_button_text', $button_text);
        }
        printf('<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>', '#', 'compare link-compare', intval( $product_id ), '
			<span class="sparkle-tooltip-label">'.esc_html( $button_text ).'</span><i class="fas fa-random"></i>' );
    }

    remove_action('woocommerce_after_shop_loop_item', array('YITH_Woocompare_Frontend', 'add_compare_link'), 20);
}
if(!function_exists('appzend_flash_sale_tag')){

    function appzend_flash_sale_tag(){

        $new_tag_text = get_theme_mod('appzend_catelog_enable_sales_tag_text', esc_html__( 'Sale!', 'appzend' ));

        $color = get_theme_mod('appzend_catelog_enable_sales_tag_text_color', '#ffffff');
        $bg_color = get_theme_mod('appzend_catelog_enable_sales_tag_text_bg_color', '#f33c3c');
        
        $style = "style='color: $color; background-color: $bg_color;'";

        return '<span class="store_sale_label" '.$style. ' ><span class="text">' . $new_tag_text . '</span></span>';
    }
}
if(!function_exists('appzend_flash_sale_new_tag')){

    function appzend_flash_sale_new_tag(){

        $new_tag_text = get_theme_mod('appzend_catelog_enable_new_tag_text', esc_html__( 'New!', 'appzend' ));

        $color = get_theme_mod('appzend_catelog_enable_new_tag_text_color', '#ffffff');
        $bg_color = get_theme_mod('appzend_catelog_enable_new_tag_text_bg_color', '#009966');
        
        $style = "style='color: $color; background-color: $bg_color;'";

        echo '<span class="onnew" '.$style. ' ><span class="text">' . $new_tag_text . '</span></span>';
    }
}
/**
 * Product wishlist button function area
*/
if ( function_exists( 'YITH_WCWL' ) ) {
    function appzend_wishlist_products() {
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
}
/**
 * define the yith-wcwl-browse-wishlist-label callback
*/
function filter_yith_wcwl_browse_wishlist_label( $var ) { 

    return '<span class="sparkle-tooltip-label">'.$var.'</span><i class="fas fa-heart"></i>';

}; 
add_filter( 'yith-wcwl-browse-wishlist-label', 'filter_yith_wcwl_browse_wishlist_label', 10, 1 ); 