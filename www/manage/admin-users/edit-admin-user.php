<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
$progress = new SetupProgress;
$module = new Module;

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.order_fulfillment.php");

$order_fulfillment = new OrderFulfillment;

$page_title = 'Edit Admin Users';
$page_group = 'admin-users';
$msg = '';

	

$this_user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : 0;

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

//$db = $dbCustom->getDbConnect(USER_DATABASE);
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>

$(document).ready(function() {
	
	$("#open_emp_assign").click(function(){	
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_empl_has_fulfillment.php?employee_id='+<?php echo $this_user_id; ?>,	  
		  success: function(data) {
			if(data == '1'){
				$("#auto_assign").show();
				$("#page_actions_bottom").show();
			}else{
				$("#ff_msg").html("This user does not have access to the production area. You must assign the user to a group that has it");
			}
			//console.log(data);
		  }
		});
	});	

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
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$sql = sprintf("SELECT * FROM user WHERE id = '%u'", $this_user_id);
		$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$object = $result->fetch_object();
			$name = $object->name;
			$username = $object->username;
			
		}else{
			$name = '';
			$username = '';
		}

		$url_str = 'admin-users.php';
		$url_str .= '?pagenum='.$_SESSION['paging']['pagenum'];
		$url_str .= '&sortby='.$_SESSION['paging']['sortby'];
		$url_str .= '&a_d='.$_SESSION['paging']['a_d'];
		$url_str .= '&truncate='.$_SESSION['paging']['truncate'];

		$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
		
		// TMP
		//$disabled = "";
		
	
		?>
		<form name="edit_user" action="<?php echo $url_str; ?>" method="post">
       	<input id="user_id" type="hidden" name="user_id" value="<?php echo $this_user_id;  ?>" />
		
		<input type="hidden" name="update_user" value="1" />
		
			<div class="page_actions edit_page">
            	<?php 
				if($admin_access->administration_level > 1){ 
				//if(1){
				
				?>
				
				
					<button name="edit_user" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
					<hr />
                <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to edit users.
                    </div>            
                <?php } ?>

		    	<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="name" value="<?php echo stripslashes($name); ?>" maxlength="160" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Email Address / User Name</label>
						</div>
						<div class="twocols">
							
                            <input type="text"  name="user_name"  value="<?php echo $username; ?>" maxlength="160" />
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Group</label>
						</div>
						<div class="twocols">
                            <div class="data_table">
                            <table cellpadding="15" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="75%">Group Name</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <?php
                                $sql = "SELECT id, group_name
                                        FROM admin_group
                                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                                $result = $dbCustom->getResult($db,$sql);
								
                                
                                $block = '';							
                                while($row = $result->fetch_object()) {
									
									$sql = "SELECT id
											FROM admin_user_to_admin_group
											WHERE user_id = '".$this_user_id."'
											AND admin_group_id = '".$row->id."'";
									
									$res = $dbCustom->getResult($db,$sql);
									
									if($res->num_rows > 0){
										$checked = "checked='checked'";	
									}else{
										$checked = '';
									}
									
									$block .= "<tr>";
									$block .= "<td>$row->group_name</td>";
									$block .= "<td><div class='checkboxtoggle on ".$disabled." '> 
									<span class='ontext'>ON</span>
									<a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='admin_group_id[]' value='".$row->id."' $checked /></div></td>";	
									$block .= "</tr>";
                                }
                                echo $block;
                                ?>
                                </table>                            
                            </div>
                        </div>
					</div>
				</fieldset>

				<div class="colcontainer formcols">
					<div class="twocols">
					&nbsp;
                    </div>
					<div class="twocols">				
                		
                        <div id="ff_msg" style="color:#900; margin-top:8px; margin-bottom:8px; width:100%;">&nbsp;</div>
                        	
                        <div id="open_emp_assign" class="btn btn-large">Automatically Assign Design Order Fulfillment Steps</div>
                        
					</div>
				</div>

				<fieldset id="auto_assign" style="display:none;">
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Fulfillment Auto Assign</label>
						</div>
						<div class="twocols">
                            <div class="data_table">
                            <table cellpadding="15" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="75%">Fulfillment Step Name</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <?php

								$all_design_steps = $order_fulfillment->getAllSteps();
							
								$block = "";
						
								foreach($all_design_steps as $all_step_val){
									
									$block .= "<tr>";
									$block .= "<td>".$all_step_val['step_name']."</td>";
									
									$is_assigned = $order_fulfillment->isEmpAutoAssigned($this_user_id, $all_step_val['order_fulfillment_step_id']);

									$checked = $is_assigned ? "checked" : "";
									
									$block .= "<td><div class='checkboxtoggle on ".$disabled." '> 
									<span class='ontext'>ON</span>
									<a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='order_fulfillment_step_id[]' value='".$all_step_val['order_fulfillment_step_id']."' $checked /></div></td>";	
									$block .= "</tr>";
                                }
                                echo $block;
                                ?>
                                </table>                            
                            </div>
                        </div>
					</div>
				</fieldset>
			</div>

			<div id="page_actions_bottom" class="page_actions edit_page" style="display:none;">
            	<?php if($admin_access->administration_level > 1){ ?>
					<button name="edit_user" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
					<hr />
                <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to edit users.
                    </div>            
                <?php } ?>

		    	<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>

		</form>

    
    
    </div>
    
	<p class="clear"></p>
	<?php 
require_once("../admin-includes/manage-footer.php");
?>
</div>
</body>
</html>
