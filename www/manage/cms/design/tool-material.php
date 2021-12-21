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

$page_title = "Tool Settings";
$page_group = "tool";

	

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

//$db = $dbCustom->getDbConnect(CTGTOOL_DATABASE);

$msg = '';

if(isset($post['add_material'])){
	
/*
mat_name
brand_id
vend_id
prod_num
core_id
type_id
finish_id
texture_id
green_id
mat_price_unit
mat_markup
mat_waste_allow
mat_weight_unit
mat_width
mat_height
mat_thickness
mat_stocked
stain_id
saas_id
*/
	
	$mat_name = (isset($_POST['mat_name']))? trim(addslashes($_POST['mat_name'])) : 'no name';
	$brand_id = (isset($_POST['brand_id']))? $_POST['brand_id'] : 0;
	$vend_id = (isset($_POST['vend_id']))? $_POST['vend_id'] : 0;
	$prod_num = (isset($_POST['prod_num']))? trim(addslashes($_POST['prod_num'])) : '';
	$core_id = (isset($_POST['core_id']))? $_POST['core_id'] : 0;
	$type_id = (isset($_POST['type_id']))? $_POST['type_id'] : 0;
	$finish_id = (isset($_POST['finish_id']))? $_POST['finish_id'] : 0;
	$texture_id = (isset($_POST['texture_id']))? $_POST['texture_id'] : 0;
	$green_id = (isset($_POST['green_id']))? $_POST['green_id'] : 0;
	$mat_price_unit = (isset($_POST['mat_price_unit']))? $_POST['mat_price_unit'] : 0;
	$mat_markup = (isset($_POST['mat_markup']))? $_POST['mat_markup'] : 0;
	$mat_waste_allow = (isset($_POST['mat_waste_allow'])) ? $_POST['mat_waste_allow'] : 'no';
	$mat_weight_unit = (isset($_POST['mat_weight_unit']))? $_POST['mat_weight_unit'] : 0;
	$mat_width = (isset($_POST['mat_width']))? $_POST['mat_width'] : 0;

	$mat_height = (isset($_POST['mat_height']))? $_POST['mat_height'] : 0;
	$mat_thickness = (isset($_POST['mat_thickness']))? $_POST['mat_thickness'] : 0;
	$mat_stocked = (isset($_POST['mat_stocked']))? $_POST['mat_stocked'] : 0;
	$stain_id = (isset($_POST['stain_id']))? $_POST['stain_id'] : 0;

	$saas_id = (isset($_POST['saas_id']))? $_POST['saas_id'] : 0;


	



	$stmt = $db->prepare("INSERT INTO materials
						(mat_name
						,brand_id
						,vend_id
						,prod_num
						,core_id
						,type_id
						,finish_id
						,texture_id
						,green_id
						,mat_price_unit
						,mat_markup
						,mat_waste_allow
						,mat_weight_unit
						,mat_width
						,mat_height
						,mat_thickness
						,mat_stocked
						,stain_id
						,saas_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");							
	$stmt->bind_param('siisiiiiiiiiiiiiiii'
						,$mat_name
						,$brand_id
						,$vend_id
						,$prod_num
						,$core_id
						,$type_id
						,$finish_id
						,$texture_id
						,$green_id
						,$mat_price_unit
						,$mat_markup
						,$mat_waste_allow
						,$mat_weight_unit
						,$mat_width
						,$mat_height
						,$mat_thickness
						,$mat_stocked
						,$stain_id
						,$saas_id);
	
	$stmt->execute();
	$stmt->close();		
	



		$msg = 'success';

	}else{
		
		$msg =  'fail';

	}
	

	

if(!isset($url_str)) $url_str = '';						
if(!isset($strip)) $strip = 0;						
if(!isset($pagenum)) $pagenum = 0;	
if(!isset($truncate)) $truncate = 0;						
if(!isset($search_str)) $search_str = '';						
					


unset($_SESSION['temp_fields']);






require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$("tbody tr").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});	
	
	
});
</script>
</head>
<body>

