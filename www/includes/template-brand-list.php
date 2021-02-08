<?php	
			$block = '';
			$i = 0;
			$last_item = count($items);
			 foreach($items as $item){
				 if ($i == 0){
					 $block .= "<ul class=\"brand-list\">";
				 }
				 $block .= "<li><a href=\"".$item['url']."\">".$item['name']."</a></li>";
				 $i++;
				 if ($i == 5 || $i == $last_item) {
					$block.= "</ul>";
					$i = 0; 
				 }
			 }
			echo $block;
?>
