

<footer class="clearfix">
<div class="wrapper">
<div class="container-fluid">
<div class="row first-footer">
	<div class="col-12 col-lg-6 col-xl-3">
		<div class="first-footer__wrapper">
			<nav class="first-footer__wrapper--border">
			<button class="first-footer__wrapper-button js-show-mobile-footer-menu-btn">
			<img src="<?php echo SITEROOT; ?>images/group.svg" alt="" class="first-footer__img">
			<h2 class="first-footer__heading">Custom closets</h2>
			</button>
			<ul class="first-footer__navivation">
			<li><a href="<?php echo SITEROOT; ?>diy-instructions.html" title="Closet Installation">Closet Installation</a></li>
			<li><a href="<?php echo SITEROOT; ?>showroom-detail-view-categories.html" title="Showroom">Showroom</a></li>
			<li><a href="<?php echo SITEROOT; ?>specifications.html" title="Closet Specifications">Closet Specifications</a></li>
			</ul>
			</nav>
		</div>
	</div>
	
	<div class="col-12 col-lg-6 col-xl-3">
		<div class="first-footer__wrapper">
			<nav class="first-footer__wrapper--border js-show-all-footer-menu">
			<button class="first-footer__wrapper-button js-show-mobile-footer-menu-btn">
			<img src="<?php echo SITEROOT; ?>images/application.svg" alt="" class="first-footer__img">
			<h2 class="first-footer__heading">Shop</h2>
			</button>
			<ul class="first-footer__navivation">
<?php
foreach($navCats as $key => $val){
	
	echo "<li><a href='".$val['url']."' title='".$val['name']."'>".$val['name']."</a></li>";
	
	if($key==4){
		echo "<li><button class='first-footer__nav-show-button js-show-all-footer-menu-btn'>See more...</button></li>";
	}
	
}

?>

			</ul>
			<button class="first-footer__nav-hide-button js-hide-all-footer-menu-btn">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g transform="translate(0 -0.001)"><g transform="translate(0 0.001)"><path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"/></g></g></svg>
			</button>
			</nav>
		</div>
	</div>

	<div class="col-12 col-lg-6 col-xl-3">
		<div class="first-footer__wrapper">
			<nav class="first-footer__wrapper--border">
			<button class="first-footer__wrapper-button js-show-mobile-footer-menu-btn">
			<img src="<?php echo SITEROOT; ?>images/support.svg" alt="" class="first-footer__img">
			<h2 class="first-footer__heading">Support</h2>
			</button>
			<ul class="first-footer__navivation">

			<li><a href="<?php echo SITEROOT; ?>support.html" title="Contact Closets To Go">Contact Closets To Go</a></li>			
			<li><a href="<?php echo SITEROOT; ?>diy-instructions.html" title="Guide and Tips">Closet Guide and Tips</a></li>
			<li><a href="<?php echo SITEROOT; ?>support.html" title="Feedback">Feedback</a></li>			
			<li><a href="<?php echo SITEROOT; ?>privacy.html" title="Privacy Statement">Privacy Statement</a></li>
			<li><a href="<?php echo SITEROOT; ?>terms.html" title="Terms">Terms</a></li>
			</ul>
			</nav>
		</div>
	</div>
	<div class="col-12 col-lg-6 col-xl-3">
		<div class="first-footer__wrapper">
			<nav class="first-footer__wrapper--border js-show-all-footer-menu">
			<button class="first-footer__wrapper-button js-show-mobile-footer-menu-btn">
			<img src="<?php echo SITEROOT; ?>images/puzzle.svg" alt="" class="first-footer__img">
			<h2 class="first-footer__heading">Company</h2>
			</button>
			<ul class="first-footer__navivation">
			<li><a href="<?php echo SITEROOT; ?>about-us.html" title="About Closets To Go">About Closets To Go</a></li>
			<li><button class="first-footer__nav-show-button js-show-all-footer-menu-btn">See more...</button></li>
			</ul>
			<button class="first-footer__nav-hide-button js-hide-all-footer-menu-btn">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g transform="translate(0 -0.001)"><g transform="translate(0 0.001)"><path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"/></g></g></svg>
			</button>
			</nav>
		</div>
	</div>
