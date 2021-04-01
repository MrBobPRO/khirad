
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 38.578065, lng: 68.750778},
    zoom: 16,
    mapTypeControl: false,
    streetViewControl: false
  });


  marker = new google.maps.Marker({
    map: map,
    draggable: false,
    animation: google.maps.Animation.BOUNCE,
    position: {lat: 38.578065, lng: 68.750778},
     icon: '/img/main/marker.png'
  });
  marker.addListener('click', toggleBounce);
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}


