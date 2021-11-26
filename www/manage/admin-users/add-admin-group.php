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

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
$progress = new SetupProgress;
$module = new Module;


$page_title = "Add Admin Group";
$page_group = "admin-users";
$msg = '';

	

//$db = $dbCustom->getDbConnect(USER_DATABASE);



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<!--
Issue #113
Think of it like windows groups and access rights... In windows for example I can create a security group and assign users to that group. 
I can then give that group permissions to different files/folders. 
Thats how we should build this.
We will create the default groups, but admins can create additional groups. 

The default groups would be "Admins", "CMS Editor", "CMS Admin", "Cart Admin", "Ecommerce Admin", etc... 

The names may change a little, but Admins will have access to everything. 
CMS Reader will be able to make changes to CMS, but it wont give them ability to OK the changes, 

Cart Admin will have access to prod catalog, Ecoomerce Admin will have access to prod catalog, ecommerce settings, customers and orders.

These groups though can be customized as well, renamed, and admins can add new groups. 
Really the group section (i.e. when creating or editing a group) we will have the on/off button for each capability. 
So for example in the admin group all of the functions of manage will be set to on. 
They will have CMS, Prod Catalog, Ecommerce, etc.. (all the different sections on the left nav menu of manage" and they will have read/write to both. 
So the design of this would look a grid with 4 columns. 

1st column is "Section Name", second is "Write Access"., and third is "Read Access" and the fourth is "Publish Access", 
then each would be listed out and you can toggle on/off the different abilities.

Then we need to assign users to these groups. Users can be a member of one or more groups.

Finally the review process... So if you only have read/write, but no publish then we you go to CMS for example and make changes 
to a page that will be stored in the "preview" side (or we can call it pending in DB). 
We have the preview capability which allows someone to email how it would look or click preview to view themselves. 
But someone who doesnt have the ability to publish when they save it goes in a pending state until someone who has access can go to that, 
review it and publish. Same thing with catalog changes. We will also need a way for those with the correct credentials to have a 
list of pending changes/updates to review. This all being said I feel the review process is different from group permissions so 
I have created another topic for this so lets leave this tread to permissions and talk on review process here. 




The different section rights would be:

CMS
Product Catalog
Ecommerce Settings
Customers & Orders
Administration
Design

And in administration and Design as well as probably customers and orders and ecommerce settings there is no publish option.

For OTG we will add another section for the OTG Manage

Be sure to add Design to it also, except as mentioned with design there is no "publish". 
Others may not have a "publish" either. Design is read and or write. If they have read then they will be able to browse the messages sent, 
view designs submitted, etc... but wont be able to respond to users.


$admin_access =  new AdminAccess();
$admin_access->getCmsLevel == 1,2 0r 3

1 => read
2 => write
3 => publish




section => cms
level => 3
group_id => 1

table admin_user_to_admin_group
		id
        user_id
        admin_group_id

table admin_group
		id
        group_name

table admin_section
		id
        admin_section_name	

table admin_access
		id
        admin_group_id
        admin_section_id
        admin_section_level
        
        
        

$admin_access->getAdminGroupID()

$admin_access->getCmsLevel 
	SELECT admin_section_level
	FROM admin_access, admin_section
    WHERE admin_access.admin_section_name = admin_section.admin_section_name
    AND admin_access.admin_section_name = 'cms'
    AND admin_access.admin_group_id = '".$admin_access->getAdminGroupID()."'   

	return level

keep using user database. Not new database.

-->


<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">

	<form name="form" action="admin-groups.php" method="post" enctype="multipart/form-data">
		<div class="page_actions edit_page">
			<button name="add_admin_group" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
			<hr />
			<a href="admin-groups.php" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
		</div>

		<div class="colcontainer formcols">
			<div class="twocols">
				<label>Group Name</label>
			</div>
			<div class="twocols">
				<input type="text" name="group_name" maxlength="80" />
			</div>
		</div>
    
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
		if(getProfileType($dbCustom) != "master"){
			$sql .= " WHERE section_name != 'master'";	
		}

$result = $dbCustom->getResult($db,$sql);		
		$block = '';
		while($row = $result->fetch_object()){
			$block .= "<tr>";
			
			$block .= "<td>$row->section_name</td>";
			
			$block .= "<td>
            <div class='radiotoggle on'> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='0' checked='checked' />
            </div>        
            </td>";
			
			
			$block .= "<td>
            <div class='radiotoggle on'> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='1' checked='checked' />
            </div>        
            </td>";

			$block .= "<td>
            <div class='radiotoggle on'> 
            <span class='ontext'>ON</span>
            <a class='switch on' href='#'></a>
            <span class='offtext'>OFF</span>
            <input type='radio' class='radioinput' name='".$row->id."' value='2' />
            </div>        
            </td>";
			
			$block .= "<td>";
			if($row->section_name == "cms" || $row->section_name == "product_catalog"){	
				$block .= "<div class='radiotoggle on'> 
				<span class='ontext'>ON</span>
				<a class='switch on' href='#'></a>
				<span class='offtext'>OFF</span>
				<input type='radio' class='radioinput' name='".$row->id."' value='3' />
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
