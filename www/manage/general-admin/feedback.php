<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Feedback";
$page_group = '';
$msg = '';
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
//$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
if(isset($_POST["del_testimonial"])){

	$testimonial_id = $_POST["del_testimonial_id"];
		
	$sql = sprintf("DELETE FROM testimonial_image WHERE testimonial_id = '%u'", $testimonial_id);
	$result = $dbCustom->getResult($db,$sql);
		
	$sql = sprintf("DELETE FROM testimonial WHERE testimonial_id = '%u'", $testimonial_id);
	$result = $dbCustom->getResult($db,$sql);

}
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
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
		$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : '';
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		if($ret_page == "customer-landing"){	
			$bread_crumb->add("Customer Area", $ste_root."manage/customer-landing.php");
		}		
		$bread_crumb->add("Testimonial", '');
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
		
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

		$sql = "SELECT * FROM testimonial 
				WHERE type = 'feedback' 
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		$result = $dbCustom->getResult($db,$sql);							
		
		if($search_str != ''){
			
			$sql .= " AND (name like '%".$search_str."%' OR city_state like '%".$search_str."%' OR email like '%".$search_str."%' )" ;
		}
		
		if($date_from != ''){		
			$sql .= " AND last_update >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND last_update <= '".$date_to."'";
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
			if($sortby == 'city_state'){
				if($a_d == 'd'){
					$sql .= " ORDER BY city_state DESC".$limit;
				}else{
					$sql .= " ORDER BY city_state".$limit;		
				}
			}
			if($sortby == 'last_update'){
				if($a_d == 'd'){
					$sql .= " ORDER BY last_update DESC".$limit;
				}else{
					$sql .= " ORDER BY last_update".$limit;		
				}
			}


		}else{
			$sql .= " ORDER BY list_order DESC".$limit;
		}

		
$result = $dbCustom->getResult($db,$sql);		
		
		
		$url_str = "testimonial_list.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		
		?>
        
                <div class="page_actions">
				
                <table width="100%">
   	            <form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                	
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
                    </tr>		
                </table>
                </div>

        
            <div class="clear"></div>

				<?php 
				if($total_rows > $rows_per_page){					
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "feedback.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);
					echo "<br /><br /><br />";
				}
				?>	
			<div class="data_table">
                <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('city_state',true); ?>>
                            City/State
                            <i <?php addSortAttr('city_state',false); ?>></i>
                            </th>
          					<th width="20%" <?php addSortAttr('last_update',true); ?>>
                            Date Submitted
                            <i <?php addSortAttr('last_update',false); ?>></i>
                            </th>
                            <th width="45%">Subject</th>
							<th width="12%">View</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
					$block = ''; 
					while($row = $result->fetch_object()) {

						$block .= "<tr>"; 
						$block .= "<td valign='top'>".$row->name."</td>";			
						$block .= "<td valign='top'>".$row->city_state."</td>";	
						if($row->last_update > 0){
							$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->last_update)."</td>";			
						}else{
							$block .= "<td valign='top'></td>";										
						}
						
						$block .= "<td valign='top'>".stripslashes($row->content)."</td>";
						
						
						
						$url_str = "edit-testimonial.php";
						$url_str .= "?testimonial_id=".$row->testimonial_id;
						$url_str .= "&type=feedback";
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						
						$block .= "<td valign='top'><a class='btn btn-small' 
						href='".$url_str."'><i class='icon-eye-open'></i> View </a></td>";
						
						
$disabled = ($admin_access->customers_level < 2)? "disabled" : '';
$disabled = '';

$block .= "<td valign='middle'>
<a class='btn btn-danger confirm ".$disabled."'>
<i class='icon-remove icon-white'></i>
<input type='hidden' id='".$row->testimonial_id."'  = '';
class='itemId' value='".$row->testimonial_id."' /></a></td>";

						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
				<?php 
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "feedback.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);
				}
				?>	                
			</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	
	$url_str = "feedback.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this email?</h3>
	<form name="del_testimonial" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_testimonial_id" class="itemId" type="hidden" name="del_testimonial_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_testimonial" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>





