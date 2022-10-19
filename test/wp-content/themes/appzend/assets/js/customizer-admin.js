jQuery(document).ready(function ($) {

    /**
     * Customizer Option Auto focus
     */
    jQuery('h3.accordion-section-title').on('click', function(){
        var id = $(this).parent().attr('id');
        var is_panel = id.includes("panel");
        var is_section = id.includes("section");
        
        if( is_panel ){
            focus_item = id.replace('accordion-panel-', '');
            //console.log(focus_item);
            history.pushState({}, null, '?autofocus[panel]=' + focus_item);
        }
        if( is_section ){
            focus_item = id.replace('accordion-section-', '');
            history.pushState({}, null, '?autofocus[section]=' + focus_item);
        }
    });

    // redirect section to active panel
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var is_panel = queryString.includes("panel");
    var is_section = queryString.includes("section");
    
    if( is_panel ){
        var active = urlParams.get('autofocus[panel]');
        focus_item = 'accordion-panel-' + active;
    }
    if( is_section ){
        var active = urlParams.get('autofocus[section]');
        focus_item = 'accordion-section-' +  active;
    }
    setTimeout(function(){
        AppZendScrollToSection(focus_item);
    }, 5000)
    
    /**
     * Select Multiple Category
     */
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function () {

            var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(
                function () {
                    return $(this).val();
                }
            ).get().join(',');

            $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');

        }
    );

    /*
      * Switch Enable/Disable Control.
    */
    $('body').on('click', '.onoffswitch', function () {
        var $this = $(this);
        if ($this.hasClass('switch-on')) {
            $(this).removeClass('switch-on');
            $this.next('input').val('disable').trigger('change')
        } else {
            $(this).addClass('switch-on');
            $this.next('input').val('enable').trigger('change')
        }
    });


    //Homepage Section Sortable
    function appzend_sections_order(container) {
        var sections = $(container).sortable('toArray');
        var sec_ordered = [];
        $.each(sections, function (index, sec_id) {
            sec_id = sec_id.replace("accordion-section-", "");
            sec_ordered.push(sec_id);
        });

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                'action': 'appzend_sections_reorder',
                'sections': sec_ordered,
            }
        }).done(function (data) {
            $.each(sec_ordered, function (key, value) {
                wp.customize.section(value).priority(key);
            });
            $(container).find( '.appzend-drag-spinner' ).hide();
            wp.customize.previewer.refresh();
        });
    }

    $('#sub-accordion-panel-appzend_frontpage_settings').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        items: '> li.control-section:not(#accordion-section-appzend_slider_section)',
        delay: 150,
        update: function (event, ui) {
            $('#sub-accordion-panel-appzend_frontpage_settings').find( '.appzend-drag-spinner' ).show();
            appzend_sections_order('#sub-accordion-panel-appzend_frontpage_settings');
            $( '.wp-full-overlay-sidebar-content' ).scrollTop( 0 );
        }
    });

    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-appzend_frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        AppZendScrollToSection( section_id );
    });

    /**
     * Set Page type for front page
     */
    wp.customize('appzend_enable_frontpage', function (setting) {
        var enableFrontPage = function (control) {
            var visibility = function () {
                if ('enable' === setting.get()) {
                    wp.customize.control('show_on_front').setting.set('posts');
                }
            };
            visibility();
            setting.bind(visibility);
        };
        
        wp.customize.control('appzend_enable_frontpage', enableFrontPage);
    });
    
    /**
     * Header Menu Button
     * Enable Related Fields
     * @since 1.0.0
     */
    wp.customize('appzend_button_enable', function (setting) {
        var hideShow = function (control) {
            
            var visibility = function () {
                if ('enable' === setting.get() ) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };
        wp.customize.control('appzend-button-text', hideShow);
        wp.customize.control('appzend-button-enable-icon', hideShow);
        wp.customize.control('appzend-button-icon', hideShow);
        wp.customize.control('appzend-button-url', hideShow);
        wp.customize.control('appzend-button-open-link-new-tab', hideShow);
        wp.customize.control('appzend-button-class', hideShow);
        wp.customize.control('appzend-button-class', hideShow);
    });

    /**
     * Header Custom Menu Selection
     * @since 1.0.0
     * Customizer navigation value set
     */
    wp.customize( 'appzend-menu', function( setting ) {
        setting.bind( function onChange( value ) {
            wp.customize.control( 'nav_menu_locations[menu-1]' ).setting.set( value );
        });
    });

});

function AppZendScrollToSection( section_id ){
    
    var preview_section_id = "banner-slider";

    var $contents = jQuery('#customize-preview iframe').contents();
    console.log(section_id);
    switch ( section_id ) {
        

        case 'sub-accordion-section-appzend_slider_section':
        preview_section_id = "banner-slider";
        break;

        case 'accordion-section-features_service_section':
        preview_section_id = "get-started";
        break;

        case 'accordion-section-appzend_highlight_service_section':
        preview_section_id = "highlight-service-section";
        break;

        case 'accordion-section-appzend_aboutus_section':
        preview_section_id = "aboutus";
        break;

        case 'accordion-section-appzend_service_section':
        preview_section_id = "appzend-service-section";
        break;

        case 'accordion-section-appzend_calltoaction_section':
        preview_section_id = "app-cta";
        break;

        case 'accordion-section-appzend_recentwork_section':
        preview_section_id = "app-portfolio";
        break;
        
        case 'accordion-section-appzend_howitworks_section':
        preview_section_id = "app-how-it-works";
        break;

        case 'accordion-section-appzend_poductcat_section':
            preview_section_id = "cl-productcat-section";
        break;
        
        case 'accordion-section-appzend_producttype_section':
            preview_section_id = "cl-producttype-section";
        break;
        
        case 'accordion-section-appzend_producthotoffer_section':
            preview_section_id = "cl-hotoffer-section";
        break;

    }

    if( $contents.find('#'+preview_section_id).length > 0 ){
        $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}