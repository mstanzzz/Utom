<?php

if(!defined('REQUEST_VARIABLE_CONSTANTS')){
    
    //Sets the flag
        define('REQUEST_VARIABLE_CONSTANTS', true);
    
    /////////////////////////////
    //Constant Definitions
        defined('REQUEST_RETURN_USER_LOGIN_STATUS') or define('REQUEST_RETURN_USER_LOGIN_STATUS', 'returnUserLoginStatus');
        
        defined('REQUEST_VARIABLE_USER_ID') or define('REQUEST_VARIABLE_USER_ID', 'userID');
        
        defined('REQUEST_VARIABLE_FILE_ID') or define('REQUEST_VARIABLE_FILE_ID', 'fileID');
        defined('REQUEST_VARIABLE_FILE_IDS') or define('REQUEST_VARIABLE_FILE_IDS', 'fileIDs');
        
        defined('REQUEST_VARIABLE_FILE_NAME') or define('REQUEST_VARIABLE_FILE_NAME', 'fileName');
        
        defined('REQUEST_VARIABLE_DESIGN_ID') or define('REQUEST_VARIABLE_DESIGN_ID', 'design');
        
        defined('REQUEST_VARIABLE_DESIGN_TOOL_INSTANCE_ID') or define('REQUEST_VARIABLE_DESIGN_TOOL_INSTANCE_ID', 'instanceID');

        defined('REQUEST_VARIABLE_TEXT') or define('REQUEST_VARIABLE_TEXT', 'text');
        
        defined('REQUEST_VARIABLE_CONVERSATION_ID') or define('REQUEST_VARIABLE_CONVERSATION_ID', 'conversationID');
        
        defined('REQUEST_VARIABLE_START_DATE') or define('REQUEST_VARIABLE_START_DATE', 'startDate');
        defined('REQUEST_VARIABLE_END_DATE') or define('REQUEST_VARIABLE_END_DATE', 'endDate');
        
        defined('REQUEST_VARIABLE_COMMENTS_BEFORE') or define('REQUEST_VARIABLE_COMMENTS_BEFORE', 'commentsBefore');
        defined('REQUEST_VARIABLE_COMMENTS_AFTER') or define('REQUEST_VARIABLE_COMMENTS_AFTER', 'commentsAfter');
        
        defined('REQUEST_VARIABLE_COMMENT_COUNT_MAX') or define('REQUEST_VARIABLE_COMMENT_COUNT_MAX', 'commentCount');
        
        defined('REQUEST_VARIABLE_LOCKED') or define('REQUEST_VARIABLE_LOCKED', 'locked');
        
        defined('REQUEST_VARIABLE_INITIAL_DESIGN_THEME_DATA') or define('REQUEST_VARIABLE_INITIAL_DESIGN_THEME_DATA', 'initialDesignThemeData');
}
?>
