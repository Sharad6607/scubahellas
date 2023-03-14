<style>
.select2-results__option[aria-selected] {
    color: #000;
}

.select2-container--default .select2-selection--single .select2-selection__rendered{
  line-height: 22px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/rental-products');?>">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
      <?php if(!empty($this->session->flashdata('error'))){
          echo $this->session->flashdata('error');
      } ?>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Dives Center</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6" id="modal-default-cliente">
                    <label for="exampleInputEmail1">Select Dives Location</label>
                    <select class="select-location form-control" name="location_id"  data-placeholder="Select Location" style="width: 100%;">
                      <option selected="true" value="" disabled="disabled">Selct Location</option>
                        <?php foreach ($dives_location as $value) { 
                        if($value->city == ""){
                          $city ="";
                        }else{
                          $city = ",".$value->city;
                        } ?>
                  
                      <option value= "<?php echo $value->id; ?>"><?php echo $value->address.$city; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                    <label for="exampleInputFile">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" onchange="readURL(this);" name="file[]" id="files" multiple>
                      </div>

                    </div>
                    <!-- <div style="margin-top: 10px;"><img id="blah" src="<?php echo base_url('assets/admin/image/user-icon.jpeg');?>" alt="your image" /></div> -->
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <script src="<?= base_url(); ?>assets/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function() {
        $('.select-location').select2();
        if (window.File && window.FileList && window.FileReader) {
          $("#files").on("change", function(e) {
            var files = e.target.files,
              filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
              var f = files[i]
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\" style=\"position: relative; margin-right: 15px;\">" +
                  "<img style=' width: 100px; height: 85px; margin-left:5px; margin-right:5px; margin-bottom:2px; border:solid 2px; ' class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                  "<br/><br/><span class='remove btn btn-danger' style=' padding: 0; position: absolute; width: 25px; height: 25px; border-radius: 50%; top: -10px; right: -10px; line-height: 22px;'>X</span>" +
                  "</span>").insertAfter("#files");
                $(".remove").click(function(){
                  $(this).parent(".pip").remove();
                });
                
              });
              fileReader.readAsDataURL(f);
            }
          });
        } else {
          alert("Your browser doesn't support to File API")
        }
       });

    </script>