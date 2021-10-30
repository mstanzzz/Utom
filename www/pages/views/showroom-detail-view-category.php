<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="showroom-detail-view">
<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
</head>
<body class="clearfix">
<?php
require_once($real_root."/includes/header.php"); 
?>
<section class="home-mobile-buttons-block showroom-page">
<div class="accordion accordion-organizer-landing-page showroom-details" id="accordion-organizer-landing">
<div class="card">
<div class="d-flex align-items-center">
	<a href="showroom-detail-view-categories.html">
		<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path fill="#ffffff" d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>
	</a>
	<div class="card-header" id="headingOne">
		<h2 class="mb-0">
			<button class="accordion-organizer-button js-filter-fix-body" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			Filters
			</button>
		</h2>
	</div>
</div>
<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-organizer-landing">
	<div class="card-body">
		<div class="organizer-filters-block__wrapper js-filters-box">
		
			<div class="my-custom-select-wrapper">
				<div class="my-custom-select">
					<div class="my-custom-select__trigger"><span>Style</span>
						<div class="arrow"></div>
					</div>
					<div class="my-custom-options">
						<span class="my-custom-option js-defaulf-state selected" data-value="Style">Style</span>
						<span class="my-custom-option" data-value="All">All</span>
						<span class="my-custom-option" data-value="Traditional">Traditional</span>
						<span class="my-custom-option" data-value="Contemporary">Contemporary</span>
						<span class="my-custom-option" data-value="Modern">Modern</span>
						<span class="my-custom-option" data-value="Minimalist">Minimalist</span>
						<span class="my-custom-option" data-value="Industrial">Industrial</span>
						<span class="my-custom-option" data-value="Shabby Chic">Shabby Chic</span>
						<span class="my-custom-option" data-value="Rustic">Rustic</span>
						<span class="my-custom-option" data-value="Luxurious">Luxurious</span>
					</div>
				</div>
			</div>
			<div class="my-custom-select-wrapper">
				<div class="my-custom-select">
					<div class="my-custom-select__trigger">
						<span>Room</span>
						<div class="arrow"></div>
					</div>
					<div class="my-custom-options">
						<span class="my-custom-option js-defaulf-state selected" data-value="Room">Room</span>
						<span class="my-custom-option" data-value="All">All</span>
						<span class="my-custom-option" data-value="Walk in">Walk in</span>
						<span class="my-custom-option" data-value="Reach in">Reach in</span>
						<span class="my-custom-option" data-value="Hers">Hers</span>
						<span class="my-custom-option" data-value="His">His</span>
						<span class="my-custom-option" data-value="Dressing">Dressing</span>
						<span class="my-custom-option" data-value="Vanity">Vanity</span>
						<span class="my-custom-option" data-value="Island/peninsula">Island/peninsula</span>
					</div>
				</div>
			</div>
			<div class="my-custom-select-wrapper">
				<div class="my-custom-select">
				<div class="my-custom-select__trigger">
					<span>Colors</span>
					<div class="arrow"></div>
				</div>
				<div class="my-custom-options">
					<span class="my-custom-option js-defaulf-state selected" data-value="Colors">Colors</span>
					<span class="my-custom-option" data-value="All">All</span>
					<span class="my-custom-option" data-value="White">White</span>
					<span class="my-custom-option" data-value="Night fall">Night fall</span>
					<span class="my-custom-option" data-value="Chocolate pear">Chocolate pear</span>
					<span class="my-custom-option" data-value="Antique white">Antique white</span>
					<span class="my-custom-option" data-value="Almond">Almond</span>
					<span class="my-custom-option" data-value="Custom grey">Custom grey</span>
					<span class="my-custom-option" data-value="Maple">Maple</span>
					<span class="my-custom-option" data-value="Mahogany">Mahogany</span>
				</div>
			</div>
		</div>
		<form class="w-100 text-center">
		<div class="form-group accordion-organizer-form-group">
		<label for="enter-tag" class="sr-only">Enter tag</label>
		<input type="text" name="enter-tag" class="form-control accordion-organizer-form-input" placeholder="Enter tag">
		</div>
		<div class="d-flex justify-content-between">
		<button type="button" class="btn btn-secondary accordion-organizer-submit">Apply filters</button>
		<button type="button" class="btn btn-secondary accordion-organizer-submit js-clear-filter">Clear filters</button>
		</div>
		</form>
	</div>
</div>
</div>
</div>
</div>
</section>




<section class="first-fixed-block covid-block showroom-page clearfix">
	<div class="mobile-show">
		<div class="mobile-heading"><p>Custom Closet Organizers for Wardrobes</p></div>
	</div>

	
	<figure class="col-12 first-fixed-block__img-group" style="background-image: url('<?php echo SITEROOT; ?>images/organizer-landing-pahe-header.png');">
	
	
	
	<figcaption class="first-fixed-block__img-group--text-block">
		<div class="wrapper text-center">
			<h1 class="first-fixed-block__img-group--heading text-center">
			<?php  echo $name; ?>
			</h1>
			<h3 class="first-fixed-block__img-group--subheading text-center">
			Lorem Ipsum Nedir ve Ne Anlama Gelir Nedir ve Ne Anlama Gelir
			</h3>

