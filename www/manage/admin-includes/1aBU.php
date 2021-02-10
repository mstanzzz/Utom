<?php 
	//helper function to set active class on appropriate nav items
	function isPageType($href) 
	{
	//get current page URI
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos($uri,$href) > 0){
			return true;	
		}
		else {
			return false;	
		}
	}
	//$isEditPage = isPageType("manage1/cms/pages/");
	
	
$parts = Explode('/', $_SERVER["PHP_SELF"]);
$lev = count($parts);
echo "<br />";
echo "<br />";
if($lev <= 3){
	// GOOD
	$man_root = './manage';
}elseif($lev == 4){
	// GOOD
	$man_root = '../../manage';
}elseif($lev >= 5){
	$man_root = '../../../manage';		
}else{
	$man_root = '';
}


echo "<br />";
echo "PHP_SELF: ".$_SERVER["PHP_SELF"];
echo "<br />";
echo "lev: ".$lev;
echo "<br />";
echo $man_root."/js/chosen/chosen.css";
echo "<br />";
echo "<br />";
echo "<br />";

//exit;

//   ../manage/jquery.multiselect.filter.css

//  ..//jquery.multiselect.filter.css


?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo (isset($page_title)) ? $page_title : '' ?> | Site Management</title>

<link href="<?php echo $man_root; ?>/js/fancybox2/source/jquery.fancybox.css?v=2.1.4" media="screen"  type="text/css" rel="stylesheet" />

<link href="<?php echo $man_root; ?>/js/chosen/chosen.css" media="screen" type="text/css" rel="stylesheet"/>
<link href="<?php echo $man_root; ?>/css/jquery.multiselect.css" media="screen" type="text/css" rel="stylesheet"/>
<link href="<?php echo $man_root; ?>/jquery.multiselect.filter.css" media="screen" type="text/css" rel="stylesheet"/>
<link href="<?php echo $man_root; ?>/css/custom-theme/jquery-ui-1.8.23.custom.css" media="screen"  type="text/css" rel="stylesheet"/>
<link href="<?php echo $man_root; ?>/css/print.css" media="print" type="text/css" rel="stylesheet"/>
<link href="<?php echo $man_root; ?>/css/forms.css" media="print" type="text/css" rel="stylesheet"/>

<link href="<?php echo $man_root; ?>/css/manageStyle.css" media="print" type="text/css" rel="stylesheet"/>


<script src="<?php echo $man_root; ?>/js/jquery-1.8.1.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/formtoggles.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/inlineConfirmation.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/fancybox2/source/jquery.fancybox.js?v=2.1.4"></script>
<script type="text/javascript" src="<?php echo $man_root; ?>/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo $man_root; ?>/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo $man_root; ?>/js/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/jquery.multiselect.min.js" ></script>

<script type="text/javascript" src="<?php echo $man_root; ?>/js/jquery.multiselect.filter.min.js"></script>
<script type="text/javascript" src="<?php echo $man_root; ?>/js/bootstrapcustom.min.js"></script>


<script type="text/javascript" src="<?php echo $man_root; ?>/js/ctg_form_validation.js"></script>


<script type="text/javascript">

$(document).ready(function(){
	
	//$('.fancybox').fancybox();
	
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});	

	
		
});

</script>

