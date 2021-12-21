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

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = 'Select Associated Products for Kit';
$page_group = 'item';

$cat_id =  (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
//if($cat_id == 0) $cat_id = $parent_cat_id;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

	


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
		
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');

		$db = $dbCustom->getDbConnect(CART_DATABASE);

		$sql = "SELECT item.name
				,item.item_id
				FROM  item 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
				AND is_kit = '0'
				AND item_id != '".$_SESSION['item_id']."'
				ORDER BY name";		
		
		$result = $dbCustom->getResult($db,$sql);		

		$url_str= SITEROOT.'manage/catalog/products/item.php';
$url_str = preg_replace('/(\/+)/','/',$url_str);

		$url_str.= "?parent_cat_id=".$_SESSION['parent_cat_id'];
		$url_str.= "&cat_id=".$_SESSION['cat_id'];						
		$url_str.= "&pagenum=".$_SESSION['paging']['pagenum'];
		$url_str.= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str.= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str.= "&truncate=".$_SESSION['paging']['truncate'];
		$url_str.= '&search_str='.$_SESSION['search_str'];

		?>
	
    	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
        
        <input type="submit" name="set_associated_items" value="Submit">
		<input type="hidden" name="item_id" value="<?php echo $_SESSION['item_id']; ?>">

    		<div class="data_table clearfix">
				
					
            	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
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
						
					
						$block .= "<tr><td>".stripslashes($row->name)."</td>";
						$block .= "<td>";
						$block .= "<div style='float:left;'>";
						//$block .= "<label>Choose</label>";
						$block .= "<div class='checkboxtoggle off'>"; 
						$block .= "<span class='ontext'>ON</span>";
						$block .= "<a class='switch on' href='#'></a>";
						$block .= "<span class='offtext'>OFF</span>";
						$block .= "<input type='checkbox' class='checkboxinput' name='item_ids[]' value='".$row->item_id."'/></div>";
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