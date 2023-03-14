<style>
.select2-results__option[aria-selected] {
    color: #000;
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
              <li class="breadcrumb-item"><a href="<?php echo base_url('vendor/rental-products');?>">Back</a></li>
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
                <h3 class="card-title">Add Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-6" id="modal-default-cliente">
                      <label for="exampleInputEmail1">Select Product</label>
                      <select class="select-product form-control"  name="product_id"  data-placeholder="Select Product" style="width: 100%;">
                        <option selected="true" value="" disabled="disabled">Selct Product</option>
                          <?php foreach ($get_products as $value) { 

                            ?>
                          
                              <option value= "<?php echo $value->id; ?>"><?php echo $value->product_name; ?></option>
                          <?php } ?>
                          </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rental Price</label>
                        <input type="text"  name="rental_price" class="form-control" id="exampleInputEmail1" placeholder="Enter Price">
                    </div>
                  </div>

                  <div class="row">
                    
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Stock</label>
                      <select class="form-control" name="stock">
                        <option value="1">In Stock</option>
                        <option value="0">Out of Stock</option>
                      </select>
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

      

      $('.select-product').select2();
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#blah').attr('src', e.target.result).width(146).height(128);
            };

            reader.readAsDataURL(input.files[0]);
          }
        }

    </script>