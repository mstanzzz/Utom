<?php

/*

'*CARD TYPES            *PREFIX           *WIDTH
'American Express       34, 37            15
'Diners Club            300 to 305, 36    14
'Carte Blanche          38                14
'Discover               6011              16
'EnRoute                2014, 2149        15
'JCB                    3                 16
'JCB                    2131, 1800        15
'Master Card            51 to 55          16
'Visa               	4                 13, 16
   

*/


class CreditCard{
	
	function getCardType($card_num){
		
		$type = 'Unknown';
		$card_num = preg_replace( '/[^a-zA-Z0-9]+/', '', $card_num);
		if(strlen($card_num) > 13){
			
			$first_2 = substr ($card_num,0,2);
			if($first_2 == '34' || $first_2 == '37'){
				$type = 'American Express';	
			}elseif($first_2 == '36'){
				$type = 'Diners Club';	
			}elseif($first_2 == '38'){
				$type = 'Carte Blanche';	
			}elseif($first_2 > 50 &&  $first_2 < 56){
				$type = 'Master Card';	
			}else{
				
				$first_4 = substr ($card_num,0,4);
				if($first_4 == '2014' || $first_4 == '2149'){
					$type = 'EnRoute';
				}elseif($first_4 == '2131' || $first_4 == '1800'){
					$type = 'JCB';
				}elseif($first_4 == '6011'){
					$type = 'Discover';
				}else{
					$first_3 = substr ($card_num,0,3);
					if($first_3 > 299 && $first_3 < 306){
						$type = 'American Diners Club';
					}else{
						$first = substr ($card_num,0,1);
						if($first = 3){
							$type = 'JCB';
						}
						if($first = 4){
							$type = 'Visa';
						}
					}
				}				
			}						
		}
	
		return $type;
	}
	
	
	
	
	function getLast4($card_num){
		
		$ret = 'Unknown';
		$card_num = preg_replace( '/[^a-zA-Z0-9]+/', '', $card_num);
		$len = strlen($card_num);
		if($len > 4){
			$ret = substr ($card_num,$len-4,4);
		}
		return $ret;
	
	}
	
	
						
						
	
}

?>

<!--

Public Function CreditCardType(ByVal CardNo As String) As String
    
'Just in case nothing is found
CreditCardType = "Unknown"

'Remove all spaces and dashes from the passed string
CardNo = Replace(Replace(CardNo, " ", ''), "-", '')

'Check that the minimum length of the string isn't less
'than fourteen characters and -is- numeric
If Len(CardNo) < 14 Or Not IsNumeric(CardNo) Then Exit Function

'Check the first two digits first
Select Case CInt(Left(CardNo, 2))
   Case 34, 37
      CreditCardType = "American Express"
   Case 36
      CreditCardType = "Diners Club"
   Case 38
      CreditCardType = "Carte Blanche"
   Case 51 To 55
      CreditCardType = "Master Card"
   Case Else

      'None of the above - so check the
	  'first four digits collectively
      Select Case CInt(Left(CardNo, 4))
	  
         Case 2014, 2149
            CreditCardType = "EnRoute"
         Case 2131, 1800
            CreditCardType = "JCB"
         Case 6011
            CreditCardType = "Discover"
         Case Else

            'None of the above - so check the
            'first three digits collectively
            Select Case CInt(Left(CardNo, 3))
               Case 300 To 305
                  CreditCardType = "American Diners Club"
               Case Else
         
               'None of the above -
               'so simply check the first digit
               Select Case CInt(Left(CardNo, 1))
                  Case 3
                     CreditCardType = "JCB"
                  Case 4
                    CreditCardType = "Visa"
               End Select

            End Select
			
      End Select
	  
End Select

End Function


-->


