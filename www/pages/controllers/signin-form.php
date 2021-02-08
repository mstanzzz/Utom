<?php

$failed = (isset($_GET["failed"]))? 1 : 0; 

if($failed){
	echo "<span style='color:#cf0623; padding-left:72px'>The supplied email and password combination was not found</span>";
}

?>
