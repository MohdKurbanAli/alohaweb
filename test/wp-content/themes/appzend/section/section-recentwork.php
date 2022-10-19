<?php
$alignment = get_theme_mod('appzend_recentwork_alignment');
$alignment_class = get_zppzend_alignment_class($alignment);
?>
<section class="get-started why-us portfolio <?php echo esc_attr($alignment_class); ?>" id="app-portfolio">
    <div class="graphics-section graphics-section-unique">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rightshape-bg.png">
    </div>

    <div class="container">
        <?php get_appzend_headline('appzend_recentwork'); ?>

        <div class="grid grid-<?php echo esc_attr(get_theme_mod('appzend_portfolio_column', 2)); ?>">
            <?php
            $portfolio = get_theme_mod('appzend_portfolio');
            
            if($portfolio):
                $portfolio = json_decode($portfolio);
                foreach($portfolio as $service):
                    $page   = get_post( $service->page );
                    $icon   = $service->logo; 
                    $title  = $page->post_title;
                    $featured_img_url = get_the_post_thumbnail_url($page->ID,'large'); 
                    $link = get_permalink( $page->id);
                    $content = get_the_excerpt( $page->id ); ?>
                    <div class="single-item section-box">
                        <div class="product-img">
                            <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr($title); ?>">
                        </div>
                        <div class="product-dec">
                            <?php if($icon): ?>
                            <div class="image logo">
                                <img src="<?php echo esc_url( $icon); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                            <?php endif; ?>

                            <div class="details-wrap">
                                <div class="service-type">
                                    <h3 class="box-title"><a class="box-title" target="_blank" href="<?php echo esc_url($link); ?>">  <?php echo esc_html( $title ); ?> </a></h3>
                                </div> 
                                <div class="service-des box-content">
                                    <?php echo esc_html( $content ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif; 
            ?>
        </div>
    </div>
</section>