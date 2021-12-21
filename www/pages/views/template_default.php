<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/includes/config.php');
require_once($real_root.'/includes/class.shopping_cart.php');
require_once($real_root.'/includes/accessory_cart_functions.php');
require_once($real_root.'/includes/class.shopping_cart_item.php');
require_once($real_root.'/includes/class.store_data.php');
require_once($real_root.'/includes/class.nav.php');
require_once($real_root.'/includes/class.customer_login.php');
require_once($real_root.'/includes/class.seo.php');
require_once($real_root.'/includes/class.company.php');
$_SESSION['no_order_refreash'] = 0;

$lgn = new CustomerLogin;
$store_data = new StoreData;
$cart = new ShoppingCart($dbCustom);
$item = new ShoppingCartItem;
$nav = new Nav;

$company = new Company;
$comp_basic = $company->getCompanyBasicInfo($dbCustom);
$navCats = $nav->getNavCats($dbCustom,'footer');

$id = (isset($_GET['id'])) ? $_GET['id'] : 1;
if(!is_numeric($id)) $id = 0;
if($id<2)$id=1;


if(isset($_POST['si_email'])){
	$username = trim($_POST['si_email']);
	$password = trim($_POST['si_pswd']);
	$lgn->login($dbCustom, $username, $password);
	
	
	if(!$lgn->isLogedIn()){
		$msg = "Incorrect user name or password";	
	}
	
}


if(isset($_POST['reg_name'])){

	$name = trim($_POST['reg_name']);
	$username = trim($_POST['reg_email']);
	$password = trim($_POST['reg_password']);
	$get_letter = $_POST['r'];
	$lgn->create_user($dbCustom, $password, $username, $name);

}

$ret_page =  (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 'home';
$slug = (isset($_GET['slug'])) ? $_GET['slug'] : 'home';
$page = $slug;

require_once($real_root."/pages/controllers/".$page.".php"); 
require_once($real_root."/".$page.".php"); 	
?>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>

<script>
/* usefull
window.onload = function() {
    if (window.jQuery) {  
        alert("Yeah!");
    } else {
        alert("Doesn't Work");
    }
}
*/

function clear_cart(){	
	var url_str = 'pages/cart-ajax/ajax-clear-cart.php';
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		success: function(data) {
			alert(data);				
		}
	});
	alert("CLEAR");	
}


function add_item(item_id){
	alert("item_id "+item_id);
	var qty = 1;
	var addMsg = "1 Item Added";
	
	var url_str = "<?php echo SITEROOT; ?>pages/cart-ajax/ajax-add-item.php?item_id="+item_id+"&qty="+qty;
	
	alert(url_str);
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: url_str,
		success: function(data) {	
			alert(data);
			
			//$(".add_to_cart_msg").css( "color", "red");		
			//$(".add_to_cart_msg" ).html(addMsg);
			
		}
	});
}

function sign_in(){
	//alert("sign_in");	

	$("#si_form").submit();

	/*	
	var sign_in_email = $("#sign_in_email").val();
	var sign_in_pswd = $("#sign_in_pswd").val();

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: 'ajax/ajax-sign-in.php?email='+sign_in_email+'&pswd='+sign_in_pswd,
	  success: function(data) {
		if(data.indexOf("y") > -1){
			alert("signin success");
			show_logged_in_menu();
		}else{
			
			alert("signin problem");
	  	}
	  }
	});
	*/
}

function register(){
	alert("register");	
	var register_name = $("#register_name").val();
	var register_email = $("#register_email").val();
	var register_pswd = $("#register_pswd").val();
	var register_c_pswd = $("#register_c_pswd").val();
	alert(register_name);
	alert(register_email);
	alert(register_pswd);
	alert(register_c_pswd);
}

function getScreenWidth(){
	var h = $(window).height();
	var w = $(window).width();
	alert("------- width:"+w);
}


function accessories_select_option(s_attr){

	var opt = 0;

	if(s_attr == 0){				
		opt  = $("#s_attr_0").val();
		$("#opt_0").val(opt);		
		alert("opt_0: "+opt);		
	}
	
	if(s_attr == 1){			
		opt  = $("#s_attr_1").val();		
		$("#opt_1").val(opt);				
		alert("opt_1: "+opt);	
	}
	
	if(s_attr == 2){				
		opt  = $("#s_attr_2").val();		
		$("#opt_2").val(opt);				
		alert("opt_2: "+opt);	
	}
	
	if(s_attr == 3){				
		opt  = $("#s_attr_3").val();		
		$("#opt_3").val(opt);				
		alert("opt_3: "+opt);	
	}
}


$('.js-account-login').on('click', function () {
    $(this).css('display', 'none');  
	$(this).siblings('.account-menu-visible').css('display', 'none');
    $(this).siblings('.account-menu-hidden').css('display', 'block');
	$(this).parents('.js-account-wrap').find('.dropdown-toggle.account').addClass('login');
    $(this).parents('.js-account-wrap').find('.account-name').css('display', 'inline-block');
});

$('.js-account-logout').on('click', function () {
    $(this).css('display', 'none');
    $(this).siblings('.account-menu-visible').css('display', 'block');
    $(this).siblings('.account-menu-hidden').css('display', 'none');
	$(this).parents('.js-account-wrap').find('.dropdown-toggle.account').removeClass('login');
    $(this).parents('.js-account-wrap').find('.account-name').css('display', 'none');
	
}); 


function show_logged_in_menu(){
	
	$(".js-account-login").css('display', 'none');
	$(".js-account-login").siblings('.account-menu-visible').css('display', 'none');
	$(".js-account-login").siblings('.account-menu-hidden').css('display', 'block');
	$(".js-account-login").parents('.js-account-wrap').find('.dropdown-toggle.account').removeClass('login');
	$(".js-account-login").parents('.js-account-wrap').find('.account-name').css('display', 'inline-block');
	
}

function show_logged_out_menu(){

    $('.js-account-logout').css('display', 'none');
    $('.js-account-logout').siblings('.account-menu-visible').css('display', 'block');
    $('.js-account-logout').siblings('.account-menu-hidden').css('display', 'none');
	$('.js-account-logout').parents('.js-account-wrap').find('.dropdown-toggle.account').removeClass('login');
    $('.js-account-logout').parents('.js-account-wrap').find('.account-name').css('display', 'none');
}

<?php
if($lgn->isLogedIn()){
?>	
	
	show_logged_in_menu();

<?php
}else{
?>	
	show_logged_out_menu();

<?php	
}
?>


</script>
