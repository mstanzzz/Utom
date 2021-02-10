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

if(isset($_POST["del_dealer"])){
		$dealer_id = $_POST["del_dealer_id"];
		$sql = sprintf("UPDATE dealer_application SET hide = '1' WHERE dealer_id = '%u'", $dealer_id);
		$result = $dbCustom->getResult($db,$sql);
		
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
			$("#del_dealer_id").val(f_id);
			
		}	
		
	})

	$("a.inline").fancybox();
	
});




</script>
</head>

<body>

<?php 
include($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/manage-header.php"); 
include($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/manage-nav.php"); 
?>

<div class="page_title_top_spacer"></div>
<div class="page_title">
	Dealer Applications
   	<div class="top_right_link">
    </div>
    
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>

<div class="page_container">

<?php
$msg =  (isset($_GET['msg'])) ? $_GET['msg'] : $msg;
echo "<div style='color:blue;'>".$msg."</div>";  
?>
  <table border="0" width="100%" cellpadding="10">
  <tr>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="25%"><div class="head">Date Submitted</div></td>
    <td width="25%"><div class="head">Name</div></td>
    <td width="25%"><div class="head">City State</div></td>
     
  </tr>
    <?php


	$sql = "SELECT * FROM dealer_application 
			WHERE hide = '0'
			AND profile_account_id = '".$_SESSION['profile_account_id']."'";
    $result = $dbCustom->getResult($db,$sql);	

    while($row = $result->fetch_object()) {
    
		$block = "<tr>"; 


		$block .= "<td valign='top'><a href='view-dealer.php?dealer_id=".$row->dealer_id."'>
		<img src='".$ste_root."/images/button_view.jpg' /></a></td>";


		$block .= "<td valign='top'><a class='inline' href='#delete'>
		<img src='".$ste_root."/images/button_delete.jpg' /><div class='e_sub' id='".$row->dealer_id."' style='display:none'></div> </a></td>";


		$block .= "<td valign='top'>".date("F j, Y, g:i a", $row->date_submitted)."</td>";			

		$block .= "<td valign='top'>$row->first_name $row->last_name</td>";			
	
		$block .= "<td valign='top'>$row->city $row->state</td>";	
		
		
	
		$block .= "</tr>";
		
		echo $block;
	}

	?>
    </table>
    
    
    <div style="display:none">
        <div id="delete" style="width:300px; height:100px;">
        	<br />
            Are you sure you want to delete this installer?
            <form name="del_dealer" action="dealer-applications.php" method="post">
                <input id="del_dealer_id" type="hidden" name="del_dealer_id" />
                <input name="del_dealer" type="submit" value="DELETE" />
            </form>
        
        
        </div>
    </div>

    
    
</div>

</body>
</html>


