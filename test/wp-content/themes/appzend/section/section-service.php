<?php
    $alignment          = get_theme_mod('appzend_service_alignment');
    $alignment_class    = get_zppzend_alignment_class($alignment);
?>
<section class="get-started why-us <?php echo esc_attr($alignment_class); ?>" id="appzend-service-section">
    <div class="graphics-section-rs">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ls-graphics.png">
    </div>
    <div class="graphics-section graphics-section-unique">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rightshape-bg.png">
    </div>

    <div class="container">
        <?php
            get_appzend_headline('appzend_service'); 
        ?>

        <div class="grid grid-3 <?php echo esc_attr($alignment_class); ?>">
            <?php
            $services = get_theme_mod('appzend_service');
            
            if($services):
                $services = json_decode($services);
                foreach($services as $service):
                    $page   = get_post( $service->page );
                    $icon   = $service->icon; 
                    $title  = $page->post_title;
                    $content = get_the_excerpt( $page->id ); ?>

                    <div class="get-started-item section-box">
                        <?php if($icon): ?>
                        <div class="box-icon">
                            <i class="icon box-icon <?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <?php endif; ?>
                        
                        <h3 class="box-title"><?php echo esc_html($title); ?></h3>
                        <p class="box-content"><?php echo esc_html($content); ?></p>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>
    </div>
</section>