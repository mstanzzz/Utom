jQuery(document).ready(function ($) {
	var signInfoTextCustomCollapse = $('.info-text-custom-collapse');
	var modalSignInfoTextCustomCollapseBtn = $('[data-role="btn-info-text-custom-collapse"]');


	function customCollapseInit() {
		var wid = $(window).width();
		if (wid < 1025) {
			$(modalSignInfoTextCustomCollapseBtn).off('click').on('click', function (event) {

				if (!$(this).siblings(signInfoTextCustomCollapse).hasClass('active')) {
					$(this).siblings(signInfoTextCustomCollapse).addClass('active')
					$(this).text('Close')
				} else {
					$(this).siblings(signInfoTextCustomCollapse).removeClass('active')
					$(this).text('Read all')
				}
			});
		}
	}


	customCollapseInit();

	$(window).on("resize", function () {
		customCollapseInit();
	});
});
