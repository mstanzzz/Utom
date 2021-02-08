<?php

class ShippingCalculator  {
	// Defaults
	var $weight = 1;
	var $weight_unit = "lb";
	var $size_length = 4;
	var $size_width = 8;
	var $size_height = 2;
	var $size_unit = "in";
	var $debug = false; // Change to true to see XML sent and recieved 
	
	// Batch (get all rates in one go, saves lots of time)
	var $batch_ups = false; // Currently Unavailable
	var $batch_usps = true; 
	var $batch_fedex = false; // Currently Unavailable
	
	// Config (you can either set these here or send them in a config array when creating an instance of the class)
	var $services;
	var $from_zip;
	var $from_state;
	var $from_country;
	var $to_zip;
	var $to_state;
	var $to_country;
	var $ups_access;
	var $ups_user;
	var $ups_pass;
	var $ups_account;
	var $usps_user;
	var $fedex_account;
	var $fedex_meter;
	
	var $is_fedex = 1;
	
	// Results
	var $rates;
	
	// Setup Class with Config Options
	function ShippingCalculator($config) {
		if($config) {
			foreach($config as $k => $v) $this->$k = $v;
		}
	}
	
	// Calculate
	function calculate($company = NULL,$code = NULL) {
		$this->rates = NULL;
		$services = $this->services;
		if($company and $code) $services[$company][$code] = 1;


		if($this->is_fedex){
			
			
			if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){    
				$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/onlinecl'; 
			}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
				$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
			}else{
				$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
			}
			
			
			$path_to_wsdl = $_SERVER['DOCUMENT_ROOT']."/includes/fedex/wsdl/RateService_v16.wsdl";		
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient($path_to_wsdl, array('trace' => 1));
			
		}

		foreach($services as $company => $codes) {
	
			/*
			if($company == 'fedex'){
				$path_to_wsdl = $_SERVER['DOCUMENT_ROOT']."/includes/fedex/wsdl/RateService_v16.wsdl";		
				ini_set("soap.wsdl_cache_enabled", "0");
				$client = new SoapClient($path_to_wsdl, array('trace' => 1));
				
			}
			*/			
			
			foreach($codes as $code => $name) {
				switch($company) {
					case "ups": 
						/*if($this->batch_ups == true) $batch[] = $code; // Batch calculation currently unavaiable
						else*/ $this->rates[$company][$code] = $this->calculate_ups($code);
						break;
					case "usps":
						if($this->batch_usps == true) $batch[] = $code;
						else $this->rates[$company][$code] = $this->calculate_usps($code);
						break;
					case "fedex": 
						/*if($this->batch_fedex == true) $batch[] = $code; // Batch calculation currently unavaiable
						else*/ $this->rates[$company][$code] = $this->calculate_fedex($code, $client);
						break;
				}
			}
			// Batch Rates
			//if($company == "ups" and $this->batch_ups == true and count($batch) > 0) $this->rates[$company] = $this->calculate_ups($batch);
			if($company == "usps" and $this->batch_usps == true and count($batch) > 0) $this->rates[$company] = $this->calculate_usps($batch);
			//if($company == "fedex" and $this->batch_fedex == true and count($batch) > 0) $this->rates[$company] = $this->calculate_fedex($batch);
		}
		
		return $this->rates;
	}
	
	// Calculate UPS
	function calculate_ups($code) {
		$url = "https://www.ups.com/ups.app/xml/Rate";
    	$data = '<?xml version="1.0"?>  
<AccessRequest xml:lang="en-US">  
	<AccessLicenseNumber>'.$this->ups_access.'</AccessLicenseNumber>  
	<UserId>'.$this->ups_user.'</UserId>  
	<Password>'.$this->ups_pass.'</Password>  
</AccessRequest>  
<?xml version="1.0"?>  
<RatingServiceSelectionRequest xml:lang="en-US">  
	<Request>  
		<TransactionReference>  
			<CustomerContext>Bare Bones Rate Request</CustomerContext>  
			<XpciVersion>1.0001</XpciVersion>  
		</TransactionReference>  
		<RequestAction>Rate</RequestAction>  
		<RequestOption>Rate</RequestOption>  
	</Request>  
	<PickupType>  
		<Code>01</Code>  
	</PickupType>  
	<Shipment>  
		<Shipper>  
			<Address>  
				<PostalCode>'.$this->from_zip.'</PostalCode>  
				<CountryCode>'.$this->from_country.'</CountryCode>  
			</Address>  
		<ShipperNumber>'.$this->ups_account.'</ShipperNumber>  
		</Shipper>  
		<ShipTo>  
			<Address>  
				<PostalCode>'.$this->to_zip.'</PostalCode>  
				<CountryCode>'.$this->to_country.'</CountryCode>  
			<ResidentialAddressIndicator/>  
			</Address>  
		</ShipTo>  
		<ShipFrom>  
			<Address>  
				<PostalCode>'.$this->from_zip.'</PostalCode>  
				<CountryCode>'.$this->from_country.'</CountryCode>  
			</Address>  
		</ShipFrom>  
		<Service>  
			<Code>'.$code.'</Code>  
		</Service>  
		<Package>  
			<PackagingType>  
				<Code>02</Code>  
			</PackagingType>  
			<Dimensions>  
				<UnitOfMeasurement>  
					<Code>IN</Code>  
				</UnitOfMeasurement>  
				<Length>'.($this->size_unit != "in" ? $this->convert_sze($this->size_length,$this->size_unit,"in") : $this->size_length).'</Length>  
				<Width>'.($this->size_unit != "in" ? $this->convert_sze($this->size_width,$this->size_unit,"in") : $this->size_width).'</Width>  
				<Height>'.($this->size_unit != "in" ? $this->convert_sze($this->size_height,$this->size_unit,"in") : $this->size_height).'</Height>  
			</Dimensions>  
			<PackageWeight>  
				<UnitOfMeasurement>  
					<Code>LBS</Code>  
				</UnitOfMeasurement>  
				<Weight>'.($this->weight_unit != "lb" ? $this->convert_weight($this->weight,$this->weight_unit,"lb") : $this->weight).'</Weight>  
			</PackageWeight>  
		</Package>  
	</Shipment>  
</RatingServiceSelectionRequest>'; 
		
		// Curl
		$results = $this->curl($url,$data);
		
		// Debug
		if($this->debug == true) {
			print "<xmp>".$data."</xmp><br />";
			print "<xmp>".$results."</xmp><br />";
		}
		
		// Match Rate
		preg_match('/<MonetaryValue>(.*?)<\/MonetaryValue>/',$results,$rate);
		
		if(isset($rate[1])){
			return $rate[1];	
		}
		
	}
	
	// Calculate USPS
	function calculate_usps($code) {
		// Weight (in lbs)
		if($this->weight_unit != 'lb') $weight = $this->convert_weight($weight,$this->weight_unit,'lb');
		else $weight = $this->weight;
		// Split into Lbs and Ozs
		$lbs = floor($weight);
		$ozs = ($weight - $lbs)  * 16;
		if($lbs == 0 and $ozs < 1) $ozs = 1;
		// Code(s)
		$array = true;
		if(!is_array($code)) {
			$array = false;
			$code = array($code);
		}
		
		$url = "http://Production.ShippingAPIs.com/ShippingAPI.dll";
		$data = 'API=RateV2&XML=<RateV2Request USERID="'.$this->usps_user.'">';
		foreach($code as $x => $c) $data .= '<Package ID="'.$x.'"><Service>'.$c.'</Service><ZipOrigination>'.$this->from_zip.'</ZipOrigination><ZipDestination>'.$this->to_zip.'</ZipDestination><Pounds>'.$lbs.'</Pounds><Ounces>'.$ozs.'</Ounces><Size>REGULAR</Size><Machinable>TRUE</Machinable></Package>';
		$data .= '</RateV2Request>';
		
		// Curl
		$results = $this->curl($url,$data);
		
		// Debug
		if($this->debug == true) {
			print "<xmp>".$data."</xmp><br />";
			print "<xmp>".$results."</xmp><br />";
		}
		
		// Match Rate(s)
		preg_match_all('/<Package ID="([0-9]{1,3})">(.+?)<\/Package>/',$results,$packages);
		foreach($packages[1] as $x => $package) {
			preg_match('/<Rate>(.+?)<\/Rate>/',$packages[2][$x],$rate);
			$rates[$code[$package]] = $rate[1];
		}
		if($array == true) return $rates;
		else return $rate[1];
	}
	
	// Calculate FedEX
	/*
	function calculate_fedex($code) {
		
		// original
		$url = "https://gatewaybeta.fedex.com/GatewayDC";
		
		//$url = "https://ws.fedex.com:443/web-services";
		
		
		
		$data = '<?xml version="1.0" encoding="UTF-8" ?>
<FDXRateRequest xmlns:api="http://www.fedex.com/fsmapi" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="FDXRateRequest.xsd">
	<RequestHeader>
		<CustomerTransactionIdentifier>Express Rate</CustomerTransactionIdentifier>
		<AccountNumber>'.$this->fedex_account.'</AccountNumber>
		<MeterNumber>'.$this->fedex_meter.'</MeterNumber>
		<CarrierCode>'.(in_array($code,array('FEDEXGROUND','GROUNDHOMEDELIVERY')) ? 'FDXG' : 'FDXE').'</CarrierCode>
	</RequestHeader>
	<DropoffType>REGULARPICKUP</DropoffType>
	<Service>'.$code.'</Service>
	<Packaging>YOURPACKAGING</Packaging>
	<WeightUnits>LBS</WeightUnits>
	<Weight>'.number_format(($this->weight_unit != 'lb' ? convert_weight($this->weight,$this->weight_unit,'lb') : $this->weight), 1, '.', '').'</Weight>
	<OriginAddress>
		<StateOrProvinceCode>'.$this->from_state.'</StateOrProvinceCode>
		<PostalCode>'.$this->from_zip.'</PostalCode>
		<CountryCode>'.$this->from_country.'</CountryCode>
	</OriginAddress>
	<DestinationAddress>
		<StateOrProvinceCode>'.$this->to_state.'</StateOrProvinceCode>
		<PostalCode>'.$this->to_zip.'</PostalCode>
		<CountryCode>'.$this->to_country.'</CountryCode>
	</DestinationAddress>
	<Payment>
		<PayorType>SENDER</PayorType>
	</Payment>
	<PackageCount>1</PackageCount>
</FDXRateRequest>';
		
		// Curl
		$results = $this->curl($url,$data);
		
		// Debug
		if($this->debug == true) {
			print "<xmp>".$data."</xmp><br />";
			print "<xmp>".$results."</xmp><br />";
		}
	
		// Match Rate
		preg_match('/<NetCharge>(.*?)<\/NetCharge>/',$results,$rate);
		
		
		return $rate[1];
	}

*/



