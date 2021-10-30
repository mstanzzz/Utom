<?php

/*

$db = $dbCustom->getDbConnect(SITE_N_DATABASE);

$sql = "SELECT *
		FROM diy_instructions
		WHERE diy_instructions.diy_instructions_id = (SELECT MAX(diy_instructions_id) FROM diy_instructions WHERE profile_account_id = '".$_SESSION['profile_account_id']."')";
$result = $dbCustom->getResult($db,$sql);

//echo "num_rows: ".$result->num_rows;
//echo "<br />";
//echo "<br />";

if($result->num_rows > 0){
	$object = $result->fetch_object();
	
	$img_1_id = $object->img_1_id;
	$img_2_id = $object->img_2_id;
	$img_3_id = $object->img_3_id;
	$top_1 = stripslashes($object->top_1);
	$top_2 = stripslashes($object->top_2);
	$top_3 = stripslashes($object->top_3);
	$p_1_head = stripslashes($object->p_1_head);
	$p_1_text = stripslashes($object->p_1_text);
	$p_2_head = stripslashes($object->p_2_head);
	$p_2_text = stripslashes($object->p_2_text);
	$p_3_head = stripslashes($object->p_3_head); 
	$p_3_text = stripslashes($object->p_3_text);
	$p_4_head = stripslashes($object->p_4_head);
	$p_4_text = stripslashes($object->p_4_text); 
	$p_5_head = stripslashes($object->p_5_head);  
	$p_5_text = stripslashes($object->p_5_text); 
	$p_6_head = stripslashes($object->p_6_head);  
	$p_6_text = stripslashes($object->p_6_text); 
	$p_7_head = stripslashes($object->p_7_head);  
	$p_7_text = stripslashes($object->p_7_text);
	$p_8_head = stripslashes($object->p_8_head);  
	$p_8_text = stripslashes($object->p_8_text);
	$p_9_head = stripslashes($object->p_9_head);  
	$p_9_text = stripslashes($object->p_9_text);

	
}else{
	$img_1_id = 0;
	$img_2_id = 0;
	$img_3_id = 0;
	$top_1 = '';
	$top_2 = '';
	$top_3 = '';
	$p_1_head = '';
	$p_1_text = '';
	$p_2_head = '';
	$p_2_text = '';
	
	$p_4_head = '';
	$p_4_text = ''; 
	
	$p_5_head = '';  
	$p_5_text = ''; 
	
	$p_6_head = '';  
	$p_6_text = ''; 
	$p_7_head = '';  
	$p_7_text = '';

	$p_8_head = '';  
	$p_8_text = '';

	$p_9_head = '';  
	$p_9_text = '';	
}

*/
$type_inst_array = array();
$sub_types_array= array();

$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'Wardrobe '.$i;
	$i++;
}
$type_inst_array[0]['type'] = 'Wardrobes';
$type_inst_array[0]['sub_types'] = $sub_types_array;


$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'Garage '.$i;
	$i++;
}
$type_inst_array[1]['type'] = 'Garage';
$type_inst_array[1]['sub_types'] = $sub_types_array;


$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'Wine Rack '.$i;
	$i++;
}
$type_inst_array[2]['type'] = 'Wine Racks';
$type_inst_array[2]['sub_types'] = $sub_types_array;



$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'Home Office '.$i;
	$i++;
}
$type_inst_array[3]['type'] = 'Home Office';
$type_inst_array[3]['sub_types'] = $sub_types_array;


$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'Wallbed '.$i;
	$i++;
}
$type_inst_array[4]['type'] = 'Wallbeds';
$type_inst_array[4]['sub_types'] = $sub_types_array;




$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'AABBCC '.$i;
	$i++;
}
$type_inst_array[5]['type'] = 'AABBCCs';
$type_inst_array[5]['sub_types'] = $sub_types_array;




$sub_types_array= array();
$i = 0;
while($i < 6){
	$sub_types_array[$i] = 'CCDDEEFF '.$i;
	$i++;
}
$type_inst_array[6]['type'] = 'CCDDEEFFs';
$type_inst_array[6]['sub_types'] = $sub_types_array;


