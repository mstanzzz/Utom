<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Blog";
$page_group = "blog";


	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

if(isset($_POST["set_active_and_featured"])){
	
	$actives = (isset($_POST["actives"]))? $_POST["actives"] : array();
	
	$featured = (isset($_POST["featured"]))? $_POST["featured"] : 0;
	
	$blog_post_ids = $_POST["blog_post_id"];

	$display_orders = $_POST["display_order"];


	$sql = "UPDATE blog_post
			SET is_feature = '0'
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
	

	$sql = "UPDATE blog_post
			SET is_feature = '1' 
			WHERE blog_post_id = '".$featured."'";
	$result = $dbCustom->getResult($db,$sql);
	
	
	$sql = "UPDATE blog_post SET hide = '1' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	$result = $dbCustom->getResult($db,$sql);
		
	foreach($actives as $key => $value){
		$sql = "UPDATE blog_post SET hide = '0' WHERE blog_post_id = '".$value."'";
		$result = $dbCustom->getResult($db,$sql);
		
		//echo "key: ".$key."   value: ".$value."<br />"; 
	}

	if(is_array($display_orders)){
		for($i = 0; $i < count($display_orders); $i++){
			$sql = sprintf("UPDATE blog_post 
				SET display_order = '%u'  
				WHERE blog_post_id = '%u'",
				$display_orders[$i], $blog_post_ids[$i]);

			$result = $dbCustom->getResult($db,$sql);
			
		}
	}





	$msg = "Changes Saved.";

}

