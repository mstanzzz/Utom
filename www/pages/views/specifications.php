<?php

if(!isset($hero)) $hero = '../../images/specification-header.png';
if(!isset($spec_array)) $spec_array = array();

require_once($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); 	

?>

<section class="home-mobile-buttons-block covid-block">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="home-mobile-buttons-block__wrapp.r">
						<a href="#" title="" class="back-link">
						<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>
						</a>
						<h2>Specifications</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="first-fixed-block covid-block clearfix">
	<figure class="first-fixed-block__img-group" style="background-image: url('<?php echo $hero; ?>');">

		<figcaption class="first-fixed-block__img-group--text-block">
			<p class="first-fixed-block__img-group--text text-center">

<?php echo $p_1_text; ?>
<!--
All of our custom closet organizers are made with quality thermal-fused melamine 
panels from Roseburg Forest Products Panolam, Flakeboard, and other high quality 
American companies.
-->

			</p>
		</figcaption>

	</figure>
</section>




<main class="main hero-block clearfix">
<section class="breadcrumb-block pb-3 desktop-show">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="breadcrumb-block__wrapp.r" aria-label="breadcrumb">
						<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Specifications</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="simple-block">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="simple-block__border no-border p-0">
						<div class="row">
							<div class="col-12">
								<div class="simple-block__heading">
									<h2 class="simple-block__heading--heading text-center">Specifications</h2>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="simple-block__text">
									<p class="text-center">

<?php echo $p_2_text; ?>
<!--
Each panel is thermally-fused to ¾” thick industrial grade particle board for great strength and durability. 
Thermal-fusion is when two products are placed under intense heat and pressure to permanently bond them together.
-->
									</p>

								</div>
							</div>
						</div>
						
						<div class="row">

<?php

foreach($spec_array as $val){
	$url_str = '';
	$url_str .= "specifications-details/".$val['spec_id'].".html";

	$svg_block = '';	
	$svg_block .= "<div class='clo-12 col-lg-2'>";
	$svg_block .= "<a href='".$url_str."'";	
	$svg_block .= " class='specification-link first-el-mobile-top-border'>";	
	$svg_block .= "<span class='specification-link__img'>";

	$svg_block .= $val['svg_code'];
		
	$svg_block .= "</span>";
	$svg_block .= "<span>".$val['name']."</span>";
	$svg_block .= "</a>";
	$svg_block .= "</div>";
	
	echo $svg_block;
	
}
?>


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
<img src="../../images/people-working-call-center_@2x.png" alt="" class="people-working__image">
<div class="people-working__wrapp.r">
<div class="people-working__content">
<p class="people-working__text">Hi! I'm the Virtual assistant, and I'm here to help you.</p>
</div>
</div>
</div>
<a href="#" class="scrollToTop js-to-top">
<img src="../../images/arrows.svg" alt="">
</a>
</div>

<div class="mobile-show">
<div class="mobile-footer-buttons">
<a href="#" class="mobile-footer-buttons__first">you design</a>
<a href="#" class="mobile-footer-buttons__second"><img src="url('../../imagesimages/icon-save.svg" alt="" class="img-fluid"></a>
<a href="#" class="mobile-footer-buttons__third">we design</a>
</div>
</div>

<?
require_once($_SERVER['DOCUMENT_ROOT']."/includes/footer.php"); 	
?>	

