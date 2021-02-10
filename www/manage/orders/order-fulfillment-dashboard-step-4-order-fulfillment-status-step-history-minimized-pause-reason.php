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
    <meta name="description" content="ORDER FULFILLMENT DASHBOARD_STEP 4 ORDER FULFILLMENT STATUS_STEP HISTORY MINIMIZED_PAUSE_REASON">
    <title>ORDER FULFILLMENT DASHBOARD_STEP 4 ORDER FULFILLMENT STATUS_STEP HISTORY MINIMIZED_PAUSE_REASON</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
  </head>

  <body>

    <!-- PAUSE REASON POP-UP -->
    <div class="order-fulfillment-dashboard-popup-container">

      <div class="order-fulfillment-dashboard-popup">

        <div class="ofd-popup-title">
          Reason for Pausing Step 01
        </div>

        <div class="ofd-popup-subtitle">
          Room 03, CLOSET #01
        </div>

        <div class="ofd-popup-pause-reason-menu">
          <select name="">
            <option value="1" selected>SELECT A REASON FOR PAUSING</option>
            <option value="2">CUSTOMER REQUEST</option>
            <option value="3">INSTALLATION ERROR</option>
            <option value="4">SHIFT ENDED</option>
            <option value="5">MISSING EQUIPMENT</option>
            <option value="6">MISSING PARTS</option>
          </select>
        </div>

        <div class="ofd-submit-pause-status-button">
          <a href="#">
            SUBMIT PAUSE STATUS
          </a>
        </div>

        <div class="ofd-cancel-button">
          <a href="#">
            CANCEL
          </a>
        </div>

      </div>

    </div>

    <div class="order-fulfillment-main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'order-fulfillment-status';
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
              <div class="order-rooms-back-to-inbound-orders-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS.php">
                  <img src="./assets/img/icon-reports-white.png">
                  <span>Inbound<br>Orders</span>
                </a>
              </div>
              <div class="order-rooms-inbound-orders-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS.php">
                  <span>Order<br>Overview</span>
                </a>
              </div>
              <div class="order-rooms-back-to-room-detail-button">
                <a href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS.php">
                  <img src="./assets/img/icon-back-white-medium.png">
                  <span>Room 03<br>Detail</span>
                </a>
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

            <div class="inbound-orders-step-4-fulfillment-status-header">

              <div class="ios4fsh-title">
                Order Fulfillment Status
              </div>
              <div class="ios4fsh-order-number">
                Order #1234567
              </div>
              <div class="ios4fsh-room-number">
                Room 03
              </div>
              <div class="ios4fsh-current-step">
                Current Step: Step 01. Order Received
              </div>

            </div>

          </header>

          <main class="order-fulfillment-dashboard-step-4-shm-container">

            <div class="order-fulfillment-dashboard-step-4-shm">

              <section class="ofds4-content">

                <div class="ofds4-shm2-closet-menu">
                  <select class="" name="">
                    <option value="" selected>CLOSET # 01</option>
                    <option value="">CLOSET # 02</option>
                    <option value="">CLOSET # 03</option>
                    <option value="">CLOSET # 04</option>
                  </select>
                </div>
                <div class="ofds4-shm2-steps-menu">
                  <select class="" name="">
                    <option value="" selected>Step 01. Order Received</option>
                    <option value="">Step 02. Layout</option>
                    <option value="">Step 03. Materials Ordered</option>
                    <option value="">Step 04. Materials Received</option>
                  </select>
                </div>
                <div class="ofds4-chart-buttons-container">

                  <div class="ofds4-room-detail-button">
                    <a href="#">
                      <span>Room Detail</span>
                    </a>
                  </div>

                  <div class="ofds4-chart-buttons">

                    <div class="ofds4-lock-button">
                      <a href="#">
                        Lock
                      </a>
                    </div>

                    <div class="ofds4-chart-container">
                      <section class="ofds4-chart">
                        <svg class="circle-chart-outer" viewbox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                          <circle class="circle-chart-outer-background" cx="14" cy="14" r="13.66" />
                          <circle class="circle-chart-outer-circle" cx="14" cy="14" r="13.66" />
                        </svg>

                        <svg class="circle-chart-inner" viewbox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                          <linearGradient id="circle-chart-inner-gradient" x1="100%" y1="0%" x2="0%" y2="0%">
                            <stop offset="0%" stop-color="#fff" />
                            <stop offset="100%" stop-color="#eee" />
                          </linearGradient>
                          <circle class="circle-chart-inner-background" cx="14" cy="14" r="12.9" />
                          <symbol id="circle-chart-inner-circle-symbol" viewbox="0 0 28 28">
                            <circle class="circle-chart-inner-circle" cx="14" cy="14" r="13" />
                          </symbol>
                          <use class="circle-chart-inner-circle-original" href="#circle-chart-inner-circle-symbol" />
                          <svg class="circle-chart-inner-circle-shadow">
                            <use class="circle-chart-inner-circle-shadow-use" href="#circle-chart-inner-circle-symbol" />
                          </svg>
                        </svg>
                        <div class="circle-chart-info-container">

                          <div class="cci-percentage-container">
                            <div class="cci-overall-job-expected-completion-percent">
                              <div class="cci-ojecp-shape">

                              </div>
                              <span>88%</span>
                            </div>
                            <span class="cci-percentage-separator">/</span>
                            <div class="cci-step-progress-percent">
                              <div class="cci-spp-shape">

                              </div>
                              <span>75%</span>
                            </div>
                          </div>

                          <div class="cci-time">
                            10:05 AM
                          </div>

                          <div class="cci-status">
                            <img src="./assets/img/icon-loading.png" alt="">
                            <span>In Progress</span>
                          </div>

                        </div>
                      </section>
                    </div>

                    <div class="ofds4-step-process-badge-container">
                      <div class="ofds4-step-process-badge">

                      </div>
                      <span>Step Process</span>
                    </div>

                    <div class="ofds4-overall-job-expected-completion-container">
                      <div class="ofds4-overall-job-expected-completion-badge">

                      </div>
                      <span>Overall Job<br>Expected<br>Completion</span>
                    </div>

                    <div class="ofds4-complete-button">
                      <a href="#">
                        Complete
                      </a>
                    </div>

                    <div class="ofds4-stop-button">
                      <a href="#">
                        <span>Stop</span>
                        <img src="./assets/img/icon-stop.png" alt="Start">
                      </a>
                    </div>

                    <div class="ofds4-overall-room-progress-container">

                      <div class="ofds4-overall-room-progress-title">
                        Overall Room Progress
                      </div>
                      <div class="ofds4-overall-room-progress-bar">
                        <div class="ofds4-overall-room-progress-bar-bg">

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

                    </div>

                  </div>

                </div>

              </section>

              <aside class="ofds4-step-history-right-sidebar-container">
                <div class="ofds4-shrs-open-button">
                  <a href="#">
                    <img src="./assets/img/icon-back-big-white.png" alt="Open Step Histopry">
                  </a>
                </div>

                <div class="ofds4-step-history-right-sidebar-content">

                  <div class="ofds4-shrsc-title">
                    Step History
                  </div>

                  <hr>

                  <div class="ofds4-shrsc-items-container scroller-view-folder-white">
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                    <div class="ofds4-shrsc-item">
                      Begun by Jane Apple<br>@ 01/19/2018 11:09 AM PST
                    </div>
                  </div>

                </div>

                <div class="ofds4-shrsc-close-button">
                    <a href="#">
                      <img src="./assets/img/arrow-menu-white.png" alt="Close Step History Sidebar">
                    </a>
                </div>

              </aside>

            </div>

          </main>

        </section>

        <!-- ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS CONTENT END -->

      </div>
    </div>

    <script>
      var tab_active = 'order-fulfillment-status';
    </script>

  </body>
</html>
