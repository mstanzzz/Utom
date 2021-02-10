const customerNameCont = document.querySelector('.customer-name');
var customerFullName = "JOHN. Smithson"
var customerLevel = "Lv. 3 Installer";
var customerLevelNum = 3;
var teamMembers = [
  {teamRole: "Supervisor", levelNumber: 5, installerName: "Mike Hilton", clockInStatus: true, status: "ONLINE"},
  {teamRole: "Installer", levelNumber: 3, installerName: "John Smithson (You)", clockInStatus: true, status: "ONLINE"},
  {teamRole: "Installer", levelNumber: 3, installerName: "George Michaels", clockInStatus: true, status: "ONLINE"},
  {teamRole: "Intern", levelNumber: 1, installerName: "Kevin McDonald", clockInStatus: true, status: "ONLINE"},
  {teamRole: "Designer", levelNumber: 4, installerName: "Ann Winterfield", clockInStatus: true, status: "ONLINE"}
]

// SET DATE
// var d = new Date();
// var dateMonth = d.getMonth()+1;
// var dateDay = d.getDate();
// var daysOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
// var dateYear = d.getFullYear();
// var pageID = document.querySelector('body').getAttribute('data-page');
// document.querySelector('.date').innerText = `${dateMonth}/${dateDay} ${daysOfWeek[d.getDay()]} ${dateYear}`;

const leftSidebarContainer = document.querySelector('.left-sidebar-container');
const leftSidebarContainerExpanded = document.querySelector('.left-sidebar-container.expanded');
const expandMenuBTN = document.querySelector('.expandMenuButton');
const btnLevelLeftSideBar = document.querySelector('.customer-level > div > span');

// customerNameCont.innerHTML = `<strong>${customerFullName.substring(0, 7)}</strong>`;
// btnLevelLeftSideBar.innerHTML = `<strong>${customerLevel.substring(0, 5)}</strong>`;

// // SET TIME
// (function startTime() {
//   var time = new Date();
//   var h = time.getHours();
//   var m = time.getMinutes();
//   var ampm = h >= 12 ? 'PM' : 'AM';
//   h = h % 12;
//   h = h ? h : 12;
//   m = checkTime(m);
//   document.querySelector('.time').innerText = `${h}:${m} ${ampm}`;
//   var t = setTimeout(startTime, 500);
// })();
//
// function checkTime(i) {
//   if (i < 10) {
//     i = "0" + i
//   };
//   return i;
// }

// EXPANDING MENU
expandMenuBTN.addEventListener('click', function (e) {expandMenu(e)}, false);
function expandMenu(e) {
  document.querySelector('.content-container').classList.toggle('left-sidebar-expanded');
  leftSidebarContainer.classList.toggle('expanded');
  if (leftSidebarContainer.classList.contains('expanded')) {
    document.querySelector('.menu-close').style.display = "block";
    document.querySelector('.menu-expand').style.display = "none";
  } else {
    document.querySelector('.menu-expand').style.display = "block";
    document.querySelector('.menu-close').style.display = "none";
  }
  if (!btnLevelLeftSideBar.parentNode.classList.contains('btn-small-' + customerLevelNum)) {
    btnLevelLeftSideBar.parentNode.setAttribute('class', 'btn-small-3 btn-shadow btn-level');
    customerNameCont.innerHTML = `<strong>${customerFullName.substring(0, 7)}</strong>`;
    btnLevelLeftSideBar.innerHTML = `<strong>${customerLevel.substring(0, 5)}</strong>`;
  } else {
    btnLevelLeftSideBar.parentNode.setAttribute('class', 'btn-installer btn-shadow btn-role');
    customerNameCont.innerHTML = `<strong>${customerFullName}</strong>`;
    btnLevelLeftSideBar.innerHTML = `<strong>${customerLevel}</strong>`;
  }
}

