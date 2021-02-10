<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
  if(strpos($_SERVER['REQUEST_URI'], 'solvitware/' )){
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/solvitware';
  } elseif (strpos($_SERVER['REQUEST_URI'], 'designitpro/' )) {
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro/';
  } else {
    $_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
  }
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php");

?>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="description" content="Installer Job Dashboard APP_Main Page_Google Navigation Map_Full Screen">
    <title>Installer Job Dashboard APP_Main Page_Google Navigation Map_Full Screen</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script src="../assets/js/script.js" defer></script>      
<script>
function get_width(){
    var w = window.innerWidth;
    alert(w);
}      
</script>           
  </head>

  <body>

    <div class="gnMap-fullscreen-main-container">

      <div class="gnMap-fullscreen-content-container">

        <!-- MAIN PAGE CONTENT START -->
        <div class="gnMap-fullscreen-content installer-dashboard-gnMap-home-page">

          <header class="ijd-gnMap-header">

            <div class="ijd-gnMap-header-customer-name">
              JOHN SMITHSON
            </div>

            <div class="ijd-gnMap-header-title">
              NAVIGATION WITH GOOGLE MAP
            </div>

            <div class="ijd-gnMap-header-buttons">
              <a class="gnMap-open-in-google-map" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#">OPEN IN GOOGLE MAP</a>
              <a class="gnMap-enter-fullscreen" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map.php">EXIT FULLSCREEN</a>
            </div>

          </header>

          <main class="ijd-gnMap-main-content">

            <div class="ijd-gnMap-mc-map-container">

              <div class="ijd-gnMap-mc-map">
                <img src="../assets/img/google-map.png" alt="Google Map">
              </div>

              <div class="ijd-gnMap-mc-navigation-axis-container">

                <div class="ijd-gnMap-mc-na-n-text">
                  N
                </div>

                <a class="ijd-gnMap-mc-na-n-icon" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>

                <div class="ijd-gnMap-mc-na-w-text">
                  W
                </div>

                <a class="ijd-gnMap-mc-na-w-icon" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>

                <div class="ijd-gnMap-mc-na-e-text">
                  E
                </div>

                <a class="ijd-gnMap-mc-na-e-icon" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>

                <div class="ijd-gnMap-mc-na-s-text">
                  S
                </div>

                <a class="ijd-gnMap-mc-na-s-icon" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>

              </div>

              <div class="ijd-gnMap-mc-map-address-tooltip">
                <div class="ijd-gnMap-mc-map-address-tooltip-title">
                  COMPANY
                </div>
                <div class="ijd-gnMap-mc-map-address-tooltip-address">
                  123 Tigard Ave Unit A<br>Tigard, OR 12345
                </div>
              </div>

              <div class="ijd-gnMap-mc-map-save-as-favorite">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#">SAVE AS<br>FAVORITE</a>
              </div>

              <div class="ijd-gnMap-mc-map-zoom-in-out-container">
                <div class="ijd-gnMap-mc-map-zoom-out">
                  <a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"><div class="ijd-gnMap-mc-map-zoom-out-shape"></div></a>
                </div>

                <div class="ijd-gnMap-mc-map-zoom-in">
                  <div class="ijd-gnMap-mc-map-zoom-in-link">
                    <a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>
                  </div>
                </div>

                <div class="ijd-gnMap-mc-map-current-location">
                  <div class="ijd-gnMap-mc-map-current-location-link">
                    <a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"></a>
                  </div>
                </div>
              </div>

            </div>

            <div class="ijd-gnMap-mc-navigation-container">

              <div class="ijd-gnMap-mc-navigation-title">
                <img src="../assets/img/icon-email-send.png">
                <span>DESTINATION<br>ADDRESS</span>
              </div>

              <div class="ijd-gnMap-mc-navigation-company-icon">
                COMPANY
              </div>

              <div class="ijd-gnMap-mc-navigation-search-container">
                <input type="search" name="search" value="123 Tigard Ave Unit A, Tigard, OR 12345" onfocus="this.value=''" onblur="this.value='123 Tigard Ave Unit A, Tigard, OR 12345'">
              </div>

              <div class="ijd-gnMap-mc-navigation-button">
                <div class="ijd-gnMap-mc-navigation-button-link">
                  <a id="gnMap-navigate" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Confirm Navigation.php">NAVIGATE</a>
                </div>
              </div>

            </div>

            <footer class="ijd-gnMap-mc-footer">

              <div class="ijd-gnMap-mc-footer-buttons-container">

                <a class="ijd-gnMap-mc-footer-button-company" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-company-bigger.png" alt="Button Company">
                  </div>
                  <span>COMPANY</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-job-site" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-home-bigger.png" alt="Button Job Site">
                  </div>
                  <span>JOB SITE</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-history" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_History.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-history-bigger.png" alt="Button History">
                  </div>
                  <span>HISTORY</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-customers" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Customer Homes.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-star-bigger.png" alt="Button Customers">
                  </div>
                  <span>CUSTOMERS</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-locate-teams" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Locate Other Team.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-current-location-bigger.png" alt="Button Locate Teams">
                  </div>
                  <span>LOCATE TEAMS</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-show-traffic" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Show Traffic.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-stats-bigger.png" alt="Button Show Traffic">
                  </div>
                  <span>SHOW TRAFFIC</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-turn-on-location" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Turn on Location.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-location-settings-bigger.png" alt="Button Turn on Location">
                  </div>
                  <span>TURN ON LOCATION</span>
                </a>

                <a class="ijd-gnMap-mc-footer-button-exit-full-screen" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-log-out-bigger.png" alt="Button Exit Full Screen">
                  </div>
                  <span>EXIT FULLSCREEN</span>
                </a>


              </div>

            </footer>

          </main>

        </div>
        <!-- MAIN PAGE CONTENT END -->

      </div>

    </div>

    <script>
      var tab_active = 'google_navigation_map';
    </script>


  </body>

</html>
