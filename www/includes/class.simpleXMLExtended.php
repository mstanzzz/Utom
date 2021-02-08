<?php

class SimpleXMLExtended extends SimpleXMLElement{
    
    public function addCData($cdata_text){
        $node = dom_import_simplexml($this); 
        $no = $node->ownerDocument; 
        $node->appendChild($no->createCDATASection($cdata_text)); 
    }
  
    static public function addCDataTo($parentNode, $cdata_text){
        $node = dom_import_simplexml($parentNode);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text)); 
    }
}
?>
