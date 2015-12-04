$(document).ready(function() {
    // Zoeken in de menu balk
    var confirmSubmit = false,
        header = $('header.header');

    $('#searchsubmit').on('click', function(event) {
        if (!confirmSubmit) event.preventDefault();

        header.toggleClass('equal');
        $(this).prev().toggle();
    });

    $('#s').on('keypress', function(event) {
        if (event.which == 13) {
            confirmSubmit = true;
            $(this).parent().submit();
        }
    });


    // Gallery breedte en movement
    var gallery = $('section.gallery'),
        galleryWrapper = gallery.find('>div'),
        galleryImages = galleryWrapper.find('a');

    // Breedte is aantal afbeeldingen
    var imageWidth = galleryImages.outerWidth();
    galleryWrapper.css('width', (imageWidth*galleryImages.length)+imageWidth);

    // Navigate to next or prev comic
    gallery.find('span.navigate').on('click', function() {
        $(this).hasClass('fa-chevron-left') ? featuredGallery('left', imageWidth) : featuredGallery('right', imageWidth);
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

    /* TODO ipv de outerWidth van de gallery berekenen, het aantal items tellen en dan +1 en -1 doen */
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