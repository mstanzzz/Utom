<?php



if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
}elseif(strpos($_SERVER['REQUEST_URI'], "designitpro" )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site';
}else{
$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Home Submit Button";
$page_group = "home";

	


$home_submit_button_id = (isset($_GET['home_submit_button_id'])) ? $_GET['home_submit_button_id'] : 0;

$msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
$sql = "SELECT button_text, page_seo_id, active 
	    FROM home_submit_button 
 		WHERE home_submit_button_id = '".$home_submit_button_id."'";
$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){
	$object = $result->fetch_object();
	$button_text = $object->button_text;
	$page_seo_id = $object->page_seo_id;
}else{
	$button_text = '';
	$page_seo_id = 0;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php');
?>

</head>
<body>

<div class="lightboxholder">
<?php if($msg != ''){ ?>
<div class="alert">
<p><?php echo $msg ?></p>
</div>
<?php
}

?>
<form name="form" action="home.php" method="post" target="_top">

<input type="hidden" name="home_submit_button_id" value="<?php echo $home_submit_button_id; ?>">

<div class="lightboxcontent">
    
    <h2><?php echo $page_title; ?></h2>
	<fieldset>
    <legend>Link Properties</legend>
    <div class="colcontainer">
        <div class="twocols">
        <label>Button Text</label>
        </div>
        <div class="twocols">
        <input id="button_text" type="text" name="button_text" value="<?php echo stripslashes($button_text); ?>" />
        </div>
    </div>
    

    
	<div class="colcontainer">
		<div class="twocols">
		<label>Link to Page</label>
		</div>
		<div class="twocols">
        
            <?php
            $block = '';			
            $block .= "<select id='page_seo_id'  name='page_seo_id'>";
            $block .= "<option value='0' >None</option>";

            $sql = "SELECT * FROM page_seo 
                    WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
                    AND page_name != 'checkout'
                    AND page_name != 'default'
                    AND page_name != 'blog-more'
					AND page_name != 'shopping-cart'
                    ";
            if(!$module->hasAskModule($_SESSION['profile_account_id'])){
                $sql .= " AND page_name != 'blog'";
                $sql .= " AND page_name != 'social-network'";			
            }		
            $sql .= " ORDER BY page_name";
			
   			$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
			$result = $dbCustom->getResult($db,$sql);            
            while($row = $result->fetch_object()){
            $selected = ($page_seo_id == $row->page_seo_id)? "selected" : '';										
            $block .= "<option value='".$row->page_seo_id."' $selected >$row->page_name</option>";
            }
            $block .= "</select>";
            echo $block;
            ?>
        
        
        </div>
	</fieldset>
</div>

<div class="savebar">
    <div style="float:left; margin-right:10px;">
    	<a href="<?php echo $ste_root;?>/manage/cms/pages/home.php" class="btn btn-large" style="width:100px;" target="_top"><i class="icon-arrow-left"></i> Cancel</a>
    </div>
    <div style="float:left;">
    	<button class="btn btn-large btn-success" name="edit_home_submit_button" type="submit"><i class="icon-ok icon-white"></i> Save Changes </button>
	</div>
    <div class="clear"></div>
	

</div>
</form>
</div>
</body>
</html>

