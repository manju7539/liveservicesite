<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Guest Arrival</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Guest Arrival</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Guest Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Guest Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>Todays Arrival</header>
                  <div class="tools">
                     <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                     <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                     <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
               </div>
               <div class="card-body ">
                  <div class="row mb-3 ">
                  <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Today's Arrival</a>
                                    </li>
                                    <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Upcoming Arrival</a>
                                    </li>
                                    
                                </ul>
                            </header>
                            </div>
</div>
                     <div class="col-md-4">
                        <form method="POST">
                           <div class="input-group">
                              <input type="text" class="form-control wide" name ="check_in"
                                 placeholder="Check-in Date" onfocus="(this.type = 'date')"
                                 id="date">
                              <button class="btn btn-info  btn-sm " type="submit"><i class="fa fa-search"></i></button>
                           </div>
                        </form>
                     </div>
                     <!-- <div class="col-md-4">
                        <select class="form-control" id="categoryDropdown"> -->
                           <!-- <option value="#">Select Option</option> -->
                           <!-- <option value="0"><a href="#" style="color:white;">Todays Arrival</a></option> -->
                           <!-- <option value="#"><a href="#" style="color:white;">Departed Arrival</a></option> -->
                           <!-- <option value="1"><a href="#" style="color:white;">Upcoming Arrival</a></option>
                        </select> -->
                     <!-- </div> -->
                     <div class="tab-content">
                                
         
                     <div class="col-md-12 d-flex justify-content-end ">
                        <button id="addRow1" class="btn btn-info add_facility">
                        Add Walking Guest 
                        </button>
                     </div>
                
              
                          <!-- accept -->
                          <div class="tab-pane" style="background-color:white;" id="arrival2_div"> 
                            <div class="row">
                                <div class="table-scrollable">
                                    <table id="arrival_tbl" class="display full-width">
                                        <thead>
                                        <tr>
                                             <th>Sr.No.</th>
                                             <th>Name</th>
                                             <th>Date(C_In)</th>
                                             <th>Date(C_Out)</th>
                                             <th>Phone</th>
                                             <th>Email</th>
                                             <th>Rooms</th>
                                             <th>Adult</th>
                                             <th>Child</th>
                                             <!-- <th>Assign Room</th> -->
                                          </tr>
                                        </thead>
                                        <tbody class="data">
                                        <?php
                                                
                                                $j = 1;
                                                if($today_hotel_book_list_by_app1)
                                                {
                                                    foreach($today_hotel_book_list_by_app1 as $t_h_b)
                                                    {
                                                        $user_data = $this->FrontofficeModel->get_admin_data($t_h_b['u_id']);
                                                        //  print_r( $user_data);
                                                        $full_name = "";
                                                        $mobile_no = "";

                                                        if($user_data)
                                                        {
                                                            $full_name = $user_data['full_name'];
                                                            $mobile_no = $user_data['mobile_no'];
                                                            $email_id = $user_data['email_id'];
                                            ?>

                                            <tr>
                                                <td>
                                                    <?php echo $j++?>
                                                </td>
                                                <td>
                                                    <?php echo $full_name ?>
                                                </td>
                                                <td>
                                                    <?php echo $t_h_b['check_in'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $t_h_b['check_out'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $mobile_no ?>
                                                </td>
                                                <td>
                                                    <?php echo $email_id ?>
                                                </td>
                                                <td>
                                                    <?php echo $t_h_b['no_of_rooms'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $t_h_b['total_adults'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $t_h_b['total_child'] ?>
                                                </td>

                                             
                                                <!-- Modal -->
                                                <div class="modal fade bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Room Allocation</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('MainController/assign_rooms')?>" method="post">
                                                                            <input type="hidden" name="booking_id" value="<?php echo $t_h_b['booking_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="basic-form">
                                                                                    <div class="col-xl-12">
                                                                                        <h4>Available Rooms</h4>
                                                                                        <div class="row row-cols-8 ">
                                                                                            <?php
                                                                                            
                                                                                                // $admin_id = $this->session->userdata('admin_id');
                                                                                                $u_id = $this->session->userdata('u_id');
                                                                                                // print_r($u_id);exit;			
                                                                                                $where ='(u_id = "'.$u_id.'")';
                                                                                               $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                                                              
                                                                                               $hotel_enquiry_request_id = '';
                                                                                               $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                                                                               $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                                                                              
                                                                                                  $admin_id = $admin_details['hotel_id'];

                                                                         $room_no_data = $this->MainModel->get_room_nos($admin_id,$t_h_b['room_type']);
                                                                        
                                                                                                if($t_h_b['no_of_rooms'] == 1)
                                                                                                {
                                                                                                    if($room_no_data)
                                                                                                    {   
                                                                                                      //print_r($room_no_data);
                                                                                                        foreach($room_no_data as $r_no)
                                                                                                        {
                                                                             $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                             $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                                                             // print_r($room_avaibility);

                                                                                                            if($room_avaibility)
                                                                                                            {                                                                              

                                                                                            ?>
                                                                                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                                data-bs-target=".add" class="green">
                                                                                                                <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no']?>">
                                                                                                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                                <input name="price" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                                <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                                            </div>
                                                                                            <?php
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        echo "Rooms not available";
                                                                                                    }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    if($t_h_b['no_of_rooms'] >= 2)
                                                                                                    {
                                                                                                        if($room_no_data)
                                                                                                        {   
                                                                                                            foreach($room_no_data as $r_no)
                                                                                                            {
                                                                                                                $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                                                                $room_avaibility = $this->MainModel->getData('room_status',$wh_r);

                                                                                                                if($room_avaibility)
                                                                                                                {                                                                              

                                                                                            ?>
                                                                                                                <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                                    data-bs-target=".add" class="green">
                                                                                                                    <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no']?>">
                                                                                                                    <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                                    <input name="price1[]" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                                    <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                                                </div>
                                                                                                <?php
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            echo "Rooms not available";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>                      
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary css_btn">Check-in</button>
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                            </tr>
                                        
                                            <?php
                                                        }
                                                    }
                                                }
                                              ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<!-- </div> -->

                        <!-- endaccept   -->
                        <div class="tab-pane active" id="arrival1_div"  style="background-color:white;">  
               
                           <div class="row">
                              <div class="table-scrollable">
                                 <table id="example1" class="display full-width">
                                    <thead>
                                       <tr>
                                          <th>Sr.No.</th>
                                          <th>Name</th>
                                          <th>Date(C_In)</th>
                                          <th>Date(C_Out)</th>
                                          <th>Phone</th>
                                          <th>Email</th>
                                          <th>Rooms</th>
                                          <th>Adult</th>
                                          <th>Child</th>
                                          <th>Assign Room</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $j = 1;
                                          if($today_hotel_book_list_by_app)
                                          {
                                             foreach($today_hotel_book_list_by_app as $t_h_b)
                                             {
                                                $user_data = $this->FrontofficeModel->get_admin_data($t_h_b['u_id']);
                                                //  print_r( $user_data);
                                                $full_name = "";
                                                $mobile_no = "";
                                          
                                                if($user_data)
                                                {
                                                      $full_name = $user_data['full_name'];
                                                      $mobile_no = $user_data['mobile_no'];
                                                      $email_id = $user_data['email_id'];
                                          ?>
                                       <tr>
                                          <td>
                                             <?php echo $j++?>
                                          </td>
                                          <td>
                                             <?php echo $full_name ?>
                                          </td>
                                          <td>
                                             <?php echo $t_h_b['check_in'] ?>
                                          </td>
                                          <td>
                                             <?php echo $t_h_b['check_out'] ?>
                                          </td>
                                          <td>
                                             <?php echo $mobile_no ?>
                                          </td>
                                          <td>
                                             <?php echo $email_id ?>
                                          </td>
                                          <td>
                                             <?php echo $t_h_b['no_of_rooms'] ?>
                                          </td>
                                          <td>
                                             <?php echo $t_h_b['total_adults'] ?>
                                          </td>
                                          <td>
                                             <?php echo $t_h_b['total_child'] ?>
                                          </td>
                                          <td>
                                             <button style="margin:auto" data-bs-toggle="modal"
                                                data-bs-target=".bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>"
                                                class="btn btn-success shadow btn-xs sharp "><i
                                                class="fa fa-check"></i></button>
                                          </td>
                                          <!-- Modal -->
                                          <div class="modal fade bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                             <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title">Room Allocation</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                      </button>
                                                   </div>
                                                   <form action="<?php echo base_url('FrontofficeController/assign_rooms')?>" method="post">
                                                      <input type="hidden" name="booking_id" value="<?php echo $t_h_b['booking_id'] ?>">
                                                      <div class="modal-body">
                                                         <div class="basic-form">
                                                            <div class="col-xl-12">
                                                               <h4>Available Rooms</h4>
                                                               <div class="row row-cols-8 ">
                                                                  <?php
                                                                     // $admin_id = $this->session->userdata('admin_id');
                                                                     $u_id = $this->session->userdata('u_id');	
                                                                     
                                                                     $where ='(u_id = "'.$u_id.'")';
                                                                     $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                                     
                                                                     $hotel_enquiry_request_id = '';
                                                                     $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                                                     $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                                                        
                                                                        $admin_id = $admin_details['hotel_id'];
                                                                        
                                                                     $room_no_data = $this->FrontofficeModel->get_room_nos($admin_id,$t_h_b['room_type']);
                                                                     // print_r($room_no_data);exit;
                                                                     if($t_h_b['no_of_rooms'] == 1)
                                                                     {
                                                                        if($room_no_data)
                                                                        {   
                                                                           //   print_r($room_no_data);
                                                                           foreach($room_no_data as $r_no)
                                                                           {
                                                                     $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';
                                                                     
                                                                     $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                                                     // print_r($room_avaibility);
                                                                     
                                                                                 if($room_avaibility)
                                                                                 {                                                                              
                                                                     
                                                                     ?>
                                                                  <div class="room_card card  p-0" data-bs-target=".add" class="green">
                                                                     <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no']?>">
                                                                     <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                     <input name="price" value="<?php echo $r_no['price']?>" type="hidden">
                                                                     <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                  </div>
                                                                  <?php
                                                                     }
                                                                     }
                                                                     }
                                                                     else
                                                                     {
                                                                     echo "Rooms not available";
                                                                     }
                                                                     }
                                                                     else
                                                                     {
                                                                     if($t_h_b['no_of_rooms'] >= 2)
                                                                     {
                                                                     if($room_no_data)
                                                                     {   
                                                                     foreach($room_no_data as $r_no)
                                                                     {
                                                                        $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';
                                                                     
                                                                        $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                                                     
                                                                        if($room_avaibility)
                                                                        {                                                                              
                                                                     
                                                                     ?>
                                                                  <div class="room_card card  p-0"
                                                                     data-bs-target=".add" class="green">
                                                                     <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no']?>">
                                                                     <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                     <input name="price1[]" value="<?php echo $r_no['price']?>" type="hidden">
                                                                     <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                  </div>
                                                                  <?php
                                                                     }
                                                                     }
                                                                     }
                                                                     else
                                                                     {
                                                                     echo "Rooms not available";
                                                                     }
                                                                     }
                                                                     }
                                                                     ?>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                         <button type="submit" class="btn btn-primary css_btn">Check-in</button>
                                                         <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </tr>
                                       <?php
                                          }
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
</div>
                                       </div>
<?php
   if ($list) 
   {
       // $admin_id = $this->session->userdata('admin_id');
       $u_id= $this->session->userdata('u_id');
   			$where ='(u_id = "'.$u_id.'")';
   			$admin_details = $this->MainModel->getData($tbl ='register', $where);
   			
   			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
   			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
   			$admin_id = $admin_details['hotel_id'];
   			$u_id11 = $admin_details['u_id'];
   
       foreach ($list as $gl) 
       {
           $user_booking_details = $this->FrontofficeModel->get_booking_room_details($gl['booking_id']);
           
   ?>
<div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInDown animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Room Related Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="row mt-4">
               <div class="col-xl-12">
                  <div class="table-responsive">
                     <table class="table table-responsive-sm">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <th>Room Type</th>
                              <th>Room No</th>
                              <th>Price</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $j = 1;
                              if ($user_booking_details) 
                              {
                                  foreach ($user_booking_details as $u_bd) 
                                  {
                              ?>
                           <tr>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap">
                                       <?php echo $u_bd['room_type_name'] ?>
                                    </h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                                 </div>
                              </td>
                              <td>
                                 <div>
                                    <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
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
            <div class="modal-footer">
               <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
<!--/. requirement modal -->
<!-- modal for extend room -->
<?php
   if ($list) 
   {
       // $admin_id = $this->session->userdata('front_id');
       $u_id= $this->session->userdata('u_id');
   			$where ='(u_id = "'.$u_id.'")';
   			$admin_details = $this->MainModel->getData($tbl ='register', $where);
   			
   			$wh = '(u_id ="'.$admin_details['hotel_id'].'")';
   			$get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
   			$admin_id = $admin_details['hotel_id'];
   			$u_id11 = $admin_details['u_id'];
   
       foreach ($list as $gl) 
       {
   
   ?>
<div class="modal fade bd-room-modal-sm_<?php echo $gl['booking_id'] ?>" tabindex="-1" aria-modal="true" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Extend Room</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form action="<?php echo base_url('CheckOutController/extend_checkout_data') ?>" method="post">
            <input type="hidden" name="booking_id" value="<?php echo $gl['booking_id'] ?>">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Guest Name :</label>
                        <span><?php //echo $gl['full_name'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Adults :</label>
                        <span> <?php echo $gl['total_adults'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Kids :</label>
                        <span> <?php echo $gl['total_child'] ?></span>
                     </div>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Check in :</label>
                        <span> <?php echo $gl['check_in'] ?></span>
                     </div>
                     <?php
                        $user_booking_details = $this->FrontofficeModel->get_booking_room_details($gl['booking_id']);
                        
                        if ($user_booking_details) 
                        {
                            foreach ($user_booking_details as $u_bd) 
                            {
                        ?>
                     <input type="hidden" name="booking_details_id[]" value="<?php echo $u_bd['booking_details_id'] ?>">
                     <div class="mb-3 col-md-6">
                        <label class="form-label"> Room Type</label>
                        <select class="form-control" name="room_type[]" id="room_type">
                           <option>Choose Room type...</option>
                           <?php
                              if ($room_type) 
                              {
                                  foreach ($room_type as $rm_t) 
                                  {
                              ?>
                           <option <?php if ($rm_t['room_type_id'] == $u_bd['room_type']) { echo "Selected";} ?> value="<?php echo $rm_t['room_type_id'] ?>"><?php echo $rm_t['room_type_name'] ?></option>
                           <?php
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Room No</label>
                        <select class="form-control" name="room_no[]" id="room_no">
                           <option>Choose Room No...</option>
                           <?php
                              if ($availble_rooms) 
                              {
                                  foreach ($availble_rooms as $rn) 
                                  {
                              ?>
                           <option <?php if ($rn['room_no'] == $u_bd['room_no']) { echo "Selected"; } ?> value="<?php echo $rn['room_no'] ?>"><?php echo $rn['room_no'] ?></option>
                           <?php
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <?php
                        }
                        }
                        ?>
                     <div class=" mb-3 col-md-6">
                        <label class="form-label">Check out</label>
                        <input type="date" class="form-control" name="check_out" required>
                     </div>
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
<?php
   }
   }
   ?>
<!-- add btn modal  -->
<div class="modal bd-add-modal add_facility_modal" style="display:none !important">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Walking Guests</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Guest Name</label>
                           <input type="text" class="form-control" name="full_name" placeholder="Guest Name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Mobile No</label>
                           <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="mobile_no" placeholder="Mobile No" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Check In</label>
                           <div class="input-group">
                              <input type="date"   class="form-control minDate" name="check_in" placeholder="Date" required>
                              <input type="time" class="form-control minDate" name="check_in_time" placeholder="time" required>
                           </div>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Check Out</label>
                           <div class="input-group">
                              <input type="date" class="form-control" name="check_out" placeholder="Date" required>
                              <input type="time" class="form-control" name="check_out_time" placeholder="Time" required>
                           </div>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Id Proof</label>
                           <input type="file" name="id_proff_img" class="form-control" placeholder="" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Adults</label>
                           <input type="number" name="total_adults" id="adult" onkeyup="add_amt()" class="form-control" placeholder="Adults" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Childs</label>
                           <input type="number" name="total_child" id="child" onkeyup="add_amt()"  class="form-control" placeholder="Childs" required>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">No.of Guest</label>
                           <input type="number" name="no_of_guests" id="guest"  class="form-control" placeholder="No. of Guest " required>
                        </div>
                        <div class=" mb-3 col-md-6 form-group">
                           <label class="form-label">Guest Type</label>
                           <select name="guest_type" id="" class="default-select form-control wide">
                              <option selected="" disabled=""> Choose...</option>
                              <option value="1">Regular</option>
                              <option value="2">Complete House Guest</option>
                              <option value="3">Very Important Person</option>
                              <option value="4">WHG</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label class="form-label ">No Of Rooms</label>
                           <input type="number" style="background: white;"  name="no_of_rooms" value="1" class="form-control" placeholder="No.of Rooms" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label"> Room Type</label>
                           <div class="input-group ">
                              <select class="default-select form-control wide " name="room_type" id="room_type_11">
                                 <option>Choose Room type...</option>
                                 <?php
                                    $room_type_list_string="";
                                    
                                    if($room_type_list)
                                    {  
                                        $room_type_list_string = json_encode($room_type_list);
                                    
                                        foreach($room_type_list as $r_t)
                                        {
                                    ?>
                                 <option value="<?php echo $r_t['room_type_id']?>"><?php echo $r_t['room_type_name']?></option>
                                 <?php
                                    }
                                    }
                                    ?>
                              </select>
                              <a class="btn btn-primary btn-sm" id="btnAdd2"><i
                                 class="fa fa-plus"></i></a>
                           </div>
                        </div>
                        <!-- <div id="TextBoxContainer2" class="mb-3"></div> -->
                        <div class="mb-3 col-md-12">
                           <label class="form-label"> Assign Room</label>
                           <div class="accordion accordion-rounded-stylish accordion-bordered"
                              id="accordion-eleven">
                              <div class="row">
                                 <div class="col-xl-12">
                                    <div class="col-xl-12">
                                       <!-- <h4>Available Rooms</h4> -->
                                       <div class="row row-cols-8 ">
                                          <div   style="display:flex;" id="display_rooms_no"></div>
                                          <!-- <div class="room_no_card card  p-0" 
                                             data-bs-target=".add" class="green">
                                             <input name="plan" class="radio" type="radio"
                                                 value="Green" name="clr">
                                             <span
                                                 class="room_no m-0 room_no_card  red colored-div">101</span>
                                             </div> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="TextBoxContainer2" class="mb-3"></div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary css_btn" >Check-in</button>
            </div>
         </form>
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
<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- script for hide show  -->
<script>
   $(document).ready(function() {
   $('.amt_ch input[type="radio"]').click(function() {
   var inputValue = $(this).attr("value");
   console.log(inputValue);
   if (inputValue == "App") {
   $("#App_Ord").show();
   $("#Walkin_Ord").hide();
   
   } else {
   $("#Walkin_Ord").show();
   $("#App_Ord").hide();
   }
   
   });
   // $('input[type="radio"]').click(function() {
   //     var inputValue = $(this).attr("value");
   //     var targetBox = $("." + inputValue);
   //     $(".walkin_guest").not(targetBox).hide();
   //     $(targetBox).show();
   // });
   });
</script>
<!-- click on plus button -->
<script>
   var appId = 1;
   $(function() {
   $("#btnAdd2").bind("click", function() { 
   var div = $("<div class=''/>");
   div.html(GetDynamicTextBox1(""));
   $("#TextBoxContainer2").append(div);
   appId++;
   });
   $("body").on("click", "#DeleteRow", function() {
   $(this).parents("#row").remove();
   })
   });
   
   
   function GetDynamicTextBox1(value) {
   
   var room_data = '<?php echo $room_type_list_string;?>';
   const obj = JSON.parse(room_data, true);
   var arr_length = obj.length;
   var rs_arr = [];
   
   for (var i = 0; i < arr_length; i++) {
   rs_arr.push('<option value="' + obj[i]['room_type_id'] + '">' + obj[i]['room_type_name'] + '</option>');
   
   }
   
   
   return '<div id="row" class="row">' +
   '<div class="mb-3 col-md-4">' +
   '<label class="form-label"> No.of Rooms</label>' +
   '<input type="number" name="no_of_rooms1[]" value="1" class="form-control" placeholder="No.of Rooms " readonly />' +
   '</div>' +
   '<div class="mb-3 col-md-4">' +
   '<label class="form-label"> Room Type</label>' +
   '<select class="default-select form-control wide" id="sel_' + appId +
   '" name="room_type1[]" onchange="get_room_no(this)" required="">' +
   '<option value="">---Choose  Room type.--</option>' +
   rs_arr +
   '</select>' +
   '</div>' +
   
   
   '<div class="mb-3 col-md-4">' +
   '<label class="form-label"> Room Charges</label>' +
   '<div class="input-group ">' +
   '<input type="number" name="room_charges" id="price_" class="form-control" placeholder="" required="">' +
   
   
   '<a type="button" value="Remove" id="DeleteRow" class="remove btn btn-danger btn-sm"><i class="fa fa-times"></i></a>' +
   '</div>' +
   '</div>' +
   '<div class="row">' +
   '<div class="mb-3 col-md-12">' +
   '<label class="form-label"> Assign Room</label>' +
   '<div class="accordion accordion-rounded-stylish accordion-bordered" id="accordion-eleven">' +
   '<div class="row">' +
   '<div class="col-xl-12">' +
   '<div class="col-xl-12">' +
   '<div class="row row-cols-8 ">' +
   '<div style="display:flex;" id="display_rooms_no_sel_' + appId + '"></div>' +
   // php code data fetch here
   '</div>' +
   '</div>' +
   '</div>' +
   
   '</div>' +
   
   '</div>' +
   '</div>' +
   '</div>' +
   '</div>' +
   '</div>'
   }
   
   

</script>
<!-- default -->
<script>
   
   function initResultDataTable(){
    $('#acceptedOrder_tb').DataTable({
                        retrieve: true,
                        // paging: false,
                        "order": [],
                        "columnDefs": [ {
                        "targets"  : 'no-sort',
                        "orderable": false,
                        }]
                });
}

    $(document).ready(function() {
  

      //   $('#newOrder_tb').DataTable();
      //   $('#acceptedOrder_tb').DataTable({
         // $('#acceptedOrder_tb').DataTable().clear().draw();
   //  aaData: response.data
      //   });
      //   $('#rejectedOrder_tb').DataTable();
      //   $('#completedOrder_tb').DataTable();
    } );
 var selectedOrderserviceurl = '';
        var base_url = '<?php echo base_url();?>';
    $('#categoryDropdown').change(function () {
        var selected_orderservice = $(this).val();
      //   alert(selected_orderservice);
        if(selected_orderservice == 0)
        {
            selectedOrderserviceurl = 'todayfrontArrival';
            $('.page_header_title').text('All New Orders ');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 1)
        {
            selectedOrderserviceurl = 'upcomingfrontaArrival';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
      //   if(selected_orderservice == 2)
      //   {
      //       selectedOrderserviceurl = 'rejectenquiryRequest';
      //       $('.page_header_title').text('All Rejected orders ');
      //       $('.rejected_orders_div').css('display','block');
      //       $('.new_orders_div').css('display','none');
      //       $('.accepted_orders_div').css('display','none');
      //       $('.completed_orders_div').css('display','none');
      //   }
        
        // var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+'FrontofficeController/'+selectedOrderserviceurl,
            success: function (response) {
                $('.data').html(response);
                initResultDataTable();
                table.clear().draw();
            }
        });
    });
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
   //     console.log(form_data);
   //     return false;
   //     $.ajax({
   //         url         : '<?= base_url('FrontofficeController/add_walking') ?>',
   //         method      : 'POST',
   //         data        : form_data,
   //         //processData : false,
   //         //contentType : false,
   //         //cache       : false,
   //         success     : function(res) {
   //             setTimeout(function(){  
   //              $(".loader_block").hide();
   //             //  $(".add_facility_modal").modal('hide');
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
           url         : '<?= base_url('FrontofficeController/add_walking') ?>',
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
<!-- default end -->
<script>
   
   
   $('#room_type_11').change(function() {
   
       var base_url = '<?php echo base_url()?>';
       var room_type = $('#room_type_11').val();
   
      //  alert(room_type);
   
       if (room_type != '') {
       $.ajax({
       url: base_url + "FrontofficeController/get_room_nos",
       method: "POST",
       data: {
           room_type: room_type
       },
       success: function(data) {
           //alert(data);
           $('#display_rooms_no').html(data);
       }
   
       });
   
       }
       });
       var base_url = '<?php echo base_url();?>';

$('#room_type_11').change(function() 
{
    //debugger;
var srvice_type = $('#room_type_11').val();
//alert(menu_n);
if (srvice_type != '')
{

        $.ajax({
            
            url: base_url + "FrontofficeController/get_room_charge",
            method: "POST",
            data: {
                srvice_type: srvice_type
            },
            success: function(data)
            {
            //alert(data);
            $('#price').val(data);
            }
        });
}
});
</script>
<script>
   function get_room_no(idd) {
   var room_type = idd.value;
   var sel_id = idd.id;
   console.log("sel", sel_id)
   // debugger;
   var base_url = '<?php echo base_url();?>';
   // var room_type = id;
   // var display_rooms_no1 = "#display_rooms_no1_"+id;
   
   // alert(display_rooms_no1);
   
   if (room_type != '') {
   $.ajax({
   url: base_url + "FrontofficeController/get_room_nos1",
   method: "POST",
   data: {
   room_type: room_type
   },
   success: function(data) {
   //alert(data);
   $('#display_rooms_no_' + sel_id).html(data);
   }
   
   })
   $.ajax({
   url: base_url + "FrontofficeController/get_room_charge1",
   method: "POST",
   data: {
   room_type: room_type
   },
   success: function(data) {
   //alert(data);
   $('#price_' + sel_id).val(data);
   }
   
   });
   
   }
   }
</script>
<!-- add amount -->
<script>
   function add_amt()
   {
   var base_url = '<?php echo base_url()?>';
   var adult = $('#adult').val();
   var child = $('#child').val();
   // var guest = $('#guest').val();
   // alert(adult);
   $.ajax({
       url : base_url + "FrontofficeController/add_guest_count",
       method : "post",
       data : {adult : adult,child : child},
       success :function(data)
               {
                   $('#guest').val(data)
               }
   });
   }
</script>
    <script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#arrival_tbl').DataTable();
    } );
 
    $('#orderserviceArrival').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'arrival1')
        {
            $('.arrival1_div').css('display','block');
            $('.arrival2_div').css('display','none');
           
        }
        if(selected_orderservice == 'arrival2')
        {
            $('.arrival2_div').css('display','block');
            $('.arrival1_div').css('display','none');
           
        }
    });

</script> 
<script>
    $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); 
                if (tabId === '#arrival1_div') {
                    $('.arrival11').text('Todays Arrival');
                } else if (tabId === '#arrival2_div') {
                    $('.arrival11').text('Upcoming Arrival');
                } 

                // $('.headingtitle').text(title);
            });
        });
    </script>
</body>
</html>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#arrival_tbl').DataTable();
    } );
 
   </script>