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

$page_title = "Navbar Label";
$page_group = "navbar";

	

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$msg = '';

$strip = (isset($_GET['strip'])) ? $_GET['strip'] : 0;
$qs_strip = ($strip) ? "strip=1" : ''; 


require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>


<script>

$(document).ready(function(){

	$(".radiotoggle").click(function(){
		if($("#esm").is(':checked')){		
			$("#lower_form").show();		
		}else{
			$("#lower_form").hide();
		}
	});

});


</script>

</head>
<body class="lightbox">
<div class="lightboxholder">
	<?php if($msg != ''){ ?>
	<div class="alert">
		<p><?php echo $msg; ?></p>
        
        <div id="msg"></div>
        
	</div>
	<?php } ?>
	<form name="add_navbar_label" action="navbar.php?<?php echo $qs_strip; ?>" method="post" <?php if(!$strip) echo "target='_top'"; ?> >
		<div class="lightboxcontent">
			<h2>Add a New Nav Item</h2>
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
                <input id="esm" type="radio" class="radioinput" name="submenu_content_type" value="3" /></div>
				</div>

            </fieldset>
    
                
           <fieldset class="colcontainer ">
           <div class="colcontainer">
               <label>Label</label>
               <input type="text" name="label" value=''  >
           </div>
                
            <div id='lower_form' style="display:none;">
            
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
                
                <div class="colcontainer">
                    <label>Selectable Page</label>
                     <?php 
                    $pages = new Pages;
                    $available_pages_array = $pages->getAvailableNavPages($_SESSION['profile_account_id']);  
                    $block = "<select name='page_seo_id'>";
					
					$block .= "<option value='0'>Select<option>";
					
                    foreach($available_pages_array as $value){
                                                            
                    $block .= "<option value='".$value['page_seo_id']."'>".ucwords($value['visible_name'])."<option>";
                    }
                    $block .= "</select>";
                    echo $block;
                    ?>
                    
                </div>
    
                <div class="colcontainer">			
                If there is a custom url, selectable page will be ignored.<br />
                <label>Custom URL</label>
                <input type="text" name="custom_url"  style="width:300px;">
                </div>
                  
                 <br /> 
                <div class="colcontainer">
                    If there is a category url, selectable page and custom url will be ignored.<br />
                    <label>Category URL</label>
                    <?php require_once($real_root.'/manage/cms/radio-tree-snippet.php');  ?>
                </div>
                </fieldset>
			</div>


			<a class="btn" href="navbar.php?<?php echo $qs_strip; ?>" <?php if(!$strip) echo "target='_top'"; ?>>Cancel</a>
			<br /><br /><br />

       	<div class="savebar">
			<?php 
            if($admin_access->ecommerce_level > 1){
                echo "<button class='btn btn-success btn-large' name='add_navbar_label' type='submit' value='Submit'><i class='icon-ok icon-white'></i> Add Nav Item</button>"; 
            }else{?>
                <div class="alert"><span class="fltlft"><i class="icon-warning-sign"></i></span> Sorry, you don't have the permissions to edit this item.</div>
            <?php } ?>
            <button class="btn btn-large" type="button" value="Cancel" onClick="top.location.href = 'navbar.php'" >Cancel</button>
		</div>

	</form>
</div>

</body>
</html>


