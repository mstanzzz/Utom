<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="account orders">
<link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
</head>
<body>

<?php	
require_once($real_root."/includes/header.php"); 	
?>	

<section class="home-mobile-buttons-block account-nav covid-block">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="home-mobile-buttons-block__wrapper">
<button class="account-nav__prev" style="display: none;">
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>
</button>
<div class="account-nav__content">
<a href="account.html" title="" class="home-mobile-buttons-block__link account-small-link">Dashboard</a>
<a href="account-settings.html" title="" class="home-mobile-buttons-block__link account-big-link">Account settings</a>
<a href="#" title="" class="home-mobile-buttons-block__link account-big-link">Start a new design</a>
<a href="account-orders.html" title="" class="home-mobile-buttons-block__link account-small-link active">My orders</a>
<a href="account-payments.html" title="" class="home-mobile-buttons-block__link account-big-link">Payment settings</a>
</div>
<button class="account-nav__next">
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
</button>
</div>
</div>
</div>
</div>
</div>
</section>


<section class="mobile-order-search covid-block">
	<div class="accordion mobile-order-search-page" id="accordion-mobile-order-search">
		<div class="card">
			<div class="card-header" id="headingMobileOne">
				<h2 class="mb-0">
					<button class="mobile-order-search-button" type="button" data-toggle="collapse" data-target="#collapseMobileOne" aria-expanded="true" aria-controls="collapseMobileOne">
						Search
						<svg xmlns="http://www.w3.org/2000/svg" width="22.113" height="22.905" viewBox="0 0 22.113 22.905"><path id="search_1_" data-name="search(1)" d="M22.761,20.862l-5.451-5.67a9.244,9.244,0,1,0-7.078,3.3,9.149,9.149,0,0,0,5.3-1.673l5.493,5.713a1.206,1.206,0,1,0,1.739-1.672ZM10.232,2.412A6.835,6.835,0,1,1,3.4,9.248,6.843,6.843,0,0,1,10.232,2.412Z" transform="translate(-0.984)" fill="#384765"/></svg>
					</button>
				</h2>
			</div>
			<div id="collapseMobileOne" class="collapse show" aria-labelledby="headingMobileOne" data-parent="#accordion-mobile-order-search">
				<div class="card-body">
					<div class="mobile-order-search__wrapper">
						<form>

						<div class="row align-items-end">
							<div class="col-12 col-lg-4 mb-3">
								<div class="form-group mobile-order-search-form-group">
									<div class="form-group">
										<label for="order-number">Order Number</label>
										<input type="text" name="order-number" placeholder="Enter order nuber" class="form-control mobile-order-search-form-input mt-2">
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4 mb-3">
								<div class="form-group mobile-order-search-form-group">
									<label for="from-date">Search order by date</label>
										<div class="row account-block__date-picker">
											<div class="col-6 mobile-from-date">
												<input type="text" name="from-date" id="mobile-my-order-from-date" placeholder="From" class="form-control mobile-order-search-form-input" readonly>
											</div>
											<div class="col-6 mobile-end-date">
												<input type="text" name="end-date" id="mobile-my-order-end-date" placeholder="To" class="form-control mobile-order-search-form-input" readonly>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-12 col-lg-4 mb-3">
									<div class="row">
										<div class="col-6">
											<div class="form-group mobile-order-search-form-group">
												<label class="home-consult-form__radio">
													<input type="radio" name="r" value="1">
													<span>Show all</span>
												</label>
											</div>
										</div>
										<div class="col-6">
											<div class="form-group mobile-order-search-form-group">		
												<label class="home-consult-form__radio">
													<input type="radio" name="r" value="2">
													<span>Last 10</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-12 text-center">
									<button type="button" class="btn btn-secondary mobile-order-search-submit mt-4 mb-4">search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
		
		
