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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;



$page_title = "Dynamic Links";
$page_group = "link";

require_once($real_root."/includes/set-page.php");	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


if(isset($_POST["edit_link"])){
	
	$url = trim(addslashes($_POST['url'])); 
	$link_text = trim(addslashes($_POST["link_text"])); 
	//$page = trim(addslashes($_POST["page"]));
	//$slug = trim(addslashes($_POST["slug"]));
	
	
	
	
	$page = "home";
	$slug = "home";
	
	$hide = $_POST["hide"];
	$link_id = $_POST["link_id"];
	$ts = time();

	if(in_array(2,$user_functions_array)){
		// create a back up
		
		$backup = new Backup;
		$dbu = $backup->doBackup($link_id,$user_id,"link");	


		//echo $url;

		$sql = sprintf("UPDATE link SET url = '%s', link_text = '%s', page = '%s', slug = '%s', hide = '%u', last_update = '%u' WHERE link_id = '%u'", 
		$url, $link_text, $page, $slug, $hide, $ts, $link_id);
		$result = $dbCustom->getResult($db,$sql);
			
	
	
	
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table
												,when_submitted
												,submitted_by_login_id
												,slug
												,content_short1
												,content_short2
												,content_short3
												,hide
												,content_record_id) 
			VALUES ('%s','%u','%u','%s','%s','%s','%s','%u','%u')", 
			"link", $ts, $user_id, "link", $url, $link_text, $slug, $hide, $link_id);
		$msg = "Your change is now pending approval.";
	}
	$result = $dbCustom->getResult($db,$sql);
		
	
}



if(isset($_POST["add_link"])){
	
	
	$url = trim(addslashes($_POST['url'])); 
	$link_text = trim(addslashes($_POST["link_text"])); 
	//$page = trim(addslashes($_POST["page"]));
	//$slug = trim(addslashes($_POST["slug"]));
	$page = "home";
	$slug = "home";
	
	$ts = time();

	if(in_array(2,$user_functions_array)){

		$sql = sprintf("INSERT INTO link 
					(url, link_text, page, slug) 
					VALUES 
					('%s','%s','%s','%s')", 
					$url, $link_text, $page, $slug);
	}else{
		
		$sql = sprintf("INSERT INTO review (content_table, 
									when_submitted, 
									submitted_by_login_id, 
									slug,
									content_short1, 
									content_short2,
									content_short3,
									action,
									profile_account_id) 
		VALUES ('%s','%u','%u','%s','%s','%s','%s','%s','%u')", 
		"link", $ts, $user_id, "link", $url, $link_text, $slug, "add", $_SESSION['profile_account_id']);
		$msg = "Your change is now pending approval.";
		
	}
	$result = $dbCustom->getResult($db,$sql);
	
}


if(isset($_POST["del_link"])){

	if(in_array(2,$user_functions_array)){
		$link_id = $_POST["del_link_id"];

		$backup = new Backup;
		$dbu = $backup->doBackup($link_id,$user_id,"link","delete");	

		$sql = sprintf("DELETE FROM link WHERE link_id = '%u'", $link_id);
		$result = $dbCustom->getResult($db,$sql);
		//
		$sql = "DELETE FROM review WHERE content_record_id = '".$link_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
	}else{
		$msg = "This user is not allowed to delete.";		
	}

}

require_once($real_root."/includes/doc_header.php"); 


?>

<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 
	
		if(this.href.indexOf("edit") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
			//alert(f_id);			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'edit-link.php?link_id='+f_id,
			  success: function(data) {
				$('#edit').html(data);
				//alert('Load was performed.');
			  }
			});			
		}
		
		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_link_id").val(f_id);
			
		}

		
	})
	$("a.inline").fancybox();
});


function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}


</script>
</head>
	<body>
<?php
	require_once($real_root."/includes/manage-header.php");
	require_once($real_root."/includes/manage-top-nav.php");
?>




<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once($real_root."/includes/manage-side-nav.php");
        ?>
    </div>	

	
  	<div class="top_link">
	    <a class='inline' href='#add'>Add Link</a>
    </div>


    <div class="manage_main">
    
    
<?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    
        $bc = $bread_crumb->output();
        echo $bc; 

