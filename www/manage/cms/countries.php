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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;



$page_title = "Countries";
$page_group = "countries";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';



if(isset($_POST["country"])){

	$country = trim(addslashes($_POST["country"]));
	$country_abr = trim(addslashes($_POST["country_abr"])); 


	$sql = "INSERT INTO countries
		(country, country_abr, profile_account_id) 
		VALUES ('".$country."', '".$country_abr."', '".$_SESSION['profile_account_id']."')";
	$result = $dbCustom->getResult($db,$sql);
	

}




if(isset($_POST["hide"])){

	if(in_array(2,$user_functions_array)){
		$hide = $_POST["hide"]; 
	
		//echo $hide;
	
		
		$sql = "UPDATE countries SET hide = '0' 
				WHERE hide = '1'
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		
		foreach($hide as $key => $value){
			
			$sql = "UPDATE countries SET hide = '1' WHERE country_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
			
		}
		
	
	}else{
		$msg="You must be logged in as 'admin' before this operation can be performed";	
	}
}




require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>

<script>
$(document).ready(function() {
	
	$("a.inline").fancybox();
});



function validate(theform){
	
	return true;
}



</script>
</head>
	<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>


<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	

   <div class="manage_main">
    
    <?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
        echo $bread_crumb->output();
        
	?>

<br /><br />
<div style="float:left; width:450px;">
Check a box to hide a state from the website.

<form name="update_hide_form" action="countries.php" method="post" enctype="multipart/form-data">
<table border="0" width="100%" cellpadding="6">
	<tr>	
		<td width="60%"><div class="head">State / Provence</div></td>
		<td>Hide Country</td>
	</tr>    
    <?php

	$sql = "SELECT country_id, country, hide 
			FROM countries 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY country"; 
$result = $dbCustom->getResult($db,$sql);	
	
	
    while($row = $result->fetch_object()) {
	
    
	$block = "<tr>"; 
 				
				
	$block .= "<td valign='top'>$row->country</td>";			

	$sel =  ($row->hide == 1) ? "checked" : '';	

	$block .= "<td valign='top'><input type='checkbox' name='hide[]' value='$row->country_id' $sel /></td>";			

	$block .= "</tr>";
    
	echo $block;
	}
    ?>
    </table>

	<input type="submit" name="update_countries" value="Update" />
</form>  
</div>


<div style="float:left;">

<form name="add_country_form" action="countries.php" method="post" enctype="multipart/form-data">

	Country Name<br />
    <input type="text" name="country" style="width:160px;"/>
    <br /><br />
    
	Country Abreviation<br />
    <input type="text" name="country_abr" style="width:20px;" />

    <br /><br />
	<input type="submit" value="Add Country" />

</form>
</div>



</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>

</div>
  
    
    <div style="display:none">
        <div id="edit" style="width:800px; height:660px;">
        </div>
    </div>
    
   <div style="display:none">
        <div id="upload" style="width:280px; height:200px;">
        </div>
    </div>
    

</body>
</html>




