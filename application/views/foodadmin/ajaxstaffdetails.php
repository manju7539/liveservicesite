<style>
   /* .datatable{
   padding-right:0px;
   } */
</style>
<!-- start page content -->
<!-- <div class="page-content-wrapper"> -->
<!-- <div class="page-content"> -->
<div class="page-bar" style="margin: 0px;">
   <!-- <div class="page-title-breadcrumb"> -->
   <div class=" pull-left">
      <div class="page-title">Staff management</div>
   </div>
   <ol class="breadcrumb page-breadcrumb pull-right">
      <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
         href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
      </li>
      <li><a class="parent-item" href="<?php echo base_url('foodstaffManage')?>">Staff</a>&nbsp;<i
         class="fa fa-angle-right"></i>
      </li>
      <li class="active">Staff History</li>
   </ol>
   <!-- </div> -->
</div>
<div class="row">
   <div class="col-lg-12 " >
      <div class="card-body">
         <?php 
            // $u_id = $this->uri->segment(3);
            // $wh = '(u_id = "'.$u_id.'")';
            // $get_staff_details = $this->MainModel->getData('register',$wh);
            if(!empty($get_staff_details))
            {
                $full_name = $get_staff_details['full_name'];
                $u_id = $get_staff_details['u_id'];
                $mobile_no = $get_staff_details['mobile_no'];
                $email_id = $get_staff_details['email_id'];
                $address = $get_staff_details['address'];           
                $register_date = date('d-m-Y',strtotime($get_staff_details['register_date']));
                //$profile = $get_staff_details['profile_photo']; 
            }
            else
            {
                $full_name = '';
                $u_id = '';
                $mobile_no = '';
                $email_id = '';
                $address = '';
                $register_date = ''; 
                
            }
            
             //for image                                                    
            if(!empty($get_staff_details['profile_photo']))
            {
                $profile = $get_staff_details['profile_photo'];
                
            }
            else
            {
            
                $profile = base_url()."assets/dist/profie/profile_photo.png"; 
            }      
            ?>
         <div class="row">
            <div class="col-lg-4">
               <div class="card">
                  <div class="card-body">
                     <div class="guest-profile">
                        <img src="<?php echo $profile?>"
                           class="rounded-circle"
                           style="margin-left: 110px;width: 150px;height:152px">
                        <h4 class="font-w600 text-center"><?php echo $full_name?>
                        </h4>
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
                              <h6 class="mb-0"><?php echo  $full_name?>
                              </h6>
                           </div>
                        </div>
                     </div>
                     <div class="mt-4 ms-3">
                        <div class="row">
                           <div class="col-lg-3">
                              <h6 class="mb-0">User
                                 ID
                              </h6>
                           </div>
                           <div class="col-lg-1">
                              <h6 class="mb-0">:-
                              </h6>
                           </div>
                           <div class="col-lg-8">
                              <h6 class="mb-0"><?php echo  $u_id?>
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
                              <h6 class="mb-0"><?php echo  $mobile_no?>
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
                              <h6 class="mb-0"><?php echo  $email_id?>
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
                              <h6 class="mb-0"><?php echo  $address?>
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
                              <h6 class="mb-0"><?php echo  $register_date?>
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
<div class="row">
   <div class="col-md-12" style="padding-right: 0px;">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header>Total Orders</header>
         </div>
         <div class="card-body ">
            <!--  <div class="btn-group r-btn">
               <button id="addRow1" class="btn btn-info">
                   Add Facility <i class="fa fa-plus"></i>
               </button>
               </div> -->
            <div class="table-scrollable">
               <table id="staff_view_table" class="display full-width">
                  <thead>
                     <tr>
                        <th>Sr.No.</th>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Room no</th>
                        <th>Customer Name</th>
                        <th>Order Amount</th>
                        <th>Order Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php 
                        if(!empty($complete_list))
                        {
                            $i=1;
                            foreach($complete_list as $u_c_order)
                            {
                       
                                //get customer name
                                $wh_c_name = '(u_id ="'.$u_c_order['u_id'].'")';
                                $get_customer_name = $this->MainModel->getData('register',$wh_c_name);
                                if(!empty($get_customer_name))
                                {
                                    $customer_name = $get_customer_name['full_name'];
                                }
                                else
                                {
                                    $customer_name = '';
                                }

                                $wh_room = '(booking_id ="'.$u_c_order['booking_id'].'")';
                              //   get room no
                                $room_info = $this->MainModel->getData('user_hotel_booking_details',$wh_room);
                                if(!empty($room_info))
                                {
                                    $room_no = $room_info['room_no'];
                                }
                                else
                                {
                                    $room_no = '';
                                }
                        
                                //get order price
                                $wh_price = '(food_order_id ="'.$u_c_order['food_order_id'].'")';
                                $get_order_price = $this->MainModel->getData('food_order_details',$wh_price);
                                if(!empty($get_order_price))
                                {
                                    $o_price = $get_order_price['price'];
                                }
                                else
                                {
                                    $o_price = 0;
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
                              <h5 class="text-nowrap"><?php echo $u_c_order['food_order_id']?></h5>
                           </div>
                        </td>
                        <td>
                           <div>
                              <h5 class="text-nowrap"><?php echo date('d-m-Y', strtotime($u_c_order['complete_date']));?></h5>
                           </div>
                        </td>
                        <td>
                           <div>
                              <h5 class="text-nowrap"><?php echo $room_no; ?></h5>
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
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
          $('#staff_view_table').DataTable();
      } );
</script>