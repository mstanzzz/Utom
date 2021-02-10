<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Edit Order";
$page_group = "order";




$sortby = (isset($_GET['sortby'])) ? trim($_GET['sortby']) : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;

$s_profile_account_id = (isset($_GET['s_profile_account_id'])) ? $_GET['s_profile_account_id'] : $_SESSION['profile_account_id'];


function getLineItemArray($order_id){
	
	$ret = array();
	$dbCustom = new DbCustom();	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT item_id
				,name
				,qty	
			FROM order_line_item
			WHERE order_id = '".$order_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$i = 0;
	while($row = $result->fetch_object()){
		
		//echo $row->price_calc_param_name;
		//echo "<br />";
		
		$ret[$i]['item_id'] = $row->item_id;
		$ret[$i]['name'] = $row->name;
		$ret[$i]['qty'] = $row->qty; 
		
		$i++;
	}
	return $ret;
}



if(isset($_POST['edit_line_item'])){
		
	$qty = trim($_POST['qty']);
	if(!is_numeric($qty) || $qty < 0) $qty = 1;
	
	$index = $_POST['index'];
	$_SESSION['temp_order_fields']['line_item_array'][$index]['qty'] = $qty;

}


if(isset($_POST['add_line_item'])){
	
	$qty = trim($_POST['qty']);
	if(!is_numeric($qty) || $qty < 0) $qty = 1;	
	
	$pa = explode('|',$_POST['item_id']); 
	
	if(isset($pa[1])){
		$i = count($_SESSION['temp_order_fields']['line_item_array']);
		
		$_SESSION['temp_order_fields']['line_item_array'][$i]['item_id'] = $pa[0];
		$_SESSION['temp_order_fields']['line_item_array'][$i]['name'] = $pa[1];
		$_SESSION['temp_order_fields']['line_item_array'][$i]['qty'] = $qty;
	}
	
	
}


if(isset($_POST['del_line_item'])){

	$temp_array = array();
	$i = 0;
	foreach($_SESSION['temp_order_fields']['line_item_array'] as $v){
		if($v['item_id'] != $_POST['del_item_id']){
			$temp_array[$i]['item_id'] = $v['item_id'];	
			$temp_array[$i]['name'] = $v['name'];
			$temp_array[$i]['qty'] = $v['qty'];
			$i++;
		}
	}
	$_SESSION['temp_order_fields']['line_item_array'] = $temp_array;
	unset($temp_array);
	
}


if(!isset($_SESSION['temp_order_fields'])){

	$_SESSION['temp_order_fields']['order_id'] = isset($_GET['order_id']) ? $_GET['order_id'] : 0; 
	
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	$sql = "SELECT *
		FROM ctg_order
		WHERE order_id = '".$_SESSION['temp_order_fields']['order_id']."'";
    $result = $dbCustom->getResult($db,$sql);
	if($result->num_rows > 0){
       	$object = $result->fetch_object();
	
	
		$_SESSION['temp_order_fields']['order_date'] = $object->order_date;
		$_SESSION['temp_order_fields']['shipping_name'] = $object->shipping_name;
		$_SESSION['temp_order_fields']['shipping_name_company'] = $object->shipping_name_company;
		$_SESSION['temp_order_fields']['shipping_address_one'] = $object->shipping_address_one;
		$_SESSION['temp_order_fields']['shipping_address_two'] = $object->shipping_address_two;
		$_SESSION['temp_order_fields']['shipping_city'] = $object->shipping_city;
		$_SESSION['temp_order_fields']['shipping_state'] = $object->shipping_state;
		$_SESSION['temp_order_fields']['shipping_zip'] = $object->shipping_zip;
		$_SESSION['temp_order_fields']['shipping_country'] = $object->shipping_country;
		$_SESSION['temp_order_fields']['shipping_phone'] = $object->shipping_phone;
		$_SESSION['temp_order_fields']['shipping_email'] = $object->shipping_email;
		$_SESSION['temp_order_fields']['billing_name'] = $object->billing_name;
		$_SESSION['temp_order_fields']['billing_email'] = $object->billing_email;
		$_SESSION['temp_order_fields']['billing_address_one'] = $object->billing_address_one;
		$_SESSION['temp_order_fields']['billing_address_two'] = $object->billing_address_two;
		$_SESSION['temp_order_fields']['billing_city'] = $object->billing_city;
		$_SESSION['temp_order_fields']['billing_state'] = $object->billing_state;
		$_SESSION['temp_order_fields']['billing_zip'] = $object->billing_zip;
		$_SESSION['temp_order_fields']['billing_country'] = $object->billing_country;
		$_SESSION['temp_order_fields']['billing_phone'] = $object->billing_phone;
		$_SESSION['temp_order_fields']['in_house_product_descr'] = $object->in_house_product_descr;
		$_SESSION['temp_order_fields']['sub_total'] = $object->sub_total;		
		$_SESSION['temp_order_fields']['shipping_cost'] = $object->shipping_cost;
		$_SESSION['temp_order_fields']['tax_cost'] = $object->tax_cost;
		$_SESSION['temp_order_fields']['customer_id'] = $object->customer_id;
		
		$_SESSION['temp_order_fields']['order_type'] = $object->order_type;
		
	

		$_SESSION['temp_order_fields']['line_item_array']  = getLineItemArray($_SESSION['temp_order_fields']['order_id']);

	
	}else{
		echo "Order Not Found";
		exit;	
	}
	
	

}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 
?>

