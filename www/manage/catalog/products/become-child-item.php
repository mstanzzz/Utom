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

$page_title = 'Become Child Product';
$page_group = 'item';

$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
//if($cat_id == 0) $cat_id = $parent_cat_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	
function get_file_name($dbCustom,$img_id){
	$dbCustom = new DbCustom();
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT file_name
			FROM image
			WHERE img_id = '".$img_id."'";
	$re = $dbCustom->getResult($db,$sql);
	if($re->num_rows > 0){
		$object = $re->fetch_object();
		return  $object->file_name;
	}
	return  '';
}

$db = $dbCustom->getDbConnect(CART_DATABASE);


$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
if(!isset($_SESSION['parent_cat_id'])) $_SESSION['parent_cat_id'] = $parent_cat_id;

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = $cat_id;

$this_item_id = (isset($_GET['item_id'])) ? $_GET['item_id'] : 0; 
if(!isset($_SESSION['item_id'])) $_SESSION['item_id'] = $this_item_id*1;

$search_str = (isset($_GET['search_str'])) ? addslashes($_GET['search_str']) : ''; 
if(!isset($_SESSION['search_str'])) $_SESSION['search_str'] = $search_str;

$ret_page = (isset($_GET['ret_page'])) ? $_GET['ret_page'] : 'item'; 

$ret_dir = (isset($_GET['ret_dir'])) ? $_GET['ret_dir'] : '';





$sql = "SELECT item_id
		FROM item
		WHERE parent_item_id = '".$_SESSION['item_id']."'
		AND profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
		
	if($ret_dir != ''){
		$url_str= '../'.$ret_dir.'/'.$ret_page.'.php';
	}else{
		$url_str= $ret_page.'.php';
	}
	$url_str.= "?parent_cat_id=".$_SESSION['parent_cat_id'];
	$url_str.= "&cat_id=".$_SESSION['cat_id'];						
	$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
	$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
	$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
	$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str.= '&search_str='.$_SESSION['search_str'];
	
	echo "<br /><br />This product has child products and cannot become a child of another product <br /><br />";
	
	echo "<a href='".$url_str."' > Back </a>";
		
	exit;
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script>

</script>
</head>

<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
	
	//echo getItemSeoList(101, 'tie rack');
	
	
?>
<!--<a onClick="test();">TEST</a>-->
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT name
				,item_id
				,img_id
				FROM  item 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
				AND item_id != '".$_SESSION['item_id']."'
				ORDER BY item_id";		
		//AND parent_item_id = '0'
		$result = $dbCustom->getResult($db,$sql);		

		if($ret_dir != ''){
			$url_str= '../'.$ret_dir.'/'.$ret_page.'.php';
		
		}else{
			$url_str= $ret_page.'.php';
		}
		
		$url_str.= "?parent_cat_id=".$_SESSION['parent_cat_id'];
		$url_str.= "&cat_id=".$_SESSION['cat_id'];						
		$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str.= '&search_str='.$_SESSION['search_str'];

		?>
	
    	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
        
        <input type="submit" name="become_child" value="Submit">
		<input type="hidden" name="item_id" value="<?php echo $_SESSION['item_id']; ?>">

    		<div class="data_table clearfix">
				
					
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th>
							
							</th>
                        	<th>
                            ID                            
                            </th>
           					<th>
                            Name                            
                            </th>
                            <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
					
                    <?php 
                    
					$block = '';
					
					while($row = $result->fetch_object()){
						
						$file_name = get_file_name($dbCustom,$row->img_id);
						$block .= "<tr>";
						$block .= "<td>";
						$block .= "<img src='".SITEROOT."saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$file_name."'/>";
						$block .= "</td>";
						
						$block .= "<td>".$row->item_id."</td>";
						$block .= "<td>".stripslashes($row->name)."</td>";
						$block .= "<td>";
						$block .= "<div style='float:left;'>";
						//$block .= "<label>Choose</label>";
						$block .= "<div class='radiotoggle off'>"; 
						$block .= "<span class='ontext'>ON</span>";
						$block .= "<a class='switch on' href='#'></a>";
						$block .= "<span class='offtext'>OFF</span>";
						$block .= "<input type='radio' class='radioinput' name='parent_item' value='".$row->item_id."'/></div>";
						$block .= "</div>";
						$block .= "</td></tr>";
					
					}
					
					
					
					echo $block;
					
                    
					?>
					
					</tbody>
				</table>
       				
			</div>
            </form>
		
		</div>

 <p class="clear"></p>
  <?php 
    require_once($real_root.'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>