<!--


							
<div class="clo-12 col-lg-2">
	<a href="specifications-details/3333.html" title="" class="specification-link first-el-mobile-top-border">
		<span class="specification-link__img">
		<svg id="description" xmlns="http://www.w3.org/2000/svg" width="26.6" height="38" viewBox="0 0 26.6 38">
		<path id="Path_193" data-name="Path 193" d="M24.7,0H1.9A1.866,1.866,0,0,0,0,1.9V36.1A1.866,1.866,0,0,0,1.9,38H19.253L26.6,30.653V1.9A1.866,1.866,0,0,0,24.7,0Zm.633,30.147-5.7,5.7v-4.18a.6.6,0,0,1,.633-.633h3.167V29.767H20.267a1.866,1.866,0,0,0-1.9,1.9v5.067H1.9a.6.6,0,0,1-.633-.633V1.9A.6.6,0,0,1,1.9,1.267H24.7a.6.6,0,0,1,.633.633Zm0,0"/>
		<path id="Path_194" data-name="Path 194" d="M120,48h7.6v1.267H120Zm0,0" transform="translate(-110.5 -44.2)"/>
		<path id="Path_195" data-name="Path 195" d="M64,264H80.467v1.267H64Zm0,0" transform="translate(-58.933 -243.1)"/>
		<path id="Path_196" data-name="Path 196" d="M64,304H80.467v1.267H64Zm0,0" transform="translate(-58.933 -279.933)"/>
		<path id="Path_197" data-name="Path 197" d="M64,344H80.467v1.267H64Zm0,0" transform="translate(-58.933 -316.767)"/>
		<path id="Path_198" data-name="Path 198" d="M64,384H74.767v1.267H64Zm0,0" transform="translate(-58.933 -353.6)"/>
		<path id="Path_199" data-name="Path 199" d="M107.4,89.776V82.049l-5.7-2.85L96,82.049v7.727l5.7,2.85Zm-5.7-4.94-1.583-.95,3.8-2.153,1.583.76Zm.823-3.8-3.61,2.09L97.9,82.493l3.8-1.9Zm-5.257,2.533,3.8,2.343v3.673h1.267V85.913l3.8-2.343v5.447L101.7,91.233l-4.433-2.217Zm0,0" transform="translate(-88.4 -72.929)"/>
		</svg>
		</span>
		<span>Product description</span>
	</a>
