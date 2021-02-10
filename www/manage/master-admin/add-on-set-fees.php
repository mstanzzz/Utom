<?php



if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;
$page_title = "Add-ons";
$page_group = "admin";
$msg = '';

	


if(isset($_POST['update_fees'])){


	$db = $dbCustom->getDbConnect(USER_DATABASE);
	$sql = "SELECT id
			,name
			,fee
			FROM  module";	
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()) {
	
		$fee = (isset($_POST[$row->id])) ? $_POST[$row->id] : 0;
		
		//echo $fee;
	
		$sql = "UPDATE module id
				SET fee = '".$fee."'
				WHERE id = '".$row->id."'
				";	
		$u_res = mysql_query ($sql);
		
	
	
	
	}



	//header('Location: start.php');


	
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>


function validate(theform){	

	
	return true;

}

function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}

function checkPercent(str){
	
	var ret = 1;
	
	if(!IsNumeric(str)){
		alert("Please enter valid numbers only");
		ret = 0;	
	}else{	
		if(str != 0 && str <= 1){
			alert("Please enter 0 or a number greater than 1");
			ret = 0;
		}
		
		if(str >= 100){
			alert("Please enter a number less than 100");
			ret = 0;
		}
	}
	
	return ret;
}

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});


</script>
</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
    	$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		?>
		<form name="update_fees_form" action="add-on-set-fees.php" method="post">
			<div class="page_actions edit_page">
				<button type="submit" name="update_fees" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
			</div>
			<div class="page_content edit_page">
				<h3>Enter the fee for each add-on.</h3>
				<fieldset>
					<?php
						$db = $dbCustom->getDbConnect(USER_DATABASE);
						$sql = "SELECT id
								,name
								,fee
								FROM  module";
				$result = $dbCustom->getResult($db,$sql);						
						$block = '';
						while($row = $result->fetch_object()) {
							$block .= "<div class='colcontainer formcols'>";
							$block .= "<div class='twocols'><label>";
							$block .= $row->name;
							$block .= "</label></div>";
							$block .= "<div class='twocols'>";
							$block .= "<span class='prepend-input'>$</span><input type='text' name='".$row->id."' class='prepended' value='".$row->fee."'> ";
							$block .= "</div>";
							$block .= "</div>";
						}
						echo $block;
					?>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
