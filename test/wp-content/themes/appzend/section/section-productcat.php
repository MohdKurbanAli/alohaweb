<?php
if (!class_exists('woocommerce')) {
    return;
}

/**
** wp query for first block
**/  
$appzend_pro_cat_id = get_theme_mod('appzend_productcat_category');
$appzend_pro_cat_id = explode(',', $appzend_pro_cat_id);
$view_style         = get_theme_mod('appzend_productcat_layout', 'category-style-1');
$column_number      = get_theme_mod('appzend_productcat_column', 3);
$layout             = get_theme_mod('appzend_productcat_category_view', 'grid');
$type               = ''; //get_theme_mod('appzend_productcat_bg_type');
$bg_video           = ''; //get_theme_mod("appzend_productcat_bg_video", '1IaZy0sDLu0');
$alignment          = get_theme_mod('appzend_productcat_alignment');
$alignment_class    = get_zppzend_alignment_class($alignment);

if( $type == "video-bg" &&  $bg_video):
    $video_data = 'data-property="{videoURL:\'' . $bg_video . '\', mobileFallbackImage:\'https://img.youtube.com/vi/' . $bg_video . '/maxresdefault.jpg\'}"';
else: 
    $video_data = '';
endif;
?>
<section id="cl-productcat-section" 
    class="cl-productcat-section cl-section  section-wrap categoryarea layout-<?php echo esc_attr( $layout ); ?> <?php echo esc_attr($alignment_class); ?>" 
    <?php echo $video_data; ?>>
        <div class="cl-section-wrap">
            <div class="container">               
                <div class="section-content text-center">                    
                    <?php get_appzend_headline('appzend_productcat'); ?>
                    <ul class="storeproductlist grid grid-<?php echo esc_attr( $column_number ); ?> <?php if($layout == 'slider'){ echo esc_attr('storeslider owl-carousel'); } ?>" data-col="<?php echo esc_attr( $column_number ); ?>" data-style="<?php echo esc_attr( $layout ); ?>">
                        <?php
                            $count = 0; 
                            if(!empty( $appzend_pro_cat_id ) ){
                                foreach ($appzend_pro_cat_id as $key ) {          
                                    $thumbnail_id = get_term_meta( $key, 'thumbnail_id', true );
                                    if($thumbnail_id){
                                        //$images = wp_get_attachment_url( $thumbnail_id );
                                        $image = wp_get_attachment_image_src($thumbnail_id, 'large', true);
                                    }else {
                                        $image[0] = '';
                                    }
                                    $term = get_term_by( 'id', $key, 'product_cat');
                                    if( !$term ) continue;
                                    $term_link = get_term_link($term);
                                    $term_name = $term->name;
                                    $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . $term->count . ' '.esc_html__('Products','appzend').'', $term);
                        ?>
                            <li class="product-category product <?php echo esc_attr( $view_style ); ?>">
                                <div class="product-wrapper">
                                    <a href="<?php echo esc_url($term_link); ?>">
                                        <div class="products-cat-wrap">
                                            <div class="products-cat-image">    
                                                <?php echo '<img class="categoryimage" src="' . esc_url( $image[0] ) . '" />'; ?>
                                            </div>
                                            <div class="products-cat-info">
                                                <h3 class="woocommerce-loop-category__title">
                                                    <?php echo esc_html($term_name); ?>
                                                    <span class="count"><?php echo esc_html( $sub_count );  ?></span>
                                                </h3>
                                            </div>
                                            <?php if( !empty( $view_style ) && $view_style == 'category-style-3' ){ ?>
                                                <ul class="product-sub-cat">
                                                    <?php 
                                                        $parent_id = $key;
                                                        $termchildrens = get_terms('product_cat',array('child_of' => $parent_id));
                                                        foreach( $termchildrens as $termchildren ){
                                                            $termchild_link = get_term_link( $termchildren );
                                                    ?>
                                                        <li><a href="<?php echo esc_url( $termchild_link ); ?>"><?php echo esc_html( $termchildren->name ); ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </div>
                                    </a>            
                                </div>         
                            </li>
                        <?php } }  ?>
                    </ul>
                </div>
            </div>
        </div>
</section>