<script type="text/javascript">
$(document).ready(function(){
	$("tbody tr.hoverable").hover(function(){
		$(this).css("background-color", "#F9FBFC");
	}, function(){
		$(this).css("background-color", "transparent");
	});
	$(".show-children").click(function(e){
		e.preventDefault();
		$(this).closest("tr").next("tr").find("td.childcats table").first().toggle();
		var icon = $(this).html();
		if (icon == '<i class="icon-chevron-right"></i>'){
			$(this).html('<i class="icon-chevron-down"></i>');
		}else {
			$(this).html('<i class="icon-chevron-right"></i>');	
		}
	});
	$(".expand-all").click(function(e){
		e.preventDefault();
		var state = $(this).text();
		if (state.indexOf("Expand") != -1){
			$("td.childcats table").show("fast");
			$(".show-children").html('<i class="icon-chevron-down"></i>');
			$(this).text("Collapse All Categories");
		}
		else {
			$("td.childcats table").hide("fast");
			$(".show-children").html('<i class="icon-chevron-right"></i>');
			$(this).text("Expand All Categories");
		}
	});
	var selectedCategories = $(".data_table .tree_table input[type='checkbox']");
	var selectedListCats = $("select.selectedCats");
	$(selectedListCats).change(function(e){
		var selectedCats = $("select.selectedCats option:selected");
		var selectedCatsArr = [];
		var n = 0;
		$(selectedCats).each(function(){
			selectedCatsArr[n] = $(this).attr("id");
			n++;
		});
		$(selectedCategories).each(function() {
			//console.log($.inArray($(this).val(),selectedCatsArr));
			if($.inArray($(this).val(),selectedCatsArr) == -1){
				$(this).prop("checked",false);
			}
			else {
				$(this).prop("checked",true);
			}
		});
	});
	$(selectedCategories).click(updateList);
	function updateList(){
		var $optarr = $("select.selectedCats");
		$optarr.find("option.placeholder_option").remove();
		$(selectedCategories).each(function() {
			var currentId = $(this).val();
			var option = "<option id='"+currentId+"'>"+$(this).next(".categoryname").val()+" "+currentId+"</option>";
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
	updateList();
});
</script>
				<label>Search for and Select Categories using either the category tree or the search box. As select and deselect categories from the tree or the search box, the searchbox will display the selected categories.</label>
				<select style="width: 90%;" multiple="multiple" class="selectedCats chosen" data-placeholder='Search and Select Categories' name="chosen_categories">
				<option class="placeholder_option">Placeholder</option>
				</select>
				

			<div class="data_table">
				<a class="btn btn-large btn-primary expand-all">Expand All Categories</a>
				<br /><br />
				<table cellpadding="0" cellspacing="0" class="tree_table">
					<thead>
						<tr>
							<th width="7%">+/-</th>
							<th width="7%">Image</th>
							<th width="30%">Category Name</th>
							<th width="26%">Relationship</th>
							<th width="20%">Select</th>
						</tr>
					</thead>
					<tbody>
					<?php
						// Build an array of the top categories from DB
						$top_cats = array();
						$sql = "SELECT cat_id, name, img_id, show_on_home_page 
								FROM category 
								WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
								ORDER BY cat_id";
				$result = $dbCustom->getResult($db,$sql);								
						$i = 0;
						while($row = $result->fetch_object()) {
							$sql = "SELECT child_cat_to_parent_cat_id 
									FROM child_cat_to_parent_cat
									WHERE child_cat_to_parent_cat.child_cat_id = '".$row->cat_id."'";
							$tgc_res = mysql_query($sql);
							if(!$tgc_res)die(mysql_error());
							if(!mysql_num_rows($tgc_res) > 0){
								$top_cats[$i]['cat_id'] = $row->cat_id;
								$top_cats[$i]['name'] = $row->name;
								$top_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
								$sql = "SELECT file_name 
										FROM image
										WHERE img_id = '".$row->img_id."'";
								$img_res = $dbCustom->getResult($db,$sql);
								$img_obj = $img_res->fetch_object();
								$top_cats[$i]['file_name'] = $img_obj->file_name;
								$top_cats[$i]["checked"] = '';							
								if($row->cat_id == $cat_id) $top_cats[$i]["checked"] = "checked='checked'";
								$i++;
							}
		
						}
					
						$j = 0;
					   //setRedirection($catId);
						$block = '';
						foreach ($top_cats as $top_cat) {
							$j =  $j +1;
							$catId = $top_cat['cat_id'];
							$block .= "<tr class='hoverable'>"; 
							$block .= "<td><a href='#' class='show-children btn btn-tiny'><i class='icon-chevron-right'></i></a>";
							//category image
							$block .= "<td valign='middle'><a class='fancybox' href='".$ste_root."/ul_cart/".$domain."/tmp/pre-crop/".$top_cat['file_name']."'><img  src='".$ste_root."/ul_cart/".$domain."/cart/list/".$top_cat['file_name']."'></a></td>";
							//category name
							$block .= "<td valign='middle'>".$top_cat['name']."</td>";
							//relationship
							$block .= "<td valign='middle'>Parent Category</td>";
							//select
							$block .= "<td valign='middle'><input type='checkbox' value='".$top_cat['cat_id']."' ".$top_cat["checked"]." /><input type='hidden' value='".$top_cat['name']."' name='categoryname' class='categoryname' /></td>";
							$block .= "</tr>";
							$parent_cat_id = $top_cat['cat_id'];
							if($parent_cat_id > 0){
							$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page  
									FROM category, child_cat_to_parent_cat  
									WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
									AND child_cat_to_parent_cat.parent_cat_id = '".$parent_cat_id."'";
						$result = $dbCustom->getResult($db,$sql);									
								
								$sub_cats = array();
				
								$i = 0;
								while($row = $result->fetch_object()) {
									$sub_cats[$i]['cat_id'] = $row->cat_id;
									$sub_cats[$i]['name'] = $row->name;
									$sub_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
										
									$sql = "SELECT file_name 
													FROM image
													WHERE img_id = '".$row->img_id."'";
									$img_res = $dbCustom->getResult($db,$sql);
									$img_obj = $img_res->fetch_object();
									$sub_cats[$i]['file_name'] = $img_obj->file_name;
									$sub_cats[$i]["checked"] = '';							
									if($row->cat_id == $cat_id) $sub_cats[$i]["checked"] = "checked='checked'";

									$i++;
								}
								$block .= "<tr><td class='childcats' colspan='6'><table width='100%' cellpadding='10' cellspacing='0'>";	
								foreach ($sub_cats as $subcat) {
									$sibling_cat_id = $subcat['cat_id'];
									if($sibling_cat_id > 0){
									$sql = "SELECT category.cat_id, category.name, category.img_id, show_on_home_page  
											FROM category, child_cat_to_parent_cat  
											WHERE category.cat_id = child_cat_to_parent_cat.child_cat_id
											AND child_cat_to_parent_cat.parent_cat_id = '".$sibling_cat_id."'";
								$result = $dbCustom->getResult($db,$sql);											
										
										$more_sub_cats = array();
						
										$i = 0;
										while($row = $result->fetch_object()) {
											$more_sub_cats[$i]['cat_id'] = $row->cat_id;
											$more_sub_cats[$i]['name'] = $row->name;
											$more_sub_cats[$i]['show_on_home_page'] = $row->show_on_home_page;
												
											$sql = "SELECT file_name 
															FROM image
															WHERE img_id = '".$row->img_id."'";
											$img_res = $dbCustom->getResult($db,$sql);
											$img_obj = $img_res->fetch_object();
											$more_sub_cats[$i]['file_name'] = $img_obj->file_name;
									
											
											$more_sub_cats[$i]["checked"] = '';							
											if($row->cat_id == $sibling_cat_id) $more_sub_cats[$i]["checked"] = "checked='checked'";
											$i++;

										}
									}

									$block .= "<tr class='hoverable'>";
									//subcategory image
									$block .= "<td width='14%' align='right'>";
									if (sizeof($more_sub_cats) > 0){
											$block .= "<a href='#' class='show-children btn btn-tiny'><i class='icon-chevron-right'></i></a>&nbsp;";
									}
									$block .= "<a class='fancybox' href='".$ste_root."/ul_cart/".$domain."/tmp/pre-crop/".$subcat['file_name']."'><img  src='".$ste_root."/ul_cart/".$domain."/cart/list/".$subcat['file_name']."'></a></td>";	
									//subcategory name
									$block .= "<td width='30%' class='indent'>".$subcat['name']."</td>";	
									//relationship
									$block .= "<td width='26%' class='indent'>Subcategory</td>";
									//select
									$block .= "<td width='20%' valign='middle'><input type='checkbox' value='".$subcat['cat_id']."' ".$subcat["checked"]." /><input type='hidden' value='".$subcat['name']."' name='categoryname' class='categoryname' /></td>";
								$block .= "</tr>";
									if($sibling_cat_id > 0 && sizeof($more_sub_cats) > 0){
									$block .= "<tr><td class='childcats' colspan='6'><table width='100%' cellpadding='10' cellspacing='0'>";	
									foreach ($more_sub_cats as $anothersubcat) {
										$block .= "<tr class='hoverable'>";
										//subcategory image
										$block .= "<td width='18%' align='right'><a class='fancybox' href='".$ste_root."/ul_cart/".$domain."/tmp/pre-crop/".$anothersubcat['file_name']."'><img  src='".$ste_root."/ul_cart/".$domain."/cart/list/".$anothersubcat['file_name']."'></a></td>";	
										//subcategory name
										$block .= "<td width='26%' class='indent'>".$anothersubcat['name']."</td>";	
										//relationship
										$block .= "<td width='26%' class='indent'>Subcategory</td>";
										//select
										$block .= "<td width='20%' valign='middle'><input type='checkbox' value='".$anothersubcat['cat_id']."' ".$anothersubcat["checked"]." name='parent_cat_ids[]' /><input type='hidden' value='".$anothersubcat['name']."' name='categoryname' class='categoryname' /></td>";
									$block .= "</tr>";	
									}
									$block .= "</table></td></tr>";	
								}
		
								}
								$block .= "</table></td></tr>";	
							}

						}
						echo $block;
						?>
					</tbody>
				</table>
