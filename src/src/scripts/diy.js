import { each } from "jquery";
import {mobilePredNextButtons} from "./functions";
import {desctopPredNextButtons} from "./functions";

jQuery(document).ready(function ($) {

	var diyTabContent = $('.js-mobile-tab-container');
	if ($(diyTabContent).length) {
		if ($(window).width() < 992) {
			$(diyTabContent).find('.tab-block__wrapper').removeClass('open');
		}
	}

	// click and check mobile diy header menu
	$('.js-mobile-tab-btn').on('click', function() {
		$(this).siblings('.js-mobile-tab-btn').removeClass('active');
		$(this).addClass('active');
		$('.js-uncheck-diy-header-btn').removeClass('not-active');
		$('.js-mobile-tab-text-img').fadeOut();
		$($(this).attr('data-id')).siblings('.tab-block__wrapper').removeClass('open');
		$($(this).attr('data-id')).addClass('open');
		$('html, body').animate({scrollTop : 0},800);

		var mainContainer, navContainer, buttonPrev, buttonNext, elemWidth = 0;

		mainContainer = document.querySelector($(this).attr('data-id'));
		navContainer = mainContainer.getElementsByClassName('tab-block__wrapper--image-content');
		buttonPrev = mainContainer.getElementsByClassName('tab-block__wrapper--image-wrap__prev');
		buttonNext = mainContainer.getElementsByClassName('tab-block__wrapper--image-wrap__next');

		var navContainerChild = navContainer[0].children;

		// for margin-right: 16px 
		// I sum all childrens with 16px without the last
		elemWidth += ((navContainerChild.length - 1) * 16);
		for (var i = 0; i < navContainerChild.length; i++) {
			elemWidth += navContainerChild[i].offsetWidth;
		}

		mobilePredNextButtons($(navContainer[0]), $(buttonPrev[0]), $(buttonNext[0]), elemWidth);
	});

	// desktop tab navigation
	if($('.tab-block__buttons-content').length >= 1) {
		
		desctopPredNextButtons($('.tab-block__buttons-content'), $('.tab-block__buttons-content').siblings('.tab-block__buttons-prev'), $('.tab-block__buttons-content').siblings('.tab-block__buttons-next'));
	}

	// tab buttons
	$('.tab-block__buttons-content .tab-block__buttons-content--button').on('click', function () {
		var tabAttr = $(this).attr("data-id");

		$("#" + tabAttr).siblings('.tab-block__wrapper').each(function () {
			$(this).removeClass('open');
			if ($(this).find('.caro-wrap').length >= 1) {
				$(this).find('.caro-wrap').removeClass('active');
			}
		});
		$(this).siblings('.tab-block__buttons-content--button').each(function () {
			$(this).removeClass('active');
		});

		$(this).addClass('active');
		$("#" + tabAttr).addClass('open');

		if ($("#" + tabAttr).find('.caro-wrap').length >= 1) {
			$("#" + tabAttr).find('.caro-wrap').addClass('active');

			var arr = new Array();
			$("#" + tabAttr).find('.caro-wrap').children().each(function () {
				arr.push($(this).attr('id'));
			});

			if (arr.length > 0 && arr.length <= 2) {

				var carousel = ("#" + arr[0]).toString(),
					carouselNav = ("#" + arr[1]).toString();

				carouselById(carousel, carouselNav, false);
			}
		}
	});

	// uncheck and click mobile diy header menu
	$('.js-uncheck-diy-header-btn').on('click', function() {
		$(this).addClass('not-active');
		$('.js-mobile-tab-btn').removeClass('active');
		$('.js-mobile-tab-text-img').fadeIn();
		$('.js-mobile-tab-container').find('.tab-block__wrapper').removeClass('open');
	});

	// open mobile modal with detach element
	$('.js-modal-diy-btn').on('click', function() {
		var modalId = $(this).attr('data-target'),
				detachedArea = $($(this).attr('data-area-id')).find('.js-diy-detached-div');

		$(modalId).find('.modal-title').text($(this).html());
		$(modalId).find('.js-close-diy-modal-btn').attr('data-area-id', $(this).attr('data-area-id'));
		$(modalId).find('.modal-body').empty().append($(detachedArea).detach());
	});

	// close mobile modal with return detached element
	$('.js-close-diy-modal-btn').on('click', function () {
		var detachedArea = $(this).parents('.modal-header').siblings('.modal-body').find('.js-diy-detached-div');
		$($(this).attr('data-area-id')).append($(detachedArea).detach());
	});

	
});