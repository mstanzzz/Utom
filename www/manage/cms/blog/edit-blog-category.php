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
$blog_cat_id = $_GET['blog_cat_id']; 

$sql = sprintf("SELECT * FROM blog_category
				WHERE blog_cat_id = '%u'
				AND profile_account_id = '%u'", $blog_cat_id, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>
    
        <form name="edit_blog_cat_form" action="blog.php" method="post">
       	<input id="blog_cat_id" type="hidden" name="blog_cat_id" value="<?php echo $blog_cat_id;  ?>" />
        	
		<table border="0" cellpadding="15">
        <tr>
        <td colspan="2">
        <div class="head">Category</div>
        <input type="text"  name="name" value="<?php echo $object->name; ?>" style="width:300px">
		</td>
		</tr>
        <tr>
        <td height="40">		
        <input name="edit_blog_cat" type="submit" value="Save" />
        </td>
        </tr>
        </table>
        </form>


</body>
</html>



