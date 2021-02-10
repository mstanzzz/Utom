<?php

exit;

set_time_limit(0);

function img_resize_direct($cur_dir, $cur_file, $newwidth, $newheight, $output_dir){
    $dir = opendir($cur_dir);
     $format='';
     if(preg_match("/.jpg/i", "$cur_file"))
     {
         $format = 'image/jpeg';
     }
     if (preg_match("/.gif/i", "$cur_file"))
     {
         $format = 'image/gif';
     }
     if(preg_match("/.png/i", "$cur_file"))
     {
         $format = 'image/png';
     }
    if($format!='')
     {
         list($width, $height) = getimagesize($cur_dir.$cur_file);
        
         switch($format)
         {
             case 'image/jpeg':
             $source = imagecreatefromjpeg($cur_dir.$cur_file);
             break;
             case 'image/gif';
             $source = imagecreatefromgif($cur_dir.$cur_file);
             break;
             case 'image/png':
             $source = imagecreatefrompng($cur_dir.$cur_file);
             break;
         }
         $thumb = imagecreatetruecolor($newwidth,$newheight);
         imagealphablending($thumb, false);
         //$source = @imagecreatefromjpeg("$filename");
         imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
         

		//copy($cur_dir.$cur_file, $output_dir.$cur_file);

 //echo $filename;
 //echo "<br />";
 //exit;
 		 imagejpeg($thumb, $output_dir.$cur_file);
		 imagedestroy($source);
     }
 }





function img_resize($cur_dir, $cur_file, $newwidth, $output_dir)
 {
      
     //$olddir = getcwd();
     $dir = opendir($cur_dir);
     $format='';
     if(preg_match("/.jpg/i", "$cur_file"))
     {
         $format = 'image/jpeg';
     }
     if (preg_match("/.gif/i", "$cur_file"))
     {
         $format = 'image/gif';
     }
     if(preg_match("/.png/i", "$cur_file"))
     {
         $format = 'image/png';
     }
     if($format!='')
     {
         list($width, $height) = getimagesize($cur_dir.$cur_file);
         $newheight=$height*$newwidth/$width;
         switch($format)
         {
             case 'image/jpeg':
             $source = imagecreatefromjpeg($cur_dir.$cur_file);
             break;
             case 'image/gif';
             $source = imagecreatefromgif($cur_dir.$cur_file);
             break;
             case 'image/png':
             $source = imagecreatefrompng($cur_dir.$cur_file);
             break;
         }
         $thumb = imagecreatetruecolor($newwidth,$newheight);
         imagealphablending($thumb, false);
         //$source = @imagecreatefromjpeg("$filename");
         imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
         

		//copy($cur_dir.$cur_file, $output_dir.$cur_file);

 //echo $filename;
 //echo "<br />";
 //exit;
 		 imagejpeg($thumb, $output_dir.$cur_file);
		 imagedestroy($source);
     }
 }



if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 1024, "../saascustuploads/sas_starter_cart/cart/full/");
		}
	
	}
}


if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 800, "../saascustuploads/sas_starter_cart/cart/large/");
		}
	
	}
}

if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 800, "../saascustuploads/sas_starter_cart/cart/large/");
		}
	
	}
}

if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 355, "../saascustuploads/sas_starter_cart/cart/medium/");
		}
	
	}
}

if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 240, "../saascustuploads/sas_starter_cart/cart/small/");
		}
	
	}
}


if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 80, "../saascustuploads/sas_starter_cart/cart/thumb/");
		}
	
	}
}

/*

if ($handle = opendir('../ul_cart/sas_starter_cart/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/sas_starter_cart/cart/details_large/", $entry, 25, "../saascustuploads/sas_starter_cart/cart/tiny/");
		}
	
	}
}
*/


/*

if ($handle = opendir('../ul_cart/hardwareresources.organizetogo.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/hardwareresources.organizetogo.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/88/cart/full/");
		}
	
	}
}


if ($handle = opendir('../ul_cart/hardwareresources.organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/hardwareresources.organizetogo.com/cart/details_large/", $entry, 25, "../saascustuploads/88/cart/tiny/");
		}
	}
}

if ($handle = opendir('../ul_cart/hardwareresources.organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/hardwareresources.organizetogo.com/cart/details_large/", $entry, 80, "../saascustuploads/88/cart/thumb/");
		}
	}
}


if ($handle = opendir('../ul_cart/hardwareresources.organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/hardwareresources.organizetogo.com/cart/details_large/", $entry, 240, "../saascustuploads/88/cart/small/");
		}
	}
}

*/

/*

if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 25, "../saascustuploads/1_oldlive/cart/tiny/");
		}
	}
}

if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 80, "../saascustuploads/1_oldlive/cart/thumb/");
		}
	}
}


if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 240, "../saascustuploads/1_oldlive/cart/small/");
		}
	}
}




 



if ($handle = opendir('../ul_cart/organizetogo.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/1/cart/full/");
		}
	
		
	
	}
}




if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 25, "../saascustuploads/1/cart/tiny/");
		}
	}
}

if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 80, "../saascustuploads/1/cart/thumb/");
		}
	}
}


if ($handle = opendir('../ul_cart/organizetogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/organizetogo.com/cart/details_large/", $entry, 240, "../saascustuploads/1/cart/small/");
		}
	}
}

*/

