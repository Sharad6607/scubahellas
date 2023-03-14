<style>
    html, body, #map-canvas {
  height: 100%;
  margin: 0;
  padding: 0;
}

#map-canvas {
  height: 400px;
  width: 100%;
}

/*label {
  padding: 20px 10px;
  display: inline-block;
  font-size: 1.5em;
}*/

input {
  font-size: 0.75em;
  padding: 10px;
}
  </style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/manage-dives');?>">Back</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <?php if(!empty($this->session->flashdata('error'))){
          echo $this->session->flashdata('error');
      } ?>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Div Center</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <!-- <form action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="country" placeholder="Enter country name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input type="text"  name="state" class="form-control" id="exampleInputEmail1" placeholder="Enter state name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter city name" name="city">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form> -->
                <div class="form-group">
                  <label for="">Address</label> 
                  <input id="map-search" class="controls form-control" type="text" placeholder="Search Box" size="104" style="margin-bottom:20px;">
                </div>
              <input type="hidden" class="latitude form-control" value="">
              <input type="hidden" class="longitude form-control">
              <input type="hidden" class="reg-input-city form-control" placeholder="City">
              
              
              <form action="" method="post">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                      <?php
                          foreach ($dives_category as $key => $value) { ?>
                            <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                            <?php 
                          } ?>
                    </select>
                </div>
                 <div id="map-canvas" style="margin-bottom: 50px;"></div> 
                <input type="hidden" value="" id="latitude" name="latitude">
                <input type="hidden" value="" id="longitude" name="longitude">
                <input type="hidden" value="" id="reg-input-city" name="reg-input-city">
                <input type="hidden" value="" id="address" name="address">
                <button type="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<script>
  function initialize() {

  var mapOptions, map, marker, searchBox, city,
    infoWindow = '',
    addressEl = document.querySelector( '#map-search' ),
    latEl = document.querySelector( '.latitude' ),
    longEl = document.querySelector( '.longitude' ),
    element = document.getElementById( 'map-canvas' );
    city = document.querySelector( '.reg-input-city' );

  mapOptions = {
    zoom: 3,
    center: new google.maps.LatLng( 27.1416735,80.8833819 ),
    disableDefaultUI: false,
    scrollWheel: true,
    draggable: true,
    mapTypeId: "roadmap",
  };

  map = new google.maps.Map( element, mapOptions );

  marker = new google.maps.Marker({
    position: mapOptions.center,
    map: map,
    //icon: 'http://localhost/google-maps-javascript-api-master/mp.png',
    draggable: true
  });

  searchBox = new google.maps.places.SearchBox( addressEl );

  google.maps.event.addListener( searchBox, 'places_changed', function () {
    var places = searchBox.getPlaces(),
      bounds = new google.maps.LatLngBounds(),
      i, place, lat, long, resultArray,
      addresss = places[0].formatted_address;

    for( i = 0; place = places[i]; i++ ) {
      bounds.extend( place.geometry.location );
      marker.setPosition( place.geometry.location );
    }

    map.fitBounds( bounds );
    map.setZoom( 15 );
    lat = marker.getPosition().lat();
    long = marker.getPosition().lng();
    latEl.value = lat;
    $("#latitude").val(lat);
    $("#longitude").val(long);
    $("#address").val(addresss);

    longEl.value = long;

    resultArray =  places[0].address_components;
    for( var i = 0; i < resultArray.length; i++ ) {
      if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
        citi = resultArray[ i ].long_name;
        city.value = citi;
        $("#reg-input-city").val(citi);
      }
    }

    if ( infoWindow ) {
      infoWindow.close();
    }
    
    infoWindow = new google.maps.InfoWindow({
      content: addresss
    });

    infoWindow.open( map, marker );
  } );


  google.maps.event.addListener( marker, "dragend", function ( event ) {
    var lat, long, address, resultArray, citi;

    console.log( 'i am dragged' );
    lat = marker.getPosition().lat();
    long = marker.getPosition().lng();

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( { latLng: marker.getPosition() }, function ( result, status ) {
      if ( 'OK' === status ) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
        address = result[0].formatted_address;
        resultArray =  result[0].address_components;

        for( var i = 0; i < resultArray.length; i++ ) {
          if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
            citi = resultArray[ i ].long_name;
            console.log( citi );
            city.value = citi;
            $("#reg-input-city").val(citi);
          }
        }
        addressEl.value = address;
        latEl.value = lat;
        longEl.value = long;
        $("#latitude").val(lat);
        $("#longitude").val(long);
        $("#address").val(addresss);

      } else {
        console.log( 'Geocode was not successful for the following reason: ' + status );
      }

      if ( infoWindow ) {
        infoWindow.close();
      }

      infoWindow = new google.maps.InfoWindow({
        content: address
      });

      infoWindow.open( map, marker );
    } );
  });
}
</script>