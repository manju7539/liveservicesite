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
                    <div class="col-12">
                        <h4><b>Check-out</b></h4>
                    </div>
                  
                    </div>
        </div>
</div>
                <div class="card ">
                <div class="card-body" id="invoice_content" style="padding-top:0px">
            <div class="row content_print">
               <div class="col-xl-12 col-xxl-12">
                  <div class="invoice ">
                                <div class="invoice ">
                                    <div class="">
                                        <!-- Header -->
                                        <header>
                                            <div class="row align-items-center">
                                                <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0"> <img
                                                        id="logo" src="<?php echo $admin_data['hotel_logo']?>"
                                                        title="Koice" alt="Koice" height="50" width="100">
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
                                                <div class="col-sm-6 mb-3 mt-3 text-sm-end  white_text_color" > <strong
                                                        class="text-black">Booking
                                                        Date:</strong>
                                                    <span><?php echo date('d-m-Y', strtotime($booking_details['booking_date']));?></span>
                                                </div>
                                            </div>
                                            <hr class="mt-0">
                                            <div class="row">
                                                <?php

                                                    $wh = '(city_id = "'.$admin_data['city'].'")';

                                                    $city_data = $this->MainModel->getData('city',$wh);

                                                    $city = "";

                                                    if($city_data)
                                                    {
                                                        $city = $city_data['city'];
                                                    }
                                                ?>
                                                <div class="col-sm-5"> <strong>Hotel Details:</strong>
                                                    <address>
                                                        <?php echo $admin_data['hotel_name']?><br>
                                                        <?php echo $admin_data['address']?>, <?php echo $admin_data['area']?><br>
                                                        Pincode -<?php echo $admin_data['pincode']?><br>
                                                        <?php echo $city?>, 
                                                        <br><?php echo $admin_data['state']?>, India.<br>
                                                    </address>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div class="row">
                                                        <div class="col-sm-4"> <strong>Check In:</strong>
                                                            <p><?php echo date('d-m-Y', strtotime($booking_details['check_in']));?></p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Check Out:</strong>
                                                            <p><?php echo date('d-m-Y', strtotime($booking_details['check_out']));?></p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Rooms:</strong>
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
                                                        <div class="col-sm-4"> <strong>Extent Room No:</strong>
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
                                                        <div class="col-sm-4"> <strong>Extent Check Out:</strong>
                                                            <p>
                                                                <?php 
                                                                    echo "-";
                                                                    if($booking_details['extend_check_out'] != "0000-00-00")
                                                                    {
                                                                        echo $booking_details['extend_check_out'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "-";
                                                                    }
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Adults:</strong>
                                                            <p><?php echo $booking_details['total_adults']?></p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Childs:</strong>
                                                            <p><?php echo $booking_details['total_child']?></p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Booking ID:</strong>
                                                            <p><?php echo $booking_details['booking_id']?></p>
                                                        </div>
                                                        <div class="col-sm-4"> <strong>Balance:</strong>
                                                            <p> <i class="fa fa-inr" aria-hidden="true"></i><?php echo $booking_checkout_data['total_bill']?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card1">
                                                <div class="card-body p-0">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <thead class="card-header1">
                                                                <?php
                                                                    $admin_id = $this->session->userdata('u_id');

			                                                        $booking_checkout_details1 = $this->MainModel->get_user_checkout_booking_details($admin_id,$booking_checkout_data['user_checkout_data_id']);
			                                                        
                                                                    $booking_checkout_details2 = $this->MainModel->get_user_checkout_booking_details1($admin_id,$booking_checkout_data['user_checkout_data_id']);

                                                                ?>
                                                                <tr>
                                                                    <td>Sr. No.</td>
                                                                    <td>Description</td>
                                                                    <?php
                                                                    // print_r($booking_checkout_details1);die;
                                                                        if($booking_checkout_details1)
                                                                        {
                                                                            foreach ($booking_checkout_details1 as $bchk) 
                                                                            {
                                                                            ?>
                                                                            <td><?php echo date('d/m/Y',strtotime($bchk['date']))?></td>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                    <td>Total</td>
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
                                                                    <td><?php echo $i++?></td>
                                                                    <td><?php echo $bchk2['description']?></td>
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
                                                                    <td> <i class="fa fa-rupee"></i><?php echo $booking_checkout_details_subtotal['sub_total']??0?></td>
                                                                    
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
                                                                    <td class="text-center border-bottom-0"><i
                                                                            class="fa fa-inr"
                                                                            aria-hidden="true"></i><?php echo $booking_checkout_data['total_bill']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="<?php echo count($booking_checkout_details1) + 2;?>" class="text-end border-bottom-0">
                                                                        <strong>Advance Amount:</strong>
                                                                    </td>
                                                                    <td class="text-center border-bottom-0"><i
                                                                            class="fa fa-inr"
                                                                            aria-hidden="true"></i><?php echo $booking_checkout_data['advance_payment']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="<?php echo count($booking_checkout_details1) + 2;?>" class="text-end border-bottom-0">
                                                                        <strong>Remaining Amount:</strong>
                                                                    </td>
                                                                    <td class="text-center border-bottom-0"><i
                                                                            class="fa fa-inr"
                                                                            aria-hidden="true"></i><?php echo $booking_checkout_data['remaing_amt']?></td>
                                                                </tr>
                                                              	<?php
                                                                    if($booking_checkout_data['is_paid'] == 1 && $booking_checkout_data['is_today_charge'] == 1)
                                                                    {
                                                                ?>
                                                                    <tr>
                                                                        <td colspan="<?php echo count($booking_checkout_details1) + 2;?>" class="text-end border-bottom-0" >
                                                                            <strong>Todays Charges:</strong>
                                                                        </td>
                                                                        <td class="text-center border-bottom-0"><i
                                                                                class="fa fa-inr"
                                                                                aria-hidden="true"></i><?php echo $booking_checkout_data['todays_charges']?></td>
                                                                    </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <p class="text-1 text-muted"><strong style="color:black;">Please Note:</strong> Amount payable is
                                                inclusive of central &amp; state goods &amp; services Tax act applicable
                                                slab
                                                rates.
                                                Please ask Hotel for invoice at the time of check-out.</p>
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
                        </div><br>
                        <div class="text-center mb-5">
                            <?php
                                if($booking_checkout_data['is_paid'] == 0)
                                {
                            ?>
                                    <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                        data-bs-target=".bd-payment-modal-sm"> <span> Check Out</span>
                                    </button>
                                    <button type="button" class="btn btn-primary css_btn" data-bs-toggle="modal"
                                        data-bs-target=".bd-extra-modal-sm">Add Additional Charges</button>
                                    <button type="button" class="btn btn-warning css_btn" data-bs-toggle="modal"
                                        data-bs-target=".bd-extra-modal-smd">Add Advance payment</button>
                                  
                            <?php
                                }
                            ?>
                          
                            <?php
                                if($booking_checkout_data['is_paid'] == 1)
                                {
                            ?>
                                    
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
            <div class="modal fade bd-payment-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Guest Checkout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="<?php echo base_url('HoteladminController/checkout_bill')?>" method="post">
                           <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(3)?>"> 
                           <input type="hidden" name="u_id" value="<?php echo $this->uri->segment(4)?>"> 
                           <input type="hidden" name="user_checkout_data_id" value="<?php echo $booking_checkout_data['user_checkout_data_id']?>"> 
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div class="basic-form">
                                        <div class="row">
                                          <div>
                                            <h6>Do you want add the Todays(<?php echo date('d-m-Y')?>) Room Charge.
                                            </h6>
                                          </div>
                                          <div>
                                            <input type="radio" name="is_today_charge" value="1" onclick="show2();" style="accent-color: green;" />
                                            <span style="font-size:15px; ">  Yes </span> &nbsp;
                                            
                                            <input type="radio" name="is_today_charge" value="2" onclick="show1();" style=" accent-color:red;" />
                                            <span style="font-size:15px;">   No </span>
                                          </div>
                                          
                                          <div id="div1" style="display:none;">
                                       
                                            <h6>Okay ,Room Charge is ......</h6>
                                            <input type="number" name="amount" class="form-control" style="width:50%">
                                     
                                      </div>
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
                        <form action="<?php echo base_url('HoteladminController/additional_amount_in_checkout')?>" method="post">
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
             <!-- modal for advance payment  -->
             <div class="modal fade bd-extra-modal-smd" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Advance payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="<?php echo base_url('HoteladminController/add_advance_payment')?>" method="post">
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
                                                        <td>Total Amount :</td>
                                                        <td class=" fw-700">
                                                            <input type="text" id="total_amt" name="total_amt" value="<?php echo $booking_checkout_data['total_bill']?>" placeholder="enter Total Amount" class="form-control" readonly>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        if($booking_checkout_data['remaing_amt'] != 0)
                                                        {
                                                    ?>
                                                        <tr>
                                                            <td>Remaining Amount:</td>
                                                            <td class="fw-700">
                                                                <input type="text" id="remaing_amt" placeholder="enter amount" value="<?php echo $booking_checkout_data['remaing_amt']?>" name="remaing_amt" class="form-control" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td> Add Amount:</td>
                                                        <td class="fw-700">
                                                            <input type="number" id="amount"  placeholder="enter amount" name="amount" class="form-control" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Select Payment type:</td>
                                                        <td class=" fw-700">
                                                            <select id="inputState" name="payment_type"
                                                                class="default-select form-control wide"
                                                                required>
                                                                <option value data-isdefault="true">Select
                                                                    for....</option>
                                                                <option value="1">Cash</option>
                                                                <option value="2">Credit Card</option>
                                                                <option value="3">Online</option>
                                                            </select>

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
                            <input type="hidden" name="booking_id" value="<?php echo $this->uri->segment(2)?>"> 
                            <input type="hidden" name="u_id" value="<?php echo $this->uri->segment(3)?>"> 
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
                                                        <td class=" fw-700"><?php echo $this->uri->segment(2)?></td>
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
      
   <script type="text/javascript">
    $(function() {
        $("#btnPrint").click(function() {
            var contents = $("#dvContents").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({
                "position": "absolute",
                "top": "-1000000px"
            });
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument
                .document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>DIV Contents</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write('<link href="style.css" rel="stylesheet" type="text/css" />');
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
    </script>

    <!-- check validation for advance payment -->
    <script>
        function check_amount()
        {
            var total_amt = $('#total_amt').val();
            var amount = $('#amount').val();

            if(amount > total_amt)
            {
                alert('Enter valid amount');
                return false;
            }
        }
    </script>
    <!-- check validation for advance payment -->

    <!-- add amount -->
    <script>
        function add_amt()
        {
            var base_url = '<?php echo base_url()?>';
            var minibar = $('#minibar').val();
            var qty = $('#qty').val();

            $.ajax({
                    url : base_url + "CheckOutController/add_minibar_amt",
                    method : "post",
                    data : {minibar : minibar,qty : qty},
                    success :function(data)
                            {
                                $('#minbar_amt').val(data)
                            }
            });
        }
    </script>
          <script>
  function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>

<script>
   const printBtn = document.getElementById('print-btn');
  const contentDiv = document.getElementById('invoice_content');

  printBtn.addEventListener('click', () => {
    window.print();
  });

</script>



