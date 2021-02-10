// Custom OTG Components, Bootstrap Components, Third Party Script Initialization
// Minify for production; this copy is for development.

function homeTogglesMobile(){
	$(".categories .toggle-btn").click(function(){
		if ($(this).text() == "Hide"){
			$(this).text("Show");
			$(this).closest(".row.categories").find("h3").addClass("hidden-content");
		}
		else {
			$(this).text("Hide");
			$(this).closest(".row.categories").find("h3").removeClass("hidden-content");
		}
		$(this).closest(".row.categories").find(".category").slideToggle("fast");
	});
}
function responsiveNavAdjustments(){
	// first make sure we don't already have menu items in the mobile nav placeholder 
	if ($("#mobile-nav ul#mobile-nav-list li").length <= 0) {
		// clone support menu and main navigation to mobile navigation placeholder
		$("#main-nav > ul > li:not('#account-menu'), #support-menu").clone().appendTo("#mobile-nav ul#mobile-nav-list");
		// get rid of the support icon
		$("#mobile-nav #support-menu > a > i.header-icon-support").remove();
		$("#mobile-nav #support-menu").detach().appendTo("#mobile-nav > ul");
		// add expansion dom elements with click events to parents of subnavs in mobile menu
		$("#mobile-nav > ul > li, #mobile-nav li.has-subnavs").append("<span class='expand-subnav' onclick='expandSubnav(this)'><i class='icon-plus-sign icon-white'></i><span>");
		//remove any existing active classes to prevent unintended toggle behavior
		$("#mobile-nav li.active, #mobile-nav li > a.active").removeClass("active");
		if ($("footer .row.footer-bottom-row h5 i").length <= 0){
			if (window.innerWidth < 768) {
				$("footer .row.footer-bottom-row h5").prepend("<i class='icon-plus-sign icon-gray' style='position:relative; top: -7px;'></i>");
				$("footer .row.footer-bottom-row h5").click(function(){
					$(this).next("ul").slideToggle("fast");	
					$(this).find("i.icon-gray").toggleClass("icon-plus-sign").toggleClass("icon-minus-sign");	
				})
			}
		}
	}
	// add click event to the navigation toggle to add body class
	$(".mobile-nav-trigger").click(function(e){
		$("body").toggleClass("show-nav");
	});
	// we need to see if the page is opening with the menu open.
	var hash = window.location.hash.substring(1);
	if (hash.indexOf("mobile-nav") != -1 && !$("body").hasClass("show-nav")){
		$("body").addClass("show-nav");	
	}
	if (hash.indexOf("mobile-account-menu") != -1 && !$("body").hasClass("show-account")){
		$("body").addClass("show-account");	
	}

	// now let's clone the account menu for mobile, if it doesn't already exist
	if ($("#mobile-account-menu ul").length <= 0) {
		$("#main-nav .account .subnav").clone().removeClass("subnav").appendTo("#mobile-account-menu");
	}
	// add click event to the account toggle to add body class
	$(".mobile-account-trigger").click(function(e){
		$("body").toggleClass("show-account");
	});


}
function expandSubnav(a){
	$(a).parent().toggleClass("active");
	var newClass = $(a).find('i').attr('class').indexOf('plus') != -1 ? "icon-minus-sign icon-white" : "icon-plus-sign icon-white";
	$(a).find('i').attr('class',newClass)
	var newHeight = 0;
	var parentHeight = 0;
	if ($(a).parent().hasClass("active")){
		$(a).siblings("ul.subnav").children("li").each(function(i){
			//console.log($(this).outerHeight(true));
			newHeight = newHeight + $(this).outerHeight(true);
			// now increase any subnav ancestor height
			parentHeight = $(a).parents("ul.subnav").height()+newHeight;
			//console.log(parentHeight);
			$(a).parents("ul.subnav").height(parentHeight);
			$(a).siblings("ul.subnav").height(newHeight);
			
		});
	}else {
			var currentHeight = $(a).siblings("ul.subnav").height();
			parentHeight = $(a).parents("ul.subnav").height()-currentHeight;
			$(a).parents("ul.subnav").height(parentHeight);
			$(a).siblings("ul.subnav").height(0)
	}
}
function mobileMenuTextSearch() {
	var text = $("#mobile-menu-search").val();
	//console.log(text);
	var linksToShow = $('<ul>', {class: 'mobile-nav-search-results', id: 'mobile-nav-search-results'});
	$("#mobile-nav").prepend(linksToShow);
	$("#mobile-nav ul#mobile-nav-search-results").empty();
	$( "#mobile-nav a:containsCI("+text+")").each(
		function(){
			var result = $(this).wrap("<li></li>");
			$("#mobile-nav-search-results").append(result)
			//console.log($(this).text());
		}
	);
	$("#mobile-nav ul#mobile-nav-list").fadeOut("fast");
	return false;
}
function normalizeSearchHeights() {
	var heights = [];
	$(".results .span3").each(function(i){
		heights[i] = $(this).innerHeight();
	});
	heights.sort(function(a,b){return b - a});
	$(".results .span3").height(heights[0]);

}
function navbarSearchWidth(bool){
	if (bool == true) {
		var navbarWidth = 0;
		var availableSpace = $("#main-nav").innerWidth();
		$("#main-nav > ul > li").each(function(){
			navbarWidth = navbarWidth + $(this).outerWidth(true); 
		})
		var newFormWidth = (availableSpace - navbarWidth) - 70;
		$("#header-search input").width(newFormWidth+"px");
	}
	else if (bool == false){
		$("#header-search input").attr("style","");
	}
}
function initializeSwitcher(){
	$(".image-switch-thumb").bind('click', function(e){
		e.preventDefault();
		
		//alert("iii");
		
		$(".image-switch-thumb").removeClass("active");
		var newImageLocation = $(this).attr("href");
		// if the large image opens in a lightbox, 
		// we need to change the link href value, too
		if($(".image-switch-large img").parent("a").length > 0) {
			$(".image-switch-large a").attr("href",newImageLocation);
		}
		$(".image-switch-large img").attr("src",newImageLocation);
		$(this).addClass("active");
	});
	
}
function jumpTo(pos){
	$('body, html').animate({scrollTop: pos},500);
}
function arrowHider(position,finalPosition){
	if(position==0){ $('#left').hide() }
	else{ $('#left').show() }
	if(position < finalPosition ){ $('#right').hide() }
	else{ $('#right').show() }
}
function initializeMobileSlider(){
	//console.log("hey gurl");
	var totalImages = $(".slider ul > li").length,
		imageWidth = $(".slider ul > li:first").outerWidth(true),
		totalWidth = imageWidth * totalImages;
		$(".slider").css({"width":totalWidth+"px"});
}
function initializeSlider(){
	$("#left").hide();
	var position = 0;
	// Declare variables
	var totalImages = $(".slider ul > li").length,
		imageWidth = $(".slider ul > li:first").outerWidth(true),
		totalWidth = imageWidth * totalImages,
		visibleImages = Math.floor($(".slider-container").innerWidth() / imageWidth),
		totalPages = Math.ceil(totalImages / visibleImages),
		visibleWidth = visibleImages * imageWidth,
		finalPosition = -(visibleWidth * (totalPages-1)),
		stopPosition = (visibleWidth - totalWidth),
		gutters = (imageWidth - $(".slider ul > li:first").innerWidth())/2,
		sliderWidth,
		slideAmount;
//		console.log("Total Images: "+totalImages);
//		console.log("Image Width: "+imageWidth);
//		console.log("Total Width: "+totalWidth);
//		console.log("Visible Images: "+visibleImages);
//		console.log("Total Pages: "+totalPages);
//		console.log("Visible Width: "+visibleWidth);
//		console.log(Math.floor($(".slider-container").innerWidth()));
		if($("div.showroom-thumbnails").length > 0){
			 sliderWidth = (visibleWidth - (gutters*2))+10;
			 slideAmount = (visibleWidth - (gutters*1)) -visibleImages;
		}
		else {
			 sliderWidth = (visibleWidth - (gutters*2))+3;
			 slideAmount = (visibleWidth - (gutters*1)) -visibleImages;
		}
		$(".slider").css({"width":sliderWidth+"px"});
	
	//reset widths to pixel values instead of percentages
	if ($(".slider").closest(".categories").length){
		$(".slider ul li").width($(".slider ul > li:first").innerWidth()).css({"margin-right":gutters+"px","margin-left":"1px"});
		totalWidth = totalWidth+100;
	}
	else {
		$(".slider ul li").width($(".slider ul > li:first").innerWidth()).css({"margin-right":gutters+"px","margin-left":gutters+"px"});
	}
	$(".slider ul").width(totalWidth);
	var containerWidth = $(".slider-container").outerWidth(false);
	var difference = containerWidth - $(".slider").outerWidth(false);
	// if there is room, center the slider and move the arrows in.
	if (difference > 40 && totalPages > 1) {
		var newMargin = (difference/2)+10;
		$(".slider").css("margin-left", newMargin+"px");
		$("#right").css("right","0px");	
		$("#left").css("left","30px");	
	}
	if (totalPages < 2) {
		$("#right").hide();	
	}

	$("#left").bind('click', function(){
		if($(".slider ul").position().left < 0 && !$(".slider ul ").is(":animated")){
			$(".slider ul").animate({left : "+=" + slideAmount + "px"}, function(){
				position = $(".slider ul").position().left;
				arrowHider(position,finalPosition);
			});
		}
		return false;
	});

	$("#right").bind('click', function(){
		if($(".slider ul").position().left > stopPosition && !$(".slider ul ").is(":animated")){
			$(".slider ul").animate({left : "-=" + slideAmount + "px"}, function(){
				position = $(".slider ul").position().left;
				arrowHider(position,finalPosition);
			});
		}
		return false;
	});
	
}
function setProductTooltips(setting) {
// show tooltip to the left of list-style product search results because the image is so small...
	if (setting){
		$(".results .span9 .itembox .product-image").each(function(){
			var tooltipContent = new String($(this).parent().find("h3").html()+$(this).html());
			$(this).tooltip({placement:'left',title:tooltipContent, html: true, delay: { show: 300, hide: 100 }});
		});
	}
	else {
		$(".results .itembox .product-image").each(function(){
			$(this).data('tooltip',false);
		});
	}
}
var navigation;
function makeTabletGridFluid(){
	$(".row").addClass("row-fluid");
	//console.log("hello");
}
function removeTabletFluidGrid(){
	$(".row").removeClass("row-fluid");	
}
//make adjustments involving images
$(window).load(function(){
	// We need to normalize search heights on the search result pages in grid view.
	// first, detect if we're on a search-result page.
	if ($(".results .span3").length > 0){
		normalizeSearchHeights();
	}
	// we want the whole page to appear at once, not in chunks or as JS adjustments 
	// are being made.
	$("body").animate({opacity: 1},150);
	
});
// bind and adjust on document ready
$(document).ready(function(){
	
	
	//mobile DOM and style adjustments that can't be acheived via CSS alone
	if (window.innerWidth < 1023) {
		// if the screen width is narrow enough, we want the slide-out menus.
		// first we need to save the original menu, because the plugin overwrites the
		// html and css.
		responsiveNavAdjustments();
	}
	if (window.innerWidth < 979 && window.innerWidth > 767){
		makeTabletGridFluid();
	}
	else if (window.innerWidth < 767 || window.innerWidth > 979){
		removeTabletFluidGrid();	
	}
	if (window.innerWidth < 767 ){
		$("h5.sidebar-heading").prepend("<i class='icon-gray icon-plus-sign pull-right' style='position: relative; top: -7px;'></i>");
		// if it's the home page, we want to add toggle events to the hide/show buttons
		if ($(".home-content").length > 0){
			homeTogglesMobile();	
		}
		// if it's a search result page we want to move the filters under the page header
		if ($(".shop-page").length > 0 ){
			$("aside").detach().insertAfter("h1.category-header");
			$("aside h5").click(function(){
				$(this).next("ul").slideToggle("fast");
				$(this).find(".icon-gray").toggleClass("icon-plus-sign").toggleClass("icon-minus-sign");
			});
			$("div.search-controls.search-controls-top span.sort-results:first em.hide-mobile").addClass("sidebar-heading").prepend("<i class='icon-gray icon-plus-sign pull-right' style='position: relative; top: -7px;'></i>").click(function(){
				$(this).next("form").slideToggle("fast");
				$(this).find(".icon-gray").toggleClass("icon-plus-sign").toggleClass("icon-minus-sign");
			});;
			$("div.search-controls.search-controls-top span.sort-results:first").detach().insertAfter("#filter-options");
			$("div.search-controls.search-controls-top span.sort-results:first").remove();
		}	
		if ($(".showroom-page").length > 0 || $(".search-results-page").length > 0  ){
			$("aside h5").click(function(){
				$(this).next("ul").slideToggle("fast");
				$(this).find(".icon-gray").toggleClass("icon-plus-sign").toggleClass("icon-minus-sign");
			});
		}	
		//mobile/small tablet cart: show item/cost totals at top (php calculates as page 
		// renders, we have to pull the values)
		if ($("#shopping-cart-page").length > 0 ){
			var totalCost = $("#grand_total").text();
			$("#heading_total_cost").text("$"+totalCost);
		}
	}
	
	//initialize the lightboxes
	//$(".fancybox").fancybox({
		
		/*
        autoDimensions: false,
        height: 525,
        width: 720
		*/
		
    //});
	
	// Jump Menus
	if ($("#jumpMenu").length > 0 ){
		$("#jumpMenu").change(function(){
			var href = $(this).val();
			var offset = $(href).offset();
			var offsetTop = offset.top;
			jumpTo(offsetTop);
		});
	}
	// 	$("select").not("[multiple]").multiselect({multiple: false, selectedList: 1}).multiselectfilter();

	// Make the full table row in the drop down cart clickable.
	if ($(".drop-table.cart").length > 0){
		$(".drop-table.cart tr").click(function(e){
			// when users click on the table row, send them to the cart!
				e.preventDefault();
				window.location.href = $(this).find("a:first-child").attr("href");
			});	
	}
	// show tooltip over categories, just in case they're truncated...
	$(".category").each(function(){
		var tooltext = $(this).find(".caption").text();
		$(this).find("a").attr("title",tooltext);
	});
//	$(".category").each(function(){
//		var tpos = "top";
//		if ($(this).closest(".slider").length > 0) {
//			var perpg = Math.floor($(".slider-container").innerWidth() / $(".slider ul > li:first").outerWidth(true));
//			if ($(this).is(":nth-child("+perpg+"n)")){
//				tpos = "left";	
//			}
//			else {
//				tpos = "right";	
//			}
//		}
//		$(this).tooltip({'title':$(this).find(".caption").text(), 'placement' : tpos, delay: { show: 300, hide: 100 }})
//	});
//	
// show tooltip to the left of list-style product search results because the image is so small...
	if ($(".results .span9 .itembox .product-image").length > 0){
		setProductTooltips(true);	
	}

	// Resize the search input so that it fills all available space in the navbar
	if ($("#main-nav,#header-search").length > 0  && window.innerWidth > 1023){
		navbarSearchWidth(true);
	}
	
	// Sliders for showroom, category sections
	if($(".slider").length > 0 && window.innerWidth > 979){
		initializeSlider();
		//console.log(window.innerWidth);
	}
	if($(".slider").length > 0 && window.innerWidth < 980){
		initializeMobileSlider();
		//console.log(window.innerWidth);
	}
	
	
	// Thumbnail / Large Image Switcher for showroom and product detail pages
	if ($("a.image-switch-thumb, .image-switch-large").length > 0){
		initializeSwitcher();
	}
	
	// Simple nested links show/hide script
	if ($(".nested-links").length > 0 ){
		$(".nested-links li.parent a").click(function(e){
			if($(this).parent(".parent").hasClass("expanded")){
				$(this).parent(".parent").removeClass("expanded").addClass("collapsed").find("ul").slideUp("fast");
			}
			else if($(this).parent(".parent").hasClass("collapsed")){
				e.preventDefault();
				$(this).parent(".parent").removeClass("collapsed").addClass("expanded").find("ul").slideDown("fast");
			}
		});
	}
	// Tumblr Style Scroll-to-top Link

	// hide #back-top first
	$("#backtotop").hide();
	//hide it on the design form
	if ($(".design_email_form").length < 1){
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#backtotop').fadeIn();
				} else {
					$('#backtotop').fadeOut();
				}
			});
	
			// scroll body to 0px on click
			$('#backtotop a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
	}
});
// Reset onload element widths and event bindings that have to do with widths on browser resize
$(window).resize(function(){
	// Resize the search input so that it fills all available space in the navbar
	if ($("#main-nav,#header-search").length > 0 && window.innerWidth > 979){
		navbarSearchWidth(true);
	}
	
	// Sliders for showroom, category sections
	if($(".slider").length > 0 && window.innerWidth > 979){
		initializeSlider();
	}
	
	// Thumbnail / Large Image Switcher for showroom and product detail pages
	if ($("a.image-switch-thumb, .image-switch-large").length > 0){
		initializeSwitcher();
	}
//	// detect whether or not to show the small-screen width menu, make other responsive adjustments
	if (window.innerWidth < 979){
		responsiveNavAdjustments();
		navbarSearchWidth(false);
	}
	if (window.innerWidth < 979 && window.innerWidth > 767){
		makeTabletGridFluid();
	}
	else if (window.innerWidth < 767 || window.innerWidth > 979){
		removeTabletFluidGrid();	
	}
//	else {
//		isMobile = false;
//		//remove the mobile menu
//		if ( $("header nav#navigation").length <= 0){
//			$("#navigation.mm-is-menu").remove();
//			$(navigation).appendTo("header.container");
//			//remove the account from top nav
//			if ($("header nav.top-nav ul .account").length > 0){
//				$("header nav.top-nav ul .account").remove();
//			}
//		}
//		//get rid of event bound to footer, unnecessary expand icon
//		if ($("footer .row.footer-bottom-row h5 i").length > 0){
//			$("footer .row.footer-bottom-row h5 i").remove();
//			$("footer .row.footer-bottom-row h5").unbind("click")
//		}
//	}

});
// Replacing the deprecated toggle functionality...
$.fn.toggleFuncs = function() {
    var functions = Array.prototype.slice.call(arguments),
    _this = this.click(function(){
        var i = _this.data('func_count') || 0;
        functions[i%functions.length]();
        _this.data('func_count', i+1);
    });
}
// Adding a case-insensitive :contains selector
$.expr[":"].containsCI = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});


