<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-6 ">
            <h4>Staff history</h4>
         </div>
         <div class="col-6">
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li><a class="parent-item" href="<?php echo base_url('Staff_mang')?>">Staff</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li class="active">Staff history</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="card-body">
               <?php 
                  if(!empty($staff_data))
                  {
                      $full_name = $staff_data['full_name'];
                      $u_id = $staff_data['u_id'];
                      $mobile_no = $staff_data['mobile_no'];
                      $email_id = $staff_data['email_id'];
                      $address = $staff_data['address'];
                      $register_date = date('F d, Y',strtotime($staff_data['register_date']));
                      
                  }
                  else
                  {
                      $full_name = "";
                      $u_id = "";
                      $mobile_no = "";
                      $email_id = "";
                      $address = "";
                      $register_date = "";
                  }
                  
                  //for image													
                  if(!empty($staff_data['profile_photo']))
                  {
                      //$img = base_url().$list['profile_photo'];
                       $img = $staff_data['profile_photo'];
                      
                  }
                  else
                  {
                  
                      $img = base_url()."assets/upload/staff_profile/mango.png";
                  }                                                         
                  
                  ?>
               <div class="row">
                  <div class="col-lg-4">
                     <div class="card">
                        <div class="card-body">
                           <div class="guest-profile">
                              <img src="<?php echo $img?>"
                                 class="rounded-circle"
                                 style="margin-left: 70px;width: 150px;height:152px">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8">
                     <div class="card">
                        <div class="card-body">
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Name
                                    </h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0">
                                       <?php echo $full_name;?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Employee ID
                                    </h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0"><?php echo $u_id;?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Mobile
                                       No.
                                    </h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0"><?php echo $mobile_no?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Email</h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0"><?php echo $email_id?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Joining
                                       Date
                                    </h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0"><?php echo $register_date?>
                                    </h6>
                                 </div>
                              </div>
                           </div>
                           <div class="mt-4 ms-3">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <h6 class="mb-0">Address</h6>
                                 </div>
                                 <div class="col-lg-1">
                                    <h6 class="mb-0">:-
                                    </h6>
                                 </div>
                                 <div class="col-lg-8">
                                    <h6 class="mb-0"><?php echo $address?>
                                    </h6>
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
         $u_id = $this->uri->segment(2);
         ?>
      <div class="row">
         <div class="col-lg-12">
            <header class="panel-heading panel-heading-gray custom-tab ">
               <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#house_staff_deatils_div" data-bs-toggle="tab" class="active">Menu Orders</a>
                  </li>
                  <li class="nav-item"><a href="#house_service_deatils_div" data-bs-toggle="tab">Laundry Orders</a>
                  </li>
               </ul>
            </header>
         </div>
      </div>
      <div class="row mt-3">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="m-auto">Total Orders</h3>
               </div>
               <div class="tab-content">
                  <div class="tab-pane active" id="house_staff_deatils_div">
                     <div class="table-scrollable">
                        <table id="house_staff_details" class="display full-width">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th>Order Id</th>
                                 <th>Date</th>
                                 <th>Room no</th>
                                 <th>Customer Name</th>
                                 <th>Order Amount</th>
                                 <th>Order Status</th>
                                 <!-- <th>Rating</th> -->
                              </tr>
                           </thead>
                           <tbody class="append_data">
                              <?php 
                                 if(!empty($user_complete_orders))
                                 {
                                     $i=1;
                                     foreach($user_complete_orders as $u_c_order)
                                     {
                                 
                                         //get customer name
                                         $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                         $get_customer_name = $this->HouseKeepingModel->getData('register',$wh_c_name);
                                         if(!empty($get_customer_name))
                                         {
                                             $customer_name = $get_customer_name['full_name'];
                                         }
                                         else
                                         {
                                             $customer_name = '';
                                         }
                                         $wh = '(booking_id = "'.$u_c_order['booking_id'].'")';
                                         $get_room_number = $this->HouseKeepingModel->getData($tbl = 'user_hotel_booking_details', $wh);
                                     //    Print_r($get_room_number);
                                     //    die;
                                         if(!empty($get_room_number))
                                         {
                                             $room_number = $get_room_number['room_no'];
                                         }
                                         else
                                         {
                                             $room_number = '';
                                         }
                                         //get order price
                                         $wh_price = '(h_k_order_id ="'.$u_c_order['h_k_order_id'].'")';
                                         $get_order_price = $this->HouseKeepingModel->getData('house_keeping_orders',$wh_price);
                                         if(!empty($get_order_price))
                                         {
                                             $o_price = $get_order_price['order_total'];
                                         }
                                         else
                                         {
                                             $o_price = '';
                                         }
                                 ?>
                              <tr>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $i;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_c_order['h_k_order_id']?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_c_order['complete_date']?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $room_number;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $customer_name;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $o_price;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <?php 
                                       if($u_c_order['order_status'] == 2)
                                       {
                                       
                                       ?>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-success">
                                             Completed
                                          </div>
                                       </a>
                                    </div>
                                    <?php 
                                       }
                                       ?>
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
                  <div class="tab-pane" id="house_service_deatils_div">
                     <div class="table-scrollable">
                        <table id="house_service_deatils" class="display full-width">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th>Order Id</th>
                                 <th>Date</th>
                                 <th>Room no</th>
                                 <th>Customer Name</th>
                                 <th>Order Amount</th>
                                 <th>Order Status</th>
                                 <!-- <th>Rating</th> -->
                              </tr>
                           </thead>
                           <tbody id="append_data">
                              <?php 
                                 if(!empty($user_laundry_complete_orders))
                                 {
                                     $i=1;
                                     foreach($user_laundry_complete_orders as $u_l_order)
                                     {
                                 
                                         //get customer name
                                         $wh_c_name = '(u_id ="'.$u_l_order['u_id'].'")';
                                         $get_customer_name = $this->HouseKeepingModel->getData('register',$wh_c_name);
                                         if(!empty($get_customer_name))
                                         {
                                             $customer_name = $get_customer_name['full_name'];
                                         }
                                         else
                                         {
                                             $customer_name = '';
                                         }
                                         $wh = '(booking_id = "'.$u_l_order['booking_id'].'")';
                                         $get_room_number = $this->HouseKeepingModel->getData($tbl = 'user_hotel_booking_details', $wh);
                                     //    Print_r($get_room_number);
                                     //    die;
                                         if(!empty($get_room_number))
                                         {
                                             $room_number = $get_room_number['room_no'];
                                         }
                                         else
                                         {
                                             $room_number = '';
                                         }
                                         //get order price
                                         $wh_price = '(cloth_order_id ="'.$u_l_order['cloth_order_id'].'")';
                                         $get_order_price = $this->HouseKeepingModel->getData('cloth_orders',$wh_price);
                                         if(!empty($get_order_price))
                                         {
                                             $o_price = $get_order_price['order_total'];
                                         }
                                         else
                                         {
                                             $o_price = '';
                                         }
                                 ?>
                              <tr>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $i;?> </h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_l_order['cloth_order_id']?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $u_l_order['complete_date']?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $room_number;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $customer_name;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo $o_price;?></h5>
                                    </div>
                                 </td>
                                 <td>
                                    <?php 
                                       if($u_l_order['order_status'] == 2)
                                       {
                                       
                                       ?>
                                    <div>
                                       <a href="#">
                                          <div class="badge badge-success">
                                             Completed
                                          </div>
                                       </a>
                                    </div>
                                    <?php 
                                       }
                                       ?>
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
</div>


<!-- used Tab -->
<script>
   $(document).ready(function() {
    
    $('#house_staff_details').DataTable();
     $('#house_service_deatils').DataTable();
   
         $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';
   
                // Update the title based on the tab ID
                if (tabId === '#house_staff_deatils_div') {
                 
                    } else if (tabId === '#house_service_deatils_div') {
                    $.get( '<?= base_url('Staff_mang');?>', function( data ) {
                    var resu = $(data).find('#house_service_deatils_div').html();
                    $('#house_service_deatils_div').html(resu);
                    setTimeout(function(){
                        $('#house_service_deatils').DataTable();
                    }, );
                });
                  
                } 
   
               
            });
        });
   
     
   
   });
   
   
   
</script>