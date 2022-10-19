<div class="welcome-getting-started">
    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Manual Setup', 'appzend'); ?></h3>

        <p><?php echo esc_html__('You can setup the home page sections either from Customizer Panel or from Elementor Pagebuilder', 'appzend'); ?></p>
        <p><strong><?php echo esc_html__('FROM CUSTOMIZER', 'appzend'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Go to Appearance &gt; Customize &gt; Enable Front Page', 'appzend'); ?></li>
            <li><?php echo esc_html__('Go to Home Sections &gt; Customize', 'appzend'); ?></li>
        </ol>
        <p><strong><?php echo esc_html__('FROM ELEMENTOR', 'appzend'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Firstly install and activate "Elementor Website Builder" plugin from', 'appzend'); ?> <a href="<?php echo esc_url(admin_url('post-new.php?page=appzend-welcome&section=recommended_plugins')); ?>" target="_blank"><?php echo esc_html__('Recommended Plugin page.', 'appzend'); ?></a></li>
            <li><?php echo esc_html__('Create a new page and edit with Elementor. Drag and drop the elements in the Elementor to create your own design.', 'appzend'); ?></li>
            <li><?php echo esc_html__('Now go to Appearance &gt; Customize &gt; Homepage Settings and choose "A static page" for "Your latest posts" and select the created page for "Home Page" option.', 'appzend'); ?></li>
        </ol>
        
        <p>
            <?php echo sprintf(esc_html__('For more detail visit our theme %s.', 'appzend'), '<a href="'.esc_url('https://docs.sparklewpthemes.com/appzend/').'" target="_blank">' . esc_html__('Documentation Page', 'appzend') . '</a>'); ?>
        </p>
    </div>

    <div class="welcome-demo-import">
        <div class="welcome-theme-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php printf(esc_attr__('%s Demo', 'appzend'), $this->theme_name); ?>">
        </div>

        <div class="welcome-demo-import-text">
            <p><?php esc_html_e('Or you can get started by importing the demo with just one click.', 'appzend'); ?></p>
            <p><?php echo sprintf(esc_html__('Click on the button below to install and activate the One Click Demo Importer Plugin. For more detailed documentation on how the demo importer works, click %s.', 'appzend'), '<a href="'.esc_url('https://docs.sparklewpthemes.com/appzend/').'" target="_blank">' . esc_html__('here', 'appzend') . '</a>'); ?></p>
            <?php echo $this->generate_demo_installer_button(); ?>
        </div>
    </div>
</div>