<?php 
if($_SESSION['profile_account_id'] == 1  && strpos($_SERVER['HTTP_HOST'], 'closetstogo.com') !== false){

?>  
<script type="text/javascript">
  
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  
  
  ga('create', 'UA-446717-1', 'auto');
  
  ga('send', 'pageview');
  
 

var trackOutboundLink = function(url) {
	
   ga('send', 'event', 'outbound', 'click', url, {'hitCallback':
     function () {
     	document.location = url;
	 
     }
   });
   
}


function timer11(){ga('send', 'event', 'TimeOnPage', '1', '11-30 seconds', { 'nonInteraction': 1 });}
function timer31(){ga('send', 'event', 'TimeOnPage', '2', '31-60 seconds', { 'nonInteraction': 1 });}
function timer61(){ga('send', 'event', 'TimeOnPage', '3', '61-180 seconds', { 'nonInteraction': 1 });}
function timer181(){ga('send', 'event', 'TimeOnPage', '4', '181-600 seconds', { 'nonInteraction': 1 });}
function timer601(){ga('send', 'event', 'TimeOnPage', '5', '601-1800 seconds', { 'nonInteraction': 1 });}
function timer1801(){ga('send', 'event', 'TimeOnPage', '6', '1801+ seconds', { 'nonInteraction': 1 });}
ga('send', 'event', 'TimeOnPage', '0', '0-10 seconds', { 'nonInteraction': 1 });
setTimeout(timer11,11000);
setTimeout(timer31,31000);
setTimeout(timer61,61000);
setTimeout(timer181,181000);
setTimeout(timer601,601000);
setTimeout(timer1801,1801000);
 


</script>
<?php }else{ ?>

<script>
var trackOutboundLink = function(url) {
   
}


</script>

<?php } ?>