</div>
<div class="row second-footer">
	<div class="col-12">
		<div class="second-footer__wrapper">
			<h2 class="second-footer__heading">Design your custom closet</h2>
			<nav class="second-footer__navigation">
			<a href="<?php echo SITEROOT; ?>we-design.html" title="">Email A Closet Design</a>
			<a href="<?php echo SITEROOT; ?>fax-a-design-plan.html" title="">Fax A Closet Design</a>
			<a href="<?php echo SITEROOT; ?>free-in-home-consults.html" title="">Free Local In-Home Consultation</a>
			</nav>
		</div>
	</div>
</div>
<div class="row third-footer">
	<div class="col-12 third-footer__wrapper">
		<h2 class="third-footer__heading">We proudly accept</h2>
		<div class="third-footer__cards">
		<img src="<?php echo SITEROOT; ?>images/footer-visa.png" alt="">
		<img src="<?php echo SITEROOT; ?>images/footer-masterCard.png" alt="">
		<img src="<?php echo SITEROOT; ?>images/footer-paypal.png" alt="">
		<img src="<?php echo SITEROOT; ?>images/footer-american-express.png" alt="">
		<img src="<?php echo SITEROOT; ?>images/optimized-enerbankusalogo.jpg" alt="" class="footer-enerbankusa-logo">
	</div>
	<p class="third-footer__first-text js-show-text">
	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
	invidunt
	ut labore et dolore magna aliquyam erat,
	sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita
	kasd
	gubergren, no sea takimata sanctus est Lorem
	ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
	nonumy
	eirmod tempor invidunt ut labore et dolore
	magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo
	</p>
	<div class="mobile-show">
		<button data-readAll="Discover all"
		data-readLess="Discover less"
		class="third-footer__mobile-button js-btn-view-all-text">
		<span>Discover all</span>
		</button>
	</div>
	<div class="third-footer__social-media">
	
	<?php
	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
	$sql = "SELECT facebook	
				,facebook_active	
				,twitter	
				,twitter_active	
				,houzz	
				,houzz_active
				,youtube	
				,youtube_active	
				,pinterest	
				,pinterest_active					
				,google_plus	
				,google_plus_active
				,linkedin
				,linkedin_active					
				,instagram
				,instagram_active				
	FROM company_info
	WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
		$object = $result->fetch_object();
		if($object->facebook_active > 0){
			echo "<a href='".$object->facebook."' target='blank'><img src='".SITEROOT."images/facebook.svg'></a>";
		}
		if($object->twitter_active > 0){
			echo "<a href='".$object->twitter."' target='blank'><img src='".SITEROOT."images/twitter.svg'></a>";
		}
		if($object->houzz_active > 0){
			echo "<a href='".$object->houzz."' target='blank'><img src='".SITEROOT."images/iconfinder_houzz.png'></a>";
		}
		if($object->pinterest_active > 0){
			echo "<a href='".$object->pinterest."' target='blank'><img src='".SITEROOT."images/logotype.svg'></a>";
		}
		if($object->linkedin_active > 0){
			echo "<a href='".$object->linkedin."' target='blank'><img src='".SITEROOT."images/linkedin.svg'></a>";
		}
		if($object->instagram_active > 0){
			echo "<a href='".$object->instagram."' target='blank'><img src='".SITEROOT."images/brands-and-logotypes.svg'></a>";
		}
		if($object->youtube_active > 0){
			echo "<a href='".$object->youtube."' target='blank'><img src='".SITEROOT."images/brands-and-logotypes(1).svg'></a>";
		}
	}
	
	?>
		
		
	</div>
	<p class="third-footer__second-text">Copyright © 2019 All Rights Reserved.</p>

	<div class="mobile-show">
		<a href="#" title="" class="third-footer__mobile-button js-to-top">Top</a>
	</div>
