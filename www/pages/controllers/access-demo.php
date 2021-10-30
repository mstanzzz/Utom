<?php


function get_svg_data($svg_id){

$ret_data['name'] = '';
$ret_data['svg_code'] = '';

$dbCustom = new DbCustom();
$db = $dbCustom->getDbConnect(CART_DATABASE);
$sql = "SELECT *
FROM svg
WHERE svg_id = '".$svg_id."'";
$re = $dbCustom->getResult($db,$sql);

if($re->num_rows > 0){
$object = $re->fetch_object();

$ret_data['name'] = $object->name;
$ret_data['svg_code'] = $object->svg_code;

}
return  $ret_data;
}


$svg_id = (isset($_GET['Id']))? $_GET['Id'] : 0;
if(!is_numeric($svg_id)) $svg_id = 0;

$items_array = $store_data->getItemsFromSvg($svg_id);

$svg_data = get_svg_data($svg_id);

$name = $svg_data['name'];
$svg_code = $svg_data['svg_code'];

$mobile_buttons_section = ';

      <section class="home-mobile-buttons-block covid-block ">
         <div class="wrapper">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-12">
                     <div class="home-mobile-buttons-block__wrapper accessories">
                        <a href="accessory.html" title="" class="back-link">
                           <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                              <path d="M0 0h24v24H0V0z" fill="none"/>
                              <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
                           </svg>
                        </a>
                        <h2>
                           <span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="48.679" height="43"
                                 viewBox="0 0 48.679 43">
                                 <g id="drawers" transform="translate(0 -29.867)">
                                    <g id="Group_416" data-name="Group 416" transform="translate(0 29.867)">
                                       <g id="Group_415" data-name="Group 415" transform="translate(0 0)">
                                          <path id="Path_222" data-name="Path 222"
                                             d="M44.623,29.867H4.057A4.061,4.061,0,0,0,0,33.924V65.565A4.063,4.063,0,0,0,3.245,69.54v.893a2.437,2.437,0,0,0,2.434,2.434h4.868a2.437,2.437,0,0,0,2.434-2.434v-.811H35.7v.811a2.437,2.437,0,0,0,2.434,2.434H43a2.437,2.437,0,0,0,2.434-2.434V69.54a4.063,4.063,0,0,0,3.245-3.975V33.924A4.061,4.061,0,0,0,44.623,29.867ZM11.359,70.433a.812.812,0,0,1-.811.811H5.679a.812.812,0,0,1-.811-.811v-.811h6.491v.811Zm32.453,0a.812.812,0,0,1-.811.811H38.132a.812.812,0,0,1-.811-.811v-.811h6.491Zm3.245-4.868A2.437,2.437,0,0,1,44.623,68H4.057a2.437,2.437,0,0,1-2.434-2.434V33.924A2.437,2.437,0,0,1,4.057,31.49H44.623a2.437,2.437,0,0,1,2.434,2.434V65.565Z"
                                             transform="translate(0 -29.867)"></path>
                                          <path id="Path_223" data-name="Path 223"
                                             d="M75.511,64H34.945a.811.811,0,0,0-.811.811V96.453a.811.811,0,0,0,.811.811H75.511a.811.811,0,0,0,.811-.811V64.811A.811.811,0,0,0,75.511,64ZM74.7,95.642H35.757V86.717H74.7Zm0-10.547H35.757V76.17H74.7Zm0-10.547H35.757V65.623H74.7Z"
                                             transform="translate(-30.889 -60.755)"></path>
                                          <path id="Path_224" data-name="Path 224"
                                             d="M232.834,103a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,103Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,99.756Z"
                                             transform="translate(-208.494 -91.642)"></path>
                                          <path id="Path_225" data-name="Path 225"
                                             d="M232.834,213.935A2.434,2.434,0,1,0,230.4,211.5,2.434,2.434,0,0,0,232.834,213.935Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,210.69Z"
                                             transform="translate(-208.494 -192.029)"></path>
                                          <path id="Path_226" data-name="Path 226"
                                             d="M232.834,324.868a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,324.868Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,321.623Z"
                                             transform="translate(-208.494 -292.415)"></path>
                                       </g>
                                    </g>
                                 </g>
                              </svg>
                           </span>
                           Wardrobe Tubes Specification
                        </h2>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
