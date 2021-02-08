<?php

if(!defined('SQL_PARAMETER_CONSTANTS')){
    
    //Sets the flag
        define('SQL_PARAMETER_CONSTANTS', true);
    
    /////////////////////////////
    //Constant Definitions
        defined('SQL_PARAM_FILE_ID') or define('SQL_PARAM_FILE_ID', 'file_id');
        defined('SQL_PARAM_FILE_NAME') or define('SQL_PARAM_FILE_NAME', 'file_name');
        
        defined('SQL_PARAM_CREATION_DATE') or define('SQL_PARAM_CREATION_DATE', 'create_date');
        defined('SQL_PARAM_REVISION_DATE') or define('SQL_PARAM_REVISION_DATE', 'rev_date');
        
        defined('SQL_PARAM_CONVERSATION_ID') or define('SQL_PARAM_CONVERSATION_ID', 'comment_id');
        
        defined('SQL_PARAM_PROJECT_ID') or define('SQL_PARAM_PROJECT_ID', 'project_id');
        
        defined('SQL_PARAM_DESIGNER_ID') or define('SQL_PARAM_DESIGNER_ID', 'designer_id');
        
        defined('SQL_PARAM_MODIFIED_BY') or define('SQL_PARAM_MODIFIED_BY', 'modified_by');
        
        defined('SQL_PARAM_LOCKED') or define('SQL_PARAM_LOCKED', 'locked');
}
?>