</div>

								
<div class="clo-12 col-lg-2">
	<a href="specifications-details/3333.html" title="" class="specification-link">
		<span class="specification-link__img">
			<svg xmlns="http://www.w3.org/2000/svg" width="40.883" height="37.683" viewBox="0 0 40.883 37.683">
				<g id="shoe" transform="translate(0 -20.038)">
				<g id="Group_406" data-name="Group 406" transform="translate(0 20.038)"><g id="Group_405" data-name="Group 405" transform="translate(0 0)"><path id="Path_200" data-name="Path 200" d="M40.847,29.14a11.346,11.346,0,0,0-2.676-6.98,7.837,7.837,0,0,0-2.8-2.083.6.6,0,0,0-.586.094c-.185.149-4.589,3.736-9.74,12.32-.606,1.011-1.141,1.921-1.613,2.724a.6.6,0,0,0,1.035.608c.471-.8,1-1.709,1.608-2.715A51.534,51.534,0,0,1,35.26,21.346c.967.508,3.9,2.453,4.361,7.511a17.85,17.85,0,0,0-4.734,3.994c-3.236.247-5.055,4.849-6.816,9.3-1.489,3.769-3.029,7.665-5.111,7.966H17.684l-1.931-6.275c3.786-.619,5.076-1.935,7.567-6.082a.6.6,0,0,0-1.029-.618c-2.331,3.881-3.357,4.993-6.895,5.541-.1-.324-.157-.733-.526-.857l-1.92-.64a.61.61,0,0,0-.38,0l-1.92.64a.6.6,0,0,0-.384.393l-.327,1.062A17.424,17.424,0,0,0,3.274,46.24C1.193,47.754,0,49.387,0,50.721a.6.6,0,0,0,.6.6H23a.612.612,0,0,0,.075,0c2.805-.351,4.412-4.416,6.112-8.72,1.531-3.874,3.109-7.869,5.374-8.477v16.6a.6.6,0,0,0,.6.6h1.92a.6.6,0,0,0,.6-.6q0-.48,0-.959,0-.8.018-1.6c.163-9.381,1.235-11.3,2.034-12.739.614-1.1,1.145-2.055,1.145-5.186C40.883,29.874,40.878,29.5,40.847,29.14ZM1.329,50.121A7.753,7.753,0,0,1,3.98,47.21,16.4,16.4,0,0,1,9.535,44.6l-1.7,5.518Zm10.832,0H9.093l2.231-7.249.837-.279Zm1.2,0V42.593l.837.279,2.231,7.249H13.361Zm23.123,0h-.721V48.147H36.5C36.493,48.772,36.486,49.429,36.484,50.121Zm2.206-15.28c-.869,1.56-1.926,3.459-2.16,12.106h-.768V33.674a16.661,16.661,0,0,1,3.92-3.451c0,.005,0,.011,0,.016C39.683,33.059,39.245,33.845,38.69,34.841Z" transform="translate(0 -20.038)"/></g></g>
				<g id="Group_408" data-name="Group 408" transform="translate(26.242 51.401)"><g id="Group_407" data-name="Group 407"><path id="Path_201" data-name="Path 201" d="M334.362,415.366a1.962,1.962,0,0,1-1.96-1.96.6.6,0,1,0-1.2,0,1.962,1.962,0,0,1-1.96,1.96.6.6,0,1,0,0,1.2,1.962,1.962,0,0,1,1.96,1.96.6.6,0,1,0,1.2,0,1.962,1.962,0,0,1,1.96-1.96.6.6,0,1,0,0-1.2Zm-2.56,1.309a3.19,3.19,0,0,0-.709-.709,3.19,3.19,0,0,0,.709-.709,3.19,3.19,0,0,0,.709.709A3.193,3.193,0,0,0,331.8,416.676Z" transform="translate(-328.641 -412.806)"/></g></g>
				<g id="Group_410" data-name="Group 410" transform="translate(1.28 30.919)"><g id="Group_409" data-name="Group 409" transform="translate(0 0)"><path id="Path_202" data-name="Path 202" d="M21.751,158.865a1.962,1.962,0,0,1-1.96-1.96.6.6,0,0,0-1.2,0,1.962,1.962,0,0,1-1.96,1.96.6.6,0,0,0,0,1.2,1.962,1.962,0,0,1,1.96,1.96.6.6,0,1,0,1.2,0,1.962,1.962,0,0,1,1.96-1.96.6.6,0,1,0,0-1.2Zm-2.56,1.309a3.19,3.19,0,0,0-.709-.709,3.189,3.189,0,0,0,.709-.709,3.19,3.19,0,0,0,.709.709A3.189,3.189,0,0,0,19.19,160.175Z" transform="translate(-16.03 -156.305)"/></g></g>
				<g id="Group_412" data-name="Group 412" transform="translate(16.641 20.678)"><g id="Group_411" data-name="Group 411" transform="translate(0 0)"><path id="Path_203" data-name="Path 203" d="M215.406,31.254a2.6,2.6,0,0,1-2.6-2.6.6.6,0,1,0-1.2,0,2.6,2.6,0,0,1-2.6,2.6.6.6,0,1,0,0,1.2,2.6,2.6,0,0,1,2.6,2.6.6.6,0,1,0,1.2,0,2.6,2.6,0,0,1,2.6-2.6.6.6,0,0,0,0-1.2Zm-3.2,1.753a3.834,3.834,0,0,0-1.153-1.153,3.833,3.833,0,0,0,1.153-1.153,3.833,3.833,0,0,0,1.153,1.153A3.833,3.833,0,0,0,212.205,33.007Z" transform="translate(-208.405 -28.054)"/></g></g>
				</g>
			</svg>													
		</span>
		<span>Womens shoes</span>
	</a>
</div>

