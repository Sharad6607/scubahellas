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
                <h3 class="card-title">Edit Dives Center</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $center[0]->id;?>">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6" id="modal-default-cliente">
                    <label for="exampleInputEmail1">Select Dives Location</label>
                    <select class="select-location form-control" name="location_id"  data-placeholder="Select Location" style="width: 100%;">
                      <option selected="true" value="" disabled="disabled">Selct Location</option>
                        <?php 
                        $var_products = explode(',', $center[0]->location_id);
                        foreach ($dives_location as $value) { 
                            $selected = (in_array($value->id,$var_products)?'selected':'');
                          ?>
                        
                      <option value= "<?php echo $value->id; ?>" <?php echo $selected;?>><?php echo $value->address; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1" <?php echo $center[0]->status == 1 ? "selected": "";?>>Active</option>
                        <option value="0" <?php echo $center[0]->status == 0 ? "selected": "";?>>Inactive</option>
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
                    <br/>
                           <div class="field" align="left">
                              <?php
                                 $images =$this->Dives_model->getImageById($center[0]->id);
                                 
                                   if(count($images) > 0){
                                           foreach ($images as $key => $value) {
                                           ?>
                              <img id="img_<?php echo $value->id; ?>" src="<?php echo base_url('assets/uploads/dives_location_image/'.$value->image); ?>" width="100">
                              <a href="Javascript:void(0);" onclick="deleteProductImage(<?php echo $value->id; ?>)" id="anchor_<?php echo $value->id; ?>"  class="btn btn-danger pl-3 pr-3 pt-1 pb-1">X</a>
                              <?php 
                                 }
                                 }
                                 ?>
                           </div>
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

      function deleteProductImage(id){
           if (!confirm('Are you sure you want to delete this image?')) return false;
           $.ajax({
                     type: 'POST',
                     url: "<?=base_url("vendor/Dives/deleteImage/")?>" + id,
                     dataType: 'text',
                     success: function(data) {
                        
                       $("#img_" + id).remove();   
                       $("#anchor_" + id).remove();  
                       var res = '<div class="col-12 text-center text-success" style="margin-top:10px;">Image has been deleted successfully.</div>';
                          $("#deleteResponse").html(res); 

                     }
                 });
         }

    </script>