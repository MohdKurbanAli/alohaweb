/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 function appzend_set_dynamic_css(control, style) {
    jQuery('style.' + control).remove();
    jQuery('head').append( '<style class="' + control + '">' + style + '</style>' );
}
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );

	wp.customize( 'appzend-button-text', function( value ) {
		value.bind( function( to ) {
			$( 'a.customize-unpreviewable' ).text( to );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( val ) {
			$('body').css('background-color', val );
		} );
	} );


	//Update menu background color...
	wp.customize( 'appzend_menu_bg', function( value ) {
		value.bind( function( val ) {
			$('.site-header').css('background-color', val );
		} );
	} );

	// update menu text color
	wp.customize( 'appzend_menu_text_color', function( value ) {
		value.bind( function( val ) {
			$('.box-header-nav .main-menu .menu-item a').css('color', val );
		} );
	} );

	// update header button background color
	wp.customize( 'appzend_button_bg_color', function( value ) {
		value.bind( function( val ) {
			var bg_color = "background-color:" + val + "!important";
			$('head').append("<style>.extralmenu-item .right-btn a{" + bg_color + "}</style>");
		});
	});

	// update header button text color
	wp.customize( 'appzend_button_text_color', function( value ) {
		value.bind( function( val ) {
			var text_color = "color:" + val + "!important";
			$('head').append("<style>.extralmenu-item .right-btn a{" + text_color + "}</style>");
		});
	});

	// update header button background color
	wp.customize( 'appzend_button_bg_hov_color', function( value ) {
		value.bind( function( val ) {
			$('.extralmenu-item .right-btn a:hover').css('background-color', val );
		} );
	} );

	// update header button background color
	wp.customize( 'appzend_button_text_hov_color', function( value ) {
		value.bind( function( val ) {
			$('.extralmenu-item .right-btn a:hover').css('color', val );
		} );
	} );
	

	wp.customize('appzend_button_enable', function (value) {
		value.bind( function() {
			if ('disable' === value.get() ) {
				$('.customize-unpreviewable').hide();
			} else {
				$('.customize-unpreviewable').show();
			}
		} );
    });	

	wp.customize('appzend_menu_relative', function (value) {
		value.bind( function() {
			if ('disable' === value.get() ) {
				$('.site-header').css('position', 'absolute');
			} else {
				$('.site-header').css('position', 'relative');
			}
		} );
    });	

	wp.customize('appzend_menu_sticky', function (value) {
		value.bind( function() {
			if ('disable' === value.get() ) {
				$('.site-header').css('position', 'absolute');
			} else {
				$('.site-header').css('position', 'fixed');
			}
		} );
    });	

	wp.customize('appzend-button-url', function (value) {
		value.bind( function( to ) {
			$('.customize-unpreviewable').attr('href', to);
		} );
    });	

	wp.customize('appzend-button-open-link-new-tab', function (value) {
		value.bind( function( to ) {
			if( to === true ) {
				$('.customize-unpreviewable').attr('target', '_blank');
			} else {
				$('.customize-unpreviewable').attr('target', '_self');
			}
		} );
    });	

	wp.customize('appzend-button-class', function (value) {
		value.bind( function ( to ) {
			var classes = 'right-btn ' + to;
			$('.extralmenu-item>div').attr( 'class', classes);
		} );
    });

	wp.customize('appzend_slider_title_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content h1' ).css( 'color', to );
		} );
    });

	wp.customize('appzend_slider_subtitle_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content p' ).css( 'color', to );
		} );
    });

	wp.customize('appzend_slider_caption_button_bg_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a' ).css( 'background-color', to );
		} );
    });

	wp.customize('appzend_slider_caption_button_border_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a' ).css( 'border', '1px solid' + to );
		} );
    });

	wp.customize('appzend_slider_caption_button_text_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a' ).css( 'color', to );
		} );
    });
	
	wp.customize('appzend_slider_caption_button_bg_hov_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a:hover' ).css( 'background-color', to );
		} );
    });

	wp.customize('appzend_slider_caption_button_border_hov_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a:hover' ).css( 'border', '1px solid' + to );
		} );
    });

	wp.customize('appzend_slider_caption_button_text_hov_color', function (value) {
		value.bind( function ( to ) {
			$( '.bannerwrap .slider-content a:hover' ).css( 'color', to );
		} );
    });
	
	wp.customize('appzend_slider_margin', function (value) {
		value.bind( function ( to ) {
			slider_margin = JSON.parse( to );
			$( '.bannerslider' ).css( {"margin-top": slider_margin.desktop.top + "px" ,"margin-right": slider_margin.desktop.right + "px","margin-bottom": slider_margin.desktop.bottom + "px","margin-left": slider_margin.desktop.left + "px"} );
		} );
    });

	wp.customize('appzend_slider_padding', function (value) {
		value.bind( function ( to ) {
			slider_padding = JSON.parse( to );
			$( '.bannerslider' ).css( {"padding-top": slider_padding.desktop.top + "px" ,"padding-right": slider_padding.desktop.right + "px","padding-bottom": slider_padding.desktop.bottom + "px","padding-left": slider_padding.desktop.left + "px"} );
		} );
    });

	// slider height desktop
	wp.customize('appzend_slider_height', function (value) {
		value.bind( function ( to ) {
			$( '.bannerslider' ).css( 'height', to + "px" );
		} );
    });

	// slider height tablet
	wp.customize('appzend_slider_height_tablet', function (value) {
		value.bind( function ( to ) {
			if( ( $( window ).width() >= 700 ) && ( $( window ).width() < 992 ) ) {
				$( '.bannerslider' ).css( 'height', to + "px" );
			}
		} );
	});
	
	// slider height mobile
	wp.customize('appzend_slider_height_mobile', function (value) {
		value.bind( function ( to ) {
			if( $( window ).width() < 500 ) {
				$( '.bannerslider' ).css( 'height', to + "px" );
			}
		} );
	});

	jQuery(document).ready( function() {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
			console.log( placement );
			var p_p_id = placement.partial.id;
			if ( p_p_id === 'appzend_slider_ss' || 
				 p_p_id === 'productcat_category' ||
				 p_p_id === 'productcat_category_view' || 
				 p_p_id === 'productcat_column' || 
				 p_p_id === 'producttype_category_view' || 
				 p_p_id === 'producttype_category' || 
				 p_p_id === 'producttype_column' || 
				 p_p_id === 'producttype_no_of_product' || 
				 p_p_id === 'producthotoffer_category' || 
				 p_p_id === 'producthotoffer_category_view' || 
				 p_p_id === 'producthotoffer_per_page' ||
				 p_p_id === 'producthotoffer_column' ||
				 p_p_id === 'appzend_productcat_layout' ) {
				var brtl = false;
    			if (jQuery("body").hasClass('rtl')) brtl = true;
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
								animateIn: 'flipInX',
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
				}
		  } );
	});

	wp.customize( 'appzend_menu_alignment', function ( value ) {
		value.bind( function( to ) {
			var align = JSON.parse( to );
			var remove_css = 'text-left text-center text-right tablet-text-left tablet-text-center tablet-text-right mobile-text-left mobile-text-center mobile-text-right';
			var apply_css = '';
			if( ( align.desktop != '' ) && ( align.desktop !== undefined ) ) {
				apply_css = apply_css + align.desktop; 
			} 
			if( ( align.tablet != '' ) && ( align.tablet !== undefined ) ) {
				apply_css = apply_css + ' tablet-' + align.tablet;
			} 
			if( ( align.mobile != '' ) && ( align.mobile !== undefined ) ) {
				apply_css = apply_css + ' mobile-' + align.mobile;
			} 
			$( '.site-header' ).removeClass( remove_css ).addClass( apply_css );
		});
	});
	
	// create custom associative array
	var section_selector = { 
		'appzend_highlight_service' : '#highlight-service-section', 
		'appzend_features_service'  : '#get-started', 
		'appzend_aboutus'           : '#aboutus',
		'appzend_calltoaction'      : '#app-cta',
		'appzend_howitworks'        : '#app-how-it-works',
		'appzend_recentwork'        : '#app-portfolio',
		'appzend_service'           : '#appzend-service-section',
		'appzend_productcat'        : '#cl-productcat-section',
		'appzend_producttype'       : '#cl-producttype-section',
		'appzend_producthotoffer'   : '#cl-hotoffer-section', 
	}; 

	$.each( section_selector, function( section, selector ) {
		wp.customize( section + '_section', function ( value ) {
			value.bind( function ( to ) {
				if( to === 'enable' ) {
					$( selector ).css( 'display', 'block' );
				} else {
					$( selector ).css( 'display', 'none' );
				}
			});
		});

		wp.customize( section + '_super_title', function ( value ) {
			value.bind( function ( to ) {
				if ( $( selector + ' .headlines:nth-of-type(1)' ).find("h4").length === 1 ) {
					$( selector + ' .headlines:nth-of-type(1) h4' ).text( to );
				} else {
					$( selector + ' .headlines:nth-of-type(1)' ).prepend( "<h4>" + to + "</h4>" );
				}
			});
		});

		wp.customize( section + '_title', function ( value ) {
			value.bind( function ( to ) {
				if ( $( selector + ' .headlines:nth-of-type(1)' ).find("h2").length === 1 ) {
					$( selector + ' .headlines:nth-of-type(1) h2' ).text( to );
				} else {
					if ( $( selector + ' .headlines:nth-of-type(1)' ).find("h4").length === 1 ) {
						$( "<h2>" + to + "</h2>" ).insertAfter( selector + ' .headlines:nth-of-type(1) h4' );
					} else {
						$( selector + ' .headlines:nth-of-type(1)' ).prepend( "<h2>" + to + "</h2>" );
					}
				}
			});
		});

		wp.customize( section + '_sub_title', function ( value ) {
			value.bind( function ( to ) {
				if ( $( selector + ' .headlines:nth-of-type(1)' ).find("p").length === 1 ) {
					$( selector + ' .headlines:nth-of-type(1) p' ).text( to );
				} else {
					$( selector + ' .headlines:nth-of-type(1)' ).append( "<p>" + to + "</p>" );
				}
			});
		});

		wp.customize( section + '_super_title_color', function ( value ) {
			value.bind( function ( to ) {
				$( selector + ' .headlines h4' ).css( 'color', to );
			});
		});

		wp.customize( section + '_title_color', function ( value ) {
			value.bind( function ( to ) {
				$( selector + ' .headlines h2' ).css( 'color', to );
			});
		});

		wp.customize( section + '_subtitle_color', function ( value ) {
			value.bind( function ( to ) {
				$( selector + ' .headlines p' ).css( 'color', to );
			});
		});

		wp.customize( section + '_margin', function (value) {
			value.bind( function ( to ) {
				var section_margin = JSON.parse( to );
				$( selector ).css( {"margin-top": section_margin.desktop.top + "px" ,"margin-right": section_margin.desktop.right + "px","margin-bottom": section_margin.desktop.bottom + "px","margin-left": section_margin.desktop.left + "px"} );
			} );
		});

		wp.customize( section + '_padding', function (value) {
			value.bind( function ( to ) {
				var section_padding = JSON.parse( to );
				$( selector ).css( {"padding-top": section_padding.desktop.top + "px" ,"padding-right": section_padding.desktop.right + "px","padding-bottom": section_padding.desktop.bottom + "px","padding-left": section_padding.desktop.left + "px"} );
			} );
		});


		// background color 
		wp.customize( section + '_bg_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					var gradient = wp.customize(section + '_bg_color').get();
					var css = selector + '{' + gradient + '}';
                    appzend_set_dynamic_css(section +'_bg_gradient', css);
				}
			} );
		});

		wp.customize( section + '_box_bg_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box' ).css( 'background-color', to );
				}
			} );
		});

		wp.customize( section + '_icon_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box .box-icon' ).css( 'color', to );
				}
			});
		});

		wp.customize( section + '_box_title_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box .box-title' ).css( 'color', to );
				}
			} );
		});

		wp.customize( section + '_text_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box .box-content' ).css( 'color', to );
				}
			} );
		});

		wp.customize( section + '_bg_hov_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					if( section === 'appzend_howitworks' ) {
						$( selector + ' .section-box:hover' ).css( 'background', to );
					} else {
						$( selector + ' .section-box:hover' ).css( 'background-color', to );
					}
				}
			});
		});

		wp.customize( section + '_icon_hov_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box:hover .box-icon' ).css( 'color', to );
				}
			} );
		});

		wp.customize( section + '_title_hov_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box:hover .box-title' ).css( 'color', to );
				}
			} );
		});

		wp.customize( section + '_text_hov_color', function (value) {
			value.bind( function ( to ) {
				if( to ) {
					$( selector + ' .section-box:hover .box-content' ).css( 'color', to );
				}
			} );
		});

		wp.customize(  section + '_alignment', function ( value ) {
			value.bind( function( to ) {
				var align = JSON.parse( to );
				var remove_css = 'text-left text-center text-right tablet-text-left tablet-text-center tablet-text-right mobile-text-left mobile-text-center mobile-text-right';
				var apply_css = '';
				if( ( align.desktop != '' ) && ( align.desktop !== undefined ) ) apply_css = apply_css + align.desktop; 
				if( ( align.tablet != '' ) && ( align.tablet !== undefined ) ) apply_css = apply_css + ' tablet-' + align.tablet;
				if( ( align.mobile != '' ) && ( align.mobile !== undefined ) ) apply_css = apply_css + ' mobile-' + align.mobile;
				$( selector ).removeClass( remove_css ).addClass( apply_css );
			});
		});

	});

	wp.customize( 'appzend_calltoaction_image', function ( value ) {
		value.bind( function ( to ) {
			if( to === '' ) {
				$( '#app-cta' ).removeAttr( "style" );
			} else {
				$( '#app-cta' ).css( 'background-image', 'url(' + to + ')' );
			}			
		});
	});

	wp.customize( 'appzend_producttype_layout', function ( value ) {
		value.bind( function ( to ) {
			console.log( to );
			$( '#cl-producttype-section .cl-section-wrap .product-list-area .sparkletabs' ).removeClass( 'tab_styleone tab_styletwo tab_stylethree' ).addClass( to );
		});
	});	

	wp.customize( 'appzend_highlight_service_image', function ( value ) {
		value.bind( function ( to ) {
			$( '.center-b img' ).attr( 'src', to );
		});
	});

	wp.customize( 'appzend_highlight_service_layout', function ( value ) {
		value.bind( function ( to ) {
			$( '#highlight-service-section' ).removeClass( 'layout-one layout-two' ).addClass( to );
		});
	});

	wp.customize( 'appzend_producthotofer_offer_text', function ( value ) {
		value.bind( function ( to ) {
			$( '.pcountdown-cnt-list-slider' ).html( to );
		});
	});

	wp.customize( 'appzend_aboutus_email_address', function ( value ) {
		value.bind( function ( to ) {
			$( '#aboutus .address-info ul li:first-of-type a' ).text( to );
		});
	});

	wp.customize( 'appzend_aboutus_phone_number', function ( value ) {
		value.bind( function ( to ) {
			$( '#aboutus .address-info ul li:nth-of-type(2) a' ).text( to );
		});
	});

	wp.customize( 'appzend_howitworks_image', function ( value ) {
		value.bind( function( to ) {
			$( '.right-img img' ).attr( 'src', to );
		});
	});

	wp.customize( 'appzend_site_layout', function ( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'full_width boxed' ).addClass( to );
		});
	});

	wp.customize( 'appzend_breadcrumbs_image', function ( value ) {
		value.bind( function( to ) {
			$( '.breadcrumb' ).css( 'background-image', 'url(' + to + ')' );
		});
	});	

	wp.customize( 'appzend_calltoaction_button', function ( value ) {
		value.bind( function( to ) {
			var cta_btn1_link = wp.customize( 'appzend_calltoaction_link' ).get();
			if( $( '#app-cta .calltoaction_button_wrap a.cta-btn1' ).length === 1 ) {
				$( '#app-cta .calltoaction_button_wrap a.cta-btn1' ).text( to );
			} else {
				if( $( '#app-cta .calltoaction_button_wrap a.cta-btn2' ).length === 1 ) {
					$( '#app-cta .calltoaction_button_wrap' ).prepend( "<a href='"+ cta_btn1_link +"' class='btn btn-primary cta-btn1'>" + to + "</a>" );
				} else {
					var first_link = "<div class='calltoaction_button_wrap'>" + 
									  "<a href='"+ cta_btn1_link +"' class='btn btn-primary cta-btn1'>" + to + "</a>" + 
									 "</div>";
					$( '#app-cta .calltoaction_full_widget_content' ).append( first_link );
				}
			}
		});
	});
	
	wp.customize( 'appzend_calltoaction_link', function ( value ) {
		value.bind( function( to ) {
			$( '#app-cta .calltoaction_button_wrap a.cta-btn1' ).attr( 'href', to );
		});
	});	

	wp.customize( 'appzend_calltoaction_button_one', function ( value ) {
		value.bind( function( to ) {
			var cta_btn2_link = wp.customize( 'appzend_calltoaction_link_one' ).get();
			if( $( '#app-cta .calltoaction_button_wrap a.cta-btn2' ).length === 1 ) {
				$( '#app-cta .calltoaction_button_wrap a.cta-btn2' ).text( to );
			} else {
				if( $( '#app-cta .calltoaction_button_wrap a.cta-btn1' ).length === 1 ) {
					$( '#app-cta .calltoaction_button_wrap' ).append( "<a href='"+ cta_btn2_link +"' class='btn btn-primary btn-border cta-btn2'>" + to + "</a>" );
				} else {
					var second_link = "<div class='calltoaction_button_wrap'>" + 
									  "<a href='"+ cta_btn2_link +"' class='btn btn-primary btn-border cta-btn2'>" + to + "</a>" + 
									 "</div>";
					$( '#app-cta .calltoaction_full_widget_content' ).append( second_link );
				}
			}
		});
	});
	
	wp.customize( 'appzend_calltoaction_link_one', function ( value ) {
		value.bind( function( to ) {
			$( '#app-cta .calltoaction_button_wrap a.cta-btn2' ).attr( 'href', to );
		});
	});

	wp.customize( 'appzend_slider_overlay_color', function ( value ) {
		value.bind( function( to ) {
			$('head').append("<style>.bannerwrap::after{ background: " + to + " }</style>");
		});
	});

	wp.customize( 'appzend_service_icon_and_before_color', function ( value ) {
		value.bind( function( to ) {
			$('head').append("<style>.get-started-item i.icon:hover{" + to + "}</style>");
		});
	});

	
}( jQuery ) );