<div class="clo-12 col-lg-2">
<a href="specifications-details/3333.html" title="" class="specification-link">
<span class="specification-link__img">
<svg xmlns="http://www.w3.org/2000/svg" width="46.912" height="38" viewBox="0 0 46.912 38">
<g id="shoes" transform="translate(-33.13 -55.334)">
<path id="Path_204" data-name="Path 204" d="M79.74,159.319a.8.8,0,0,0-.064-.537c-1.856-3.711-6.013-3.221-9.05-2.865a9.33,9.33,0,0,1-3.483.053,27.105,27.105,0,0,1-4.33-2.124,5.518,5.518,0,0,0-2.767-4.348,49.576,49.576,0,0,0-7.437-3.21.8.8,0,0,0-.822.194c-.963.963-1.928,1.84-2.866,2.606a9.315,9.315,0,0,1-7.635,2.044,6.3,6.3,0,0,1-3.984-2.109.8.8,0,0,0-1.43.191L34.7,152.741a9.093,9.093,0,0,0-1.241,7.512l-.043,4.688a.8.8,0,0,0,.8.81h12a.8.8,0,0,0,.8-.8v-1.32a91.147,91.147,0,0,1,13.2,1.848,15.806,15.806,0,0,0,2.881.436c.776.049,1.7.087,2.731.087,3.661,0,8.6-.473,12.535-2.566a3.2,3.2,0,0,0,1.4-4.049Zm-8.926-1.808c3.244-.381,5.7-.5,7.062,1.383a21.533,21.533,0,0,1-11.01,3.071,51.536,51.536,0,0,1-10.125-1.3,69.507,69.507,0,0,0-7.535-1.2,2.849,2.849,0,0,1,2.707-1.937h7.7a3.226,3.226,0,0,0,2.962-1.958,27.582,27.582,0,0,0,4.016,1.909,9.837,9.837,0,0,0,4.225.035Zm-34.72-3.971a.81.81,0,0,0,.094-.191l.8-2.4a9.042,9.042,0,0,0,4,1.755,10.91,10.91,0,0,0,8.954-2.377c.863-.7,1.745-1.5,2.627-2.36.371.131.941.338,1.622.6a11.816,11.816,0,0,0-.216,2.1.8.8,0,1,0,1.606,0,9.6,9.6,0,0,1,.133-1.488c.305.129.617.264.933.405a11.983,11.983,0,0,0-.253,2.291.8.8,0,0,0,1.606,0,9.756,9.756,0,0,1,.149-1.581c.381.191.755.388,1.111.59a3.916,3.916,0,0,1,1.971,3.41,1.617,1.617,0,0,1-1.616,1.615h-7.7a4.44,4.44,0,0,0-4.332,3.438c-.422-.017-.848-.028-1.278-.028H34.878A7.659,7.659,0,0,1,36.095,153.54Zm41.518,8.476c-4.863,2.587-11.7,2.468-14.411,2.294a14.261,14.261,0,0,1-2.592-.39,96.33,96.33,0,0,0-14.345-1.953.817.817,0,0,0-.6.217.8.8,0,0,0-.252.584v1.377H35.028l.029-3.211H46.3a51.536,51.536,0,0,1,10.125,1.3,52.755,52.755,0,0,0,10.437,1.334A22.955,22.955,0,0,0,78.4,160.46,1.556,1.556,0,0,1,77.613,162.016Z" transform="translate(0 -72.666)"/>
<path id="Path_205" data-name="Path 205" d="M199.211,79.009a.8.8,0,0,0,1.135-1.135l-1.136-1.136a.8.8,0,1,0-1.135,1.135Z" transform="translate(-131.653 -16.921)"/>
<path id="Path_206" data-name="Path 206" d="M179.412,59.21a.8.8,0,0,0,1.135-1.135l-1.136-1.136a.8.8,0,1,0-1.135,1.135Z" transform="translate(-115.827 -1.095)"/>
<path id="Path_207" data-name="Path 207" d="M198.643,59.446a.8.8,0,0,0,.568-.235l1.136-1.136a.8.8,0,1,0-1.135-1.135l-1.136,1.136a.8.8,0,0,0,.568,1.37Z" transform="translate(-131.653 -1.095)"/>
<path id="Path_208" data-name="Path 208" d="M178.844,79.245a.8.8,0,0,0,.568-.235l1.136-1.136a.8.8,0,0,0-1.135-1.135l-1.136,1.136a.8.8,0,0,0,.568,1.37Z" transform="translate(-115.827 -16.921)"/>
<path id="Path_209" data-name="Path 209" d="M67.493,56.979a.823.823,0,1,0-.823-.823A.823.823,0,0,0,67.493,56.979Z" transform="translate(-26.808)"/>
<path id="Path_210" data-name="Path 210" d="M259.493,56.979a.823.823,0,1,0-.823-.823A.823.823,0,0,0,259.493,56.979Z" transform="translate(-180.273)"/>
<path id="Path_211" data-name="Path 211" d="M233.177,152.249a2.408,2.408,0,1,0-2.408-2.408A2.411,2.411,0,0,0,233.177,152.249Zm0-3.211a.8.8,0,1,1-.8.8A.8.8,0,0,1,233.177,149.038Z" transform="translate(-157.972 -73.614)"/>
<path id="Path_212" data-name="Path 212" d="M70.769,93.84a2.408,2.408,0,1,0,2.408-2.408A2.411,2.411,0,0,0,70.769,93.84Zm2.408-.8a.8.8,0,1,1-.8.8A.8.8,0,0,1,73.177,93.038Z" transform="translate(-30.085 -28.853)"/>
</g>
</svg>
</span>
<span>Mens shoes</span>
</a>
</div>

