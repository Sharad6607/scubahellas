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
                <h3 class="card-title">Edit Vendor</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user[0]->id ?>">

                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" placeholder="Enter first name" value="<?php echo $user[0]->first_name;?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name" value="<?php echo $user[0]->last_name;?>">
                  </div>
                </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $user[0]->email;?>" name="email">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Mobile</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user[0]->mobile;?>" name="mobile">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Address</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user[0]->address;?>" name="address">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Country</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user[0]->country;?>" name="country">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">State</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user[0]->state;?>" name="state">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">City</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user[0]->city;?>" name="city">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="password">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Status</label>
                      <select class="form-control" name="status">
                        <option value="1" <?php echo $user[0]->status == 1 ? "selected": "";?>>Active</option>
                        <option value="0" <?php echo $user[0]->status == 0 ? "selected": "";?>>Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Zipcode</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="zip_code" value="<?php echo $user[0]->zip_code;?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label>Gender</label>
                      <select class="form-control" name="gender">
                        <option value="1" <?php echo $user[0]->gender == 1 ? "selected": "";?>>Male</option>
                        <option value="2" <?php echo $user[0]->gender == 2 ? "selected": "";?>>Female</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Profile Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" onchange="readURL(this);" name="file">
                      </div>

                    </div>
                    <div style="margin-top: 10px;"><img id="blah" src="<?php echo !empty($user[0]->profile_pic) ?base_url('assets/admin/image/'.$user[0]->profile_pic): base_url('assets/admin/image/user-icon.jpeg');?>" alt="your image" /></div>
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