<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                <div class="card-body">
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
                    <label for="exampleInputFile">Profile Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" onchange="readURL(this);" name="file">
                      </div>

                    </div>
                    <div style="margin-top: 10px;"><img id="blah" src="<?php echo !empty($user['profile_pic']) ?base_url('assets/admin/image/'.$user['profile_pic']): base_url('assets/admin/image/user-icon.jpeg');?>" alt="your image" /></div>
                  </div>
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