<?php
/**
 * Includes all the custom controller classes
 *
 * @param string $file_path , path from the theme
 * @return string full path of file inside theme
 *
 */
/** tabs */
require get_template_directory() .'/inc/custom-controller/toggle-section/toggle-section.php';
require get_template_directory() .'/inc/custom-controller/tab/class-tab-controller.php';
require get_template_directory() .'/inc/custom-controller/seprator/class-seprator.php';
require get_template_directory() .'/inc/custom-controller/repeater/class-repeater.php';
/*cssbox controller*/
require get_template_directory() .'/inc/custom-controller/cssbox/class-control-cssbox.php';
require get_template_directory() .'/inc/custom-controller/gradient/class-gradient.php';

/*buttonset controller*/
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-buttonset.php';
require get_template_directory() .'/inc/custom-controller/buttonset/class-control-responsive-buttonset.php';

require get_template_directory() .'/inc/custom-controller/alpha-color/class-alpha-color.php';
require get_template_directory() .'/inc/custom-controller/background-control/background-control.php';
require get_template_directory() .'/inc/custom-controller/color-tab/color-tab.php';
require get_template_directory() .'/inc/custom-controller/heading/heading.php';
require get_template_directory() .'/inc/custom-controller/range-slider/range-slider.php';
require get_template_directory() .'/inc/custom-controller/range/class-range.php';
require get_template_directory() .'/inc/custom-controller/font-awesome-icon/font-awesome-icon.php';