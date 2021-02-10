<?php



	if(!isset($_SESSION['cat_id'])) $_SESSION['cat_id'] = 0;

	if($_SESSION['cat_id'] == 0){
		unset($_SESSION['temp_cat']);	
	}

	$top_cats = array();
		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT cat_id, name, img_id, show_on_home_page 
				FROM category 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				ORDER BY name";
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
		
		
		
		if(!isset($_SESSION['temp_cat'])){ 
			$_SESSION['temp_cat']['cat_id'] = 0;
			$_SESSION['temp_cat']['name'] = '';
		}
		
		
		//echo "cat_id".$_SESSION['cat_id'];

		if($_SESSION['cat_id'] > 0){
			
			if($_SESSION['temp_cat']['cat_id'] == 0){
			
				$db = $dbCustom->getDbConnect(CART_DATABASE);
				$sql = "SELECT name 
						FROM category 
						WHERE cat_id = '".$_SESSION['cat_id']."'";
				$result = $dbCustom->getResult($db,$sql);				
				if($result->num_rows > 0){		
					$object = $result->fetch_object();
					$_SESSION['temp_cat']['cat_id'] = $_SESSION['cat_id'];	
					$_SESSION['temp_cat']['name'] = $object->name;	
				
				}
			}				
		}

		
		//echo "ggggggggggggggggggggggggggggggggggggggggggg".$_SESSION['cat_id'];
		//print_r($_SESSION['temp_cat']);
	
?>
<script type="text/javascript">
function show_children(cat_id){
	var wheel = "<li><img src='<?php echo $ste_root; ?>/images/progress.gif' style='width:25px;height:auto;'></li>";
	$("li#"+cat_id+" > ul.childrenplaceholder").html(wheel);
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo $ste_root; ?>/manage/cms/ajax_get_radio_tree_snippet_child_cats_list.php?cat_id='+cat_id+'&subject_cat_id='+<?php echo $_SESSION['cat_id']; ?>,
		success: function(data) {
			$("li#"+cat_id+" > ul.childrenplaceholder").html(data);
			updateCheckboxes();
	  }
	});
}
function setCatBox(){
	var $optarr = $("select.selectedCats");
	<?php
	if($_SESSION['temp_cat']['cat_id'] > 0){
		
		
		$cat_path_array = getCatPath($_SESSION['temp_cat']['cat_id']);
		$cat_tooltip = '';
		$i = 0;
		$last_index = sizeof($cat_path_array);
		foreach($cat_path_array as $cat_name){
			$cat_name = preg_replace( '/[^a-zA-Z0-9-]+/', ' ', $cat_name );
			$cat_tooltip .= $cat_name;
			$i++;
			if($i < $last_index){
				$cat_tooltip .= " -> ";
			}
		}
	
	?>
		var option = "<option title='<?php echo $cat_tooltip; ?>' id='<?php echo $_SESSION['temp_cat']['cat_id']; ?>' value='<?php echo $_SESSION['temp_cat']['cat_id']; ?>' ><?php echo $_SESSION['temp_cat']['name']; ?></option>";
		var opt = $(option);
		$optarr.append(opt);
		opt.attr("selected","selected");
	
	<?php	
	}
	?>
	$(".selectedCats").trigger("liszt:updated");
}


function updateOptions(cat_id){
	
	
	//alert(cat_id);
	// deselect all
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
		url: '<?php echo $ste_root; ?>/manage/cms/ajax_reset_tempcat_session.php?cat_id='+cat_id,
		success: function(data) {
			//alert(data);
			//updateCheckboxes();
	  }
	});

	
	var selectedCategories = $(".selectcattree input[type='checkbox']");
	var $optarr = $("select.selectedCats");
	$(selectedCategories).each(function() {

		var currentId = $(this).val();
		if(currentId != cat_id){				
			$(this).removeAttr("checked");	
		}
	
		//alert($(this).val());
	
		var option = "<option id='"+currentId+"' value='"+currentId+"' >"+$(this).next(".categoryname").val()+" "+currentId+"</option>";
		var opt = $(option);
		if ($($optarr).has("option#"+currentId).length){
			var existingitem = $optarr.find("option#"+currentId);
			if($(this).attr("checked") == "checked"){
				existingitem.attr("selected","selected");	
			}else{
				existingitem.removeAttr("selected");	
			}
		}
		else {
			if($(this).attr("checked") == "checked"){
				opt.attr("selected","selected");	
			}
			$optarr.append(opt);
		}
	});
	
	$(".selectedCats").trigger("liszt:updated");
	
	
	
}



function updateCheckboxes(){
	$("select.selectedCats option").each(function() {
		var currentId = $(this).attr("id");
		if ($(".selectcattree input[type='checkbox']#"+currentId).length){
			var existingitem = $(".selectcattree").find("input#"+currentId);
			if($(this).is(":selected")){
				existingitem.attr("checked","checked");					
			}else{
				existingitem.removeAttr("checked");	
			}
		}
	});
}



function collapse_all(){
	$('.selectcattree ul.childrenplaceholder').empty();	
}

$(document).ready(function(){
	$("li").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});
	$("select.selectedCats").change(function(e){
		updateCheckboxes();	
	});
	$(".expand-all").click(function(e){
		
		e.preventDefault();
		var state = $(this).text();
		if (state.indexOf("Expand") != -1){
			var wheel = "<li><img src='<?php echo $ste_root; ?>/images/progress.gif'></li>";
			$('#categorytree').html(wheel);
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: '<?php echo $ste_root; ?>/manage/cms/ajax_get_radio_tree_snippet_expanded_cat_list.php?subject_cat_id='+<?php echo $_SESSION['cat_id']; ?>,
			  success: function(data) {
				$('#categorytree').html(data);
				updateCheckboxes();
			  }
			});
			$(this).text("Collapse All");
		}
		else {
		
			collapse_all();
			$(this).text("Expand All");
		}
	});
	setCatBox();
});


</script>
<script type="text/javascript" src="<?php echo $ste_root;?>/js/categorytree.js"></script>

<label>Search for and Select Categories using the category tree. As select and deselect categories from the tree, the searchbox will display the selected categories.</label>
<select id="cats" style="width: 90%;" multiple="multiple" class="selectedCats chosen" data-placeholder='Search and Select Categories' name="chosen_categories[]">
	<!--<option class="placeholder_option">Placeholder</option>-->
</select>
<div class="mT10 mB10"><a class="btn btn-large btn-primary expand-all">Expand All Categories</a></div>
<ul id="categorytree" role="tree" class="tree selectcattree">
	<?php
					$block = '';
					
					
					
					foreach ($top_cats as $top_cat) {
														
						$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
						
						$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' 
						onclick='show_children(".$top_cat['cat_id'].")'  data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>
						<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$top_cat['file_name']."'  /><span  >".$top_cat['name']."</span>";

						$checked = ($top_cat['cat_id'] == $_SESSION['temp_cat']['cat_id'])  ? "checked='checked'" : '';
						
						$block .= "<input class='checkbox' onclick='updateOptions(\"".$top_cat['cat_id']."\")' type='radio' id='".$top_cat['cat_id']."' name='cat_id' value='".$top_cat['cat_id']."' ".$checked." />
						<input type='hidden' value='".$top_cat['name']."' name='categoryname' class='categoryname' /></a>";
						
						$block .= "<ul role='group' class='childrenplaceholder'></ul></li>"; 

					}
					echo $block;
				?>
</ul>
