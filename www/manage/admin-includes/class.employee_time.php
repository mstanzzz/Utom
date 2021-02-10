<?php
error_reporting(0);
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/class.admin_login.php');

// This class depends on user being logged in
// All properties are dependent on the current logged in user
class EmployeeTime
{
	

	function __construct(){

	
	}


	function getTotalWeek($user_id){

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$t = time();
		$d = date("j");
		
		$day_of_week = date("w");

		$seconds_this_week = $day_of_week*24*60*60;
		
		$start = $t - $seconds_this_week;
		
		$total_seconds = 0;

		$sql = "SELECT time_on
					,time_off
				FROM time_clock
				WHERE time_on > '".$start."' 
				AND user_id = '".$user_id."'"; 				
		$result = $dbCustom->getResult($db,$sql);				
		while($row = $result->fetch_object()){
			//echo "week time_on:  ".$row->time_on."    week time_off:  ".$row->time_off;
			//echo "<br />";
			
			if($row->time_off == 0){
				
				
			}else{
				$total_seconds += $row->time_off - $row->time_on; 			
			}
			
		}


		$week_hours = floor($total_seconds / 3600);
		$week_minutes = floor(($total_seconds / 60) % 60);
		$week_seconds = $total_seconds % 60;

		if($week_seconds > 29){
			$week_minutes++;	
		}else{
			
		}
		
		$week_display = $week_hours." Hr ".$week_minutes." min";
		
		/*
		echo "<br />";
		echo "week_hours: ".$week_hours;
		echo "<br />";
		echo "week_minutes: ".$week_minutes;
		echo "<br />";
		echo "week_seconds: ".$week_seconds;
		echo "<br />";
		echo "week_display: ".$week_display;
		echo "<br />";
		*/
		
		$ret = array();		
		$ret['display'] = $week_display;
		$ret['hours'] = $week_hours;
		$ret['min'] = $week_minutes;
		
		return $ret;

/*	
		echo "<br />";
		echo "d:  ".$d; 
		echo "<br />";
		$mod_7 = $d % 7;
		echo "mod_7: ".$mod_7;		
		echo "<br />";
		echo "<br />";
		$test = $t;
		$wd = date("w",$test);
		echo "<br />";;
		echo "---->wd:  ".$wd; 
		echo "<br />";		 
		echo "<br />";;
		echo "---->day_of_week:  ".$day_of_week; 
		echo "<br />";
*/		
	

	}

	function getTotalMonth($user_id){

		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		
		$t = time();
		$d = date("j");
		$seconds_this_month = $d*24*60*60;
		
		$start = $t - $seconds_this_month;

		$total_seconds = 0;

		$sql = "SELECT time_on
					,time_off
				FROM time_clock
				WHERE time_on > '".$start."' 
				AND user_id = '".$user_id."'"; 
				
		$result = $dbCustom->getResult($db,$sql);
				
		while($row = $result->fetch_object()){
			//echo "month time_on:  ".$row->time_on."    month time_off:  ".$row->time_off;
			//echo "<br />";
			
			if($row->time_off == 0){
				
				
			}else{
				$total_seconds += $row->time_off - $row->time_on; 			
			}
			
		}

		$month_hours = floor($total_seconds / 3600);
		$month_minutes = floor(($total_seconds / 60) % 60);
		$month_seconds = $total_seconds % 60;

		if($month_seconds > 29){
			$month_minutes++;	
		}else{
			
		}

		$month_display = $month_hours." Hr ".$month_minutes." min";

		/*
		echo "<br />";
		echo "month_hours: ".$month_hours;
		echo "<br />";
		echo "month_minutes: ".$month_minutes;
		echo "<br />";
		echo "month_seconds: ".$month_seconds;
		echo "<br />";
		echo "month_display: ".$month_display;
		echo "<br />";
		*/
		
				
		$ret = array();		
		$ret['display'] = $month_display;
		$ret['hours'] = $month_hours;
		$ret['min'] = $month_minutes;
		
		return $ret;
	}

	
	function getTotalShift($user_id){
				
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(USER_DATABASE);

		$time_on = 0; 
		$time_off = 0;
		$month = date("m");
		$day = date("d");
		$year = date("Y");
		$max_time_on = 0;
		$max_time_off = 0;
		$on_clock = 1;
		$morning = mktime(0,0,0,$month,$day,$year);
		$midnight = mktime(23,59,59,$month,$day,$year);

/*
		$sql = "SELECT MAX(time_on) as max_time_on
				FROM time_clock
				WHERE time_on > '".$morning."' 
				AND time_on <  '".$midnight."'
				AND user_id = '".$user_id."'"; 
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 		
			$max_time_on = $object->max_time_on; 
			if($max_time_on == "") $max_time_on = 0;
		}
		$sql = "SELECT MAX(time_off) as max_time_off				
				FROM time_clock
				WHERE time_off > '".$morning."' 
				AND time_off <  '".$midnight."'
				AND user_id = '".$user_id."'"; 
		$result = $dbCustom->getResult($db,$sql);
		if($result->num_rows > 0){
			$object = $result->fetch_object(); 		
			$max_time_off = $object->max_time_off;
			if($max_time_off == "") $max_time_off = 0;
		}
		
		echo "max_time_on:  ".$max_time_on;
		echo "<br />";
		echo "max_time_off: ".$max_time_off;
		echo "<br />";
		
		if($max_time_on > $max_time_off){
			$on_clock = 0;	
		}else{
			$on_clock = 1;		
		}
*/

		$total_shift = 0;

		$sql = "SELECT time_on
					,time_off
				FROM time_clock
				WHERE time_on > '".$morning."' 
				AND time_on <  '".$midnight."'
				AND user_id = '".$user_id."'"; 
		$result = $dbCustom->getResult($db,$sql);
		while($row = $result->fetch_object()){
			
			//echo "time_on:  ".$row->time_on."    time_off:  ".$row->time_off;
			//echo "<br />";
			
			if($row->time_off == 0){
							
			}else{
				$total_shift += $row->time_off - $row->time_on; 

				//echo "total_shift: ".$total_shift;
				//echo "<br />";	
			}			
		}

		$shift_hours = floor($total_shift / 3600);
		$shift_minutes = floor(($total_shift / 60) % 60);
		$shift_seconds = $total_shift % 60;

		if($shift_seconds > 29){
			$shift_minutes++;	
		}else{
			
		}
		
		$shift_display = $shift_hours." Hr ".$shift_minutes." min";
				
		$ret = array();		
		$ret['display'] = $shift_display;
		$ret['hours'] = $shift_hours;
		$ret['min'] = $shift_minutes;

		return $ret;
		
	}

}

?>