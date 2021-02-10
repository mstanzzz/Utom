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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$page = "miscellaneous";

if(isset($_GET["backedup"])){
	
	$backup_id = $_GET['backup_id'];
    $sql = "SELECT backup_id, 
			content_table,
			price,
			percent_off,
			slug, 
			content1, 
			content2, 
			content_short1, 
			content_short2, 
			content_short3, 
			cat_id,
			img_id, 
			content_record_id, 
			hide,
			action
	FROM backup
	WHERE backup_id = '".$backup_id."'";
	
	
}else{
	
	$review_id = $_GET['review_id'];
    $sql = "SELECT review_id, 
			content_table,
			price,
			percent_off,
			slug, 
			content1, 
			content2, 
			content_short1, 
			content_short2, 
			content_short3, 
			cat_id,
			img_id, 
			content_record_id, 
			action,
			hide   	
	FROM review
	WHERE review_id = '".$review_id."'";
	
}


    $result = $dbCustom->getResult($db,$sql);		
	$object = $result->fetch_object();

	//echo $object->content_table;
	//echo $object->content_short1;

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Change</title>


<link type="text/css" rel="stylesheet" href="../css/cmsNav.css" />
<link type="text/css" rel="stylesheet" href="../css/nav.css" />

<link type="text/css" rel="stylesheet" href="../css/style.css" />

<link rel="stylesheet" href="../js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="../css/cmsStyle.css" />
<link type="text/css" rel="stylesheet" href="../css/mce.css" />

<style>




#slideshow-area, #slideshow-scroller {
  width: 250px;
  height: 240px;
  position: relative;
  overflow: hidden;
  margin: 0 auto;
}

#slideshow-area {
  border: 1px solid #000;
}
#slideshow-holder {
  height: 300px;
}
#slideshow-previous, #slideshow-next {
  width: 20px;
  height: 20px;
  background: transparent url("../images/arrow_gal_left.jpg") no-repeat 50% 50%;
  display: none;
  cursor: pointer;
  cursor: hand;
}

#slideshow-next {
  display: block;
  background: transparent url("../images/arrow_gal_right.jpg") no-repeat 50% 50%;
  right: 0;
}

.slideshow-content {
  float: left;
}

</style>


<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<script type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>

<script>

var totalSlides = 0;
var currentSlide = 1;
var contentSlides = '';

$(document).ready(function(){


	/*
	$(window).scroll(function() { 
	    $('#scrolltop').css('top', $(this).scrollTop() + "px"); 
	});
	*/
	$(window).scroll(function(e){  
	  $el = $('#scrolltop');  
	  if ($(this).scrollTop() > 220 && $el.css('position') != 'fixed'){
		  //alert($(this).scrollTop());
		$('#scrolltop').css({'position': 'fixed', 'top': '0px'});  
	  }
	  if ($(this).scrollTop() < 300 && $el.css('position') != 'absolute'){  
		$('#scrolltop').css({'position': 'absolute', 'top': '0px'});  
	  }
	}); 



  $("#slideshow-previous").click(showPreviousSlide);
  $("#slideshow-next").click(showNextSlide);
  
  var totalWidth = 0;
  contentSlides = $(".slideshow-content");
  contentSlides.each(function(i){
    totalWidth += this.clientWidth;
    totalSlides++;
  });
  $("#slideshow-holder").width(totalWidth);
  $("#slideshow-scroller").attr({scrollLeft: 0});
  updateButtons();
});
function showPreviousSlide()
{
  currentSlide--;
  updateContentHolder();
  updateButtons();
}

function showNextSlide()
{
  currentSlide++;
  updateContentHolder();
  updateButtons();
}

function updateContentHolder()
{
  var scrollAmount = 0;
  contentSlides.each(function(i){
    if(currentSlide - 1 > i) {
      scrollAmount += this.clientWidth;
    }
  });
  $("#slideshow-scroller").animate({scrollLeft: scrollAmount}, 1000);
}

function updateButtons()
{
  if(currentSlide < totalSlides) {
    $("#slideshow-next").show();
  } else {
    $("#slideshow-next").hide();
  }
  if(currentSlide > 1) {
    $("#slideshow-previous").show();
  } else {
    $("#slideshow-previous").hide();
  }
}


/* For IE only */ 
DD_roundies.addRule('.details_galary_view_box', '6px');
DD_roundies.addRule('.details_galary_thumb', '6px');
  
function show_pic(img_name)
{
	//alert(img_name);
	var block="<img src='./images/"+img_name+"' border='0'>";
	eval(document.getElementById('preview').innerHTML = block);	
}
 
if (document.images)
{

	<?php
	if($object->content_table == "showroom_item"){
		$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);
		$sql = "SELECT * FROM showroom_item_gallery WHERE showroom_item_id = '".$object->content_record_id."'";
		$gallery_result = mysql_query ($sql);
		
		$i = 1;
		while($gallery_row = mysql_fetch_object($gallery_result)) {
		
		?>
			pic<?php echo $i; ?>= new Image();
		  	pic<?php echo $i; ?>.src="<?php echo $ste_root; ?>/uploads/<?php echo $gallery_row->file_name; ?>"; 
		
		<?php
		$i++;
		}
	}
	?>
}

</script>
</head>

<body>

<?php 
include("includes/cms-header.php"); 
include("includes/cms-nav.php"); 
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	View Changed Content <?php 
	
	echo "<span style='font-size:14px'>";
	echo $object->slug; 
	
	if($object->content_table == "added_page"){
		echo " - ".$object->content_short2;	
	}
	echo "</span>";
	
	?> 

   	<div class="top_right_link">
    	<a href='change-management.php'>Cancel</a>   
    </div>
    <?php if(isset($_GET["rejected"])){ ?>
        <div class="top_link">
            <form action="change-management.php" method="post">
            <input type="hidden" name="approve_review_id" value="<?php echo $object->review_id; ?>" />
            <input type="hidden" name="approve_change" value="1" />
            <input type="image" name="approve_change" src="../images/button_approve.jpg" alt="Approve">
            </form>    
        </div>

	<?php }elseif(isset($_GET["backedup"])){  ?>
        <div class="top_link">
        <form action="change-management.php" method="post">
        <input type="hidden" name="restore_backup_id" value="<?php echo $object->backup_id; ?>" />
        <input type="hidden" name="restore_backup" value="1" />
        <input type="image" name="restore_backup" src="../images/button_restore.jpg" alt="Restore">
        </form>    
        </div>
	
	
	<?php }elseif(isset($_GET["approved"])){  ?>
           <div class="top_link">
                <form action="change-management.php" method="post">
                <input type="hidden" name="approve_review_id" value="<?php echo $object->review_id; ?>" />
                <input type="hidden" name="approve_change" value="1" />
                <input type="image" name="approve_change" src="../images/button_re_approve.jpg" alt="Approve">
                </form>    
            </div>	
	
	<?php }else{ ?>     
            <div class="top_link">
                <form action="change-management.php" method="post">
                <input type="hidden" name="approve_review_id" value="<?php echo $object->review_id; ?>" />
                <input type="hidden" name="approve_change" value="1" />
                <input type="image" name="approve_change" src="../images/button_approve.jpg" alt="Approve">
                </form>    
            </div>
            <div class="top_link">
                <form action="change-management.php" method="post">
                <input type="hidden" name="reject_review_id" value="<?php echo $object->review_id; ?>" />
                <input type="hidden" name="reject_change" value="1" />
                <input type="image"  name="reject_change" src="../images/button_reject.jpg" alt="Reject">
                </form>    
            </div>
    <?php } ?>
