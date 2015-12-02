$(document).ready(function() {
    // Gallery breedte en movement
    var gallery = $('section.gallery'),
        galleryWrapper = gallery.find('>div'),
        galleryImages = galleryWrapper.find('a');

    // Breedte is aantal afbeeldingen
    var imageWidth = galleryImages.outerWidth();
    galleryWrapper.css('width', (imageWidth*galleryImages.length)+imageWidth);

    // Navigate to next or prev comic
    gallery.find('span.navigate').on('click', function() {
        $(this).hasClass('icon-left') ? featuredGallery('left', imageWidth) : featuredGallery('right', imageWidth);
    });

    // Swipe events voor mobiel
    gallery.on('swipeleft', function() {
        featuredGallery('right', imageWidth)
    });

    gallery.on('swiperight', function() {
        featuredGallery('left', imageWidth)
    });
});


$(window).resize(function() {

});


function featuredGallery(direction, width) {
    var gallery = $('section.gallery'),
        wrapper = gallery.find('>div'),
        allowNavigate = parseInt(wrapper.css('marginLeft'));

    if (direction == 'left' && (allowNavigate+width) <= 0) {
        allowNavigate += width;

        wrapper.stop();
        wrapper.animate({
            'marginLeft': allowNavigate
        });
    } else if (direction == 'right' && allowNavigate-width >= gallery.outerWidth()-wrapper.outerWidth()) {
        allowNavigate -= width;

        wrapper.stop();
        wrapper.animate({
            'marginLeft': allowNavigate
        });
    }
}