<main class="main clearfix">
			<section class="account-block">
				<div class="wrapper">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-lg-3">
								<div class="account-block__navigation--wrapper">

									<div class="account-block__navigation--user js-login-txt">
										<a href="#" title="" class="account-block__navigation--user-link">

											<span class="account-block__navigation--user-image">
												<span class="flip-front">
													<img src="<?php echo SITEROOT; ?>images/team-3.png" alt="" class="img-fluid">
												</span>
												<span class="flip-back">Edit/add<br>photo</span>
											</span>

											<span class="account-block__navigation--user-plus">
												<svg xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5"><defs><style>.add-showroom{fill:#02adb0;}</style></defs><path class="add-showroom" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.274,21.274,0,0,0,21.25,0Zm9.3,23.021H23.021v7.526a1.771,1.771,0,1,1-3.541,0V23.021H11.953a1.771,1.771,0,0,1,0-3.541h7.526V11.953a1.771,1.771,0,0,1,3.541,0v7.526h7.526a1.771,1.771,0,1,1,0,3.541Zm0,0"/></svg>
											</span>
										</a>

										<h4 class="account-block__navigation--user-heading">Hi, Joro</h4>
									</div>

									<div class="mobile-show">
										<div class="account-block__navigation--user active js-not-login-txt">
	
											<h4 class="account-block__navigation--user-heading">Login</h4>
										</div>
									</div>
									
									
			<?php	
			require_once($real_root."/includes/account_side_nav.php"); 	
			?>	
									

									
								</div>
							</div>
							<div class="col-12 col-lg-9">
								<div class="account-block__wellcome">
									<p class="account-block__wellcome--heading"><span class="wellome-txt">Welcome,</span> Super Administrator! <span>How are you today?</span></p>
									<p class="account-block__wellcome--text">