// All of the Bootstrap Components being used are below.

/* ===================================================
 * bootstrap-transition.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#transitions
 * ===================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


  /* CSS TRANSITION SUPPORT (http://www.modernizr.com/)
   * ======================================================= */

  $(function () {

    $.support.transition = (function () {

      var transitionEnd = (function () {

        var el = document.createElement('bootstrap')
          , transEndEventNames = {
               'WebkitTransition' : 'webkitTransitionEnd'
            ,  'MozTransition'    : 'transitionend'
            ,  'OTransition'      : 'oTransitionEnd otransitionend'
            ,  'transition'       : 'transitionend'
            }
          , name

        for (name in transEndEventNames){
          if (el.style[name] !== undefined) {
            return transEndEventNames[name]
          }
        }

      }())

      return transitionEnd && {
        end: transitionEnd
      }

    })()

  })

}(window.jQuery);/* ========================================================
 * bootstrap-tab.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#tabs
 * ========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* TAB CLASS DEFINITION
  * ==================== */

  var Tab = function (element) {
    this.element = $(element)
  }

  Tab.prototype = {

    constructor: Tab

  , show: function () {
      var $this = this.element
        , $ul = $this.closest('ul:not(.dropdown-menu)')
        , selector = $this.attr('data-target')
        , previous
        , $target
        , e

      if (!selector) {
        selector = $this.attr('href')
        selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
      }

      if ( $this.closest('li').hasClass('active') ) return

      previous = $ul.find('.active:last a')[0]

      e = $.Event('show', {
        relatedTarget: previous
      })

      $this.trigger(e)

      if (e.isDefaultPrevented()) return

      $target = $(selector)

      this.activate($this.closest('li'), $ul)
      this.activate($target, $target.parent(), function () {
        $this.trigger({
          type: 'shown'
        , relatedTarget: previous
        })
      })
    }

  , activate: function ( element, container, callback) {
      var $active = container.find('> .active')
        , transition = callback
            && $.support.transition
            && $active.hasClass('fade')

      function next() {
        $active
          .removeClass('active')
          .find('> .dropdown-menu > .active')
          .removeClass('active')

        element.addClass('active')

        if (transition) {
          element[0].offsetWidth // reflow for transition
          element.addClass('in')
        } else {
          element.removeClass('fade')
        }

        if ( element.parent('.dropdown-menu') ) {
          element.closest('li.dropdown').addClass('active')
        }

        callback && callback()
      }

      transition ?
        $active.one($.support.transition.end, next) :
        next()

      $active.removeClass('in')
    }
  }


 /* TAB PLUGIN DEFINITION
  * ===================== */

  var old = $.fn.tab

  $.fn.tab = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tab')
      if (!data) $this.data('tab', (data = new Tab(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tab.Constructor = Tab


 /* TAB NO CONFLICT
  * =============== */

  $.fn.tab.noConflict = function () {
    $.fn.tab = old
    return this
  }


 /* TAB DATA-API
  * ============ */

  $(document).on('click.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function (e) {
    e.preventDefault()
    $(this).tab('show')
  })

}(window.jQuery);

/* ==========================================================
 * bootstrap-carousel.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#carousel
 * ==========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* CAROUSEL CLASS DEFINITION
  * ========================= */

  var Carousel = function (element, options) {
    this.$element = $(element)
    this.options = options
    this.options.pause == 'hover' && this.$element
      .on('mouseenter', $.proxy(this.pause, this))
      .on('mouseleave', $.proxy(this.cycle, this))
  }

  Carousel.prototype = {

    cycle: function (e) {
      if (!e) this.paused = false
      this.options.interval
        && !this.paused
        && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
      return this
    }

  , to: function (pos) {
      var $active = this.$element.find('.item.active')
        , children = $active.parent().children()
        , activePos = children.index($active)
        , that = this

      if (pos > (children.length - 1) || pos < 0) return

      if (this.sliding) {
        return this.$element.one('slid', function () {
          that.to(pos)
        })
      }

      if (activePos == pos) {
        return this.pause().cycle()
      }

      return this.slide(pos > activePos ? 'next' : 'prev', $(children[pos]))
    }

  , pause: function (e) {
      if (!e) this.paused = true
      if (this.$element.find('.next, .prev').length && $.support.transition.end) {
        this.$element.trigger($.support.transition.end)
        this.cycle()
      }
      clearInterval(this.interval)
      this.interval = null
      return this
    }

  , next: function () {
      if (this.sliding) return
      return this.slide('next')
    }

  , prev: function () {
      if (this.sliding) return
      return this.slide('prev')
    }

  , slide: function (type, next) {
      var $active = this.$element.find('.item.active')
        , $next = next || $active[type]()
        , isCycling = this.interval
        , direction = type == 'next' ? 'left' : 'right'
        , fallback  = type == 'next' ? 'first' : 'last'
        , that = this
        , e

      this.sliding = true

      isCycling && this.pause()

      $next = $next.length ? $next : this.$element.find('.item')[fallback]()

      e = $.Event('slide', {
        relatedTarget: $next[0]
      })

      if ($next.hasClass('active')) return

      if ($.support.transition && this.$element.hasClass('slide')) {
        this.$element.trigger(e)
        if (e.isDefaultPrevented()) return
        $next.addClass(type)
        $next[0].offsetWidth // force reflow
        $active.addClass(direction)
        $next.addClass(direction)
        this.$element.one($.support.transition.end, function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () { that.$element.trigger('slid') }, 0)
        })
      } else {
        this.$element.trigger(e)
        if (e.isDefaultPrevented()) return
        $active.removeClass('active')
        $next.addClass('active')
        this.sliding = false
        this.$element.trigger('slid')
      }

      isCycling && this.cycle()

      return this
    }

  }


 /* CAROUSEL PLUGIN DEFINITION
  * ========================== */

  var old = $.fn.carousel

  $.fn.carousel = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('carousel')
        , options = $.extend({}, $.fn.carousel.defaults, typeof option == 'object' && option)
        , action = typeof option == 'string' ? option : options.slide
      if (!data) $this.data('carousel', (data = new Carousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (action) data[action]()
      else if (options.interval) data.cycle()
    })
  }

  $.fn.carousel.defaults = {
    interval: 5000
  , pause: 'hover'
  }

  $.fn.carousel.Constructor = Carousel


 /* CAROUSEL NO CONFLICT
  * ==================== */

  $.fn.carousel.noConflict = function () {
    $.fn.carousel = old
    return this
  }

 /* CAROUSEL DATA-API
  * ================= */

  $(document).on('click.carousel.data-api', '[data-slide]', function (e) {
    var $this = $(this), href
      , $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
      , options = $.extend({}, $target.data(), $this.data())
    $target.carousel(options)
    e.preventDefault()
  })

}(window.jQuery);
/* ===========================================================
 * bootstrap-tooltip.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#tooltips
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* TOOLTIP PUBLIC CLASS DEFINITION
  * =============================== */

  var Tooltip = function (element, options) {
    this.init('tooltip', element, options)
  }

  Tooltip.prototype = {

    constructor: Tooltip

  , init: function (type, element, options) {
      var eventIn
        , eventOut

      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.enabled = true

      if (this.options.trigger == 'click') {
        this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
      } else if (this.options.trigger != 'manual') {
        eventIn = this.options.trigger == 'hover' ? 'mouseenter' : 'focus'
        eventOut = this.options.trigger == 'hover' ? 'mouseleave' : 'blur'
        this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
      }

      this.options.selector ?
        (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
        this.fixTitle()
    }

  , getOptions: function (options) {
      options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay
        , hide: options.delay
        }
      }

      return options
    }

  , enter: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.show) return self.show()

      clearTimeout(this.timeout)
      self.hoverState = 'in'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'in') self.show()
      }, self.options.delay.show)
    }

  , leave: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (this.timeout) clearTimeout(this.timeout)
      if (!self.options.delay || !self.options.delay.hide) return self.hide()

      self.hoverState = 'out'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'out') self.hide()
      }, self.options.delay.hide)
    }

  , show: function () {
      var $tip
        , inside
        , pos
        , actualWidth
        , actualHeight
        , placement
        , tp

      if (this.hasContent() && this.enabled) {
        $tip = this.tip()
        this.setContent()

        if (this.options.animation) {
          $tip.addClass('fade')
        }

        placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement

        inside = /in/.test(placement)

        $tip
          .detach()
          .css({ top: 0, left: 0, display: 'block' })
          .insertAfter(this.$element)

        pos = this.getPosition(inside)

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight

        switch (inside ? placement.split(' ')[1] : placement) {
          case 'bottom':
            tp = {top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'top':
            tp = {top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width}
            break
        }

        $tip
          .offset(tp)
          .addClass(placement)
          .addClass('in')
      }
    }

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()

      $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
      $tip.removeClass('fade in top bottom left right')
    }

  , hide: function () {
      var that = this
        , $tip = this.tip()

      $tip.removeClass('in')

      function removeWithAnimation() {
        var timeout = setTimeout(function () {
          $tip.off($.support.transition.end).detach()
        }, 500)

        $tip.one($.support.transition.end, function () {
          clearTimeout(timeout)
          $tip.detach()
        })
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        removeWithAnimation() :
        $tip.detach()

      return this
    }

  , fixTitle: function () {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
      }
    }

  , hasContent: function () {
      return this.getTitle()
    }

  , getPosition: function (inside) {
      return $.extend({}, (inside ? {top: 0, left: 0} : this.$element.offset()), {
        width: this.$element[0].offsetWidth
      , height: this.$element[0].offsetHeight
      })
    }

  , getTitle: function () {
      var title
        , $e = this.$element
        , o = this.options

      title = $e.attr('data-original-title')
        || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

      return title
    }

  , tip: function () {
      return this.$tip = this.$tip || $(this.options.template)
    }

  , validate: function () {
      if (!this.$element[0].parentNode) {
        this.hide()
        this.$element = null
        this.options = null
      }
    }

  , enable: function () {
      this.enabled = true
    }

  , disable: function () {
      this.enabled = false
    }

  , toggleEnabled: function () {
      this.enabled = !this.enabled
    }

  , toggle: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)
      self[self.tip().hasClass('in') ? 'hide' : 'show']()
    }

  , destroy: function () {
      this.hide().$element.off('.' + this.type).removeData(this.type)
    }

  }


 /* TOOLTIP PLUGIN DEFINITION
  * ========================= */

  var old = $.fn.tooltip

  $.fn.tooltip = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tooltip')
        , options = typeof option == 'object' && option
      if (!data) $this.data('tooltip', (data = new Tooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tooltip.Constructor = Tooltip

  $.fn.tooltip.defaults = {
    animation: true
  , placement: 'top'
  , selector: false
  , template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
  , trigger: 'hover'
  , title: ''
  , delay: 0
  , html: false
  }


 /* TOOLTIP NO CONFLICT
  * =================== */

  $.fn.tooltip.noConflict = function () {
    $.fn.tooltip = old
    return this
  }

}(window.jQuery);
/* ============================================================
 * bootstrap-dropdown.js v2.2.2
 * http://twitter.github.com/bootstrap/javascript.html#dropdowns
 * ============================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================ */


!function ($) {

  "use strict"; // jshint ;_;


 /* DROPDOWN CLASS DEFINITION
  * ========================= */

  var toggle = '[data-toggle=dropdown]'
    , Dropdown = function (element) {
        var $el = $(element).on('click.dropdown.data-api', this.toggle)
        $('html').on('click.dropdown.data-api', function () {
          $el.parent().removeClass('open')
        })
      }

  Dropdown.prototype = {

    constructor: Dropdown

  , toggle: function (e) {
      var $this = $(this)
        , $parent
        , isActive

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      clearMenus()

      if (!isActive) {
        $parent.toggleClass('open')
      }

      $this.focus()

      return false
    }

  , keydown: function (e) {
      var $this
        , $items
        , $active
        , $parent
        , isActive
        , index

      if (!/(38|40|27)/.test(e.keyCode)) return

      $this = $(this)

      e.preventDefault()
      e.stopPropagation()

      if ($this.is('.disabled, :disabled')) return

      $parent = getParent($this)

      isActive = $parent.hasClass('open')

      if (!isActive || (isActive && e.keyCode == 27)) return $this.click()

      $items = $('[role=menu] li:not(.divider):visible a', $parent)

      if (!$items.length) return

      index = $items.index($items.filter(':focus'))

      if (e.keyCode == 38 && index > 0) index--                                        // up
      if (e.keyCode == 40 && index < $items.length - 1) index++                        // down
      if (!~index) index = 0

      $items
        .eq(index)
        .focus()
    }

  }

  function clearMenus() {
    $(toggle).each(function () {
      getParent($(this)).removeClass('open')
    })
  }

  function getParent($this) {
    var selector = $this.attr('data-target')
      , $parent

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && /#/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') //strip for ie7
    }

    $parent = $(selector)
    $parent.length || ($parent = $this.parent())

    return $parent
  }


  /* DROPDOWN PLUGIN DEFINITION
   * ========================== */

  var old = $.fn.dropdown

  $.fn.dropdown = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('dropdown')
      if (!data) $this.data('dropdown', (data = new Dropdown(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  $.fn.dropdown.Constructor = Dropdown


 /* DROPDOWN NO CONFLICT
  * ==================== */

  $.fn.dropdown.noConflict = function () {
    $.fn.dropdown = old
    return this
  }


  /* APPLY TO STANDARD DROPDOWN ELEMENTS
   * =================================== */

  $(document)
    .on('click.dropdown.data-api touchstart.dropdown.data-api', clearMenus)
    .on('click.dropdown touchstart.dropdown.data-api', '.dropdown form', function (e) { e.stopPropagation() })
    .on('touchstart.dropdown.data-api', '.dropdown-menu', function (e) { e.stopPropagation() })
    .on('click.dropdown.data-api touchstart.dropdown.data-api'  , toggle, Dropdown.prototype.toggle)
    .on('keydown.dropdown.data-api touchstart.dropdown.data-api', toggle + ', [role=menu]' , Dropdown.prototype.keydown)

}(window.jQuery);
!function ($) {

  "use strict"; // jshint ;_;


 /* POPOVER PUBLIC CLASS DEFINITION
  * =============================== */

  var Popover = function (element, options) {
    this.init('popover', element, options)
  }


  /* NOTE: POPOVER EXTENDS BOOTSTRAP-TOOLTIP.js
     ========================================== */

  Popover.prototype = $.extend({}, $.fn.tooltip.Constructor.prototype, {

    constructor: Popover

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()
        , content = this.getContent()

      $tip.find('.popover-title')[this.options.html ? 'html' : 'text'](title)
      $tip.find('.popover-content')[this.options.html ? 'html' : 'text'](content)

      $tip.removeClass('fade top bottom left right in')
    }

  , hasContent: function () {
      return this.getTitle() || this.getContent()
    }

  , getContent: function () {
      var content
        , $e = this.$element
        , o = this.options

      content = $e.attr('data-content')
        || (typeof o.content == 'function' ? o.content.call($e[0]) :  o.content)

      return content
    }

  , tip: function () {
      if (!this.$tip) {
        this.$tip = $(this.options.template)
      }
      return this.$tip
    }

  , destroy: function () {
      this.hide().$element.off('.' + this.type).removeData(this.type)
    }

  })


 /* POPOVER PLUGIN DEFINITION
  * ======================= */

  var old = $.fn.popover

  $.fn.popover = function (option) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('popover')
        , options = typeof option == 'object' && option
      if (!data) $this.data('popover', (data = new Popover(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.popover.Constructor = Popover

  $.fn.popover.defaults = $.extend({} , $.fn.tooltip.defaults, {
    placement: 'right'
  , trigger: 'click'
  , content: ''
  , template: '<div class="popover"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"></div></div></div>'
  })


 /* POPOVER NO CONFLICT
  * =================== */

  $.fn.popover.noConflict = function () {
    $.fn.popover = old
    return this
  }

}(window.jQuery);