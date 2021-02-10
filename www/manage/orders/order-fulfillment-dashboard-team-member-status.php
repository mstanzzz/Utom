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
    <meta name="description" content="ORDER FULFILLMENT DASHBOARD_TEAM MEMBER STATUS">
    <title>ORDER FULFILLMENT DASHBOARD_TEAM MEMBER STATUS</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
  </head>

  <body>

    <div class="main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'order_fulfillment_team_member_status';
        require_once('./nav/installer_includes/inst_left_nav.php');
      ?>

      <div class="content-container left-sidebar-expanded">

        <!------------------------------ TOP NAV ELEMENTS ---------------------------->
        <?php
          require_once('./nav/top_nav.php');
        ?>

        <!------------------------------ CONTENT AREA -------------------------->

        <!-- CONTENT -->
        <div class="team-member-status-content">

          <!-- Team Member Status START -->
          <div class="tms-maincontent-minimenu-container">

            <!-- MAIN CONTENT CONTAINER START -->
            <div class="fulfillment-dashboard-tms-maincontent-container box-shadow">

              <!-- MINIMIZE MINI MENU START -->
              <div class="tms-minimize-minimenu"></div>
              <!-- MINIMIZE MINI MENU END -->

              <div class="tms-maincontent">

                <div class="tms-maincontent-header">
                  <div class="io-tms-maincontent-header-title">
                    TEAM MEMBER STATUS
                  </div>
                  <div class="tms-maincontent-header-team-color-container">
                    <span>YOUR TEAM COLOR</span>
                    <div class="io-tms-maincontent-header-team-color">

                    </div>
                  </div>
                  <div class="tms-maincontent-header-status">

                  </div>
                </div>

                <hr class="tms-maincontent-hr">

                <div class="tms-maincontent-team-member-table-container">

                  <div class="tms-mtmt-header">
                    <div class="tms-mtmt-header-reorder">
                      REORDER
                    </div>
                    <div class="tms-mtmt-header-team-role">
                      TEAM ROLE
                    </div>
                    <div class="tms-mtmt-header-installer-name">
                      INSTALLER NAME
                    </div>
                    <div class="tms-mtmt-header-clocked-in">
                      CLOCKED-IN
                    </div>
                    <div class="tms-mtmt-status-container">
                      STATUS
                    </div>
                    <div class="tms-mtmt-header-view-progress">
                      PROGRESS
                    </div>
                  </div>

                  <!-- TEAM MEMBER ROW 1 -->
                  <div class="tms-mtmt-row">
                    <!-- SUB ROW 1 -->
                    <div class="tms-mtmt-row-subrow-1">
                      <div class="tms-mtmt-reorder-icon">
                        <img src="./assets/img/icon-reorder.png" alt="">
                      </div>
                      <div class="">
                        <button class="btn-supervisor btn-role btn-shadow" type="button">Lv. 5 Supervisor</button>
                      </div>
                      <div class="tms-mtmt-installer-name-text">
                        Mike Hilton
                      </div>
                      <div class="tms-mtmt-clocked-in-icon">
                        <img src="./assets/img/tick-small.png">
                      </div>
                      <div class="tms-mtmt-status-container">
                        <div class="tms-mtmt-status">
                          ONLINE
                        </div>
                      </div>
                      <div class="tms-mtmt-view-progress">
                        <span>VIEW</span>
                        <img src="./assets/img/icon-down-dark.png">
                      </div>
                    </div>
                    <!-- SUB ROW 2 -->
                    <div class="tms-mtmt-row-subrow-2">

                      <div class="tms-mtmt-row-subrow-2-header">
                        <div class="tms-mtmt-row-subrow-2-header-current-room">
                          CURRENT ROOM
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-progress">
                          PROGRESS
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-working-with">
                          WORKING WITH
                        </div>
                      </div>

                      <div class="tms-mtmt-row-subrow-2-content">
                        <div class="tms-mtmt-row-subrow-2-header-cr-text">
                          Dining
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-p-text">
                          Install Shelves/ Tubes
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-ww-text">
                          KEVIN
                        </div>
                      </div>

                    </div>

                  </div>

                  <!-- TEAM MEMBER ROW 2 -->
                  <div class="tms-mtmt-row">
                    <!-- SUB ROW 1 -->
                    <div class="tms-mtmt-row-subrow-1">
                      <div class="tms-mtmt-reorder-icon">
                        <img src="./assets/img/icon-reorder.png" alt="">
                      </div>
                      <div class="io-service-level-buttons-container">
                        <button class="btn-service-lv3" type="button">Lv. 3 Service</button>
                      </div>
                      <div class="tms-mtmt-installer-name-text">
                        John Smithson (You)
                      </div>
                      <div class="tms-mtmt-clocked-in-icon">
                        <img src="./assets/img/tick-small.png">
                      </div>
                      <div class="tms-mtmt-status-container">
                        <div class="tms-mtmt-status">
                          ONLINE
                        </div>
                      </div>
                      <div class="tms-mtmt-view-progress">
                        <span>VIEW</span>
                        <img src="./assets/img/icon-down-dark.png">
                      </div>
                    </div>
                    <!-- SUB ROW 2 -->
                    <div class="tms-mtmt-row-subrow-2">

                      <div class="tms-mtmt-row-subrow-2-header">
                        <div class="tms-mtmt-row-subrow-2-header-current-room">
                          CURRENT ROOM
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-progress">
                          PROGRESS
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-working-with">
                          WORKING WITH
                        </div>
                      </div>

                      <div class="tms-mtmt-row-subrow-2-content">
                        <div class="tms-mtmt-row-subrow-2-header-cr-text">
                          Dining
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-p-text">
                          Install Shelves/ Tubes
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-ww-text">
                          KEVIN
                        </div>
                      </div>

                    </div>

                  </div>

                  <!-- TEAM MEMBER ROW 3 -->
                  <div class="tms-mtmt-row">
                    <!-- SUB ROW 1 -->
                    <div class="tms-mtmt-row-subrow-1">
                      <div class="tms-mtmt-reorder-icon">
                        <img src="./assets/img/icon-reorder.png" alt="">
                      </div>
                      <div class="">
                        <button class="btn-installer btn-role btn-shadow" type="button">Lv. 3 Installer</button>
                      </div>
                      <div class="tms-mtmt-installer-name-text">
                        George Michaels
                      </div>
                      <div class="tms-mtmt-clocked-in-icon">

                      </div>
                      <div class="tms-mtmt-status-container">
                        <div class="io-tms-mtmt-status-offline">
                          OFFLINE
                        </div>
                      </div>
                      <div class="tms-mtmt-view-progress">
                        <span>VIEW</span>
                        <img src="./assets/img/icon-down-dark.png">
                      </div>
                    </div>
                    <!-- SUB ROW 2 -->
                    <div class="tms-mtmt-row-subrow-2">

                      <div class="tms-mtmt-row-subrow-2-header">
                        <div class="tms-mtmt-row-subrow-2-header-current-room">
                          CURRENT ROOM
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-progress">
                          PROGRESS
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-working-with">
                          WORKING WITH
                        </div>
                      </div>

                      <div class="tms-mtmt-row-subrow-2-content">
                        <div class="tms-mtmt-row-subrow-2-header-cr-text">
                          Dining
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-p-text">
                          Install Shelves/ Tubes
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-ww-text">
                          KEVIN
                        </div>
                      </div>

                    </div>

                  </div>

                  <!-- TEAM MEMBER ROW 4 -->
                  <div class="tms-mtmt-row">
                    <!-- SUB ROW 1 -->
                    <div class="tms-mtmt-row-subrow-1">
                      <div class="tms-mtmt-reorder-icon">
                        <img src="./assets/img/icon-reorder.png" alt="">
                      </div>
                      <div class="">
                        <button class="btn-intern btn-role btn-shadow" type="button">Lv. 1 Intern</button>
                      </div>
                      <div class="tms-mtmt-installer-name-text">
                        Kevin McDonald
                      </div>
                      <div class="tms-mtmt-clocked-in-icon">
                        <img src="./assets/img/tick-small.png">
                      </div>
                      <div class="tms-mtmt-status-container">
                        <div class="tms-mtmt-status">
                          ONLINE
                        </div>
                      </div>
                      <div class="tms-mtmt-view-progress">
                        <span>VIEW</span>
                        <img src="./assets/img/icon-down-dark.png">
                      </div>
                    </div>
                    <!-- SUB ROW 2 -->
                    <div class="tms-mtmt-row-subrow-2">

                      <div class="tms-mtmt-row-subrow-2-header">
                        <div class="tms-mtmt-row-subrow-2-header-current-room">
                          CURRENT ROOM
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-progress">
                          PROGRESS
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-working-with">
                          WORKING WITH
                        </div>
                      </div>

                      <div class="tms-mtmt-row-subrow-2-content">
                        <div class="tms-mtmt-row-subrow-2-header-cr-text">
                          Dining
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-p-text">
                          Install Shelves/ Tubes
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-ww-text">
                          KEVIN
                        </div>
                      </div>

                    </div>

                  </div>

                  <!-- TEAM MEMBER ROW 5 -->
                  <div class="tms-mtmt-row">
                    <!-- SUB ROW 1 -->
                    <div class="tms-mtmt-row-subrow-1">
                      <div class="tms-mtmt-reorder-icon">
                        <img src="./assets/img/icon-reorder.png" alt="">
                      </div>
                      <div class="">
                        <button class="btn-designer btn-role btn-shadow" type="button">Lv. 4 Designer</button>
                      </div>
                      <div class="tms-mtmt-installer-name-text">
                        Ann Winterfield
                      </div>
                      <div class="tms-mtmt-clocked-in-icon">

                      </div>
                      <div class="tms-mtmt-status-container">
                        <div class="tms-mtmt-status">
                          ONLINE
                        </div>
                      </div>
                      <div class="tms-mtmt-view-progress">
                        <span>VIEW</span>
                        <img src="./assets/img/icon-down-dark.png">
                      </div>
                    </div>
                    <!-- SUB ROW 2 -->
                    <div class="tms-mtmt-row-subrow-2">

                      <div class="tms-mtmt-row-subrow-2-header">
                        <div class="tms-mtmt-row-subrow-2-header-current-room">
                          CURRENT ROOM
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-progress">
                          PROGRESS
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-working-with">
                          WORKING WITH
                        </div>
                      </div>

                      <div class="tms-mtmt-row-subrow-2-content">
                        <div class="tms-mtmt-row-subrow-2-header-cr-text">
                          Dining
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-p-text">
                          Install Shelves/ Tubes
                        </div>
                        <div class="tms-mtmt-row-subrow-2-header-ww-text">
                          KEVIN
                        </div>
                      </div>

                    </div>

                  </div>


                </div>


              </div>
            </div>
            <!-- MAIN CONTENT CONTAINER END -->

            <!-- TEAM MEMBER STATUS MINI MENU CONTAINER START -->
            <div class="tms-minimenu-container">
              <div class="tms-minimenu">
                <div>MESSAGE</div>
                <div>MIKE</div>
                <div>GEORGE</div>
                <div>KEVIN</div>
                <div>DESIGNER</div>
                <div>Team<br>MSG</div>
                <div>OTHER<br>TEAM</div>
              </div>
            </div>
            <!-- TEAM MEMBER STATUS MINI MENU CONTAINER END -->

          </div>

          <!-- Team Member Status END -->

        </div>
      </div>
    </div>

    <script>
      var tab_active = 'order_fulfillment_team_member_status';
    </script>

  </body>
</html>
