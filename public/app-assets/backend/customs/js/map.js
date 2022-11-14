$(function () {
    let current_lat = Number($('#lat').val() || '30.04561429595649');
    let current_lng = Number($('#lng').val() || '31.241347656250014');
    var map = new google.maps.Map(document.getElementById('map'), {
        center:{
            lat: current_lat,
            lng: current_lng
        },
        zoom:15
    });
    var marker = new google.maps.Marker({
        position: {
            lat: current_lat,
            lng: current_lng
        },
        map:map,
        draggable:true
    });

    google.maps.event.addListener(marker,'position_changed',function () {
        var lat = marker.getPosition().lat() ;
        var lng = marker.getPosition().lng() ;

        $('#lat').val(lat);
        $('#lng').val(lng);
    });
});
