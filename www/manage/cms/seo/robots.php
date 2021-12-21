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


require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "SEO Robots";
$page_group = "seo";

	

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

//echo $_SESSION['profile_account_id'];

if(isset($_POST['submit'])){

	$sql = "DELETE FROM robots 
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	


	//$excludes = trim(addslashes($_POST['excludes']));	
	$excludes = (isset($_POST['excludes'])) ? $_POST['excludes'] : array();


	$path = $_SERVER['DOCUMENT_ROOT']."/saas-customers";
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/".$_SESSION['profile_account_id'];
	if (!file_exists($path)) {
		mkdir($path);         
	}
	$path .= "/robots";
	if (!file_exists($path)) {
		mkdir($path);         
	}

	if(file_exists($path.'/robots.txt')){
		unlink($path.'/robots.txt');		
	}
	
	
	$fp = fopen($path.'/robots.txt',"w"); 
	
	fwrite($fp, '# robots.txt for '.SITEROOT.PHP_EOL.PHP_EOL);
	fwrite($fp, 'User-agent: *'.PHP_EOL.PHP_EOL);
	fwrite($fp, '# disallow pages/folders'.PHP_EOL.PHP_EOL);
		
	fwrite($fp, 'Disallow: /blueimp/'.PHP_EOL);
	fwrite($fp, 'Disallow: /cgi-bin/'.PHP_EOL);
	fwrite($fp, 'Disallow: /closet-organizer/'.PHP_EOL);
	fwrite($fp, 'Disallow: /costco/'.PHP_EOL);
	//fwrite($fp, 'Disallow: /css/'.PHP_EOL);
	fwrite($fp, 'Disallow: /flash/'.PHP_EOL);
	//fwrite($fp, 'Disallow: /js/'.PHP_EOL);
	//fwrite($fp, 'Disallow: /images/'.PHP_EOL);
	fwrite($fp, 'Disallow: /includes/'.PHP_EOL);
	fwrite($fp, 'Disallow: /manage/'.PHP_EOL);
	fwrite($fp, 'Disallow: /temp_uploads/'.PHP_EOL);
		
	foreach($excludes as $value){
			
		$exclude = trim(addslashes($value));
		$sql = sprintf("INSERT INTO robots (exclude, profile_account_id) 
			VALUES ('%s','%u')", 
		$exclude, $_SESSION['profile_account_id']);		
$result = $dbCustom->getResult($db,$sql);		

		if(strpos($exclude,'.html')){
			fwrite($fp, 'Disallow: *'.$exclude.'*'.PHP_EOL);
		}else{
			fwrite($fp, 'Disallow: '.$exclude.PHP_EOL);	
		}
	}

	fwrite($fp, PHP_EOL.'Sitemap: '.SITEROOT.'/sitemap.xml.gz'.PHP_EOL);

	fclose($fp);
		
	$msg = 'Robots.txt file created';

	
	unset($_SESSION['input_count']);
	unset($_SESSION['exclude_values']);

}

$firstload =  (isset($_GET['firstload'])) ? $_GET['firstload'] : 0;
if($firstload){
	unset($_SESSION['input_count']);
	unset($_SESSION['exclude_values']);
}


if(!isset($_SESSION['exclude_values'])){

	$_SESSION['exclude_values'] = array();
	$sql = "SELECT exclude 
			FROM robots
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);	
	while($row = $result->fetch_object()){
		$_SESSION['exclude_values'][] = $row->exclude;
		
		//echo $row->exclude;
				
	}
	$_SESSION['input_count'] = count($_SESSION['exclude_values']);
	if($_SESSION['input_count'] == 0) $_SESSION['input_count'] = 1;
	
}


$_SESSION['input_count'] = (isset($_SESSION['input_count'])) ? $_SESSION['input_count'] :1;
$_SESSION['exclude_values'] = (isset($_SESSION['exclude_values'])) ? $_SESSION['exclude_values'] :array();


//print_r($_SESSION['exclude_values']);



require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>
<script>
$(document).ready(function() {

	q_str = '?action=0';
	set_form(q_str);

});

function add_input(){
	
	q_str = '?action=add'+get_query_str();
	
	set_form(q_str);	
}



function set_form(q_str){
	
	
	
	$.ajaxSetup({ cache: false}); 
	$.ajax({	
	  url: 'ajax_robot_form.php'+q_str,
	  success: function(data) {			
			
		$('#form_content').html(data);
		  
	  }
	});		
}


</script>

</head>
<body>
<?php
	require_once($real_root.'/manage/admin-includes/manage-header.php');
	require_once($real_root.'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
	</div>
	<div class="manage_main">
		<?php 
		
		require_once($real_root."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->reSet();
		$bread_crumb->add("CMS", SITEROOT."/manage/cms/cms-landing.php");
		$bread_crumb->add("Robots", '');
        echo $bread_crumb->output();
		
        require_once($real_root.'/manage/admin-includes/manage-content-top-category.php');
        
		//SEO section tabbed sub-navigation
        require_once($real_root."/manage/admin-includes/seo-section-tabs.php");
		
		?>
        <form name="form" action="robots.php" method="post" enctype="multipart/form-data">
        	Excludes<br />
        	
			<div id='form_content'></div>
			
			
        	<br />

			<a href='#' onClick="add_input();">Add Another Exclude</a>
        
        	<br /><br />
            <input type="submit" name="submit" value="Create Robot File">
        
        </form>
    	



		<?php 

        if($admin_access->cms_level > 1){
            //echo "<button class='btn btn-success btn-large' name='edit_global_word' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Save Changes</button>"; 
        }else{?>
            <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
        <?php } ?>
  	</div>

        
    <p class="clear"></p>
	<?php 
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
	?>
</div>
</body>
</html>

