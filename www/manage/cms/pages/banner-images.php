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

$page_title = "Cart Categories";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = '';
if(isset($_POST["del_img"])){

	$img_id = $_POST["del_img_id"];

	$sql = sprintf("SELECT file_name FROM image WHERE img_id = '%u'", $img_id);
	$img_res = $dbCustom->getResult($db,$sql);
	
	$object = $img_res->fetch_object();
	
	$myFile = "../uploads/$object->file_name";
	if(file_exists($myFile)) unlink($myFile);
	
	$sql = sprintf("DELETE FROM image WHERE img_id = '%u' AND slug = 'home' ", $img_id);
	$result = $dbCustom->getResult($db,$sql);
	

}





require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_img_id").val(f_id);
		}
		
		if(this.href.indexOf("upload") > 1){
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'upload.php?img_width=200&img_height=180&ret_page=images',
			  success: function(data) {
				$('#upload').html(data);
				//alert('Load was performed.');
			  }
			});			
		}
		
	})

	
	$("a.inline").fancybox();
	
});

function select_img(img_id){
	document.getElementById("r"+img_id).checked = true;	
}

</script>
</head>

	<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>



<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');


		?>
    </div>	

   	<div class="top_link">
	    <a href='home.php'>back</a><br>
    </div>



    <div class="manage_main">

	<?php
 		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Pages", SITEROOT."/manage/cms/pages/page.php");
		$bread_crumb->add("Banner Images", '');
        echo $bread_crumb->output();

	?>


    <table border="0" width="100%" cellpadding="18">
    <tr>
    <td width="10%">&nbsp;</td>
    <td>Image</td>
    <td>File Name</td>
    <td>Use</td>
    </tr>
    <?php

	$sql = "SELECT file_name, img_id, slug
	FROM image
	WHERE slug = 'home'
	AND profile_account_id = '".$_SESSION['profile_account_id']."'
	ORDER BY file_name";
	
    $result = $dbCustom->getResult($db,$sql);	
	//echo "====".$result->num_rows;

	
    $block = "<tr>"; 
    while($row = $result->fetch_object()) {
        
		if(in_array(2,$user_functions_array)){
			$block .= "<td valign='top'><a class='inline' href='#delete'>
			delete<div class='e_sub' id='".$row->img_id."' style='display:none'></div> </a></td>";
		}else{
			$block .= "<td>&nbsp;</td>";
		}
		$block .= "<td valign='top'><img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/banner/".$row->file_name."' width='200'/></td>";
		
		$block .= "<td valign='top'>$row->file_name</td>";
		
		$block .= "<td>";
		
		$sql = "SELECT banner_id
		FROM banner, image
		WHERE banner.img_id = image.img_id
		AND banner.img_id = '".$row->img_id."'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
	    $t_result = mysql_query ($sql);
		if(mysql_num_rows($t_result) > 0){
			$block .= "Used";
		}else{
			$block .= "Not used";
			
		}
		$block .= "</td>";
				
        $block .= "</tr>";
    }
    echo $block;
    ?>
    </table>
    

    

</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</div>

     
    <div style="display:none">
        <div id="upload" style="width:280px; height:200px;">
        </div>
    </div>

    <div style="display:none">
        <div id="delete" style="width:280px; height:100px; text-align:center;">
            Are you sure you want to delete this image?
            <form name="del_img_form" action="banner-images.php" method="post" enctype="multipart/form-data">
                <input id="del_img_id" type="hidden" name="del_img_id" />
                <input name="del_img" type="submit" value="DELETE" />
            </form>
        </div>
    </div>
</body>
</html>