/*  Jeremiah
Production Password: uHQyF9oFVqU1QY0vIPiEg0Yip

FedEx Account Number : 221108213

Production Meter Number : 107818641

Production URL: https://ws.fedex.com:443/web-services

Supported Web Services:	 FedEx Web Services for Shipping
Authentication Key:	 pe74aJ9xmXk58O7X
Meter Number:	 107818641
*/


	function calculate_fedex($code, $client) {


			$request['WebAuthenticationDetail'] = array(
				'UserCredential' =>array(
					'Key' => 'pe74aJ9xmXk58O7X', //'3vQvjcCj6xMahfoG', 
					'Password' => 'uHQyF9oFVqU1QY0vIPiEg0Yip', //'KebUSB1dRVlBDns8kCZbiSAdL'
				)
			); 
			$request['ClientDetail'] = array(
				'AccountNumber' => '221108213', //'510087321', 
				'MeterNumber' => '107818641', //'118674547'
			);
			$request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Rate Request using PHP ***');
			$request['Version'] = array(
				'ServiceId' => 'crs', 
				'Major' => '16', 
				'Intermediate' => '0', 
				'Minor' => '0'
			);
			
			//$request['ReturnTransitAndCommit'] = true;
			//$request['RequestedShipment']['DropoffType'] = 'REGULAR_PICKUP'; // valid values REGULAR_PICKUP, REQUEST_COURIER, ...
			//$request['RequestedShipment']['ShipTimestamp'] = date('c');
			
			$request['RequestedShipment']['ServiceType'] = $code; // valid values STANDARD_OVERNIGHT, PRIORITY_OVERNIGHT, FEDEX_GROUND, ...
			//$request['RequestedShipment']['ServiceType'] = $code;
			
			//$request['RequestedShipment']['PackagingType'] = 'YOUR_PACKAGING'; // valid values FEDEX_BOX, FEDEX_PAK, FEDEX_TUBE, YOUR_PACKAGING, ...
			/*
			$request['RequestedShipment']['TotalInsuredValue']=array(
				'Ammount'=>100,
				'Currency'=>'USD'
			);
			*/
			
	
			$request['RequestedShipment']['Shipper'] = array(
					'Contact' => array(
						'PersonName' => 'Sender Name',
						'CompanyName' => 'Sender Company Name',
						'PhoneNumber' => ''
					),
					'Address' => array(
						'StreetLines' => array('Address Line 1'),
						'City' => '',
						'StateOrProvinceCode' => $this->from_state,
						'PostalCode' => $this->from_zip,
						'CountryCode' => 'US'
					)
				);
	
	
		//var $from_zip;
		//var $from_state;
		//var $from_country;
		//var $to_zip;
		//var $to_state;
		//var $to_country;
			
			
			$request['RequestedShipment']['Recipient'] = array(
					'Contact' => array(
						'PersonName' => 'Recipient Name',
						'CompanyName' => 'Company Name',
						'PhoneNumber' => ''
					),
					'Address' => array(
						'StreetLines' => array('Address Line 1'),
						'City' => '',
						'StateOrProvinceCode' => '',
						'PostalCode' => $this->to_zip,
						'CountryCode' => 'US',
						'Residential' => false
					)
				);
			
			/*
			$request['RequestedShipment']['ShippingChargesPayment'] = array(
					'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
					'Payor' => array(
						'ResponsibleParty' => array(
							'AccountNumber' => '510087321',
							'CountryCode' => 'US'
						)
					)
				);
			*/	
				
			
			$request['RequestedShipment']['PackageCount'] = '1';
			
			$request['RequestedShipment']['RequestedPackageLineItems'] = array(
					'SequenceNumber'=>1,
					'GroupPackageCount'=>1,
					'Weight' => array(
						'Value' => $this->weight,
						'Units' => 'LB'
					)
					
					
					/*
					,
					'Dimensions' => array(
						'Length' => 15,
						'Width' => 10,
						'Height' => 10,
						'Units' => 'IN'
					)
					*/
				);
				
			
			//$request['RequestedShipment']['TotalWeight'] = '1';	
			
	
			$response = $client->getRates($request);
	
			
			
		//return	print_r($response->HighestSeverity);
			
		//return strpos($response->HighestSeverity , 'ERROR');	
		
		
		
		
		
		if(strpos($response->HighestSeverity , 'ERROR') == true || strpos($response->HighestSeverity , 'error') == true){
			return -1;	
		}				
			
		if(!isset($response->RateReplyDetails)){
			return -1;
		}
			
		if(!isset($response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount)){
			return -1;
		}
				
		return $response->RateReplyDetails->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount; 
		
	
	}

	