';



$mobil_filters_section = '

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

';

$main = '
      <main class="main clearfix accessories">
         <section class="specification-detial-header desktop-show">
            <div class="wrapper">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12 col-lg-9">
                        <div class="specification-detial-header__wrap">
                           <span class="specification-detial-header__img">
                              <svg xmlns="http://www.w3.org/2000/svg" width="48.679" height="43"
                                 viewBox="0 0 48.679 43">
                                 <g id="drawers" transform="translate(0 -29.867)">
                                    <g id="Group_416" data-name="Group 416" transform="translate(0 29.867)">
                                       <g id="Group_415" data-name="Group 415" transform="translate(0 0)">
                                          <path id="Path_222" data-name="Path 222"
                                             d="M44.623,29.867H4.057A4.061,4.061,0,0,0,0,33.924V65.565A4.063,4.063,0,0,0,3.245,69.54v.893a2.437,2.437,0,0,0,2.434,2.434h4.868a2.437,2.437,0,0,0,2.434-2.434v-.811H35.7v.811a2.437,2.437,0,0,0,2.434,2.434H43a2.437,2.437,0,0,0,2.434-2.434V69.54a4.063,4.063,0,0,0,3.245-3.975V33.924A4.061,4.061,0,0,0,44.623,29.867ZM11.359,70.433a.812.812,0,0,1-.811.811H5.679a.812.812,0,0,1-.811-.811v-.811h6.491v.811Zm32.453,0a.812.812,0,0,1-.811.811H38.132a.812.812,0,0,1-.811-.811v-.811h6.491Zm3.245-4.868A2.437,2.437,0,0,1,44.623,68H4.057a2.437,2.437,0,0,1-2.434-2.434V33.924A2.437,2.437,0,0,1,4.057,31.49H44.623a2.437,2.437,0,0,1,2.434,2.434V65.565Z"
                                             transform="translate(0 -29.867)"></path>
                                          <path id="Path_223" data-name="Path 223"
                                             d="M75.511,64H34.945a.811.811,0,0,0-.811.811V96.453a.811.811,0,0,0,.811.811H75.511a.811.811,0,0,0,.811-.811V64.811A.811.811,0,0,0,75.511,64ZM74.7,95.642H35.757V86.717H74.7Zm0-10.547H35.757V76.17H74.7Zm0-10.547H35.757V65.623H74.7Z"
                                             transform="translate(-30.889 -60.755)"></path>
                                          <path id="Path_224" data-name="Path 224"
                                             d="M232.834,103a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,103Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,99.756Z"
                                             transform="translate(-208.494 -91.642)"></path>
                                          <path id="Path_225" data-name="Path 225"
                                             d="M232.834,213.935A2.434,2.434,0,1,0,230.4,211.5,2.434,2.434,0,0,0,232.834,213.935Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,210.69Z"
                                             transform="translate(-208.494 -192.029)"></path>
                                          <path id="Path_226" data-name="Path 226"
                                             d="M232.834,324.868a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,324.868Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,321.623Z"
                                             transform="translate(-208.494 -292.415)"></path>
                                       </g>
                                    </g>
                                 </g>
                              </svg>
                           </span>
                           <div class="specification-detial-header__content">
                              <h2 class="specification-detial-header__heading">Wardrobe Tubes</h2>
                              <p class="specification-detial-header__text">Lorem ipsum dolor sit amet,
                                 consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                                 labore
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-lg-3">
                        <div class="specification-detial-header__link-wrap">
                           <a href="accessory.html" title="" class="specification-detial-header__link">back
                           to categories</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>

';

$filters_sort_by_section = "";
$filters_sort_by_section .= "<section class='search-filters-sort_by-view'>
<div class='wrapper'>
<div class='container-fluid'>
<div class='row'>";

$filters_sort_by_section .= "<div class='col-12 col-lg-3'>";
$filters_sort_by_section .= "<form action='#'>";
$filters_sort_by_section .= "<input type='text' placeholder='Search item'>";
$filters_sort_by_section .= "<button class='btn-nd__a'>";
$filters_sort_by_section .= "<img src='<?php echo SITEROOT; ?>images/search(1).svg' alt=''>";
$filters_sort_by_section .= "</button>";
$filters_sort_by_section .= "</form>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='col-12 col-lg-6'></div>";                  
$filters_sort_by_section .= "<div class='col-12 col-lg-3 latest-box'>";

