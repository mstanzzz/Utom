<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 

require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$msg = '';

$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;
$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : '';
$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 'a';
$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 1;

//echo $order_id;

$url_str = 'order-list.php';
$url_str .= "?order_id=".$order_id;
$url_str .= '&pagenum='.$pagenum;
$url_str .= '&sortby='.$sortby;
$url_str .= '&a_d='.$a_d;
$url_str .= '&truncate='.$truncate;


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 

?>
<script language="JavaScript">


</script>
</head>

<body class="lightbox">
<div class='lightboxholder'>
	<form action="<?php echo $url_str; ?>" method="post" enctype="multipart/form-data" target="_top">
    
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />

		<div class='lightboxcontent'>
			<fieldset>
				<legend>Order Processes Completed</legend>
				<label>Check the boxes that apply </label>
                
          		<table cellpadding="10" cellspacing="0">
					<thead>
						<tr>
                        	<th>Order State</th>
							<th>Complete</th>
                            <th>When Set</th>
                        </tr>
					</thead>
                <?php
				
	$db = $dbCustom->getDbConnect(CART_DATABASE);
	
	$sql = "SELECT order_state_id, order_state.name
			FROM order_state";
    $result = $dbCustom->getResult($db,$sql);	
	
	$block = '';
	
	while($row = $result->fetch_object()){						
	
		$sql = "SELECT order_to_order_state_id, when_complete 
				FROM order_to_order_state
				WHERE order_to_order_state.order_state_id = '".$row->order_state_id."' 
				AND order_to_order_state.order_id = '".$order_id."'
				AND order_to_order_state.when_complete > '0'";
		$res = $dbCustom->getResult($db,$sql);
		
		if($res->num_rows > 0){
			$obj = $res->fetch_object();
			$date = date("m/d/Y",$obj->when_complete);	 
			
			
		}else{
			$date = '';
		}
		
	
		$block .= "<td valign='top'>".$row->order_state_id."   ".$row->name."</td>";
		
		$checked = ($res->num_rows > 0)? "checked='checked'" : '';			
						
		$block .= "<td valign='top'>
			<div class='checkboxtoggle on' > 
			<span class='ontext'>Done</span>
			<a class='switch on' href='#'></a>
			<span class='offtext'>Not</span>
			<input type='checkbox' class='checkboxinput' name='done_state[]' value='".$row->order_state_id."' $checked /></div></td>";
			
			$block .= "<td valign='top'>".$date."</td>";
		
		$block .= '</tr>';
	}
						
	$block .= '</table>';	
					
	echo $block;
				
	?>

			<input type="submit" name="process" value="Submit">			
            
			</fieldset>
            
		</div>
	</form>
</div>
</body>
</html>
