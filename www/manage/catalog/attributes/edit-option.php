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
$opt_id = $_GET['opt_id']; 
$attribute_id = $_GET['attribute_id']; 


$sql = sprintf("SELECT * FROM opt WHERE opt_id = '%u'", $opt_id);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>
    
        <form name="edit_opt" action="option.php?attribute_id=<?php echo $attribute_id;  ?>" method="post">
       	<input id="opt_id" type="hidden" name="opt_id" value="<?php echo $opt_id;  ?>" />
            <div class="head">Attribute name</div><br />
            <input type="text" name="opt_name" value="<?php echo stripslashes($object->opt_name); ?>" style="width:300px" />
            <br />
            <div style="float:left; padding-right:100px; padding-top:15px;">
                <input name="edit_opt" type="submit" value="Save" />
            </div>
            <div style="float:left; padding-top:15px;">
                <input type="button" value="Cancel" onClick="location.href = 'attribute.php'" />
            </div>  
            </form>




</body>
</html>



