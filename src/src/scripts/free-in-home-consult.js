import {each} from "jquery";

jQuery(document).ready(function ($) {

	// open first part of free in home consult form
	$('#js-mobile-first-home-consult-form-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		//add heading
		$(modalId)
			.find('h5#mobile-first-home-consult-form-title .js-heading').empty()
			.append($('#js-mobile-first-home-consult-form').find('h4.home-consult-form__heading').text());

		//add form
		$(modalId).find('.modal-body').empty().append($('#js-mobile-first-home-consult-form').clone());

		if (!$('body').hasClass('modal-open')) {
			$('body').addClass('modal-open_custom');
		}
	});

	$('#js-mobile-modal-first-home-consult-form-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		//add heading
		$(modalId)
			.find('h5#mobile-first-home-consult-form-title .js-heading').empty()
			.append($('#js-mobile-first-home-consult-form').find('h4.home-consult-form__heading').text());

		//add form
		$(modalId).find('.modal-body').empty().append($('#js-mobile-first-home-consult-form').clone());

		if (!$('body').hasClass('modal-open')) {
			$('body').addClass('modal-open_custom');
		}
	});

	// open second part of free in home consult form
	$('#js-mobile-second-home-consult-form-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		//add heading
		$(modalId).find('h5#mobile-second-home-consult-form-title .js-heading').empty()
			.append($('#js-mobile-second-home-consult-form').find('h4.home-consult-form__heading').not('.bordered-heading').text());

		$(modalId).find('.modal-body').empty().append($('#js-mobile-second-home-consult-form').clone());

		$('body').addClass('modal-open_custom');
	});

	$('#js-mobile-modal-second-home-consult-form-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		//add heading
		$(modalId).find('h5#mobile-second-home-consult-form-title .js-heading').empty()
			.append($('#js-mobile-second-home-consult-form').find('h4.home-consult-form__heading').not('.bordered-heading').text());

		$(modalId).find('.modal-body form').empty().append($('#js-mobile-second-home-consult-form').clone());

		$('body').addClass('modal-open_custom');
	});

	// open third part of free in home consult form
	$('#js-mobile-third-home-consult-form-btn').on('click', function () {
		var modalId = $(this).attr('data-target');

		//add heading
		$(modalId).find('h5#mobile-third-home-consult-form-title .js-heading').empty()
			.append($('#js-mobile-third-home-consult-form').find('h4.home-consult-form__heading').not('.bordered-heading').text());

		$(modalId).find('.modal-body').empty().append($('#js-mobile-third-home-consult-form').clone());

		$('body').addClass('modal-open_custom');
	});

	$('#js-mobile-home-consult-form-submit-btn').on('click', function (e) {
		e.preventDefault();
		$('.modal-title').find('.js-heading').empty();
		$('.modal-body').empty();
		$('body').removeClass('modal-open_custom');
	});

	function scrollFormToCenter() {

		setTimeout(() => {
			document.getElementById('home-consult-form').scrollIntoView({
				behavior: 'smooth',
				block: "center"
			})
		}, 700)
	}

	// close free in home consult form
	$('.free-in-home-consults-modal-close').on('click', function (e) {
		e.preventDefault();
		$('.modal-title').find('.js-heading').empty();
		$('.modal-body form').empty();
		$('body').removeClass('modal-open_custom');
	});

	//show the first part of desktop form
	$('#js-desktop-first-home-consult-form-btn').on('click', function () {
		$(this).closest('.js-open-form').fadeOut(300);
		$('.home-consult-form').addClass('active');
		$('.home-consult-form').find('.first-content').addClass('opened active').fadeIn(500);
		$('#js-desktop-first-home-consult-nav-btn').removeAttr('disabled').addClass('visited active');

		scrollFormToCenter()
	});

	$('#js-desktop-first-home-consult-nav-btn').on('click', function () {
		$(this).closest('.home-consult-form__wrapper').find('.first-content').addClass('opened active').fadeIn(500).siblings('.home-consult-form__content').removeClass('opened active').fadeOut(300);
		$(this).addClass('active').siblings('button').removeClass('visited active').attr('disabled', 'disabled');
	});

	// show the second part of desktop form
	$('#js-desktop-second-home-consult-form-btn').on('click', function () {
		$(this).closest('.first-content').removeClass('active').fadeOut(300);
		$(this).closest('.third-content').siblings('.home-consult-form__content').removeClass('active').fadeOut(300);
		$(this).closest('.first-content').siblings('.second-content').addClass('opened active').fadeIn(500);
		$('#js-desktop-second-home-consult-nav-btn').removeAttr('disabled').addClass('visited active').siblings('button').removeClass('active');

		scrollFormToCenter()
	});

	$('#js-desktop-second-home-consult-nav-btn').on('click', function () {
		$(this).closest('.home-consult-form__wrapper').find('.second-content').addClass('opened active').fadeIn(500).siblings('.home-consult-form__content').fadeOut(300);
		$(this).addClass('active').siblings('#js-desktop-third-home-consult-nav-btn').removeClass('visited active').attr('disabled', 'disabled');
	});

	//show the third part of desktop form
	$('#js-desktop-third-home-consult-form-btn').on('click', function () {
		$(this).closest('.second-content').removeClass('active').fadeOut(300);
		$(this).closest('.third-content').siblings('.home-consult-form__content').removeClass('active').fadeOut(300);
		$(this).closest('.second-content').siblings('.third-content').addClass('opened active').fadeIn(500);
		$('#js-desktop-third-home-consult-nav-btn').removeAttr('disabled').addClass('visited active').siblings('button').removeClass('active');

		scrollFormToCenter()
	});

	// last form button
	$('#js-desktop-last-home-consult-form-btn').on('click', function () {
		$(this).closest('.third-content').removeClass('opened active').fadeOut(300);
		$(this).closest('.third-content').siblings('.home-consult-form__content').removeClass('active').removeClass('opened').fadeOut(300);
		$(this).parents('.home-consult-form').find('.home-consult-form__nav--button').removeClass('visited active').attr('disabled', 'disabled');
		$(this).parents('.home-consult-form').removeClass('active');
		$('.js-open-form').fadeIn(500);
	});
});
