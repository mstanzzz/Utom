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


if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 

$progress = new SetupProgress;
$module = new Module;

$page_title = 'View User';
$page_group = 'customer';

	



require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>


<script>

</script>



</head>

<body>
<div class="manage_page_container">
		<div class="manage_side_nav">
			<?php 
		//the side navigation portion of the template
        require_once($real_root.'/manage/admin-includes/manage-side-nav.php');
        ?>
		</div>
		<div class="manage_main"> 
<br />
<br />
<div style="margin-left:10%;">
<a href="customer-landing.php" class="btn btn-primary btn-large">Back</a>
</div>
<br /><br />
<table width="100%">
<tr>
<td width="20%">Operating System</td>
<td width="20%">Browser</td>
<td>IP Address</td>
<td>Location</td>
</tr>        
<?php







$db = $dbCustom->getDbConnect(USER_DATABASE);

$sql = "SELECT os, browser, ip FROM snif_user";
$result = $dbCustom->getResult($db,$sql);


while($row = $result->fetch_object()){
	
	
	$location = '';
	
	echo "<tr><td>".$row->os."</td><td>".$row->browser."</td><td>".$row->ip."</td><td>".$location."</td></tr>";	
	
	
}

?>

</table>
			<!-- end main content area --> 
		</div>
		<p class="clear"></p>
	<?php 



$row = 1;
if (($handle = fopen("GeoLiteCity-Location.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}




	//the footer portion of the template
	require_once($real_root.'/manage/admin-includes/manage-footer.php');
?>
</div>
</body>
</html>
