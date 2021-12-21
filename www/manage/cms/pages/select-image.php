<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;


$page_title = "Select Image";
$page_group = "home-page";

	


$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = '';


$page_title = "Select Image";
$page_group = "home-page";


$banner_id = (isset($_GET["banner_id"])) ? $_GET["banner_id"] : 0; 


if(isset($_POST["add_img"])){
	
	$ret_page = $_REQUEST['ret_page'];
	
	$new_img_id = $_POST['img_id'];
	
	$banner_id = $_POST["banner_id"];
	
	$_SESSION['img_id'] = $img_id;



	$header_str = "Location: ".$ret_page.".php";
	$header_str .= "?banner_id=".$banner_id;
	$header_str .= "&new_img_id=".$new_img_id;
	$header_str .= "&is_new_img=1";
	
		
	$header_str .= "&msg=".$msg;
	
	//echo "header_str=======================:   ".$header_str;
	//exit;	

	header($header_str);

}

$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";

$banner_id =  (isset($_REQUEST['banner_id'])) ? $_REQUEST['banner_id'] : 0;


//echo $banner_id;


$sql = "SELECT max(img_id) AS img_id  
		FROM image
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		$img_res = $dbCustom->getResult($db,$sql);
		$img_obj = $img_res->fetch_object();

$_SESSION['img_id'] = $img_obj->img_id;


//echo $ret_page;
if($ret_page == "add-home-banner" || $ret_page == "edit-home-banner"){
	$slug = "home";
	
	//exit;
}else{
	$slug ='';
}	

if($slug != ''){
	

			$sql = "SELECT file_name, img_id 
			FROM image
			WHERE slug = '".$slug."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'  
			ORDER BY img_id";
	$result = $dbCustom->getResult($db,$sql);			
			//echo "kk====kkk".$result->num_rows;

	//exit;


}else{

			$sql = "SELECT file_name, img_id 
			FROM image
			AND profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY img_id";
	$result = $dbCustom->getResult($db,$sql);			
			//echo "====".$result->num_rows;
		
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

<script>

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}


function validate(theform){	


	
	var num_i = document.add_image.img_id.length; 
	
	if(!IsNumeric(num_i)){
		alert("Please selectan image.");
		return false;
	}
	

	return true;
}



function select_img(img_id){
	
	document.getElementById("r"+img_id).checked = true;
	
	//alert("lll");
		
}

</script>
</head>

<body>
<div class="lightboxholder">
	<form name="add_image"  action="select-image.php?parent_cat_id=<?php echo $parent_cat_id; ?>&ret_page=<?php echo $ret_page; ?>" method="post" onSubmit="return validate(this)"  enctype="multipart/form-data">
		<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
		<input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>" />
		<div class="lightboxcontent">
			<a class="btn" href="<?php echo $ret_page; ?>.php?ret_page=<?php echo $ret_page; ?>'&parent_cat_id='<?php echo $parent_cat_id; ?>&banner_id=<?php echo $banner_id; ?>"><i class="icon-arrow-left"></i> Cancel, Go Back</a>
			<h2><?php echo $page_title; ?></h2>
			<div class="data_table">
			<table width="100%" cellpadding="10" cellspacing="0" border="0">
				<thead>
					<tr>
						<th width="33%">Image</th>
						<th width="33%">Select</th>
						<th>In Use?</th>
					</tr>
				</thead>
				<?php
					$block = "<tr>"; 
				while($row = $result->fetch_object()) {
					$sel = ($_SESSION['img_id']) ? "checked='checked'" : ''; 
					$block .= "<td><img src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cms/".$row->file_name."' 
					onClick='select_img(".$row->img_id.")' width='85%' /></td>";
					$block .= "</td>";
					$block .= "<td valign='top'>".$row->file_name." <input id='r".$row->img_id."' type='radio' name='img_id' value='".$row->img_id."' $sel /></td>";
					$block .= "<td valign='top'>";	
					$db = $dbCustom->getDbConnect(SITE_N_DATABASE);		
					$sql = "SELECT banner_id
					FROM banner, image
					WHERE banner.img_id = image.img_id
					AND banner.img_id = '".$row->img_id."'";
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
	</div>
	<div class="savebar">
	  	<button type="submit" name="add_img" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save Selected Image &amp; Return to Edit Screen</button>
	</div>
  </form>
</div>
</body>
</html>

