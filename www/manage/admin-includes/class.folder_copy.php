<?php


class FolderCopy {


	  public static function copyFolder($src, $dest) {
	
		$path = realpath($src);
		$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	
		  /** SplFileInfo $object*/
		foreach($objects as $name => $object)
		{
		  $startsAt = substr(dirname($name), strlen($src));
		  self::mkDir($dest.$startsAt);
		  if(is_writable($dest.$startsAt) and $object->isFile())
		  {
			  copy((string)$name, $dest.$startsAt.DIRECTORY_SEPARATOR.basename($name));
		  }
		}
	  }
	
	  private static function mkDir($folder, $perm=0777) {
		if(!is_dir($folder)) {
		  mkdir($folder, $perm);
		}
	  }









}

?>