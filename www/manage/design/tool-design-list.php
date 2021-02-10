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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_account.php"); 

$customer_account =  new CustomerAccount();

$progress = new SetupProgress;
$module = new Module;

$page_title = "Tool Designs";
$page_group = "design-email";
$msg = '';
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

	

unset($_SESSION['paging']);

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
		if($ret_page == "design-tool-landing"){	
			$bread_crumb->add("Design Area", $ste_root."manage/design-tool-landing.php");
		}		
		$bread_crumb->add("Tool Designs", '');
		echo $bread_crumb->output();

		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		$search_str = isset($_REQUEST['search_str']) ? trim(addslashes($_REQUEST['search_str'])) : '';
		
		if(isset($_REQUEST["date_from"])){
			$date_from = strpos($_REQUEST['date_from'], '/') ? date('Y-m-d H:i:s', strtotime(trim($_REQUEST['date_from']))) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_REQUEST['date_to'])){
			$date_to = strpos($_REQUEST['date_to'], '/') ? date('Y-m-d H:i:s', strtotime(trim($_REQUEST['date_to']))) : '';
		}else{
			$date_to = ''; 
		}
		
		$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
		$sql = "SELECT 	file_id
						,file_name
						,thumbnail_image_data
						,create_date
						,user_id
				FROM designs
				WHERE saas_id = '".$_SESSION['profile_account_id']."'"; 

		if($search_str != ''){
			if(is_numeric($search_str)){
				$sql .= " AND file_id = '".$search_str."'";
			}else{			
				$search_str = addslashes($search_str);
				$sql .= " file_name like '%".$search_str."%' " ;
			}
		}
		
		if($date_from != ''){		
			$sql .= " AND create_date >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND create_date <= '".$date_to."'";
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
			
			if($sortby == 'create_date'){
				if($a_d == 'd'){
					$sql .= " ORDER BY create_date DESC".$limit;
				}else{
					$sql .= " ORDER BY create_date".$limit;		
				}
			}
			
			if($sortby == 'user_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY user_id DESC".$limit;
				}else{
					$sql .= " ORDER BY user_id".$limit;		
				}
			}
			
			if($sortby == 'file_name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY file_name DESC".$limit;
				}else{
					$sql .= " ORDER BY file_name".$limit;		
				}
			}


		}else{
			$sql .= " ORDER BY file_id DESC".$limit;
		}

		
$result = $dbCustom->getResult($db,$sql);	

		
		
		?>
			<div class="page_actions">
				
                <table width="100%">
   	            <form name="search_form" action="tool-design-list.php" method="post" enctype="multipart/form-data">
                	
                    
                    <tr>
                    <td width="20%">
                    <label>Enter Design name or Design ID</label>
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
					<a href="<?php echo $url_str; ?>" class="btn btn-large btn-primary"><i class="icon-plus icon-white"></i> Edit ....</a>
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
					
					echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "design/tool-design-list.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);
					
					
					echo "<br /><br /><br /><br />";
				}
				?>	
            	




                <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th <?php addSortAttr('create_date',true); ?>>
                            Date Created
                            <i <?php addSortAttr('create_date',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('user_id',true); ?>>
                            Customer
                            <i <?php addSortAttr('user_id',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('file_name',true); ?>>
                            Design Name
                            <i <?php addSortAttr('file_name',false); ?>></i>
                            </th>
                            <th width="12%">Status</th>    
							<th width="12%">View</th>
						</tr>
					</thead>
					<?php
					
					require_once($_SERVER['DOCUMENT_ROOT']."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					$block = ''; 
					while($row = $result->fetch_object()) {
						
						$block .= "<tr>"; 
							
						$block .= "<td valign='top'>".$row->create_date."</td>";								
						
						$cust_name = $customer_account->getCustName($row->user_id);
						
						$block .= "<td valign='top'>".$cust_name."</td>";	
													
						$block .= "<td valign='top'>".stripAllSlashes($row->file_name)."</td>";	
						
						// purchased
						// in shopping cart
						// ... 

						$block .= "<td valign='top'>...</td>";	

						
						$url_str = "view-tool-design.php";
						$url_str .= "?cart_design_id=".$row->cart_design_id;
						$url_str .= "&design_id=".$row->design_id;
						$url_str .= "&user_id=".$row->user_id;
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						$url_str .= "&file_name=".$row->file_name;
						
						$block .= "</td>";	
						$block .= "<td valign='top'>";
						$block .= "<a class='btn btn-small' href='".$url_str."'><i class='icon-eye-open'></i> Reports </a></td>";
					}
					echo $block;
					?>
				</table>
				<?php 
				if($total_rows > $rows_per_page){
					echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "design/tool-design-list.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);

				}
				?>	                
			</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</body>
</html>