$filters_sort_by_section .= "<div class='select-custom accessories-select' 
									data-select='select-option__sort-by'>";
$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										show-select 
										my-custom-select-selects-wrapper-six'>";
$filters_sort_by_section .= "<div class='my-customs-select my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Sort By</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='category-block__filters--right-wrapper'>";
$filters_sort_by_section .= "<div class='category-block__filters--right-content'>";
$filters_sort_by_section .= "<span>View:</span>";
$filters_sort_by_section .= "<button data-type='js-thumb'
									class='category-block__filters--button 
									js-switch-list-view-sm active'>";
$filters_sort_by_section .= "<svg id='thumb-menu-gray' 
data-name='thumb-menu-gray'
xmlns='http://www.w3.org/2000/svg' width='18.146'
height='18.146' viewBox='0 0 18.146 18.146'>
<g id='Group_343' data-name='Group 343'>
<g id='Group_342' data-name='Group 342'>
<path id='Path_182' data-name='Path 182'
d='M6.266,0H2.1A2.1,2.1,0,0,0,0,2.1V6.266a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V2.1A2.1,2.1,0,0,0,6.266,0Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V2.1A.682.682,0,0,1,2.1,1.418H6.266a.682.682,0,0,1,.681.681Z'
fill='#949dae'/>
</g>
</g>
<g id='Group_345' data-name='Group 345'
transform='translate(9.782)'>
<g id='Group_344' data-name='Group 344'>
<path id='Path_183' data-name='Path 183'
d='M282.238,0h-4.111A2.129,2.129,0,0,0,276,2.126V6.238a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126V2.126A2.129,2.129,0,0,0,282.238,0Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709V2.126a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z'
transform='translate(-276)' fill='#949dae'/>
</g>
</g>
<g id='Group_347' data-name='Group 347'
transform='translate(0 9.782)'>
<g id='Group_346' data-name='Group 346'>
<path id='Path_184' data-name='Path 184'
d='M6.266,276H2.1A2.1,2.1,0,0,0,0,278.1v4.167a2.1,2.1,0,0,0,2.1,2.1H6.266a2.1,2.1,0,0,0,2.1-2.1V278.1A2.1,2.1,0,0,0,6.266,276Zm.681,6.266a.682.682,0,0,1-.681.681H2.1a.682.682,0,0,1-.681-.681V278.1a.682.682,0,0,1,.681-.681H6.266a.682.682,0,0,1,.681.681Z'
transform='translate(0 -276)' fill='#949dae'/>
</g>
</g>
<g id='Group_349' data-name='Group 349'
transform='translate(9.782 9.782)'>
<g id='Group_348' data-name='Group 348'>
<path id='Path_185' data-name='Path 185'
d='M282.238,276h-4.111A2.129,2.129,0,0,0,276,278.126v4.111a2.129,2.129,0,0,0,2.126,2.126h4.111a2.129,2.129,0,0,0,2.126-2.126v-4.111A2.129,2.129,0,0,0,282.238,276Zm.709,6.238a.71.71,0,0,1-.709.709h-4.111a.71.71,0,0,1-.709-.709v-4.111a.71.71,0,0,1,.709-.709h4.111a.71.71,0,0,1,.709.709Z'
transform='translate(-276 -276)'
fill='#949dae'/>
</g>
</g>
</svg>";
$filters_sort_by_section .= "</button>";
$filters_sort_by_section .= "<button data-type='js-list'
							class='category-block__filters--button 
									js-switch-list-view-sm '>";
