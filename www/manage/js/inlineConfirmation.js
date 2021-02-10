// Inline Confirmation Script
// SJC V1.2 09/05/2012
$(document).ready(function(){
	var itemId;
	var itemId2;
	
	
	var itemContent;
	var itemDescription;
	
	if ($(".confirm").length > 0){
		$(".confirm-content .dismiss").click(function(e){
			$(".confirm-content").fadeOut("fast");
		});
		$(".confirm").click(function(e){
			e.preventDefault();
			if (!$(this).hasClass("disabled")){
				if ($(this).hasClass("logo-delete")){
					var imageID = $(this).find("input.imgId").attr("id");
					var imageURL = $(this).find("input.imgId").val();
					var addImage = "<img src=\""+imageURL+"\" />";
					$("#logo-delete .imgPlaceholder").empty().append(addImage);
					$("#logo-delete #del_logo_id").val(imageID);
					$("#logo-delete").hide().fadeIn("fast");
				}
				else if ($(this).hasClass('confirm-deactivate')){
					if ($(this).find("input.itemId").length > 0){
						itemID = $(this).find("input.itemId").val();
						$("#content-deactivate .itemId").val(itemID);
						//alert("itemId"+val(itemID));
					}
					$("#content-deactivate").hide().fadeIn("fast");
				}
				else if ($(this).hasClass('confirm-edit')){
					/*
					itemID = $(this).find("input.itemId").val();
					$("#content-edit .itemId").val(itemID);
					itemContent = $(this).find("input.contentToEdit").val();
					if ($(this).find("input.descriptionToEdit").length > 0){
						itemDescription = $(this).find("input.descriptionToEdit").val();
					}
					$("#content-edit .contentToEdit").val(itemContent);
					$("#content-edit .descriptionToEdit").text(itemDescription);
					$("#content-edit").hide().fadeIn("fast");
					*/
					
					//alert("rrr");
					
					if ($(this).find("input.itemId").length > 0){
						
						//alert("itemId");
						
						itemID = $(this).find("input.itemId").val();
						
						$("#content-edit .itemId").val(itemID);
						
					}
					
					if ($(this).find("input.contentToEdit").length > 0){
						itemContent = $(this).find("input.contentToEdit").val();
						
						//alert("itemContent  "+itemContent);
						
						$("#content-edit .contentToEdit").val(itemContent);
						//alert("contentToEdit"+val(itemContent));
					}
					if ($(this).find("input.descriptionToEdit").length > 0){
						itemDescription = $(this).find("input.descriptionToEdit").val();
						$("#content-edit .descriptionToEdit").text(itemDescription);
						//alert("contentToEdit"+val(itemDescription));
					}
								
					$("#content-edit").hide().fadeIn("fast");

				}
				else if ($(this).hasClass('confirm-add')){
					$("#content-add").hide().fadeIn("fast");
				}
				else if ($(this).hasClass('image-delete')){
					var imageID = $(this).find("input.imgId").attr("id");
					var imageFile = $(this).find("input.imgId").val();
					$("#image-delete .fileName").val(imageFile);
					$("#image-delete .imageId").val(imageID);
					$("#image-delete").hide().fadeIn("fast");
				}
				/*
				else if ($(this).hasClass('no-item')){
					$("#content-delete").hide().fadeIn("fast");
				}
				*/
				else {
					if ($(this).find("input.itemId").length > 0){
						itemID = $(this).find("input.itemId").val();
						$("#content-delete .itemId").val(itemID);
					}
					if ($(this).find("input.itemId2").length > 0){
						itemID2 = $(this).find("input.itemId2").val();
						
						
						
						
						$("#content-delete .itemId2").val(itemID2);
					}
					
					
					$("#content-delete").hide().fadeIn("fast");
				}
			}
			else {				
				if ($(".disabledMsg").length > 0 ){
					$(".disabledMsg").hide().fadeIn("fast").delay(1500).fadeOut("fast");
				}
				else {
					alert("This item can't be deleted or inactive.")	
				}
			}
		});
	}




	if($(".confirm2").length > 0){
		
		$(".confirm-content2 .dismiss").click(function(e){
			$(".confirm-content2").fadeOut("fast");
		});
		$(".confirm-content .dismiss").click(function(e){
			$(".confirm-content").fadeOut("fast");
		});
		
		$(".confirm2").click(function(e){
			e.preventDefault();
					
				
				
					
					
			if(!$(this).hasClass("disabled")){
				
				
				
				if ($(this).find("input.itemId").length > 0){
					itemID = $(this).find("input.itemId").val();
					$("#content-delete2 .itemId").val(itemID);
					
					$("#content-delete2").hide().fadeIn("fast");
				}
				if ($(this).find("input.itemId2").length > 0){
					itemID2 = $(this).find("input.itemId2").val();
					$("#content-delete2 .itemId2").val(itemID2);
					
					$("#content-delete2").hide().fadeIn("fast");
				}
			
				if ($(this).hasClass('confirm-add2')){
					
					
				
					$("#content-add2").hide().fadeIn("fast");
					
					
					
				}
			}
			
			else {				
				if ($(".disabledMsg").length > 0 ){
					$(".disabledMsg").hide().fadeIn("fast").delay(1500).fadeOut("fast");
				}
				else {
					alert("This item can't be deleted or inactive.")	
				}
			}
		});
	}



	if ($(".confirm3").length > 0){
		$(".confirm-content3 .dismiss").click(function(e){
			$(".confirm-content3").fadeOut("fast");
		});
		$(".confirm-content .dismiss").click(function(e){
			$(".confirm-content").fadeOut("fast");
		});
		$(".confirm3").click(function(e){
			e.preventDefault();
					
			if (!$(this).hasClass("disabled")){
				
				if ($(this).find("input.itemId").length > 0){
					itemID = $(this).find("input.itemId").val();
					$("#content-delete3 .itemId").val(itemID);
					
					$("#content-delete3").hide().fadeIn("fast");
				}
				if ($(this).find("input.itemId2").length > 0){
					itemID2 = $(this).find("input.itemId2").val();
					$("#content-delete3 .itemId2").val(itemID2);
					
					$("#content-delete3").hide().fadeIn("fast");
				}
			
				if ($(this).hasClass('confirm-add3')){
				
					$("#content-add3").hide().fadeIn("fast");
				}
			}
			
			else {				
				if ($(".disabledMsg").length > 0 ){
					$(".disabledMsg").hide().fadeIn("fast").delay(1500).fadeOut("fast");
				}
				else {
					alert("This item can't be deleted or inactive.")	
				}
			}
		});
	}


	if($(".confirm4").length > 0){
		
		
		$(".confirm-content4 .dismiss").click(function(e){
			$(".confirm-content4").fadeOut("fast");
		});
		$(".confirm-content .dismiss").click(function(e){
			$(".confirm-content").fadeOut("fast");
		});
		$(".confirm4").click(function(e){
			e.preventDefault();
					
			if (!$(this).hasClass("disabled")){
				
				if ($(this).find("input.itemId").length > 0){
					itemID = $(this).find("input.itemId").val();
					$("#content-delete4 .itemId").val(itemID);
					
					$("#content-delete4").hide().fadeIn("fast");
				}
				if ($(this).find("input.itemId2").length > 0){
					
					itemID2 = $(this).find("input.itemId2").val();
					
					
					$("#content-delete4 .itemId2").val(itemID2);
					
					$("#content-delete4").hide().fadeIn("fast");
				}
			
				if ($(this).hasClass('confirm-add4')){
				
					$("#content-add4").hide().fadeIn("fast");
				}
			}
			
			else {				
				if ($(".disabledMsg").length > 0 ){
					$(".disabledMsg").hide().fadeIn("fast").delay(1500).fadeOut("fast");
				}
				else {
					alert("This item can't be deleted or inactive.")	
				}
			}
		});
	}




});

function callConfirmDelete(the_id){
	$("#content-delete .itemId").val(the_id);
	$("#content-delete").hide().fadeIn("fast");
}

function callConfirmDismiss(){
	$(".confirm-content").fadeOut("fast");	
}
