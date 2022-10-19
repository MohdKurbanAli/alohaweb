<?php
$alignment = get_theme_mod('appzend_aboutus_alignment');
$alignment_class = get_zppzend_alignment_class($alignment);
?>
<section id="aboutus" class="about_us <?php echo esc_attr($alignment_class); ?>">
    <div class="container">
        <div class="about-content">

            
            <?php 
                get_appzend_headline('appzend_aboutus');
                $about = get_theme_mod('appzend_aboutus');
                $email  = get_theme_mod('appzend_aboutus_email_address');
                $phone = get_theme_mod('appzend_aboutus_phone_number');
                
                if($about):
                    $page   = get_post( $about );
                    $title  = $page->post_title;
                    $content = $page->post_content;
                    $featured_img_url = get_the_post_thumbnail_url($page->ID,'full'); 
                    ?>

                    <div class="aboutus-headlines headlines about-content">
                        <h2><?php echo esc_html($title); ?></h2>
                        <div class="content">
                            <?php echo apply_filters( 'the_content', $content ); ?>
                        </div>
                    </div>
                
                    <?php if( $email || $phone ): ?>
                    <div class="address-info">
                        <ul>
                            <?php if($email): ?>
                                <li><?php echo __('Email Us', 'appzend'); ?> : <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
                            <?php endif; ?>
                            <?php if($phone): ?>
                                <li><?php echo __('Contact Us', 'appzend'); ?> : <a href="tel:<?php echo esc_attr($phone);?>"><?php echo esc_html($phone); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                
                <?php if( $featured_img_url ): ?>
                    <div class="feature-image">
                        <img src="<?php echo esc_url($featured_img_url); ?>" />
                    </div>
                <?php endif; endif; ?>
    </div>
</section>
