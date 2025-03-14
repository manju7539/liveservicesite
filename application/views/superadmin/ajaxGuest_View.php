<style>
  /* hide everything except the content div when printing */
  @media print {
    body * {
      visibility: hidden;
    }
    #invoice_content, #invoice_content * {
      visibility: visible;
    }
    #invoice_content {
      position: relative;
      left: 0;
      top: 0;

    }
    #print-btn {
      display: none;
    }
#logo{
   height:180px;
   width:200px
}
@page {
  margin-top: -1in;
}
#invoice_table{
   margin-top:150px;
}

  }

  .card-header1{
   font-weight:bold;
  }

</style>

<script src="http://localhost/client_code/Super_Admin/assets/dist/vendor/global/global.min.js"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Check-out</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <!-- <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li> -->
                  
                    <li class="active"><i class="fa fa-angle-right"></i>Check-out</li>
                </ol>
            </div>
        </div>
<div class="content-body" >
   <!-- row -->
   <div class="container-fluid">
      <div class="row page-titles">
         <!-- <div class="col-6">
            <h4>Check-out</h4>
         </div>
         <div class="col-6">
            <ol class="breadcrumb page-breadcrumb pull-right">
              
               <li class="active"> <i class="fa fa-angle-right"></i>Check-out</li>
            </ol>
         </div> -->
      </div>
      <div class="card">
         <div class="card-body" id="invoice_content" style="padding-top:0px">
            <div class="row content_print">
               <div class="col-xl-12 col-xxl-12">
                  <div class="invoice ">
                     <div class="">
                        <!-- Header -->
                        <header>
                           <div class="row align-items-center">
                              <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0"> 
                                 <?php 
                                    if(isset($admin_data['hotel_logo']) && !empty($admin_data['hotel_logo'])){
                                    
                                        $hotel_l= $admin_data['hotel_logo'];
                                    }else{
                                        $hotel_l= base_url().'documents/h_image.jpg';; 
                                    }
                                    
                                    ?>
                                 <img 
                                    src="<?php echo   $hotel_l ?>" id="logo"  
                                    title="Koice" alt="Koice" height="80" width="90">
                              </div>
                              <div class="col-sm-5 text-center text-sm-end">
                                 <h4 class="mb-0">Invoice</h4>
                                 <p class="mb-0">Invoice Number - <?php echo $this->uri->segment(3)?></p>
                              </div>
                           </div>
                           <hr>
                        </header>
                        <!-- Main Content -->
                        <main>
                           <div class="row mt-3" style="background:#355980; color: white;">
                              <div class="col-sm-6 mb-3 mt-3  white_text_color"> <strong class="text-black">Guest
                                 Name:</strong>
                                 <span><?php echo $user_data['full_name']?></span>
                              </div>
                              <div class="col-sm-6 mb-3 mt-3 text-sm-end white_text_color"> <strong
                                 class="text-black">Booking
                                 Date:</strong>
                                 <span><?php echo date('d-m-Y', strtotime($booking_details['booking_date']));?></span>
                              </div>
                           </div>
                           <hr class="mt-0">
                           <div class="row">
                              <?php
                              if(!empty($admin_data))
                              {
                                  $wh = '(city_id = "'.$admin_data['city'].'")';
                              }
                              else
                              {
                                  $wh = '(city_id = "0")';
                              }
                                 
                                 
                                 $city_data = $this->MainModel->getData('city',$wh);
                                 
                                 $city = "";
                                 
                                 if($city_data)
                                 {
                                     $city = $city_data['city'];
                                 }
                                 ?>
                              <div class="col-sm-5">
                                 <strong>Hotel Details:</strong>
                                 <address>
                                    <?php echo $admin_data['hotel_name']??''?><br>
                                    <?php echo $admin_data['address']??''?>, <?php echo $admin_data['area']??''?><br>
                                    Pincode -<?php echo $admin_data['pincode']??''?><br>
                                    <?php echo $city?>, 
                                    <br><?php echo $admin_data['state']??''?>, India.<br>
                                 </address>
                              </div>
                              <div class="col-sm-7">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <strong>Check In:</strong>
                                       <p><?php echo date('d-m-Y', strtotime($booking_details['check_in']))??''?></p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Check Out:</strong>
                                       <p><?php echo date('d-m-Y', strtotime($booking_details['check_out']))?></p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Rooms:</strong>
                                       <p><?php echo $booking_details['no_of_rooms']?></p>
                                    </div>
                                    <!-- <div class="col-sm-4"> <strong>Room Type:</strong>
                                       <p>Double Deulxe</p>
                                       </div> -->
                                    <div class="col-sm-4"> <strong>Room No:</strong>
                                       <?php 
                                          if($booking_room_details)
                                          {
                                              foreach($booking_room_details as $b_rm)
                                              {
                                                  echo "<p>".$b_rm['room_no']."</p>";
                                              }
                                          }
                                          ?>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Extend Room No:</strong>
                                       <p>
                                          <?php 
                                             if($booking_room_details)
                                             {
                                                 foreach($booking_room_details as $b_rm)
                                                 {
                                                     if($b_rm['extend_room_no'] != 0)
                                                     {
                                                         echo $b_rm['extend_room_no'];
                                                     }
                                                     else
                                                     {
                                                         echo "-";
                                                     }
                                                 }
                                             }
                                             else
                                             {
                                                 echo "-";
                                             }
                                             ?>
                                       </p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Extend Check Out:</strong>
                                       <p>
                                          <?php 
                                             echo "-";
                                             if($booking_details['extend_check_out'] != "0000-00-00")
                                             {
                                                 echo date('d-m-Y', strtotime($booking_details['extend_check_out']));
                                             }
                                             else
                                             {
                                                 echo "-";
                                             }
                                             ?>
                                       </p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Adults:</strong>
                                       <p><?php echo $booking_details['total_adults']?></p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Childs:</strong>
                                       <p><?php echo $booking_details['total_child']?></p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Booking ID:</strong>
                                       <p><?php echo $booking_details['booking_id']?></p>
                                    </div>
                                    <div class="col-sm-4">
                                       <strong>Balance:</strong>
                                       <p> <i class="fa fa-inr" aria-hidden="true"></i><?php echo $booking_checkout_data['total_bill']??''?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card1">
                              <div class="card-body p-0">
                                 <div class="table-responsive">
                                    <table class="table mb-0" id="invoice_table">
                                       <thead class="card-header1">
                                          <?php
                                             // $admin_id = $this->session->userdata('admin_id');
                                             //  print_r($admin_id);
                                             $booking_id = $this->uri->segment(3);
                                             
                                             
                                             $u_id = $this->uri->segment(4);
                                             
                                             
                                             $where ='(booking_id = "'.$booking_id.'" )';
                                             $admin_details = $this->MainModel->getData($tbl ='user_hotel_booking', $where);
                                             
                                             $admin_id = $admin_details['hotel_id'];
                                             //  print_r($admin_id);die;

                                             $booking_checkout_details1 = $this->SuperAdmin->get_user_checkout_booking_details($admin_id,$booking_checkout_data['user_checkout_data_id']??'');	
                                             	
                                             $booking_checkout_details2 = $this->SuperAdmin->get_user_checkout_booking_details1($admin_id,$booking_checkout_data['user_checkout_data_id']??'');
                                             // echo "<pre>";
                                             // print_r($booking_checkout_details1);die;
                                             
                                             
                                             ?>
                                          <tr>
                                             <td>
                                                Sr. No.
                                             </td>
                                             <td>
                                                Description
                                             </td>
                                             <?php
                                                if($booking_checkout_details1)
                                                {

                                                    foreach ($booking_checkout_details1 as $bchk) 
                                                    {
                                                      // echo "<pre>";
                                                      // print_r($bchk);die;
                                                ?>
                                             <td><?php echo date('d/m/Y',strtotime($bchk['date']))?></td>
                                             <?php
                                                }
                                                }
                                                ?>
                                             <td>Total</td>
                                             </td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             $i = 1;
                                             if($booking_checkout_details2)
                                             {
                                                 foreach ($booking_checkout_details2 as $bchk2) 
                                                 {
                                                     $booking_checkout_details_amt = $this->MainModel->get_user_checkout_booking_details_amt($admin_id,$booking_checkout_data['user_checkout_data_id'],$bchk2['description']);
                                             
                                                     $booking_checkout_details_subtotal = $this->MainModel->get_user_checkout_booking_details_subtotal($admin_id,$booking_checkout_data['user_checkout_data_id'],$bchk2['description']);
                                             
                                             ?>
                                          <tr>
                                             <td>
                                                <h5><?php echo $i++?></h5>
                                             </td>
                                             <td>
                                                <h5><?php echo $bchk2['description']?></h5>
                                             </td>
                                             <?php
                                                if($booking_checkout_details_amt)
                                                {
                                                    foreach ($booking_checkout_details_amt as $bchk_a) 
                                                    {
                                                ?>
                                             <td> <i class="fa fa-inr" aria-hidden="true"></i><?php echo $bchk_a['amount']?></td>
                                             <?php
                                                }
                                                }
                                                ?>
                                             <td> <i class="fa fa-rupee"></i><?php echo $booking_checkout_details_subtotal['sub_total']?></td>
                                          </tr>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </tbody>
                                       <tfoot>
                                          <!-- <tr>
                                             <td colspan="9" class="text-end"><strong>Sub
                                                     Total:</strong></td>
                                             <td class="text-end"><i
                                                     class="fa fa-rupee"></i>400.00</td>
                                             </tr> -->
                                          <!-- <tr>
                                             <td colspan="9" class="text-end">
                                                 <strong>Tax:</strong>
                                             </td>
                                             <td class="text-end"><i
                                                     class="fa fa-rupee"></i>40.00</td>
                                             </tr> -->
                                          <tr>
                                             <td colspan="<?php echo count($booking_checkout_details1) + 2;?>" class="text-end border-bottom-0" >
                                                <strong>Total:</strong>
                                             </td>
                                             <td class="text-end border-bottom-0"><i	
                                                class="fa fa-inr"	
                                                aria-hidden="true"></i><?php echo $booking_checkout_data['total_bill']??''?></td>
                                             
                                          </tr>
                                       </tfoot>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <p class="text-1 text-muted"><strong>Please Note:</strong> Amount payable is
                              inclusive of central &amp; state goods &amp; services Tax act applicable
                              slab
                              rates.
                              Please ask Hotel for invoice at the time of check-out.
                           </p>
                        </main>
                        <!-- Footer -->
                        <footer class="text-center">
                           <!-- <hr>
                              <p><strong>Koice Inc.</strong><br>
                                  4th Floor, Plot No.22, Above Public Park, 145 Murphy Canyon Rd,<br>
                                  Suite 100-18, San Diego CA 2028. </p>
                              <hr> -->
                           <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt
                              and
                              does not require physical signature.
                           </p>
                           <div class="row p-3">
                              <div>
                                 <div style="float:right">
                                 </div>
                              </div>
                              <div class="mt-4">
                                 <div style="float:right">
                                 </div>
                              </div>
                           </div>
                           <div>
                           </div>
                        </footer>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class="text-center">
               <?php
                  if($booking_checkout_data['is_paid']??'' == 0)
                  {
                  ?>   <!-- <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                  data-bs-target=".bd-payment-modal-sm"> <span> Check Out</span>
                  </button>
                  
                  <button type="button" class="btn btn-primary css_btn" data-bs-toggle="modal"
                  data-bs-target=".bd-extra-modal-sm">Add Additional Charges</button>
                  <button type="button" class="btn btn-warning css_btn" data-bs-toggle="modal"
                  data-bs-target=".bd-extra-modal-mb">Add Minibar</button> -->
               <?php
                  }
                  ?>
               <?php
                  if($booking_checkout_data['is_paid']??'' == 1)
                  {
                  ?>
               <!-- <button class="btn btn-success " onclick="window.print()" type="button"><span><i class="fa fa-print"></i>
               Print</span> 
               </button> -->
               <button class="btn btn-success" id="print-btn" type="button">
  <span><i class="fa fa-print"></i> Print</span>
</button>
               <?php
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
   <!-- modal for Payment  -->
   <div class="modal fade bd-payment-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Payment</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form action="<?php echo base_url('CheckOutController/checkout_bill')?>" method="post">
               <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(3)?>"> 
               <input type="hidden" name="u_id" value="<?php echo $this->uri->segment(4)?>"> 
               <input type="hidden" name="user_checkout_data_id" value="<?php echo $booking_checkout_data['user_checkout_data_id']?>"> 
               <div class="modal-body">
                  <div class="col-lg-12">
                     <div class="basic-form">
                        <div class="row">
                           <table class="table simple mb-0">
                              <tbody>
                                 <tr>
                                    <td>Payment Method:</td>
                                    <td class=" fw-700">
                                       <select id="inputState" name="payment_type"
                                          class="default-select form-control wide"
                                          style="display: none;" required>
                                          <option value data-isdefault="true">Select
                                             for....
                                          </option>
                                          <option value="1">Cash</option>
                                          <option value="2">Credit Card</option>
                                          <option value="3">Online</option>
                                       </select>
                                    </td>
                                 </tr>
                                 <!-- <tr>
                                    <td> Advance Amount:</td>
                                    <td class="fw-700">
                                        <input type="number" class="form-control">
                                    </td>
                                    </tr>
                                    <tr>
                                    <td> Transaction Id:</td>
                                    <td class="fw-700">
                                        <input type="number" class="form-control">
                                    </td>
                                    </tr> -->
                              </tbody>
                           </table>
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
   <!-- modal for Add Extra amount  -->
   <div class="modal fade bd-extra-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Additional Amount</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form action="<?php echo base_url('CheckOutController/additional_amount_in_checkout')?>" method="post">
               <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(3)?>"> 
               <input type="hidden" name="u_id" value="<?php echo $this->uri->segment(4)?>"> 
               <input type="hidden" name="user_checkout_data_id" value="<?php echo $booking_checkout_data['user_checkout_data_id']?>"> 
               <div class="modal-body">
                  <div class="col-lg-12">
                     <div class="basic-form">
                        <div class="row">
                           <table class="table simple mb-0">
                              <tbody>
                                 <tr>
                                    <td>Invoice Number:</td>
                                    <td class=" fw-700"><?php echo $this->uri->segment(3)?></td>
                                 </tr>
                                 <tr>
                                    <td>Service Type :</td>
                                    <td class=" fw-700">
                                       <input type="text" name="description" placeholder="enter service" class="form-control" required>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> Date:</td>
                                    <td class="fw-700">
                                       <input type="date" name="date" class="form-control" required>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Amount:</td>
                                    <td class="fw-700">
                                       <input type="number" name="amount" placeholder="enter amount" class="form-control" required>
                                    </td>
                                 </tr>
                                 <!-- <tr>
                                    <td>Remark:</td>
                                    <td class=" fw-700">
                                        <input type="text" placeholder="enter remark"
                                            class="form-control">
                                    </td>
                                    </tr> -->
                              </tbody>
                           </table>
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
   <!-- modal for Add add minbar  -->
   <div class="modal fade bd-extra-modal-mb" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Minibar</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form action="<?php echo base_url('CheckOutController/add_minbar_in_checkout')?>" method="post">
               <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(3)?>"> 
               <input type="hidden" name="u_id" value="<?php echo $this->uri->segment(4)?>"> 
               <input type="hidden" name="user_checkout_data_id" value="<?php echo $booking_checkout_data['user_checkout_data_id']?>"> 
               <input type="hidden" name="description" value="Minibar"> 
               <div class="modal-body">
                  <div class="col-lg-12">
                     <div class="basic-form">
                        <div class="row">
                           <table class="table simple mb-0">
                              <tbody>
                                 <tr>
                                    <td>Invoice Number:</td>
                                    <td class=" fw-700"><?php echo $this->uri->segment(3)?></td>
                                 </tr>
                                 <tr>
                                    <td>Minibar :</td>
                                    <td class=" fw-700">
                                       <select name="minibar" id="minibar"
                                          class="default-select form-control wide"
                                          style="display: none;" required>
                                          <option value data-isdefault="true">Select</option>
                                          <?php
                                             if($minibar_list)
                                             {
                                                 foreach($minibar_list as $ml)
                                                 {
                                             ?>
                                          <option value="<?php echo $ml['r_s_min_bar_id']?>"><?php echo $ml['item_name']?></option>
                                          <?php
                                             }
                                             }
                                             ?>
                                       </select>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Quantity :</td>
                                    <td class=" fw-700">
                                       <input type="number" name="qty" id="qty" onkeyup="add_amt()" class="form-control" required>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> Date:</td>
                                    <td class="fw-700">
                                       <input type="date" name="date" class="form-control" required>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>Amount:</td>
                                    <td class="fw-700">
                                       <input type="number" name="amount" id="minbar_amt" placeholder="enter amount" class="form-control" readonly>
                                    </td>
                                 </tr>
                                 <!-- <tr>
                                    <td>Remark:</td>
                                    <td class=" fw-700">
                                        <input type="text" placeholder="enter remark"
                                            class="form-control">
                                    </td>
                                    </tr> -->
                              </tbody>
                           </table>
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
</div>
</div>

</div>
<script>
   const printBtn = document.getElementById('print-btn');
  const contentDiv = document.getElementById('invoice_content');

  printBtn.addEventListener('click', () => {
    window.print();
  });

</script>



