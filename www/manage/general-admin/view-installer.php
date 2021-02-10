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

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>

<body>


<div class="page_title_top_spacer"></div>
<div class="page_title">
View Installer Application

  	<div class="top_right_link">
  		<a href='installer-applications.php'>Done</a>
    </div>
</div>

<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">




	
<?php 
$installer_id = $_GET['installer_id']; 

//echo $discount_id;

	$sql = "SELECT * FROM installer_application WHERE installer_id = '".$installer_id."' ";
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
        <td>License</td>
        <td><?php echo $object->license; ?></td>
		</tr>        

        <tr>
        <td>Insurance Company</td>
        <td><?php echo $object->insurance_name; ?></td>
		</tr>        

       <tr>
        <td>Insurance Policy Number</td>
        <td><?php echo $object->insurance_policy_num; ?></td>
		</tr>        

        <tr>
        <td>Liability/Bond Amount</td>
        <td><?php echo $object->bonded_amount; ?></td>
		</tr>        

        <tr>
        <td>Company Type</td>
        <td><?php echo $object->company_type; ?></td>
		</tr>        

        <tr>
        <td>Years In Business</td>
        <td><?php echo $object->years_in_bus; ?></td>
		</tr>        
        <tr>
        <td>Gross Annual Revenue</td>
        <td><?php echo $object->gross_rev; ?></td>
		</tr>        

       <tr>
        <td>Federal Tax Id</td>
        <td><?php echo $object->fed_tax_id; ?></td>
		</tr>        
       <tr>
        <td>State Tax Id</td>
        <td><?php echo $object->state_tax_id; ?></td>
		</tr>        

       <tr>
        <td>Bank Name</td>
        <td><?php echo $object->bank_name; ?></td>
		</tr>        


       <tr>
        <td>Comments</td>
        <td><?php echo $object->comments; ?></td>
		</tr>        

        </table>
        
</div>
</body>
</html>



