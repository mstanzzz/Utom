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

$page_title = "In-Home Consultation Requests";
$page_group = "design-email";
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(isset($_POST["edit_email_content"])){

	$consult_email_content_id = $_POST["consult_email_content_id"];
	$content = trim($_POST["content"]);

	$stmt = $db->prepare("UPDATE consult_email_content
						SET content = ?
						WHERE consult_email_content_id = ?");

						//echo 'Error '.$db->error;	
						// d for double / decimal 
													
	$stmt->bind_param('si'
						,$content
						,$consult_email_content_id);
	
	$stmt->execute();
	$stmt->close();		

	$msg = 'success';
}

if(isset($_POST["del_id"])){
	//if($user_level > 1){
		$request_id = $_POST["del_id"];
		$sql = "SELECT file_name
				FROM consultation_request_image 
				WHERE in_home_consult_request_id = '".$request_id."'";	
		$img_res = $dbCustom->getResult($db,$sql);
		while($img_row = $img_res->fetch_object()) {								
			$theFile = SITEROOT."/user_uploads/".$_SESSION['profile_account_id']."/".$img_row->file_name;
			if(is_file($theFile)){
				unlink($theFile);	
			}
		}

		$sql = sprintf("DELETE FROM consultation_request_image WHERE in_home_consult_request_id = '%u'", $request_id);
		$result = $dbCustom->getResult($db,$sql);
		
		$sql = sprintf("DELETE FROM in_home_consult_request WHERE request_id = '%u'", $request_id);
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
		<?php 
		$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		if($ret_page == "design-tool-landing"){	
			$bread_crumb->add("Design Area", SITEROOT."manage/design-tool-landing.php");
		}		
		$bread_crumb->add("Consultation Request", '');
		echo $bread_crumb->output();

		require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
        
		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;		
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
		$search_str = (isset($_REQUEST["search_str"])) ?  trim(addslashes($_REQUEST["search_str"])) : '';
		
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
		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * FROM in_home_consult_request WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";

		if($search_str != ''){
			if(is_numeric($search_str)){
				$sql .= " AND user_id = '".$search_str."'";
			}else{	
				$sql .= " AND (name like '%".$search_str."%' OR city like '%".$search_str."%' OR email like '%".$search_str."%' )" ;
			}
		}
		if($date_from != ''){		
			$sql .= " AND date_entered >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND date_entered <= '".$date_to."'";
		}

		$nmx_res = $dbCustom->getResult($db,$sql);
		if(!$nmx_res)die(mysql_error($nmx_res));

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 10;
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
			if($sortby == 'city'){
				if($a_d == 'd'){
					$sql .= " ORDER BY city DESC".$limit;
				}else{
					$sql .= " ORDER BY city".$limit;		
				}
			}
			if($sortby == 'date_entered'){
				if($a_d == 'd'){
					$sql .= " ORDER BY date_entered DESC".$limit;
				}else{
					$sql .= " ORDER BY date_entered".$limit;		
				}
			}
			if($sortby == 'is_costco'){
				if($a_d == 'd'){
					$sql .= " ORDER BY is_costco DESC".$limit;
				}else{
					$sql .= " ORDER BY is_costco".$limit;		
				}
			}

		}else{
			$sql .= " ORDER BY request_id DESC".$limit;
		}
		$result = $dbCustom->getResult($db,$sql);
		
		?>
        <div class="page_actions">
                <table width="100%">
   	            <form name="search_form" action="in-home-consult.php" method="post" enctype="multipart/form-data">
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
					$url_str = 'edit-cust-email-consult.php';											
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
           
           	<?php 			
			if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "in-home-consult.php", $sortby, $a_d,0,0, $search_str);
				echo "<br /><br /><br />";
			}
			?>	


            <div class="data_table">
				<?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
                <table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('city',true); ?>>
                            City/State
                            <i <?php addSortAttr('city',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('date_entered',true); ?>>
                            Date Submitted
                            <i <?php addSortAttr('date_entered',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('is_costco',true); ?>>
                            Customer Type
                            <i <?php addSortAttr('is_costco',false); ?>></i>
                            </th>
							<th width="12%">View</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					$block = ''; 
					while($row = $result->fetch_object()) {
						
						
						
						//REMOVE after going live for a few days
						
						if($row->user_id == 0){
							
							$customer_id = $lgn->getUserIdByEmail($row->email);
							
							//echo "customer_id".$customer_id;
							
							if($customer_id > 0){
								
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "UPDATE in_home_consult_request
										SET user_id = '".$customer_id."'
										WHERE request_id = '".$row->request_id."'";	
								$re = $dbCustom->getResult($db,$sql);
							}
								
						}
						
						
						
						$block .= "<tr>"; 
						$block .= "<td valign='top'>$row->name</td>";			
						$block .= "<td valign='top'>$row->city $row->state</td>";	
						$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->date_entered)."</td>";			
						$block .= "<td valign='top'>";
						if($row->is_costco){
							$block .= "<b>Costco Customer</b>";
						}
						else {
							$block .= "Regular Customer";
						}
						$block .= "</td>";
						$block .= "<td valign='top'>";
						
						$url_str = "view-in-home-consult.php";
						$url_str .= "?request_id=".$row->request_id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						
						
						$block .= "<a class='btn btn-small' href='".$url_str."'><i class='icon-eye-open'></i> View / Print</a></td>";
						$block .= "<td valign='middle'>";
						$block .= "<a class='btn btn-danger confirm'><i class='icon-remove icon-white'></i><input type='hidden' id='".$row->request_id."' class='itemId' value='".$row->request_id."' /></a></td>";
						$block .= "</tr>";
					}
					echo $block;
	?>
		</table>
          	<?php 			
			if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "in-home-consult.php", $sortby, $a_d,0,0, $search_str);

			}
			
			
		
	$url_str = "in-home-consult.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
		
			
			?>	
	</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this consultation request?</h3>
	<form name="del_request" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_id" class="itemId" type="hidden" name="del_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_request" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
	</div>
	<p class="clear"></p>
	<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
