<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$module = new Module;

$page_title = "Add SVG";
$page_group = "svg";

$msg = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>

<div style="margin:6%;">

<a class="btn btn-large" href="svg.php">Cancel</a>

<h2>ADD SVG</h2>

<form name="form" action="svg.php" method="post">

<input type="hidden" name="add_svg" value="1">

  
<label>Name</label>
<br />
<input style="width:60%" type="text" name="name" value="">
<label>SVG Code</label>
<br />
<textarea style="width:100%; height:400px;"  
name="svg_code" ></textarea>

<input type="submit" name="submit" value="Save">

</form>

</div>

</body>
</html>



