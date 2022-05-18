jQuery(document).ready(function ($) {

	var btnLoadPage = $('.btn-load-page');

	btnLoadPage.click(function () {
		var iframe = $(this).data('target');
		var src = $(this).data('src');
		$(iframe + ' iframe').attr('src', src);
	})


});