/*
foreach($type_inst_array as $val){

	echo "<br />";
	echo $val['type'];
	echo "<br />";
	print_r($val['sub_types']);
	echo "<br />";
	echo "<br />";
}
echo "<br />";
echo "<br />";


exit;

*/
?>




<!--
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
	<span>Wardrobes</span>
	<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">

	<span class="my-customs-select-select-option js-default-value" 
			data-value="Wardrobes">
			Wardrobes
	</span>

	<span class="my-customs-select-select-option" 
			data-value="Wardrobes 1">
			Wardrobes 1
	</span>
	<span class="my-customs-select-select-option" 
			data-value="Wardrobes 2">
			Wardrobes 2
	</span>
	<span class="my-customs-select-select-option" 
			data-value="Wardrobes 3">
			Wardrobes 3
	</span>
	<span class="my-customs-select-select-option" 
			data-value="Wardrobes 4">
			Wardrobes 4
	</span>
	<span class="my-customs-select-select-option" 
			data-value="Wardrobes 5">
			Wardrobes 5
	</span>
</div>
</div>
</div>



<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Garage</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
	<span class="my-customs-select-select-option js-default-value" 
		data-value="Garage">
		Garage
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 1">
		Garage 1
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 2">
		Garage 2
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 3">
		Garage 3
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 4">
		Garage 4
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 5">
		Garage 5
	</span>
</div>
</div>
</div>


<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
	<span>Wine Racks</span>
	<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
	<span class="my-customs-select-select-option js-default-value" 
	data-value="Wine Racks">
		Wine Racks
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Wine Racks 1">
		Wine Racks 1
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Wine Racks 2">
		Wine Racks 2
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Wine Racks 3">
		Wine Racks 3
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Wine Racks 4">
		Wine Racks 4
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Wine Racks 5">
		Wine Racks 5
	</span>
</div>
</div>
</div>


<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Home Office</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Home Office">Home Office</span>
<span class="my-customs-select-select-option" data-value="Home Office 1">Home Office 1</span>
<span class="my-customs-select-select-option" data-value="Home Office 2">Home Office 2</span>
<span class="my-customs-select-select-option" data-value="Home Office 3">Home Office 3</span>
<span class="my-customs-select-select-option" data-value="Home Office 4">Home Office 4</span>
<span class="my-customs-select-select-option" data-value="Home Office 5">Home Office 5</span>
</div>
</div>
</div>


<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Wallbeds</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Wallbeds">Wallbeds</span>
<span class="my-customs-select-select-option" data-value="Wallbeds 1">Wallbeds 1</span>
<span class="my-customs-select-select-option" data-value="Wallbeds 2">Wallbeds 2</span>
<span class="my-customs-select-select-option" data-value="Wallbeds 3">Wallbeds 3</span>
<span class="my-customs-select-select-option" data-value="Wallbeds 4">Wallbeds 4</span>
<span class="my-customs-select-select-option" data-value="Wallbeds 5">Wallbeds 5</span>
</div>
</div>
</div>


???---------

								
<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Wardrobes</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
<span class="my-customs-select-select-option js-default-value" data-value="Wardrobes">Wardrobes</span>
<span class="my-customs-select-select-option" data-value="Wardrobes 1">Wardrobes 1</span>
<span class="my-customs-select-select-option" data-value="Wardrobes 2">Wardrobes 2</span>
<span class="my-customs-select-select-option" data-value="Wardrobes 3">Wardrobes 3</span>
<span class="my-customs-select-select-option" data-value="Wardrobes 4">Wardrobes 4</span>
<span class="my-customs-select-select-option" data-value="Wardrobes 5">Wardrobes 5</span>
</div>
</div>
</div>


<div class="my-custom-select-select-wrapper">
<div class="my-customs-select-select">
<div class="my-customs-select-select__trigger">
<span>Garage</span>
<div class="arrow-second"></div>
</div>
<div class="my-customs-select-select-options">
	<span class="my-customs-select-select-option js-default-value" 
		data-value="Garage">
		Garage
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 1">
		Garage 1
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 2">
		Garage 2
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 3">
		Garage 3
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 4">
		Garage 4
	</span>
	<span class="my-customs-select-select-option" 
		data-value="Garage 5">
		Garage 5
	</span>
</div>
</div>
</div>

--!>





