

<?php	
require_once($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); 	
?>	

<section class="first-fixed-block covid-block clearfix consult-block pb-0">
<figure class="col-12 first-fixed-block__img-group" style="background-image: url('../../images/free-in-home-consults-header.png');">
<figcaption class="first-fixed-block__img-group--text-block">
<div class="wrapper">
<h1 class="first-fixed-block__img-group--heading">

<?php
echo $top_1;
?>
<!-- Free In-Home Consultations -->
</h1>
<!-- <h3 class="first-fixed-block__img-group--subheading">We currently offer free local in-home consultations only in the greater Portland, Oregon metro area.</h3> -->
<p class="first-fixed-block__img-group--text">
<?php
echo $top_2;
?>
<!-- We currently offer free local in-home consultations only in the greater Portland, Oregon metro area. -->
</p>
</div>
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
								<li class="breadcrumb-item"><a href=".././">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Free in home consults</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="simple-block pb-md-5">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<div class="simple-block__border no-border pb-0">
							<div class="row">
								<div class="col-12">
									<div class="simple-block__heading">
										<h2 class="simple-block__heading--heading text-center">
<?php
echo $p_1_head;
?>
<!-- Please fill out the form below and we'll get in touch with you soon! -->

										</h2>
									</div>
								</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="simple-block__text">
									<p class="text-center">
<?php
echo $p_1_text;
?>
<!--
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna 
aliquyam erat, sed diam. voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, 
no sea takimata sanctus est Lorem ipsum dolor sit amet
-->
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


	<section class="two-elements-block pb-md-3 js-open-form">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="consult-wrap">
							<div class="row">
								<div class="col-12 col-lg-4">
									<div class="consult-wrap__image-block right-border h-lg-100">
										<img src="../../images/house.svg" alt="" class="consult-wrap__image-block--img img-fluid">
										<p class="consult-wrap__image-block--heading">
In home consultation
										</p>
									</div>
								</div>
								<div class="col-12 col-lg-8">
									<div class="consult-wrap__image-block justify-content-lg-start align-items-lg-start h-lg-100">
										<p class="consult-wrap__image-block--text">

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam. voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod. tempor invidunt ut labore et dolore magna aliquyam erat, sed diam. voluptua.

										</p>
												
										<div class="desktop-show">
											<button class="consult-wrap__image-block--button" id="js-desktop-first-home-consult-form-btn">Explore your options</button>
										</div>

										<div class="mobile-show">
											<button class="consult-wrap__image-block--button"
													data-toggle="modal" 
													data-target="#mobile-first-home-consult-form"
													id="js-mobile-first-home-consult-form-btn">
												Explore your options
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-12 col-md-6">
						<div class="consult-wrap virtual-consultation">
							<div class="row">
								<div class="col-12 col-lg-4">
									<div class="consult-wrap__image-block right-border h-lg-100">
										<img src="../../images/virtual-reality.svg" alt="" class="consult-wrap__image-block--img img-fluid">
										<p class="consult-wrap__image-block--heading">
<?php
echo $p_2_head;
?>
<!-- Virtual consultation -->
										</p>
									</div>
								</div>
								<div class="col-12 col-lg-8">
									<div class="consult-wrap__image-block justify-content-lg-start align-items-lg-start h-lg-100">
										<p class="consult-wrap__image-block--text">
										<p class="consult-wrap__image-block--heading">
