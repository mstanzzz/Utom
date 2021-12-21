
<?php
if(isset($_POST['del_idea_house_id'])){

	$del_idea_house_id = (isset($_POST['del_idea_house_id'])) ? $_POST['del_idea_house_id'] : 0;

	$sql = "DELETE FROM  idea_house
			WHERE idea_house_id = '".$del_idea_house_id."'";
	$result = $dbCustom->getResult($db,$sql);
	
	$sql = "DELETE FROM idea_house_to_room
			WHERE idea_house_id = '".$del_idea_house_id."'";
	$result = $dbCustom->getResult($db,$sql);
}
?>


<a href="account-idea-folder-details.html" 
class="account-nav__link active account-menu-hidden">Idea folder detail</a>


<nav class="account-block__navigation--navigation">
<ul class="account-nav">
<li class="mobile-show">
<button class="account-nav__button js-hide-account-mobile-menu">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g transform="translate(0 -0.001)"><g transform="translate(0 0.001)"><path d="M13.326,12l10.4-10.4A.938.938,0,0,0,22.4.275L12,10.675,1.6.275A.938.938,0,0,0,.274,1.6L10.674,12,.274,22.4A.938.938,0,0,0,1.6,23.726L12,13.327l10.4,10.4A.938.938,0,0,0,23.725,22.4Z" transform="translate(0 -0.001)"></path></g></g></svg>
</button>
</li>
<li class="mobile-show">
<a href="#" title="" class="account-nav__link account-mobile-menu-visible js-mobile-account-login">
login
</a>
</li>
<li class="mobile-show">
<a href="#" title="" class="account-nav__link account-mobile-menu-visible">
Register
</a>
</li>
<li>
<a href="<?php echo SITEROOT; ?>account.html" title="" class="account-nav__link account-menu-hidden">
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19.575" viewBox="0 0 20 19.575">
<path id="Path_210" data-name="Path 210" d="M90.589,177.888l-9.99,7.262v12.313h7.069v-9.036H93.41v9.036H100.6V185.151Z" transform="translate(-80.6 -177.888)" fill="#db440d"/>
</svg>
Dashboard
</a>
</li>
<li>
<a href="<?php echo SITEROOT; ?>account-settings.html" title="" class="account-nav__link account-menu-hidden">
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"><defs><style>.gear{fill:#5eae5e;}</style></defs><g transform="translate(8.203 8.203)"><path class="gear" d="M146.8,140a6.8,6.8,0,1,0,2.053,13.278,1.172,1.172,0,0,0-.707-2.235,4.447,4.447,0,1,1,2.929-2.993,1.172,1.172,0,0,0,2.25.658A6.8,6.8,0,0,0,146.8,140Z" transform="translate(-140 -140)"/></g><path class="gear" d="M26.484,10.9h-.59a.39.39,0,0,1-.357-.245l-.01-.025A.393.393,0,0,1,25.6,10.2l.417-.417a3.52,3.52,0,0,0,0-4.972l-.829-.829a3.516,3.516,0,0,0-4.972,0L19.8,4.4a.393.393,0,0,1-.43.077l-.022-.009a.392.392,0,0,1-.249-.358v-.59A3.52,3.52,0,0,0,15.586,0H14.414A3.52,3.52,0,0,0,10.9,3.516v.59a.391.391,0,0,1-.248.358l-.023.009A.393.393,0,0,1,10.2,4.4L9.78,3.979a3.516,3.516,0,0,0-4.972,0l-.829.829a3.52,3.52,0,0,0,0,4.972L4.4,10.2a.4.4,0,0,1,.075.435l-.007.017a.392.392,0,0,1-.358.249h-.59A3.52,3.52,0,0,0,0,14.414v1.172A3.52,3.52,0,0,0,3.516,19.1h.59a.39.39,0,0,1,.357.245l.01.025A.393.393,0,0,1,4.4,19.8l-.417.417a3.516,3.516,0,0,0,0,4.972l.829.829a3.516,3.516,0,0,0,4.972,0L10.2,25.6a.393.393,0,0,1,.43-.077l.022.009a.392.392,0,0,1,.249.358v.59A3.52,3.52,0,0,0,14.414,30h1.172A3.52,3.52,0,0,0,19.1,26.484v-.59a.391.391,0,0,1,.248-.358l.023-.009a.393.393,0,0,1,.431.077l.417.417a3.516,3.516,0,0,0,4.972,0l.829-.829a3.516,3.516,0,0,0,0-4.972L25.6,19.8a.393.393,0,0,1-.077-.431l.009-.021a.392.392,0,0,1,.358-.249h.59A3.52,3.52,0,0,0,30,15.586V14.414A3.52,3.52,0,0,0,26.484,10.9Zm1.172,4.687a1.173,1.173,0,0,1-1.172,1.172h-.59a2.728,2.728,0,0,0-2.525,1.7l-.008.018a2.729,2.729,0,0,0,.585,2.986l.417.417a1.172,1.172,0,0,1,0,1.657l-.829.829a1.172,1.172,0,0,1-1.657,0l-.417-.417a2.729,2.729,0,0,0-2.988-.584l-.017.007a2.728,2.728,0,0,0-1.7,2.525v.59a1.173,1.173,0,0,1-1.172,1.172H14.414a1.173,1.173,0,0,1-1.172-1.172v-.59a2.728,2.728,0,0,0-1.7-2.525l-.016-.007a2.767,2.767,0,0,0-1.063-.213,2.716,2.716,0,0,0-1.925.8l-.417.417a1.172,1.172,0,0,1-1.657,0l-.829-.829a1.172,1.172,0,0,1,0-1.657l.417-.417a2.729,2.729,0,0,0,.585-2.986l-.008-.018a2.728,2.728,0,0,0-2.525-1.7h-.59a1.173,1.173,0,0,1-1.172-1.172V14.414a1.173,1.173,0,0,1,1.172-1.172h.59a2.729,2.729,0,0,0,2.526-1.7l.005-.013A2.729,2.729,0,0,0,6.054,8.54l-.417-.417a1.173,1.173,0,0,1,0-1.657l.829-.829a1.172,1.172,0,0,1,1.657,0l.417.417a2.729,2.729,0,0,0,2.988.584l.017-.007a2.728,2.728,0,0,0,1.7-2.525v-.59a1.173,1.173,0,0,1,1.172-1.172h1.172a1.173,1.173,0,0,1,1.172,1.172v.59a2.728,2.728,0,0,0,1.7,2.525l.016.007a2.729,2.729,0,0,0,2.987-.584l.417-.417a1.172,1.172,0,0,1,1.657,0l.829.829a1.173,1.173,0,0,1,0,1.657l-.417.417a2.727,2.727,0,0,0-.586,2.983l.009.021a2.728,2.728,0,0,0,2.525,1.7h.59a1.173,1.173,0,0,1,1.172,1.172Z"/></svg>
Account settings
</a>
</li>
<li>
<a href="#" title="" class="account-nav__link account-menu-hidden svg-stroke">
<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20.185" viewBox="0 0 21 20.185">
<g id="Group_372" data-name="Group 372" transform="translate(-80.1 -209.102)">
<rect id="Rectangle_47" data-name="Rectangle 47" width="8.816" height="8.816" rx="0.915" transform="translate(80.6 209.602)" fill="none" stroke="#384765" stroke-miterlimit="10" stroke-width="1"/>
<path id="Rectangle_48" data-name="Rectangle 48" d="M.916,0H7.9a.915.915,0,0,1,.915.915V7.9a.915.915,0,0,1-.915.915H.915A.915.915,0,0,1,0,7.9V.916A.916.916,0,0,1,.916,0Z" transform="translate(91.784 209.602)" fill="none" stroke="#384765" stroke-miterlimit="10" stroke-width="1"/>
<path id="Rectangle_49" data-name="Rectangle 49" d="M.916,0H7.9a.915.915,0,0,1,.915.915V7.9a.916.916,0,0,1-.916.916H.915A.915.915,0,0,1,0,7.9V.916A.916.916,0,0,1,.916,0Z" transform="translate(80.6 219.969)" fill="none" stroke="#384765" stroke-miterlimit="10" stroke-width="1"/>
<path id="Path_212" data-name="Path 212" d="M94.4,218.967h-2.88v-2.876a.551.551,0,1,0-1.1,0v2.876H87.537a.551.551,0,1,0,0,1.1h2.878v2.878a.551.551,0,1,0,1.1,0v-2.878H94.4a.551.551,0,0,0,0-1.1Z" transform="translate(5.225 4.858)" fill="#384765"/>
</g>
</svg>													
Start a new design
</a>
</li>
<li>
<a href="<?php echo SITEROOT; ?>account-orders.html" title="" class="account-nav__link account-menu-hidden svg-stroke">
<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21.628" viewBox="0 0 21 21.628">
<g id="Group_373" data-name="Group 373" transform="translate(-80.1 -272.056)">
<path id="Path_213" data-name="Path 213" d="M88.264,276.655v-4.1l-7.664,5.4h5.817C87.437,277.957,88.264,277.374,88.264,276.655Z" fill="none" stroke="#384765" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
<path id="Path_214" data-name="Path 214" d="M98.579,272.556H91.724a1.451,1.451,0,0,0-1.589,1.247l-.015,4.3a1.951,1.951,0,0,1-2.137,1.677H82.189a1.449,1.449,0,0,0-1.589,1.251v10.559a1.845,1.845,0,0,0,2.021,1.59H98.579a1.846,1.846,0,0,0,2.021-1.59V274.146A1.846,1.846,0,0,0,98.579,272.556Z" fill="none" stroke="#384765" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
</g>
</svg>
My orders
</a>
</li>
<li>
<a href="<?php echo SITEROOT; ?>account-payments.html" title="" class="account-nav__link account-menu-hidden">
<svg xmlns="http://www.w3.org/2000/svg" width="21.667" height="17.755" viewBox="0 0 21.667 17.755"><defs><style>.wallet{fill:#384765;}</style></defs><g transform="translate(0 -39)"><g transform="translate(0 39)"><g transform="translate(0 0)"><path class="wallet" d="M19.591,39H4.429a2.081,2.081,0,0,0-2.071,2.081v.025H2.076A2.075,2.075,0,0,0,0,43.173v11.5a2.088,2.088,0,0,0,2.076,2.081H17.238a2.081,2.081,0,0,0,2.071-2.081v-.025h.281a2.075,2.075,0,0,0,2.076-2.066v-11.5A2.085,2.085,0,0,0,19.591,39ZM17.238,55.752H2.076A1.085,1.085,0,0,1,1,54.673v-11.5A1.072,1.072,0,0,1,2.076,42.11H17.238a1.065,1.065,0,0,1,1.068,1.063v2.869a1.235,1.235,0,0,1-.266.03H15.147a2.856,2.856,0,0,0,0,5.713h2.889c.09-.005.181-.015.266-.025l.005,2.914A1.078,1.078,0,0,1,17.238,55.752Zm3.426-3.17a1.072,1.072,0,0,1-1.073,1.063H19.31V51.4a2.741,2.741,0,0,0,.577-.527l.777-1Zm-1.57-2.317a1.35,1.35,0,0,1-1.053.522H15.147a1.856,1.856,0,0,1,0-3.711h2.889a2.288,2.288,0,0,0,1-.226,2.332,2.332,0,0,0,.848-.682l.777-1,.005,3.064Zm1.57-6.741L19.31,45.269v-2.1a2.068,2.068,0,0,0-2.071-2.066H3.36v-.025A1.078,1.078,0,0,1,4.429,40H19.591a1.085,1.085,0,0,1,1.073,1.078v2.443Z" transform="translate(0 -39)"/></g></g><g transform="translate(14.565 48.429)"><path class="wallet" d="M292.105,227h-1.2a.5.5,0,1,0,0,1h1.2a.5.5,0,0,0,0-1Z" transform="translate(-290.4 -227)"/></g></g></svg>
Payment settings
</a>
</li>

<li class="mobile-show">
<a href="account-idea-folder-detail.html" title="" class="account-nav__link active account-menu-hidden">Idea folder</a>

<a href="account-idea-folder.html" title="" class="account-nav__link active account-menu-hidden">Idea folder</a>
</li>
<li class="mobile-show">
<a href="#" title="" class="account-nav__link account-menu-hidden">My designs</a>
</li>
<li>
<a href="#" title="" class="account-nav__link svg-stroke account-menu-hidden js-mobile-account-logout">
<svg xmlns="http://www.w3.org/2000/svg" width="21.181" height="23.04" viewBox="0 0 21.181 23.04">
<g id="Group_375" data-name="Group 375" transform="translate(9.029 7.998)">
<path id="Path_217" data-name="Path 217" d="M137.722,410.829v4.887a2.879,2.879,0,0,1-2.88,2.88h-8.709a2.879,2.879,0,0,1-2.88-2.88v-16.28a2.88,2.88,0,0,1,2.88-2.88h8.709a2.88,2.88,0,0,1,2.88,2.88v4.325" transform="translate(-131.782 -404.054)" fill="none" stroke="#384765" stroke-miterlimit="10" stroke-width="1"/>
<line id="Line_3" data-name="Line 3" x2="11.471" transform="translate(0 3.523)" fill="none" stroke="#342f4c" stroke-miterlimit="10" stroke-width="1"/>
<path id="Path_218" data-name="Path 218" d="M133.674,401.221l3.252,3.523-3.252,3.523" transform="translate(-125.455 -401.221)" fill="none" stroke="#384765" stroke-miterlimit="10" stroke-width="1"/>
</g>
</svg>
Sign out
</a>
</li>
</ul>
</nav>

									


<!-- Modal delete house -->
<div class="modal fade" id="deleteHouse" tabindex="-1" role="dialog" aria-labelledby="#deleteHouseTitle" aria-hidden="true">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="deleteHouseTitle"><span>XXXX</span></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<div class="account-block__form">

<div class="row mb-3">
<div class="col-12">
<p class="js-delete-text">You are about to delete 
<span style="color: #17C3C6">XXXX</span>.<br /> 
Are you sure that you want to continue?</p>
</div>
</div>
<div class="row">
<div class="col-12">


<form  action"<?php echo SITEROOT.'account-idea-folder.html'; ?>" method="post">
<input type="hidden" id="del_idea_house_id" name="del_idea_house_id" value="1">								<div class="row mb-3">

<button type="submit" class="btn btn-secondary w-100">continue</button>
</form>

</div>
</div>

</div>
</div>

</div>
</div>
</div>




<!-- Modal alert confirmation -->
<div class="modal fade confirm-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="#confirmModalTitle" aria-hidden="true">
<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="confirmModalTitle"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="account-block__form">
		

<div class="col-12">
<p class="js-delete-text">Are you sure that you would like to share your Idea Folder with Closets To Go?</p>
</div>
</div>
<div class="row">
<div class="col-6">
<button type="submit" data-dismiss="modal" class="btn btn-secondary w-100">No</button>
</div>
<div class="col-6">
<button type="submit" data-dismiss="modal" class="btn btn-primary w-100">Yes</button>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
 		
<script>

function update_folder(id){
	document.getElementById("update_folder_id").value = id;	
}

function set_del_house(id){
	alert(id);
	document.getElementById("del_idea_house_id").value = id;
	alert(document.getElementById("del_idea_house_id"));	
}

function add_spec(){
	//alert("kkkkkkkkkkkkkkk");
	document.getElementById("add_spec_modal").style.display = "block";

}

</script>


<!-- test add_spec -->
<div id="add_spec_modal" 
	style="z-index:36;
		top:-140px;
		left:500px;	
		width:200px; 
		height:60px; 
		position:absolute;">
<form  action"<?php echo SITEROOT.'account-idea-folder.html'; ?>" method="post" style="border-style:solid;">
	<input type="hidden" name="add_spec" value="1">
	
	<input type="text" name="title" value="Spec Name">	
	<input type="text" name="description" value="description">
	<select name="spec_room">
	<option value="0"> SELECT ROOM </option>
	<?php
	$sql = "SELECT idea_room_id, room_name
			FROM idea_rooms 
			WHERE active > '0'
			AND profile_account_id  = '".$_SESSION['profile_account_id']."'";
	$res = $dbCustom->getResult($db,$sql);
	while($row = $res->fetch_object()){
		echo "<option value='".$row->idea_room_id."'>".$row->room_name."</option>"; 
	}
	?>
	</select>

	<input type="submit" value="ADD Spec">
</form>
</div>

<span onClick="add_spec();">
>>>>>>>>>>>>>>>>> ADD SPEC
</span>
