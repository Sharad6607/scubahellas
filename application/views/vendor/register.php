<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Vendor-login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/ionicons.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/ogpm.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/blue.css') ?>">
	<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<div>
	
	<form action="" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
  <div class="container">
  	<div class="row">
  		<h1 style="text-align: center;">Scuba Hellas</h1>
    <h1> Vendor Sign Up</h1>
    <?php echo $this->session->flashdata('message') ?>
    <hr>
    <div class="form-group col-md-6">
	    <label for="exampleInputEmail1">First Name</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" name="first_name" placeholder="Enter first name">
	</div>
	<div class="form-group col-md-6">
        <label for="exampleInputEmail1">Last Name</label>
        <input type="text"  name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter last name">
    </div>
	<div class="form-group col-md-6">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
    </div>
	<div class="form-group col-md-6">
      <label for="exampleInputEmail1">Mobile</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="mobile">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Address</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="address">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Country</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile"  name="country">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">State</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="state">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">City</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="city">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Password</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="password">
    </div>
    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Zipcode</label>
      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile" name="zip_code">
    </div>
    <div class="form-group col-md-6">
      <label>Gender</label>
      <select class="form-control" name="gender">
        <option value="1">Male</option>
        <option value="2">Female</option>
      </select>
    </div>
    <div class="form-group col-md-6">
    <label for="exampleInputFile">Profile Image</label>
    <div class="input-group">
      <div class="custom-file">
        <input type="file" onchange="readURL(this);" name="file">
      </div>

    </div>
    <div style="margin-top: 10px;"><img id="blah" src="<?php echo base_url('assets/admin/image/user-icon.jpeg');?>" alt="your image" /></div>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <p style="text-align:center;margin-top: 10px;">OR</p>
    <a href="<?php echo base_url('vendor');?>"><button type="button" class="btn btn-success">Log In</button></a>
</div>
  </div>
</form>
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
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

      <script type="text/javascript">
  $("body").on("change",".tgl_checkbox",function(){
    $.post('<?=base_url("backend/category/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
      id : $(this).data('id'),
      status : $(this).is(':checked')==true?1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
</script>

    </script>

</body>
</html>
