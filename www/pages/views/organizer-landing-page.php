<?php	

if(!isset($hero_file_name)) $hero_file_name = '';

if($hero_file_name == ''){
	
	$hero = '../../images/organizer-landing-pahe-header.png';
	
}else{

	$hero = '';

	$hero .= "../../saascustuploads/";
	$hero .= $_SESSION['profile_account_id'];
	$hero .= "/cms/";
	$hero .= $hero_file_name;
	//$hero = preg_replace('/(\/+)/','/',$im);

}

//echo "hero ".$hero;
//exit;

//$hero = '../../images/organizer-landing-pahe-header.png';


require_once($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); 	
?>	



<section class="home-mobile-buttons-block covid-block">

	<div class="accordion accordion-organizer-landing-page" id="accordion-organizer-landing">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="accordion-organizer-button js-filter-fix-body" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Search
						<svg xmlns="http://www.w3.org/2000/svg" width="22.113" height="22.905" viewBox="0 0 22.113 22.905"><path id="search_1_" data-name="search(1)" d="M22.761,20.862l-5.451-5.67a9.244,9.244,0,1,0-7.078,3.3,9.149,9.149,0,0,0,5.3-1.673l5.493,5.713a1.206,1.206,0,1,0,1.739-1.672ZM10.232,2.412A6.835,6.835,0,1,1,3.4,9.248,6.843,6.843,0,0,1,10.232,2.412Z" transform="translate(-0.984)" fill="#384765"/></svg>
					</button>
				</h2>
			</div>
			
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-organizer-landing">
				<div class="card-body">
					<div class="organizer-filters-block__wrapper">
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
						<form class="w-100 text-center">
							<div class="form-group accordion-organizer-form-group">
								<label for="enter-tag" class="sr-only">Enter tag</label>
								<input type="text" name="enter-tag" class="form-control accordion-organizer-form-input" placeholder="Enter tag">
							</div>
							<button type="submit" class="btn btn-secondary accordion-organizer-submit">Search</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="first-fixed-block covid-block organizer-landing-page clearfix">

<?php 
//../../images/organizer-landing-pahe-header.png
//echo $hero;
?>
<figure class="col-12 first-fixed-block__img-group" 
style="background-image: url('<?php echo $hero; ?>');">

		<figcaption class="first-fixed-block__img-group--text-block">

			<div class="wrapper text-center">

<h1 class="first-fixed-block__img-group--heading text-center">Gallery</h1>
<h3 class="first-fixed-block__img-group--subheading text-center">Get ideas. Be inspired.</h3>

			<!-- <p class="first-fixed-block__img-group--text dark-color">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
				
				<a href="#" title="" class="link-button">
					Explore now
					
					<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
					</svg>
					
				</a>
				
			</div>
		</figcaption>
	</figure>



