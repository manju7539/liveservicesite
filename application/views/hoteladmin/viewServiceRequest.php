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
               <li class="active">Service Request</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Service Request Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
     
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="headingtitle">Create Service Request</span></header>
               </div>
               <div class="card-body">
                  <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                     <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#Service_Request_div" data-bs-toggle="tab" class="active">Create Service Request</a>
                           </li>
                           <li class="nav-item"><a href="#Service_AllRequest_div" data-bs-toggle="tab">Service Request</a>
                           </li>
                           <li class="nav-item"><a href="#Service_accepted_div" data-bs-toggle="tab">Accepted Service Request</a>
                           </li>
                           <li class="nav-item"><a href="#Service_rejected_div" data-bs-toggle="tab">Rejected Service Request</a>
                           </li>
                        </ul>
                     </header>
                     <div class="table-responsive">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                           <div class="card-body ">
                              <div class="btn-group r-btn">
                                 <button id="addRow1" class="btn btn-info add_request">
                                 Add Request
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane active" id="Service_Request_div">
                        <div class="table-scrollable">
                           <table id="request_manage_div" class="display full-width">
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
                                        // print_r($list);die;
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
                     <div class="tab-pane" id="Service_AllRequest_div">
                        <div class="table-scrollable1">
                           <table id="request_allmanage_div" class="display full-width">
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
                              <tbody class="append_data1">
                              <?php
                                    if(!empty($list1))
                                    {
                                        $i=1;
                                        foreach($list1 as $h_l)
                                        {
                                            $wh = '(department_id  = "'.$h_l['send_to'].'")';
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
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($h_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($h_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $h_l['requirement']?></h5>
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
                     <div class="tab-pane" id="Service_accepted_div">
                        <div class="table-scrollable2">
                           <table id="request_accepted_div" class="display full-width">
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
                              <tbody class="append_data2">
                              <?php
                                    if(!empty($list2))
                                    {
                                        $i=1;
                                        foreach($list2 as $a_l)
                                        {
                                            $wh = '(department_id  = "'.$a_l['send_to'].'")';
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
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($a_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($a_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $a_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $a_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $a_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td>
                                       <a href="#">
                                          <div class="badge badge-success" data-bs-toggle="modal" data-bs-target="">
                                             Accepted
                                          </div>
                                       </a>
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
                     <div class="tab-pane" id="Service_rejected_div">
                        <div class="table-scrollable3">
                           <table id="request_rejected_div" class="display full-width">
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
                              <tbody class="append_data3">
                              <?php
                                    if(!empty($list4))
                                    {
                                        $i=1;
                                        foreach($list4 as $r_l)
                                        {
                                            $wh = '(department_id  = "'.$r_l['send_to'].'")';
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
                                    <td>
                                       <?php echo date('d-m-Y',strtotime($r_l['created_at']))?>
                                       <sub><?php echo date('h:i A', strtotime($r_l['created_at']));?></sub>
                                    </td>
                                    <td>
                                       <h5><?php echo $r_l['room_no']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $r_l['guest_name']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $r_l['requirement']?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $department_name ?></h5>
                                    </td>
                                    <td>
                                       <a href="#">
                                          <div class="badge badge-danger" data-bs-toggle="modal" data-bs-target="">
                                            Rejected
                                          </div>
                                       </a>
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
<div class="modal bd-add-modal add_request_modal" style="display:none !important">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock1"  method="post" enctype="multipart/form-data">
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
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Room No</label>
                           <select  id="room_no" name="room_no" class="default-select form-control wide dropdown js-example-disabled-results"
                              >
                              <option value="" selected disabled>--Select--</option>
                              <?php 
                                 $room_no = $this->HotelAdminModel->get_accupied_rooms($user_id);
                                 
                                 foreach ($room_no as $r_no) 
                                 {
                                 ?>
                              <option value="<?php echo $r_no["room_no"];?>"><?php echo $r_no["room_no"];?></option>
                              <?php
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label"> Guest Name</label>
                           <input type="hidden" class="form-control"   name="user_n"  placeholder="Enter name" id="user_id">
                           <input type="text" class="form-control" name="user_name" placeholder="Guest Name" id="users_name">
                        </div>
                        <div class=" mb-3 col-md-6">
                           <label class="form-label">Requirement</label>
                           <textarea class="summernote" name="requirement" style="min-height: 400px;"></textarea>
                        </div>
                        <div class=" mb-3 col-md-6 form-group">
                           <label class="form-label">Send to Department </label>
                           <select name="send_to" class="default-select form-control wide  js-example-disabled-results" required>
                              <option value="" selected disabled>--Select--</option>
                              <?php
                                 $admin_id = $this->session->userdata('u_id');
                                 
                                 $wh_admin = '(u_id ="'.$admin_id.'")';
                                 $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                 $hotel_id = $get_hotel_id['hotel_id']; 
                                 
                                 // $wh11 = '(user_type = 8 AND hotel_id ="'.$hotel_id.'")';
                                 $wh11 = '(admin_id = "'.$admin_id.'" )';
                                //  print_r($wh11);die;
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
<!-- end of modal  -->
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
<!-- add service modal  -->
<!-- end add btn modal -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).ready(function() {
     $('#request_manage_div').DataTable();
     $('#request_allmanage_div').DataTable();
     $('#request_accepted_div').DataTable();
     $('#request_rejected_div').DataTable();
    
     $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';
   
                // Update the title based on the tab ID
                if (tabId === '#Service_Request_div') {
                 
                    
                    $('.add_request').css('display','block');
                    $('.headingtitle').text('Create Service Request');
                }   else if (tabId === '#Service_AllRequest_div') {
                    $('.add_request').css('display','none');
                   
                    
                    $('.headingtitle').text('Service Request');
                } else if (tabId === '#Service_accepted_div') {
                    $('.add_request').css('display','none');
                    $('.headingtitle').text('Accepted Service Request');
                }   else if (tabId === '#Service_rejected_div') {
                    $('.add_request').css('display','none');
                    $('.headingtitle').text('Rejected Service Request');
                }
   
              
            });
        });
   
     
   
   });
   
   
   
</script>
<script>
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
                        
                        url: base_url + "HoteladminController/get_user_id",
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
                        
                        url: base_url + "HoteladminController/get_user_name",
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
   $(document).on("click",".add_request",function(){
       $(".add_request_modal").modal('show');
   
    });
   $(document).on('submit', '#frmblock1', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HoteladminController/add_service_request') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
              
                   $.get( '<?= base_url('Ser_request');?>', function( data ) {
                   var resu = $(data).find('#Service_Request_div').html();
                  
                   $('#Service_Request_div').html(resu);
                   setTimeout(function(){
                       $('#request_manage_div').DataTable();
                   }, 2000);
               });
                   
                   
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_request_modal").modal('hide');
                $(".add_request_modal").on("hidden.bs.modal", function() {
                     $("#frmblock1")[0].reset(); // reset the form fields
                  });
                  
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
              
              
           });
       
    });
</script>