<script>

$(document).ready(function() {
	$("#datepicker1").datepicker();
	//$("#datepicker2").datepicker();
	
	$(".confirm").click(function(e){
		save_session();
	});
	
	/*
	$('#clear_dates').click(function() {
		$('#datepicker1').val('');
		$('#datepicker2').val('');
	});
	*/
	
	$("#customer_id").change(function() {

		var customer_id = $(this).val();
		
		//alert(customer_id);
		
		$.ajaxSetup({ cache: false}); 
		$.ajax({
			url: '../ajax-get-cust-data.php?customer_id='+customer_id,
			dataType: "json"
		}).done(function(data) {
			
			$("#shipping_name").val(data.shipping_name_first+" "+data.shipping_name_last);
			$("#shipping_address_one").val(data.shipping_address_one);
			$("#shipping_address_two").val(data.shipping_address_two);
			$("#shipping_city").val(data.shipping_city);
			$("#shipping_state").val(data.shipping_state);
			$("#shipping_zip").val(data.shipping_zip);
			$("#shipping_country").val(data.shipping_country);
			$("#shipping_phone").val(data.shipping_phone);

			$("#billing_name").val(data.billing_name_first+" "+data.billing_name_last);
			$("#billing_address_one").val(data.billing_address_one);
			$("#billing_address_two").val(data.billing_address_two);
			$("#billing_city").val(data.billing_city);
			$("#billing_state").val(data.billing_state);
			$("#billing_zip").val(data.billing_zip);
			$("#billing_country").val(data.billing_country);
			$("#billing_phone").val(data.billing_phone);
			$("#billing_email").val(data.username);
			
		
		}).fail(function(jqXHR, textStatus) {
			console.log( "Request failed: " + textStatus );
		});
		
		
		/*
		$.ajaxSetup({ cache: false}); 
		$.ajax({
		  url: '../ajax-get-cust-data.php?customer_id='+customer_id,
		  success: function(data) {
			alert(data);
		  }
		});
		*/	
			
		
		

	});

});

function save_session(){	

	var q_str = "?action=ao"+get_query_str();
	$.ajaxSetup({ cache: false}); 
	$.ajax({
	  url: '../ajax_set_temp_order_session.php'+q_str,
	  success: function(data) {
			//alert(data);
	  }
	});

}

	
function get_query_str(){
		
	var query_str = '';
	
	query_str += "&order_date="+$("#datepicker1").val();
	query_str += "&shipping_name="+$("#shipping_name").val();
	query_str += "&shipping_name_company="+$("#shipping_name_company").val();
	query_str += "&shipping_address_one="+$("#shipping_address_one").val();
	query_str += "&shipping_address_two="+$("#shipping_address_two").val();
	query_str += "&shipping_city="+$("#shipping_city").val();
	query_str += "&shipping_state="+$("#shipping_state").val();
	query_str += "&shipping_zip="+$("#shipping_zip").val();
	query_str += "&shipping_country="+$("#shipping_country").val();
	query_str += "&shipping_phone="+$("#shipping_phone").val();
	query_str += "&shipping_email="+$("#shipping_email").val();
	query_str += "&billing_name="+$("#billing_name").val();
	query_str += "&billing_email="+$("#billing_email").val();
	query_str += "&billing_address_one="+$("#billing_address_one").val();
	query_str += "&billing_address_two="+$("#billing_address_two").val();
	query_str += "&billing_city="+$("#billing_city").val();	
	query_str += "&billing_state="+$("#billing_state").val();
	query_str += "&billing_zip="+$("#billing_zip").val();
	query_str += "&billing_country="+$("#billing_country").val();
	query_str += "&billing_phone="+$("#billing_phone").val();
	query_str += "&in_house_product_descr="+$("#in_house_product_descr").val();
	
	query_str += "&customer_id="+$("#customer_id").val();
	
	query_str += "&sub_total="+$("#sub_total").val();

	query_str += "&shipping_cost="+$("#shipping_cost").val();
	query_str += "&tax_cost="+$("#tax_cost").val();
	
	return query_str;
}





