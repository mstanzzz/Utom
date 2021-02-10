
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="../js/jquery.valid8.js"></script> 


<script>
$(document).ready(function() {

	/*
	$('#label').click(
		function () {
			alert("mmm");
		}
	);
	*/
	
	$('#label').valid8('Required');

});

</script>
</head>

<body>
<form action="v8.php" method="post">
					<label>Label</label>
            	
                    
                    <input id="label" tabindex="18" type="text" name="label" value='' />
                    
            
                    
                    <input type="submit">
</form>

</body>
</html>

