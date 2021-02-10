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

$page_title = 'Footer Nav Label';
$page_group = 'navbar';

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg ?></p>
	</div>
	<?php } ?>
	<form name="add_footer_nav_label" action="footer-nav.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
		<div class="lightboxcontent">
		<h2>Add Footer Nav Item</h2>
		<fieldset class="colcontainer">
        
        
        
				<p>Select a navigation type.</p>
				<div style="float:left;">
				<label>Use Shop by Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="1" /></div>
				</div>

				<div style="float:left; padding-left:160px;">                
				<label>Use Home Page Category List</label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="4" checked="checked" /></div>
				</div>


				<div style="clear:both"></div>
                
                
				<div style="float:left;">
				<label>Use Shop by Brand List </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="2" /></div>
				</div>

				<div style="float:left; padding-left:160px;">
				<label>Use Editable Subnavigation </label>
				<div class="radiotoggle off"> 
                <span class="ontext">ON</span>
                <a class="switch on" href="#"></a>
                <span class="offtext">OFF</span>
                <input type="radio" class="radioinput" name="submenu_content_type" value="3" /></div>
				</div>

		
        
        
        	</fieldset>

			<div class="twocols editable_subnavigation" style="display:none;">


			<fieldset class="colcontainer ">

				<div class="twocols">
					<label>Label</label>
					<input type="text" name="label">
				</div>

	            <?php
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT keyword_landing_id, url_name 
                        FROM keyword_landing 
                        WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
                $result = $dbCustom->getResult($db,$sql);	
                if($result->num_rows > 0){
                
                ?>				
				<div class="colcontainer">
                	<label>Keyword Lading Page </label>
                    <?php 
    					$block = "<select name='keyword_landing_id'>";
							
						$block .= "<option value='0'>Select<option>";
							
    					while($row = $result->fetch_object()) {
					
							$block .= "<option value='".$row->keyword_landing_id."' >".$row->url_name."<option>";
					
						}
						$block .= "</select>";
						echo $block;
                       ?>
				</div>
                
                <?	
                }
                ?>       

            
            		<label>Static Page</label>
					<select name="page_seo_id">
                    <option value="0"> Select </option>
                    <?php
                        
                        $block = '';			
						$sql = "SELECT * FROM page_seo 
							WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
							AND page_name != 'checkout'
							AND page_name != 'default'
							AND page_name != 'blog-more'
							";
						if(!$module->hasAskModule($_SESSION['profile_account_id'])){
							$sql .= " AND page_name != 'blog'";
							$sql .= " AND page_name != 'social-network'";			
						}		
                        $sql .= " ORDER BY page_name";
                        $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
						$result = $dbCustom->getResult($db,$sql);
                        
                        while($row = $result->fetch_object()){
                            $selected = ($object->page_seo_id == $row->page_seo_id)? 'selected' : '';										
                            $block .= "<option value='".$row->page_seo_id."' $selected >$row->page_name</option>";
                        }
                        echo $block;
                        
                 	?>
                    </select>
				</div>
			</fieldset>
	</div>
		<br /><br />
	<div class="savebar">
		<button class="btn btn-large btn-success" name="add_footer_nav_label" type="submit"><i class="icon-ok icon-white"></i> Add Nav Item </button>
        <a class="btn btn-large" style="width:100px;" href="footer-nav.php?<?php echo $qs_strip; ?>" <?php if(!$strip) echo "target='_top'"; ?>>Cancel</a>
	</div>
	</form>
</div>
</body>
</html>


