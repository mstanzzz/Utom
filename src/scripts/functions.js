import {Collapse} from "bootstrap";

export function carouselById(carousel, carouselNav, vertical) {

	$(carousel + '.slick-initialized').slick('unslick');
	$(carouselNav + '.slick-initialized').slick('unslick');

	$(carousel).not('.slick-initialized').slick({
		initialSlide: 0,
		dots: false,
		infinite: true,
		arrows: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		rows: 0,
		centerMode: true,
		mobileFirst: false,
		adaptiveHeight: true,
		asNavFor: carouselNav,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					slidesToShow: 1,
					centerMode: true,
					variableWidth: false,
					dots: false,
					infinite: true
				}
			}
		]
	});

	$(carouselNav).not('.slick-initialized').slick({
		slidesToShow: 5,
		infinite: true,
		slidesToScroll: 1,
		asNavFor: carousel,
		vertical: vertical,
		dots: false,
		centerMode: true,
		focusOnSelect: true,
		arrows: false,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					centerMode: true,
					dots: false,
					infinite: true
				}
			}
		]
	});
}

export function mobilePredNextButtons(container, buttonPrev, buttonNext, maxWidth) {
	var contentWidth = container.width();

	//maxWidth+30 - because there is a moment when the last letter of the last link is hidden, but the arrows
	//doesn't shows
	if (contentWidth > 992 || contentWidth >= maxWidth + 30) {
		buttonPrev.css('display', 'none');
		buttonNext.css('display', 'none');
	}

	jQuery.fn.scrollCenter = function (elem, speed) {
		var active = jQuery(this).find(elem),
			activeWidth = active.width() / 2,
			pos = active.position().left + activeWidth,
			elpos = jQuery(this).scrollLeft(),
			elW = jQuery(this).width();

		pos = pos + elpos - elW / 2; // for center position if you want adjust then change this

		jQuery(this).animate({
			scrollLeft: pos
		}, speed == undefined ? 1000 : speed);
		return this;
	};

	if ($(container).find('.home-mobile-buttons-block__link').hasClass('active')) {
		$(container).scrollCenter('.active', 300);
	}

	$(window).on({
		resize: function () {
			contentWidth = container.width();

			if (contentWidth > 992 || contentWidth >= maxWidth) {

				buttonPrev.css('display', 'none');
				buttonNext.css('display', 'none');
			}
		}
	});

	// on scroll element account nav
	$(container).on('scroll', function (e) {
		// $(container).on('touchmove', function(e) {
		var $elem = $(container),
			newScrollLeft = $elem.scrollLeft(),
			width = $elem.outerWidth(),
			scrollWidth = $elem.get(0).scrollWidth;

		$(buttonPrev).css('display', 'flex');
		$(buttonNext).css('display', 'flex');

		// alert(`${scrollWidth}, ${newScrollLeft}, ${width}`);

		if (scrollWidth - Math.round(newScrollLeft) - 1 <= width) {
			$(buttonPrev).css('display', 'flex');
			$(buttonNext).css('display', 'none');
		}

		if (newScrollLeft <= 1) {
			$(buttonPrev).css('display', 'none');
			$(buttonNext).css('display', 'flex');
		}
	});

	//click next button
	$(buttonNext).on('click', function (e) {
		e.preventDefault();
		if (!$(this).data('lockedAt') || +new Date() - $(this).data('lockedAt') > 300) {
			var leftPos = $(container).scrollLeft();
			$(buttonPrev).css('display', 'flex');
			$(container).animate({
				// scrollLeft: leftPos + 200
				scrollLeft: leftPos + Math.round(contentWidth / 2)
			}, 800);
		}
		$(this).data('lockedAt', +new Date());
	});

	// click preview button
	$(buttonPrev).on('click', function (e) {
		e.preventDefault();
		if (!$(this).data('lockedAt') || +new Date() - $(this).data('lockedAt') > 300) {
			var leftPos = $(container).scrollLeft();
			$(buttonNext).css('display', 'flex');
			$(container).animate({
				// scrollLeft: leftPos - 200
				scrollLeft: leftPos - Math.round(contentWidth / 2)
			}, 800);
		}
		$(this).data('lockedAt', +new Date());
	});
}

export function desctopPredNextButtons(container, buttonPrev, buttonNext) {
	var contentWidth = container.width();

	if (contentWidth < 992) {
		buttonPrev.css('display', 'none');
		buttonNext.css('display', 'none');
	}

	jQuery.fn.scrollCenter = function (elem, speed) {
		var active = jQuery(this).find(elem),
			activeWidth = active.width() / 2,
			pos = active.position().left + activeWidth,
			elpos = jQuery(this).scrollLeft(),
			elW = jQuery(this).width();

		pos = pos + elpos - elW / 2; // for center position if you want adjust then change this

		jQuery(this).animate({
			scrollLeft: pos
		}, speed == undefined ? 1000 : speed);
		return this;
	};

	if ($(container).find('.home-mobile-buttons-block__link').hasClass('active')) {
		$(container).scrollCenter('.active', 300);
	}

	$(window).on({
		resize: function () {
			contentWidth = container.width();

			if (contentWidth < 992) {

				buttonPrev.css('display', 'none');
				buttonNext.css('display', 'none');
			}
		}
	});

	// on scroll element account nav
	$(container).on('scroll', function (e) {
		// $(container).on('touchmove', function(e) {
		var $elem = $(container),
			newScrollLeft = $elem.scrollLeft(),
			width = $elem.outerWidth(),
			scrollWidth = $elem.get(0).scrollWidth;

		$(buttonPrev).css('display', 'flex');
		$(buttonNext).css('display', 'flex');

		if (scrollWidth - Math.round(newScrollLeft) - 1 <= width) {
			$(buttonPrev).css('display', 'flex');
			$(buttonNext).css('display', 'none');
		}

		if (newScrollLeft <= 1) {
			$(buttonPrev).css('display', 'none');
			$(buttonNext).css('display', 'flex');
		}
	});

	//click next button
	$(buttonNext).on('click', function (e) {
		e.preventDefault();
		if (!$(this).data('lockedAt') || +new Date() - $(this).data('lockedAt') > 300) {
			var leftPos = $(container).scrollLeft();
			$(buttonPrev).css('display', 'flex');
			$(container).animate({
				scrollLeft: leftPos + 200
				// scrollLeft: leftPos + Math.round(contentWidth/2)
			}, 800);
		}
		$(this).data('lockedAt', +new Date());
	});

	// click preview button
	$(buttonPrev).on('click', function (e) {
		e.preventDefault();
		if (!$(this).data('lockedAt') || +new Date() - $(this).data('lockedAt') > 300) {
			var leftPos = $(container).scrollLeft();
			$(buttonNext).css('display', 'flex');
			$(container).animate({
				scrollLeft: leftPos - 200
				// scrollLeft: leftPos - Math.round(contentWidth/2)
			}, 800);
		}
		$(this).data('lockedAt', +new Date());
	});
}
