<?php
	
	if(!isset($_SERVER['DOCUMENT_ROOT'])) $_SERVER['DOCUMENT_ROOT'] = '../..';

	$yesterday = time() - (24 * 60 * 60);

	if($handle = @opendir($_SERVER['DOCUMENT_ROOT'].'/temp_uploads')) {
		/* This is the correct way to loop over the directory. */
		while (false !== ($entry = readdir($handle))) {
			if(is_numeric($entry)){
				if($entry < $yesterday){
					if (file_exists($_SERVER['DOCUMENT_ROOT'].'/temp_uploads/'.$entry)) {
						deleteDir($_SERVER['DOCUMENT_ROOT'].'/temp_uploads/'.$entry);
					}
				}
			}
		}
		closedir($handle);
	}
?>