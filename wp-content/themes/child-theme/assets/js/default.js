$(document).ready(function() {
    // Gallery breedte en movement
    var gallery = $('section.gallery'),
        galleryWrapper = gallery.find('>div'),
        galleryImages = galleryWrapper.find('a'),
        maxWidth = galleryImages.outerWidth() * galleryImages.length;

    // Breedte is aantal afbeeldingen
    galleryWrapper.css('width', maxWidth);

    // Interval die de galerij laat lopen
    loopGalery(gallery, galleryWrapper, maxWidth);
    var galleryInterval = setInterval(function(){ loopGalery(gallery, galleryWrapper, maxWidth)}, 7000);

    gallery.hover( function () {
        console.log('stop interval');

        clearInterval(galleryInterval);
        galleryWrapper.stop();
    }, function() { // Herstart de interval
        galleryInterval = setInterval(function(){ loopGalery(gallery, galleryWrapper, maxWidth)}, 7000);
    });
});


$(window).resize(function() {

});


function loopGalery(parent, wrapper, maxWidth)
{
    console.log('start interval');

    wrapper.stop(); // stop alle animaties (voor de zekerheid)
    wrapper.animate({
        'left': - (maxWidth / parent.outerWidth() * 100 - 100) + '%'
    }, 4000, function() {
        setTimeout( function() { // Als de galerij aan het einde is
            wrapper.animate({
                'left': '0'
            }, 500);
        }, 2000);
    });
}