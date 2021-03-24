<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;



$page_title = "Edit Lead Time";
$page_group = "vend-man";

	


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
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
$attribute_id = $_GET['attribute_id']; 


$sql = sprintf("SELECT * FROM attribute WHERE attribute_id = '%u'", $attribute_id);
$result = $dbCustom->getResult($db,$sql);
$object = $result->fetch_object();

?>
    
        <form name="edit_attribute" action="attribute.php" method="post">
       	<input id="attribute_id" type="hidden" name="attribute_id" value="<?php echo $attribute_id;  ?>" />
            <div class="head">Attribute name</div><br />
            <input type="text" name="attribute_name" value="<?php echo stripslashes($object->attribute_name); ?>" style="width:300px" />
            <br />
            <div style="float:left; padding-right:100px; padding-top:15px;">
                <input name="edit_attribute" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-top:15px;">
                <input type="button" value="Cancel" onClick="location.href = 'attribute.php'" />
            </div>  
            </form>


</div>
    <p class="clear"></p>
 
</div>
</body>
</html>



















