var windowWidth = $(window).outerWidth();

$(document).ready(function() {
    /** ----- MOBIEL MENU ----- **/
    var nav = $('nav.primary'),
        toggle = $('span.toggle-mobile');

    toggle.on('click', function() {
        nav.slideToggle();
    });

    nav.find('a').on('click', function(event) {
        toggleSubmenuMobile(event, $(this));
    });



    /** ----- SEARCH ----- **/
    var confirmSubmit = false,
        header = $('header.header');

    $('#searchsubmit').on('click', function(event) {
        if(!confirmSubmit) event.preventDefault();

        header.toggleClass('equal');
        $(this).prev().toggle();
    });

    $('#s').on('keypress', function(event) {
        if( event.which == 13 ) {
            confirmSubmit = true;
            $(this).parent().submit();
        }
    });


    /** ----- GALLERY (NIEUWE ITEMS) ----- **/
    var gallery = $('section.gallery'),
        galleryWrapper = gallery.find('>div'),
        galleryImages = galleryWrapper.find('a');

    // Breedte is aantal afbeeldingen
    var imageWidth = galleryImages.outerWidth();
    galleryWrapper.css( 'width', (imageWidth*galleryImages.length) + imageWidth );

    var position = 0, index = 0,
        maxIndex = galleryImages.length-6;

    // Navigate to next or prev comic
    gallery.find('span.navigate').on('click', function() {
        if( $(this).hasClass('prev') && index > 0) {
            index--;
            position += imageWidth;

            galleryWrapper.animate({ 'marginLeft': position + 'px' });
        } else if( $(this).hasClass('next') && index <= maxIndex ) {
            index++;
            position -= imageWidth;

            galleryWrapper.animate({ 'marginLeft': position + 'px' });
        }
    });

    // Swipe events voor mobiel
    /*gallery.on('swipeleft', function() {
        featuredGallery('right', imageWidth)
    });

    gallery.on('swiperight', function() {
        featuredGallery('left', imageWidth)
    }); */


    /** ----- LOCATIE ----- **/
    $('section.location').find('h1').on('click', function() {
        var map = $(this).parent().find('div#map');

        !map.hasClass('closed')
            ? $(this).find('span.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up')
            : $(this).find('span.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');

        map.slideToggle().toggleClass('closed');
    });
});


$(window).resize(function() {
    windowWidth = $(window).outerWidth();

    if (windowWidth > 991) {
        $('ul.sub-menu, nav.primary').removeAttr('style');
    }
});


function toggleSubmenuMobile(event, elem)
{
    if (event.target.className.indexOf('fo') >= 0 && windowWidth < 991) {
        event.preventDefault();
        elem.closest('li').find('ul.sub-menu').slideToggle();
    }
}