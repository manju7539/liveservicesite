<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Room Status</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Room Status</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Rooms</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                   
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                 <tr>
                                    <th>Floor No.</th>
                                    <th>Booked Rooms</th>
                                    <th>Available Rooms</th>
                                    <th>Dirty Rooms</th>
                                    <th>Under Maintance</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                   
                                   if($floor_list)
                                   {
                                       foreach ($floor_list as $fl) 
                                       {
                                           if($fl['floor'] == 1)
                                           {
                                               $extension = "st";
                                           }
                                           else
                                           {
                                               if($fl['floor'] == 2)
                                               {
                                                   $extension = "nd";
                                               }
                                               else
                                               {
                                                   if($fl['floor'] == 3)
                                                   {
                                                       $extension = "rd";
                                                   }
                                                   else
                                                   {
                                                       $extension = "th";
                                                   }
                                               }
                                           }
                               ?>
                                   <tr>
                                       <td><b> <?php echo $fl['floor'] ?> <sup><?php echo $extension?></sup></b></td>
                                       <td>
                                           <div  class="px-1" style="display:flex;flex-wrap: wrap;justify-content: center;">
                                           <?php
                                               // $admin_id = $this->session->userdata('admin_id');
                                            //    $u_id= $this->session->userdata('front_id');
                                            //    $where ='(u_id = "'.$u_id.'")';
                                            //    $admin_details = $this->FrontofficeModel->getData($tbl ='register', $where);
                                               
                                               $u_id = $this->session->userdata('u_id');
                                               $where ='(u_id = "'.$u_id.'")';
                                               $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                              
                                               $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                               $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
                                               
                                                   $admin_id = $admin_details['hotel_id'];
                                               

                                               $room_no = $this->FrontofficeModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                               if($room_no)
                                               {
                                                   foreach ($room_no as $rn) 
                                                   {
                                                       $wh = '(room_no = "'.$rn['room_no'].'" AND room_status = 2  AND hotel_id = "'.$admin_id.'")';

                                                       $room_status = $this->FrontofficeModel->getData('room_status',$wh);

                                                       if($room_status)
                                                       {
                                           ?>
                                                       <div class="room_card card " style="background:#7cc142">
                                                           <span class="room_no d-flex justify-content-center align-items-center " style="height:38px; width:42px; "><?php echo $room_status['room_no']?></span>
                                                       </div>
                                           <?php
                                                       }
                                                   }
                                               }
                                               else
                                               {
                                                   echo "Room Not Availble";
                                               }
                                           ?>
                                           </div>
                                       </td>
                                       <td>
                                       <div  class="px-1" style="display:flex;flex-wrap: wrap;justify-content: center;">

                                           <?php
                                               // $admin_id = $this->session->userdata('admin_id');
                                               $u_id = $this->session->userdata('u_id');
                                               $where ='(u_id = "'.$u_id.'")';
                                               $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                               
                                               $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                               $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
                                               
                                                   $admin_id = $admin_details['hotel_id'];

                                               $room_no = $this->FrontofficeModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                               if($room_no)
                                               {
                                                   foreach ($room_no as $rn) 
                                                   {
                                                       $wh1 = '(room_no = "'.$rn['room_no'].'" AND room_status = 3 AND hotel_id = "'.$admin_id.'")';

                                                       $room_status1 = $this->FrontofficeModel->getData('room_status',$wh1);

                                                       if($room_status1)
                                                       {
                                           ?>
                                                       <div class="room_card card" style="background:#a9ada6">
                                                            <span class="room_no d-flex justify-content-center align-items-center" style="height:38px; width:42px; "><?php echo $room_status1['room_no']?></span>
                                                       </div>
                                                      
                                                       
                                           <?php
                                                       }
                                                   }
                                               }
                                               else
                                               {
                                                   echo "Room Not Availble";
                                               }
                                           ?>
                                           </div>
                                       </td>
                                       <td>
                                       <div  class="px-1" style="display:flex;flex-wrap: wrap;justify-content: center;">

                                           <?php
                                               // $admin_id = $this->session->userdata('admin_id');
                                               $u_id = $this->session->userdata('u_id');
                                               $where ='(u_id = "'.$u_id.'")';
                                               $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                               
                                               $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                               $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
                                               
                                                   $admin_id = $admin_details['hotel_id'];

                                               $room_no = $this->FrontofficeModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                               if($room_no)
                                               {
                                                   foreach ($room_no as $rn) 
                                                   {
                                                       $wh2 = '(room_no = "'.$rn['room_no'].'" AND room_status = 1 AND hotel_id = "'.$admin_id.'")';

                                                       $room_status2 = $this->FrontofficeModel->getData('room_status',$wh2);

                                                       if($room_status2)
                                                       {
                                           ?>      
                                                       <div class="room_card card" style="background:#35c0f0">
                                                            <span class="room_no d-flex justify-content-center align-items-center" style="height:38px; width:42px; "><?php echo $room_status2['room_no']?></span>
                                                       </div>

                                                     
                                           <?php
                                                       }
                                                   }
                                               }
                                               else
                                               {
                                                   echo "Room Not Availble";
                                               }
                                           ?>
                                           </div>
                                       </td>
                                       <td>
                                       <div  class="px-1" style="display:flex;flex-wrap: wrap;justify-content: center;">

                                           <?php
                                               // $admin_id = $this->session->userdata('admin_id');
                                               $u_id = $this->session->userdata('u_id');
                                               $where ='(u_id = "'.$u_id.'")';
                                               $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                               
                                               $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                               $get_hotel_name = $this->FrontofficeModel->getData($tbl ='register', $wh);
                                               
                                                   $admin_id = $admin_details['hotel_id'];

                                               $room_no = $this->FrontofficeModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                               if($room_no)
                                               {
                                                   foreach ($room_no as $rn) 
                                                   {
                                                       $wh3 = '(room_no = "'.$rn['room_no'].'" AND room_status = 4 AND hotel_id = "'.$admin_id.'")';

                                                       $room_status3 = $this->FrontofficeModel->getData('room_status',$wh3);

                                                       if($room_status3)
                                                       {
                                           ?>      
                                                       <div class="room_card card" style="background:#ec1c24">
                                                            <span class="room_no d-flex justify-content-center align-items-center" style="height:38px; width:42px; "><?php echo $room_status3['room_no']?></span>
                                                       </div>
                                                       
                                           <?php
                                                       }
                                                   }
                                               }
                                               else
                                               {
                                                   echo "Room Not Availble";
                                               }
                                           ?>
                                           </div>
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
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="facility_name" class="form-control" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
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


<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
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

     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_facility') ?>',
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