<style>
  #map-canvas {
  height: 400px;
  width: 100%;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mange Div Center</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if(!empty($this->session->flashdata('success'))){
          echo $this->session->flashdata('success');
      } ?>
      <div></div>
      <div class="container-fluid">
        <div class="card-header">
                <a href="manage-dives/add"><button class="btn btn-primary" style="float:right;">Add Center</button></a>
              </div>
        <div id="map-canvas" style="margin-bottom: 50px;"></div> 
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <a href="manage-dives/add"><button class="btn btn-primary" style="float:right;">Add Center</button></a>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Address</th>
                    <th>Lat</th>
                    <th>Long</th>
                    <th>Added Date</th>
                    <th>Status</th>
                    <th>Added By</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($center as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value->address;?></td>
                      <td><?php echo $value->latitude ;?></td>
                      <td><?php echo $value->longitude ;?></td>
                      <td><?php echo $value->created_at;?></td>
                      <td><?php echo $value->status == 1? "Active": "Inactive";?></td>
                      <td><?php echo $value->type;?></td>
                      <td><?php echo $value->email;?></td>
                      <td><a href="<?php echo base_url('admin/manage-dives/'.$value->id);?>"><i class="fas fa-edit"></i></a><a href="<?php echo base_url('admin/manage-dives/delete/'.$value->id);?>"><i class="fas fa-trash" style="margin-left:10px;"></i></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initialize() {
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: new google.maps.LatLng(27.1416735,80.8833819),
          zoom: 3
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('<?php echo base_url("admin/dives/getallmarker");?>', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name;
              infowincontent.appendChild(strong);

              var img = document.createElement('img');
              img.src = '<?php echo base_url("assets/admin/image/dives-icon/mp.png");?>';
              img.style.width = '100px';
              infowincontent.appendChild(img);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>