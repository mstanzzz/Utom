var didScroll;
var lastScrollTop = 0;
var delta = 2;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
	didScroll = true;
});

setInterval(function() {
	if (didScroll) {
		hasScrolled();
		didScroll = false;
	}
}, 250);

function hasScrolled() {
	if ($(window).width() <= 992){
		var st = $(this).scrollTop();

		// if(Math.abs(lastScrollTop - st) <= delta)
		// 	return;

		// if (st > lastScrollTop && st > navbarHeight){
		// 	$('header').removeClass('nav-down').addClass('nav-up');
		// } else {
		// 	if(st + $(window).height() < $(document).height()) {
		// 		$('header').removeClass('nav-up').addClass('nav-down');
		// 	}
		// }
			
		// lastScrollTop = st;

		// sticky header
		if (st >= 100) {
			$('header').removeClass('nav-down').addClass('nav-up');
		}
    else {
			$('header').removeClass('nav-up').addClass('nav-down');
		}
	}
}