<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="Accessory Category page">
<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
</head>
<body class="product-detail specification-page">

<?php
require_once($real_root."/includes/header.php"); 
$hero = SITEROOT.'/images/accessory-category-header.jpg';
	
?>

		<section class="home-mobile-buttons-block covid-block">
			<div class="wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="home-mobile-buttons-block__wrapper">
<!--								<a href="#" title="" class="back-link">-->
<!--									<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>-->
<!--								</a>-->
								<h2><?php echo $cat_name; ?></h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="first-fixed-block covid-block clearfix">
			<figure class="first-fixed-block__img-group" style="background-image: url('<?php echo $hero; ?>');">
				<figcaption class="first-fixed-block__img-group--text-block">
					<p class="first-fixed-block__img-group--text text-center">
					All of our custom closet organizers are made with quality thermal-fused melamine panels from Roseburg Forest Products Panolam, 
					Flakeboard, and other high quality American companies.
					</p>
				</figcaption>
			</figure>
		</section>

		<main class="main hero-block clearfix">

			<section class="breadcrumb-block pb-3 desktop-show">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
									<ul class="breadcrumb">
										<li class="breadcrumb-item"><a href="#">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Accessory category</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

<section class="simple-block">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
	<div class="col-12">
		<div class="simple-block__border no-border p-0">
			<div class="row">
				<div class="col-12">
					<div class="simple-block__heading">
						<h2 class="simple-block__heading--heading text-center">Accessory category</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="simple-block__text">
						<p class="text-center">
							Each panel is thermally-fused to ¾” thick industrial grade particle board for great strength and durability. Thermal-fusion is when two products are placed under intense heat and pressure to permanently bond them together.
						</p>
					</div>
				</div>
			</div>
									
									
			<div class="row">
				
				

<?php echo $icons_block; ?>

				
				
				
				
			</div>
		</div>
	</div>
</div>
</div>
</div>
</section>

</main>



		<div class="scrollToTopBlock">
			<div class="people-working">
				<img src="<?php echo SITEROOT; ?>images/people-working-call-center_@2x.png" alt="" class="people-working__image">

				<div class="people-working__wrapper">
					<div class="people-working__content">
						<p class="people-working__text">Hi! I'm the Virtual assistant, and I'm here to help you.</p>
					</div>
				</div>
			</div>

			<a href="#" class="scrollToTop js-to-top">
				<img src="<?php echo SITEROOT; ?>images/arrows.svg" alt="">
			</a>
		</div>

		<div class="mobile-show">
			<div class="mobile-footer-buttons">
				<a href="#" class="mobile-footer-buttons__first">you design</a>
				<a href="#" class="mobile-footer-buttons__second"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="img-fluid"></a>
				<a href="#" class="mobile-footer-buttons__third">we design</a>
			</div>
		</div>

<?php
require_once($real_root.'/includes/footer.php');
?>

<script src="<?php echo SITEROOT; ?>app.js"></script></body>
</html>
		
		