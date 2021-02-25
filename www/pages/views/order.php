

<?php	
require_once($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); 	
?>	

<main class="main clearfix main__order-page">
	<section class="section-checkout">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="px-0 col-lg-8 px-lg-2 text-center mt-lg-4">
						<div class="title__background__success ">
							
							<!--SHOW THIS ON MOBILE SCREEN-->
							<div class="card-el__show-on-md check-circled__header">
								<img src="../../images/check-circled.svg" alt="">
							</div>
							<!--#SHOW THIS ON MOBILE SCREEN-->
							
							<h1 class="title__background__success__title">
								congratulations
							</h1>
						</div>
						<div class="px-3">
							<p class=" page-order__title-description">
								Thank you for shopping with "Closets To Go". Your payment has been processed
								successfully. You will receive an email confirming your order shortly.
							</p>
						</div>
						<div>
							<a href="#" class="link-button">
								continue shopping
								<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
									<path id="left-arrow_3_" data-name="left-arrow(3)"
									d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
									transform="translate(0.001 -4.676)"></path>
								</svg>
							</a>
						</div>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-12 card-checkout__info__wrap">
						<div class="card card-checkout card-checkout__info">
							<div class="card-body">
								<div class="row justify-content-center">
										
										<!--SHIPPING INFORMATION-->
										<div class="col-lg-4 shipping-info__wrap">
											<h5 class="card-checkout__header">
											Shipping Information
										</h5>
										<div class="address-shipping">
											<div class="address-shipping__customer">
												<div class="form__chosen-address" data-role="toggle-el-target">
													<div class="form-group form-group__default">
														<div class="home-consult-form__radio-block">
															<div class="home-consult-form__radio">
																<div class="form-group__default__label  address-shipping__info">
																	<span class="name">Daniel Dimitrov</span>
																	,
																	<span class="tel"> +359 83404243</span>
																	<br>
																	<span class="d-block mt-2"></span>
																	<span class="street">239 Blvd.Alexander Stamboliiski</span>
																	<br>
																	<span class="city">Sofia, Razsadnika, Bulgaria, 1309 </span>
																	<span class="is-default">Default</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--#SHIPPING INFORMATION-->

									<div class="col-lg-4 info-summary__wrap">
										<h5 class="card-checkout__header">
											Payment Methods
										</h5>
										<div class="radio-image col-6 mx-auto mx-lg-0 p-lg-0">
											<div class="pay__method-wrap">
												<img src="../../images/footer-visa.png" class="img img-fluid">
											</div>
										</div>
									</div>
									<div class="col-lg-3 info-summary__wrap">
										<h5 class="card-checkout__header">
											Order Summary
										</h5>
										<div class="table-responsive">
											<table class="table table__order">
											<tbody>
											<tr>
												<td scope="row" class="text text__product-description">3
												products
												</td>
												<td class="text-right text text__product-description"></td>
												<td class="text-right text"></td>
											</tr>
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
									
									<!--SHOW THIS ON MOBILE SCREEN-->
									<div class="col-12 card-el__show-on-md">
										<div>
											<a href="#" class="link-button">
														continue shopping
														<svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623"
															 viewBox="0 0 20.8 14.623">
															<path id="left-arrow_3_" data-name="left-arrow(3)"
																  d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z"
																  transform="translate(0.001 -4.676)"></path>
														</svg>
											</a>
										</div>
									</div>
									<!-- #SHOW THIS ON MOBILE SCREEN-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php');
?>