</div>
<div class="horizontal_bar"></div>
<div style="height:26px; font-size:12px; color:red; margin:auto; width:960px;">
<?php  
echo "Changed content is located within the red dotted box.";


?>
</div>

<div class="page_container">

    <?php

	if($object->content_table == "showroom_item"){
		
		
		echo "<div class='inner_container'>";

		$block = '';
		$block .= "<div id='side_nav'>";
		$db = $dbCustom->getDbConnect(SHOWROOM_DATABASE);
		$sql = "SELECT name, showroom_cat_id FROM showroom_category";
		$cat_res = mysql_query ($sql);
		//if(!$cat_res)die(mysql_error());
		while($cat_row = $cat_res->fetch_object()) {
			$block .= "<div class='side_nav_box'>";
			$block .= "$cat_row->name";
			$block .= "</div>";
		}			    
		$block .= "</div>";
		echo $block;

	?>

		<div class="details_content">

			<div class="details_galary">
				<div class="details_galary_view_box" id="preview">
                    <div id="slideshow-area">
                      <div id="slideshow-scroller">
                        <div id="slideshow-holder">
                            <?php

							if($object->action != "add"){
								// check to see what has changed
								$sql = "SELECT * FROM showroom_item WHERE showroom_item_id = '".$object->content_record_id."'";
								$existing_item_result = mysql_query ($sql);
								$existing_item_object = mysql_fetch_object($existing_item_result);
								
								$existing_item_img_id = $existing_item_object->img_id;
								$existing_item_name = $existing_item_object->name;
								$existing_item_description = $existing_item_object->description;
								$existing_item_price = $existing_item_object->price;
								$existing_percent_off = $existing_item_object->percent_off;
							}
							
                            $sql = "SELECT * FROM showroom_item_gallery WHERE showroom_item_id = '".$object->content_record_id."'";
                            $gallery_result = mysql_query ($sql);
                            if(!$gallery_result)die(mysql_error());
                            
                            //if no gallery images, show the item image
                            if(!mysql_num_rows($gallery_result)){
								
								$sql = "SELECT file_name FROM showroom_image WHERE img_id = '".$object->img_id."'";
								$img_res = $dbCustom->getResult($db,$sql);							
								$img_object = $img_res->fetch_object();
								if($img_res->num_rows){
									echo "<img src='../uploads/".$img_object->file_name."' />";	
								}else{
									echo "No Image";	
								}
							}else{

								//echo mysql_num_rows($gallery_result);exit;

								while($gallery_row = mysql_fetch_object($gallery_result)) {
									echo "<div class='slideshow-content'><img src='../uploads/".$gallery_row->file_name."' /></div>";
								}
							
							}

                            ?>
                        </div>
                      </div>
                    </div>
                </div>
				<div style="float:left; width:80px; padding-top:18px;">
					<div id="slideshow-previous"></div>
                </div>
				<div style="float:left; padding-top:18px;">                    
                    <img src="../images/button_back_to_gallary.jpg" /></a>
                </div>
				<div style="float:right; padding-top:18px;">                    
					<div id="slideshow-next"></div>
 				</div>							
                            
			</div>			
			
			<div class="details_content_right" >
            
				<div class="details_content_head">
					<?php 
						if($object->action != "add" && $existing_item_name == $object->content_short1){
							echo $object->content_short1;							
						}else{
							echo "<div class='red_box'>".$object->content_short1."</div>"; 
						}
					?>
				</div>				
				<div class="details_description">

					<?php 
						if($object->action != "add" && $existing_item_description == $object->content1){
							echo stripslashes($object->content1);							
						}else{
							$shc = stripslashes($object->content1);												
							echo "<div class='red_box'>".$shc."</div>";	
						}
					?>


				</div>	
				
                
                
                <div class="details_price">
                  	<?php 
						if($object->action != "add" && $existing_item_price == $object->price){
							echo "$".number_format($object->price,2);
						}else{
							echo "<div class='red_box'>$".number_format($object->price,2)."</div>";
						}
					?>
				</div>					
				<div class="details_price_label">
					<?php
                    if($object->percent_off > 0){
						echo "Original Price"; 					
					}else{
						echo "Price"; 
					}
                    ?>
                </div>
                
                
				<?php
                if($object->percent_off > 0){  //echo "-------------------".$object->percent_off;
				?>                
				<div class="clear"></div>
                
                <div class="details_price">
                	<?php
					$p_off = ($object->percent_off/100);
					//echo "-------------------".$p_off;
					if($object->action != "add" && $existing_percent_off == $object->percent_off){
						$discount = $p_off * $object->price;
						echo "-$".number_format($discount,2);
					}else{
						$discount = $p_off * $object->price;
						echo "<div class='red_box'>-$".number_format($discount,2)."</div>";
					}
					?>
							
				</div>
                					
				<div class="details_price_label">
                    <?php
 						echo "%".$object->percent_off."  Discount:"; 
                    ?>
                </div>
                
				<div class="clear" style="height:14px;"></div>
				<div class="horizontal_bar" style="width:220px; float:right;"></div>
				<div class="clear" style="height:4px;"></div>

                <div class="details_your_price">
                   <?php 
						$your_price = $object->price - $discount;
						if($object->action != "add" && $existing_item_price == $object->price){
							echo "$".number_format($your_price,2);
						}else{
							echo "<span class='red_box'>$".number_format($your_price,2)."</span>";
							//echo 111;
						}
					?>
                    		
				</div>					
				<div class="details_your_price_label">
                   	Your Price: 
                </div>
                
                
				<?php
				}
				?>                
                
                
                
                    
                    
				<div class="clear" style="height:40px;"></div>

				<div class="details_sd_button_container">				
					<a href="details.php?item_id=<?php echo $item_id ?>"><img src="../images/button_start_designing.jpg" /></a>
				</div>
				
			</div>
		
        <div class="clear"></div>		
       	
        Item main Image<br />		
        <?php
				   
				   
		$sql = "SELECT file_name FROM showroom_image WHERE img_id = '".$object->img_id."'";
		$img_res = $dbCustom->getResult($db,$sql);							
		$img_object = $img_res->fetch_object();
  
		if($object->action != "add" && $existing_item_img_id == $object->img_id){
			if($img_res->num_rows){
				echo "<img src='../uploads/".$img_object->file_name."' width='240px' height='230px' />";	
			}else{
				echo "No Image";	
			}
		}else{
			
			$block = "<div class='red_box'>";

			if($img_res->num_rows){
				$block .= "<img src='../uploads/".$img_object->file_name."' width='240px' height='230px' />";	
			}else{
				$block .= "No Image";	
			}
			$block .= "</div>";
			echo $block;
		}
		?>

		<div class="clear"></div>

		</div>		

        
	</div>		



<?php	}



	//*****************************************************************************************
	
	if($object->content_table == "added_page"){
			$sql = "SELECT content, hide FROM added_page 
			WHERE added_page_id = '".$object->content_record_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$ex_object = $result->fetch_object();
	        if($object->hide){
				$show_hide = "Hidden";
			}else{
				$show_hide = "Live";	
			}
			echo "<div style='width:100px;'>";
			if($ex_object->hide == $object->hide){
				echo "Status: $show_hide";
			}else{
				echo "<div class='red_box'>Status: $show_hide</div>";
			}
			echo "</div><br /><br />";


			if($ex_object->content == $object->content1){
				echo $object->content1;
			}else{
				$shc = stripslashes($object->content1);												
				echo "<div class='red_box'>".$shc."</div>";	
			}


	}
		
	
	//*****************************************************************************************

	if($object->content_table == "about_us"){
		
			$sql = "SELECT file_name 
			FROM image 
			WHERE img_id = '".$object->img_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$img_object = $result->fetch_object();
				
			$block = '';
			$block .= "<div class='red_box'>";
			
			$block .= "<div class='company_about_left_container'>";
			$block .= "<img src='../uploads/".$img_object->file_name."' />";
			$block .= "</div>";
			$shc = stripslashes($object->content1);					
			$block .= "<div class='company_about_right_container'>".$shc."</div>";
			$block .= "<div class='clear'></div>";
			$block .= "</div>";	
			echo $block;

	}
	
	
	//*****************************************************************************************

	if($object->content_table == "testimonial"){
	
	    $sql = "SELECT testimonial_page.content, image.file_name 
    	FROM testimonial_page, image 
    	WHERE testimonial_page.img_id = image.img_id ";
    	$page_result = mysql_query($sql);
		$t_object = mysql_fetch_object($page_result);
		
		$block = "<div class='company_testimonials_left_container'>";
		$block .= "<img src='../uploads/".$t_object->file_name."' />";

		$block .= "<div class='company_testimonials_link_box'>";

		$block .= "Want to share<br />your testimonial";
		
		$block .= "</div>";
		
		$block .= "</div>";

		$block .= "<div class='company_testimonials_right_container'>";
		$block .= "$t_object->content<br /><br />";

				
		$sql = "SELECT * FROM testimonial ORDER BY list_order";
	$result = $dbCustom->getResult($db,$sql);		while($row = $result->fetch_object()) {			
			if($row->testimonial_id == $object->content_record_id){
				$block .= "<div class='red_box'>";		
				if(!$object->hide){
					if($row->hide){
						$block .= "<div style='color:#F00; font-size:12px;'><br />";
						$block .= "This testimonial is currently set as <b>hide</b> but the requested change is to set it as <b>show</b>";
						$block .= "</div><br />";
						$block .= "<div style='font-size:14px; font-weight:bold;'>$object->content_short1, $object->content_short3</div>";
						$shc = stripslashes($object->content1);			
						$block .= $shc;				
					}else{
						$block .= "<div style='font-size:14px; font-weight:bold;'>$object->content_short1, $object->content_short3</div>";
						$shc = stripslashes($object->content1);			
						$block .= $shc;				
					}
				}else{
					if(!$row->hide){
						$block .= "<div style='color:#F00; font-size:12px;'><br />";
						$block .= "This testimonial is currently set as <b>show</b> but the requested change is to set it as <b>hide</b>";
						$block .= "</div><br />";
						$block .= "<div style='font-size:14px; font-weight:bold;'>$object->content_short1, $object->content_short3</div>";
						$shc = stripslashes($object->content1);			
						$block .= $shc;				
					}else{
						$block .= "<div style='color:#F00; font-size:12px;'><br />";
						$block .= "This testimonial is currently set as <b>hide</b> and the requested change is to leave it as <b>hide</b>";						
						$block .= "</div><br />";
						$block .= "<div style='font-size:14px; font-weight:bold;'>$object->content_short1, $object->content_short3</div>";
						$shc = stripslashes($object->content1);			
						$block .= $shc;				
					}
				}
				$block .= "</div>";		
			}else{
				if(!$row->hide){
					$block .= "<div style='font-size:14px; font-weight:bold;'>$row->name, $row->city_state</div>";
					$shc = stripslashes($row->content);			
					$block .= "$shc<br /><br />";
				}
			}
		}
			
		$block .= "</div>";
		echo $block;
	}

	//*****************************************************************************************

	if($object->content_table == "testimonial_page"){

	    $sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
    	$img_result = mysql_query($sql);
		$img_object = $img_res->fetch_object();
		
		$block = '';
		$block .= "<div class='company_testimonials_left_container'>";
		$block .= "<div class='red_box'>";
		$block .= "<img src='../uploads/".$img_object->file_name."' />";
		$block .= "</div>";
		$block .= "<div class='company_testimonials_link_box'>";
		$block .= "<div class='red_box'>";		
		$block .= "Want to share<br />your testimonial";
		$block .= "</div>";
		$block .= "</div>";
		$block .= "</div>";
		$block .= "<div class='company_testimonials_right_container'>";
		$block .= "<div class='red_box'>";	
		$shc = stripslashes($object->content1);						
		$block .= "$shc<br /><br />";
		$block .= "</div>";
		
		$sql = "SELECT * FROM testimonial WHERE hide = '0'";
	$result = $dbCustom->getResult($db,$sql);		while($row = $result->fetch_object()) {
			$block .= "<div style='font-size:14px; font-weight:bold;'>$row->name, $row->city_state</div>";
			$block .= "$row->content<br /><br />";
		}
		$block .= "</div>";
		echo $block;
	}

	//*****************************************************************************************

	if($object->content_table == "discount_how"){

		$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
$result = $dbCustom->getResult($db,$sql);		
		$img_object = $result->fetch_object();
			
		$block = '';
		$block .= "<div class='red_box'>";
		$block .= "<div class='company_discounts_left_container'>";
		$block .= "<a href='company.php?slug=discounts-how'><img src='../uploads/".$img_object->file_name."' /></a>";
		$block .= "</div>";
		$shc = stripslashes($object->content1);					
		$block .= "<div class='company_discounts_right_container'>".$shc."</div>";
		$block .= "<div class='clear'></div>";
		$block .= "</div>";
			
		echo $block;


	}

	//*****************************************************************************************

	if($object->content_table == "discount"){

		$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
$result = $dbCustom->getResult($db,$sql);		
		$img_object = $result->fetch_object();
	
		$block = '';
		$block .= "<div class='red_box'>";
		$block .= "<div class='company_discounts_left_container'>";
		$block .= "<img src='../uploads/".$img_object->file_name."' />";
		$block .= "</div>";
		$shc = stripslashes($object->content1);							
		$block .= "<div class='company_discounts_right_container'>".$shc."</div>";
		$block .= "<div class='clear'></div>";
		$block .= "</div>";
			
		echo $block;

	}

	//*****************************************************************************************


	if($object->content_table == "shipping_time"){

			$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$img_object = $result->fetch_object();
			
			$block = '';
			$block .= "<div class='red_box'>";
			$block .= "<div class='company_shipping_top_container'>";			
			$block .= "<img src='../uploads/".$img_object->file_name."'/>";			
			$block .= "<div class='company_shipping_text_container'>".stripslashes($object->content_short1)."</div>";
			$block .= "</div>";
			$shc = stripslashes($object->content1);							
			$block .= "<div class='company_shipping_bottom_container'>".$shc."</div>";
			$block .= "</div>";
			echo $block;

	}

	//*****************************************************************************************

	if($object->content_table == "shipping_term"){

			$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$img_object = $result->fetch_object();
			
			$block = '';
			$block .= "<div class='red_box'>";
			$block .= "<div class='company_shipping_left_container'>";
			$block .= "<img src='../uploads/".$img_object->file_name."'/>";
			$block .= "<div class='company_shipping_eta_link_box'>";
			$block .= "See Estimated<br />Arrival Times</div>";
			$block .= "</div>";
			$shc = stripslashes($object->content1);										
			$block .= "<div class='company_shipping_content'>".$shc."</div>";
			$block .= "<div class='clear'></div>";
			$block .= "</div>";

			echo $block;

	}

	//*****************************************************************************************


	if($object->content_table == "policy_category"){

		$sql = "SELECT policy.policy_id, policy.content, policy.policy_cat_id, image.file_name, policy_category.category_name 
		FROM policy, image, policy_category 
		WHERE policy.img_id = image.img_id 
		AND policy.policy_cat_id = policy_category.policy_cat_id
		ORDER BY policy.policy_id
		";
		
$result = $dbCustom->getResult($db,$sql);		
		
		//echo $result->num_rows;
		$r_display = 0;
		while($row = $result->fetch_object()) {
			$block = '';		
			$block .= "<div class='company_wide_section'>";
			$block .= "<div class='company_policies_left_container'>";
			$block .= "<img src='../uploads/".$row->file_name."'/>";
			$block .= "</div>";
			
			if($row->policy_cat_id == $object->content_record_id ){
				$block .= "<div class='company_section_title'><div class='red_box'>".$object->content_short1."</div></div>";								
			}else{
				$block .= "<div class='company_section_title'>".$row->category_name."</div>";				
			}
			$shc = stripslashes($object->content1);													
			$block .= "<div class='company_policies_section_body'>".$shc."</div>";
			$block .= "</div><div class='clear'></div>";
			echo $block;
		}
	}



	//*****************************************************************************************


	if($object->content_table == "policy"){

		$sql = "SELECT policy.policy_id, policy.content, policy.policy_cat_id, image.file_name, policy_category.category_name 
		FROM policy, image, policy_category 
		WHERE policy.img_id = image.img_id 
		AND policy.policy_cat_id = policy_category.policy_cat_id
		ORDER BY policy.policy_id
		";
		
$result = $dbCustom->getResult($db,$sql);		
		
		//echo $result->num_rows;
		$r_display = 0;
		while($row = $result->fetch_object()) {
			$block = '';
			

			if($row->policy_id == $object->content_record_id){
				$r_display = 1;
				$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				$img_object = $img_res->fetch_object();

				$sql = "SELECT category_name FROM policy_category WHERE policy_cat_id = '".$object->cat_id."'";
				$cat_result = mysql_query ($sql);
				$cat_object = mysql_fetch_object($cat_result);
				$block .= "<div class='red_box'>";
				$block .= "<div class='company_wide_section'>";
				$block .= "<div class='company_policies_left_container'>";
				$block .= "<img src='../uploads/".$img_object->file_name."'/>";
				$block .= "</div>";
				$block .= "<div class='company_section_title'>".$cat_object->category_name."</div>";	
				$shc = stripslashes($object->content1);														
				$block .= "<div class='company_policies_section_body'>".$shc."</div>";
				$block .= "</div>";
				$block .= "<div class='clear'></div></div>";
			}else{
				$block .= "<div class='company_wide_section'>";
				$block .= "<div class='company_policies_left_container'>";
				$block .= "<img src='../uploads/".$row->file_name."'/>";
				$block .= "</div>";
				$block .= "<div class='company_section_title'>".$row->category_name."</div>";
				$shc = stripslashes($row->content);										
				$block .= "<div class='company_policies_section_body'>".$shc."</div>";
				$block .= "</div><div class='clear'></div>";
			}

			
			echo $block;
		}
		if($object->action == "add" && !$r_display){
		
			$block = '';
			$block .= "<div class='red_box'>";
			$block .= "<div class='company_wide_section'>";
			$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
			$img_res = $dbCustom->getResult($db,$sql);
			$img_object = $img_res->fetch_object();
			$sql = "SELECT category_name FROM policy_category WHERE policy_cat_id = '".$object->cat_id."'";
			$cat_result = mysql_query ($sql);
			$cat_object = mysql_fetch_object($cat_result);
			$block .= "<div class='company_policies_left_container'>";
			$block .= "<img src='../uploads/".$img_object->file_name."'/>";
			$block .= "</div>";
			$block .= "<div class='company_section_title'>".$cat_object->category_name."</div>";
			$shc = stripslashes($object->content1);										
			$block .= "<div class='company_policies_section_body'>".$shc."</div>";
			$block .= "</div>";
			$block .= "<div class='clear'></div></div>";
			echo $block;

		}		
		if($object->action == "delete" && !$r_display){
		
			$block = '';
			$block .= "<div class='red_box'>";
			$block .= "<div class='company_wide_section'>";
			$sql = "SELECT file_name FROM image WHERE img_id = '".$object->img_id."'";
			$img_res = $dbCustom->getResult($db,$sql);
			$img_object = $img_res->fetch_object();
			$sql = "SELECT category_name FROM policy_category WHERE policy_cat_id = '".$object->cat_id."'";
			$cat_result = mysql_query ($sql);
			$cat_object = mysql_fetch_object($cat_result);
			$block .= "<div class='company_policies_left_container'>";
			$block .= "<img src='../uploads/".$img_object->file_name."'/>";
			$block .= "</div>";
			$block .= "<div class='company_section_title'>".$cat_object->category_name."</div>";
			$shc = stripslashes($object->content1);										
			$block .= "<div class='company_policies_section_body'>".$shc."</div>";
			$block .= "</div>";
			$block .= "<div class='clear'></div></div>";
			echo $block;

		}		

	}


	//*****************************************************************************************


	if($object->content_table == "process_category"){	

		echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";
		// Get process categories
		$sql = "SELECT DISTINCT process_category.category_name, process_category.process_cat_id 
		FROM process_category";
		$cat_res = mysql_query ($sql);
		
		while($row = $cat_res->fetch_object()) {
			if($str_width < strlen($row->category_name)*10)	$str_width = strlen($row->category_name)*10;
		}
		if($str_width < strlen($object->content_short1)*11)	$str_width = strlen($object->content_short1)*11;
		$sub_width_style = "style = 'width:".$str_width."px;'";

		mysql_data_seek($cat_res, 0);				
	    $block = '';
		while($row = $cat_res->fetch_object()) {
			if($row->process_cat_id == $object->content_record_id){
				$block .= "<div class='side_nav_box' $sub_width_style>";
				$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";
				$block .= "<a href='#".$row->process_cat_id."'><div class='red_box'>$row->category_name</div></a>";
				$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";			
				$block .= "</div>";
			}else{
				$block .= "<div class='side_nav_box' $sub_width_style>";
				$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";
				$block .= "<a href='#".$row->process_cat_id."'>$row->category_name</a>";
				$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";			
				$block .= "</div>";
			}
		}
		if($object->action == "add"){
			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";
			$block .= "<a href='#".$object->cat_id."'><div class='red_box'>$object->content_short1</div></a>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";			
			$block .= "</div>";
		}
		if($object->action == "delete"){
			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";
			$block .= "<a href='#".$object->cat_id."'><div class='red_box'>$object->content_short1</div></a>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";			
			$block .= "</div>";
		}

		echo $block;
		echo "</div></div>";
		
		$content_width = 730 - ($str_width - 160);			
		$content_width_style = "style = 'width:".$content_width."px;'";
		echo "<div class='company_process_content' $content_width_style>";

		mysql_data_seek($cat_res, 0); 
		while($cat_row = $cat_res->fetch_object()) {					
			echo "<div class='company_section_title'><a name='".$cat_row->process_cat_id."'>$cat_row->category_name</a></div>";
			$sql = sprintf("SELECT * FROM process WHERE process_cat_id = '%u'", $cat_row->process_cat_id);
			$result = $dbCustom->getResult($db,$sql);
			while($row = $result->fetch_object()) {	
				if($row->process_id == $object->content_record_id){
					$shc = stripslashes($object->content1);										
					echo "<div class='company_process_section_body'><div class='red_box'>$shc</div></div>";
				}else{
					$shc = stripslashes($row->content);										
					echo "<div class='company_process_section_body'>$shc</div>";
				}
			}
			if($object->action == "add"){
				if($cat_row->process_cat_id == $object->cat_id){
					$shc = stripslashes($object->content1);										
					echo "<div class='company_process_section_body'><div class='red_box'>$shc</div></div>";
				}
			}		
		}
		echo "</div>";
	}

	//*****************************************************************************************




	if($object->content_table == "process"){

		echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";
		// Get process categories
		$sql = "SELECT DISTINCT process_category.category_name, process_category.process_cat_id 
		FROM process_category";
		$cat_res = mysql_query ($sql);
		
		while($row = $cat_res->fetch_object()) {
			if($str_width < strlen($row->category_name)*10)	$str_width = strlen($row->category_name)*10;
		}
		$sub_width_style = "style = 'width:".$str_width."px;'";

		mysql_data_seek($cat_res, 0);				

		$block = '';
		while($row = $cat_res->fetch_object()) {
			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";
			$block .= "<a href='#".$row->process_cat_id."'>$row->category_name</a>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers' /></div>";			
			$block .= "</div>";
		}
		echo $block;
		echo "</div></div>";
		
		$content_width = 730 - ($str_width - 160);			
		$content_width_style = "style = 'width:".$content_width."px;'";
		echo "<div class='company_process_content' $content_width_style>";
		mysql_data_seek($cat_res, 0); 
		while($cat_row = $cat_res->fetch_object()) {					
			echo "<div class='company_section_title'><a name='".$cat_row->process_cat_id."'>$cat_row->category_name</a></div>";
			$sql = sprintf("SELECT * FROM process WHERE process_cat_id = '%u'", $cat_row->process_cat_id);
			$result = $dbCustom->getResult($db,$sql);
			while($row = $result->fetch_object()) {	
				if($row->process_id == $object->content_record_id){
					$shc = stripslashes($object->content1);										
					echo "<div class='company_process_section_body'><div class='red_box'>$shc</div></div>";
				}else{
					$shc = stripslashes($row->content);										
					echo "<div class='company_process_section_body'>$shc</div>";
				}
			}
			if($object->action == "add"){
				if($cat_row->process_cat_id == $object->cat_id){
					$shc = stripslashes($object->content1);										
					echo "<div class='company_process_section_body'><div class='red_box'>$shc</div></div>";
				}
			}
			
			if($object->action == "delete"){
				if($cat_row->process_cat_id == $object->cat_id){
					$shc = stripslashes($object->content1);										
					echo "<div class='company_process_section_body'><div class='red_box'>$shc</div></div>";
				}
			}		

			
		}
		echo "</div>";
	}
	
	//*****************************************************************************************

	if($object->content_table == "faq_category"){
	

				echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";

				// Get FAQ categories
				$sql = "SELECT DISTINCT faq_category.category_name, faq_category.faq_cat_id 
				FROM faq_category, faq
				WHERE faq_category.faq_cat_id = faq.faq_cat_id";
				$cat_res = mysql_query ($sql);
				
				$str_width = 160;
				while($row = $cat_res->fetch_object()) {
					if($str_width < strlen($row->category_name)*11)	$str_width = strlen($row->category_name)*11;
				}
				$sub_width_style = "style = 'width:".$str_width."px;'";
				
				mysql_data_seek($cat_res, 0);

			    $block = '';
				while($row = $cat_res->fetch_object()) {
					if($row->faq_cat_id == $object->content_record_id){
						$block .= "<div class='side_nav_box' $sub_width_style>";
						$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
						$block .= "<a href='#".$row->faq_cat_id."'><div class='red_box'>$object->content_short1</div></a>";
						$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
						$block .= "</div>";
					}else{
						$block .= "<div class='side_nav_box' $sub_width_style>";
						$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
						$block .= "<a href='#".$row->faq_cat_id."'>$row->category_name</a>";
						$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
						$block .= "</div>";
					}
				}
				if($object->action == "add"){
					$block .= "<div class='side_nav_box' $sub_width_style>";
					$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
					$block .= "<a href='#".$row->faq_cat_id."'><div class='red_box'>$object->content_short1</div></a>";
					$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
					$block .= "</div>";
				}
				
				echo $block;
				
				echo "</div></div>";

				$content_width = 730 - ($str_width - 160);			
				$content_width_style = "style = 'width:".$content_width."px;'";
				echo "<div class='support_content' $content_width_style>";

				$temp_id = '';
				mysql_data_seek($cat_res, 0); 
				while($cat_row = $cat_res->fetch_object()) {					
					echo "<div class='support_section_title'><a name='".$cat_row->faq_cat_id."'>$cat_row->category_name</a></div>";
					// Get FAQ per categories
					$sql = sprintf("SELECT question, answere, faq_id FROM faq WHERE faq_cat_id = '%u'", $cat_row->faq_cat_id);
					$result = $dbCustom->getResult($db,$sql);
					while($row = $result->fetch_object()) {							
							$shc = stripslashes($row->question);										
							echo "<div class='support_question'>$shc</div>";
							$shc = stripslashes($row->answere);										
							echo "<div class='support_answere'>$shc</div>";
					}
				}

				echo "</div>";
	}

	//*****************************************************************************************


	if($object->content_table == "faq"){
	

				echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";

				// Get FAQ categories
				$sql = "SELECT DISTINCT faq_category.category_name, faq_category.faq_cat_id 
				FROM faq_category, faq
				WHERE faq_category.faq_cat_id = faq.faq_cat_id";
				$cat_res = mysql_query ($sql);

				$str_width = 160;
				while($row = $cat_res->fetch_object()) {
					if($str_width < strlen($row->category_name)*11)	$str_width = strlen($row->category_name)*11;
				}
				$sub_width_style = "style = 'width:".$str_width."px;'";

				mysql_data_seek($cat_res, 0);

				$block = '';
				while($row = $cat_res->fetch_object()) {
					$block .= "<div class='side_nav_box' $sub_width_style>";
					$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
					$block .= "<a href='#".$row->faq_cat_id."'>$row->category_name</a>";
					$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
					$block .= "</div>";
				}
				
				echo $block;
				
				echo "</div></div>";

				$content_width = 730 - ($str_width - 160);			
				$content_width_style = "style = 'width:".$content_width."px;'";
				echo "<div class='support_content' $content_width_style>";

				$temp_id = '';
				mysql_data_seek($cat_res, 0); 
				while($cat_row = $cat_res->fetch_object()) {					
					echo "<div class='support_section_title'><a name='".$cat_row->faq_cat_id."'>$cat_row->category_name</a></div>";
					// Get FAQ per categories
					$sql = sprintf("SELECT question, answere, faq_id FROM faq WHERE faq_cat_id = '%u'", $cat_row->faq_cat_id);
					$result = $dbCustom->getResult($db,$sql);
					while($row = $result->fetch_object()) {	
					
						if($row->faq_id == $object->content_record_id){
							if( $row->faq_cat_id == $object->cat_id){
								echo "<div class='red_box'>";
								$shc = stripslashes($object->content1);										
								echo "<div class='support_question'>$shc</div>";
								$shc = stripslashes($object->content2);										
								echo "<div class='support_answere'>$shc</div>";
								echo "</div>";	
							}
						}else{
							$shc = stripslashes($row->question);										
							echo "<div class='support_question'>$shc</div>";
							$shc = stripslashes($row->answere);										
							echo "<div class='support_answere'>$shc</div>";
						}
					}

					if($object->action == "add"){
						if($cat_row->faq_cat_id == $object->cat_id){
							echo "<div class='red_box'>";
							$shc = stripslashes($object->content1);										
							echo "<div class='support_question'>$shc</div>";
							$shc = stripslashes($object->content2);										
							echo "<div class='support_answere'>$shc</div>";
							echo "</div>";	
						}
					}
					
					
					if($object->action == "delete"){
						if($cat_row->faq_cat_id == $object->cat_id){
							echo "<div class='red_box'>";
							$shc = stripslashes($object->content1);										
							echo "<div class='support_question'>$shc</div>";
							$shc = stripslashes($object->content2);										
							echo "<div class='support_answere'>$shc</div>";
							echo "</div>";	
						}
					}		
					
					echo "<div class='support_section_title_spacer'></div>";
	
					
				}
				echo "</div>";

	}

	//*****************************************************************************************


	if($object->content_table == "contact_us"){
	
	?>

				<div class="support_addr_box">									
                    <div class='red_box'>
					<?php 
					echo stripslashes($object->content_short1); 
					?>
                    </div>
 				</div>
				<div class="support_faq_button_box">
                	Have a question? Don't forget to check out our:<br />
					<a href="#"><img src="../images/button_faq.jpg" /></a>                
                </div>
                <div class="clear"></div>
				<div class="support_icon_box">
					<img src="../images/icons/phone.png" />                
                </div>

				<div class="support_phone_box">
                   	<div class='red_box'>
                	<?php echo stripslashes($object->content_short2); ?>
                    </div>
                </div>
				<div class="support_email_button_box">
					<a href="#"><img src="../images/button_email_us.jpg" /></a>                
                </div>
                
                
                <div class="clear"></div>
				<div class="support_icon_box">
					<img src="../images/icons/fax.png" />                
                </div>

				<div class="support_fax_box" style="border-style:dotted; border-color:#F00;">
                     <?php echo stripslashes($object->content_short3); ?>
                </div>
				<div class="support_live_button_box">
                	 with a live representative (available)<br />
					<a href="#"><img src="../images/button_live.jpg" /></a>                
                </div>
                
               <div class="clear"></div>
                
                
                
                <div class="support_map">
                
               <iframe width="970" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=9540+SW+Tigard+Street,+Tigard,+Oregon+97223&amp;sll=37.0625,-95.677068&amp;sspn=28.887524,86.220703&amp;ie=UTF8&amp;hq=&amp;hnear=9540+SW+Tigard+St,+Tigard,+Washington,+Oregon+97223&amp;ll=45.431505,-122.775157&amp;spn=0.021081,0.036478&amp;z=14&amp;iwloc=&amp;output=embed"></iframe><br />
               
                
                </div>




	<?php
	}

	//*****************************************************************************************


	if($object->content_table == "contact_email_page"){
		
		echo "<div class='inner_container'>";
		$shc = stripslashes($object->content1);												
		echo "<div class='red_box'>".$shc."</div>";
	?>	
				<br />
			
				<table border="0" cellpadding="10">
				  <tr>
					<td width="100" align="right" >Name:</td>
					<td><input id="co_name" type="text" name="name" maxlength="80" style="width:300px;" />
                    </td>
				  </tr>
				  <tr>
					<td align="right" >City:</td>
					<td><input id="co_city" type="text" name="city" maxlength="80" style="width:300px;" />
                    </td>
				  </tr>
				  <tr>
					<td align="right" >State:</td>
                  	<td>
						<select name="state" class="details_select">
						<?php 
						$sql = "SELECT state FROM states WHERE hide = '0' ORDER BY state"; 
				$result = $dbCustom->getResult($db,$sql);						 $block = '';
						 while($row = $result->fetch_object()) {
							$sel =  ($_SESSION['state'] == $row->state) ? "selected" : '';	
							$block .= "<option value='".$row->state."' $sel >$row->state</option>";
						 }
						echo $block;
                        ?>
                        </select>             
						 
                    </td>
                  </tr>	 
                  
				  <tr>
					<td align="right" >Phone #:</td>
					<td><input id="co_phone" type="text" name="phone" maxlength="80" style="width:300px;" />
                    </td>
				  </tr>                  
                  
				  <tr>
					<td align="right" >Email:</td>
					<td><input id="co_email" type="text" name="email" maxlength="80" style="width:300px;" />
                    </td>
				  </tr>
                  
                  
				  <tr>
					<td align="right" >Dept:</td>
                  	<td>
						<select name="dept" class="details_select">
	                        <option value="design_team">Design Team</option>
                        </select>             
                    </td>
                  </tr>	 
                  
				  <tr>
					<td align="right" >Subject:</td>
					<td><input id="co_subject" type="text" name="subject" maxlength="120" style="width:300px;" />
                    </td>
				  </tr>
				  <tr>
					<td align="right" valign="top" >Support Issue:</td>
					<td><textarea id="co_support_issue" class="support_textarea" name="support_issue"  /></textarea>
                    </td>
				  </tr>
				</table>
				<br /><br />
				<div class="clear"></div>
                <br />
                <?php 
					$shc = stripslashes($object->content2);												
					echo "<div class='red_box'>".$shc."</div>"; 
				?>
				<br /><br />
                <div id="support_upload_button">
                    <img src="../images/button_attach.jpg" />
                </div>
				<div class='clear' style='height:32px;'></div>
				<div class='horizontal_bar' style='width:940px;'></div>
				<div class='clear' style='height:32px;'></div>
				<div class="support_submit_container">					
                    <img src="../images/button_sendto.jpg" id = "submit_sendto"/>
				</div>				
				<div class="support_submit_container">					
                    <img id="co_clear" src="../images/button_clear.jpg" />
				</div>				
			</div>
		</div>
		
	<?php 
	} 
	
	
