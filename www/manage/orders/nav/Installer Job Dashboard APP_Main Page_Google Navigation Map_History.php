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
    <meta name="description" content="Installer Job Dashboard APP_Main Page_Google Navigation Map_History">
    <title>Installer Job Dashboard APP_Main Page_Google Navigation Map_History</title>
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

    <div class="main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'google_navigation_map';
        require_once('../sections/inst_left_nav.php');
      ?>


      <div class="content-container left-sidebar-expanded">

        <!------------------------------ TOP NAV ELEMENTS ---------------------------->
        <?php
          require_once('../sections/top_nav.php');
        ?>

        <!------------------------------ CONTENT AREA -------------------------->

        <!-- MAIN PAGE CONTENT START -->
        <div class="gnMap-content installer-dashboard-gnMap-home-page">

          <header class="ijd-gnMap-header">

            <div class="ijd-gnMap-header-title">
              NAVIGATION WITH GOOGLE MAP
            </div>

            <div class="ijd-gnMap-header-buttons">
              <a class="gnMap-open-in-google-map" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#">OPEN IN GOOGLE MAP</a>
              <a class="gnMap-enter-fullscreen" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Full Screen.php">ENTER FULLSCREEN</a>
            </div>

          </header>

          <main class="ijd-gnMap-main-content">

            <div class="ijd-gnMap-mc-map-container">

              <div class="ijd-gnMap-mc-map">
                <img src="../assets/img/google-map.png" alt="Google Map">
              </div>

              <div class="ijd-gnMap-mc-map-customers-list-container">
                <div class="ijd-gnMap-mc-map-customers-list-header">
                  <div class="ijd-gnMap-mc-map-customers-list-header-icon">
                    <img src="../assets/img/icon-history-small.png" alt="">
                  </div>
                  <div class="ijd-gnMap-mc-map-customers-list-header-title">
                    History
                  </div>
                  <div class="ijd-gnMap-mc-map-customers-list-header-close-button">
                    <a href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#"><img src="../assets/img/icon-close.png" alt="Close Customers List"></a>
                  </div>
                </div>

                <div class="ijd-gnMap-mc-map-history-list-content ijd-gnMap-mc-map-customers-list-sroller">

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Company
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Kiss Kar Wash
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      2 Days Ago
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Fast Food Restaurant
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      2 Days Ago
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>

                  <div class="ijd-gnMap-mc-map-history-item">
                    <div class="ijd-gnMap-mc-map-history-item-name">
                      Job Site
                    </div>
                    <div class="ijd-gnMap-mc-map-history-item-date">
                      Yesterday
                    </div>
                  </div>


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

              <div class="ijd-gnMap-mc-navigation-address-title">
                Kiss Car Wash
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

                <a  class="ijd-gnMap-mc-footer-button-company" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/#">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-company-bigger.png" alt="Button Company">
                  </div>
                  <span>COMPANY</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-job-site" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Navigate to Job Site.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-home-bigger.png" alt="Button Job Site">
                  </div>
                  <span>JOB SITE</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-history" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_History.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-history-bigger.png" alt="Button History">
                  </div>
                  <span>HISTORY</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-customers" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Customer Homes.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-star-bigger.png" alt="Button Customers">
                  </div>
                  <span>CUSTOMERS</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-locate-teams" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Locate Other Team.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-current-location-bigger.png" alt="Button Locate Teams">
                  </div>
                  <span>LOCATE TEAMS</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-show-traffic" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Show Traffic.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-stats-bigger.png" alt="Button Show Traffic">
                  </div>
                  <span>SHOW TRAFFIC</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-turn-on-location" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Turn on Location.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-location-settings-bigger.png" alt="Button Turn on Location">
                  </div>
                  <span>TURN ON LOCATION</span>
                </a>

                <a  class="ijd-gnMap-mc-footer-button-full-screen" href="<?php echo SITEROOT; ?>/manage/dashboard/installer/Installer Job Dashboard APP_Main Page_Google Navigation Map_Full Screen.php">
                  <div class="ijd-gnMap-mc-footer-button-img">
                    <img src="../assets/img/icon-export-bigger.png" alt="Button Full Screen">
                  </div>
                  <span>ENTER FULLSCREEN</span>
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
