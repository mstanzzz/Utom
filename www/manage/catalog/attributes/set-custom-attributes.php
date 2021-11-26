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
require_once($real_root.'/includes/class.shipping.php');

$shipping = new Shipping;
$progress = new SetupProgress;
$module = new Module;
$page_title = "Custom Product Attributes";
$page_group = "attribute";
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$db = $dbCustom->getDbConnect(CART_DATABASE);

if(isset($_POST["add_attribute"])){
	$added_attribute = addslashes($_POST["added_attribute"]); 
	$sql = sprintf("SELECT attribute_id 
					FROM attribute 
					WHERE attribute_name = 's'
					AND profile_account_id = '%u'", 
					$added_attribute,$_SESSION['profile_account_id']);	
	$result = $dbCustom->getResult($db,$sql);	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO attribute (attribute_name, profile_account_id) VALUES ('%s','%u')", $added_attribute, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		$msg = "Attribute Added Successfully.";
	}else{
		$msg = "The attribute name already exists";
	}
}
if(isset($_POST["edit_attribute"])){
	$name = addslashes($_POST["attribute_name"]); 
	$attribute_id = $_POST["attribute_id"];
	$sql = sprintf("UPDATE attribute SET attribute_name = '%s' WHERE attribute_id = '%u'", 
	$name, $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Attribute successfully edited.";
}
if(isset($_POST["del_attribute"])){
	$attribute_id = $_POST["del_attribute_id"];
	$sql = "SELECT opt_id 
			FROM attribute, opt 
			WHERE attribute.attribute_id = opt.attribute_id
			AND attribute.attribute_id = '".$attribute_id."'
			";
	$result = $dbCustom->getResult($db,$sql);
	while($opt_row = $result->fetch_object()){
			$sql = "DELETE FROM item_to_opt WHERE opt_id = '".$opt_row->opt_id."'";
			$temp_result = mysql_query($sql);
	}
	$sql = sprintf("DELETE FROM attribute WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	$sql = sprintf("DELETE FROM opt WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Attribute successfully deleted.";
}

if(isset($_POST['add_item'])){
	include('../include-add-item.php');
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
	$sql = "SELECT child_cat_to_parent_cat_id 
			FROM child_cat_to_parent_cat
			WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
	$res = $dbCustom->getResult($db,$sql);				
	if(!$res->num_rows > 0){
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
}

$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : '';
unset($_SESSION['ret_page']);
unset($_SESSION['ret_dir']);
unset($_SESSION['item_id']);
//unset($_SESSION['temp_item_fields']);
//unset($_SESSION['temp_item_cats']);
//unset($_SESSION['temp_attr_opt_ids']);
unset($_SESSION['img_id']);
//unset($_SESSION['parent_item_id']);
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script type="text/javascript" src="<?php echo SITEROOT; ?>js/categorytree.js"></script>
<script type="text/javascript" language="javascript">
function show_children(cat_id){
	var wheel = "<li><img src='<?php echo SITEROOT; ?>images/progress.gif' style='width:25px;height:auto;'></li>";
	$("li#"+cat_id+" > ul.childrenplaceholder").html(wheel);
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '../categories/ajax_get_tree_child_cats_list.php?cat_id='+cat_id,
	  success: function(data) {
			$("li#"+cat_id+" > ul.childrenplaceholder").html(data);
			
			bindfocus();
			//console.log(data);
	  }
	});
}
function collapse_all(){
	<?php foreach($top_cats as $top_cat) { ?>				
		$('#'+<?php echo $top_cat['cat_id']; ?>+' ul.childrenplaceholder').html('');
		$('#'+<?php echo $top_cat['cat_id']; ?>+' a').click();	
	<?php } ?>
	bindclick();
}
function bindclick(){
	<?php foreach($top_cats as $top_cat) { ?>				
		$('#'+<?php echo $top_cat['cat_id']; ?>+' a').bind('click',show_children(<?php echo $top_cat['cat_id']; ?>));
	<?php } ?>
}
function bindfocus(){
	$('.tree li a').focus(function(){
		var catid;
		var catname;
		var img;
		var editbtn;
		var template
		cat_id = $(this).attr("data-catid");
		$("#active_cat_id").val(cat_id);
		catname = $(this).text();
		img = '<img src="'+$(this).attr("data-imageurl")+'" />';
		editbtn = "<a href='edit-cat-attributes.php?cat_id="+cat_id+"&firstload=1' class='btn btn-primary fancybox fancybox.iframe' >"; 
		editbtn += "<i class='icon-cog icon-white'></i> Edit Allowed Attributes</a>";	
		template = '<a style="cursor:pointer; float:right;" onClick="closeCatBox()">Close</a><br /><br />'+img+'<h4><br />'+catname+'</h4><div class="fltlft">'+editbtn+'</div>';	
		$(".categoryoptions_attr").show();
		$(".categoryoptions_attr").empty();
		$(".categoryoptions_attr").html(template);
		$(".item_attr_section").empty();
		show_item_list(cat_id,"");
	});
}
function show_item_list(cat_id,search_str){
	$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: 'ajax_get_items_list_attr.php?cat_id='+cat_id+'&search_str='+search_str,
		  success: function(data) {	
			$(".item_attr_section").html(data);
		  }
		});	
}
function closeCatBox(){
	$(".categoryoptions_attr").hide();
}

