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

require_once($real_root.'/includes/class.nav.php');
$nav = new Nav;


$list_type = (isset($_GET['list_type'])) ? $_GET['list_type'] : 'cart'; 


require_once($real_root.'/manage/admin-includes/doc_header.php'); 
?>
</head>
<body>

	<div class="lightboxholder">

<br /><br />
    
    <form name="form" action="home.php" method="post" enctype="multipart/form-data" target="_top">
        
        <input type="hidden" name="set_hp_display_order" value="1">

		
        <input type="hidden" name="list_type" value="<?php echo $list_type; ?>">
        
        
        
    
    <input class="btn btn-primary btn-large" type="submit" name="submit" value="Submit" >    
<br /><br />        
		<table cellpadding="10" cellspacing="0">
			<thead>
			<tr>
				<th width="40%">Image</th>
   				<th width="30%">Name</th>
                <th width="8%">ID</th>
   				<th>Order</th>                
			</tr>
			</thead>
			<tbody>
            


	<?php
	
	if($list_type == 'cart'){
		$cats = $nav->getHomePageCats($dbCustom,'cart');
	}else{
		$cats = $nav->getHomePageCats($dbCustom,'showroom');		
	}



	$block = '';
	foreach($cats as $val){
		
		$block .= "<tr>";
			$block .= "<td><a  href='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/full/".$val['file_name']."'>";
			$block .= "<img  src='".SITEROOT."/saascustuploads/".$_SESSION['profile_account_id']."/cart/thumb/".$val['file_name']."'></a></td>";
		
		$block .= "<td>".$val['name']."</td>";
		
		$block .= "<td>".$val['cat_id']."</td>";

		//hp1_display order
		if($list_type == 'cart'){
			$dsval = $val['hp1_display_order'];
		}else{
			$dsval = $val['hp2_display_order'];
		}
		$block .= "<td valign='middle' >
		<input type='text' name='order[]' value='".$dsval."'/>
		<input type='hidden' name='cat_id[]' value='".$val['cat_id']."' /></td>";
		
		
		//active (on/off)
		/*
		$checked = ($val['active'])? "checked='checked'" : ''; 
		$block	.= "<td align='center' valign='middle' >
					<div class='checkboxtoggle on '> 
					<span class='ontext'>ON</span>
					<a class='switch on' href='#'></a>
					<span class='offtext'>OFF</span>
					<input type='checkbox' class='checkboxinput' name='active[]' value='".$val['cat_id']."' ".$checked." /></div></td>";	
		*/
		
		
		$block .= "</tr>";
	}


	echo $block;
	
	?>
    
    </tbody>
    </table>
    
    
    
    </form>


	</div>
</body>
</html>