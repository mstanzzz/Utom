<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>ClosetsToGo</title>
	<meta name="description" content="showroom-detail-view-categories"><link href="./app.css" rel="stylesheet"></head>
	<body>

<?php
if(!isset($hero_file_name)) $hero_file_name = '';
$hero = '';
if($hero_file_name == ''){
	$hero .= '<?php echo SITEROOT; ?>images/showroom-detail-view-header.png';
}else{
	$hero .= "<?php echo SITEROOT; ?>saascustuploads/";
	$hero .= $_SESSION['profile_account_id'];
	$hero .= "/cms/";
	$hero .= $hero_file_name;
}
$hero = 'images/showroom-detail-view-header.png';
require_once($real_root."/includes/header.php"); 
?>	

		<section class="first-fixed-block covid-block clearfix">
			<figure class="first-fixed-block__img-group" 
			style="background-image: url('<?php echo $hero; ?>');">
				<figcaption class="first-fixed-block__img-group--text-block">
					<div class="wrapper">
						<h1 class="first-fixed-block__img-group--heading text-center">Closet Organizer Showroom</h1>
					</div>
				</figcaption>
			</figure>
		</section>


<main class="main hero-block clearfix">
<section class="breadcrumb-block desktop-show">
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb-block__wrapper" aria-label="breadcrumb">
					<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo SITEROOT; ?>" title="">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page" title="">Room Gallery</li>
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
						<h2 class="simple-block__heading--heading text-center">Room Gallery</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="simple-block__text">
<p class="text-center">
Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam. voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet
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

<section class="showroom-detail-block">
<div class="wrapper">
	<div class="container-fluid">
		<div class="row">				
			<?php
			echo $cat_block;
			?>
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
<a href="#" title="" class="scrollToTop js-to-top">
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

<script src="./app.js"></script></body>
</html>