<div class="page-content-wrapper">
<div class="page-content">
<div class="card ">
   <div class="card-body" id="invoice_content" style="padding-top:0px">
      <div class="content-body">
         <div class="container-fluid">
            <div class="row page-titles">
               <div class="col-6">
                  <h4>Guest Information</h4>
               </div>
               <div class="col-6">
                  <ol class="breadcrumb page-breadcrumb pull-right">
                     <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                        href="<?php echo base_url('index') ?>">Home</a>&nbsp;<i
                        class="fa fa-angle-right"></i>
                     </li>
                     <li class="active">Guest Information</li>
                  </ol>
               </div>
            </div>
            <?php
               if($user_data['profile_photo'])
               {
                   $profile_photo = $user_data['profile_photo'];
               }
               else
               {
                   $profile_photo = base_url().'documents/blankpic.jpg';
               }
               ?>
            <div class="row">
               <div class="col-lg-4">
                  <div class="card" style="border: 2px solid #48e4ff;">
                     <div class="card-body">
                        <!-- <h4 class="text-center mb-3">Guest Information</h4> -->
                        <div class="d-flex flex-column align-items-center text-center">
                           <img src="<?php echo $profile_photo?>" alt="Admin"
                              class="rounded-circle p-1 bg-primary" style="height: 100px; width: 100px;">
                           <div class="mt-3">
                              <h4><?php echo $user_data['full_name']?></h4>
                              <p class="text-info mb-1"><?php echo $user_data['mobile_no']?></p>
                              <p class="text-black text-font-size-12">
                                 <?php echo $user_data['email_id']?>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-8">
                  <div class="card" style="border: 2px solid #48e4ff;">
                     <div class="card-body">
                        <h4 class="title mb-4">Booking Information</h4>
                        <div class="row">
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h5 class="">Check-in :</h5>
                                 </div>
                                 <div class="col-sm-6 text-dark " style="font-size:12px;">
                                    <?php echo date('d-m-Y', strtotime($booking_details['check_in']));?>
                                 </div>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="">Check-out :</h6>
                                 </div>
                                 <div class="col-sm-6 text-secondary" style="font-size:12px;">
                                    <?php echo date('d-m-Y', strtotime($booking_details['check_out']));?>
                                 </div>
                              </div>
                           </div>
                           <!-- <hr> -->
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">No.of.adults :</h6>
                                 </div>
                                 <div class="col-sm-6 text-dark " style="font-size:12px;">
                                    <?php echo $booking_details['total_adults']?>
                                 </div>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">No.of Childs :</h6>
                                 </div>
                                 <div class="col-sm-6 text-secondary" style="font-size:12px;">
                                    <?php echo $booking_details['total_child']?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">Source :</h6>
                                 </div>
                                 <div class="col-sm-6 text-dark " style="font-size:12px;">
                                    <?php 
                                       if($booking_details['booking_from'] == 1)
                                       {
                                           echo  "From Walking Booking";
                                       }
                                       else
                                       {
                                           if($booking_details['booking_from'] == 2)
                                           {
                                               echo "From App Booking";
                                           }
                                           else
                                           {
                                               echo "";
                                           }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <?php
                              $date1 = $booking_details['check_in'];
                              $date2 = $booking_details['check_out'];
                              
                              $diff = abs(strtotime($date2) - strtotime($date1));
                              
                              $years = floor($diff / (365*60*60*24));
                              $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                              $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                              
                              $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                              
                              ?>
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">Total Days :</h6>
                                 </div>
                                 <div class="col-sm-6 text-secondary" style="font-size:12px;">
                                    <?php echo $days?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">No.of room:</h6>
                                 </div>
                                 <div class="col-sm-6 text-dark " style="font-size:12px;">
                                    <?php echo $booking_details['no_of_rooms']?>
                                 </div>
                              </div>
                           </div>
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">Id Proof :</h6>
                                 </div>
                                 <div class="col-sm-6">
                                    <div id="lightgallery">
                                       <a href="<?php echo $booking_details['id_proff_img']?>"
                                          data-exthumbimage="<?php echo $booking_details['id_proff_img']?>"
                                          data-src="<?php echo $booking_details['id_proff_img']?>"
                                          class="col-lg-3 col-md-6 mb-4">
                                       <img src="<?php echo $booking_details['id_proff_img']?>" alt=""
                                          style="width:80px;">
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="col-6">
                              <div class="row">
                                  <div class="col-sm-6">
                                      <h6 class="mb-2">Room Type :</h6>
                                  </div>
                                  <div class="col-sm-6 text-secondary" style="font-size:12px;">
                                      Deluxe room
                                  </div>
                              </div>
                              </div> -->
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-6">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <h6 class="mb-2">Room No. :</h6>
                                 </div>
                                 <div class="col-sm-6 text-white " style="font-size:18px;">
                                    <?php
                                       if($room_number)
                                       {
                                           foreach($room_number as $rn)
                                           {
                                       ?>
                                    <div class="view_room_card" style="display:inline-block;">
                                       <div class="room_card card red " style=" background-color:green;display:flex; justify-content:center; align-items:center;" >
                                          <span class="room_no mb-3 " style="color:white; font-weight:700; display:flex; justify-content:center; align-items:center; "><?php echo $rn['room_no']?></span>
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       }
                                       ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
            <div class="card">
               <div class="card-header">
                  <div>
                     <h4 class="card-title">Booking History</h4>
                  </div>
                  <div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="table-responsive">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                           <div class="guest-calendar">
                              <div id="reportrange" class="pull-right reportrange"
                                 style="width: 100%">
                                 <span></span><b class="caret"></b>
                                 <!-- <i class="fas fa-chevron-down ms-3"></i> -->
                              </div>
                           </div>
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.No.</strong></th>
                                    <th><strong>Booking Date </strong></th>
                                    <th><strong>Booking ID</strong></th>
                                    <!-- <th><strong>Address</strong></th> -->
                                    <th><strong>Check-in</strong></th>
                                    <th><strong>Check-out</strong></th>
                                    <th><strong>Service</strong></th>
                                    <th><strong>Total Bill</strong></th>
                                 </tr>
                              </thead>
                              <tbody id="searchTable">
                                 <?php
                                    $i = 1;
                                    if(!empty($booking_history))
                                    {
                                        foreach($booking_history as $bk_h)
                                        {
                                            
                                    ?>
                                 <tr>
                                    <td><?php echo $i++?></td>
                                    <td><?php echo date('d-m-Y', strtotime($bk_h['booking_date'])); ?></td>
                                    <td><?php echo $bk_h['booking_id']?></td>
                                    <td><?php echo date('d-m-Y', strtotime($bk_h['check_in'])); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($bk_h['check_out'])); ?></td>
                                    <td>
                                       <!-- <a href="#"><span class="badge badge-secondary" data-bs-toggle="modal"
                                          data-bs-target=".bd-example-modal-lg_<?php echo $bk_h['booking_id'] ?>">View </span></a> -->
                                       <a href="#" class="badge badge-info service_data"  data-unic-id="<?= $bk_h['booking_id'] ?>" user_id="<?= $bk_h['u_id'] ?>">view</a>
                                    </td>
                                    <td><?php echo $bk_h['total_charges'] ?> Rs </td>
                                 </tr>
                                 <?php
                                    }
                                    }
                                    
                                    ?>
                              </tbody>
                           </table>
                           <nav style="float:right;">
                           
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--view model start -->
         <div class="modal fade" id="service_data_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="min-width:50%">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Note:</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="basic-form get_data_model">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-light css_btn"
                        data-bs-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <!-- view model end -->
      </div>
   </div>
</div>
</div>
</div>

<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
      $('#acceptedOrder_tb').DataTable();
      $('#rejectedOrder_tb').DataTable();
   
      $(document).on('click','.service_data', function (e) {
         e.preventDefault(); 
         var id = $(this).attr('data-unic-id');
         var user_id = $(this).attr('user_id');
         
         $('#service_data_model').modal('show');
         
         $.ajax({
            
            url: '<?= base_url('HoteladminController/get_all_order_data') ?>',
            type: "post",
            data: {id : id, user_id : user_id},
            success: function (response) {
               $('.get_data_model').html(response);
            }
         });
      });
   
   });
   
   
</script>