<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-includes.php');

$progress = new SetupProgress;
$module = new Module;



$page_title = "ship credentials";
$page_group = "ship";

	

$db = $dbCustom->getDbConnect(CART_DATABASE);

//$sas_cust_id =  (isset($_REQUEST['sas_cust_id'])) ? $_REQUEST['sas_cust_id'] : 0;

$msg = '';

if(isset($_POST["update_credentials"])){
	
	$ship_credentials_id = $_POST["ship_credentials_id"];
	$ups_access = trim($_POST["ups_access"]);
	$ups_user = trim($_POST["ups_user"]);
	$ups_pass = trim($_POST["ups_pass"]);
	$ups_account = trim($_POST["ups_account"]);
	$usps_user = trim($_POST["usps_user"]);
	$fedex_account = trim($_POST["fedex_account"]);
	$fedex_meter = trim($_POST["fedex_meter"]);
	$from_zip = trim($_POST["from_zip"]);
	$from_state = trim($_POST["from_state"]);
	$from_country = trim($_POST["from_country"]);
	$action = $_POST["action"];
	
	if($action == "insert"){
		
		$sql = sprintf("INSERT INTO ship_credentials
		(
			ups_access
			,ups_user
			,ups_pass
			,ups_account
			,usps_user
			,fedex_account
			,fedex_meter
			,from_zip
			,from_state
			,from_country
			,profile_account_id
		)VALUES(
			'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%s'
			,'%u'
		)",
		$ups_access
		,$ups_user
		,$ups_pass
		,$ups_account
		,$usps_user
		,$fedex_account
		,$fedex_meter
		,$from_zip
		,$from_state
		,$from_country
		,$_SESSION['profile_account_id']
		);
$result = $dbCustom->getResult($db,$sql);		
		
		
	}else{

		$sql = sprintf("UPDATE ship_credentials SET
					ups_access = '%s'
					,ups_user = '%s'
					,ups_pass = '%s'
					,ups_account = '%s'
					,usps_user = '%s'
					,fedex_account = '%s'
					,fedex_meter = '%s'
					,from_zip = '%s'
					,from_state = '%s'
					,from_country = '%s'
					WHERE ship_credentials_id = '%u'",
					$ups_access
					,$ups_user
					,$ups_pass
					,$ups_account
					,$usps_user
					,$fedex_account
					,$fedex_meter
					,$from_zip
					,$from_state
					,$from_country
					,$ship_credentials_id
					);
$result = $dbCustom->getResult($db,$sql);		
	}

	
}


require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/doc_header.php'); 


?>
</head>
<body>
<?php 

	require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-header.php');
	//require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-top-nav.php');
?>
<div class="manage_page_container">
  <div class="manage_side_nav">
    <?php 
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-side-nav.php');
        ?>
  </div>
  <!--
   	<div class="top_link">
	    <a class='inline' href='#add'>Add option</a><br>
    </div>
	-->
  <div class="manage_main">
    <?php 
	
		require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/class.admin_bread_crumb.php");	
		$bread_crumb = new AdminBreadCrumb;
		$bread_crumb->prune("Shiping Credentials");
		$bread_crumb->add("Shiping Credentials", $ste_root."manage/ecomsettings/ship-credentials.php");
		
		echo $bread_crumb->output();
		
        require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-content-top.php');
        
		//shipping section tabbed sub-navigation
        require_once($_SERVER['DOCUMENT_ROOT']."/manage/admin-includes/shipping-section-tabs.php");
	
//echo $_SESSION['profile_account_id'];
        
        echo "<div class='manage_main_page_title'>".$page_title." </div>";
     

		$db = $dbCustom->getDbConnect(CART_DATABASE);
		$sql = "SELECT * FROM ship_credentials 
				WHERE profile_account_id = '".$_SESSION['profile_account_id']."'";
