		<h2>My Folders:</h2>
		<?php 
			$folders = $xml->xpath('/folders/folder[@author_id="'.$customer_id.'"]');
			// Build the folder list HTML...
			$folder_nav_html = "<ul class='folder_navigation'>";
			foreach ($folders as $folder) {
				$folder_id = $folder->attributes()->id;
				$folder_title = $folder->attributes()->title;
				$folder_author_id = $folder->attributes()->author_id;
				$active = ($folder_id == $current_folder_id) ? "class='active'" : '';
				$folder_icon = ($folder_id == $current_folder_id) ? "class='idea-icon-folder-picture'" : "class='idea-icon-folder'";
				$folder_nav_html .= "<li ".$active."><a href='".SITEROOT."/idea-folder-contents/user/".$folder_author_id."/idea-folder/".$folder_id."'>";
				$folder_nav_html .= "<i ".$folder_icon."></i> ".$folder_title."</a></li>";
			}
			$folder_nav_html .= "<li class='add_new'><a onclick='add_idea_folder()'><i class='idea-icon-folder-add'></i> Add a New Folder</a></li>";
			$folder_nav_html .= "</ul>";
			echo $folder_nav_html;
		?>
