<?php
$alignment = get_theme_mod('appzend_features_service_alignment');
$alignment_class = get_zppzend_alignment_class($alignment);
?>
<section class="get-started <?php echo esc_attr($alignment_class); ?>" id="get-started">
    <div class="graphics-section-ls">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/ls-graphics.png">
    </div>
    <div class="graphics-section">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/rightshape-bg.png">
    </div>

    <div class="container">
        <?php 
            get_appzend_headline('appzend_features_service'); 
        ?>

        <div class="grid grid-3 <?php echo esc_attr($alignment_class); ?>">
            <?php
                $features = get_theme_mod('appzend_features_service');
                if($features):
                    $features = json_decode($features);
                    foreach($features as $feature):
                        $page   = get_post( $feature->page );
                        $icon   = $feature->icon; 
                        $title  = $page->post_title;
                        $content = get_the_excerpt( $page->id );
                        ?>
                        <div class="feature-services-item section-box">
                            <?php if($icon): ?>
                            <div class="hex box-icon">
                                <i class="icon <?php echo esc_attr($icon); ?>"></i> 
                                
                                <div class="dots">
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/dots.png" alt="dots">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="feature-services-details">
                                <h3 class="box-title"><?php echo esc_html($title); ?></h3>
                                <p class="box-content"><?php echo esc_html($content); ?></p>
                            </div>
                        </div>

                        <?php
                    endforeach;
                endif;
                ?>
        </div>
    </div>
</section>