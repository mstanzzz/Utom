<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>ClosetsToGo</title>
   <meta name="description" content="Accessories page">
   <link href="<?php echo SITEROOT; ?>app.css" rel="stylesheet"></head>
   <body class="html_accessories">
<?php
require_once($real_root."/includes/header.php"); 	
?>


      <section class="home-mobile-buttons-block covid-block ">
         <div class="wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
                     <div class="home-mobile-buttons-block__wrapper accessories">
                        <a href="specifications.html" title="" class="back-link">
                           <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                              <path d="M0 0h24v24H0V0z" fill="none"/>
                              <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
                           </svg>
                        </a>
                        <h2>
                           <span>
						   
						   <?php
						   echo $svg_code;
						   ?>
						   
                              
                           </span>
                           <?php echo $name; ?>
                        </h2>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="home-mobile-buttons-block showroom-page accessories-page">
         <div class="accordion accordion-organizer-landing-page showroom-details accessories-accordion" id="accordion-organizer-landing">
            <div class="card">
               <div class="d-flex align-items-center">
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
                        <div class="my-custom-select-selects-wrapper">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Choose item</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 1</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 1">Item 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 2</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 2">Item 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 3</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 3">Item 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 4</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 4">Item 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 5</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 5">Item 5</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 6</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 6">Item 6</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <div class="my-customs-select-select__trigger">
                                          <span>Item 7</span>
                                          <div class="arrow-second"></div>
                                       </div>
                                       <div class="my-customs-select-select-options">
                                          <span class="my-customs-select-select-option js-default-value" data-value="Item 7">Item 7</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                          <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-two">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Item 1</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-three">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Item 2</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-four">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Item 3</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Item 4</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <form class="w-100 text-center">
                           <div class="d-flex justify-content-between">
                              <button type="button" class="btn btn-secondary accordion-organizer-submit">Apply filters</button>
                              <button type="button" class="btn btn-secondary accordion-organizer-submit clear-filters-accessories js-clear-filter">Clear filters</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <main class="main clearfix accessories">
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
                              <h2 class="specification-detial-header__heading"><?php echo $name; ?></h2>
                              <p class="specification-detial-header__text">
							  <?php echo $description; ?>
							  
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3">
                        <div class="specification-detial-header__link-wrap">
                           <a href="<?php echo SITEROOT; ?>accessory-category.html" title="" class="specification-detial-header__link">
						   back to categories</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>
      <section class="search-filters-sort_by-view">
         <div class="wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12 col-lg-2">
                     <form action="#">
                        <input type="text" placeholder="Search item">
                        <button>
                        <img src="<?php echo SITEROOT; ?>images/search(1).svg" alt="">
                        </button>
                     </form>
                  </div>
                  <div class="col-12 col-lg-8">
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__one ">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Choose item</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 1</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 1">Item 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 2</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 2">Item 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 3</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 3">Item 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 4</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 4">Item 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 5</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 5">Item 5</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 6</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 6">Item 6</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <div class="my-customs-select-select__trigger">
                                       <span>Item 7</span>
                                       <div class="arrow-second"></div>
                                    </div>
                                    <div class="my-customs-select-select-options">
                                       <span class="my-customs-select-select-option js-default-value" data-value="Item 7">Item 7</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 1">SubItem 1</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 2">SubItem 2</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 3">SubItem 3</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 4">SubItem 4</span>
                                       <span class="my-customs-select-select-option" data-value="SubItem 5">SubItem 5</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-two">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 1</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-three">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 2</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-four">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 3</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="my-custom-select-selects-wrapper my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five">
                        <div class="my-customs-select my-customs-select__features-detail">
                           <div class="my-customs-select__trigger">
                              <span>Item 4</span>
                              <div class="arrows"></div>
                           </div>
                           <div class="my-customs-options">
                              <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 6">Item 6</span>
                                 </div>
                              </div>
                              <div class="my-custom-select-select-wrapper">
                                 <div class="my-customs-select-select">
                                    <span class="my-customs-select-select-option " data-value="Item 7">Item 7</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- btn close filters -->
                     <div class="my-custom-select-selects-wrapper clear-filters clear-filters-accessories">
                        <div class="covid-header">
                           <button class="js-clear-all-accessories-filters">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                 <g transform="translate(0 -0.001)">
                                    <g transform="translate(0 0.001)">
                                       <path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"/>
                                    </g>
                                 </g>
                              </svg>
                           </button>
                           <span>Clear filters</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-2 latest-box">
                     <div class="select-custom accessories-select" data-select="select-option__sort-by">
                        <div class="my-custom-select-selects-wrapper show-select my-custom-select-selects-wrapper-six">
                           <div class="my-customs-select my-customs-select__features-detail">
                              <div class="my-customs-select__trigger">
                                 <span>Sort By</span>
                                 <div class="arrows"></div>
                              </div>
                              <div class="my-customs-options">
                                 <span class="my-customs-option selected d-n_nd" data-value="Closets">Choose item</span>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 1">Item 1</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 2">Item 2</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 3">Item 3</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 4">Item 4</span>
                                    </div>
                                 </div>
                                 <div class="my-custom-select-select-wrapper">
                                    <div class="my-customs-select-select">
                                       <span class="my-customs-select-select-option " data-value="Item 5">Item 5</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="category-block__filters--right-wrapper">
                        <div class="category-block__filters--right-content">
                           <span>View:</span>
                           <button data-type="js-thumb"
                              class="category-block__filters--button js-switch-list-view-sm active">
                              <svg id="thumb-menu-gray" data-name="thumb-menu-gray"
                                 xmlns="http://www.w3.org/2000/svg" width="18.146"
                                 height="18.146" viewBox="0 0 18.146 18.146">
                                 <g id="Group_343" data-name="Group 343">
                                    <g id="Group_342" data-name="Group 342">
                                       <path id="Path_182" data-name="Path 182"
                                          d="M6.266,0H2.1A2.1,2.1,0,0,0,0,2.1V6.266a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V2.1A2.1,2.1,0,0,0,6.266,0Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V2.1A.682.682,0,0,1,2.1,1.418H6.266a.682.682,0,0,1,.681.681Z"
                                          fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_345" data-name="Group 345"
                                    transform="translate(9.782)">
                                    <g id="Group_344" data-name="Group 344">
                                       <path id="Path_183" data-name="Path 183"
                                          d="M282.238,0h-4.111A2.129,2.129,0,0,0,276,2.126V6.238a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126V2.126A2.129,2.129,0,0,0,282.238,0Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709V2.126a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z"
                                          transform="translate(-276)" fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_347" data-name="Group 347"
                                    transform="translate(0 9.782)">
                                    <g id="Group_346" data-name="Group 346">
                                       <path id="Path_184" data-name="Path 184"
                                          d="M6.266,276H2.1A2.1,2.1,0,0,0,0,278.1v4.167a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V278.1A2.1,2.1,0,0,0,6.266,276Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V278.1a.682.682,0,0,1,.681-.681H6.266a.682.682,0,0,1,.681.681Z"
                                          transform="translate(0 -276)" fill="#949dae"/>
                                    </g>
                                 </g>
                                 <g id="Group_349" data-name="Group 349"
                                    transform="translate(9.782 9.782)">
                                    <g id="Group_348" data-name="Group 348">
                                       <path id="Path_185" data-name="Path 185"
                                          d="M282.238,276h-4.111A2.129,2.129,0,0,0,276,278.126v4.111a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126v-4.111A2.129,2.129,0,0,0,282.238,276Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709v-4.111a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z"
                                          transform="translate(-276 -276)"
                                          fill="#949dae"/>
                                    </g>
                                 </g>
                              </svg>
                           </button>
                           <button data-type="js-list"
                              class="category-block__filters--button js-switch-list-view-sm ">
                              <svg id="hamburger-menu-gray" data-name="hamburger-menu-gray"
                                 xmlns="http://www.w3.org/2000/svg" width="17.941"
                                 height="18.146" viewBox="0 0 17.941 18.146">
                                 <path id="Path_186" data-name="Path 186"
                                    d="M17.194,124.608H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0"
                                    transform="translate(0 -114.565)" fill="#949dae"/>
                                 <path id="Path_187" data-name="Path 187"
                                    d="M17.194,1.94H.748A.881.881,0,0,1,0,.97.881.881,0,0,1,.748,0H17.194a.881.881,0,0,1,.748.97A.881.881,0,0,1,17.194,1.94Zm0,0"
                                    fill="#949dae"/>
                                 <path id="Path_188" data-name="Path 188"
                                    d="M17.194,247.272H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0"
                                    transform="translate(0 -229.126)" fill="#949dae"/>
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
	  
	  
	  

	  
      <div class="wrapper accessories-page">
         <div class="js-list category-block__thumb accessories-product-box" id="list-view">
            <div class="container-fluid">

	<ul id="html5-products" class="accessories-products">
               
