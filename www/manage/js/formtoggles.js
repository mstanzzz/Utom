$(document).ready(function(){
	// Radio Toggle Script V 1.2 SJC 08-24-2012
	
		updateAllRadio();
		$(".radiotoggle").click(
			function(e){
				e.preventDefault();
				if (!$(this).hasClass("disabled")){
					if ($(this).hasClass("on")){
						$(this).switchClass("on", "off", 200);
						$(this).find(".switch").animate({right: "38px"},300).css("left","auto");
						$(this).find("input.radioinput").attr("checked", false);
					}
					else if ($(this).hasClass("off")){
						$(this).switchClass("off", "on", 200);
						$(this).find(".switch").animate({left: "38px"},300).css("right","auto");
						$(this).find("input.radioinput").attr("checked", true);
					}
					updateAllRadio();
				}
				else {
					displayDisabledMsg();	
				}
			}
		);
		function updateAllRadio(){
			$(".radiotoggle input.radioinput").each(function(){
				if ($(this).is(":checked")) {
					$(this).closest(".radiotoggle").removeClass("off").addClass("on");
					$(this).siblings(".switch").css({position: "absolute", top: "2px", right: "2px"});
				}
				else {
					$(this).closest(".radiotoggle").removeClass("on").addClass("off");
					$(this).siblings(".switch").css({position: "absolute", top: "2px", left: "2px"});
				}
			});
		}
	
	// End Radio Toggle Script	
	// Checkbox Toggle Script V 1.2 SJC 08-24-2012
		$(".checkboxtoggle input.checkboxinput").each(function(){
			if ($(this).is(":checked")) {
				$(this).closest(".checkboxtoggle").removeClass("off").addClass("on");
				$(this).siblings(".switch").css({position: "absolute", top: "2px", right: "2px"});
			}
			else {
				$(this).closest(".checkboxtoggle").removeClass("on").addClass("off");
				$(this).siblings(".switch").css({position: "absolute", top: "2px", left: "2px"});
			}
		});
		$(".checkboxtoggle").click(
			function(e){
				e.preventDefault();
				if (!$(this).hasClass("disabled")){
					if ($(this).hasClass("on")){
						$(this).switchClass("on", "off", 200);
						$(this).find(".switch").animate({right: "38px"},300).css("left","auto");
						//$(this).find("input.checkboxinput").removeAttr("checked").val("0");
						$(this).find("input.checkboxinput").removeAttr("checked");
					}
					else if ($(this).hasClass("off")){
						$(this).switchClass("off", "on", 200);
						$(this).find(".switch").animate({left: "38px"},300).css("right","auto");
						//$(this).find("input.checkboxinput").attr("checked", "checked").val("1");
						$(this).find("input.checkboxinput").attr("checked", "checked");
					}
				}
				else {
					displayDisabledMsg();	
				}
			}
		);
	//End Checkbox Toggle Script
	// Begin Display Disabled Msg Script
	function displayDisabledMsg(){
		if ($(".disabledMsg").length > 0 ){
			$(".disabledMsg").hide().fadeIn("fast").delay(1500).fadeOut("fast");
		}
		else {
			alert("This item can't be deleted or inactive.")	
		}
	}
	//initialize the select widgets
	$("select[multiple]").not(".selectedCats").multiselect({selectedList: 4}).multiselectfilter();
	$("select").not("[multiple]").multiselect({multiple: false, selectedList: 1}).multiselectfilter();
	$(".selectedCats").chosen();
	
	//Begin Fieldset Slide Script V 1.2 SJC 08-31-2012
	$(".edit_page fieldset legend, .seo_bc_content fieldset legend").click(function(){
		$(this).closest("fieldset").find("div.colcontainer").toggle("fast");
		$(this).closest("fieldset").find("table").toggle("fast");
		$(this).closest("fieldset").find("div.alert").toggle("fast");
		var currentIcon = $(this).find("i").attr("class");
		if (currentIcon == "icon-minus-sign icon-white"){
			$(this).find("i").attr("class","icon-plus-sign icon-white");
			$(this).closest("fieldset").addClass("collapsed");
		}
		else {
			$(this).find("i").attr("class","icon-minus-sign icon-white");	
			$(this).closest("fieldset").removeClass("collapsed");
		}
	});
	$('.toggleFieldsets').click(function(e){
		e.preventDefault();
		var currentText = $(this).text();
		var areastocollapse = $(".edit_page fieldset div.colcontainer, .edit_page fieldset div.alert, .edit_page fieldset div#display, .edit_page fieldset table, .edit_page fieldset div.location_container, .edit_page fieldset div.location_container, .seo_bc_content fieldset div.colcontainer, .seo_bc_content fieldset div.alert, .seo_bc_content fieldset div#display, .seo_bc_content fieldset table, .seo_bc_content fieldset div.location_container, .seo_bc_content fieldset div.location_container");
		if (currentText.indexOf("Collapse") != -1) {
			currentText = currentText.replace("Collapse", "Expand");
			$(this).text(currentText).prepend("<i class='icon-plus-sign icon-white'></i> ");
			$(areastocollapse).slideUp("fast");
			$(".edit_page fieldset legend i").attr("class","icon-plus-sign icon-white");
			$(".edit_page fieldset").addClass("collapsed");
			$("ul#manage_navigation").css("position","static");
		}
		else {
			currentText = currentText.replace("Expand", "Collapse");
			$(this).text(currentText).prepend("<i class='icon-minus-sign icon-white'></i> ");;
			$(areastocollapse).slideDown("fast");
			$(".edit_page fieldset legend i").attr("class","icon-minus-sign icon-white");
			$(".edit_page fieldset").removeClass("collapsed");
			var sidebar = $(".manage_side_nav");
			var viewportHeight = $(window).height() + "px";
			var sidebarWidth = $(sidebar).width() + "px";
			var sidebarHeight = $(sidebar).height() + "px";
			var contentHeight = $(".manage_main").height() -200;
			$("ul#manage_navigation").css({"position":"fixed", "width":sidebarWidth, "background-color":"white"});
		}
	});
	//End Fieldset Slide Script 
	// Begin editible submenu show/hide script SJC v 1.0 08-29-2012
	$("input[name='submenu_content_type']").parent().click(function(){
		if ($("input[name='submenu_content_type'][value='3']").is(":checked")) {
		$(".editable_subnavigation").slideDown("fast");
		}
		else {
		$(".editable_subnavigation").slideUp("fast");
		}
	});
	//end editable submenu show/hide script
	// Begin JumpMenu script v 1.0 SJC 09-05-2012
	$("select.jumpMenu").change(function(){
		var href = $(this).val();
		var offset = $(href).offset();
		var offsetTop = offset.top;
		jumpTo(offsetTop);
	});
	function jumpTo(pos){
		$('body, html').animate({scrollTop: pos},500);
	}
	// End JumpMenu Script
	
	if ($(".accordion").length > 0) {
		accordion();
	}
	
	// Add Additional Form Field Items  
	var c = 2;
    var copiedItem = $(".copy");
	var type = $("#copy_item_type").length > 0 ? $("#copy_item_type").val(): "Item";
    if ($(".add-one").length > 0) {
        bindAddOne(type);
		addRemover($(".add-one"));
    }
    if ($(".add-five").length > 0) {
        bindAddFive(type);
		addRemover($(".add-five"));
    }
	function addRemover(btn){
		if ($(".remove-all-added-items").length < 1){
			$(btn).siblings(".btn").last().after(" <a class='btn remove-all-added-items'><i class='icon-remove'></i> Remove All Added Fields</a>");
			$(".remove-all-added-items").click(function(){
				$(".added").remove();
				c = 2;
			});
		}
			
	}
	function bindAddFive(type) {
        $(".add-five").click(function (e) {
            e.preventDefault();
            for (i = 0; i < 5; i++) {
                $(".lightboxcontent").append(createCopy(c, type));
                c++;
            }

            $("select").not("[multiple]").multiselect({
                multiple: false,
                selectedList: 1
            }).multiselectfilter();
            $(".accordion-label").unbind("click");
            accordion();
            bindRemoveItems(type);
        });
    }
	function bindAddOne(type) {
        $(".add-one").click(function (e) {
            e.preventDefault();
            $(".lightboxcontent").append(createCopy(c,type));
            c++;
            $("select").not("[multiple]").multiselect({
                multiple: false,
                selectedList: 1
            }).multiselectfilter();
            $(".accordion-label").unbind("click");
            accordion();
            bindRemoveItems(type);
        });
    }

    function createCopy(num, type) {
        var cloned = copiedItem.clone();
        var w1 = "<div class='added'><h2><a href='#accordion_" + num + "' class='accordion-label'><i class='icon-minus-sign icon-white right'></i>New " + type + " " + num + "</h2></div>";
        var w2 = "<div class='accordion-content accordion-visible' id='accordion_" + num + "'><fieldset class=''><a href='#accordion_" + num + "' class='btn remove-" + type + " '><i class='icon-remove'></i> Remove </a></fieldset></div>";
        var content = $(w2).prepend(cloned);
        var adjusted = $(w1).append(content);
        adjusted.find(":input").each(function () {
            if ($(this).is(":button")) {
                $(this).remove();
            } else {
                var currentName = $(this).attr("name") ? $(this).attr("name") : "input_";
                var lastChar = currentName.indexOf("_") + 1;
                var newNameAttr = currentName.substr(0, lastChar) + num;
                $(this).attr("name", newNameAttr);
            }
        });
        return adjusted;
    }

    function bindRemoveItems(type) {
        $(".remove-" + type).click(function (e) {
            e.preventDefault();
            $(this).closest(".added").remove();
        });
    }
});
	// Begin Accordion Script SJC 05-09-2013
function accordion() {
    $(".accordion-label").click(function (e) {
        e.preventDefault();
        var target = $($(this).attr("href"));
        if (target.is(":visible")) {
            target.slideUp("fast");
            $(this).find("i").attr("class", "icon-plus-sign icon-white right");
        } else {
            target.slideDown("fast");
            $(this).find("i").attr("class", "icon-minus-sign icon-white right");
        }
    });
}
	//End Accordion Script
	