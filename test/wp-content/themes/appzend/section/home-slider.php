<section class="bannerslider banner-slider" id="banner-slider"> 
    <div class="owl-carousel">

    <?php 
        $appzend_slider = get_theme_mod('appzend_slider');
        if( $appzend_slider ):
            $appzend_slider = json_decode($appzend_slider);
            foreach($appzend_slider as $slider):
                $page_id = $slider->slider_page;

                if( !empty( $page_id ) ):

                    $page = new WP_Query( 'page_id='.$page_id );

                    if( $page->have_posts() ):
                        while( $page->have_posts() ):
                            $page->the_post();
                            $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
                            ?>
                            <div class="bannerwrap" <?php if($slider->banner == 'background'): ?> style="background-image:url(<?php echo esc_url($image_path[0]); ?>)" <?php endif; ?>>
                                <div class="container grid position-<?php echo esc_attr($slider->banner); ?> <?php echo esc_attr($slider->alignment); ?>">
                                    <?php if($slider->banner == 'left'): ?>
                                    <div class="banner-image">
                                        <img src="<?php echo esc_url($image_path[0]); ?>">
                                    </div>
                                    <?php endif; ?>

                                    <div class="slider-content">
                                        <h1><?php the_title(); ?></h1>
                                        <?php the_excerpt(  ); ?>
                                        <?php if( $slider->button_text ): ?>
                                            <a href="<?php echo esc_url($slider->button_url); ?>"><?php echo esc_html($slider->button_text); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($slider->banner == 'right'): ?>
                                    <div class="banner-image">
                                        <img src="<?php echo esc_url($image_path[0]); ?>">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        endwhile;
                    endif;
                endif;
            endforeach;
        endif;
    ?>
        
    </div>    
</section>