if(isset($_POST["add_blog"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$title = trim(addslashes($_POST['title']));
	$substitute_by = trim(addslashes($_POST["substitute_by"]));
	$blog_cat_id = trim($_POST["blog_cat_id"]);
	$user_id = trim($_POST["user_id"]);
	$type = trim($_POST["type"]);
	$img_id = $_POST['img_id'];
	

	$sql = sprintf("INSERT INTO blog_post (when_posted, blog_cat_id, user_id, substitute_by, title, content, type, img_id, profile_account_id) 
					VALUES ('%u','%u','%u','%s','%s','%s','%s','%u','%u')", 
					time(), $blog_cat_id, $user_id, $substitute_by, $title ,$content ,$type, $img_id, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	



}

if(isset($_POST["edit_blog"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$title = trim(addslashes($_POST['title']));
	$substitute_by = trim(addslashes($_POST["substitute_by"]));
	$user_id = trim($_POST["user_id"]);
	//$hide = $_POST["hide"];
	$blog_cat_id = trim($_POST["blog_cat_id"]);
	$blog_post_id = $_POST["blog_post_id"];
	$type = trim($_POST["type"]);

	$sql = sprintf("UPDATE blog_post 
					SET user_id = '%u', blog_cat_id = '%u', substitute_by = '%s', title = '%s', content = '%s',  type = '%s'
					WHERE blog_post_id = '%u'", 
					$user_id, $blog_cat_id, $substitute_by, $title, $content, $type, $blog_post_id);
		
	$result = $dbCustom->getResult($db,$sql);
	
	
}

if(isset($_POST["del_blog_post_id"])){

	$blog_post_id = $_POST["del_blog_post_id"];

	$sql = "SELECT blog_post.img_id, image.file_name 
			FROM blog_post, image 
			WHERE blog_post.img_id = image.img_id 
			AND blog_post_id = '".$blog_post_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	if($result->num_rows > 0){
		$img_obj = $result->fetch_object();
		$sql = "DELETE FROM image WHERE img_id = '".$img_obj->img_id."'";
		$result = $dbCustom->getResult($db,$sql);
		
		
		$myFile = $_SERVER['DOCUMENT_ROOT']."/ul_cms/".$domain."/".$img_obj->file_name;
		if(file_exists($myFile)) unlink($myFile);
	}

	$sql = sprintf("DELETE FROM blog_post WHERE blog_post_id = '%u'", $blog_post_id);
	$result = $dbCustom->getResult($db,$sql);
	

}

unset($_SESSION["temp_blog_fields"]);

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script>
function regularSubmit() {
  document.form.submit(); 
}	
</script>
</head>
<body>
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
    <div class="manage_side_nav">
        <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
    </div>	
    <div class="manage_main">
		<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("Blog", '');
        echo $bread_crumb->output();

        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//blog section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/blog-section-tabs.php");

		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * FROM blog_post WHERE profile_account_id = '".$_SESSION['profile_account_id']."' ORDER BY when_posted";

		$nmx_res = $dbCustom->getResult($db,$sql);
		
				
		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 8;
		$last = ceil($total_rows/$rows_per_page); 
							
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}elseif ($pagenum > $last){ 
			$pagenum = $last; 
		} 
							
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;

		$sql = "SELECT * FROM blog_post 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
				
		if($sortby != ''){
			if($sortby == 'title'){
				if($a_d == 'd'){
					$sql .= " ORDER BY title DESC".$limit;
				}else{
					$sql .= " ORDER BY title".$limit;		
				}
			}
			if($sortby == 'blog_cat_id'){
				if($a_d == 'd'){
					$sql .= " ORDER BY blog_cat_id DESC".$limit;
				}else{
					$sql .= " ORDER BY blog_cat_id".$limit;		
				}
			}
			if($sortby == 'when_posted'){
				if($a_d == 'd'){
					$sql .= " ORDER BY when_posted DESC".$limit;
				}else{
					$sql .= " ORDER BY when_posted".$limit;		
				}
			}
		}else{
			$sql .= " ORDER BY when_posted".$limit;					
		}
			

	$result = $dbCustom->getResult($db,$sql);		

		?>

		<form name="form" action='blog.php' method='post' enctype="multipart/form-data">       
        	<input type="hidden" name="set_active_and_featured" value="1">

			<div class="page_actions">
				<?php if($admin_access->cms_level > 1){ ?>
                    <a class="btn btn-large btn-primary" href="add-blog.php?ret_page=blog"><i class="icon-plus icon-white"></i> Add a New Blog Post </a>
                    <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
				<?php 
				}
				?>
			</div>
			<div class="data_table">
				<?php
				if($total_rows > $rows_per_page){
					echo getPagination($total_rows, $rows_per_page, $pagenum, 1 ,$last, "cms/blog/blog.php", $sortby, $a_d); 
					
					
					
					echo "<br /><br /><br /><br />";
				}
				?>

				<?php
                    require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php");
                ?>                
                <table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
        					<th <?php addSortAttr('title',true); ?>>
                            Title
                            <i <?php addSortAttr('title',false); ?>></i>
                            </th>
        					<th <?php addSortAttr('blog_cat_id',true); ?>>
                            Category
                            <i <?php addSortAttr('blog_cat_id',false); ?>></i>
                            </th>
        					<th <?php addSortAttr('when_posted',true); ?>>
                            Date
                            <i <?php addSortAttr('when_posted',false); ?>></i>
                            </th>
							<th>Featured</th>
							<th>Active</th>
                            <th>Order</th>
							<th width="12%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					    <?php
							while($row = $result->fetch_object()) {
								$block = "<tr>"; 				
								//Post Title
								$block .= "<td valign='top'>".stripslashes($row->title)."</td>";
								//Category
								$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
								$sql = "SELECT name FROM blog_category WHERE blog_cat_id = '".$row->blog_cat_id."'";
								$cat_res = $dbCustom->getResult($db,$sql);
								$object = $cat_res->fetch_object();
								$block .= "<td valign='top'>$object->name</td>";
								//Date
								$block .= "<td valign='top'>".date("m/d/Y", $row->when_posted)."</td>";
								
								
								$disabled = ($admin_access->cms_level < 2)? "disabled" : '';
								
								//Featured
								$checked = ($row->is_feature)? "checked='checked'" : '';
								$block .= "<td>
								<div class='radiotoggle on ".$disabled." '> 
								<span class='ontext'>ON</span>
								<a class='switch on' href='#'></a>
								<span class='offtext'>OFF</span>
								<input type='radio' class='radioinput' name='featured'  value='".$row->blog_post_id."' $checked />
								</div>        
								</td>";

								//Active
								$checked = (!$row->hide)? "checked='checked'" : '';								
								$block .= "<td valign='top'>
								<div class='checkboxtoggle on ".$disabled." '> 
								<span class='ontext'>ON</span>
								<a class='switch on' href='#'></a>
								<span class='offtext'>OFF</span>
								<input type='checkbox' class='checkboxinput' name='actives[]' value='".$row->blog_post_id."' $checked /></div></td>";
															
								//display order
								$block .= "<td valign='top' align='center' >
								<input type='text' name='display_order[]' value='".$row->display_order."'/>
								<input type='hidden' name='blog_post_id[]' value='".$row->blog_post_id."' /></td>";
										
								//Edit
								$block .= "<td valign='middle'><a class='btn btn-primary' href='edit-blog.php?blog_post_id=".$row->blog_post_id."&ret_page=blog'><i class='icon-cog icon-white'></i> Edit</a></td>";
								//Delete
								$block .= "<td valign='middle'>
								<a class='btn btn-danger confirm ".$disabled." '>
								<i class='icon-remove icon-white'></i>
								<input type='hidden' id='".$row->blog_post_id."' class='itemId' value='".$row->blog_post_id."' /></a></td>";
								echo $block;
							}
						?>
				</table>
			</div>
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Changes </a>
</div>
<p class="clear"></p>
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
?>
</div>
<!-- New Delete Confirmation Dialogue -->
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this post?</h3>
	<form name="del_blog_post_form" action="blog.php" method="post" target="_top">
		<input id="del_blog_post_id" class="itemId" type="hidden" name="del_blog_post_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_blog_post" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>


