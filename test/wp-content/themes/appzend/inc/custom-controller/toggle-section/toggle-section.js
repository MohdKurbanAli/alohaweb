jQuery(document).ready(function ($) {
    var toggleSection = $('.appzend-toggle-section');

    toggleSection.each(
            function () {
                var controlName = $(this).data('control');
                try{
                    var controlValue = wp.customize.control(controlName).setting.get();
                    var parentHeader = $(this).parent();
                    if (typeof (controlName) !== 'undefined' && controlName !== '') {
                        var iconClass = 'dashicons-visibility';
                        if (controlValue === 'disable') {
                            iconClass = 'dashicons-hidden';
                            parentHeader.addClass('appzend-section-hidden').removeClass('appzend-section-visible');
                        } else {
                            parentHeader.addClass('appzend-section-visible').removeClass('appzend-section-hidden');
                        }
                        $(this).children().attr('class', 'dashicons ' + iconClass);
                    }
                }catch(e){
                    console.info(e)
                }
            }
    );

    toggleSection.on(
            'click',
            function (e) {
                e.stopPropagation();
                var controlName = $(this).data('control');
                var parentHeader = $(this).parent();
                var controlValue = wp.customize.control(controlName).setting.get();
                if (typeof (controlName) !== 'undefined' && controlName !== '') {
                    var iconClass = 'dashicons-visibility';

                    if (controlValue === 'disable') {
                         parentHeader.addClass('appzend-section-visible').removeClass('appzend-section-hidden');
                         wp.customize.control(controlName).setting.set('enable');
                         if( controlName == 'appzend_enable_frontpage'){
                            wp.customize.control('show_on_front').setting.set('posts');
                         }

                         $('[data-customize-setting-link=' + controlName + ']').siblings('.onoffswitch').addClass('switch-on');
                         
                     } else {
                         iconClass = 'dashicons-hidden';
                         parentHeader.addClass('appzend-section-hidden').removeClass('appzend-section-visible');
                         wp.customize.control(controlName).setting.set('disable');
                         $('[data-customize-setting-link=' + controlName + ']').siblings('.onoffswitch').removeClass('switch-on');
                     }

                    $(this).children().attr('class', 'dashicons ' + iconClass);
                }
            }
    );
    

    $('body').on('click', '.switch-section.onoffswitch', function () {
        var controlName = $(this).siblings('input').data('customize-setting-link');
        var controlValue = $(this).siblings('input').val();
        var iconClass = 'dashicons-visibility';
        if (controlValue === 'disable') {
            iconClass = 'dashicons-hidden';
            $('[data-control=' + controlName + ']').parent().addClass('appzend-section-hidden').removeClass('appzend-section-visible');
        } else {
            $('[data-control=' + controlName + ']').parent().addClass('appzend-section-visible').removeClass('appzend-section-hidden');
        }
        $('[data-control=' + controlName + ']').children().attr('class', 'dashicons ' + iconClass);
    });
});