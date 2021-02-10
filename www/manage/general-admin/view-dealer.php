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


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>

<body>


<div class="page_title_top_spacer"></div>
<div class="page_title">
View Dealer Application

  	<div class="top_right_link">
  		<a href='dealer-applications.php'>Done</a>
    </div>
</div>

<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">




	
<?php 
$dealer_id = $_GET['dealer_id']; 

//echo $discount_id;

	$sql = "SELECT * FROM dealer_application WHERE dealer_id = '".$dealer_id."' ";
$result = $dbCustom->getResult($db,$sql);	$object = $result->fetch_object();

?>
        	
		<table border="0" cellpadding="6" width="100%">
        <tr>
        <td>Name</td>
        <td><?php echo $object->first_name." ".$object->last_name;   ?></td>
		</tr>        

        <tr>
        <td>Address</td>
        <td><?php echo $object->address." ".$object->city.", ".$object->state." ".$object->zip; ?></td>
		</tr>        

        <tr>
        <td>Phone</td>
        <td><?php echo $object->phone; ?></td>
		</tr>        

        <tr>
        <td>Fax</td>
        <td><?php echo $object->fax; ?></td>
		</tr>        
        <tr>
        <td>E-Mail</td>
        <td><?php echo $object->email; ?></td>
		</tr>        


        <tr>
        <td>Hourly Rate</td>
        <td><?php echo $object->rate; ?></td>
		</tr>        

       <tr>
        <td>Comments</td>
        <td><?php echo $object->comments; ?></td>
		</tr>        

        </table>
        
</div>
</body>
</html>


