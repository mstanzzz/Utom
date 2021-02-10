<?php
	if(isset($_GET['when_active'])) $_SESSION['temp_page_fields']['when_active'] = $_GET['when_active'];
	if(isset($_GET['when_expired'])) $_SESSION['temp_page_fields']['when_expired'] = $_GET['when_expired'];
	if(isset($_GET['name'])) $_SESSION['temp_page_fields']['name'] = $_GET['name'];
	if(isset($_GET['description'])) $_SESSION['temp_page_fields']['description'] = $_GET['description'];
	if(isset($_GET['type'])) $_SESSION['temp_page_fields']['type'] = $_GET['type'];
	if(isset($_GET['coupon_code'])) $_SESSION['temp_page_fields']['coupon_code'] = $_GET['coupon_code'];
	if(isset($_GET['percent_off'])) $_SESSION['temp_page_fields']['percent_off'] = $_GET['percent_off'];
	if(isset($_GET['amount_off'])) $_SESSION['temp_page_fields']['amount_off'] = $_GET['amount_off'];
	if(isset($_GET['hide'])) $_SESSION['temp_page_fields']['hide'] = $_GET['hide'];
	if(isset($_GET['if_greater_than'])) $_SESSION['temp_page_fields']['if_greater_than'] = $_GET['if_greater_than'];
	if(isset($_GET['if_less_than'])) $_SESSION['temp_page_fields']['if_less_than'] = $_GET['if_less_than'];
	if(isset($_GET['can_use_with_other_discounts'])) $_SESSION['temp_page_fields']['can_use_with_other_discounts'] = $_GET['can_use_with_other_discounts'];

?>