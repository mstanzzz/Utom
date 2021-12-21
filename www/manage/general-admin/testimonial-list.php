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

$page_title = "Testimonials";
$page_group = '';
$msg = '';
$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(!isset($_SESSION['temp_id'])) $_SESSION['temp_id'] = time();

if(isset($_POST["add_testimonial"])){

	$name = trim(addslashes($_POST['name'])); 
	$email = trim(addslashes($_POST['email'])); 
	$city_state = trim(addslashes($_POST['city_state'])); 
	$content = trim(addslashes($_POST['content'])); 
	$list_order = trim(addslashes($_POST['list_order'])); 
	$hide = (isset($_POST['hide']))? $_POST['hide'] : 1;
	$is_local = (isset($_POST['is_local']))? $_POST['is_local'] : 0;
	$rating = $_POST['rating'];
	$last_update = trim($_POST['last_update']);
	if($last_update == ''){ 
		$last_update = time();
	}else{		
		$wd = explode("/", $last_update);
		if(count($wd) == 3 ) {
			$last_update = mktime(00, 00, 00, $wd[0], $wd[1], $wd[2]);
		}else{
			$last_update = time();
		}
	}
	$type = 'testimonial';
	$stmt = $db->prepare("INSERT INTO testimonial
						(name
						,email
						,city_state
						,content
						,type
						,rating
						,list_order						
						,hide
						,last_update
						,is_local
						,profile_account_id)
						VALUES
						(?,?,?,?,?,?,?,?,?,?,?)");	
						//print_r($stmt);
						//echo 'Error '.$db->error;						
	$stmt->bind_param('sssssiiiiii'
						,$name
						,$email
						,$city_state
						,$content
						,$type
						,$rating
						,$list_order
						,$hide
						,$last_update
						,$is_local
						,$_SESSION['profile_account_id']);
	$stmt->execute();
	$stmt->close();		
	$the_id = $db->insert_id;

	$sql = "SELECT file_name 
		FROM temp_upload 
		WHERE temp_id = '".$_SESSION['temp_id']."'
		AND profile_account_id = '".$_SESSION["profile_account_id"]."'";
	$img_res = $dbCustom->getResult($db,$sql);
	
	
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/user_uploads/")){
		if(!file_exists($_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id'])){			
			mkdir ($_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id'] , $mode = 0777 );
		}		
		while($row = $img_res->fetch_object()){
			$from_file = $_SERVER['DOCUMENT_ROOT']."/temp_uploads/".$_SESSION['temp_id']."/".$row->file_name;
			if(is_file($from_file)) {
				$file_name = str_replace (" ", "_", $row->file_name);
				$file_name = $_SESSION['temp_id']."_".$file_name;
				if(copy($from_file , $_SERVER['DOCUMENT_ROOT']."/user_uploads/".$_SESSION['profile_account_id']."/".$file_name)){
						
					$sql = "INSERT INTO testimonial_image 
						(file_name, testimonial_id, profile_account_id) 
						VALUES 
						('".$file_name."', '".$the_id."', '".$_SESSION['profile_account_id']."')";				
					$r = $dbCustom->getResult($db,$sql);
						
				}
			}
		}
	}	
		
	$sql = "DELETE FROM temp_upload WHERE temp_id = '".$_SESSION['temp_id']."'";
	$r = $dbCustom->getResult($db,$sql);

	$msg = 'success';
}


if(isset($_POST['edit_testimonial'])){

	$name = trim(addslashes($_POST['name'])); 
	$email = trim(addslashes($_POST["email"])); 
	$city_state = trim(addslashes($_POST["city_state"])); 
	$content = trim(addslashes($_POST["content"])); 
	$hide = (isset($_POST['hide']))? $_POST['hide'] : 1;
	$is_local = (isset($_POST['is_local']))? $_POST['is_local'] : 0;
	$rating = $_POST['rating'];
	$last_update = trim($_POST['last_update']);
	if($last_update == ''){ 
		$last_update = time();
	}else{		
		$wd = explode("/", $last_update);
		if(count($wd) == 3 ) {
			$last_update = mktime(00, 00, 00, $wd[0], $wd[1], $wd[2]);
		}else{
			$last_update = time();
		}
	}
	$testimonial_id = $_POST["testimonial_id"];
	$stmt = $db->prepare("UPDATE testimonial
						SET 
						name = ?
						,email = ?  
						,city_state = ?  
						,content = ?  
						,rating = ?  
						,hide = ?  
						,last_update = ?
						,is_local = ?
						WHERE testimonial_id = ?");
						//echo 'Error '.$db->error;	
						// d for double / decimal 
	if(!$stmt->bind_param('ssssiiiii'
						,$name
						,$email  
						,$city_state  
						,$content  
						,$rating  
						,$hide  
						,$last_update 
						,$is_local 
						,$testimonial_id)){
				//echo 'Error '.$db->error;
	}else{
		$stmt->execute();
		$stmt->close();
	}
	$active = (isset($_POST["active"])) ? $_POST["active"] : 0;  
	$sql = "UPDATE testimonial_image
			SET active = '0'
			WHERE testimonial_id = '".$testimonial_id."'";
	$result = $dbCustom->getResult($db,$sql);
	$sql = "UPDATE testimonial_image
			SET active = '1'
			WHERE testimonial_img_id = '".$active."'";
	$result = $dbCustom->getResult($db,$sql);
	$msg = "Your change is now live.";

}

if(isset($_POST["del_testimonial"])){
		$testimonial_id = $_POST["del_testimonial_id"];
		$sql = sprintf("DELETE FROM testimonial_image WHERE testimonial_id = '%u'", $testimonial_id);
		$result = $dbCustom->getResult($db,$sql);

		$sql = sprintf("DELETE FROM testimonial WHERE testimonial_id = '%u'", $testimonial_id);
		$result = $dbCustom->getResult($db,$sql);
}

if(isset($_POST['set_active_and_display_order'])){
	
	$content_array = isset($_POST['content'])?$_POST['content']:array();
$name_array = isset($_POST['name'])?$_POST['name']:array();
$city_state_array = isset($_POST['city_state'])?$_POST['city_state']:array();
	
	$testimonial_ids = isset($_POST['testimonial_id'])?$_POST['testimonial_id']:array();
	$list_orders = isset($_POST['list_order'])?$_POST['list_order']:array();
	$actives = (isset($_POST['active']))? $_POST['active'] : array();
	$is_local_array = (isset($_POST['is_local']))? $_POST['is_local'] : array();
	if(isset($_POST['t_from_this_page'])){
		$t_from_page_array = explode(',',$_POST['t_from_this_page']);
	}else{
		$t_from_page_array = array();
	}




	foreach($city_state_array as $k=>$c){
		//echo "k: ".$k;
		//echo "<br />";
		$t_id = $t_from_page_array[$k];
		//echo "t_id: ".$t_id; 
		//echo "<br />";	
		$c=addslashes($c);
		//echo "<hr />";
		$sql = "UPDATE testimonial 
				SET city_state = '".$c."' 
				WHERE testimonial_id = '".$t_id."'";
		$result = $dbCustom->getResult($db,$sql);				
	}




	foreach($name_array as $k=>$c){
		//echo "k: ".$k;
		//echo "<br />";
		$t_id = $t_from_page_array[$k];
		//echo "t_id: ".$t_id; 
		//echo "<br />";	
		$c=addslashes($c);
		//echo "<hr />";
		$sql = "UPDATE testimonial 
				SET name = '".$c."' 
				WHERE testimonial_id = '".$t_id."'";
		$result = $dbCustom->getResult($db,$sql);				
	}


	foreach($content_array as $k=>$c){
		//echo "k: ".$k;
		//echo "<br />";
		$t_id = $t_from_page_array[$k];
		//echo "t_id: ".$t_id; 
		//echo "<br />";	
		$c=addslashes($c);
		//echo "<hr />";
		$sql = "UPDATE testimonial 
				SET content = '".$c."' 
				WHERE testimonial_id = '".$t_id."'";
		$result = $dbCustom->getResult($db,$sql);				
	}
	foreach($t_from_page_array as $t_id){
		if(is_numeric($t_id)){
			$sql = "UPDATE testimonial 
					SET hide = '1', is_local = '0' 
					WHERE testimonial_id = '".$t_id."'";
			$result = $dbCustom->getResult($db,$sql);				
		}
	}
	foreach($is_local_array as $key => $value){
		$sql = "UPDATE testimonial SET is_local = '1' WHERE testimonial_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		echo "key: ".$key."   value: ".$value."<br />"; 
	}
	foreach($actives as $key => $value){
		$sql = "UPDATE testimonial SET hide = '0' WHERE testimonial_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
	}
	for($i = 0; $i < count($list_orders); $i++){
		$sql = sprintf("UPDATE testimonial 
				SET list_order = '%u'  
				WHERE testimonial_id = '%u'",
				$list_orders[$i], $testimonial_ids[$i]);
		$result = $dbCustom->getResult($db,$sql);
	}
	$msg = "Changes Saved.";
}

if(isset($_SESSION['temp_id'])){
	unset($_SESSION['temp_id']);
}
require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
<script src="https://cdn.tiny.cloud/1/iyk23xxriyqcd2gt44r230a2yjinya99cx1kd3tk9huatz50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
	selector: 'textarea',
	plugins: 'advlist link image lists code',
	forced_root_block : false

});
</script>
<script>
$(document).ready(function() {

	$("#datepicker1").datepicker();
	$("#datepicker2").datepicker();
	
});
function regularSubmit() {
  document.form.submit(); 
}	

</script>
</head>
<body>
<?php
require_once($real_root.'/manage/admin-includes/manage-header.php');
require_once($real_root.'/manage/admin-includes/manage-top-nav.php');

if(isset($_GET['del_id'])){
	$testimonial_id = $_GET['del_id'];
	echo "testimonial_id:  |".$testimonial_id."|";
	if(is_numeric($testimonial_id)){
		$sql = "DELETE FROM testimonial WHERE testimonial_id = '".$testimonial_id."'";
		$result = $dbCustom->getResult($db,$sql);							
	}
}
?>

<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
		$sql = "DELETE FROM testimonial
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				AND testimonial_id > '4000'
				AND testimonial_id < '5000'";
		//$result = $dbCustom->getResult($db,$sql);

		$sql = "UPDATE testimonial 
				SET is_local = '0' 
				AND profile_account_id = '".$_SESSION['profile_account_id']."'";
		//$result = $dbCustom->getResult($db,$sql);							
		
		/*  
		$sql = "SELECT testimonial_id, name, city_state, rating, type
		FROM testimonial
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY testimonial_id";
		$result = $dbCustom->getResult($db,$sql);
		while($row=$result->fetch_object()){
			echo "<table border='1' cellpadding='10'>";
			echo "<tr>";
			echo "<td>".$row->testimonial_id."</td>";
			echo "<td style='width:300px;'>".$row->name."</td>";
			echo "<td style='width:300px;'>".$row->city_state."</td>";
			echo "<td style='width:300px;'>".$row->type."</td>";
			echo "<td><a style='color:red;' href='testimonial-list.php?del_id=".$row->testimonial_id."'>";
			echo "DELETE</a>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
		}
		exit;
		*/

        //require_once($real_root.'/manage/admin-includes/manage-content-testimonial.php');
		$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
		$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;
		$search_str = isset($_REQUEST['search_str']) ? trim(addslashes($_REQUEST['search_str'])) : '';
		if(isset($_REQUEST['date_from'])){
			$date_from = strpos($_REQUEST['date_from'], '/') ? strtotime(trim($_REQUEST['date_from'])) : '';
		}else{
			$date_from = ''; 
		}
		if(isset($_REQUEST['date_to'])){
			$date_to = strpos($_REQUEST['date_to'], '/') ? strtotime(trim($_REQUEST['date_to'])) : '';
		}else{
			$date_to = ''; 
		}

		$sql = "SELECT * FROM testimonial 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
				AND type != 'feedback'"; 
		$result = $dbCustom->getResult($db,$sql);							
		if($search_str != ''){
			$sql .= " AND name like '%".$search_str."%'
			OR city_state like '%".$search_str."%' 
			OR email like '%".$search_str."%'" ;
		}
		if($date_from != ''){		
			$sql .= " AND last_update >= '".$date_from."'";
		}
		if($date_to != ''){		
			$sql .= " AND last_update <= '".$date_to."'";
		}
		
		$nmx_res = $dbCustom->getResult($db,$sql);
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 100;
		$last = ceil($total_rows/$rows_per_page); 
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;
		if($sortby != ''){
			if($sortby == 'name'){
				if($a_d == 'd'){
					$sql .= " ORDER BY name DESC".$limit;
				}else{
					$sql .= " ORDER BY name".$limit;		
				}
			}
			if($sortby == 'city_state'){
				if($a_d == 'd'){
					$sql .= " ORDER BY city_state DESC".$limit;
				}else{
					$sql .= " ORDER BY city_state".$limit;		
				}
			}
			if($sortby == 'last_update'){
				if($a_d == 'd'){
					$sql .= " ORDER BY last_update DESC".$limit;
				}else{
					$sql .= " ORDER BY last_update".$limit;		
				}
			}
			if($sortby == 'is_local'){
				if($a_d == 'd'){
					$sql .= " ORDER BY is_local DESC".$limit;
				}else{
					$sql .= " ORDER BY is_local".$limit;		
				}
			}
			if($sortby == 'testimonial_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY testimonial_id DESC".$limit;
				}else{
					$sql .= " ORDER BY testimonial_id".$limit;		
				}
			}
			if($sortby == 'hide'){
				if($a_d == 'd'){
					$sql .= " ORDER BY hide DESC".$limit;
				}else{
					$sql .= " ORDER BY hide".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY list_order".$limit;
		}
		$result = $dbCustom->getResult($db,$sql);		
				
		?>
		<div class="page_actions">            
		<?php
		$url_str = "testimonial-list.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		$url_str .= "&date_from=".$date_from;
		$url_str .= "&date_to=".$date_to;
		?>
        <table width="100%">
			<form name="search_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
            <tr>
            <td width="20%">
            <label>Enter name, email address,<br /> city, or customer ID</label>
			<input type="text" name="search_str" class="searchbox" placeholder="Search Requests" />
            </td>
            <td width="10%">
                    <div style="padding-top:17px;">
                	<label>Date From</label>
					<input id="datepicker1" type="text" name="date_from" value="none" style='width:80px;'/>
                    </div>
            </td>
            <td width="10%">
                    <div style="padding-top:17px;">
					<label>Date To</label>
					<input id="datepicker2" type="text" name="date_to" value="today" style='width:100px;'/>
                    </div>
			</td>
            <td>
			<div style="padding-top:47px;">
			<button type="submit" class="btn btn-primary btn-large" value="search"><i class="icon-search icon-white"></i></button>
			</div>
            </td>
			<td align="right" valign="bottom">
					<?php
                        $url_str = "add-testimonial.php";
                        $url_str .= "?pagenum=".$pagenum;
                        $url_str .= "&sortby=".$sortby;
                        $url_str .= "&a_d=".$a_d;
                        $url_str .= "&truncate=".$truncate;
						$url_str .= "&date_from=".$date_from;
						$url_str .= "&date_to=".$date_to;
    	            ?>
        			<a href="<?php echo $url_str; ?>" class="btn btn-primary btn-small fancybox fancybox.iframe" >
                    <i class="icon-plus icon-white"></i> Add a New Testimonial </a>
			</td>
            
			</form>
			</tr>		
            </table>
			<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
			</div>
            <div class="clear"></div>
				<?php 
				if($total_rows > $rows_per_page){	
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "testimonial-list.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);
					echo "<br /><br /><br />";
				}
				$url_str = "testimonial-list.php";
				$url_str .= "?pagenum=".$pagenum;
				$url_str .= "&sortby=".$sortby;
				$url_str .= "&a_d=".$a_d;
				$url_str .= "&truncate=".$truncate;
				$url_str .= "&search_str=".$search_str;
				?>	
			<div class="data_table">
            	<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="set_active_and_display_order" value="1">
<table cellpadding="10" cellspacing="0">
<thead>
<tr>
<th>
<a href="testimonial-list.php?sortby=testimonial_id&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
<br />
ID
<br />
<a href="testimonial-list.php?sortby=testimonial_id&a_d=d">	
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th>
<a href="testimonial-list.php?sortby=name&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
<br />
NAME
<br />
<a href="testimonial-list.php?sortby=name&a_d=d">	
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th>
<a href="testimonial-list.php?sortby=city_state&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
<br />
City/State
<br />
<a href="testimonial-list.php?sortby=city_state&a_d=d">
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th width="20%">
<a href="testimonial-list.php?sortby=last_update&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
<br />
Date Submitted
<br />
<a href="testimonial-list.php?sortby=last_update&a_d=d">
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th width="10%">
<a href="testimonial-list.php?sortby=is_local&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
<br />
Is Local
<br />
<a href="testimonial-list.php?sortby=is_local&a_d=d">
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th width="10%">
<a href="testimonial-list.php?sortby=hide&a_d=a"><span style='font-size:30px;'>&uarr;</span></a>
Active
<a href="testimonial-list.php?sortby=hide&a_d=d">
<span style='font-size:30px;'>&darr;</span>
</a>
</th>
<th width="5%">Edit</th>
<th width="5%">Del</th>
</tr>
</thead>
                    
<?php
$t_from_this_page = '';
$block = ''; 
$disabled = ($admin_access->customers_level < 2)? "disabled" : '';
$disabled = '';
while($row = $result->fetch_object()) {
	$t_from_this_page .= $row->testimonial_id.",";
	$date_str=($row->last_update > 0)?date("F j, Y", $row->last_update):'';
	$block .= "<tr>"; 				
	$block .= "<td>".$row->testimonial_id."</td>";			
	$block .= "<td><input type='text' name='name[]' value='".$row->name."' /></td>";			
	$block .= "<td><input type='text' name='city_state[]' value='".$row->city_state."' /></td>";										
	$block .= "<td>".$date_str."</td>";
	//Local (on/off)
	$checked = ($row->is_local == 1)? "checked='checked'" : ''; 
	$block	.= "<td>
	<div class='checkboxtoggle on ".$disabled." '> 
	<span class='ontext'>Yes</span>
	<a class='switch on' href='#'></a>
	<span class='offtext'>No</span>
	<input type='checkbox' class='checkboxinput' name='is_local[]' value='".$row->testimonial_id."' ".$checked." /></div>";
	$block	.= "</td>";
						
	$checked = ($row->hide == 0)? "checked='checked'" : ''; 
	$block	.= "<td align='center' valign='middle' >
	<div class='checkboxtoggle on ".$disabled." '> 
	<span class='ontext'>ON</span>
	<a class='switch on' href='#'></a>
	<span class='offtext'>OFF</span>
	<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->testimonial_id."' ".$checked." /></div>";
	$block	.= "</td>";
	$block	.= "<input type='hidden' name='list_order[]' value='".$row->list_order."'/>";
	$block	.= "<input type='hidden' name='testimonial_id[]' value='".$row->testimonial_id."' />";
						
	$url_str = "edit-testimonial.php";
	$url_str .= "?testimonial_id=".$row->testimonial_id;
	$url_str .= "&pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;
	$url_str .= "&search_str=".$search_str;
						
	$block .= "<td style='background-color:grey;'>";
	$block .= "<a style='background-color:pink;'"; 
	$block .= "class='fancybox fancybox.iframe'"; 
	$block .= "href='".$url_str."'> Edit </a>";
	$block .= "</td>";

	$block .= "<td style='background-color:red; color:white;'>
	<a class='btn btn-danger confirm ".$disabled."'>del
	<input type='hidden' id='".$row->testimonial_id."' 
	class='itemId'
	value='".$row->testimonial_id."' /></a></td>";
	$block .= "</tr>";
	$block .= "<td colspan='8'>";
	$block .= "<textarea  name='content[]' rows='10' cols='120'>";
	$block .= stripcslashes($row->content);
	$block .= "</textarea>";
	$block .= "<p style='height:30px; width='100%'></p>";
	$block .= "</td>";
	
	$block .= "</tr>";

}
echo $block;
?>
</table>

<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
<?php 

//echo "rows_per_page:  ".$rows_per_page;
//echo "<br />";
//echo "total_rows:  ".$total_rows;
//echo "<br />";

if($total_rows > $rows_per_page){
echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "testimonial-list.php", $sortby, $a_d, 0, 0,  $search_str,0,0,$strip);					
}
?>	                
</div>
<input type="hidden" name="t_from_this_page" value="<?php echo $t_from_this_page; ?>"> 
</form>
</div>
<p class="clear"></p>
<?php 
require_once($real_root.'/manage/admin-includes/manage-footer.php');
	$url_str = "testimonial-list.php";
$url_str .= "?pagenum=".$pagenum;
$url_str .= "&sortby=".$sortby;
$url_str .= "&a_d=".$a_d;
$url_str .= "&truncate=".$truncate;
$url_str .= "&search_str=".$search_str;
?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this email?</h3>
	<form name="del_testimonial" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_testimonial_id" class="itemId" type="hidden" name="del_testimonial_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_testimonial" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>