function validate(){

	document.edit_order_form.submit();	

}


function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;   
}
/*
 */
</script>
</head>

<body>

<div class="manage_page_container">
	<div class="manage_side_nav">
		<?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
		

        ?>
	</div>
	<div class="manage_main">

	<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		echo $bread_crumb->output();

		echo "<div class='manage_main_page_title'>".$page_title."</div>";
	
		$url_str = "order-list.php";
		$url_str .= "?pagenum=".$pagenum;
		$url_str .= "&sortby=".$sortby;
		$url_str .= "&a_d=".$a_d;
		$url_str .= "&truncate=0";
		$url_str .= "&s_profile_account_id=".$s_profile_account_id;
	
	
	?>	





    <form  name="edit_order_form" action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data">

		<input type="hidden" name="edit_order" value="1">
        
        <input type="hidden" name="order_id" value="<?php echo $_SESSION['temp_order_fields']['order_id']; ?>">
        
        
        <div class="page_actions edit_page"> 
				<a onClick="validate()" class="btn btn-success btn-large"><i class="icon-ok icon-white"></i> Save Order </a>
                <a href="<?php echo $url_str; ?>" class="btn"><i class="icon-arrow-left"></i> Cancel &amp; Go Back</a>
                
		</div>                
        
        <?php		
		//$oDate = new DateTime($_SESSION['temp_order_fields']['order_date']);
		//$order_date = $oDate->format("m/d/y");
		
		if(is_numeric($_SESSION['temp_order_fields']['order_date'])){		
			$order_date = date('m/d/Y',$_SESSION['temp_order_fields']['order_date']);
		}else{
			$order_date = $_SESSION['temp_order_fields']['order_date'];			
		}
		
		
		?>
        
		<fieldset class="edit_content">
		<legend>Customer Information</legend>
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Order Date</label>
				</div>
				<div class="twocols">                        
					<input id="datepicker1" type="text" name="order_date" value="<?php echo $order_date; ?>" style='width:120px;'/>
				</div>
			</div>
            

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Order Type</label>
				</div>
				<div class="twocols">
				<?php
				echo $_SESSION['temp_order_fields']['order_type'];
                
                if($_SESSION['temp_order_fields']['order_type'] == "manual" || $_SESSION['temp_order_fields']['order_type'] == 'legacy'){
					
					$db = $dbCustom->getDbConnect(CART_DATABASE);
					$sql = "SELECT sent_email_feedback_id
					FROM sent_email_feedback
					WHERE order_id = '".$_SESSION['temp_order_fields']['order_id']."'";
					
					$res = $dbCustom->getResult($db,$sql);
					if($res->num_rows == 0){

						echo "<br />Since this is a manually entered order or copied from the old site, to get a customer review, 
						you must <a href='".SITEROOT."/manage/customer/send-review-request-for-manual-orders.php?order_id=".$_SESSION['temp_order_fields']['order_id']."' 
						target='_blank' style='text-decoration: underline;'>click here</a> to send the request via email.";
					}
                }
                ?>
                </div>
			</div>


   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Select Customer</label>
                    Do this first. It will automatically fill the form with customer data.
				</div>
				<div class="twocols">
                 
				 <select name="customer_id" id="customer_id">
                 <option value="0"> Select Customer</option>
				 <?php 
				 	$db = $dbCustom->getDbConnect(USER_DATABASE);                      
					$sql = "SELECT id, name
						FROM  user
						WHERE profile_account_id = '".$s_profile_account_id."'
						AND user_type_id < '7'
						ORDER BY name";
					$result = $dbCustom->getResult($db,$sql);
					$block = '';
					while($row = $result->fetch_object()){
						
						$sel = ($row->id == $_SESSION['temp_order_fields']['customer_id']) ? "selected" : '';
						
						$block .= "<option value='".$row->id."' $sel>".$row->name."</option>";
					}
					
					echo $block;
                 ?>
                 </select>                   
                </div>
                
                
			</div>
                        
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Name</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_name" name="shipping_name" value="<?php echo $_SESSION['temp_order_fields']['shipping_name']; ?>"/>                      
                </div>
			</div>
            
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Name Company</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_name_company" name="shipping_name_company" value="<?php echo $_SESSION['temp_order_fields']['shipping_name_company']; ?>" />                      
                </div>
			</div>
                    
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Address 1</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_address_one" name="shipping_address_one" value="<?php echo $_SESSION['temp_order_fields']['shipping_address_one']; ?>" />                      
                </div>
			</div>
                       
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Address 2</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_address_two" name="shipping_address_two" value="<?php echo $_SESSION['temp_order_fields']['shipping_address_two']; ?>" />                      
                </div>
			</div>

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping City</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_city" name="shipping_city" value="<?php echo $_SESSION['temp_order_fields']['shipping_city']; ?>" />                      
                </div>
			</div>
                             
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping State</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_state" name="shipping_state" value="<?php echo $_SESSION['temp_order_fields']['shipping_state']; ?>" />                      
                </div>
			</div>
                       
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Zip</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_zip" name="shipping_zip" value="<?php echo $_SESSION['temp_order_fields']['shipping_zip']; ?>" />                      
                </div>
			</div> 
                                   
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Country</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_country" name="shipping_country" value="<?php echo $_SESSION['temp_order_fields']['shipping_country']; ?>" />                      
                </div>
			</div> 
           
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Phone</label>
				</div>
				<div class="twocols">        
					<input type="text" id="shipping_phone" name="shipping_phone" value="<?php echo $_SESSION['temp_order_fields']['shipping_phone']; ?>" />                      
                </div>
			</div>             			
           
                       
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Name</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_name" name="billing_name" value="<?php echo $_SESSION['temp_order_fields']['billing_name']; ?>" />                      
                </div>
			</div>             			
                        
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Email</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_email" name="billing_email" value="<?php echo $_SESSION['temp_order_fields']['billing_email']; ?>" />                      
                </div>
			</div>          
						       			                    
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Address 1</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_address_one" name="billing_address_one" value="<?php echo $_SESSION['temp_order_fields']['billing_address_one']; ?>" />                      
                </div>
			</div>      
                        
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Address 2</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_address_two" name="billing_address_two" value="<?php echo $_SESSION['temp_order_fields']['billing_address_two']; ?>" />                      
                </div>
			</div>      
                        
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing City</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_city" name="billing_city" value="<?php echo $_SESSION['temp_order_fields']['billing_city']; ?>" />                      
                </div>
			</div>      

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing State</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_state" name="billing_state" value="<?php echo $_SESSION['temp_order_fields']['billing_state']; ?>" />                      
                </div>
			</div>      

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Zip</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_zip" name="billing_zip" value="<?php echo $_SESSION['temp_order_fields']['billing_zip']; ?>" />                      
                </div>
			</div>      

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Country</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_country" name="billing_country" value="<?php echo $_SESSION['temp_order_fields']['billing_country']; ?>" />                      
                </div>
			</div>      
                        
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Billing Phone</label>
				</div>
				<div class="twocols">        
					<input type="text" id="billing_phone" name="billing_phone" value="<?php echo $_SESSION['temp_order_fields']['billing_phone']; ?>" />                      
                </div>
			</div>      
		</fieldset>

		<fieldset class="edit_content">		  
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Description of order product</label>
                    Use this for in-house manufactured products 
				</div>
				<div class="twocols">
                    <textarea id="in_house_product_descr" name="in_house_product_descr"><?php echo $_SESSION['temp_order_fields']['in_house_product_descr']; ?></textarea>
				</div>
           </div>

			<div class="colcontainer formcols">
                <div class="twocols">
                	<label>Line Items (Cart Type Products)</label>
                </div>
                    <div class="twocols">
                        <a class="btn btn-large btn-primary confirm confirm-add" href="#"><i class="icon-plus icon-white"></i> Add a New Line Item </a>
                        <br />
                        <table width="100%" cellpadding="10">
                        <?php
							if(count($_SESSION['temp_order_fields']['line_item_array']) > 0){
							
								
								$block = "<tr><td width='40%'>Product</td><td>QTY</td><td></td><td></td></tr>"; 
								
								$i = 0;
								
								foreach($_SESSION['temp_order_fields']['line_item_array'] as $v){
									
									$block .= "<tr><td>".$v['name']."</td>";
									
									$block .= "<td>".$v['qty']."</td>";
									
									
									$block .= "<td><a class='btn btn-primary confirm confirm-edit'><i class='icon-cog icon-white'></i>Edit Order
										<input type='hidden' class='itemId' id='".$i."' value='".$i."' />
										<input type='hidden' class='contentToEdit' id='".$v['qty']."' value='".$v['qty']."' />
										</a></td>";
									
									$block .= "<td><a class='btn btn-danger confirm confirm-delete'><i class='icon-remove icon-white'></i>
										<input type='hidden' id='".$v['item_id']."' class='itemId' value='".$v['item_id']."' />										
										</a></td></tr>";
									$i++;		
								}
								
								echo $block;
							}
						?>
                        </table>
            	</div>
			</div>
               

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Amount Charged (without shipping)</label> 
				</div>
				<div class="twocols">
                    <input type="text" id="sub_total" name="sub_total" value="<?php echo $_SESSION['temp_order_fields']['sub_total']; ?>"  >
				</div>
           </div>


   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Shipping Amount</label> 
				</div>
				<div class="twocols">
                    <input type="text" id="shipping_cost" name="shipping_cost" value="<?php echo $_SESSION['temp_order_fields']['shipping_cost']; ?>"  >
				</div>
           </div>

   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Tax Amount</label> 
				</div>
				<div class="twocols">
                    <input type="text" id="tax_cost" name="tax_cost" value="<?php echo $_SESSION['temp_order_fields']['tax_cost']; ?>"  >
				</div>
           </div>


			<!--
   			<div class="colcontainer formcols">
				<div class="twocols">
					<label>Order State</label> 
				</div>
				<div class="twocols">
                
                
		              <?php
					  /* 
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							
							$block = '';
							$block .= "<select id='order_state_id' name='order_state_id' data-placeholder='Select an order state' style='width:210px;'  >";
							$block .= "<option value='0'>Select</option";
							$sql = "SELECT order_state_id, name
									FROM order_state 
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
							$result = $dbCustom->getResult($db,$sql);
							while($row = $result->fetch_object()) {
																
								$sel = ($row->order_state_id == $_SESSION['temp_order_fields']['order_state_id']) ? "selected" : '';								
																
								$block .= "<option value='".$row->order_state_id."' $sel>".$row->name."</option>";
							}
							$block .= "</select>";
							echo $block;
					*/
							?>  
                </select>
                
                
                </div>
           </div>
			-->

		</fieldset>
    

    </form>
 
    </div>

	<p class="clear"></p>
     
