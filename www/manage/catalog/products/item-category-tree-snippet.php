<?php
	if(!isset($cat_id)) $cat_id = 0;

	if(!isset($cat_context)) $cat_context = '';

	if(!isset($item_id)) $item_id = 0;

	$top_cats = array();
	$item_cats = array();
	
	$sql = "SELECT cat_id, name, img_id, show_on_home_page 
			FROM category 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
			ORDER BY name";
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
	
	if(!isset($_SESSION['temp_item_cats'])) $_SESSION['temp_item_cats'] = array();
		
	if($cat_id > 0){
		if(!inArray($cat_id, $_SESSION['temp_item_cats'], 'cat_id')){
			$sql = "SELECT name 
					FROM category 
					WHERE cat_id = '".$cat_id."'";
			$result = $dbCustom->getResult($db,$sql);					
			if($result->num_rows > 0){
				$c_obj = $result->fetch_object();
				$i = count($_SESSION['temp_item_cats']);
				$_SESSION['temp_item_cats'][$i]['cat_id'] = $cat_id;
				$_SESSION['temp_item_cats'][$i]['name'] = $c_obj->name;
			}
		}
	}

	
?>

<script type="text/javascript">


function setCatBox(){
	var $optarr = $("select.selectedCats");
	<?php
	if(is_array($_SESSION['temp_item_cats'])){	
		foreach($_SESSION['temp_item_cats'] as $val){
			
			$cat_path_array = getCatPath($val['cat_id']);
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

	var option = "<option title='<?php echo $cat_tooltip; ?>' id='<?php echo $val['cat_id']; ?>' value='<?php echo $val['cat_id']; ?>' ><?php echo $val['name']; ?></option>";
	var opt = $(option);
	$optarr.append(opt);
	opt.attr("selected","selected");

	<?php	
	} }
	?>
	$(".selectedCats").trigger("liszt:updated");
}

function updateOptions(the_cat_id){
	
	if(typeof the_cat_id == "undefined"){
		the_cat_id = 0;
	}		
	
	var selectedCategories = $("#categorytree input[type='checkbox']");
	var $optarr = $("select.selectedCats");
	var add_the_cat = 0;
	
	var i = 0;
	$(selectedCategories).each(function() {
		
		var currentId = $(this).attr("id");
		var option = "<option id='"+currentId+"' value='"+currentId+"' >"+$(this).next(".categoryname").val()+" "+currentId+"</option>";
		var opt = $(option);

		if ($($optarr).has("option#"+currentId).length){
			
			var existingitem = $optarr.find("option#"+currentId);
			if($(this).attr("checked") == "checked"){
				existingitem.attr("selected","selected");
				if(the_cat_id == currentId){
					add_the_cat = 1;	
				}	
			}else{
				existingitem.removeAttr("selected");	
			}
		}
		else {
			if($(this).attr("checked") == "checked"){
				opt.attr("selected","selected");	
			
				if(the_cat_id == currentId){
					add_the_cat = 1;	
				}	
			}
			$optarr.append(opt);
		}
				
	});

	$(".selectedCats").trigger("liszt:updated");
	
	if(the_cat_id > 0){
		add_del_cat_in_session(the_cat_id, add_the_cat);
	}
}

function add_del_cat_in_session(the_cat_id, add_the_cat){
	if(add_the_cat){
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: "<?php echo $ste_root; ?>/manage/catalog/products/ajax_add_cat_to_session.php?cat_id="+the_cat_id,
		  success: function(data) {
			set_attr_section();
		  }
		});
	}else{
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: '<?php echo $ste_root; ?>/manage/catalog/products/ajax_del_cat_from_session.php?cat_id='+the_cat_id,
		  success: function(data) {
		  	set_attr_section();
		  }
		});
	}
}

function collapse_all(){
	$('.selectcattree ul.childrenplaceholder').empty();	
}

function ajax_set_cats(selectedCatsArr){
	var q_str = "?cat_list=";
	$(selectedCatsArr).each( function(index, value){
		q_str += value+"|";
	})
	q_str = q_str.replace(/(\s+)?.$/, '');
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  
	  url: '<?php echo $ste_root; ?>/manage/catalog/products/ajax_set_cats.php'+q_str,
	  success: function(data) {
		//alert(data);

		set_attr_section();

	  }
	});
	
}


function set_attr_section(){
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '<?php echo $ste_root; ?>/manage/catalog/products/ajax_get_attr_area.php',
	  success: function(data) {
		$("#attr_section").html(data);
		//$(".chosen").chosen();
		//alert(data);
	  }
	});
}

$(document).ready(function(){


	$("li").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});

	var selectedListCats = $("select.selectedCats");
	//alert(selectedListCats.length);

	$(selectedListCats).change(function(e){
		e.preventDefault();

		var selectedCategories = $("#categorytree input[type='checkbox']");
		
		var selectedCats = $("select.selectedCats option:selected");
		var selectedCatsArr = [];
		var n = 0;
		
		$(selectedCats).each(function(){
			selectedCatsArr[n] = $(this).attr("id");
			n++;
		});
		
		$(selectedCategories).each(function() {
			if($.inArray($(this).val(),selectedCatsArr) == -1){
				$(this).prop("checked",false);
			}
			else {
				$(this).prop("checked",true);
			}
		});
		
		ajax_set_cats(selectedCatsArr);
	});


	$(".expand-all").click(function(e){
		e.preventDefault();
		
		
		var state = $(this).text();
		
		if (state.indexOf("Expand") != -1){
			var wheel = "<li><img src='<?php echo $ste_root; ?>/images/progress.gif'></li>";
			$('#categorytree').html(wheel);
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: '<?php echo $ste_root; ?>/manage/catalog/products/ajax_get_item_tree_snippet_expanded_cat_list.php',
			  success: function(data) {
					$('#categorytree').html(data);
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
<script type="text/javascript" src="<?php $ste_root;?>/js/categorytree.js"></script>
		
<label>Search for and Select Categories. The searchbox will display the selected categories.</label>
<select style="width: 90%;" multiple="multiple" class="selectedCats chosen" 
data-placeholder='Search and Select Categories' name="chosen_categories[]">

</select>

<ul id="categorytree" role="tree" class="tree selectcattree">
<?php
$j = 0;
$block = '';
foreach ($top_cats as $top_cat) {
	$j++;
	$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
	$block .= "<a tabindex='-1' class='tree-parent tree-parent-collapsed' ";   
	$block .= "data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>";
	$block .= "<img src='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/tiny/".$top_cat['file_name']."' />".$top_cat['name'].'';
	$checked = inArray($top_cat['cat_id'], $_SESSION['temp_item_cats'], 'cat_id') ? "checked='checked'" : '';
	$block .= "<input class='checkbox' onclick='updateOptions(".$top_cat['cat_id'].")' ";
	$block .= " type='checkbox' id='".$top_cat['cat_id']."' value='".$top_cat['cat_id']."' ".$checked." />";
	$block .= "<input type='hidden' value='".$top_cat['name']."' name='categoryname' class='categoryname' /></a>";
	$block .= "<ul role='group' class='childrenplaceholder'></ul></li>"; 
				
}
echo $block;
?>
</ul>
