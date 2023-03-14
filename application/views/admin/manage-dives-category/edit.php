<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/vendors');?>">Back</a></li>
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
                <h3 class="card-title">Edit Dives Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user[0]->id ?>">

                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter first name" value="<?php echo $user[0]->name;?>">
                  </div>
                  <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1" <?php echo $user[0]->status == 1 ? "selected": "";?>>Active</option>
                        <option value="0" <?php echo $user[0]->status == 0 ? "selected": "";?>>Inactive</option>
                      </select>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Icon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" onchange="readURL(this);" name="file">
                      </div>

                    </div>
                    <div style="margin-top: 10px;"><img id="blah" src="<?php echo !empty($user[0]->icon) ?base_url('assets/admin/image/dives-icon/'.$user[0]->icon): base_url('assets/admin/image/user-icon.jpeg');?>" alt="your image" / style="height: 50px;width: 50px;"></div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>

    <script type="text/javascript">
      
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