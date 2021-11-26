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

$page_title = 'Category Tree';
$page_group = 'category';

$msg = '';

$parent_cat_id = (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;
$_SESSION['parent_cat_id'] = $parent_cat_id;

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

if(isset($_POST['add_item'])){
	include('../include-add-item.php');
}

if(isset($_POST['edit_item'])){
	include('../include-edit-item.php');
}

if(isset($_POST['del_cat_id'])){

	$cat_id = $_POST['del_cat_id'];
	
	$sql = "DELETE FROM child_cat_to_parent_cat 
			WHERE child_cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = sprintf("DELETE FROM category WHERE cat_id = '%u'", $cat_id);
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM category_to_attr 
			WHERE cat_id = '".$cat_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$msg = 'Your change is now live.';

}

$top_cats = array();
$sql = "SELECT cat_id, name, img_id, show_on_home_page 
		FROM category 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
if(isset($_POST["category_search"])){
	$search_str = trim(addslashes($_POST["category_search"]));
	$sql .= " AND name like '%".$search_str."%'";
}
$sql .=  "ORDER BY name";
$result = $dbCustom->getResult($db,$sql);				
$i = 0;
while($row = $result->fetch_object()) {
	$top_cats[$i]['cat_id'] = $row->cat_id;
	$top_cats[$i]['name'] = $row->name;
	$top_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
	$sql = "SELECT file_name 
			FROM image
			WHERE img_id = '".$row->img_id."'";
	$img_res = $dbCustom->getResult($db,$sql);
	if($img_res->num_rows > 0){
		$img_obj = $img_res->fetch_object();
		$top_cats[$i]['file_name'] = $img_obj->file_name;
	}else{
		$top_cats[$i]['file_name'] = '';					
	}
	$i++;
}

$_SESSION['new_img_id'] = 0;
$_SESSION['img_id'] = 0;

$alt_ret_page = (isset($_GET['alt_ret_page']))? $_GET['alt_ret_page'] : '';
if($alt_ret_page != ''){
	$_SESSION['alt_ret_page'] = $alt_ret_page;
}
unset($_SESSION['ret_page']);
unset($_SESSION['item_id']);
unset($_SESSION['temp_item_fields']);
unset($_SESSION['temp_item_cats']);
unset($_SESSION['temp_attr_opt_ids']);
unset($_SESSION['new_img_id']);
unset($_SESSION['img_id']);
unset($_SESSION['parent_item_id']);
unset($_SESSION['temp_gallery']);
unset($_SESSION['temp_documents']);
unset($_SESSION['home_cats']);
unset($_SESSION['top_cats']);
		
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
		
?>

<script type="text/javascript" src="<?php echo SITEROOT; ?>js/categorytree.js"></script>

<script type="text/javascript" language="javascript">

function bindfocus(){
	$('.tree li a').focus(function(){
		
		var catid = $(this).attr("data-catid");		
		var catname = $(this).text();
		var cattype = $(this).attr("data-cattype");
		var img = '<img src="'+$(this).attr("data-imageurl")+'" />';
		var editbtn;
		var deletebtn = '';
		
		editbtn = '<a href="edit-top-category.php?cat_id='+catid+'&ret_page=category-tree&firstload=1&strip=1" class="btn btn-primary fancybox fancybox.iframe"><i class="icon-cog icon-white"></i> Edit</a>';
		deletebtn = '<a class="btn btn-danger" onclick="callConfirmDelete('+catid+');"><i class="icon-remove icon-white"></i></a>';		
		
		$(".categoryoptions .content").empty();
		var template = img+'<h4>'+catname+'</h4><div class="fltlft">'+editbtn+deletebtn+'</div>';
		$(".categoryoptions .content").prepend(template);
	});
}


$(document).ready(function(){

	$('#categorytree').tree();
	bindfocus();

	$(".expand-all").click(function(e){
		e.preventDefault();
		var state = $(this).text();
		if (state.indexOf("Expand") != -1){
			var wheel = "<div><img src='<?php echo SITEROOT; ?>images/progress.gif'></div>";
			$('#categorytree').html(wheel);
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_get_tree_expanded_cat_list.php',
			  success: function(data) {
					$('#categorytree').html(data);
					bindfocus();
					//console.log(data);
			  }
			});
			$(this).text("Collapse All");
		}
		else {
			collapse_all();
			$(this).text("Expand All");
			bindfocus();
		}
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
<div class="manage_page_container <?php if($strip){ echo 'lightbox'; }?>">
    <div class="manage_side_nav">
        <?php
		if(!$strip){  
        	require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
		}
		?>
    </div>	
    <div class="manage_main">
	<?php
	if($_SESSION['alt_ret_page'] != ''){
	echo "<a href='".SITEROOT."/manage/mPDF/data-table.php'>Return To Price Sheets</a>";	
	}
	require_once($real_root."/manage/admin-includes/category-section-tabs.php");
	?>
	<div class="page_actions cancelscroll">
		<div class="search_bar">
			<form name="search_form" action="category-tree.php" method="post" enctype="multipart/form-data">
			<input type="text" name="category_search" class="searchbox" placeholder="Find a Category" />
			<button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
			</form>
		</div>

		<a class="btn btn-large btn-primary <?php if(!$strip){ echo "fancybox fancybox.iframe"; } ?>" 
		href="add-top-category.php?ret_page=top&firstload=1&strip=1">
		<i class="icon-plus icon-white"></i> Add Top Category 
		</a>
		<a class="btn btn-large btn-primary expand-all">Expand All</a>
	</div>

<div class="colcontainer categorytreecontainer">
<div class="twocols">
<ul id="categorytree" role="tree" class="tree">
<?php
$block = '';
foreach ($top_cats as $top_cat) {
$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
$block .= "<a tabindex='-1' class='tree-parent' onclick='show_children(".$top_cat['cat_id'].")'"; 
$block .= "data-imageurl='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$top_cat['file_name']."'"; 
$block .= "data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>".stripslashes($top_cat['name'])."</a>";
$block .= "<ul role='group' class='childrenplaceholder'></ul></li>"; 
}
echo $block;
?>
</ul>
</div>
<div class="twocols">
<div class="categoryoptions clearfix">
<h3>Selected Category Info &amp; Options</h3>
<div class="content">
Select a category to view its image and edit and delete options.
</div>
</div>
</div>
</div>
        
<div id="content-delete" class="confirm-content">
<h3>Are you sure you want to delete this category?</h3>
<form name="del_category" action="category-tree.php?strip=<?php echo $strip; ?>" method="post" target="_top">
<input id="del_cat_id" class="itemId" type="hidden" name="del_cat_id" value='' />
<a class="btn btn-large dismiss" onClick="callConfirmDismiss();" target="_top">No, Cancel</a>
<button class="btn btn-danger btn-large" name="del_cat" type="submit" >Yes, Delete</button>
</form>
</div>
<div class="disabledMsg">
<p>Sorry, this item can't be deleted or inactive.</p>
</div>

</div>

<p class="clear"></p>
    <?php
	if(!$strip){  
    	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	}
	?>
</div>

</body>
</html>


