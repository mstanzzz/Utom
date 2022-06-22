import {carouselById} from "./functions";
import {each} from "jquery";

jQuery(document).ready(function ($) {

	var productDetail = $('.product-detail .caro-wrap');
	var specificationLoad = $('#tab-content-1');
	var showroomDetailView = $('.showroom-detail-view-carousel');

	//include header, footer, modals and snippets
	$('#header').load('./html-snippets/header.html');
	$('#footer').load('./html-snippets/footer.html');
	$('#modal-custom-fixed-element-info-employee').load('./modals/modal-custom-fixed-element-info-employee.html');
	$('#modal-alert-confirmation').load('./modals/modal-alert-confirmation.html');
	$('#modal-delete').load('./modals/modal-delete.html');
	$('#modal-e-sign-dialog').load('./modals/modal-e-sign-dialog.html');
	$('#modal-free-shipping').load('./modals/modal-free-shipping.html');
	$('#modal-manage-saved-houses').load('./modals/modal-manage-saved-houses.html');
	$('#modal-mobile-campany-block').load('./modals/modal-mobile-campany-block.html');
	$('#modal-mobile-products-block').load('./modals/modal-mobile-products-block.html');
	$('#modal-mobile-team-block').load('./modals/modal-mobile-team-block.html');
	$('#modal-mobile-time-line').load('./modals/modal-mobile-time-line.html');
	$('#modal-new-house').load('./modals/modal-new-house.html');
	$('#modal-perfect-fit-guarantee').load('./modals/modal-perfect-fit-guarantee.html');
	$('#modal-save-to-idea-folder').load('./modals/modal-save-to-idea-folder.html');
	$('#modal-save-to-specs-sheet').load('./modals/modal-save-to-specs-sheet.html');
	$('#virtual-assistant').load('./html-snippets/virtual-assistant.html');
	$('#mobile-show-footer-buttons').load('./html-snippets/mobile-show-footer-buttons.html');

	// function to hide search wrapper and overlay
	function hideSeaechWrapper(e) {
		var el = e.target.closest('#search-form-wrapper');
		if (!el) {
			$('#overlay-search').removeClass('open');
			$('#search-form-wrapper').removeClass('open');
			document.removeEventListener('click', hideSeaechWrapper);
		}
	}

	//show header search form
	$('#show-search-form').on('click', function () {
		$('#overlay-search').addClass('open');
		$('#search-form-wrapper').addClass('open');
		setTimeout(function () {
			document.addEventListener('click', hideSeaechWrapper);
		});
	});

	//after desctop login 
	$('.js-account-login').on('click', function () {
		$(this).css('display', 'none');
		$(this).siblings('.account-menu-visible').css('display', 'none');
		$(this).siblings('.account-menu-hidden').css('display', 'block');
		$(this).parents('.js-account-wrap').find('.dropdown-toggle.account').addClass('login');
		$(this).parents('.js-account-wrap').find('.account-name').css('display', 'inline-block');
	});

	//after desctop log out
	$('.js-account-logout').on('click', function () {
		$(this).css('display', 'none');
		$(this).siblings('.account-menu-visible').css('display', 'block');
		$(this).siblings('.account-menu-hidden').css('display', 'none');
		$(this).parents('.js-account-wrap').find('.dropdown-toggle.account').removeClass('login')
		$(this).parents('.js-account-wrap').find('.account-name').css('display', 'none');
	});


	//hide covid section
	$('.js-hide-covit').on('click', function () {
		$(this).parents('.covid-header').remove();
		$('.header-covid').removeClass('header-covid');
		$('.covid-block').removeClass('covid-block');
	});

	var navDropDown = $('.second-header__logo-nav--grop-down');	

	if ($(navDropDown).length) {
		if ($(window).width() > 992) {
			$(navDropDown).hover(function () {
				$(this).find('.dropdown-wrap').addClass('active');
			}, function () {
				$(this).find('.dropdown-wrap').removeClass('active');
			});
		} else {
			var clickSpan = $(navDropDown).find('span');
			$(clickSpan).on('click', function () {
				if ($(this).hasClass('clickSpan')) {
					$(this).removeClass('clickSpan');
					$(this).find('.icon__minus').hide();
					$(this).find('.icon__plus').show();
					$(this).siblings('.dropdown-wrap').removeClass('active');
				} else {
					$(this).addClass('clickSpan');
					$(this).find('.icon__minus').show();
					$(this).find('.icon__plus').hide();
					$(this).siblings('.dropdown-wrap').addClass('active');
				}
			});
		}
	}

	function slickInit() {
		$('.carousel-har').not('.slick-initialized').slick({
			dots: true,
			infinite: false,
			arrows: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			rows: 1,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 992,
					settings: 'unslick'
				}
			]
		}).on('afterChange', function () {
			$('.yvideo').each(function () {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
		});
	}

	// 
	function slickInitOrganizer() {
		$('.organizer-caro').not('.slick-initialized').slick({
			dots: false,
			arrows: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 992,
					settings: 'unslick'
				}
			]
		}).on('afterChange', function () {
			$('.yvideo').each(function () {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
		});
	}

	function slickInitVideo() {
		$('.video-caro').not('.slick-initialized').slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 992,
					settings: 'unslick'
				}
			]
		}).on('afterChange', function () {
			$('.yvideo').each(function () {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
		});

		$('.video-second-caro').not('.slick-initialized').slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			responsive: [
				{
					breakpoint: 992,
					settings: 'unslick'
				}
			]
		}).on('afterChange', function () {
			$('.yvideo').each(function () {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
		});
	}

	function slickInitServises() {
		$('.services-caro').not('.slick-initialized').slick({
			dots: false,
			arrows: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			mobileFirst: true,
			infinite: false,
			responsive: [
				{
					breakpoint: 992,
					settings: 'unslick'
				}
			]
		}).on('afterChange', function () {
			$('.yvideo').each(function () {
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
		});
	}

	setTimeout(function () {
		slickInit();
		slickInitOrganizer();
		slickInitVideo();
		slickInitServises();
	}, 100);


	if ($('.video-block__videos').length >= 1) {
		if ($(window).width() > 992) {
			if ($('.video-block__videos').find('.embed-responsive').hasClass('embed-responsive-4by3')) {
				$('.embed-responsive').removeClass('embed-responsive-4by3').addClass('embed-responsive-16by9');
			}
		} else {
			if ($('.video-block__videos').find('.embed-responsive').hasClass('embed-responsive-16by9')) {
				$('.embed-responsive').removeClass('embed-responsive-16by9').addClass('embed-responsive-4by3');
			}
		}
	}

	// document load set padding on main tag by height on image
	$(window).on({
		resize: function () {

			setTimeout(function () {
				//add functions here to fire on resize
				slickInit();
				slickInitOrganizer();
				slickInitVideo();
				slickInitServises();
				initSomeCarousels()
			}, 100)

			if ($('.video-block__videos').length >= 1) {
				if ($(window).width() > 992) {
					if ($('.video-block__videos').find('.embed-responsive').hasClass('embed-responsive-4by3')) {
						$('.embed-responsive').removeClass('embed-responsive-4by3').addClass('embed-responsive-16by9');
					}
				} else {
					if ($('.video-block__videos').find('.embed-responsive').hasClass('embed-responsive-16by9')) {
						$('.embed-responsive').removeClass('embed-responsive-16by9').addClass('embed-responsive-4by3');
					}
				}
			}

			var productDetail = $('.product-detail .caro-wrap');
			if (productDetail.length >= 1) {
				carouselById('.product-detail__carousel', '.product-detail__carousel-nav', false);
			}

			var specificationLoad = $('#tab-content-1');
			if (specificationLoad.length >= 1) {
				carouselById("#js-carousel-1", "#js-carousel-nav-1", false);
			}

			var showroomDetailView = $('.showroom-detail-view-carousel');
			if (showroomDetailView.length >= 1) {
				carouselById('.showroom-detail-view-carousel', '.showroom-detail-view-carousel-nav', true);
			}

			if ($(window).width() > 992) {

				// remove sticky class nav up
				var navUp = $('header');
				if ($(navUp).hasClass('nav-up')) {
					$(navUp).removeClass('nav-up');
				}

				if ($(navUp).hasClass('small-header')) {
					$(navUp).removeClass('small-header');
				}

				if ($(navUp).find('.hide-element').length >= 1) {
					$(navUp).find('.hide-element').removeClass('hide-element');
				}

				if ($('.home-active-fixed').length >= 1) {
					$('.home-active-fixed').removeClass('home-active-fixed');
				}

				if ($('body').hasClass('position-fixed')) {
					$('body').removeClass('position-fixed');
				}
			} else {
				if ($('.scrollToTopBlock').length >= 1) {
					$('.scrollToTopBlock').fadeOut();
				}
			}

		},
		scroll: function () {
			var scroll = $(window).scrollTop();

			if ($(window).width() > 992) {
				if (scroll > 300) {
					$('.scrollToTopBlock').fadeIn();
				} else {
					$('.scrollToTopBlock').fadeOut();
				}
			}
		},
		orientationchange: function (event) {

			setTimeout(function () {
				//add functions here to fire on resize
				slickInit();
				slickInitOrganizer();
				slickInitVideo();
				slickInitServises();
			}, 100);

			var productDetail = $('.product-detail .caro-wrap');
			if (productDetail.length >= 1) {
				carouselById('.product-detail__carousel', '.product-detail__carousel-nav', false);
			}

			var specificationLoad = $('#tab-content-1');
			if (specificationLoad.length >= 1) {
				carouselById("#js-carousel-1", "#js-carousel-nav-1", false);
			}

			var showroomDetailView = $('.showroom-detail-view-carousel');
			if (showroomDetailView.length >= 1) {
				carouselById('.showroom-detail-view-carousel', '.showroom-detail-view-carousel-nav', true);
			}
		}
	});

	function initSomeCarousels() {
		if (productDetail.length >= 1) {
			carouselById('.product-detail__carousel', '.product-detail__carousel-nav', false);
		}


		if (specificationLoad.length >= 1) {
			carouselById("#js-carousel-1", "#js-carousel-nav-1", false);
		}


		if (showroomDetailView.length >= 1) {
			carouselById('.showroom-detail-view-carousel', '.showroom-detail-view-carousel-nav', true);
		}
	}

	initSomeCarousels()

	//Click footer to top button
	$('.js-to-top').on('click', function () {
		$('html, body').animate({scrollTop: 0}, 800);
		return false;
	});

	// Category switch between list view and thumb view
	$('.js-switch-list-view').on('click', function () {
		$(this).addClass('active');
		$(this).siblings('button').removeClass('active');

		if ($(this).attr('data-type') === 'js-thumb') {
			$('.js-list-category')
				.addClass('category-block__thumb')
				.find('.col-12')
				.addClass('col-md-4');
		} else {
			$('.js-list-category')
				.removeClass('category-block__thumb')
				.find('.col-12')
				.removeClass('col-md-4');
		}
	});
	// Category switch between list view and thumb view
	$('.js-switch-list-view-sm').on('click', function () {
		$(this).addClass('active');
		$(this).siblings('button').removeClass('active');

		if ($(this).attr('data-type') === 'js-thumb') {
			$('.js-list-category')
				.addClass('category-block__thumb')
				.find('.col-12')
				.addClass('col-sm-6 col-md-3 col-lg-2');
		} else {
			$('.js-list-category')
				.removeClass('category-block__thumb')
				.find('.col-12')
				.removeClass('col-sm-6 col-md-3 col-lg-2');
		}
	});

	//Expand more category by click on the 6 button
	$(".expand-button").click(function (e) { // click event for load more
		e.preventDefault();

		$(this).removeClass('expand-button')
			.addClass('d-none')
			.siblings('a.link-button')
			.removeClass('d-none');

		$(".hidden-box:hidden").slice(0, 6).addClass('open');
	});

	//hamburger mobile menu
	// function hideMobileMenu(e) {
	// 	var el = e.target.closest('.second-header__logo-nav--navigation');
	// 	if (!el) {
	// 		$('#overlay-mobile-nav').removeClass('open');
	// 		$('.second-header__logo-nav--navigation').removeClass('active');
	// 		$('body').css('overflow','auto');
	// 		document.removeEventListener('click', hideMobileMenu);
	// 	}
	// }

	$('.js-hamburger').on('click', function () {
		$('.second-header__logo-nav--navigation').addClass('active');
		$('#overlay-mobile-nav').addClass('open');
		$('body').css('overflow', 'hidden');
		if ($('header').hasClass('nav-up')) {
			$('header').removeClass('nav-up').addClass('nav-down');
		}
		// setTimeout(function() {
		// 	document.addEventListener('click', hideMobileMenu);
		// });
	});

	$('.js-hide-general-mobile-menu').on('click', function () {
		$('#overlay-mobile-nav').removeClass('open');
		$('.second-header__logo-nav--navigation').removeClass('active');
		$('body').css('overflow', 'auto');

		// setTimeout(function() {
		// 	document.addEventListener('click', hideMobileMenu);
		// });
	});

	//third header menu click
	$('.js-home-top-button').on('click', function () {
		$(this).siblings('button').each(function () {
			$(this).removeClass('active');
			$('#' + $(this).attr('data-value')).removeClass('home-active-fixed');
		});

		if ($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('#' + $(this).attr('data-value')).removeClass('home-active-fixed');
			$('.first-header').removeClass('hide-element');
			$('.covid-header').removeClass('hide-element');
			$('header').removeClass('small-header');
			$('body').removeClass('position-fixed');
		} else {
			$(this).addClass('active');
			$('#' + $(this).attr('data-value')).addClass('home-active-fixed');
			$('.first-header').addClass('hide-element');
			$('.covid-header').addClass('hide-element');
			$('header').addClass('small-header');
			$('body').addClass('position-fixed');
		}
	});

	//show text button
	$('.js-btn-view-all-text').on('click', function () {
		$(this).toggleClass('active');
		var scrollToEl = Math.round($(this).closest('div').siblings('.js-show-text').offset().top);

		if ($(this).hasClass('active')) {
			$(this).closest('div').siblings('.js-show-text').addClass('show-text');
			$(this).find('span').text($(this).attr('data-readLess'));
		} else {
			$(this).closest('div').siblings('.js-show-text').removeClass('show-text');
			$(this).find('span').text($(this).attr('data-readAll'));
			$('html, body').animate({scrollTop: scrollToEl - 130}, 800);
		}
	});

	function hideModal(e) {
		var el = e.target.closest('#js-mobile-show-modal');
		if (!el) {
			$('#js-mobile-show-modal').removeClass('active');
			document.removeEventListener('click', hideModal);
		}
	}

	//open modal for block with background
	$('#js-btn-mobile-show-modal').on('click', function () {
		$('#js-mobile-show-modal').addClass('active');
		setTimeout(function () {
			document.addEventListener('click', hideModal);
		});
	});

	// open showroom detail view
	$('.js-showroom-detail-view-btn').on('click', function () {
		$(this).closest('figcaption.showroom-detail-block__images').siblings('div.showroom-detail-view-block').addClass('active');
		$('body').addClass('modal-open_custom');
	});

	$('.js-showroom-detail-view-btn-siblings').on('click', function () {
		$(this).siblings('div.showroom-detail-view-block').addClass('active');
		$('body').addClass('modal-open_custom');
	});

	// hide showroom detail view
	$('.js-showroom-detail-close-btn').on('click', function () {
		$(this).parent('div.showroom-detail-view-block').removeClass('active');
		$('body').removeClass('modal-open_custom');
	});

	// show mobile fax a desing plan modals
	$('.js-mobile-fax-design-content-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		$(modalId).find('.modal-title').empty().text($(this).text());
		$(modalId).find('.modal-body .row').empty().append($($(this).attr('date-content-class-open')).detach());
		if ($(this).attr('date-content-class-open') === '.js-sample-fax-form') {
			$(modalId).find('.modal-body .row').addClass('flex-column-reverse');
			$(modalId).find('.two-elements-block__wrapper--content').addClass('mt-0 mb-3');
		} else {
			$(modalId).find('.modal-body .row').removeClass('flex-column-reverse');
		}
		$(modalId).find('.modal-body h2').remove();
		$(modalId).find('.js-close-fax-design').attr('date-content-class-close', $(this).attr('date-content-class-open'));
		$(modalId).find('.two-elements-block__wrapper--link-block').addClass('flex-row');
		$(modalId).find('.js-btn-view-all-text').remove();
		$(modalId).find('.js-show-text').css('text-align', 'left').removeClass('small-text');
		$(modalId).find('.you-design').addClass('modal-fax-design-btn').siblings('.we-design').addClass('modal-fax-design-btn');
		$(modalId).find('.two-elements-block__wrapper--stars').addClass('mt-0');
	});

	$('.js-close-fax-design').on('click', function () {
		var modalBody = $(this).parents('.modal-header').siblings('.modal-body');
		if (($(this).attr('date-content-class-close') === '.js-sample-fax-form') || ($(this).attr('date-content-class-close') === 'js-read-review')) {
			$('.js-first-fax-design').find('.row').append($(modalBody).find($(this).attr('date-content-class-close')).detach());
		} else {
			$('.js-second-fax-design').find('.row').append($(modalBody).find($(this).attr('date-content-class-close')).detach());
		}
	});

	$('.js-only-close-fax-design').on('click', function () {
		$(this).parents('.modal-body').siblings('.modal-header').find('.js-close-fax-design').trigger('click')
	});
	document.body.addEventListener("click", function (event) {
		if ($(event.target).hasClass('js-delete-uploaded-img')) {
			var clickedBtn = $(event.target),
				modalId = clickedBtn.attr('data-target');

			$(modalId).find('.js-delete-uploaded-img-btn').attr(
				{
					'data-image-name': '.' + clickedBtn.attr('data-image-name'),
					'data-target': '#mobile-fax-design'
				});
		}
	});

	$('.js-delete-uploaded-img-btn').on('click', function () {
		var deletedRow = $(this).attr('data-image-name'),
			modalId = $(this).attr('data-target');

		$(modalId).find(deletedRow).parents('tr').remove();
	});

	//show all desktop footer menu
	$('.js-show-all-footer-menu-btn').on('click', function () {
		if ($(window).width() >= 992) {
			var $wrap = $(this).parents('.js-show-all-footer-menu');

			$(this).hide();
			$wrap.find('.first-footer__wrapper-button').css('display', 'none');
			$wrap.find('.first-footer__navivation').addClass('show-all-menu', 100, 'swing');
			$wrap.find('.hidden-footer-menu-item').show(100);
			$wrap.find('.js-hide-all-footer-menu-btn').addClass('show-btn', 100, 'swing');
		}
	});

	//hide desktop footer menu
	$('.js-hide-all-footer-menu-btn').on('click', function () {
		if ($(window).width() >= 992) {
			var $wrap = $(this).parents('.js-show-all-footer-menu');

			$(this).removeClass('show-btn', 110, 'swing');
			$wrap.find('.first-footer__wrapper-button').css('display', 'flex');
			$wrap.find('.first-footer__navivation').removeClass('show-all-menu', 110, 'swing');
			$wrap.find('.hidden-footer-menu-item').hide();
			$wrap.find('.js-show-all-footer-menu-btn').show(100);
		}
	});

	// show mobile footer nav
	$('.js-show-mobile-footer-menu-btn').on('click', function () {
		if ($(window).width() <= 992) {
			$(this).siblings('.first-footer__navivation').toggle(300);
			$(this).parents('.col-12.col-lg-6.col-xl-3').siblings('.col-12.col-lg-6.col-xl-3').find('.first-footer__navivation').hide(300);
		}
	});
});

