<?php 

$strip = (isset($strip)) ? $strip : 0;
$qs_strip = (isset($qs_strip)) ? $qs_strip : '';

?>


		<ul class="nav nav-tabs">
			<li <?php echo setActiveTab("navbar"); ?>><a href="<?php echo $ste_root;?>/manage/cms/navigation/navbar.php?<?php echo $qs_strip; ?>">Main Navigation</a></li>
			<li <?php echo setActiveTab("header"); ?>><a href="<?php echo $ste_root;?>/manage/cms/navigation/header-support-menu.php?<?php echo $qs_strip; ?>">Header Support Menu</a></li>
			<li <?php echo setActiveTab("footer"); ?>><a href="<?php echo $ste_root;?>/manage/cms/navigation/footer-nav.php?<?php echo $qs_strip; ?>">Footer Navigation</a></li>
			<li <?php echo setActiveTab("side"); ?>><a href="<?php echo $ste_root;?>/manage/cms/navigation/side-nav.php?<?php echo $qs_strip; ?>">Side Navigation</a></li>

		</ul>