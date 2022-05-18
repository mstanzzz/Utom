jQuery(document).ready(function ($) {

	if ($(window).width() > 992) {
		if ($('.card-fixed').length) {
			var checkCardWrap = $('.card-fixed'),
				checkCard = $('.card-fixed__inner'),
				startPosition = checkCardWrap.offset().top,
				headerWrap = $('header').outerHeight(),
				stopPosition = $('footer').offset().top - checkCard.outerHeight() - 60;

			$(document).scroll(function () {
				//stick nav to top of page
				var y = $(this).scrollTop() + headerWrap + 25;

				if (y >= startPosition) {
					checkCard.addClass('position-fixed');
					if (y > stopPosition) {
						checkCard.css('top', stopPosition - y + headerWrap + 25);
					} else {
						checkCard.css('top', headerWrap + 25);
					}
				} else if (y <= stopPosition) {
					checkCard.removeClass('position-fixed');
					checkCard.css('top', 0);
				}
			});
		} else {
			return false;
		}
	}


});
