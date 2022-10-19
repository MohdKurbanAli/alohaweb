<?php
    $alignment = get_theme_mod('appzend_howitworks_alignment');
    $alignment_class = get_zppzend_alignment_class($alignment);
?>
<section class="how-it-works <?php echo esc_attr($alignment_class); ?>" id="app-how-it-works">
    <div class="graphics-section-left">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/leftbg-shape.png">
    </div>

    <div class="container">
        <?php 
            get_appzend_headline('appzend_howitworks'); 
        ?>
        <div class="grid grid-2 <?php echo esc_attr($alignment_class); ?>">
            <div class="left-accordion">
                <ul class="appzend-tab">
                <?php
                $works = get_theme_mod('appzend_howitworks');
                
                if($works):
                    $count = 0;
                    $works = json_decode($works);
                    foreach($works as $service):
                        if(!$service->howitworks_page) continue;
                        $page   = get_post( $service->howitworks_page );
                        $title  = $page->post_title;
                        ?>
                        
                        <li class="section-box <?php if($count == 0 ): echo 'active'; endif; ?>">
                            <div class="title box-title"><i class="far fa-dot-circle"></i><?php echo esc_html($title); ?></div>
                            <div class="content box-content"><?php echo apply_filters( 'the_content', $page->post_content ); ?></div>
                        </li>
                    <?php
                    $count++;
                    endforeach;
                endif;
                ?>
                </ul>
            </div>
            <?php
            $img = get_theme_mod('appzend_howitworks_image');
            if($img): ?>
                <div class="right-img">
                    <img src="<?php echo esc_url($img); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>