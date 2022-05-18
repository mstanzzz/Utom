import { each } from "jquery";
import 'jquery-ui';

jQuery(document).ready(function ($) {

	// clicl some filters checkbox to show clear button
	$('.js-add-product-filter').on('click', function() {
		var clickedCheckbox = $(this),
				checkboxWrapper = $(this).parents('.js-product-filters');

		$(this).parents('.dropdown').removeClass('open');

		if($(clickedCheckbox).is(':checked')) {
			
			if ($(checkboxWrapper).find('input[type="checkbox"]:checked').length >= 1) {
				$('.js-clear-all-product-filters').css('display','block');
			} else {
				$('.js-clear-all-product-filters').css('display','none');
			}
		}
		else {
			if ($(checkboxWrapper).find('input[type="checkbox"]:checked').length >= 1) {
				$('.js-clear-all-product-filters').css('display','flex');
			} else {
				$('.js-clear-all-product-filters').css('display','none');
			}
		}
	});

	//add to cart for Accesories page
	$('.js-add-to-card-button.accessories-page').on('click', function() {
		if ($(window).width() > 992) {
			var cart = $('.js-add-to-card');
			var imgtodrag = $(this).parents('.product-box').find('.product-image').find('img').eq(0);

			if (imgtodrag) {
				var imgclone = imgtodrag.clone()
				.offset({
					top: imgtodrag.offset().top,
					left: imgtodrag.offset().left
				})
				.css({
					'position': 'absolute',
					'width': imgtodrag.width(),
					'height': imgtodrag.height(),
					'z-index': '10000'
				}, 1000)
				.appendTo($('body'))
				.animate({
					'top': cart.offset().top + 10,
					'left': cart.offset().left + 10,
					'opacity':'0.5',
					'width': '50px',
					'height': '50px',
					'z-index': '100'
				}, 1000);
				
				imgclone.animate({
					'width': 0,
					'height': 0
				}, function() {
					$(this).detach()
				});
			}
		} else {
			var cart = $('.js-add-to-card.mobile');
			var imgtodrag = $(this).parents('.product-box').find('.product-image').find('img').eq(0);
		
			if (imgtodrag) {
				var imgclone = imgtodrag.clone()
				.offset({
					top: imgtodrag.offset().top,
					left: imgtodrag.offset().left
				})
				.css({
					'position': 'absolute',
					'width': imgtodrag.width(),
					'height': imgtodrag.height(),
					'z-index': '10000'
				}, 1000)
				.appendTo($('body'))
				.animate({
					'top': cart.offset().top + 10,
					'left': cart.offset().left + 10,
					'opacity':'0.5',
					'width': '0px',
					'height': '0px',
					'margin-top': '-10px',
					'z-index': '100'
				}, 1000);
				
				imgclone.animate({
					'width': 0,
					'height': 0
				}, function() {
					$(this).detach()
				});
			}
		}
	});

	//add to cart for product detail view page

	$('.js-add-to-card-button').on('click', function() {
		if ($(window).width() > 992) {
			var cart = $('.js-add-to-card');
			var imgtodrag = $('.js-add-to-card-image-holder .slick-current.slick-center').find('img').eq(0);

			if (imgtodrag) {
				var imgclone = imgtodrag.clone()
				.offset({
					top: imgtodrag.offset().top,
					left: imgtodrag.offset().left
				})
				.css({
					'position': 'absolute',
					'width': imgtodrag.width(),
					'height': imgtodrag.height(),
					'z-index': '10000'
				}, 1000)
				.appendTo($('body'))
				.animate({
					'top': cart.offset().top + 10,
					'left': cart.offset().left + 10,
					'opacity':'0.5',
					'width': '50px',
					'height': '50px',
					'z-index': '100'
				}, 1000);
				
				imgclone.animate({
					'width': 0,
					'height': 0
				}, function() {
					$(this).detach()
				});
			}
		} else {
			var cart = $('.js-add-to-card.mobile');
			var imgtodrag = $('.js-add-to-card-image-holder .slick-current.slick-center').find('img').eq(0);

			if (imgtodrag) {
				var imgclone = imgtodrag.clone()
				.offset({
					top: imgtodrag.offset().top,
					left: imgtodrag.offset().left
				})
				.css({
					'position': 'absolute',
					'width': imgtodrag.width(),
					'height': imgtodrag.height(),
					'z-index': '10000'
				}, 1000)
				.appendTo($('body'))
				.animate({
					'top': cart.offset().top + 10,
					'left': cart.offset().left + 10,
					'opacity':'0.5',
					'width': '0px',
					'height': '0px',
					'margin-top': '-10px',
					'z-index': '100'
				}, 1000);
				
				imgclone.animate({
					'width': 0,
					'height': 0
				}, function() {
					$(this).detach()
				});
			}
		}
	});

	$('.js-add-to-card-button').on('click', function() {
		if ($(window).width() > 992) {
			var cart = $('.js-add-to-card');
			var imgtodrag = $('.product-image').find('img').eq(0);

			if (imgtodrag) {
				var imgclone = imgtodrag.clone()
				.offset({
					top: imgtodrag.offset().top,
					left: imgtodrag.offset().left
				})
				.css({
					'position': 'absolute',
					'width': imgtodrag.width(),
					'height': imgtodrag.height(),
					'z-index': '10000'
				}, 1000)
				.appendTo($('body'))
				.animate({
					'top': cart.offset().top + 10,
					'left': cart.offset().left + 10,
					'opacity':'0.5',
					'width': '50px',
					'height': '50px',
					'z-index': '100'
				}, 1000);
				
				imgclone.animate({
					'width': 0,
					'height': 0
				}, function() {
					$(this).detach()
				});
			}
		}
	});


	if ($('.js-text-wrap').length >= 1) {

		var textWrapTop;

		setTimeout(() => {
			textWrapTop = $('.js-text-wrap').find('.tab-content__text-wrap--title').offset().top
		}, 100);
	


	}

	// show hidden text
	$('.js-btn-read-all-text').on('click', function() {
		$(this).toggleClass('active');

		// var titlePosition = $(this).siblings('.js-text-wrap').find('.tab-content__text-wrap--title').offset().top;
		console.log(textWrapTop);

		if($(this).hasClass('active')){
			$(this).siblings('.js-text-wrap').addClass('opened');
			$(this).find('span').text($(this).attr('data-readLess'));
		}
		else {
			$(this).siblings('.js-text-wrap').removeClass('opened').animate({
				scrollTop: -textWrapTop
			}, 800);
			$(this).find('span').text($(this).attr('data-readAll'));
		}
	});

	//button back to filters
	$('.back-to-filters-wrap').hover(
		function () {
			$(this).find('.back-to-filters').addClass('clicked').text($(this).find('.back-to-filters').attr('data-second-text'));
		}, 
		function() {
			$(this).find('.back-to-filters').removeClass('clicked').text($(this).find('.back-to-filters').attr('data-default-text'));
	});
	
	$('.back-to-filters-wrap').on('click', function() {
		if($(this).find('.back-to-filters').hasClass('clicked')) {
			$(this).find('.back-to-filters').removeClass('clicked').text($(this).find('.back-to-filters').attr('data-default-text'));
		} else {
			$(this).find('.back-to-filters').addClass('clicked').text($(this).find('.back-to-filters').attr('data-second-text'));
		}
	});

	// show info-popup-idea-folder
	$('.idea-folder.__square').hover(
		function () {
			$(this).parents('.product-purchase__buttons').find('.parent_idea-folder').addClass('show');
			$(this).parents('.product-purchase__buttons').find('.info-popup-idea-folder').addClass('show');
			$(this).parents('.justify-content-lg-between').find('.info-popup-idea-folder').addClass('show');
		}, 
		function() {
			$(this).parents('.product-purchase__buttons').find('.parent_idea-folder').removeClass('show');
			$(this).parents('.product-purchase__buttons').find('.info-popup-idea-folder').removeClass('show');
			$(this).parents('.justify-content-lg-between').find('.info-popup-idea-folder').removeClass('show');
	});
	$('.save-to-specs-sheet.__square').hover(
		function () {
			$(this).parents('.product-purchase__buttons').find('.parent_spec-folder').addClass('show');
			$(this).parents('.product-purchase__buttons').find('.info-popup-spec-folder').addClass('show');
			$(this).parents('.justify-content-lg-between').find('.info-popup-spec-folder').addClass('show');
		}, 
		function() {
			$(this).parents('.product-purchase__buttons').find('.parent_spec-folder').removeClass('show');
			$(this).parents('.product-purchase__buttons').find('.info-popup-spec-folder').removeClass('show');
			$(this).parents('.justify-content-lg-between').find('.info-popup-spec-folder').removeClass('show');
	});


	// button "Don't Show Again" 
	$('.dontShowAgain').on('click', function() {
		$('.tooltip__save-images.__nd').fadeOut();
		$(".parent_idea-folder").css("display", "none");
		$(".info-popup-idea-folder").addClass("hide-info");
		$(".info-popup-idea-folder-big").addClass("hide-info");
	});
	$('.dontShowAgain_idea').on('click', function() {
		$('.tooltip__save-images.__nd').addClass("hide-info");
		$(".parent_idea-folder").css("display", "none");
		$(".info-popup-idea-folder").addClass("hide-info");
		$(".info-popup-idea-folder-big").addClass("hide-info");
	});
	$('.dontShowAgain_spec').on('click', function() {
		$(".parent_spec-folder").css("display", "none");
		$(".info-popup-spec-folder").addClass("hide-info");	
		$(".info-popup-spec-folder-big").addClass("hide-info");
	});
	
});
