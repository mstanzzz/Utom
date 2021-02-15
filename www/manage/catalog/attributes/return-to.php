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


$page_title = "Return To";
$page_group = "return-to";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

$parent_cat_id =  (isset($_GET['parent_cat_id'])) ? $_GET['parent_cat_id'] : 0;

$msg = '';

if(isset($_POST["add_return_to"])){

	$name = addslashes($_POST["added_return_to"]); 
	
	
	$sql = sprintf("SELECT * 
					FROM return_to 
					WHERE name = '%s'
					AND profile_account_id = '%u'", $name, $_SESSION['profile_account_id']);	
$result = $dbCustom->getResult($db,$sql);
	
	if(!$result->num_rows){
		$sql = sprintf("INSERT INTO return_to (name, profile_account_id) VALUES ('%s''%u')", $name, $_SESSION['profile_account_id']);
		$result = $dbCustom->getResult($db,$sql);
		
		
		$msg = "Your change is now live.";

	}else{
		$msg = "The brand name already exists";
	}

}


if(isset($_POST["edit_return_to"])){
	
	
	$name = addslashes($_POST['name']); 

	$return_to_id = $_POST["return_to_id"];
	
	//echo $return_to_id;
	
	$sql = sprintf("UPDATE return_to SET name = '%s' WHERE return_to_id = '%u'", 
	$name, $return_to_id);
	
	//echo $sql;
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";
	
}

if(isset($_POST["del_return_to"])){

	$return_to_id = $_POST["del_return_to_id"];
	//echo "accessory_cat_id".$accessory_cat_id;
	//exit;
	$sql = sprintf("DELETE FROM return_to WHERE return_to_id = '%u'", $return_to_id);
	$result = $dbCustom->getResult($db,$sql);
	

	$msg = "Your change is now live.";

}





require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
<script>
$(document).ready(function() {
	

	$(".inline").click(function(){ 


		if(this.href.indexOf("edit") > 1){
			var f_id = $(this).find(".e_sub").attr('id');
			//alert(this.href.indexOf("edit"));
			
			//alert(f_id);
			
			$.ajaxSetup({ cache: false}); 
			$.ajax({
			  url: 'edit-return-to.php?return_to_id='+f_id,
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
			$("#del_return_to_id").val(f_id);
			
		}		
		
	})

	
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

 
   	<div class="top_link">
	    <a class='inline' href='#add'>Add return to</a><br>
    </div>


    <div class="manage_main">
    
    
<?php 
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
    
        $bc = $bread_crumb->output();
        echo $bc."<br />"; 



$sql = "SELECT * FROM return_to 
AND profile_account_id = '".$_SESSION['profile_account_id']."'
ORDER BY return_to_id";
$result = $dbCustom->getResult($db,$sql);
	
	
if($result->num_rows < 1){
	echo "No lead times";	
}

?>

    <table border="0" width="100%" cellpadding="10">
    <tr>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td><div class="head">Return To</div></td>
    </tr>
    <?php
	
    while($row = $result->fetch_object()) {
    	$block = "<tr>"; 
		
		if(in_array(2,$user_functions_array)){
	
			$block .= "<td valign='top'><a class='inline' href='#edit'>
			edit<div class='e_sub' id='".$row->return_to_id."' style='display:none'></div> </a></td>";
			
			$block .= "<td valign='top'><a class='inline' href='#delete'>
			delete<div class='e_sub' id='".$row->return_to_id."' style='display:none'></div> </a></td>";
		}else{
			$block .= "<td>&nbsp;</td>";
			$block .= "<td>&nbsp;</td>";
		}

		$block .= "<td valign='top'>".stripslashes($row->name)."</td>";
		$block .= "</tr>";
		echo $block;
    }
    
    ?>
    </table>




</div>
</div>


    
	<div style="display:none">
        <div id="edit" style="width:760px; height:400px;">
        </div>
    </div>

    <div style="display:none">
        <div id="delete" style="width:280px; height:100px; text-align:center;">
        
            Are you sure you want to delete lead time?
            <form name="del_return_to" action="return-to.php" method="post">
                <input id="del_return_to_id" type="hidden" name="del_return_to_id" />
                <input name="del_return_to" type="submit" value="DELETE" />
            </form>
        
        </div>
    </div>

    
    <div style="display:none">
        <div id="add"  style="width:760px; height:400px; text-align:left;">
            <form name="add_return_to" action="return-to.php" method="post">
                <div class="head">Lead time</div><br />
                <input type="text" name="added_return_to" style="width:300px" />
                <input name="add_return_to" type="submit" value="ADD" />
                          
                </textarea> 
            </form>
        </div>
    </div>
    
</body>
</html>