<?php
if(!$strip){ 
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 
		if(!$strip){ 
			require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Tool Settings", SITEROOT."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Attributes", '');
			echo $bread_crumb->output();
		}
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//attribute section tabbed sub-navigation
		
        require_once($real_root."/manage/admin-includes/tool-section-tabs.php");
		
		
		
		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		
		
		if($admin_access->product_catalog_level > 1){
		
		
		
		$url_str = 'add-tool-material.php';
		$url_str .= '?strip='.$strip;											
		$url_str .= '&pagenum='.$pagenum;
		$url_str .= '&sortby='.$sortby;
		$url_str .= '&a_d='.$a_d;
		$url_str .= '&truncate='.$truncate;
		$url_str .= '&search_str='.$search_str;
		
//class="btn btn-large btn-primary confirm confirm-add" 
		?>
			<div class="page_actions"> 
            <a href="<?php echo $url_str; ?>" class="btn btn-large btn-primary"><i class="icon-plus icon-white"></i> Add a New Material </a>
			</div>		
        <?php 
		
		
		
		}
		
		
		
		
		
		
/*		
material_id	
material_name	
tier_id	
material_type_id	
mat_color	
mat_alpha	
mat_image	
saas_id	
*/
		
		
		

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
		
		
		$sql = "SELECT mat_id	
					,mat_name	
					,saas_id	
				FROM materials 
				WHERE saas_id = '".$_SESSION['profile_account_id']."'";
		$nmx_res = $dbCustom->getResult($db,$sql);
		
		
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
					
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
					
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
		
		if($sortby == 'mat_name'){
			if($a_d == 'd'){
				$sql .= " ORDER BY mat_name DESC".$limit;
			}else{
				$sql .= " ORDER BY mat_name".$limit;	
			}
		}elseif($sortby == 'saas_id'){
			if($a_d == 'd'){
				$sql .= " ORDER BY saas_id DESC".$limit;
			}else{
				$sql .= " ORDER BY saas_id".$limit;	
			}
		}else{
			$sql .= " ORDER BY mat_name".$limit;					
		}
						
		$result = $dbCustom->getResult($db,$sql);		
					
		if($total_rows > $rows_per_page){
			echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, 'design/tool-material.php', $sortby, $a_d);
			echo "<br /><br /><br />";
		}
			
		if($total_rows < 1){
			echo "No attributes";	
		}
		

		?>

        <div class="data_table">
        <?php require_once($real_root."/manage/admin-includes/tablesort.php"); ?>
            <table cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th <?php addSortAttr('mat_name',true); ?>>
                            Name
                           <i <?php addSortAttr('mat_name',false); ?>></i>
                        </th>

                        <th <?php addSortAttr('saas_id',true); ?>>
                            SAAS ID
                           <i <?php addSortAttr('saas_id',false); ?>></i>
                        </th>
                        
                        <th width="15%">Edit</th>
                        <th width="15%">Delete</th>
                    </tr>
                </thead>
				<?php
							$block = '';
							$j = 0;
							while($row = $result->fetch_object()) {
								$j =  $j +1;
								$block .= "<tr>";
								$block .= "<td valign='middle' width='300px'>".stripslashes($row->material_name)."</td>";
								
								$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
								$fb = (!$strip) ? "fancybox fancybox.iframe" : '';						
		
		
		
		
		
		$url_str = 'edit-tool-material.php';
		$url_str .= '?strip='.$strip;											
		$url_str .= '&pagenum='.$pagenum;
		$url_str .= '&sortby='.$sortby;
		$url_str .= '&a_d='.$a_d;
		$url_str .= '&truncate='.$truncate;
		$url_str .= '&search_str='.$search_str;
		
																		
								$block .= "<td valign='middle'>
								<a class='btn btn-primary ".$fb." ' href='".$url_str."'>
								<i class='icon-list icon-white'></i> ?????</a></td>";					



						$url_str = "edit-material.php";
						$url_str .= "?mat_id=".$row->mat_id;		
						$url_str .= "&strip=".$strip;											
						$url_str .= "&pagenum=".$pagenum;
						$url_str .= "&sortby=".$sortby;
						$url_str .= "&a_d=".$a_d;
						$url_str .= "&truncate=".$truncate;
						$url_str .= "&search_str=".$search_str;
						

						//Edit 
						$block .= "<td valign='middle'>
						<a class='btn btn-primary btn-small' href='".$url_str."'>
						<i class='icon-cog icon-white'></i> Edit</a></td>";

								
								$block .= "<td valign='middle'>
								<a class='btn btn-danger confirm ".$disabled." '>
								<i class='icon-remove icon-white'></i>
								<input type='hidden' id='".$row->mat_id."' class='itemId' value='".$row->mat_id."' /></a>
								</td>";
							
								$block .= "</tr>";
							}
							echo $block;
    					?>
				</table>
				<?php
				
				
				

			
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $last, 'design/tool.php', $sortby, $a_d);
			}

			?>	
			</div>
	</div>
	<p class="clear"></p>
    <?php
	if(!$strip){  
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	
	$url_str = "tool.php";
	$url_str .= "?strip=".$strip;							
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;			
	?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Attribute?</h3>
	<form name="del_material" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_material_id" class="itemId" type="hidden" name="del_material_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_material" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>

	
</body>
</html>
