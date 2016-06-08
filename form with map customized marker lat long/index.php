<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="script.js"></script>
    
    <!-------Including CSS File------>
        <link rel="stylesheet" type="text/css" href="style.css">
  
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 50%;
        width: 50%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

    </style>
    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
  <div class="row" style="height:20px;"></div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4"><input type="hidden" class="form-control" name="parentType" id="parentType"></div>
</div>
<div class="row" style="margin-top:25px;">
  <div class="col-md-3"></div>
    <div class="col-md-4">
          <div class="form-group">
              <label>Titre</label>
              <input type="text" class="form-control" name="titre" id="titre">
          </div>
    </div>
</div>
<div class="row" style="margin-top:25px;">
  <div class="col-md-3"></div>
    <div class="col-md-4">
          <div class="form-group">
              <label>Presentation</label>
              <textarea  class="form-control" name="presentation" id="presentation"></textarea> 
          </div>
    </div>
</div>
<div class="row" style="margin-top:25px;">
  <div class="col-md-3"></div>
    <div class="col-md-4">
          <div class="form-group">
              <label>Telephone</label>
              <input type="text" class="form-control" name="tel" id="tel">
          </div>
    </div>
</div>
<div class="row">
      <input id="lat" style="display:inline;"> 
      <input id="lng" style="display:inline;"> 
      <div class="col-md-3"></div>
      <div class="col-md-2" style="margin-top:25px;"><label>Map</label></div>
</div>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div style="margin-left:25%;margin-top:25px;" id="map"></div>
<div class="row" style="margin-top:25px;">
  <div class="col-md-3"></div>
    <div class="col-md-4">
          <div class="form-group">
              <label>Image</label>
             <div>
                <form enctype="multipart/form-data" action="" method="post">
                   <hr/>
                    <div id="filediv"><input name="file[]" type="file" id="file"  value="add" ></div><br/>
           
                    <input class="btn btn-primary" type="button" id="add_more" class="upload" value="Ajouter des Images"/>
                    
                    <input class="btn btn-success" type="submit" value="Uploader des Images" name="submit" id="upload" class="upload"/>
                </form>
             </div>
          </div>
    </div>
</div>
<div class="row" style="text-align:center;margin-top:30px;">
  <button class="btn btn-success">Sauvegarder</button>
</div>
    <script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initAutocomplete() {
	var markers = [];
  var map = new google.maps.Map(document.getElementById('map'), {
   
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
  var input = /** @type {HTMLInputElement} */(
    document.getElementById('pac-input')
  );
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
      var marker = new google.maps.Marker({
        draggable: true,
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });
      // drag response
      google.maps.event.addListener(marker, 'dragend', function(e) {
        displayPosition(this.getPosition());
      });
      // click response
      google.maps.event.addListener(marker, 'click', function(e) {
        displayPosition(this.getPosition());
      });
      markers.push(marker);
      bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
  });
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
  // displays a position on two <input> elements
  function displayPosition(pos) {
    document.getElementById('lat').value = pos.lat();
    document.getElementById('lng').value = pos.lng();
  }
}  
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtmfC1_zF74LthpksH-2JQ_QZWZvowVkw&libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>