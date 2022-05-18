jQuery(document).ready(function ($) {

	let collapseTarget = $('#accordion [data-target]')

	$('.collapse').not('.spec').collapse();

	$('.feature-detail__item-drop').on('shown.bs.tooltip', function () {
		// do something…
		setTimeout(function () {   //calls click event after a certain time
			$(this).tooltip('hide');
		}, 1000);
	})

	$('.feature-detail__item-drop__show-more').on('click', function () {

		if ($(this).parent('.feature-detail__item-drop').hasClass('active')) {

			$(this).parent('.feature-detail__item-drop').removeClass('active');
			$(this).parents('.phantom-actions__dropdowns').removeClass('active');
		} else {
			$(this)
				.parents('.phantom-actions__dropdowns')
				.find('.feature-detail__item-drop').removeClass('active');

			$(this)
				.parent('.feature-detail__item-drop').addClass('active')
				.parents('.phantom-actions__dropdowns').addClass('active');

		}


	});

	//collapse on hover - the collapse needs to wait until other collapse ends
	// $(".card").hover(function () {
	//     $(this).closest('.card').find('.collapse').collapse('toggle');
	// })
	// $('.card .btn').mouseleave(function () {
	//     console.log('leave');
	//     $(this).closest('.card').find('.collapse').collapse('hide');
	// })


	//specifications-details.html back to tom of the collapsing section
	//wait until collapse is shown, then trigger the scroll to the header of the collapse section
	// if ($(window).width() < 992) {
	// 	$(collapseTarget).on('click', function () {
	// let content = $(this).data('target')
	//
	// $(content).on('shown.bs.collapse', function () {
	// 	$(content).addClass('shown')
	// })
	// $(content).on('hidden.bs.collapse', function () {
	// 	$(content).removeClass('shown')
	// })

	// 		setTimeout(() => {
	// 			$('html, body').animate({
	// 				scrollTop: (($(this).offset().top) - 120)
	// 			}, 400);
	// 		}, 500)
	// 	})
	// }
});
