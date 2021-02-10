// Management Navigation Script

$(document).ready(function() {
	// SJC: The old script for now, so that the old navigation will still work.
	$(".accord1").click(function(){    
		$(".accord_body1").toggle("fast",function(){
			
		});
	});	
	$(".accord2").click(function(){ 
	
		$(".accord_body2").toggle("fast",function(){
			
		});
	});		
	$(".accord3").click(function(){    
		$(".accord_body3").toggle("fast",function(){
			
		});
	});	
	$(".accord4").click(function(){    
		$(".accord_body4").toggle("fast",function(){
			
		});
	});	
	$(".accord5").click(function(){    
		$(".accord_body5").toggle("fast",function(){
			
		});
	});	
	$(".accord6").click(function(){    
		$(".accord_body6").toggle("fast",function(){
			
		});
	});	
	$(".accord7").click(function(){    
		$(".accord_body7").toggle("fast",function(){
			
		});
	});
	$(".accord8").click(function(){    
		$(".accord_body8").toggle("fast",function(){
			
		});
	});
	$(".accord9").click(function(){    
		$(".accord_body9").toggle("fast",function(){
			
		});
	});
	$(".accord10").click(function(){    
		$(".accord_body10").toggle("fast",function(){
			
		});
	});
	//SJC: End old navigation script. Begin New Navigation script.
	
	$("#manage_navigation").find(".active").parents('ul').slideDown('fast');
	$("#manage_navigation >li a").click(function(e){
		$("#manage_navigation li ul").slideUp('fast');
		$(this).parent("li").find("ul").slideDown('fast');
		e.preventDefault();
	});
});
