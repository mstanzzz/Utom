jQuery(document).ready(function ($) {

	if ($(window).width() < 992) {
		if ($('#shoppingCardTitle').length) {
			var shoppingCardTitle = $('#shoppingCardTitle').detach();
			$(".mobile__append-shoppingCardTitle").append(shoppingCardTitle);
		}
	}
});
