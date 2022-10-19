jQuery(document).ready(function(){
    var brtl = false;
    if (jQuery("body").hasClass('rtl')) brtl = true;

    // appzend custom tab like accordion
    jQuery('.appzend-tab li').on('click', function(){
        var active = false;
        if( jQuery(this).hasClass('active')){
            active = true;
        }
        jQuery(this).parent().find('li').removeClass('active');
        if( active ){
            jQuery(this).removeClass('active');
        }else{
            jQuery(this).addClass('active');
        }
    })

    /**
     * Home Slider 
     */
    jQuery('#banner-slider .owl-carousel, .storeslider').each(function(){
        var $this = jQuery(this);
        var dataCol = $this.attr('data-col') || 1;
        $this.owlCarousel({
            items: dataCol,
            loop: true,
            smartSpeed: 20000,
            dots: false,
            nav: true,
            autoplay: true,
            mouseDrag: true,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            rtl: brtl,
            responsive: {
            0: {
                nav: false,
                mouseDrag: false,
                touchDrag:false,
                items: 1,
            },
            767: {
                nav: false,
                mouseDrag: false,
                touchDrag:false,
                items: 1,
    
            },
            1000: {
                nav: true,
                mouseDrag: true,
                touchDrag:true,
    
            }
            }
        });
    });

    /**
     * Sparkle Tabs Category Product
    */
    $ = jQuery;
    jQuery('.sparkletablinks').each(function(){
        $(this).find('li').first('li').addClass('active');
    })
    
    jQuery('.sparkletabs .sparkletablinks a').on('click', function(e)  {
        e.preventDefault();
        var that = $(this);

        var currentAttrValue = that.attr('href');
        var product_num = that.parents('ul').data('noofporduct');
        var column =  that.parents('ul').data('column');
        var layout = that.parents('ul').data('layout');
        var active = that.attr('id');

        var parentLi = that.parent('li');
            parentLi.addClass('active').siblings().removeClass('active');

        var contentArea = $(this).parents('.sparkletabs').siblings('.sparkletabsproductwrap .sparkletablinkscontent').find('.sparkletabproductarea').find("#"+currentAttrValue);
        
        //find is ajax or not
        var is_no_ajax = that.data('noajax');
        if( is_no_ajax ){
            
            that.parents('.sparkletabs').parent().find('.sparkletabproductarea .tab-content').hide();
            
            that.parents('.sparkletabs').parent().find('.sparkletabproductarea #' + active).show();
            $(window).trigger('resize');
            return ;
        }

        that.parents('.sparkletabs').parent().find('.sparkletabproductarea ul').addClass('hidden');

        contentArea.removeClass('hidden');
        $(window).trigger('resize');
        
        if( parentLi.attr('data-loaded') == 1) {
            console.log('already loaded');
            return;
        }

        contentArea.hide();
    });
})
