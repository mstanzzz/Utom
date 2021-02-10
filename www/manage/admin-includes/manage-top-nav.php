<?php
$steps_required = $progress->getNumRequiredSteps($_SESSION['profile_account_id']);
$steps_completed = $progress->getNumCompletedSteps($_SESSION['profile_account_id']);

$show_progress_bar = 0;
$steps_required = 9;
$steps_completed  = 3;

if($steps_completed < $steps_required){
	$show_progress_bar = 1;
	$prog_val = 100*($steps_completed/$steps_required)+1;
}else{	
	$prog_val = 0;	
}

if($show_progress_bar){
?>

<script>
  $(document).ready(function() {
    $("#progressbar").progressbar({ value: <?php echo $prog_val; ?> });
  });
  </script>
<?php } ?>

<div class="top_nav_bar">
	<?php if($show_progress_bar){ 

		$percentage = number_format(($steps_completed / $steps_required) * 100);

		$block = "<a href='setup-progress-details.php' class='progress_percentage'>";
		$block .= "Your Profile is ".$percentage."% Complete";
		$block .= "</a>";	
        $block .= "<div id='progressbar'></div>";        
		$block .= "<a href='setup-progress-details.php' class='progress_missing'>What am I missing?</a>";        
        echo $block;
		
	}?>
    
    
	<div class="clear"></div>
</div>
<div class="clear"></div>

