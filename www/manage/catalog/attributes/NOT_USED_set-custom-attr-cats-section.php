

NOT USED


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


$db = $dbCustom->getDbConnect(CART_DATABASE);


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



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>


<script type="text/javascript" src="<?php echo $ste_root; ?>/js/categorytree.js"></script>





<script type="text/javascript" language="javascript">




/*

function show_children(cat_id){
	var wheel = "<li><img src='<?php echo $ste_root; ?>/images/progress.gif' style='width:25px;height:auto;'></li>";
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
	//bindclick();
}


function bindclick(){
	<?php foreach($top_cats as $top_cat) { ?>				
		$('#'+<?php echo $top_cat['cat_id']; ?>+' a').bind('click',show_children(<?php echo $top_cat['cat_id']; ?>));
	<?php } ?>
}

*/

function bindfocus(){
	
	$('.tree li a').focus(function(){
		
		var catid;
		var catname;
		var img;
		var editbtn;
		var template
		
		catid = $(this).attr("data-catid");
		
		catname = $(this).text();

		img = '<img src="'+$(this).attr("data-imageurl")+'" />';

		editbtn = "<a href='edit-cat-attributes.php?cat_id="+catid+"' class='btn btn-primary fancybox fancybox.iframe' > <i class='icon-cog icon-white'></i> Edit</a>";	
		
		template = '<a style="curser:pointer; float:right;" onClick="closeCatBox()">Close</a><br /><br />'+img+'<h4><br />'+catname+'</h4><div class="fltlft">'+editbtn+'</div>';
	
		$(".categoryoptions_attr").show();
		
		$(".categoryoptions_attr").empty();
		
		$(".categoryoptions_attr").html(template);

	});
	
}

function closeCatBox(){
	
	$(".categoryoptions_attr").hide();
}


$(document).ready(function(){

	$(".categoryoptions_attr").hide();

/*
	$('.fancybox').fancybox({
		autoSize : false,
		height : 800,
		width : 1060	
	});
*/		


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
	

});


</script>


</head>
<body>




			
			<div class="colcontainer categorytreecontainer">

                   <a class="btn btn-large btn-primary expand-all">Expand All</a>

				<div class="twocols">
					<ul id="categorytree" role="tree" class="tree">
						<?php
							$block = '';
							foreach ($top_cats as $top_cat) {
								
								
								$block .= "<li role='treeitem' aria-expanded='true' id='".$top_cat['cat_id']."'>"; 
								
								$block .= "<a tabindex='-1' class='tree-parent' onclick='show_children(".$top_cat['cat_id'].")'"; 
								
								$block .= "data-imageurl='".$ste_root."/saascustuploads/".$_SESSION['profile_account_id']."/cart/small/".$top_cat['file_name']."'"; 
								
								$block .= "data-catid='".$top_cat['cat_id']."' data-cattype='topcat'>".stripslashes($top_cat['name'])."</a>";
								
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
         




</head>
<body>
