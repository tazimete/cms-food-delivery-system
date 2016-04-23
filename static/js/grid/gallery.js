$(function () {
	$("#gallery").removeClass('hide');
    var buildGallery = function(){
        $('a[rel^="prettyPhoto"]').prettyPhoto({slideshow:5000, autoplay_slideshow:false});
        
        $("#gallery").gridalicious({
          animate: true,
          gutter: 15,
          width: 250
        });
    }

    buildGallery();
});