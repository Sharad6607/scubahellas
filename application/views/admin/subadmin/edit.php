<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
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
                <h3 class="card-title">Edit Subadmin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">

                <div class="card-body">
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id">
                          <?php
                          foreach ($roles as $key => $value) { ?>
                            <option value="<?php echo $value->id;?>" <?php echo $value->id == $user['role_id'] ? "selected": "";?>><?php echo $value->name;?></option>
                            <?php 
                          } ?>
                        </select>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" placeholder="Enter first name" value="<?php echo $user['first_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name" value="<?php echo $user['last_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo $user['email'];?>" name="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mobile</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" value="<?php echo $user['mobile'];?>" name="mobile">
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="1" <?php echo $user['status'] == 1 ? "selected": "";?>>Active</option>
                      <option value="0" <?php echo $user['status'] == 0 ? "selected": "";?>>Inactive</option>
                    </select>
                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

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