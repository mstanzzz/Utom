Braintree_Subscription Object ( 
	[_attributes] => Array ( 
    	[addOns] => Array ( ) 
        [balance] => 0.00 
        [billingDayOfMonth] => 17 
        [billingPeriodEndDate] => DateTime Object ( ) 
        [billingPeriodStartDate] => DateTime Object ( ) 
        [currentBillingCycle] => 1 
        [daysPastDue] => 
        [discounts] => Array ( ) 
        [failureCount] => 0 
        [firstBillingDate] => DateTime Object ( ) 
        [id] => bqwch6 
        [merchantAccountId] => ClosetsToGo 
        [neverExpires] => 1 
        [nextBillAmount] => 0.25 
        [nextBillingPeriodAmount] => 0.25 
        [nextBillingDate] => DateTime Object ( ) 
        [numberOfBillingCycles] => 
        [paidThroughDate] => DateTime Object ( ) 
        [paymentMethodToken] => 8d258 
        [planId] => nc8b 
        [price] => 0.25 
        [status] => Active 
        [trialDuration] => 
        [trialDurationUnit] => day 
        [trialPeriod] => 
        [descriptor] => Braintree_Descriptor Object ( 
        	[_attributes] => Array ( [name] => [phone] => 
         ) 
    ) 
    [transactions] => Array ( 
    	[0] => Braintree_Transaction Object ( 
        	[_attributes] => Array ( 
            	[id] => dzp6w2 
                [status] => submitted_for_settlement 
                [type] => sale 
                [currencyIsoCode] => USD 
                [amount] => 0.25 
                [merchantAccountId] => ClosetsToGo 
                [orderId] => 
                [createdAt] => DateTime Object ( ) 
                [updatedAt] => DateTime Object ( ) 
                [customer] => Array ( 
                	 [id] => 52 
                     [firstName] => 
                     [lastName] => 
                     [company] => Your Company 2 
                     [email] => 
                     [website] => 
                     [phone] => 
                     [fax] => 
                )
                [billing] => Array ( 
                	[id] => 
                    [firstName] => 
                    [lastName] => 
                    [company] => 
                    [streetAddress] => 
                    [extendedAddress] => 
                    [locality] => 
                    [region] => 
                    [postalCode] => 
                    [countryName] => 
                    [countryCodeAlpha2] => 
                    [countryCodeAlpha3] => 
                    [countryCodeNumeric] => 
                )
                [refundId] => 
                [refundIds] => Array ( ) 
                [refundedTransactionId] => 
                [settlementBatchId] => 
                [shipping] => Array ( 
                	[id] => 
                    [firstName] => 
                    [lastName] => 
                    [company] => 
                    [streetAddress] => 
                    [extendedAddress] => 
                    [locality] => 
                    [region] => 
                    [postalCode] => 
                    [countryName] => 
                    [countryCodeAlpha2] => 
                    [countryCodeAlpha3] => 
                    [countryCodeNumeric] => 
                ) 
                [customFields] => 
                [avsErrorResponseCode] => 
                [avsPostalCodeResponseCode] => I 
                [avsStreetAddressResponseCode] => I 
                [cvvResponseCode] => I 
                [gatewayRejectionReason] => 
                [processorAuthorizationCode] => 892QYW 
                [processorResponseCode] => 1000 
                [processorResponseText] => Approved 
                [purchaseOrderNumber] => 
                [taxAmount] => 
                [taxExempt] => 
                [creditCard] => Array ( 
                	[token] => 8d258 
                    [bin] => 411111 
                    [last4] => 1111 
                    [cardType] => Visa 
                    [expirationMonth] => 01 
                    [expirationYear] => 2014 
                    [customerLocation] => US 
                    [cardholderName] => 
                ) 
                [statusHistory] => Array ( 
                	[0] => Braintree_Transaction_StatusDetails Object ( 
                    	[_attributes] => Array ( 
                        	[timestamp] => DateTime Object ( ) 
                            [status] => authorized 
                            [amount] => 0.25 
                            [user] => mike@closetstogo.com 
                            [transactionSource] => Recurring 
                        ) 
                    ) 
                    [1] => Braintree_Transaction_StatusDetails Object ( 
                    	[_attributes] => Array ( 
                        	[timestamp] => DateTime Object ( ) 
                            [status] => submitted_for_settlement 
                            [amount] => 0.25 
                            [user] => mike@closetstogo.com 
                            [transactionSource] => Recurring 
                        ) 
                    ) 
                )
                [planId] => nc8b 
                
                
                
                
                [subscriptionId] => bqwch6 
                
                
                
                
                
                [subscription] => Array ( 
                	[billingPeriodEndDate] => DateTime Object ( ) 
                    [billingPeriodStartDate] => DateTime Object ( ) 
                ) 
                [addOns] => Array ( ) 
                [discounts] => Array ( ) 
                [descriptor] => Braintree_Descriptor Object ( 
                	[_attributes] => Array ( 
                    	[name] => 
                        [phone] => 
                    ) 
                ) 
                [creditCardDetails] => Braintree_Transaction_CreditCardDetails Object ( 
                	[_attributes:protected] => Array ( 
                    	[token] => 8d258 
                        [bin] => 411111 
                        [last4] => 1111 
                        [cardType] => Visa 
                        [expirationMonth] => 01 
                        [expirationYear] => 2014 
                        [customerLocation] => US 
                        [cardholderName] => 
                        [expirationDate] => 01/2014 
                        [maskedNumber] => 411111******1111 
                    ) 
                ) 
                [customerDetails] => Braintree_Transaction_CustomerDetails Object ( 
                	[_attributes] => Array ( 
                    	[id] => 52 
                        [firstName] => 
                        [lastName] => 
                        [company] => Your Company 2 
                        [email] => 
                        [website] => 
                        [phone] => 
                        [fax] => 
                    ) 
                ) 
                [billingDetails] => Braintree_Transaction_AddressDetails Object ( 
                	[_attributes:protected] => Array ( 
                    	[id] => 
                        [firstName] => 
                        [lastName] => 
                        [company] => 
                        [streetAddress] => 
                        [extendedAddress] => 
                        [locality] => 
                        [region] => 
                        [postalCode] => 
                        [countryName] => 
                        [countryCodeAlpha2] => 
                        [countryCodeAlpha3] => 
                        [countryCodeNumeric] => 
                    ) 
                ) 
                [shippingDetails] => Braintree_Transaction_AddressDetails Object ( 
                	[_attributes:protected] => Array ( 
                    	[id] => 
                        [firstName] => 
                        [lastName] => 
                        [company] => 
                        [streetAddress] => 
                        [extendedAddress] => 
                        [locality] => 
                        [region] => 
                        [postalCode] => 
                        [countryName] => 
                        [countryCodeAlpha2] => 
                        [countryCodeAlpha3] => 
                        [countryCodeNumeric] => 
                    ) 
                ) 
                [subscriptionDetails] => Braintree_Transaction_SubscriptionDetails Object ( 
                	[_attributes] => Array ( 
                    	[billingPeriodEndDate] => DateTime Object ( ) 
                        [billingPeriodStartDate] => DateTime Object ( ) 
                    )     
                ) 
            ) 
        ) 
     ) 
  ) 
) 














