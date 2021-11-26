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
require_once($real_root."/includes/config.php"); 

$msg = '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



if($_POST){
	
	include($_SERVER['DOCUMENT_ROOT'].'/includes/class.upload.php');	

	$name = trim(addslashes($_POST['name']));
	
	$ret_doc_id = 0;
	
	$dir_dest = $_SERVER['DOCUMENT_ROOT']."/saascustuploads/".$_SESSION['profile_account_id']."/cms/doc/";
	
	if(!file_exists($dir_dest)){
		mkdir($dir_dest);	
	}
	
	$handle = new Upload($_FILES['uploadedfile']);
	

	if ($handle->uploaded) {
	
		// copy the uploaded file from its temporary location to the wanted location
		$handle->Process($dir_dest);

		if ($handle->processed) {
			
			
			$msg = "Upload Successful";

			$file_name = $handle->file_dst_name;
			
				
			$sql = sprintf("INSERT INTO document (name, file_name, profile_account_id) VALUES ('%s','%s','%u')", $name, $file_name, $_SESSION['profile_account_id']);
			$r = $dbCustom->getResult($db,$sql);

			$ret_doc_id = $db->insert_id; 
			
			
		}else{	
			$msg = "  Error: " . $handle->error;        
		}
				
		// delete the temporary files
		$handle->clean();
	} else {
		$msg = "  Error: " . $handle->error;        
	}

	
	
	$header_str = "Location: select-doc.php";
	
	$header_str .= "?ret_doc_id=".$ret_doc_id;
		
	$header_str .= "&msg=".$msg;


	header($header_str);
		

//echo $header_str;
//exit;






}
require_once("../admin-includes/doc_header.php"); 


?>

</head>

<body>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        //require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">

        <div class="colcontainer">
        <form action="upload-doc.php" method="post" enctype="multipart/form-data" >
            
            
                <h2>Upload File</h2>
    
                <br />
                
                <label> Document Name </label>
                <input type="text" name="name"  />    
                
                <br /><br />
                
                <input type="file" name="uploadedfile">
                <div class="center">
                
                <?php
                    $url_str = SITEROOT.'/manage/cms/select-doc.php';		
                ?>            
                
                
                <a class="btn btn-large" 
                href="<?php echo $url_str; ?>" target='_top'>Cancel</a> </div>
                
                <div class="loadinggif" id="inprogress"><img id="inprogress_img" src="<?php echo SITEROOT; ?>images/progress.gif">
                    <p>Please Wait...</p>
                </div>
            
            
                <button type="submit" class="btn btn-large btn-success" value="Submit" onClick="document.getElementById('inprogress').style.visibility='visible'"><i class="icon-ok icon-white"></i> Upload File</button>
            
        </form>
        </div>
        
	</div>
</div>
</body>
</html>
