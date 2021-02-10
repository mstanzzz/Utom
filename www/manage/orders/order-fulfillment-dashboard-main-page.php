<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
  if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
  } elseif (strpos($_SERVER['REQUEST_URI'], 'designitpro/' )) {
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
  } else {
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
  }
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

?>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="description" content="ORDER FULFILLMENT DASHBOARD_MAIN PAGE">
    <title>ORDER FULFILLMENT DASHBOARD_MAIN PAGE</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
  </head>

  <body>

    <div class="main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'orders-fulfillment-main-page';
        require_once('./nav/installer_includes/inst_left_nav.php');
      ?>

      <div class="content-container left-sidebar-expanded">

        <!------------------------------ TOP NAV ELEMENTS ---------------------------->
        <?php
          require_once('./nav/top_nav.php');
        ?>

        <!------------------------------ CONTENT AREA -------------------------->

        <!-- MAIN PAGE CONTENT START -->
        <div class="content personal-dashboard-home-page">

          <div class="content-title-mainpage">
            <div class="content-title-mainpage-title">
              <div class="order-fulfillment-content-title-mainpage-text">Hello Ann,<br>Welcome to Order Fulfillment Dashboard</div>
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
                <img src="./assets/img/tick-small.png">
              </div>
            </div>
            <div class="team-position-container">
              <div class="team-position-title">
                TEAM POSITION
              </div>
              <div class="order-fulfillment-team-position-text">
                Lv. 3 Customer Service
              </div>
            </div>
          </div>

        </div>



      </div>
    </div>

    <script>
      var tab_active = '';
    </script>

  </body>
</html>
