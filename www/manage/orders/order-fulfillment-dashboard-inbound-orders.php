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
    <meta name="description" content="ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS">
    <title>ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <script src="./assets/js/script.js" defer></script>
  </head>

  <body>

    <div class="order-fulfillment-main-container">

      <!-- Left Sidebar -->
      <?php
        $ln_active = 'orders';
        require_once('./nav/installer_includes/inst_left_nav.php');
      ?>

      <div class="content-container left-sidebar-expanded">

        <!------------------------------ TOP NAV ELEMENTS ---------------------------->
        <?php
          require_once('./nav/top_nav.php');
        ?>

        <!------------------------------ CONTENT AREA -------------------------->

        <!-- ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS CONTENT START -->

        <section class="io-content inbound-orders-home-page">

          <header class="inbound-orders-home-page-header-container">

            <div class="inbound-orders-home-page-header">
              <div class="inbound-orders-home-page-header-title">
                Inbound Orders
              </div>
              <div class="inbound-orders-home-page-header-orders-counter">
                Total 5 Inbound Orders
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

          <main class="inbound-orders-home-page-order-list-container">

            <!-- ORDERS LIST ROW 1 -->
            <a class="io-hpor-row-container blue-flag" href="<?php echo SITEROOT; ?>/manage/dashboard/orders/ORDER FULFILLMENT DASHBOARD_STEP 2 ORDER JOBS.php">

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

            </a>

            <!-- ORDERS LIST ROW 2 -->
            <a class="io-hpor-row-container blue-flag" href="#">

              <div class="io-hpor-row-flag-icon">
                <img src="./assets/img/icon-color-function-system-blue.png">
              </div>
              <div class="io-hpor-row-job-badge-pickup-container">
                <div class="io-hpor-row-job-badge-install">
                  Install
                </div>
              </div>
              <div class="io-hpolh-order-number-text">
                1234567
              </div>
              <div class="io-hpolh-date-text">
                01/01
              </div>
              <div class="io-hpolh-name-text">
                Mary Winterfield
              </div>
              <div class="io-hpolh-type-icon">
                <img src="./assets/img/icon-order-type-email-unread.png">
              </div>
              <div class="io-hpolh-status-badge-container">
                <div class="io-hpolh-status-badge io-in-progress">
                  In Progress
                </div>
              </div>
              <div class="io-hpolh-design-text">
                <span>2</span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-fulfillment-status-text">
                D1: 7. Production
                <hr>
                D2: 8. Staging Area
              </div>
              <div class="io-hpolh-designer-text">
                <span>Kelly L.</span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-team-color-container">
                <div class="io-hpolh-team-color io-team-color-green">

                </div>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-assigned-text">
                <span>Sally L.</span>
                <span></span>
                <span>Zack O.</span>
              </div>
              <div class="io-hpolh-total-text">
                <span>$123.45</span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-order-time-text">
                <span>94 hrs</span>
                <span></span>
                <span>105 hrs</span>
              </div>
              <div class="io-hpolh-readerboard-icon">
                <img src="./assets/img/icon-readerboard-orange.png">
                <span></span>
                <span></span>
              </div>
            </a>

            <!-- ORDERS LIST ROW 3 -->
            <a class="io-hpor-row-container blue-flag" href="#">

              <div class="io-hpor-row-flag-icon">
                <img src="./assets/img/icon-color-function-system-blue.png">
              </div>
              <div class="io-hpor-row-job-badge-pickup-container">
                <div class="io-hpor-row-job-badge-delivery">
                  Delivery
                </div>
              </div>
              <div class="io-hpolh-order-number-text">
                1234567
              </div>
              <div class="io-hpolh-date-text">
                01/02
              </div>
              <div class="io-hpolh-name-text">
                Aloha Oregon
              </div>
              <div class="io-hpolh-type-icon">
                <img src="./assets/img/icon-order-type-shopping-cart.png">
              </div>
              <div class="io-hpolh-status-badge-container">
                <div class="io-hpolh-status-badge io-in-progress">
                  In Progress
                </div>
              </div>
              <div class="io-hpolh-design-text">
                <span>3</span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-fulfillment-status-text">
                D1: 3. Materials Recei...
                <hr>
                D2: 4. Materials on W...
                <hr>
                D3: 2. Layout
              </div>
              <div class="io-hpolh-designer-text">
                <span>Molly N.</span>
                <span></span>
                <span>Isabella O.</span>
                <span></span>
                <span>Molly N.</span>
              </div>
              <div class="io-hpolh-team-color-container">
                <div class="io-hpolh-team-color io-team-color-blue">

                </div>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-assigned-text">
                <span>Paul B.</span>
                <span></span>
                <span>Brittney L.</span>
                <span></span>
                <span>Rena I.</span>
              </div>
              <div class="io-hpolh-total-text">
                <span>$789.01</span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-order-time-text">
                <span>23 hrs</span>
                <span></span>
                <span>32 hrs</span>
                <span></span>
                <span>18 hrs</span>
              </div>
              <div class="io-hpolh-readerboard-icon">
                <img src="./assets/img/icon-readerboard-green.png">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>

            </a>

            <!-- ORDERS LIST ROW 4 -->
            <a class="io-hpor-row-container yellow-flag" href="#">

              <div class="io-hpor-row-flag-icon">
                <img src="./assets/img/icon-color-function-system-yellow.png">
              </div>
              <div class="io-hpor-row-job-badge-pickup-container">
                <div class="io-hpor-row-job-badge-online">
                  Online
                </div>
              </div>
              <div class="io-hpolh-order-number-text">
                1234567
              </div>
              <div class="io-hpolh-date-text">
                01/03
              </div>
              <div class="io-hpolh-name-text">
                Cookies Candy
              </div>
              <div class="io-hpolh-type-icon">
                <img src="./assets/img/icon-order-type-design-service.png">
              </div>
              <div class="io-hpolh-status-badge-container">
                <div class="io-hpolh-status-badge io-in-progress">
                  In Progress
                </div>
              </div>
              <div class="io-hpolh-design-text">
                1
              </div>
              <div class="io-hpolh-fulfillment-status-text">
                <span>1. Order Received</span>
              </div>
              <div class="io-hpolh-designer-text">
                <span>Kelly L.</span>
              </div>
              <div class="io-hpolh-team-color-container">
                <div class="io-hpolh-team-color io-team-color-green">

                </div>
              </div>
              <div class="io-hpolh-assigned-text">
                <span>Zack O.</span>
              </div>
              <div class="io-hpolh-total-text">
                <span>$567.89</span>
              </div>
              <div class="io-hpolh-order-time-text">
                <span>23 hrs</span>
              </div>
              <div class="io-hpolh-readerboard-icon">
                <img src="./assets/img/icon-readerboard-yellow.png">
              </div>

            </a>

            <!-- ORDERS LIST ROW 5 -->
            <a class="io-hpor-row-container red-flag" href="#">

              <div class="io-hpor-row-flag-icon">
                <img src="./assets/img/icon-color-function-system-red.png">
              </div>
              <div class="io-hpor-row-job-badge-pickup-container">
                <div class="io-hpor-row-job-badge-pickup">
                  Pickup
                </div>
              </div>
              <div class="io-hpolh-order-number-text">
                1234567
              </div>
              <div class="io-hpolh-date-text">
                01/03
              </div>
              <div class="io-hpolh-name-text">
                Joan Bell
              </div>
              <div class="io-hpolh-type-icon">
                <img src="./assets/img/icon-order-type-design-service.png">
              </div>
              <div class="io-hpolh-status-badge-container">
                <div class="io-hpolh-status-badge io-paused">
                  Paused
                </div>
              </div>
              <div class="io-hpolh-design-text">
                <span>2</span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-fulfillment-status-text">
                <span>D1: 2. Layout</span>
                <hr>
                <span>D2: 3. Materials Recei...</span>
              </div>
              <div class="io-hpolh-designer-text">
                <span>Jason P.</span>
                <span></span>
                <span>Isabella O.</span>
              </div>
              <div class="io-hpolh-team-color-container">
                <div class="io-hpolh-team-color io-team-color-orange">

                </div>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-assigned-text">
                <span>Tim E.</span>
                <span></span>
                <span>Rena I.</span>
              </div>
              <div class="io-hpolh-total-text">
                <span>$1074.12</span>
                <span></span>
                <span></span>
              </div>
              <div class="io-hpolh-order-time-text">
                <span>15 hr</span>
                <span></span>
                <span>20 hr</span>
              </div>
              <div class="io-hpolh-readerboard-icon">
                <img src="./assets/img/icon-readerboard-red.png">
                <span></span>
                <span></span>
              </div>

            </a>

          </main>

        </section>

        <!-- ORDER FULFILLMENT DASHBOARD_INBOUND ORDERS CONTENT END -->

      </div>
    </div>

    <script>
      var tab_active = 'orders';
    </script>

  </body>
</html>