$filters_sort_by_section .= "<svg id='hamburger-menu-gray' data-name='hamburger-menu-gray'
xmlns='http://www.w3.org/2000/svg' width='17.941'
height='18.146' viewBox='0 0 17.941 18.146'>
<path id='Path_186' data-name='Path 186'
d='M17.194,124.608H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0'
transform='translate(0 -114.565)' fill='#949dae'/>
<path id='Path_187' data-name='Path 187'
d='M17.194,1.94H.748A.881.881,0,0,1,0,.97.881.881,0,0,1,.748,0H17.194a.881.881,0,0,1,.748.97A.881.881,0,0,1,17.194,1.94Zm0,0'
fill='#949dae'/>
<path id='Path_188' data-name='Path 188'
d='M17.194,247.272H.748a1,1,0,0,1,0-1.94H17.194a1,1,0,0,1,0,1.94Zm0,0'
transform='translate(0 -229.126)' fill='#949dae'/>
</svg>";
$filters_sort_by_section .= "</button>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='col-12 col-lg-12'>";
$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										my-custom-select-selects-wrapper__one '>";
$filters_sort_by_section .= "<div class='my-customs-select my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Choose item</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' 
								data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 1</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 2</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 3</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 4</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 5</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";

$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 6</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 6'>Item 6</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<div class='my-customs-select-select__trigger'>";
$filters_sort_by_section .= "<span>Item 7</span>";
$filters_sort_by_section .= "<div class='arrow-second'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-select-select-options'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option 
									js-default-value' 
									data-value='Item 7'>Item 7</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 1'>SubItem 1</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 2'>SubItem 2</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 3'>SubItem 3</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 4'>SubItem 4</span>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' 
									data-value='SubItem 5'>SubItem 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";


$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										my-custom-select-selects-wrapper__select-nd show-select 
										my-custom-select-selects-wrapper-two'>";
$filters_sort_by_section .= "<div class='my-customs-select my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Item 1</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";

$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' 
								data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 6'>Item 6</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 7'>Item 7</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";

$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										my-custom-select-selects-wrapper__select-nd 
										show-select my-custom-select-selects-wrapper-three'>";
$filters_sort_by_section .= "<div class='my-customs-select 
										my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Item 2</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option' data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "</div>";

$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 6'>Item 6</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 7'>Item 7</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										my-custom-select-selects-wrapper__select-nd show-select 
										my-custom-select-selects-wrapper-four'>";
$filters_sort_by_section .= "<div class='my-customs-select my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Item 3</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 6'>Item 6</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 7'>Item 7</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
my-custom-select-selects-wrapper__select-nd show-select my-custom-select-selects-wrapper-five'>";
$filters_sort_by_section .= "<div class='my-customs-select my-customs-select__features-detail'>";
$filters_sort_by_section .= "<div class='my-customs-select__trigger'>";
$filters_sort_by_section .= "<span>Item 4</span>";
$filters_sort_by_section .= "<div class='arrows'></div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-customs-options'>";
$filters_sort_by_section .= "<span class='my-customs-option selected d-n_nd' 
data-value='Closets'>Choose item</span>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 1'>Item 1</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 2'>Item 2</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 3'>Item 3</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 4'>Item 4</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 5'>Item 5</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' data-value='Item 6'>Item 6</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "<div class='my-custom-select-select-wrapper'>";
$filters_sort_by_section .= "<div class='my-customs-select-select'>";
$filters_sort_by_section .= "<span class='my-customs-select-select-option ' 
								data-value='Item 7'>Item 7</span>";

$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";

//<!-- btn close filters -->
$filters_sort_by_section .= "<div class='my-custom-select-selects-wrapper 
										clear-filters clear-filters-accessories'>";
$filters_sort_by_section .= "<div class='covid-header'>";
$filters_sort_by_section .= "<button class='js-clear-all-accessories-filters'>";
$filters_sort_by_section .= "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'>
<g transform='translate(0 -0.001)'>
<g transform='translate(0 0.001)'>
<path d='M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z' transform='translate(0 -0.001)'/>
</g>
</g>
</svg>";
$filters_sort_by_section .= "</button>";
$filters_sort_by_section .= "<span>Clear filters</span>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";

$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</div>";
$filters_sort_by_section .= "</section>";



/*
Select boxes

Think of "Item" and "SubItem" as Primary Attribute and Sub-Attribute. 
For example, Item1 could be Material Type and SubItem for that could be Melamine. 
Item2 could be Color and SubItem for that could be Oxford White.
Item3 could be Width and SubItem for that could be 24 inches. 
==> try attribute (name of elect) and option (as option of select)

*/




?>