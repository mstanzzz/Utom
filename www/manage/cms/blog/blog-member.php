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
$page = '';

$msg = '';

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

if(isset($_POST["add_member"])){

	$name = trim(addslashes($_POST['name'])); 

	$sql = sprintf("INSERT INTO blog_member (name, profile_account_id) 
					VALUE ('%s','%u')", 
					$name, $_SESSION['profile_account_id']);
	$result = $dbCustom->getResult($db,$sql);
	

}

if(isset($_POST["edit_member"])){
	
	$name = trim(addslashes($_POST['name'])); 
	$blog_member_id = $_POST["blog_member_id"];
	
	$sql = sprintf("UPDATE blog_member SET name = '%s' 
					WHERE blog_member_id = '%u'
					AND profile_account_id = '%u'", 
					$name, $_SESSION['profile_account_id']);

		
	$result = $dbCustom->getResult($db,$sql);
	//
	
}

if(isset($_POST["del_blog_member_id"])){

	$blog_member_id = $_POST["del_blog_member_id"];

	$sql = sprintf("DELETE FROM blog_member WHERE blog_member_id = '%u'", $blog_member_id);
	$result = $dbCustom->getResult($db,$sql);
	//
}

require_once($real_root.'/manage/admin-includes/doc_header.php'); 

?>

<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 
								
   		if(this.href.indexOf("edit") > 1){
			var f_id = $(this).find(".faq_sub").attr('id');
			//alert(this.href.indexOf("edit"));
						
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'edit-blog-member.php?blog_member_id='+f_id,
			  success: function(data) {
				$('#edit').html(data);
				//alert('Load was performed.');
			  }
			});			
		}


		if(this.href.indexOf("delete") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert("del"+this.href.indexOf("delete"));
			//alert("f_id"+f_id);
			$("#del_blog_member_id").val(f_id);
			
		}
		
	});

	$("a.inline").fancybox();
	
});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	content_css : "../css/mce.css"
});


</script>
</head>

<body>

<?php 
include($real_root."/manageincludes/manage-header.php"); 
include($real_root."/manageincludes/manage-nav.php"); 
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	Blog

	<div class="top_right_link">
    <?php
	$ret_page =  (isset($_REQUEST['ret_page'])) ? $_REQUEST['ret_page'] : "start";
	echo "<a href='".$ret_page.".php'>< BACK</a>";
	?>        
    </div> 
    
	<div class="top_link">
         <a class='inline' href='#add'>add blog member</a>
    </div>
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">

<?php
$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : $msg;
echo "<div style='color:blue;'>".$msg."</div>";  
$message =  (isset($_GET['message'])) ? $_GET['message'] : '';
echo "<div style='color:blue;'>".$message."</div>";  
?>

<table border="0" width="100%" cellpadding="10">
    <tr>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td><div class="head">Name</div></td>
    </tr>
    <?php
    $sql = "SELECT * FROM blog_member WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
    
	//

    while($row = $result->fetch_object()) {
    	$block = "<tr>"; 				

		$block .= "<td valign='top'><br /><a href='edit-blog-member.php?blog_member_id=".$row->blog_member_id."&ret_page=blog-member'>
			<img src='../images/button_edit.jpg' /></a></td>";
	
		$block .= "<td valign='top'><br /><a class='inline' href='#delete' style='color:#3f6e84;'>
			<img src='../images/button_delete.jpg' /><div class='e_sub' id='".$row->blog_member_id."' style='display:none'></div> </a></td>";
 
        $block .= "<td valign='top'><br />$row->name</td>";

		echo $block;
    }
    ?>
</table>
    
    
	<div style="display:none">
        <div id="edit" style="width:350px; height:160px;">
        </div>
    </div>

    
    <div style="display:none">
        <div id="delete" style="width:380px; height:100px;">
            Are you sure you want to delete this blog member?
            <form name="del_blog_member_form" action="blog-member.php" method="post">
                <input id="del_blog_member_id" type="hidden" name="del_blog_member_id" />
                <input name="del_blog_member" type="submit" value="DELETE" />
            </form>        
        </div>
    </div>
    
    <div style="display:none">
        <div id="add">
        <form name="add_blog_member_form" action="blog-member.php" method="post">
        <input type="text" name="name" style="width:300px" />
        <input name="add_member" type="submit" value="ADD" />
        </form>
        </div>
    </div>
    

</div>

</body>
</html>


