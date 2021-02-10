<?php
require_once("../includes/config.php"); 
require_once("../admin-includes/db_connect.php");
require_once("../includes/class.admin_login.php");
require_once("../admin-includes/class.admin_bread_crumb.php");	
require_once("includes/tool-tip.php"); 

require_once("includes/class.setup_progress.php"); 
$progress = new SetupProgress;
require_once("../admin-includes/class.module.php");	
$module = new Module;

$page_title = "Access Denied";
$page_group = "access";

require_once("includes/set-page.php");	


require_once("includes/doc_header.php"); 

?>
</head>

<body>
<?php
	require_once("includes/manage-header.php");
	require_once("includes/manage-top-nav.php");
?>
<div class="manage_page_container">


    <div class="manage_side_nav">
        <?php 
        require_once("includes/manage-side-nav.php");
        ?>
    </div>	
	

    <div class="manage_main">
<?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    
        $bc = $bread_crumb->output();
        echo $bc; 

?>


<div style="margin-left:40px; margin-top:40px;">

You do not have access to view this area please contact your site administrator. 

</div>

	
    
    
</div>
  <p class="clear"></p>
<?php 
require_once("includes/manage-footer.php");
?>       
  
    
</div>

</body>
</html>


