<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
		<title>ClosetsToGo</title>
	<meta name="description" content="solution detail view"><link href="./app.css" rel="stylesheet"></head>
	<body>

<?php	
if(isset($file_name)){
	$hero = "<?php echo SITEROOT; ?>saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$file_name;
}else{
	$hero = "<?php echo SITEROOT; ?>images/solution-detail-view-header.png";
}
if(!isset($item_id)) $item_id = 0;
if(!isset($name)) $name = '';
if(!isset($description)) $description = '';
require_once($real_root."/includes/header.php"); 	
?>	

<section class="first-fixed-block covid-block clearfix">
<figure class="first-fixed-block__img-group" 
style="background-image: url('<?php echo $hero; ?>');">
	<figcaption class="first-fixed-block__img-group--text-block">
		<div class="wrapper">
			<h1 class="first-fixed-block__img-group--heading">
			<?php echo $name; ?>
			</h1>
			<!-- <h3 class="first-fixed-block__img-group--subheading">Lorem ipsum dolor sit amet, consectetur.</h3> -->
			<p class="first-fixed-block__img-group--text">
			<?php echo $description; ?>
			</p>
		</div>
	</figcaption>
</figure>
</section>

<main class="main clearfix">
<section class="breadcrumb-block">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="breadcrumb-block__wrapp.r" aria-label="breadcrumb">
					<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Custom closet organizers for wardrobes</a></li>
					<li class="breadcrumb-item active" aria-current="page">His and her walk in closet organizers</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="simple-block no-border">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="simple-block__border">
						<div class="row">
							<div class="col-12">
								<div class="simple-block__heading">
								<h2 class="simple-block__heading--heading">
			<?php echo $name; ?>					
								</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="simple-block__text">
									<p class="text-center">
			<?php echo $description; ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

			<section class="solution-block-carousel">
				<div class="wrapper">
					<div class="solution-block-carousel__wrapp.r">
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
						<div class="solution-block-carousel__wrapp.r--image-block">
							<a href="images/solution-carousel-img-1.png" data-lightbox="roadtrip" data-title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/solution-carousel-img-1.png" alt="" class="img-fluid">
							</a>
							<div class="image-share-buttons">
								<button class="save-for-idea" data-img-path="images/solution-carousel-img-1.png">
									<!-- <img src="<?php echo SITEROOT; ?>images/icon-save-white.svg" alt="" class="img-fluid"> -->
								</button>
								<button class="share-img" data-img-path="images/solution-carousel-img-1.png">
									<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
										<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
										<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
										<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
										<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
									</svg>									
								</button>
							</div>
						</div>
					</div>
				</div>
			</section>