<?php 
$ts = time();
echo date("d D Y, l", $ts);
?>
									</p>
								</div>

								<div class="account-block__general-info my-orders">

									<div class="account-block__general-info--image my-orders-img">
										<p class="desktop-show">My cart</p>
										<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21.628" viewBox="0 0 21 21.628">
											<g id="Group_373" data-name="Group 373" transform="translate(-80.1 -272.056)">
												<path id="Path_213" data-name="Path 213" d="M88.264,276.655v-4.1l-7.664,5.4h5.817C87.437,277.957,88.264,277.374,88.264,276.655Z" fill="none" stroke="#384765" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"></path>
												<path id="Path_214" data-name="Path 214" d="M98.579,272.556H91.724a1.451,1.451,0,0,0-1.589,1.247l-.015,4.3a1.951,1.951,0,0,1-2.137,1.677H82.189a1.449,1.449,0,0,0-1.589,1.251v10.559a1.845,1.845,0,0,0,2.021,1.59H98.579a1.846,1.846,0,0,0,2.021-1.59V274.146A1.846,1.846,0,0,0,98.579,272.556Z" fill="none" stroke="#384765" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"></path>
											</g>
										</svg>

										<div class="account-block__general-info--details mobile-show">
											<div class="row">
												<div class="col-12"><p>My cart</p></div>
											</div>
											<div class="row mt-2">
												<div class="col-12"><p class="second-text">Super Administrator</p></div>
											</div>
											<div class="row">
												<div class="col-12"><p class="second-text">admin@admincloset.togo</p></div>
											</div>
										</div>

										<a href="#" title="" class="mobile-log-out">Log out</a>
									</div>

									<div class="account-block__general-info--details my-orders-mobile-details">
										<div class="row">
											<div class="col-4 desktop-show"><p class="first-text">Account Name:</p></div>
											<div class="col-8 desktop-show"><p class="second-text">Super Administrator</p></div>
										</div>
										<div class="row">
											<div class="col-4 desktop-show"><p class="first-text">Account Email:</p></div>
											<div class="col-8 desktop-show"><p class="second-text">admin@admincloset.togo</p></div>
										</div>
										<div class="row">
											<div class="col-5 col-lg-4"><p class="first-text">Current order:</p></div>
											<div class="col-7 col-lg-8"><p class="second-text">You have <span style="color: #FB561B;">(3)</span> product/s in your order</p></div>
										</div>
										<div class="row">
											<div class="col-5 col-lg-4"><p class="first-text">Order number:</p></div>
											<div class="col-7 col-lg-8"><p class="second-text">0002457BDR874</p></div>
										</div>
									</div>

									<div class="account-block__general-info--my-order-price">
										<div class="row">
											<div class="col-7"><p class="first-text">Sub Total:</p></div>
											<div class="col-5"><p class="second-text">$52.44</p></div>
										</div>
										<div class="row">
											<div class="col-7"><p class="first-text">Discount:</p></div>
											<div class="col-5"><p class="second-text">$0.00</p></div>
										</div>
										<div class="row">
											<div class="col-7"><p class="first-text">Tax:</p></div>
											<div class="col-5"><p class="second-text">$0.00</p></div>
										</div>
										<div class="row my-order-total">
											<div class="col-7"><p class="first-text">Price:</p></div>
											<div class="col-5"><p class="second-text">$52.44</p></div>
										</div>
									</div>

								</div>

								<div class="account-block__form my-order desktop-show">

									<h3 class="account-block__heading">My orders</h3>

									<form>
										<div class="row align-items-end">
											<div class="col-4 mb-3">
												<div class="form-group">
													<div class="form-group">
														<label for="end-date">Order Number</label>
														<input type="text" name="end-date" placeholder="Enter order nuber" class="form-control mt-2">
													</div>
												</div>
											</div>
											<div class="col-4 mb-3">
												<div class="form-group">
													<label for="from-date">Search order by date</label>
													<div class="row account-block__date-picker">
														<div class="col-6 from-date">
															<input type="text" name="from-date" id="my-order-from-date" placeholder="From" class="form-control" readonly>
														</div>

														<div class="col-6 end-date">
															<input type="text" name="end-date" id="my-order-end-date" placeholder="To" class="form-control" readonly>
														</div>
													</div>
												</div>
											</div>
											<div class="col-4 mb-3">
												<div class="form-group">
													<div class="home-consult-form__radio-block mb-2">
														<label class="home-consult-form__radio">
															<input type="radio" name="r" value="1">
															<span>Show all</span>
														</label>

														<label class="home-consult-form__radio">
															<input type="radio" name="r" value="2">
															<span>Last 10</span>
														</label>
													</div>
													
												</div>
											</div>
											<div class="col-auto">
												<button type="button" class="btn btn-primary js-show-my-orders">search</button>
												<button type="button" class="btn btn-secondary js-hide-my-orders">Clear order list</button>
											</div>
										</div>
									</form>
								</div>

								<div id="accordion" class="account-block__collapse my-orders">

									<div class="my-orders__heading-block">
										<h3 class="account-block__heading"><span style="color: #FB561B;">3</span> result/s found</h3>

										<div class="my-custom-select-wrapper">
											<div class="my-custom-select">
												<div class="my-custom-select__trigger"><span>10</span>
													<div class="arrow"></div>
												</div>
												<div class="my-custom-options">
													<span class="my-custom-option" data-value="5">5</span>
													<span class="my-custom-option selected" data-value="10">10</span>
													<span class="my-custom-option" data-value="20">20</span>
													<span class="my-custom-option" data-value="all">all</span>
												</div>
											</div>
										</div>
									</div>

									<div class="card my-order mb-2">

										<button class="account-mobile-more-info-btn my-orders-btn js-show-mobile-action-btn">
										</button>

										<div class="account-mobile-more-info-wrapper js-show-mobile-action-buttons">
											<div class="account-mobile-more-info-wrapper__mobile-more-info">
												<button class="">Print order</button>
												<button class="">Send to e-mail</button>
											</div>
										</div>

										<div class="card-header" id="headingOne">
											<div class="account-block__collapse--header collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

												<div class="row align-items-center row-with-border-bottom">
													<div class="col-12 col-lg-6">
														<p class="account-block__collapse--heading">Order: 838</p>
													</div>
													<div class="col-12 col-lg-6">
														<div class="my-orders-date-wrapper">
															<p class="account-block__collapse--date">27 May 2020, Monday / 11:35 Pm.</p>
															<div class="my-order-print-send-buttons">
																<button class="send-to-email">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234"><defs><style>.email-white{fill:#fff;}</style></defs><g transform="translate(0 -61)"><g transform="translate(0 61)"><path class="email-white" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.062l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.062Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)"/></g></g></svg>
																</button>
																<button class="print-my-order">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18.589" viewBox="0 0 20 18.589"><defs><style>.print{fill:#fff;}</style></defs><g transform="translate(0 -18.065)"><g transform="translate(0 18.065)"><g transform="translate(0 0)"><path class="print" d="M18.444,22.59H16.323V18.732a.667.667,0,0,0-.667-.667H4.343a.667.667,0,0,0-.667.667V22.59H1.556A1.557,1.557,0,0,0,0,24.146v6.707a1.557,1.557,0,0,0,1.556,1.556H3.677v3.579a.667.667,0,0,0,.667.667H15.656a.667.667,0,0,0,.667-.667V32.408h2.121A1.557,1.557,0,0,0,20,30.853V24.146A1.557,1.557,0,0,0,18.444,22.59ZM5.01,19.4h9.98V22.59H5.01ZM14.99,35.32H5.01V29.866h9.98C14.99,30.031,14.99,35.2,14.99,35.32Zm3.677-4.467a.222.222,0,0,1-.222.222H16.323V29.2a.667.667,0,0,0-.667-.667H4.344a.667.667,0,0,0-.667.667v1.876H1.556a.222.222,0,0,1-.222-.222V24.146a.222.222,0,0,1,.222-.222H18.444a.222.222,0,0,1,.222.222Z" transform="translate(0 -18.065)"/></g></g><g transform="translate(13.293 25.171)"><g transform="translate(0 0)"><path class="print" d="M342.662,199.988h-1.7a.667.667,0,1,0,0,1.333h1.7a.667.667,0,1,0,0-1.333Z" transform="translate(-340.298 -199.988)"/></g></g><g transform="translate(6.444 32.978)"><path class="print" d="M171.422,399.834h-5.778a.667.667,0,0,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -399.834)"/></g><g transform="translate(6.444 30.875)"><g transform="translate(0 0)"><path class="print" d="M171.422,346.006h-5.778a.667.667,0,1,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -346.006)"/></g></g></g></svg>
																</button>
															</div>
														</div>
													</div>
													<div class="col-12 mobile-show">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-9 desktop-show">
														<p class="account-block__collapse--heading">Products:</p>
														<p class="account-block__collapse--text">1. Hardware Resources Knob, Oil Rubbed Bronze - x2</p>
														<p class="account-block__collapse--text">2. Hafele Wire Pull, Brushed Chrome - x1</p>
														<p class="account-block__collapse--text">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze - x1</p>
													</div>
													<div class="col-12 col-lg-3 desktop-show text-right">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
														<button class="btn btn-primary js-read-button" data-readAll="Discover more" data-readLess="Discover less"><span>Discover more</span></button>
													</div>
												</div>
											</div>
										</div>
								
										<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
											
											<div class="card-body">
												<div class="account-block__collapse--block mobile-show pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-9">
															<p class="account-block__collapse--heading">Products:</p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">1. Hardware Resources Knob, Oil Rubbed Bronze</span><span class="mobile-text-quantity">x2</span></p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">2. Hafele Wire Pull, Brushed Chrome</span><span class="mobile-text-quantity">x1</span></p>
															<p class="account-block__collapse--text mobile-flex-text"><span class="mobile-text-product">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze</span><span class="mobile-text-quantity">x1</span></p>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading">Shipping address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading mobile-border-top">Billing address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billing E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billinging phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Payment Method</h4>
																
															<div class="row mt-4">
																<div class="col-4">
																	<img src="<?php echo SITEROOT; ?>images/footer-visa.png" alt="" class="img-fluid">
																</div>
																<div class="col-8">
																	<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
																	<p class="account-block__collapse--text">XXXX XXXX XXXX 1234</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Order review</h4>
														</div>
													</div>

													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-1.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price:</span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>

													<div class="row pt-3 mt-3" style="background: #E6EFFF;">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-2.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">

															<div class="row mb-2">
																<div class="col-12 col-lg-6 d-flex align-items-center">
																	<span class="you-design">you design</span>
																	<span class="e-sign-complete ml-5">
																		<svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="23.542" viewBox="0 0 19.5 23.542"><defs><style>.a{fill:#fff;}</style></defs><path class="a" d="M49.32,3.678A13.029,13.029,0,0,1,39.623,0a13.027,13.027,0,0,1-9.7,3.678c0,6.59-1.364,16.03,9.7,19.864C50.683,19.708,49.32,10.268,49.32,3.678Zm-10.5,11.6-3.23-3.231L37.036,10.6l1.784,1.784L42.21,8.991l1.446,1.446Z" transform="translate(-29.873)"/></svg>
																		e-sign complete
																	</span>
																</div>
															</div>

															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>
													
													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-3.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="card my-order mb-2">
										<button class="account-mobile-more-info-btn my-orders-btn js-show-mobile-action-btn">
										</button>

										<div class="account-mobile-more-info-wrapper js-show-mobile-action-buttons">
											<div class="account-mobile-more-info-wrapper__mobile-more-info">
												<button class="">Print order</button>
												<button class="">Send to e-mail</button>
											</div>
										</div>

										<div class="card-header" id="headingTwo">
											<div class="account-block__collapse--header collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												<div class="row align-items-center row-with-border-bottom">
													<div class="col-12 col-lg-6">
														<p class="account-block__collapse--heading">Order: 838</p>
													</div>
													<div class="col-12 col-lg-6">
														<div class="my-orders-date-wrapper">
															<p class="account-block__collapse--date">27 May 2020, Monday / 11:35 Pm.</p>
															<div class="my-order-print-send-buttons">
																<button class="send-to-email">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234"><defs><style>.email-white{fill:#fff;}</style></defs><g transform="translate(0 -61)"><g transform="translate(0 61)"><path class="email-white" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.062l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.062Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)"/></g></g></svg>
																</button>
																<button class="print-my-order">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18.589" viewBox="0 0 20 18.589"><defs><style>.print{fill:#fff;}</style></defs><g transform="translate(0 -18.065)"><g transform="translate(0 18.065)"><g transform="translate(0 0)"><path class="print" d="M18.444,22.59H16.323V18.732a.667.667,0,0,0-.667-.667H4.343a.667.667,0,0,0-.667.667V22.59H1.556A1.557,1.557,0,0,0,0,24.146v6.707a1.557,1.557,0,0,0,1.556,1.556H3.677v3.579a.667.667,0,0,0,.667.667H15.656a.667.667,0,0,0,.667-.667V32.408h2.121A1.557,1.557,0,0,0,20,30.853V24.146A1.557,1.557,0,0,0,18.444,22.59ZM5.01,19.4h9.98V22.59H5.01ZM14.99,35.32H5.01V29.866h9.98C14.99,30.031,14.99,35.2,14.99,35.32Zm3.677-4.467a.222.222,0,0,1-.222.222H16.323V29.2a.667.667,0,0,0-.667-.667H4.344a.667.667,0,0,0-.667.667v1.876H1.556a.222.222,0,0,1-.222-.222V24.146a.222.222,0,0,1,.222-.222H18.444a.222.222,0,0,1,.222.222Z" transform="translate(0 -18.065)"/></g></g><g transform="translate(13.293 25.171)"><g transform="translate(0 0)"><path class="print" d="M342.662,199.988h-1.7a.667.667,0,1,0,0,1.333h1.7a.667.667,0,1,0,0-1.333Z" transform="translate(-340.298 -199.988)"/></g></g><g transform="translate(6.444 32.978)"><path class="print" d="M171.422,399.834h-5.778a.667.667,0,0,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -399.834)"/></g><g transform="translate(6.444 30.875)"><g transform="translate(0 0)"><path class="print" d="M171.422,346.006h-5.778a.667.667,0,1,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -346.006)"/></g></g></g></svg>
																</button>
															</div>
														</div>
													</div>
													<div class="col-12 mobile-show">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-9 desktop-show">
														<p class="account-block__collapse--heading">Products:</p>
														<p class="account-block__collapse--text">1. Hardware Resources Knob, Oil Rubbed Bronze - x2</p>
														<p class="account-block__collapse--text">2. Hafele Wire Pull, Brushed Chrome - x1</p>
														<p class="account-block__collapse--text">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze - x1</p>
													</div>
													<div class="col-lg-3 desktop-show text-right">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
														<button class="btn btn-primary js-read-button" data-readAll="Discover more" data-readLess="Discover less"><span>Discover more</span></button>
													</div>
												</div>
											</div>
										</div>

										<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
											<div class="card-body">
												<div class="account-block__collapse--block mobile-show pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-9">
															<p class="account-block__collapse--heading">Products:</p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">1. Hardware Resources Knob, Oil Rubbed Bronze</span><span class="mobile-text-quantity">x2</span></p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">2. Hafele Wire Pull, Brushed Chrome</span><span class="mobile-text-quantity">x1</span></p>
															<p class="account-block__collapse--text mobile-flex-text"><span class="mobile-text-product">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze</span><span class="mobile-text-quantity">x1</span></p>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading">Shipping address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading mobile-border-top">Billing address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billing E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billinging phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Payment Method</h4>
																
															<div class="row mt-4">
																<div class="col-4">
																	<img src="<?php echo SITEROOT; ?>images/footer-visa.png" alt="" class="img-fluid">
																</div>
																<div class="col-8">
																	<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
																	<p class="account-block__collapse--text">XXXX XXXX XXXX 1234</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Order review</h4>
														</div>
													</div>

													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-1.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-showaccount-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>

													<div class="row pt-3 mt-3" style="background: #E6EFFF;">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-2.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">

															<div class="row mb-2">
																<div class="col-12 col-lg-6 d-flex align-items-center">
																	<span class="you-design">you design</span>
																	<span class="e-sign-complete ml-5">
																		<svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="23.542" viewBox="0 0 19.5 23.542"><defs><style>.a{fill:#fff;}</style></defs><path class="a" d="M49.32,3.678A13.029,13.029,0,0,1,39.623,0a13.027,13.027,0,0,1-9.7,3.678c0,6.59-1.364,16.03,9.7,19.864C50.683,19.708,49.32,10.268,49.32,3.678Zm-10.5,11.6-3.23-3.231L37.036,10.6l1.784,1.784L42.21,8.991l1.446,1.446Z" transform="translate(-29.873)"/></svg>
																		e-sign complete
																	</span>
																</div>
															</div>

															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>
														
													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-3.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="card my-order mb-2">
										<button class="account-mobile-more-info-btn my-orders-btn js-show-mobile-action-btn">
										</button>

										<div class="account-mobile-more-info-wrapper js-show-mobile-action-buttons">
											<div class="account-mobile-more-info-wrapper__mobile-more-info">
												<button class="">Print order</button>
												<button class="">Send to e-mail</button>
											</div>
										</div>

										<div class="card-header" id="headingThree">
											<div class="account-block__collapse--header collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												<div class="row align-items-center row-with-border-bottom">
													<div class="col-12 col-lg-6">
														<p class="account-block__collapse--heading">Order: 838</p>
													</div>
													<div class="col-12 col-lg-6">
														<div class="my-orders-date-wrapper">
															<p class="account-block__collapse--date">27 May 2020, Monday / 11:35 Pm.</p>
															<div class="my-order-print-send-buttons">
																<button class="send-to-email">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="15.234" viewBox="0 0 20 15.234"><defs><style>.email-white{fill:#fff;}</style></defs><g transform="translate(0 -61)"><g transform="translate(0 61)"><path class="email-white" d="M18.242,61H1.758A1.761,1.761,0,0,0,0,62.758V74.477a1.761,1.761,0,0,0,1.758,1.758H18.242A1.761,1.761,0,0,0,20,74.477V62.758A1.761,1.761,0,0,0,18.242,61ZM18,62.172l-7.962,7.962L2.006,62.172ZM1.172,74.234V62.995l5.644,5.6ZM2,75.062l5.647-5.647,1.979,1.962a.586.586,0,0,0,.827,0l1.929-1.929L18,75.062Zm16.828-.829-5.617-5.617L18.828,63Z" transform="translate(0 -61)"/></g></g></svg>
																</button>
																<button class="print-my-order">
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="18.589" viewBox="0 0 20 18.589"><defs><style>.print{fill:#fff;}</style></defs><g transform="translate(0 -18.065)"><g transform="translate(0 18.065)"><g transform="translate(0 0)"><path class="print" d="M18.444,22.59H16.323V18.732a.667.667,0,0,0-.667-.667H4.343a.667.667,0,0,0-.667.667V22.59H1.556A1.557,1.557,0,0,0,0,24.146v6.707a1.557,1.557,0,0,0,1.556,1.556H3.677v3.579a.667.667,0,0,0,.667.667H15.656a.667.667,0,0,0,.667-.667V32.408h2.121A1.557,1.557,0,0,0,20,30.853V24.146A1.557,1.557,0,0,0,18.444,22.59ZM5.01,19.4h9.98V22.59H5.01ZM14.99,35.32H5.01V29.866h9.98C14.99,30.031,14.99,35.2,14.99,35.32Zm3.677-4.467a.222.222,0,0,1-.222.222H16.323V29.2a.667.667,0,0,0-.667-.667H4.344a.667.667,0,0,0-.667.667v1.876H1.556a.222.222,0,0,1-.222-.222V24.146a.222.222,0,0,1,.222-.222H18.444a.222.222,0,0,1,.222.222Z" transform="translate(0 -18.065)"/></g></g><g transform="translate(13.293 25.171)"><g transform="translate(0 0)"><path class="print" d="M342.662,199.988h-1.7a.667.667,0,1,0,0,1.333h1.7a.667.667,0,1,0,0-1.333Z" transform="translate(-340.298 -199.988)"/></g></g><g transform="translate(6.444 32.978)"><path class="print" d="M171.422,399.834h-5.778a.667.667,0,0,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -399.834)"/></g><g transform="translate(6.444 30.875)"><g transform="translate(0 0)"><path class="print" d="M171.422,346.006h-5.778a.667.667,0,1,0,0,1.333h5.778a.667.667,0,0,0,0-1.333Z" transform="translate(-164.977 -346.006)"/></g></g></g></svg>
																</button>
															</div>
														</div>
													</div>
													<div class="col-12 mobile-show">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
													</div>
												</div>
												<div class="row">
													<div class="col-12 col-lg-9 desktop-show">
														<p class="account-block__collapse--heading">Products:</p>
														<p class="account-block__collapse--text">1. Hardware Resources Knob, Oil Rubbed Bronze - x2</p>
														<p class="account-block__collapse--text">2. Hafele Wire Pull, Brushed Chrome - x1</p>
														<p class="account-block__collapse--text">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze - x1</p>
													</div>
													<div class="col-12 col-lg-3 desktop-show text-right">
														<p class="account-block__collapse--price">Price: <span>$52.44</span></p>
														<button class="btn btn-primary js-read-button" data-readAll="Discover more" data-readLess="Discover less"><span>Discover more</span></button>
													</div>
												</div>
											</div>
										</div>

										<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
											<div class="card-body">
												<div class="account-block__collapse--block mobile-show pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-9">
															<p class="account-block__collapse--heading">Products:</p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">1. Hardware Resources Knob, Oil Rubbed Bronze</span><span class="mobile-text-quantity">x2</span></p>
															<p class="account-block__collapse--text mobile-underlined mobile-flex-text"><span class="mobile-text-product">2. Hafele Wire Pull, Brushed Chrome</span><span class="mobile-text-quantity">x1</span></p>
															<p class="account-block__collapse--text mobile-flex-text"><span class="mobile-text-product">3. Hardware Resources Somerset Arch Handle, Brushed Oil Rubbed Bronze</span><span class="mobile-text-quantity">x1</span></p>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading">Shipping address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Shipping phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
														<div class="col-12 col-lg-6">
															<h4 class="account-block__collapse--block-heading mobile-border-top">Billing address</h4>
															<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
															<p class="account-block__collapse--text">239 Blvd.Alexander Stamboliiski Sofia, Razsadnika, Bulgaria, 1309</p>

															<div class="row mt-4">
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billing E-mail</p>
																	<p class="account-block__collapse--text">email@email.email</p>
																</div>
																<div class="col-6">
																	<p class="account-block__collapse--heading">Billinging phone</p>
																	<p class="account-block__collapse--text">0123 456 789</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Payment Method</h4>
																
															<div class="row mt-4">
																<div class="col-4">
																	<img src="<?php echo SITEROOT; ?>images/footer-visa.png" alt="" class="img-fluid">
																</div>
																<div class="col-8">
																	<p class="account-block__collapse--heading">Daniel Dimitrov, +359 83404243</p>
																	<p class="account-block__collapse--text">XXXX XXXX XXXX 1234</p>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="account-block__collapse--block pt-3 pb-3">
													<div class="row">
														<div class="col-12">
															<h4 class="account-block__collapse--block-heading">Order review</h4>
														</div>
													</div>

													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-1.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>

													<div class="row pt-3 mt-3" style="background: #E6EFFF;">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-2.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">

															<div class="row mb-2">
																<div class="col-12 col-lg-6 d-flex align-items-center">
																	<span class="you-design">you design</span>
																	<span class="e-sign-complete ml-5">
																		<svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="23.542" viewBox="0 0 19.5 23.542"><defs><style>.a{fill:#fff;}</style></defs><path class="a" d="M49.32,3.678A13.029,13.029,0,0,1,39.623,0a13.027,13.027,0,0,1-9.7,3.678c0,6.59-1.364,16.03,9.7,19.864C50.683,19.708,49.32,10.268,49.32,3.678Zm-10.5,11.6-3.23-3.231L37.036,10.6l1.784,1.784L42.21,8.991l1.446,1.446Z" transform="translate(-29.873)"/></svg>
																		e-sign complete
																	</span>
																</div>
															</div>

															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
																</div>
															</div>
														</div>
													</div>
														
													<div class="row mt-3">
														<div class="col-5 col-lg-2 d-flex align-items-center">
															<img src="<?php echo SITEROOT; ?>images/my-order-3.png" alt="" class="img-fluid">
														</div>
														<div class="col-7 col-lg-10">
															<p class="account-block__collapse--heading">Hardware Resources Knob, Oil Rubbed Bronze</p>
															<p class="account-block__collapse--text desktop-show mb-2">Product Id: 000168</p>
															<p class="account-block__collapse--text desktop-show">Packaged with 1 x #8 32 x 1'' screw, Easy to install. The classic knob. Works well in offices and any closet alike. Available colors: Brushed Chrome, Oil Rubbed Bronze and Polished Chrome.</p>

															<div class="row mt-3">
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading">Unit Price: <span class="ml-1">$22.22</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Quantity: </span><span class="ml-1">x2</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="account-block__collapse--heading"><span>Price: </span><span class="ml-1" style="color: #FB561B;">$44.44</span></p>
																</div>
																<div class="col-12 col-lg-auto">
																	<p class="desktop-show account-block__collapse--heading"><img src="<?php echo SITEROOT; ?>images/icon-save.svg" alt="" class="mr-2"> Save to idea folder</p>
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
require_once($real_root.'/includes/footer.php');
?>


		<!-- Modal alert confirmation -->
		<div class="modal fade confirm-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="#confirmModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="confirmModalTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="account-block__form">
							<form>
								<div class="row mb-3">
									<div class="col-12">
										<p class="js-delete-text">Are you sure that you would like to share your Idea Folder with Closets To Go?</p>
									</div>
								</div>
								<div class="row">
									<div class="col-6">
										<button type="submit" data-dismiss="modal" class="btn btn-secondary w-100">No</button>
									</div>
									<div class="col-6">
										<button type="submit" data-dismiss="modal" class="btn btn-primary w-100">Yes</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
	
<?php
require_once($real_root.'/includes/footer.php');
?>
<script src="<?php echo SITEROOT; ?>app.js"></script>
</body>
</html>
