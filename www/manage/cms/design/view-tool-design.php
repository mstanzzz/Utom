<?php
if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){ 
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/designitpro'; 
}elseif(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){  
	$real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
}else{
	$real_root = $_SERVER['DOCUMENT_ROOT']; 	
}
require_once($real_root.'/includes/class.dbcustom.php');
$dbCustom = new DbCustom();

require_once($real_root.'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;

$page_title = "Tool Design";
$page_group = "tool-design";
$msg = '';


	
$db = $dbCustom->getDbConnect(SITE_N_DATABASE);


$pagenum = (isset($_GET['pagenum'])) ? $_GET['pagenum'] : 0;
if(!isset($_SESSION['paging']['pagenum'])) $_SESSION['paging']['pagenum'] = $pagenum;

$sortby = (isset($_GET['sortby'])) ? $_GET['sortby'] : 0;
if(!isset($_SESSION['paging']['sortby'])) $_SESSION['paging']['sortby'] = $sortby;

$a_d = (isset($_GET['a_d'])) ? $_GET['a_d'] : 0;
if(!isset($_SESSION['paging']['a_d'])) $_SESSION['paging']['a_d'] = $a_d;

$truncate = (isset($_GET['truncate'])) ? $_GET['truncate'] : 0;
if(!isset($_SESSION['paging']['truncate'])) $_SESSION['paging']['truncate'] = $truncate;

$search_str = isset($_GET['search_string']) ? $_GET['search_string'] : '';

$cart_design_id = (isset($_GET['cart_design_id'])) ? $_GET['cart_design_id'] : 0;
$design_id = (isset($_GET['design_id'])) ? $_GET['design_id'] : 0;
$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : 0;
$file_name = (isset($_GET['file_name'])) ? $_GET['file_name'] : 0;

$customer_name = get_customer_name($user_id);

// We need this local .... is it on Github?

$url = SITEROOT."/API/reports.php?reporttype=1&designid=".$cart_design_id;

// Was working but now moved to /API/
//$url = "https://www.storittek.com/CTGTOOL/reports.php?reporttype=1&designid=".$cart_design_id;


$ch = curl_init($url);

$fp = fopen("parts.xml", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);

curl_setopt($ch, CURLOPT_HEADER, 0);

if(curl_exec($ch) === false)
{
    echo '<br />Curl error: ' . curl_error($ch);
}
else
{
    //echo 'Operation completed without any errors';
}


$xml = '';

$lines = file('parts.xml');

foreach ($lines as $line_num => $line) {
    
	//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
	
	if(strpos($line, '<root>') !== false){
		
		$xml = $line;
		
		break;		
		
	}
	
}

$xml=simplexml_load_string($xml) or die("Error: Cannot create object");

curl_error($ch);

curl_close($ch);

fclose($fp);


$parts_array = array();

$i = 0;
foreach($xml as $k=>$v){

	$r = _xml2array($v);
	
	$parts_array[$i]['PartID'] = $r['PartID'];

	if(!is_array($r['PartNumber'])){
		
		$part_num = $r['PartNumber'];	
	}else{
		$part_num = '';	
	}

	$parts_array[$i]['PartNumber'] = $part_num;
	
	$parts_array[$i]['PartName'] = $r['PartName'];

	$parts_array[$i]['Description'] = $r['Description'];
	
	$parts_array[$i]['MaterialName'] = $r['MaterialName'];
	
	$parts_array[$i]['Quantity'] = $r['Quantity'];

	$i++;
}


require_once($real_root.'/manage/admin-includes/doc_header.php'); 


?>
</head>

<body class="printable_page">
<div class="print_container">
	<?php 
        
	$db = $dbCustom->getDbConnect(COMPONENTS_DATABASE);
    
 

	$url_str = "tool-design-list.php";
	$url_str .= "?pagenum=".$pagenum;
	$url_str .= "&sortby=".$sortby;
	$url_str .= "&a_d=".$a_d;
	$url_str .= "&truncate=".$_SESSION['paging']['truncate'];
	$url_str .= "&search_str=".$search_str;

	?>

	<a href="#" onClick="window.print();return false" class="btn btn-large"><i class="icon-print"></i> Print Page</a><br /><br />
    <a href="<?php echo $url_str; ?>"class="btn btn-large"><i class="icon-arrow-left"></i> Go Back</a><br />
	
    <h1>Design Name: <?php echo stripslashes($file_name);   ?></h1>

	<?php 
	if($customer_name != ''){		
		echo "<h2>Customer: ".$customer_name."</h2>";	
	}
	?>

	

    <hr />


	<div style="float:left; margin-right:30px;">
		<a class="btn btn-large btn-primary"> Reports Type A. </a>
    </div>
    
    
	<div style="float:left; margin-right:30px;">
		<a class="btn btn-large btn-primary"> Reports Type B. </a>
    </div>
    
    
	<div style="float:left; margin-right:30px;">
		<a class="btn btn-large btn-primary"> Reports Type C. </a>
    </div>        

    
	<div style="float:left; margin-right:30px;">
		<a class="btn btn-large btn-primary"> Reports Type D. </a>
    </div>        
    

	<table width="100%" cellpadding="6" cellspacing="0">
		<tr>
            <td><strong>PartID</strong></td>
            <td><strong>PartNumber</strong></td>
            <td><strong>PartName</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Description</strong></td>
            
        </tr>
		<?php 
			$block = '';
			
			foreach($parts_array as $key=>$val){
						
				$block .= "<tr>";
				$block .= "<td>".$val['PartID']."</td>";
				$block .= "<td>".$val['PartNumber']."</td>";
				$block .= "<td>".$val['PartName']."</td>";
				$block .= "<td>".$val['Quantity']."</td>";
				$block .= "<td>".$val['Description']."</td>";
				$block .= "</tr>";
					
			}
			echo $block;
							
			?>
	</table>
</div>



<br /><br /><br /><br /><br /><br />

</body>
</html>





