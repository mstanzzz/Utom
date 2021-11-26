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

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

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
		
		
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
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
		$rows_per_page = 200;
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
   	            <form name="search_form" action="design-email-sel.php" method="post" enctype="multipart/form-data">
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
					<button type="submit" class="btn btn-primary btn-large" value="search">Search</button>
                    </div>
                    </td>
                    </tr>		
                    
                </form>
                </table>
                </div>

            <div class="clear"></div>
			

		<form name="export_form" action="export.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="export" value="1">
			<input type="submit" name="submit" value="Create Spread Sheet">
			<div class="data_table">
				<?php 
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "../manage/design/design-email-sel.php", $sortby, $a_d, 0, 0,  $search_str);
					echo "<br /><br /><br /><br />";
				}
				?>	
            
                <?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
						    <th>
                            Select
                            </th>

          					<th <?php addSortAttr('name',true); ?>>
                            Name
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('name',true); ?>>
                            Location
                            <i <?php addSortAttr('name',false); ?>></i>
                            </th>
							<th <?php addSortAttr('email',true); ?>>
                            Email Address
                            <i <?php addSortAttr('email',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('date_submitted',true); ?>>
                            Date Submitted
                            <i <?php addSortAttr('date_submitted',false); ?>></i>
                            </th>
        				</tr>
					</thead>
					<?php
					
					require_once($real_root."/includes/class.customer_login.php");
					$lgn = new CustomerLogin();
					
					$block = '';
					while($row = $result->fetch_object()) {
		
						$block .= "<tr>"; 
						
						$checked = ($date_from != '')? 'checked' : '';
	
						$block	.= "<td align='center' valign='middle' >
									<div class='checkboxtoggle on '> 
									<span class='ontext'>ON</span>
									<a class='switch on' href='#'></a>
									<span class='offtext'>OFF</span>
									<input type='checkbox' class='checkboxinput' name='design_email_ids[]' 
									value='".$row->design_email_id."' ".$checked." /></div>";
						$block .= "</td>";				
						
						$block .= "<td>".stripSlashes($row->name)."</td>";			
						$block .= "<td>".stripslashes($row->city)." ".$row->state.", ".$row->zip."</td>";
						$block .= "<td>".$row->email."</td>";								
						$block .= "<td>".date("F j, Y", $row->date_submitted)."</td>";			
						$block .= "</tr>";
					}
					echo $block;
					?>
				</table>
				<?php 
				if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "../manage/design/design-email-sel.php", $sortby, $a_d, 0, 0,  $search_str);
					echo "<br /><br /><br /><br />";
				}
				?>	
				
			</div>
			</form>
		
	</div>
	<p class="clear"></p>
</div>

<a href="clean-spam.php">Clean Spam</a>

</body>
</html>
