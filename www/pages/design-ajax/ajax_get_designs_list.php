<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 										

$level_id = (isset($_GET['level_id'])) ? $_GET['level_id'] : 0;

$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
$sql = "SELECT file_id
			,file_name
			,thumbnailImage
			,locked
			,create_date
			,rev_date			
		FROM designs
		WHERE folder_id = '".$level_id."'
		ORDER BY file_name";
$result = $dbCustom->getResult($db,$sql);
						

$block = '';

$block .= "<table width='100%'>";
$block .= "<tr>";
$block .= "<td width='25%'><span style='font-size:16px;'>Image</span></td>";
$block .= "<td width='25%'><span style='font-size:16px;'>Design Name</span></td>";
$block .= "<td width='20%'><span style='font-size:16px;'>Locked</span></td>";
$block .= "<td width='15%'><span style='font-size:16px;'>Created</span></td>";
$block .= "<td><span style='font-size:16px;'>Revised</td>";
$block .= "<tr>";

while($row = $result->fetch_object()) {

	$block .= "<tr>";
	//$block .= "<td><img src='data:image/jpeg;base64, ".base64_decode($row->thumbnailImage)."'/></td>";
	//$block .= "<td></td>";
	
	$thmb = base64_encode($row->thumbnailImage);
									
	$thmb = base64_decode($thmb);
									
	$block .= "<td><a href='".$_SERVER['DOCUMENT_ROOT']."/app-flex?design=".$row->file_id."'><img src='data:image/png;base64, ".$thmb."'/></a></td>";
	
	
	//$block .= "<td><a href='".$_SERVER['DOCUMENT_ROOT']."/app-flex?design=".$row->file_id."'>".$row->file_name."</a></td>";
	$block .= "<td><a href='".$_SERVER['DOCUMENT_ROOT']."/app-flex?design=".$row->file_id."'>".$row->file_name."</a></td>";
	
	
	if($row->locked){
		$block .= "<td>Yes</td>";
	}else{
		$block .= "<td>No</td>";
	}
	
	$block .= "<td>".date("m/d/Y", strtotime($row->create_date))."</td>";
	
	if($row->rev_date != '0000-00-00 00:00:00'){
		$block .= "<td>".date("m/d/Y", strtotime($row->rev_date))."</td>";
	}else{
		$block .= "<td>none</td>";
		
	}

	$block .= "<tr>";

}
$block .= "</table>";

echo $block;

?>

<span style=""