/*

if ($handle = opendir('../ul_cart/designclosetsonline.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/designclosetsonline.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/73/cart/full/");
		}
	
	}
}




if ($handle = opendir('../ul_cart/islandhomehi.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/islandhomehi.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/78/cart/full/");
		}
	
	}
}




if ($handle = opendir('../ul_cart/onlineclosetdesigner.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/onlineclosetdesigner.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/1/cart/full/");
		}
	
	}
}






if ($handle = opendir('../ul_cart/portland.closetstogo.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/portland.closetstogo.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/89/cart/full/");
		}
	
	}
}




if ($handle = opendir('../ul_cart/portland.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/portland.closetstogo.com/cart/details_large/", $entry, 25, "../saascustuploads/89/cart/tiny/");
		}
	}
}

if ($handle = opendir('../ul_cart/portland.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/portland.closetstogo.com/cart/details_large/", $entry, 80, "../saascustuploads/89/cart/thumb/");
		}
	}
}


if ($handle = opendir('../ul_cart/portland.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/portland.closetstogo.com/cart/details_large/", $entry, 240, "../saascustuploads/89/cart/small/");
		}
	}
}

*/

/*

if ($handle = opendir('../ul_cart/socal.closetstogo.com/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/socal.closetstogo.com/tmp/pre-crop/", $entry, 800, "../saascustuploads/90/cart/full/");
		}
	
	}
}






if ($handle = opendir('../ul_cart/socal.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/socal.closetstogo.com/cart/details_large/", $entry, 25, "../saascustuploads/90/cart/tiny/");
		}
	}
}

if ($handle = opendir('../ul_cart/socal.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/socal.closetstogo.com/cart/details_large/", $entry, 80, "../saascustuploads/90/cart/thumb/");
		}
	}
}

if ($handle = opendir('../ul_cart/socal.closetstogo.com/cart/details_large')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../ul_cart/socal.closetstogo.com/cart/details_large/", $entry, 240, "../saascustuploads/90/cart/small/");
		}
	}
}


if ($handle = opendir('../saascustuploads/1/sas_starter_cart/cart/details_large/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/sas_starter_cart/cart/details_large/", $entry, 25, "../saascustuploads/1/sas_starter_cart/tiny/");
		}
	}
}
if ($handle = opendir('../saascustuploads/1/sas_starter_cart/cart/details_large/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/sas_starter_cart/cart/details_large/", $entry, 80, "../saascustuploads/1/sas_starter_cart/thumb/");
		}
	}
}
if ($handle = opendir('../saascustuploads/1/sas_starter_cart/cart/details_large/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/sas_starter_cart/cart/details_large/", $entry, 240, "../saascustuploads/1/sas_starter_cart/small/");
		}
	}
}




if ($handle = opendir('../saascustuploads/1/cms/banner/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/cms/banner/", $entry, 660, "../saascustuploads/1/cms/banner/small/");
		}
	}
}
if ($handle = opendir('../saascustuploads/1/cms/banner/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/cms/banner/", $entry, 700, "../saascustuploads/1/cms/banner/medium/");
		}
	}
}

if ($handle = opendir('../saascustuploads/1/cms/banner/')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/cms/banner/", $entry, 860, "../saascustuploads/1/cms/banner/large/");
		}
	}
}




if ($handle = opendir('../saascustuploads/1/tmp/pre-crop')) {
	while (false !== ($entry = readdir($handle))) {
    	if($entry != '.' && $entry != '..'){
			
			//print_r(getimagesize("../ul_cart/organizetogo.com/tmp/pre-crop/".$entry));
		
			echo $entry;
			echo "<br />";
			img_resize("../saascustuploads/1/tmp/pre-crop/", $entry, 1024, "../saascustuploads/1/cart/full/");
		}
	
	}
}


*/





?>





<!--


cat 135
details 280
details_large 355
details_med 315
grid 164
landing 170
like 150
promo 137
list 80
tiny 50


Those are the dimensions I think the images should be, but I am sure someone will contradict me. It's better to down-size the images in CSS than up-size, for quality; but the reverse is true when considering bandwidth/page load time. The other option is to have lots and lots of different sizes, but that's no good either. 



Home page carousel, viewport 1270+ —> 860x460

Home page carousel, viewport  640-1269—> 700x400

Home page carousel, viewport <640 —> 660x340




Product Image Sizes:

(down-sized via CSS for different responsive layouts)

tiny (used in sidebars): 25x25 (i don't think this is necessary; i think we can just use thumbnail size and down-size via css)

thumb (used in product list, cart): 80x80

small (used for category lists, product grid view, showroom lists): 240x240

medium (used on product detail): 460x460

large: max width 600px (replace on showroom with a smaller image that has the same dimensions as the original but with maximum width 600px; faster page load. Currently the page is loading largest size image and resizing to fit the space via css)



full size: (actual image size; loads in lightbox when a medium/large image is clicked in product detail or on showroom)




So regarding the product list images: when switching from grid/list view on product list pages, I am making css class changes on the container, and not pulling any new data or loading new images to the page, so that might have to change if we're going to use the exact image dimensions on this page. If someone comes into the page on list view and the images are all naturally 80x80, they will look terrible upsized to 240x240 if the user switches to grid view. We can either load images in the larger size when they switch (which would mean changing that function) or just load the larger size by default.

When the viewport is smaller, css is down-sizing the images to fit the space appropriately. On smaller viewports (<640) lists of category thumbnails (like on the home page) could load the "thumbnail" size specified above, instead of the "small" like it would need to for larger viewports.

I hope this answers all your image questions. Let me know if you have other questions.

-->