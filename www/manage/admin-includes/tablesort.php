<?php

// these can be used for anything you want to pass on the url
if(!isset($uid1)) $uid1 = 0;
if(!isset($uid2)) $uid2 = 0;

?>

<script type="text/javascript">

var filename = '<?php echo basename($_SERVER['PHP_SELF']); ?>';

function sortby(thisfile, sortby, a_d){
	var uid1 = <?php echo $uid1; ?>;
	var uid2 = <?php echo $uid2; ?>;
	
	var url = thisfile+"?sortby="+sortby+"&a_d="+a_d+"&uid1="+uid1+"&uid2="+uid2;


	//location.href = url; 
}

$(document).ready(function() {
	$("th.sortable").click(function(){
		
		var sortdata = $(this).attr("data-sortby");
		if ($(this).hasClass("sorted_ascending")){
			sortby(filename,sortdata,'d');
			$(this).removeClass("sorted_ascending").addClass("sorted_descending");
			$(this).find("i").removeClass("sorted_ascending").addClass("sorted_descending");
		}
		else if ($(this).hasClass("sorted_descending")){
			sortby(filename,sortdata,'a');
			$(this).removeClass("sorted_descending").addClass("sorted_ascending");
			$(this).find("i").removeClass("sorted_descending").addClass("sorted_ascending");
		}
		else {
			sortby(filename,sortdata,'a');
			$(this).addClass("sorted_ascending");
			$(this).find("i").addClass("sorted_ascending");
		}
	});
});

</script>
<?php

	if(!isset($a_d)) $a_d = 'a';
	if(!isset($sortby)) $sortby = '';
	

		$a_d_class = get_a_d_class($a_d);
		function get_a_d_class($a_d){
			switch ($a_d) {
				case 'a':
					return 'sorted_ascending';
					break;
				case 'd':
					return 'sorted_descending';
					break;
				default:
					return '';
			}
		}
		function addSortAttr($headertype, $bool){
			global $sortby, $a_d_class;
			$attrs = 'class="sortable';
			if ($sortby == $headertype){
				$attrs .= ' '.$a_d_class;
			}
			$attrs .= '"';
			if ($bool) {
				$attrs .= ' data-sortby="'.$headertype.'"';	
			}
			echo $attrs;
		}
?>