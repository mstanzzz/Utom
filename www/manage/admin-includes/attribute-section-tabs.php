<?php 

if(!isset($strip)) $strip = 0;

$block = '';
$block .= "<ul class='nav nav-tabs'>";
$block .= "<li ".setActiveTab("/attribute.php")."><a href='".SITEROOT."/manage/catalog/attributes/set-custom-attributes.php?strip=".$strip."'>Custom Attributes</a></li>";
$block .= "<li ".setActiveTab("/brand.php")."><a href='".SITEROOT."/manage/catalog/attributes/brand.php?strip=".$strip."'>Brands</a></li>";
$block .= "<li ".setActiveTab("/vend-man.php")."><a href='".SITEROOT."/manage/catalog/attributes/vend-man.php?strip=".$strip."'>Vendors</a></li>";
$block .= "<li ".setActiveTab("/style.php")."><a href='".SITEROOT."/manage/catalog/attributes/style.php?strip=".$strip."'>Style</a></li>";
$block .= "<li ".setActiveTab("/lead-time.php")."><a href='".SITEROOT."/manage/catalog/attributes/lead-time.php?strip=".$strip."'>Lead Times</a></li>";
$block .= "<li ".setActiveTab("/skill-level.php")."><a href='".SITEROOT."/manage/catalog/attributes/skill-level.php?strip=".$strip."'>Skill Levels</a></li>";
$block .= "<li ".setActiveTab("/type.php")."><a href='".SITEROOT."/manage/catalog/attributes/type.php?strip=".$strip."'>type</a></li>";
$block .= "</ul>";

echo $block;

?>
	