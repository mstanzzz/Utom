<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Admin Group";
$page_group = "admin-users";
$msg = '';

	


$admin_group_id = (isset($_GET['admin_group_id'])) ? $_GET['admin_group_id'] : 0;  

$dbCustom = new DbCustom();				
$db = $dbCustom->getDbConnect(USER_DATABASE);

$sql = "SELECT group_name 
		FROM admin_group
		WHERE id = '".$admin_group_id."'";
		
$result = $dbCustom->getResult($db,$sql);					
		
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$group_name = $object->group_name;
}else{
	$group_name = '';
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
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

	<form name="form" action="admin-groups.php" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="admin_group_id" value="<?php echo $admin_group_id; ?>">
		
        <div style="float:left; padding-top:50px;">
 			<div style="width:60px; float:left;">
				<label><b>Group Name</b></label>
			</div>
			<div style="float:left;">
				<input type="text" name="group_name" value="<?php echo $group_name; ?>" width="30" maxlength="80" />
			</div>
		</div>

		<div style="float:right; padding-top:50px;">
           	<?php if($admin_access->administration_level > 1){ ?>
				<button name="edit_admin_group" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
				<hr />
            <?php }else{ ?>
                <div class="alert">
                    <i class="icon-warning-sign"></i>         
                    Sorry, you don't have the permissions to edit groups.
                </div>            
            <?php } ?>
			<a href="admin-groups.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>

		<div class="clear"></div>
    
        <div class="data_table">
        <table cellpadding="15" cellspacing="0">
        <thead>
        <tr>
            <th>Section Name</th>
            <th>No Access</th>
            <th>Read Access</th>
            <th>Write Access</th>
            <th>Publish Access</th>    
        </tr>
        </thead>
        <?php
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		$sql = "SELECT id, section_name 
				FROM admin_section";
				
		if(getProfileType() != 'master'){
			$sql .= " WHERE section_name != 'master'";	
		}
				
		$result = $dbCustom->getResult($db,$sql);		
		$block = '';
		while($row = $result->fetch_object()){
			
			$sql = "SELECT id
						,admin_section_id
						,admin_section_level 
					FROM admin_access
					WHERE admin_section_id = '".$row->id."'
					AND admin_group_id = '".$admin_group_id."'";
			$res = $dbCustom->getResult($db,$sql);
			
			if($res->num_rows > 0){
				$s_obj = $res->fetch_object();	
				$admin_section_level = $s_obj->admin_section_level;
			}else{
				$admin_section_level = 0;
			}
						
			$block .= "<tr>";
			$block .= "<td>$row->section_name</td>";
			
			$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
			
			$checked = ($admin_section_level == 0) ? "checked='checked'" : '';  			
			$block .= "<td>
            <div class='radiotoggle on ".$disabled." '> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='0' $checked />
            </div>        
            </td>";

			
			$checked = ($admin_section_level == 1) ? "checked='checked'" : '';  			
			$block .= "<td>
            <div class='radiotoggle on ".$disabled." '> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='1' $checked />
            </div>        
            </td>";

			$checked = ($admin_section_level == 2) ? "checked='checked'" : '';  
			$block .= "<td>
            <div class='radiotoggle on ".$disabled." '> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='2' $checked />
            </div>        
            </td>";
			
			$block .= "<td>";
			if($row->section_name == "cms" || $row->section_name == "product_catalog"){	
				$checked = ($admin_section_level > 2) ? "checked='checked'" : '';  
				$block .= "<div class='radiotoggle on ".$disabled." '> 
				<span class='ontext'>ON</span>
				<a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span>
				<input type='radio' class='radioinput' name='".$row->id."' value='3' $checked />
				</div>";
			}
            $block .= "</td>";

			$block .= "</tr>";
		}
		
		echo $block;
		
		?>
        </table>
    

    </form>


		</div>



	</div>

	<p class="clear"></p>
	<?php 
	require_once("../admin-includes/manage-footer.php");
	?>
</div>
</body>
</html>
