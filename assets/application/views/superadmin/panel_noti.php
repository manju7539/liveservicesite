<!-- start page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Panel Notification</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Notification</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Notification Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Notification</header>
               </div>
               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button id="addRow1"  class="btn btn-info add_hotel">
                     Create Notification
                     </button>
                  </div>
                  <div class="table-scrollable" >
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th>Sr.no.</th>
                              <th>Send To</th>
                              <th>Name</th>
                              <th>Notification Type</th>
                              <th>Subject</th>
                              <th>Message</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php
                              if(!empty($list))
                              {
                                   $i = 1 ;                                                              
                                   //    $i=$this->uri->segment(2)+1;
                                   // $data["list"] =$this->MainModel->getAllTableData($tbl='superadmin_notification');
                                   foreach($list as $row)
                                           {
                                                   if($row['send_for']==1)
                                                   {
                                                       $st="All Hotels";
                                                   }
                                                   elseif($row['send_for']==2)
                                                   {
                              
                                                       $st="specific hotels";
                                                   }
                                                   elseif($row['send_for']==3)
                                                   {
                                                       $st="All customer";
                                                   }
                                                   elseif($row['send_for']==4)
                                                   {
                                                       $st="specific customer";
                                                   }
                                                   elseif($row['send_for']==5)
                                                   {
                                                       $st="location";
                                                   }
                                                  
                                                   else
                                                   {
                                                       $st="-";
                                                   }
                              
                              
                                                   if($row['notification_type']==1)
                                                   {
                                                       $nt="Whatsapp";
                                                   }
                                                   elseif($row['notification_type']==2)
                                                   {
                                                       $nt="Push Notification";
                                                   }
                                                   elseif($row['notification_type']==3)
                                                   {
                                                       $nt="Email";
                                                   }
                                                   else
                                                   {
                                                       $nt=" ";
                                                   }
                                                   ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $st?></h5>
                              </td>
                              <td>
                                 <!-- <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm_<?php echo $row['notification_id']; ?>">
                                 <i class="fa fa-eye"></i>
                                 </a> -->
                                 <a href="#" class="btn btn-secondary btn-xs edit_model_click" data-unic-id="<?php echo $row['notification_id']?>"><i class="fa fa-eye"></i></a>
                              </td>
                              <td>
                                 <h5><?php echo $nt?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $row['title']?></h5>
                              </td>
                              <td>
                                 <a href="#"
                                    class="btn btn-secondary shadow btn-xs sharp "
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter_<?php echo $row['notification_id'];?>"><i
                                    class="fa fa-envelope"></i></a>
                              </td>
                              <td>
                                 <div>
                                    <a href="javascript:void(0)"  data-id="<?= $row['notification_id']?>" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-share"></i>
                                    </a>
                                    <a href="#" id="delete_<?php echo $row['notification_id']; ?>"
                                       class=" btn btn-danger shadow btn-xs sharp"><i
                                       class="fa fa-trash"></i></a>
                                 </div>
                              </td>
                              <div class="modal fade" id="exampleModalCenter_<?php echo $row['notification_id'];?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title"><b>Message</b></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <textarea name="" class="form-control" id="" cols="30" rows="10" readonly><?php echo strip_tags($row['description']);?></textarea>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </tr>
                           <script>
                              document.getElementById('delete_<?php echo $row['notification_id'] ?>').onclick = function() {
                              var id='<?php echo $row['notification_id'] ?>';
                              // alert(id);
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
                                              url:base_url+"SuperAdminController/delete_cities", 
                                              
                                              type: "post",
                                              data: {id:id},
                                              dataType:"HTML",
                                              success: function (data) {
                                                  if(data==1){
                                                  swal(
                                                          "Deleted!",
                                                          "Your  Plan has been deleted!",
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
                           <!-- end of modal  -->
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
<?php
   $where='(user_type = 2)';
   $city_list = $this->SuperAdmin->group_city($tbl='register',$where);
   
   ?>
<?php
   $id=$this->session->userdata('notification_id');
   //echo $id; die;
   $admin_id = $this->session->userdata('u_id');
   
   ?>
<!-- add btn modal  -->
<div class="modal fade add_leads_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md ">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Notification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="addplan" method="POST" enctype="multipart/form-data">
               <input type="hidden" class="form-control" name="notification_id" value="<?php echo $id;?>">
               <div class="row">
                  <div class=" mb-3 col-md-6 form-group">
                     <label class="form-label">Send To</label>
                     <select name="send_for" id="" class="default-select form-control wide"
                        onchange="send_specific(this.value); ">
                        <option selected="" disabled=""> Choose...</option>
                        <!-- <option value="0">All</option> -->
                        <option value="1">All Hotels </option>
                        <option value="2">Specific Hotel</option>
                        <option value="3">All Customer</option>
                        <option value="4">Specific Customer</option>
                        <option value="5">Location</option>
                     </select>
                  </div>
                  <div id="all_user" class=" mb-3 col-md-6 form-group "
                     style="display: none;">
                     <label class="form-label">Select Hotel</label>
                     <select class="multi-select example" name="individual[]" 
                        multiple="true" style="width:100%"  >
                     <?php
                        $users=$this->SuperAdmin->get_hotels_id();
                        
                        foreach($users as $u)
                            {
                                $name=$u['hotel_name'];
                                
                                echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                            }
                        ?>
                     </select>
                  </div>
                  <div id="all_customer" class=" mb-3 col-md-6 form-group "
                     style="display: none;">
                     <label class="form-label">Select Customer</label>
                     <select class="multi-select example"  name="users[]" 
                        multiple="multiple"  style="width:100%"  >
                        <?php 
                           if($user_list)
                           {
                               foreach($user_list as $us)
                               {
                           ?>
                        <option value="<?php echo $us['u_id']?>"><?php echo $us['full_name']?></option>
                        <?php
                           }
                           }
                           ?>
                     </select>
                  </div>
                  <div id="all_location" class=" mb-3 col-md-6 form-group "
                     style="display: none;">
                     <label class="form-label">Select Location</label>
                     <select class="multi-select" name="name[]"
                        multiple="multiple"  style="width:100%" >
                        <?php 
                           if($get_user_list_by_hotels)
                           {
                               foreach($get_user_list_by_hotels as $us)
                               {   
                                    $wh = '(city_id = "'.$us['city'].'")';
                                   $cities = $this->SuperAdmin->getSingleData('city',$wh);
                                  if(!empty($cities))
                                    {
                                      $city2 = $cities['city'];
                                    
                                     }
                                  else
                                   {
                                       $city2 = "-";
                                       
                           
                                   }
                           ?>
                        <option value="<?php echo $us['u_id']?>"><?php echo $city2 ?></option>
                        <?php
                           }
                           }
                           ?>
                     </select>
                  </div>
                  <div class=" mb-3 col-md-6 form-group">
                     <label class="form-label">Notification</label>
                     <select name="notification_type" id="" class="multi-select form-control wide"
                        multiple="multiple"  style="width:100%">
                        <option value="1">Whatsapp</option>
                        <option value="2">Push</option>
                        <option value="3">Email</option>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Subject</label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="title"
                           placeholder="enter subject" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-12 form-group">
                     <label class="form-label">Message</label>
                     <!-- <div class="summernote"></div> -->
                     <textarea class="summernote" name="description" style="min-height: 400px;"></textarea>
                  </div>
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-success css_btn">Send</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

   <div class="modal fade" id="notification_names_view_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Names</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="basic-form get_data_model">
        </div>
    </div>
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   // $(document).on("click",".resendNoti",function(){
   //    var data_id = $(this).attr('data-id');
   //    $(".add_staff_modal_"+data_id).modal('show');
   // });
   $(document).on("click",".add_hotel",function(){
      $(".add_leads_modal").modal('show');
   });
   $(document).on('click','.edit_model_click', function () {
        var id = $(this).attr('data-unic-id');
        $('#notification_names_view_model').modal('show');
        // $('#set_id_in_model').val($(this).attr('data-unic-id'));
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "POST",
            url: base_url+"SuperAdminController/get_view_name_data_notification",
            data: {id : id},
            // dataType: "dataType",
            success: function (response) {
            console.log(response);
            $('.get_data_model').html(response);
            }
        });
    });
   
   $(document).on('submit', '#addplan', function(e){
      e.preventDefault(); 
      $(".loader_block").show();
      var form_data = new FormData(this);
      console.log(form_data);
      $.ajax({
          url         : '<?= base_url('SuperAdminController/add_notification') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          // dataType    : 'JSON',
          async:false,
          success     : function(res) {
            
                $.get( '<?= base_url('panel_noti');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
   
              setTimeout(function(){  
               $(".loader_block").hide();
               $(".add_leads_modal").modal('hide');
               $(".add_leads_modal").on("hidden.bs.modal", function () {
    $("#addplan")[0].reset(); // reset the form fields
});
               $(".append_data").html(res);
                $(".updatemessage").show();
                }, 2000);
               setTimeout(function(){  
                  $(".updatemessage").hide();
                }, 4000);
          }
      });
   });
   $(document).on('submit', '#frmupdateblock', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?= base_url('SuperAdminController/update_lead_recharge') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {
            
              setTimeout(function(){  
               $(".loader_block").hide();
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
   
   // $(document).ready(function() {
   //   $('#example1').DataTable();
   
   $(document).on('click', '.resendNoti', function(e){
   e.preventDefault(); 
   var notificationId = $(this).attr('data-id');
   if (confirm("Are you sure you want to Resend the Message?")) {
       $.ajax({
          url         : '<?= base_url('SuperAdminController/resend_notification') ?>',
          method      : 'POST',
          data        : {notificationId: notificationId},
          success     : function(res) {
              $('example1_wrapper').DataTable();
              $('example1_wrapper').html('');
              table_data = $(res).find('.table-scrollable');
              $('example1_wrapper').append(table_data);
              $('example1_wrapper').DataTable().destroy();
              location.reload(true);
          }
       });
   }
   });
   
   
   
   $(document).ready(function() {
      $('#main_cat').change(function() {
   
          var base_url = '<?php echo base_url()?>';
          var cat = $('#main_cat').val();
   
   
          if (cat) {
              $.ajax({
                  url: base_url + "SuperAdminController/changeSubcategory",
                  method: "post",
                  data: {
                      cat: cat
                  },
                  success: function(data) {
                      //  alert(data);
                      $('#sub_cat').html(data);
                  }
   
              });
          } else {
              $('#sub_cat').html('<option>Select Hotel</option>');
          }
      });
   });
   
   $(document).ready(function() {
      $('#city').change(function() {
   
          var base_url = '<?php echo base_url()?>';
          var cat = $('#city').val();
          //    alert(cat);
   
          if (cat) {
              $.ajax({
                  url: base_url + "SuperAdminController/editsubhotels",
                  method: "post",
                  data: {
                      cat: cat
                  },
                  success: function(data) {
                      //  alert(data);
                      $('#hotels').html(data);
                  }
   
              });
          } else {
              $('#hotels').html('<option>Select Hotel</option>');
          }
      });
   });
</script>
<script>
   function send_specific(values) {
       if (values == "1") {
           document.getElementById('all_location').style.display = "none";
           document.getElementById('all_user').style.display = "none";
           document.getElementById('all_customer').style.display = "none";
       }
       if (values == "2") {
           document.getElementById('all_user').style.display = "block";
           document.getElementById('all_customer').style.display = "none";
           document.getElementById('all_location').style.display = "none";
       }
       if (values == "3") {
           document.getElementById('all_location').style.display = "none";
           document.getElementById('all_user').style.display = "none";
           document.getElementById('all_customer').style.display = "none";
       }
       if (values == "4") {
           document.getElementById('all_customer').style.display = "block";
           document.getElementById('all_user').style.display = "none";
           document.getElementById('all_location').style.display = "none";
       }
       if (values == "5") {
           document.getElementById('all_location').style.display = "block";
           document.getElementById('all_user').style.display = "none";
           document.getElementById('all_customer').style.display = "none";
       }
   }
</script>