</div>
</div>
</div>
</div>

</footer>


		<!-- popup "Perfect-fit-guarantee" -->
		<div class="cd-popup perfect-fit-guarantee" role="alert">
			<div class="cd-popup-container">
			   <img src="<?php echo SITEROOT; ?>images/pp1.jpg" alt="">
			   <div class="content-popup">
				  <a href="">
				  <img src="<?php echo SITEROOT; ?>images/svgg.svg" alt="">
				  </a>
				  <p>100% Perfect fit guarantee</p>
				  <a href="#" title="" class="link-button">
					 discover more
					 <svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
					 </svg>
				  </a>
			   </div>
			   <a href="#0" class="cd-popup-close img-replace">
				  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
					 <g id="Group_360" data-name="Group 360">
						<path id="Path_208" data-name="Path 208" d="M15,0A15,15,0,1,0,30,15,15.017,15.017,0,0,0,15,0Zm6.067,19.3a.625.625,0,0,1,0,.884l-.884.884a.625.625,0,0,1-.884,0l-4.3-4.3-4.3,4.3a.625.625,0,0,1-.884,0l-.884-.884a.625.625,0,0,1,0-.884l4.3-4.3-4.3-4.3a.625.625,0,0,1,0-.884l.884-.884a.625.625,0,0,1,.884,0l4.3,4.3,4.3-4.3a.625.625,0,0,1,.884,0l.884.884a.625.625,0,0,1,0,.884l-4.3,4.3Z" fill="#384765"/>
					 </g>
				  </svg>
			   </a>
			   <a class="cd-popup-close img-replace"></a>
			</div>
		</div>

		<!-- popup "Free-shipping" -->
		<div class="cd-popup free-shipping" role="alert">
			<div class="cd-popup-container">
			   <img src="<?php echo SITEROOT; ?>images/pp2.jpg" alt="">
			   <div class="content-popup">
				  <a href="">
				  <img src="<?php echo SITEROOT; ?>images/svgg.svg" alt="">
				  </a>
				  <p>Free<br /> shipping</p>
				  <a href="#" title="" class="link-button">
					 discover more
					 <svg xmlns="http://www.w3.org/2000/svg" width="20.8" height="14.623" viewBox="0 0 20.8 14.623">
						<path id="left-arrow_3_" data-name="left-arrow(3)" d="M14.014,4.9a.737.737,0,1,0-1.048,1.038l5.314,5.314H.744A.738.738,0,0,0,0,11.982a.747.747,0,0,0,.744.744H18.281l-5.314,5.3a.752.752,0,0,0,0,1.048.734.734,0,0,0,1.048,0l6.573-6.573a.739.739,0,0,0,0-1.038Z" transform="translate(0.001 -4.676)"></path>
					 </svg>
				  </a>
			   </div>
			   <a href="#0" class="cd-popup-close img-replace">
				  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
					 <g id="Group_360" data-name="Group 360">
						<path id="Path_208" data-name="Path 208" d="M15,0A15,15,0,1,0,30,15,15.017,15.017,0,0,0,15,0Zm6.067,19.3a.625.625,0,0,1,0,.884l-.884.884a.625.625,0,0,1-.884,0l-4.3-4.3-4.3,4.3a.625.625,0,0,1-.884,0l-.884-.884a.625.625,0,0,1,0-.884l4.3-4.3-4.3-4.3a.625.625,0,0,1,0-.884l.884-.884a.625.625,0,0,1,.884,0l4.3,4.3,4.3-4.3a.625.625,0,0,1,.884,0l.884.884a.625.625,0,0,1,0,.884l-4.3,4.3Z" fill="#384765"/>
					 </g>
				  </svg>
			   </a>
			   <a class="cd-popup-close img-replace"></a>
			</div>
		</div>
