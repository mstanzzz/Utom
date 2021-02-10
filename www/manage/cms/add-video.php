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


$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;


$page_title = "Add Video";
$page_group = "video";

$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'select-video';

$strip = (isset($_REQUEST['strip'])) ? $_REQUEST['strip'] : 0;


$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

if(isset($_POST['add_video'])){

	
	$youtube_url = trim($_POST['youtube_url']);
	$temp = explode('?v=',$youtube_url);
	
	//echo $temp[1];
	
	if(isset($temp[1])){
	
		//echo "<br />";
		//print_r($temp);
		
		$youtube_id = $temp[1]; 
		
		//echo "<br />";
		//echo "youtube_id:  ".$youtube_id;
		
		$name = trim(addslashes($_POST['name']));
		
		$description = trim(addslashes($_POST['description']));
		
		$video_id = 0;
		
		if ($stmt = $db->prepare("SELECT video_id FROM video WHERE youtube_id = ?")) {
			
			$stmt->bind_param('s', $youtube_id);
			
			$stmt->execute();
			
			
			if($stmt->num_rows > 0){
				
				$stmt->bind_result($video_id);
			
				$stmt->fetch();
				
			}
			
			$stmt->close();
			
		}
		
		
		//echo "<br />";
		//echo "video_id:  ".$video_id;

		if($video_id > 0){
			
			$stmt = $db->prepare("UPDATE video
								SET name = ?
									,description = ?
								WHERE video_id = ?");
			
			$stmt->bind_param("ssi",
						$name
						,$description 
						,$video_id);						
			
			$stmt->execute();
			$stmt->close();
			
		}else{
			
			//echo $youtube_id;
		
			//echo "<br />";
			
			
			$stmt = $db->prepare("INSERT INTO video
								(youtube_id ,name ,description, profile_account_id)
								VALUES
								(?,?,?,?)");
								
			//echo 'Error INSERT   '.$db->error;
								
			if(!$stmt->bind_param("sssi",
						$youtube_id
						,$name 
						,$description
						,$_SESSION['profile_account_id'])){
			
				//echo 'Error-2 '.$db->error;
			
			}else{
				$stmt->execute();
				$stmt->close();
				
				$the_id = $db->insert_id;
				
			}
			
		
			
			
			$header_str = "Location: ".$ret_page.".php";
	
			header($header_str);
			
			
			
			
		}
			
	}else{
		$msg = 'The URL is not properly formatted';	
	}
	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body class="lightbox">

		<br /><br />
		<br /><br />
        <br /><br />	
            <?php echo $msg; ?> 
            
			<form action="add-video.php" method="post" enctype="multipart/form-data" <?php if(!$strip) echo "target='_top'"; ?>>

			<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>" />
           
    
                        
				<center>
							<label>Enter the whole Youtube URL</label>
							<input type="text" name="youtube_url" style="width:400px !important;" />
                            
                            <br />
                            <br />
					
                    		<label>Name</label>
							<input type="text" name="name" style="width:400px !important;" />
                            
                            <br />
                            <br />
                            
                            <label>Description </label>
                            <textarea cols="20" rows="5" name="description"></textarea>
                    
                    
                    <br />
               
                    
                    <button type="submit" name="add_video" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
                        
                    <a class="btn btn-large" href="<?php echo $ret_page.".php"; ?>">Cancel</a> 
               
               	</center>
    
    		</form>
    
    
    
    
    	
</body>
</html>
