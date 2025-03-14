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
        <td><?php echo $s['register_date']?></td>
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
        <!-- <a href="<?php //echo base_url('HomeController/staffdetails/').$s['u_id']?>"
            class="btn btn-success view shadow btn-xs sharp ">
            <i class="fa fa-eye"></i></a> -->
            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 mng_staff_eye" data-bs-toggle="modal" u-id=<?= $s['u_id']?> hotel-id=<?= $s['hotel_id']?> data-bs-target=".bd-view-modal-superadmin-guest"><i class="fa fa-eye"></i></a>
          <!-- <a href="javascript:void(0)" data-id="<?php // $s['u_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i> 
                                                        </a>-->
                                                        <a href="#" class="btn btn-warning btn-xs edit_model_click" data-id="<?php echo $s['u_id']?>"><i class="fa fa-pencil"></i></a>
      <a href="#" id="delete_<?php echo $s['u_id'] ?>"
                                                        class="btn btn-tbl-delete btn-xs"><i
                                                            class="fa fa-trash-o"></i></a>
    </td>

    </tr>
<script>
                                            
    document.getElementById('delete_<?php echo $s['u_id'] ?>').onclick = function() {
    var id='<?php echo $s['u_id'] ?>';
    var base_url='<?php echo base_url();?>';
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
        },
        function(isConfirm) {
        
            if (isConfirm) {
                $.ajax({
                    url:base_url+"HomeController/delete_staff", 
                    
                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
                                "success");
                            }
                        $('.confirm').click(function()
                                                    {
                                                            location.reload();
                                                        });
                    }

                    
                    });                                                                                                           
                                
            } else {
                swal(
                    "Cancelled",
                    "Your  staff is safe !",
                    "error"
                );
            }
        });
};
                                        </script>
    <!-- modal popup for edit  -->
<div class="modal fade update_staff_modal add_staff_modal_<?php echo $s['u_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-lg slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="hidden" name="u_id" value="<?php echo $s['u_id']?>">
                            <input type="text" name="full_name" value="<?php echo $s['full_name']?>" class="form-control" placeholder="">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Mobile No.</label>
                            <input type="text" name="mobile" value="<?php echo $s['mobile_no']?>" class="form-control"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email_Id</label>
                            <input type="email" name="email" value="<?php echo $s['email_id']?>" class="form-control" placeholder="">
                        </div>
                       <div class="mb-3 col-md-6">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="File" value="<?php echo $s['profile_photo']?>" class="form-control" placeholder="">
                        </div>
                       <div class="col-md-12 col-sm-12">
                         <label class="form-label">Address</label>
                        <textarea name="address" class="summernote" cols="30" rows="10">
                            <?php echo $s['address']?>
                        </textarea>
                    </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light  css_btn">Close</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
<!-- end of modal  -->
<?php $i++; }  } ?>