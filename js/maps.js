function initMap() {

    var sekadau = {lat: -33.91722, lng: 151.23064};

    var map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: sekadau});
    var marker = new google.maps.Marker({position: sekadau, map: map});
    var infoWindow = new google.maps.InfoWindow;


    
        // // Try HTML5 geolocation.
        // if (navigator.geolocation) {
        //       navigator.geolocation.getCurrentPosition(function(position) {
        //         var pos = {
        //           lat: position.coords.latitude,
        //           lng: position.coords.longitude
        //       };

        //           infoWindow.setPosition(pos);
        //           infoWindow.setContent('Lokasi anda saat ini');
        //           infoWindow.open(map);
        //           map.setCenter(pos);
        //     }, function() {
        //         handleLocationError(true, infoWindow, map.getCenter());
        //     });

        // } else {
        //     // Browser doesn't support Geolocation
        //     handleLocationError(false, infoWindow, map.getCenter());
        // }


        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
        var icons = {
          parking: {
            name: 'Parkiran',
            icon: iconBase + 'parking_lot_maps.png'
          },
          library: {
            name: 'Perpustakaan',
            icon: iconBase + 'library_maps.png'
          },
          info: {
            name: 'Informasi',
            icon: iconBase + 'info-i_maps.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(-33.91721, 151.22630),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91539, 151.22820),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91747, 151.22912),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91910, 151.22907),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91725, 151.23011),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91872, 151.23089),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91784, 151.23094),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91682, 151.23149),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91790, 151.23463),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91666, 151.23468),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.916988, 151.233640),
            type: 'info'
          }, {
            position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
            type: 'library'
          }
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });

        var legend = document.getElementById('legend');
        for (var key in icons) {
          var type = icons[key];
          var name = type.name;
          var icon = type.icon;
          var div = document.createElement('div');
          div.innerHTML = '<img src="' + icon + '"> ' + name;
          legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);

}

// function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//     infoWindow.setPosition(pos);
//     infoWindow.setContent(browserHasGeolocation ?
//       'Error: The Geolocation service failed.' :
//       'Error: Your browser doesn\'t support geolocation.');
//     infoWindow.open(map);
// }