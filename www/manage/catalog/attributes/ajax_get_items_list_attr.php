<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');
$search_str = (isset($_REQUEST['search_str'])) ?  trim(addslashes($_REQUEST['search_str'])) : '';

$cat_id = (isset($_GET['cat_id'])) ? $_GET['cat_id'] : 0;
$search_str = (isset($_GET['search_str'])) ? $_GET['search_str'] : '';

$db = $dbCustom->getDbConnect(CART_DATABASE);

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
	
}else{
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



		
		$sql .= " ORDER BY item.name";
		
		$result = $dbCustom->getResult($db,$sql);

	//echo "cat_id:  ".$cat_id;

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
				$block .= "<a href='#' class='show-children btn btn-tiny'><i class='icon-chevron-right'></i></a>";
			
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

				$block .= "<tr class='hoverable child'>";
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





