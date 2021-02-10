<?php

/*
I'll refer to this as the "User Profile Widget" throughout this email.

The top left will always have the current date, regardless of the status of the user (clocked in, out, etc). Same for the top right's current time.

The Job Role button may change as the user's Job Level or Job Role changes.
It will display what that user is currently set as, so if they were originally a level 3 installer, but they "level up" (this will be a process later, but right now we'll manually set levels) to 4, the button will change to say "level 4 installer".

The text under their first and last name will say "You are not clocked in" if they are not clocked in; "You are clocked in" if they are clocked in, and "You are at lunch" if they are at lunch but in blue text to differentiate from the clock in/out text.

When a user clocks in, the "clock in" button becomes faded in color (see the "Main Page_Lunch Out Mode" picture in the finished comp images directory of the install repo) and cannot be interacted with.

When a user clocks out, the same thing happens with the "clock out" button as it would with the "clock in" button. Additionally, when a user clocks out, if they are a Team Lead, they will be prompted with a separate pop-up notification asking them to submit a report, which will be saved in the Job History page.

When a user clicks the "lunch in" button, both the "clock in" and "clock out" buttons will both become faded in color; the text for "lunch in" will then change to "lunch out" and the color of the button shift to a brighter blue. They will be allocated a default of 30 minutes for the "lunch" time. When the user reaches 5 minutes left of their lunch, and they haven't clocked in, a pop-up will display alerting them their lunch is almost over. They can then choose to be reminded later, or clock in right then.

Finally, the hours/minutes clocked in are total for that day, minus the 30 minute lunch. It will actively count up until the user fully clocks out.

Functionally, Jeff wants this to be linked to tsheets' functionality. Eventually we may support other time clocks, but this will be the first one we will embed in our software. Tsheets separates out "clock in/out" and "lunch in/out" functionally, so that's why we're doing it in that fashion.

https://developers.tsheets.com/docs/api/

I've attached all the related comps for what I've discussed here. If you feel I missed anything, please let me know and I'll cover it.

Sincerely,

Jeremiah Henning
IT Director
*/

?>

<!--
<a onclick="test();">GGGGGGGGG</a>
-->

<input type="hidden" id="is_in" name="is_in" value="0" />
<input type="hidden" id="is_out" name="is_out" value="0" />

<script>


function text(){

	console.log("kkkkk");


}



function set_toggle_out(){
	console.log("kkkkk");

	var is_out = document.getElementById("is_out").value;
	var url_str = "<?php echo SITEROOT; ?>/manage/dashboard/ajax/ajax-set-toggle-out.php?is_out="+is_out;

	axios.get(url_str).then(function(response){
		console.log(response);

		document.getElementById("is_out").value = response.data;

		if(response.data == '1'){
			document.getElementById("in_out_msg").innerHTML = "Clocked Out";
			document.getElementById("button_out").style.backgroundColor = "#b1bfbe";
		}else{
			document.getElementById("in_out_msg").innerHTML = "";
			document.getElementById("button_out").style.backgroundColor = "#E9D8DA";
		}


	}).catch(function(error){
		console.log(error);
	});
}

function set_toggle_in(){

	var is_in = document.getElementById("is_in").value;

	var url_str = "<?php echo SITEROOT; ?>/manage/dashboard/ajax/ajax-set-toggle-in.php?is_in="+is_in;

	axios.get(url_str).then(function(response){
		console.log(response);
		document.getElementById("is_in").value = response.data;
		if(response.data == '1'){
			document.getElementById("in_out_msg").innerHTML = "Clocked In";
			document.getElementById("button_in").style.backgroundColor = "#b1bfbe";
		}else{
			document.getElementById("in_out_msg").innerHTML = "Clocked Out";
		}
	}).catch(function(error){
		console.log(error);
	});

}

function set_toggle_lunch_in(){

	var is_out = document.getElementById("is_out").value;
	var url_str = "<?php echo SITEROOT; ?>/manage/dashboard/ajax/ajax-set-toggle-lunch.php?is_out="+is_out;
	axios.get(url_str).then(function(response){
		console.log(response);
		document.getElementById("is_out").value = response.data;
		if(response.data == '1'){
			document.getElementById("in_out_msg").innerHTML = "At Lunch";
			document.getElementById("button_in").style.backgroundColor = "#b1bfbe";
			document.getElementById("button_out").style.backgroundColor = "#b1bfbe";
			document.getElementById("lunch_in").style.backgroundColor = "#b1bfbe";
			document.getElementById("lunch_in").innerHTML = "At Lunch";
		}else{
			alert("no return");
			document.getElementById("in_out_msg").innerHTML = "";
		}

	}).catch(function(error){
		console.log(error);
	});

}

