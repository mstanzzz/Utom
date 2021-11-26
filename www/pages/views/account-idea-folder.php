<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="Account idea folder">
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
<a href="account-orders.html" title="" class="home-mobile-buttons-block__link account-small-link">My orders</a>
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

<section class="mobile-order-search covid-block mobile-idea-folder">
<div class="mobile-idea-folder__buttons">
<button class="mobile-idea-folder__button add-house" data-toggle="modal" data-target="#newHouse">
<svg xmlns="http://www.w3.org/2000/svg" width="30.77" height="30.789" viewBox="0 0 30.77 30.789"><defs><style>.home-run{fill:#384765;}</style></defs><g transform="translate(-0.001 -0.068)"><g transform="translate(0.001 0.068)"><path class="home-run" d="M30.762,13.386a2.689,2.689,0,0,0-.936-1.848L27.164,9.256V2.767a.9.9,0,0,0-.9-.9H22.657a.892.892,0,0,0-.889.9V4.616L17.206.724a2.688,2.688,0,0,0-3.517,0L.946,11.539a2.708,2.708,0,0,0,2.673,4.606V29.955a.892.892,0,0,0,.889.9H26.263a.9.9,0,0,0,.9-.9V16.145a2.7,2.7,0,0,0,3.6-2.759Zm-7.2-9.717h1.815V7.709L23.559,6.162Zm-4.5,25.383H11.72v-7.23h7.344Zm6.31,0H20.854v-8.12a.9.9,0,0,0-.9-.9H10.818a.892.892,0,0,0-.889.9v8.12H5.41v-14.2L15.443,6.329l9.931,8.51V29.052ZM28.75,14.181a.9.9,0,0,1-1.272.1L16.032,4.459a.9.9,0,0,0-1.17,0L3.293,14.278a.9.9,0,0,1-1.177-1.367L14.859,2.094a.9.9,0,0,1,1.174,0l12.62,10.815A.9.9,0,0,1,28.75,14.181Z" transform="translate(-0.001 -0.068)"></path></g><g transform="translate(11.732 10.887)"><path class="home-run" d="M201.625,179.938H196.1a.892.892,0,0,0-.889.9v5.413a.892.892,0,0,0,.889.9h5.529a.9.9,0,0,0,.9-.9V180.84A.9.9,0,0,0,201.625,179.938Zm-.889,5.413H197v-3.609h3.738Z" transform="translate(-195.207 -179.938)"></path></g><g transform="translate(15.446 23.639)"><ellipse class="home-run" cx="0.901" cy="0.902" rx="0.901" ry="0.902"></ellipse></g></g></svg>
<span>Add house</span>
</button>
<button class="mobile-idea-folder__button manage-house" data-toggle="modal" data-target="#manageHouses">
<svg xmlns="http://www.w3.org/2000/svg" width="33.667" height="26.649" viewBox="0 0 33.667 26.649"><defs><style>.adjust{fill:#18c4c7;}</style></defs><g transform="translate(0 -53.359)"><g transform="translate(0 53.359)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,56.679H21.215a2.482,2.482,0,0,0-.527-.777L18.875,54.09a2.5,2.5,0,0,0-3.529,0L13.534,55.9a2.483,2.483,0,0,0-.527.777H.987a.987.987,0,1,0,0,1.975H13.007a2.482,2.482,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.483,2.483,0,0,0,.527-.777H32.679a.987.987,0,1,0,0-1.975ZM19.291,58.035l-1.812,1.812a.521.521,0,0,1-.737,0L14.93,58.035a.522.522,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0L19.291,57.3A.522.522,0,0,1,19.291,58.035Z" transform="translate(0 -53.359)"></path></g></g><g transform="translate(0 62.508)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,195.815H13.421a2.494,2.494,0,0,0-.529-.777l-1.812-1.812a2.5,2.5,0,0,0-3.529,0l-1.812,1.812a2.484,2.484,0,0,0-.527.777H.987a.987.987,0,1,0,0,1.975H5.212a2.482,2.482,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.5,2.5,0,0,0,.529-.777H32.679a.987.987,0,1,0,0-1.975ZM11.5,197.171l-1.812,1.812a.521.521,0,0,1-.737,0l-1.812-1.812a.522.522,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0l1.812,1.812a.521.521,0,0,1,0,.737Z" transform="translate(0 -192.495)"></path></g></g><g transform="translate(0 71.393)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,330.945H27.8a2.483,2.483,0,0,0-.527-.777l-1.812-1.812a2.5,2.5,0,0,0-3.529,0l-1.812,1.812a2.484,2.484,0,0,0-.527.777H.987a.987.987,0,0,0,0,1.975h18.6a2.483,2.483,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.484,2.484,0,0,0,.527-.777h4.883a.987.987,0,1,0,0-1.975ZM25.873,332.3l-1.812,1.812a.521.521,0,0,1-.737,0L21.512,332.3a.521.521,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0l1.812,1.812A.521.521,0,0,1,25.873,332.3Z" transform="translate(0 -327.625)"></path></g></g></g></svg>
<span>Manage house/s</span>
</button>
</div>
</section>
		
<main class="main clearfix">
<section class="account-block">
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3">
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
		<p class="account-block__wellcome--heading">
			<span class="wellome-txt">Welcome,</span> Super Administrator! <span>How are you today?</span>
		</p>
		<p class="account-block__wellcome--text">27 May 2020, Monday</p>
	</div>
	<div class="account-block__general-info idea-folder">
		<div class="account-block__general-info--image idea-folder-img">
			<p class="desktop-show">Idea folder</p>				
			<?php echo $svg_idea_folder; ?>				
			<div class="account-block__general-info--details mobile-show">
				<div class="row">
					<div class="col-12"><p>Idea folder</p></div>
				</div>
				<div class="row">
					<div class="col-12"><p class="second-text">Super Administrator</p></div>
				</div>
				<div class="row">
					<div class="col-12"><p class="second-text">admin@admincloset.togo</p></div>
				</div>
			</div>
			<a href="#" title="" class="mobile-log-out">Log out</a>
		</div>
		<div class="account-block__general-info--details desktop-show">
			<div class="row">
				<div class="col-3"><p class="first-text">Account Name:</p></div>
					<div class="col-9"><p class="second-text">Super Administrator</p></div>
				</div>
				<div class="row">
					<div class="col-3"><p class="first-text">Account Email:</p></div>
					<div class="col-9"><p class="second-text">admin@admincloset.togo</p></div>
				</div>
				<div class="row">
					<div class="col-12 desktop-show">
						<div class="account-block__buttons-block idea-folder mt-4 mb-0">
							<button class="account-block__buttons-block--button add-house" data-toggle="modal" data-target="#newHouse">
								<span class="button-image">
									<svg xmlns="http://www.w3.org/2000/svg" width="30.77" height="30.789" viewBox="0 0 30.77 30.789"><defs><style>.home-run{fill:#384765;}</style></defs><g transform="translate(-0.001 -0.068)"><g transform="translate(0.001 0.068)"><path class="home-run" d="M30.762,13.386a2.689,2.689,0,0,0-.936-1.848L27.164,9.256V2.767a.9.9,0,0,0-.9-.9H22.657a.892.892,0,0,0-.889.9V4.616L17.206.724a2.688,2.688,0,0,0-3.517,0L.946,11.539a2.708,2.708,0,0,0,2.673,4.606V29.955a.892.892,0,0,0,.889.9H26.263a.9.9,0,0,0,.9-.9V16.145a2.7,2.7,0,0,0,3.6-2.759Zm-7.2-9.717h1.815V7.709L23.559,6.162Zm-4.5,25.383H11.72v-7.23h7.344Zm6.31,0H20.854v-8.12a.9.9,0,0,0-.9-.9H10.818a.892.892,0,0,0-.889.9v8.12H5.41v-14.2L15.443,6.329l9.931,8.51V29.052ZM28.75,14.181a.9.9,0,0,1-1.272.1L16.032,4.459a.9.9,0,0,0-1.17,0L3.293,14.278a.9.9,0,0,1-1.177-1.367L14.859,2.094a.9.9,0,0,1,1.174,0l12.62,10.815A.9.9,0,0,1,28.75,14.181Z" transform="translate(-0.001 -0.068)"/></g><g transform="translate(11.732 10.887)"><path class="home-run" d="M201.625,179.938H196.1a.892.892,0,0,0-.889.9v5.413a.892.892,0,0,0,.889.9h5.529a.9.9,0,0,0,.9-.9V180.84A.9.9,0,0,0,201.625,179.938Zm-.889,5.413H197v-3.609h3.738Z" transform="translate(-195.207 -179.938)"/></g><g transform="translate(15.446 23.639)"><ellipse class="home-run" cx="0.901" cy="0.902" rx="0.901" ry="0.902"/></g></g></svg>
								</span>
								<span class="button-text">
									Add house<br />
									<span>click to add new house</span>
								</span>
							</button>			
							<button class="account-block__buttons-block--button manage-house" data-toggle="modal" data-target="#manageHouses">
								<span class="button-image">
									<svg xmlns="http://www.w3.org/2000/svg" width="33.667" height="26.649" viewBox="0 0 33.667 26.649"><defs><style>.adjust{fill:#18c4c7;}</style></defs><g transform="translate(0 -53.359)"><g transform="translate(0 53.359)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,56.679H21.215a2.482,2.482,0,0,0-.527-.777L18.875,54.09a2.5,2.5,0,0,0-3.529,0L13.534,55.9a2.483,2.483,0,0,0-.527.777H.987a.987.987,0,1,0,0,1.975H13.007a2.482,2.482,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.483,2.483,0,0,0,.527-.777H32.679a.987.987,0,1,0,0-1.975ZM19.291,58.035l-1.812,1.812a.521.521,0,0,1-.737,0L14.93,58.035a.522.522,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0L19.291,57.3A.522.522,0,0,1,19.291,58.035Z" transform="translate(0 -53.359)"/></g></g><g transform="translate(0 62.508)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,195.815H13.421a2.494,2.494,0,0,0-.529-.777l-1.812-1.812a2.5,2.5,0,0,0-3.529,0l-1.812,1.812a2.484,2.484,0,0,0-.527.777H.987a.987.987,0,1,0,0,1.975H5.212a2.482,2.482,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.5,2.5,0,0,0,.529-.777H32.679a.987.987,0,1,0,0-1.975ZM11.5,197.171l-1.812,1.812a.521.521,0,0,1-.737,0l-1.812-1.812a.522.522,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0l1.812,1.812a.521.521,0,0,1,0,.737Z" transform="translate(0 -192.495)"/></g></g><g transform="translate(0 71.393)"><g transform="translate(0 0)"><path class="adjust" d="M32.679,330.945H27.8a2.483,2.483,0,0,0-.527-.777l-1.812-1.812a2.5,2.5,0,0,0-3.529,0l-1.812,1.812a2.484,2.484,0,0,0-.527.777H.987a.987.987,0,0,0,0,1.975h18.6a2.483,2.483,0,0,0,.527.777l1.812,1.812a2.5,2.5,0,0,0,3.529,0l1.812-1.812a2.484,2.484,0,0,0,.527-.777h4.883a.987.987,0,1,0,0-1.975ZM25.873,332.3l-1.812,1.812a.521.521,0,0,1-.737,0L21.512,332.3a.521.521,0,0,1,0-.737l1.812-1.812a.521.521,0,0,1,.737,0l1.812,1.812A.521.521,0,0,1,25.873,332.3Z" transform="translate(0 -327.625)"/></g></g></g></svg>											
								</span>
								<span class="button-text">
									Manage your House/s<br />
									<span>edit, add, remove, reorder folders and files</span>
								</span>
							</button>
						</div>
					</div>
				</div>
			</div>										
			<div class="house-checkbox">
				<input class="custom-checkbox js-load-confirm-modal" id="checkbox-24" type="checkbox" value="value24" data-target="#confirmModal">
				<label for="checkbox-24">Share with Closets To Go</label>
				<span>Share the whole ideas folder with us</span>
			</div>
		</div>

		<!-- My houses block -->
		<div class="account-block__details idea-folder active" id="my-houses">
			<div class="row">
				<?php
$block = '';
				
echo count($houses_array);
				
foreach($houses_array as $val){

	$block .= "<div class='col-6 col-lg-4'>";
	$block .= "<figure class='my-house__wrapper'>";
	$block .= "<figcaption class='my-house__content'>";											
	$block .= "<div class='my-house__img--group'>";
	$block .= "<img src='".$val['blob_image']."' alt='' class='img-fluid my-house__img--img'>";
		
	$block .= "<a href='account-idea-folder-details.html' class='my-house__link-fixed mobile-show'></a>";
	$block .= "<div class='my-house__img--text'>";															
	$block .= "<a href='account-idea-folder-details.html' class='my-house__link-fixed'></a>";
	$block .= "<div class='row'>";
	$block .= "<div class='col-9'>";
	$block .= "<p class='first-text'>Created room/s:</p>";
	$block .= "</div>";
	$block .= "<div class='col-3'>";
	$block .= "<p class='second-text'>".$val['num_rooms']."</p>";
	$block .= "</div>";
	$block .= "</div>";
	$block .= "<div class='row'>";
	$block .= "<div class='col-9'>";
	$block .= "<p class='first-text'>Saved item/s:</p>";
	$block .= "</div>";
	$block .= "<div class='col-3'>";
	$block .= "<p class='second-text'>15</p>";
	$block .= "</div>";
	$block .= "</div>";															
	$block .= "<div class='my-house__img--buttons'>";
	$block .= "<button class='shere'>";				
				
	$block .= '<svg id="share" xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5" viewBox="0 0 42.5 42.5">
	<path id="Path_226" data-name="Path 226" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(10 19)" fill="#384765"/>
	<path id="Path_225" data-name="Path 225" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 26)" fill="#384765"/>
	<path id="Path_224" data-name="Path 224" d="M2.5,0A2.5,2.5,0,1,1,0,2.5,2.5,2.5,0,0,1,2.5,0Z" transform="translate(25 11)" fill="#384765"/>
	<path id="Path_209" data-name="Path 209" d="M21.25,0A21.25,21.25,0,1,0,42.5,21.25,21.333,21.333,0,0,0,21.25,0ZM17.484,21.556l6.348,3.794a5.112,5.112,0,1,1-1.181,2.195l-5.96-3.562a5,5,0,1,1-.3-5.842l6.193-3.46a5.046,5.046,0,1,1,1.069,2.255L17.43,20.413a2.916,2.916,0,0,1,.054,1.143Z" fill="#384765"/>
	</svg>';
	
	$block .= "</button>";
	
	$block .= "<button onClick='set_del_house(".$val['idea_house_id'].")' class='delete' data-toggle='modal' data-target='#deleteHouse'>";
	
	$block .= '<svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 43 43">
	<g id="trash" transform="translate(11.363 9.917)">
	<circle id="Ellipse_36" data-name="Ellipse 36" cx="21.5" cy="21.5" r="21.5" transform="translate(-11.363 -9.917)" fill="#fb561b"/>
	<path id="Path_408" data-name="Path 408" d="M63.808,128.863a1.849,1.849,0,0,0,1.914,1.655H73.9a1.882,1.882,0,0,0,1.947-1.687l1.33-13.886H62.186Z" transform="translate(-59.104 -107.806)" fill="#fff"/>
	<path id="Path_409" data-name="Path 409" d="M33.059,2.92H27.024V1.882A1.817,1.817,0,0,0,25.274,0H21.087a1.817,1.817,0,0,0-1.85,1.783q0,.049,0,.1V2.92H13.2a.649.649,0,0,0,0,1.3H33.059a.649.649,0,1,0,0-1.3ZM25.726,1.882V2.92H20.535V1.882a.519.519,0,0,1,.552-.584h4.088a.519.519,0,0,1,.554.481A.513.513,0,0,1,25.726,1.882Z" transform="translate(-12.554 0)" fill="#fff"/>
	</g>
	</svg>';				
					
	$block .= "</button>";
	$block .= "</div>";
	$block .= "</div>";
	$block .= "</div>";
	$block .= "<a href='account-idea-folder-details.html' class='my-house__heading'>".$val['house_name']."</a>";
	$block .= "</figcaption>";
	$block .= "</figure>";
	$block .= "</div>";		


}					
	echo $block;			
				?>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</section>
</main>

<?php
require_once($real_root.'/includes/footer.php');

?>

<!-- Modal delete house -->
<div class="modal fade" id="deleteHouse" tabindex="-1" role="dialog" aria-labelledby="#deleteHouseTitle" aria-hidden="true">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="deleteHouseTitle"><span>XXXXHHHHHHHH</span></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="account-block__form">							
<form action="<?php echo SITEROOT; ?>account-idea-folder/<?php echo $_SESSION['idea_folder_id']; ?>.html" method="post">
<input type="hidden" id="del_idea_house_id" name="del_idea_house_id" value="1">
<div class="row mb-3">
<div class="col-12">
<p class="js-delete-text">You are about to delete <span style="color: #17C3C6">XXXX</span>.<br /> Are you sure that you want to continue?</p>
</div>
</div>
<div class="row">
<div class="col-12">
<button type="submit" class="btn btn-secondary w-100">continue</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>



<!-- Modal New house -->
<!-- see my change in app.js -->
<div class="modal houses-modal fade" id="newHouse" tabindex="-1" role="dialog" aria-labelledby="#newHouseTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="newHouseTitle"><span>Add house</span></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="account-block__form">
<form action="<?php echo SITEROOT; ?>account-idea-folder/999.html" method="post">
<input type="hidden" name="add_house" value="1">
<input class="house_blob_image" type="hidden" name="house_blob_image" value="no blob image data">
<div class="row">
<div class="col-12 col-lg-4 mb-2">
<div class="account-block__form--house-image">
<img src="<?php echo SITEROOT; ?>images/photo.svg" alt="" 
class="account-block__form--house-image-defaltImg js-my-house-defalt-img">
<a href="" data-lightbox="roadtrip" data-title="Lorem ipsum">
<img src="xxxHTMLLINKxxx0.0242654720692188080.7917992898801613xxx" alt="" 
class="js-my-house-img-view img-fluid" style="display: none;">
</a>
</div>
</div>
<div class="col-12 col-lg-4 mb-2">
<div class="row js-mobile-file-position"></div>
<div class="row">
<div class="col-12 mb-2">
<div class="form-group">
<label for="house-name" class="label-riquired">Add/Edit house title</label>
<input type="text" class="form-control mt-2" name="house_name" placeholder="Add/Edit house title">
</div>
</div>
</div>
<div class="row">
<div class="col-12 mb-2">
<p class="mb-1">Add room/s</p>
<div class="dropdown">
<label class="dropdown-label" data-default-text="Choose one or more room/s">Choose one or more room/s</label>
<div class="dropdown-list">
<?php echo $rooms_block; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 mb-2">
<div class="form-group">
<label for="house-custom-room">Add custom room</label>
<input type="text" class="form-control mt-2" name="house-custom-room" placeholder="(ex. my big garage)">
</div>
</div>
</div>
<div class="row js-desctop-file-position">
<div class="col-12 mb-2">
<div class="form-group">
<div class="my-house-image-upload__wrapper">														
<input type="file" class="my-house-image-upload__file js-img-up" name="my-house-image-upload">
<svg xmlns="http://www.w3.org/2000/svg" width="33.001" height="33" viewBox="0 0 33.001 33"><defs><style>.upload{fill:#384765;}</style></defs><g transform="translate(0 -0.003)"><g transform="translate(0 0.003)"><path class="upload" d="M16.5,0A16.5,16.5,0,1,0,33,16.5,16.5,16.5,0,0,0,16.5,0ZM12.207,8.966l3.488-3.488a1.163,1.163,0,0,1,.826-.342h.017a1.165,1.165,0,0,1,.826.342l3.488,3.488A1.168,1.168,0,1,1,19.2,10.618L17.658,9.076v6.259a1.168,1.168,0,1,1-2.337,0V9.156l-1.463,1.462a1.168,1.168,0,0,1-1.652-1.652ZM25.474,23.028h0c0,1.577-1.546,2.812-3.521,2.812h-10.9c-1.974,0-3.521-1.235-3.521-2.812V15.437c0-1.577,1.546-2.813,3.521-2.813h1.472a2.776,2.776,0,0,0,1.022,0h.067v2.282H11.048c-.8,0-1.238.4-1.238.53v7.591c0,.132.439.53,1.238.53H21.953c.8,0,1.238-.4,1.238-.53V15.437c0-.132-.439-.53-1.238-.53H19.37V12.625h.158a2.714,2.714,0,0,0,1.01,0h1.415c1.974,0,3.521,1.236,3.521,2.813v7.591Z" transform="translate(0 -0.003)"/></g></g></svg>
<label for="my-house-image-upload" class="house-image-upload__label">Upload/change cover image</label>
</div>
</div>
</div>
</div>
<div class="row js-mobile-row-action">
<div class="col-6 js-col-delete">
<button type="submit" class="btn btn-secondary w-100"><span>delete house</span></button>
</div>
<div class="col-6 js-col-edit-add">
<button type="submit" class="btn btn-primary w-100"><span>confirm</span></button>										
</div>
</div>
</div>
<div class="col-12 col-lg-4">
<div class="form-group text-max-height">
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy</p>
</div>
</div>
</div>
<div class="row js-row-action">
<div class="col-4 js-col-delete">
<button type="submit" class="btn btn-secondary w-100"><span>delete house</span></button>
</div>
<div class="col-4 js-col-edit-add">
<button type="submit" class="btn btn-primary w-100"><span>confirm</span></button>										
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>




<!-- Modal manage saved houses -->
<div class="modal fade" id="manageHouses" tabindex="-1" role="dialog" aria-labelledby="#manageHousesTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title manage-house-tite" id="manageHousesTitle">My houses
		<div class="manage-house-filters">
			<div class="house-checkbox">
				<input class="custom-checkbox js-select-all-houses" id="checkbox-17" type="checkbox" value="value17">
				<label for="checkbox-17">Select all</label>
			</div>
			<div class="manage-house-filters__result"  style="display: none;">
				<button class="manage-house-filters__result--button js-manage-house-clear">
				<svg xmlns="http://www.w3.org/2000/svg" width="14.116" height="14.116" viewBox="0 0 14.116 14.116"><path d="M7.058,0a7.058,7.058,0,1,0,7.058,7.058A7.066,7.066,0,0,0,7.058,0Zm2.6,8.826a.588.588,0,1,1-.832.832L7.058,7.89,5.291,9.657a.588.588,0,0,1-.832-.832L6.227,7.058,4.459,5.291a.588.588,0,1,1,.832-.832L7.058,6.227,8.826,4.459a.588.588,0,0,1,.832.832L7.89,7.058Zm0,0"/></svg>
				</button>
<p class="manage-house-filters__result--text">(<span>6</span>) selected item</p>
<button class="manage-house-filters__result--button js-manage-house-delete" data-toggle="modal" 
data-target="#deleteHouse">
<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
</button>
			</div>
			<div class="my-custom-select-wrapper">
				<div class="my-custom-select">
					<div class="my-custom-select__trigger"><span>Reorder by</span>
						<div class="arrow"></div>
					</div>
					<div class="my-custom-options">
						<span class="my-custom-option selected" data-value="Reorder by">Reorder by</span>
						<span class="my-custom-option" data-value="Name">Name</span>
						<span class="my-custom-option" data-value="Lastest">Lastest</span>
						<span class="my-custom-option" data-value="Older">Older</span>
						<span class="my-custom-option" data-value="Number of rooms">Number of rooms</span>
						<span class="my-custom-option" data-value="Most visited">Most visited</span>
					</div>
				</div>
			</div>
								
			<button class="account-mobile-more-info-btn mobile-manage-house-btn js-show-mobile-action-btn">
			</button>
			<div class="account-mobile-more-info-wrapper mobile-manage-house-info js-show-mobile-action-buttons">
				<div class="account-mobile-more-info-wrapper__mobile-more-info">
					<button class="mobile-manage-house-info--button-bold">Reorder by</button>
					<button class="mobile-manage-house-info--button-light">Name</button>
					<button class="mobile-manage-house-info--button-light">Latest</button>
					<button class="mobile-manage-house-info--button-light">Older</button>
					<button class="mobile-manage-house-info--button-light">Number of rooms</button>
					<button class="mobile-manage-house-info--button-light">Most visited</button>
				</div>
			</div>
		</div>
	</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body manage-house-modal-body">
	<div class="row">
<?php
		
foreach($houses_array as $val){

echo "<div class='col-6 col-lg-4'>";
echo "<div class='manage-house-houses'>";
echo "<div class='manage-house-houses__checkbox'>";
echo "<div class='house-checkbox'>";
echo "<input class='custom-checkbox js-select-house' id='checkbox-'".$val['idea_house_id']."' 
type='checkbox' value='value".$val['idea_house_id']."'>";
echo "<label for='checkbox-".$val['idea_house_id']."'></label>";
echo "</div>";
echo "</div>";
echo "<button class='manage-house-houses__button js-edit-house' data-house-id='".$val['idea_house_id']."' 
data-dismiss='modal' data-toggle='modal' data-target='#newHouse'>";
echo "<img src='".$val['blob_image']."' alt='' class='img-fluid'>";
echo "<p class='manage-house-houses__heading'>".$val['house_name']."</p>";
echo "</button>";
echo "</div>";
echo "</div>";

			
}
		
?>

<div class="col-6 col-lg-4">
<div class="manage-house-houses">
<div class="manage-house-houses__checkbox">
<div class="house-checkbox">
<input class="custom-checkbox js-select-house" id="checkbox-18" type="checkbox" value="value18">
<label for="checkbox-18"></label>
</div>
</div>
<button class="manage-house-houses__button js-edit-house" data-house-id="1" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
<img src="<?php echo SITEROOT; ?>images/my-house-1.png" alt="" class="img-fluid">
<p class="manage-house-houses__heading">Title house name 1</p>
</button>
</div>
</div>
		
		
		<div class="col-6 col-lg-4">
			<div class="manage-house-houses">
				<div class="manage-house-houses__checkbox">
					<div class="house-checkbox">
						<input class="custom-checkbox js-select-house" id="checkbox-19" type="checkbox" value="value19">
						<label for="checkbox-19"></label>
					</div>
				</div>
				<button class="manage-house-houses__button js-edit-house" data-house-id="2" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
					<img src="<?php echo SITEROOT; ?>images/my-house-2.png" alt="" class="img-fluid">
					<p class="manage-house-houses__heading">Title house name 2</p>
				</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-20" type="checkbox" value="value20">
											<label for="checkbox-20"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="3" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-3.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 3</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">									
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-21" type="checkbox" value="value21">
											<label for="checkbox-21"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="4" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-1.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 1</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-22" type="checkbox" value="value22">
											<label for="checkbox-22"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="5" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-2.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 2</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-23" type="checkbox" value="value23">
											<label for="checkbox-23"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="6" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-3.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 3</p>
									</button>
								</div>
							</div>
							
							
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-18" type="checkbox" value="value18">
											<label for="checkbox-18"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="7" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-1.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 1</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-19" type="checkbox" value="value19">
											<label for="checkbox-19"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="8" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-2.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 2</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-20" type="checkbox" value="value20">
											<label for="checkbox-20"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="9" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-3.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 3</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">									
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-21" type="checkbox" value="value21">
											<label for="checkbox-21"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="10" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-1.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 1</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-22" type="checkbox" value="value22">
											<label for="checkbox-22"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="11" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-2.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 2</p>
									</button>
								</div>
							</div>
							<div class="col-6 col-lg-4">
								<div class="manage-house-houses">
									<div class="manage-house-houses__checkbox">
										<div class="house-checkbox">
											<input class="custom-checkbox js-select-house" id="checkbox-23" type="checkbox" value="value23">
											<label for="checkbox-23"></label>
										</div>
									</div>
									<button class="manage-house-houses__button js-edit-house" data-house-id="12" data-dismiss="modal" data-toggle="modal" data-target="#newHouse">
										<img src="<?php echo SITEROOT; ?>images/my-house-3.png" alt="" class="img-fluid">
										<p class="manage-house-houses__heading">Title house name 3</p>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


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
										<button type="submit" data-dismiss="modal" class="btn btn-secondary w-100 js-uncheck-checkbox-btn">No</button>
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
		
<script src="<?php echo SITEROOT; ?>app.js"></script>
</body>
</html>
		
		