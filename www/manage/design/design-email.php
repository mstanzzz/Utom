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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Design Email Requests";
$page_group = "design-email";
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_DATABASE);

if(isset($_POST["edit_email_content"])){

	$design_email_content_id = $_POST["design_email_content_id"];
	$content = trim($_POST["content"]);

	$stmt = $db->prepare("UPDATE design_email_content
						SET content = ?
						WHERE design_email_content_id = ?");

						//echo 'Error '.$db->error;	
						// d for double / decimal 
													
	$stmt->bind_param('si'
						,$content
						,$design_email_content_id);
	
	$stmt->execute();
	$stmt->close();		

	$msg = 'success';

}

if(isset($_POST["del_design_email"])){
	//if($user_level > 1){
		$design_email_id = $_POST["del_design_email_id"];
		$sql = "SELECT file_name
				FROM design_email_image 
				WHERE design_email_id = '".$design_email_id."'";	
				
		$img_result = $dbCustom->getResult($db,$sql);
		while($img_row = $img_result->fetch_object()) {								
						
			$theFile =  $_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name;
			if(is_file($theFile)){
				unlink($theFile);	
			}
		}
		$sql = sprintf("DELETE FROM design_email_image WHERE design_email_id = '%u'", $design_email_id);
		$result = $dbCustom->getResult($db,$sql);
		$sql = sprintf("DELETE FROM design_email WHERE design_email_id = '%u'", $design_email_id);
		$result = $dbCustom->getResult($db,$sql);
	//}else{
		//$msg = "You are not authorised to delete.";		
	//}
}

unset($_SESSION['paging']);

require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>
$(document).ready(function() {

	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
	
});
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
	
	<a class="btn btn-primary btn-large" href="design-email-sel.php"> Select to Export </a>
	
		<?php 
	
	
	$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		if($ret_page == "design-tool-landing"){	
			$bread_crumb->add("Design Area", SITEROOT."/manage/design-tool-landing.php");
		}		
		$bread_crumb->add("Design Request Email", '');
		echo $bread_crumb->output();
		
        
		$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		$search_str = isset($_REQUEST['search_str']) ? trim(addslashes($_REQUEST['search_str'])) : '';
		
		if(isset($_REQUEST["date_from"])){
			$date_from = strpos($_REQUEST['date_from'], '/') ? strtotime(trim($_REQUEST['date_from'])) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_REQUEST['date_to'])){
			$date_to = strpos($_REQUEST['date_to'], '/') ? strtotime(trim($_REQUEST['date_to'])) : '';
		}else{
			$date_to = ''; 
		}
		
		$db = $dbCustom->getDbConnect(SITE_DATABASE);
		$sql = "SELECT * FROM design_email WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		
		if($search_str != ''){
			if(is_numeric($search_str)){
				$sql .= " AND user_id = '".$search_str."'";
			}else{			
				$search_str = addslashes($search_str);
				$sql .= " AND (name like '%".$search_str."%' OR city like '%".$search_str."%' OR email like '%".$search_str."%' )" ;
			}
		}
		if($date_from != ''){		
			$sql .= " AND date_submitted >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND date_submitted <= '".$date_to."'";
		}
		$nmx_res = $dbCustom->getResult($db,$sql);
		
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
						
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
						
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY name DESC".$limit;
				}else{
					$sql .= " ORDER BY name".$limit;		
				}
			}
			if($sortby == 'email'){
				if($a_d == 'd'){
					$sql .= " ORDER BY email DESC".$limit;
				}else{
					$sql .= " ORDER BY email".$limit;		
				}
			}
			if($sortby == 'date_submitted'){
				if($a_d == 'd'){
					$sql .= " ORDER BY date_submitted DESC".$limit;
				}else{
					$sql .= " ORDER BY date_submitted".$limit;		
				}
			}
			if($sortby == 'user_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY user_id DESC".$limit;
				}else{
					$sql .= " ORDER BY user_id".$limit;		
				}
			}

		}else{
			$sql .= " ORDER BY design_email_id DESC".$limit;
		}
		
		$result = $dbCustom->getResult($db,$sql);		
		?>
			<div class="page_actions">
				
                <table width="100%">
   	            <form name="search_form" action="design-email.php" method="post" enctype="multipart/form-data">
                	
                    
                    <tr>
                    <td width="20%">
                    <label>Enter name, email address,<br /> city, or customer ID</label>
					<input type="text" name="search_str" class="searchbox" placeholder="Search Requests" />
                    </td>
                    <td width="10%">
                    <div style="padding-top:17px;">
                	<label>Date From</label>
					<input id="datepicker1" type="text" name="date_from" value="none" style='width:80px;'/>
                    </div>
                    </td>
                    <td width="10%">
                    <div style="padding-top:17px;">
					<label>Date To</label>
					<input id="datepicker2" type="text" name="date_to" value="today" style='width:100px;'/>
                    </div>
					</td>
                    <td>
                    <div style="padding-top:47px;">
					<button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                    </div>
                    </td>
                    
                </form>
					<td>
                
                 <?php		
				if($admin_access->design_level > 1){
					$url_str = 'edit-cust-email-design.php';											
					$url_str .= '?pagenum='.$pagenum;
					$url_str .= '&sortby='.$sortby;
					$url_str .= '&a_d='.$a_d;
					$url_str .= '&truncate='.$truncate;
					$url_str .= '&search_str='.$search_str;
				?>
					<div style="padding-top:47px;">
					<a href="<?php echo $url_str; ?>" class="btn btn-large btn-primary"><i class="icon-plus icon-white"></i> Edit Customer Email Content</a>
                    </div>
							
				<?php 
				}    
				?>        
                    </td>
                    </tr>		
                </table>
                </div>

            <div class="clear"></div>

			<div class="data_table">
				<?php 
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "../manage/design/design-email.php", $sortby, $a_d, 0, 0,  $search_str);
					echo "<br /><br /><br /><br />";
				}
				?>	
            
                <?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
							<th>Location</th>
          					<th <?php addSortAttr('email',true); ?>>
                            Email Address
                            <i <?php addSortAttr('email',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('date_submitted',true); ?>>
                            Date Submitted
                            <i <?php addSortAttr('date_submitted',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('user_id',true); ?>>
                            Customer ID
                            <i <?php addSortAttr('user_id',false); ?>></i>
                            </th>
	
							<th width="12%">View</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					
					require_once($real_root."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					$block = ''; 
					while($row = $result->fetch_object()){
						
						/*
						$acs_obj = getCityStateFromZip($row->zip);
						$ret_city = ucwords(strtolower($acs_obj['city']));
						$ret_state = $acs_obj['state'];
						if($ret_city != ''){
							$sql = "UPDATE design_email
									SET city = '".$ret_city."', state = '".$ret_state."'
									WHERE design_email_id = '".$row->design_email_id."'";	
							$r = $dbCustom->getResult($db,$sql);
						}
						*/

						$block .= "<tr>"; 
						// strip all slashes
						$block .= "<td valign='top'>".stripSlashes($row->name)."</td>";			
						$block .= "<td valign='top'>".$row->city." ".$row->state." ".$row->zip."</td>";
						$block .= "<td valign='top'>".$row->email."</td>";								
						$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->date_submitted)."</td>";			
						$block .= "<td valign='top'>".$row->user_id;

						$url_str = "view-design-email.php";
						$url_str .= "?design_email_id=".$row->design_email_id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						
						
						$block .= "</td>";	
						$block .= "<td valign='top'>";
						$block .= "<a class='btn btn-small' href='".$url_str."'><i class='icon-eye-open'></i> View / Print</a></td>";
						$block .= "<td valign='middle'>";
						$block .= "<a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->design_email_id."' class='itemId' value='".$row->design_email_id."' /></a></td>";
						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
				<?php 
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "../manage/design/design-email.php", $sortby, $a_d, 0, 0,  $search_str);
				}
				?>	                
			</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	
	$url_str = "design-email.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
	
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this design request?</h3>
	<form name="del_design_email" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_design_email_id" class="itemId" type="hidden" name="del_design_email_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_design_email" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

<a href="clean-spam.php">Clean Spam</a>

</body>
</html>
