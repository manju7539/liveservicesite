<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-6">
            <h4>Guest History</h4>
         </div>
         <div class="col-6">
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('dashboard')?>">Home</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li><i class=""></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('guest_panel')?>">Guests</a>&nbsp;<i
                  class="fa fa-angle-right"></i>
               </li>
               <li class="active">Guest_Booking_History</li>
            </ol>
         </div>
      </div>
      <!-- section for guest details  -->
      <div class="row mt-4">
         <div class="col-xl-12">
            <div class="row">
               <div class=" col-md-12 ">
                  <!-- <div class="card">
                     <?php
                        if($user_data['profile_photo'])
                        {
                            $profile_photo = $user_data['profile_photo'];
                        }
                        else
                        {
                            $profile_photo = base_url().'documents/logo16.png';
                        }
                        ?>
                         <div class="card-body"> -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="card">
                           <div class="card=-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                 <img style="margin-top:60px"
                                    class="profile-user-img img-responsive img-circle"
                                    src="<?php echo $profile_photo?>"
                                    alt="Admin" class="rounded-circle" width="150">
                                 <div class="mt-3">
                                    <h4><?php echo $user_data['full_name']?></h4>
                                    <p class="text-secondary mb-1">  <?php
                                       if($user_data['guest_type'] == 0)
                                       {
                                         echo"Regular";
                                       
                                       }
                                       elseif($user_data['guest_type'] == 2)
                                       {
                                           echo "VIP";
                                       }
                                       elseif($user_data['guest_type'] == 3)
                                       {
                                           echo "CHG";
                                       }
                                       elseif($user_data['guest_type'] == 3)
                                       {
                                           echo "WHG";
                                       }
                                       else{
                                           echo"-";
                                       
                                       }
                                       ?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-8 pe-0">
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <h6 class="mb-0">Full Name</h6>
                                       </div>
                                       <div class="col-sm-6 text-secondary" style="white-space: nowrap;">
                                          <?php echo $user_data['full_name']?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <h6 class="mb-0">Email</h6>
                                       </div>
                                       <div class="col-sm-6 text-secondary" style="white-space: nowrap;">
                                          <?php echo $user_data['email_id']?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <h6 class="mb-0">Phone</h6>
                                       </div>
                                       <div class="col-sm-6 text-secondary">
                                          <?php echo $user_data['mobile_no'];?>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            Male
                                        </div>
                                    </div>
                                    </div> -->
                              </div>
                              <hr>
                              <div class="row">
                                 <!-- <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Address</h6>
                                        </div>
                                        <div class="col-sm-6 text-secondary">
                                        <?php echo $user_data['address'];?>
                                        </div>
                                    </div>
                                    </div> -->
                                 <div class="col-md-6">
                                    <?php
                                       // $admin_id = $this->uri->segment(2);
                                       
                                       // $admin_data = $this->MainModel->get_user_dataa($admin_id);
                                       // print_r($admin_data);
                                       if($admin_data['Id_proff_photo'])
                                       {
                                           $Id_proff_photo = $admin_data['Id_proff_photo'];
                                           // $address = $admin_data['address'];
                                       
                                       }
                                       else
                                       {
                                           $Id_proff_photo = base_url().'documents/logo16.png';
                                           // $address = "-";
                                       
                                       }
                                       ?>
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <h6 class="mb-0">Id</h6>
                                       </div>
                                       <!-- assets/dist/images/id.png -->
                                       <div class="col-sm-6 text-secondary">
                                          <div class="lightgallery">
                                             <!-- <a href=""
                                                data-exthumbimage="<?php echo $booking_details['id_proff_img']?>"
                                                data-src="<?php echo $booking_details['id_proff_img']?>"
                                                class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                <img style="height:90px"
                                                    src="<?php echo $Id_proff_photo ; ?>"
                                                    alt="" class="img-fluid">
                                                </a> -->
                                             <img src="<?php echo $Id_proff_photo ; ?>" alt="" style="width: 50px; height: 50px;">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- </div>
                     </div> -->
               </div>
            </div>
         </div>
      </div>
    
      <div class="row">
         <div class="col-md-12 pe-0">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>Booking History</header>
               </div>
               <div class="card-body ">
                  <div class="table-scrollable" >
                     <table id="guest_history_datatable" class="display full-width">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <th>Booking Date</th>
                              <th>Booking Id</th>
                              <th>Phone</th>
                              <!-- <th>Address</th> -->
                              <th>Check In</th>
                              <th>Check Out</th>
                              <!-- <th>Services</th> -->
                              <th>Total Bill</th>
                           </tr>
                        </thead>
                        <tbody id="geeks">
                           <?php
                              $i = 1;
                              if($booking_history)
                              {
                              //    echo "hii"; echo "<pre>"; print_r($booking_history);die;
                                  foreach($booking_history as $bk_h)
                                  {
                              
                              
                                      $wh = '(u_id= "'.$bk_h['u_id'].'")';
                                      $data = $this->MainModel->getSingleData('register',$wh);
                                  //  print_r($recharg  );
                                      if(!empty($data))
                                  {
                                      $full_name = $data['full_name'];
                                      $address = $data['address'];
                                      $mobile_no = $data['mobile_no'];
                                      $hotel_name = $data['hotel_name'];
                              
                              
                              
                                  }
                                  else
                                  {
                                      $full_name = "-";
                                      $address ="-";
                                      $mobile_no ="-";
                                      $hotel_name ="-";
                              
                                  }
                              
                              ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i++?></h5>
                              </td>
                              <td>
                                 <h5><?php echo date('d-m-Y', strtotime($bk_h['booking_date'])); ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $bk_h['booking_id'] ?></h5>
                              </td>
                              <!-- <td>
                                 <div>
                                     <h5><?php echo $hotel_name ?></h5>
                                 </div>
                                 </td> -->
                              <td>
                                 <h5><?php echo $mobile_no ?></h5>
                              </td>
                              <!-- <td><h5><?php echo $address ?></h5></td> -->
                              <td>
                                 <h5><?php echo date('d-m-Y', strtotime($bk_h['check_in']));?></h5>
                              </td>
                              <td>
                                 <h5><?php echo date('d-m-Y', strtotime($bk_h['check_out']));?></h5>
                              </td>
                              <!-- <td>
                                 <span class="badge badge-secondary" data-bs-toggle="modal"
                                     data-bs-target=".example_<?php echo $bk_h['booking_id'] ?>">Service</span>
                                 </td> -->
                              <!-- <td><a href="#"><span class="badge badge-secondary" data-bs-toggle="modal"
                                 data-bs-target=".bd-example-modal-lg_<?php echo $bk_h['booking_id'] ?>">View </span></a> -->
                              </td>
                              <td><?php echo $bk_h['total_charges'] ?> Rs </td>
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
<?php
   $u_id = $this->uri->segment(3);
   // $booking_id = $this->uri->segment(2);
   // // $u_id = $this->uri->segment(3);
   
 
   if($booking_history)
   {
    $where ='(booking_id = "'.$bk_h['booking_id'].'" )';
    $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
    $admin_id = $admin_details['hotel_id'];
   foreach($booking_history as $bk_h)
   {  
   $room_service_menu_completed_order = $this->MainModel->get_user_room_service_menu_completed_order_list($admin_id,$bk_h['booking_id'],$u_id);
   
   // $housekeeping_service_completed_order = $this->MainModel->get_user_housekeeping_completed_order_list($admin_id,$bk_h['booking_id'],$u_id);
   
   // $laundry_completed_order = $this->MainModel->get_user_laundry_order_list($admin_id,$bk_h['booking_id'],$u_id);
   
   // $food_completed_order = $this->MainModel->get_user_food_completed_order_list($admin_id,$bk_h['booking_id'],$u_id);
   
   // $room_service_services_completed_order = $this->MainModel->get_user_room_service_services_order_list($admin_id,$bk_h['booking_id'],$u_id);
   
   ?>
<div class="modal fade bd-example-modal-lg_<?php echo $bk_h['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Service Used</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="custom-tab-1">
               <ul class="nav nav-tabs ">
                  <li class="nav-item">
                     <a class="nav-link active" data-bs-toggle="tab" href="#home1">Room Service </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#profile1">Housekeeping</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#contact1"> Food & Beverage</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#rm_menu">Room Service Menu</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-bs-toggle="tab" href="#laundry"> Laundry</a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane fade show active" id="home1" role="tabpanel">
                     <div class="pt-4">
                        <div class="table-responsive">
                           <table
                              class="table table-bordered table-bordered table-hover table-responsive-sm">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Service Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $j = 1;
                                    if($room_service_services_completed_order)
                                    {
                                        foreach($room_service_services_completed_order as $rm_service)
                                        {
                                    ?>
                                 <tr>
                                    <th><?php echo $j++?></th>
                                    <td><?php echo $rm_service['service_name'] ?></td>
                                    <td><?php echo $rm_service['quantity'] ?></td>
                                    <td><?php echo $rm_service['price'] ?> Rs</td>
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
                  <div class="tab-pane fade" id="profile1">
                     <div class="pt-4">
                        <div class="table-responsive">
                           <table class="table table-bordered table-hover table-responsive-sm">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Service Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $k = 1;
                                    if($housekeeping_service_completed_order)
                                    {
                                        foreach($housekeeping_service_completed_order as $hk_service)
                                        {
                                    ?>
                                 <tr>
                                    <th><?php echo $k++?></th>
                                    <td><?php echo $hk_service['service_type'] ?></td>
                                    <td><?php echo $hk_service['quantity'] ?></td>
                                    <td><?php echo $hk_service['price'] ?> Rs</td>
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
                  <div class="tab-pane fade" id="contact1">
                     <div class="pt-4">
                        <div class="table-responsive">
                           <table class="table table-hover table-responsive-sm">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Menu Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $l = 1;
                                    if($food_completed_order)
                                    {
                                        foreach($food_completed_order as $fb)
                                        {
                                    ?>
                                 <tr>
                                    <th><?php echo $l++?></th>
                                    <td><?php echo $fb['items_name'] ?></td>
                                    <td><?php echo $fb['quantity'] ?></td>
                                    <td><?php echo $fb['price'] ?> Rs</td>
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
                  <div class="tab-pane fade" id="rm_menu">
                     <div class="pt-4">
                        <div class="table-responsive">
                           <table class="table table-hover table-responsive-sm">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Menu Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $m = 1;
                                    if($room_service_menu_completed_order)
                                    {
                                        foreach($room_service_menu_completed_order as $rs_m)
                                        {
                                    ?>
                                 <tr>
                                    <th><?php echo $m++?></th>
                                    <td><?php echo $rs_m['menu_name'] ?></td>
                                    <td><?php echo $rs_m['quantity'] ?></td>
                                    <td><?php echo $rs_m['price'] ?> Rs</td>
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
                  <div class="tab-pane fade" id="laundry">
                     <div class="pt-4">
                        <div class="table-responsive">
                           <table class="table table-hover table-responsive-sm">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Cloth Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $m = 1;
                                    if($laundry_completed_order)
                                    {
                                        foreach($laundry_completed_order as $ld)
                                        {
                                    ?>
                                 <tr>
                                    <th><?php echo $m++?></th>
                                    <td><?php echo $ld['cloth_name'] ?></td>
                                    <td><?php echo $ld['quantity'] ?></td>
                                    <td><?php echo $ld['price'] ?> Rs</td>
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
         <!-- </div>
            </div> -->
         <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-info">Save changes</button> -->
         </div>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
</div>
<script>
   $(document).ready(function() {
   $('#guest_history_datatable').DataTable();
   })
</script>