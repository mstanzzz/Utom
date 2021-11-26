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


$db = $dbCustom->getDbConnect(CART_DATABASE);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

</head>

<body>
	
<?php 
$return_to_id = $_GET['return_to_id']; 


$sql = sprintf("SELECT * FROM return_to WHERE return_to_id = '%u'", $return_to_id);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>
    
        <form name="edit_return_to" action="return-to.php" method="post">
       	<input id="return_to_id" type="hidden" name="return_to_id" value="<?php echo $return_to_id;  ?>" />
        
        	<div style="float:left; width:560px;">
                <div class="head">Return To</div><br />
                <input type="text" name="name" value="<?php echo stripslashes($object->name); ?>" style="width:300px" />

               
            </div> 
                   


            
            <div class="clear"></div>
            <div style="float:left; padding-right:100px; padding-top:15px;">
                <input name="edit_return_to" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-top:15px;">
                <input type="button" value="Cancel" onClick="location.href = 'return-to.php'" />
            </div>  
            </form>




</body>
</html>



