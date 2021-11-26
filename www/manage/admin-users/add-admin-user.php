<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
$progress = new SetupProgress;
$module = new Module;

$aLgn = new AdminLogin;

$page_title = "Add User";
$page_group = "admin";

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$msg = '';

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
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
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$url_str = "admin-users.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];

		?>
		<form name="add_user" action="<?php echo $url_str; ?>" method="post">
			<div class="page_actions edit_page">
				<button name="add_user" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Add New User </button>
				<hr />
				<a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
			</div>
			<div class="page_content edit_page">
				<fieldset class="edit_content">
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Name</label>
						</div>
						<div class="twocols">
							<input type="text" name="name"  maxlength="160" />
						</div>
					</div>
					
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Email Address / User Name</label>
						</div>
						<div class="twocols">
							<!--<input type="email" name="user_name"  maxlength="160" />-->
							<input type="text" name="user_name"  maxlength="160" />
						</div>
					</div>
					
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Password</label>
						</div>
						<div class="twocols">
							<input type="password" name="password"  maxlength="160" />
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
                                        <th>Group Name</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <?php
								$db = $dbCustom->getDbConnect(USER_DATABASE);

                                $sql = "SELECT id, group_name
                                        FROM admin_group
                                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                                $result = $dbCustom->getResult($db,$sql);                                
                                $block = '';							
                                while($row = $result->fetch_object()) {
                                $block .= "<tr>";
                                $block .= "<td>$row->group_name</td>";
                                $block .= "<td><div class='checkboxtoggle on'> 
                                <span class='ontext'>ON</span>
                                <a class='switch on' href='#'></a>
                                <span class='offtext'>OFF</span>
                                <input type='checkbox' class='checkboxinput' name='admin_group_id[]' value='".$row->id."' /></div></td>";	
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
		</form>
	</div>
	<p class="clear"></p>
	<?php 
require_once("../admin-includes/manage-footer.php");
?>
</div>
</body>
</html>