<section class="two-elements-block">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-xl-7">
					<div class="two-elements-block__wrapp.r">
						<h2 class="two-elements-block__wrapp.r--heading">Products</h2>
						<p class="two-elements-block__wrapp.r--text small-text js-show-text">
						Struggling to evenly divide a shared walk in closet? By designing your his and
						hers walk in closet organizers with our online
						closet design tool, you and your partner can create and purchase a closet that
						is tailored to your specific needs. This system
						features side by side drawer units in the center to separate the closet into his
						and her sides.
						<br/><br/>

						Both anchored by double hanging, shelving and shoes shelves. Finally, the crown
						jewel in this closet; the center island.
						This island displays an opulent granite countertop and houses drawers for
						additional storage. Restore the balance in your home
						with the his and hers walk in closet organizers from Closets To Go.
						
						</p>
						<div class="two-elements-block__wrapp.r--link-block">
						<button data-readAll="Discover all" data-readLess="Discover less" class="link-button js-btn-view-all-text">
						<span>Discover all</span>
						<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
						</svg>
						</button>
						<a href="#" class="link-button you-design">
						Start your design
						<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)"
						d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
						transform="translate(0.001 -4.676)"/>
						</svg>
						</a>

						<a href="#" class="link-button we-design">
						Let us design
						<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)"
						d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
						transform="translate(0.001 -4.676)"/>
						</svg>
						</a>
						</div>
						</div>
						</div>
						<div class="col-12 col-xl-5">
						<div class="two-elements-block__wrapp.r">
						<div class="two-elements-block__wrapp.r--content">
						<div class="two-elements-block__wrapp.r--video">
						<h2 class="heading">Watch Our Installation Video</h2>
						<div class="video-wrapp.r">
						<img src="<?php echo SITEROOT; ?>images/video.png" alt="">
						</div>
						<p class="flex-p">
						<img src="<?php echo SITEROOT; ?>images/passage-of-time.svg" alt="">
						Just 4-6 hours to install a 10 x 10 closet.
						</p>
						<p class="flex-p underlined-text">
						<img src="<?php echo SITEROOT; ?>images/security-yellow.svg" alt="">
						100% Perfect Fit Guarantee
						</p>
						</div>
						</div>
						</div>
						</div>
						<div class="col-12">
						<div class="two-elements-block__wrapp.r--stars">
						<h2 class="heading">Read Our Reviews</h2>
						<div class="stars-wrapp.r">
						<div class="block-stars__wrapp.r">
						<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapp.r--image">
						<div class="block-stars__wrapp.r--text">
						<div class="stars-container">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						</div>
						<p class="first-text">Aubree W. Charlotte, North Carolina</p>
						<p>Just had a successful installation!</p>
						</div>
						</div>
						<div class="block-stars__wrapp.r">
						<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapp.r--image">
						<div class="block-stars__wrapp.r--text">
						<div class="stars-container">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						</div>
						<p class="first-text">Aubree W. Charlotte, North Carolina</p>
						<p>Just had a successful installation!</p>
						</div>
						</div>
						<div class="block-stars__wrapp.r">
						<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapp.r--image">
						<div class="block-stars__wrapp.r--text">
						<div class="stars-container">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						<img src="<?php echo SITEROOT; ?>images/star.svg" alt="">
						</div>
						<p class="first-text">Aubree W. Charlotte, North Carolina</p>
						<p>Just had a successful installation!</p>
						</div>
						</div>
						</div>
						<a href="#" class="link-button">Discover all
							<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
							<path id="left-arrow_3_" data-name="left-arrow(3)"
							d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
							transform="translate(0.001 -4.676)"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

			<section class="five-elements-block">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row five-elements-block__heading">
							<div class="col-12">
								<h2>Walk in Closet Organizers inspiration</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-12 five-elements-block__content">
								<div class="five-elements-block__wrapp.r">
									<div class="five-elements-block__wrapp.r--item">
									<a href="#">
									<figure>
									<div class="five-elements-block__wrapp.r--image">
									<img src="<?php echo SITEROOT; ?>images/solution-1.png" alt="">
									</div>
									<figcaption>
									<p>Closet Solutions:</p>
									<p>DIY Online Designs</p>
									</figcaption>
									</figure>
									</a>
									</div>
									<div class="five-elements-block__wrapp.r--item">
									<a href="#">
									<figure>
									<div class="five-elements-block__wrapp.r--image">
									<img src="<?php echo SITEROOT; ?>images/solution-2.png" alt="">
									</div>
									<figcaption>
									<p>Custom Closets:</p>
									<p>Order Online Today</p>
									</figcaption>
									</figure>
									</a>
									</div>
									<div class="five-elements-block__wrapp.r--item">
									<a href="#">
									<figure>
									<div class="five-elements-block__wrapp.r--image">
									<img src="<?php echo SITEROOT; ?>images/solution-3.png" alt="">
									</div>
									<figcaption>
									<p>Closet Design:</p>
									<p>Easy Online Design Tool</p>
									</figcaption>
									</figure>
									</a>
									</div>
									<div class="five-elements-block__wrapp.r--item">
									<a href="#">
									<figure>
									<div class="five-elements-block__wrapp.r--image">
									<img src="<?php echo SITEROOT; ?>images/solution-4.png" alt="">
									</div>
									<figcaption>
									<p>Closet Systems:</p>
									<p>Designed By You, Crafted By Us</p>
									</figcaption>
									</figure>
									</a>
									</div>
									<div class="five-elements-block__wrapp.r--item">
									<a href="#">
									<figure>
									<div class="five-elements-block__wrapp.r--image">
									<img src="<?php echo SITEROOT; ?>images/solution-5.png" alt="">
									</div>
									<figcaption>
									<p>Closet Organizers:</p>
									<p>Custom-designed by you, quality-b...</p>
									</figcaption>
								</figure>
							</a>
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

				<div class="people-working__wrapp.r">
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

<script src="./app.js"></script></body>
</html>
