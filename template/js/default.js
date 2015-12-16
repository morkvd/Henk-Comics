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

    var $el, $ps, $up, totalHeight;
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

$(".description-box .read-more").click(function() {
    totalHeight = 0

    $el = $(this);
    $p  = $el;
    $up = $p.parent();
    $ps = $up.find(".comic-description");
  
    // measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
    $ps.each(function() {
        totalHeight += $(this).outerHeight();
    });
        
    $up
        .css({
        // Set height to prevent instant jumpdown when max height is removed
        "height": $up.height(),
        "max-height": 9999
    })
    .animate({
        "height": totalHeight
    });
  
    // fade out read-more
    $p.fadeOut();
  
    // prevent jump-down
    return false;
});