<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<title>ClosetsToGo</title>
<meta name="description" content="Features Detail page">
<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
</head>
<body class="video-library-page features-detail-page" data-markup="body">
<?php
require_once($real_root."/includes/header.php"); 	
?>

<section class="home-mobile-buttons-block home-mobile-buttons-block__mimic covid-block">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
	<div class="col-12">
		<div class="home-mobile-buttons-block__wrapper">
			<!--this link href is set to the 'specifications.html' by js in 'feature.js' -> window.location.href = "specifications.html";
			the behaviour of the link depends on the screens
			if the user is in features-detail.html page on the first screen
			this link goes to 'specifications.html', but if user is in detail view of some feature,
			then this link is back button
			-->
			<a href="#" title="" class="back-link">
				<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
				<path d="M0 0h24v24H0V0z" fill="none"/>
				<path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
				</svg>
			</a>
			<h2>
				<span>
				<?php	
				echo $svg_code					
				?>	
				</span>
				<?php
				//Wardrobe Tubes
				echo $name; 			
				?>
			</h2>
		</div>
	</div>
</div>
</div>
</div>
</section>


<div class="category-block__filters category-block__filters__mobile">
<div class="container-fluid">
<div class="row align-items-center">

	<div class="col-6 col-sm-4">
		<div class="my-custom-select-selects-wrapper">
			<div data-select="choose-item-btn" class="my-customs-select__mobile my-customs-select__features-detail">
				<div class="my-customs-select__trigger">
					<span class="my-customs-select__trigger__main-label">Choose Item</span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6 col-sm-8">
		<div class="category-block__filters--right-wrapper">
			<div class="category-block__filters--right-content">
				<div class="select-custom_mobile" data-select="select-option__sort-by">
					<div class="select-custom__box hover__rotate-angle">
						<div class="home-consult-form__select__selected ">
							<div data-select="sort-by-btn" class="select-option select-custom__option selected default">
								<div class="select-custom__option__wrap">
									<p class="select-custom__option__text">Sort by</p>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<main class="main clearfix video-library features-detail-page">
<section class="breadcrumb-block pb-3 desktop-show">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
	<div class="col-12">
		<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
			<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Features</li>
			</ul>
		</div>
	</div>
</div>
</div>
</div>
</section>

<section class="specification-detial-header desktop-show">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
	
	<div class="col-12 col-lg-9">
		<div class="specification-detial-header__wrap">
			<span class="specification-detial-header__img">
				<?php 				
				echo $svg_code;
				?>				
			</span>
			<div class="specification-detial-header__content">
				<h2 class="specification-detial-header__heading">
				<?php 				
				echo $name;
				?>				
				</h2>
				<p class="specification-detial-header__text">
				<?php 				
				echo $description;
				?>
				description  description  description
				</p>
			</div>
		</div>
	</div>
	
	<div class="col-12 col-lg-3">
		<div class="specification-detial-header__link-wrap">
			<a href="<?php echo SITEROOT; ?>features.html" title="" class="specification-detial-header__link">
				back to categories
			</a>
		</div>
	</div>
</div>
</div>
</div>
</section>


<section class="category-block">
<div class="wrapper">
<div class="category-block__filters">
<div class="container-fluid">
	<div class="row">

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut ipsum elit. Cras id porta odio. Nunc tincidunt nec mauris in condimentum. Etiam tortor libero, ultricies a tincidunt malesuada, posuere at urna. Maecenas sed blandit mauris, ut efficitur ipsum. Vestibulum vel interdum leo. Etiam dictum ac massa rhoncus bibendum. In nec ipsum ipsum. Quisque tristique, libero pharetra luctus aliquet, augue lacus sollicitudin metus, nec imperdiet augue justo nec felis. Fusce eleifend augue in eros malesuada tempus. Nullam quis tincidunt purus, et condimentum tellus. Aenean ultricies accumsan erat, eget pulvinar arcu interdum vel. Integer mollis felis non eros tincidunt, id ultricies nisi bibendum. Nulla facilisi.

Phasellus et interdum purus, non tempor massa. Ut libero ligula, pretium ac mi sed, pulvinar laoreet mi. Pellentesque rhoncus quam eget purus dignissim, eget aliquam nunc aliquet. Nullam imperdiet facilisis tempus. Aliquam non elementum sem, vel fringilla leo. Donec pharetra magna ut nibh hendrerit, id consectetur mauris dictum. Integer hendrerit lobortis hendrerit. In accumsan dignissim nisi, eu maximus ex cursus sed. Phasellus consectetur rhoncus imperdiet. Vivamus eu orci volutpat, gravida orci eget, dignissim orci. Proin pretium mauris eget velit pulvinar pellentesque. Duis placerat dolor id odio aliquet, sed faucibus mauris volutpat. Phasellus lorem turpis, varius ut sem ut, porttitor rhoncus velit. Nam aliquet tellus a consectetur efficitur.

