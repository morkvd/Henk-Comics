$(document).ready( function() {
    !window.addEventListener
        ? window.onload = addMap('Geldersekade 96, 1012 BM Amsterdam')
    : window.addEventListener('load', addMap('Geldersekade 96, 1012 BM Amsterdam'), false);
});

function addMap(adress)
{
    var mapOptions = {
        zoom: 17,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false
    };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions),
        stylez = [{ featureType: 'all', elementType: 'all', stylers: [{ saturation: -10 }] }],
        image = '/wp-content/themes/child-theme/assets/images/marker.png',
        mapType = new google.maps.StyledMapType(stylez),
        geocoder = new google.maps.Geocoder();

    map.mapTypes.set('wowMap', mapType);
    map.setMapTypeId('wowMap');

    geocoder.geocode({
        'address': adress
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                icon: image,
                position: results[0].geometry.location,
                markerID: 'marker'
            });
        } else
            console.log('Geocode not successful, reason: ' + status);
    });
}