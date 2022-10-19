<?php
if (!class_exists('woocommerce')) {
    return;
}

/**
** wp query for first block
**/  
$appzend_pro_cat_id = get_theme_mod('appzend_producthotoffer_category');
$appzend_pro_cat_id = explode(',', $appzend_pro_cat_id);
$column_number      = get_theme_mod('appzend_producthotoffer_column', 3);
$per_page           = get_theme_mod('appzend_producthotoffer_per_page', 9);
$layout             = get_theme_mod('appzend_producthotoffer_category_view', 'grid');
$type               = ''; //get_theme_mod('appzend_producthotoffer_bg_type');
$bg_video           = ''; //get_theme_mod("appzend_producthotoffer_bg_video", '1IaZy0sDLu0');
$offer_text         = get_theme_mod('appzend_producthotofer_offer_text', '<span class="color-primary">Hurry up!</span> Offers end in');
$alignment          = get_theme_mod('appzend_producthotoffer_alignment', 'text-center');
$alignment_class    = get_zppzend_alignment_class($alignment);


if( $type == "video-bg" &&  $bg_video):
    $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
else: 
    $video_data = '';
endif;

$css = array();
$css[] = 'product-hotoffer-wrap product-deals section-wrap';
$css[] = 'layout-'.esc_attr( $layout );
$css[] = 'offer-style-3';
$css[] = $alignment_class;

$product_args = array(
    'post_type' => 'product',
    'tax_query' => array(
        array('taxonomy'  => 'product_cat',
            'field'     => 'term_id',
            'terms'     => $appzend_pro_cat_id,
        )
    ),
    'meta_query'     => array(
        array(
            'key'           => '_sale_price_dates_to',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
        )
    ),
    'posts_per_page' => $per_page
);

?>
<section id="cl-hotoffer-section" 
    class="cl-producthotoffer-section cl-section <?php echo implode(' ', $css); ?>" 
    <?php echo $video_data; ?>>
    <div class="container">

        <div class="product-list-area section-content woocommerce">

            
            <?php get_appzend_headline('appzend_producthotoffer'); ?>

            <ul class="storeproductlist products grid grid-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-col="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                <?php
                    $query = new WP_Query( $product_args );

                    if($query->have_posts()) {  while( $query->have_posts() ) { $query->the_post();
                ?>
                    <li <?php post_class(); ?>>
                        <?php
                            /**
                             * woocommerce_before_shop_loop_item hook.
                             *
                             * @hooked woocommerce_template_loop_product_link_open - 10
                             */
                            do_action( 'woocommerce_before_shop_loop_item' );

                            /**
                             * woocommerce_before_shop_loop_item_title hook.
                             *
                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                             */
                            do_action( 'woocommerce_before_shop_loop_item_title' );
                        ?>
                        <?php
                            $product_id = get_the_ID();
                            $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                            $price_sale = get_post_meta( $product_id, '_sale_price', true );
                            $date = date_create($sale_price_dates_to);
                            $new_date = date_format($date,"Y/m/d H:i");

                            if(!empty( $sale_price_dates_to ) ) { if(!empty( $price_sale) ) {
                        ?>
                            <div class="pcountdown-cnt-list-slider">
                                
                                <?php if( $offer_text):
                                    echo wp_kses_post(wpautop($offer_text));
                                endif; ?>
                                    
                                
                                <ul class="countdown_<?php echo intval( $product_id ); ?> clearfix">
                                    <li><div class="time-days"><span class="days">00</span><span class="time"><?php esc_html_e('Days','appzend'); ?></span></div></li>
                                    <li><div class="time-hours"><span class="hours">00</span><span class="time"><?php esc_html_e('Hours','appzend'); ?></span></div></li>
                                    <li><div class="time-minutes"><span class="minutes">00</span><span class="time"><?php esc_html_e('Mins','appzend'); ?></span></div></li>
                                    <li><div class="time-seconds"><span class="seconds">00</span><span class="time"><?php esc_html_e('Secs','appzend'); ?></span></div></li>
                                </ul>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                    jQuery(".countdown_<?php echo intval( $product_id ); ?>").countdown({
                                        date: "<?php echo esc_attr( $new_date ); ?>",
                                        offset: -8,
                                        day: "Day",
                                        days: "Days"
                                    }, function () {
                                    //  alert("Done!");
                                    });
                                });
                            </script>
                        <?php } } ?>
                        <?php
                            /**
                             * woocommerce_shop_loop_item_title hook.
                             *
                             * @hooked woocommerce_template_loop_product_title - 10
                             */
                            do_action( 'woocommerce_shop_loop_item_title' );

                            /**
                             * woocommerce_after_shop_loop_item_title hook.
                             *
                             * @hooked woocommerce_template_loop_rating - 5
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            do_action( 'woocommerce_after_shop_loop_item_title' );

                            /**
                             * woocommerce_after_shop_loop_item hook.
                             *
                             * @hooked woocommerce_template_loop_product_link_close - 5
                             * @hooked woocommerce_template_loop_add_to_cart - 10
                             */
                            do_action( 'woocommerce_after_shop_loop_item' );
                        ?>
                    </li>

                <?php } } wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
</div><!-- End Product Slider -->