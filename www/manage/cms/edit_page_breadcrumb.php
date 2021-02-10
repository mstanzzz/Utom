<?php
if(!isset($page_heading)) $page_heading = '';

if(!isset($_SESSION['page_bc_array'])) $_SESSION['page_bc_array'] = array(); 
if(!isset($_SESSION['bc_page_title'])) $_SESSION['bc_page_title'] = $page_heading; 
?>

<script>
function test(ccc){
	//alert(ccc);
	alert("ttt");
}

function update_bc_page_title(){

	var new_title = $("#bc_page_title").val();

	var q_str = "?action=change_title&new_bc_page_title="+new_title;
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		$("#display").html(data);
	  }
	});


}

function update_label(page_seo_id){

	var new_text = $("#breadcrumb_label_"+page_seo_id).val();

	var q_str = "?action=change_label&new_text="+new_text+"&page_seo_id="+page_seo_id;
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		$("#display").html(data);
	  }
	});


}


function update_seo_id(page_seo_id){
	
	//alert(page_seo_id);

	var new_page_seo_id = $("#page_seo_id_"+page_seo_id).val();

	//alert(new_page_seo_id);

	var q_str = "?action=change_seo_id&new_page_seo_id="+new_page_seo_id+"&page_seo_id="+page_seo_id;
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;

	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		$("#display").html(data);
	  }
	});

	
}

function reorder_bc(page_seo_id){

	var new_display_order = $("#breadcrumb_order_"+page_seo_id).val();
	
	var q_str = "?action=reorder&page_seo_id="+page_seo_id+"&new_display_order="+new_display_order;
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		$("#display").html(data);
	  }
	});

}


function remove_bc(page_seo_id){
	
	//alert(page_seo_id);
	var q_str = "?action=remove&page_seo_id="+page_seo_id;
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		$("#display").html(data);
	  }
	});
	
}

function set_display(){

	var q_str = "?action=display";
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		//alert(data);
		$("#display").html(data);
	  }
	});
	
}

function add_breadcrumb(){
	
	var q_str = '';
	 	q_str += "?new_breadcrumb_label="+$("#new_breadcrumb_label").val();
		q_str += "&new_page_seo_id="+$("#new_page_seo_id").val();
		q_str += "&new_breadcrumb_order="+$("#new_breadcrumb_order").val();
		q_str += "&action=add";
		
	var t_url = "<?php echo $ste_root; ?>/manage/cms/ajax_set_breadcrumb_session.php"+q_str;
		
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: t_url,
	  success: function(data) {
		//alert(data);
		$("#display").html(data);
	  }
	});
}

$(document).ready(function() {
	set_display();
});

</script>
<?php


if(!isset($page)) $page = '';


//echo "page".$page;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT * FROM bread_crumb 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		AND page = '".$page."'
		ORDER BY display_order"; 
$result = $dbCustom->getResult($db,$sql);



//echo $result->num_rows;

$i = 0;

while($row = $result->fetch_object()){
	$_SESSION['page_bc_array'][$i]['text'] = $row->text;
	$_SESSION['page_bc_array'][$i]['page_seo_id'] = $row->page_seo_id;
	$_SESSION['page_bc_array'][$i]['display_order'] = $row->display_order;
	$i++;
}

//print_r($_SESSION['page_bc_array']);

if($i > 0){
	$last_index = $i-1;
	$_SESSION['bc_page_title'] = $_SESSION['page_bc_array'][$last_index]['text'];
	array_pop($_SESSION['page_bc_array']);
}

?>

<fieldset class="edit_breadcrumbs">
	<legend>Edit Breadcrumbs <i class="icon-minus-sign icon-white"></i></legend>
	<div class="colcontainer">
		<label>Current Page Breadcrumbs:</label>
		<div id='display'></div>
	</div>
</fieldset>

<div style="height:200px;"></div>
