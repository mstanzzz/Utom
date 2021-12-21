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

$page_title = "Set Order Shipping";
$page_group = "order";


	


$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {
	
	$(".inline").click(function(){ 

		if(this.href.indexOf("view_desc") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'view-item-description.php?item_id='+f_id,
			  success: function(data) {
				$('#view_desc').html(data);
				//alert('Load was performed.');
			  }
			});			
			
		}
		
	})
	
	$("a.inline").fancybox();
	
	$("#view_desc").click(function(){ $.fancybox.close;  })

});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});

function select_img(img_id){
	document.getElementById(img_id).checked = true;	
}

function show_msg(msg){
	alert(msg);
}

</script>
</head>

<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');


	$ret = (isset($_GET["ret"]))? $_GET["ret"] : 'order-list'; 
	
	$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;
	$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
	$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
	$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
	$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
	
	$url_str = "?order_id=".$order_id;
	$url_str .= '&pagenum='.$pagenum;
	$url_str .= '&sortby='.$sortby;
	$url_str .= '&a_d='.$a_d;
	$url_str .= '&truncate='.$truncate;
?>

<div class="manage_page_container">

    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

    <div class="manage_main">

        <a href="<?php echo $ret.'.php'.$url_str; ?>" class='btn btn-small'>Back</a>
    
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
		
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT *
			FROM  ctg_order 
			WHERE order_id = '".$order_id."'";
	
		$result = $dbCustom->getResult($db,$sql);	
		if($result->num_rows > 0){
			$object = $result->fetch_object();
		
		
		
			
			$url_str = "order.php";
			$url_str .= "?order_id=".$order_id;
			$url_str .= "&pagenum=".$pagenum;
			$url_str .= "&sortby=".$sortby;
			$url_str .= "&a_d=".$a_d;
			$url_str .= "&truncate=".$truncate;
			
			?>	
		
		
			<form action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
		
			<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
		
		
			Carrier<br />
			<input type="text" name="actual_ship_carrier" value="<?php echo $object->actual_ship_carrier; ?>">
		   <br /><br />
		   
			Ship Method<br />
			<input type="text" name="actual_ship_method" value="<?php echo $object->actual_ship_method; ?>" > 
			<br /><br />
			
			Actual Cost<br />
			$<input type="text" name="actual_ship_cost" value="<?php echo $object->actual_ship_cost; ?>" >
			<br /><br />
			Tracking Number<br />
			<input type="text" name="tracking_num" value="<?php echo $object->tracking_num; ?>" >
			<br /><br />
	
		
			<input type="submit" name="send_ship_email" value="Update and Send Shipping Email" >
			
            <span style="width:10%">Or</span>
            
			<input type="submit" name="update_ship" value="Update Without Sending Email" >
			
			</form>
	
	
		</div>


		<p class="clear"></p>

<?php 
	}
		
require_once($real_root.'/manage/admin-includes/manage-footer.php');

?>    
  
</div>


</body>
</html>


