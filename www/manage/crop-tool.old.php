<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

/*****************************************

TRY THIS http://fengyuanchen.github.io/cropper/

THIS IS BETTER http://dev.vizuina.com/cropper/
-- cannot zoom in or out
-- maybe just force aspect ratio and re-size as needed
-- set min width and min height to 520 for cart images

*****************************************/


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');


$fromfancybox = (isset($_REQUEST["fromfancybox"])) ? $_REQUEST["fromfancybox"] : 0;

if(!isset($_SESSION['new_img_id']))$_SESSION['new_img_id'] = 0;
if(!isset($_SESSION['img_id']))$_SESSION['img_id'] = 0;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>CropZoom</title>
<link href="../js/css/ui-lightness/jquery-ui-1.8.7.custom.css" rel="Stylesheet" type="text/css" />
<link href="../js/css/jquery.cropzoom.css" rel="Stylesheet" type="text/css" />
<link href="<?php echo $ste_root; ?>/css/manageStyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/ui/jquery-ui-1.8.7.custom.js"></script>
<script type="text/javascript" src="../js/jquery.cropzoom.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		/*
		if (jQuery.browser.safari && document.readyState != "complete"){
			setTimeout( arguments.callee, 100 );
			return;
		  } 
		*/
		if (document.readyState != "complete"){
			setTimeout( arguments.callee, 100 );
			return;
		  } 
	   var pre_cropped_fn = $('#pre_cropped').find('img').attr('src');
	   var pre_cropped_w = $('#pre_cropped').find('img').attr('width');
	   var pre_cropped_h = $('#pre_cropped').find('img').attr('height');
		
       var cropzoom = $('#crop_container').cropzoom({
		  <?php		
		  if((strpos($_SESSION["ret_page"], "home-banner") !== false)
		  ||(strpos($_SESSION["ret_page"], "showroom-banner") !== false)
		  ||(strpos($_SESSION["ret_page"], "shop-banner") !== false)){	
		  ?>
		  	width:1100,
			height:700,
			//width:900,
            //height:500,

		  <?php
		  }elseif(strpos($_SESSION["ret_page"], "blog") !== false){
		  ?>
		  	width:900,
			height:700,
            //width:700,
            //height:500,
		<?php
		}elseif(strpos($_SESSION["ret_page"], "installation-step") !== false){
		?>  
		  //width: 400,
		  //height: 400,			  			  
		<?php
		}elseif(strpos($_SESSION["ret_page"], "installation-tool") !== false){
		?>  
			width:900,
			height:700,
		  //width: 300,
		  //height: 300,			  			  
		<?php
		}elseif(strpos($_SESSION["ret_page"], "installation") !== false){
		?>
			width:900,
			height:700,		  
		  //width: 500,
		  //height: 500,			  			  
		  <?php
		}elseif($_SESSION["ret_page"] == "home"){
			?>
			width:900,
			height:700,
		  //width: 400,
		  //height: 400,			  			  
		  <?php
		}elseif($_SESSION["ret_page"] == "add-spec" || $_SESSION["ret_page"] == "edit-spec"){
			?>
			width:900,
			height:700,			
		  //width: 400,
		  //height: 400,			  			  
		<?php
		}elseif(strpos($_SESSION["ret_page"], "global-discount") !== false){
		?>
			width:900,
			height:700,
		  //width: 400,
		  //height: 400,			  			  
	  <?php
		}elseif($_SESSION["ret_page"] == "about-us"){
		?>
			width:900,
			height:700,
		  //width: 600,
		  //height: 500,			  			  		  
	  <?php
		}elseif($_SESSION["ret_page"] == "specs-side-content"){
		?>
			width:900,
			height:700,
		  //width: 400,
		  //height: 400,			  			  		  
	  <?php
		}elseif($_SESSION["ret_page"] == "we-design-fax"){
		?>
			width:900,
			height:700,
		  //width: 400,
		  //height: 400,			  			  
		<?php
		}else{
		?>
		width:900,
		height:700,		
		//width:860,
		//height:500,
		<?php
		}
		?>
            bgColor: '#caeefe',		
            enableRotation:true,
            enableZoom:true,
            zoomSteps:1,
            rotationSteps:1,
            selector:{
			<?php		
		  	if(strpos($_SESSION["ret_page"], "home-banner") !== false){	
			?>
			  //w: 870,
			  //h: 349,
				w: 860,
				h: 460,
			  <?php
			}elseif(strpos($_SESSION["ret_page"], "showroom-banner") !== false || (strpos($_SESSION["ret_page"], "shop-banner") !== false)){
			  ?>  
			  //w: 870,
			  //h: 299,
			  w: 860,
			  h: 460,
			<?php
			}elseif(strpos($_SESSION["ret_page"], "blog") !== false){
			?>  
			  w: 446,
			  h: 314,

			<?php
			}elseif(strpos($_SESSION["ret_page"], "installation-step") !== false){
			?>  
			w: 164,
			h: 144,
			<?php
			}elseif(strpos($_SESSION["ret_page"], "installation-tool") !== false){
			?>  
			w: 84,
			h: 98,
			<?php
			}elseif(strpos($_SESSION["ret_page"], "installation") !== false){
			?>  
			  w: 256,
			  h: 231,			  			  
			<?
			}elseif($_SESSION["ret_page"] == "home"){
				
				if($_SESSION['img_type'] == 2){
					
				?>
				  w: 269,
				  h: 160,
				<?
					
				}else{
			
				?>
				  w: 265,
				  h: 160,
				<?
				}
			
			}elseif($_SESSION["ret_page"] == "add-spec" || $_SESSION["ret_page"] == "edit-spec"){
			?>
			  w: 162,
			  h: 162,
			<?php
			}elseif(strpos($_SESSION["ret_page"], "global-discount") !== false){
			?>  
			  w: 182,
			  h: 182,
			<?
			}elseif($_SESSION["ret_page"] == "specs-side-content"){
			?>
			  w: 256,
			  h: 182,
			<?php
			}elseif($_SESSION["ret_page"] == "about-us"){
			?>
			  w: 381,
			  h: 190,
			<?php
			}elseif($_SESSION["ret_page"] == "we-design-fax"){
			?>
			  w: 372,
			  h: 200,
			<?php
			}else{
			?>
			  //w: 460,
			  //h: 460,
			  w: 520,
			  h: 520,
			  
			<?php
			}
			?>
			  aspectRatio:true,	       
              centered:true,
              borderColor:'red',
              borderColorHover:'yellow',
              startWithOverlay: false,
              hideOverlayOnDragAndResize: true
            },
            image:{
                source: pre_cropped_fn,
				width: pre_cropped_w,
                height: pre_cropped_h,
                minZoom:10,
                maxZoom:150,
                snapToContainer:false
            }
        });
        $('#crop').click(function(){ 
            cropzoom.send('ajax-resize-and-crop.php','POST',{},function(rta){
				//alert(rta);
				
				$('.result').find('img').remove();
                var img = $('<img />').attr('src',rta);
                $('.result').find('.txt').hide().end().append(img);
            });
        });
        $('#restore').click(function(){
            $('.result').find('img').remove();
            $('.result').find('.txt').show();
            cropzoom.restore();
        });
		
		 $('#pre_cropped').hide();
		
	  	$('#show_pre_cropped').click(function(){
            $('#pre_cropped').show();
        });
    });
