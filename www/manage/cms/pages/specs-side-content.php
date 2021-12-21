<?php
require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Specs Intro &amp; Side Content";
$page_group = "specs";
$page = "specs";

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$ts = time();

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>

function ajax_set_page_session(){
	
	var q_str = "?page=discount"+get_query_str();

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax_set_page_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});
}


function get_query_str(){
	
	var query_str = '';
	query_str += "&content="+tinyMCE.get('content').getContent();
	query_str += "&sidebar_content="+tinyMCE.get('sidebar_content').getContent();
	query_str += "&page_heading="+$("#page_heading").val().replace('&', '%26');

	return query_str;
}


function setRegularSubmit() {
  document.form.action = 'specs.php';
  document.form.target = '_self'; 
}	

</script>
</head>

<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($real_root."/manage/admin-includes/specs-section-tabs.php");
		?>

		<form name="form" action="specs.php" method="post" enctype="multipart/form-data">
        	
		</form>
	</div>
	<p class="clear"></p>
</div>
</body>
</html>
