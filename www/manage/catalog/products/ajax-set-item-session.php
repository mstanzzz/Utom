<?php
session_start();


$svg_id = (isset($_GET['svg_id']))? $_GET['svg_id'] : 0; 
if(!is_numeric($svg_id)) $svg_id = 0;
$_SESSION['temp_item_fields']['svg_id'] = $svg_id


?>