<div class="clo-12 col-lg-2">
<a href="specifications-details/3333.html" title="" class="specification-link">
<span class="specification-link__img">
<svg xmlns="http://www.w3.org/2000/svg" width="35.847" height="43" viewBox="0 0 35.847 43">
<g id="lightbulb" transform="translate(-35.966)">
<g id="Group_414" data-name="Group 414" transform="translate(35.966)">
<g id="Group_413" data-name="Group 413">
<path id="Path_213" data-name="Path 213" d="M116.387,93.2a11.075,11.075,0,0,0-7.319,19.372c1.75,1.75,1.591,5.489,1.551,5.529a.659.659,0,0,0,.2.517.734.734,0,0,0,.477.2h10.143a.659.659,0,0,0,.477-.2.756.756,0,0,0,.2-.517c0-.04-.2-3.779,1.551-5.529l.119-.119a11.041,11.041,0,0,0-7.4-19.253Zm6.364,18.338c-.04.04-.119.119-.119.159-1.551,1.671-1.83,4.415-1.87,5.728h-8.791c-.04-1.313-.318-4.177-1.989-5.887a9.686,9.686,0,1,1,12.769,0Z" transform="translate(-98.431 -83.932)" fill="#231f20"/>
<path id="Path_214" data-name="Path 214" d="M210.005,121.6a.676.676,0,1,0,0,1.352,7.24,7.24,0,0,1,7.24,7.24.676.676,0,1,0,1.352,0A8.556,8.556,0,0,0,210.005,121.6Z" transform="translate(-192.089 -109.507)" fill="#231f20"/>
<path id="Path_215" data-name="Path 215" d="M165.43,358.4H156.6a1.671,1.671,0,1,0,0,3.341h8.791a1.716,1.716,0,0,0,1.71-1.671A1.681,1.681,0,0,0,165.43,358.4Zm0,1.949H156.6a.314.314,0,0,1-.318-.318.293.293,0,0,1,.318-.318h8.791a.314.314,0,0,1,.318.318A.284.284,0,0,1,165.43,360.349Z" transform="translate(-143.099 -322.759)" fill="#231f20"/>
<path id="Path_216" data-name="Path 216" d="M176.005,398.8H169.8a1.671,1.671,0,0,0,0,3.341h6.205a1.681,1.681,0,0,0,1.671-1.671A1.655,1.655,0,0,0,176.005,398.8Zm0,1.949H169.8a.314.314,0,0,1-.318-.318.293.293,0,0,1,.318-.318h6.205a.318.318,0,0,1,0,.636Z" transform="translate(-154.986 -359.141)" fill="#231f20"/>
<path id="Path_217" data-name="Path 217" d="M210.005,5.967a.67.67,0,0,0,.676-.676V.676a.676.676,0,0,0-1.352,0V5.29A.7.7,0,0,0,210.005,5.967Z" transform="translate(-192.089)" fill="#231f20"/>
<path id="Path_218" data-name="Path 218" d="M296.733,33.241a.642.642,0,0,0-.915.159l-2.546,3.819a.655.655,0,0,0,.159.955.642.642,0,0,0,.358.119.635.635,0,0,0,.557-.318l2.546-3.819A.617.617,0,0,0,296.733,33.241Z" transform="translate(-267.559 -29.82)" fill="#231f20"/>
<path id="Path_219" data-name="Path 219" d="M106.21,36.149a.642.642,0,0,0,.358-.119.7.7,0,0,0,.2-.955L104.3,31.217a.69.69,0,0,0-1.154.756l2.466,3.858A.66.66,0,0,0,106.21,36.149Z" transform="translate(-96.369 -27.836)" fill="#231f20"/>
<path id="Path_220" data-name="Path 220" d="M40.994,105.552l-4.018-2.188a.7.7,0,0,0-.915.278.635.635,0,0,0,.278.915l4.018,2.188a.936.936,0,0,0,.318.08.656.656,0,0,0,.6-.358A.7.7,0,0,0,40.994,105.552Z" transform="translate(-35.966 -93.022)" fill="#231f20"/>
<path id="Path_221" data-name="Path 221" d="M347.544,103.643a.7.7,0,0,0-.915-.278l-4.057,2.188a.7.7,0,0,0-.278.915.656.656,0,0,0,.6.358.749.749,0,0,0,.318-.08l4.057-2.188A.7.7,0,0,0,347.544,103.643Z" transform="translate(-311.768 -93.022)" fill="#231f20"/>
</g>
</g>
</g>
</svg>
</span>
<span>Lighting</span>
</a>
</div>

