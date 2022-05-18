import { each } from "jquery";
import 'jquery-ui';

// hide select and btn
$(".clear-filters-accessories").click(function(){
	$(".my-custom-select-selects-wrapper__select-nd").addClass("show-select");
	$(this).css("display", "none");
});


$(".my-customs-select-select-option").click(function(){
	$(".my-custom-select-selects-wrapper-two").removeClass("show-select");
});

$(".my-custom-select-selects-wrapper-two .my-customs-select-select").click(function(){
	$(".my-custom-select-selects-wrapper-three").removeClass("show-select");
});

$(".my-custom-select-selects-wrapper-three .my-customs-select-select").click(function(){
	$(".my-custom-select-selects-wrapper-four").removeClass("show-select");
});

$(".my-custom-select-selects-wrapper-four .my-customs-select-select").click(function(){
	$(".my-custom-select-selects-wrapper-five").removeClass("show-select");
});

// covid btn fix
$(".html_accessories .js-hide-covit").click(function(){
	$(".html_accessories .main.clearfix.accessories").removeClass("accessories");
	$(".html_accessories .home-mobile-buttons-block.showroom-category-page.accessories-page").addClass("mobile__position-covid");
});



//show next select
$(".my-customs-select-select-option").click(function(){
	$(".item-type-one").addClass("show-select");
	$(".item-type-one").removeClass("hide-select");
	$(".clear-filters-accessories").css("display", "inline-block");
});
$(".item-type-one li").click(function(){
	$(".item-type-two").addClass("show-select");
	$(".item-type-two").removeClass("hide-select");
});
$(".item-type-two li").click(function(){
	$(".item-type-three").addClass("show-select");
	$(".item-type-three").removeClass("hide-select");
});
$(".item-type-three li").click(function(){
	$(".item-type-four").addClass("show-select");
	$(".item-type-four").removeClass("hide-select");
});

// button "Don't Show Again" 

$('.idea-folder.__square').hover(
	function () {
		$(this).parents('.share-product-accessories').find('.info-popup-idea-folder.__square').addClass('show');
		$(this).parents('.see-detail-product-accessories').find('.info-popup-idea-folder.__square').addClass('show');
	}, 
	function() {
		$(this).parents('.share-product-accessories').find('.info-popup-idea-folder.__square').removeClass('show');
		$(this).parents('.see-detail-product-accessories').find('.info-popup-idea-folder.__square').removeClass('show');
});
$('.save-to-specs-sheet.__square').hover(
	function () {
		$(this).parents('.share-product-accessories').find('.info-popup-spec-folder.__square').addClass('show');
		$(this).parents('.see-detail-product-accessories').find('.info-popup-spec-folder.__square').addClass('show');
	}, 
	function() {
		$(this).parents('.share-product-accessories').find('.info-popup-spec-folder.__square').removeClass('show');
		$(this).parents('.see-detail-product-accessories').find('.info-popup-spec-folder.__square').removeClass('show');
});

$('.dontShowAgain_acc_idea').on('click', function() {
	$('.info-popup-idea-folder').addClass("hide-info");
	$('.tooltip__save-images.__nd').addClass("hide-info");
});
$('.dontShowAgain_acc_spec').on('click', function() {
	$('.info-popup-spec-folder').addClass("hide-info");
});

	