Donec id porta ante. Phasellus a consequat ante. Proin vehicula dui at tortor porttitor, id rhoncus felis sodales. Maecenas venenatis eu lacus id rutrum. Suspendisse convallis lorem a tortor congue congue. Quisque vulputate risus ut venenatis tincidunt. Nullam faucibus pretium lobortis. Ut ac fringilla nisl. Aliquam quam risus, volutpat non volutpat id, scelerisque vestibulum nisl. Ut non mauris ac lorem fringilla sagittis. Cras consequat nisl non massa condimentum mattis. Aenean quis ex quis ligula aliquet feugiat quis et dui.

Cras faucibus commodo tortor vitae efficitur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas semper non nisi suscipit ultricies. Vivamus lacus nisi, tempor ut ante at, sagittis tincidunt ante. Nam tristique magna vel fermentum porttitor. Donec eget felis convallis, rutrum mauris eu, dignissim nibh. Proin nec vehicula massa, ut euismod est. Donec mollis bibendum nibh, quis ultrices mi ultrices sed.

Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin vitae tristique est. Etiam scelerisque consequat metus, quis molestie erat pulvinar a. Nulla viverra sem diam, et posuere nibh iaculis hendrerit. Donec nec libero metus. Mauris vitae orci porta, consectetur elit vel, vulputate felis. Duis pretium libero ut lacus porta, eu volutpat orci bibendum. Praesent vel efficitur nisi. Fusce rhoncus interdum sodales. Duis ullamcorper, quam nec pellentesque aliquam, libero diam venenatis nisl, id porta turpis ante ac nisi. In facilisis volutpat semper. Curabitur non tristique diam. Donec scelerisque ligula velit, id tincidunt velit feugiat ut.	
	
	</div>
</div>
</div>
</div>
</section>
	




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


<!-- Modal mobile team block -->
<div class="modal about-us-modal fade" id="mobile-team-gallery" tabindex="-1" role="dialog" aria-labelledby="mobile-team-gallery-title" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mobile-team-gallery-title">&nbsp;</h5>
				<button type="button" class="close about-us-modal-close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pl-0 pr-0"> </div>
		</div>
	</div>
</div>


<!-- Custom fixed element for more inforamtion about the employee -->
<div class="custom-fixed-modal" id="custom-fixed-modal">
	<div class="custom-fixed-modal__wrapper">
		<div class="custom-fixed-modal__header">
			<button class="custom-fixed-modal__close-btn js-hide-custom-fixed-modal"
			data-custom-modal-id="#custom-fixed-modal">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
			<g transform="translate(0 -0.001)">
			<g transform="translate(0 0.001)">
			<path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z"
			transform="translate(0 -0.001)"></path>
			</g>
			</g>
			</svg>
			</button>
		</div>
		<div class="custom-fixed-modal__employee">
			<img src="<?php echo SITEROOT; ?>images/vl1.jpg" alt="" class="mb-3 img-fluid">
			<a href="mailto:" title="" class="text-center">
			<p class="four-elements-block__wrapper--name">Product description</p>
			<p class="four-elements-block__wrapper--position">Closet Installation director</p>
			<p class="four-elements-block__wrapper--email"><span>@</span> employee@employee.employee</p>
			</a>
		</div>
		<div class="custom-fixed-modal__content">
			<div class="custom-fixed-modal__text">
				<p class="custom-fixed-modal__text--heading">In-home design consultation</p>
				<p class="custom-fixed-modal__text--text">
				Lorem ipsum dolor sit amet, consetetur sadipscing
				elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed
				diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd
				gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
				amet, consetetur sadipscing elitr, sed diam nonumy.
				</p>
			</div>
		</div>
		<div class="custom-fixed-modal__text">
			<p class="custom-fixed-modal__text--heading">In-home design consultation</p>
			<p class="custom-fixed-modal__text--text">
			Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
			sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
			voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
			sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
			sadipscing elitr, sed diam nonumy.
			</p>
		</div>
	</div>
</div>


<script src="<?php echo SITEROOT; ?>app.js"></script>
</body>
</html>
