<?php 
    $image = get_theme_mod('appzend_calltoaction_image');  
    $alignment = get_theme_mod('appzend_calltoaction_alignment');
    $alignment_class = get_zppzend_alignment_class($alignment);
?>
    
<div id="app-cta" class="calltoaction_promo_wrapper <?php echo esc_attr($alignment_class); ?>" <?php if($image): ?>style="background-image: url(<?php echo esc_url_raw( $image ); ?>)"<?php endif; ?>>
    <div class="container">
        <div class="calltoaction_full_widget_content">
            <?php get_appzend_headline('appzend_calltoaction'); ?>
            <?php
                $btn = get_theme_mod('appzend_calltoaction_button');
                $btn_link = get_theme_mod('appzend_calltoaction_link');
                $btn1 = get_theme_mod('appzend_calltoaction_button_one');
                $btn_link1 = get_theme_mod('appzend_calltoaction_link_one');
            if($btn || $btn1 ): ?>
            <div class="calltoaction_button_wrap">
                <?php if($btn): ?>
                    <a href="<?php echo esc_url($btn_link); ?>" class="btn btn-primary cta-btn1"> <?php echo esc_html($btn); ?></a>
                <?php endif; ?>
                <?php if($btn1): ?>
                    <a href="<?php echo esc_url($btn_link1); ?>" class="btn btn-border cta-btn2"> <?php echo esc_html($btn1); ?></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>