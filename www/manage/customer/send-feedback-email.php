<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.customer_account.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.saas_customer.php');

$CustAccnt = new CustomerAccount;
$saas_cust = new SaasCustomer;


if(!isset($_SESSION['profile_company'])) $_SESSION['profile_company'] = 'Closets To Go';

$company_email = $saas_cust->getCompanyEmail();


$name = 'Name';

$to = 'mark.stanz@gmail.com';

$email_subject = 'We Would Like Your Feedback';

$message = '';

$message .= "<html lang='en'>";
$message .= "<meta charset='utf-8'>";
$message .= "<body>";

$message .= "<div style=\"width: 600px; margin: 0 auto; background-color: #ffffff; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.4em; font-weight: lighter; font-weight: 200; color: #000000;\">";

$message .= "<div style='width: 200px; height: 100px; float: left;'></div>";
$message .= "<h1 style='font-weight: lighter; font-weight: 200; font-size: 28px;'>Thank You For ... !</h1>";
$message .= "<br style='clear: left;' />";
$message .= "<div style='width: 550px; padding-left: 25px; padding-right: 25px;'>";
$message .= "<p>Dear ".$name.",</p>";
		
$message .= "<p>Thank you for your recent .... with ".$_SESSION['profile_company']."! ....</p>";
		
$message .= "<div style='margin-top: 20px;'>";
$message .= $link;
$message .= "</div>";
$message .= "</div>";

$message .= "</body>";
$message .= "</html>";


$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $company_email";
$headers .= "\r\n";
$headers .= "Return-path: help@closetstogo.com";

if(!mail($to, $email_subject, $message, $headers)){

}

?>