</section>

	
<main class="main hero-block organizer-landing-page clearfix">
	<section class="organizer-filters-block desktop-show">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="organizer-filters-block__wrapper">			
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
						<h2>Master Closet Organizers</h2>
					</div>
				</div>
				<div class="row showroom-block__wrapper">
					
					<?php	
					echo $cat_block;
					?>
							
				</div>
			</div>
		</div>
	</section>
			
	<section class="five-elements-block organizer-landing-page">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row five-elements-block__heading">
					<div class="col-12">
						<h2>Closet Video Solutions</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-12 five-elements-block__content">
						<div class="five-elements-block__wrapper video-second-caro">
							
							<div class="five-elements-block__wrapper--item">
								<!-- <a href="#" title=""> -->
								<figure>
									<div class="five-elements-block__wrapper--image">
										<div class="embed-responsive embed-responsive-4by3">
											<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
										</div>
									</div>
									<figcaption>
										<p>Closet Solutions:</p>
										<p>DIY Online Designs</p>
									</figcaption>
								</figure>
								<!-- </a> -->
							</div>
							
							<div class="five-elements-block__wrapper--item">
								<!-- <a href="#" title=""> -->
								<figure>
									<div class="five-elements-block__wrapper--image">
										<div class="embed-responsive embed-responsive-4by3">
											<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
										</div>
									</div>
									<figcaption>
										<p>Custom Closets:</p>
										<p>Order Online Today</p>
									</figcaption>
								</figure>
								<!-- </a> -->
							</div>
							
							<div class="five-elements-block__wrapper--item">
								<!-- <a href="#"> -->
								<figure>
									<div class="five-elements-block__wrapper--image">
										<div class="embed-responsive embed-responsive-4by3">
											<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
										</div>
									</div>
									<figcaption>
										<p>Closet Design:</p>
										<p>Easy Online Design Tool</p>
									</figcaption>
								</figure>
								<!-- </a> -->
							</div>
									<div class="five-elements-block__wrapper--item">
										<!-- <a href="#" title=""> -->
											<figure>
												<div class="five-elements-block__wrapper--image">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												<figcaption>
													<p>Closet Systems:</p>
													<p>Designed By You, Crafted By Us</p>
												</figcaption>
											</figure>
										<!-- </a> -->
									</div>
									<div class="five-elements-block__wrapper--item">
										<!-- <a href="#" title=""> -->
											<figure>
												<div class="five-elements-block__wrapper--image">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												<figcaption>
													<p>Closet Organizers:</p>
													<p>Custom-designed by you, quality-b...</p>
												</figcaption>
											</figure>
										<!-- </a> -->
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12 desktop-show text-center">
								<a href="#" class="link-button mt-4">
									Explore More
									<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
										<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>


		<section class="catalog-block organizer-landing-page">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 catalog-block__heading">
								<h2>Other Room Categories</h2>
							</div>
						</div>
						<div class="row">
							<figure class="col-12 col-lg-6 col-xl-4">
								<a href="#" title="" class="catalog-block__content">
									<div class="catalog-block__content--image">
<img src="../../images/shopping-cart-catalog-1.png" alt="">
									</div>
									<figcaption>
										<p>Closet Solutions: DIY Online Designs</p>
									</figcaption>
								</a>
							</figure>
							<figure class="col-12 col-lg-6 col-xl-4">
								<a href="#" title="" class="catalog-block__content">
									<div class="catalog-block__content--image">
										<img src="../../images/shopping-cart-catalog-2.png" alt="">
									</div>
									<figcaption>
										<p>Closet Solutions: DIY Online Designs</p>
									</figcaption>
								</a>
							</figure>
							<figure class="col-12 col-lg-6 col-xl-4">
								<a href="#" title="" class="catalog-block__content">
									<div class="catalog-block__content--image">
										<img src="../../images/shopping-cart-catalog-3.png" alt="">
									</div>
									<figcaption>
										<p>Closet Solutions: DIY Online Designs</p>
									</figcaption>
								</a>
							</figure>
						</div>
					</div>
				</div>
			</section>
		</main>

<div class="scrollToTopBlock">
	<div class="people-working">
	<img src="../../images/people-working-call-center_@2x.png" alt="" class="people-working__image">
	<div class="people-working__wrapper">
		<div class="people-working__content">
			<p class="people-working__text">Hi! I'm the Virtual assistant, and I'm here to help you.</p>
		</div>
	</div>
</div>
	<a href="#" title="" class="scrollToTop js-to-top">
		<img src="../../images/arrows.svg" alt="">
	</a>
</div>

<div class="mobile-show">
	<div class="mobile-footer-buttons">
		<a href="#" title="" class="mobile-footer-buttons__first">you design</a>
		<a href="#" title="" class="mobile-footer-buttons__second"><img src="../../images/icon-save.svg" alt="" class="img-fluid"></a>
		<a href="#" title="" class="mobile-footer-buttons__third">we design</a>
	</div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
?>
	
