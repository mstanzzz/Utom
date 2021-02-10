<?php


function setTopToolActiveTab($tab)
{
	
	if($tab == 'general-setup'){
		if(strpos($_SERVER['REQUEST_URI'], 'material-type') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'material-tier') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'finish') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'texture') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'panel-brands') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'collections') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'dimensions') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'graphical-command') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'general-setup') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'core') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'colors') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'section-width-group') > 0
			
			
			
		){
			return "class='active'";		
		}
	}


	if($tab == 'material-setup'){
		if((strpos($_SERVER['REQUEST_URI'], 'material') > 0 && (strpos($_SERVER['REQUEST_URI'], 'material-') < 1))
			|| strpos($_SERVER['REQUEST_URI'], 'edge-banding') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'material-setup') > 0
		){
			return "class='active'";		
		}
	}


	if($tab == 'pricing'){
		if(strpos($_SERVER['REQUEST_URI'], 'pricing-schemas') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'qty-schemas') > 0		
			|| strpos($_SERVER['REQUEST_URI'], 'price-method') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'price-schema-unit') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'price-calc') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'qty-calc-para') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'qty-calc') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'discount-tier') > 0
		){
			return "class='active'";		
		}
	}


	if($tab == 'pieces'){
		if(strpos($_SERVER['REQUEST_URI'], 'panel') > 0
			//|| (strpos($_SERVER['REQUEST_URI'], 'part') > 0 && strpos($_SERVER['REQUEST_URI'], 'part-') < 1)
			|| strpos($_SERVER['REQUEST_URI'], '-part') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'part') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'component') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'pieces') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'unit') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'cabinetry-') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'cleat') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'backing') > 0
			|| strpos($_SERVER['REQUEST_URI'], 'toe-plate') > 0
			
		){
			return "class='active'";		
		}
	}
	
	
	
	return '';	
	
}



?>



		<ul class="nav nav-tabs">
        	<li <?php echo setTopToolActiveTab('general-setup'); ?>><a href="<?php echo $ste_root;?>/manage/tool/general-setup.php">General Setup</a></li>
            
            <li <?php echo setTopToolActiveTab('material-setup'); ?>><a href="<?php echo $ste_root;?>/manage/tool/material-setup.php">Material Setup</a></li>
            
            <li <?php echo setTopToolActiveTab('pricing'); ?>><a href="<?php echo $ste_root;?>/manage/tool/pricing-schemas.php">Pricing</a></li>
            
            <li <?php echo setTopToolActiveTab('pieces'); ?>><a href="<?php echo $ste_root;?>/manage/tool/pieces.php">Pieces</a></li>
              
		</ul>
        
        
        