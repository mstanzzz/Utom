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

$page_title = 'Logo';
$page_group = 'logo';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$logo_id = (isset($_GET["logo_id"]))? $_GET["logo_id"] : 0;


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 
	
		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_logo_id").val(f_id);	
		}
	})
	
	$("a.inline").fancybox();
	
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

</script>
</head>
<body>
<?php 
	
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT logo.logo_id, logo.active, image.file_name 
    FROM logo, image 
    WHERE logo.img_id = image.img_id
	AND logo.logo_id = '".$logo_id."'";
	$result = $dbCustom->getResult($db,$sql);	
	
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		echo "<img src='".SITEROOT."/uploads/logo/".$img_obj->file_name."'  />";
	}
	
	?>
      <div id="delete" class="lightboxcontent">
        <h2>Are you sure you want to delete this logo?</h2>
        <form name="del_logo" action="logo.php" method="post" target="_top">
          <input id="del_logo_id" type="hidden" name="del_logo_id" value="<?php echo $logo_id; ?>" />
          <input name="del_logo" class="btn btn-large btn-danger"  type="submit" value="DELETE" />
        </form>
      </div>
</body>
</html>