$result = $dbCustom->getResult($db,$sql);		
		if($result->num_rows > 0){
			$action = "update";
			$object = $result->fetch_object();
			$ship_credentials_id = $object->ship_credentials_id;
			$ups_access = $object->ups_access;
			$ups_user = $object->ups_user;
			$ups_pass = $object->ups_pass;
			$ups_account = $object->ups_account;
			$usps_user = $object->usps_user;
			$fedex_account = $object->fedex_account;
			$fedex_meter = $object->fedex_meter;
			$from_zip = $object->from_zip;
			$from_state = $object->from_state;
			$from_country = $object->from_country;
		}else{
			$action = "insert";
			$ship_credentials_id = '';
			$ups_access = '';
			$ups_user = '';
			$ups_pass = '';
			$ups_account = '';
			$usps_user = '';
			$fedex_account = '';
			$fedex_meter = '';
			$from_zip = '';
			$from_state = '';
			$from_country = '';
		}

?>
    <div class="dashboard_container_pages">
    
        <form name="update_credentials_form" action="ship-credentials.php" method="post">
          <input type="hidden" name="ship_credentials_id" value="<?php echo $ship_credentials_id; ?>" />
          <input type="hidden" name="action" value="<?php echo $action; ?>" />
           <div class="inner_container"> <div class="page_content">
            <table border="0" cellpadding="5" cellspacing="0" width="500px" align="center">
              <tr>
                <td width="150px"> ups_access </td>
                <td><input type="text" name="ups_access" value="<?php echo $ups_access; ?>" /></td>
              </tr>
              <tr>
                <td width="150px"> ups_user</td>
                <td><input type="text" name="ups_user" value="<?php echo $ups_user; ?>" /></td>
              </tr>
              <tr>
                <td width="150px"> ups_pass</td>
                <td><input type="text" name="ups_pass" value="<?php echo $ups_pass; ?>" /></td>
              </tr>
              <tr>
                <td width="150px"> ups_account</td>
                <td><input type="text" name="ups_account" value="<?php echo $ups_account; ?>" /></td>
              </tr>
              <tr>
                <td width="150px"> usps_user </td>
                <td><input type="text" name="usps_user" value="<?php echo $usps_user; ?>" /></td>
              </tr>
              <tr>
                <td width="150px">fedex_account</td>
                <td><input type="text" name="fedex_account" value="<?php echo $fedex_account; ?>" /></td>
              </tr>
              <tr>
                <td width="150px">fedex_meter</td>
                <td><input type="text" name="fedex_meter" value="<?php echo $fedex_meter; ?>" /></td>
              </tr>
              <tr>
                <td width="150px">from_zip</td>
                <td><input type="text" name="from_zip" value="<?php echo $from_zip; ?>" /></td>
              </tr>
              <tr>
                <td width="150px">from_state </td>
                <td><select name="from_state">
                    <?php 
                $db = $dbCustom->getDbConnect(SITE_N_DATABASE);
                $sql = "SELECT state, state_abr FROM states 
						WHERE hide = '0' 
						AND profile_account_id = '".$_SESSION['profile_account_id']."'
						ORDER BY country DESC, state"; 
                $result = $dbCustom->getResult($db,$sql);                //
                 $block = '';
	             $block .= "<option value=''>----select----</option>";			 
                 while($row = $result->fetch_object()) {
                    $sel =  ($from_state == $row->state_abr) ? "selected" : '';	
                    $block .= "<option value='".$row->state_abr."' $sel >$row->state</option>";
                 }
                echo $block;
		?>
                  </select></td>
              </tr>
              <tr>
                <td width="150px">from_country</td>
                <td><input type="text" name="from_country" value="<?php echo $from_country; ?>" /></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="update_credentials" value="Submit" /></td>
              </tr>
            </table>
          </div> </div>
        </form>
     
    </div>

</div>
<p class="clear"></p>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/manage/admin-includes/manage-footer.php');
    ?>
</body>
</html>