</div>
    	<br /><br /><br />
    	<br /><br /><br />


<?php

$url_str = "add-order.php";
$url_str .= "?pagenum=".$pagenum;
$url_str .= "&sortby=".$sortby;
$url_str .= "&a_d=".$a_d;
$url_str .= "&truncate=".$truncate;
$url_str .= "&s_profile_account_id=".$s_profile_account_id;



?>



<div id="content-add" class="confirm-content">
	<form name="add_line_item" action="<?php echo $url_str; ?>" method="post" target="_top">
	<fieldset class="colcontainer">
				
		<label>Choose Line Item</label>
				
		              <?php 
							$db = $dbCustom->getDbConnect(CART_DATABASE);
							
							$block = '';
							$block .= "<select id='item_id' name='item_id' data-placeholder='Select an item' style='width:210px;'  >";
							
							$sql = "SELECT item_id, name
									FROM item 
									WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
							$result = $dbCustom->getResult($db,$sql);
							while($row = $result->fetch_object()) {
																
								$block .= "<option value='".$row->item_id."|".stripslashes($row->name)."'>".stripslashes($row->name)."</option>";
							}
							$block .= "</select>";
							echo $block;
							
							?>  
                </select>
                
                <br /><br />
                
                QTY<br />
				<input type="text" name="qty" value="1">
            
            
	</fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="add_line_item" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Add </button>
	</form>
</div>




<div id="content-edit" class="confirm-content">
        <form name="edit_item_form" action="<?php echo $url_str; ?>" method="post" target="_top">
			<fieldset class="colcontainer">
				<label>Edit Line Item </label>
 
                Qty<br />
				<input type="text" class="contentToEdit" name="qty">
            
            	 <input id="index" class="itemId" type="hidden" name="index" />
            
            </fieldset>
			<a class="btn btn-large dismiss"> Cancel </a>
			<button name="edit_line_item" type="submit" class="btn btn-large btn-success"><i class="icon-ok icon-white"></i> Save </button>
		</form>
	</div>


    
	<div id="content-delete" class="confirm-content">
        <h3>Are you sure you want to remove this Line Item?</h3>
        <form name="del_item_form" action="<?php echo $url_str; ?>" method="post" target="_top">
            <input id="del_item_id" class="itemId" type="hidden" name="del_item_id" value='' />
            <a class="btn btn-large dismiss">No, Cancel</a>
            <button class="btn btn-danger btn-large" name="del_line_item" type="submit" >Yes, Delete</button>
        </form>
    </div>    






</body>
</html>



