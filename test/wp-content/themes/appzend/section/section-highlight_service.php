<?php
    $alignment = get_theme_mod('appzend_highlight_service_alignment');
    $alignment_class = get_zppzend_alignment_class($alignment);
?>
<section class="work-with-us <?php echo esc_attr($alignment_class); ?> <?php echo esc_attr(get_theme_mod('appzend_highlight_service_layout', 'layout-one')); ?>" id="highlight-service-section">
    <div class="graphics-section-left">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/leftbg-shape.png">
    </div>
    <div class="container">
        <?php 
            get_appzend_headline('appzend_highlight_service');

            $services = get_theme_mod('appzend_highlight_service');
            $left_services = array();
            $right_sevices = array();
            if($services):
                $services = json_decode($services);
                $quantity = count($services);

                $left_services = array_slice($services, 0, intval($quantity / 2), true);
                $right_sevices = array_diff_key($services, $left_services);
            endif;
        ?>

        <div class="grid grid-3 text-center ">
            <div class="left-grid">
                <?php foreach($left_services as $service):
                        $page   = get_post( $service->page );
                        $title  = $page->post_title;
                        $content = get_the_excerpt( $page->id );
                ?>
                <div class="left-side-b section-box">
                    <div class="three-work">
                        <div class="left-content">
                            <h3 class="box-title"><?php echo esc_html($title); ?></h3>
                            <p class="box-content"><?php echo esc_html($content); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $image = get_theme_mod('appzend_highlight_service_image');
            if($image): ?> 
            <div class="center-b">
                <img src="<?php echo esc_url($image); ?>">
            </div>
            <?php endif; ?>

            <div class="right-side-b">

                <?php foreach($right_sevices as $service):
                        $page   = get_post( $service->page );
                        $title  = $page->post_title;
                        $content = get_the_excerpt( $page->id );
                ?>
                <div class="left-side-b section-box">
                    <div class="three-work">
                        <div class="left-content">
                            <h3 class="box-title"><?php echo esc_html($title); ?></h3>
                            <p class="box-content"><?php echo esc_html($content); ?></p>
                        </div>
                    </div>
                </div>
                <?php 
                if(!empty($page)){
                    //do something with your query results
                    //invoke post data reset here
                    wp_reset_postdata();
                  }
                endforeach; ?>
            </div>
        </div>
    </div>
</section>