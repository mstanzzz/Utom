jQuery(document).ready(function($){
	//open popup "100% Perfect fit guarantee"
	$('.first-header__shipping .first-header__child:first-child').on('click', function(event){
		event.preventDefault();
		$('.cd-popup.perfect-fit-guarantee').addClass('is-visible');
	});

	//open popup "Free shipping"
	$('.first-header__shipping .first-header__child:last-child').on('click', function(event){
		event.preventDefault();
		$('.cd-popup.free-shipping').addClass('is-visible');
	});

	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
});