<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<title>ClosetsToGo</title>
<meta name="description" content="shopping-cart">
<link href="./app.css" rel="stylesheet">
</head>
<body class="clearfix product-detail">
<?php	
require_once($real_root."/includes/header.php"); 	
?>	
<main class="main clearfix main__payment-page">
<section class="section-checkout">
<div class="wrapper">
<div class="container-fluid">
<div class="row flex-lg-nowrap">
	<div class="col col-auto__custom">
		<div class="card card-checkout card-checkout__header__main" id="shoppingCardTitle">
			<div class="card-body">
<h5 class="card-checkout__header">
<span class="card-checkout__header__main__back-icon">
<a href="index.html" class="d-block"><img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt=""></a>
</span><span>Shopping Cart (<?php echo $cart->getItemCount(); ?>)</span>
</h5>
<!--SHOW THIS ON DESKTOP SCREEN-->
<input class="checkbox__ch-card__checkbox selectable card-el__hide-on-md" id="checkbox__select-all" type="checkbox" value="value1">
<label for="checkbox__select-all" class="checkbox__select-all__label card-el__hide-on-md">Select All</label>
<!--#SHOW THIS ON DESKTOP SCREEN-->
			</div>
		</div>	
		<!--PRODUCT ITEM-->
		<div class="card card-checkout">
			<div class="card-checkout__remove-item">
				<button class="p-0">
					<img class="img-fluid" src="<?php echo SITEROOT; ?>images/icon-close.svg" alt="">
				</button>
			</div>
			<div class="card-body d-flex align-items-center">
				<!--SHOW THIS ON DESKTOP SCREEN-->
				<div class="mr-1 card-el__hide-on-md">
					<div>
						<input class="checkbox__ch-card__checkbox selectable"
						id="checkbox-product-1" type="checkbox" value="value2">
						<label for="checkbox-product-1"> </label>
					</div>
				</div>
				<!--#SHOW THIS ON DESKTOP SCREEN-->
				<div class="card-checkout__product__image mr-3">
					<div class="img-wrap">
						<img src="<?php echo SITEROOT; ?>images/hardware-resources-knob-oil-rubbed-bronze.png"
						class="img-fluid" alt="">
					</div>
				</div>
				<div class="card-checkout__product">
					<div class="row align-items-end align-items-lg-center">
						<div class="col card-checkout__product__title-wrap">
							<h5 class="card-checkout__product__title">
							Special title treatment
							</h5>
							<p class="card-checkout__product__number">Product Id: 000168</p>
						</div>
						<!--SHOW THIS ON MOBILE SCREEN-->
						<div class="col-auto card-el__show-on-md ">
							<p class="card-checkout__product__label">
								<span class="card-el__hide-on-md">Price:</span>
								<span class="card-checkout__product__label-value mark-color">$44.44</span>
							</p>
						</div>
						<!--#SHOW THIS ON MOBILE SCREEN-->
					</div>
					
					<!--SHOW THIS ON DESKTOP SCREEN-->
					<p class="card-checkout__product__description card-el__hide-on-md">
					Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob.
					Works well in offices and any closet alike. Available colors: Brushed
					Chrome, Oil Rubbed Bronze and Polished Chrome.
					</p>

					<!--#SHOW THIS ON DESKTOP SCREEN-->
					<div class="d-flex align-items-center justify-content-end justify-content-lg-between mt-2 mt-md-0">
						<!--SHOW THIS ON DESKTOP SCREEN-->
						<div class="card-el__hide-on-md">
							<p class="card-checkout__product__label">
							<span>Unit Price:</span> 
							<span class="card-checkout__product__label-value">$22.22</span>
							</p>
						</div>
						<!--#SHOW THIS ON DESKTOP SCREEN-->
						<div class="card-checkout__product__label__buttons__wrap">

							<!--SHOW THIS ON DESKTOP SCREEN-->
							<p class="card-checkout__product__label card-el__hide-on-md">
							<label for="checkbox-quantity-1">Quantity: </label>
							<span class="input-wrap">
							<span class="input-wrap__quantity-mark">x</span>
							<input id="checkbox-quantity-1" type="number" min="0"
							class="card-checkout__product__label-value input"
							value="2"/>
							</span>
							</p>
							
							<!-- #SHOW THIS ON DESKTOP SCREEN-->
							<div class="card-checkout__product__label__buttons card-el__show-on-md">
								<span class="butones minus">-</span>
								<input class="text" type="text" value="1" id="prod-1"/>
								<span class="butones plus">+</span>
							</div>
						</div>

						<!--SHOW THIS ON DESKTOP SCREEN-->
						<div class="card-el__hide-on-md">
						<p class="card-checkout__product__label">
						Price:
						<span class="card-checkout__product__label-value mark-color">$44.44</span>
						</p>
						</div>
						
						<!--#SHOW THIS ON DESKTOP SCREEN-->
						<div>
							<div class="idea-folder-on-md">
								<p class="card-checkout__product__label card-checkout__product__label__sm justify-content-end">
								<a href="" title="" class="link hover__ltr">
								<span class="icon-wrap">
								<svg id="Save" xmlns="http://www.w3.org/2000/svg"
								width="25.6" height="23.023"
								viewBox="0 0 25.6 23.023">
								<path id="Path_205" data-name="Path 205"
								d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
								transform="translate(0 -0.963)"/>
								<path id="Path_207" data-name="Path 207"
								d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
								transform="translate(13.1 24)" />
								</svg>
								</span>
								<!--SHOW THIS ON DESKTOP SCREEN-->
								<span class="card-el__hide-on-md">
								Save to idea folder
								</span>
								<!--#SHOW THIS ON DESKTOP SCREEN-->
								</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--#PRODUCT ITEM-->
		
		<!--PRODUCT ITEM-->
		<div class="card card-checkout you-design__mark">
			<div class="card-checkout__remove-item">
				<button class="p-0">
					<img class="img-fluid" src="<?php echo SITEROOT; ?>images/icon-close.svg" alt="">
				</button>
			</div>
			<div class="card-body d-flex align-items-center">

				<!--SHOW THIS ON DESKTOP SCREEN-->
				<div class="mr-1 card-el__hide-on-md">
					<div>
						<input class="checkbox__ch-card__checkbox selectable"
						id="checkbox-product-2" type="checkbox" value="value2">
						<label for="checkbox-product-2"> </label>
					</div>
				</div>
				<!--#SHOW THIS ON DESKTOP SCREEN-->

				<div class="card-checkout__product__image mr-3">
					<!--SHOW YOU DESIGN ON TOP OF THE IMAGE ON MOBILE-->
					<span class="card-checkout__product__badge badge__u-design card-el__show-on-md">you design</span>
					<!--SHOW YOU DESIGN ON TOP OF THE IMAGE ON MOBILE-->
					<div class="img-wrap">
						<img src="<?php echo SITEROOT; ?>images/hardware-resources-knob-oil-rubbed-bronze.png"
						class="img-fluid" alt="">
					</div>
				</div>
				
				<div class="card-checkout__product">
					<div class="card-checkout__product__badges ">
						<!--HIDE YOU DESIGN ON MOBILE-->
						<span class="card-checkout__product__badge badge__u-design card-el__hide-on-md">you design</span>
						<!-- #HIDE YOU DESIGN ON MOBILE-->
						<span class="card-checkout__product__badge badge__required">(E-sign required !)*</span>
					</div>
					<div class="row align-items-end align-items-lg-center ">
						<div class="col card-checkout__product__title-wrap">
							<h5 class="card-checkout__product__title">
							Special title treatment
							</h5>
							<p class="card-checkout__product__number">Product Id: 000168</p>
						</div>
						
						<!--SHOW THIS ON MOBILE SCREEN-->
						<div class="col-auto card-el__show-on-md">
							<p class="card-checkout__product__label">
							<span class="card-el__hide-on-md">Price:</span>
							<span class="card-checkout__product__label-value mark-color">$44.44</span>
							</p>
						</div>
						
						<!--#SHOW THIS ON MOBILE SCREEN-->
					</div>
					
					<!--SHOW THIS ON DESKTOP SCREEN-->
					<p class="card-checkout__product__description card-el__hide-on-md">
					Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob.
					Works well in offices and any closet alike. Available colors: Brushed
					Chrome, Oil Rubbed Bronze and Polished Chrome.
					</p>
					<!--#SHOW THIS ON DESKTOP SCREEN-->

					<div class="d-flex align-items-center justify-content-end justify-content-lg-between mt-2 mt-md-0">
						<!--SHOW THIS ON DESKTOP SCREEN-->
						<div class="card-el__hide-on-md">
							<p class="card-checkout__product__label">
							<span>Unit Price:</span> 
							<span class="card-checkout__product__label-value">$22.22</span>
							</p>
						</div>
						<!--#SHOW THIS ON DESKTOP SCREEN-->

						<div class="card-checkout__product__label__buttons__wrap">
							<!--SHOW THIS ON DESKTOP SCREEN-->
							<p class="card-checkout__product__label card-el__hide-on-md">
							<label for="checkbox-quantity-2">Quantity: </label>
							<span class="input-wrap">
							<span class="input-wrap__quantity-mark">x</span>
							<input id="checkbox-quantity-2" type="number" min="0"
							class="card-checkout__product__label-value input"
							value="2"/>
							</span>
							</p>
							<!--#SHOW THIS ON DESKTOP SCREEN-->

							<div class="card-checkout__product__label__buttons card-el__show-on-md">
								<span class="butones minus">-</span>
								<input class="text" type="text" value="1" id="prod-2"/>
								<span class="butones plus">+</span>
							</div>
						</div>
						<div class="card-el__hide-on-md">
							<p class="card-checkout__product__label">
							Price:
							<span class="card-checkout__product__label-value mark-color">$44.44</span>
							</p>
						</div>
						<div class="">
							<p class="card-checkout__product__label">
							<button type="button"
							class="link-button link-button__no-arrow link-button__reversed-colors"
							data-toggle="modal" data-target="#modal__e-sign">
							<span class="card-el__show-on-md icon-signature">
							<svg xmlns="http://www.w3.org/2000/svg" width="24.144"
							height="16.825" viewBox="0 0 24.144 16.825">
							<g transform="translate(0 0)">
							<path class="a"
							class="a"
							d="M23.434,188.008H.71a.71.71,0,1,0,0,1.42H23.434a.71.71,0,1,0,0-1.42Z"
							transform="translate(0 -172.603)"/></g>
							</svg>
							</span>
							<!--SHOW THIS ON DESKTOP SCREEN-->
							<span class="card-el__hide-on-md">
							e-sign document
							</span>
							<!--#SHOW THIS ON DESKTOP SCREEN-->
							</button>
							</p>
						</div>
						
						<div>
							<div class="idea-folder-on-md">
								<p class="card-checkout__product__label card-checkout__product__label__sm justify-content-end">
								<a href="" title="" class="link hover__ltr">
								<span class="icon-wrap">
								<svg id="Save" xmlns="http://www.w3.org/2000/svg"
								width="25.6" height="23.023"
								viewBox="0 0 25.6 23.023">
								<path id="Path_205" data-name="Path 205"
								d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z"
								transform="translate(0 -0.963)"/>
								<path id="Path_207" data-name="Path 207"
								d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z"
								transform="translate(13.1 24)" />
								</svg>
								</span>
								<!--SHOW THIS ON DESKTOP SCREEN-->
								<span class="card-el__hide-on-md">
								Save to idea folder
								</span>
								<!--#SHOW THIS ON DESKTOP SCREEN-->
								</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!--E-SIGN COMPLETE BARGE-->			
			<div class="eSignComplete">
				<div class="d-flex align-items-center justify-content-center">
					<div>
						<img src="<?php echo SITEROOT; ?>images/shield.svg" alt="">
					</div>
					<div>
						<p class="eSignComplete-text">
						e-sign complete
						</p>
					</div>
				</div>
			</div>
			<!--E-SIGN COMPLETE BARGE-->
			
		</div>
	<!--#PRODUCT ITEM-->
	</div>

		
	<div class="col col__card-checkout">
		<div class="card-fixed width-inherit z-depth-3">
			<div class="card card-checkout card-fixed__inner card-shadow no-border">
				<div class="card-body card-order">
					<h5 class="card-checkout__header">Order Summary</h5>
					<div class="order">
						<div class="table-responsive">
							<table class="table table__order">
							<tbody>
							<tr>
								<td scope="row" class="text">Sub Total:</td>
								<td class="text-right text">$52.44</td>
								<td class="text-right text"></td>
							</tr>
							<tr>
								<td scope="row" class="text">Discount:</td>
								<td class="text-right text">$0.00</td>
								<td class="text-right text"></td>
							</tr>
							<tr>
								<td scope="row" class="text">Tax:</td>
								<td class="text-right text">$0.00</td>
								<td class="text-right text"></td>
							</tr>
							</tbody>
							<tfoot>
							<tr>
								<td>Price:</td>
								<td class="text-right">$52.44</td>
								<td class="text-right text"></td>
							</tr>
							</tfoot>
							</table>
						</div>
					</div>
					<div class="">
						
						<button onClick="goto_checkout();" 
						class="btn btn-secondary btn-checkout btn-full btn-full">
						checkout
						</button>
						
					</div>
				</div>
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

