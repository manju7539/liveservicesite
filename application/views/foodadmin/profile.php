 <!-- start page content -->
 <style>
.manage_form {
    margin-left: 80px
}

@media only screen and (max-width:1024px) and (min-width:768px) {
    .manage_form {
        margin: 0px
    }
}

@media only screen and (max-width:767px) and (min-width:320px) {
    .manage_form {
        margin: 0px
    }
}
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Profile</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
         <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Admin Details Updated..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="append_data">
  <?php 
                        
                        if(!empty($admin_details))
                        {
                            $id = $admin_details['u_id'];
                            $fname = $admin_details['full_name'];
                            //$lname = $admin_details['last_name'];
                            $email = $admin_details['email_id'];
                            $mobile = $admin_details['mobile_no'];
                        }
                        else
                        {
                            $id = '';
                            $fname ='';
                            //$lname ='';
                            $email = '';
                            $mobile = '';
                        }
                        
                        //for image                                                 
                        if(!empty($admin_details['profile_photo']))
                        {
                              $img = $admin_details['profile_photo'];
                              
                        }
                        else
                        {
                          
                              $img = base_url()."assets/dist/profie/avatar.png";
                        }
                ?>
          <div class="row">
<div class="col-lg-3">
<div class="profile-sidebar" style="width: 310px;">
<div class="card card-topline-aqua">
<div class="card-body no-padding height-9">
    <div class="row">
        <div class="profile-userpic text-center">
            <img src="<?php echo $img;?>" class="img-responsive" style="width:200px;height:200px;border-radius:50%;box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        </div>
    </div>
    <div class="profile-usertitle">
        
      <!--<h3 class="profile-usertitle-name text-center"> John </h3>-->
        <h4 class="profile-usertitle-job text-center"> <?php echo $fname?> </h4>
    </div>
    <ul class="list-group list-group-unbordered">
        <li class="list-group-item">
            <b>Full Name</b> <a class="pull-right" style="float:right;"><?php echo $fname?>
                </a>
        </li>
        <li class="list-group-item">
            <b>Email ID</b> <a class="pull-right"
                style="float:right;"><?php echo $email;?></a>
        </li>
        <li class="list-group-item">
            <b>Phone</b> <a class="pull-right" style="float:right;"><?php echo $mobile;?></a>
        </li>
    </ul>
    <!-- END SIDEBAR USER TITLE -->
    <!-- SIDEBAR BUTTONS -->

    <!-- END SIDEBAR BUTTONS -->
</div>
</div>



</div>
</div>
<div class="col-xl-8 manage_form" >
<div class="card">

<div class="card-body">
<!-- Nav tabs -->
<div class="default-tab">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#home"><i
                    class="la la-edit me-2"></i> Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#profile"><i
                    class="la la-lock me-2"></i> Reset Password</a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="home" role="tabpanel">
            <div class="pt-4">
                <div class="basic-form">
                <form id="frmblock" method="post" enctype="multipart/form-data">
                        <div class="mb-3 form-group">
                            <label class="text-label form-label" for="full name">Full
                                Name </label>
                            <div class="input-group">
                                <span class="input-group-text"> <i
                                        class="fa fa-user"></i> </span>
                                <input type="hidden" name="id" value="<?php echo $admin_details['u_id']?>">
                                <input type="text" class="form-control" id="full_name"
                                    placeholder="Name" value="<?php echo $fname?>" name="fname">
                                <div class="invalid-feedback">
                                    Enter Full name
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="text-label form-label" for="email">Email ID
                                </label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-envelope"></i> </span>
                                <input type="email" class="form-control" id="email"
                                    placeholder="email" value="<?php echo $email?>" name="email">

                                <div class="invalid-feedback">
                                    Enter email.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="text-label form-label" for="mobile">Mobile
                                Number </label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-phone"></i> </span>
                                <input type="text" class="form-control" id="mobile"
                                    placeholder="Mobile" name="mobile" value="<?php echo $mobile;?>" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                <div class="invalid-feedback">
                                    Enter mobile.
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="text-label form-label"
                                for="dlab-password">Upload profile</label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-file"></i> </span>
                                <input type="file" name="File" value="<?php  echo $img?>" class="form-control"
                                    id="dlab-password">

                                <div class="invalid-feedback">
                                    Please Enter a email.
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="btn me-2 btn-primary css_btn">Update</button>
                        <!-- <button type="submit" class="btn btn-light css_btn">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <div class="pt-4">
                <div class="basic-form">
                <form id="updateProfile" method="POST">
                        <div class="mb-3">
                            <label class="text-label form-label" for="current-password">
                                Current Password </label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-lock"></i> </span>
                                <input type="hidden" name="u_id" value="<?php echo $admin_details['u_id'];?>">
                                <input type="password" class="form-control" id="pass_log_id0"
                                    id="current-password" name="current_password" placeholder="current password"
                                    required="">
                                <span class="input-group-text show-pass">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password0">

                                </span>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-label form-label" for="new-password">New
                                Password </label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-lock"></i> </span>
                                <input type="password" class="form-control" id="pass_log_id"
                                    name="new_password" placeholder="new password"
                                    required="">
                                <span class="input-group-text show-pass">
                                   
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password">

                                    </span>
                                </span>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-label form-label"
                                for="confirm-password">Confirm Password </label>
                            <div class="input-group transparent-append">
                                <span class="input-group-text"> <i
                                        class="fa fa-lock"></i> </span>
                                <input type="password" class="form-control" id="pass_log_id1"
                                    id="confirm-password" name="confirm_password" placeholder="confirm password"
                                    required="">
                                <span class="input-group-text show-pass" toggle="#password-field">
                                  <span  class="fa fa-fw fa-eye field_icon toggle-password1"></span><!-- <i class="fa fa-eye"></i> -->

                                </span>

                            </div>
                        </div>

                        <button type="submit"
                            class="btn me-2 btn-primary css_btn">Change</button>
                        <!-- <button type="submit" class="btn btn-light css_btn">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

    </div>
</div>
        <div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>

$(document).on('click', '.toggle-password0', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#pass_log_id0");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-password', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#pass_log_id");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-password1', function() {

$(this).toggleClass("fa-eye fa-eye-slash");

var input = $("#pass_log_id1");
input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_profile') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".category_modal").modal('hide');
                 $(".append_data").html(res);
                $(".successmessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });
    

    $(document).on('submit', '#updateProfile', function(e) {
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HomeController/change_password') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            setTimeout(function() {
                $(".loader_block").hide();
                $(".category_modal").modal('hide');
                if (res == 1) {
                    $(".successmessage").show();
                    $('a[href="#home"]').tab('show');
                    setTimeout(function() {
                        $(".successmessage").hide();
                        // Redirect to a specific tab
                        // Assuming you have a tab element with the id "myTab"
                        
                    }, 1000);
                } else if (res == 2) {
                    alert("Something went Wrong");
                    return false;
                } else if (res == 3) {
                    alert("New password and Confirm Password do not match");
                    return false;
                } else {
                    alert("Incorrect Old password");
                    return false;
                }
            }, 2000);
        }
    });
});

</script>