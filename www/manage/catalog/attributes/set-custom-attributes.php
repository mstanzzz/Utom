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

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.shipping.php');

$shipping = new Shipping;

//echo $admin_access->product_catalog_level;


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
	//
	while($opt_row = $result->fetch_object()){
	
			$sql = "DELETE FROM item_to_opt WHERE opt_id = '".$opt_row->opt_id."'";
			$temp_result = mysql_query($sql);
			//if(!$temp_result)die(mysql_error());
	}


	$sql = sprintf("DELETE FROM attribute WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	//

	$sql = sprintf("DELETE FROM opt WHERE attribute_id = '%u'", $attribute_id);
	$result = $dbCustom->getResult($db,$sql);
	//
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

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script type="text/javascript" src="<?php echo $ste_root; ?>/js/categorytree.js"></script>





<script type="text/javascript" language="javascript">





function show_children(cat_id){
	var wheel = "<li><img src='<?php echo $ste_root; ?>/images/progress.gif' style='width:25px;height:auto;'></li>";
	$("li#"+cat_id+" > ul.childrenplaceholder").html(wheel);

//alert(cat_id);

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
				
		//$(".item_attr_section").show();
	
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

			//alert("nnnn");
			
			var cat_id = $("#active_cat_id").val();
			
			var search_str = $("#active_search_str").val();
			
			if(search_str != ""){
				show_item_list(0,search_str);
			}else{
				show_item_list(cat_id,"");	
			}
			//alert(cat_id);
				
			
			
			//location.reload();
        	//return;

    	}	
	});
	
	

	$('#categorytree').tree();
	bindfocus();


	$(".expand-all").click(function(e){
		e.preventDefault();
		
		
		var state = $(this).text();
		if (state.indexOf("Expand") != -1){
			var wheel = "<div><img src='<?php echo $ste_root; ?>/images/progress.gif'></div>";
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
	

// Items

	
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
		
		//$(this).closest("tr").nextAll("tr").toggle();
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
if(!$strip){ 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
}
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php
		if(!$strip){  
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		}
		?>
	</div>
	<div class="manage_main">
		<?php 
		if(!$strip){ 
			require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
			$bread_crumb = new AdminBreadCrumb;
			$bread_crumb->reSet();
			$bread_crumb->add("Product Catalog", $ste_root."manage/catalog/catalog-landing.php");
			$bread_crumb->add("Attributes", '');
			echo $bread_crumb->output();
		}
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
		
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/attribute-section-tabs.php");
        
		
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
                        <th>
                            Name       
                        </th>
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
				<?php
				

			?>	
			</div>
            
         
         <input type="hidden" name="active_cat_id" id="active_cat_id" />
         
			
			<div class="colcontainer categorytreecontainer">

                   <a class="btn btn-large btn-primary expand-all">Expand All</a>

				<div class="twocols">
					<ul id="categorytree" role="tree" class="tree">
						<?php
							$block = '';
							foreach ($top_cats as $top_cat) {
								$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
								$block .= "<a tabindex='-1' class='tree-parent' onclick='show_children(".$top_cat['cat_id'].")'"; 
								$block .= "data-imageurl='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."'"; 
								$block .= "data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>".stripAllSlashes($top_cat['name'])."</a>";
								$block .= "<ul role='group' class='childrenplaceholder'></ul></li>";
							}
							echo $block;
						?>
					</ul>
				</div>
				<div class="twocols">
					<div class="categoryoptions_attr clearfix">
						
						Select a category to edit attributes.
						
					</div>
				</div>
			</div>
            
            
         
         <div class="search_bar">
				
                <form id="search_form" name="search_form" action="set-custom-attributes.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="search_str" class="searchbox" placeholder="Find a Product" />
                    <button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
                </form>
         </div>
         
         
         <input type="hidden" name="active_search_str" id="active_search_str" value="<?php echo $search_str; ?>" />
         
         
         
         <div class="item_attr_section">
         
         <?php
		 
		 
		 if($search_str != ''){
			
			$sql = "SELECT DISTINCT item.name
				,item.description
				,item.item_id
				,item.img_id
				,item.parent_item_id
				,item.show_in_cart
				,item.show_in_showroom
				,item.is_closet
				,item.short_description	
				,item.prod_number
				,item.sku
				,item.active
			FROM  item 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
			AND parent_item_id = '0'";
			
			if(is_numeric($search_str)){
				$sql .= " AND (item.name like '%".$search_str."%' ||  item.profile_item_id = '".$search_str."')";				
			}else{
				$sql .= " AND item.name like '%".$search_str."%'";
			}
			
			$result = $dbCustom->getResult($db,$sql);
			
		}elseif($cat_id > 0){
				
			$sql = "SELECT DISTINCT item.name
					,item.description
					,item.item_id
					,item.img_id
					,item.parent_item_id
					,item.show_in_cart
					,item.show_in_showroom
					,item.is_closet
					,item.short_description	
					,item.prod_number
					,item.sku
					,item.active
				FROM  item, item_to_category 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'			
				AND item.item_id = item_to_category.item_id 						
				AND item_to_category.cat_id = '".$cat_id."'
				AND parent_item_id = '0'";	
			
		}
		 
		 
		?>
		<div class="data_table clearfix">
          	<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
							<th width="2%"></th>
							<th width="7%">Image</th>
           					<th>
                            Name
                            </th>
           					<th>
                            Categories
                            </th>							
           					<th>
                            Add Children
                            </th>							

							<th width="18%">Edit Attributes</th>
						</tr>
					</thead>
					<tbody>


    	<?php 
         
	   
    $block = '';
	while($row = $result->fetch_object()) {

			//children products for this product...
			$sql = "SELECT name
				,item_id
				,img_id
				,parent_item_id
				,prod_number
				,sku
				,active			
			FROM  item
			WHERE parent_item_id = '".$row->item_id."'
			AND profile_account_id = '".$_SESSION['profile_account_id']."' 
			ORDER BY item_id";
			
			
			$child_res = $dbCustom->getResult($db,$sql);
			
			$block .= "<tr class='hoverable'>";
			
			$block .= "<td>";
			if($child_res->num_rows > 0){
				//collapse/expand
				$block .= "<a href='#' class='item-show-children btn btn-tiny'><i class='icon-chevron-right'></i></a>";
			
			}
			$block .= "</td>";

			$block .= "<td>";

			//product image
			$sql = "SELECT file_name FROM image WHERE img_id = '".$row->img_id."'";
			$img_res = $dbCustom->getResult($db,$sql);
			if(!$img_res){ die(mysql_error()); }
			if($img_res->num_rows > 0){
				$img_object = $img_res->fetch_object();
				
				$block .= "<a class='fancybox' href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_object->file_name."'>";
				$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$img_object->file_name."'></a>";
			}
			$block .= "</td>";
			
			//product Name
			//$block .= "<td>".stripAllSlashes($row->name)."    ".$row->item_id."</td>";
			$block .= "<td>".stripAllSlashes($row->name)."</td>";
			
			//product ID
			//$block .= "<td>".$row->prod_number."</td>";
			
			
			//product Categories
			$block .= "<td>";
			$sql = "SELECT DISTINCT category.name  
                    FROM category, item_to_category 
                    WHERE category.cat_id = item_to_category.cat_id
                    AND item_to_category.item_id = '".$row->item_id."'";
			$res = $dbCustom->getResult($db,$sql);		
            while($cg_row = $res->fetch_object()) {
                $block .= "<br />".stripAllSlashes($cg_row->name);	
            }
            $block .= "</td>";    


			$disabled = ($admin_access->product_catalog_level < 2)? "disabled" : '';

			// Add Child
			$url_str = "../products/add-item.php";
			$url_str .= "?parent_item_id=".$row->item_id;
			$url_str .= "&search_str=".$search_str;
			$url_str .= "&ret_page=set-custom-attributes";
			$url_str .= "&ret_dir=attributes";
	
			$block .= "<td><a class='btn btn-small btn-primary' href='".$url_str."'><i class='icon-plus icon-white'></i> Child</a><br />";

			
			//edit
			$url_str = "edit-item-attributes.php";
			$url_str .= "?item_id=".$row->item_id;
			$url_str .= "&firstload=1";

			$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' 
			href='".$url_str."'><i class='icon-cog icon-white'></i> Edit Attributes</a></td>";
			
			
			
			$block .= "</tr>";

			while($child_row = $child_res->fetch_object()) {

				$block .= "<tr class='hoverable item_child'>";
				$block .= "<td>Child</td>";
				//product image
				$sql = "SELECT file_name FROM image WHERE img_id = '".$child_row->img_id."'";
				$img_res = $dbCustom->getResult($db,$sql);
				if($img_res->num_rows > 0){
					$img_object = $img_res->fetch_object();
					// childthumb
					$block .= "<td valign='middle'><a class='fancybox' 
					href='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$img_object->file_name."'>";
					$block .= "<img  src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$img_object->file_name."'></a>";
				}else{
					$block .= "<td  colspan='2'></td>";
				}
				
				//$block .= " ".stripAllSlashes($child_row->name)."  --- ".$child_row->item_id."</td>";
				$block .= "<td>".stripAllSlashes($child_row->name)."</td>";
				
			
				$sql = "SELECT DISTINCT category.name  
						FROM category, item_to_category 
						WHERE category.cat_id = item_to_category.cat_id
						AND item_to_category.item_id = '".$child_row->item_id."'";
						
				$res = $dbCustom->getResult($db,$sql);

				$block .= "<td>";						
				while($cg_row = $res->fetch_object()) {
					$block .= "<br />".stripAllSlashes($cg_row->name);	
				}
				$block .= "</td>";      
				
				//$block .= "<td></td>";
				
				
				
				
				//edit
				$url_str = "edit-item-attributes.php";
				$url_str .= "?item_id=".$child_row->item_id;
				$url_str .= "&firstload=1";
				
								
				$block .= "<td><a class='btn btn-primary btn-small fancybox fancybox.iframe' href='".$url_str."'><i class='icon-cog icon-white'></i> Edit Attributes</a></td>";


				$block .= "</tr>";	
			}
			
			
			
	
	}
   echo  $block;
     
	 
		?>         
    	</tbody>
		</table>
        </div>
        
        </div>
         
               
            
	</div>
    
    
    
	<p class="clear"></p>
    <?php
	if(!$strip){  
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	}
	
	$url_str = "set-custom-attributes.php";
	
	?>
</div>


	<!-- New Add Dialogue -->
	<div id="content-add" class="confirm-content">
		<form name="add_attribute" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Add New Custom Attribute</label>
				<input type="text" class="contentToAdd"  name="added_attribute">
			</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_attribute" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
		</form>
	</div>
	<!-- New Edit Dialogue -->
	<div id="content-edit" class="confirm-content">
		<form name="edit_attribute" action="<?php echo $url_str; ?>" method="post" target="_top">
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
	<form name="del_attribute" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_attribute_id" class="itemId" type="hidden" name="del_attribute_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_attribute" type="submit" >Yes, Delete</button>
	</form>
</div>    


</body>
</html>


<!--

function bindfocus(){

	alert("bindfocus");

	
	$('.tree li a').focus(function(){
		
		var catid;
		var catname;
		var img;
		var editbtn;
		var template
		
		catid = $(this).attr("data-catid");
		
		catname = $(this).text();

		img = '<img src="'+$(this).attr("data-imageurl")+'" />';

		//editbtn = "<a href='edit-cat-attributes.php?cat_id="+catid+"' class='btn btn-primary fancybox fancybox.iframe' > <i class='icon-cog icon-white'></i> Edit</a>";	
		
	




		//template += getCatBoxContent(catid);
	
		$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'ajax_get_cat_attr_box_content.php?catid='+catid,
			  success: function(data) {			
				
				//alert("|"+data+"|");
	
				template = '<a style="cursor:pointer; float:right;" onClick="closeCatBox()">Close</a><br /><br />'+img+'<h4><br />'+catname+'</h4><div class="fltlft"></div>';

				//template += data;

				$(".categoryoptions_attr").show();
				
				$(".categoryoptions_attr").empty();
				
				$(".categoryoptions_attr").html(template+data);



	
			  }
		});		



	

	});
	
}



-->