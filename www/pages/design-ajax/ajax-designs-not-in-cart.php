<?php
require_once("../../includes/config.php"); 										
require_once("../../includes/class.design_cart.php");

$design_cart = new DesignCart;

$job_id = $_GET["job_id"];

//echo $job_id;

$block = '';
$block .= "<div id='design_nic'>";
$designs_not_in_cart = $design_cart->getDesignsNotInCart($job_id);
$block .= "<select id='design_not_in_cart' name='design_not_in_cart' style='font-size:12px; height:22px; width: 160px;'>";
foreach($designs_not_in_cart as $val){
	$block .= "<option value='".$val["design_id"]."'>".$val['name']." ".$val["design_id"]."</option>";
}
$block .= "</select>";
$block .= "</div>";
echo $block;


?>