<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'aws/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/aws';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

if(isset($_GET['del'])){
	
	$id = $_GET['del'];
	if(!is_numeric($id)) $id = 0;
	
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "DELETE 
		FROM design_email 
		WHERE design_email_id = '".$id."'";
	
	
}



require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
</head>
<body>

<a href="design-email.php">BACK</a>

		<table cellspacing="5">
		<tr>
		<td width="3%"></td>
		<td width="3%">spam</td>
		<td width="3%">ID</td>
		<td width="3%">Email</td>
		<td width="3%">Date</td>
		<td>obstructions</td>
		<td>comments</td>
		<!--
		<td>base_mold_height</td>
		<td>ceiling_height</td>
		-->

		</tr>
		
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>		
		<!--
		<td width="5%"></td>
		<td width="5%"></td>		
		-->
		</tr>
		
		<?php 
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$sql = "SELECT * 
		FROM design_email 
		WHERE profile_account_id = '".$_SESSION['profile_account_id']."'
		ORDER BY design_email_id";

		$result = $dbCustom->getResult($db,$sql);		
		
		$block = ''; 
		while($row = $result->fetch_object()) {
			$is_spam = 0;
			
			if(substr($row->email, -3) == '.ru'){
				$is_spam = 1;	
			}
			if(substr($row->email, -3) == '.pl'){
				$is_spam = 1;	
			}
			if(substr($row->email, -3) == '.ua'){
				$is_spam = 1;	
			}

			if(isSPAM($row->obstructions)){
				$is_spam = 1;
			}
			if(isSPAM($row->comments)){
				$is_spam = 1;	
			}

						
			$block .= "<tr>";
			
			$block .= "<td></td>";
			
			if($is_spam > 0){
				$block .= "<td><a href='clean-spam.php?del=".$row->design_email_id."'><button type='button'>DEL SPAM</button></a></td>";					

			}else{
				$block .= "<td>".$is_spam."</td>";					
			}				
						
			$block .= "<td>".$row->design_email_id."</td>";					
			
			$block .= "<td>".trim($row->email)."</td>";					
			$block .= "<td>".date("F Y", $row->date_submitted)."</td>";

			$block .= "<td>".$row->obstructions."</td>";					
			$block .= "<td>".$row->comments."</td>";					

			//$block .= "<td>".$row->base_mold_height."</td>";
			//$block .= "<td>".$row->ceiling_height."</td>";

			$block .= "</tr>";	

			$block .= "<tr><td colspan='7'><hr /></td></tr>";

			
		}
		echo $block;
		?>
		</table>
		

</body>
</html>
