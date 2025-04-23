function initMap() {
    const fordhamLocation = { lat: 40.862, lng: -73.888 };
    
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 15,
      center: fordhamLocation,
      mapTypeControl: true,
      streetViewControl: true,
      fullscreenControl: true,
    });
    
    const marker = new google.maps.Marker({
      position: fordhamLocation,
      map: map,
      title: "Fordham University, Rose Hill Campus",
      animation: google.maps.Animation.DROP
    });
    
    const infoWindow = new google.maps.InfoWindow({
      content: "<div><strong>Aldin's Travel Blog</strong><br>Fordham University<br>Rose Hill Campus<br>441 E Fordham Rd<br>Bronx, NY 10458</div>"
    });
    
    marker.addListener("click", () => {
      infoWindow.open(map, marker);
    });
  }
  
  function handleMapError() {
    const mapElement = document.getElementById("map");
    if (mapElement) {
      mapElement.innerHTML = '<div class="alert alert-warning">Failed to load Google Maps. Please try again later.</div>';
    }
  }
  
  window.gm_authFailure = handleMapError;