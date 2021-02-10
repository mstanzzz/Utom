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

$page_title = "Edit Lead Time";
$page_group = "vend-man";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$msg = '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</script>	
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
	
	$skill_level_id = $_GET['skill_level_id']; 
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = sprintf("SELECT * FROM skill_level WHERE skill_level_id = '%u'", $skill_level_id);
$result = $dbCustom->getResult($db,$sql);	
	$object = $result->fetch_object();

	?>
    
        <form name="edit_skill_level" action="skill-level.php" method="post">
       	<input id="skill_level_id" type="hidden" name="skill_level_id" value="<?php echo $skill_level_id;  ?>" />
        
        	<div style="float:left; width:560px;">
                <div class="head">level name</div><br />
                <input type="text" name="level_name" value="<?php echo prepFormInputStr($object->level_name); ?>" style="width:300px" />

               
            </div> 
                   
        	<div style="float:left; width:560px;">
                <div class="head">description</div><br />
                <textarea name="description" cols="60" rows="4">
                <?php echo $object->description; ?>
                </textarea> 
                
           
            </div> 
            
            <div class="clear"></div>
            <div style="float:left; padding-right:100px; padding-top:15px;">
                <input name="edit_skill_level" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-top:15px;">
                <input type="button" value="Cancel" onClick="location.href = 'skill-level.php'" />
            </div>  
            </form>



</div>
    <p class="clear"></p>

</div>
</body>
</html>


<?php
require_once("../../includes/config.php"); 
require_once("../admin-includes/class.setup_progress.php"); 
$progress = new SetupProgress;


$db = $dbCustom->getDbConnect(CART_DATABASE);

?>


