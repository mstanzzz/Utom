<?php 

if(!isset($strip)) $strip = 0;


$block = '';
$block .= "<ul class='nav nav-tabs'>";
$block .= "<li ".setActiveTab("/catalog/categories/category-tree.php")."><a href='".SITEROOT."/manage/catalog/categories/category-tree.php?strip=".$strip."'>Category Tree</a></li>";
$block .= "<li ".setActiveTab("/catalog/categories/top-category.php")."><a href='".SITEROOT."/manage/catalog/categories/top-category.php?strip=".$strip."'>Top Categories</a></li>";
$block .= "<li ".setActiveTab("/catalog/categories/category.php")."><a href='".SITEROOT."/manage/catalog/categories/category.php?strip=".$strip."'>Sub-Categories</a></li>";
$block .= "</ul>";

echo $block;

?>

