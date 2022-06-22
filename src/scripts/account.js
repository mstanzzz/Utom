import { each } from "jquery";
import {mobilePredNextButtons} from "./functions";

jQuery(document).ready(function ($) {
	
  // clicl account setings buttons to show details
	$('.js-open-hidden-box').on('click', function() {
		if ($(window).width() > 992) {
			$(this).addClass('active').siblings().removeClass('active');
			$($(this).attr('date-open-block')).addClass('active').siblings('.account-block__details').removeClass('active');
			$($(this).attr('date-open-block')).siblings('.account-block__details').find('.account-block__form').removeClass('active');
			$($(this).attr('date-open-block')).siblings('.account-block__details').find('.account-block__details__wrapper--edit-button').show();
		} else {

			if ($(this).hasClass('active')) {
				$(this).removeClass('active').siblings().removeClass('active');
				$(this).siblings('.mobile-show').empty();
			} else {
				$(this).addClass('active').siblings().removeClass('active');
				$(this).siblings('.mobile-show').empty();
				$($(this).attr('date-open-block')).clone().appendTo($($(this).attr('data-open-mobile-block')));
				$($(this).attr('data-open-mobile-block')).find('.account-block__details').fadeIn(300);
			}
		}
	});

	function hideMobileAccountSettingsButtons(e) {
		var el = e.target.closest('.js-show-mobile-action-btn');
		if (!el) {
			$('.js-show-mobile-action-buttons').fadeOut(300);
			document.removeEventListener('click', hideMobileAccountSettingsButtons);
		}
	}

	// show mobile edit and delete buttons
	document.body.addEventListener('click', function(event) {
		if ($(event.target).hasClass('js-show-mobile-action-btn')) {
			var clickedButton = event.target;

			$(clickedButton).parents('.card').siblings().find('.js-show-mobile-action-buttons').each( function () {
				$(this).fadeOut(300);
			});

			$(clickedButton).siblings('.js-show-mobile-action-buttons').fadeIn(300);
			setTimeout(function () {
				document.addEventListener('click', hideMobileAccountSettingsButtons);
			});
		}

		if ($(event.target).hasClass('js-modal-type') || $(event.target).parent().hasClass('js-modal-type')) {
			if ($(event.target).hasClass('js-modal-type')){
				var	modal = $(event.target).attr('data-target'),
						newTextTitle = $(event.target).attr('data-address-type');
			} else {
				var	modal = $(event.target).parent().attr('data-target'),
						newTextTitle = $(event.target).parent().attr('data-address-type');
			}
			
			$(modal).find('.modal-title span').text(newTextTitle);
		}
	});

	// show my-order collapse
	$('.js-show-my-orders').on('click', function () {
		$(this).siblings('button.btn-secondary').show();
		$('.account-block__collapse').addClass('open');
	});

	//hide my-order collapse
	$('.js-hide-my-orders').on('click', function() {
		$(this).hide();
		$('.account-block__collapse').removeClass('open');
	});

	$('.my-order .account-block__collapse--header').on('click', function () {
		if ($(window).width() > 992) {
			if ($(this).hasClass('collapsed')) {
				$(this).find('.js-read-button span').text($(this).find('.js-read-button').attr('data-readLess'));
			} else {
				$(this).find('.js-read-button span').text($(this).find('.js-read-button').attr('data-readAll'));
			}

			$(this).parents('.my-order').toggleClass('active').siblings().removeClass('active');
			$(this).parents('.my-order').siblings().find('.js-read-button span').text($(this).find('.js-read-button').attr('data-readAll'));
		}
	});

	$('.account-block__collapse--header').on('click', function () {

		if ($(window).width() > 992) {
			$(this).parents('.card').siblings().find('.account-block__details--edit-button').show();
		
			if($(this).hasClass('collapsed')) {
				$(this).find('.account-block__details--edit-button').hide();
			} else {
				$(this).find('.account-block__details--edit-button').show();
			}
		} else {
			if($(this).hasClass('collapsed')) {
				$('html, body').animate({
					scrollTop: ($("#accordion").offset().top) - 150
				}, 800);
			}
		}
	});

	// change defalt image on add new house image
	$('.js-img-up').on('change',function() {
		if (this.files && this.files[0]) {
			
			var reader = new FileReader(),
					changedInput = this;
				
			reader.onload = function (e) {
				$('.js-my-house-defalt-img').hide();
				$('.js-my-house-img-view').attr('src', e.target.result).show().parent('a').attr('href', e.target.result);
				$(changedInput).siblings('label').text($(changedInput).val().split('\\').pop());
			}
			reader.readAsDataURL(this.files[0]);
		}
	});

	// select all saved houses
	$('.js-select-all-houses').on('click', function() {
		if($(this).is(':checked')) {
			var modalHeader = $(this).parents('.modal-header');

			$(modalHeader).find('.house-checkbox').hide();
			$(modalHeader).find('.manage-house-filters__result').css('display','flex');
			$(modalHeader).find('.manage-house-filters__result--text span').text($(modalHeader).siblings('.modal-body').find('input[type="checkbox"]').length);
			$(modalHeader).siblings('.modal-body').find('input[type="checkbox"]').each(function() {
				$(this).prop('checked', true);
				$(this).parents('.manage-house-houses').find('.js-edit-house').addClass('active');
			});
		}
	});

	// unselect all houses
	$('.js-manage-house-clear').on('click', function(){
		var modalHeader = $(this).parents('.modal-header');

		$(modalHeader).find('.house-checkbox').show();
		$(modalHeader).find('.js-select-all-houses').prop('checked', false);
		$(modalHeader).find('.manage-house-filters__result').css('display','none');
		$(modalHeader).siblings('.modal-body').find('input[type="checkbox"]').each(function() {
			$(this).prop('checked', false);
			$(this).parents('.manage-house-houses').find('.js-edit-house').removeClass('active');
		});
	});

	// select one or more houses
	$('.js-select-house').on('click', function() {
		var modalBody = $(this).parents('.modal-body'),
				modalHeader = $(modalBody).siblings('.modal-header');
	
		if($(this).is(':checked')) {
			$(this).parents('.manage-house-houses').find('.js-edit-house').addClass('active');

			if($(modalBody).find('input[type="checkbox"]:checked').length > 0) {
				$(modalHeader).find('.house-checkbox').hide();
				$(modalHeader).find('.manage-house-filters__result').css('display','flex');
				$(modalHeader).find('.manage-house-filters__result--text span').text($(modalBody).find('input[type="checkbox"]:checked').length);
			} else {
				$(modalHeader).find('.house-checkbox').show();
				$(modalHeader).find('.js-select-all-houses').prop('checked', false);
				$(modalHeader).find('.manage-house-filters__result').css('display','none');
			}
		}
		else {
			$(this).parents('.manage-house-houses').find('.js-edit-house').removeClass('active');

			if($(modalBody).find('input[type="checkbox"]:checked').length > 0) {
				$(modalHeader).find('.house-checkbox').hide();
				$(modalHeader).find('.manage-house-filters__result').css('display','flex');
				$(modalHeader).find('.manage-house-filters__result--text span').text($(modalBody).find('input[type="checkbox"]:checked').length);
			} else {
				$(modalHeader).find('.house-checkbox').show();
				$(modalHeader).find('.js-select-all-houses').prop('checked', false);
				$(modalHeader).find('.manage-house-filters__result').css('display','none');
			}
		}
	});

	// edit house 
	$('.js-edit-house').on('click', function() {
		var modal = $(this).attr('data-target'),
				houseId = $(this).attr('data-house-id');
		
		$(modal).find('.modal-title span').text('Edit house with ID = ' + houseId);
		if ($(window).width() > 992) {
			$(modal).find('.js-row-action').css('display','flex').removeClass('justify-content-center').addClass('justify-content-end');
			$(modal).find('.js-mobile-row-action').hide();
			$(modal).find('.js-col-edit-add').find('button.btn-primary span').text('save changes');
		} else {
			$(modal).find('.js-row-action').hide()
			$(modal).find('.js-mobile-row-action').css('display','flex').removeClass('justify-content-center').addClass('justify-content-end');
			$(modal).find('.js-col-edit-add').removeClass('col-12').addClass('col-6').find('button.btn-primary span').text('save changes');
		}
		
		$(modal).find('.js-col-delete').show();
	});

	//add house 
	$('.add-house').on('click', function() {
		var modal = $(this).attr('data-target')

		$(modal).find('.modal-title span').text('Add house');
		if ($(window).width() > 992) {
			$(modal).find('.js-row-action').css('display','flex').removeClass('justify-content-end').addClass('justify-content-center');
			$(modal).find('.js-mobile-row-action').hide();
			$(modal).find('.js-col-edit-add').find('button.btn-primary span').text('confirm');
		} else {
			$(modal).find('.js-row-action').hide();
			$(modal).find('.js-mobile-row-action').css('display','flex').removeClass('justify-content-end').addClass('justify-content-center');
			$(modal).find('.js-col-edit-add').removeClass('col-6').addClass('col-12').find('button.btn-primary span').text('confirm');
		}
		
		$(modal).find('.js-col-delete').hide();
	});

	// function hideMobileAccountNav(e) {
	// 	var el = e.target.closest('.account-block__navigation--wrapper');
	// 	if (!el) {
	// 		$('#overlay-search').removeClass('open');
	// 		$('.account-block__navigation--wrapper').removeClass('active');
	// 		$('body').css('overflow','auto');
	// 		document.removeEventListener('click', hideMobileAccountNav);
	// 	}
	// }

	// account navigation in header
	$('.js-show-user-nav').on('click', function() {
		$('.account-block__navigation--wrapper').addClass('active');
		$('#overlay-mobile-nav').addClass('open');
		$('body').css('overflow','hidden');
		// setTimeout(function() {
		// 	document.addEventListener('click', hideMobileAccountNav);
		// });
	});

	//hide accunt nov
	$('.js-hide-account-mobile-menu').on('click', function () {
		$('.account-block__navigation--wrapper').removeClass('active');
		$('#overlay-mobile-nav').removeClass('open');
		$('body').css('overflow','auto');
	});

	//mobile login show account nav
	$('.js-mobile-account-login').on('click', function () {
		$(this).css('display','none');
		$(this).parents('li').siblings('li').find('.account-mobile-menu-visible').css('display','none');
		$(this).parents('li').siblings('li').find('.account-menu-hidden').css('display','flex');
		$(this).parents('.account-block__navigation--wrapper').find('.js-login-txt').addClass('active');
		$(this).parents('.account-block__navigation--wrapper').find('.js-not-login-txt').removeClass('active');
	});

	//mobile logout hive account nav
	$('.js-mobile-account-logout').on('click', function() {
		$(this).css('display','none');
		$(this).parents('li').siblings('li').find('.account-mobile-menu-visible').css('display','flex');
		$(this).parents('li').siblings('li').find('.account-menu-hidden').css('display','none');
		$(this).parents('.account-block__navigation--wrapper').find('.js-login-txt').removeClass('active');
		$(this).parents('.account-block__navigation--wrapper').find('.js-not-login-txt').addClass('active');
	});

	// account navigation under header
	var $accountNav = $('.account-nav__content');

	if($accountNav.length === 1) {
		var elemWidth = 0;

		$($accountNav).find('.home-mobile-buttons-block__link').each(function() {
			elemWidth += $(this).width();
		});

		mobilePredNextButtons($('.account-nav__content'), $('.account-nav__prev'), $('.account-nav__next'), elemWidth);
	}

	//Hide mobile folver nav and show mobile folced content
	$('.js-hide-folder-nav').on('click', function () {
		if ($(window).width() < 992) {
			$(this).removeClass('active');
			$(this).parents('.js-folder-nav-wrap').fadeOut(100);
			$('.js-mobile-idea-folder-header').find('.js-back-house-list').removeClass('full-with-button');
			$('.js-mobile-idea-folder-header').find('.manage-folders').addClass('active');
			$('.js-mobile-idea-folder-header').find('.js-hide-folder-nav-content-btn').addClass('active').attr('date-aria-controls', $(this).attr('aria-controls'));
			$('.js-mobile-idea-folder-header').find('.mobile-idea-folder--details__content').addClass('active');
			$('.js-mobile-idea-folder-header').find('.mobile-idea-folder--details__text-box').empty().html($(this).html());
			// $('.js-mobile-idea-folder-header').find('.js-show-mobile-action-btn').fadeIn(100);
		} else {
			$($(this).attr('href')).siblings().each(function(){
				if ($(this).find('.js-saved-images-box').length()){
					$(this).find('.js-saved-images-box').fadeIn(500);
					$(this).find('.js-specification-sheet-box').fadeOut(10);
					$(this).find('.js-add-to-rooms-new-idea-folder-images').fadeOut(10);
				} else {
					$(this).find('.js-saved-images-box').fadeOut(10);
					$(this).find('.js-specification-sheet-box').fadeOut(10);
					$(this).find('.js-add-to-rooms-new-idea-folder-images').fadeIn(500);
				}
			});
		}
	});

	//Hide mobile folced content and show mobile folver nav
	$('.js-hide-folder-nav-content-btn').on('click', function() {
		if ($(window).width() < 992) {
			$(this).removeClass('active');
			$(this).parents('.js-folder-nav-content').fadeOut(100);
			$('#'+$(this).attr('date-aria-controls')).removeClass('active show');
			$('.js-folder-nav-wrap').fadeIn(100);
			$('.js-folder-nav-wrap').find('a[aria-controls='+$(this).attr('date-aria-controls')+']').removeClass('active');
			$('.js-mobile-idea-folder-header').find('.js-back-house-list').addClass('full-with-button');
			$('.js-mobile-idea-folder-header').find('.manage-folders').removeClass('active');
			$('.js-mobile-idea-folder-header').find('.mobile-idea-folder--details__content').removeClass('active');
			// $('.js-mobile-idea-folder-header').find('.js-show-mobile-action-btn').fadeOut(100);
		}
	});

	//show specification sheet
	$('.specification-sheet').on('click', function () {
		if ($(window).width() > 992) {
			$(this).parents('.js-saved-images-box').fadeOut(500);
			$(this).parents('.js-saved-images-box').siblings('.js-specification-sheet-box').fadeIn(500);
		}
	});

	$('.specification-sheet .folder-wrapper__saved-element--folders-button').on('click', function () {
		$(this).parents('.js-saved-images-box').fadeOut(10);
		$(this).parents('.js-saved-images-box').siblings('.js-specification-sheet-box').fadeIn(500);
	});

	$('.js-hide-specification-sheet-box-btn').on('click', function () {
		$(this).parents('.folder-wrapper').find('.js-saved-images-box').fadeIn(500);
		$(this).parents('.folder-wrapper').find('.js-specification-sheet-box').fadeOut(10);
		$(this).parents('.folder-wrapper').find('.js-add-to-rooms-new-idea-folder-images').fadeOut(10);
		$('html, body').animate({scrollTop : 0},800);
	});

	$('.js-show-specification-sheet-btn').on('click', function() {
		if ($(this).hasClass('clicked')) {
			$(this).removeClass('clicked');
			$(this).parents('.folder-wrapper').find('.js-saved-images-box').fadeIn(500);
			$(this).parents('.folder-wrapper').find('.js-specification-sheet-box').fadeOut(10);
			$(this).parents('.folder-wrapper').find('.js-add-to-rooms-new-idea-folder-images').fadeOut(10);
		} else {
			$(this).addClass('clicked');
			$(this).parents('.folder-wrapper').find('.js-saved-images-box').fadeOut(10);
			$(this).parents('.folder-wrapper').find('.js-specification-sheet-box').fadeIn(500);
			$(this).parents('.folder-wrapper').find('.js-add-to-rooms-new-idea-folder-images').fadeOut(10);
		}
	});

	$('.js-show-add-to-rooms-new-idea-folder-images-btn').on('click', function () {
		$(this).parents('.folder-wrapper').find('.js-saved-images-box').fadeOut(10);
		$(this).parents('.folder-wrapper').find('.js-add-to-rooms-new-idea-folder-images').fadeIn(500);
	});

	$('.js-hide-add-to-rooms-new-idea-folder-images-btn').on('click', function () {
		$(this).parents('.folder-wrapper').find('.js-saved-images-box').fadeIn(500);
		$(this).parents('.folder-wrapper').find('.js-specification-sheet-box').fadeOut(10);
		$(this).parents('.folder-wrapper').find('.js-add-to-rooms-new-idea-folder-images').fadeOut(10);
		$('html, body').animate({scrollTop : 0},800);
	});

	if($('.js-desktop-active').length){
		if ($(window).width() > 992) {
			$('.js-desktop-active').attr('aria-selected','true');
			$('.js-desktop-active').addClass('active');
			$($('.js-desktop-active').attr('href')).addClass('active show');
		}
	}

	$(window).on({
		load: function() {
			if ($(window).width() < 992) {
				if ($('.js-desctop-file-position').length) {
					if ($('.js-desctop-file-position').find('.col-12').length) {
						$('.js-mobile-file-position').append($($('.js-desctop-file-position').find('.col-12')).detach());
					}
				}
			} else {
				if ($('.js-mobile-file-position').find('.col-12').length){
					$('js-desctop-file-position').append($($('.js-mobile-file-position').find('.col-12')).detach());
				}
			}
		},
		resize: function (){
			if ($(window).width() < 992) {
				if ($('.js-desctop-file-position').length) {
					if ($('.js-desctop-file-position').find('.col-12').length) {
						$('.js-mobile-file-position').append($($('.js-desctop-file-position').find('.col-12')).detach());
					}
				}
			} else {
				if ($('.js-mobile-file-position').find('.col-12').length){
					$('.js-desctop-file-position').append($($('.js-mobile-file-position').find('.col-12')).detach());
				}

				if($('.js-desktop-active').length){
					$('.js-desktop-active').attr('aria-selected','true');
					$('.js-desktop-active').addClass('active');
					$($('.js-desktop-active').attr('href')).addClass('active show');
				}
			}
		}
	});

	//load confirm alert for checked checkbox
	$('.js-load-confirm-modal').on('click', function (){
		var modalId = $(this).attr('data-target');

		if($(this).is(':checked')) {
			$(modalId).modal('show');
			$(modalId).find('.js-uncheck-checkbox-btn').attr('date-checkbox-id', '#'+$(this).attr('id'));
		}
	});

	// uncheck checkbox if click NO
	$('.js-uncheck-checkbox-btn').on('click', function () {
		$($(this).attr('date-checkbox-id')).prop('checked', false);
	});


	$('.js-url-modal-btn').on('click', function (){
		var modalId = $(this).attr('data-target');

		$(modalId).find('.js-save-image-url-btr').attr('data-tab-parrent', $(this).attr('data-tab-parrent')).attr('data-button-positon', $(this).attr('data-button-positon'));
	});

	$('.js-add-new-url-field-btn').on('click', function(){
		var newField = '<div class="col-12 new-field-wrap js-new-url-field">' +
	 				'<div class="form-group mt-2">' +
						'<input type="text" class="form-control mt-2" name="image-url" placeholder="Paste URL here">' +
					'</div>' +
					'<button type="button" class="new-field-btn js-remove-new-url-field">' +
						'<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>' + 
					'</button>' +
				'</div>';

		$(this).parents('.js-add-new-field').before(newField);
		// $(this).hide();
	});

	$('.js-row-url-list').on('click', '.js-remove-new-url-field', function (){
		$(this).parents('.js-new-url-field').remove();
		// $('.js-add-new-url-field-btn').css('display','flex');
	});


	// upload new image 
	$('.drop-input').on('change', function(event) {
		var files = event.target.files;
		var savedArea = $(this).parents('.new-field-wrap-table__footer').siblings('.new-field-wrap-table__body').find('.col-12');
		var newSize = files[0].size / 1000;

		if (newSize >= 1000) {
			newSize = (newSize / 1000).toFixed(2) + " MB";
		} else {
			newSize = newSize.toFixed(2) + " KB";
		}

		$(savedArea).append(
			'<div class="row new-field-wrap-table__body--row">' +
				'<div class="col-5 new-field-wrap-table__body--file-name">' +
					'<input type="text" class="image-data" name="file-name[]" value="'+files[0].name+'">'+
					'<input type="text" class="image-data" name="file-size[]" value="'+files[0].size+'">'+
					'<input type="text" class="image-data" name="image-type[]" value="'+ files[0].type+'">'+files[0].name +
				'</div>' +
				'<div class="col-4 new-field-wrap-table__body--file-size">' +  newSize +
				'</div>' + 
				'<div class="col-3 new-field-wrap-table__body--file-sucsess">' +
					'<img src="images/checked.svg" alt="" class="img-fluid">' +
				'</div>' + 
				'<button class="new-field-wrap-table__body--delete js-delete-new-upload-img-btn">' +
					'<img src="images/trash-small.svg" alt="" class="img-fluid">' +
				'</button>' +
			'</div>'
		);

		// $(this).val('');
	});


	$('.new-field-wrap-table__body').on('click', '.js-delete-new-upload-img-btn', function() {
		$(this).parents('.new-field-wrap-table__body--row').remove();
	});

	// Delete folder
	$('.js-manage-house-delete').on('click', function() {
		$(this).parents('.parents').find('.msg-delete').addClass('show-box');
		$(this).parents('.parents').addClass('nd_hide-box');
		setTimeout(function(){
			$('.show-box').fadeOut();
			$('.nd_hide-box').fadeOut();
		}, 1000)
	});	

	// Delete orders mobile
	$('.js-delete-orders').on('click', function() {
		$(this).parents('.my-order').find('.msg-delete-orders').addClass('show-box-orders');
		$(this).parents('.my-order').addClass('nd_hide-box-orders');
		setTimeout(function(){
			$('.nd_hide-box-orders').addClass('hide-box-orders');
		}, 1000)
	});	

});