/*
this is the response

SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
<SOAP-ENV:Header/><SOAP-ENV:Body>
<RateReply xmlns="http://fedex.com/ws/rate/v16">
<HighestSeverity>SUCCESS</HighestSeverity>
<Notifications>
<Severity>SUCCESS</Severity>
<Source>crs</Source>
<Code>0</Code>
<Message>Request was successfully processed. </Message>
<LocalizedMessage>Request was successfully processed. </LocalizedMessage>
</Notifications>

<TransactionDetail>
	<CustomerTransactionId> *** Rate Request using PHP ***</CustomerTransactionId>
</TransactionDetail>

<Version>
	<ServiceId>crs</ServiceId>
	<Major>16</Major>
	<Intermediate>0</Intermediate>
	<Minor>0</Minor>
</Version>

<RateReplyDetails>
	<ServiceType>INTERNATIONAL_PRIORITY</ServiceType>
	<PackagingType>YOUR_PACKAGING</PackagingType>
	<DeliveryStation>YVRA </DeliveryStation>
	<DeliveryDayOfWeek>MON</DeliveryDayOfWeek>
	<DeliveryTimestamp>2015-04-06T12:00:00</DeliveryTimestamp>
	<CommitDetails>
		<CommodityName>DOCUMENTS</CommodityName>
		<ServiceType>INTERNATIONAL_PRIORITY</ServiceType>
		<CommitTimestamp>2015-04-06T12:00:00</CommitTimestamp>
		<DayOfWeek>MON</DayOfWeek>
		<DestinationServiceArea>AM</DestinationServiceArea>
		<BrokerToDestinationDays>0</BrokerToDestinationDays>
		<CommitMessages>
			<Code>108</Code>
			<Message>WEEKEND DEL AVAILABLE. SH REQD WITH WEEKEND DELIVERY</Message>
		</CommitMessages>
		<CommitMessages>
			<Code>134</Code>
			<Message>REQUEST COMPLETED</Message>
		</CommitMessages>
		<DeliveryMessages>BY NOON IF NO CUSTOMS DELAY</DeliveryMessages>
		<DelayDetails>
			<Date>2015-04-05</Date>
			<DayOfWeek>SUN</DayOfWeek>
			<Level>COUNTRY</Level>
			<Point>DESTINATION</Point>
			<Type>NO_SERVICE_AREA_DELIVERY</Type>
			<Description>NO SVC AREA DELIVERY</Description>
		</DelayDetails>
		<DocumentContent>DOCUMENTS_ONLY</DocumentContent>
		<RequiredDocuments>INTERNATIONAL_AIRWAY_BILL</RequiredDocuments>
	</CommitDetails>

	<DestinationAirportId>YVR</DestinationAirportId>
	<IneligibleForMoneyBackGuarantee>false</IneligibleForMoneyBackGuarantee>
	<OriginServiceArea>A2</OriginServiceArea><DestinationServiceArea>A3</DestinationServiceArea>
	<SignatureOption>SERVICE_DEFAULT</SignatureOption>
	<ActualRateType>PAYOR_ACCOUNT_SHIPMENT</ActualRateType>
	
	<RatedShipmentDetails>
		<ShipmentRateDetail>
			<RateType>PAYOR_ACCOUNT_SHIPMENT</RateType>
			<RateScale>0000000</RateScale>
			<RateZone>US001O</RateZone>
			<PricingCode>ACTUAL</PricingCode>
			<RatedWeightMethod>ACTUAL</RatedWeightMethod>
			<CurrencyExchangeRate>
				<FromCurrency>USD</FromCurrency>
				<IntoCurrency>USD</IntoCurrency>
				<Rate>1.0</Rate>
			</CurrencyExchangeRate>
			<DimDivisor>139</DimDivisor>
			<DimDivisorType>COUNTRY</DimDivisorType>
			<FuelSurchargePercent>1.5</FuelSurchargePercent>
			<TotalBillingWeight>
				<Units>LB</Units>
				<Value>50.0</Value>
			</TotalBillingWeight>
			<TotalBaseCharge>
				<Currency>USD</Currency>
				<Amount>332.04</Amount>
			</TotalBaseCharge>
			
			<TotalFreightDiscounts>
				<Currency>USD</Currency>
				<Amount>0.0</Amount>
			</TotalFreightDiscounts>
			<TotalNetFreight>
				<Currency>USD</Currency>
				<Amount>332.04</Amount>
			</TotalNetFreight>
			<TotalSurcharges>
				<Currency>USD</Currency>
				<Amount>13.98</Amount>
			</TotalSurcharges>
			<TotalNetFedExCharge>
				<Currency>USD</Currency>
				<Amount>346.02</Amount>
			</TotalNetFedExCharge>
			<TotalTaxes>
				<Currency>USD</Currency>
				<Amount>0.0</Amount>
			</TotalTaxes>
			<TotalNetCharge>
				<Currency>USD</Currency>
				<Amount>346.02</Amount>
			</TotalNetCharge>
			<TotalRebates>
				<Currency>USD</Currency>
				<Amount>0.0</Amount>
			</TotalRebates>
			<Surcharges>
				<SurchargeType>ADDITIONAL_HANDLING</SurchargeType>
				<Description>Additional handling surcharge - dimension</Description>
				<Amount>
					<Currency>USD</Currency>
					<Amount>9.0</Amount>
				</Amount>
			</Surcharges>
			<Surcharges>
				<SurchargeType>FUEL</SurchargeType>
				<Description>Fuel</Description>
				<Amount>
					<Currency>USD</Currency>
					<Amount>4.98</Amount>
				</Amount>
			</Surcharges>
		</ShipmentRateDetail>
	</RatedShipmentDetails>
</RateReplyDetails>
</RateReply>
</SOAP-ENV:Body></SOAP-ENV:Envelope>


*/		

	
	
		/*
		me for the developet center
		mstanzzz
		nathannn1A
		
		Mine:

Required for All Web Services
Developer Test Key:	 3vQvjcCj6xMahfoG
Required for FedEx Web Services for Intra Country Shipping in US and Global
Test Account Number:	 510087321
Test	Meter Number:	 118674547
Required for FedEx Web Services for Office and Print
Test	FedEx Office Integrator ID:	 123
Test	Client Product ID:	 TEST
Test	Client Product Version:	 9999
		
	
	
	
	
Jeremiah's	
	
Test Password:iBX0Vs9Sw8f3am94m3ZurHoEA
Test Account Number:510087380 (for FedEx Web Services for Shipping only)
Test Meter Number:118675867 (for FedEx Web Services for Shipping only)

Production Password: uHQyF9oFVqU1QY0vIPiEg0Yip

FedEx Account Number : 221108213

Production Meter Number : 107818641

Production URL: https://ws.fedex.com:443/web-services

Supported Web Services: FedEx Web Services for Shipping

Supported Web Services:	 FedEx Web Services for Shipping
Authentication Key:	 pe74aJ9xmXk58O7X
Meter Number:	 107818641
	
	
	
Jeff's
Production account information

Production Password: kyKDga8FLgdtkbj8ZPHT0mdgn

FedEx Account Number : 221108213

Production Meter Number : 107749872

Production URL: https://ws.fedex.com:443/web-services	
	
	
		
		
		*/
	
	
	
	
	
	// Curl
	function curl($url,$data = NULL) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		if($data) {
			curl_setopt($ch, CURLOPT_POST,1);  
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		}  
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		$contents = curl_exec ($ch);
		
		return $contents;
		
		curl_close ($ch);
	}
	
	// Convert Weight
	function convert_weight($weight,$old_unit,$new_unit) {
		$units['oz'] = 1;
		$units['lb'] = 0.0625;
		$units['gram'] = 28.3495231;
		$units['kg'] = 0.0283495231;
		
		// Convert to Ounces (if not already)
		if($old_unit != "oz") $weight = $weight / $units[$old_unit];
		
		// Convert to New Unit
		$weight = $weight * $units[$new_unit];
		
		// Minimum Weight
		if($weight < .1) $weight = .1;
		
		// Return New Weight
		return round($weight,2);
	}
	
	// Convert Size
	function convert_size($size,$old_unit,$new_unit) {
		$units['in'] = 1;
		$units['cm'] = 2.54;
		$units['feet'] = 0.083333;
		
		// Convert to Inches (if not already)
		if($old_unit != "in") $size = $size / $units[$old_unit];
		
		// Convert to New Unit
		$size = $size * $units[$new_unit];
		
		// Minimum Size
		if($size < .1) $size = .1;
		
		// Return New Size
		return round($size,2);
	}
	
	// Set Value
	function set_value($k,$v) {
		$this->$k = $v;
	}
}
?>