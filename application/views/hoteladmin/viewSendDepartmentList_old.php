<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Notification to Departments</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li class="active">Notification to Departments</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of Notification</header>
               </div>
               <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="card-body ">
                  <div class="row mb-3">
                     <div class="col-md-4">
                        <form method="POST">
                           <div class="input-group " style="margin-left:4px;">
                              <select id="inputState" name="send_to" class="default-select form-control wide">
                                 <option selected="" disabled >Select Send to</option>
                                 <option value="1">All</option>
                                 <option value="2">Specific</option>
                              </select>
                              <select id="inputState" name="notification_type" class="default-select form-control wide " >
                                 <option selected="" disabled> Notification Type </option>
                                 <option value="2">Push Notification</option>
                                 <option value="3">Email Notification</option>
                              </select>
                              <button name="search" type="submit" class="btn btn-warning  btn-sm "><i
                                 class="fa fa-search"></i></button>
                           </div>
                        </form>
                     </div>
                     <div class="col-md-8">
                        <div>
                           <button style="float:right;" type="button" class="btn btn-primary css_btn"
                              data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Create Notification</button>
                        </div>
                        <br><br>
                        <div class="modal fade bd-add-modal update_login_modal" id="exampleModalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Add Notification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <form  id="frmblock" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <div class="basic-form">
                                             <div class="row">
                                                <div class=" mb-3 col-md-6 form-group">
                                                   <label class="form-label">Send To</label>
                                                   <select name="send_to" id="ddlPassport"
                                                      class="default-select form-control wide"
                                                      onchange="ShowHideDiv()">
                                                      <option selected="" disabled="">Choose...</option>
                                                      <option value="all">All Department </option>
                                                      <option value="specific">Specific Department
                                                      </option>
                                                   </select>
                                                   <!-- <div class="nice-select default-select form-control wide" tabindex="0"><span class="current">Choose...</span><ul class="list"><li data-value="Choose..." class="option selected disabled">Choose...</li><li data-value="all" class="option">All Department </li><li data-value="specific" class="option">Specific Department</li></ul></div> -->
                                                </div>
                                                <div id="dvPassport" class=" mb-3 col-md-6 form-group "
                                                   style="display: none;">
                                                   <label class="form-label">Select department</label>
                                                   <select class="multi-select" name="departments[]"
                                                      multiple="multiple">
                                                      <?php 
                                                         if($hotel_admin_panels)
                                                         {
                                                             foreach($hotel_admin_panels as $h_p)
                                                             {
                                                         ?>
                                                      <option value="<?php echo $h_p['department_id']?>"><?php echo $h_p['department_name']?></option>
                                                      <?php
                                                         }
                                                         }
                                                         ?>
                                                   </select>
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Notification type</label>
                                                   <div>
                                                      <select name="notification_type" id=""
                                                         class="default-select form-control wide"
                                                         required="">
                                                         <option value="" selected="" disabled="">
                                                            ---select---
                                                         </option>
                                                         <option value="4">Both</option>
                                                         <option value="2">Push Notification</option>
                                                         <option value="3">Email Notification</option>
                                                      </select>
                                                      <!-- <div class="nice-select default-select form-control wide" tabindex="0"><span class="current">---select---</span><ul class="list"><li data-value="" class="option selected disabled">---select---</li><li data-value="" class="option">Both</li><li data-value="" class="option">Push Notification</li><li data-value="" class="option">Email Notification</li></ul></div> -->
                                                   </div>
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Subject</label>
                                                   <div class="input-group">
                                                      <input type="text" name="title" class="form-control"
                                                         placeholder="enter subject" required>
                                                   </div>
                                                </div>
                                                <div class="mb-3 col-md-12 form-group">
                                                   <label class="form-label">Message</label>
                                                   <textarea name="description" class="summernote"></textarea>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="text-center">
                                             <button type="submit" class="btn btn-info">Add
                                             Notification</button>
                                          </div>
                                 </form>
                                 </div>
                                 </div> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="table-scrollable">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.no.</strong></th>
                              <th><strong>Send To</strong></th>
                              <th><strong>Notification Type</strong></th>
                              <th><strong>Subject</strong></th>
                              <th><strong>Message</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody  class="append_data">
                           <?php
                              $i = 1;
                              if($list)
                              {
                              foreach($list as $nt)
                              {
                              $send_to = "";
                              
                              if($nt['send_to'] == 1)
                              {
                              $send_to = "All";
                              }
                              else
                              {
                              $send_to = "Specific";
                              }
                              
                              $notification_type = "";
                              
                              if($nt['notification_type'] == 1)
                              {
                              $notification_type = "Whatsapp Notification";
                              }
                              else
                              {
                              if($nt['notification_type'] == 2)
                              {
                                  $notification_type = "Push Notification";
                              }
                              else
                              {
                                  if($nt['notification_type'] == 3)
                                  {
                                      $notification_type = "Email Notification";
                                  }
                                  else
                                  {
                                      if($nt['notification_type'] == 4)
                                      {
                                          $notification_type = "Email and Push Notification";
                                      }
                                  }
                              }
                              }
                              ?>
                           <tr>
                              <td><strong><?php echo $i++ ?></strong></td>
                              <td>
                                 <?php echo $send_to?>
                              </td>
                              <td><?php echo $notification_type?></td>
                              <td><?php echo $nt['title']?></td>
                              <td>

                                    <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp "
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter_<?php echo $nt['notification_id'];?>"><i
                                    class="fa fa-envelope"></i></a>
                              </td>

                              <td>
                                 <div class="">
                                  

                                       <a href="javascript:void(0)"  data-id="<?= $nt['notification_id']?>" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-share"></i>
                                    </a>
                                 
                                    <a href="#" onclick="delete_data(<?php echo $nt['notification_id'] ?>)"
                                       class="btn btn-danger shadow btn-xs sharp"><i
                                       class="fa fa-trash"></i></a>
                                 </div>
                              </td>
                                                            <!-- msg modal -->
                                                            <div class="modal fade" id="exampleModalCenter_<?php echo $nt['notification_id'];?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title"><b>Message</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                       <p>
                                             <?php echo $nt['description'] ?>
                                          </p>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                             
                            
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   $(document).on('submit', '#frmblock', function(e){
   // alert('hi');
   e.preventDefault();
   $(".loader_block").show();
   var form_data = new FormData(this);
   $.ajax({
      url         : '<?= base_url('HoteladminController/sent_notification_to_department') ?>',
      method      : 'POST',
      data        : form_data,
      processData : false,
      contentType : false,
      cache       : false,
      success     : function(res) {
        $.get( '<?= base_url('HoteladminController/sendDepartment');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
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
   function delete_data(id)
   {
   var id = id;
   var base_url = '<?php echo base_url()?>';
   
   const swalWithBootstrapButtons = Swal.mixin({
      customClass: 
      {
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
                  url     : base_url + "HoteladminController/delete_notification",
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
    $(document).on('click', '.resendNoti', function(e){
   e.preventDefault(); 
   $(".loader_block").show();

   var notificationId = $(this).attr('data-id');
   if (confirm("Are you sure you want to Resend the Message?")) {
       $.ajax({
          url         : '<?= base_url('HoteladminController/resend_notification_to_department') ?>',
          method      : 'POST',
          data        : {notificationId: notificationId},
          success     : function(res) {
            $.get( '<?= base_url('HoteladminController/sendDepartment');?>', function( data ) {
   var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
               $(".loader_block").hide();
               $(".append_data").html(res);
                $(".updatemessage").show();
                }, 2000);
                setTimeout(function(){  
              $(".updatemessage").hide();
            }, 4000);
          }
       });
   }
   });
</script>

<script type="text/javascript">
   function ShowHideDiv() {
       var ddlPassport = document.getElementById("ddlPassport");
       var dvPassport = document.getElementById("dvPassport");
       dvPassport.style.display = ddlPassport.value == "specific" ? "block" : "none";
   }
</script>