$(document).ready(function(){

	$(".categoryoptions_attr").hide();
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 900,
		afterClose : function() {
			var cat_id = $("#active_cat_id").val();
			var search_str = $("#active_search_str").val();
			if(search_str != ""){
				show_item_list(0,search_str);
			}else{
				show_item_list(cat_id,"");	
			}
    	}	
	});
	
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
			  url: '../categories/ajax_get_tree_expanded_cat_list.php',
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
	$(".item_child").toggle();
	$("tbody tr.hoverable").hover(function(){
		if($(this).hasClass("item_child")){
			$(this).closest("tbody").first("tr").css("background-color", "#F9FBFC");
			$(this).css("background-color", "#dce9f0");
		}
		else {
			$(this).css("background-color", "#F9FBFC");	
		}
	}, function(){
		$(this).css("background-color", "transparent");
		if($(this).hasClass("item_child")){
			$(this).closest("tbody").first("tr").css("background-color", "transparent");
		}
	});
	$(".item-show-children").click(function(e){
		e.preventDefault();
		$(this).closest("tr").nextAll(".item_child").toggle();	
		var icon = $(this).html();
		if (icon == '<i class="icon-chevron-right"></i>'){
			$(this).html('<i class="icon-chevron-down"></i>');
		}else {
			$(this).html('<i class="icon-chevron-right"></i>');	
		}
	});
	
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
		if($admin_access->product_catalog_level > 1){
		?>
			<div class="page_actions"> 
            <a  class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Attribute </a>
			</div>		
        <?php 
		}
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT * 
				FROM attribute 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY attribute_name";
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows < 1){
			echo "No attributes";	
		}
		?>



<div class="data_table">
<table cellpadding="10" cellspacing="0">
<thead>
<tr>
<th>Name</th>
<th width="16%">Options</th>
<th width="13%">Edit</th>
<th width="13%">Delete</th>
</tr>
</thead>
<?php
$block = '';
$j = 0;
while($row = $result->fetch_object()) {
	$j =  $j +1;
	$block .= "<tr>";
	$block .= "<td valign='middle' width='300px'>".stripslashes($row->attribute_name)."</td>";
	$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';
	$fb = (!$strip) ? "fancybox fancybox.iframe" : '';						
	
	$url_str = "option.php";
	$url_str .= "?attribute_id=".$row->attribute_id;
	$url_str .= "&strip=".$strip;
	$url_str .= "&ret_page=set-custom-attributes";							

	$block .= "<td valign='middle'>
	<a class='btn btn-primary ".$fb." ' href='".$url_str."'>
	<i class='icon-list icon-white'></i> Options</a></td>";	

	$block .= "<td><a class='btn btn-primary confirm confirm-edit ".$disabled."' ><i class='icon-cog icon-white'></i> 
	Edit<input type='hidden' class='itemId' id='".$row->attribute_id."' value='".$row->attribute_id."' />
	<input type='hidden' class='contentToEdit' id='".$row->attribute_id."' value=\"".htmlentities($row->attribute_name)."\" /></a></td>";								

	$block .= "<td valign='middle'>
	<a class='btn btn-danger confirm ".$disabled." '>
	<i class='icon-remove icon-white'></i>
	<input type='hidden' id='".$row->attribute_id."' class='itemId' value='".$row->attribute_id."' /></a>
	</td>";												


	$block .= "</tr>";
}
echo $block;
?>
</table>
</div>


<div id="content-add" class="confirm-content">
<form name="add_attribute" action="set-custom-attributes.php" method="post" target="_top">
<fieldset class="colcontainer">
<label>Add New Custom Attribute</label>
<input type="text" class="contentToAdd"  name="added_attribute">
</fieldset>
<a class="btn btn-large dismiss"> Cancel </a>
<button name="add_attribute" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
</form>
</div>

<div id="content-edit" class="confirm-content">
<form name="edit_attribute" action="set-custom-attributes.php" method="post" target="_top">
<input id="attribute_id" type="hidden" class="itemId" name="attribute_id" value='' />
<fieldset class="colcontainer">
<label>Edit Attribute</label>
<input type="text" class="contentToEdit"  name="attribute_name" value=''>
</fieldset>
<a class="btn btn-large dismiss"> Cancel </a>
<button name="edit_attribute" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
</form>
</div>
    
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this Attribute?</h3>
	<form name="del_attribute" action="set-custom-attributes.php" method="post" target="_top">
		<input id="del_attribute_id" class="itemId" type="hidden" name="del_attribute_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_attribute" type="submit" >Yes, Delete</button>
	</form>
</div>    


</body>
</html>

