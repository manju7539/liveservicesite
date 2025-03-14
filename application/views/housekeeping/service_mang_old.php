<style>
   .service_manage .container-fluid{
      padding:0px
   }
</style>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Service management</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Service management</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Added Service Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">updated Service Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of services</header>
               </div>
               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button id="addRow1" class="btn btn-info add_service">
                     Add Service
                     </button>
                  </div>
                  <div class="table-scrollable service_manage">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.No.</strong></th>
                              <th><strong>Service Type</strong></th>
                              <th><strong>Icon</strong></th>
                              <th><strong>Amount</strong></th>
                              <th><strong>Remark</strong></th>
                              <th><strong>Status</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php
                              if (!empty($service_list)) {
                                  $i = 1;
                                  foreach ($service_list as $l) 
                                  {
                                     if(!empty($l['icon']))
                                     {
                                           $img= $l['icon'];
                                     }
                                     else
                                     {
                                          $img="";
                                     }
                              
                              ?>
                           <tr>
                              <td><?php echo $i; ?></td>
                              <td>
                                 <span><?php echo $l['service_type'] ?></span>
                              </td>
                              <td> <img class="me-2 " target="_blank" src="<?php echo $l['icon']?>"
                                                alt="" style="width:100px;"></td>
                              <!-- <td>
                                 <div class="lightgallery">
                                    <a href="<?php echo $img;?>" target="_blank"
                                       class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                    <img class="me-2 "
                                       src="<?php echo $img;?>" alt=""
                                       style="width:80px;">
                                    </a>
                                 </div> -->
                             
                              <td><?php echo $l['amount'] ?></td>
                              <td> <a href="#" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_<?php echo $l['h_k_services_id'] ?>">view</a>
                              </td>
                              <input type="hidden" name="user_id" id="uid<?php echo $l['h_k_services_id'];?>" value="<?php echo $l['h_k_services_id'];?>">
                              <td>
                                 <select class="default-select form-control wide" name="is_active" id="active<?php echo $l['h_k_services_id'];?>" onchange="change_status(<?php echo $l['h_k_services_id']?>);">
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
                              <td class="text-center">
                                 <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                    data-bs-toggle="modal"
                                    data-id="<?php echo $l['h_k_services_id']?>" data-bs-target=".update_service_modal"><i
                                    class="fa fa-pencil"></i></a>
                                 <a href="#" id="delete_<?php echo $l['h_k_services_id'] ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                                 <i class="fa fa-trash "></i> </a>
                              </td>
                           </tr>
                           <!-- Modal popup for view-->
                           <div class="row">
                              <div class="modal fade" id="exampleModalCenter_<?php echo $l['h_k_services_id'] ?>" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Note:</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p><?php echo $l['description'] ?></p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- modal popup for edit  -->
                           <!--dlt script start-->                                                               
                           <script>
                              document.getElementById('delete_<?php echo $l['h_k_services_id'] ?>').onclick = function() {
                              var id='<?php echo $l['h_k_services_id'] ?>';
                              var base_url='<?php echo base_url();?>';
                              swal({
                              
                                  
                                  title: "Are you sure?",
                                  text: "You will not be able to recover this file!",
                                  type: "warning",
                                  showCancelButton: true,
                                  confirmButtonColor: '#DD6B55',
                                  confirmButtonText: 'Yes, delete it!',
                                  cancelButtonText: "No, cancel",
                                  closeOnConfirm: false,
                                  closeOnCancel: false
                              },
                              function(isConfirm) {
                              //console.log(id);
                                  if (isConfirm) {
                                      $.ajax({
                                          url:base_url+"HouseKeepingController/delete_services", 
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"HTML",
                                          success: function (data) {
                                              if(data==1){
                                              swal(
                                                      "Deleted!",
                                                      "Your  file has been deleted!",
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
                                          "Your  file is safe !",
                                          "error"
                                      );
                                  }
                              });
                              };
                           </script>
                           <!--end dlt script-->  
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
<!-- modal popup for edit  -->
<!-- Modal -->
<div class="modal fade update_service_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Order Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Service Type:</label>
                        <input type="hidden" name="u_id" id="id">
                        <input type="text" name="service_type" id="service_type" class="form-control" placeholder="">
                     </div>
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Icon</label>
                        <div class="input-group mb-3">
                           <div class="form-file form-control"
                              style="border: 0.0625rem solid #ccc7c7; position:static;">
                              <input type="file" name="File" id="File"  accept="image/png, image/gif, image/jpeg" >
                              
                           </div>
                           <span class="input-group-text">Upload</span>
                        </div>
                        <img src="" id="img" alt="Not Found" height="50" width="50">
                     </div>
                     <div class="mb-3 col-md-4">
                        <label class="form-label">Amount:</label>
                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="">
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Remark:</label>
                        <!--<div id="summernote1"></div>-->
                        <textarea class="summernote" name="description" id="description">

                        </textarea>
                     </div>
                  </div>
                  <div class="text-center">
                     <button type="submit" class="btn btn-primary css_btn">Save</button>
                     <button type="button" class="btn btn-light css_btn"  data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end of modal  -->
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
<!-- add service modal  -->
<div class="modal fade add_service_modal" tabindex="-1"  aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock1" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="u_id"  id="u_id">
            <div class="modal-header">
               <h5 class="modal-title">Add service</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Service Type:</label>
                           <input type="text" name="type" class="form-control" placeholder="Enter Service Type" required>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Icon</label>
                           <div class="input-group mb-3">
                              <div class="form-file form-control"
                                 style="border: 0.0625rem solid #ccc7c7;">
                                 <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                              </div>
                              <!--<span class="input-group-text">Upload</span>-->
                           </div>
                        </div>
                        <div class="mb-3 col-md-4">
                           <label class="form-label">Amount:</label>
                           <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="amount" class="form-control" placeholder="Enter Amount" >
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Remark:</label>
                           <!--<div id="summernote"></div>-->
                           <textarea class="summernote" id="remark" name="remark" required></textarea>
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
<!-- end add service modal -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).on("click",".add_service",function(){
       $(".add_service_modal").modal('show');
   });
   $(document).on('submit', '#frmblock1', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_services') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
              
                   $.get( '<?= base_url('service_mang');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                  
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
                   

                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_service_modal").modal('hide');
                $(".add_service_modal").on("hidden.bs.modal", function() {
                     $("#frmblock1")[0].reset(); // reset the form fields
                  });
                  $('#remark').summernote('reset');
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
              
              
           });
       });
   
       $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getServiceData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#id').val(data.h_k_services_id);
                                           // $('#id').val(data.u_id);
                                            $('#service_type').val(data.service_type);
                                            $('#amount').val(data.amount);
                                            $("#img").attr('src',data.icon);
                                          //   $('#file').src(data.file);
                                             $('#description').summernote('code', data.description);
                                          
                                           
   
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
           url         : '<?= base_url('HouseKeepingController/update_services') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('service_mang');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                  
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
               //  $(".updateFaq").modal('hide');
                $(".update_service_modal").modal('hide');
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
                           url: base_url + "HouseKeepingController/update_status_services",
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