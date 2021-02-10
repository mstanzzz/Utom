<?php
	$slug =  (isset($_GET["slug"])) ? addslashes($_GET["slug"]) : "idea-folder";
?>
<div class="idea_hero container page-content">
	<div class="ask_pad">
		<div class="row<?php if (!$lgn->isLogedIn()) echo " not_logged_in"; ?>">
			<div class="span5">
				<h1><a href="<?php echo $ste_root;?>/idea-folder.html">Idea Folders</a></h1>
				<?php if (strpos($slug,"idea-folder-contents")!== false) {
					echo "<h3><a href='".$ste_root."/idea-folder.html'>< View All</a></h3>";
				} else {
					echo "<h3>Save &amp; Share your Inspriation!</h3>";
				} ?>
				<?php if (!$lgn->isLogedIn()){ ?>
					<img src="/images/idea-landing.png" alt="Save Ideas in One Place" class="landing-img" />
				<?php } ?>
			</div>
			<div class="span7<?php if (!$lgn->isLogedIn()) echo " not_logged_in"; ?>">
				<?php if($lgn->isLogedIn()){ 
	 				$customer_id = $lgn->getCustId();
					$share_template = '';
					if (strpos($slug,"idea-folder-contents")!== false || strpos($slug,"idea-view-single") !== false) {
						// display actions for viewing a folder's contents
						$current_folder_author = (isset($_GET["author_id"])) ? addslashes($_GET["author_id"]) : "0";
						$folder_id = (isset($_GET["folder_id"])) ? addslashes($_GET["folder_id"]) : "0";
						$share_template .= "<div class='btn-group'>";
							$share_template .=  "<a class='btn btn-primary dropdown-toggle' data-toggle='dropdown'><i class='idea-icon-share icon-white'></i> Share Folder <span class='caret'></span></a>";
							$share_template .= "<ul class='dropdown-menu share'>";
								$folder_url = $ste_root."/idea-folder-contents/user/".$current_folder_author."/idea-folder/".$folder_id;
								//FB App Id: 408739485873715
								$share_template .=  "<li><a href='https://www.facebook.com/dialog/feed?app_id=408739485873715&link=".$folder_url."&name=Cool%20Idea%20Folder&caption=Check%20out%20this%20idea%20folder&description=Check%20out%20this%20idea%20folder&redirect_uri=".$folder_url."' target='_blank'><i class='idea-icon-facebook icon-white'></i> Facebook</a></li>";
								$share_template .=  "<li><a href='https://twitter.com/share?url=".$folder_url."&text=Check%20out%20this%20idea%20folder'><i class='idea-icon-twitter icon-white' target='_blank'></i> Twitter</a></li>";
								if (strpos($slug,"idea-view-single")!== false){
									$share_template .=  "<li><a onclick='share_idea_email()'><i class='idea-icon-email icon-white'></i> Email</a></li>";
								} else {
									$share_template .=  "<li><a onclick='share_folder_email()'><i class='idea-icon-email icon-white'></i> Email</a></li>";
								}
							$share_template .=  "</ul>";
						$share_template .=  "</div>"; 
					?>
					<div class="idea_folder_actions gutter-top">
						<?php
							// if the user is viewing their own folder, display the 'add new idea' and edit folder options:
							if ($customer_id === $current_folder_author){
						?>
							<div class="btn-group"> <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#"> <i class="icon-plus-sign icon-white"></i> Add a New Idea <span class="caret"></span> </a>
								<ul class="dropdown-menu success">
									<li><a onclick="add_new_idea('image');">Upload Image</a></li>
									<li><a onclick="add_new_idea('link');">Link to Web Page</a></li>
									<li><a onclick="add_new_idea('text');">Text</a></li>
									<li><a onclick="add_new_idea('product');">ClosetsToGo.com Product</a></li>
								</ul>
							</div>
							<a onclick='folder_actions("edit_folder","single")' class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit Folder </a>
						<?php 
						} else {
							// if it's not their own folder, let them copy the folder... 
						?>
						<a onclick='folder_actions("copy_folder","single")'  class="btn btn-primary"><i class="icon-copy icon-white"></i> Copy Folder </a>
						<?php }
						// now display the share button...
						echo $share_template;
						?>
						
					</div>
					<?php } else {?>
					<div class="idea_search_block">
						<!-- for search results, return the idea-folder.php page, but only pull folders from the DB that match the search query. -->
						<h5><strong>Find Your Inspiration Now:</strong> Search idea folders by keyword and/or category:</h5>
						<input type="text" name="search_folders" />
						<select name="filter_folders" style="width: 105px;">
							<option>Select Category</option>
						</select>
						<a href="#" class="btn btn-large btn-primary">Search</a>
					</div>
					<?php } ?>
				<?php } 
				// not logged in: can't see folder actions / search.
				else { ?>
					<script type="text/javascript" language="javascript">
						$(document).ready(function(){
							$(".login_button").click(function(e){
								e.preventDefault();
								$(".sub2").animate({"opacity":1,"display":"block"}).css({"display":"block", "left":"200px","top":"85px","box-shadow":"0px 3px 10px #000000"});
							});
						});
					</script>
					<h2 class="center-text">Sign up or Login Now to <strong>Start Saving Your Ideas!</strong></h2>
					<p class="center-text"><a href='http://www.onlineclosetdesigner.com/signup-form.html' class="btn btn-large btn-success">Sign Up</a> <a href="#" class="btn btn-large login_button">Login</a>
					<hr />
					<div class="row more_info">
						<div class="span3">
							<h3><img src="/images/icon-lightbulb.png" alt="Save Ideas in One Place" /> Save Your Ideas,</h3>
							<p>With Closets to Go, you can save products, pictures, links and notes for inspiration on your organization project!</p>
						</div>
						<div class="span3">
							<h3><img src="/images/icon-share.png" alt="Save Ideas in One Place" /> Then Share Them</h3>
							<p>You can then share your idea folders with anyone on Facebook, Twitter, or via email.</p>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
