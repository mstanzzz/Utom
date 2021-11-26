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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;



$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>

	
<?php 
$showroom_item_id = $_GET['showroom_item_id']; 

$sql = sprintf("SELECT description FROM showroom_item WHERE showroom_item_id = '%u'", $showroom_item_id);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>

<div style="margin:auto; text-align:left;">

<?php echo stripslashes($object->description); ?> 

</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</body>
</html>