// CLOSE/OPEN NOTIFICATION MENU
const notificCenterCont = document.querySelector('.notification-center-container');
document.querySelector('.btn-notific-close').addEventListener('click', function(el) {
  notificCenterCont.classList.remove('open');
}, false);
document.querySelector('.btn-notific').addEventListener('click', function(e) {
  if (!notificCenterCont.classList.contains('full-screen')) {
    notificCenterCont.classList.add('open');
  }
  document.querySelector('.new-notifics-number').style.display = "none";
}, false);
// FULL SCREEN NOTIFICATION WINDOW
document.querySelector('.view-all-notification').addEventListener('click', function(el) {
  notificCenterCont.classList.replace('open', 'full-screen');
}, false);
document.querySelector('.btn-notific-page-close').addEventListener('click', function(el) {
  notificCenterCont.classList.remove('full-screen');
}, false);

// OPEN REMINDER OPTIONS WINDOW
const reminderWindowClose = document.querySelectorAll('.reminder-window-close');
const btnReminderWindowDelayJob = document.querySelector('.btn-reminder-window-delay-job');
const jobConfirmationContainer = document.querySelector('.job-confirmation-container');
const reminderWindowDelayTimeContainer = document.querySelector('.reminder-window-delay-time-container');
const btnReminderWindowDelayTimeConfirm = document.querySelector('.btn-reminder-window-delay-time-confirm');
const reminderWindowDelayTimeSuccessfulContainer = document.querySelector('.reminder-window-delay-time-successful-con');
const reminderConfirm = document.querySelector('.reminder-confirm');
const selectDashboardWindowBackground = document.querySelector('.select-dashboard-window-background');
const reminderWindowBackground = document.querySelector('.reminder-window-background');

// btnReminderWindowDelayJob.addEventListener('click', function() {
//   jobConfirmationContainer.style.display = "none";
//   reminderWindowDelayTimeContainer.classList.toggle('delay-job');
// }, false);
// btnReminderWindowDelayTimeConfirm.addEventListener('click', function() {
//   reminderWindowDelayTimeContainer.classList.toggle('delay-job');
//   reminderWindowDelayTimeSuccessfulContainer.classList.toggle('delayed-successfully');
// }, false);
// reminderConfirm.addEventListener('click', function() {
//   reminderWindowBackground.classList.toggle('reminder-window-open');
// }, false);
reminderWindowClose.forEach(function(e) {
    e.addEventListener('click', closeOpenReminderWindow, false);
});
function closeOpenReminderWindow() {
  reminderWindowBackground.classList.toggle('reminder-window-open');
}

// SELECTING DASHBOARD
const btnDashboardButton = document.querySelector('.btn-dashboard-button');
const selectDashboardCancel = document.querySelector('.select-dashboard-cancel');
const btnSelectDashboardPersonalCenter = document.querySelector('.btn-select-dashboard-buttons-personal-center');
const transitioningJobDashboard = document.querySelector('.transitioning-job-dashboard');

// btnDashboardButton.addEventListener('click', openCloseSelectDashboard, false);
// selectDashboardCancel.addEventListener('click', openCloseSelectDashboard, false);

// btnSelectDashboardPersonalCenter.addEventListener('click', function() {
//   selectDashboardWindowBackground.classList.toggle('select-dashboard-open');
//   transitioningJobDashboard.classList.add('entering-job-dashboard');
// }, false);

function openCloseSelectDashboard() {
  selectDashboardWindowBackground.classList.toggle('select-dashboard-open');
}

// TEAM MEMBER STATUS TABLE ROW OPEN/CLOSE
const viewButtons = document.querySelectorAll('.tms-mtmt-view-progress');
const teamMemberTableRow = document.querySelectorAll(".tms-mtmt-row");

teamMemberTableRow.forEach(function(el) {
  if (el.classList.contains('open')) {
    el.querySelector('.tms-mtmt-view-progress > span').innerHTML = 'MINIMIZE';
  } else {
    el.querySelector('.tms-mtmt-view-progress > span').innerHTML = 'VIEW';
  }
});

// Adding event listener for view buttons
viewButtons.forEach(function(el) {
  el.addEventListener('click', updateToggledRow, false);
});

// Adding open class for selected row
function updateToggledRow(el) {
    el.currentTarget.querySelector('span').innerHTML = 'MINIMIZE';
    el.currentTarget.parentNode.parentNode.classList.toggle("open");
    if (el.currentTarget.parentNode.parentNode.classList.contains('open')) {
      el.currentTarget.querySelector('span').innerHTML = 'MINIMIZE';
    } else {
      el.currentTarget.querySelector('span').innerHTML = 'VIEW';
    }
}

