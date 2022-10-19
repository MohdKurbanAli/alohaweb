
(function ($) {
    jQuery(document).ready(function ($) {
        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();
        
        // FontAwesome Icon Control JS
        $('body').on('click', '.appzend-customizer-icon-box .appzend-icon-list li', function () {
            var icon_class = $(this).find('i').attr('class');
            $(this).closest('.appzend-icon-box').find('.appzend-icon-list li').removeClass('icon-active');
            $(this).addClass('icon-active');
            $(this).closest('.appzend-icon-box').prev('.appzend-selected-icon').children('i').attr('class', '').addClass(icon_class);
            $(this).closest('.appzend-icon-box').next('input').val(icon_class).trigger('change');
            $(this).closest('.appzend-icon-box').slideUp();
        });
    
        $('body').on('click', '.appzend-customizer-icon-box .appzend-selected-icon', function () {
            $(this).next().slideToggle();
        });
    
        $('body').on('change', '.appzend-customizer-icon-box .appzend-icon-search select', function () {
            var selected = $(this).val();
            $(this).closest('.appzend-icon-box').find('.appzend-icon-search-input').val('');
            $(this).closest('.appzend-icon-box').find('.appzend-icon-list li').show();
            $(this).closest('.appzend-icon-box').find('.appzend-icon-list').hide().removeClass('active');
            $(this).closest('.appzend-icon-box').find('.' + selected).fadeIn().addClass('active');
        });
    
        $('body').on('keyup', '.appzend-customizer-icon-box .appzend-icon-search input', function (e) {
            var $input = $(this);
            var keyword = $input.val().toLowerCase();
            search_criteria = $input.closest('.appzend-icon-box').find('.appzend-icon-list.active i');
    
            delay(function () {
                $(search_criteria).each(function () {
                    if ($(this).attr('class').indexOf(keyword) > -1) {
                        $(this).parent().show();
                    } else {
                        $(this).parent().hide();
                    }
                });
            }, 500);
        });

    });
})(jQuery);