//*****************************************************************************************

	if($object->content_table == "guide_tip_category"){
		echo "<div class='inner_container'>";

		echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";
		// Get guides tips categories
		$sql = "SELECT DISTINCT guide_tip_category.category_name, guide_tip_category.guide_tip_cat_id 
				FROM guide_tip_category";
		$cat_res = mysql_query ($sql);
		
		$str_width = 160;
		while($row = $cat_res->fetch_object()) {
			if($str_width < strlen($row->category_name)*11)	$str_width = strlen($row->category_name)*11;
		}
		if($str_width < strlen($object->content_short1)*11)	$str_width = strlen($object->content_short1)*11;

		$sub_width_style = "style = 'width:".$str_width."px;'";
		mysql_data_seek($cat_res, 0);				
		
		$block = '';
		while($row = $cat_res->fetch_object()) {
			
			if($row->guide_tip_cat_id == $object->content_record_id){
				$block .= "<div class='side_nav_box' $sub_width_style>";
				$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
				$block .= "<div style='border-style:dotted; border-color:#F00;'>";
				$block .= "<a href='#".$row->guide_tip_cat_id."'>$row->category_name</a>";
				$block .= "</div>";
				$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
				$block .= "</div>";
			}else{
				$block .= "<div class='side_nav_box' $sub_width_style>";
				$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
				$block .= "<a href='#".$row->guide_tip_cat_id."'>$row->category_name</a>";
				$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
				$block .= "</div>";
			}			
		}
		if($object->action == "add"){
			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "<div style='border-style:dotted; border-color:#F00;'>";
			$block .= "<a href='#".$object->cat_id."'>$object->content_short1</a>";
			$block .= "</div>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "</div>";
		}
		if($object->action == "delete"){
			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "<div style='border-style:dotted; border-color:#F00;'>";
			$block .= "<a href='#".$object->cat_id."'>$object->content_short1</a>";
			$block .= "</div>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "</div>";						
		}
	
		echo $block;
		echo "</div></div>";

		$content_width = 730 - ($str_width - 160);			
		$content_width_style = "style = 'width:".$content_width."px;'";
		echo "<div class='support_content' $content_width_style>";
		
		mysql_data_seek($cat_res, 0); 
		while($cat_row = $cat_res->fetch_object()) {
										
			echo "<div class='support_cat_title'><a name='".$cat_row->guide_tip_cat_id."'>$cat_row->category_name</a></div>";
					
			$sql = sprintf("SELECT * FROM guide_tip WHERE guide_tip_cat_id = '%u'", $cat_row->guide_tip_cat_id);
			$result = $dbCustom->getResult($db,$sql);
					
			while($row = $result->fetch_object()) {	
				echo stripslashes($row->content);
			}
		}
		echo "</div>";

		echo "</div>";
		
	}
	
