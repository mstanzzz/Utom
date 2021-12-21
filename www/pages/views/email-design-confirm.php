

<?php

if($msg != ''){
	echo "<div id='msg' class='frm_success'>".$msg."</div>";
}

?>

<form action="<?php echo SITEROOT.'design-request.html'; ?>" method="post">

<input type="hidden" name="another" value="1">

<input type="submit" name="another" value="Create Another Design" style='width:450px;'>

</form>