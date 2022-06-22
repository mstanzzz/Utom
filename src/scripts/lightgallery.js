import { each } from "jquery";

jQuery(document).ready(function ($) {

  $(".video-gallery").lightGallery({
    loadYoutubeThumbnail: true,
    youtubeThumbSize: 'default',
  });

  $(".image-gallery").lightGallery({
    mode: 'lg-slide',
  });

  $('.idea-folder-gallery').lightGallery({
    mode: 'lg-slide',
    counter: false,
  });
});
