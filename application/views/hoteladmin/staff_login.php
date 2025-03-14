 <style>
.staff_login .container-fluid {
    padding: 0px
}
 </style><!-- start page content -->
 <div class="page-content-wrapper">
     <div class="page-content">
         <div class="page-bar">
             <div class="page-title-breadcrumb">
                 <div class=" pull-left">
                     <div class="page-title">Staff Login</div>
                 </div>
                 <ol class="breadcrumb page-breadcrumb pull-right">
                     <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                             href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                     </li>
                     <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i class="fa fa-angle-right"></i>
                     </li>
                     <li class="active">Staff Login</li>
                 </ol>
             </div>
         </div>
         <?php
                    if($this->session->flashdata('msg'))
                    {
                ?>
         <div class="alert alert-primary" role="alert">
             <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
         </div>
         <?php
                    }
                ?>
         <div class="alert alert-success successmessage" role="alert" id="a"
             style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
             <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>

             <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;"
                 aria-hidden="true">&times;</span>

         </div>
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-topline-aqua">
                     <div class="card-head">
                         <header>All Staff Login</header>

                     </div>
                     <div class="card-body">
                         <div class="btn-group r-btn">
                             <a class="btn btn-info add_login_person" href="javascript:void(0)">Create Staff Login
                                 ID</a>
                         </div>

                         <div class="table-scrollable staff_login">
                             <table id="example1" class="display full-width">
                                 <thead>
                                     <tr>
                                         <th><strong>Sr.No.</strong></th>
                                         <th><strong>Profile</strong></th>
                                         <th><strong>Department</strong></th>
                                         <th><strong>Full Name</strong></th>
                                         <!--<th><strong>Password </strong></th>-->
                                         <th><strong>Email Id</strong></th>
                                         <th><strong>Mobile No. </strong></th>
                                         <th><strong>Shift </strong></th>
                                         <th><strong>Shift Time</strong></th>
                                         <!-- <th><strong> Access</strong></th> -->
                                         <!--<th><strong>ID proof</strong></th>-->
                                         <th><strong>Password</strong></th>
                                         <th>Status</th>
                                         <th><strong>Action</strong></th>
                                     </tr>
                                 </thead>
                                 <tbody class="append_data">
                                     <?php

                                    $i = 1;
                                    if($staff_list)
                                    {
                                        foreach($staff_list as $st)
                                        {
                                            
                                            if($st['profile_photo'])
                                            {
                                                $profile_photo = $st['profile_photo'];
                                            }
                                            else
                                            {
                                                $profile_photo = base_url().'assets/upload/blank_img/blankpic.jpg';
                                            }

                                            $user_type = "";
                                            //user type
                                            if($st['user_type'] == 8)
                                            {
                                                $user_type = "Foods And Beverages";
                                            }
                                            else
                                            {
                                                if($st['user_type'] == 9)
                                                {
                                                    $user_type = "House keeping";
                                                }
                                                else
                                                {
                                                    if($st['user_type'] == 10)
                                                    {
                                                        $user_type = "Room Service";
                                                    }
                                                }
                                            }

                                            $shift_type = "";
                                            //shift time
                                            if($st['shift_type'] == 1)
                                            {
                                                $shift_type = "Morning";
                                            }
                                            else
                                            {
                                                if($st['shift_type'] == 2)
                                                {
                                                    $shift_type = "General";
                                                }
                                                else
                                                {
                                                    if($st['shift_type'] == 3)
                                                    {
                                                        $shift_type = "Night";
                                                    }
                                                }
                                            }
                                    ?>

                                     <tr>
                                         <td><?php echo $i++ ?></td>
                                         <td>
                                             <div class="lightgallery">
                                                 <a href="<?php echo $profile_photo ?>"
                                                     data-exthumbimage="<?php echo $profile_photo ?>"
                                                     data-src="<?php echo $profile_photo ?>"
                                                     class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">

                                                     <img src="<?php echo $profile_photo ?>" class="img-thumbnail"
                                                         style="height: 35px;box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
                                                 </a>
                                             </div>
                                         </td>
                                         <td><?php echo $user_type?></td>
                                         <td>
                                             <span class="w-space-no"><?php echo $st['full_name'] ?></span>
                                         </td>
                                         <!-- <td><?php echo $st['password_text'] ?></td>-->
                                         <td><?php echo $st['email_id'] ?></td>
                                         <td><?php echo $st['mobile_no'] ?></td>
                                         <td><?php echo $shift_type?></td>
                                         <td><?php echo date('h:i a',strtotime($st['shift_start_time'])) ?> to
                                             <?php echo date('h:i a',strtotime($st['shift_end_time'])) ?></td>
                                         <!-- <td>
                                            <a href="<?php //echo base_url('access_frontOffice') ?>" class="badge badge-rounded badge-secondary"><i class="fa fa-check"></i>
                                            </a>
                                        </td> -->

                                         <!--<td>
                                            <div class="lightgallery">
                                                <a href="<?php echo $st['Id_proff_photo'] ?>" data-exthumbimage="<?php echo $st['Id_proff_photo'] ?>" data-src="assets/dist/images/aadhar.jpg" class="col-lg-3 col-md-6 mb-4">
                                                    <img src="<?php echo $st['Id_proff_photo'] ?>" alt="" style="width:50px;">
                                                </a>
                                            </div>
                                        </td>-->
                                         <td><?php echo $st['password_text'] ?></td>
                                         <td>
                                             <select class="default-select form-control wide"
                                                 id="status_<?php echo $st['u_id'] ?>"
                                                 onchange="change_status(<?php echo $st['u_id'] ?>)">
                                                 <option <?php if($st['is_active'] == 1){echo "Selected";}?> value="1">
                                                     Active</option>
                                                 <option <?php if($st['is_active'] == 0){echo "Selected";}?> value="0">
                                                     Deactive</option>
                                             </select>
                                         </td>
                                         </td>
                                         <td>
                                         <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $st['u_id']?>" ><i class="fa fa-trash"></i></a> 
                                         </td>
                                     </tr>
                                     <?php
                                        }
                                    }
                                    ?>

                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 </div>



 <!-- add btn modal  -->
 <div class="modal fade bd-add-modal update_login_modal" tabindex="-1" style="display: none;" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form id="frmblock" method="post" enctype="multipart/form-data">
                 <div class="modal-header">
                     <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Login Info</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="col-lg-12">
                         <div class="basic-form">
                             <div class="row">
                                 <div class="mb-12 col-md-12" style="margin-bottom:15px">
                                     <label class="form-label">Select Department</label>

                                     <select class="form-control" name="department_id">
                                         <?php
                                            if($list)
                                            {
                                                foreach ($list as $dep_list) 
                                                {
                                                    ?>
                                         <option name="department_id" value="<?php echo $dep_list['department_id'] ?>">
                                             <?php echo $dep_list['department_name'] ?></option>
                                         <?php
                                                }
                                            }
                                        ?>
                                     </select>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">First Name</label>
                                     <input type="text" name="first_name" value="" class="form-control" required>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">Last Name</label>
                                     <input type="text" name="last_name" value="" class="form-control" required>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">Mobile No.</label>
                                     <input type="text" maxlength="10"
                                         oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="mobile_no"
                                         class="form-control" required="">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">Email ID</label>
                                     <input type="text" name="email_id" value="" class="form-control" required>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">Default Password</label>
                                     <input type="text" name="password" class="form-control" required value="admin"
                                         readonly>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label class="form-label">Upload Icon</label>
                                     <div class="input-group mb-3">
                                         <div class="form-file form-control" style="border: 0.0625rem solid #ccc7c7;">
                                             <input type="file" accept=".jpg,.jpeg,.png,application/"
                                                 name="profile_photo" class="form-control" required="">
                                         </div>
                                         <span class="input-group-text">Upload</span>
                                     </div>
                                 </div>
                                 <div class="mb-6 col-md-6" style="margin-bottom:15px">
                                     <label class="form-label">Select Shift</label>
                                     <select class="form-control" name="shift_type">
                                         <option value="1">Morning</option>
                                         <option value="2">General</option>
                                         <option value="3">Night</option>
                                     </select>
                                 </div>
                                 <div class="mb-3 col-md-4">
                                     <label class="form-label">Time</label>
                                     <div class="input-group">
                                         <input type="time" class="form-control" name="shift_start_time" required="">
                                         <input type="time" class="form-control" name="shift_end_time" required="">
                                     </div>
                                 </div>

                                 <!--   <div class="mb-3 col-md-12">
                                        <label class="form-label">Description</label>
                                      
                                        <textarea class="summernote" name="desc"  required=""></textarea>
                                    </div> -->
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary css_btn">Add</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- end add btn modal -->




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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

 <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
 <script>
