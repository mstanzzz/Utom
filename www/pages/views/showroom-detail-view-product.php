<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>ClosetsToGo</title>
   <meta name="description" content="Showroom detail view product">
   <link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet">
   </head>
   <body class="clearfix product-detail showroom-detail__page tooltip__a">
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
	  
      <main class="main showroom-detail-product clearfix">
         <section class="breadcrumb-block showroom-detail-page desktop-show">
            <div class="wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>" title="">Home</a></li>
								<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>showroom-detail-view-categories.html" title="">Room Gallery</a></li>
								<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>showroom-detail-view.html" title="">Master closet Organizers</a></li>
								<li class="breadcrumb-item active" aria-current="page" title="">Product</li>
							</ul>
							</div>
						</div>
					</div>
				</div>
            </div>
         </section>
         <section class="simple-block showroom-detail-product-heading">
            <div class="wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="simple-block__border no-border p-0">
							<div class="row">
								<div class="col-12">
									<div class="simple-block__heading">
										<a href="showroom-detail-view.html" title="" class="showroom-detail-product-heading-back">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
										</svg>
										</a>
										<h2 class="simple-block__heading--heading text-center">Closet Organizers: Custom-designed by you, quality-built by us.</h2>
										<a href="showroom-detail-view-categories.html" title="" class="showroom-detail-product-heading-close">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
											<g transform="translate(0 -0.001)">
												<g transform="translate(0 0.001)">
													<path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"/>
												</g>
											</g>
										</svg>
										</a>
									</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
            </div>
         </section>
         <!--			CAROUSEL SECTION-->
         <section class="two-elements-block clearfix">
            <div class="wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12 col-lg-6">
                        <div class="caro-wrap js-switch-carosel-mobile-wrap">
							<div class="showroom-detail-product__carousel image-gallery js-switch-carosel-mobile">
								<div class="embed-responsive embed-responsive-4by3">
									<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
								</div>
								

<?php
						
foreach($gallery_imgs as $val){
echo "<a href='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$val['file_name']."'>";
echo "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/wide/".$val['file_name']."' class='img-fluid'>";
echo "</a>";
}
?>								
<!--								
								
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
								<a href="<?php echo SITEROOT; ?>images/showroom-1.png" title="Lorem ipsum">
								<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid">
								</a>
							
-->
							
							</div>
							<div class="showroom-detail-product__carousel-nav">
							
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>

<?php					
foreach($gallery_imgs as $val){
echo "<div>";
echo "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/large/".$val['file_name']."' class='img-fluid prod-detail__nav-img'>";
echo "</div>";
}
?>

<!--								
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
								<div>
									<img src="<?php echo SITEROOT; ?>images/showroom-1.png" alt="" class="img-fluid prod-detail__nav-img">
								</div>
