<?php




//--------------- functions ------------------

//=========================== Sections ===================================
function getSections(&$sectionlist,$xml){
    try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //print_r(array_values($sectionlist));
    $sqla = "select * from cabinetrySection left outer join cabinetrySectionGroupAssoc on cabinetrySectionGroupAssoc.cabinetrySectionID = cabinetrySection.cabinetrySectionID left outer join cabinetrySectionGroup on cabinetrySectionGroup.cabinetrySectionGroupID = cabinetrySectionGroupAssoc.cabinetrySectionGroupID left outer join collection_sections_assoc on  collection_sections_assoc.section_id = cabinetrySection.cabinetrySectionID left outer join collection on collection.collection_id = cabinetrySection.CollectionID where cabinetrySection.cabinetrySectionID in (".implode(",",$sectionlist).") order by CollectionID";
    print_r($sqla." - ");
	$resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
  	//echo json_encode($resulta);
	if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionData");
		while($rowa = $resulta->fetch_assoc())
		{
            
            //get current collection and set flag
            
            if ( $collflag != $rowa['collection_id']) {
                // make collection container
                $newnode2 = $newnode1->addChild("collection");
                $newnode2->addChild("id",$rowa['collection_id']);
                $newnode2->addChild("name",$rowa['collection_name']);
                $collflag = $rowa['collection_id'];
            } else {
                //$newnode2 = $newnode1;
            }
            
            // Add cabinetry section
           $newnode3 = $newnode2->addChild("cabinetrySection");
           $newnode3->addChild("id",$rowa['cabinetrySectionID']);
           $newnode3->addChild("name")->addCData($rowa['cabinetrySectionName']);
           if ($rowa['collection_name'] == "default") {
               $newnode3->addChild("isDefault","true");
           } else {
               $newnode3->addChild("isDefault","false");
           }
           
           // get group data if exists
           if ($rowa['cabinetrySectionGroupID'] != null) {
             $newnode4 = $newnode3->addChild("group");
             $newnode4->addChild("id",$rowa['cabinetrySectionGroupID']);
             $newnode4->addChild("name",$rowa['cabinetrySectionGroupName']);
           }
           
           // add default Section height
           $newnode3->addChild("defaultSectionHeight")->addCData($rowa['defaultSectionHeight']."mm");
           if ($rowa['usesFloorSupport'] == 1) {
               $newnode3->addChild("usesFloorSupport","true");
           } else {
               $newnode3->addChild("usesFloorSupport","false");
           }

            if ($rowa['isHutchStyle'] == 1) {
               $newnode3->addChild("isHutchStyle","true");
           } else {
               $newnode3->addChild("isHutchStyle","false");
           }

           //print_r($rowa['cabinetrySectionID']);
            // set each associated panel
			if ($rowa['cabinetrySectionID'] != "") {
            $sqlb = "select * from cabinetrySectionPanelAssoc left outer join panels on panels.panel_id =  cabinetrySectionPanelAssoc.cabinetrySectionPanelID  where cabinetrySectionPanelAssoc.cabinetrySectionID =".$rowa['cabinetrySectionID'];
            print_r($sqlb);
            $resultb = $dbCustom2->getResult($db2,$sqlb);
            if ($resultb) {
                while($rowb = $resultb->fetch_assoc()){
                    if (!in_array($rowb['panel_id'], $GLOBALS['panellist'] )) {
  	 					array_push($GLOBALS['panellist'],$rowb['panel_id']);
                    }
                    $newnode5 = $newnode3->addChild("cabinetrySectionPanel");
                    if ($rowb['CollectionID'] == 0) {
                       $newnode5->addChild("collection", "default");
                   } else {
                        $newnode5->addChild("collection",$rowb['CollectionID'] );
                  }
                    
                    $newnode5->addChild("id",$rowb['panel_id'] );
                    if ($rowb['hutchSystemHole'] > 0) {
                        $newnode5->addChild("hutchSystemHole",$rowb['hutchSystemHole']);
                    } 

                }
            }
			}
            
            // set each associated unit
            $sqlc = "select * from cabinetrySectionUnitAssoc left outer join units on units.unit_id =  cabinetrySectionUnitAssoc.cabinetrySectionUnitID  where cabinetrySectionUnitAssoc.cabinetrySectionID =".$rowa['cabinetrySectionID'];
            print_r($sqlb);
            $resultc = $dbCustom2->getResult($db2,$sqlc);
            if ($resultc) {
                //echo json_encode($resultc);
                while($rowc = $resultc->fetch_assoc()){
                    if (!in_array($rowc['unit_id'], $GLOBALS['unitlist'] )) {
  	 					array_push($GLOBALS['unitlist'],$rowc['unit_id']);
                    }
                   
                    $newnode6 = $newnode3->addChild("cabinetrySectionUnit");
                    if ($rowc['CollectionID'] == 0) {
                        $newnode6->addChild("collection", "default");
                    } else {
                        $newnode6->addChild("collection",$rowc['CollectionID'] );
                    }

                    $newnode6->addChild("id",$rowc['unit_id'] );
                    $newnode6->addChild("systemHole",$rowc['systemHole'] );
                }
            }
            
            // set each associated cleat
            $sqlc = "select * from cabinetrySectionCleatAssoc left outer join CleatUnits on CleatUnits.CleatID =  cabinetrySectionCleatAssoc.CleatID  where cabinetrySectionCleatAssoc.cabinetrySectionID =".$rowa['cabinetrySectionID'];
            print_r($sqlc);
            $resultc = $dbCustom2->getResult($db2,$sqlc);
            if ($resultc) {
                while($rowc = $resultc->fetch_assoc()){
                    if (!in_array($rowc['CleatID'], $GLOBALS['cleatlist'] )) {
  	 					array_push($GLOBALS['cleatlist'], $rowc['CleatID']);
                    }
                   
                    $newnode6a = $newnode3->addChild("cabinetrySectionCleat");
                    if ($rowc['CollectionID'] == 0) {
                        $newnode6a->addChild("collection", "default");
                    } else {
                        $newnode6a->addChild("collection",$rowc['CollectionID'] );
                    }
                    $newnode6a->addChild("id",$rowc['CleatID'] );
                    $newnode6a->addChild("systemHole",$rowc['systemHole'] );
                }
            }
            
            // set each associated toeplate
            $sqld = "select * from cabinetrySectionToePlateAssoc left outer join ToePlate on ToePlate.ToePlateID =  cabinetrySectionToePlateAssoc.ToePlateID  where cabinetrySectionToePlateAssoc.cabinetrySectionID =".$rowa['cabinetrySectionID'];
            print_r("***".$sqld."***");
            $resultd = $dbCustom2->getResult($db2,$sqld);
            if ($resultd) {
                while($rowd = $resultd->fetch_assoc()){
                    if (!in_array($rowd['ToePlateID'], $GLOBALS['toelist'] )) {
  	 					array_push($GLOBALS['toelist'],$rowd['ToePlateID']);
                    }
                    $newnode7 = $newnode3->addChild("cabinetrySectionToePlate");
                    if ($rowd['CollectionID'] == 0) {
                        $newnode7->addChild("collection", "default");
                    } else {
                        $newnode7->addChild("collection",$rowd['CollectionID'] );
                    }

                    $newnode7->addChild("id",$rowd['ToePlateID'] );
                    $newnode7->addChild("systemHole",$rowd['systemHole'] );
                }
            }
            
            // set each associated backing
            $sqle = "select * from cabinetrySectionBackingAssoc left outer join Backing on Backing.backingID =  cabinetrySectionBackingAssoc.cabinetrySectionBackingID  where cabinetrySectionBackingAssoc.cabinetrySectionID =".$rowa['cabinetrySectionID'];
            print_r($sqle);
            $resulte = $dbCustom2->getResult($db2,$sqle);
            if ($resulte) {
                while($rowe = $resulte->fetch_assoc()){
                    if (!in_array($rowe['backingID'], $GLOBALS['backinglist'] )) {
  	 					array_push($GLOBALS['backinglist'], $rowe['backingID']);
                    }
                   
                    $newnode8 = $newnode3->addChild("cabinetrySectionBacking");
                    if ($rowe['collectionID'] == 0) {
                        $newnode8->addChild("collection", "default");
                    } else {
                        $newnode8->addChild("collection",$rowe['collectionID'] );
                    }
                    $newnode8->addChild("id",$rowe['backingID'] );
                    $newnode8->addChild("offset",$rowe['offset'] );
                }
            }
                
        }
        

    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Units ===================================

function getUnits(&$unitlist,$xml){
    try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($unitinput);
   // print_r("+++".(string)$unitinput."+++");
    $sqla = "select * from units left outer join part_types on part_types.pt_id = units.partTypeID left join qtyCalculation on qtyCalculation.qtyCalcID = units.qtyCalcID where units.unit_id in (".implode(",",$unitlist).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
   
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionUnitData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetrySectionUnit");
           $newnode2->addChild("name") ->addCData($rowa['unit_name']);
           $newnode2->addChild("id",$rowa['unit_id']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
           if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
           $newnode3 = $newnode2->addChild("pricingData");

           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
		   if ($rowa['pricing_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['pricing_schema_id']);
		   }
           
           // add getComponents list
           $sqlb = "select * from units_components left join components on units_components.component_id = components.component_id left outer join part_types on part_types.pt_id = components.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid where unit_id =".$rowa['unit_id'];
	       //print_r("===".$sqlb."===");
           $resultb = $dbCustom2->getResult($db2,$sqlb);
		   
           $newnodeCPL = $newnode2->addChild("cabinetryComponentList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['component_id'], $GLOBALS['complist'] )) {
  	 					array_push($GLOBALS['complist'],$rowb['component_id']);
                    }
                    if ($rowb['component_id'] != 0) {
                    $newnodeCP = $newnode2->addChild("cabinetryComponent");
                    $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    if ($rowb['collectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['collectionID'] );
                    }
                    $newnodeCP->addChild("id", $rowb['component_id']);
                    $newnodeCP->addChild("count", $rowb['component_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("cabinetryComponent");
                    $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("typeName",$rowb['pt_name']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['required']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Components ===================================
function getComponents(&$complist,$xml){
	try{
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($compinput);
    $sqla = "select * from components left outer join part_types on part_types.pt_id = components.part_type_id left join qtyCalculation on qtyCalculation.qtyCalcID = components.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid join sectionwidthgroups on sectionwidthgroups.swg_id = components.widthConstraintsID where components.component_id in (".implode(",",$complist).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetryComponentData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetryComponent");
           $newnode2->addChild("name") ->addCData($rowa['component_name']);
           $newnode2->addChild("id",$rowa['component_id']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
            if ($rowa['collectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
           $newnode3 = $newnode2->addChild("pricingData");
           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           if ($rowa['pricing_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['pricing_schema_id']);
		   }
           
           //Add Constraints
           //if (!in_array($id, $complist)) {
			//	$complist[] = $id;
				

				$newnode4 = $newnode2->addChild("constraintData");
				$newnode4->addChild("systemHoleOccupancy",$rowa['systemHoleOccupancy']);
                $newnode4->addChild("systemHolePaddingTop",$rowa['systemHolePaddingTop']);
				$newnode4->addChild("widthConstraintsID",$rowa['swg_name']);
                $newnode4->addChild("allowCustomWidth",tf($rowa['allowCustomWidth']));
				$newnode5 = $newnode2->addChild("componentPartRenderDataCommandList");
		  	 				$newnode5->addAttribute("collection","defaultElevation");
		  	 				$newnode5->addAttribute("id",$rowa['CPRDCLName']);

			//}
           
           // add getComponentParts list
           $sqlb = "select * from component_parts left join parts on component_parts.part_id = parts.part_id left outer join part_types on part_types.pt_id = parts.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid where component_id =".$rowa['component_id'];
	       $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("componentPartList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['part_id'], $GLOBALS['partslist'] )) {
  	 					array_push($GLOBALS['partslist'],$rowb['part_id']);
                    }
                    if ($rowb['part_type_id'] != 0) {
                    $newnodeCP = $newnode2->addChild("componentPart");
                    $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    if ($rowb['CollectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['CollectionID'] );
                    }

                    $newnodeCP->addChild("id", $rowb['part_id']);
                    $newnodeCP->addChild("count", $rowb['part_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("componentPart");
                    $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("typeName", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['part_req']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Backing ===================================
function getBacking(&$backinginput,$xml){
	try{
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($cleatinput);
    $sqla = "select * from Backing left outer join part_types on part_types.pt_id = Backing.partTypeID left join qtyCalculation on qtyCalculation.qtyCalcID = CleatUnits.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where Backing.backingID in (".implode(",",$backinginput).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionBackingData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetrySectionBacking");
           $newnode2->addChild("name")->addCData($rowa['backingName']);
           $newnode2->addChild("id",$rowa['backingID']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
            if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
          
           $newnode3 = $newnode2->addChild("pricingData");
           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           if ($rowa['price_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['price_schema_id']);
		   }
           
           $newnode5 = $newnode2->addChild("componentPartRenderDataCommandList");
		  	 				$newnode5->addAttribute("collection","defaultElevation");
		  	 				$newnode5->addAttribute("id",$rowa['CPRDCLName']);
           
           
           // add getComponentParts list
           $sqlb = "select * from backing_parts left join parts on backing_parts.part_id = parts.part_id left outer join part_types on part_types.pt_id = parts.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where backingID =".$rowa['backingID'];
	      // print_r("***".$sqlb."***");
           $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("componentPartList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['part_id'], $GLOBALS['partslist'] )) {
  	 					array_push($GLOBALS['partslist'],$rowb['part_id']);
                    }
                    if ($rowb['part_type_id'] != 0){
                    $newnodeCP = $newnode2->addChild("componentPart");
                    $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    if ($rowb['CollectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['CollectionID'] );
                    }
  
                    $newnodeCP->addChild("id", $rowb['part_id']);
                    $newnodeCP->addChild("count", $rowb['part_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("componentPart");
                    $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("typeName", $rowb['CPRDCLName']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['part_req']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Cleats ===================================
function getCleats(&$cleatinput,$xml){
	try{ 
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($cleatinput);
    $sqla = "select * from CleatUnits left outer join part_types on part_types.pt_id = CleatUnits.partTypeID left join qtyCalculation on qtyCalculation.qtyCalcID = CleatUnits.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where CleatUnits.CleatID in (".implode(",",$cleatinput).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionCleatData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetrySectionCleat");
           $newnode2->addChild("name")->addCData($rowa['CleatName']);
           $newnode2->addChild("id",$rowa['CleatID']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
            if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
          
           $newnode3 = $newnode2->addChild("pricingData");
           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           if ($rowa['price_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['price_schema_id']);
		   }
           
           $newnode5 = $newnode2->addChild("componentPartRenderDataCommandList");
		  	 				$newnode5->addAttribute("collection","defaultElevation");
		  	 				$newnode5->addAttribute("id",$rowa['CPRDCLName']);
           
           
           // add getComponentParts list
           $sqlb = "select * from cleats_parts left join parts on cleats_parts.part_id = parts.part_id left outer join part_types on part_types.pt_id = parts.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where CleatID =".$rowa['CleatID'];
	      // print_r("***".$sqlb."***");
           $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("componentPartList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['part_id'], $GLOBALS['partslist'] )) {
  	 					array_push($GLOBALS['partslist'],$rowb['part_id']);
                    }
                    if ($rowb['part_type_id'] != 0){
                    $newnodeCP = $newnode2->addChild("componentPart");
                    $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    if ($rowb['CollectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['CollectionID'] );
                    }
  
                    $newnodeCP->addChild("id", $rowb['part_id']);
                    $newnodeCP->addChild("count", $rowb['part_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("componentPart");
                    $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("typeName", $rowb['CPRDCLName']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['part_req']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Toe Plates ===================================
function getToePlates(&$toeplateinput,$xml){
	try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
   //$something = array($toeplateinput);
    $sqla = "select * from ToePlate left outer join part_types on part_types.pt_id = ToePlate.partTypeID left join qtyCalculation on qtyCalculation.qtyCalcID = ToePlate.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where ToePlateID in (".implode(",",$toeplateinput).")";
	//print_r($sqla);
    $resulta = $dbCustom2->getResult($db2,$sqla);
	//print_r(" --ok--  ");
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionToePlateData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetrySectionToePlate");
           $newnode2->addChild("name") ->addCData($rowa['ToePlateName']);
           $newnode2->addChild("id",$rowa['ToePlateID']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
            if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
          
           $newnode3 = $newnode2->addChild("pricingData");
           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           if ($rowa['price_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['price_schema_id']);
		   }
           
           $newnode4 = $newnode2->addChild("constraintData");
           $newnode4->addChild("systemHoleOccupancy", $rowa['systemHoleOccupancy']);
           $newnode4->addChild("systemHoleIncrement", $rowa['systemHoleIncrement']);
           $newnode4->addChild("allowCustomWidth", tf($rowa['allowCustomWidth']));
           
           $newnode5 = $newnode2->addChild("componentPartRenderDataCommandList");
		  	 				$newnode5->addAttribute("collection","defaultElevation");
		  	 				$newnode5->addAttribute("id",$rowa['CPRDCLName']);
           
           
           // add getComponentParts list
           $sqlb = "select * from ToePlate_parts left join parts on ToePlate_parts.part_id = parts.part_id left outer join part_types on part_types.pt_id = parts.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid  where ToePlateID =".$rowa['ToePlateID'];
	       $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("componentPartList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['part_id'], $GLOBALS['partslist'] )) {
  	 					array_push($GLOBALS['partslist'],$rowb['part_id']);
                    }
                    if ($rowb['part_type_id'] != 0) {
                    $newnodeCP = $newnode2->addChild("componentPart");
                    $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    if ($rowb['CollectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['CollectionID'] );
                    }
                    $newnodeCP->addChild("id", $rowb['part_id']);
                    $newnodeCP->addChild("count", $rowb['part_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("componentPart");
                    $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("typeName", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['part_req']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Panels ===================================
function getPanels(&$panellist,$xml){
	try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
 
   // print_r(" * ".$panelinput." * ");
    $sqla = "select * from panels left outer join part_types on part_types.pt_id = panels.partTypeID left join qtyCalculation on qtyCalculation.qtyCalcID = panels.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid where panels.panel_id in (".implode(",",$panellist).")";
	 //print_r("***".$sqla."***");
    
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("cabinetrySectionPanelData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("cabinetrySectionPanel");
           $newnode2->addChild("name") ->addCData($rowa['panel_name']);
           $newnode2->addChild("id",$rowa['panel_id']);
           $newnode2->addChild("typeID",$rowa['pt_name']);
           //$newnode2->addChild("typeID","sectionPanel");
            if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }
          
           $newnode3 = $newnode2->addChild("pricingData");
           $newnode3->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           if ($rowa['pricing_schema_id'] == null) {
			   $newnode3->addChild("pricingSchema")->addAttribute("id","defaultParentPricing");
		   } else {
           		$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['pricing_schema_id']);
		   }
           
           $newnode5 = $newnode2->addChild("componentPartRenderDataCommandList");
		  	 				$newnode5->addAttribute("collection","defaultElevation");
		  	 				$newnode5->addAttribute("id",$rowa['CPRDCLName']);
           
           
           // add getComponentParts list
           $sqlb = "select * from panels_parts left join parts on panels_parts.part_id = parts.part_id left outer join part_types on part_types.pt_id = parts.part_type_id left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid where panel_id =".$rowa['panel_id'];
	       $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("componentPartList");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['part_id'], $GLOBALS['partslist'] )) {
  	 					array_push($GLOBALS['partslist'],$rowb['part_id']);
                    }
                    if ($rowb['part_type_id'] != 0) {
                    $newnodeCP = $newnode2->addChild("componentPart");
                    if ($rowb['pt_name'] == "sectionPanel") {
                        $newnodeCP->addChild("typeID", "sectionPanel");
                    } else {
                        $newnodeCP->addChild("typeID", $rowb['pt_name']);
                    }
                   
                    if ($rowb['CollectionID'] == 0) {
                        $newnodeCP->addChild("collection", "default");
                    } else {
                        $newnodeCP->addChild("collection",$rowb['CollectionID'] );
                    }
                    $newnodeCP->addChild("id", $rowb['part_id']);
                    $newnodeCP->addChild("count", $rowb['part_qty'] );
                    
                    $newnodeCPLa = $newnodeCPL->addChild("componentPart");
                    if ($rowb['pt_name'] == "sectionPanel") {
                        $newnodeCPLa->addAttribute("typeID", "sectionPanel");
                    } else {
                        $newnodeCPLa->addAttribute("typeID", $rowb['pt_name']);
                    }
                    $newnodeCPLa->addAttribute("typeName", $rowb['pt_name']);
                    $newnodeCPLa->addAttribute("required", tf($rowb['part_req']));
                    }
                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Parts ===================================
function getParts(&$partslist,$xml){
	try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($partsinput);
    $sqla = "select * from parts left outer join part_types on part_types.pt_id = parts.part_type_id left join qtyCalculation on qtyCalculation.qtyCalcID = parts.qtyCalcID left join CPRDCL on CPRDCL.CPRDCLid = part_types.CPRDCLid where part_id in (".implode(",",$partslist).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("componentPartData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("componentPart");
           $newnode2->addChild("name") ->addCData($rowa['part_name']);
           $newnode2->addChild("id",$rowa['part_id']);
           if ($rowa['pt_name'] == "sectionPanel") {
                $newnode2->addChild("typeID","sectionPanel");
           } else {
               $newnode2->addChild("typeID",$rowa['pt_name']);
           }
           
            if ($rowa['CollectionID'] == 0) {
               $newnode2->addChild("isDefault","true");
           } else {
               $newnode2->addChild("isDefault","false");
           }

           if ($rowa["elvCollID"] != "") {

          $newnodea = $newnode2->addChild("componentPartRenderData");
                $newnodeb = $newnodea->addChild("elevation");
                   $newnodec = $newnodeb->addChild("graphicCommand");
                   $newnodec ->addAttribute("collection", $rowa["elvCollID"]);
                    $newnodec ->addAttribute("id",$rowa['elvID']);

           }
               
            $newnoded = $newnode2->addChild("componentPartDimensionData");
                $newnoded->addChild("width",$rowa['width']);
                if ($rowa['widthOffset'] != '') {
                    $newnoded->addChild("widthOffset",$rowa['widthOffset']);
                }
                $newnoded->addChild("height",$rowa['height']);
                if ($rowa['heightOffset'] != '') {
                    $newnoded->addChild("heightOffset",$rowa['heightOffset']);
                }
                $newnoded->addChild("depth",$rowa['depth']);
                if ($rowa['depthOffset'] != '') {
                    $newnoded->addChild("depthOffset",$rowa['depthOffset']);
                }

           $newnode2->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           $newnode3 = $newnode2->addChild("pricingData");
           
           $newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           $newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['pricing_schema_id']);
           
           $newnode4 = $newnode3->addChild("unitPrice");
                $newnode4 ->addAttribute("price",$rowa['price_unit']);
                $newnode4 ->addAttribute("quantityPerUnit",$rowa['qty_unit']);
          
           
           // add material
           $sqlb = "select * from materials left join parts on parts.material_id = materials.mat_id left outer join material_types on material_types.mat_type_id = materials.mat_id  where part_id =".$rowa['part_id'];
	       $resultb = $dbCustom2->getResult($db2,$sqlb);
           $newnodeCPL = $newnode2->addChild("material");
           if ($resultb) {
               while($rowb = $resultb->fetch_assoc())
		        {
                    if (!in_array($rowb['material_id'], $GLOBALS['materiallist'] )) {
  	 					array_push($GLOBALS['materiallist'],$rowb['material_id']);
                    }
                   // if ($rowb['type_id'] == 0) {
                        $newnodeCPL->addChild("collection","default" );
                  //  } else {
                  //      $newnodeCPL->addChild("collection",$rowb['type_id'] );
                  //  }
                    
                    $newnodeCPL->addChild("id", $rowb['material_id']);

                }
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

//=========================== Materials ===================================
function getMaterials(&$materiallist,$xml){
	try {
    $dbCustom2 = new DbCustom();
    $db2 = $dbCustom2->getDbConnect(COMPONENTS_DATABASE);
    //$something = array($materialinput);
    $sqla = "select * from materials left outer join material_types on material_types.mat_type_id = materials.type_id left outer join finish on finish.finish_id = materials.finish_id left join qtyCalculation on qtyCalculation.qtyCalcID = materials.qtyCalcID where materials.mat_id in (".implode(",",$materiallist).")";
	//print_r("***".$sqla."***");
    $resulta = $dbCustom2->getResult($db2,$sqla);
	$count = 0;
    
    if ($resulta) {
        $collflag = null;
        $newnode1 = $xml->addChild("materialData");
		while($rowa = $resulta->fetch_assoc())
		{
           $newnode2 = $newnode1->addChild("material");
           $newnode2->addChild("name") ->addCData($rowa['mat_name']);
           $newnode2->addChild("id",$rowa['mat_id']);
           $newnode2->addChild("typeID",$rowa['mat_type_id']);
           $newnode2->addChild("typeName") ->addCData($rowa['mat_type_name']);
           $newnode2->addChild("quantityEquation") ->addCData($rowa['qtyCalc']);
           
           $newnode3 = $newnode2->addChild("pricingData");
           //$newnode3->addChild("quantityCalculationSchema")->addAttribute("id",$rowa['qty_schema_id']);
           //$newnode3->addChild("pricingSchema")->addAttribute("id",$rowa['price_schema_id']);
           
           //ASK SAM======================================
           $newnode4 = $newnode3->addChild("price");
		   		$newnode4 ->addChild("pricePerUnit",1.5);
				   $newnode4 ->addChild("method","linear-foot");
                //$newnode4 ->addAttribute("pricePerUnit",$rowa['price_unit']);
                //$newnode4 ->addAttribute("quantityPerUnit",$rowa['qty_unit']);

           $newnode3 = $newnode2->addChild("materialRenderData");
           $newnode4 = $newnode3->addChild("fill");
           if ($rowa['tool_image'] != null) {  
               $newnode5 = $newnode4->addChild("imageFill");
               $newnode5->addAttribute("url",  $rowa['tool_image']);
           }
           
           if ($rowa['tool_color'] != null) {
               $newnode6 = $newnode4->addChild("solidFill");
               
                   $colorval = str_replace("#","0x", $rowa['tool_color']);
               
               $newnode6->addAttribute("color", $colorval);
               $newnode6->addAttribute("alpha", $rowa['tool_alpha']);
           }
        }
    }
	} catch (Exception $e) {
		$xml->addChild("error", $e);
	}
}

function tf($value) {
    if ($value == 1) {return "true";} else {return "false";}
}

?>