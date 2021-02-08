<?php

// SEO is no longer an addon. It will work for all saas customers.
$_SESSION['seo'] = 1;


class Seo {

	public $title = '';
	public $keywords = '';
	public $description = '';
	public $page_heading = '';
	public $page_name = '';
	public $added_page_id = '';
	public $template = '';
	public $canonical = '';

	public function setMeta($slug, $use_fixed_page_name=0) {
		
		$dbCustom = new DbCustom();
		$db = $dbCustom->getDbConnect(SITE_N_DATABASE);
		$use_default = 1;
		$fetch = 0;
		$use_default = 1;

		if($_SESSION['seo'] && $use_fixed_page_name == 0){		
			
			if($stmt = $db->prepare("SELECT title
										,keywords
										,description
										,page_name
										,page_heading
										,added_page_id
										,template
										,canonical
						FROM page_seo 
						WHERE (seo_name = ? OR page_name = ?)  
						AND profile_account_id = ?")){
			$stmt->bind_param('ssi', $slug, $slug, $_SESSION['profile_account_id']);
						
			$stmt->execute();
			$stmt->bind_result($title
							,$keywords
							,$description
							,$page_name
							,$page_heading
							,$added_page_id
							,$template
							,$canonical);
							
				$fetch = 1;			
			}
			
			
		}else{

			if($stmt = $db->prepare("SELECT  title
										,keywords
										,description
										,page_name
										,page_heading
										,added_page_id
										,template
										,canonical
						FROM page_seo 
						WHERE page_name = ? 
						AND profile_account_id = ?")){
							
			$stmt->bind_param('si', $slug, $_SESSION['profile_account_id']);
						
			$stmt->execute();
			$stmt->bind_result($title
							,$keywords
							,$description
							,$page_name
							,$page_heading
							,$added_page_id
							,$template
							,$canonical);
				$fetch = 1;			
			}
		}
		
		if($fetch){
			if($stmt->fetch()){
				$use_default = 0;
				$this->title = $title;
				$this->keywords = $keywords;
				$this->description = $description;
				$this->page_name = $page_name;
				
				if($page_name == 'default') $use_default = 1;
				
				$this->page_heading = $page_heading;
				$this->added_page_id = $added_page_id;
				$this->template = $template;			
				$this->canonical = $canonical;
				
				$use_default = 0;
			}
		
			$stmt->close();
		}

		
		
		if($use_default){
		
			$sql = sprintf("SELECT * 
						FROM page_seo 
						WHERE page_name = '%s' 
						AND profile_account_id = '".$_SESSION['profile_account_id']."'", 
						'default', $_SESSION['profile_account_id']);

			$result = $dbCustom->getResult($db,$sql);
			
			if($result->num_rows > 0){
				$use_default = 0;
				$page_obj = $result->fetch_object();
				$this->title = $page_obj->title;
				$this->keywords = $page_obj->keywords;
				$this->description = $page_obj->description;
				
				$this->page_name = '';
				$this->page_heading = '';
				$this->added_page_id = 0;
				$this->template = '';
				$this->canonical = '';
			}
		}
	}

	function get_url_from_id($page_seo_id){
		$ret = '';
		if(is_array($_SESSION["pages"])){
			foreach($_SESSION["pages"] as $p_val){
				if($p_val["page_seo_id"] == $page_seo_id){					
					if($_SESSION['seo']){
						$ret = $p_val['seo_name'];											
					}else{
						$ret = $p_val['page_name'];
					}
				}
			}
		}
		
		return $ret; 
	}

	function get_url_from_page_name($page_name){
		$ret = '';
		if(is_array($_SESSION['pages'])){
			foreach($_SESSION['pages'] as $p_val){
				if($p_val['page_name'] == $page_name){					
					if($_SESSION['seo']){
						$ret = $p_val['seo_name'];						
					}else{
						$ret = $p_val['page_name'];						
					}
				}
			}
		}
		
		return $ret; 
	}
	
}

?>