-->
								
							</div>
							<div class="row">
								<div class="col-12">
									<div class="back-to-filters-wrap showroom-detail-product__more-btn">
										<a href="#" title="" class="btn btn-primary pt-2 pb-2">back to filters</a>
										<a href="#" title="" class="btn-primary pt-2 pb-2 you-design">You design</a>
										<a href="#" title="" class="btn-primary pt-2 pb-2 we-design">We design</a>
									</div>
								</div>
							</div>
							<div class="showroom-detail-product__more-informations more-Installations">
								<p class="showroom-detail-product__more-informations--heading">Instruction and related video's</p>
								<p>Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Our custom closet organizers are the easiest to install in the nation, guaranteed!</p>
								<p>They're also constructed with high-quality, environmentally-friendly materials made right here in the United States. Carefully constructed exactly to your specifications, our closet organizers can solve a number of organizational issues, whether it be more space for kitchen storage, a new place in your garage to store seasonal items and tools or a room to showcase your exquisite fashion taste. It's easy to get started - simply click "Start Designing" below to request a complimentary closet design or try your hand at our easy-to-use online closet design software. Whatever it is you're looking for, our custom closet organizers will satisfy all your space saving and organizational needs. Experience the Closets To Go difference and see why nationwide customers are repeat customers!</p>
							</div>
                        </div>
                     </div>
                     <div class="col-12 col-lg-6">
                        <div class="row product-collapse-container">
                           <div class="col-12">
                              <div class="product-nav-wrap showroom-detail-product-nav" data-nav="showroom-detail-product-nav">
                                 <div class="product-nav-wrap__content">
                                    <button class="product-nav-wrap__prev" style="display: none;">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
										</svg>
                                    </button>
                                    <ul class="nav nav-pills product-nav" id="pills-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link product-nav__link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
										</li>
										<li class="nav-item">
											<a class="nav-link product-nav__link" id="pills-feaures-tab" data-toggle="pill" href="#pills-feaures" role="tab" aria-controls="pills-feaures" aria-selected="false">Feaures</a>
										</li>
										<li class="nav-item">
											<a class="nav-link product-nav__link" id="pills-specifications-tab" data-toggle="pill" href="#pills-specifications" role="tab" aria-controls="pills-specifications" aria-selected="false">Specs</a>
										</li>
										<li class="nav-item">
											<a class="nav-link product-nav__link" id="pills-feaures-tab" data-toggle="pill" href="#pills-feaures" role="tab" aria-controls="pills-feaures" aria-selected="false">Accessories</a>
										</li>
										<li class="nav-item">
											<a class="nav-link product-nav__link" id="pills-Installations-tab" data-more-information=".more-Installations" data-toggle="pill" href="#pills-Installations" role="tab" aria-controls="pills-Installations" aria-selected="false">Installations</a>
										</li>
										<li class="nav-item">
											<a class="nav-link product-nav__link" id="pills-features-tab" data-toggle="pill" href="#pills-features" role="tab" aria-controls="pills-features" aria-selected="false">Detail</a>
										</li>
                                    </ul>
                                    <button class="product-nav-wrap__next" style="display: flex;">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
										</svg>
                                    </button>
                                 </div>
                              </div>
                              <div class="tab-content product-tab-content showroom-detail-product-tab-content" id="pills-tabContent" data-target="pills-tabContent">
                                 <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                    <div class="tab-content__text-wrap js-text-wrap">
										<p class="tab-content__text-wrap--title">
											Closet organizers skillfully crafted with superior quality materials at affordable prices. Guaranteed easy install and ships free.
										</p>
                                       <div class="tab-content__text-wrap--content js-hidden-text small-text">
											<p class="tab-content__text-wrap--text">
												Closet organizers are the ultimate do it yourself project. They not only make your life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble. From our easy-to-adjust hanging bracket to the pre-assembly of all your hardware fittings and labeled panels, we've virtually made reading instructions a thing of the past. Carefully constructed exactly to your specifications, our closet organizers can solve a number of organizational issues, whether it be more space for kitchen storage, a new place in your garage to store seasonal items and tools or a room to showcase your exquisite fashion taste. It's easy to get started - simply click "Start Designing" below to request a complimentary closet design or try your hand at our easy-to-use online closet design software. Whatever it is you're looking for, our custom closet organizers will satisfy all your space saving and organizational needs. Experience the Closets To Go difference and see why nationwide customers are repeat customers!
											</p>
                                       </div>
                                    </div>
                                    <button data-readall="Explore more" data-readless="Explore less" class="product-tab-content__link mt-2 p-0 mb-0 js-btn-read-all-text">
                                    <span>Explore more</span>
                                    </button>
                                    <div class="you-we-design-buttons">
										<div class="product-purchase__buttons">
											<button class="product-purchase__buttons--share">
												<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
													<defs>
													<style>.share-no-background{fill:#384765;}</style>
													</defs>
													<g transform="translate(0)">
													<path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"></path>
													<path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"></path>
													<path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"></path>
													<path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"></path>
													<path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"></path>
													<path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"></path>
													<path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"></path>
													<path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"></path>
													</g>
												</svg>
											</button>
											<button class="product-purchase__buttons--idea-folder">
												<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="25.6" height="23.023" viewBox="0 0 25.6 23.023">
													<path id="Path_205" data-name="Path 205" d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z" transform="translate(0 -0.963)" fill="#00fbff"></path>
													<path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" transform="translate(13.1 24)" fill="#00fbff"></path>
												</svg>
											</button>
											<button class="product-purchase__buttons--pdf">
											PDF
											</button>
										</div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="pills-feaures" role="tabpanel" aria-labelledby="pills-feaures-tab">
                                    <div class="tab-feaures--wrapper">
										<div class="row">
											<div class="row">
												<div class="col-12 col-lg-6">
													<div class="first-fixed-block__text-group--items">
														<img src="<?php echo SITEROOT; ?>images/package.svg" alt="">
														<div class="first-fixed-block__text-group--text">
															<p>2K 457</p>
														</div>
													</div>
													<p class="text__SDI-nd">Successful DIY Installations</p>
												</div>
												<div class="col-12 col-lg-6">
													<div class="block-stars__wrapper a__">
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
											</div>
											<div class="row row_nd">
												<div class="col-12 js-specifications-subheading">
													<p class="tab-content__specifications--subheading tab-features__selection-detail">
													Feature selection/detail
													<img class="tab-content__specifications--subheading-icon-plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
													<img class="tab-content__specifications--subheading-icon-minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
													</p>
												</div>
												<div class="col-12 col-12__nd__a">
													<div class="row row-with-desctop-border-bottom__nd">
													<div class="col-12">
														<div class="tab-content__specifications--images-block features-block">
															<p class="tab-content__text-wrap--text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.</p>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box red__hover js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																<span class="red__box-hover-eye">
																	<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																		<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																	</svg>
																</span>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
														</div>
														<div class="tab-content__specifications--images-block features-block">
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
															<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
																<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																	<g id="Group_394" data-name="Group 394">
																		<g id="Group_393" data-name="Group 393">
																			<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																			<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																			<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																		</g>
																	</g>
																</svg>
																</span>
															</div>
														</div>
														<p class="tab-content__text-wrap--text__italic">
															<svg xmlns="http://www.w3.org/2000/svg" width="27.00" height="16.375" viewBox="0 0 27.47 16.375">
																<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
															</svg>
															<i>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.</i>
														</p>
														<!-- from features-detail -->
														<div class="parent_romb">
															<span class="romb"></span>
														</div>
														<div class="card-feature tab--feaures_nd" data-select="feature-item">
															<div class="titles">
																<p class="card-feature__title nd">
																	Lorem ipsum dolor sit amet, dipscing
																</p>
																<p class="card-feature__title-sub nd">
																	Current Simple name selected
																</p>
															</div>
															
															<div class="icons-f__p__s">
																<div class="product-purchase__buttons">
																	<span class="plus__hover"><span>+</span></span>
																	<button class="product-purchase__buttons--idea-folder a__">
																		<svg id="unun" xmlns="http://www.w3.org/2000/svg" width="33.398" height="33.33" viewBox="0 0 33.398 33.33">
																			<circle id="Ellipse_23" data-name="Ellipse 23" cx="16.5" cy="16.5" r="16.5" fill="#fff"/>
																			<g id="Group_597" data-name="Group 597" transform="translate(0.068)">
																			  <path id="Path_434" data-name="Path 434" d="M94.586,100.138H87.051l-1.985-1.8H81.683a.47.47,0,0,0-.469.469v11.522a.47.47,0,0,0,.469.469h.356l1.871-9.631H95.055v-.558A.47.47,0,0,0,94.586,100.138Z" transform="translate(-71.859 -87.074)" fill="#18c4c7"/>
																			  <path id="Path_435" data-name="Path 435" d="M16.666,0A16.665,16.665,0,1,0,33.331,16.665,16.665,16.665,0,0,0,16.666,0Zm8.582,23.633a2.221,2.221,0,0,1-2.149,2.1c-.011,0-.022,0-.033,0H9.516A2.224,2.224,0,0,1,7.3,23.517v-12.1A2.224,2.224,0,0,1,9.517,9.2h4.219l2.084,1.892h7.245a2.224,2.224,0,0,1,2.221,2.222V13.9h1.989Z" transform="translate(-0.001)" fill="#18c4c7"/>
																			</g>
																			<circle id="Ellipse_25" fill="#18c4c7" data-name="Ellipse 25" cx="6" cy="6" r="6" transform="translate(16 17)" fill="#18c4c7"/>
																			<path id="Path_2319" fill="#fff" data-name="Path 2319" d="M10.089-5.794H7.02v3.069H5.409V-5.794H2.324V-7.413H5.409V-10.5H7.02v3.085h3.069Z" transform="translate(16.08 29.904)" fill="#fff"/>
																		</svg>	
																	 </button>
																	 <span class="plus__hover"><span>+</span></span>
																	 <button class="product-purchase__buttons--idea-folder">
																		<svg id="Save" xmlns="http://www.w3.org/2000/svg" width="25.6" height="23.023" viewBox="0 0 25.6 23.023">
																		   <path id="Path_205" data-name="Path 205" d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z" transform="translate(0 -0.963)" fill="#00fbff"></path>
																		   <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" transform="translate(13.1 24)" fill="#00fbff"></path>
																		</svg>
																	 </button>
																	 
																	 <div class="icons icon-share__circle- icon-share__circle__gray nd">
																		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 23.547 25.688">
																			<defs>
																				<style>.share-white {
																					fill: #fff;
																				}</style>
																			</defs>
																			<g transform="translate(0)">
																				<path class="share-white" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"></path>
																				<path class="share-white" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"></path>
																				<path class="share-white" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"></path>
																				<path class="share-white" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"></path>
																				<path class="share-white" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"></path>
																				<path class="share-white" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"></path>
																				<path class="share-white" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"></path>
																				<path class="share-white" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"></path>
																			</g>
																		</svg>
																	</div>
																	
																 </div>
															</div>
															
															<div class="card-feature__img a__" data-feature="replace-image">
																<img src="<?php echo SITEROOT; ?>images/showroom-detail-view-product.png" class="img-fluid" alt="showroom-detail-view-product">
															</div>
															<div class="phantom-actions__dropdowns__a">
																<!--MENU WITH ADDITIONAL FEATURES,
																EVERY ROW HAS A COLLAPSE DIV SIBLING,
																WHEN YOU CLICK A ITEM FROM DIV, A COLLAPSE MENU IS SHOWING
																YOU CAN HAVE A MULTIPLE COLLAPSE MENUS FOR EVERY ITEM
																OR ONE COLLAPSE DIV AND REPLACE ITEMS INSIDE DEPENDS ON
																WHICH ITEM USER CLICKS
																-->
																<div class="phantom-actions__dropdowns accordion active nd"
																	 id="collapseFeature-parent-2">
																	<div class="row margin-none">
																		<div class="col-2 feature-product__item-image a__simple">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"				
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name"																																				 >
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image drop_detail__items dropdown-one">
																			<div class="feature-detail__item-drop"
																				 title="Simple name"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				
																				<button class="feature-detail__item-drop__show-more hover-btn__v2 "
																						data-toggle="collapse"
																						data-target="#collapseFeature-11"
																						aria-expanded="true"
																						aria-controls="collapseFeature-11">
																				<svg xmlns="http://www.w3.org/2000/svg" width="3.726" height="6.536" viewBox="0 0 3.726 6.536"><defs><style>.a{fill:#fff;}</style></defs><g transform="translate(0 6.536) rotate(-90)"><path class="a" d="M3.268,3.726a.456.456,0,0,1-.324-.134L.134.781A.458.458,0,0,1,.781.134L3.268,2.621,5.755.134A.458.458,0,0,1,6.4.781L3.592,3.592A.456.456,0,0,1,3.268,3.726g></svg>
																				</button>
																				
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		
																		<div id="collapseFeature-11" class="collapse show border-nd_hove_nd collapseFeature-opacity_class"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row first_z-index">
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop selected-item-box" data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																		</div>
																	</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		<div class="col-2 feature-product__item-image">
																			<div class="feature-detail__item-drop"
																				 data-feature="feature-item"
																				 data-container="#collapseFeature-parent-2"
																				 data-toggle="tooltip" data-container="body" data-placement="top" title="Simple name">
																				<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																				<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																			</div>
																		</div>
																		
																	</div>
																	
																	<!--COLLAPSABLE ITEMS ARE PLACED RIGHT BEFORE ROW, -->
																	<!--WHERE THERE TRIGGER BUTTONS ARE-->
																	
																	<div id="collapseFeature-12" class="border-nd_hove_nd collapseFeature-opacity_class collapse show border-nd_hove_nd"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div id="collapseFeature-13" class="border-nd_hove_nd collapseFeature-opacity_class collapse show border-nd_hove_nd"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																			<div class="col-2 feature-product__item-image">
																				<div class="feature-detail__item-drop" data-feature="feature-item" data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/lock_product-thumb.png" class="img-fluid selected-item-border" alt="">
																					<span class="eye_top-right__selected">
																					<svg xmlns="http://www.w3.org/2000/svg" width="22.47" height="16.375" viewBox="0 0 27.47 16.375">
																						<path id="dewfew" d="M13.735,98.725c-5.248,0-10.008,2.871-13.52,7.535a1.087,1.087,0,0,0,0,1.3c3.512,4.67,8.272,7.541,13.52,7.541s10.008-2.871,13.52-7.535a1.087,1.087,0,0,0,0-1.3C23.743,101.6,18.983,98.725,13.735,98.725Zm.376,13.953a5.778,5.778,0,1,1,5.389-5.389A5.781,5.781,0,0,1,14.111,112.678Zm-.174-2.664a3.111,3.111,0,1,1,2.905-2.905A3.106,3.106,0,0,1,13.937,110.014Z" transform="translate(0 -98.725)" fill="#384765"/>
																					</svg>
																				</span>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div id="collapseFeature-22" class="collapse show"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div id="collapseFeature-33" class="collapse show"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-3.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-3.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-3.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-3.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																		</div>
																	</div>
																	<div id="collapseFeature-44" class="collapse show"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name" title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																		</div>
																	</div>
																	
																	<div id="collapseFeature-55" class="collapse show"
																			aria-labelledby="headingOne"
																			title="Second Simple name">
																		<div class="row">
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																		</div>
																	</div>
																	<div id="collapseFeature-66" class="collapse show"
																			aria-labelledby="headingOne"
																			data-parent="#collapseFeature-parent-2">
																		<div class="row">
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																			<div class="col-3">
																				<div class="feature-detail__item-drop"
																					 data-feature="feature-item"
																					 data-toggle="tooltip" data-placement="top"
																					 title="Second Simple name"
																					 data-container="#collapseFeature-parent-2">
																					<img src="<?php echo SITEROOT; ?>images/door_lock-2.png"
																						 class="img-fluid"
																						 alt="">
					
																				</div>
																			</div>
																		</div>
																	</div>
																	<!--COLLAPSABLE ITEMS ARE PLACED RIGHT BEFORE ROW, -->
																	<!--WHERE THERE TRIGGER BUTTONS ARE-->
																</div>
																<!-- /MENU WITH ADDITIONAL FEATURES-->
															</div>
														</div>
														<!-- off -->
													</div>
													<div class="col-12">
														<div class="tab-content__specifications--description-wrap active"
															id="sizes">
														</div>
														<div class="tab-content__specifications--description-wrap"
															id="colors">
															<p class="first-footer__heading mb-3">Colors</p>
														</div>
														<div class="tab-content__specifications--description-wrap"
															id="materials">
															<p class="first-footer__heading mb-3">Materials</p>
														</div>
														<div class="tab-content__specifications--description-wrap"
															id="useful-tips">
															<p class="first-footer__heading mb-3">usefull tips</p>
														</div>
														<div class="tab-content__specifications--description-wrap"
															id="useful-links">
															<p class="first-footer__heading mb-3">useful links</p>
														</div>
													</div>
													</div>
												</div>
											</div>
											<div class="row tab-viideo--wrapper">
												<div class="col-12 js-specifications-subheading">
													<p class="tab-content__specifications--subheading tab-video__selection-detail">
													Videos
													<img class="tab-content__specifications--subheading-icon-plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
													<img class="tab-content__specifications--subheading-icon-minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
													</p>
												</div>
												<div class="col-12 a__padding-nd">
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
													<div class="col-lg-4 showroom-detail-product-col-lg mw_">
													<div class="showroom-detail-product-video">
														<div class="embed-responsive embed-responsive-4by3">
															<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
														</div>
													</div>
													</div>
												</div>
											</div>
										</div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade specs_content" id="pills-specifications" role="tabpanel" aria-labelledby="pills-specifications-tab">
                                    <div class="tab-content__">
										<div class="row">
											<div class="col-12 col-lg-6">
												<div class="first-fixed-block__text-group--items">
													<img src="<?php echo SITEROOT; ?>images/package.svg" alt="">
													<div class="first-fixed-block__text-group--text">
														<p>2K 457</p>
													</div>
												</div>
												<p class="text__SDI-nd">Successful DIY Installations</p>
											</div>
											<div class="col-12 col-lg-6">
												<div class="block-stars__wrapper a__">
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
										</div>
                                      
										<div class="row">
											<div class="col-12 js-specifications-subheading">
												<p class="tab-content__specifications--subheading">
													Description
													<img class="tab-content__specifications--subheading-icon-plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
													<img class="tab-content__specifications--subheading-icon-minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
												</p>
											</div>
											<div class="col-12">
												<p class="showroom-detail-product-images-block__text"><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit nisl sit amet posuere scelerisque.</b></p>
												<p class="tab-content__text-wrap--text font-futurica">Morbi eu velit facilisis, sodales sapien non, sagittis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse vel enim sit amet sem pretium sollicitudin sed vel lorem.Praesent aliquam euismod leo. Aenean aliquet nunc arcu, at dapibus justo congue vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
											</div>
										</div>
										<div class="row">
											<div class="col-12 js-specifications-subheading">
												<p class="tab-content__specifications--subheading tab-features__selection-detail">
													Specification Details
													<img class="tab-content__specifications--subheading-icon-plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
													<img class="tab-content__specifications--subheading-icon-minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
												</p>
											</div>
											<div class="col-12">
												<div class="row-with-desctop-border-bottom__nd">
													<div class="col-12">
													<div class="tab-content__specifications--images-block features-block">
														<p class="tab-content__text-wrap--text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut</p>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box red__hover js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
													</div>
													<div class="tab-content__specifications--images-block features-block">
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
														<div class="col-1 image-group__box js-open-specifications-tab-btn" data-toggle="tooltip" data-placement="top" data-open-description="#sizes">
															<span class="" data-toggle="tooltip" data-placement="top" title="Simple name">
																<svg id="size" xmlns="http://www.w3.org/2000/svg" width="41" height="41" viewBox="0 0 41 41">
																<g id="Group_394" data-name="Group 394">
																	<g id="Group_393" data-name="Group 393">
																		<path id="Path_182" data-name="Path 182" d="M3.417,256H0v13.667H13.667V266.25H3.417Z" transform="translate(0 -228.667)"></path>
																		<path id="Path_183" data-name="Path 183" d="M256,0V3.417h10.25v10.25h3.417V0Z" transform="translate(-228.667)"></path>
																		<rect id="Rectangle_58" data-name="Rectangle 58" width="3.417" height="37.24" transform="translate(8.541 34.874) rotate(-135)"></rect>
																	</g>
																</g>
																</svg>
															</span>
														</div>
													</div>
													</div>
													<div class="col-12 bg-nd__tab-specifications-detail-img">
														<div class="tab-content__specifications--description-wrap active"
															id="sizes">
															<div class="wrap-content d-flex flex-wrap">
																<div class="parent_romb">
																	<span class="romb"></span>
																</div>
																<div class="tab-content__specifications--description-content">
																	<img src="<?php echo SITEROOT; ?>images/specification-description-1.png" alt="" class="img-fluid">
																	<div class="tab-content__specifications--description-text">
																	<p class="heading">Drawer Openings</p>
																	<p>
																		<span>30" w/ full ext. slides</span>
																		<span>39" on hutches</span>
																	</p>
																	</div>
																</div>
																<div class="tab-content__specifications--description-content">
																	<img src="<?php echo SITEROOT; ?>images/specification-description-2.png" alt="" class="img-fluid">
																	<div class="tab-content__specifications--description-text">
																	<p class="heading">Drawer Widths</p>
																	<p>
																		<span>21" - 24" - 27"</span>
																		<span>30" - 32" - 36"</span>
																	</p>
																	</div>
																</div>
																<div class="tab-content__specifications--description-content">
																	<img src="<?php echo SITEROOT; ?>images/specification-description-3.png" alt="" class="img-fluid">
																	<div class="tab-content__specifications--description-text">
																	<p class="heading">Drawer Face Heights</p>
																	<p>
																		<span>5" - 7.5" - 6.25"</span>
																		<span>10" - 12.5"</span>
																	</p>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="pdf_download-section__box__a">
														<div class="pdf_download-section">
															<a href="#">
																<button class="product-purchase__buttons--pdf">
																PDF 
																</button>Download Instructions
															</a>
														</div>
														<div class="pdf_download-section">
															<a href="#">
																<button class="product-purchase__buttons--pdf">
																PDF 
																</button>Download Instructions 2
															</a>
														</div>
														<div class="pdf_download-section nd__style">
															<a href="#">
																<button class="product-purchase__buttons--pdf">
																PDF 
																</button>Download Instructions 3
															</a>
														</div>
														<div class="pdf_download-section nd__style">
															<a href="#">
																<button class="product-purchase__buttons--pdf">
																PDF 
																</button>Download Instructions 4
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row tab-viideo--wrapper">
											<div class="col-12 js-specifications-subheading">
												<p class="tab-content__specifications--subheading tab-video__selection-detail">
												Videos
												<img class="tab-content__specifications--subheading-icon-plus" src="<?php echo SITEROOT; ?>images/minus-button-1.svg" alt="">
												<img class="tab-content__specifications--subheading-icon-minus" src="<?php echo SITEROOT; ?>images/minus-button.svg" alt="">
												</p>
											</div>
											<div class="col-12 a__padding-nd">
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
												<div class="col-lg-4 showroom-detail-product-col-lg mw_">
												<div class="showroom-detail-product-video">
													<div class="embed-responsive embed-responsive-4by3">
														<iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
													</div>
												</div>
												</div>
											</div>
										</div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="pills-Installations" role="tabpanel" aria-labelledby="pills-Installations-tab">
                                    <div class="row row-with-desctop-border-bottom">
										<div class="col-12 col-lg-6">
											<div class="first-fixed-block__text-group--items">
												<img src="<?php echo SITEROOT; ?>images/package.svg" alt="">
												<div class="first-fixed-block__text-group--text">
													<p>2K 457</p>
												</div>
											</div>
											<p class="text__SDI-nd">Successful DIY Installations</p>
										</div>
										<div class="col-12 col-lg-6">
												<div class="block-stars__wrapper a__">
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
                                    </div>
                                    <div class="row">
                                       <div class="col-12 mobile-show text-center js-acordeon-scroll-position">
                                          <button class="product-dyi-installer__heading-button">
                                             Instructions
                                             <svg xmlns="http://www.w3.org/2000/svg" width="28.704" height="23.92" viewBox="0 0 28.704 23.92">
                                                <g id="direct-download" transform="translate(0 -2)">
                                                   <path id="Path_441" data-name="Path 441" d="M13.176,18.744a.9.9,0,0,1-.648-.277L6.249,11.889A.9.9,0,0,1,6.9,10.372h3.289V3.5a1.5,1.5,0,0,1,1.5-1.5h2.99a1.5,1.5,0,0,1,1.5,1.5v6.877h3.289a.9.9,0,0,1,.648,1.517l-6.279,6.578A.9.9,0,0,1,13.176,18.744Z" transform="translate(1.176)" fill="#db440d"/>
                                                   <path id="Path_442" data-name="Path 442" d="M26.611,22.784H2.093A2.1,2.1,0,0,1,0,20.691v-.6A2.1,2.1,0,0,1,2.093,18H26.611A2.1,2.1,0,0,1,28.7,20.093v.6A2.1,2.1,0,0,1,26.611,22.784Z" transform="translate(0 3.136)" fill="#db440d"/>
                                                </g>
                                             </svg>
                                          </button>
                                       </div>
                                    </div>
                                    <div class="product-dyi-installer mt-2">
										<div class="row">
											<div class="col-12">
												<div class="row row-with-mobile-border-bottom row-with-mobile-top-bottom">
													<div class="col-12 col-lg-6">
													<p class="product-dyi-installer__heading js-show-hiden-installations-btn">DIY installer</p>
													</div>
													<div class="col-lg-6 desktop-show text-right">
													<button class="product-dyi-installer__heading-button">
														Instructions
														<svg xmlns="http://www.w3.org/2000/svg" width="28.704" height="23.92" viewBox="0 0 28.704 23.92">
															<g id="direct-download" transform="translate(0 -2)">
																<path id="Path_441" data-name="Path 441" d="M13.176,18.744a.9.9,0,0,1-.648-.277L6.249,11.889A.9.9,0,0,1,6.9,10.372h3.289V3.5a1.5,1.5,0,0,1,1.5-1.5h2.99a1.5,1.5,0,0,1,1.5,1.5v6.877h3.289a.9.9,0,0,1,.648,1.517l-6.279,6.578A.9.9,0,0,1,13.176,18.744Z" transform="translate(1.176)" fill="#db440d"/>
																<path id="Path_442" data-name="Path 442" d="M26.611,22.784H2.093A2.1,2.1,0,0,1,0,20.691v-.6A2.1,2.1,0,0,1,2.093,18H26.611A2.1,2.1,0,0,1,28.7,20.093v.6A2.1,2.1,0,0,1,26.611,22.784Z" transform="translate(0 3.136)" fill="#db440d"/>
															</g>
														</svg>
													</button>
													</div>
												</div>
												<div class="row">
													<div class="col-12 js-show-hiden-installations">
													<div class="row">
														<div class="col-12">
															<p class="product-dyi-installer__text need-hours">
																<svg xmlns="http://www.w3.org/2000/svg" width="23.797" height="22" viewBox="0 0 23.797 22">
																<g id="passage-of-time" transform="translate(0 -1.775)">
																	<g id="Layer_1_65_" transform="translate(0 1.775)">
																		<g id="Group_335" data-name="Group 335">
																			<path id="Path_182" data-name="Path 182" d="M23.75,11.063a.5.5,0,0,0-.454-.288H21.814a10.992,10.992,0,1,0-1.287,7.5,1,1,0,0,0-1.731-1,9.009,9.009,0,1,1,.972-6.5H18.3a.5.5,0,0,0-.385.82l2.5,3a.5.5,0,0,0,.768,0l2.5-3A.5.5,0,0,0,23.75,11.063Z" transform="translate(0 -1.775)" fill="#edb700"/>
																			<path id="Path_183" data-name="Path 183" d="M20.02,6.713a1,1,0,0,0-1,1v6.068a1.748,1.748,0,0,0,1,3.183,1.728,1.728,0,0,0,.738-.169L24.237,18.8a.989.989,0,0,0,.5.135,1,1,0,0,0,.5-1.866l-3.482-2.011a1.742,1.742,0,0,0-.734-1.279V7.713A1,1,0,0,0,20.02,6.713Zm0,9.25a.75.75,0,1,1,.75-.749A.751.751,0,0,1,20.02,15.963Z" transform="translate(-9.02 -4.213)" fill="#edb700"/>
																		</g>
																	</g>
																</g>
																</svg>
																Just 4-6 hours to install a 10 x 10 closet.
															</p>
														</div>
														<div class="col-12">
															<p class="product-dyi-installer__text perfect-fit">
																<svg id="security" xmlns="http://www.w3.org/2000/svg" width="15.756" height="18.752" viewBox="0 0 15.756 18.752">
																<path fill="#384765" id="Path_21" data-name="Path 21" d="M32.848,4.829c-.01-.506-.019-.985-.019-1.447a.656.656,0,0,0-.656-.656A9.05,9.05,0,0,1,25.447.186a.656.656,0,0,0-.915,0,9.048,9.048,0,0,1-6.725,2.539.656.656,0,0,0-.656.656c0,.463-.009.941-.019,1.448-.09,4.711-.213,11.164,7.643,13.887a.656.656,0,0,0,.43,0C33.061,15.993,32.938,9.54,32.848,4.829ZM24.99,17.4c-6.737-2.447-6.636-7.809-6.545-12.545.005-.284.011-.56.014-.83A10.121,10.121,0,0,0,24.99,1.549a10.123,10.123,0,0,0,6.531,2.475c0,.27.009.545.014.829C31.626,9.59,31.728,14.951,24.99,17.4Z" transform="translate(-17.112 0)"/>
																<path fill="#384765" id="Path_22" data-name="Path 22" d="M74.149,79.078l-3.168,3.168L69.63,80.894a.656.656,0,0,0-.928.928l1.816,1.816a.656.656,0,0,0,.928,0l3.632-3.632a.656.656,0,0,0-.928-.928Z" transform="translate(-64.011 -71.982)"/>
																</svg>
																100% Perfect Fit Guarantee
															</p>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<div class="product-dyi-installer__small-images-boxes">
																<div class="d-flex">
																<div class="product-dyi-installer__small-images-box yellow">
																	<svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
																		<g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
																			<path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
																			<path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
																			<path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
																		</g>
																	</svg>
																</div>
																<div class="product-dyi-installer__small-images-box yellow">
																	<svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
																		<g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
																			<path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
																			<path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
																			<path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
																		</g>
																	</svg>
																</div>
																<div class="product-dyi-installer__small-images-box">
																	<svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
																		<g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
																			<path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
																			<path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
																			<path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
																		</g>
																	</svg>
																</div>
																<div class="product-dyi-installer__small-images-box">
																	<svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
																		<g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
																			<path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
																			<path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
																			<path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
																		</g>
																	</svg>
																</div>
																</div>
																<p class="product-dyi-installer__text">Middle degree of difficulty</p>
															</div>
														</div>
													</div>
													<div class="row row-with-mobile-top-bottom">
														<div class="col-12">
															<p class="product-dyi-installer__heading mobile-bold">Tools required to complete the installation</p>
														</div>
													</div>
													<div class="row row-with-mobile-border-bottom">
														<div class="col-12">
															<div class="product-dyi-installer__big-images-boxes">
																<div class="product-dyi-installer__big-images-box multimeter">
																<svg xmlns="http://www.w3.org/2000/svg" width="35.984" height="63.665" viewBox="0 0 35.984 63.665">
																	<g id="multimeter" transform="translate(-111.309)">
																		<path id="Path_455" data-name="Path 455" d="M139.914,0H118.687a7.37,7.37,0,0,0-7.378,7.345V27.976a9.376,9.376,0,0,0,1.476,5.053,5.653,5.653,0,0,1,.89,3.046V50.886a12.827,12.827,0,0,0,12.846,12.779h5.559a12.827,12.827,0,0,0,12.846-12.779V36.074a5.653,5.653,0,0,1,.89-3.046,9.376,9.376,0,0,0,1.476-5.053V7.345A7.37,7.37,0,0,0,139.914,0Zm3.648,27.976a5.652,5.652,0,0,1-.89,3.046,9.377,9.377,0,0,0-1.476,5.053V50.886a9.093,9.093,0,0,1-9.115,9.049h-5.559a9.093,9.093,0,0,1-9.115-9.049V36.074a9.377,9.377,0,0,0-1.476-5.053,5.652,5.652,0,0,1-.89-3.046V7.345a3.636,3.636,0,0,1,3.648-3.615h21.227a3.636,3.636,0,0,1,3.648,3.615V27.976Z"/>
																		<path id="Path_456" data-name="Path 456" d="M190.506,60.974H173.174a1.865,1.865,0,0,0-1.865,1.865v9.679a1.865,1.865,0,0,0,1.865,1.865h17.332a1.865,1.865,0,0,0,1.865-1.865V62.839A1.865,1.865,0,0,0,190.506,60.974Zm-1.865,9.679h-13.6V64.7h13.6Z" transform="translate(-52.539 -53.392)"/>
																		<path id="Path_457" data-name="Path 457" d="M175.784,202.544a1.865,1.865,0,0,0,0-3.73h-2.61a1.865,1.865,0,0,0,0,3.73Z" transform="translate(-52.539 -174.092)"/>
																		<path id="Path_458" data-name="Path 458" d="M193.849,263.957a8.826,8.826,0,1,0,8.826,8.826A8.836,8.836,0,0,0,193.849,263.957Zm0,13.921a5.1,5.1,0,1,1,5.1-5.1,5.1,5.1,0,0,1-5.1,5.1Z" transform="translate(-64.548 -231.135)"/>
																		<circle id="Ellipse_16" data-name="Ellipse 16" cx="1.865" cy="1.865" r="1.865" transform="translate(123.705 53.15)"/>
																		<circle id="Ellipse_17" data-name="Ellipse 17" cx="1.865" cy="1.865" r="1.865" transform="translate(131.166 53.15)"/>
																	</g>
																</svg>
																</div>
																<div class="product-dyi-installer__big-images-box measuring-tape">
																<svg xmlns="http://www.w3.org/2000/svg" width="76.271" height="63.665" viewBox="0 0 76.271 63.665">
																	<g id="measuring-tape" transform="translate(-0.001 0)">
																		<path id="Path_451" data-name="Path 451" d="M107.856,103.98a7.137,7.137,0,1,0,7.136,7.137A7.145,7.145,0,0,0,107.856,103.98Zm0,12.039a4.9,4.9,0,1,1,4.9-4.9A4.908,4.908,0,0,1,107.856,116.019Zm0,0" transform="translate(-85.714 -88.491)"/>
																		<path id="Path_452" data-name="Path 452" d="M74.33,64.586a13.005,13.005,0,1,0,13,13.005A13.02,13.02,0,0,0,74.33,64.586Zm0,23.776A10.771,10.771,0,1,1,85.1,77.591,10.783,10.783,0,0,1,74.33,88.362Zm0,0" transform="translate(-52.188 -54.965)"/>
																		<path id="Path_453" data-name="Path 453" d="M208.094,218.514a4.127,4.127,0,1,0,4.127-4.127A4.132,4.132,0,0,0,208.094,218.514Zm4.127-1.892a1.892,1.892,0,1,1-1.892,1.892A1.895,1.895,0,0,1,212.221,216.621Zm0,0" transform="translate(-177.094 -182.451)"/>
																		<path id="Path_454" data-name="Path 454" d="M75.154,36.45H70.64a1.118,1.118,0,0,0-1.117,1.117v3.4h-4.66a1.117,1.117,0,1,0,0,2.234h4.66v2.28H49.787V43.2h9.868a1.117,1.117,0,1,0,0-2.234H49.787V37.8a7.092,7.092,0,0,0-2.09-5.046l-1.891-1.891A4.87,4.87,0,0,1,44.369,27.4V22.721a22.431,22.431,0,0,0-1.77-8.759l1.4-1.4a2.622,2.622,0,0,0,0-3.708l-.548-.548a1.886,1.886,0,0,1-.513-1.731l.236-1.114a2.614,2.614,0,0,0-.71-2.4L41.7,2.3a2.613,2.613,0,0,0-2.4-.711l-1.115.236a1.886,1.886,0,0,1-1.731-.513L35.912.768a2.621,2.621,0,0,0-3.708,0L30.855,2.116A21.874,21.874,0,0,0,22.2.335h-.012A22.185,22.185,0,0,0,0,22.52V40.577A7.126,7.126,0,0,0,2.747,46.2a4.13,4.13,0,0,0-.55.466C.16,48.724.146,52.775.151,53.217V60.44a3.224,3.224,0,1,0,6.448,0V53.368c0-3.333.816-5.017,1.23-5.654H25.4a1.117,1.117,0,0,0,0-2.234H7.137a4.907,4.907,0,0,1-4.9-4.9V22.52a19.95,19.95,0,0,1,19.95-19.95h.01a20.077,20.077,0,0,1,19.94,20.152V27.4a7.088,7.088,0,0,0,2.09,5.046l1.891,1.892A4.869,4.869,0,0,1,47.552,37.8v7.676H30.61a1.117,1.117,0,0,0,0,2.234H75.154A1.118,1.118,0,0,0,76.272,46.6V37.568a1.118,1.118,0,0,0-1.117-1.117ZM4.365,53.368V60.44a.99.99,0,1,1-1.979,0V53.206c-.009-.981.226-3.787,1.4-4.974a2.349,2.349,0,0,1,1.548-.561,14.619,14.619,0,0,0-.971,5.7Zm28.6-50.2.816-.816a.388.388,0,0,1,.548,0l.548.548a4.113,4.113,0,0,0,3.774,1.119l1.115-.236a.386.386,0,0,1,.354.1l.76.761A.386.386,0,0,1,40.989,5l-.236,1.115a4.112,4.112,0,0,0,1.118,3.774l.548.548a.388.388,0,0,1,0,.548l-.855.855a22.453,22.453,0,0,0-8.6-8.674ZM74.037,45.479h-2.28V38.685h2.28Zm0,0"/>
																	</g>
																</svg>
																</div>
																<div class="product-dyi-installer__big-images-box pencil">
																<svg xmlns="http://www.w3.org/2000/svg" width="63.665" height="63.665" viewBox="0 0 63.665 63.665">
																	<g id="pencil" transform="translate(-0.001)">
																		<g id="Group_698" data-name="Group 698" transform="translate(0.001 0)">
																			<path id="Path_450" data-name="Path 450" d="M60.471,3.2a10.908,10.908,0,0,0-15.427,0L5.213,43.026a1.934,1.934,0,0,0-.5.868L.067,61.228A1.936,1.936,0,0,0,2.438,63.6l17.334-4.644a1.935,1.935,0,0,0,.868-.5L60.471,18.623a10.909,10.909,0,0,0,0-15.427ZM43.759,9.956l3.606,3.606L12.926,48,9.32,44.4ZM4.675,58.991,7.584,48.136l7.946,7.946Zm14.6-4.645-3.607-3.607L50.1,16.3l3.607,3.607ZM57.733,15.884l-1.285,1.285L46.5,7.218l1.285-1.285a7.036,7.036,0,0,1,9.951,9.951Z" transform="translate(-0.001 0)"/>
																		</g>
																	</g>
																</svg>
																</div>
																<div class="product-dyi-installer__big-images-box screwdriver">
																<svg xmlns="http://www.w3.org/2000/svg" width="65.123" height="65.512" viewBox="0 0 65.123 65.512">
																	<path id="screwdriver" d="M83.943,20.245a.833.833,0,0,0-1.069-.091L76.05,24.969a.834.834,0,0,0-.261.3l-1.721,3.352L50.619,52.07l-.821-.821a2.212,2.212,0,0,0-3.128,0l-.3.3a2.211,2.211,0,0,0-.156,2.954,5.42,5.42,0,0,1-5.4,5.1.862.862,0,0,0-.106.007,6.221,6.221,0,0,0-3.935,1.806L23.2,74.987a6.225,6.225,0,0,0,0,8.8,5.738,5.738,0,0,0,4.088,1.722,6.361,6.361,0,0,0,4.489-1.949L45.347,69.99a6.223,6.223,0,0,0,1.806-3.94.838.838,0,0,0,.006-.1A5.478,5.478,0,0,1,52,60.286a2.211,2.211,0,0,0,2.949-.16l.3-.3a2.215,2.215,0,0,0,0-3.128l-.821-.821,23.45-23.449,3.352-1.721a.834.834,0,0,0,.3-.261l4.816-6.825a.833.833,0,0,0-.092-1.069ZM37.02,63.517a2,2,0,0,1-.46,2.123l-8.814,8.814a2,2,0,0,1-2.123.46ZM31.845,81.136a2.01,2.01,0,0,1,.459-2.122L41.119,70.2a2.01,2.01,0,0,1,2.122-.459ZM45.494,65.9a4.555,4.555,0,0,1-1.033,2.587,3.68,3.68,0,0,0-4.52.532l-8.814,8.814a3.68,3.68,0,0,0-.521,4.539l-.011.011a4.311,4.311,0,0,1-6.222.226,4.56,4.56,0,0,1,0-6.449l.011-.011a3.674,3.674,0,0,0,4.539-.522l8.814-8.814a3.675,3.675,0,0,0,.533-4.521,4.555,4.555,0,0,1,2.59-1.032,7.092,7.092,0,0,0,6.8-5.3l2.89,2.89A7.277,7.277,0,0,0,45.494,65.9Zm8.576-7.255-.3.3a.56.56,0,0,1-.773,0L47.547,53.5a.547.547,0,0,1,0-.773l.3-.3a.56.56,0,0,1,.773,0l5.449,5.449a.547.547,0,0,1,0,.773ZM80.285,29.319,77,31.006a.835.835,0,0,0-.208.153L53.249,54.7,51.8,53.248,75.338,29.706a.83.83,0,0,0,.153-.208l1.687-3.286,6.084-4.293,1.317,1.317Z" transform="translate(-21.372 -20.001)"/>
																</svg>
																</div>
																<div class="product-dyi-installer__big-images-box drill">
																<svg xmlns="http://www.w3.org/2000/svg" width="65.333" height="65.333" viewBox="0 0 65.333 65.333">
																	<g id="drill" transform="translate(0 0)">
																		<g id="Group_697" data-name="Group 697" transform="translate(0 0)">
																			<g id="Group_696" data-name="Group 696">
																			<path id="Path_445" data-name="Path 445" d="M39.577,51.2H36.311a2.18,2.18,0,0,0-2.178,2.178v5.8A2.167,2.167,0,0,0,35.5,61.2L38.769,62.5a2.178,2.178,0,0,0,2.987-2.023v-7.1A2.18,2.18,0,0,0,39.577,51.2Zm0,9.281-3.267-1.307v-5.8h3.267Z" transform="translate(-29.777 -44.667)" fill="#384765"/>
																			<path id="Path_446" data-name="Path 446" d="M64.244,10.889H58.8a2.18,2.18,0,0,0-2.178-2.178H54.147A2.31,2.31,0,0,0,52.722,7.6l-3.85-.88a3.271,3.271,0,0,0-3.14-2.369H39.454a3.261,3.261,0,0,0-2.432-1.089H33.755a2.18,2.18,0,0,0-.63.094L28.558.621A4.357,4.357,0,0,0,26.317,0H16.6a4.326,4.326,0,0,0-3.08,1.276l-.264.264a2.164,2.164,0,0,1-1.54.638H4.355A4.36,4.36,0,0,0,0,6.533V17.477a4.359,4.359,0,0,0,2.587,3.98l5.168,2.3a2.175,2.175,0,0,1,1.206,2.6A55.875,55.875,0,0,0,6.533,41.377v4.542a1.082,1.082,0,0,1-.319.77L4.676,48.228l0,0-.449.449a3.245,3.245,0,0,0-.957,2.31v8.9a5.451,5.451,0,0,0,5.444,5.444H33.1a3.255,3.255,0,0,0,1.812-.549l1.748-1.165A3.26,3.26,0,0,0,38.111,60.9V57.32a3.253,3.253,0,0,0-.608-1.9l-2.759-3.863a8.728,8.728,0,0,0-7.088-3.648H20.286a1.777,1.777,0,0,1-1.707-2.264l3.343-11.7a3.282,3.282,0,0,1,3.144-2.369,2.158,2.158,0,0,0,2.156-2.156V28.311a1.09,1.09,0,0,0-.115-.487c-.017-.033-1.6-3.268.471-4.957h2.91a3.271,3.271,0,0,0,3.082-2.187c.061.005.122.009.184.009h3.267A3.262,3.262,0,0,0,39.454,19.6h6.279a3.271,3.271,0,0,0,3.14-2.369l3.85-.88a2.309,2.309,0,0,0,1.425-1.106h2.474A2.18,2.18,0,0,0,58.8,13.066h5.444a1.089,1.089,0,0,0,0-2.178Zm-28.8,50.918L33.7,62.972a1.082,1.082,0,0,1-.6.183H8.711a3.27,3.27,0,0,1-3.267-3.267H35.933V60.9A1.087,1.087,0,0,1,35.448,61.806ZM21.778,50.088h5.877a6.547,6.547,0,0,1,5.316,2.736l2.759,3.863a1.084,1.084,0,0,1,.2.633v.391H5.444V50.99a1.082,1.082,0,0,1,.319-.77l.132-.132H21.778Zm-.932-18.68c-.9-2.4-.955-4.339-.171-5.791a6.146,6.146,0,0,1,4.156-2.7,7.134,7.134,0,0,0,.218,5.647l.014.835A5.468,5.468,0,0,0,20.846,31.408ZM31.577,19.6a1.09,1.09,0,0,1-1.089,1.089H25.044a.992.992,0,0,0-.12.007c-.176.019-4.332.517-6.156,3.87-1.325,2.435-1.035,5.629.857,9.494l-3.14,10.99a3.955,3.955,0,0,0,.271,2.861H8.034a3.244,3.244,0,0,0,.677-1.991V41.377a53.648,53.648,0,0,1,2.337-14.406,4.357,4.357,0,0,0-2.409-5.207l-5.168-2.3a2.18,2.18,0,0,1-1.294-1.99V6.533A2.18,2.18,0,0,1,4.356,4.355h7.358a4.326,4.326,0,0,0,3.08-1.276l.264-.264a2.164,2.164,0,0,1,1.54-.638h9.72a2.179,2.179,0,0,1,1.12.31L31.624,5a2.2,2.2,0,0,0-.046.445V19.6Zm5.444-1.089H33.755V16.333h1.089a1.089,1.089,0,0,0,0-2.178H33.755V9.8h1.089a1.089,1.089,0,0,0,0-2.178H33.755V5.444h3.267a1.09,1.09,0,0,1,1.089,1.089V17.422A1.09,1.09,0,0,1,37.022,18.511Zm8.711-1.089H40.288V10.889h3.267a1.089,1.089,0,0,0,0-2.178H40.288V6.533h5.444a1.09,1.09,0,0,1,1.089,1.089v8.711A1.09,1.09,0,0,1,45.733,17.422ZM49,14.967V8.986l3.21.731a.236.236,0,0,1,.056.17v4.182a.671.671,0,0,1-.029.158Zm5.444-1.9V10.889h2.178v1.073c0,.005,0,.01,0,.016s0,.011,0,.016v1.073Z" transform="translate(0 0)" fill="#384765"/>
																			<path id="Path_447" data-name="Path 447" d="M131.445,51.2H120.556a1.089,1.089,0,1,0,0,2.178h10.889a1.089,1.089,0,0,0,0-2.178Z" transform="translate(-104.223 -44.667)" fill="#384765"/>
																			<path id="Path_448" data-name="Path 448" d="M131.445,85.333H120.556a1.089,1.089,0,1,0,0,2.178h10.889a1.089,1.089,0,0,0,0-2.178Z" transform="translate(-104.223 -74.444)" fill="#384765"/>
																			<path id="Path_449" data-name="Path 449" d="M131.445,119.467H120.556a1.089,1.089,0,0,0,0,2.178h10.889a1.089,1.089,0,0,0,0-2.178Z" transform="translate(-104.223 -104.223)" fill="#384765"/>
																			</g>
																		</g>
																	</g>
																</svg>
																</div>
															</div>
														</div>
													</div>
													</div>
												</div>
											</div>
										</div>
                                    </div>
                                    <div class="product-dyi-installer mt-2">
                                       <div class="row">
                                          <div class="col-12">
                                             <p class="product-dyi-installer__heading js-show-hiden-installations-btn">Professional installer</p>
                                          </div>
                                       </div>
                                       <div class="row row-with-mobile-border-bottom">
                                          <div class="col-12 js-show-hiden-installations">
                                             <div class="row mb-3">
                                                <div class="col-12">
                                                   <p class="d-block product-dyi-installer__text mobile-blue">Choose which option makes the most sense when considering our DIY solution, <span class="special-text">hire a professional</span> or do it themselves.</p>
                                                </div>
                                             </div>
                                             <div class="row row-with-mobile-top-bottom">
                                                <div class="col-12">
                                                   <p class="product-dyi-installer__text need-hours">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="23.797" height="22" viewBox="0 0 23.797 22">
                                                         <g id="passage-of-time" transform="translate(0 -1.775)">
                                                            <g id="Layer_1_65_" transform="translate(0 1.775)">
                                                               <g id="Group_335" data-name="Group 335">
                                                                  <path id="Path_182" data-name="Path 182" d="M23.75,11.063a.5.5,0,0,0-.454-.288H21.814a10.992,10.992,0,1,0-1.287,7.5,1,1,0,0,0-1.731-1,9.009,9.009,0,1,1,.972-6.5H18.3a.5.5,0,0,0-.385.82l2.5,3a.5.5,0,0,0,.768,0l2.5-3A.5.5,0,0,0,23.75,11.063Z" transform="translate(0 -1.775)" fill="#edb700"/>
                                                                  <path id="Path_183" data-name="Path 183" d="M20.02,6.713a1,1,0,0,0-1,1v6.068a1.748,1.748,0,0,0,1,3.183,1.728,1.728,0,0,0,.738-.169L24.237,18.8a.989.989,0,0,0,.5.135,1,1,0,0,0,.5-1.866l-3.482-2.011a1.742,1.742,0,0,0-.734-1.279V7.713A1,1,0,0,0,20.02,6.713Zm0,9.25a.75.75,0,1,1,.75-.749A.751.751,0,0,1,20.02,15.963Z" transform="translate(-9.02 -4.213)" fill="#edb700"/>
                                                               </g>
                                                            </g>
                                                         </g>
                                                      </svg>
                                                      Just 1-2 hours to install a 10 x 10 closet.
                                                   </p>
                                                </div>
                                                <div class="col-12">
                                                   <p class="product-dyi-installer__text perfect-fit">
                                                      <svg id="security" xmlns="http://www.w3.org/2000/svg" width="15.756" height="18.752" viewBox="0 0 15.756 18.752">
                                                         <path fill="#384765" id="Path_21" data-name="Path 21" d="M32.848,4.829c-.01-.506-.019-.985-.019-1.447a.656.656,0,0,0-.656-.656A9.05,9.05,0,0,1,25.447.186a.656.656,0,0,0-.915,0,9.048,9.048,0,0,1-6.725,2.539.656.656,0,0,0-.656.656c0,.463-.009.941-.019,1.448-.09,4.711-.213,11.164,7.643,13.887a.656.656,0,0,0,.43,0C33.061,15.993,32.938,9.54,32.848,4.829ZM24.99,17.4c-6.737-2.447-6.636-7.809-6.545-12.545.005-.284.011-.56.014-.83A10.121,10.121,0,0,0,24.99,1.549a10.123,10.123,0,0,0,6.531,2.475c0,.27.009.545.014.829C31.626,9.59,31.728,14.951,24.99,17.4Z" transform="translate(-17.112 0)"/>
                                                         <path fill="#384765" id="Path_22" data-name="Path 22" d="M74.149,79.078l-3.168,3.168L69.63,80.894a.656.656,0,0,0-.928.928l1.816,1.816a.656.656,0,0,0,.928,0l3.632-3.632a.656.656,0,0,0-.928-.928Z" transform="translate(-64.011 -71.982)"/>
                                                      </svg>
                                                      100% Perfect Fit Guarantee
                                                   </p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-12">
                                                   <div class="product-dyi-installer__small-images-boxes mb-0">
                                                      <div class="d-flex">
                                                         <div class="product-dyi-installer__small-images-box yellow">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
                                                               <g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
                                                                  <path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
                                                                  <path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
                                                                  <path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
                                                               </g>
                                                            </svg>
                                                         </div>
                                                         <div class="product-dyi-installer__small-images-box">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
                                                               <g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
                                                                  <path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
                                                                  <path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
                                                                  <path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
                                                               </g>
                                                            </svg>
                                                         </div>
                                                         <div class="product-dyi-installer__small-images-box">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
                                                               <g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
                                                                  <path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
                                                                  <path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
                                                                  <path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
                                                               </g>
                                                            </svg>
                                                         </div>
                                                         <div class="product-dyi-installer__small-images-box">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26.77" height="25.914" viewBox="0 0 26.77 25.914">
                                                               <g id="screwdriver-and-wrench" transform="translate(0 -0.428)">
                                                                  <path id="Path_436" data-name="Path 436" d="M17.6,12.3a2.781,2.781,0,0,1,1.854-.457l7.314-7.316-4.1-4.1L15.358,7.744a2.762,2.762,0,0,1-.476,1.877Z" fill="#c2c2c2"/>
                                                                  <path id="Path_437" data-name="Path 437" d="M4.842,21.207l-.265-.265L3.19,22.063.854,25.744l.6.6,3.684-2.336,1.12-1.383-.266-.269L10.642,17.7l-1.156-1.14Z" fill="#c2c2c2"/>
                                                                  <path id="Path_438" data-name="Path 438" d="M11.2,8.307A5.7,5.7,0,0,0,4.215,1.262L7.448,4.494,6.6,7.66l-3.17.848L.2,5.278A5.709,5.709,0,0,0,7.486,12.2l.018.018,13.3,13.3A2.695,2.695,0,0,0,24.614,21.7ZM22.94,25.061a1.029,1.029,0,1,1,1.031-1.029A1.027,1.027,0,0,1,22.94,25.061Z" fill="#c2c2c2"/>
                                                               </g>
                                                            </svg>
                                                         </div>
                                                      </div>
                                                      <p class="product-dyi-installer__text">Easiest degree of difficulty</p>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="tab-pane fade" id="pills-features" role="tabpanel" aria-labelledby="pills-features-tab">
                                    <div class="tab-content__text-wrap features-text js-text-wrap">
                                       <div class="tab-content__text-wrap--content js-hidden-text">
                                          <p class="tab-content__text-wrap--title">
                                             <span>1</span>
                                             Adding title here
                                          </p>
                                          <p class="tab-content__text-wrap--text a__nd">
                                             Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
                                          </p>
                                          <p class="tab-content__text-wrap--title">
                                             <span>2</span>
                                             Adding title here
                                          </p>
                                          <p class="tab-content__text-wrap--text a__nd">
                                             Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
                                          </p>
                                          <p class="tab-content__text-wrap--title">
                                             <span>3</span>
                                             Adding title here
                                          </p>
                                          <p class="tab-content__text-wrap--text a__nd">
                                             Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
                                          </p>
                                          <p class="tab-content__text-wrap--title">
                                             <span>4</span>
                                             Adding title here
                                          </p>
                                          <p class="tab-content__text-wrap--text a__nd">
                                             Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
                                          </p>
                                          <p class="tab-content__text-wrap--title">
                                             <span>5</span>
                                             Adding title here
                                          </p>
                                          <p class="tab-content__text-wrap--text a__nd">
                                             Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
                                          </p>
										  <p class="tab-content__text-wrap--title">
											<span>6</span>
											Adding title here
										 </p>
										 <p class="tab-content__text-wrap--text a__nd">
											Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
										 </p>
										 <p class="tab-content__text-wrap--title">
											<span>7</span>
											Adding title here
										 </p>
										 <p class="tab-content__text-wrap--text a__nd">
											Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
										 </p>
										 <p class="tab-content__text-wrap--title">
											<span>8</span>
											Adding title here
										 </p>
										 <p class="tab-content__text-wrap--text a__nd">
											Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
										 </p>
										 <p class="tab-content__text-wrap--title">
											<span>9</span>
											Adding title here
										 </p>
										 <p class="tab-content__text-wrap--text a__nd">
											Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
										 </p>
										 <p class="tab-content__text-wrap--title">
											<span>10</span>
											Adding title here
										 </p>
										 <p class="tab-content__text-wrap--text a__nd">
											Closet organizers are the ultimate do it yourself project. They not only makeyour life simpler, they also bring about a lifetime of satisfaction. The Closets To Go closet organizers are the easiest to design and assemble.
										 </p>
                                       </div>
                                    </div>
                                    <button data-readall="Explore more" data-readless="Explore less" class="product-tab-content__link mt-2 p-0 mb-0 js-btn-read-all-text">
                                    <span>Explore more</span>
                                    </button>
                                    <div class="you-we-design-buttons">
                                       <div class="product-purchase__buttons">
                                          <button class="product-purchase__buttons--share">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
                                                <defs>
                                                   <style>.share-no-background{fill:#384765;}</style>
                                                </defs>
                                                <g transform="translate(0)">
                                                   <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"></path>
                                                   <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"></path>
                                                   <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"></path>
                                                   <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"></path>
                                                   <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"></path>
                                                   <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"></path>
                                                   <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"></path>
                                                   <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"></path>
                                                </g>
                                             </svg>
                                          </button>
                                          <button class="product-purchase__buttons--idea-folder">
                                             <svg id="Save" xmlns="http://www.w3.org/2000/svg" width="25.6" height="23.023" viewBox="0 0 25.6 23.023">
                                                <path id="Path_205" data-name="Path 205" d="M25.6,4.963v7.6a1,1,0,0,1-1,1h-.55a1,1,0,0,1-.724-.31L18.974,8.69l-7.748,9.89a1,1,0,0,1-.787.383h0a1,1,0,0,1-.787-.384L7.006,15.195,5.592,17.034a1,1,0,0,1-1.585-1.22l2.2-2.861A1,1,0,0,1,7,12.563H7a1,1,0,0,1,.788.384L10.44,16.34l7.672-9.794a1,1,0,0,1,1.511-.073L23.6,10.642V4.963a2,2,0,0,0-2-2H4a2,2,0,0,0-2,2v14a2,2,0,0,0,2,2h6.55a1,1,0,0,1,0,2H4a4,4,0,0,1-4-4v-14a4,4,0,0,1,4-4H21.6A4,4,0,0,1,25.6,4.963ZM4,7.563a3,3,0,1,1,3,3A3,3,0,0,1,4,7.563Zm2,0a1,1,0,1,0,1-1A1,1,0,0,0,6,7.563Z" transform="translate(0 -0.963)" fill="#00fbff"></path>
                                                <path id="Path_207" data-name="Path 207" d="M11.836-4.736H8.076v3.76H6.1v-3.76H2.324V-6.719H6.1V-10.5H8.076v3.779h3.76Z" transform="translate(13.1 24)" fill="#00fbff"></path>
                                             </svg>
                                          </button>
                                          <button class="product-purchase__buttons--pdf">
                                          PDF
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12">
                              <div class="showroom-detail-product__more-informations more-Installations">
                                 <div class="showroom-detail-product__video-block">
                                    <div class="showroom-detail-product__video">
                                       <div class="embed-responsive embed-responsive-4by3">
                                          <iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                       </div>
                                    </div>
                                    <div class="showroom-detail-product__video">
                                       <div class="embed-responsive embed-responsive-4by3">
                                          <iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                       </div>
                                    </div>
                                    <div class="showroom-detail-product__video">
                                       <div class="embed-responsive embed-responsive-4by3">
                                          <iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                       </div>
                                    </div>
                                    <div class="showroom-detail-product__video">
                                       <div class="embed-responsive embed-responsive-4by3">
                                          <iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
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
		 
         <section class="four-elements-block showroom-detail-product">
            <div class="wrapper">
               <div class="container-fluid">
                  <div class="row showroom-detail-product-row">
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-video">
                           <div class="embed-responsive embed-responsive-4by3">
                              <iframe class="yvideo" width="100%" height="100%" src="https://www.youtube.com/embed/Wb0JINqX71w?autoplay=0&amp;enablejsapi=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="we-design-block__form">
                           <form action="">
                              <div class="row">
                                 <div class="col-12">
                                    <h3 class="we-design-block__form--heading">Request a Free Design</h3>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <div class="row showroom-detail-product-row">
                                       <div class="col-6 showroom-detail-product-col-lg">
                                          <div class="form-group">
                                             <input type="text" class="form-control we-design-block__form--input" name="first-name" placeholder="First name">
                                          </div>
                                       </div>
                                       <div class="col-6 showroom-detail-product-col-lg">
                                          <div class="form-group">
                                             <input type="text" class="form-control we-design-block__form--input" name="Last-name" placeholder="Last name">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row showroom-detail-product-row mt-2">
                                       <div class="col-6 showroom-detail-product-col-lg">
                                          <div class="form-group">
                                             <input type="text" class="form-control we-design-block__form--input" name="phone" placeholder="Phone number">
                                          </div>
                                       </div>
                                       <div class="col-6 showroom-detail-product-col-lg">
                                          <div class="form-group">
                                             <input type="text" class="form-control we-design-block__form--input" name="zip-code" placeholder="Zip code">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row showroom-detail-product-row mt-2">
                                       <div class="col-12 showroom-detail-product-col-lg">
                                          <div class="form-group">
                                             <input type="email" class="form-control we-design-block__form--input" name="email" placeholder="E-mail">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row mt-2">
                                 <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit Request</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-design">
                           <p class="showroom-detail-product-design__img">
                              <svg id="vector6" xmlns="http://www.w3.org/2000/svg" width="78.3" height="78.3" viewBox="0 0 78.3 78.3">
                                 <g id="Group_612" data-name="Group 612">
                                    <g id="Group_611" data-name="Group 611">
                                       <path id="Path_427" data-name="Path 427" d="M76.006,0H66.83a2.294,2.294,0,0,0-2.294,2.294V4.588h-18.9a6.88,6.88,0,0,0-12.975,0h-18.9V2.294A2.294,2.294,0,0,0,11.47,0H2.294A2.294,2.294,0,0,0,0,2.294V11.47a2.294,2.294,0,0,0,2.294,2.294H11.47a2.294,2.294,0,0,0,2.294-2.294V9.145H23.3a30.137,30.137,0,0,0-13.912,23.5,6.879,6.879,0,1,0,4.6.046,25.614,25.614,0,0,1,19-22.749,6.878,6.878,0,0,0,12.327,0,25.613,25.613,0,0,1,19,22.749,6.884,6.884,0,1,0,4.6-.046A30.084,30.084,0,0,0,55,9.176h9.539V11.47a2.294,2.294,0,0,0,2.294,2.294h9.176A2.294,2.294,0,0,0,78.3,11.47V2.294A2.294,2.294,0,0,0,76.006,0ZM9.176,9.176H4.588V4.588H9.176Zm2.447,32.268a2.294,2.294,0,1,1,2.294-2.294A2.3,2.3,0,0,1,11.623,41.444ZM39.15,9.176a2.294,2.294,0,1,1,2.294-2.294A2.3,2.3,0,0,1,39.15,9.176Zm27.527,27.68a2.294,2.294,0,1,1-2.294,2.294A2.3,2.3,0,0,1,66.677,36.856Zm7.035-27.68H69.124V4.588h4.588Z" fill="#fff"/>
                                    </g>
                                 </g>
                                 <g id="Group_614" data-name="Group 614" transform="translate(18.504 18.506)">
                                    <g id="Group_613" data-name="Group 613">
                                       <path id="Path_428" data-name="Path 428" d="M161.906,149.557,143.554,122.03l0,0-.02-.029c-.031-.046-.065-.09-.1-.133a2.294,2.294,0,0,0-3.673.133l-.02.029,0,0-18.352,27.527a2.294,2.294,0,0,0,.287,2.895,29.063,29.063,0,0,1,8.283,16.96,11.819,11.819,0,0,0-1.026.93,11.627,11.627,0,0,0-3.341,8.168,2.294,2.294,0,0,0,2.294,2.294h27.527a2.294,2.294,0,0,0,2.294-2.294,11.628,11.628,0,0,0-3.341-8.168,11.825,11.825,0,0,0-1.026-.93,29.059,29.059,0,0,1,8.283-16.96A2.294,2.294,0,0,0,161.906,149.557Zm-20.26-1.021a2.294,2.294,0,1,1-2.294,2.294A2.3,2.3,0,0,1,141.646,148.536Zm-11.079,27.68a7.007,7.007,0,0,1,6.491-4.741h9.176a7.007,7.007,0,0,1,6.491,4.741Zm18.457-8.98a11.271,11.271,0,0,0-2.79-.349h-9.176a11.263,11.263,0,0,0-2.79.349,33.662,33.662,0,0,0-8.052-16.654l13.136-19.7v13.464a6.882,6.882,0,1,0,4.588,0V130.879l13.136,19.7A33.657,33.657,0,0,0,149.024,167.237Z" transform="translate(-121 -121.01)" fill="#fff"/>
                                    </g>
                                 </g>
                              </svg>
                           </p>
                           <p class="showroom-detail-product-design__text">Start design</p>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-specification">
                           <p class="showroom-detail-product-specification__img">
                              <svg xmlns="http://www.w3.org/2000/svg" width="78.347" height="78.3" viewBox="0 0 78.347 78.3">
                                 <g id="vector7" transform="translate(0 -0.153)">
                                    <g id="Group_617" data-name="Group 617" transform="translate(6.528 13.164)">
                                       <g id="Group_616" data-name="Group 616">
                                          <path id="Path_429" data-name="Path 429" d="M47.561,85.179a4.9,4.9,0,0,0-4.9,4.9v13.058h3.264V90.076a1.632,1.632,0,0,1,1.632-1.632H86.734V85.179Z" transform="translate(-42.664 -85.179)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_619" data-name="Group 619" transform="translate(6.528 44.176)">
                                       <g id="Group_618" data-name="Group 618">
                                          <path id="Path_430" data-name="Path 430" d="M47.561,305.8a1.632,1.632,0,0,1-1.632-1.632V287.845H42.664v16.322a4.9,4.9,0,0,0,4.9,4.9H63.883V305.8Z" transform="translate(-42.664 -287.845)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_621" data-name="Group 621" transform="translate(0 26.222)">
                                       <g id="Group_620" data-name="Group 620">
                                          <path id="Path_431" data-name="Path 431" d="M51.753,210.632l-39.64-39.64a1.632,1.632,0,0,0-2.308,0L.478,180.319a1.632,1.632,0,0,0,0,2.308l39.64,39.64a1.631,1.631,0,0,0,2.308,0l9.326-9.327A1.632,1.632,0,0,0,51.753,210.632ZM41.272,218.8,3.94,181.472l7.019-7.019,37.332,37.332Z" transform="translate(0 -170.514)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_623" data-name="Group 623" transform="translate(47.334 62.13)">
                                       <g id="Group_622" data-name="Group 622">
                                          <path id="Path_432" data-name="Path 432" d="M333.814,405.179H309.331v3.264h17.954V416.6a1.632,1.632,0,0,0,1.632,1.632h4.9a6.529,6.529,0,1,0,0-13.058Zm0,9.793H330.55v-6.529h3.264a3.264,3.264,0,0,1,0,6.529Z" transform="translate(-309.331 -405.179)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_625" data-name="Group 625" transform="translate(63.657 13.164)">
                                       <g id="Group_624" data-name="Group 624">
                                          <path id="Path_433" data-name="Path 433" d="M424.159,85.179H416v3.264h8.161a3.264,3.264,0,0,1,3.264,3.264v48.967h3.264V91.708A6.529,6.529,0,0,0,424.159,85.179Z" transform="translate(-415.998 -85.179)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_627" data-name="Group 627" transform="translate(24.961 46.286)">
                                       <g id="Group_626" data-name="Group 626">
                                          <rect id="Rectangle_59" data-name="Rectangle 59" width="6.926" height="3.264" transform="translate(0 4.897) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_629" data-name="Group 629" transform="translate(18.433 39.757)">
                                       <g id="Group_628" data-name="Group 628">
                                          <rect id="Rectangle_60" data-name="Rectangle 60" width="6.926" height="3.264" transform="translate(0 4.897) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_631" data-name="Group 631" transform="translate(31.487 52.815)">
                                       <g id="Group_630" data-name="Group 630">
                                          <rect id="Rectangle_61" data-name="Rectangle 61" width="6.926" height="3.264" transform="translate(0 4.897) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_633" data-name="Group 633" transform="translate(38.019 59.347)">
                                       <g id="Group_632" data-name="Group 632">
                                          <rect id="Rectangle_62" data-name="Rectangle 62" width="6.926" height="3.264" transform="translate(0 4.897) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_635" data-name="Group 635" transform="translate(11.899 33.228)">
                                       <g id="Group_634" data-name="Group 634">
                                          <rect id="Rectangle_63" data-name="Rectangle 63" width="6.926" height="3.264" transform="translate(0 4.897) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_637" data-name="Group 637" transform="translate(36.03 0.153)">
                                       <g id="Group_636" data-name="Group 636" transform="translate(0 0)">
                                          <path id="Path_434" data-name="Path 434" d="M269.83,3.775l-2.256-2.256a4.939,4.939,0,0,0-6.821,0l-24.82,24.82a1.632,1.632,0,0,0,0,2.308l6.769,6.769a1.631,1.631,0,0,0,2.308,0L269.83,10.6l0,0A4.822,4.822,0,0,0,269.83,3.775Zm-2.306,4.512L243.857,31.954,239.4,27.493,263.063,3.827a1.6,1.6,0,0,1,2.2,0l2.257,2.254h0A1.559,1.559,0,0,1,267.524,8.286Z" transform="translate(-235.456 -0.153)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_639" data-name="Group 639" transform="translate(32.644 26.977)">
                                       <g id="Group_638" data-name="Group 638">
                                          <path id="Path_435" data-name="Path 435" d="M224.591,181.188l-7.045,2.352,2.352-7.056-3.1-1.033-3.385,10.154a1.632,1.632,0,0,0,1.549,2.148,1.657,1.657,0,0,0,.509-.078l10.154-3.385Z" transform="translate(-213.328 -175.451)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_641" data-name="Group 641" transform="translate(56.813 6.031)">
                                       <g id="Group_640" data-name="Group 640">
                                          <rect id="Rectangle_64" data-name="Rectangle 64" width="3.264" height="9.573" transform="translate(0 2.308) rotate(-45)" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_643" data-name="Group 643" transform="translate(34.276 36.015)">
                                       <g id="Group_642" data-name="Group 642">
                                          <rect id="Rectangle_65" data-name="Rectangle 65" width="24.483" height="3.264" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_645" data-name="Group 645" transform="translate(62.024 36.015)">
                                       <g id="Group_644" data-name="Group 644">
                                          <rect id="Rectangle_66" data-name="Rectangle 66" width="3.264" height="3.264" fill="#fff"/>
                                       </g>
                                    </g>
                                    <g id="Group_647" data-name="Group 647" transform="translate(68.553 36.015)">
                                       <g id="Group_646" data-name="Group 646">
                                          <rect id="Rectangle_67" data-name="Rectangle 67" width="3.264" height="3.264" fill="#fff"/>
                                       </g>
                                    </g>
                                 </g>
                              </svg>
                           </p>
                           <p class="showroom-detail-product-specification__text">Closet specifications</p>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-images-block">
                           <div class="showroom-detail-product-images-block__image">
                              <img src="<?php echo SITEROOT; ?>images/showroom-detail-product-1.png" alt="" class="img-fluid">
                           </div>
                           <p class="showroom-detail-product-images-block__text">View Sample Closet Organizers</p>
                           <a href="#" title="" class="showroom-detail-product-images-block__button link-button mb-0">
                              Explore now
                              <svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
                                 <path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
                              </svg>
                           </a>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-images-block">
                           <div class="showroom-detail-product-images-block__image">
                              <img src="<?php echo SITEROOT; ?>images/showroom-detail-product-2.png" alt="" class="img-fluid">
                           </div>
                           <p class="showroom-detail-product-images-block__text">Closet Organizer Accessories</p>
                           <a href="#" title="" class="showroom-detail-product-images-block__button link-button mb-0">
                              Explore now
                              <svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
                                 <path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
                              </svg>
                           </a>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-images-block">
                           <div class="showroom-detail-product-images-block__image">
                              <img src="<?php echo SITEROOT; ?>images/showroom-detail-product-3.png" alt="" class="img-fluid">
                           </div>
                           <p class="showroom-detail-product-images-block__text">Decorative Closet Handles and Knobs</p>
                           <a href="#" title="" class="showroom-detail-product-images-block__button link-button mb-0">
                              Explore now
                              <svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
                                 <path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
                              </svg>
                           </a>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3 showroom-detail-product-col-lg">
                        <div class="showroom-detail-product-images-block">
                           <div class="showroom-detail-product-images-block__image">
                              <img src="<?php echo SITEROOT; ?>images/showroom-detail-product-4.png" alt="" class="img-fluid">
                           </div>
                           <p class="showroom-detail-product-images-block__text">Custom Closet Organizer Colors</p>
                           <a href="#" title="" class="showroom-detail-product-images-block__button link-button mb-0">
                              Explore now
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
		 
         <section class="four-elements-block showroom-detail-product desktop-show">
            <div class="wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <h2 class="four-elements-block__heading text-center">Customers reviews</h2>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                     <div class="col-12 col-lg-4 mb-4">
                        <div class="block-stars__wrapper a__">
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
                  </div>
                  <div class="row">
                     <div class="col-12 text-center">
                        <a href="#" title="" class="red-link mt-3">
                        See all reviews
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
         <a href="#" class="scrollToTop js-to-top">
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
	  
<?php
require_once($real_root."/includes/footer.php");
?>		
			  
<script src="<?php echo SITEROOT; ?>app.js"></script></body>
</html>
