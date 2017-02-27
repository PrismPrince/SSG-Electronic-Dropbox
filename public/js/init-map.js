function initMap() {
  var uluru = {lat: 10.295861, lng: 123.906303};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 17,
    center: uluru
  });

  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}
