<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');


$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;


$page_title = "Add Video";
$page_group = "video";



$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'edit-item';
$strip = (isset($_REQUEST['strip'])) ? $_REQUEST['strip'] : 0;


$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;


$msg = '';

if(isset($_POST['add_video'])){

	if(!isset($_SESSION['temp_videos'])) $_SESSION['temp_videos'] = array();
	
	$youtube_url = trim($_POST['youtube_url']);
	$temp = explode('?v=',$youtube_url);
	
	//print_r($temp);
	
	if(isset($temp[1])){
		
		
		$youtube_id = $temp[1]; 
		
		$title = trim(addslashes($_POST['title']));
		
		$description = trim(addslashes($_POST['description']));
	
		$indx = count($_SESSION['temp_videos']);
		
		$video_id = 0;
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		
		if ($stmt = $db->prepare("SELECT video_id FROM video WHERE youtube_id = ?")) {
			
			$stmt->bind_param('s', $youtube_id);
			
			$stmt->execute();
			
			
			if($stmt->num_rows > 0){
				
				$stmt->bind_result($video_id);
			
				$stmt->fetch();
				
			}
			
			$stmt->close();
			
		}
		

		if($video_id > 0){
			
			$stmt = $db->prepare("UPDATE video
								SET title = ?
									,description = ?
								WHERE video_id = ?");
			
			$stmt->bind_param("ssi",
						$title
						,$description 
						,$video_id);						
			
			$stmt->execute();
			$stmt->close();
			
			$in_session = 0;
			$i = 0;	
			foreach($_SESSION['temp_videos'] as $val){			
				if($_SESSION['temp_videos'][$i]['video_id'] == $video_id){
					$in_session = 1;
					$_SESSION['temp_videos'][$i]['title'] = $title;
					$_SESSION['temp_videos'][$i]['description'] = $description;
				}
				$i++;
			}
			
			if(!$in_session){
			
				$indx = count($_SESSION['temp_videos']);
				
				$_SESSION['temp_videos'][$indx]['video_id'] = $video_id;
				$_SESSION['temp_videos'][$indx]['youtube_id'] = $youtube_id;
				$_SESSION['temp_videos'][$indx]['title'] = $title;
				$_SESSION['temp_videos'][$indx]['description'] = $description;
				
			}
			
			
		}else{
			
			$stmt = $db->prepare("INSERT INTO video
								(youtube_id ,title ,description, profile_account_id)
								VALUES
								(?,?,?,?)");
			$stmt->bind_param("sssi",
						$youtube_id
						,$title 
						,$description
						,$_SESSION['profile_account_id']);
			
			$stmt->execute();
			$stmt->close();
			
			$the_id = $db->insert_id;
			
			$indx = count($_SESSION['temp_videos']);
			
			$_SESSION['temp_videos'][$indx]['video_id'] = $the_id;
			$_SESSION['temp_videos'][$indx]['youtube_id'] = $youtube_id;
			$_SESSION['temp_videos'][$indx]['title'] = $title;
			$_SESSION['temp_videos'][$indx]['description'] = $description;								
			
			
		}
		
		$header_str = "Location: ".$ret_page.".php";

		header($header_str);
		
		
	}else{
		$msg = 'The URL is not properly formatted';	
	}
	
	/*
	
		$sql = "SELECT video_id 
				FROM video 
				WHERE youtube_id = '".$youtube_id."'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";									
		$result = $dbCustom->getResult($db,$sql);	
		if($result->num_rows > 0){
			$object = $result->fetch_object();
					
					
					
			$_SESSION['temp_videos'][$indx]['video_id'] = $object->video_id;
			$_SESSION['temp_videos'][$indx]['youtube_id'] = $youtube_id;	
			
		}else{
			
			$sql = "INSERT INTO video
					(youtube_id, profile_account_id) 
					VALUES
					( '".$youtube_id."', '".$_SESSION['profile_account_id']."')";
			$result = $dbCustom->getResult($db,$sql);		
			
			$video_id = $db->insert_id;
			
			$_SESSION['temp_videos'][$indx]['video_id'] = $video_id;
			$_SESSION['temp_videos'][$indx]['youtube_id'] = $youtube_id;	
			
		}
		
		
		//print_r($_SESSION['temp_videos']);
		

		$header_str = "Location: ".$ret_page.".php";
		$header_str .= "?parent_cat_id=".$parent_cat_id;	
		$header_str .= "&cat_id=".$cat_id;		
		

		header($header_str);
	
	}else{
		$msg = 'The URL is not properly formatted';	
	}
	
	*/
		
	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body class="lightbox">

		<br /><br />
		<br /><br />
        <br /><br />	
            <?php echo $msg; ?> 
            
			<form action="add-item-video.php" method="post" enctype="multipart/form-data" <?php if(!$strip) echo "target='_top'"; ?>>
            <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
			<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>" />
           
    
                        
				<center>
							<label>Enter the whole Youtube URL</label>
							<input type="text" name="youtube_url" style="width:400px !important;" />
                            
                            <br />
                            <br />
					
                    		<label>Title</label>
							<input type="text" name="title" style="width:400px !important;" />
                            
                            <br />
                            <br />
                            
                            <label>Description </label>
                            <textarea cols="20" rows="5" name="description"></textarea>
                    
                    
                    <br /><br /><br />	
                
               
                    
                    <button type="submit" name="add_video" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
                        
                    <a class="btn btn-large" 
                    href="<?php echo $ret_page.".php"; ?> 
                    <?php if(!$fromfancybox){ echo "target='_top'"; } ?>>Cancel</a> 
               
               	</center>
    
    		</form>
    
    
    
    
    	
</body>
</html>
