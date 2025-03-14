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
                  <div class="tools">
                     <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                     <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                     <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
               </div>
               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('serviceRequest')?>" style="color:white;">List Of Request</a></button> 
                     <button id="addRow1" class="btn btn-info add_facility">
                     Add Request
                     </button>  
                  </div>
                  <div class="table-scrollable">
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
                                 <h5><?php echo $f_l['created_at']?></h5>
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
                        $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                        $room_no = $this->MainModel->getAllData($tbl ='room_status',$where);
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
                  <textarea class="summernote" name="requirement" style="min-height: 400px;"></textarea>
               </div>
               <div class=" mb-3 col-md-6 form-group">
                  <label class="form-label">Send to department </label>
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
   
   // $(document).on('submit', '#frmblock', function(e){
   //     e.preventDefault();
   //     $(".loader_block").show();
   //     var form_data = new FormData(this);
   //     $.ajax({
   //         url         : '<?= base_url('HomeController/add_facility') ?>',
   //         method      : 'POST',
   //         data        : form_data,
   //         processData : false,
   //         contentType : false,
   //         cache       : false,
   //         success     : function(res) {
   //             setTimeout(function(){  
   //              $(".loader_block").hide();
   //              $(".add_facility_modal").modal('hide');
   //              $(".append_data").html(res);
   //               $(".successmessage").show();
   //               }, 2000);
   //             setTimeout(function(){  
   //                 $(".successmessage").hide();
   //               }, 4000);
              
   //         }
   //     });
   // });
   
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
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_facility_modal").modal('hide');
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