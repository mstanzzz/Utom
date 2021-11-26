<?php
if(!isset($_SESSION['specs_content_id'])) $_SESSION['specs_content_id'] = 0;
if($_SESSION['specs_content_id'] == 0){
	$_SESSION['specs_content_id'] = get_max_specs_content_id($dbCustom);
}

$url_str_content = '';
$url_str_content .= SITEROOT;
$url_str_content .= "manage/cms/pages/specs-content.php?specs_content_id=";
$url_str_content .= $_SESSION['specs_content_id'];


echo "specs_content_id: ".$_SESSION['specs_content_id'];
//exit;



?>


<ul class="nav nav-tabs">
<li <?php echo setActiveTab("specs.php"); ?>>
<a href="<?php echo SITEROOT;?>/manage/cms/pages/specs.php">Specs</a>
</li>
<li <?php echo setActiveTab("specs-category.php"); ?>>
<a href="<?php echo SITEROOT;?>/manage/cms/pages/specs-category.php">Specs Categories</a>
</li>
<li <?php echo setActiveTab("specs-content.php"); ?>>
<a href="<?php echo $url_str_content;?> ">Specs Page Intro</a>
</li>
</ul>