<div class="clo-12 col-lg-2">
<a href="specifications-details/3333.html" title="" class="specification-link">
<span class="specification-link__img">
<svg xmlns="http://www.w3.org/2000/svg" width="48.679" height="43" viewBox="0 0 48.679 43">
<g id="drawers" transform="translate(0 -29.867)">
<g id="Group_416" data-name="Group 416" transform="translate(0 29.867)">
<g id="Group_415" data-name="Group 415" transform="translate(0 0)">
<path id="Path_222" data-name="Path 222" d="M44.623,29.867H4.057A4.061,4.061,0,0,0,0,33.924V65.565A4.063,4.063,0,0,0,3.245,69.54v.893a2.437,2.437,0,0,0,2.434,2.434h4.868a2.437,2.437,0,0,0,2.434-2.434v-.811H35.7v.811a2.437,2.437,0,0,0,2.434,2.434H43a2.437,2.437,0,0,0,2.434-2.434V69.54a4.063,4.063,0,0,0,3.245-3.975V33.924A4.061,4.061,0,0,0,44.623,29.867ZM11.359,70.433a.812.812,0,0,1-.811.811H5.679a.812.812,0,0,1-.811-.811v-.811h6.491v.811Zm32.453,0a.812.812,0,0,1-.811.811H38.132a.812.812,0,0,1-.811-.811v-.811h6.491Zm3.245-4.868A2.437,2.437,0,0,1,44.623,68H4.057a2.437,2.437,0,0,1-2.434-2.434V33.924A2.437,2.437,0,0,1,4.057,31.49H44.623a2.437,2.437,0,0,1,2.434,2.434V65.565Z" transform="translate(0 -29.867)"/>
<path id="Path_223" data-name="Path 223" d="M75.511,64H34.945a.811.811,0,0,0-.811.811V96.453a.811.811,0,0,0,.811.811H75.511a.811.811,0,0,0,.811-.811V64.811A.811.811,0,0,0,75.511,64ZM74.7,95.642H35.757V86.717H74.7Zm0-10.547H35.757V76.17H74.7Zm0-10.547H35.757V65.623H74.7Z" transform="translate(-30.889 -60.755)"/>
<path id="Path_224" data-name="Path 224" d="M232.834,103a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,103Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,99.756Z" transform="translate(-208.494 -91.642)"/>
<path id="Path_225" data-name="Path 225" d="M232.834,213.935A2.434,2.434,0,1,0,230.4,211.5,2.434,2.434,0,0,0,232.834,213.935Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,210.69Z" transform="translate(-208.494 -192.029)"/>
<path id="Path_226" data-name="Path 226" d="M232.834,324.868a2.434,2.434,0,1,0-2.434-2.434A2.434,2.434,0,0,0,232.834,324.868Zm0-3.245a.811.811,0,1,1-.811.811A.811.811,0,0,1,232.834,321.623Z" transform="translate(-208.494 -292.415)"/>
</g>
</g>
</g>
</svg>
</span>
<span>Drawer</span>
</a>
</div>