//*****************************************************************************************
	
	if($object->content_table == "guide_tip"){

		//echo $object->content_table;
		//exit;
	
		echo "<div class='inner_container'>";

		echo "<div id='side_nav'><div id='scrolltop' style='position:absolute;'>";
		// Get guides tips categories
		$sql = "SELECT DISTINCT guide_tip_category.category_name, guide_tip_category.guide_tip_cat_id 
				FROM guide_tip_category";
		$cat_res = mysql_query ($sql);

		$str_width = 160;
		while($row = $cat_res->fetch_object()) {
			if($str_width < strlen($row->category_name)*11)	$str_width = strlen($row->category_name)*11;
		}
		$sub_width_style = "style = 'width:".$str_width."px;'";
		mysql_data_seek($cat_res, 0);				

		$block = '';
		while($row = $cat_res->fetch_object()) {

			$block .= "<div class='side_nav_box' $sub_width_style>";
			$block .= "<div class='side_nav_box_edge_left'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "<a href='#".$row->guide_tip_cat_id."'>$row->category_name</a>";
			$block .= "<div class='side_nav_box_edge_right'><img src='".$ste_root."/images/side_nav_box_edge.jpg' alt='closet organizers'/></div>";
			$block .= "</div>";

		}
				
		echo $block;
		echo "</div></div>";

		$content_width = 730 - ($str_width - 160);			
		$content_width_style = "style = 'width:".$content_width."px;'";
		echo "<div class='support_content' $content_width_style>";
		
		mysql_data_seek($cat_res, 0); 
		while($cat_row = $cat_res->fetch_object()) {
										
			echo "<div class='support_cat_title'><a name='".$cat_row->guide_tip_cat_id."'>$cat_row->category_name</a></div>";
					
			$sql = sprintf("SELECT * FROM guide_tip WHERE guide_tip_cat_id = '%u'", $cat_row->guide_tip_cat_id);
			$result = $dbCustom->getResult($db,$sql);
					
			while($row = $result->fetch_object()) {	
				if($row->guide_tip_id == $object->content_record_id){
					$shc = stripslashes($object->content1);												
					echo "<div class='red_box'>".$shc."</div>";	
				}else{
					echo stripslashes($row->content);
				}
			}
			
			if($object->action == "add"){
				if($cat_row->guide_tip_cat_id == $object->cat_id){
					$shc = stripslashes($object->content1);												
					echo "<div class='red_box'>".$shc."</div>";	
				}
			}		
			
			
			if($object->action == "delete"){
				if($cat_row->guide_tip_cat_id == $object->cat_id){
					$shc = stripslashes($object->content1);												
					echo "<div class='red_box'>".$shc."</div>";	
				}
			}		
			
						
		}
		
		
		echo "</div>";

		echo "</div>";
		
	}
	
	//*****************************************************************************************
	
	if($object->content_table == "terms_of_use"){
			$sql = "SELECT content FROM terms_of_use 
			WHERE terms_of_use_id = '".$object->content_record_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$ex_object = $result->fetch_object();

			if($ex_object->content == $object->content1){
				echo $object->content1;
			}else{
				$shc = stripslashes($object->content1);												
				echo "<div class='red_box'>".$shc."</div>";	
			}
	}


	//*****************************************************************************************
	
	if($object->content_table == "privacy_statement"){
			$sql = "SELECT content FROM privacy_statement 
			WHERE privacy_statement_id = '".$object->content_record_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$ex_object = $result->fetch_object();

			if($ex_object->content == $object->content1){
				echo $object->content1;
			}else{
				$shc = stripslashes($object->content1);												
				echo "<div class='red_box'>".$shc."</div>";	
			}
	}


	//*****************************************************************************************
	
	if($object->content_table == "in_home_consultation"){
			
			$sql = "SELECT content FROM in_home_consultation 
			WHERE in_home_consultation_id = '".$object->content_record_id."'";
	$result = $dbCustom->getResult($db,$sql);			
			$ex_object = $result->fetch_object();


			if($ex_object->content == $object->content1){
				echo $object->content1;
			}else{
				$shc = stripslashes($object->content1);												
				echo "<div class='red_box'>".$shc."</div>";	
			}
	}
		

	//*****************************************************************************************
	
	if($object->content_table == "link"){
			
		echo "<br /><br />";
		if($object->action == "add"){
			echo "This link was added to the lower nav bar:<br /><br />";
		}else{
			echo "This link for the lower nav bar was edited as follows:<br /><br />";
		}
		
		echo "<div style='float:left; width:250px;'>Actual link:</div>
			<div style='float:left;'><a href='".$ste_root.$object->content_short1."' target='_blank'>".$object->content_short2."</a></div>
			<div class='clear'></div><br /><br />";
		
		echo "<div style='float:left; width:250px;'>Link URL:</div><div style='float:left;'>".$object->content_short1."</div>
			<div class='clear'></div><br /><br />";

		echo "<div style='float:left; width:250px;'>Link text:</div><div style='float:left;'>".$object->content_short2."</div>
			<div class='clear'></div><br /><br />";

		echo "<div style='float:left; width:250px;'>Page where the link shows:</div><div style='float:left;'>".$object->content_short3."<div>
			<div class='clear'></div>";

	}

	
	//*****************************************************************************************
	
	if($object->content_table == "news"){
			
		echo "<br /><br />
			$object->content1
			";
	}
	
	
	if($object->content_table == "log_post"){
			
			
				if(trim($object->substitute_by) != ''){
					$by = $object->substitute_by;
				}else{
					$db = $dbCustom->getDbConnect(USER_DATABASE);
					$sql = "SELECT name FROM user WHERE id = '".$object->user_id."'";
					$mem_res = mysql_query($sql);
					$pb_object = mysql_fetch_object($mem_res);
					$by = $pb_object->name;
				}
				
				
				$date_posted = date("F j, Y",$row["when_posted"]);
				$time_posted = date("g:i a", $row["when_posted"]);
							
				$title = $row['title'];
				echo "<div class='blog_head'> 
								date: $date_posted<br />
								time: $time_posted <br />
								by: $by <br />
								subject: $title
								</div>";
				
			
		echo "<br /><br />			
			
			title: $object->content_short1 <br />  <br />

			$object->content1
			";
	}
	
	?>
    
 

<p class="clear"></p>

</div>
</body>
</html>

