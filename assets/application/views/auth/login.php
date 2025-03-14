<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Hotel Management" />
	<meta name="author" content="SmartUniversity" />
	<title>Hotel Management</title>
	<!-- icons -->
	<link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/iconic/css/material-design-iconic-font.min.css')?>">
	<!-- bootstrap -->
	<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/pages/extra_pages.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/pages/custom.css')?>">
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico')?>" />
<style>
	option{
		color: #000;
	}
</style>
</head>

<body>
	<div class="limiter">
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				 <form class="login100-form validate-form" id="loginform"  action="<?php echo base_url('LoginController/page_login');?>" method="POST">
				<!-- <form class="login100-form validate-form"> -->
					<span class="login100-form-logo">
						<i class="zmdi zmdi-flower"></i>
					</span>
					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
					<div style="margin-top:10px; text-align:center;">
                  		<?php echo $this->session->flashdata('msg')?>
                    </div>
                    <?php if (!empty($this->session->flashdata('error_msg')) ) { ?>
                        <div class="alert" role="alert" id="a" style="margin-top:10px;">
                            <strong style="color:black ;margin-top:10px;"><?php echo $this->session->flashdata('error_msg') ?></strong>
                    </div>
                        <?php } ?>
                        <div class="wrap-input100">
                     <select class="form-control" name="userType" style="font-size: 16px;color: #fff;line-height: 1.2;display: block;width: 100%;height: 45px;background: transparent;padding: 0 5px 0 38px;border: unset;">
                     	<?php 
                     	$userRole = userRole();
                     	foreach ($userRole as $key => $value) { ?>
                     		<option value="<?= $key?>"><?= $value?></option>	
                     	<?php } ?>
						
						
					</select>  
					<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div> 
					<div class="wrap-input100 validate-input" data-validate="Enter email">
						<input class="input100" type="text" name="email" placeholder="email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					<div class="contact100-form-checkbox">
						
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
					<!-- <div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
	<!-- bootstrap -->
	<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/extra_pages/login.js')?>"></script>
	<!-- end js include path -->
</body>

</html>