<div class="clo-12 col-lg-2">
<a href="specifications-details/3333.html" title="" class="specification-link">
<span class="specification-link__img">
<svg xmlns="http://www.w3.org/2000/svg" width="48.68" height="43.789" viewBox="0 0 48.68 43.789">
<g id="shopping-basket" transform="translate(0 -0.501)">
<path id="Path_227" data-name="Path 227" d="M3.245,21.572h.867l1.353,18.95A4.072,4.072,0,0,0,9.513,44.29H39.167a4.072,4.072,0,0,0,4.047-3.768l1.353-18.95h.867a3.245,3.245,0,1,0,0-6.491H31.387l9.04-9.04a3.246,3.246,0,1,0-4.589-4.591L22.208,15.082H3.245a3.245,3.245,0,1,0,0,6.491ZM41.6,40.407a2.445,2.445,0,0,1-2.429,2.26H9.513a2.445,2.445,0,0,1-2.429-2.26L5.739,21.572h37.2Zm3.838-23.7a1.623,1.623,0,1,1,0,3.245H26.488c.056-.049.118-.087.17-.139L29.764,16.7Zm-22.218-.336L36.985,2.6a1.623,1.623,0,1,1,2.295,2.3L25.51,18.663a1.66,1.66,0,0,1-2.294,0,1.623,1.623,0,0,1,0-2.295ZM3.245,16.7H21.233a3.161,3.161,0,0,0,.836,3.106c.053.053.114.091.17.139H3.245a1.623,1.623,0,1,1,0-3.245Zm0,0" transform="translate(0 0)"/>
<path id="Path_228" data-name="Path 228" d="M218.434,242.119a2.434,2.434,0,0,0,2.434-2.434V226.7a2.434,2.434,0,1,0-4.868,0v12.981A2.434,2.434,0,0,0,218.434,242.119Zm-.811-15.415a.811.811,0,1,1,1.623,0v12.981a.811.811,0,1,1-1.623,0Zm0,0" transform="translate(-194.094 -201.075)"/>
<path id="Path_229" data-name="Path 229" d="M154.434,242.119a2.434,2.434,0,0,0,2.434-2.434V226.7a2.434,2.434,0,0,0-4.868,0v12.981A2.434,2.434,0,0,0,154.434,242.119Zm-.811-15.415a.811.811,0,1,1,1.623,0v12.981a.811.811,0,0,1-1.623,0Zm0,0" transform="translate(-136.585 -201.075)"/>
<path id="Path_230" data-name="Path 230" d="M346.434,242.119a2.434,2.434,0,0,0,2.434-2.434V226.7a2.434,2.434,0,0,0-4.868,0v12.981A2.434,2.434,0,0,0,346.434,242.119Zm-.811-15.415a.811.811,0,0,1,1.623,0v12.981a.811.811,0,0,1-1.623,0Zm0,0" transform="translate(-309.113 -201.075)"/>
<path id="Path_231" data-name="Path 231" d="M282.434,242.119a2.434,2.434,0,0,0,2.434-2.434V226.7a2.434,2.434,0,0,0-4.868,0v12.981A2.434,2.434,0,0,0,282.434,242.119Zm-.811-15.415a.811.811,0,0,1,1.623,0v12.981a.811.811,0,0,1-1.623,0Zm0,0" transform="translate(-251.604 -201.075)"/>
<path id="Path_232" data-name="Path 232" d="M90.434,242.119a2.434,2.434,0,0,0,2.434-2.434V226.7a2.434,2.434,0,1,0-4.868,0v12.981A2.434,2.434,0,0,0,90.434,242.119ZM89.623,226.7a.811.811,0,0,1,1.623,0v12.981a.811.811,0,0,1-1.623,0Zm0,0" transform="translate(-79.076 -201.075)"/>
</g>
</svg>
</span>
<span>Baskets</span>
</a>
</div>
-->