<?php
echo $p_2_text;
?>
<!--
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam. voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod. tempor invidunt ut labore et dolore magna aliquyam erat, sed diam. voluptua.
-->
</p>
										<button class="consult-wrap__image-block--button">Virtual showroom</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="home-consult-form pb-md-3">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<!-- <form action=""> -->

						<div class="home-consult-form__wrapper">
							<div class="home-consult-form__nav">
							<button class="home-consult-form__nav--button" id="js-desktop-first-home-consult-nav-btn" disabled>1 Your Contact Info</button>
							<button class="home-consult-form__nav--button" id="js-desktop-second-home-consult-nav-btn" disabled>2 Your Project Info</button>
							<button class="home-consult-form__nav--button" id="js-desktop-third-home-consult-nav-btn" disabled>3 Attach an Image</button>
						</div>

						<div class="home-consult-form__content first-content" id="js-mobile-first-home-consult-form">
							<h4 class="home-consult-form__heading desktop-show text-center">Your Contact Info</h4>
							<div class="form-group">
								<label class="mobile-show home-consult-form__label " for="names" >Enter your full name</label>
								<input 
								type="text" 
								name="names" 
								placeholder="Enter your full name" 
								class="home-consult-form__input" 
								autocapitalize="off" 
								autocomplete="off"
								spellcheck="false" 
								autocorrect="off"/>
							</div>
							<div class="form-group">
								<label class="mobile-show home-consult-form__label" for="email">E-mail</label>
								<input 
								type="text" 
								name="email" 
								placeholder="E-mail" 
								class="home-consult-form__input" 
								autocapitalize="off" 
								autocomplete="off"
								spellcheck="false" 
								autocorrect="off"/>
							</div>
							<div class="form-group">
								<input 
								type="text" 
								name="address-1" 
								placeholder="Address:" 
								class="home-consult-form__input" 
								autocapitalize="off" 
								autocomplete="off"
								spellcheck="false" 
								autocorrect="off"/>
							</div>											
							<div class="form-group">
								<input 
								type="text" 
								name="address-2" 
								placeholder="Address 2:" 
								class="home-consult-form__input" 
								autocapitalize="off" 
								autocomplete="off"
								spellcheck="false" 
								autocorrect="off"/>
							</div>
							<div class="home-consult-form__zip-code-block">
								<div class="form-group small-input">
									<input 
									type="text" 
									name="city" 
									placeholder="City" 
									class="home-consult-form__input" 
									autocapitalize="off" 
									autocomplete="off"
									spellcheck="false" 
									autocorrect="off"/>
								</div>

								<div class="home-consult-form__select small-input">
									<select name="states" id="">
														<option value="State">State:</option>
														<option value="State 1">State 1</option>
														<option value="State 2">State 2</option>
														<option value="State 3">State 3</option>
														<option value="State 4">State 4</option>
									</select>
								</div>

								<div class="form-group small-input">
									<input 
									type="text" 
									name="zip-code" 
									placeholder="ZIP Code:" 
									class="home-consult-form__input" 
									autocapitalize="off" 
									autocomplete="off"
									spellcheck="false" 
									autocorrect="off"/>
								</div>

								<div class="form-group small-input">
									<input 
									type="text" 
									name="telephone-include-area-code" 
									placeholder="Telephone Include area code" 
									class="home-consult-form__input" 
									autocapitalize="off" 
									autocomplete="off"
									spellcheck="false" 
									autocorrect="off"/>
								</div>
							</div>

							<div class="home-consult-form__radio-block">
								<span>Mailing list:</span>

								<label class="desktop-show home-consult-form__radio">
									<input type="radio" name="r" value="1">
									<span>Yes</span>
								</label>
								<label class="desktop-show home-consult-form__radio">
									<input type="radio" name="r" value="2">
									<span>No</span>
								</label>
								<input type="checkbox" name="r" value="2" class="mobile-show home-consult-form__switcher" checked>
							</div>

							<div class="desktop-show text-center">
								<button class="home-consult-form__submit mt-4" id="js-desktop-second-home-consult-form-btn">Next</button>
							</div>
						</div>

						<div class="home-consult-form__content second-content" id="js-mobile-second-home-consult-form">
							<h4 class="home-consult-form__heading text-center desktop-show">Your Project Info</h4>

							<div class="form-group datapicker-block">
								<label for="date" class="control-label datapicker-block__label">Proposed Finish Date</label>
								<input 
								type="text" name="date" placeholder="Proposed Finish Date" 
								class="form-control home-consult-form__input date-pikcer" 
								data-provide="datepicker" 
								data-date-autoclose="1" 
								data-date-todayHighlight="1" 
								data-date-format="mm/dd/yyyy" 
								data-date-week-start="1"
								data-date-container=".datapicker-block"
								data-date-focusOnShow="false"
    							data-date-ignoreReadonly="true"
								readonly="readonly"/>
								<span class="datapicker-block__image"><img src="../../images/CAlendar.svg" alt=""></span>
							</div>

							<h4 class="home-consult-form__heading bordered-heading">Storage Areas <span>Which type of storage area are you interested in?</span></h4>

							<div class="home-consult-form__checkbox-block">
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-1" type="checkbox" value="value1">
									<label for="checkbox-1">Pantry</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-2" type="checkbox" value="value2">
									<label for="checkbox-2">Nursery</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-3" type="checkbox" value="value3">
									<label for="checkbox-3">Wallbed</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-4" type="checkbox" value="value4">
									<label for="checkbox-4">His Master</label>
								</div>
								<div class="form-group bigger-text">
									<input class="custom-checkbox bigger-text" id="checkbox-5" type="checkbox" value="value5">
									<label for="checkbox-5">His & Her Master</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-6" type="checkbox" value="value6">
									<label for="checkbox-6">Guest</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-7" type="checkbox" value="value7">
									<label for="checkbox-7">Office</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-8" type="checkbox" value="value8">
									<label for="checkbox-8">Garage</label>
								</div>
								<div class="form-group">
									<input class="custom-checkbox" id="checkbox-9" type="checkbox" value="value9">
									<label for="checkbox-9">Her Master</label>
								</div>
							</div>

							<div class="form-group">
								<label class="mobile-show home-consult-form__label textarea-label" for="massage">Comments <span>Is there any additional information we might need?</span></label>
								<textarea 
								name="massage" 
								id="" 
								cols="30" 
								rows="4" 
								class="home-consult-form__textarea" 
								placeholder="Comments: Is there any additional information we might need?" 
								autocapitalize="off" 
								autocomplete="off"
								spellcheck="false" 
								autocorrect="off"></textarea>
							</div>

							<div class="home-consult-form__select">
								<select name="states" id="">
													<option value="How did you hear about us?">How did you hear about us?</option>
													<option value="Option 1">Option 1</option>
													<option value="Option 2">Option 2</option>
													<option value="Option 3">Option 3</option>
													<option value="Option 4">Option 4</option>
								</select>
							</div>

							<div class="desktop-show text-center">
								<button class="home-consult-form__submit mt-4" id="js-desktop-third-home-consult-form-btn">Next</button>
							</div>
						</div>

						<div class="home-consult-form__content third-content" id="js-mobile-third-home-consult-form">
							<h4 class="home-consult-form__heading text-center desktop-show">Attach an Image</h4>
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
									<img src="../../images/checked.svg" alt="">
								</td>
							</tr>
							<tr>
								<td class="mobile-button-delete-wrap">
									<button class="mobile-button-delete js-delete-uploaded-img" data-image-name="example.jpg" data-toggle="modal" data-target="#deleteImgModal"></button>
								</td>
								<td class="mobile-image-icon"><span class="mobile-image-container" style="background: #7D9BC2;">jpg</span></td>
								<td class="image-name example1.jpg">example1.jpg</td>
								<td class="image-size">124 kb</td>
								<td class="success-or-error">
									<img src="../../images/cancel.svg" alt="">
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
																			<path fill="#384765" id="Path_195" data-name="Path 195" d="M14.3,0A14.3,14.3,0,1,0,28.6,14.3,14.316,14.316,0,0,0,14.3,0Zm8.342,14.9a.6.6,0,0,1-.6.6H15.491v6.554a.6.6,0,0,1-.6.6H13.7a.6.6,0,0,1-.6-.6V15.491H6.554a.6.6,0,0,1-.6-.6V13.7a.6.6,0,0,1,.6-.6h6.554V6.554a.6.6,0,0,1,.6-.6H14.9a.6.6,0,0,1,.6.6v6.554h6.554a.6.6,0,0,1,.6.6Z"/>
																		</g>
											</svg>
											Add file or drag and drop image here
											<input type="file" name="" id="" class="drop-region-input" accept="image/*" multiple>
										</div>
									</div>
								</td>
							</tr>
							</tfoot>
							</table>

							<div class="desktop-show text-center">
								<button class="home-consult-form__submit mt-4" id="js-desktop-last-home-consult-form-btn">submit your reqest</button>
							</div>
						</div>
					</div>
									<!-- <input type="submit" name="send" class="home-consult-form__submit" value="submit your reqest"> -->
								<!-- </form> -->
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="simple-block pb-md-5 desktop-show">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="simple-block__border pb-0 no-border">
									<div class="row">
										<div class="col-12">
											<div class="simple-block__heading">
												<h2 class="simple-block__heading--heading services-mobile-black-title text-center">Once the design meets your requirements you can place your order and your
													closet will be manufactured and shipped to you for you to install.</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>


			<section class="catalog-block services" id="js-show-mobile-catalog">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-lg-4 catalog-block__content">
								<figure>
									<div class="catalog-block__content--image">
										<img src="../../images/about-us-choices.png" alt="">
									</div>
									<figcaption>
										<h2>Choices</h2>
										<p class="simple-test">We offer many custom choices ranging from custom designs,
											colors to accessories that fit your style and needs.</p>
									</figcaption>
								</figure>
							</div>
							<div class="col-12 col-lg-4 catalog-block__content">
								<figure>
									<div class="catalog-block__content--image">
										<img src="../../images/about-us-lifetime.png" alt="">
									</div>
									<figcaption>
										<h2>Lifetime Warranty</h2>
										<p class="simple-test">
											All closet organizers installed by our company include a purchaser's lifetime warranty
											covering material defects and workmanship.
											See policies page for more information.
										</p>
									</figcaption>
								</figure>
							</div>
							<div class="col-12 col-lg-4 catalog-block__content">
								<figure>
									<div class="catalog-block__content--image">
										<img src="../../images/about-us-showrom.png" alt="">
									</div>
									<figcaption>
										<h2>Showrom-Design Center</h2>
										<p class="simple-test">
											Visit America’s largest closet organizer showroom and design center to view a wide
											variety of organizers for your home or office.
											Located in Tigard, Oregon, it’s the perfect place to design your new closet organizer,
											pantry, garage system and more. Our showroom
											is open Monday through Friday 9:00AM - 5:00 PM and on the weekends by appointment.
										</p>
									</figcaption>
								</figure>
							</div>
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



		<!-- Modal mobile first part of form -->
		<div class="modal free-in-home-consults-modal fade" id="mobile-first-home-consult-form" tabindex="-1" role="dialog" aria-labelledby="mobile-first-home-consult-form-title" aria-hidden="true" data-replace="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header fixed-modal-header">
						<h5 class="modal-title free-in-home-consults-modal__heading" id="mobile-first-home-consult-form-title">
							<span class="current-form">1/3</span>
							<span class="js-heading"></span>
						</h5>
						<button type="button" class="close free-in-home-consults-modal-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- <form action="">

						</form> -->
					</div>

					<div class="modal-footer fixed-modal-footer">
						<div class="current-form-block">
							<span class="current-form-block__elements active">1</span>
							<span class="current-form-block__elements">2</span>
							<span class="current-form-block__elements">3</span>
						</div>
						<button type="button" class="fixed-modal-footer__botton"
							data-dismiss="modal"
							data-toggle="modal" 
							data-target="#mobile-second-home-consult-form"
							id="js-mobile-second-home-consult-form-btn">
							Next
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</span>
						</button>
					</div>
				</div>
			</div>
		</div>



		<!-- Modal mobile second part of form -->
		<div class="modal free-in-home-consults-modal fade" id="mobile-second-home-consult-form" tabindex="-1" role="dialog" aria-labelledby="mobile-second-home-consult-form-title" aria-hidden="true" data-replace="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header fixed-modal-header">
						<h5 class="modal-title free-in-home-consults-modal__heading" id="mobile-second-home-consult-form-title">
							<span class="current-form">2/3</span>
							<span class="js-heading"></span>
						</h5>
						<button type="button" class="close free-in-home-consults-modal-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- <form action="">

						</form> -->
					</div>

					<div class="modal-footer fixed-modal-footer">
						<div class="current-form-block">
							<button type="button" class="current-form-block__elements"
								data-dismiss="modal"
								data-toggle="modal" 
								data-target="#mobile-first-home-consult-form"
								id="js-mobile-modal-first-home-consult-form-btn">
								1
							</button>
							<span class="current-form-block__elements active">2</span>
							<span class="current-form-block__elements">3</span>
						</div>
						<button type="button" class="fixed-modal-footer__botton"
							data-dismiss="modal"
							data-toggle="modal" 
							data-target="#mobile-third-home-consult-form"
							id="js-mobile-third-home-consult-form-btn">
							Next
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
								</svg>
							</span>
						</button>
					</div>
				</div>
			</div>
		</div>



		<!-- Modal mobile third part of form -->
		<div class="modal free-in-home-consults-modal fade" id="mobile-third-home-consult-form" tabindex="-1" role="dialog" aria-labelledby="mobile-third-home-consult-form-title" aria-hidden="true" data-replace="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header fixed-modal-header">
						<h5 class="modal-title free-in-home-consults-modal__heading" id="mobile-third-home-consult-form-title">
							<span class="current-form">3/3</span>
							<span class="js-heading"></span>
						</h5>
						<button type="button" class="close free-in-home-consults-modal-close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<!-- <form action="">

						</form> -->
					</div>

					<div class="modal-footer fixed-modal-footer">
						<div class="current-form-block">
							<button type="button" class="current-form-block__elements"
								data-dismiss="modal"
								data-toggle="modal" 
								data-target="#mobile-first-home-consult-form"
								id="js-mobile-modal-first-home-consult-form-btn">
								1
							</button>
							<button type="button" class="current-form-block__elements"
								data-dismiss="modal"
								data-toggle="modal" 
								data-target="#mobile-second-home-consult-form"
								id="js-mobile-modal-second-home-consult-form-btn">
								2
							</button>
							<span class="current-form-block__elements active">3</span>
						</div>
						<button type="button" class="fixed-modal-footer__botton--submit"
							data-dismiss="modal"
							id="js-mobile-home-consult-form-submit-btn">
							Submit your reqest
						</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal delete -->
		<div class="modal confirm-modal fade" id="deleteImgModal" tabindex="-1" role="dialog" aria-labelledby="#deleteImgModalTitle" aria-hidden="true">
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
								<div class="row mb-3">
									<div class="col-12">
										<p class="js-delete-text">You are about to delete <span style="color: #17C3C6">XXXX</span>.<br /> Are you sure that you want to continue?</p>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<button type="submit" data-dismiss="modal" class="btn btn-primary mw-100">cancel</button>
									</div>
									<div class="col-6">
										<button type="submit" data-dismiss="modal" class="btn btn-secondary js-delete-uploaded-img-btn mw-100">continue</button>
									</div>
								</div>
							<!-- </form> -->
						</div>
					</div>
				</div>
			</div>
		</div>
