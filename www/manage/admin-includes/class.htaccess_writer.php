<?php
if(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(!isset($_SERVER['DOCUMENT_ROOT'])){
	if(strpos($_SERVER['REQUEST_URI'], 'storittek/' )){    
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
	}elseif(strpos($_SERVER['REQUEST_URI'], 'designitpro/' )){
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'].'/designitpro';
	}else{
		$_SERVER['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; 	
	}
}
}

require_once($_SERVER['DOCUMENT_ROOT']."/includes/config.php"); 

class HtaccessWriter {

	private $_SERVER['DOCUMENT_ROOT'];
	private $file_ext = '.xml.gz';

	public  function HtaccessWriter() {

		if(strpos($_SERVER['REQUEST_URI'], 'onlinecl/' )){  
			$this->real_root = $_SERVER['DOCUMENT_ROOT'].'/storittek'; 
		}elseif(strpos($_SERVER['REQUEST_URI'], 'organize2go' )){  
			$this->real_root = $_SERVER['DOCUMENT_ROOT'].'/organize2go'; 
		}elseif(strpos($_SERVER['REQUEST_URI'], 'otg-site' )){  
			$this->real_root = $_SERVER['DOCUMENT_ROOT'].'/otg-site'; 
		}else{
			$this->real_root = $_SERVER['DOCUMENT_ROOT']; 	
		}
	
	}


	public function writeHtaccess() {
		
		$dbCustom = new DbCustom();
	
	
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		  
		$sql = "SELECT id 
				FROM profile_account
				WHERE active = '1'"; 
		$result = $dbCustom->getResult($db,$sql);
			
		$block = '';
		while($row = $result->fetch_object()){

			 $block .= $this->getSaasCustBlock($row->id);
			
		}
		
		$file = $this->real_root.'/.htaccess';
		
		$backupfile = $this->real_root.'/saas-customers/htaccess_backup.'.time().'.txt';

		 //$fh=fopen($backupfile,"w+");
		
		if(file_exists($file) && file_exists($backupfile)){
			if(!copy($file, $backupfile)) {
				echo "failed to copy $file...\n";
			}	
		}

		$current = file_get_contents($file);

		$str_parts = explode('#::::::#', $current);

		//$new_content = $str_parts[0].PHP_EOL.'#::::::#'.PHP_EOL;
		$new_content = $str_parts[0].'#::::::#'.PHP_EOL;
		
		$new_content .= $block;			
		file_put_contents($file, $new_content);			
	
	}
	  
	  
	private function getSaasCustBlock($profile_account_id){
		
		$dbCustom = new DbCustom();
		  
		$db = $dbCustom->getDbConnect(USER_DATABASE);
		  
		$sql = "SELECT domain_name 
			FROM profile_account 
			WHERE id = '".$profile_account_id."'"; 
		$result = $dbCustom->getResult($db,$sql);
			
		$block = '';
		if($result->num_rows){
			$object = $result->fetch_object();
			
			
			$condition_line = 'RewriteCond %{http_host} ^';
			if(substr_count($object->domain_name,'.') > 1){				
				$condition_line .= $object->domain_name.' [NC]';
			}else{
				$condition_line .= 'www.'.$object->domain_name.' [NC]';
			}
			$block .= PHP_EOL;
			
			$block .= $condition_line.PHP_EOL;
			$block .= 'RewriteRule ^sitemap'.$this->file_ext.'$ saas-customers/'.$profile_account_id.'/sitemap/sitemap'.$this->file_ext.PHP_EOL;
		
			//get sitemap count
			$directory = $this->real_root.'/saas-customers/'.$profile_account_id.'/sitemap/';
			$num_sitemaps = 0;
			$files = glob($directory . "*");
			if ($files){
				$num_sitemaps = count($files);
			}
			
			
			for($i = 1; $i < $num_sitemaps; $i++){
				$block .= $condition_line.PHP_EOL;				
				$block .= 'RewriteRule ^sitemap'.$i.$this->file_ext.'$ saas-customers/'.$profile_account_id.'/sitemap/sitemap'.$i.$this->file_ext.PHP_EOL;				
			}		
		
			$block .= $condition_line.PHP_EOL;
			$block .= 'RewriteRule ^robots.txt$ saas-customers/'.$profile_account_id.'/robots/robots.txt'.PHP_EOL;
		
		
		
		}
		
		return $block;   
	}
	
	  
}

?>