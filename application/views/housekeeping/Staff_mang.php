<style>
   .staff_list .container-fluid{
   padding:0px
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
      <div class="alert alert-success successmessage11" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Mobile Number Already Exist</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success successmessage12" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Email Allready Exist</strong>
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
                  <div class="tab-content">
                     <div class="tab-pane active" id="staff_new_order_div">
                        <div class="table-scrollable staff_list" >
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>SR.NO.</strong></th>
                                    <th><strong>NAME</strong></th>
                                    <th><strong>Employee ID</strong></th>
                                    <th><strong>MOBILE</strong></th>
                                    <th><strong>EMAIL</strong></th>
                                    <th><strong>JOINING DATE</strong></th>
                                    <th><strong>STATUS</strong></th>
                                    <th><strong>ACTION</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php   
                                    if (!empty($staff_list)) 
                                    {
                                        $i=1;
                                        foreach ($staff_list as $l) 
                                        {
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i;?></strong></td>
                                    <td>
                                       <div class="align-items-center"><span
                                          class="w-space-no"><?php echo $l['full_name']?></span></div>
                                    </td>
                                    <td><?php echo $l['u_id']?></td>
                                    <td><?php echo $l['mobile_no']?></td>
                                    <td><?php echo $l['email_id']?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l['register_date']));?></td>
                                    <input type="hidden" name="user_id" id="uid<?php echo $l['u_id'];?>" value="<?php echo $l['u_id'];?>">
                                    <td>
                                       <select class="form-control" name="is_active" id="active<?php echo $l['u_id'];?>" onchange="change_status(<?php echo $l['u_id']?>);">
                                          <?php 
                                             if($l['is_active']=="1") 
                                             {
                                             ?>
                                          <option value=" 1" selected>Active</option>
                                          <option value="0">Deactive</option>
                                          <?php 
                                             }
                                             if($l['is_active']=="0")
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
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 view_id" data-bs-toggle="modal" u-id1=<?= $l['u_id']?> data-bs-target=".bd-view-modal-staff-view"><i class="fa fa-eye"></i>
                                       </a>
                                       <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                          data-bs-toggle="modal"
                                          data-id="<?php echo $l['u_id']?>" data-bs-target=".update_staff_modal"><i
                                          class="fa fa-pencil"></i></a>
                                       <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['u_id']?>" ><i class="fa fa-trash"></i></a> 
                                    </td>
                                 </tr>
                                 <?php
                                    $i++;
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
</div>
<!-- modal popup for edit  -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="u_id"  id="u_id">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name"  class="form-control" required  >
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Mobile No.</label>
                        <input type="text" name="mobile_no" id="mobile_no"  class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Email_Id</label>
                        <input type="email" name="email_id" id="email_id"  class="form-control" required >
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Photo</label>
                        <input type="file" name="File" id="File"  class="form-control" placeholder="" >
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Address</label>
                        <!--<div id="summernote1"></div>-->
                        <textarea class="summernote" name="address" id="address"></textarea>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary  css_btn">Save</button>
                        <button type="button" class="btn btn-light  css_btn"  data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end of modal  -->
<!-- model gor view -->
<div class="modal fade  bd-view-modal-staff-view" tabindex="-1"  aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:90%">
      <div class="modal-content">
         <form id="frmblock3"  method="post" enctype="multipart/form-data">
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
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock1" method="post" enctype='multipart/form-data'>
            <div class="modal-header">
               <h5 class="modal-title">Add Staff</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Full Name</label>
                           <input type="text" name="s_name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Mobile No.</label>
                           <input type="text" name="s_mobile" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Mobile No" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Email_Id</label>
                           <input type="email" name="s_email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Photo</label>
                           <input type="file" name="File" accept="image/png, image/gif, image/jpeg" class="form-control" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Address</label>
                           <textarea class="summernote" name="s_address" id="s_address" placeholder="Enter Address" required></textarea>
                        </div>
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).on("click",".add_staff",function(){
       $(".add_staff_modal").modal('show');
   
   
   
   
   $(document).on('submit', '#frmblock1', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_staff') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               if(res==1)
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_staff_modal").modal('hide');
               //  $(".append_data").html(res);
                 $(".successmessage11").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage11").hide();
                 }, 4000);
               }
               else if(res==2)
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_staff_modal").modal('hide');
               //  $(".append_data").html(res);
                 $(".successmessage12").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage12").hide();
                 }, 4000);
               }
               else
               {
                   $.get( '<?= base_url('Staff_mang');?>', function( data ) {
                   var resu = $(data).find('#staff_new_order_div').html();
                  
                   $('#staff_new_order_div').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
                   
                   
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_staff_modal").modal('hide');
                $(".add_staff_modal").on("hidden.bs.modal", function() {
                    $("#frmblock1")[0].reset(); // reset the form fields
                   
                 });
                 
                    $('#s_address').summernote('reset'); // reset the form fields
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
              
              
           }
       });
   });
   });
   
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getStaffData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#u_id').val(data.u_id);
                                            $('#full_name').val(data.full_name);
                                            $('#mobile_no').val(data.mobile_no);
                                            $('#email_id').val(data.email_id);
                                           //  $('#File').val(data.File);
                                             $('#address').summernote('code', data.address);
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });
   
       $(document).on('submit', '#frmupdateblock', function(e){
           // alert('hi');die;
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/update_staff') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('Staff_mang');?>', function( data ) {
                   var resu = $(data).find('#staff_new_order_div').html();
                  
                   $('#staff_new_order_div').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
               //  $(".updateFaq").modal('hide');
                $(".update_staff_modal").modal('hide');
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
<script>
   function change_status(cnt) {
                  //alert('hi');
                   var base_url = '<?php echo base_url();?>';
                   var status = $('#active'+cnt).children("option:selected").val();
                   var uid = $('#uid'+cnt).val();
   				//alert(cid);
                   if (status != '') {
   
                       $.ajax({
                           url: base_url + "HouseKeepingController/update_status_user",
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
<script>
   $(document).on('click', '.view_id', function(){
          
           //$(".loader_block").show();
           var id = $(this).attr('view_id');
           var uid1= $(this).attr('u-id1');
          
           // console.log(id);
           // return false;
           $.ajax({
               url         : '<?= base_url('HouseKeepingController/staffdetails') ?>',
               type      : 'POST',
               data        : {view_id: id,u_id1: uid1},
               
               success     : function(res) {
                   console.log(res);
   
                   $('.customer_view').html(res);
   
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
   
      
        // delete department script
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
                       url: '<?= base_url('HouseKeepingController/delete_staff') ?>',
                       method: "POST",
                       data: { id: id },
                       dataType: "html",
                       success: function (data) {
                           swal("Deleted!", "Your file has been deleted!", "success");
                           $.get('<?= base_url('Staff_mang');?>', function (data) {
                               var resu = $(data).find('#staff_new_order_div').html();
                               $('#staff_new_order_div').html(resu);
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
                           "Your  file is safe !",
                           "error"
                   );
               }
           });
       });
   
   
</script>