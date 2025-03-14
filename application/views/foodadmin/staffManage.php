 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
 <!-- start page content -->
 <style>
.food_staff .container-fluid {
    padding: 0px
}
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Staff management</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Staff management</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Staff Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Staff Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Staff Manage</header>
                       
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1" class="btn btn-info add_staff">
                            Add Staff 
                        </button>
                    </div>
                                        
                        <div class="table-scrollable food_staff">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Joining Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                            <?php 
                                if(!empty($staff_list)){
                                    $i=1;
                                     foreach($staff_list as $s)
                                    {
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><div class="align-items-center"><span
                                                                    class="w-space-no"><?php echo $s['full_name']?></span></div></td>
                                      <td><?php echo $s['u_id']?></td>
                                        <td><?php echo $s['mobile_no']?></td>
                                        <td><?php echo $s['email_id']?> </td>
                                        <!-- <td>Morning</td> -->
                                        <td><?php echo date('d-m-Y', strtotime($s['register_date']));?></td>
                                        <input type="hidden" name="user_id" id="uid<?php echo $s['u_id'];?>" value="<?php echo $s['u_id'];?>">
                                        <td>
                                            <select class="form-control" name="is_active" id="active<?php echo $s['u_id'];?>" onchange="change_status(<?php echo $s['u_id']?>);">
                                                <?php 
                                                    if($s['is_active']=="1") 
                                                    {
                                                ?>
                                                    <option value=" 1" selected>Active</option>
                                                    <option value="0">Deactive</option>
                                                <?php 
                                                    }
                                                    if($s['is_active']=="0")
                                                    { 
                                                ?>
                                                    <option value="1">Active</option>
                                                    <option value="0" selected>Deactive</option>
                                                <?php 
                                                    } 
                                                ?>
                                            </select>
                                        </td>
                                         <td>
                                       
                                        
                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 mng_staff_eye" data-bs-toggle="modal" u-id=<?= $s['u_id']?> hotel-id=<?= $s['hotel_id']?> data-bs-target=".bd-view-modal-superadmin-guest"><i class="fa fa-eye"></i></a>

                                    
                                        <a href="#" class="btn btn-warning btn-xs edit_model_click" data-id="<?php echo $s['u_id']?>"><i class="fa fa-pencil"></i></a>

                                                       
                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['u_id']?>" ><i class="fa fa-trash"></i></a>
                                   
                                    </td>
                    
                                    </tr>
 
       <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
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
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
  <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Staff</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile No.</label>
                                            <input type="text" name="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Mobile No" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email_Id</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                        </div>
                                      
                                         <div class="mb-3 col-md-6">
                                             <label class="form-label">Profile Photo</label>
                                               <input type="file" name="File" accept="image/png, image/gif, image/jpeg" class="form-control" required>
                                          </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Address</label>
                                                <textarea name="address" class="summernote" cols="30" rows="10"></textarea>
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
        <!-- eye model start -->
        <div class="modal fade  bd-view-modal-superadmin-guest" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock4"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                         
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body food_staff_eye">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- eye model end -->
        <!-- edit model strat -->
        <div class="modal fade" id="food_mng_staf_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px;">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Edit Details:</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="basic-form get_food_mng_staff_data_model">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- edit model end -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>
    $(document).on('click','.edit_model_click', function () {
        var u_id = $(this).attr('data-id');
        $('#food_mng_staf_edit_modal').modal('show');
        // $('#set_id_in_model').val($(this).attr('data-unic-id'));
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "POST",
            url: base_url+"HomeController/get_edit_mng_staff_detaiils",
            data: {u_id : u_id},
            // dataType: "dataType",
            success: function (response) {
            // console.log(response);
            $('.get_food_mng_staff_data_model').html(response);
            

            }
        });
    });

$(document).on('click', '.mng_staff_eye', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('u-id');
        var hotel_id = $(this).attr('hotel-id');

        // alert(id+""+hotel_id);
        // var uid1= $(this).attr('u-id1');
       
        // console.log(id);
        // console.log(uid1);

        // return false;
        $.ajax({
            url         : '<?= base_url('HomeController/staffdetails') ?>',
            method      : 'POST',
            data        : {id: id,hotel_id:hotel_id},
            
            success     : function(res) {
                // console.log(res);

                $('.food_staff_eye').html(res);

                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>
<script>

    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_staff') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('foodstaffManage');?>', function( data ) {
                    var resu = $(data).find('.food_staff').html();
                    $('.food_staff').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_staff_modal").modal('hide');
                 $(".add_staff_modal").on("hidden.bs.modal", function() {
                     $("#frmblock")[0].reset(); // reset the form fields
                  });
                $('.summernote').summernote('reset');

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
            url         : '<?= base_url('HomeController/update_staff_details') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $("#food_mng_staf_edit_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });

    // delete staff
    $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

            var id = $(this).attr('delete-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Staff!",
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
                        url: '<?= base_url('HomeController/delete_staff') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your staff has been deleted!", "success");
                            $.get('<?= base_url('foodstaffManage');?>', function (data) {
                                var resu = $(data).find('.food_staff').html();
                                $('.food_staff').html(resu);
                                setTimeout(function () {
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
                        "Your  staff is safe!",
                        "error"
                    );
                }
            });
    });

</script>

<script type="text/javascript">
    function change_status(cnt) {
             //alert('hi');
              var base_url = '<?php echo base_url();?>';
              var status = $('#active'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
                //alert(cid);
              if (status != '') {

                  $.ajax({
                      url: base_url + "HomeController/update_status_user",
                      method: "POST",
                      data: {
                          active: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                          //alert(data);
                          if (data == true) {
                              alert('Status Changed Sucessfully !..');
                          } else {
                              alert('Something Went Wrong !...')
                          }
                      }
                  });
              }
          }
</script>