<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$page_title = "Add Video";
$page_group = "video";

$ret_page = (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : 'edit-item';
$strip = (isset($_REQUEST['strip'])) ? $_REQUEST['strip'] : 0;
$fromfancybox = (isset($_GET['fromfancybox'])) ? $_GET['fromfancybox'] : 0;

$video_id = (isset($_GET['video_id'])) ? $_GET['video_id'] : 0;

$msg = '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST['edit_video'])){


	$title = trim(addslashes($_POST['title']));
		
	$description = trim(addslashes($_POST['description']));
		
	$video_id = $_POST['video_id'];
	
		
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
			
		$i = 0;	
		foreach($_SESSION['temp_videos'] as $val){			
			if($_SESSION['temp_videos'][$i]['video_id'] == $video_id){
				$_SESSION['temp_videos'][$i]['title'] = $title;
				$_SESSION['temp_videos'][$i]['description'] = $description;					
			}
			$i++;
		}
			
			
	}
	
	$header_str = "Location: ".$ret_page.".php";

	header($header_str);

		
		
		
}

$youtube_id = '';
$title = '';
$description = '';

if ($stmt = $db->prepare("SELECT youtube_id, title, description FROM video WHERE video_id = ?")) {
			
	$stmt->bind_param('i', $video_id);
			
	$stmt->execute();
			
	$stmt->store_result();
			
	if($stmt->num_rows > 0){
				
		$stmt->bind_result($youtube_id, $title, $description);
		
		$stmt->fetch();
				
	}		
	$stmt->close();
			
}
					
		

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body class="lightbox">

		<br />
        
        <img width='200' height='200' src='http://img.youtube.com/vi/<?php echo $youtube_id; ?>/0.jpg' />
		
        
        
        
        	
            <?php echo $msg; ?> 
            
			<form action="edit-item-video.php" method="post" enctype="multipart/form-data" <?php if(!$strip) echo "target='_top'"; ?>>
            <input type="hidden" name="ret_page" value="<?php echo $ret_page; ?>" />
			<input type="hidden" name="fromfancybox" value="<?php echo $fromfancybox; ?>" />
            
            <input type="hidden" name="video_id" value="<?php echo $video_id; ?>" />
           
           
    
                        
				<center>
							
                    <label>Title</label>
					<input type="text" name="title" value="<?php echo stripslashes($title); ?>" style="width:400px !important;" />
                            
                    <br />
                    <br />
                            
                    <label>Description </label>
                    <textarea cols="20" rows="5" name="description"><?php echo stripslashes($description); ?></textarea>
                    
                    
                    <br /><br />	
                
               
                    
                    <button type="submit" name="edit_video" class="btn btn-success"><i class="icon-ok icon-white"></i> Submit </button>
                        
                    <a class="btn btn-large" 
                    href="<?php echo $ret_page.".php"; ?> 
                    <?php if(!$fromfancybox){ echo "target='_top'"; } ?>>Cancel</a> 
               
               	</center>
    
    		</form>
    
    
    
    
    	
</body>
</html>
