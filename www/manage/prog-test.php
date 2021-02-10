<?php

	$p_val = 60;

?>


<!DOCTYPE html>
<html>
<head>
  
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <script>
  
  
  $(document).ready(function() {
	  
    $("#progressbar").progressbar({ value: <?php echo $p_val; ?> });
	
  });
  </script>


</head>
<body style="font-size:62.5%;">
<div style="width:300px;">
  
<div id="progressbar"></div>


</div>

</body>
</html>
