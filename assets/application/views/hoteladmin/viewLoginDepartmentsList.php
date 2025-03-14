 <!-- start page content -->
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Manager Login</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Manager Login</li>
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
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
  
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
  
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Manager Login</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                   <!--  <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info">
                            Create Order<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                     <div class="btn-group r-btn">
                        <a class="btn btn-info add_login_person" href="javascript:void(0)">Create Manager Login ID</a>
                      <!--   <button id="addRow1" class="btn btn-info add_staff">
                            Departed Guest <i class="fa fa-eye"></i>
                        </button> -->
                    </div>
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                    <th><strong>Sr.No.</strong></th>
                                    <th><strong>Profile</strong></th>
                                    <th><strong>Department</strong></th>
                                    <th><strong>Full Name</strong></th>
                                    <!--<th><strong>Password </strong></th>-->
                                    <th><strong>Email Id</strong></th>
                                    <th><strong>Phone </strong></th>
                                    <th><strong>Shift </strong></th>
                                    <th><strong>Shift Time</strong></th>
                                    <th><strong> Access</strong></th>
                                    <!--<th><strong>ID proof</strong></th>-->
                                        <th><strong>Password</strong></th>
                                    <th>Status</th>
                                    <th><strong>Action</strong></th>
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                $i = 1;
                                                if($panel_admin_list)
                                                {
                                                    foreach($panel_admin_list as $p_ad)
                                                    {
                                                        
                                                        if($p_ad['profile_photo'])
                                                        {
                                                            $profile_photo = $p_ad['profile_photo'];
                                                        }
                                                        else
                                                        {
                                                            $profile_photo = base_url().'assets/upload/blank_img/blankpic.jpg';
                                                        }
                                                
                                                        $user_type = "";
                                                        //user type
                                                        if($p_ad['user_type'] == 3)
                                                        {
                                                            $user_type = "Front Office";
                                                        }
                                                        else
                                                        {
                                                            if($p_ad['user_type'] == 5)
                                                            {
                                                                $user_type = "House keeping";
                                                            }
                                                            else
                                                            {
                                                                if($p_ad['user_type'] == 6)
                                                                {
                                                                    $user_type = "Room Service";
                                                                }
                                                                else
                                                                {
                                                                    if($p_ad['user_type'] == 7)
                                                                    {
                                                                        $user_type = "Foods and Beverage";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                
                                                        $shift_type = "";
                                                        //shift time
                                                        if($p_ad['shift_type'] == 1)
                                                        {
                                                            $shift_type = "Morning";
                                                        }
                                                        else
                                                        {
                                                            if($p_ad['shift_type'] == 2)
                                                            {
                                                                $shift_type = "General";
                                                            }
                                                            else
                                                            {
                                                                if($p_ad['shift_type'] == 3)
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
                                                      <a href="<?php echo $profile_photo ?>" data-exthumbimage="<?php echo $profile_photo ?>" data-src="assets/dist/images/tab/staff.png" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                      <img src="<?php echo $profile_photo ?>" class="img-thumbnail" style="height: 35px;box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
                                                      </a>
                                                   </div>
                                                </td>
                                                <td><?php echo $user_type?></td>
                                                <td>
                                                   <span class="w-space-no"><?php echo $p_ad['full_name'] ?></span>
                                                </td>
                                                <!--<td><?php echo $p_ad['password_text'] ?></td>-->
                                                <td><?php echo $p_ad['email_id'] ?></td>
                                                <td><?php echo $p_ad['mobile_no'] ?></td>
                                                <td><?php echo $shift_type?></td>
                                                <td><?php echo date('h:i a',strtotime($p_ad['shift_start_time'])) ?> to <?php echo date('h:i a',strtotime($p_ad['shift_end_time'])) ?></td>
                                                <td>
                                                   <?php
                                                      if($p_ad['user_type'] == 3)
                                                      {
                                                          $user_type = "Front Office";
                                                      ?>
                                                 
                                                   <a href="#" class="badge badge-rounded badge-secondary booking_id" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 5)
                                                          {
                                                              $user_type = "House keeping";
                                                      ?>
                                                    <a href="#" class="badge badge-rounded badge-secondary booking_id1" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view1"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 6)
                                                          {
                                                              $user_type = "Room Service";
                                                      ?>
                                                   
                                                   <a href="#" class="badge badge-rounded badge-secondary booking_id2" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view2"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 7)
                                                          {
                                                              $user_type = "Foods and Beverage";
                                                      ?>
                                                       <a href="#" class="badge badge-rounded badge-secondary booking_id3" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view3"><i class="fa fa-check"></i></a>
                                                   <!-- <a href="<?php //echo base_url('HoteladminController/access_food/'.$p_ad['u_id']) ?>" class="badge badge-rounded badge-secondary"><i class="fa fa-check"></i></a> -->
                                                   <?php
                                                      }
                                                      }
                                                      }
                                                      }
                                                      ?>
                                                </td>
                                               <!-- <td>
                                                   <div class="lightgallery">
                                                      <a href="<?php echo $p_ad['Id_proff_photo'] ?>" data-exthumbimage="<?php echo $p_ad['Id_proff_photo'] ?>" data-src="<?php echo $p_ad['Id_proff_photo'] ?>" class="col-lg-3 col-md-6 mb-4">
                                                      <img src="<?php echo $p_ad['Id_proff_photo'] ?>" alt="" style="width:50px;">
                                                      </a>
                                                   </div>
                                                </td>-->
                                               <td><?php echo $p_ad['password_text'] ?></td>
                                                <td>
                                                   <select class="default-select form-control wide" id="status_<?php echo $p_ad['u_id'] ?>" onchange="change_status(<?php echo $p_ad['u_id'] ?>)" >
                                                      <option <?php if($p_ad['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                                                      <option <?php if($p_ad['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                                                   </select>
                                                </td>
                                                <td>
                                                   <a href="#" onclick="delete_data(<?php echo $p_ad['u_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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

<div class="modal fade  bd-view-modal-customer-view <?php echo $p_ad['u_id']??0 ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body customer_view">

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade  bd-view-modal-customer-view1 <?php echo $p_ad['u_id']??0 ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body customer_view1">

                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="modal fade  bd-view-modal-customer-view2 <?php echo $p_ad['u_id']??0 ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body customer_view2">

                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade  bd-view-modal-customer-view3 <?php echo $p_ad['u_id']??0 ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body customer_view3">

                        </div>
                    </form>
                </div>
            </div>
        </div>
                                           <!-- add btn modal  -->
<div class="modal fade bd-add-modal update_login_modal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
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
                                       <!-- <select class="form-control" name="department_id">
                                            <option value="1">Front Office</option>
                                            <option value="1">Room Service</option>
                                            <option value="1">Food & Beverages</option>
                                            <option value="1">Housekeeping Service</option>
                                       </select> -->
                                       <?php
                                        
                                       ?>
                                       <select class="form-control" name="department_id">
                                       <?php
                                      
                                                                  if($list){

                                                                      foreach ($list as $dep_list) {
                                                                         
                                                                         
                                                                  ?>
                                                              
                                                                  
                                                                      <option name="department_id" value="<?php echo $dep_list['department_id'] ?>"><?php echo $dep_list['department_name'] ?></option>
                                                                    
                                                                 
                                                              
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
                                        <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="mobile_no" class="form-control" required="">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Email ID</label>
                                        <input type="text" name="email_id" value="" class="form-control" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Default Password</label>
                                        <input type="text" name="password" class="form-control" required  value="admin" readonly>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Upload Icon</label>
                                        <div class="input-group mb-3">
                                            <div class="form-file form-control"
                                                style="border: 0.0625rem solid #ccc7c7;">
                                                <input type="file" accept=".jpg,.jpeg,.png,application/" name="profile_photo" class="form-control" required="">
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
                                  
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary css_btn" >Add</button>
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

<script>

    $(document).on("click",".add_login_person",function(){
        $(".update_login_modal").modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HoteladminController/create_all_department_admin') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_login_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });
    
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HoteladminController/create_all_department_admin') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
         // $('.delete').click(function() {
             function delete_data(id)
             {
                 var id = id;
                 var base_url = '<?php echo base_url()?>';
         
                 const swalWithBootstrapButtons = Swal.mixin({
                 customClass: {
                                 confirmButton: 'btn btn-danger',
                                 cancelButton: 'btn btn-success'
                             },
                 buttonsStyling: false
                 })
         
                 swalWithBootstrapButtons.fire({
                     title: 'Are you sure?',
                     text: "You won't be able to revert this!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Yes, delete it!',
                     cancelButtonText: 'No, cancel!',
                 reverseButtons: true
                 }).then((result) => 
                 {
                     if (result.isConfirmed) 
                     {
                         $.ajax({
                                 url     : base_url + "HoteladminController/delete_user",
                                 method  : "post",
                                 data    : {id : id},
                                 success : function(data)
                                         {
                                             // alert(data);
                                             if(data == 1)
                                             {
                                                 swalWithBootstrapButtons.fire(
                                                             'Deleted!',
                                                             'Your file has been deleted.',
                                                             'success'
                                                         ).then((result) =>
                                                         {
                                                             location.reload();
                                                         })
                                             }
                                         }
         
                             });
                     } 
                     else if (
                         /* Read more about handling dismissals below */
                         result.dismiss === Swal.DismissReason.cancel
                     ) {
                         swalWithBootstrapButtons.fire(
                             'Cancelled',
                             'Your imaginary file is safe :)',
                             'error'
                         )
                     }
                 })
             }
      </script>
      <script>
         function change_status(id)
         {
             var base_url = '<?php echo base_url()?>';
             var status = $('#status_'+id).children("option:selected").val();
             var id = id;
             // alert(id);
         
             if(status != '')
             {
                 $.ajax({
                             url     : base_url + 'HoteladminController/change_users_status',
                             method  : "post",
                             data    : {status : status, id : id},
                             success : function(data)
                                     {
                                         // alert(data)
                                         if(data == 1)
                                         {
                                             alert('Status Chnaged successfully');
                                             
                                         }
                                         else
                                         {
                                             alert('Something went wrong');
                                           
                                         }
                                     }
         
                 });
             }
         }
      </script>
      <script>

$(document).on('click', '.booking_id', function(){
       
    var uid1= $(this).attr('u-id1');
        $.ajax({
            url         : '<?= base_url('HoteladminController/access_frontOffice') ?>',
            type      : 'POST',
            data        : {u_id1: uid1},
            success     : function(res) {
                console.log(res);

                $('.customer_view').html(res);  
            }
            
        });
    });


    $(document).on('click', '.booking_id1', function(){
       
        var uid1= $(this).attr('u-id1');
      $.ajax({
           url         : '<?= base_url('HoteladminController/access_housekeeping') ?>',
           type      : 'POST',
           data        : {u_id1: uid1},
           
           success     : function(res) {
               console.log(res);

               $('.customer_view1').html(res);
           }
           
       });
   });

   $(document).on('click', '.booking_id2', function(){
       
       var uid1= $(this).attr('u-id1');
     $.ajax({
          url         : '<?= base_url('HoteladminController/access_room') ?>',
          type      : 'POST',
          data        : {u_id1: uid1},
          
          success     : function(res) {
              console.log(res);

              $('.customer_view2').html(res);
          }
          
      });
  });

  $(document).on('click', '.booking_id3', function(){
       
       var uid1= $(this).attr('u-id1');
     $.ajax({
          url         : '<?= base_url('HoteladminController/access_food') ?>',
          type      : 'POST',
          data        : {u_id1: uid1},
          
          success     : function(res) {
              console.log(res);

              $('.customer_view3').html(res);
          }
          
      });
  });
</script>