<?php 
$items_top = array_slice($items, 0, 5, true);
foreach($items_top as $val){
	$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	$details_url = SITEROOT."product-".$val['item_id']."/".$val['name'].".html";
	
?>

	<li data-sub-html="Product description 1">
		<div>
		<div class="product-image">
		<img src="<?php echo $img; ?>" alt="" class="">
        </div>
		<p class="product-title"><?php echo $val['name']; ?></p>
		<p class="product-description__text"><?php echo $val['short_description']; ?></p>
		<div class="share-product-accessories">
        <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
        <defs>
        <style>.share-no-background{fill:#384765;}</style>
        </defs>
        <g transform="translate(0)">
        <path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
        <path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
        <path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
        <path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
        <path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
        <path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
        <path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
        <path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
        </g>
        </svg>
        </a>
        <span class="trash-icon">
        <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="22.783" height="20.49" viewBox="0 0 22.783 20.49">
        <defs>
        <style>.a{fill:#18c4c7;}</style>
        </defs>
        <path class="a" d="M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z" transform="translate(0 -0.963)"/>
        <path class="a" d="M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z" transform="translate(11.402 22.514)"/>
        </svg>
        </a>
        </span>
        </div>
        <div class="see-detail-product-accessories">
        <p><a href="<?php echo $details_url; ?>">See details</a></p>
        </div>
        <div class="stars-review-price-btn">
		<div class=" stars-product-accessories">
		<div class="stars-container">
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<img src="<?php echo SITEROOT; ?>images/stars.svg" alt="">
		</div>
		</div>
		<div class="reviews-counter-product-accessories">
		<p>115 reviews</p>
		</div>
		<div class="price">
		<p>Price: $<?php  echo $val['price_flat'] ?></p>
		</div>
		<div class="btn-add-to-cart">
		<!--
		<span class="card-el__hide-on-md" onClick="add_item(<?php  echo $val['item_id']; ?>)" >
		quick add to cart
		</span>
		-->
		</div>
		</div>
		</div>
	</li>
	
<?php
}
?>
</ul>

<ul id="html5-videos" class="accessories-products landscape-accessories-products">
<?php
$items_wide = array_slice($items, 4, 2, true);
foreach($items_wide as $val){
	$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/exwide/".$val['file_name'];
	$details_url = SITEROOT."product-".$val['item_id']."/".$val['name'].".html";

?>

	<li data-sub-html="Product description 1" data-html="#video1">
		<div>
		<div>
		<img class="landscape-images" src="<?php echo $img; ?>" alt="">
		</div>
		<p class="product-title">Lorem ipsum dolor sit amet...</p>
		<p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elit,invid ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd</p>
		</div>
		<div class="stars-review-counter-accessories">
		<div class="stars-container">
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
		<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
		</svg>
		<img src="<?php echo SITEROOT; ?>images/stars.svg" alt="">
		</div>
		<div class="reviews-counter-product-accessories">
		<p>115 reviews</p>
		</div>
		<div class="price">
		<p>Price: $88888</p>
		</div>
		</div>
		<div class="see-detail-product-accessories">
		<a href="#">
		<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
		<defs>
		<style>.share-no-background{fill:#384765;}</style>
		</defs>
		<g transform="translate(0)">
		<path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
		<path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
		<path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
		<path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
		<path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
		<path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
		<path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
		<path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
		</g>
		</svg>
		</a>
		<span class="trash-icon">
		<a href="#">
		<svg xmlns="http://www.w3.org/2000/svg" width="22.783" height="20.49" viewBox="0 0 22.783 20.49">
		<defs>
		<style>.a{fill:#18c4c7;}</style>
		</defs>
		<path class="a" d="M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z" transform="translate(0 -0.963)"/>
		<path class="a" d="M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z" transform="translate(11.402 22.514)"/>
		</svg>
		</a>
		</span>
		<p><a href="#">See details</a></p>
		<!--
		<span class="card-el__hide-on-md">
		quick add to cart
		</span>
		-->
		</div>
	</li>

<?php
}
?>	
	
</ul>


<ul id="html5-videos" class="accessories-products">
<?php 
$items_bottom = array_slice($items, 5);
foreach($items_bottom as $val){
	$img = SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/medium/".$val['file_name'];
	$details_url = SITEROOT."product-".$val['item_id']."/".$val['name'].".html";
?>
	<li data-sub-html="Product description 1">

	<div>
	<div class="product-image">
	<img src="<?php echo $img; ?>" alt="" class="">
	</div>
	<p class="product-title">Lorem ipsum dolor sit amet, consetetur sadipscing</p>
	<p class="product-description__text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est </p>
	<div class="share-product-accessories">
	<a href="#">
	<svg xmlns="http://www.w3.org/2000/svg" width="23.547" height="25.688" viewBox="0 0 23.547 25.688">
	<defs>
	<style>.share-no-background{fill:#384765;}</style>
	</defs>
	<g transform="translate(0)">
	<path class="share-no-background" d="M321.625,19.479A3.478,3.478,0,1,1,318.147,16a3.479,3.479,0,0,1,3.478,3.478Zm0,0" transform="translate(-298.881 -15.197)"/>
	<path class="share-no-background" d="M302.949,8.563a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,8.563Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(-283.683 0)"/>
	<path class="share-no-background" d="M321.625,360.811a3.478,3.478,0,1,1-3.478-3.479A3.478,3.478,0,0,1,321.625,360.811Zm0,0" transform="translate(-298.881 -339.404)"/>
	<path class="share-no-background" d="M302.949,349.895a4.281,4.281,0,1,1,4.281-4.281A4.286,4.286,0,0,1,302.949,349.895Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676A2.679,2.679,0,0,0,302.949,342.938Zm0,0" transform="translate(-283.683 -324.207)"/>
	<path class="share-no-background" d="M22.957,190.146a3.479,3.479,0,1,1-3.479-3.479A3.479,3.479,0,0,1,22.957,190.146Zm0,0" transform="translate(-15.197 -177.303)"/>
	<path class="share-no-background" d="M4.281,179.23a4.281,4.281,0,1,1,4.281-4.281,4.286,4.286,0,0,1-4.281,4.281Zm0-6.957a2.676,2.676,0,1,0,2.676,2.676,2.679,2.679,0,0,0-2.676-2.676Zm0,0" transform="translate(0 -162.105)"/>
	<path class="share-no-background" d="M115.42,98.019a1.07,1.07,0,0,1-.531-2l9.931-5.662a1.07,1.07,0,1,1,1.06,1.86l-9.932,5.662a1.063,1.063,0,0,1-.529.14Zm0,0" transform="translate(-108.611 -85.688)"/>
	<path class="share-no-background" d="M125.372,274.022a1.064,1.064,0,0,1-.529-.14l-9.932-5.662a1.07,1.07,0,0,1,1.06-1.86l9.932,5.662a1.07,1.07,0,0,1-.531,2Zm0,0" transform="translate(-108.633 -252.862)"/>
	</g>
	</svg>
	</a>
	<span class="trash-icon">
	<a href="#">
	<svg xmlns="http://www.w3.org/2000/svg" width="22.783" height="20.49" viewBox="0 0 22.783 20.49">
	<defs>
	<style>.a{fill:#18c4c7;}</style>
	</defs>
	<path class="a" d="M22.783,4.523v6.764a.89.89,0,0,1-.89.89H21.4a.89.89,0,0,1-.644-.276L16.886,7.839l-6.9,8.8a.89.89,0,0,1-.7.341h0a.89.89,0,0,1-.7-.342L6.235,13.629,4.976,15.265A.89.89,0,0,1,3.566,14.18l1.959-2.546a.89.89,0,0,1,.7-.347h0a.89.89,0,0,1,.7.342l2.36,3.02,6.828-8.716a.89.89,0,0,1,1.345-.065L21,9.577V4.523a1.782,1.782,0,0,0-1.78-1.78H3.56a1.782,1.782,0,0,0-1.78,1.78V16.982a1.782,1.782,0,0,0,1.78,1.78H9.389a.89.89,0,0,1,0,1.78H3.56A3.564,3.564,0,0,1,0,16.982V4.523A3.564,3.564,0,0,1,3.56.963H19.223A3.564,3.564,0,0,1,22.783,4.523ZM3.56,6.837a2.67,2.67,0,1,1,2.67,2.67A2.673,2.673,0,0,1,3.56,6.837Zm1.78,0a.89.89,0,1,0,.89-.89A.891.891,0,0,0,5.34,6.837Z" transform="translate(0 -0.963)"/>
	<path class="a" d="M10.789-5.37H7.443v3.346H5.688V-5.37H2.324V-7.135H5.688V-10.5H7.443v3.363h3.346Z" transform="translate(11.402 22.514)"/>
	</svg>
	</a>
	</span>
	</div>
	<div class="see-detail-product-accessories">
	<p><a href="<?php echo $details_url; ?>">See details</a></p>
	</div>
	<div class="stars-review-price-btn">
	<div class=" stars-product-accessories">
	<div class="stars-container">
	<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
	<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
	</svg>
	<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
	<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
	</svg>
	<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
	<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
	</svg>
	<svg xmlns="http://www.w3.org/2000/svg" width="17.513" height="16.706" viewBox="0 0 17.513 16.706">
	<path id="Path_522" data-name="Path 522" d="M17.488,18.14a.513.513,0,0,0-.414-.349L11.645,17l-2.428-4.92a.513.513,0,0,0-.92,0L5.869,17,.439,17.79a.513.513,0,0,0-.284.875l3.928,3.829L3.156,27.9a.513.513,0,0,0,.744.541L8.757,25.89l4.856,2.553a.513.513,0,0,0,.745-.541l-.928-5.407,3.929-3.829A.513.513,0,0,0,17.488,18.14Z" transform="translate(0 -11.796)" fill="#ededed"/>
	</svg>
	<img src="<?php echo SITEROOT; ?>images/stars.svg" alt="">
	</div>
	</div>
	<div class="reviews-counter-product-accessories">
	<p>115 reviews</p>
	</div>
	<div class="price">
	<p>Price: $<?php  echo $val['price_flat'] ?></p>
	</div>
	<div class="btn-add-to-cart">
	<!--
	<span class="card-el__hide-on-md" onClick="add_item(<?php  echo $val['item_id']; ?>)" >
	quick add to cart
	</span>
	-->
	</div>
	</div>
	</div>



	</li>
<?php
	
}
?>           
</ul>
		 
		 
</div>
</div>
</div>
	  
	  
	  
	  
	  
	  
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

	  
	  
	  
<script src="<?php echo SITEROOT; ?>app.js"></script></body>
</html>
