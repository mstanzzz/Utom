<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'aws/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/aws';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Design Request Origin Statistics";
$page_group = "design-email";
$msg = '';

	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



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
		$bread_crumb->add("Design Area", $ste_root."manage/design-tool-landing.php");
		$bread_crumb->add("Design Request Origin Statistics", '');
		echo $bread_crumb->output();

		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

//date_submitted
//echo $_SESSION['profile_account_id'];
//echo "<br />";

$count_buy_cl = 0;
$count_design_options = 0;
$count_gen_nav = 0;
$count_kwlp = 0;

$readable_date_from = 'Start';
$readable_date_to = 'Now';

if(isset($_REQUEST["date_from"])){
	$date_from = strpos($_REQUEST['date_from'], '/') ? strtotime(trim($_REQUEST['date_from'])) : '';
	
	$readable_date_from = $_REQUEST["date_from"];
	
}else{
	$date_from = ''; 
	
}
if(isset($_REQUEST['date_to'])){
	$date_to = strpos($_REQUEST['date_to'], '/') ? strtotime(trim($_REQUEST['date_to'])) : '';
	
	$readable_date_to = $_REQUEST["date_to"];
	
}else{
	$date_to = ''; 
	
}

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

	$sql = "SELECT origin FROM design_email 
			WHERE origin != '' 
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
			
		if($date_from != ''){		
			$sql .= " AND date_submitted >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND date_submitted <= '".$date_to."'";
		}			


		$sql .= " ORDER BY origin";
		
		$result = $dbCustom->getResult($db,$sql);
		
		
		//echo $result->num_rows;
		
		while($row = $result->fetch_object()) {

			if(strpos($row->origin, 'uyclosets') !== false){
				$count_buy_cl++;
			}elseif(strpos($row->origin, 'Options') !== false){
				$count_design_options++;
			}elseif(strpos($row->origin, 'Navigatio') !== false){
				$count_gen_nav++;
			}elseif(strpos($row->origin, 'eyword') !== false){
				$count_kwlp++;
			}else{
				
			}

			//echo "|".$row->origin."|";
			//echo "<br />";
			
			
			


		}

?>

			<div class="page_actions">
				
                <table width="100%">
   	            <form name="search_form" action="design-req-origin-stats.php" method="post" enctype="multipart/form-data">
                	
                    
                    <tr>
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
                    </tr>
                </form>
				
                 		
                </table>
                
                 <?php
			
			echo "From Date: ".$readable_date_from;
			echo "<br />";
			echo "To Date: ".$readable_date_to;
			echo "<br /><br />";
			
			
			?>
                
            </div>
                
			
            <div class="clear"></div>


			<div class="data_table">
            
           
            
            
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th>
                            	Buyclosets Tool
                            </th>

          					<th>
                            	Design Options Page
                            </th>
                            
                            <th>
                            	General Navigation
                            </th>
                            
                            <th>
                            	keyword Landing Page
                            </th>
          					
						</tr>
					</thead>
					
                    <tr>                    
                    <td><?php echo $count_buy_cl; ?></td>
                    
                     <td><?php echo $count_design_options; ?></td>
                     
                     <td><?php echo $count_gen_nav; ?></td>
                     
                     <td><?php echo $count_kwlp; ?></td>
                    
                    </tr>
                    </table>

		</div>
		
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
    
    </div>
</body>
</html>

                    


