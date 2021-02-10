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


$db = $dbCustom->getDbConnect(CART_DATABASE);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


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
                <input type="text" name="name" value="<?php echo prepFormInputStr($object->name); ?>" style="width:300px" />

               
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



