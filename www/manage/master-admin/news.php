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

$progress = new SetupProgress;
$module = new Module;

$page_title = "Internal News";
$page_group = "news";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);



$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';


if(isset($_POST["add_news"])){

	$author = trim(addslashes($_POST["author"]));
	$content = trim(addslashes($_POST["content"])); 
	$title = trim(addslashes($_POST['title']));
	$type = trim($_POST["type"]);
	$ts = time();
	
	$sql = "SELECT count(news_id) AS num FROM news WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
		   $result = $dbCustom->getResult($db,$sql);		   $n_object = $result->fetch_object();
		   $list_order = $n_object->num + 1;

	$sql = sprintf("INSERT INTO news (author, title, content, list_order, type, last_update, profile_account_id) 
					VALUES ('%s','%s','%s','%u','%s','%u','%u')", $author, $title, $content, $list_order, $type, $ts, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	

}

if(isset($_POST["edit_news"])){
	
	$author = trim(addslashes($_POST["author"]));	
	$content = trim(addslashes($_POST["content"])); 
	$title = trim(addslashes($_POST['title']));
	$type = trim($_POST["type"]);
	$news_id = $_POST["news_id"];
	//$hide = $_POST["hide"];
	$ts = time();

	$sql = sprintf("UPDATE news 
					SET author = '%s', title = '%s', content = '%s', type = '%s', last_update = '%u' 
					WHERE news_id = '%u'
					AND profile_account_id  = '%u'", 
	$author, $title, $content, $type, $ts, $news_id, $_SESSION['profile_account_id']);
		
	$result = $dbCustom->getResult($db,$sql);
	
	
}

if(isset($_POST["del_news_id"])){

	$news_id = $_POST["del_news_id"];

//	$backup = new Backup;
//	$dbu = $backup->doBackup($news_id,$user_id,"news","delete");	

	$sql = sprintf("DELETE FROM news WHERE news_id = '%u'", $news_id);
	$result = $dbCustom->getResult($db,$sql);
	
}



if(isset($_POST["set_active_and_display_order"])){
	
	$list_orders = $_POST["list_order"];
	$news_ids  = $_POST["news_id"];
	$actives = (isset($_POST["active"]))? $_POST["active"] : array();

	$sql = "UPDATE news SET hide = '1' WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	

	if(is_array($actives)){	
		foreach($actives as $key => $value){
			$sql = "UPDATE news SET hide = '0' WHERE news_id = '".$value."'";
	$result = $dbCustom->getResult($db,$sql);			
				//echo "key: ".$key."   value: ".$value."<br />"; 
		}
	}

	
	//print_r($display_orders);
	//echo "<br />";
	//print_r($navbar_label_ids);
	//exit;
	
	if(is_array($list_orders)){

		for($i = 0; $i < count($list_orders); $i++){
			
			//echo "display_orders".$display_orders[$i];
			//echo "<br />";
			//echo "navbar_label_id".$navbar_label_ids[$i];
			//echo "-----------------------<br />";
			
			$sql = sprintf("UPDATE news 
				SET list_order = '%u' 
				WHERE news_id = '%u'",
				$list_orders[$i], $news_ids[$i]);

			$result = $dbCustom->getResult($db,$sql);
			


		}
	}


}

unset($_SESSION['paging']);

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
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');

		$sortby = (isset($_GET['sortby'])) ? trim(mysql_escape_string($_GET['sortby'])) : '';
		$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';		
		$pagenum = (isset($_GET['pagenum'])) ? addslashes($_GET['pagenum']) : 0;
		$truncate = (isset($_GET['truncate'])) ? addslashes($_GET['truncate']) : 1;
		

		$url_str = "news.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;

		?>
		<div class="alert alert-info"><span class="fltlft"><i class="icon-info-sign icon-white"></i></span><strong>Note:</strong> These news articles display on the home page of the Admin Panel, not the website. If you'd like to add a new article to the website, go to the <a href="<?php echo $ste_root; ?>/manage/cms/blog/blog.php">Blog section</a>.</div>
		<form name="form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="set_active_and_display_order" value="1">
			
        <?php if($admin_access->administration_level > 1){ 
		
		$url_str = "add-news.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=".$truncate;
		?>
            
            <div class="page_actions"> 
            	<a class="btn btn-large btn-primary" href="<?php echo $url_str ; ?>"><i class="icon-plus icon-white"></i> Add Internal News Article </a>
				<a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
			</div>
		<?php

		}

		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * FROM news 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";

		$nmx_res = $dbCustom->getResult($db,$sql);
		

		$total_rows = $nmx_res->num_rows;
		$rows_per_page = 16;
		$last = ceil($total_rows/$rows_per_page); 
						
		if ($pagenum > $last){ 
			$pagenum = $last; 
		}
		if ($pagenum < 1){ 
			$pagenum = 1; 
		}
						
		$limit = ' limit ' .($pagenum - 1) * $rows_per_page.','.$rows_per_page;



		if($sortby != ''){
			if($sortby == 'list_order'){
				if($a_d == 'd'){
					$sql .= " ORDER BY list_order DESC".$limit;
				}else{
					$sql .= " ORDER BY list_order".$limit;		
				}
			}
   
			if($sortby == 'title'){
				if($a_d == 'd'){
					$sql .= " ORDER BY title DESC".$limit;
				}else{
					$sql .= " ORDER BY title".$limit;		
				}
			}
			if($sortby == 'content'){
				if($a_d == 'd'){
					$sql .= " ORDER BY content DESC".$limit;
				}else{
					$sql .= " ORDER BY content".$limit;		
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


			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "general-admin/news.php", $sortby, $a_d);
				echo "<br /><br /><br />";
			}
	
?>
		<div class="data_table">
            <?php require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/tablesort.php"); ?>
				<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
          					<th width="7%" <?php addSortAttr('list_order',true); ?>>
                            List 0rder
                            <i <?php addSortAttr('list_order',false); ?>></i>
                            </th>
          					<th width="20%" <?php addSortAttr('title',true); ?>>
                            Title
                            <i <?php addSortAttr('title',false); ?>></i>
                            </th>
          					<th <?php addSortAttr('content',true); ?>>
                            Content Preview
                            <i <?php addSortAttr('content',false); ?>></i>
                            </th>
          					<th width="15%" <?php addSortAttr('hide',true); ?>>
                            Active
                            <i <?php addSortAttr('hide',false); ?>></i>
                            </th>
							<th width="12%">Edit</th>
							<th width="5%">Delete</th>
						</tr>
					</thead>
					<?php
						$block = '';
						while($row = $result->fetch_object()) {
							$block .= "<tr>"; 				
							//list order
							$block .= "<td><input type='text' name='list_order[]' value='".$row->list_order."' style='width:20px' /></td>";
							//title
							$block .= "<td>$row->title</td>";
							
							//content preview
							$content = stripslashes($row->content);
							$contentSnippet = substr($content,0,100);

							$block .= "<td>$contentSnippet</td>";
							$block .= "<input type='hidden' name='news_id[]' value='".$row->news_id."' />";
							$checked = ($row->hide)? '' : "checked='checked'";
							$disabled = ($admin_access->administration_level < 2)? "disabled" : '';
							
							$block .= "<td><div class='checkboxtoggle on ".$disabled." '> 
							<span class='ontext'>ON</span><a class='switch on' href='#'></a>
							<span class='offtext'>OFF</span>
							<input type='checkbox' class='checkboxinput' name='active[]' value='".$row->news_id."' $checked /></div></td>";	
							//edit
							$url_str = "edit-news.php";
							$url_str .= "?news_id=".$row->news_id;
							$url_str .= "&pagenum=".$pagenum;
							$url_str .= "&sortby=".$sortby;
							$url_str .= "&a_d=".$a_d;
							$url_str .= "&truncate=".$truncate;

							$block .= "<td><a class='btn btn-primary btn-small' 
							href='".$url_str."'><i class='icon-cog icon-white'></i> Edit</a></td>";
							//delete
							$block .= "<td><a class='btn btn-danger confirm ".$disabled."'>
							<i class='icon-remove icon-white'></i>
							<input type='hidden' id='".$row->news_id."' class='itemId' value='".$row->news_id."' /></a></td>";
							$block .= "</tr>";
						}
							
							echo $block;
					
						?>
				</table>
			<?php
			if($total_rows > $rows_per_page){
				echo getPagination($total_rows, $rows_per_page, $pagenum, $truncate, $last, "general-admin/news.php", $sortby, $a_d);
			}

			?>

			</div>
		</form>
        <a onClick="regularSubmit();" href="#" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </a>
	</div>
	<p class="clear"></p>
	<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');

	$url_str = "news.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$truncate;

?>
</div>
<div id="content-delete" class="confirm-content">
	<h3>Are you sure you want to delete this news item?</h3>
	<form name="del_news_form" action="<?php echo $url_str; ?>" method="post" target="_top">
		<input id="del_news_id" class="itemId" type="hidden" name="del_news_id" value='' />
		<a class="btn btn-large dismiss">No, Cancel</a>
		<button class="btn btn-danger btn-large" name="del_news" type="submit" >Yes, Delete</button>
	</form>
</div>
<div class="disabledMsg">
	<p>Sorry, this item can't be deleted or inactive.</p>
</div>
</body>
</html>
