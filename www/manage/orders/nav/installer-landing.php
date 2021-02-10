<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], '/www/dashboard/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/www/dashboard'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro/';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}

//echo $_SERVER['REQUEST_URI'];
//echo "<br />";

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$user_name = "This is the User's Name";
$user_position = "Lv 5 Closet Installer";
$user_name_short = substr($user_name,0,18);
$user_position_short = substr($user_position,0,18);

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script src="../assets/js/script.js" defer></script>      
<script>
function get_width(){
    var w = window.innerWidth;
    alert(w);
}      
</script>           
  </head>
<body data-page="persoanl-dash-mainpage">


  <!-- SELECT DASHBOARD WINDOW START -->
  <div class="select-dashboard-window-background">
    <div class="select-dashboard-window-container">
      <div class="select-dashboard">

        <div class="select-dashboard-title">
          Select Dashboard
        </div>
        <div class="select-dashboard-buttons">
          <div class="btn-dashboard-buttons btn-select-dashboard-buttons-personal-center btn-dashboard-current">
            PERSONAL CENTER
          </div>
          <div class="btn-dashboard-buttons btn-select-dashboard-buttons-job-center">
            JOB CENTER
          </div>
          <div class="btn-dashboard-buttons btn-select-dashboard-buttons-feedback-center">
            FEEDBACK CENTER
          </div>
        </div>
        <div class="select-dashboard-cancel">
          CANCEL
        </div>

      </div>
    </div>
  </div>
  <!-- SELECT DASHBOARD WINDOW END -->

<?php
require_once('reminder_window.php');
?>

<div class="main-container">

<!-- Left sidebar -->
<?php
require_once('../sections/inst_left_nav.php');
?>


  <div class="content-container">

    <?php
	require_once('../sections/top_nav.php');
    ?>

    <!------------------------------ CONTENT AREA -------------------------->

    <!-- CONTENT -->
    <div class="content personal-dashboard-home-page">

      <!-- ENTERING DASHBOARD ALERT START -->
      <div class="transitioning-job-dashboard">
        Entering Job Dashboard Now...
      </div>
      <!-- ENTERING DASHBOARD ALERT END -->

      <!-- REMINDER ALERT START -->
      <div class="reminder-container">
        <div class="reminder-message-container">
          <div class="btn-reminder-close">
            <img src="assets/img/close-warning.png" alt="Close Reminder">
          </div>
          <div class="btn-reminder-warning">
            <img src="assets/img/warning.png" alt="Reminder Warning Icon">
          </div>
          <div class="reminder-text">
            REMINDER: 1 JOB IS STARTING IN 5 MIN
          </div>
          <div class="reminder-confirm">
            Confirm
          </div>
        </div>
        <div class="reminder-options-container">
          <div class="btn-enter-job">
            Enter Job Dashboard Now
          </div>
          <div class="btn-delay">
            Delay Job
          </div>
        </div>
      </div>
      <!-- REMINDER ALERT END -->

      <!-- MAIN PAGE CONTENT START -->
      <div class="content-title-mainpage">
        <div class="content-title-mainpage-title">
          <div class="content-title-mainpage-text">Hello John,<br>Welcome to your Persoanl Dashboard</div>
        </div>
        <div class="content-title-mainpage-subtitle">
          <div class="content-title-mainpage-date">TUES, SEP 14</div>
          <div class="content-title-mainpage-time">12:05 PM</div>
        </div>
      </div>

      <div class="content-text-mainpage">
        <div class="shift-hours-container">
          <div class="shift-hours-title">
            TODAY'S SHIFT HOURS
          </div>
          <div class="shift-hours-text">
            05 Hours 35 min
          </div>
        </div>
        <div class="shift-table-container">
          <table>
            <thead>
              <th>THIS WEEK</th>
              <th>THIS MONTH</th>
            </thead>
            <tbody>
              <td>13 Hours 12 min</td>
              <td>43 Hours 18 min</td>
            </tbody>
          </table>
        </div>
        <div class="clockedin-container">
          <div class="clockedin-text">
            CLOCKED-IN
          </div>
          <div class="clockedin-icon">
            <img src="assets/img/tick.png">
          </div>
        </div>
        <div class="team-position-container">
          <div class="team-position-title">
            TEAM POSITION
          </div>
          <div class="team-position-text">
            Lv. 3 Installer
          </div>
        </div>
        <div class="btn-email-field-container">
          <input class="btn-email-field" type="email" placeholder="Enter E-mail" />
        </div>
      </div>
      <!-- MAIN PAGE CONTENT END -->

    </div>
  </div>
</div>
</body>
</html>
