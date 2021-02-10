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

$page_title = "Location Settings";
$page_group = "states";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';


// copy states if not exist

		$sql = "SELECT state_id 
			FROM states 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'"; 
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows == 0){
			$sql = "SELECT state, state_abr, country 
				FROM states 
				WHERE profile_account_id = '1'"; 
				
			$res = $dbCustom->getResult($db,$sql);	
				
			while($row = $res->fetch_object($copy_res)) {
				$sql = "INSERT INTO states
						(state
						,state_abr
						,country
						,profile_account_id
						)
						VALUES
						('".$row->state."'
						,'".$row->state_abr."'
						,'".$row->country."'
						,'".$_SESSION['profile_account_id']."'
						)";
						
				$sub_res = $dbCustom->getResult($db,$sql);	
			}
		}
		


if(isset($_POST["update_states"])){

	//if(in_array(2,$user_functions_array)){
		$hide = (isset($_POST["hide"]))? $_POST["hide"] : array(); 
	
		//echo $hide;
	
		
		$sql = "UPDATE states SET hide = '0' WHERE hide = '1' AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);
		
		foreach($hide as $key => $value){
			
			$sql = "UPDATE states SET hide = '1' WHERE state_id = '".$value."'";
			$result = $dbCustom->getResult($db,$sql);
			
			//echo "key: ".$key."   value: ".$value."<br />"; 
			
		}
		
	/*
	}else{
		$msg="You must be logged in as 'admin' before this operation can be performed";	
	}
	*/
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<script>
$(document).ready(function() {
	

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
		<form name="update_hide_form" action="states.php" method="post" enctype="multipart/form-data">
			
            <div class="page_actions edit_page">
				<?php if($admin_access->administration_level > 1){ ?>
                    <button type="submit" name="update_states" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </button>
                    <hr />
                 <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to make changes in this area.
                    </div>            
                <?php } ?>
			</div>
			<div class="page_content edit_page">
				<div class="colcontainer">
					<div class="alert alert-info">This page allows you to remove particular states, provincee or regions from the dropdown select menus in the entire site. The right side displays locations that are currently hidden. Select or deselect items on the left and click save to hide/show the site to these locations.</div>
					<div class="twocols">
					<h3>Select States &amp; Provinces to Hide:</h3>
						<?php
					
						$sql = "SELECT state_id, state, hide 
								FROM states 
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
								ORDER BY country DESC, state"; 
				$result = $dbCustom->getResult($db,$sql);						
						
						$block = "<select multiple='multiple' name='hide[]'>"; 
						while($row = $result->fetch_object()) {
							$sel =  ($row->hide == 1) ? "selected" : '';	
							//$block .= "<option name='hide[]' value='$row->state_id' $sel />$row->state</option>";
							$block .= "<option value='$row->state_id' $sel />$row->state</option>";			
						}
							$block .= "</select>";
							echo $block;
						?>
					</div>
					<div class="twocols">
					<h3>Locations Currently Hidden:</h3>
					    <?php
						$sql = "SELECT state_id, state, hide 
								FROM states 
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
								ORDER BY country DESC, state"; 
				$result = $dbCustom->getResult($db,$sql);						
						$block = "<ul>"; 
						while($row = $result->fetch_object()) {
							if  ($row->hide == 1) {	
								$block .= "<li>$row->state</li>";	
							}
						}
						$block .= "</ul>";
						echo $block;
						?>
					</div>
				</div>
			</div>
</form>  
</div>
<br />

<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>

</div>
  
    
</body>
</html>