<?php
require_once($real_root.'/includes/footer_shopping_cart.php');
?>

		<!-- Modal e-sign -->
		<div class="modal modal-sign fade" id="modal__e-sign" tabindex="-1" role="dialog"
			 aria-labelledby="exampleModalLabel" aria-hidden="true">

			<div class="modal-dialog " role="document">

				<div class="modal-content">
					<!--SHOW THIS ON DESKTOP SCREEN-->
					<div class="d-flex align-items-center justify-content-between modal-content__header card-el__hide-on-md">
						<div class="f-1">
							<div class="modal-sign__brand-wrap ">
								<img src="<?php echo SITEROOT; ?>images/svgg.svg" class="img-fluid" alt="">
							</div>
						</div>
						<div class="f-1">
							<h2 class="modal-sign__header text-center">
								E-sign
							</h2>
						</div>
						<div class="f-1 modal-sign__close-icon-wrap text-right close close-modal" type=""
							 data-dismiss="modal" aria-label="Close">
							<img src="<?php echo SITEROOT; ?>images/close.svg" class="img-fluid" alt="">
						</div>
					</div>
					<!--#SHOW THIS ON DESKTOP SCREEN-->

					<!--SHOW THIS ON MOBILE SCREEN-->
					<div class="modal__add-address__header__fixed card-el__show-on-md">
						<button type="button"
								class="modal-sign__back btn-back d-none"
								data-role="signBack"
						>
							<img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
						</button>
						<h3 class="title">
							E-sign
						</h3>
						<div class="f-1 modal-sign__close-icon-wrap text-right close-modal" type="buttons"
							 data-dismiss="modal" aria-label="modalAddAddress">
							<img src="<?php echo SITEROOT; ?>images/close.svg" class="img-fluid" alt="">
						</div>
					</div>
					<!--#SHOW THIS ON MOBILE SCREEN-->
					<div class="alert alert-primary cd-none" data-alert="alert-primary-initialize" role="alert">
						<span class="alert-icon"><img src="<?php echo SITEROOT; ?>images/shield.svg" class="img-fluid" alt=""></span>You have
						completed all required fields. Please click "Continue"
					</div>
					<div class="alert alert-agree cd-none" data-alert="alert-agree-initialize" role="alert">
						<div class="flex-column flex-md-row row align-items-md-center">
							<div class="col">
								<h4 class="alert-title">
									Almost done
								</h4>
								<p class="alert-text">
									I agree to be legally bound by this document and the Hellosign terms of services
								</p>
							</div>
							<div class="col-auto mk-btn-stls">
								<button class="btn btn-transparent btn-rounded">
									Edit
								</button>
								<button class="btn btn-info btn-rounded" data-role="agree-with-tac">
									Agree
								</button>
							</div>
						</div>
					</div>

					<div class="modal-body card-shadow w-100">
						<form id="modalForm" class="needs-validation">
							<fieldset>
								<div class="form-group form-group__default pt-4 pt-lg-0" data-inputforms="input-forms">
									<div class="form-control form-group__default__form-control home-consult-form__input">
										<label class="label-above card-el__show-on-md"
											   for="input-name">Name:</label>
										<input class="input" id="input-name" required type="text" placeholder="Name">
										<span class="required__star"><abbr title="required">*</abbr></span>
									</div>
									<div class="form-control form-group__default__form-control home-consult-form__input">
										<label class="label-above card-el__show-on-md"
											   for="input-email">E-mail:</label>
										<input class="input" id="input-email" required type="email"
											   placeholder="Email Address">
										<span class="required__star"><abbr title="required">*</abbr></span>
									</div>
								</div>
								<div class="mt-3 mb-4 px-30 px-md-0">
									<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit?
									</p>
									<div class="form-group form-group__default">
										<div class="form-check form-group__default__form-check form-check-inline">
											<input class="checkbox__ch-card__checkbox" id="checkbox__select-nam"
												   type="checkbox"
												   value="value1">
											<label for="checkbox__select-nam">Nam dignissim:</label>
										</div>
										<div class="form-check form-check form-group__default__form-check form-check-inline">
											<input class="checkbox__ch-card__checkbox" id="checkbox__select-ipsum"
												   type="checkbox"
												   value="value1">
											<label for="checkbox__select-ipsum">Ipsum eget rhoncus:</label>
										</div>
									</div>
								</div>
								<div class="px-30 px-md-0" data-role="info-text-custom-collapse">
									<p class="text-small info-text-custom-collapse">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dignissim, ipsum
										eget
										rhoncus
										fermentum, tortor augue dictum risus, non sagittis ex quam vestibulum ipsum. Ut
										posuere
										quam
										sed arcu convallis ultrices. Pellentesque vehicula condimentum porttitor. Donec
										dignissim
										dui lobortis, sagittis turpis ac, facilisis tortor. In hac habitasse platea
										dictumst.
										Nullam
										pharetra ullamcorper neque in aliquam. Suspendisse lacus nibh, elementum et
										cursus
										vitae,
										accumsan ac metus.
									</p>
									<button class="card-el__show-on-md btn-link"
											data-role="btn-info-text-custom-collapse" type="button">
										Read all
									</button>
								</div>

								<div id="cta-footer-nav"
									 class="justify-content-between align-items-center align-items-md-stretch modal-sign__md-footer-fixed">


									<div class=" mt-0 mt-md-4 w-100" data-role="choose-e-type">
										<!--SHOW THIS ON DESKTOP SCREEN-->
										<div class="d-flex align-items-center justify-content-between ">
											<button class="btn btn-primary choose__e-type card-el__hide-on-md"
													data-toggle="modal"
													data-target="#modal__e-sign__type">
												Choose e-sign type
											</button>

											<button class="btn btn-secondary btn-secondary__outline card-el__hide-on-md"
													data-role="sign"
													disabled>click to sign</span>
											</button>
										</div>
										<!--#SHOW THIS ON DESKTOP SCREEN-->

										<!--MOBILE FIXED FOOTER FOR SWITCHING BETWEEN MODALS AND TABS -->
										<!--SHOW THIS ON MOBILE SCREEN-->
										<!-- Default dropup button -->
										<div class="btn-group dropup card-el__show-on-md btn-dropup__modals">
											<button type="button" class="btn btn-primary  dropdown-toggle"
													data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Choose e-sign type
											</button>
											<div class="dropdown-menu">
												<!-- Dropdown menu links -->
												<ul class="nav nav__tabs-modal" id="pills-tab" role="tablist">
													<li class="nav-item choose__e-type"
														data-toggle="modal"
														data-target="#modal__e-sign__type"
													>
														<a class="nav-link" id="pills-draw-tab" data-toggle="pill"
														   href="#pills-home" role="tab" aria-controls="pills-home"
														   aria-selected="true">Draw it in</a>
													</li>
													<li class="nav-item choose__e-type"
														data-toggle="modal"
														data-target="#modal__e-sign__type"
													>
														<a class="nav-link hover__ltr" id="pills-type-tab"
														   data-toggle="pill"
														   href="#pills-type" role="tab" aria-controls="pills-profile"
														   aria-selected="false">Type it in</a>
													</li>
													<li class="nav-item choose__e-type"
														data-toggle="modal"
														data-target="#modal__e-sign__type"
													>
														<a class="nav-link hover__ltr" id="pills-upload-tab"
														   data-toggle="pill"
														   href="#pills-upload" role="tab" aria-controls="pills-contact"
														   aria-selected="false">Upload image</a>
													</li>
													<li class="nav-item choose__e-type"
														data-toggle="modal"
														data-target="#modal__e-sign__type"
													>
														<a class="nav-link hover__ltr"
														   id="pills-smartphone-tab"
														   data-toggle="pill"
														   href="#pills-smartphone"
														   role="tab"
														   aria-controls="pills-contact"
														   aria-selected="false"
														   data-tab="continue">Use smartphone</a>
													</li>
													<li class="nav-item choose__e-type"
														data-toggle="modal"
														data-target="#modal__e-sign__type"
													>
														<button class="nav-link hover__ltr"
																role="button"
																aria-selected="false">Saved initials
														</button>
													</li>
												</ul>
											</div>
										</div>
										<!--#SHOW THIS ON MOBILE SCREEN-->

									</div>
									<div class="card-el__hide-on-md">
										<div class="init-wrap d-none mt-0 mt-md-3" data-signature="signature-check">
											<img src="<?php echo SITEROOT; ?>images/signature.png" class="img-fluid" alt="">
										</div>
									</div>
									<div class=" sign-placeholder mt-0 mt-md-3 card-el__show-on-md">
										<button class="btn btn-secondary btn-secondary__outline"
												disabled>click to sign</span>
										</button>
									</div>
									<div class="init-wrap init-wrap__lg  d-none mt-0 mt-md-3"
										 data-signature="signature-confirmed">
										<img src="<?php echo SITEROOT; ?>images/signature.png" class="img-fluid" alt="">
										<span class="required__star " data-role="required-star"><abbr
												title="required">*</abbr></span>
									</div>
								</div>

								<div id="cta-footer-continue" class="modal-sign__md-footer-fixed d-none">
									<div class="d-flex justify-content-center mx-auto">
										<div class="d-none mt-md-5" data-role="continue-confirm">
											<button class="btn btn-secondary"
													type="submit">
												continue
											</button>
										</div>
									</div>
								</div>

								<div class="d-flex justify-content-between card-el__hide-on-md">
									<a href="" class="btn btn-primary btn-auto choose__e-type mt-100 d-none"
									   data-toggle="modal"
									   data-role="back"
									   data-target="#modal__e-sign__type">
										back
									</a>
									<div class="card-el__hide-on-md">
										<div class="sign-placeholder sign-placeholder__md p-0 text-center"
											 data-role="sign-placeholder">
											<button class="btn btn-secondary d-none mt-100" data-role="sign"
													disabled>
												click to sign <span class="required__star d-none"
																	data-role="required-star"><abbr
													title="required">*</abbr></span>
											</button>
										</div>
									</div>
								</div>

								<!--ON MOBILE SHOW SIGNATURE INSIDE MODAL BODY -->
								<div class="card-el__show-on-md">
									<div class="init-wrap d-none init-wrap__md mx-auto mx-md-0 mt-5 mb-3 mb-md-down-0 mt-0 mt-md-3 "
										 data-signature="signature-check">
										<img src="<?php echo SITEROOT; ?>images/signature.png" class="img-fluid" alt="">
									</div>
								</div>

								<div class="card-el__show-on-md">
									<div class="init-wrap init-wrap__lg  d-none mt-3 mx-auto"
										 data-signature="signature-confirmed">
										<img src="<?php echo SITEROOT; ?>images/signature.png" class="img-fluid" alt="">
										<span class="required__star " data-role="required-star"><abbr
												title="required">*</abbr></span>
									</div>
								</div>


								<!--ON MOBILE SHOW "CLICK TO SIGN SIGNATURE" BUTTON INSIDE MODAL BODY -->
								<div class="sign-placeholder sign-placeholder__md mt-3 text-center card-el__show-on-md"
									 data-role="sign-placeholder">
									<button class="btn btn-secondary d-none" data-role="sign"
											disabled>
										click to sign <span class="required__star d-none"
															data-role="required-star"><abbr
											title="required">*</abbr></span>
									</button>
								</div>

								<div class="d-flex justify-content-center card-el__hide-on-md">
									<div class=" d-none mt-3 mt-md-5" data-role="continue-confirm">
										<button class="btn btn-secondary"
												type="submit">
											continue
										</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal E-Sign Type-->
		<div class="modal modal-sign modal-sign__type fade" id="modal__e-sign__type" tabindex="-1" role="dialog"
			 aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<!--SHOW THIS ON MOBILE SCREEN-->
					<div class="modal__add-address__header__fixed card-el__show-on-md">
						<h3 class="title">
							E-sign
						</h3>
						<div class="f-1 modal-sign__close-icon-wrap text-right close close-modal" type="buttons"
							 data-dismiss="modal" aria-label="modalAddAddress">
							<img src="<?php echo SITEROOT; ?>images/close.svg" class="img-fluid" alt="">
						</div>
					</div>
					<!--#SHOW THIS ON MOBILE SCREEN-->

					<!--SHOW THIS ON DESKTOP SCREEN-->
					<div class="modal-content__header card-el__hide-on-md-el">
						<h2 class="modal-sign__header text-center">
							<button type="button"
									class="choose__e-type w-100 back btn-back"
									data-toggle="modal"
									data-role="back"
									data-target="#modal__e-sign">
								<img class="btn-back__icon" src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
								<img class="btn-back__icon" src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
								Back
							</button>
						</h2>
					</div>
					<!--#SHOW THIS ON DESKTOP SCREEN-->

					<div class="modal-body card-shadow w-100">

						<form class="modal-sign__type__form">
							<fieldset class="modal-sign__type__fieldset">
								<!--SHOW THIS ON DESKTOP SCREEN-->
								<ul class="nav mb-3 nav__tabs-modal card-el__hide-on-md" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active hover__ltr" id="pills-draw-tab" data-toggle="pill"
										   href="#pills-home" role="tab" aria-controls="pills-home"
										   aria-selected="true">Draw it in</a>
									</li>
									<li class="nav-item">
										<a class="nav-link hover__ltr" id="pills-type-tab" data-toggle="pill"
										   href="#pills-type" role="tab" aria-controls="pills-profile"
										   aria-selected="false">Type it in</a>
									</li>
									<li class="nav-item">
										<a class="nav-link hover__ltr" id="pills-upload-tab" data-toggle="pill"
										   href="#pills-upload" role="tab" aria-controls="pills-contact"
										   aria-selected="false">Upload image</a>
									</li>
									<li class="nav-item">
										<a class="nav-link hover__ltr"
										   id="pills-smartphone-tab"
										   data-toggle="pill"
										   href="#pills-smartphone"
										   role="tab"
										   aria-controls="pills-contact"
										   aria-selected="false"
										   data-tab="continue">Use smartphone</a>
									</li>
									<li class="nav-item ml-auto">
										<button class="nav-link hover__ltr"
												role="button"
												aria-selected="false">Saved initials
										</button>
									</li>
								</ul>
								<!--#SHOW THIS ON DESKTOP SCREEN-->
								<!--TABS in modal-->
								<div class="tab-content" id="pills-tabContent">
									<!-- Draw tab -->
									<div class="tab-pane fade show active" id="pills-home" role="tabpanel"
										 aria-labelledby="pills-draw-tab">
										<!--SHOW THIS ON MOBILE SCREEN-->
										<div class=" card-el__show-on-md">
											<h5 class="card-checkout__header">
												<div class="card-checkout__header__main__back-icon">
													<button type="button"
															class="choose__e-type w-100 back btn-back text-left"
															data-toggle="modal"
															data-role="back"
															data-target="#modal__e-sign"
													>
														<img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
													</button>
												</div>
												<span>Draw it in</span>
											</h5>
										</div>
										<!--#SHOW THIS ON MOBILE SCREEN-->


										<div class="tab-content__wrap">
											<h3 class="tab-content__title">
												create initials
											</h3>
											<div class="tab-content__initial-wrap initial__draw ">
												<div class="initial">
													<div class="initial__main-line">
														<div class="initial-clear__wrap">
															<img src="<?php echo SITEROOT; ?>images/close.svg" class="initial-clear" alt="">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /Draw tab -->
									<!-- Type tab -->
									<div class="tab-pane fade" id="pills-type" role="tabpanel"
										 aria-labelledby="pills-type-tab">
										<!--SHOW THIS ON MOBILE SCREEN-->
										<div class=" card-el__show-on-md">
											<h5 class="card-checkout__header">
												<div class="card-checkout__header__main__back-icon">
													<button type="button"
															class="choose__e-type w-100 back btn-back text-left"
															data-toggle="modal"
															data-role="back"
															data-target="#modal__e-sign"
													>
														<img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
													</button>
												</div>
												<span>Type it in</span>
											</h5>
										</div>
										<!--#SHOW THIS ON MOBILE SCREEN-->
										<div class="tab-content__wrap">
											<h3 class="tab-content__title">
												create initials
											</h3>
											<div class="mb-150 mb-md-down-0">
												<div class="tab-content__initial-wrap">
													<div class="initial">
														<input type="text" max="15" class="init-title input" placeholder="Your initials"/>
													</div>
												</div>
												<div class="text-center mt-4">
													<button class="btn btn-primary">
														change font
													</button>
												</div>
											</div>
										</div>
									</div>
									<!-- /Type tab -->
									<!-- Upload tab -->
									<div class="tab-pane fade" id="pills-upload" role="tabpanel"
										 aria-labelledby="pills-contact-tab">
										<!--SHOW THIS ON MOBILE SCREEN-->
										<div class=" card-el__show-on-md">
											<h5 class="card-checkout__header">
												<div class="card-checkout__header__main__back-icon">
													<button type="button"
															class="choose__e-type w-100 back btn-back text-left"
															data-toggle="modal"
															data-role="back"
															data-target="#modal__e-sign"
													>
														<img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
													</button>
												</div>
												<span>Upload image</span>
											</h5>
										</div>
										<!--#SHOW THIS ON MOBILE SCREEN-->
										<div class="tab-content__wrap">
											<h3 class="tab-content__title card-el__hide-on-md">
												create initials
											</h3>
											<div class="mb-150 mb-md-down-0">
												<p class="text text-center tab-content__title__on-md">
													Upload a picture of your initials
												</p>
												<div class="custom-file__wrap">
													<div class="custom-file custom-file__upload">
														<input type="file" class="custom-file-input" id="customFile">
														<label class="custom-file-label btn btn-primary"
															   for="customFile">
															upload
														</label>
													</div>
													<p class="custom-file-label__text"></p>
												</div>
												<p class="text-center text-small">
													Maximum file size: 40 MB <br/> Acceptable file formats: png, jpg,
													jpeg, bmp, gif
												</p>
											</div>
										</div>

									</div>
									<!-- /Upload tab -->
									<!-- Use smartphone tab -->
									<div class="tab-pane fade" id="pills-smartphone" role="tabpanel"
										 aria-labelledby="pills-contact-tab">
										<!--SHOW THIS ON MOBILE SCREEN-->
										<div class=" card-el__show-on-md">
											<h5 class="card-checkout__header">
												<div class="card-checkout__header__main__back-icon">
													<button type="button"
															class="choose__e-type w-100 back btn-back text-left"
															data-toggle="modal"
															data-role="back"
															data-target="#modal__e-sign"
													>
														<img src="<?php echo SITEROOT; ?>images/back-icon.svg" alt="">
													</button>
												</div>
												<span>Use smartphone</span>
											</h5>
										</div>
										<!--#SHOW THIS ON MOBILE SCREEN-->
										<div class="tab-content__wrap">
											<h3 class="tab-content__title card-el__hide-on-md">
												create initials
											</h3>
											<div class="mb-150 mb-md-down-0">
												<p class="text text-center tab-content__title__on-md">
													Please follow the instructions below:
												</p>
												<div class="px-4 px-md-0">
													<ul class="upload-instructions">
														<li class="text">
															1. Take photo of your initials
														</li>
														<li class="text">
															2. Email the photo to: closetstogo@email.address; Subject:
															156rt68yu
														</li>
														<li class="text">
															3. Click "Continue"
														</li>
													</ul>
												</div>

											</div>
										</div>

									</div>
									<!-- /Use smartphone tab -->
								</div>
								<!--#TABS in modal-->
								<div class="mb-md-30 mb-0 px-30">
									<p class="text-center text-small">I understand this is a legal representation of my
										initials</p>
									<div class="text-center">
										<a href="" class="btn btn-secondary tab-content__btn choose__e-type"
										   data-toggle="modal"
										   data-confirm="toggle-initialize-confirm"
										   data-target="#modal__e-sign">
											<span class="" data-btn="insert">insert</span>
											<span class="d-none" data-btn="continue">continue</span>
										</a>
									</div>
								</div>
							</fieldset>
						</form>

						<!--SHOW THIS ON MOBILE SCREEN-->
						<div class="card-el__show-on-md d-flex justify-content-between align-items-center align-items-md-stretch modal-sign__md-footer-fixed">
							<!-- Default dropup button -->
							<div class="btn-group dropup card-el__show-on-md btn-dropup__modals">
								<button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false">
									Choose e-sign type
								</button>
								<div class="dropdown-menu">
									<!-- Dropdown menu links -->
									<ul class="nav nav__tabs-modal" id="pills-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link" id="pills-draw-tab" data-toggle="pill"
											   href="#pills-home" role="tab" aria-controls="pills-home"
											   aria-selected="true">Draw it in</a>
										</li>
										<li class="nav-item">
											<a class="nav-link hover__ltr" id="pills-type-tab" data-toggle="pill"
											   href="#pills-type" role="tab" aria-controls="pills-profile"
											   aria-selected="false">Type it in</a>
										</li>
										<li class="nav-item">
											<a class="nav-link hover__ltr" id="pills-upload-tab" data-toggle="pill"
											   href="#pills-upload" role="tab" aria-controls="pills-contact"
											   aria-selected="false">Upload image</a>
										</li>
										<li class="nav-item">
											<a class="nav-link hover__ltr"
											   id="pills-smartphone-tab"
											   data-toggle="pill"
											   href="#pills-smartphone"
											   role="tab"
											   aria-controls="pills-contact"
											   aria-selected="false"
											   data-tab="continue">Use smartphone</a>
										</li>
										<li class="nav-item">
											<button class="nav-link hover__ltr"
													role="button"
													aria-selected="false">Saved initials
											</button>
										</li>
									</ul>
								</div>
							</div>
							<div class=" sign-placeholder mt-0 mt-md-3" data-role="sign-placeholder">
								<button class="btn btn-secondary btn-secondary__outline"
										disabled>click to sign</span>
								</button>
							</div>
						</div>

						<!--#SHOW THIS ON MOBILE SCREEN-->
					</div>

				</div>
			</div>
		</div>

		<!-- Modal e-sign  - "hanks for submitting" modal -->
		<div class="modal modal-sign fade" id="modal__e-sign__success" tabindex="-1" role="dialog"
			 aria-labelledby="exampleModalLabel" aria-hidden="true">

			<div class="modal-dialog " role="document">
				<!--SHOW THIS ON DESKTOP SCREEN-->
				<div class="modal-content card-el__hide-on-md">
					<div class="d-flex align-items-center justify-content-between modal-content__header">
						<div class="f-1">
							<div class="modal-sign__brand-wrap ">
								<img src="<?php echo SITEROOT; ?>images/svgg.svg" class="img-fluid" alt="">
							</div>
						</div>
						<div class="f-1">
							<h2 class="modal-sign__header text-center">
								E-sign
							</h2>
						</div>
						<div class="f-1 modal-sign__close-icon-wrap text-right close close-modal" type=""
							 data-dismiss="modal" aria-label="Close">
							<img src="<?php echo SITEROOT; ?>images/close.svg" class="img-fluid" alt="">
						</div>
					</div>
					<div class="alert alert-success mt-4">
						<div>
							<span class="alert-icon"><img src="<?php echo SITEROOT; ?>images/shield.svg" class="img-fluid" alt=""></span>
						</div>
						<h3 class="alert-title">
							thanks for submitting your document
						</h3>
						<p class="alert-text">
							you`ll receive a copy in your inbox shortly
						</p>
					</div>
				</div>
<!--#SHOW THIS ON DESKTOP SCREEN-->


<!--SHOW THIS ON MOBILE SCREEN-->
<div class="modal-content card-el__show-on-md">
<div class="modal__add-address__header__fixed">
<h3 class="title">
E-sign
</h3>
<div class="f-1 modal-sign__close-icon-wrap text-right close close-modal" type="buttons"
data-dismiss="modal" aria-label="modalAddAddress">
<img src="<?php echo SITEROOT; ?>images/close.svg" class="img-fluid" alt="">
</div>
</div>

<div class="alert-success">
<div class="row">
<div class="col-9 m-auto">
<div class="">
<span class="alert-icon">
<img src="<?php echo SITEROOT; ?>images/shield.svg" class="img-fluid" alt="">
</span>
</div>
<h3 class="alert-title mt-2">
thanks for submitting your document
</h3>
<p class="alert-text mt-3">
you`ll receive a copy in your inbox shortly
</p>
</div>
</div>
</div>

<div class="row  flex-column">
<div class="col-9 mx-auto mt-5 text-center">
<img src="<?php echo SITEROOT; ?>images/svgg.svg" class="img-fluid" alt="">
</div>
<div class="col-7 mx-auto mt-5 btn-alert-scs">
<button class="btn btn-secondary w-100 close-modal " type="button"
data-dismiss="modal" aria-label="backToCard" data-role="backToCard">
back to cart
</button>
</div>
</div>
</div>
<!--#SHOW THIS ON MOBILE SCREEN-->
</div>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>

function add_item(item_id){
	var qty = 1;
	var addMsg = "1 Item Added";
	alert("item_id "+item_id);

	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '../cart-ajax/ajax-add-item.php?item_id='+item_id+'&qty='+qty,
		success: function(data) {	
		  
		alert(data);
			
		}
	});	
}

function remove_item(item_id){	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '../cart-ajax/ajax-remove-item.php?item_id='+item_id,
		success: function(data) {
				
				//alert(data);				
				//location.reload(true);
				//setCartContent();
		}
	});	
}

function goto_checkout(){
	
	window.location.href = "checkout.html";
	
}


</script>

		
<script src="./app.js"></script>
</body>
</html>

