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

<script>

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	plugins : "safari",	
	content_css : "../css/mce.css"
});

</script>
</head>
<body>

<div class="page_title_top_spacer"></div>
<div class="page_title">
Edit Feedback
</div>
<div class="horizontal_bar"></div>
<div class="horizontal_bar_bottom_spacer"></div>
<div class="page_container">

	
<?php 
// feed back is a type of testimonial
$testimonial_id = $_GET['testimonial_id']; 
//echo $testimonial_id;
$sql = sprintf("SELECT * FROM testimonial 
				WHERE testimonial_id = '%u'
				AND profile_account_id = '%u'", $testimonial_id, $_SESSION['profile_account_id']);
$result = $dbCustom->getResult($db,$sql);$object = $result->fetch_object();

?>
    
        <form name="edit_feedback" action="feedback.php" method="post">
       	<input id="testimonial_id" type="hidden" name="testimonial_id" value="<?php echo $testimonial_id;  ?>" />
        	
		<table border="0" cellpadding="8">
        <tr>
        <td><div class="head">Name</div><input type="text" name="name" value="<?php echo stripslashes($object->name); ?>" maxlength="160" size="30" /></td>
        <td>Email Address<br /><input type="text" name="email" value="<?php echo $object->email; ?>" maxlength="160" size="30"  /></td>
        <td>City State<br /><input type="text" name="city_state" value="<?php echo stripslashes($object->city_state); ?>" maxlength="160" size="30" /></td>
        </tr>
        <tr>
        <td colspan="3">
        <div class="head">Feedback</div>
        <textarea  name="content" rows="2" cols="80" style="width: 700px; height:200px;"><?php echo $object->content; ?></textarea>
		</td>
		</tr>
        <input type="hidden" name="hide" value="1" />
        <tr>
        <td><!--<div class="head">Hide</div> &nbsp;<input type="radio" name="hide" value="1" <?php //if($object->hide) echo "checked"; ?>/>--></td>
        <td><!--<div class="head">Show</div> &nbsp;<input type="radio" name="hide" value="0" <?php //if(!$object->hide) echo "checked"; ?>/>--></td>
        <td>
		<div style="float:left; padding-left:1px; padding-right:60px; padding-top:33px;">		
	        <input name="edit_feedback" type="submit" value="Save" />
        </div>
        <div style="float:left; padding-right:60px; padding-top:33px;">		
            <input type="button" value="Cancel" onClick="location.href = 'feedback.php'; " />
        </div>
        </td>
        </tr>
        </table>
        </form>

</div>
</body>
</html>