?>




	<table width="100%" cellpadding="6">
    	<td width="8%">&nbsp;</td>
        <td width="8%">&nbsp;</td>
    	<td width="8%"><div class="head">Status</div></td>
        <td width="42%"><div class="head">URL</div></td>
    	<td width="18%"><div class="head">Link</div></td>
        <td><div class="head">Slug</div></td>
        
		</tr>
	<?php    
    
    $sql = "SELECT * FROM link WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
    $result = $dbCustom->getResult($db,$sql);		

    while($row = $result->fetch_object()) {
    	$block = "<tr>"; 				
		
 		if(in_array(2,$user_functions_array)){
			//class='inline'		
			$block .= "<td valign='top'><a  href='edit-link.php?link_id=".$row->link_id."' style='color:#3f6e84;'>edit</a>
			
			</td>";
			
			//<div class='e_sub' id='".$row->link_id."' style='display:none'></div> 
			
			$block .= "<td valign='top'><a class='inline' href='#delete'>
			delete<div class='e_sub' id='".$row->link_id."' style='display:none'></div> </a></td>";
		}else{
			$block .= "<td>&nbsp;</td>";
		
$block .= "<td valign='top'><a  href='edit-link.php?link_id=".$link_id."' style='color:#3f6e84;'>edit</a></td>";		}
		
		if($row->hide){
			$show_hide = "Hidden";
		}else{
			$show_hide = "<span style='color:red'>Live</span>";	
		}

		$block .= "<td valign='top'>$show_hide</td>";
		$block .= "<td valign='top'>$row->url</td>";
		$block .= "<td valign='top'><a href='".SITEROOT.$row->url."' target='_blank'>$row->link_text</a></td>";
		$block .= "<td valign='top'></td>";
		$block .="</tr>";
	    echo $block;
    }
    ?>

    
    
    
    </table>  
  
    
    
    
 	<div style="display:none">
        <div id="delete" style="width:250px; height:100px;">
        	<br />
            Are you sure you want to delete this link?<br />
            <form name="del_link" action="link.php" method="post">
                <input id="del_link_id" type="hidden" name="del_link_id" />
                <input name="del_link" type="submit" value="DELETE" />
            </form>
        
        
        </div>
    </div>



    <div style="display:none">
        <div id="edit" style="width:360px; height:320px;">

        </div>
    </div>



    <div style="display:none">
        <div id="add" style="width:340px; height:250px;">
            <form name="add_link" action="link.php" method="post">
             <table width="100%">
             <tr>
             	<td width="30%" height="50"  align="left">
                    <div class="head">Link To</div>
                </td>
                <td align="left">
				<select name="url" style="width:180px;">
                <option value='' >none</option>
                               
				<?php
						
                        $db = $dbCustom->getDbConnect(CART_DATABASE);
                        $sql = "SELECT cat_id, name  
                                FROM category
								ORDER BY cat_id";  
                        $cat_res = mysql_query ($sql);
                        if(!$cat_res)die(mysql_error());
                        //echo " ".$cat_res->num_rows;
						
						
						while($row = $cat_res->fetch_object()) {
							
                            //echo "<option value='/storage-shop/category/".getUrlText($row->name)."/".$row->cat_id."'>$row->name</option>";
							
							echo "<option value='/storage-shop/category/".getUrlText($row->name)."/".$row->cat_id."' >$row->name</option>";
                        
						
						
						
						
						
						
						}
						
                
                ?>




                    <option value="/closet-organizer/closet-system-installers.html">installers wanted</option>
                    <option value="/closet-organizer/closet-organizers-feedback.html">feedback</option>
                    <option value="/closet-organizer/closet-organizers-privacy-statement.html">privacy statement</option>
                    <option value="/closet-organizer/closet-organizers-terms-of-use.html">terms of use</option>
                    <option value="/closet-organizer/closet-organizers-in-home-consultation.html">in home consultation</option>
                    <option value="/custom-closets/showroom-sub.html">custom closets</option>
                    <option value="/closet-design.html">design online</option>
                    <option value="/custom-closet-organizers/closet-system-faq.html">support - FAQ</option>
                    <option value="/custom-closet-organizers/closet-system-contact.html">support - contact us</option>
                    <option value="/custom-closet-organizers/closet-system-guides-and-tips.html">support - guides & tips</option>
                    <option value="/closet-systems/custom-closets-process.html">company - process</option>
                    <option value="/closet-systems/custom-closets-policies.html">company - policies</option>
                    <option value="/closet-systems/custom-closets-shipping.html">company - shipping</option>
                    <option value="/closet-systems/closet-organizer-discounts.html">company - discounts</option>
                    <option value="/closet-systems/custom-closets-testimonials.html">company - testimonials</option>
                    <option value="/closet-systems/about-closet-organizer.html">company - about us</option>
                </select>
                </td>
             </tr>
             <tr>
             	<td height="50" align="left">
                    <div class="head">Link Text</div>
                 </td>
                 <td align="left">   
            		<input type="text" name="link_text" style="width:180px;" />                    
                </td>
             </tr>
             <!--
             <tr>
             	<td height="50" align="left">
                    <div class="head">Page</div>
                </td>
                <td align="left"> 
                    <select name="page" style="width:180px;">
                        <option value="home">home</option>
                    </select>
                </td>
             </tr>
             <tr>
             	<td height="50" align="left">
                    <div class="head">Slug</div>
                </td>
                <td align="left"> 
                    <select name="slug" style="width:180px;">
                        <option value="home">home</option>
                    </select>
                </td>
             </tr>
             -->
            <tr>
            	<td></td>
                <td  height="60" align="left">
                 <div style="float:left;">		
                           <input name="add_link" type="submit" value="Add" />
                  </div>
                  <div style="float:left; padding-left:30px;">		
                            <input type="button" value="Cancel" onClick="location.href = 'link.php'; " />
                  </div>
                </td>
            </tr>
          </table>
          </form>
        </div>
    </div>


    
</div>
<p class="clear"></p>
<?php 
require_once($real_root."/includes/manage-footer.php");
?>

</div>

</body>
</html>



