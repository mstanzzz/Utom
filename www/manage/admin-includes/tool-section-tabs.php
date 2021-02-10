<?php 

if($tab == 'general-setup'){

	$block = '';	
		
	$block .= "<ul class='nav nav-tabs'>";
	
	$block .= "<li ".setActiveTab('material-type.php')."><a href='material-type.php'>Material Type</a></li>";
	
	$block .= "<li ".setActiveTab('material-tier.php')."><a href='material-tier.php'>Material Tier</a></li>";
	
	$block .= "<li ".setActiveTab('finish.php')."><a href='finish.php'>Finish</a></li>";
	
	$block .= "<li ".setActiveTab('texture.php')."><a href='texture.php'>Texture</a></li>";
	
	$block .= "<li ".setActiveTab('panel-brands.php')."><a href='panel-brands.php'>Panel Brands</a></li>";
	
	$block .= "<li ".setActiveTab('collections.php')."><a href='collections.php'>Collections</a></li>";			
				
	$block .= "<li ".setActiveTab('dimensions.php')."><a href='dimensions.php'>Dimensions</a></li>";
	
	$block .= "<li ".setActiveTab('section-width-group.php')."><a href='section-width-group.php'>Section Width Groups</a></li>";
	
	$block .= "<li ".setActiveTab('core.php')."><a href='core.php'>Cores</a></li>";
	
	$block .= "<li ".setActiveTab('colors.php')."><a href='colors.php'>Colors</a></li>";				
				
	//$block .= "<li ".setActiveTab('graphical-command.php')."><a href='graphical-command.php'>Graphical Command</a></li>";							
				
	$block .= "</ul>";
	
	echo $block;

}




if($tab == 'material-setup'){
	
	$block = '';	
		
	$block .= "<ul class='nav nav-tabs'>";
	
	$block .= "<li ".setActiveTab('material.php')."><a href='material.php'>Material</a></li>";
	
	$block .= "<li ".setActiveTab('edge-banding.php')."><a href='edge-banding.php'>Edge Banding</a></li>";
				
	$block .= "</ul>";
	
	echo $block;
	
}

if($tab == 'pricing'){
	
	$block = '';	
		
	$block .= "<ul class='nav nav-tabs'>";
	
	$block .= "<li ".setActiveTab('pricing-schemas.php')."><a href='pricing-schemas.php'>Pricing Schema</a></li>";
	
	$block .= "<li ".setActiveTab('qty-schemas.php')."><a href='qty-schemas.php'>QTY Schema</a></li>";
		
	//$block .= "<li ".setActiveTab('price-method.php')."><a href='price-method.php'>Price Method</a></li>";
	
	//$block .= "<li ".setActiveTab('price-schema-unit.php')."><a href='price-schema-unit.php'>Price Schema Unit</a></li>";
	
	$block .= "<li ".setActiveTab('price-calc-params.php')."><a href='price-calc-params.php'>Price Calc Param</a></li>";	
	
	$block .= "<li ".setActiveTab('qty-calc-params.php')."><a href='qty-calc-params.php'>QTY Calc Param</a></li>";	
	
	$block .= "<li ".setActiveTab('qty-calc.php')."><a href='qty-calc.php'>QTY Calculation</a></li>";
	
	$block .= "<li ".setActiveTab('discount-tier.php')."><a href='discount-tier.php'>Discount Tiers</a></li>";
	
	$block .= "<li ".setActiveTab('discounts-to-users.php')."><a href='discounts-to-users.php'>Discounts To Users</a></li>";
				
	$block .= "</ul>";
	
	echo $block;
	
}


if($tab == 'pieces'){
	
	
	
	$block = '';	
		
	$block .= "<ul class='nav nav-tabs'>";
	
	$block .= "<li ".setActiveTab('panel.php')."><a href='panel.php'>Section Panels</a></li>";
	
	$block .= "<li ".setActiveTab('part.php')."><a href='part.php'>Constructed Parts</a></li>";
        
    $block .= "<li ".setActiveTab('fixed-part.php')."><a href='fixed-part.php'>Catalog Parts</a></li>";
	
	//$block .= "<li ".setActiveTab('part-type.php')."><a href='part-type.php'>Part Types</a></li>";	

	$block .= "<li ".setActiveTab('component.php')."><a href='component.php'>Components</a></li>";	
	
	$block .= "<li ".setActiveTab('unit.php')."><a href='unit.php'>Units</a></li>";	
	
	$block .= "<li ".setActiveTab('cabinetry-section.php')."><a href='cabinetry-section.php'>Cabinetry Sections</a></li>";		

	$block .= "<li ".setActiveTab('cleat.php')."><a href='cleat.php'>Cleats</a></li>";	
	
	$block .= "<li ".setActiveTab('backing.php')."><a href='backing.php'>Backing</a></li>";	
	
	$block .= "<li ".setActiveTab('toe-plate.php')."><a href='toe-plate.php'>Toe Plates</a></li>";
				
	$block .= "</ul>";
	
	echo $block;
	
}


