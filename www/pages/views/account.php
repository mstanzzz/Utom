<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>ClosetsToGo</title>
<meta name="description" content="account">
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
							<a href="account.html" title="" class="home-mobile-buttons-block__link account-small-link active">Dashboard</a>
								<a href="account-settings.html" title="" class="home-mobile-buttons-block__link account-big-link">Account settings</a>
									<a href="#" title="" class="home-mobile-buttons-block__link account-big-link">Start a new design</a>
									<a href="account-orders.html" title="" class="home-mobile-buttons-block__link account-small-link">My orders</a>
									<a href="account-payments.html" title="" class="home-mobile-buttons-block__link account-big-link">Payment settings</a>
						</div>
						<button class="account-nav__next" style="display: flex;">
							<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
						</button>
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
				<h4 class="account-block__navigation--user-heading">
				Hi, <?php echo $cust_name; ?>
				</h4>
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
					<span class="wellome-txt">Welcome,</span> 
					<?php echo $cust_name; ?>! 
					<span>How are you today?</span>
					</p>
					<p class="account-block__wellcome--text">
					<?php 
					$ts = time();
					echo date("d D Y, l", $ts);
					?>
					</p>
				</div>
				<div class="account-block__dashboard">
					<div class="account-block__dashboard-links">
						<div class="account-block__dashboard-links--wrapper">
							<a href="#" title="" class="account-block__dashboard-links--link-fixed"></a>											
							<div class=" account-block__dashboard-links--content my-design">
								<div class="account-block__dashboard-links--heading-block">
									<p class="account-block__dashboard-links--heading">My Designs</p>
									<?php
									echo $svg_my_designs;
									?>
								</div>							
								<div class="account-block__dashboard-links--holder">
									<a href="#" title="" class="account-block__dashboard-links--link">View my design</a>
									<a href="#" title="" class="account-block__dashboard-links--link">Start a new disign</a>
								</div>
							</div>
						</div>
						<div class="account-block__dashboard-links--wrapper">
							<a href="account-orders.html" title="" class="account-block__dashboard-links--link-fixed"></a>
								<div class=" account-block__dashboard-links--content my-order">
									<div class="account-block__dashboard-links--heading-block">
										<p class="account-block__dashboard-links--heading">
											My orders
											<svg xmlns="http://www.w3.org/2000/svg" width="23.667" height="23.675" viewBox="0 0 23.667 23.675"><defs><style>.search-order{fill:#384765;}</style></defs><g transform="translate(-0.08)"><g transform="translate(0.08)"><g transform="translate(0)"><path class="search-order" d="M9.8,0a9.722,9.722,0,1,0,9.722,9.722A9.722,9.722,0,0,0,9.8,0Zm0,16.062a6.34,6.34,0,1,1,6.34-6.34A6.34,6.34,0,0,1,9.8,16.062Z" transform="translate(-0.08)"/></g></g><g transform="translate(16.982 16.91)"><path class="search-order" d="M326.251,323.939l-3.381-3.381a1.692,1.692,0,0,0-2.392,2.392l3.381,3.381a1.692,1.692,0,0,0,2.392-2.392Z" transform="translate(-319.982 -320.062)"/></g></g></svg>
										</p>
										<?php
										echo $svg_my_orders;
										?>
									</div>
									<div class="account-block__dashboard-links--holder">
							<a href="<?php echo SITEROOT; ?>account-orders.html" title="" class="account-block__dashboard-links--link">View Order Receipt</a>
							<a href="<?php echo SITEROOT; ?>account-orders.html" title="" class="account-block__dashboard-links--link">View all</a>
						</div>
					</div>
				</div>							
				<div class="account-block__dashboard-links--wrapper">
					<a href="<?php echo SITEROOT; ?>account-idea-folder.html" title="" class="account-block__dashboard-links--link-fixed"></a>
					<div class=" account-block__dashboard-links--content idea-folder">
						<div class="account-block__dashboard-links--heading-block">
							<p class="account-block__dashboard-links--heading">Idea folder</p>
							<img src="<?php echo SITEROOT; ?>images/idfolder.svg" alt="" class="img-fluid">
						</div>
						<div class="account-block__dashboard-links--holder">
							<a href="<?php echo SITEROOT; ?>account-idea-folder.html" title="" class="account-block__dashboard-links--link">View saved content</a>
						</div>
					</div>
				</div>				
				<div class="account-block__dashboard-links--wrapper">
					<a href="<?php echo SITEROOT; ?>account-settings.html" title="" class="account-block__dashboard-links--link-fixed"></a>
					<div class=" account-block__dashboard-links--content my-account">
						<div class="account-block__dashboard-links--heading-block">
							<p class="account-block__dashboard-links--heading">My account</p>
							<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 96 96"><defs><style>.user{fill:#949dae;}</style></defs><g transform="translate(0)"><g transform="translate(0)"><path class="user" d="M81.941,62.059A47.816,47.816,0,0,0,63.7,50.618a27.75,27.75,0,1,0-31.4,0A48.076,48.076,0,0,0,0,96H7.5a40.5,40.5,0,1,1,81,0H96A47.687,47.687,0,0,0,81.941,62.059ZM48,48A20.25,20.25,0,1,1,68.25,27.75,20.273,20.273,0,0,1,48,48Z" transform="translate(0)"/></g></g></svg>
						</div>
						<div class="account-block__dashboard-links--holder">
							<a href="<?php echo SITEROOT; ?>account-settings.html" title="" class="account-block__dashboard-links--link">Change Password</a>
							<a href="<?php echo SITEROOT; ?>account-settings.html" title="" class="account-block__dashboard-links--link">Change Address</a>
							<a href="<?php echo SITEROOT; ?>account-settings.html" title="" class="account-block__dashboard-links--link">Update Preferences</a>
						</div>
					</div>
				</div>
			</div>
			<div class="account-block__dashboard-static">
				<div class="account-block__dashboard-static--wrapper diy">
					<p class="account-block__dashboard-static--image">
					<?php
					echo $svg_diy;					
					?>
					</p>
					<div class="account-block__dashboard-static--text-block">
						<p class="account-block__dashboard-static--number">2 457</p>
						<p class="account-block__dashboard-static--text">Successful DIY Installations</p>
					</div>
				</div>
				<div class="account-block__dashboard-static--wrapper design-tool">
					<p class="account-block__dashboard-static--image">
					<?php
					echo $svg_users; 
					?>
					</p>
					<div class="account-block__dashboard-static--text-block">
						<p class="account-block__dashboard-static--number">10 214</p>
						<p class="account-block__dashboard-static--text">Current users in design tool</p>
					</div>
				</div>
				<div class="account-block__dashboard-static--wrapper designs">
					<p class="account-block__dashboard-static--image">
					<?php
					echo $svg_users; 
					?>
					</p>
					<div class="account-block__dashboard-static--text-block">
						<p class="account-block__dashboard-static--number">6 873</p>
						<p class="account-block__dashboard-static--text">Current users submitting designs</p>
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

				</ul>
			</nav>



<!-- Modal Folder list view -->
<div class="modal fade" id="manageFolders" tabindex="-1" role="dialog" aria-labelledby="#manageHousesTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title manage-house-tite" id="manageHousesTitle">Title house name 1 - Living Room
				</h5>
						
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body manage-house-modal-body">
				<div class="row">
					<div class="col-12">
						<div class="manage-house-houses">
							<table class="manage-house-houses__table">
							<thead>
							<tr>
								<th>Folder name</th>
								<th>Images</th>
								<th>Subfolders</th>
								<th colspan="2" class="text-center">
									<button class="manage-house-houses__table--button add-house" data-toggle="modal" data-target="#newFolder">New folder</button>
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
								<td>120</td>
								<td>0</td>
								<td>
									<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="1" data-toggle="modal" data-target="#newFolder">Rename</button>
								</td>
								<td>
									<button class="js-manage-house-delete" data-house-id="1" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
									</button>
								</td>
								</tr>
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="2" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="2" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
									</tr>
									<tr>
										<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
										<td>120</td>
										<td>0</td>
										<td>
											<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="3" data-toggle="modal" data-target="#newFolder">Rename</button>
										</td>
										<td>
											<button class="js-manage-house-delete" data-house-id="3" data-toggle="modal" data-target="#deleteFolder">
												<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
											</button>
										</td>
									</tr>
									<tr>
										<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
										<td>120</td>
										<td>0</td>
										<td>
											<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="4" data-toggle="modal" data-target="#newFolder">Rename</button>
										</td>
										<td>
											<button class="js-manage-house-delete" data-house-id="4" data-toggle="modal" data-target="#deleteFolder">
												<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
											</button>
										</td>
									</tr>
									<tr>
										<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
										<td>120</td>
										<td>0</td>
										<td>
											<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="5" data-toggle="modal" data-target="#newFolder">Rename</button>
										</td>
										<td>
											<button class="js-manage-house-delete" data-house-id="5" data-toggle="modal" data-target="#deleteFolder">
												<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
											</button>
										</td>
								</tr>
							
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="6" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="6" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
								</tr>
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="7" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="7" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
								</tr>
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="8" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="8" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
								</tr>
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="9" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="9" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
								</tr>
								<tr>
									<td class="manage-house-houses__folder-name">My custom folder<br /><span>5 items</span></td>
									<td>120</td>
									<td>0</td>
									<td>
										<button class="manage-house-houses__table--button edit js-edit-house" data-house-id="10" data-toggle="modal" data-target="#newFolder">Rename</button>
									</td>
									<td>
										<button class="js-manage-house-delete" data-house-id="10" data-toggle="modal" data-target="#deleteFolder">
											<svg xmlns="http://www.w3.org/2000/svg" width="14.932" height="16.033" viewBox="0 0 14.932 16.033"><defs><style>.trash-small{fill:#fb561b;}</style></defs><g transform="translate(0 0)"><g transform="translate(0 0)"><g transform="translate(0 0)"><path class="trash-small" d="M63.331,124.769a1.305,1.305,0,0,0,1.351,1.168h5.771a1.328,1.328,0,0,0,1.374-1.191l.939-9.8H62.186Z" transform="translate(-60.01 -109.905)"/><path class="trash-small" d="M27.028,2.061h-4.26V1.328A1.283,1.283,0,0,0,21.533,0H18.577a1.282,1.282,0,0,0-1.306,1.259q0,.035,0,.07v.733h-4.26a.458.458,0,0,0,0,.916H27.028a.458.458,0,1,0,0-.916Zm-5.176-.733v.733H18.188V1.328a.366.366,0,0,1,.389-.412h2.886a.366.366,0,0,1,.391.34A.362.362,0,0,1,21.852,1.328Z" transform="translate(-12.554 0)"/></g></g></g></svg>
										</button>
									</td>
								</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal-footer manage-house-modal-footer">
				<button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#newFolder">Add new folder</button>
			</div>
		</div>
	</div>
</div>



<script src="<?php echo SITEROOT; ?>app.js"></script>
</body>
</html>
		
	