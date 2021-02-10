<?php 
require_once('../includes/config.php'); 

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<title>Plupload - Queue widget example</title>


<link href="<?php echo $ste_root; ?>/css/base.min.css" rel="stylesheet">

<!--
<link href="<?php echo $ste_root; ?>/css/base.css" rel="stylesheet">
-->

<link href="<?php echo $ste_root; ?>/css/responsive.min.css" rel="stylesheet">
<!--
<link href="<?php //echo $ste_root; ?>/css/responsive.css" rel="stylesheet">
-->

<link href="<?php echo $ste_root; ?>/css/mce.css" rel="stylesheet"/>
<link href="<?php echo $ste_root; ?>/js/fancybox2/source/jquery.fancybox.css?v=2.1.4" rel="stylesheet">

<!--
<link href="<?php //echo $ste_root; ?>/css/misc.css" rel="stylesheet">
-->

<!--
<link type="text/css" rel="stylesheet" media="all" href="<?php //echo $ste_root; ?>/css/mmenu.min.css" />
-->

<link type="text/css" rel="stylesheet" media="all" href="<?php echo $ste_root; ?>/css/mmenu.min.css" />
<!--
<link type="text/css" rel="stylesheet" media="all" href="<?php //echo $ste_root; ?>/css/mmenu.css" />
-->

<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="<?php echo $ste_root; ?>/plupload-2.1.8/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

<!-- production -->
<script type="text/javascript" src="<?php echo $ste_root; ?>/plupload-2.1.8/js/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo $ste_root; ?>/plupload-2.1.8/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<!-- debug 
<script type="text/javascript" src="../../js/moxie.js"></script>
<script type="text/javascript" src="../../js/plupload.dev.js"></script>
<script type="text/javascript" src="../../js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
-->


</head>
<body style="font: 13px Verdana; background: #eee; color: #333">

<form method="post" action="dump.php">	
	<div id="uploader">
		<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
	</div>
	<input type="submit" value="Send" />
</form>

<script type="text/javascript">
$(function() {
	
	// Setup html5 version
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,flash,silverlight,html4',
		url : '<?php echo $ste_root; ?>/plupload-2.1.8/otg/upload.php',
		chunk_size: '1mb',
		rename : true,
		dragdrop: true,
		
		filters : {
			// Maximum file size
			max_file_size : '10mb',
			// Specify what files to browse for
			mime_types: [
				{title : "Image files", extensions : "jpg,gif,png"},
				{title : "Zip files", extensions : "zip"}
			]
		},

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90},

		flash_swf_url : '<?php echo $ste_root; ?>/plupload-2.1.8/js/Moxie.swf',
		silverlight_xap_url : '<?php echo $ste_root; ?>/plupload-2.1.8/js/Moxie.xap'
	});

});
</script>

</body>
</html>
