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
    <meta name="description" content="ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS">
    <title>ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
  </head>

  <body>

    <div class="order-fulfillment-main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'order-room-details-step-3';
        require_once('./nav/installer_includes/inst_left_nav.php');
      ?>

      <div class="content-container left-sidebar-expanded">

        <!------------------------------ TOP NAV ELEMENTS ---------------------------->
        <?php
          require_once('./nav/top_nav.php');
        ?>

        <!------------------------------ CONTENT AREA -------------------------->

        <!-- ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS CONTENT START -->

        <section class="io-content inbound-orders-order-rooms">

          <header class="inbound-orders-home-page-header-container">

            <div class="inbound-orders-order-rooms-header">
              <div class="order-rooms-inbound-orders-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS.php">
                  <span>Inbound<br>Orders</span>
                </a>
              </div>
              <div class="order-rooms-back-to-inbound-orders-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS.php">
                  <img src="./assets/img/icon-back-white-medium.png">
                  <span>Orders<br>Overview</span>
                </a>
              </div>
              <div class="order-rooms-page-title">
                Room 03
              </div>
              <div class="order-rooms-page-header-order-rooms-details">
                <div class="orphord-status-title">
                  STATUS
                </div>
                <div class="orphord-total-title">
                  TOTAL
                </div>
                <div class="orphord-team-title">
                  TEAM
                </div>
                <div class="orphord-rooms-title">
                  ROOMS
                </div>
                <div class="orphord-assigned-title">
                  ASSIGNED
                </div>

                <div class="orphord-status-text">
                  In Progress
                </div>
                <div class="orphord-total-text">
                  1 Design
                </div>
                <div class="orphord-team-text">
                  <div class="io-hpolh-header-team-color io-team-color-orange">

                  </div>
                </div>
                <div class="orphord-rooms-text">
                  3 Rooms
                </div>
                <div class="orphord-assigned-text">
                  Tim E.
                </div>
              </div>

              <div class="icon-readerboard">
                <img src="./assets/img/icon-readerboard-green.png">
              </div>
            </div>

            <div class="inbound-orders-home-page-order-list-header">

              <div class="io-hpolh-flag">
                FLAG
              </div>
              <div class="io-hpolh-job">
                JOB
              </div>
              <div class="io-hpolh-order-number">
                ORDER #
              </div>
              <div class="io-hpolh-date">
                DATE
              </div>
              <div class="io-hpolh-name">
                NAME
              </div>
              <div class="io-hpolh-type">
                TYPE
              </div>
              <div class="io-hpolh-status">
                STATUS
              </div>
              <div class="io-hpolh-design">
                DESIGN
              </div>
              <div class="io-hpolh-fulfillment-status">
                FULFILLMENT STATUS
              </div>
              <div class="io-hpolh-designer">
                DESIGNER
              </div>
              <div class="io-hpolh-team">
                TEAM
              </div>
              <div class="io-hpolh-assigned">
                ASSIGNED
              </div>
              <div class="io-hpolh-total">
                TOTAL
              </div>
              <div class="io-hpolh-order-time">
                <img src="./assets/img/icon-recent.png" alt="">
              </div>
              <div class="io-hpolh-readerboard-icon">

              </div>

            </div>

          </header>

          <main class="inbound-orders-order-rooms-order-list-container">

            <!-- ORDERS LIST ROW 1 -->
            <div class="io-oror-order-rooms-list-header-container">

              <div class="io-oror-order-rooms-list-header oror-blue-flag">
                <div class="io-hpor-row-flag-icon">
                  <img src="./assets/img/icon-color-function-system-blue.png">
                </div>
                <div class="io-hpor-row-job-badge-pickup-container">
                  <div class="io-hpor-row-job-badge-pickup">
                    Pick Up
                  </div>
                </div>
                <div class="io-hpolh-order-number-text">
                  1234567
                </div>
                <div class="io-hpolh-date-text">
                  00/00
                </div>
                <div class="io-hpolh-name-text">
                  John 21 Century
                </div>
                <div class="io-hpolh-type-icon">
                  <img src="./assets/img/icon-order-type-design-service.png">
                </div>
                <div class="io-hpolh-status-badge-container">
                  <div class="io-hpolh-status-badge io-in-progress">
                    In Prog...
                  </div>
                </div>
                <div class="io-hpolh-design-text">
                  1
                </div>
                <div class="io-hpolh-fulfillment-status-text">
                  4. Materials on W...
                </div>
                <div class="io-hpolh-designer-text">
                  Jason P.
                </div>
                <div class="io-hpolh-team-color-container">
                  <div class="io-hpolh-team-color io-team-color-orange">

                  </div>
                </div>
                <div class="io-hpolh-assigned-text">
                  Tim E.
                </div>
                <div class="io-hpolh-total-text">
                  $123.45
                </div>
                <div class="io-hpolh-order-time-text">
                  35 hrs
                </div>
                <div class="io-hpolh-readerboard-icon">
                  <img src="./assets/img/icon-readerboard-green.png">
                </div>
              </div>

            </div>

            <div class="io-oror-order-rooms-list-content-container">

              <div class="io-oror-orlc-title-back-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS.php">
                  <img src="./assets/img/back-black.png" alt="Back">
                  <span>Back</span>
                </a>
                <div class="io-oror-orlc-title">
                  Room 03 Detail
                </div>
              </div>

              <div class="io-oror-orlc-room-detail-container">

                <div class="io-oror-orlc-room-detail-tabs">

                  <div class="io-oror-orlc-room-detail-tab">
                    <a href="#">Room<br>01</a>
                  </div>
                  <div class="io-oror-orlc-room-detail-tab">
                    <a href="#">Room<br>02</a>
                  </div>
                  <div class="io-oror-orlc-room-detail-tab room-detail-tab-selected">
                    <a href="#">Room<br>03</a>
                  </div>
                  <div class="io-oror-orlc-room-detail-tab">
                    <a href="#">Room<br>04</a>
                  </div>

                </div>

                <div class="io-oror-orlc-room-detail-content room-detail-content-selected">

                  <div class="io-oror-orlc-room-detail-content-header">

                    <div class="io-oror-orlc-rdch-level-badge-container">
                      <div class="io-oror-orlc-rdch-level-badge btn-room-lv4">
                        lv4
                      </div>
                    </div>
                    <div class="io-oror-orlc-rdch-title">
                      Room 3
                    </div>
                    <div class="io-oror-orlc-rdch-status-container">
                      <a href="#">
                        <div class="io-oror-orlc-rdch-status">
                          <img src="./assets/img/icon-loading.png" alt="">
                          <span>IN PROGRESS</span>
                        </div>
                      </a>
                    </div>
                    <div class="io-oror-orlc-rdch-team-color io-team-color-orange">

                    </div>

                  </div>

                  <hr>

                  <div class="io-oror-orlc-room-status-bar">
                    <div class="io-oror-orlc-room-status-bar-bg">

                    </div>
                    <div class="io-oror-orlc-room-status-lines">
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                      <div class="io-oror-orlc-room-status-line">|</div>
                    </div>
                    <div class="io-oror-orlc-room-status-numbers">
                      <div class="io-oror-orlc-room-status-number">
                        10%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        20%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        30%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        40%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        50%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        60%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        70%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        80%
                      </div>
                      <div class="io-oror-orlc-room-status-number">
                        90%
                      </div>
                    </div>
                  </div>

                  <div class="io-oror-orlc-rdc-update-history-container">
                    <div class="io-oror-orlc-rdc-update-history-header">
                      <span>Update History</span>
                    </div>
                  </div>

                  <hr>

                  <div class="io-oror-orlc-rdc-update-history-list-container scroller-view-folder-light">


                    <div class="io-oror-orlc-rdc-update-history-list-item hli-in-progress">
                      <div class="io-oror-orlc-rdc-uhli-icon-container">
                        <div class="io-oror-orlc-rdc-uhli-icon">

                        </div>
                      </div>
                      <div class="io-oror-orlc-rdc-uhli-content-container">
                        <div class="io-oror-orlc-rdc-uhli-content-title-container">
                          <div class="io-oror-orlc-rdc-uhli-content-title">
                            Step 03. Order Received
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-status-container">
                          <div class="io-oror-orlc-rdc-uhli-content-status">
                            <img src="./assets/img/icon-loading.png">
                            <span>IN PROGRESS</span>
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-name">
                          Kevin M.
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-time">
                          11:55 AM
                        </div>
                      </div>
                    </div>

                    <div class="io-oror-orlc-rdc-update-history-list-item">
                      <div class="io-oror-orlc-rdc-uhli-icon-container">
                        <div class="io-oror-orlc-rdc-uhli-icon">

                        </div>
                      </div>
                      <div class="io-oror-orlc-rdc-uhli-content-container">
                        <div class="io-oror-orlc-rdc-uhli-content-title-container">
                          <div class="io-oror-orlc-rdc-uhli-content-title">
                            Step 02. Layout
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-status-container">
                          <div class="io-oror-orlc-rdc-uhli-content-status">
                            <img src="./assets/img/tick-small.png">
                            <span>COMPLETE</span>
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-name">
                          Kevin M.
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-time">
                          11:35 AM
                        </div>
                      </div>
                    </div>

                    <div class="io-oror-orlc-rdc-update-history-list-item">
                      <div class="io-oror-orlc-rdc-uhli-icon-container">
                        <div class="io-oror-orlc-rdc-uhli-icon">

                        </div>
                      </div>
                      <div class="io-oror-orlc-rdc-uhli-content-container">
                        <div class="io-oror-orlc-rdc-uhli-content-title-container">
                          <div class="io-oror-orlc-rdc-uhli-content-title">
                            Step 01. Order Received
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-status-container">
                          <div class="io-oror-orlc-rdc-uhli-content-status">
                            <img src="./assets/img/tick-small.png">
                            <span>COMPLETE</span>
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-name">
                          Kevin M.
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-time">
                          11:45 AM
                        </div>
                      </div>
                    </div>

                    <div class="io-oror-orlc-rdc-update-history-list-item">
                      <div class="io-oror-orlc-rdc-uhli-icon-container">
                        <div class="io-oror-orlc-rdc-uhli-icon">

                        </div>
                      </div>
                      <div class="io-oror-orlc-rdc-uhli-content-container">
                        <div class="io-oror-orlc-rdc-uhli-content-title-container">
                          <div class="io-oror-orlc-rdc-uhli-content-title">
                            Step 01. Order Received
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-status-container">
                          <div class="io-oror-orlc-rdc-uhli-content-status">
                            <img src="./assets/img/tick-small.png">
                            <span>COMPLETE</span>
                          </div>
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-name">
                          Kevin M.
                        </div>
                        <div class="io-oror-orlc-rdc-uhli-content-time">
                          11:45 AM
                        </div>
                      </div>
                    </div>



                  </div>


                </div>


              </div>

              <div class="io-oror-orlc-room-detail-buttons-container">
                <div class="btn-io-oror-orlc-room-detail-inbound-orders">
                  <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS.php">Inbound Orders</a>
                </div>
                <div class="btn-io-oror-orlc-room-detail-back-to-orders-overview">
                  <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS.php">
                    <img src="./assets/img/icon-back-big-white.png" alt="Back to Orders Overview">
                    <span>Back to Orders Overview</span>
                  </a>
                </div>
              </div>

            </div>

          </main>

        </section>

        <!-- ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS CONTENT END -->

      </div>
    </div>

    <script>
      var tab_active = 'order-room-details-step-3';
    </script>

  </body>
</html>
