// Keep Editing Actions Fixed to page top on scroll
$(document).ready(function(){
	var controls = $('.page_actions');
	var cancelscroll = $('.page_actions.cancelscroll');
	var tablehead = $('.data_table thead:first');
	var sidebar = $(".manage_side_nav");
	var editpage = $('.edit_page');
	var canscrolltablehead = false;
	// only execute if we're on a page that has the sidebar.
	if (sidebar.length > 0){
		var navheight = 0;
		$.each($("#manage_navigation > li > a"), function(){
			navheight = navheight + $(this).outerHeight(true) + 12;
		});
		var trueheight = navheight + $("#manage_navigation > li > a.active").closest("li").find("ul").innerHeight() + 10;
		var sbw = $(sidebar).width() -15;
		var sidebarWidth = sbw + "px";
		if (trueheight < $(window).height() && trueheight < $(".manage_main").innerHeight()){
			$("ul#manage_navigation").css({"position":"fixed", "width":sidebarWidth, "background-color":"white", "z-index": "600"});
		}
		else {
			$("ul#manage_navigation").css({"position":"static"});
		}
	}
	// only execute if we're on a page that has page actions.
	
	if (controls.length > 0 && cancelscroll.length == 0){
		var currentY = $(window).scrollTop();
		var alreadyScrolled = false;
		var originalCoords = $(controls).parent().offset();
		var originalTop = originalCoords.top;
		var leftcoords = $(controls).offset().left;
			leftcoords = "-"+leftcoords.toString()+"px"
		var originalParent = $(controls).parent();
		//console.log(originalTop);
		$(window).scroll(function(){
			setInterval(function(){checkPosition()},400);
			$(window).unbind('scroll');
		});
		if (tablehead.length > 0 && tablehead.length < 2){
			var tableRows = $('.data_table table tr');
			var tableRowNum = tableRows.length;
			var tableCoords = $(tablehead).parent().offset();
			var tableOriginalTop = tableCoords.top;
			if (tableRowNum > 7){
				var scrollTableHead = $(tablehead).clone();
				var widths = [];
				var i = 0;
				$(tablehead).find("th").each(function(){
					widths[i] = $(this).width();
					i++;
				});
				if (widths.length > 0 && editpage.length < 1){
					i = 0;
					$(scrollTableHead).find("th").each(function(){
						$(this).width(widths[i]);
						i++;
						if (!$(".manage_page_container").hasClass("lightbox")){
							canscrolltablehead = true;
						}
					});
					$(scrollTableHead).addClass("scroller").width($(".data_table table").width());
				}				
			}
				
		}
		function checkPosition(){
			currentY = $(window).scrollTop();
			if(currentY > originalTop && !alreadyScrolled){
				if ($(controls).attr("class").indexOf("edit_page") != -1 ){
					$(controls).addClass("affixed-right").css({"right":"-30px"});
				}
				else {
					$(controls).addClass("affixed-left").css({"left":"-20px"}).before("<span class='placeholder'></span>").detach();
					$(".manage_page_container").prepend(controls);	
				}
				alreadyScrolled = true;
			}
			if(alreadyScrolled){
				var controlTop = $(controls).css("top");
					controlTop = controlTop.replace("px","");
				if ((controlTop != currentY-originalTop) &&(controlTop != currentY) ) {
						reposition(currentY,originalTop);
				}
				if (canscrolltablehead){
					if ($(".scroller").length < 1){
						$(".data_table table").css("position","relative").prepend(scrollTableHead);
					}
					scrolltablehead();
				}
			}
		}
		function reposition(y,oy){
			if (y>oy) {
				if ($(controls).hasClass("affixed-right")){
					y = (y-oy) -30;
				}
				else if ($(controls).hasClass("affixed-left")){
					y = (y-oy) +110;
				}
				$(controls).animate({ "top": y},200);
			}
			else {
				if ($(controls).hasClass("edit_page")){
					$(controls).removeClass("affixed-right").attr("style","");
				} else {
					$(controls).removeClass("affixed-left").attr("style","").detach();
					$(originalParent).find(".placeholder:first").after(controls);
				}
				alreadyScrolled = false;	
			}
		}
		function scrolltablehead(){
			if(currentY > originalTop && $(".scroller").length > 0){
				$(scrollTableHead).fadeIn("fast");
			}
			else if(currentY <= originalTop){
				$(".scroller").detach();
			}
		}
	}
});