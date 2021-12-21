<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<title>ClosetsToGo</title>
<meta name="description" content="fax a design plan">
<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
</head>
<body>

<?php
require_once($real_root."/includes/header.php"); 
?>	

<section class="first-fixed-block covid-block fax-a-design clearfix">
	<figure class="first-fixed-block__img-group" style="background-image: url('<?php echo SITEROOT; ?>images/fax-a-design-plan-header.png');">
		<figcaption class="first-fixed-block__img-group--text-block">
			<div class="wrapper">
				<h1 class="first-fixed-block__img-group--heading">
				<?php
				echo "top_1:  ".$top_1;
				//Scan or Fax your design plan request
				?>
				</h1>
				<button class="mobile-hero-btn">
				<svg xmlns="http://www.w3.org/2000/svg" width="25.052" height="35.636" viewBox="0 0 25.052 35.636"><defs><style>.down-arrow-white{fill:#fff;}</style></defs><path class="down-arrow-white" d="M24.011,5.053a1.263,1.263,0,1,0-1.8,1.778l9.105,9.105H1.274A1.265,1.265,0,0,0,0,17.193a1.28,1.28,0,0,0,1.275,1.275H31.32l-9.105,9.088a1.289,1.289,0,0,0,0,1.8,1.258,1.258,0,0,0,1.8,0L35.271,18.091a1.267,1.267,0,0,0,0-1.778Z" transform="translate(29.728 0.001) rotate(90)"/></svg>
				</button>
			</div>
		</figcaption>
	</figure>
</section>
		
<main class="main hero-block covid-block clearfix">

	<section class="breadcrumb-block desktop-show">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item"><a href="#">About us</a></li>
								<li class="breadcrumb-item"><a href="#">Contact us</a></li>
								<li class="breadcrumb-item active" aria-current="page">We-design-fax</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="simple-block fax-design">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="simple-block__border">
							<div class="row">
								<div class="col-12">
									<div class="simple-block__heading">
										<h2 class="simple-block__heading--heading">
<?php
echo "p_1_head:  ".$p_1_head;
?>
<!-- Download and Print Our Fax Form -->

										</h2>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-9 col-xl-9">
									<div class="simple-block__text">
										<p>

<?php
echo "p_1_text:  ".$p_1_text;
?>
<!--
Download, fill out and fax the following form to us with your specifications. Check out the form below for a sample. This is just 
an example as everyone's design will be different. If you have any questions, feel free to contact us at 1-888-312-7424. 
-->
										</p>
									</div>
								</div>
								<div class="col-12 col-lg-3 col-xl-3 text-center">
									<a href="#" class="link-button">
										Download Our Fax Form
										<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
											<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
										</svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="simple-block fax-design mobile-show">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="fax-design-mobile-buttons">
							<button class="fax-design-mobile-button js-mobile-fax-design-content-btn" 
							date-content-class-open=".js-sample-fax-form" data-toggle="modal" data-target="#mobile-fax-design">
							Sample Fax Form
							</button>
							<button class="fax-design-mobile-button js-mobile-fax-design-content-btn" 
							date-content-class-open=".js-tips-how-to-measure" data-toggle="modal" data-target="#mobile-fax-design">
							Tips on how to measure
							</button>
							<button class="fax-design-mobile-button js-mobile-fax-design-content-btn" 
							date-content-class-open=".js-fax-your-project" data-toggle="modal" data-target="#mobile-fax-design">
							Fax us your idea project
							</button>
							<button class="fax-design-mobile-button js-mobile-fax-design-content-btn" 
							date-content-class-open=".js-read-review" data-toggle="modal" data-target="#mobile-fax-design">
							Read Our Reviews
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="two-elements-block fax-design js-first-fax-design">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-xl-7 js-sample-fax-form">
						<div class="two-elements-block__wrapper">
							<h2 class="two-elements-block__wrapper--heading">
<?php
echo "p_2_head:  ".$p_2_head;
?>								
<!-- Sample Fax Form -->
								
							</h2>
							<p class="two-elements-block__wrapper--text small-text js-show-text">
<?php
echo "p_2_text:  ".$p_2_text;
?>								
									
<!--									
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum egestas diam at arcu malesuada, 
a efficitur tortor congue. Morbi hendrerit ex in lacus efficitur euismod. Morbi risus orci, hendrerit at bibendum efficitur, molestie a ex. 
Morbi eget dui tincidunt, luctus diam sed, placerat ex. Nunc ut malesuada ante. 
<br><br>
Praesent egestas consectetur volutpat. Morbi varius maximus iaculis. In a velit mollis, venenatis 
nibh eu, congue nulla. Praesent vitae ipsum ut sapien pretium tincidunt. Morbi dapibus nibh vitae elit blandit, et consectetur sem tempor. 
Etiam tristique est vel lacinia dignissim. Quisque facilisis, ligula ac volutpat porttitor, augue diam consequat metus, non dapibus sem metus 
-->
							</p>
							<div class="two-elements-block__wrapper--link-block">
								<button data-readAll="Discover all" data-readLess="Discover less" class="link-button js-btn-view-all-text">
									<span>Discover all</span>
									<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
										<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
									</svg>
								</button>

								<a href="#" class="link-button you-design">
									Start Your design
									<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
										<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
									</svg>
								</a>
								<a href="#" class="link-button we-design">
									Let us design
									<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
										<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
									</svg>
								</a>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-xl-5 js-sample-fax-form">
						<div class="two-elements-block__wrapper">
							<div class="two-elements-block__wrapper--content">
								<div class="two-elements-block__wrapper--image">
									<div class="only-image">
										<img src="<?php echo SITEROOT; ?>images/fax-adesign-cheme.png" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-6 col-xl-12 js-read-review">
						<div class="two-elements-block__wrapper--stars fax-a-design">
							<h2 class="heading">Read Our Reviews</h2>
							<div class="stars-wrapper">
								<div class="block-stars__wrapper">
									<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapper--image">
									<div class="block-stars__wrapper--text">
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
								<div class="block-stars__wrapper">
									<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapper--image">
									<div class="block-stars__wrapper--text">
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
								<div class="block-stars__wrapper">
									<img src="<?php echo SITEROOT; ?>images/Rectangle12.png" alt="" class="block-stars__wrapper--image">
									<div class="block-stars__wrapper--text">
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
								<a href="#" class="link-button">
								Discover all
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
								<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="two-elements-block fax-design js-second-fax-design">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-lg-6 js-tips-how-to-measure">
						<div  class="no-shadow">
							<h2 class="heading">
<?php
echo "p_head_tips:  ".$p_head_tips;
?>
<!-- Tips on how to measure -->
							</h2>
									
							<div id="accordion">
								<div class="card-collapse">													
									<div class="card-collapse__header collapsed" id="heading-one" data-toggle="collapse" data-target="#collapse-one" aria-expanded="false" aria-controls="collapse-one">
										<h5 class="card-collapse__title">
<span>
<?php
echo "p_3_head:  ".$p_3_head;
?>
<!-- How to using a laser level if your floor is sloped -->
</span>
											<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
											<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>
									<div id="collapse-one" class="collapse" aria-labelledby="heading-one" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_3_text:  ".$p_3_text;
?>
<!--											
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->												
										</div>
									</div>
								</div>
	
								<div class="card-collapse">
									<div class="card-collapse__header collapsed" id="heading-two" data-toggle="collapse" data-target="#collapse-two" aria-expanded="false" aria-controls="collapse-two">
										<h5 class="card-collapse__title">
										<span>
<?php
echo "p_4_head:  ".$p_4_head;
?>
<!-- Do you know that... -->
										</span>
										<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
										<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>
									<div id="collapse-two" class="collapse" aria-labelledby="heading-two" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_4_text:  ".$p_4_text;
?>
<!--												
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->												
										</div>
									</div>
								</div>

								<div class="card-collapse">
									<div class="card-collapse__header collapsed" id="heading-three" data-toggle="collapse" data-target="#collapse-three" aria-expanded="false" aria-controls="collapse-three">
										<h5 class="card-collapse__title">
<span>
<?php
echo "p_5_head:  ".$p_5_head;
?>
<!--How to prevent... -->
</span>
										<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
										<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>
									<div id="collapse-three" class="collapse" aria-labelledby="heading-three" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_5_text:  ".$p_5_text;
?>
<!--
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->
										</div>
									</div>
								</div>

								<div class="card-collapse">
									<div class="card-collapse__header collapsed" id="heading-four" data-toggle="collapse" data-target="#collapse-four" aria-expanded="false" aria-controls="collapse-four">
										<h5 class="card-collapse__title">
<span>
<?php
echo "p_6_head:  ".$p_6_head;
?>
<!--
How to using a laser level if your floor is sloped
-->
</span>
										<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
										<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>

									<div id="collapse-four" class="collapse" aria-labelledby="heading-four" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_6_text:  ".$p_6_text;
?>												
<!--
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->	
										</div>
									</div>
								</div>

								<div class="card-collapse">
									<div class="card-collapse__header collapsed" id="heading-five" data-toggle="collapse" data-target="#collapse-five" aria-expanded="false" aria-controls="collapse-five">
										<h5 class="card-collapse__title">
<span>
<?php
echo "p_7_head:  ".$p_7_head;
?>
<!-- Do you know that... -->
</span>
										<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
										<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>
									<div id="collapse-five" class="collapse" aria-labelledby="heading-five" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_7_text:  ".$p_7_text;
?>												
<!--
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->	
										</div>
									</div>
								</div>

								<div class="card-collapse">
									<div class="card-collapse__header collapsed" id="heading-six" data-toggle="collapse" data-target="#collapse-six" aria-expanded="false" aria-controls="collapse-six">
										<h5 class="card-collapse__title">
<span>
<?php
echo "p_8_head:  ".$p_8_head;
?>
<!-- How to prevent... -->
</span>
											<img class="collapse-icon collapse-icon__plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
											<img class="collapse-icon collapse-icon__minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
										</h5>
									</div>
									<div id="collapse-six" class="collapse" aria-labelledby="heading-six" data-parent="#accordion">
										<div class="card-collapse__body">
<?php
echo "p_8_text:  ".$p_8_text;
?>							
<!--
Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illum, neque dolor aliquam ea voluptatum necessitatibus explicabo quaerat ducimus at dolores debitis nisi nam facere sit recusandae quibusdam, quisquam id.
-->	
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-12 col-lg-6 js-fax-your-project">
						<div class="home-consult-form__content no-shadow mw-100" id="js-mobile-third-home-consult-form">
							<h2 class="heading">Fax us your idea project</h2>			
									<table class="home-consult-form__image-area">
										<thead>
											<tr>
												<th class="image-name bigger-col">Filename</th>
												<th class="image-size">Size</th>													
												<th class="success-or-error">Status</th>
											</tr>
										</thead>
										<tbody class="image-preview">
											<tr>
												<td class="mobile-button-delete-wrap">
													<button class="mobile-button-delete js-delete-uploaded-img" data-image-name="example.jpg" data-toggle="modal" data-target="#deleteImgModal"></button>
												</td>
												<td class="mobile-image-icon"><span class="mobile-image-container" style="background: #7D9BC2;">jpg</span></td>
												<td class="image-name example.jpg">example.jpg</td>
												<td class="image-size">30 kb</td>
												<td class="success-or-error">
													<img src="<?php echo SITEROOT; ?>images/checked.svg" alt="">
												</td>
											</tr>
											<tr>
												<td class="mobile-button-delete-wrap">
													<button class="mobile-button-delete js-delete-uploaded-img" data-image-name="example1.jpg" data-toggle="modal" data-target="#deleteImgModal"></button>
												</td>
												<td class="mobile-image-icon"><span class="mobile-image-container" style="background: #7D9BC2;">jpg</span></td>
												<td class="image-name example1.jpg">example1.jpg</td>
												<td class="image-size">124 kb</td>
												<td class="success-or-error">
													<img src="<?php echo SITEROOT; ?>images/cancel.svg" alt="">
												</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="3">
													<div class="drop-region">
														<div class="drop-message">
															<svg id="add" xmlns="http://www.w3.org/2000/svg" width="28.6" height="28.6" viewBox="0 0 28.6 28.6">
																<g id="Group_376" data-name="Group 376">
																	<path fill="#384765" id="Path_195" data-name="Path 195" d="M14.3,0A14.3,14.3,0,1,0,28.6,14.3,14.316,14.316,0,0,0,14.3,0Zm8.342,14.9a.6.6,0,0,1-.6.6H15.491v6.554a.6.6,0,0,1-.6.6H13.7a.6.6,0,0,1-.6-.6V15.491H6.554a.6.6,0,0,1-.6-.6V13.7a.6.6,0,0,1,.6-.6h6.554V6.554a.6.6,0,0,1,.6-.6H14.9a.6.6,0,0,1,.6.6v6.554h6.554a.6.6,0,0,1,.6.6Z"></path>
																</g>
															</svg>
															Add file
															<input type="file" name="" id="" class="drop-region-input" accept="image/*" multiple="">
														</div>
													</div>
												</td>
												</tr>
										</tfoot>
									</table>
						</div>
						<input type="submit" name="send" class="link-button fax-a-design-form-button" value="submit your request">
					</div>
				</div>
			</div>
		</div>
	</section>


	<section class="video-block fax-design">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="video-block__with-border">
							<div class="row">
								<div class="col-12">
									<h2 class="video-block__heading">Watch some videos</h2>
									<p class="video-block__text desktop-show">on how to measure the area correctly to ensure all things are taken into consideration such as base molding, windows, 
												electrical outlets, attic and floor crawl spaces, heat registers etc..
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="video-block__videos video-second-caro">
										<div class="video-block__videos--video">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>
										<div class="video-block__videos--video">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>
										<div class="video-block__videos--video">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>
										<div class="video-block__videos--video">
											<div class="embed-responsive embed-responsive-16by9">
												<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
	</section>
			
	<section class="company-block fax-design">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row organizer-caro fax-design">
					<div class="col-12 col-lg-4 company-block__images">
						<img src="<?php echo SITEROOT; ?>images/company-1.png" alt="">
						<div class="company-block__images--text">
							<p>Closet Solutions:</p>
							<p>DIY Online Designs</p>
							<a href="#" class="link-button">
								buy now
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</a>
						</div>
					</div>
					<div class="col-12 col-lg-4 company-block__images">
						<img src="<?php echo SITEROOT; ?>images/company-2.png" alt="">								
						<div class="company-block__images--text white-color">
							<p>Custom Closets:</p>
							<p>Order Online Today</p>
							<a href="#" class="link-button">
								buy now
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</a>
						</div>
					</div>
					<div class="col-12 col-lg-4 company-block__images">
						<img src="<?php echo SITEROOT; ?>images/company-3.png" alt="">								
						<div class="company-block__images--text white-color">
							<p>Closet Organizer</p>
							<p>Showroom</p>
							<a href="#" class="link-button">
								explore now
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</a>
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

<!-- Modal mobile fax a design buttons -->
		<div class="modal mobile-full-screan-modal fade" id="mobile-fax-design" tabindex="-1" role="dialog"
			 aria-labelledby="mobile-fax-design-title" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="mobile-fax-design-title">&nbsp;</h5>
						<button type="button" class="close js-close-fax-design" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal delete -->
		<div class="modal confirm-modal fade" id="deleteImgModal" tabindex="-1" role="dialog"
			 aria-labelledby="#deleteImgModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="deleteImgModalTitle"><span>XXXX</span></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="account-block__form">
							<!-- <form> -->
							<div class="mb-3">
								<p class="js-delete-text">You are about to delete <span
										style="color: #17C3C6">XXXX</span>.<br/> Are you sure that you want to continue?
								</p>
								<div class="d-flex align-content-center justify-content-between">
									<button type="submit" data-dismiss="modal" class="btn btn-primary mr-2">cancel
									</button>
									<button type="submit" data-dismiss="modal"
											class="btn btn-secondary js-delete-uploaded-img-btn ml-2">continue
									</button>
								</div>
							</div>
							<!-- </form> -->
						</div>
					</div>
				</div>
			</div>
		</div>

<script src="<?php echo SITEROOT; ?>app.js"></script>
	
</body>
</html>