// Left sidebar tab selected style
switch(tab_active) {
  case "google_navigation_map":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-navigate-job-site-container');
    break;
  case "customer_information":
    var currentSelectedSidebarTab = document.querySelector('.viewing-design-preview-expanded-container');
    break;
  case "installation_progress":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-installation-progress-container');
    break;
  case "team_member_status":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-team-member-status-container');
    break;
  case "special_instructions":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-left-sidebar-special-instructions-container');
    break;
  case "job_site_documents":
    var currentSelectedSidebarTab = document.querySelector('.btn-sidebar-special-instructions-container');
    break;
  case "documenting_progress":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-left-sidebar-documenting-progress-container');
    break;
  case "design_preview":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-design-preview-container');
    break;
  case "issues_gallery":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-design-preview-issues-gallery-container');
    break;
  case "issues_during_installation":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-left-sidebar-issues-during-installation-container');
    break;
  case "document_center":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-design-preview-document-center-container');
    break;
  case "team_member_status":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-team-member-status-container');
    break;
  case "order_fulfillment_team_member_status":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-io-team-member-status-container');
    break;
  case "orders":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-inbound-orders-container');
    break;
  case "order-rooms":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-inbound-orders-container');
    break;
  case "order-room-details":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-inbound-orders-container');
    break;
  case "order-room-details-step-3":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-inbound-orders-container');
    break;
  case "order-fulfillment-status":
    var currentSelectedSidebarTab = document.querySelector('.btn-ijd-cd-inbound-orders-container');
    break;
  default:
    var currentSelectedSidebarTab = false;
}
var leftSidebarExpanded = document.querySelector('.expanded');
var allSidebarTabs = document.querySelectorAll('.left-sidebar-tabs-box-shadow');
var allSidebarTabsLink = document.querySelectorAll('.left-sidebar-tabs-box-shadow a');
var sidebarJobsiteLink = document.querySelectorAll('.btn-sidebar-special-instructions-subitem-viewing-text a');

allSidebarTabsLink.forEach(function(el) {
  el.addEventListener('click', function(el) {
    currentSelectedSidebarTab.classList.add('tab-selected');
  }, false);
});

if (currentSelectedSidebarTab) {
  if (leftSidebarExpanded) {
    document.querySelector('.viewing-order-fulfillment-container').style.display = "none";
    if (tab_active == "order-rooms" || tab_active == "order-room-details") {
      document.querySelector('.btn-ijd-cd-inbound-orders-container').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms-container').style.display = "flex";
    } else if (tab_active == "order-room-details-step-3") {
      document.querySelector('.btn-ijd-cd-inbound-orders-container').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-room-detail').style.display = "flex";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms-container').style.display = "flex";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms-container').style.flexDirection = "column";
    } else if (tab_active == "order-fulfillment-status") {
      document.querySelector('.btn-ijd-cd-inbound-orders-container').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-room-detail').style.background = "linear-gradient(to right, #85AEB3, #8FBFC6)";
      document.querySelector('.btn-ijd-cd-inbound-orders-room-detail').style.display = "flex";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms-container').style.display = "flex";
      document.querySelector('.btn-ijd-cd-inbound-orders-order-rooms-container').style.flexDirection = "column";
      document.querySelector('.btn-ijd-cd-order-fulfillment-status-container').style.display = "flex";
    }
  } else {
    document.querySelector('.viewing-ijd-cd-document-center-container').style.display = "none";
    document.querySelector('.viewing-order-fulfillment-container').style.display = "flex";
  }

  if (tab_active == "special_instructions" || tab_active == "job_site_documents") {
    document.querySelector('.btn-ijd-cd-left-sidebar-special-instructions-container').style.display = "none";
    document.querySelector('.btn-sidebar-special-instructions-container').classList.add('tab-selected');
    if (tab_active == "job_site_documents") {
      document.querySelector('.btn-sidebar-subitem-job-site-documents').classList.add('subitem-selected');
      document.querySelector('.btn-sidebar-subitem-job-site-documents a').innerText = "READING";
      document.querySelector('.btn-sidebar-special-instructions-subitem-viewing-text').innerText = "";
    }
  } else {
    currentSelectedSidebarTab.classList.add('tab-selected');
  }
}
