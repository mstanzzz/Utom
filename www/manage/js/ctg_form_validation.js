// JavaScript Document
// By M. Stanz for ctg form validation

function show_not_valid(input_name, msg){
	
	if ($("#input_"+input_name).length > 0) {
		
		$("#input_"+input_name).css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#cf0623'
		});
	}
					
					
	$("#label_"+input_name).css('color', '#cf0623');
	$("#msg_"+input_name).html("<span style='font-size:11px; color:#cf0623;'>"+msg+"</span>");

}


function show_is_valid(input_name){

	if ($("#input_"+input_name).length > 0) {	
		$("#input_"+input_name).css({
					'border-width' : '1px'
					,'border-style' : 'solid'
					,'border-color' : '#c2c2c2'
		});
	}
	
	$("#label_"+input_name).css('color', '#565656');
	$("#msg_"+input_name).html(" ");	

}


function is_numeric(value)
{
	value = jQuery.trim(value);
	var ValidChars = "0123456789.";
	var IsNumber=true;
	var Char;
	
	if(value == ""){
		return false;
	}
	
	
	for (i = 0; i < value.length && IsNumber == true; i++) 
		{ 
			Char = value.charAt(i); 
			if (ValidChars.indexOf(Char) == -1) 
			{
				IsNumber = false;
			}
		}
	
	
	
	if (IsNumber){
		return true;	
	}else {
		return false;	
	}
}

function is_zero_to_one(value){
	
	if(value == ""){
		return false;		
	}
	if(!is_numeric(value)){		
		return false;
	}
	if(value > 1 || value < 0){		
		return false;	
	}
	return true;
}
