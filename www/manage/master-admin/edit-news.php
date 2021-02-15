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

$page_title = "Edit Admin News";
$page_group = "news";

	

$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
		tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "wysiwyg",
        theme : "advanced",
        skin : "o2k7",
        plugins : "table,advhr,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,style",
        // Theme options
        theme_advanced_buttons1 :"bold,italic,underline,strikethrough,|,styleselect,formatselect,fontsizeselect,|,forecolor,backcolor",
        theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,cut,copy,paste,pastetext,pasteword,|,undo,redo,|,link,unlink,",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
	content_css : "../../../css/mce.css"
	});

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
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);    
		$news_id = $_GET['news_id']; 
		$sql = sprintf("SELECT list_order, type, content, hide, author, title 
						FROM news 
						WHERE news_id = '%u'
						AND profile_account_id = '%u'", $news_id, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);		$object = $result->fetch_object();
		
		$url_str = "news.php";
		$url_str .= "?pagenum=".$_SESSION['paging']['pagenum'];
		$url_str .= "&sortby=".$_SESSION['paging']['sortby'];
		$url_str .= "&a_d=".$_SESSION['paging']['a_d'];
		$url_str .= "&truncate=".$_SESSION['paging']['truncate'];

		?>
		<form name="edit_news" action="<?php echo $url_str; ?> " method="post">
       		<input id="news_id" type="hidden" name="news_id" value="<?php echo $news_id;  ?>" />
			
            <div class="page_actions edit_page">
            	<?php if($admin_access->administration_level > 1){ ?>
					<button name="edit_news" type="submit" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save </button>
					<hr />
                <?php }else{ ?>
                    <div class="alert">
                        <i class="icon-warning-sign"></i>         
                        Sorry, you don't have the permissions to edit this area.
                    </div>            
                <?php } ?>
            	<a href="<?php echo $url_str; ?>" target="_top" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a> 
            </div>
			
            
            <div class="page_content edit_page">
				<fieldset class="edit_content">
					<div class="colcontainer formcols">
						<?php if(getProfileType() == "master" || getProfileType() == "parent"){ ?>
						<div class="twocols">
							<label>News Type</label>
						</div>
						<div class="twocols">
							<select name="type">
								 <option value="admin" <?php if($object->type == "admin") echo "selected"; ?>>admin</option>
								 <option value="whats_new" <?php if($object->type == "whats_new") echo "selected"; ?>>admin what's new</option>
								 <option value="public" <?php if($object->type == "public") echo "selected"; ?>>public</option>
							</select>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Active?</label>
						</div>
						<div class="twocols">
							<div class="radiotoggle on"> <span class="ontext">ON</span><a class="switch on" href="#"></a><span class="offtext">OFF</span><input type="radio" class="radioinput" name="hide" value="1" <?php if(!$object->hide) echo "checked='checked'"?> /></div>
						</div>
					</div>
					<div class="colcontainer formcols">
						<?php }else{ ?>
						<input type="hidden" name="type" value="public" />
						<?php } ?>
						<div class="twocols">
							<label>Author</label>
						</div>
						<div class="twocols">
							<input type="text" name="author" value="<?php echo prepFormInputStr($object->author); ?>"/>
						</div>
					</div>
					<div class="colcontainer formcols">
						<div class="twocols">
							<label>Title</label>
						</div>
						<div class="twocols">
							<input type="text" name="title"  value="<?php echo prepFormInputStr($object->title); ?>" />
						</div>
					</div>
					<div class="colcontainer">
						<label>Content</label>
						<textarea  name="content" id="wysiwyg1" class="wysiwyg small"><?php echo stripslashes($object->content); ?></textarea>
					</div>
				</fieldset>
			</div>
		</form>
	</div>
	<p class="clear"></p>
	<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>
