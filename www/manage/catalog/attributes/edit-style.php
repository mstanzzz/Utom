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

$page_title = "Edit Style";
$page_group = "vend-man";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>
<div class="manage_page_container">
  <div class="top_link"> <a href='style.php'>Back</a><br>
  </div>
  <div class="manage_main">
    <?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    
        $bc = $bread_crumb->output();
        echo $bc."<br />"; 


	$style_id = $_GET['style_id']; 

	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = sprintf("SELECT * FROM style WHERE style_id = '%u'", $style_id);
$result = $dbCustom->getResult($db,$sql);	
	
	$object = $result->fetch_object();
	
	?>
	
	<form name="edit_style" action="style.php" method="post">
       	<input id="style_id" type="hidden" name="style_id" value="<?php echo $style_id;  ?>" />

            <div class="head">style name</div><br />
            <input type="text" name="name" value="<?php echo stripslashes($object->name); ?>" style="width:300px" />
            <br />
            <div style="float:left; padding-right:100px; padding-top:15px;">
                <input name="edit_style" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-top:15px;">
                <input type="button" value="Cancel" onClick="location.href = 'style.php'" />
            </div>  
            </form>




</div>
    <p class="clear"></p>

</div>
</body>
</html>

