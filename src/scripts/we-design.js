import { each } from "jquery";

jQuery(document).ready(function ($) {
	
	if($(window).width() < 992) {
		if ($('.js-mobile-removed-area').length >= 1 && !$('.js-mobile-removed-area').hasClass('detached')) {
			$('.js-desktop-removed-area').empty().append($('.js-mobile-removed-area').find('.wrapper').detach());
			$('.js-mobile-removed-area').addClass('detached');
		}
	}

	$(window).on({
		resize: function () {
			if($(window).width() < 992) {
				if ($('.js-mobile-removed-area').length >= 1 && !$('.js-mobile-removed-area').hasClass('detached')) {
					$('.js-desktop-removed-area').empty().append($('.js-mobile-removed-area').find('.wrapper').detach());
					$('.js-mobile-removed-area').addClass('detached');
					$('.js-desktop-removed-area').removeClass('detached');
				}
			} else {
				if ($('.js-desktop-removed-area').length >= 1 && !$('.js-desktop-removed-area').hasClass('detached')) {
					$('.js-mobile-removed-area').empty().append($('.js-desktop-removed-area').find('.wrapper').detach());
					$('.js-desktop-removed-area').addClass('detached');
					$('.js-mobile-removed-area').removeClass('detached');
				}
			}
		}
	});
	
});