function set_toggle_home(){

	document.getElementById("button_in").style.backgroundColor = "#b1bfbe";
	document.getElementById("button_out").style.backgroundColor = "#b1bfbe";
	document.getElementById("lunch_in").style.backgroundColor = "#b1bfbe";
	document.getElementById("in_out_msg").innerHTML = "At Home";

}


function nav_to_dest(where){


	 alert(where);


	window.location.href = where+".php";


}


</script>

<?php
if(!isset($ln_active )) $ln_active = '';

$user_name_short = "John Smith";

$user_position_short = "My Position";

?>


<div class="left-sidebar-container expanded">
	<div class="left-sidebar-content">
		<div class="quick-links box-shadow">

			<div class="date"><span>TUE, </span>&nbsp;9/14<span>, 2019</span></div>

			<div class="time">12:05 PM</div>

			<div class="customer-name">Peter P<span>arrison</span> </div>

			<div class="customer-level">
				<div class="btn-installer btn-shadow btn-level">Lv. 3 <span>&nbsp;Installer</span></div>
			</div>

			<div class="gnMap-clocked-in-text">Clocked-in</div>
			<div class="gnMap-clocked-in-date">
				Today 05 Hrs 35 min
			</div>

			<div class="trainee-buttons-in-out-home">
				<div class="btn-in btn-shadow"><a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"><span>In</span></a></div>
				<div class="btn-out btn-shadow"><a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"><span>Out</span></a></div>
				<div class="btn-home btn-shadow"><a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page.php"><span>HOME</span></a></div>
				<div class="btn-lunch-in btn-shadow"><a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"><span>Lunch In</span></a></div>
			</div>

		</div>

		<!-- DASHBOARD BUTTON -->
		<div class="btn-design-preview-dashboard-container left-sidebar-tabs-box-shadow">
			<div class="btn-design-preview-dashboard">
				<span class="ijd-cd-dashboard-title"><strong>SELECT DASHBOARD</strong></span><br>
				<span class="design-preview-dashboard-text">YOU ARE IN JOB DASHBOARD</span>
			 </div>
			 <div class="btn-design-preview-dashboard-button">
				 <a href="#"><span>SELECT</span></a>
			 </div>
		</div>
		<!-- INBOUND ORDERS BUTTON -->
		<div class="btn-ijd-cd-inbound-orders-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-inbound-orders">
				<div class="btn-ijd-cd-inbound-orders-icon">

				</div>
				<div class="btn-ijd-cd-inbound-orders-title">
					<span>INBOUND ORDERS</span>
				</div>
				<div class="btn-ijd-cd-inbound-orders-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS.php">
						<span>VIEW</span>
					</a>
				</div>
			</div>
		</div>
		<div class="btn-ijd-cd-inbound-orders-order-rooms-container">
			<div class="btn-ijd-cd-inbound-orders-order-rooms left-sidebar-tabs-box-shadow">
				<img src="../assets/img/icon-orders-white.png" alt="Order Rooms">
				<div class="btn-ijd-cd-order-rooms-title">
					<span>ORDER ROOMS</span>
				</div>
				<div class="btn-ijd-cd-order-rooms-order-number">
					<span>ORDER #12345678</span>
				</div>
			</div>
			<div class="btn-ijd-cd-inbound-orders-room-detail left-sidebar-tabs-box-shadow">
				<img src="../assets/img/icon-email-content-white.png" alt="Room Detail">
				<div class="btn-ijd-cd-order-rooms-title">
					<span>ROOM DETAIL</span>
				</div>
				<div class="btn-ijd-cd-order-rooms-order-number">
					<span>ROOM 03</span>
				</div>
			</div>
		</div>
		<!-- ORDERS PAGE TEAM MEMBER STATUS -->
		<div class="btn-ijd-cd-io-team-member-status-container left-sidebar-tabs-box-shadow">
			<img src="../assets/img/team-member.png" alt="Team Member Status">
			<div class="btn-ijd-cd-io-team-member-status-title">
				TEAM MEMBERS STATUS
			</div>
			<div class="btn-ijd-cd-io-team-member-status-button">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_TEAM MEMBER STATUS.php">
					<span>VIEW</span>
				</a>
			</div>
		</div>
		<!-- NAVIGATE TO JOB SITE BUTTON -->
		<div class="btn-ijd-cd-navigate-job-site-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-navigate-job-site-address">
				123 New York Ave Unit A<br>
				New York, NY  12345
			</div>
			<div class="btn-ijd-cd-navigate-job-site-button">
				<a class="btn-ijd-cd-navigate-job-site" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map.php">NAVIGATE TO JOB SITE</a>
			</div>
		</div>
		<!-- CUSTOMER INFO BUTTON -->
		<div class="btn-ijd-cd-customer-info-container left-sidebar-tabs-box-shadow">
			<div class="btn-customer-info">
				<span class="ijd-cd-customer-info-title">CUSTOMER INFO</span><br>
				<span class="ijd-cd-customer-info-text"><strong>VIEWING</strong></span>
			 </div>
		</div>
		<!-- ORDER FULFILLMENT DASHBOARD VIEWING SECTION -->
		<div class="viewing-order-fulfillment-container">
			<div class="viewing-order-fulfillment">
				<div class="viewing-ijd-cd-design-preview-viewing-text">
					Viewing
				</div>
				<div class="viewing-ijd-cd-design-preview-section-menu-container">
					<div class="viewing-ijd-cd-design-preview-section">
						<img src="../assets/img/icon-orders.png">
						<br>
						<span class="viewing-ijd-cd-design-preview-section-title">Order<br>Fulfillment</span>
					</div>
					<div class="expandMenuButton">
						<div class="menu-close">
							SWIPE TO<br><br><span>CLOSE<br>MENU</span> <img class="left-menu-arrow" src="../assets/img/arrow-menu-close-white.png" alt="">
						</div>
						<div class="menu-expand">
							SWIPE TO<br><br><span>EXPAND<br>MENU</span> <img class="left-menu-arrow" src="../assets/img/arrow-menu-white.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- VIEWING SECTION -->
		<div class="viewing-ijd-cd-document-center-container">
			<div class="viewing-ijd-cd-design-preview-viewing-text">
				Viewing
			</div>
			<div class="viewing-ijd-cd-design-preview-section-menu-container">
				<div class="viewing-ijd-cd-design-preview-section">
					<img src="../assets/img/icon-home-big.png">
					<br>
					<span class="viewing-ijd-cd-design-preview-section-title">JOB CENTER<br>MAIN PAGE</span>
				</div>
				<div class="expandMenuButton">
					<div class="menu-close">
						SWIPE TO<br><br><span>CLOSE<br>MENU</span> <img class="left-menu-arrow" src="../assets/img/arrow-menu-close.png" alt="">
					</div>
					<div class="menu-expand">
						SWIPE TO<br><br><span>EXPAND<br>MENU</span> <img class="left-menu-arrow" src="../assets/img/arrow-menu.png" alt="">
					</div>
				</div>
			</div>
		</div>

		<!-- VIEWING SECTION EXPANDED -->
		<div class="viewing-design-preview-expanded-container left-sidebar-tabs-box-shadow">
			<div class="viewing-design-preview-expanded-title-container">

				<div class="viewing-design-preview-expanded-title-img">
					<img src="../assets/img/user-profile-management-small.png">
				</div>

				<div class="viewing-design-preview-expanded-title">
					<strong>CUSTOMER INFORMATION</strong>
				</div>

				<div class="viewing-design-preview-expanded-viewing-text">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Customer Information.php">
		        <span>VIEW</span>
		      </a>
				</div>

			</div>

			<hr class="viewing-ijd-cd-expanded-hr">

			<div class="viewing-design-preview-expanded-customer-info">
				<div class="viewing-design-preview-expanded-customer-name">
					<span>CUSTOMER NAME</span>
					<span>Adams Aria</span>
				</div>
				<div class="viewing-design-preview-expanded-job-number">
					<span>JOB NUMBER</span>
					<span>#1234567</span>
				</div>
			</div>

		</div>

		<!-- INSTALLATION PROGRESS -->
		<div class="btn-ijd-cd-installation-progress-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-installation-Progress-bg">

			</div>
			<div class="btn-ijd-cd-installation-progress-title">
				<span>INSTALLATION PROGRESS</span>
				<span>50%</span>
			</div>
			<div class="btn-ijd-cd-installation-progress-button">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Installation Progress.php">
					<span>IN PROGRESS</span>
				</a>
			</div>
		</div>

		<!-- TEAM MEMBER STATUS -->
		<div class="btn-ijd-cd-team-member-status-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-team-member-status-title">
				TEAM MEMBERS STATUS
			</div>
			<div class="btn-ijd-cd-team-member-status-button">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Installation Team_Team Lead.php">
					<span>In Progress</span>
				</a>
			</div>
		</div>

		<!-- SPECIAL INSTRUCTIONS -->
		<div class="btn-ijd-cd-left-sidebar-mixed-tabs-container btn-ijd-cd-left-sidebar-special-instructions-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-special-instructions-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-title">
					<span>SPECIAL INSTRUCTIONS</span>
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Special Instructions.php">
						<span>READ NOW</span>
					</a>
				</div>

			</div>

			<hr>

			<div class="btn-ijd-cd-special-instructions-read-before-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-title">
					READ BEFORE STARTING INSTALLATION
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Special Instructions.php">
						<span><img src="../assets/img/icon-forward.png" alt="READ BEFORE STARTING INSTALLATION"></span>
					</a>
				</div>

			</div>
		</div>

		<!-- SPECIAL INSTRUCTIONS -->
		<div class="btn-sidebar-special-instructions-container">
			<div class="btn-sidebar-special-instructions-subitems-container">
				<div class="btn-sidebar-special-instructions-subitem btn-sidebar-subitem-special-instructions">
					<div class="btn-sidebar-subitem-title">
						SPECIAL INSTRUCTIONS
					</div>
					<div class="btn-sidebar-special-instructions-subitem-viewing-text">
						READING
					</div>
				</div>
				<div class="btn-sidebar-special-instructions-subitem btn-sidebar-subitem-job-site-documents">
					<div class="btn-sidebar-subitem-title">
						JOB SITE DOCUMENTS
					</div>
					<div class="btn-sidebar-special-instructions-subitem-viewing-text">
						<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Special Instructions_Job Site Documents.php">OPEN</a>
					</div>
				</div>
			</div>

		</div>

		<!-- DOCUMENTING PROGRESS -->
		<div class="btn-ijd-cd-left-sidebar-mixed-tabs-container btn-ijd-cd-left-sidebar-documenting-progress-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-documenting-progress-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-title">
					<span>DOCUMENTING PROGRESS</span>
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Documenting Progress.php">
						<span>START</span>
					</a>
				</div>

			</div>

			<hr>

			<div class="btn-ijd-cd-documenting-progress-submit-photos-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-title">
					SUBMIT PROGRESS PHOTOS
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Documenting Progress.php">
						<span><img src="../assets/img/icon-forward.png" alt="SUBMIT PROGRESS PHOTOS"></span>
					</a>
				</div>

			</div>
		</div>

		<!-- DESIGN PREVIEW -->
		<div class="btn-ijd-design-preview-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-design-preview-title">
				<span>DESIGN PREVIEW</span>
			</div>
			<div class="btn-ijd-design-preview-text">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Design Preview.php">
					<span>VIEW</span>
				</a>
			</div>
		</div>

		<!-- ISSUES GALLERY -->
		<div class="btn-ijd-design-preview-issues-gallery-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-design-preview-issues-gallery-title">
				<span>ISSUES GALLERY</span>
			</div>
			<div class="btn-ijd-design-preview-issues-gallery-status">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Optional Pictures.php">
					<span>VIEW</span>
				</a>
			</div>
		</div>

		<!-- ISSUES DURING INSTALLATION -->
		<div class="btn-ijd-cd-left-sidebar-mixed-tabs-container btn-ijd-cd-left-sidebar-issues-during-installation-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-cd-issues-during-installation-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-title">
					<span>ISSUES DURING INSTALLATION</span>
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-button">
					<div class="btn-ijd-cd-left-sidebar-mixed-tab-button-icon">
						<img src="../assets/img/icon-question.png">
					</div>
					<div class="btn-ijd-cd-left-sidebar-mixed-tab-button-button">
						<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Issues During Installation.php">
							<span>Contact us</span>
						</a>
					</div>
				</div>

			</div>

			<hr>

			<div class="btn-ijd-cd-second-row-container">

				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-title">
					Submit feedback of issues during installation
				</div>
				<div class="btn-ijd-cd-left-sidebar-mixed-tab-second-row-button">
					<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Issues During Installation.php">
						<img src="../assets/img/icon-forward.png" alt="READ BEFORE STARTING INSTALLATION">
					</a>
				</div>

			</div>
		</div>

		<!-- DOCUMENT CENTER -->
		<div class="btn-ijd-design-preview-document-center-container left-sidebar-tabs-box-shadow">
			<div class="btn-ijd-design-preview-issues-gallery-title">
				<span>DOCUMENT CENTER</span>
			</div>
			<div class="btn-ijd-design-preview-issues-gallery-status">
				<a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Document Center.php">
					<span>START</span>
				</a>
			</div>
		</div>


	</div>
</div>
