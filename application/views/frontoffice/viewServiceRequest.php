<style>
   .service_request .container-fluid{
   padding:0px
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Service Request</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li>Service Request</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Request Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Request Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Service Request</header>
               </div>
               <div class="card-body ">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#arrival1_div_spa" data-bs-toggle="tab" class="active">Create Service Request</a>
                              </li>
                              <li class="nav-item"><a href="#arrival2_div1_spa" data-bs-toggle="tab">Service Request</a>
                              </li>
                              <li class="nav-item"><a href="#accept_div" data-bs-toggle="tab">Accept Request</a>
                              </li>
                              <li class="nav-item"><a href="#reject_div" data-bs-toggle="tab">Reject Request</a>
                              </li>
                           </ul>
                        </header>
                     </div>
                  </div>
                  <div class="btn-group r-btn">
                     <button id="addRow1" class="btn btn-info add_facility">
                     Add Request
                     </button>  
                  </div>
                  <div class="tab-content">
                     <!-- upcoming guest -->
                     <div class="tab-pane active" style="background-color:white;" id="arrival1_div_spa">
                        <div class="table-scrollable service_request">
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Date / Time</th>
                                    <th>Room No</th>
                                    <th>Guest Name</th>
                                    <th>Request</th>
                                    <th>Sent Deparment</th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php
                                    if(!empty($list))
                                    {
                                        $i=1;
                                        foreach($list as $f_l)
                                        {
                                            $wh = '(department_id  = "'.$f_l['send_to'].'")';
                                            $depart_name = $this->MainModel->getData(' departement',$wh);
                                            if(!empty($depart_name))
                                        {
                                            $department_name = $depart_name['department_name'];
                                    
                                    
                                        }
                                        else
                                        {
                                            $department_name = "-";
                                    
                                        }
                                    
                                    
                                    
                                    ?>
                                 <tr>
                                    <td>
                                       <h5>
                                       <?php echo $i++;?>
                                    </td>
                                    <!-- <td>
                                       10/10/2022 / <sub> 02:30 AM</sub>
                                       </td> -->
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($f_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($f_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
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
                     <div class="tab-pane" style="background-color:white;" id="accept_div">
                        <div class="table-scrollable service_request">
                           <table id="list" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Date / Time</th>
                                    <th>Room No</th>
                                    <th>Guest Name</th>
                                    <th>Request</th>
                                    <th>Sent Deparment</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody >
                                 <?php
                                    if(!empty($list3))
                                    {
                                        $i=1;
                                        foreach($list3 as $f_l)
                                        {
                                            $wh = '(department_id  = "'.$f_l['send_to'].'")';
                                            $depart_name = $this->MainModel->getData(' departement',$wh);
                                            if(!empty($depart_name))
                                        {
                                            $department_name = $depart_name['department_name'];
                                    
                                    
                                        }
                                        else
                                        {
                                            $department_name = "-";
                                    
                                        }
                                    
                                    
                                    
                                    ?>
                                 <tr>
                                    <td>
                                       <h5>
                                       <?php echo $i++;?>
                                    </td>
                                    <!-- <td>
                                       10/10/2022 / <sub> 02:30 AM</sub>
                                       </td> -->
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($f_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($f_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td><span class="badge badge-primary">Accepted</span></td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" style="background-color:white;" id="reject_div">
                        <div class="table-scrollable service_request">
                           <table id="list1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Date / Time</th>
                                    <th>Room No</th>
                                    <th>Guest Name</th>
                                    <th>Request</th>
                                    <th>Sent Deparment</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    if(!empty($list4))
                                    {
                                        $i=1;
                                        foreach($list4 as $f_l)
                                        {
                                            $wh = '(department_id  = "'.$f_l['send_to'].'")';
                                            $depart_name = $this->MainModel->getData(' departement',$wh);
                                            if(!empty($depart_name))
                                        {
                                            $department_name = $depart_name['department_name'];
                                    
                                    
                                        }
                                        else
                                        {
                                            $department_name = "-";
                                    
                                        }
                                    
                                    
                                    
                                    ?>
                                 <tr>
                                    <td>
                                       <h5>
                                       <?php echo $i++;?>
                                    </td>
                                    <!-- <td>
                                       10/10/2022 / <sub> 02:30 AM</sub>
                                       </td> -->
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($f_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($f_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td><span class="badge badge-danger">Rejected</span></td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" style="background-color:white;" id="arrival2_div1_spa">
                        <div class="table-scrollable service_request">
                           <table id="list21" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Date / Time</th>
                                    <th>Room No</th>
                                    <th>Only Guest Name</th>
                                    <th>Request</th>
                                    <th>Sent Deparment</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php
                                    if(!empty($list2))
                                    {
                                        $i=1;
                                        foreach($list2 as $f_l)
                                        {
                                            $wh = '(department_id  = "'.$f_l['send_to'].'")';
                                            $depart_name = $this->MainModel->getData(' departement',$wh);
                                            if(!empty($depart_name))
                                        {
                                            $department_name = $depart_name['department_name'];
                                    
                                    
                                        }
                                        else
                                        {
                                            $department_name = "-";
                                    
                                        }
                                    
                                    
                                    
                                    ?>
                                 <tr>
                                    <td>
                                       <h5>
                                       <?php echo $i++;?>
                                    </td>
                                    <!-- <td>
                                       10/10/2022 / <sub> 02:30 AM</sub>
                                       </td> -->
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($f_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($f_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $f_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $f_l['service_request_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a>
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
</div>
<!-- add btn modal  -->
<!-- add btn modal  -->
<div class="modal bd-add-modal add_facility_modal" style="display:none !important">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Service</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <?php 
                           $user_id = $this->session->userdata('u_id');
                           $wh_h_id = '(u_id = "'.$user_id.'")';
                           $get_user_data = $this->MainModel->getData('register',$wh_h_id);
                           $hotel_id = $get_user_data['hotel_id'];
                           
                           ?>
                        <!-- <div class="mb-3 col-md-6">
                           <label class="form-label">Room No</label>
                           <input type="number" class="form-control" placeholder="">
                           </div> -->
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Room No</label>
                           <select  id="room_no" name="room_no" class="default-select form-control wide dropdown js-example-disabled-results"
                              >
                              <option selected="">Choose...</option>
                              <!-- <option>Mr.M.S.Rathod</option>
                                 <option>Ms.Priya</option>
                                 <option>Ms.R.K.Mohan </option>
                                 <option>Mr.M.R.Soni </option> -->
                              <option selected="">Select... </option>
                              <?php 
                                 //$where = '(hotel_id = 3)';
                                 // $where = '(hotel_id = "'.$hotel_id.'")';
                                 // $room_no = $this->MainModel->getAllData($tbl ='room_nos',$where);
                                 // $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                                 $room_no = $this->FrontofficeModel->get_accupied_rooms($hotel_id);
                                 // print_r($room_no);exit;
                                 foreach ($room_no as $r_no) 
                                 {
                                 ?>
                              <option value="<?php echo $r_no["room_no"];?>"><?php echo $r_no["room_no"];?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                        </div>
                        <!-- <div class="mb-3 col-md-6">
                           <label class="form-label">Guest Name</label>
                           <input type="" class="form-control" placeholder="">
                           </div> -->
                        <div class="mb-3 col-md-6">
                           <label class="form-label"> Guest Name</label>
                           <input type="hidden" class="form-control"   name="user_n"  placeholder="Enter name" id="user_id">
                           <input type="text" class="form-control" name="user_name" placeholder="Guest Name" id="users_name">
                        </div>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Requirement</label>
                           <!-- <div class="summernote"></div> -->
                           <textarea class="summernote" name="requirement" id="requirement1" style="min-height: 400px;"></textarea>
                        </div>
                        <div class=" mb-3 col-md-6 form-group">
                           <label class="form-label">Send to Department </label>
                           <!-- <select name="send_to" class="form-control" required> -->
                           <select name="send_to" class="default-select form-control wide  js-example-disabled-results" required>
                              <option value="" selected disabled>--Select--</option>
                              <?php
                                 $admin_id = $this->session->userdata('u_id');
                                 
                                 $wh_admin = '(u_id ="'.$admin_id.'")';
                                 $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                 $hotel_id = $get_hotel_id['hotel_id']; 
                                 
                                 // $wh11 = '(user_type = 8 AND hotel_id ="'.$hotel_id.'")';
                                 $wh11 = '(admin_id = "'.$hotel_id.'" AND department_id != 2 AND department_id != 1)';
                                 $food_staff = $this->MainModel->getAllData($tbl = 'hotels_panel_list', $wh11);
                                 foreach ($food_staff as $f_staff) 
                                 {
                                     $name = $f_staff['department_name'];
                                 ?>
                              <option value="<?php echo $f_staff["department_id"]; ?>"><?php echo $name; ?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary css_btn">Add
                        Request</button>
                     </div>
         </form>
         </div>
         </div>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Order status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <!-- <input type="hidden" name="b_c_reserve_id" id="b_c_reserve_id"> -->
                        <input type="hidden" name="service_request_id" id="service_request_id">
                        <label class="form-label">Change Order Status</label>
                        <select  id="send_user"  name="request_status" class="default-select form-control wide" required>
                           <option value="">Choose...</option>
                           <option value="1">Accept</option>
                           <option value="2">Reject</option>
                        </select>
                     </div>
                     <!-- <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                        <label class="form-label">Reason For Rejecting</label>
                        <select id="reason" name="reject_reason" class="default-select form-control wide">
                           <option value="">Choose</option>
                           <option value="1">Please Try After Sometime</option>
                           <option value="2">Temporarily unavailable</option>
                           <option value="3">Slots not available</option>
                           <option value="4">Please contact Front office</option>
                        </select>
                        </div> -->
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Save</button>
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <!-- <p>loader 3</p> -->
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
        $('#list21').DataTable();
        $('#list').DataTable();
        $('#list1').DataTable();
   });
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                 url: '<?= base_url('FrontofficeController/serviceId') ?>',
                    type: "post",
                 data: {id:id},
                 dataType:"json",
                 success: function (data) {
                    // console.log(data);
                    $('#service_request_id').val(data.service_request_id);
                    // $('.description_view').html(data.additional_note);                                        
                 }
              }); 
           })
       });
     $(document).ready(function()
     {
        var base_url = '<?php echo base_url();?>';
   
           $('#room_no').change(function() 
           {
              var $hotel_id = '<?php echo $hotel_id?>';
              var room_no = $('#room_no').val();
              //alert(room_no);
              if (room_no != '')
              {
                 
                    $.ajax({
                       
                       url: base_url + "FrontofficeController/get_user_id",
                       method: "POST",
                       data: {
                           room_no: room_no , hotel_id: $hotel_id
                       },
                       success: function(data)
                       {
                          //alert(data);
                          $('#user_id').val(data);
                       }
                    });
                    $.ajax({
                       
                       url: base_url + "FrontofficeController/get_user_name",
                       method: "POST",
                       data: {
                           room_no: room_no , hotel_id: $hotel_id
                       },
                       success: function(data)
                       {
                          //alert(data);
                          $('#users_name').val(data);
                       }
                    });
                   
              }
           });
     });   
</script>
<script>
   $(document).on("click",".add_facility",function(){
       $(".add_facility_modal").modal('show');
   });
   
   $(document).on("click",".update_facility_modal",function(){
       var data_id = $(this).attr('data-id');
      
       $(".add_facility_modal_"+data_id).modal('show');
   });
   $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?php echo base_url('FrontofficeController/change_service_status') ?>',
            type      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
               $.get( '<?= base_url('serviceRequest');?>', function( data ) {
                var resu = $(data).find('#arrival1_div_spa').html();
                var resu1 = $(data).find('#arrival2_div1_spa').html();
                var resu2 = $(data).find('#accept_div').html();
                var resu3 = $(data).find('#reject_div').html();
                $('#arrival1_div_spa').html(resu);
                $('#arrival2_div1_spa').html(resu1);
                $('#accept_div').html(resu2);
                $('#reject_div').html(resu3);
                setTimeout(function() {
                    $('#example1').DataTable();
                    $('#list21').DataTable();
                    $('#list').DataTable();
                    $('#list1').DataTable();
                }, 2000);
            });
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_staff_modal").modal('hide');
                 $(".update_staff_modal").on("hidden.bs.modal", function () {
                  $("#frmupdateblock")[0].reset(); // reset the form fields
                });
                 $(".updatemessage1").show();
               //   $(".append_data3").html(res);
                 var requestStatus = form_data.get('request_status');
               //  console.log(requestStatus); // Log the requestStatus value to the console
                     if (requestStatus === "1") {
                        $('a[href="#accept_div"]').tab('show');
                     } else if (requestStatus === "2") {
                        $('a[href="#reject_div"]').tab('show');
                        
                     }
                  }, 2000);
                  setTimeout(function(){  
                    $(".updatemessage1").hide();
                  }, 4000);
            }
           
        });
    });     
    $(document).on('submit', '#frmblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('FrontofficeController/add_service_request') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            $.get( '<?= base_url('serviceRequest');?>', function( data ) {
                   var resu = $(data).find('#arrival1_div_spa').html();
                  
                   $('#arrival1_div_spa').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
                   setTimeout(function(){  
                $(".loader_block").hide();
                $("#frmblock")[0].reset();
                $('#requirement1').summernote('reset'); 
                $(".add_facility_modal").modal('hide');
                 $(".successmessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
           });
    });
</script>