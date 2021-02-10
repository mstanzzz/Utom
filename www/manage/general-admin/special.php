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

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$page ="miscellaneous";

if(isset($_POST["add_page"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$page_name = trim(addslashes($_POST['page_name']));
	$page_title = trim(addslashes($_POST["page_title"]));
	$page_cat = $_POST["page_cat"];
	
//	echo $page_cat."<br />";
//	exit;
	$sql = sprintf("INSERT INTO added_page (content, page_name, page_title, page_cat, hide, profile_account_id) VALUES ('%s','%s','%s','%s', '1', '%u')", 
	$content, $page_name, $page_title, $page_cat, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	
	
}

if(isset($_POST["edit_page"])){
	
	$content = trim(addslashes($_POST["content"])); 
	$page_name = trim(addslashes($_POST['page_name']));
	$page_title = trim(addslashes($_POST["page_title"]));	
	$page_cat = $_POST["page_cat"];
	$added_page_id = $_POST["added_page_id"];
	//echo "content".$content."<br />";
	//exit;

	$sql = sprintf("UPDATE added_page 
					SET content = '%s', page_name = '%s', page_title = '%s', page_cat = '%s' WHERE added_page_id = '%u'", 
	$content, $page_name, $page_title, $page_cat, $added_page_id);
	$result = $dbCustom->getResult($db,$sql);
	//
	
}

if(isset($_POST["del_page"])){

	$added_page_id = $_POST["del_page_id"];
	//echo "policy_id".$policy_id;
	//exit;
	$sql = sprintf("DELETE FROM added_page WHERE added_page_id = '%u'", $added_page_id);
	$result = $dbCustom->getResult($db,$sql);
	//

}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 
	
		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_page_id").val(f_id);
			
		}
		
	})


	
	$("a.inline").fancybox();
	
	/* not necessary
	$("#edit_faq").click(function(){ $.fancybox.close;  })
	$("#add_faq").click(function(){ $.fancybox.close;  })
	*/
});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});

</script>
</head>


<body>

<?php include($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/cms-header.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/cms-nav.php"); ?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	Specials
    
   	<div class="top_right_link">
	    <a href='add-special.php'>Add New Special</a>
    </div>

</div>


<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">

<?php

 if(isset($_GET['message'])) echo "<div style='color:blue;'>".$_GET['message']."</div>";   ?>

  <table border="0" width="100%" cellpadding="15">
  <tr>
    <td width="10%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
    <td width="18%">Status</td>
    <td width="18%"><div class="head">Special Name</div></td>
	<td width="18%"><div class="head">&nbsp;</div></td>
    <td ><div class="head">Description</div></td>

  </tr>
    <?php
    //$sql = "SELECT * FROM policy";


	$sql = "SELECT * FROM special
			WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
	
    $result = $dbCustom->getResult($db,$sql);	//
 
    while($row = $result->fetch_object()) {
		
		
		 $block = "<tr>";		
		 
        $block .= "<td valign='top'><a href='edit-special.php?special_id=".$row->special_id."'>
		<img src='../images/button_edit.jpg' /></a></td>";
	
        $block .= "<td valign='top'><a class='inline' href='#delete' style='color:#3f6e84;'>
		<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->special_id."' style='display:none'></div> </a></td>";

        if($row->hide){
			$show_hide = "Hidden";
		}else{
			$show_hide = "<span style='color:red'>Live</span>";	
		}
		$block .= "<td valign='top'>$show_hide</td>";

		$block .= "<td valign='top'>stripslashes($row->special_name)</td>";
		
		$block .= "<td valign='top'></td>";
		
		$block .= "<td valign='top'>stripslashes($row->description)</td>";

        $block .= "</tr>";
		echo $block;
    }
    
    ?>
    </table>
    
    
    <div style="display:none">
        <div id="delete" style="width:200px; height:100px;">
        
            Are you sure you want to delete this page?<br /><br />
            <form name="del_page_form" action="page.php" method="post">
                <input id="del_page_id" type="hidden" name="del_page_id" />
                <input name="del_page" type="submit" value="DELETE" />
            </form>
        
        
        </div>
    </div>
    
    
    
    
    <br /><br /><br />
    
    
    
    
</div>

</body>
</html>



