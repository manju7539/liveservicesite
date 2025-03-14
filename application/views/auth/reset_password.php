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
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" id="resetpasswordform" action="<?php echo base_url('ResetPasswordController/updatePassword');?>" method="POST">
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-flower"></i>
                    </span>
                    <span class="login100-form-title p-b-34 p-t-27">
                        Reset Password
                    </span>
                    <div style="margin-top:10px; text-align:center;">
                        <?php echo $this->session->flashdata('error_msg')?>
                    </div>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="New Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Confirm password">
                        <input class="input100" type="password" name="confirm_password" placeholder="Confirm New Password">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Reset Password
                        </button>
                    </div>
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