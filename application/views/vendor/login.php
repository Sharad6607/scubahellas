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
</head>
<body class="hold-transition login-page" style="height: auto;background-color: #ff00a5 !important;">
<div class="login-box">
	<div class="login-logo"><strong>Scuba Hellas</strong></div>
	
	<div class="login-box-body">
		<h1 class="login-box-msg">SIGNIN</h1>
		<?php echo $this->session->flashdata('message') ?>
		<form action="<?php echo base_url('vendor/login/auth'); ?>" method="POST">
			<div class="form-group has-feedback">
				<input type="email" name="email" class="form-control" placeholder="Email" required>
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group">
				<div class="captcha-image"><?php echo $captcha['image']; ?></div>
			</div>
			<div class="form-group has-feedback">
				<input type="text" name="captcha_code" class="form-control" placeholder="Enter Captcha" required>
				<span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
			</div>
			<div class="text-center">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
			
		</form>
		<p style="text-align:center;">OR</p>
		<div class="text-center">
				<a href="<?php echo base_url('vendor/register');?>"><button type="button" class="btn btn-success btn-block btn-flat">Sign Up</button></a>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/admin/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
	$(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
</script>
</body>
</html>