function change_status(id) {
    var base_url = '<?php echo base_url()?>';
    var status = $('#status_' + id).children("option:selected").val();
    var id = id;
    // alert(id);

    if (status != '') {
        $.ajax({
            url: base_url + 'HoteladminController/change_users_status',
            method: "post",
            data: {
                status: status,
                id: id
            },
            success: function(data) {
                // alert(data)
                if (data == 1) {
                    alert('Status Chnaged successfully');
                    // location.reload();
                } else {
                    alert('Something went wrong');
                    // location.reload();
                }
            }
        });
    }
}
 </script>
 <script>
    // delete department script
    $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HoteladminController/delete_login_staff') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your file has been deleted.", "success");
                        $.get('<?= base_url('HoteladminController/staff_login');?>', function(data) {
                        var resu = $(data).find('.table-scrollable').html();
                        $('.table-scrollable').html(resu);
                        setTimeout(function() {
                            $('#example1').DataTable();
                        }, 2000);
                    });
                        $(".loader_block").hide();
                        $(".append_data").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }

                });

            } else {
                swal(
                  "Cancelled",
                        "Your file is safe",
                        "error"
                );
            }
        });
    });

   </script>


 <script>
$(document).on("click", ".add_login_person", function() {
    $(".update_login_modal").modal('show');
});

$(document).on('submit', '#frmblock', function(e) {
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HoteladminController/create_all_department_staff') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            $.get('<?= base_url('HoteladminController/staff_login');?>', function(data) {
                var resu = $(data).find('.table-scrollable').html();
                $('.table-scrollable').html(resu);
                setTimeout(function() {
                    $('#example1').DataTable();
                }, 2000);
            });
            setTimeout(function() {
                $(".loader_block").hide();
                $(".update_login_modal").modal('hide');
                $(".update_login_modal").on("hidden.bs.modal", function() {
                    $("#frmblock")[0].reset(); // reset the form fields
                });
                $(".append_data").html(res);
                $(".successmessage").show();
            }, 2000);
            setTimeout(function() {
                $(".successmessage").hide();
            }, 4000);

        }
    });
});

$(document).on('submit', '#frmupdateblock', function(e) {
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url: '<?= base_url('HoteladminController/create_all_department_staff') ?>',
        method: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        cache: false,
        success: function(res) {
            setTimeout(function() {
                $(".loader_block").hide();
                $(".update_modal").modal('hide');
                $(".append_data").html(res);
                $(".updatemessage").show();
            }, 2000);
            setTimeout(function() {
                $(".updatemessage").hide();
            }, 4000);

        }
    });
});
 </script>