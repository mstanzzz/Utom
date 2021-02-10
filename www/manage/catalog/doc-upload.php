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


//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/accessory_cart_functions.php");

$msg = '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



if($_POST){
	
	include($_SERVER['DOCUMENT_ROOT'].'/includes/class.upload.php');	

	$ret_page = $_POST['ret_page'];
	$ret_dir = $_POST['ret_dir'];	
	$parent_cat_id = $_POST['ret_dir'];
	$cat_id	= $_POST['ret_dir'];
	$fromfancybox = $_POST['fromfancybox'];
	$vend_man_id = isset($_POST['vend_man_id']) ? $_POST['vend_man_id'] : 0;;
	$name = addslashes($_POST['name']);


	$document_id = 0;
	
	$handle = new Upload($_FILES['uploadedfile']);
	

	if ($handle->uploaded) {
		// The file is on the server, now do stuff to it 
		// see http://www.verot.net/res/sources/class.upload.html        
		//$handle->file_max_size = 800000; 		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$vm_name = '';
		if($vend_man_id > 0){
			$sql = "SELECT name FROM vend_man 
					WHERE vend_man_id = '".$vend_man_id."'";									
			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				$object = $result->fetch_object();
				$vm_name = getUrlText($object->name);				
				$vm_name = '/'.$vm_name;
				
			}
		}
		
		$dir_dest = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cart/docs".$vm_name;
		
		// copy the uploaded file from its temporary location to the wanted location
		$handle->Process($dir_dest);
		if ($handle->processed) {
			
			$msg = "Upload Successful";

			$file_name = $handle->file_dst_name;
			
			
			if(strpos($ret_page,'item') !== false){
				
				
				$sql = sprintf("INSERT INTO document 
							(file_name, name, vend_man_id, profile_account_id) 
							VALUES ('%s','%s','%u','%u')", 
							$file_name, $name, $vend_man_id, $_SESSION['profile_account_id']);
				$r = $dbCustom->getResult($db,$sql);

				
				$document_id = $db->insert_id; 

			}
			
		}else{	
			$msg = "  Error: " . $handle->error;        
		}
		
		
		// delete the temporary files
		$handle->clean();
	} else {
		$msg = "  Error: " . $handle->error;        
	}


	$ret_page = $_POST['ret_page'];
	$ret_dir = $_POST['ret_dir'];	
	$parent_cat_id = $_POST['ret_dir'];
	$cat_id	= $_POST['ret_dir'];


	if($fromfancybox == 0){
		$header_str = $ret_dir."/".$ret_page.".php";
		$header_str .= "?parent_cat_id=".$parent_cat_id;	
		$header_str .= "&cat_id=".$cat_id;		
		$header_str .= "&document_id=".$document_id;
		$header_str .= "&action=upload_document";
		
		echo("<script language='javascript'>");
		echo("top.location.href = '".$header_str."';");
		echo("</script>");
	}else{
		$header_str = "Location: ".$ret_dir."/".$ret_page.".php";
		$header_str .= "?parent_cat_id=".$parent_cat_id;	
		$header_str .= "&cat_id=".$cat_id;		
		$header_str .= "&document_id=".$document_id;
		$header_str .= "&action=upload_document";
		
		header($header_str);
	}

}
require_once($_SERVER['DOCUMENT_ROOT'] ."/manage/admin-includes/doc_header.php"); 


?>
<script language="JavaScript">

/*
var submitted = false;
function doSubmit() {
	if (!submitted) {
		submitted = true;
		ProgressImg = document.getElementById('inprogress_img');
		document.getElementById("inprogress").style.visibility = "visible";
		setTimeout("ProgressImg.src = ProgressImg.src",1000);
		return true;
		
	}else {
		return false;
	}
}
*/

</script>
</head>

<body class="lightbox">
<?php 
//require_once("../admin-includes/manage-header.php");

$ret_page =  (isset($_GET['ret_page'])) ? $_GET['ret_page'] : "start";
$ret_dir =  (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : "pages";

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;

$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;

?>
<div class="lightboxholder">
	<form action="doc-upload.php" method="post" enctype="multipart/form-data" >
    
    <?php //if($fromfancybox){ echo "target='_self'"; }else{ echo "target='_top'"; } ?>
		
        <div class="lightboxcontent">
			<h2>Upload File</h2>

			<input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
			<input type="hidden" name="ret_dir" value="<?php echo $ret_dir; ?>" />
			<input type="hidden" name="parent_cat_id" value="<?php echo $parent_cat_id; ?>" />
			<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
			<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>" />
  		<input type="file" name="uploadedfile">
		<br /><br /><br />
        Name:<br />			
		<input type="text" name="name" style='width:400px;'>  
		<br />
        <?php
		// get total number of rows
		$sql = "SELECT * FROM vend_man 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
								
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$result = $dbCustom->getResult($db,$sql);
		
		if($result->num_rows > 0){
		?>
            <br /><br /><br />
            Vendor Manufacturer:<br />
            <select name="vend_man_id">
            <option value="0">None</option> 
            <?php
            while($row = $result->fetch_object()){
                echo "<option value='".$row->vend_man_id."'>".$row->name."</option>";	
            }
            ?>
            </select>
        <?php } ?>			
        
        
              
            
            <div class="center"><br />
			<a class="btn btn-large" 
            href="<?php echo $ret_dir."/".$ret_page.".php?parent_cat_id=".$parent_cat_id."&cat_id=".$cat_id; ?>" 
            <?php if(!$fromfancybox){ echo "target='_top'"; } ?>>Cancel</a> </div>
			<div class="loadinggif" id="inprogress"><img id="inprogress_img" src="<?php echo $ste_root; ?>/images/progress.gif">
				<p>Please Wait...</p>
			</div>
		</div>
		<br />
		<br />
		<br />
		<br />
        
		<div class="savebar">
        	<button type="submit" class="btn btn-large btn-success" value="Submit" onClick="document.getElementById('inprogress').style.visibility='visible'"><i class="icon-ok icon-white"></i> Upload File</button>
        </div>
	</form>
</div>
</body>
</html>
