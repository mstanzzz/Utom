<?php

if(defined('OUTPUT_XML_MESSAGE_FUNCTIONS') == false){
    
    //Sets the flag
        define('OUTPUT_XML_MESSAGE_FUNCTIONS', true);
        
    //File Includes
        include 'xmlElementNameConstants.php';
        
    /////////////////////////////////////////////////
    //XML Functions//////////////////////////////////
    /////////////////////////////////////////////////
        function writeAllGlobalMessagesToXML($xml){
            
        //Begins XML messages
            $messagesXMLNode = $xml->addChild(XML_MESSAGES);

            //Error Messages
                writeErrorMessagesToXML($messagesXMLNode);
            
            //Alert Messages
                writeAlertMessagesToXML($messagesXMLNode);
            
            //Soft Messages
                writeSoftMessagesToXML($messagesXMLNode);
        }
        
        function writeErrorMessagesToXML($xml){
            
        //Declares the globals
            global $_ERROR_MESSAGES;
            
        //Dummy Control
            if(!isset($_ERROR_MESSAGES) || count($_ERROR_MESSAGES) == 0)
                return;
            
        //Error Messages
            while(count($_ERROR_MESSAGES) > 0){
                $errorMessage = array_shift($_ERROR_MESSAGES);
                SimpleXMLExtended::addCDataTo($xml->addChild(XML_ERROR_MESSAGE), $errorMessage);
            }
        }
        
        function writeAlertMessagesToXML($xml){
            
        //Declares the globals
            global $_ALERT_MESSAGES;
            
        //Dummy Control
            if(!isset($_ALERT_MESSAGES) || count($_ALERT_MESSAGES) == 0)
                return;
            
        //Alert Messages
            while(count($_ALERT_MESSAGES) > 0){
                $alertMessage = array_shift($_ALERT_MESSAGES);
                SimpleXMLExtended::addCDataTo($xml->addChild(XML_ALERT_MESSAGE), $alertMessage);
            }
        }
        
        function writeSoftMessagesToXML($xml){
            
        //Declares the globals
            global $_SOFT_MESSAGES;
            
        //Dummy Control
            if(!isset($_SOFT_MESSAGES) || count($_SOFT_MESSAGES) == 0)
                return;
            
        //Soft Messages
            while(count($_SOFT_MESSAGES) > 0){
                $softMessage = array_shift($_SOFT_MESSAGES);
                SimpleXMLExtended::addCDataTo($xml->addChild(XML_SOFT_MESSAGE), $softMessage);
            }
        }
}
?>
