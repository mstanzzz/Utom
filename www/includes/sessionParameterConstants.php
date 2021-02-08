<?php

if(!defined('SESSION_PARAMETER_CONSTANTS')){
    
    //Sets the flag
        define('SESSION_PARAMETER_CONSTANTS', true);
    
    /////////////////////////////
    //Constant Definitions
        defined('SESSION_PARAM_OPEN_DESIGN_TOOL_INSTANCE_DATA') or define('SESSION_PARAM_OPEN_DESIGN_TOOL_INSTANCE_DATA', 'openDesignToolInstanceDataObjects');
        
        defined('SESSION_PARAM_CTG_CUSTOMER_ID') or define('SESSION_PARAM_CTG_CUSTOMER_ID', 'ctg_cust_id');
        defined('SESSION_PARAM_PROFILE_ACCOUNT_ID') or define('SESSION_PARAM_PROFILE_ACCOUNT_ID', 'profile_account_id');
        
        defined('SESSION_PARAM_ANONYMOUS_SHOPPER_ID') or define('SESSION_PARAM_ANONYMOUS_SHOPPER_ID', 'anonymous_shopper_id');
        
        defined('SESSION_PARAM_DESIGN_CART') or define('SESSION_PARAM_DESIGN_CART', 'design_cart');
        
        defined('SESSION_PARAM_PROFILE_CURRENCY') or define('SESSION_PARAM_PROFILE_CURRENCY', 'profile_currency');
        
        defined('SESSION_PARAM_PROFILE_WEIGHT_UNITS') or define('SESSION_PARAM_PROFILE_WEIGHT_UNITS', 'profile_weight_units');
        
        defined('SESSION_PARAM_PROFILE_LENGTH_UNITS') or define('SESSION_PARAM_PROFILE_LENGTH_UNITS', 'profile_length_units');
}
?>
