
function submit_per_page_form(obj){
	//$(".per_page_form").submit();
	
	obj.closest('form').submit();

}
function submit_sort_form(obj){
	//$(".sort_form").submit();
	obj.closest('form').submit();
}



// used in footer
/*
function make_scroll(section){
	if(section.indexOf("short") >= 0){
		$("#"+section).removeClass("foot_lower_container_short");
		$("#"+section).addClass("foot_lower_scroll_container_short");
		$("#"+section+"_more").hide();	
	}else{
		$("#"+section).removeClass("foot_lower_container");
		$("#"+section).addClass("foot_lower_scroll_container");
		$("#"+section+"_more").hide();
	}
}
*/


function openProgram(){
	var popurl="./app/";
	window.open(popurl,"","resizable=yes,scrollbars=no");
	location.href(popurl); 
}


// maybe get rid of this and use update_header_cart to do the whole thing
function update_item_count_top(count){	
	//alert("hhhhhh");
	$('#item_count_top').html(count);
	//$('#item_count_top').html("jkl");
}


function update_header_cart(count){	

}



function make_blank(ele)
{
	ele.value ="";
}


function defaultText(ele,str){
		
	if(ele.value == ""){
		
		ele.value = str;
	}
	
}


function isValidEmail(str) {
 
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(str);
}
function loadAJAX(url_str){
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		type: "GET",
		dataType: "html", 
		error: function(){
			//console.log("error loading ajax");
		},
		success: function(data) {
			//console.log(data);
			$("#items_content").html(data);
		}
	});
}
function appendAndLoadAJAX(url_str,obj){
	var missingQueryStr = obj.options[obj.selectedIndex].value;
	url_str = url_str+missingQueryStr;
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		type: "GET",
		dataType: "html", 
		error: function(){
			//console.log("error loading ajax");
		},
		success: function(data) {
			//console.log(data);
			$("#items_content").html(data);
		}
	});
}
function loadBrandsAJAX(url_str,id){
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		type: "GET",
		dataType: "html", 
		error: function(){
			//console.log("error loading ajax");
		},
		success: function(data) {
			//console.log(data);
			$(id).html(data);
		}
	});
}
$(document).ready(function() {

	//$("a.inline").fancybox();	
	
	
	//$("#get_pswd").click(function(){ $.fancybox.close;  })

/*	
	var ol_len = $('.overlay').length;
	var i;
	for(i=0;i<=ol_len;i++){
		$('#under_lay'+i).hover(
			function () {
				$(this).addClass('trans_overlay');
				$(this).removeClass('overlay');				
				//$(this).find(".hsb").css('color','black');
				
				
			},			
			function () {
				$(this).removeClass('trans_overlay');
				$(this).addClass('overlay');
				//$(this).find(".hsb").css('color','999999');
			}		
		);
	}

*/

/*
	$("#email_updates").click(function(){ 

		$("#eu_thankyou").html("");

		//alert("bbbb");							   
		var email = $("#email_updates_input").attr('value');
		//var email = $("#email_updates_input").val();
		//alert("value   "+email);

		if(!isValidEmail(email)){
			$("#eu_thankyou").html("<span style='color:#cf0623'>Please enter a valid email address</span>");
			
		}else{
		
		
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax-add-to-email-list.php?email='+email,
			  success: function(data) {
				//alert('Entered: '+data+'   Thank you.' );
				$("#eu_thankyou").html("<span style='color:#3f6e84'>Your request was sent. Thank you</span>");
				//alert("load");
			  }
			});

		
		}
		
	})	
	
*/	
	
	// Everything below is VERY bad practice, esp. concerning SEO. 
	// This is being deprecated and replaced with hyperlinked navigation.
/*
	$(".header_support_row").click(function(){ 

		var url = $(this).find(".r_sub").attr('id');					

		if(url.indexOf("http") > -1){
			window.open(url);
		}else{
			var $ste_root = $(this).find(".s_sub").attr('id');
			window.location = $ste_root+"/"+url;
		
		}
			
	})
*/
	
/*	
	$(".header_cart_row").click(function(){ 
		//var item_id = $(this).find(".i_sub").attr('id');
		//var cat_id = $(this).find(".c_sub").attr('id');			
		//var $ste_root = $(this).find(".r_sub").attr('id');			
		var url = $(this).find(".r_sub").attr('id');
		
		//alert(url);
		
		window.location = url;
		
		
		//window.location = $ste_root+"/closet-accessory-details/closets-accessory-item/"+item_id+"/"+cat_id;
	})

*/

/*
	$(".footer_nav_cats_li").click(function(){ 
		var cat_name = $(this).find(".n_sub").attr('id');
		var cat_id = $(this).find(".c_sub").attr('id');			
		var $ste_root = $(this).find(".r_sub").attr('id');
		var shop_name = $(this).find(".s_sub").attr('id');			
		//alert(cat_name);
		//window.location = $ste_root+"/storage-shop/category/"+cat_name+"/"+cat_id;
		window.location = $ste_root+"/"+shop_name+"/category/"+cat_name+"/"+cat_id;
	})

*/

/*	
	$(".nav_li_out").click(function(){ 
		var cat_name = $(this).find(".n_sub").attr('id');
		var cat_id = $(this).find(".c_sub").attr('id');			
		var $ste_root = $(this).find(".r_sub").attr('id');
		var shop_name = $(this).find(".s_sub").attr('id');			
		window.location = $ste_root+"/"+shop_name+"/category/"+cat_name+"/"+cat_id;
		
	})
*/	

/*
	$(".nav_li_in").click(function(){ 
	
		var cat_name = $(this).find(".n_sub").attr('id');
		var cat_id = $(this).find(".c_sub").attr('id');			
		var $ste_root = $(this).find(".r_sub").attr('id');
		window.location = $ste_root+"/"+shop_name+"/category/"+cat_name+"/"+cat_id;
		
	})
*/

/*	
	$(".nav_brand_li").click(function(){ 
	
		//alert("hhhh");
		var name = $(this).find(".n_sub").attr('id');
		var vend_man_id = $(this).find(".v_sub").attr('id');			
		var $ste_root = $(this).find(".r_sub").attr('id');			
		var shop_name = $(this).find(".s_sub").attr('id');			
		//alert(shop_name);
		//window.location = $ste_root+"/storage-shop/brand/"+name+"/"+vend_man_id;
		window.location = $ste_root+"/"+shop_name+"/brand/"+name+"/"+vend_man_id;

	})
*/

/*
   	$(".nav_rd_li").click(function(){ 
		
		var url = $(this).find(".s_sub").attr('id');			
		
		//alert(url);
		
		if(url.indexOf("http") > -1){
			window.open(url);
			
		}else{
			
			var $ste_root = $(this).find(".r_sub").attr('id');
			
			window.location = $ste_root+"/"+url;
		}
	})

*/	
	


	
})