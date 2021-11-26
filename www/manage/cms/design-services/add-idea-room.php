<?php
require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
//$module = new Module;
//module is instantiated in included script restrict_redirect.php  
$pages = new Pages;


$page_title = "";
$page_group = "page";

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
function regularSubmit() {
  document.form.submit(); 
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
		
		<h2>ROOM</h2>

		<form name="form" action="idea-folder.php" method="post">
        	<input type="hidden" name="add_idea_room" value="1">        	
			Name
			<input type="text" name="name" value="">					
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
	</div>
	<p class="clear"></p>


</body>
</html>