function location_fb(url){
	<?php if($fromfancybox){ ?>
	location.href = url;
	<?php }else{ ?>
	if (window.top.location != window.location) {
		self.parent.location.href=url;
	}
	<?php } ?>
	location.href = url;
}
</script>
<style type="text/css">
#img_to_crop {
	-webkit-user-drag: element;
	-webkit-user-select: none;
}

.center_this_block{
	
	display:inline-block;
	
}

body{
	text-align:center;
}


</style>
</head>
<!--
<body class="lightbox">
-->	
<body>
<di style="height:22px; background-color:#F0F6F9; padding-top:6px;">
<h3>You must crop the image before it will be saved.</h3>
</div>

<div style="background:#FFF;">

	<?php
	if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = 0;
	if((strpos($_SESSION["ret_page"], "home-banner") > 0)||(strpos($_SESSION["ret_page"], "showroom-banner") > 0)||(strpos($_SESSION["ret_page"], "shop-banner") > 0) ){	
	?>


		<div id="crop_container" style="float:left; margin-left:60px;"></div>

        <div style="float:left; margin-left:20px; padding-top:11px;">
        	
	        <span><a  style="width:65px;" id="crop" class="btn" href="javascript:void(0)">Crop</a></span> 
            <span><a  style="width:65px; margin-left:20px;" id="restore"  class="btn" href="javascript:void(0)">Restore</a></span>    
            <span><a  style="width:65px; margin-left:20px;"  class="btn btn-success" 
                href="<?php echo $_SESSION["ret_dir"]."/".$_SESSION["ret_page"].".php?is_new_img=1&cat_id=".$_SESSION['cat_id']; ?>" ><i class="icon-ok icon-white"></i> Done</a></span>
            <span><a  style="width:65px; margin-left:20px;"  class="btn" 
                href="<?php echo $_SESSION["ret_dir"]."/".$_SESSION["ret_page"].".php"; ?>" > Cancel</a></span>
        	
        </div>
        
        <div style="float:left; margin-left:20px; padding-top:26px;">        	
			<h4>Current Crop Preview:</h4>
			<div class="result">
				<div class="txt"></div>
			</div>
        </div>
            
            
	<?php
	}elseif(strpos($_SESSION["ret_page"], "blog") > 0){
		//echo $_SESSION["blog_post_id"];
	?>



		<div id="crop_container" style="float:left; margin-left:20px;"></div>

        <div style="float:left; margin-left:20px; padding-top:11px;">
        	
	        <span><a  style="width:65px;" id="crop" class="btn" href="javascript:void(0)">Crop</a></span> 
            <span><a  style="width:65px; margin-left:20px;" id="restore"  class="btn" href="javascript:void(0)">Restore</a></span>    
            <span><a href="<?php echo $_SESSION["ret_dir"]."/".$_SESSION["ret_page"].".php?is_new_img=1"; ?>" class="btn btn-success" target="_parent">Done</a></span>
            <span><a  style="width:65px; margin-left:20px;"  class="btn" 
                href="<?php echo $_SESSION["ret_dir"]."/".$_SESSION["ret_page"].".php"; ?>" > Cancel</a></span>
        	
        </div>
        
        <div style="float:left; margin-left:20px; padding-top:26px;">        	
			<h4>Current Crop Preview:</h4>
			<div class="result">
				<div class="txt"></div>
			</div>
        </div>

    
	<?php
	}else{
		
		
		//echo $_SESSION["ret_page"];
		




$url_str = $_SESSION['ret_dir'];
$url_str .= '/'.$_SESSION['ret_page'].'.php';
$url_str .= "?is_new_img=1";
$url_str .= "&cat_id=".$_SESSION['cat_id'];
if(isset($_SESSION['img_type'])){
	$url_str .= "&img_type=".$_SESSION['img_type'];	
}



?>



		<div id="crop_container" style="float:left; margin-left:20px;"></div>

        <div style="float:left; margin-left:20px; padding-top:11px;">
        	
	        <span><a  style="width:65px;" id="crop" class="btn" href="javascript:void(0)">Crop</a></span> 
            <span><a  style="width:65px; margin-left:20px;" id="restore"  class="btn" href="javascript:void(0)">Restore</a></span>    
           	<span><a class="btn" onclick="location_fb('<?php echo $url_str; ?>')">Done</a></span>
            <span><a  style="width:65px; margin-left:20px;"  class="btn" 
               onclick="location_fb('<?php echo $url_str; ?>')"> Cancel</a></span>
        	
        </div>
        
        <div style="float:left; margin-left:20px; padding-top:26px;">        	
			<h4>Current Crop Preview:</h4>
			<div class="result">
				<div class="txt"></div>
			</div>
        </div>


	<?php
	}
	?>
    
            <div style="clear:both;">
            <br /><br />
                <div id="show_pre_cropped" style="cursor:pointer; text-decoration:underline;">Show Pre Cropped Image
                
                <?php 
                        
                        
                        /*
                        echo "
                        
                        <div class='original'>
                            <h3>Original Image:</h3>
                            <div id='pre_cropped' >
                                <img src='../saascustuploads/".$_SESSION['profile_account_id']."/tmp/pre-crop/".$_SESSION["pre_cropped_fn"]."' />
                            </div>
                        </div>
                        ";
						*/
                        
                        echo "    
                        <div class='original'>
                            <h3>Original Image:</h3>
                            <div id='pre_cropped' >
                                <img src='../saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$_SESSION['pre_cropped_fn']."' />
                            </div>
                        </div>
                        ";
						
                        
                        
                        
                ?>
                </div>
            </div>
 </div>
</body>
</html>
