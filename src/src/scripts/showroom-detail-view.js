import {each} from "jquery";
import {carouselById} from "./functions";
import {mobilePredNextButtons} from "./functions";

jQuery(document).ready(function ($) {

	//swich carosels
	if ($('.js-switch-carosel-mobile-wrap').length >= 1) {
		if ($(window).width() >= 992) {
			if ($('.js-switch-carosel-mobile').has('showroom-detail-product__carousel')) {
				carouselById('.showroom-detail-product__carousel', '.showroom-detail-product__carousel-nav', false);
			} else {
				$('.js-switch-carosel-mobile').removeClass('video-caro').addClass('showroom-detail-product__carousel');
				carouselById('.showroom-detail-product__carousel', '.showroom-detail-product__carousel-nav', false);
			}
		} else {
			if ($('.js-switch-carosel-mobile').has('showroom-detail-product__carousel')) {
				$('.js-switch-carosel-mobile').removeClass('showroom-detail-product__carousel').addClass('video-caro');
			}
		}
	}

	//get menu top position
	var productNavTopPosition = 0;
	var productTabPaneTopPosition = 0;

	if ($('.product-nav').length >= 1) {

		setTimeout(() => {
			// productNavTopPosition = $('.product-nav-wrap__content').offset().top;
			productNavTopPosition = $(".product-nav")[0].getBoundingClientRect().top;
			productTabPaneTopPosition = Math.round($($('.product-nav__link').attr('href')).offset().top);
		}, 200);
	}

	$(window).on({
		resize: function () {

			if ($('.product-nav').length >= 1) {
				setTimeout(() => {
					// productNavTopPosition = $('.product-nav-wrap__content').offset().top;
					productNavTopPosition = $(".product-nav")[0].getBoundingClientRect().top;
					productTabPaneTopPosition = Math.round($($('.product-nav__link').attr('href')).offset().top);
				}, 200);
			}

			if ($(window).width() >= 992) {
				if ($('.js-switch-carosel-mobile').has('showroom-detail-product__carousel')) {
					carouselById('.showroom-detail-product__carousel', '.showroom-detail-product__carousel-nav', false);
				} else {
					$('.js-switch-carosel-mobile').removeClass('video-caro').addClass('showroom-detail-product__carousel');
					carouselById('.showroom-detail-product__carousel', '.showroom-detail-product__carousel-nav', false);
				}
			} else {
				if ($('.js-switch-carosel-mobile').has('showroom-detail-product__carousel')) {
					$('.js-switch-carosel-mobile').removeClass('showroom-detail-product__carousel').addClass('video-caro');
				}
			}
		},
		scroll: function () {
			var scroll = $(window).scrollTop();

			if ($(window).width() <= 992) {
				// console.log(productNavTopPosition);

				if (Math.round(scroll) >= Math.round(productNavTopPosition)) {
					$('.product-nav-wrap').addClass('fixed-nav');
				} else {
					$('.product-nav-wrap').removeClass('fixed-nav');
				}
			}
		}
	});


	// mobile menu
	var $productNav = $('.product-nav');
	if ($productNav.length === 1) {
		var elemWidth = 0;
		$($productNav).find('.nav-item').each(function () {
			elemWidth += $(this).width();
		});

		mobilePredNextButtons($('.product-nav'), $('.product-nav-wrap__prev'), $('.product-nav-wrap__next'), Math.round(elemWidth));
	}

	$('.js-show-hiden-options').on('click', function () {
		if ($(window).width() <= 992) {
			$(this).siblings('.tab-content__options--content').toggle(500);
		}
	});


	$('.tab-content__specifications--subheading').on('click', function () {
		if ($(this).hasClass('toggled')) {
			$(this).removeClass('toggled');
			$(this).find('.tab-content__specifications--subheading-icon-plus').fadeOut(100);
			$(this).find('.tab-content__specifications--subheading-icon-minus').fadeIn(100);
		} else {
			$(this).addClass('toggled');
			$(this).find('.tab-content__specifications--subheading-icon-plus').fadeIn(100);
			$(this).find('.tab-content__specifications--subheading-icon-minus').fadeOut(100);
		}

		$(this).parents('.js-specifications-subheading').siblings('.col-12').toggle(100);
		$(this).parents('.js-specifications-subheading_v2').siblings('.col-12').toggle(200);
	});


	$('.js-open-specifications-tab-btn').on('click', function () {
		$(this).siblings().removeClass('active');

		if ($(this).hasClass('active')) {
			$($(this).attr('data-open-description')).addClass('active').siblings().removeClass('active');
		} else {
			$(this).addClass('active');
			$($(this).attr('data-open-description')).addClass('active').siblings().removeClass('active');
		}
	});

	$('.js-set-red-bg').on('click', function () {
		$('.js-set-red-bg').removeClass('red-bg');		
		$(this).toggleClass('red-bg');		
	});

	$('#icon_1').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 1 + ".png" )
	});
	$('#icon_2').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 2 + ".png" )
	});
	$('#icon_3').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 3 + ".png" )
	});
	$('#icon_4').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 4 + ".png" )
	});
	$('#icon_5').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 5 + ".png" )
	});
	$('#icon_6').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 6 + ".png" )
	});
	$('#icon_7').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 7 + ".png" )
	});
	$('#icon_8').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 8 + ".png" )
	});
	$('#icon_9').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 9 + ".png" )
	});
	$('#icon_10').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 10 + ".png" )
	});
	$('#icon_11').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 11 + ".png" )
	});
	$('#icon_12').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 12 + ".png" )
	});
	$('#icon_13').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 13 + ".png" )
	});
	$('#icon_14').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 14 + ".png" )
	});
	$('#icon_15').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 15 + ".png" )
	});
	$('#icon_16').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 16 + ".png" )
	});
	$('#icon_17').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 17 + ".png" )
	});
	$('#icon_18').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 18 + ".png" )
	});
	$('#icon_19').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 19 + ".png" )
	});
	$('#icon_20').on('click', function () {
		$('#img-from-icons').attr( "src", "images/showroom-detail-view-product" + 20 + ".png" )
	});
	$('#icon_21').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 1 + ".png" )
	});
	$('#icon_22').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 2 + ".png" )
	});
	$('#icon_23').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 3 + ".png" )
	});
	$('#icon_24').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 4 + ".png" )
	});
	$('#icon_25').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 5 + ".png" )
	});
	$('#icon_26').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 6 + ".png" )
	});
	$('#icon_27').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 7 + ".png" )
	});
	$('#icon_28').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 8 + ".png" )
	});
	$('#icon_29').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 9 + ".png" )
	});
	$('#icon_30').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 10 + ".png" )
	});
	$('#icon_31').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 11 + ".png" )
	});
	$('#icon_32').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 12 + ".png" )
	});
	$('#icon_33').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 13 + ".png" )
	});
	$('#icon_34').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 14 + ".png" )
	});
	$('#icon_35').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 15 + ".png" )
	});
	$('#icon_36').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 16 + ".png" )
	});
	$('#icon_37').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 17 + ".png" )
	});
	$('#icon_38').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 18 + ".png" )
	});
	$('#icon_39').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 19 + ".png" )
	});
	$('#icon_40').on('click', function () {
		$('#img-from-icons2').attr( "src", "images/showroom-detail-view-product" + 20 + ".png" )
	});
	$('#icon_41').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 1 + ".png" )
	});
	$('#icon_42').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 2 + ".png" )
	});
	$('#icon_43').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 3 + ".png" )
	});
	$('#icon_44').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 4 + ".png" )
	});
	$('#icon_45').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 5 + ".png" )
	});
	$('#icon_46').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 6 + ".png" )
	});
	$('#icon_47').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 7 + ".png" )
	});
	$('#icon_48').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 8 + ".png" )
	});
	$('#icon_49').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 9 + ".png" )
	});
	$('#icon_50').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 10 + ".png" )
	});
	$('#icon_51').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 11 + ".png" )
	});
	$('#icon_52').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 12 + ".png" )
	});
	$('#icon_53').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 13 + ".png" )
	});
	$('#icon_54').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 14 + ".png" )
	});
	$('#icon_55').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 15 + ".png" )
	});
	$('#icon_56').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 16 + ".png" )
	});
	$('#icon_57').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 17 + ".png" )
	});
	$('#icon_58').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 18 + ".png" )
	});
	$('#icon_59').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 19 + ".png" )
	});
	$('#icon_60').on('click', function () {
		$('.tab-content__specifications--description-content').fadeOut()
		$('#img-from-icons3').removeClass("d-none")
		$('#img-from-icons3').attr( "src", "images/showroom-detail-view-product" + 20 + ".png" )
	});





	if ($('.showroom-detail-product-nav .nav-link').length >= 1) {
		var activeNavLinkAttr = $('.showroom-detail-product-nav .nav-link.active');

		if (typeof $(activeNavLinkAttr).attr('data-more-information') !== typeof undefined && $(activeNavLinkAttr).attr('data-more-information') !== false) {
			$($(activeNavLinkAttr).attr('data-more-information')).addClass('active');
			$($(activeNavLinkAttr).attr('data-more-information')).siblings('.showroom-detail-product__more-informations').removeClass('active');
		} else {
			$('.showroom-detail-product__more-informations').removeClass('active');
		}
	}


	$('.showroom-detail-product-nav .nav-link').on('click', function () {
		if (typeof $(this).attr('data-more-information') !== typeof undefined && $(this).attr('data-more-information') !== false) {
			$($(this).attr('data-more-information')).addClass('active');
			$($(this).attr('data-more-information')).siblings('.showroom-detail-product__more-informations').removeClass('active');
		} else {
			$('.showroom-detail-product__more-informations').removeClass('active');
		}
	});


	$('.js-show-hiden-installations-btn').on('click', function () {
		if ($(window).width() <= 992) {
			$(this).parents('.product-dyi-installer').siblings('.product-dyi-installer').find('.js-show-hiden-installations').fadeOut();
			$(this).parents('.product-dyi-installer').find('.js-show-hiden-installations').toggle(300);

			$('html, body').animate({
				scrollTop: (($('.js-acordeon-scroll-position').offset().top) - 200)
			}, 800);
		}
	});


	$('.js-filter-fix-body').on('click', function () {

		if ($(window).width() <= 992) {
			$('body').toggleClass('modal-open_custom');

			if ($('header').hasClass('nav-down')) {
				$('header').toggleClass('nav-up');
			}
		}
	});


	$('.js-clear-filter').on('click', function () {
		$(this).parents('.js-filters-box').find('.js-defaulf-state').each(function () {
			if (!$(this).hasClass('selected')) {
				$(this).addClass('selected').siblings().removeClass('selected');
				$(this).parents('.my-custom-select').find('.my-custom-select__trigger span').text($(this).text());
			}
		});
		$(this).parents('.js-filters-box').find('input[type=text]').val('');
	});

	function iOS() {
		return [
				'iPad Simulator',
				'iPhone Simulator',
				'iPod Simulator',
				'iPad',
				'iPhone',
				'iPod'
			].includes(navigator.platform)
			// iPad on iOS 13 detection
			|| (navigator.userAgent.includes("Mac") && "ontouchend" in document)
	}

	iOS();


	function scrollToTargetAnimation(target, offset) {
		if (iOS()) {
			// window.scrollTop(productNavTopPosition - 150);
			$('html, body', parent.document).animate({
				scrollTop: (($(target).parents('.product-collapse-container').find('[data-target="pills-tabContent"]').offset().top) - offset)
			}, 400);
		} else {
			$('html, body').animate({
				scrollTop: (($(target).parents('.product-collapse-container').find('[data-target="pills-tabContent"]').offset().top) - offset)
			}, 400);
		}
	}

	function scrollToTargetCompare(target, fixedOffset, nonFixedOffset) {
		if ($(target).hasClass('product-nav__link') && $(target).parents('.fixed-nav').length > 0) {
			scrollToTargetAnimation(target, fixedOffset)

		} else if ($(target).hasClass('product-nav__link') && $(target).parents('[data-nav="showroom-detail-product-nav"]').length > 0) {
			scrollToTargetAnimation(target, nonFixedOffset)
		}
	}

	function scrollToTarget(target) {
		if ($(target).parents('.showroom-detail__page').length > 0) {
			console.log('showroom-detail__page');
			scrollToTargetCompare(target, 60, 120)
		} else if ($(target).parents('.product-detail__page').length > 0) {
			console.log('product-detail__page');
			scrollToTargetCompare(target, 112, 170)
		}
	}


	window.addEventListener('click', function (e) {
		if ($(window).width() <= 992) {
			let target = e.target;
			scrollToTarget(target)
		}
	})

	$('.slick-slider').on('click', function () {
		$(".image-bg-detail-view").fadeOut();
	})

	$('.product-nav__link').on('click', function () {
		$(".image-bg-detail-view").removeClass("d-b__a");
	})
	$('.product-nav__link.tab-details').on('click', function () {
		$(".image-bg-detail-view").addClass("d-b__a");
	})
	
	// selected features product item image
	$('.phantom-actions__dropdowns.accordion.nd .no-popup .feature-detail__item-drop').on('click', function () {
		$(".selected-item-box").removeClass("selected-item-box");
		$(this).toggleClass("selected-item-box");
	})


	$('.hover-btn__v2').on('mouseover', function(){
		$(this).parent().addClass('is-hover');
	  }).on('mouseout', function(){
		$(this).parent().removeClass('is-hover');
	})

	// show the eye in parent item
	$('.phantom-actions__dropdowns.accordion.nd .no-popup .feature-product__item-image').on('click', function () {
		$(".no-popup .feature-product__item-image").addClass("opacity__style");
		$(this).removeClass("opacity__style");
	})

	$('.no-popup .feature-detail__item-drop ').on('click', function () {
		$(".no-popup .feature-detail__item-drop").removeClass("selected-item-box__new");
		$(this).toggleClass("selected-item-box__new");
	})

	$('.phantom-actions__dropdowns.accordion.nd .drop_detail__items').on('click', function () {
		$(".phantom-actions__dropdowns.accordion.nd .drop_detail__items").removeClass("hide_eye");
	})

	$('.sec-feature-one .feature-detail__item-drop').on('click', function () {
		$(".sec-feature-one .selected-item-box").removeClass("selected-item-box");
		$(this).toggleClass("selected-item-box");
	})
	$('.sec-feature-two .feature-detail__item-drop').on('click', function () {
		$(".sec-feature-two .selected-item-box").removeClass("selected-item-box");
		$(this).toggleClass("selected-item-box");
	})
	$('.sec-feature-three .feature-detail__item-drop').on('click', function () {
		$(".sec-feature-three .selected-item-box").removeClass("selected-item-box");
		$(this).toggleClass("selected-item-box");
	})
	$('.sec-feature-four .feature-detail__item-drop').on('click', function () {
		$(".sec-feature-four .selected-item-box").removeClass("selected-item-box");
		$(this).toggleClass("selected-item-box");
	})




	$('.sec-feature-one .feature-product__item-image').on('click', function () {
		$(".sec-feature-one .feature-product__item-image").addClass("opacity__style");
		$(this).removeClass("opacity__style");
	})
	$('.sec-feature-two .feature-product__item-image').on('click', function () {
		$(".sec-feature-two .feature-product__item-image").addClass("opacity__style");
		$(this).removeClass("opacity__style");
	})
	$('.sec-feature-three .feature-product__item-image').on('click', function () {
		$(".sec-feature-three .feature-product__item-image").addClass("opacity__style");
		$(this).removeClass("opacity__style");
	})
	$('.sec-feature-four .feature-product__item-image').on('click', function () {
		$(".sec-feature-four .feature-product__item-image").addClass("opacity__style");
		$(this).removeClass("opacity__style");
	})

	$('.margin-none .sec-one .a__simple').on('click', function () {
		$(".sec-one .selected-item-box__new").removeClass("selected-item-box__new");
	})
	$('.margin-none .sec-two .a__simple').on('click', function () {
		$(".sec-two .selected-item-box__new").removeClass("selected-item-box__new");
	})
	$('.margin-none .sec-three .a__simple').on('click', function () {
		$(".sec-three .selected-item-box__new").removeClass("selected-item-box__new");
	})
	$('.margin-none .sec-four .a__simple').on('click', function () {
		$(".sec-four .selected-item-box__new").removeClass("selected-item-box__new");
	})




	$('#collapseFeature-11').on('click', function () {
		$(".dropdown-one .active").addClass("selected-item-box");
		$(".dropdown-one").removeClass("hide_eye");
		$(".dropdown-one").removeClass("opacity__style");
	})

	$('#collapseFeature-12').on('click', function () {
		$(".sec-one .active").addClass("selected-item-box");
		$(".sec-one").removeClass("hide_eye");
		$(".sec-one").removeClass("opacity__style");
	})
	$('#collapseFeature-13').on('click', function () {
		$(".sec-two .active").addClass("selected-item-box");
		$(".sec-two").removeClass("hide_eye");
		$(".sec-two").removeClass("opacity__style");
	})
	$('#collapseFeature-14').on('click', function () {
		$(".sec-three .active").addClass("selected-item-box");
		$(".sec-three").removeClass("hide_eye");
		$(".sec-three").removeClass("opacity__style");
	})
	$('#collapseFeature-15').on('click', function () {
		$(".sec-four .active").addClass("selected-item-box");
		$(".sec-four").removeClass("hide_eye");
		$(".sec-four").removeClass("opacity__style");
	})


	//for dropdown item in popup idea folder
	$('.sec-one').on('mouseover', function(){
		$('.sec-one .hover-btn__v2.v3_a').addClass('show-btn');
	  }).on('mouseout', function(){
		$('.sec-one .hover-btn__v2.v3_a').removeClass('show-btn');
	})
	$('.sec-two').on('mouseover', function(){
		$('.sec-two .hover-btn__v2.v3_a').addClass('show-btn');
	  }).on('mouseout', function(){
		$('.sec-two .hover-btn__v2.v3_a').removeClass('show-btn');
	})
	$('.sec-three').on('mouseover', function(){
		$('.sec-three .hover-btn__v2.v3_a').addClass('show-btn');
	  }).on('mouseout', function(){
		$('.sec-three .hover-btn__v2.v3_a').removeClass('show-btn');
	})
	$('.sec-four').on('mouseover', function(){
		$('.sec-four .hover-btn__v2.v3_a').addClass('show-btn');
	  }).on('mouseout', function(){
		$('.sec-four .hover-btn__v2.v3_a').removeClass('show-btn');
	})


	$('.hover-btn__v2.v3_a').on('click', function () {
		$(this).addClass("is-hover_v2");
	})


	$('.sec-one').on('click', function () {
		$(".sec-one .hover-btn__v2.v3_a").addClass("show-btn");
	})
	$('.sec-two').on('click', function () {
		$(".sec-two .hover-btn__v2.v3_a").addClass("show-btn");
	})
	$('.sec-three').on('click', function () {
		$(".sec-three .hover-btn__v2.v3_a").addClass("show-btn");
	})
	$('.sec-four').on('click', function () {
		$(".sec-four .hover-btn__v2.v3_a").addClass("show-btn");
	})

	
	$('.hover-btn__v2.v3_a').on('click', function () {
		$(this).toggleClass("icon-rotate");
	})

	$('.modal-save-to-specs-sheet .right-side .sec-feature-one .a__simple').on('click', function () {
		$(".sec-one .icon-rotate").toggleClass("icon-rotate");
		$(".sec-one .is-hover_v2").toggleClass("is-hover_v2");
		$("#collapseFeature-12 .selected-item-box-popup").removeClass("selected-item-box-popup");
	})
	$('.modal-save-to-specs-sheet .right-side .sec-feature-two .a__simple').on('click', function () {
		$(".sec-two .icon-rotate").toggleClass("icon-rotate");
		$(".sec-two .is-hover_v2").toggleClass("is-hover_v2");
		$("#collapseFeature-13 .selected-item-box-popup").removeClass("selected-item-box-popup");
	})
	$('.modal-save-to-specs-sheet .right-side .sec-feature-three .a__simple').on('click', function () {
		$(".sec-three .icon-rotate").toggleClass("icon-rotate");
		$(".sec-three .is-hover_v2").toggleClass("is-hover_v2");
		$("#collapseFeature-14 .selected-item-box-popup").removeClass("selected-item-box-popup");
	})
	$('.modal-save-to-specs-sheet .right-side .sec-feature-four .a__simple').on('click', function () {
		$(".sec-four .icon-rotate").toggleClass("icon-rotate");
		$(".sec-four .is-hover_v2").toggleClass("is-hover_v2");
		$("#collapseFeature-15 .selected-item-box-popup").removeClass("selected-item-box-popup");
	})

	$('#collapseFeature-12 .feature-product__item-image').on('click', function () {
		$(".sec-one .feature-detail__item-drop").addClass("selected-item-box");
		$(".sec-one").removeClass("opacity__style");
		$("#collapseFeature-12 .selected-item-box-popup").removeClass("selected-item-box-popup");
		$(this).addClass("selected-item-box-popup");
		$("#collapseFeature-12 .popup-save-sheet").removeClass("opacity__style");
	})
	$('#collapseFeature-13 .feature-product__item-image').on('click', function () {
		$(".sec-two .feature-detail__item-drop").addClass("selected-item-box");
		$(".sec-two").removeClass("opacity__style");
		$("#collapseFeature-13 .selected-item-box-popup").removeClass("selected-item-box-popup");
		$(this).addClass("selected-item-box-popup");
		$("#collapseFeature-13 .popup-save-sheet").removeClass("opacity__style");
	})
	$('#collapseFeature-14 .feature-product__item-image').on('click', function () {
		$(".sec-three .feature-detail__item-drop").addClass("selected-item-box");
		$(".sec-three").removeClass("opacity__style");
		$("#collapseFeature-14 .selected-item-box-popup").removeClass("selected-item-box-popup");
		$(this).addClass("selected-item-box-popup");
		$("#collapseFeature-14 .popup-save-sheet").removeClass("opacity__style");
	})
	$('#collapseFeature-15 .feature-product__item-image').on('click', function () {
		$(".sec-four .feature-detail__item-drop").addClass("selected-item-box");
		$(".sec-four").removeClass("opacity__style");
		$("#collapseFeature-15 .selected-item-box-popup").removeClass("selected-item-box-popup");
		$(this).addClass("selected-item-box-popup");
		$("#collapseFeature-15 .popup-save-sheet").removeClass("opacity__style");
	})
	



	//show popup "i" info box

	if ($(window).width() > 900) {
		$('.showroom-detail-view-product-page.idea-folder').on('mouseover', function(){
			$(".info-popup-idea-folder-big").fadeIn(0);
		  }).on('mouseout', function(){
			$(".info-popup-idea-folder-big").fadeOut(0);
		})
		$('.showroom-detail-view-product-page.save-to-specs-sheet').on('mouseover', function(){
			$(".info-popup-spec-folder-big").fadeIn(0);
		  }).on('mouseout', function(){
			$(".info-popup-spec-folder-big").fadeOut(0);
		})

		$('.idea-folder.__square').on('mouseover', function(){
			$(this).find(".info-popup-idea-folder.__square").fadeIn(0);
			$(".info-popup-idea-folder-big").fadeOut(0);
		  }).on('mouseout', function(){
			$(".info-popup-idea-folder.__square").fadeOut(0);
			$(".info-popup-idea-folder-big").fadeOut(0);
		})
		$('.save-to-specs-sheet.__square').on('mouseover', function(){
			$(this).find('.info-popup-spec-folder.__square').fadeIn(0);
			$(".info-popup-spec-folder-big").fadeOut(0);
		  }).on('mouseout', function(){
			$(".info-popup-spec-folder.__square").fadeOut(0);
			$(".info-popup-spec-folder-big").fadeOut(0);
		})

		$('.save-to-specs-sheet.mini_v2').on('mouseover', function(){
			$(".info-popup-spec-folder").fadeIn(0);
			$(".info-popup-spec-folder-big").fadeOut(0);
		  }).on('mouseout', function(){
			$(".info-popup-spec-folder").fadeOut(0);
			$(".info-popup-spec-folder-big").fadeOut(0);
		})
		$('.idea-folder.mini_v2').on('mouseover', function(){
			$(".info-popup-idea-folder").fadeIn(0);
			$(".info-popup-idea-folder-big").fadeOut(0);
		  }).on('mouseout', function(){
			$(".info-popup-idea-folder").fadeOut(0);
			$(".info-popup-idea-folder-big").fadeOut(0);
		})
	}
	
	
	//show-hide popup "i" info box for mobile
	$(".popup-info-box").hover(function(){
		$(".popup-info-content-mobile").fadeIn(0);
		}, function(){
		$(".popup-info-content-mobile").fadeOut(0);
	});

	// $(".popup-info-box").on("click", function () {
	// 	$(".popup-info-content-mobile").addClass("show")
	// })
	// $('.close-popup-content-mobile').on('click', function () {
	// 	$('.popup-info-content-mobile').fadeOut(0);
	// })



	// show-hide popup dropdown filter
	$('.modal-save-to-specs-sheet .dropdown__filter').on('mouseover', function(){
		$(this).addClass('open');
	  }).on('mouseout', function(){
		$(this).removeClass('open');
	})

	$(".house .custom-checkbox").click(function(){
		var house = $(this).val();
		$(".house .dropdown-label__filter").text(house);
	  });

	$(".room .custom-checkbox").click(function(){
	var room = $(this).val();
	$(".room .dropdown-label__filter").text(room);
	$(".room").removeClass("val");
	});

	$(".confirm").click(function(){
		$(".val").addClass('-red');
	});

	//mobile

	if ($(window).width() < 992) {
		$(".room").click(function(){
			$(this).toggleClass('open');
		});
		$(".house").click(function(){
			$(this).toggleClass('open');
		});
	}

	if ($(window).height() > 740) {
		var rowHeight = $(window).height()
		$('.right-side').css("max-height", rowHeight - 218);
	}

	
});
