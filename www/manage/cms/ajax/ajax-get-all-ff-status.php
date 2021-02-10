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

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

$order_id = (isset($_GET['order_id'])) ? $_GET['order_id'] : 0;   

$db = $dbCustom->getDbConnect(CART_DATABASE);

$sql =  sprintf("SELECT item_id
					,design_id
					,name
		FROM  order_line_item
		WHERE order_id = %u", $order_id);

$result = $dbCustom->getResult($db,$sql);
if($result->num_rows > 0){

	$object = $result->fetch_object();	
	$item_id = $object->item_id;
	$design_id = $object->design_id;
	$name = $object->name;
}else{
	$item_id = 0;
	$design_id = 0;
	$name = '';	
	
}


?>
 
 
 
 
 
        <div class="modal-table-row">
            <div class="modal-table-cell">
                <span class="btn-default btn-bold text-capitalize with-bottom-shadow">Item # 1</span>		
            </div>
            <div class="modal-table-cell-spacer">&nbsp;</div>
            <div class="modal-table-cell">
                <span class="order-status  btn-default btn-bold text-capitalize with-bottom-shadow">
                    9. Order received
                    <button class="btn-light-green btn-bold text-capitalize with-bottom-shadow">view</button>
                </span>
            </div>
        </div>
        <div class="modal-table-row">
            <div class="modal-table-cell">
                <span class="btn-default btn-bold text-capitalize with-bottom-shadow">Item # 2</span>		
            </div>
            <div class="modal-table-cell-spacer">&nbsp;</div>
            <div class="modal-table-cell">
                <span class="order-status  btn-default btn-bold text-capitalize with-bottom-shadow">
                    9. Order received
                    <button class="btn-light-green btn-bold text-capitalize with-bottom-shadow">view</button>
                </span>
            </div>
        </div>
        <div class="modal-table-row">
            <div class="modal-table-cell">
                <span class="btn-default btn-bold text-capitalize with-bottom-shadow">Item # 3</span>		
            </div>
            <div class="modal-table-cell-spacer">&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div class="modal-table-cell">
                <span class="order-status  btn-default btn-bold text-capitalize with-bottom-shadow">
                    9. Order received
                    <button class="btn-light-green btn-bold text-capitalize with-bottom-shadow">view</button>
                </span>
            </div>
        </div>
        <div style="clear:both;"></div>