<!--			
			<a href="#" title="" class="link-button">
			Explore Now
			

<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
</svg>

			</a>
-->			
		</div>
	</figcaption>
	</figure>
</section>


<main class="main hero-block organizer-landing-page clearfix">

<div style="padding:15px;">
<?php

echo $p_1_text;

?>

</div>


<!--
<section class="breadcrumb-block showroom-detail-page desktop-show">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
	<div class="col-12">
		<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
			<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>" title="">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>/showroom-detail-view-categories.html">
			Rooms
		
			</a></li>
			<li class="breadcrumb-item active" aria-current="page" title="">
			<?php
			//Master closet Organizers
			echo $name;
			?>
			
			</li>
			</ul>
		</div>
	</div>
</div>
</div>
</div>
</section>

-->




<section class="organizer-filters-block desktop-show">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="organizer-filters-block__wrapper">


<?php
//echo $filters_block;
?>


<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Style</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Style">Style</span>
<span class="my-custom-option" data-value="All">All</span>
<span class="my-custom-option" data-value="Traditional">Traditional</span>
<span class="my-custom-option" data-value="Contemporary">Contemporary</span>
<span class="my-custom-option" data-value="Modern">Modern</span>
<span class="my-custom-option" data-value="Minimalist">Minimalist</span>
<span class="my-custom-option" data-value="Industrial">Industrial</span>
<span class="my-custom-option" data-value="Shabby Chic">Shabby Chic</span>
<span class="my-custom-option" data-value="Rustic">Rustic</span>
<span class="my-custom-option" data-value="Luxurious">Luxurious</span>
</div>
</div>
</div>


<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Room</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Room">Room</span>
<span class="my-custom-option" data-value="All">All</span>
<span class="my-custom-option" data-value="Walk in">Walk in</span>
<span class="my-custom-option" data-value="Reach in">Reach in</span>
<span class="my-custom-option" data-value="Hers">Hers</span>
<span class="my-custom-option" data-value="His">His</span>
<span class="my-custom-option" data-value="Dressing">Dressing</span>
<span class="my-custom-option" data-value="Vanity">Vanity</span>
<span class="my-custom-option" data-value="Island/peninsula">Island/peninsula</span>
</div>
</div>
</div>


<div class="my-custom-select-wrapper">
<div class="my-custom-select">
<div class="my-custom-select__trigger"><span>Colors</span>
<div class="arrow"></div>
</div>
<div class="my-custom-options">
<span class="my-custom-option selected" data-value="Colors">Colors</span>
<span class="my-custom-option" data-value="All">All</span>
<span class="my-custom-option" data-value="White">White</span>
<span class="my-custom-option" data-value="Night fall">Night fall</span>
<span class="my-custom-option" data-value="Chocolate pear">Chocolate pear</span>
<span class="my-custom-option" data-value="Antique white">Antique white</span>
<span class="my-custom-option" data-value="Almond">Almond</span>
<span class="my-custom-option" data-value="Custom grey">Custom grey</span>
<span class="my-custom-option" data-value="Maple">Maple</span>
<span class="my-custom-option" data-value="Mahogany">Mahogany</span>
</div>
</div>
</div>



<form class="form-inline align-items-start">
<div class="form-group">
<label for="enter-tag" class="sr-only">Enter tag</label>
<input type="text" name="enter-tag" class="form-control" placeholder="Enter tag">
</div>
<button type="submit" class="btn btn-secondary btn-enter-tag">Go</button>
</form>
</div>
</div>
</div>
</div>
</div>
</section>



<section class="showroom-block organizer-landing-page">
<div class="wrapper">
<div class="container-fluid">

<div class="row">
	<div class="col-12 showroom-block__heading">
		<h2>		
		<?php 
		
		echo $name; 
		?>
		</h2>
	</div>
</div>




<div class="row showroom-block__wrapper">
	<?php
	echo $item_images;
	?>
	<div class="row">
		<div class="col-12 text-center">
		<a href="#" title="" class="link-button mt-3">
		Load more
		<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
		<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
		</svg>
		</a>
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
<a href="#" title="" class="scrollToTop js-to-top">
<img src="<?php echo SITEROOT; ?>images/arrows.svg" alt="">
</a>
</div>

<div class="mobile-show">
<div class="mobile-footer-buttons">
<a href="#" title="" class="mobile-footer-buttons__first">you design</a>
<a href="#" title="" class="mobile-footer-buttons__second"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="img-fluid"></a>
<a href="#" title="" class="mobile-footer-buttons__third">we design</a>
</div>
</div>

<script src="./app.js"></script></body>
<?php
require_once($real_root.'/includes/footer.php');
?>
