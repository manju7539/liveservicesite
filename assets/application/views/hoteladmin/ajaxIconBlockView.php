<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<style>
    
.demo1 {
    /* color:green; */
    font-size: smaller;
    margin-left: -12px;
    position: absolute;
    margin-top: -9px;
}

.dropify-wrapper {
    height: 84px;

}
.form-control:disabled, .form-control[readonly] {
  background-color: white;
}
.room_card {
    height: 239px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, .19), 0 6px 6px rgba(0, 0, 0, .23) !important;
    border-radius: 20px;
    margin-bottom: 1.875rem;
    background-color: #fff;
    transition: all .5s ease-in-out;
    position: relative;
    border: 0rem solid transparent;
    border-radius: 0.75rem;
    box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgb(82 63 105 / 5%);
    /* height: calc(100% - 30px); */
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0);
    transition: background 0.5s ease;
}

.demo:hover .overlay {
    display: block;
    background: rgba(0, 0, 0, .3);
}

.demo .button {
    position: absolute;
    /* width: 270px; */
    left: 27%;
    top: 111px;
    text-align: center;
    opacity: 0;
    transition: opacity .35s ease;
}

.demo .button a {
    /* width: 200px; */
    padding: 12px 48px;
    text-align: center;
    color: white;
    border: solid 2px white;
    z-index: 1;
}

.demo:hover .button {
    opacity: 1;
}
</style>



<?php 

if($icon_id == 1){?>
    <style>
        .custome_model_block{
            margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%) !important;
  transform: translate(-50%, -50%) !important;
width:600px
        }
    </style>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header><span class="page_header_title11">All Enquiry Request</span></header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Enquiry</option>
                                        <option value="accepted_order">Accepted Enquiry</option>
                                        <option value="rejected_order">Rejected Enquiry</option>
                                     
                                    </select>                         
                                </div>
<!--         
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Departed Guest</a>
            
            </div> -->
            <div class="new_orders_div">
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                            <tr>
                                    <th><strong>Sr. No.</strong></th>
                                <th><strong>Guest Name</strong></th>
                                <th><strong>Phone No.</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Check-In</strong></th>
                                <th><strong>Check-Out</strong></th>
                                <th><strong>Enquiry Id</strong></th>
                                
                                <th><strong>Requirement</strong></th>
                                <th><strong>Room Names</strong></th>
                                <th><strong>Select Room Type</strong></th>
                                
                                <th><strong>Action</strong></th>
                            </tr>
                        </thead>
                        <tbody class="">
                        <?php

        $i = 1;
        if($list)
        {
            foreach($list as $e_req)
            {
                $user_data = $this->HotelAdminModel->get_user_data($e_req['u_id']);
                
                if($user_data)
                {
    ?>
    
                <tr class="sub-container">
                    <td><strong><?php echo $i++?></strong></td>
                    <td><?php echo $user_data['full_name'] ?></td>
                    <td><?php echo $user_data['mobile_no'] ?></td>
                    <td><?php echo $user_data['email_id'] ?></td>
                    <td><?php echo $e_req['check_in_date'] ?></td>
                    <td><?php echo $e_req['check_out_date'] ?></td>
                    <td><?php echo $e_req['hotel_enquiry_request_id'] ?></td>
                    
                    <!--<td><?php //echo $e_req['no_of_room'] ?></td>
                    <td><?php //echo $e_req['total_adults'] ?></td>
                    <td><?php //echo $e_req['total_childs'] ?></td>-->
                    <!-- <td>
                        <button class="btn btn-secondary_<?php //echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i class="fa fa-eye"></i></button>

                    </td> -->
                  
                    
                     <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
    <td>
                        <?php echo $e_req['room_type_name']?>
                    </td>
                    <td>
                        
                        <select name="room_type" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id']?>)" id="status_<?php echo $e_req['hotel_enquiry_request_id']?>"> 
                            <?php
                                $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'" AND room_type_id = "'.$e_req['room_type'].'")';

                                $room_type_exist= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                                if($room_type_exist)
                                {
                            
                                    echo"<option selected disabled>-Room Type is Available in our Hotel-</option>";
                                
                                }
                                else{
                                    $wh_room_type = '(hotel_id = "'.$e_req['hotel_id'].'")';
            
                                    $room_type_exist11= $this->HotelAdminModel->getAllData('room_type',$wh_room_type);

                                    echo"<option selected disabled>--Select room--</option>";

                                    foreach($room_type_exist11 as $u)
                                    {
                                        $name = $u['room_type_name'];
                                        
                                        echo '<option value="'. $u['room_type_id'].'" >'.$name.'</option>';
                                        
                                    }
                                }
                                ?>
                        
                    </select>
                    </td>
                    <?php 
                        $wh_room_type = '(room_type_id = "'.$e_req['room_type'].'" AND hotel_id="'.$e_req['hotel_id'].'" )';

                        $room_type_exist = $this->HotelAdminModel->getData('room_type',$wh_room_type);
        
                    ?>
                    <td>
                        <div class="d-flex">
                            <a href="#"><span class="badge badge-success"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>">Accept</span>
                            </a>&nbsp;&nbsp;
                            <a href="<?php echo base_url('HoteladminController/reject_enquiry_request1/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                        </div>
                        <!-- accept modal  -->
                        <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm custome_model_block">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <h5 class="modal-title">Accepted Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div> -->
                                    <?php
                                    
                                        if($room_type_exist)
                                        {
                                            ?>
                                                    <form action="<?php echo base_url('HoteladminController/accept_enquiry_request1')?>" method="post">
                                                    <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Room Charges</label>
                                                            <input type="number" name="room_charges" value="<?php echo $room_type_exist['price'] ?>" onKeyUp="change_amount()" id="price" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['lux_tax'] ?>" id="lux_tax" class="form-control" required="">
                                                            <input type="hidden" value="<?php echo $room_type_exist['serv_tax'] ?>" id="serv_tax" class="form-control" required="">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Service Tax Amount</label>
                                                            <input type="number" name="service_tax" value="<?php echo $room_type_exist['serv_tax_amt'] ?>" id="serv_tax_amt" class="form-control">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Luxury Tax Amount</label>
                                                            <input type="number" name="luxury_tax" value="<?php echo $room_type_exist['lux_tax_amt'] ?>" id="lux_tax_amt" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Send </button>
                                                    </div>
                                                </form>
                                            <?php
                                        }else{
                                            
                                            ?>
                                                <h5 style="color:red;padding:5px">Please Select Room Type First...</h5>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                                
                                
                            </div>
                        </div>
                        <!-- /. accept modal  -->
                    </td>
                </tr>
                <div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Requirement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $e_req['requirement'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
    <?php
                }
            }
        }
        
            ?>
                            
                            
                        </tbody>
                    </table>
                </div>
    </div>








    <div class="accepted_orders_div" style="display: none;">
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
                        <thead>
                            <tr>
                            <th><strong>Sr. No.</strong></th>
                                                        <th><strong>Guest Name</strong></th>
                                                        <th><strong>Phone No.</strong></th>
                                                        <th><strong>Email</strong></th>
                                                        <th><strong>Check-In</strong></th>
                                                        <th><strong>Check-Out</strong></th>
                                                        <th><strong>Enquiry ID</strong></th>
                                                        <th><strong>Requirement</strong></th>

                                                        <!-- <th><strong>Room Name</strong></th> -->
                                                        <th><strong>Selected Room Type</strong></th>
                                                        <th><strong>Status</strong></th>
                            </tr>
                        </thead>
                        <tbody class="">
                        <?php

                                                    $i = 1;
                                                    if($list1)
                                                    {
                                                        foreach($list1 as $e_req)
                                                        {
                                                            $user_data = $this->MainModel->get_user_data($e_req['u_id']);
                                                        
                                                            if($user_data)
                                                            {
                                                ?>
                                                            <tr class="sub-container">
                                                                <td><strong><?php echo $i++?></strong></td>
                                                                <td><?php echo $user_data['full_name'] ?></td>
                                                                <td><?php echo $user_data['mobile_no'] ?></td>
                                                                <td><?php echo $user_data['email_id'] ?></td>
                                                                <td><?php echo $e_req['check_in_date'] ?></td>
                                                                <td><?php echo $e_req['check_out_date'] ?></td>
                                                                <td><?php echo $e_req['hotel_enquiry_request_id'] ?></td>
                                                                <!-- <td>
                                                                    <button class="btn btn-secondary_<?php echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                                                                        data-toggle="popover"><i class="fa fa-eye"></i></button>
                                                                </td> -->
                                                                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo  $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                                                <td>
                                                                    <?php echo $e_req['room_type_name']?>
                                                                </td>   
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="#"><span class="badge badge-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="">Accepted</span>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Requirement</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo  $e_req['requirement'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>

                            
                        </tbody>
                    </table>
                </div>
    </div>




    <div class="rejected_orders_div" style="display: none;">
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
                        <thead>
                            <tr>
                            <th><strong>Sr. No.</strong></th>
                                                        <th><strong>Guest Name</strong></th>
                                                        <th><strong>Phone No.</strong></th>
                                                        <th><strong>Email</strong></th>
                                                        <th><strong>Check-In</strong></th>
                                                        <th><strong>Check-Out</strong></th>
                                                        <th><strong>Enquiry ID</strong></th>
                                                        <th><strong>Requirement</strong></th>

                                                        <!-- <th><strong>Room Name</strong></th> -->
                                                        <th><strong>Selected Room Type</strong></th>
                                                        <th><strong>Status</strong></th>

                        </thead>
                        <tbody class="">
                        <?php

                                                    $i = 1;
                                                    if($list2)
                                                    {
                                                        foreach($list2 as $e_req)
                                                        {
                                                            $user_data = $this->MainModel->get_user_data($e_req['u_id']);
                                                        
                                                            if($user_data)
                                                            {
                                                ?> 
                                                            <tr class="sub-container">
                                                                <td><strong><?php echo $i++?></strong></td>
                                                                <td><?php echo $user_data['full_name'] ?></td>
                                                                <td><?php echo $user_data['mobile_no'] ?></td>
                                                                <td><?php echo $user_data['email_id'] ?></td>
                                                                <td><?php echo $e_req['check_in_date'] ?></td>
                                                                <td><?php echo $e_req['check_out_date'] ?></td>
                                                                <td><?php echo $e_req['hotel_enquiry_request_id'] ?></td>
                                                                <!-- <td>
                                                                    <button class="btn btn-secondary_<?php echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                                                                        data-toggle="popover"><i class="fa fa-eye"></i></button>
                                                                </td> -->
                                                                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo  $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                                                <td>
                                                                    <?php echo $e_req['room_type_name']?>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <!-- <a href="#"><span class="badge badge-success"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target=".bd-example-modal-sm">Accepted</span>
                                                                        </a> -->
                                                                        <a href="#"><span class="badge badge-danger">Rejected</span></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade bd-terms-modal-sm1_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo  $e_req['requirement'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
         
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
<?php } elseif($icon_id == 2) { ?>
    
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-xl-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">All Rooms</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="guest-calendar">
                        <div id="reportrange" class="pull-right reportrange" style="width: 100%">
                            <span></span><b class="caret"></b>
                            
                        </div>
                    </div>
                  

                </div>
                <table id="example1"
                    class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list card-table display  shadow-hover table-responsive-lg  no-footer">
                    <thead>
                        <tr>
                            <th>Floor No.</th>
                            <th>Booked Rooms</th>
                            <th>Available Rooms</th>
                            <th>Dirty Rooms</th>
                            <th>Under Maintenance</th>
                        </tr>
                    </thead>
                    <tbody id="geeks">
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
                                <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                                <?php
                                    $admin_id = $this->session->userdata('u_id');

                                    $room_no = $this->HotelAdminModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                    if($room_no)
                                    {
                                        foreach ($room_no as $rn) 
                                        {
                                            $wh = '(room_no = "'.$rn['room_no'].'" AND room_status = 2 AND hotel_id = "'.$admin_id.'")';

                                            $room_status = $this->HotelAdminModel->getData('room_status',$wh);

                                            if($room_status)
                                            {
                                ?>
                                            <div class="room_card card" style="background:#7cc142;height: 40px;width: 40px;font-size: 18px;">
                                                <span class="room_no " style="margin-top: 5px;"><?php echo $room_status['room_no']?></span>
                                            </div>
                                <?php
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "Room Not Available";
                                    }
                                ?>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                                <?php
                                    $admin_id = $this->session->userdata('u_id');

                                    $room_no = $this->HotelAdminModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                    if($room_no)
                                    {
                                        foreach ($room_no as $rn) 
                                        {
                                            $wh1 = '(room_no = "'.$rn['room_no'].'" AND room_status = 3 AND hotel_id = "'.$admin_id.'")';

                                            $room_status1 = $this->HotelAdminModel->getData('room_status',$wh1);

                                            if($room_status1)
                                            {
                                ?>
                                            <div class="room_card card" style="background:#a9ada6;height: 40px;width: 40px;font-size: 18px;">
                                                <span class="room_no "style="margin-top: 5px;"><?php echo $room_status1['room_no']?></span>
                                            </div>
                                <?php
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "Room Not Available";
                                    }
                                ?>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                                <?php
                                    $admin_id = $this->session->userdata('u_id');

                                    $room_no = $this->HotelAdminModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                    if($room_no)
                                    {
                                        foreach ($room_no as $rn) 
                                        {
                                            $wh2 = '(room_no = "'.$rn['room_no'].'" AND room_status = 1 AND hotel_id = "'.$admin_id.'")';

                                            $room_status2 = $this->HotelAdminModel->getData('room_status',$wh2);

                                            if($room_status2)
                                            {
                                ?>      
                                            <div class="room_card card" style="background:#35c0f0;height: 40px;width: 40px;font-size: 18px;">
                                                <span class="room_no "style="margin-top: 5px;"><?php echo $room_status2['room_no']?></span>
                                            </div>
                                <?php
                                            }
                                        }
                                    }
                                    else
                                    {
                                        echo "Room Not Available";
                                    }
                                ?>
                                </div>
                            </td>
                            <td>
                                <div style="display:flex;flex-wrap: wrap;justify-content: center;">
                                <?php
                                    $admin_id = $this->session->userdata('u_id');

                                    $room_no = $this->HotelAdminModel->get_room_nos_floor_wise($admin_id,$fl['floor_id']);

                                    if($room_no)
                                    {
                                        foreach ($room_no as $rn) 
                                        {
                                            $wh3 = '(room_no = "'.$rn['room_no'].'" AND room_status = 4 AND hotel_id = "'.$admin_id.'")';

                                            $room_status3 = $this->HotelAdminModel->getData('room_status',$wh3);

                                            if($room_status3)
                                            {
                                ?>      
                                            <div class="room_card card" style="background:#ec1c24;height: 40px;width: 40px;font-size: 18px;">
                                                <span class="room_no "style="margin-top: 5px;"><?php echo $room_status3['room_no']?></span>
                                            </div>
                                <?php
                                            }
                                        }
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
                    <tfoot></tfoot>
                </table>
              
              

            </div>
        </div>
    </div>
</div>
            
    <?php } elseif($icon_id == 4){ ?>
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Floor List</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <!-- <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div> -->
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Floor</button>
                            <br><br>
                             <div class="modal fade" id="exampleModalCenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Floor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/add_floor')?>" method="post">
                                <div class="modal-body">
                                    <div class="col-md-12 form-group">
                                        <label class="form-label">Floor No.</label>
                                        <input type="number" name="floor" id="floor" onkeyup="check_entry()" class="form-control" placeholder="Enter Floor No." required="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                                        <th><strong>Sr. No.</strong></th>
                                        <th><strong>Floor</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $fl)
                                        {
                                ?>
                                
                                    <tr>
                                        <td><strong><?php echo $i++?></strong></td>
                                        <td>
                                            <span class="w-space-no"><?php echo $fl['floor'] ?></span>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning shadow btn-xs sharp me-1"
                                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $fl['floor_id'] ?>"><i
                                                    class="fa fa-pencil"></i></a>
                                            <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                            <a href="#" onclick="delete_data(<?php echo $fl['floor_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>

                                      
                                        <!-- edit modal -->
                                        <div class="modal fade bd-example-modal-lg_<?php echo $fl['floor_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm slideInRight animated">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Floor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 ">
                                                            <form action="<?php echo base_url('HoteladminController/edit_floor')?>" method="post">
                                                                <input type="hidden" name="floor_id" value="<?php echo $fl['floor_id'] ?>">
                                                                <div class="col-md-12 form-group">
                                                                    <label class="form-label">Floor No.</label>
                                                                    <input type="number" name="floor" id="floor1"  value="<?php echo $fl['floor'] ?>" class="form-control" placeholder="" required>
                                                                </div>
                                                                <br>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-info">Update Floor</button>
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="modal-footer">
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <!-- /. edit modal -->
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
        <?php } elseif($icon_id == 5){ ?>
            <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    
    <div class="col-md-12">
        <div class="card card-topline-aqua">
       
                    
            <div class="card-head">
                <header>List Of Room Type</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Room Type</button>
        
           <br>
           <br>
                    <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Room Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>  
                            <form action="<?php echo base_url('HoteladminController/add_room_type')?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="col-md-12 mb-3 form-group">
                                        <label class="form-label">Room Type</label>
                                        <input type="text" name="room_type_name" id="room_type_name" onkeyup="check_entry()" class="form-control" placeholder="Enter Room Type" required="">
                                    </div>
                                    <div class="col-md-12 mb-3 form-group">
                                        <label class="form-label">Room Type Price</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Enter Room Type Price" required="">
                                    </div>
                                    <div class="col-md-12 mb-3 form-group">
                                        <label class="form-label">Luxurious tax ( In % )</label>
                                        <input type="number" name="lux_tax" class="form-control" placeholder="" required="">
                                    </div>  
                                    <div class="col-md-12 mb-3 form-group">
                                        <label class="form-label">Service tax ( In % )</label>
                                        <input type="number" name="serv_tax" class="form-control" placeholder="" required="">
                                    </div>   
                                    <div class="col-md-12 mb-3 form-group">
                                        <label class="form-label">Upload image</label>
                                        <input type="file" name="image" accept="image/jpeg, image/png," class="form-control" required="">
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>            
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Room Type</strong></th>
                        <th><strong>Room Type Price</strong></th>
                        <th><strong>Luxury Tax</strong></th>
                        <th><strong>Service Tax</strong></th>
                        <th><strong>Room Type Image</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $r_m)
                                        {
                                ?>
                                
                                    <tr>
                                        <td><strong><?php echo $i++ ?></strong></td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['room_type_name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['price'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['lux_tax'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['serv_tax'] ?></span>
                                        </td>
                                        <td>
                                            <div class="lightgallery"
                                                class="room-list-bx d-flex align-items-center">
                                                <a href="<?php echo $r_m['images']?>"
                                                    data-exthumbimage="<?php echo $r_m['images']?>"
                                                    data-src="<?php echo $r_m['images']?>"
                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                    <img class="me-3 "
                                                        src="<?php echo $r_m['images']?>"
                                                        alt="" style="width:50px; height:40px;">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning shadow btn-xs sharp me-1"
                                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $r_m['room_type_id'] ?>"><i
                                                    class="fa fa-pencil"></i></a>
                                            <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                            <a href="#" onclick="delete_data_room(<?php echo $r_m['room_type_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>
                                                    <div class="modal fade bd-example-modal-lg_<?php echo $r_m['room_type_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md slideInRight animated">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Room Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12 ">
                                                <form action="<?php echo base_url('HoteladminController/edit_room_type')?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="room_type_id" value="<?php echo $r_m['room_type_id'] ?>">
                                                  
                                                  <div class="row">
                                                    
                                                 
                                                    <div class="col-md-6 form-group">
                                                        <label class="form-label">Room Type</label>
                                                        <input type="text" name="room_type_name" id="room_type_name1" onkeyup="check_entry1()" value="<?php echo $r_m['room_type_name'] ?>" class="form-control" placeholder="" required>
                                                    </div>
                                                    <div class="col-md-6  form-group">
                                                        <label class="form-label">Room Type Price</label>
                                                        <input type="number" name="price" id="price" value="<?php echo $r_m['price'] ?>" class="form-control" placeholder="" required>
                                                    </div>
                                                     </div>
                                                    <div class="row ">
                                                    <div class="col-md-6 mt-3 form-group">
                                                        <label class="form-label">Luxurious tax ( In % )</label>
                                                        <input type="number" name="lux_tax" id="lux_tax" value="<?php echo $r_m['lux_tax'] ?>" class="form-control" placeholder="" required>
                                                    </div>
                                                    <div class="col-md-6 mt-3 form-group">
                                                        <label class="form-label">Service tax ( In % )</label>
                                                        <input type="number" name="serv_tax" id="serv_tax" value="<?php echo $r_m['serv_tax'] ?>" class="form-control" placeholder="" required>
                                                    </div>
                                                  </div>
                                                    
                                                    <div class="col-md-12 mt-3 form-group">
                                                        <label class="form-label">Upload image</label>
                                                        <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $r_m['images']?>">
                                                    </div>
                                                    <br>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-info">Update Room Type</button>
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
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
            <?php } elseif($icon_id == 6){ ?>
            <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    
    <div class="col-md-12">
        <div class="card card-topline-aqua">
       
                    
            <div class="card-head">
                <header><span class="page_header_title1">Room Configure</span></header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="add_div_view">
            <div class="m-4">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
           
            <?php
                            $admin_id = $this->session->userdata('u_id');

                            if($room_type)
                            {
                                foreach($room_type as $r_m)
                                {
                                    $total_rooms = $this->MainModel->get_total_room_count($admin_id,$r_m['room_type_id']);
                        ?>
                                    <div class="col">
                                        <div class="room_card">
                                            <div class="demo">
                                                <img src="<?php echo $r_m['images']?>"
                                                    class="card-img-top" alt="..." height="151px;">
                                                <div class="card-body" style="position:unset !important">
                                                    <div class="overlay"></div>
                                                    <div class="button" style="top:41px"><a href="#" data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-xl_<?php echo $r_m['room_type_id']?>"> Add </a></div>
                                                    <!-- <button type="button" class="btn btn-primary mb-2" >Large modal</button> -->
                                                    <div class="button ">
                                                  
                                                    <!-- <a  href="#" onclick="orderserviceview(<?php echo $r_m['room_type_id']?>)" >View</a> -->
                                                    <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 room_id" data-bs-toggle="modal" room-id=<?= $r_m['room_type_id']?> data-bs-target=".bd-view-modal">View
                                                                        </a>
                                                    </div>
                                                    <h6><?php echo $r_m['room_type_name']?></h6>
                                                    <h6>Total Rooms: <?php echo $total_rooms[0]['total_room']?></h6>
                                                </div>
                                                <!-- <div class="card-footer">
                                            <small class="text-muted">Last updated 5 mins ago</small>
                                            </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- add mmodel -->
                                    <div class="modal fade bd-example-modal-xl_<?php echo $r_m['room_type_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Room </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo base_url('HoteladminController/add_rooms')?>" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3 form-group">
                                                                <label class="form-label">Select Floor No.</label>
                                                                <select id="inputState" name="floor_id" class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($floor_list)
                                                                        {
                                                                            foreach($floor_list as $f_l)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $f_l['floor_id']?>"><?php echo $f_l['floor']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>

                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Room No.</label>
                                                                <input type="text" name="room_no[]" class="form-control" placeholder="" required="">
                                                            </div>
                                                            <div class="mb-3 col-md-3 form-group">
                                                                <label class="form-label">Type of room</label>
                                                                <input type="hidden" name="room_type" value="<?php echo $r_m['room_type_id']?>" class="form-control" placeholder="">
                                                                <input type="text" value="<?php echo $r_m['room_type_name']?>" class="form-control" placeholder="" readonly>

                                                                <!-- <select id="inputState" class="default-select form-control wide" style="display: none;">
                                                                    <option selected="">Choose...</option>
                                                                    <option>Single Room</option>
                                                                    <option>Double Room</option>
                                                                    <option>Deluxe Room </option>
                                                                    <option>Duplex Room </option>
                                                                </select> -->
                                                            </div>
                                                            <div class="mb-3 col-md-3 form-group">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" name="price" value="<?php echo $r_m['price']?>" class="form-control" placeholder="" readonly>
                                                            </div>
                                                            <div class="mb-3 col-md-9 form-group">
                                                                <label class="form-label">Facilties</label>
                                                                <input type="text" name="facility[]" class="form-control" placeholder="" data-role="tagsinput"  required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Room Details</label>
                                                                <textarea class="summernote" name="room_details" rows="4" id="comment" required=""></textarea>
                                                                <!-- <textarea class="form-control" rows="4" id="comment" required></textarea> -->
                                                            </div>

                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Upload Photos</label>
                                                                <input name="images[]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" multiple="multiple" />
                                                            </div>
                                                            <div class="text-center">
                                                                <!-- <button type="submit" class="btn btn-info" id="toastr-warning-top-right">Add
                                                                    Room</button> -->
                                                                <button type="submit" class="btn btn-info">Add
                                                                    Room</button>
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/. add mmodel  -->
                        <?php
                                }
                            }
                        ?>
            </div>
        </div>
                        </div>
                        <div class="modal fade bd-view-modal <?php echo $r_m['room_type_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width:130%">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">View Configuration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body view_Room_Id">

                        </div>
                    </form>
                </div>
            </div>
                        <div class="add_div_view2" style="display:none;">
                        <h3 class="text-center mb-3"> <?php echo $room_type_data['room_type_name']?> Room</h3>
                <?php
                    if($list)
                    {  
			            $admin_id = $this->session->userdata('u_id');
                  $i=1;

                        foreach($list as $r_c)
                        {
                          $i++;
			                $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                            
			                $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);

			                $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);

                ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                       <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                <div class="card-body p-4">
                                    <div class="  bootstrap-carousel">
                                        <div id="carouselExampleIndicators_<?php echo $i;?>" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                    data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                    data-bs-slide-to="1" aria-label="Slide 2" class="active"
                                                    aria-current="true"></button>
                                                <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                    data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                            </div>
                                            <div class="  carousel-inner">
                                                <?php
                                                                if($room_imgs)
                                                                {
                                                                  $j=1;
                                                                 // print_r($room_imgs);
                                                                    foreach($room_imgs as $ri)
                                                                    {
                                                            ?>
                                                                    <div class="carousel-item  <?php if($j==1){echo"active";}?>">
                                                                        <img class="d-block w-100"
                                                                            src="<?php echo $ri['images']?>"
                                                                            alt="First slide" style="height:400px;">
                                                                    </div>
                                                            <?php
                                                              $j++;
                                                                    }
                                                               }
                                                            ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleIndicators_<?php echo $i;?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleIndicators_<?php echo $i;?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                                
                                        <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                            <div class="product-detail-content">
                                                <div class="new-arrival-content pr">
                                                    <p class="fs-16"><strong>Description</strong>:&nbsp;&nbsp;
                                                    <p class="text-content">
                                                        <?php echo $r_c['room_details']?>
                                                    </p>

                                                 

                                                    <div class="d-flex flex-wrap">
                                                        <div class="mt-4 check-status">
                                                            <p class="d-block mb-2 fs-16"><strong>Room No.</strong></p>
                                                            <?php
                                                                if($room_number)
                                                                {
                                                                    foreach($room_number as $rn)
                                                                    {
                                                            ?>
                                                      
                                                                    <div class="view_room_card" style="display:inline-block;">
                                                                        <div class="room_card card red">
                                                                            <span class="room_no "><?php echo $rn['room_no']?></span>
                                                                        </div>
                                                                        </div>
                                                                    
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        <div class="mt-4 ms-3">
                                                            <p class="d-block mb-2 text-black fs-16"><strong>Price</strong></p>
                                                            <span class="font-w500 fs-24 text-black">
                                                                <div class="d-table mb-2 mt-2">
                                                                    <p class="price float-start d-block">Rs <?php echo $r_c['price']?></p>
                                                                    <!-- <p class=""><strong>20% off</strong></p> -->
                                                                </div>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-end flex-wrap mt-4">
                                                        <div class="filtaring-area me-3">

                                                        </div>
                                                    </div>
                                                    <div class="facilities">
                                                        <?php
                                                            if($room_facility)
                                                            {
                                                                foreach($room_facility as $rf)
                                                                {
                                                        ?>
                                                                    <a href="javascript:void(0);" class="btn btn-secondary light"><?php echo $rf['room_facility']?></a>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                        
                                                        
                                                    </div>

                                                    <div class="shopping-cart  mt-5">

                                                        <div class="d-flex" style="float:right">
                                                            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl_<?php echo $r_c['room_configure_id']?>"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <a href="#" onclick="delete_data_rooms(<?php echo $r_c['room_configure_id'] ?>)"
                                                                class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                   
                ?>


<?php
                    if($list)
                    {  
			            $admin_id = $this->session->userdata('u_id');

                        foreach($list as $r_c)
                        {
			                $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                            
			                $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);

			                $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
                            
                ?>
                            <div class="modal fade bd-example-modal-xl_<?php echo $r_c['room_configure_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Room Configure</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo base_url('HoteladminController/update_rooms')?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="room_configure_id" value="<?php echo $r_c['room_configure_id']?>">
                                                <div class="row">
                                                    <div class="mb-3 col-md-3 form-group">
                                                        <label class="form-label">Select Floor No.</label>
                                                        <select id="inputState" name="floor_id" class="default-select form-control wide">
                                                            <option value data-isdefault="true">Choose...</option>
                                                            <?php
                                                                if($floor_list)
                                                                {
                                                                    foreach($floor_list as $f_l)
                                                                    {
                                                            ?>
                                                                        <option <?php if($f_l['floor_id'] == $r_c['floor_id']){echo "Selected";}?> value="<?php echo $f_l['floor_id']?>"><?php echo $f_l['floor']?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6 form-group">
                                                        <label class="form-label">Room No.</label>
                                                        <input type="text" name="room_no[]" value="
                                                        <?php
                                                            $room_no = array();
                  
                                                            foreach($room_number as $rm)
                                                            {
                                                                $room_no[] = $rm['room_no'];
                                                            } 
                                                          
                                                            $room_no11 = implode(',',$room_no);
                                        
                                                            print_r($room_no11);
                                                        ?>" class="form-control">
                                                    </div>
                                                    <div class="mb-3 col-md-3 form-group">
                                                        <label class="form-label">Type of room</label>
                                                        <input type="hidden" name="room_type" value="<?php echo $r_c['room_type']?>" class="form-control" placeholder="">
                                                        <input type="text" value="<?php echo $room_type_data['room_type_name']?>" class="form-control" placeholder="" readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-3 form-group">
                                                        <label class="form-label">Price</label>
                                                        <input type="number" class="form-control" value="<?php echo $r_c['price']?>" name="price">
                                                    </div>
                                                    <div class="mb-3 col-md-9 form-group">
                                                        <label class="form-label">Facilties</label>
                                                        <input type="text"  data-role="tagsinput"   name="facility[]" value="
                                                        <?php
                                                            $room_fc = array();
                  
                                                            foreach($room_facility as $rf)
                                                            {
                                                                $room_fc[] = $rf['room_facility'];
                                                            } 
                                                          
                                                            $room_fc11 = implode(',',$room_fc);
                                        
                                                            print_r($room_fc11);
                                                        ?>" class="form-control">
                                                    </div>
                                                 
                                                    
                                               
                                             
                                                    <?php
                                                             
                                                            $j = 0;

                                                            if($room_imgs)
                                                            { 
                                                        ?>
                                                  
                                                  
                                                                  
                                                                   
                                                                    <label class="form-label">Upload Photos</label>
                                                  <div class="row">
                                                                    <?php
                                                                        foreach($room_imgs as $rm_i)
                                                                        {
                                                                    ?>
                                                                            <input type="hidden" name="room_img_id[]" value="<?php echo $rm_i['room_img_id']?>">
                                                                 
                                                                    
                                                              <div class="mb-3 col-md-4 ">
                                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $rm_i['images']?>">
                                                                     </div>
                                                                      
                                                                           <!-- <output id="Filelist"></output>-->
                                                                    <?php
                                                                            $j++;
                                                                        }
                                                                    ?>
                                                                
                                                                </div>
                                                     
                                                        <?php
                                                                
                                                            }
                                                        ?>
                                                    
                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label class="form-label">Room Details</label>
                                                        <textarea class="summernote" rows="4" id="comment" name="room_details"><?php echo $r_c['room_details']?></textarea>
                                                        <!-- <textarea class="form-control" rows="4" id="comment" required></textarea> -->
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-info">Update
                                                            Room</button>
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
                
                        </div>
                        
                        
                        
                        </div>
    </div>
            <?php }elseif($icon_id == 7){?>
                <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Business Center</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <!-- <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div> -->
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Business
                                        Center</button>
        
           <br>
           <br>    
           <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Business Center</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>  
                            <form action="<?php echo base_url('HoteladminController/add_business_center')?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Business Center type</label>
                                                                <input type="text" class="form-control" name="business_center_type"
                                                                    placeholder="Enter Business Center type" required>
                                                            </div>
                                                            <div class=" col-md-12 mb-12 form-group">
                                                                <label class="form-label">Center Capacity</label>
                                                                <small>(No.of.people)</small>
                                                                <input type="number" name="no_of_people" class="form-control" placeholder="Center Capacity"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-12 mb-12 form-group">
                                                                <label class="form-label">Price</label>
                                                                <input type="text" name="price" class="form-control"
                                                                    placeholder="Price" required>
                                                            </div>

                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Facilties</label>
                                                                <input type="text" name="facility_name[]"
                                                                    class="form-control" placeholder="Facilties"
                                                                    required>
                                                            </div>
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Upload Photos</label>

                                                                <input name="image[]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify"
                                                                    data-height="150" multiple />

                                                            </div>
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Center Description</label>
                                                                <textarea class="summernote" rows="3" name="description" id="comment"
                                                                    required=""></textarea>
                                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                   
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th>Sr. No.</th>
                        <th>Photo</th>
                        <th>Center Type</th>
                        <th> Capacity</th>
                        <th>Price(₹)</th>
                        <th>facilities</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $bus_c)
    {
        $wh = '(business_center_id = "'.$bus_c['business_center_id'].'")';

        $business_center_img = $this->HotelAdminModel->getData('business_center_images',$wh);
        if(!empty($business_center_img))
        {
           $business_image = $business_center_img['image'];
        }
        else
        {
            $business_image ='';
        }
?>

        <tr>
            <td><?php echo $i++ ?></td>
            <td>
                <div class="lightgallery"
                    class="room-list-bx d-flex align-items-center">
                    <a href="<?php echo $business_image?>"
                        data-exthumbimage="<?php echo $business_image?>"
                        data-src="<?php echo $business_image?>"
                        class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                            src="<?php echo $business_image?>"
                            alt="" style="width:50px; height:40px;">
                    </a>
                </div>
            </td>
            <td>
                <div>
                    <span class=" fs-16 font-w500 text-nowrap"><?php echo $bus_c['business_center_type']?></span>
                </div>
            </td>
            <td class="">
                <span class="fs-16 font-w500 text-nowrap"><?php echo $bus_c['no_of_people']?>
                    peoples</span>
            </td>
            <td class="">
                <span class="fs-16 font-w500 text-nowrap"><?php echo $bus_c['price']?></span>
            </td>
            <td class="">
                <a href="" data-bs-toggle="modal"
                    data-bs-target="#exampleModalCenter_<?php echo $bus_c['business_center_id']?>">
                    <span class="badge badge-outline-secondary">show
                        all</span></a>
            </td>
            <!-- facility  -->
            <div class="modal fade" id="exampleModalCenter_<?php echo $bus_c['business_center_id']?>" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">facilities</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="facilities">
                                <?php
                                    $wh = '(business_center_id = "'.$bus_c['business_center_id'].'")';

                                    $business_center_facility = $this->HotelAdminModel->getAllData('business_center_facility',$wh);

                                    if($business_center_facility)
                                    {
                                ?>
                                            <a href="javascript:void(0);" class="btn btn-secondary light">
                                            <?php 
                                                foreach($business_center_facility as $bus_fac)
                                                {
                                                    echo $bus_fac['facility_name'];
                                                }
                                            ?></a>
                                <?php
                                        
                                    }
                                ?>
                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/. facility  -->
            <!-- <td>
                <button class="btn btn-secondary_<?php //echo $bus_c['business_center_id']?> shadow btn-xs sharp"
                    data-toggle="popover"><i
                        class="fa fa-eye"></i></button>

            </td> -->
            <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $bus_c['business_center_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
            <td>
                <select onchange="change_status1(<?php echo $bus_c['business_center_id']?>)" id="status_<?php echo $bus_c['business_center_id']?>"
                    class="default-select form-control wide"
                    >
                    <option <?php if($bus_c['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                    <option <?php if($bus_c['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                </select>
            </td>
            <td>
                <a href="#"
                    class="btn btn-warning shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $bus_c['business_center_id']?>"><i
                        class="fa fa-pencil"></i></a>
                <a href="#" onclick="delete_data_business(<?php echo $bus_c['business_center_id'] ?>)"
                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
            
            <!-- edit modal -->
                <div class="modal fade bd-example-modal-lg_<?php echo $bus_c['business_center_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Center</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/edit_business_center')?>" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="col-12 ">
                                        <input type="hidden" name="business_center_id" value="<?php echo $bus_c['business_center_id']?>">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Business Center type</label>
                                                <input type="text" class="form-control" name="business_center_type" value="<?php echo $bus_c['business_center_type']?>">
                                            </div>
                                            <div class=" col-md-6 mb-3 form-group">
                                                <label class="form-label">Center Capacity</label>
                                                <small>(No.of.people)</small>
                                                <input type="text" class="form-control" name="no_of_people" value="<?php echo $bus_c['no_of_people']?>">
                                            </div>
                                            <div class="col-md-6 mb-3 form-group">
                                                <label class="form-label">Price</label>
                                                <input type="text" class="form-control" name="price" value="<?php echo $bus_c['price']?>">
                                            </div>

                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Facilties</label>
                                                <input type="text" name="facility_name[]" class="form-control"
                                                    value="<?php
                                                    
                                                    foreach($business_center_facility as $bus_fac)
                                                    {
                                                        echo $bus_fac['facility_name'];
                                                    }
                                                    ?>">
                                            </div>
                                            
                                            <div class="mb-3 col-md-12 form-group">
                                            <?php

                                                $j = 0;
                                                $business_center_imgs = $this->HotelAdminModel->getAllData('business_center_images',$wh);

                                                if($business_center_imgs)
                                                {
                                            ?>
                                                    <label class="form-label">Upload Photos</label>
                                            <?php
                                                    foreach($business_center_imgs as $bus_im)
                                                    {
                                            ?>
                                                        <input type="hidden" name="business_center_image_id[]" value="<?php echo $bus_im['business_center_image_id']?>">
                                                        <input name="image[<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" data-default-file="<?php echo $bus_im['image']?>"/>
                                            <?php
                                                        $j++;
                                                    }
                                                }
                                            ?>
                                            </div>
                                            
                                            <div class="mb-3 col-md-12 form-group">
                                                <label class="form-label">Center Description</label>
                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                    required=""><?php echo $bus_c['description']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">Update Center</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </td>
            <!--/. edit modal -->
        </tr>
        <div class="modal fade bd-terms-modal-sm_<?php echo $bus_c['business_center_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $bus_c['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
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
                <?php } elseif($icon_id == 8){?>
                    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header><span class="page_header_title12">List Of New Request</span></header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown2">
                                        <option value="new_orders2">New Request</option>
                                        <option value="accepted_order2">Reservation List</option>
                                     
                                    </select>                         
                                </div>
        
                                <button style="float:right" type="button" class="btn btn-primary css_btn"
                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">Add Reservation</button>
                                <br><br>
                                <div class="modal fade" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Reservation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    
                                    <form action="<?php echo base_url('HoteladminController/reserve_business_center')?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Guest Name</label>
                                                                <input type="text" name="client_name" class="form-control"
                                                                    placeholder="Name of client" required>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Mobile number</label>
                                                                <input type="text" name="client_mobile_no" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                                                    placeholder="Mobile number" required>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Type of center</label>
                                                                    <select id="inputState" name="business_center_type" class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                                                <label class="form-label"> Date</label>
                                                                <input type="date" name="event_date" class="form-control" placeholder=""
                                                                    required>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Event</label>
                                                                <input type="text" name="event_name" class="form-control"
                                                                    placeholder="Event" required>
                                                            </div>
                                                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                                                <label class="form-label">Time-in</label>
                                                                <input type="time" name="start_time" class="form-control"
                                                                    placeholder="Check time" required>
                                                            </div>
                                                            <div class="col-xl-3 col-xxl-6 col-md-6 mb-3">
                                                                <label class="form-label">Time-Out</label>
                                                                <input type="time" name="end_time" class="form-control"
                                                                    placeholder="Check time" required>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Upload ID proof</label>

                                                                <input type="file" name="id_proof_photo" class="   form-control"
                                                                    data-height="50" required>

                                                            </div>
                                                          
                                                          
                                                             <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Additional Note</label>
                                                                <textarea class="summernote" name="room_details" rows="4" id="comment" required=""></textarea>
                                                                <!-- <textarea class="form-control" rows="4" id="comment" required></textarea> -->
                                                            </div>
                                        </div>
                                                                    </div>
                                        <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add reservation</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            <div class="new_orders_div2">    
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                        <th><strong> Guest Name</strong></th>
                                                        <th><strong>Business Center Type</strong></th>
                                                        <th><strong>Capacity</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Time-in</strong></th>
                                                       <th><strong>Time-Out</strong></th>
                                                         <th><strong>Status</strong></th>
                                                        <th><strong>Note</strong></th>
                    </tr>
                        </thead>
                        <tbody id="searchTable">
                                                    <tr>
                                                        <td><strong>1</strong></td>
                                                        <td>
                                                            <span class="w-space-no">Harshada</span>
                                                        </td>
                                                        <td>Workshop</td>
                                                        <td>100</td>
                                                        <td>2022-12-29</td>
                                                        <td>02:56 pm</td>
                                                       <td>02:56 pm</td>
                                                      
                                                      <td>
                                                                        <select onchange="change_status(28)" id="status_28" class=" form-control" >
                                                                            <option selected="" value="1">New Order</option>
                                                                            <option value="0">Accept</option>
                                                                          <option value="0">Reject</option>
                                                                        </select>
                                                
                                                                    </td>
                                                      
                                                     <!-- <td>
                                                                <button class="btn btn-secondary shadow btn-xs sharp"
                                                                    data-toggle="popover"><i
                                                                        class="fa fa-eye"></i></button>

                                                            </td> -->
                                                            <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>

                                                        <!-- <td>
                                                                <div class="d-flex">
                                                                    <a href="#"
                                                                        class="btn btn-info shadow btn-xs sharp me-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".bd-example-modal-lg"><i
                                                                            class="fas fa-pencil-alt"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td> -->
                                                    </tr>
                                                    <div class="modal fade bd-terms-modal-sm1" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna  aliqua. Ut enim ad minim veniam" ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
                                                  
                                                </tbody>
                    </table>
                </div>
                                                    </div>


                                                    
                                                    <div class="accepted_orders_div2" style="display: none;">
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb2" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Guest Name</strong></th>
                        <th><strong>Guest Mobile No</strong></th>
                        <th><strong>Business Center Type</strong></th>
                        <th><strong>Event Name</strong></th>
                        <th><strong>Event Date</strong></th>
                        <th><strong>Event start time</strong></th>
                        <th><strong>Event start time</strong></th>
                        <th><strong>ID Proof</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                        $i = 1;
                                                        if($list)
                                                        {
                                                            foreach($list as $bu_r)
                                                            {
                                                    ?>
                                                    
                                                        <tr>
                                                            <td><strong><?php echo $i++?></strong></td>
                                                            <td>
                                                                <span class="w-space-no"><?php echo $bu_r['client_name']?></span>
                                                            </td>
                                                            <td><?php echo $bu_r['client_mobile_no']?></td>
                                                            <td><?php echo $bu_r['business_center_type_name']?></td>
                                                            <td><?php echo $bu_r['event_name']?></td>
                                                            <td><?php echo $bu_r['event_date']?></td>
                                                            <td><?php echo date('h:i a',strtotime($bu_r['start_time']))?></td>
                                                            <td><?php echo date('h:i a',strtotime($bu_r['end_time']))?></td>
                                                            <td>
                                                                <div class="lightgallery">
                                                                    <a href="<?php echo $bu_r['id_proof_photo']?>"
                                                                        data-exthumbimage="<?php echo $bu_r['id_proof_photo']?>"
                                                                        data-src="<?php echo $bu_r['id_proof_photo']?>"
                                                                        class="col-lg-3 col-md-6 mb-4">
                                                                        <img src="<?php echo $bu_r['id_proof_photo']?>" alt=""
                                                                            style="width:50px;">
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <!-- <td>
                                                                <div class="d-flex">
                                                                    <a href="#"
                                                                        class="btn btn-info shadow btn-xs sharp me-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".bd-example-modal-lg"><i
                                                                            class="fas fa-pencil-alt"></i></a>
                                                                    <a href="#"
                                                                        class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td> -->
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
                    <?php } elseif($icon_id == 9){?>
                        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Request</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

            <div class="row">
            <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control"
                                                            placeholder="2017-06-04">
                                                        <input type="text" class="form-control" placeholder="Request"
                                                            id="">
                                                        <button class="btn btn-warning  btn-sm "><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                    </div>
                <!-- <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div> -->
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                    <th><strong>Room No.</strong></th>
                                                    <th><strong>Guest Name</strong></th>
                                                    <th><strong>Request</strong></th>
                                                    <th><strong>Date</strong></th>
                                                    <th><strong>Time</strong></th>
                                                    <th><strong>Send To</strong></th>
                                                    <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <tr>
                                                    <td><strong>1</strong></td>
                                                    <td>
                                                        <span class="w-space-no">101</span>
                                                    </td>
                                                    <td>Harshada</td>
                                                    <td>Request for AC</td>
                                                    <td>22-02-2022</td>
                                                    <td>1:00 pm</td>
                                                    <td>Housekeeping </td>
                                                    <td>
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>1</strong></td>
                                                    <td>
                                                        <span class="w-space-no">101</span>
                                                    </td>
                                                    <td>Harshada</td>
                                                    <td>Request for AC</td>
                                                    <td>4-05-2022</td>
                                                    <td>1:00 pm</td>
                                                    <td>Housekeeping </td>
                                                    <td>
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                class="fa fa-trash"></i></a>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>1</strong></td>
                                                    <td>
                                                        <span class="w-space-no">101</span>
                                                    </td>
                                                    <td>Harshada</td>
                                                    <td>Request for AC</td>
                                                    <td>22-05-2022</td>
                                                    <td>4:00 pm</td>
                                                    <td>Housekeeping </td>
                                                    <td>
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>1</strong></td>
                                                    <td>
                                                        <span class="w-space-no">101</span>
                                                    </td>
                                                    <td>Harshada</td>
                                                    <td>Request for AC</td>
                                                    <td>5-02-2022</td>
                                                    <td>11:00 pm</td>
                                                    <td>Housekeeping </td>
                                                    <td>
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php } elseif($icon_id == 10){?>
       

                        <?php } elseif($icon_id == 11){ ?>
                            <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of Lost Item</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control"
                                                            placeholder="2017-06-04">
                                                        <input type="text" class="form-control" placeholder="Room No."
                                                            id="">
                                                        <button class="btn btn-warning  btn-sm "><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th>Sr. No.</th>
                                                    <th>Room No.</th>
                                                    <th>Guest Name</th>
                                                    <th>Contact number</th>
                                                    <th>Date</th>
                                                    <th>Lost OR Found Item</th>
                                                    <th>Item Photo</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $lost_f)
    {
        if($lost_f['lost_item_name'])
        {
            $found_lost_item_name = $lost_f['lost_item_name'];
        }
        else
        {
            if($lost_f['found_item_name'])
            {
                $found_lost_item_name = $lost_f['found_item_name'];
            }
        }
?>
        <tr>
            <td><strong><?php echo $i++?></strong></td>
            <td><?php echo $lost_f['room_no'] ?></td>
            <td><?php echo $lost_f['guest_name'] ?></td>
            <td><?php echo $lost_f['contact_no'] ?></td>
            <td><?php echo $lost_f['lost_found_date'] ?></td>
            <td><?php echo $found_lost_item_name ?></td>
            <td>
                <div class="lightgallery">
                    <a href="<?php echo $lost_f['img'] ?>"
                        data-exthumbimage="<?php echo $lost_f['img'] ?>"
                        data-src="<?php echo $lost_f['img'] ?>"
                        class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 rounded"
                            src="<?php echo $lost_f['img'] ?>" alt=""
                            style="width:80px; height:40px;">
                    </a>
                </div>
            </td>
            <!-- <td>
                <button class="btn btn-secondary_<?php echo $lost_f['id'] ?> shadow btn-xs sharp"
                    data-toggle="popover"><i class="fa fa-eye"></i></button>
            </td> -->
            <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $lost_f['id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
            <td>

                <a href="#" onclick="delete_data_lost(<?php echo $lost_f['id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
            </td>
        </tr>
        <div class="modal fade bd-terms-modal-sm_<?php echo $lost_f['id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $lost_f['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
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
                            <?php } elseif($icon_id == 12){?>
                                <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of Expenses</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Expenses
                                        </button>
        
           <br>
           <br>    
           <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Expenses</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>  
                            <form action="<?php echo base_url('HoteladminController/add_expenses')?>" method="post">
                            <div class="card-body">
                                                        <div class="row">
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="guest_name" class="form-control" placeholder="Name"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Contact Number</label>
                                                                <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Booking ID</label>
                                                                <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Expense Amount</label>
                                                                <input type="number" name="expense_amt" class="form-control" placeholder="Expense Amount"
                                                                    required="">
                                                            </div>

                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Date</label>
                                                                <input type="date" name="date" class="form-control" placeholder=""
                                                                    required="">
                                                            </div>

                                                            <div class="mb-12 col-md-12 form-group">
                                                                <label class="form-label">Expenses Details</label>
                                                                <textarea class="summernote" name="description" rows="4" id="comment"
                                                                    required=""></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-info">Add
                                                                Expenses</button>
                                                            <!-- <button type="button" class="btn btn-light">Cancel</button> -->
                                                        </div>
                                                    </div>
                            </form>
                        </div>
                    </div>
                </div>                   
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                            <th><strong>Date</strong></th>
                                                            <th><strong>Name</strong></th>
                                                            <th><strong>Contact No</strong></th>
                                                            <th><strong>Expenses </strong></th>
                                                            <th><strong>Details</strong></th>
                                                            <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $exp)
    {
?>
        <tr>
            <td><?php echo $i++?></td>
            <td><?php echo $exp['date']?></td>
            <td><?php echo $exp['guest_name']?></td>
            <td><?php echo $exp['mobile_no']?></td>
            <td><?php echo $exp['expense_amt']?> Rs</td>
            <!-- <td>
                <button class="btn btn-secondary_<?php echo $exp['expense_id']?> shadow btn-xs sharp"
                    data-toggle="popover"><i
                        class="fa fa-eye"></i></button>
            </td> -->
            <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $exp['expense_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
            <td>
                <a href="#"
                    class="btn btn-warning shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $exp['expense_id']?>"><i
                        class="fa fa-pencil"></i></a>
                <a href="#" onclick="delete_data_exp(<?php echo $exp['expense_id'] ?>)"
                    class="btn btn-danger shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
                        <div class="modal fade bd-example-modal-lg_<?php echo $exp['expense_id']?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Expenses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="<?php echo base_url('HoteladminController/edit_expenses')?>" method="post">
                            <input type="hidden" name="expense_id" value="<?php echo $exp['expense_id']?>">
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="guest_name" value="<?php echo $exp['guest_name']?>" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" maxlength="10" name="mobile_no" value="<?php echo $exp['mobile_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Booking ID</label>
                                                <input type="text" value="<?php echo $exp['booking_id']?>" class="form-control" readonly>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Expense Amount</label>
                                                <input type="number" name="expense_amt" value="<?php echo $exp['expense_amt']?>" class="form-control">
                                            </div>

                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Date</label>
                                                <input type="date" name="date" value="<?php echo $exp['date']?>" class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-12 form-group">
                                                <label class="form-label">Expenses Details</label>
                                                <textarea class="summernote" name="description" rows="4" id="comment"><?php echo $exp['description']?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </td>
            <!-- edit schedule -->
           
            <!--/. edit schedule   -->
        </tr>
        <div class="modal fade bd-terms-modal-sm_<?php echo $exp['expense_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $exp['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
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
                                <?php } elseif($icon_id == 13){ ?>
                                    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Visitors</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
            <div class="col-md-4">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control"
                                                            placeholder="2017-06-04">
                                                        <input type="time" class="form-control" placeholder=" No."
                                                            id="">
                                                        <button class="btn btn-warning  btn-sm "><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                    <th><strong>Visitor Name</strong></th>
                                                    <th><strong>No.of Visitor</strong></th>

                                                    <th><strong>Visiting Date</strong></th>
                                                    <th><strong>Visiting Time</strong></th>
                                                    <th><strong>Contact No.</strong></th>
                                                    <th><strong> Guest Name</strong></th>
                                                    <!-- <th><strong>Floor</strong></th> -->
                                                    <th><strong> Room No.</strong></th>
                                                    <th><strong>OTP</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $vis) 
    {
        $user_data = $this->HotelAdminModel->get_user_data($vis['u_id']);

        if($user_data)
        {

?>
        <tr>
            <td><strong><?php echo $i++?></strong></td>
            <td><?php echo $vis['visitor_name']?></td>
            <td><?php echo $vis['no_of_visitor']?></td>
            <td><?php echo $vis['visit_date']?></td>
            <td><?php echo date('h:i a',strtotime($vis['visit_time']))?></td>
            <td><?php echo $user_data['mobile_no']?></td>
            <td><?php echo $user_data['full_name']?></td>
            <td><?php echo $vis['room_no']?></td>
            <td>
                <?php
                    if($vis['is_otp_verified'] == 0)
                    {
                        
                ?>
                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                            data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-lg_<?php echo $vis['visitor_id']?>"><i
                                class="fa fa-unlock-alt text-white"></i></a>
                <?php
                    }
                    else
                    {
                        if($vis['is_otp_verified'] == 1 && $vis['is_otp_correct'] == 1)
                        {
                ?>
                            <span class="badge badge-success">Success</span>
                <?php
                        }
                        else
                        {
                            if($vis['is_otp_verified'] == 2 && $vis['is_otp_correct'] == 2)
                            {
                ?>
                                <span class="badge badge-danger" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg_<?php echo $vis['visitor_id']?>">Fail</span>
                <?php
                            }
                        }
                    }
                ?>
                <!-- edit modal -->
                <div class="modal fade bd-example-modal-lg_<?php echo $vis['visitor_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">OTP Configuration</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/check_visitor_otp')?>" method="post">
                                <input type="hidden" name="visitor_id" value="<?php echo $vis['visitor_id']?>">
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Enter OTP</label>
                                            <input type="number" name="otp" class="form-control" placeholder="OTP" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Check</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
            </td>
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
    <?php }elseif($icon_id == 14){  ?>
      
        <script src="<?php echo base_url('assets/plugins/steps/jquery.steps.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/steps/steps-data.js')?>"></script>
    

	<script src="<?php echo base_url('assets/plugins/jquery-toast/dist/jquery.toast.min.js')?>"></script>
	<script src="<?php echo base_url('assets/plugins/jquery-toast/dist/toast.js')?>"></script>
    				<!-- basic wizard -->
					<div class="row">
                        
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>
Night Audit
</header>
								</div>
								<div class="card-body ">
                                    
                                    <div class="row "> 
                                        <div class=" col-xl-4 offset-xl-4 text-center mb-3">
                                            <input type="text" style="width:130px;height:47px;border-radius:5px;background:#0275d8;color:#fff;text-align:center" value="10/10/2022" >
                                            
                                            <button type="button" class="btn btn-primary css_btn btn-lg">Settle</button>
                                        </div>
                                    </div>
									<div id="wizard">
										<h1>Room Status</h1>
										
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Room Status</header>
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
                                                        
                                                            <table id="example11" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                    <!-- <th>Sr.No.</th> -->
                                                                    <th>Room No</th>
                                                                    <th>Room Type</th>
                                                                    <th>Guest</th>
                                                                    <th>Check In</th>
                                                                    <th>Check Out</th>
                                                                    <th>Total(Rs)</th>
                                                                    <th>Balance(Rs)</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge light badge-primary">Stayover</span>
                                                                </td>
                                                                <td>
                                                             
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                   

                                                                

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span class="badge light badge-info">Dueout</span>
                                                                </td>
                                                                <td>
                                                                <div class="d-flex ">
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <button class="tstTopCenter btn btn-info ms-2" title="Check Out"> <i class="fa fa-check"></i></button>

                                                                </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>103 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mrs.Monika Bing</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge light badge-success">Arrived</span>
                                                                </td>
                                                                <td>
                                                              
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    

                                                                

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>104</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Joey Tribbiani</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <span class="badge light badge-danger">Day
                                                                        Use</span>
                                                                </td>
                                                                <td>
                                                                <div class="d-flex ">
            
                                                                    <button id="addRow1" class="btn btn-secondary add_facility">
                                                                        <i class="fa fa-ellipsis-h"></i>
                                                                    </button>
                                                                    <button class="tstTopCenter btn btn-info ms-2" title="Check Out"> <i class="fa fa-check"></i></button>

                                                                </div>

                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       

										<h1>Room Service</h1>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Room Services</header>
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
                                                        
                                                            <table id="example12" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Housekeeping</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Housekeeping</header>
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
                                                        
                                                            <table id="example13" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Food & Beverages</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Food & Beverages</header>
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
                                                        
                                                            <table id="example14" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h1>Other Services</h1>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-topline-aqua">
                                                    <div class="card-head">
                                                        <header>List Of Other Services</header>
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
                                                        
                                                            <table id="example15" class="display full-width">
                                                                <thead>
                                                                    <tr>
                                                                        <!-- <th>Sr.No.</th> -->
                                                                        <th>Room No</th>
                                                                        <th>Room Type</th>
                                                                        <th>Guest</th>
                                                                        <th>Check In</th>
                                                                        <th>Check Out</th>
                                                                        <th>Service</th>
                                                                        <th>Total(Rs)</th>
                                                                        <th>Paid(Rs)</th>
                                                                        <th>Balance(Rs)</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="append_data">
                                                                <tr>
                                                                <td>
                                                                    <h5>101 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr. Paul Walker</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Expence</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5>102 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Dulex</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Mr.Ross Geller </h5>
                                                                </td>
                                                                <td>
                                                                    <h5>03/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>05/10/2022</h5>
                                                                </td>
                                                                <td>
                                                                    <h5>Car Wash</h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4500 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>
                                                                <td>
                                                                    <h5><i class="fa fa-rupee"></i>4000 </h5>
                                                                </td>

                                                            </tr>
                                                                
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
			</div>

            <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Amend Stay</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row"  style="margin: 10px;">
                            <div class="col-md-6">
                                <div class="row" style=" border: 1px solid grey;">
                                    <div>
                                        <h5> Miss.Abita </h5>
                                    </div>
                                    <div>
                                        <i class="fa fa-phone"></i>
                                        <span>8877665544</span> &nbsp;

                                        <i class="fa fa-envelope"></i>
                                        <span>abc@gmail.com</span>
                                    </div>

                                </div>
                                <div class="row" style=" border: 1px solid grey;">
                                    <div class=" p-5">
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Status</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold  fs-6 text-gray-800">Stayover</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Check in</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold  fs-6 text-gray-800">13/10/2022</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Check Out
                                            </label>
                                            <div class="col-lg-8 col-6 d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">15/10/2022</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Room No</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">103</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Room Type
                                            </label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">Dulex</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Adult</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">2</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">Childs</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800">0</span>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label class="col-lg-4 col-6 fw-semibold text-muted">
                                                Room Allownce</label>
                                            <div class="col-lg-8 col-6">
                                                <span class="fw-bold fs-6 text-gray-800"> <i
                                                        class="fa fa-rupee"></i>4000</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style=" border: 1px solid grey;">
                                <div class="row">
                                    <div>
                                        <h5>Amend Stay</h5>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Check In :</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="10/10/2022"
                                                onfocus="(this.type = 'date')" class="date" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Check Out:</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="10/10/2022"
                                                onfocus="(this.type = 'date')" class="date">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-4 col-6 fw-semibold text-muted">Room Rate :</label>
                                        <div class="col-lg-8 col-6">
                                            <input type="text" class="form-control" placeholder="Enter Amount">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="footer">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row mb-2">
                                    <label class="col-lg-8 col-6 fw-semibold text-muted" style="text-align: right;">Total</label>
                                    <div class="col-lg-4 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>45000</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-8 col-6 fw-semibold text-muted" style="text-align: right;">Paid</label>
                                    <div class="col-lg-4 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>0.00</span>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-lg-8 col-6 fw-semibold text-muted" style="text-align: right;">Balance</label>
                                    <div class="col-lg-4 col-6">
                                        <span class="fw-bold  fs-6 text-gray-800"> <i
                                                class="fa fa-rupee"></i>45000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 30px;">
                                <div class="mt-5">
                                    <button type="button" class="btn btn-primary css_btn">Save</button>
                                    <button type="button" class="btn btn-light css_btn"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    </form>
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
</script>



            
 <?php }elseif($icon_id == 15){  ?>

    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Hotel Guide</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card">
                    <div class="card-body">
                        <?php
        $admin_id = $this->session->userdata('u_id');

        $data = $this->HotelAdminModel->get_hotel_guidelines($admin_id);
                            $content = "";

                            if($data)
                            {
                                $content = $data['content'];
                            }
                        ?>
                        <form action="<?php echo base_url('HoteladminController/add_hotel_guidelines')?>" method="post">
                            <div class="row">
                                <div class="col-xl-12 col-xxl-12">
                                    <textarea class="summernote" style="width:100%;heigth:200px!important;" name="content" value="<?php echo $content ?>" rows="20" id="comment" required=""></textarea>
                                </div>
                            </div><br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>



                                    <?php }elseif($icon_id == 16){  ?>
                                        <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of Raise Dispute</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <!-- <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                 -->
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                    <th><strong>Booking Id</strong></th>
                                                    <th><strong>Room No.</strong></th>
                                                    <th><strong>Guest Name</strong></th>
                                                    <th><strong>Email Id</strong></th>
                                                    <th><strong>Mobile No.</strong></th>
                                                    <th><strong>Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

        <tr>
        <td><strong>1</strong></td>
                                                    <td>
                                                        <span class="w-space-no">289</span>
                                                    </td>
                                                    <td>111</td>
                                                    <td>Harshada</td>
                                                    <td>harshada@gmail.com</td>
                                                    <td>9876787678</td>
                                                    <td>
                                                        <select id="inputState" class="default-select form-control wide"
                                                            >
                                                            <option>In-progress</option>
                                                            <option>Completed</option>
                                                        </select>

                                                    </td>
            
        </tr>

     
          
        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                              <?php } ?>

                                    <script>
    $(document).ready(function() {

        <?php

            if($list)
            {
                foreach($list as $e_req)
                {
                    // print_r($e_req);die;
        ?>
                    $('.btn-secondary_<?php echo $e_req['hotel_enquiry_request_id']?>').popover({
                        title: "Description",
                        content: "<?php echo $e_req['requirement']?>",
                        trigger: "focus"
                    });
        <?php
                }
            }
        ?>
    });
    </script>
 
   
     <script>
       
    // $('.delete').click(function() {
    function delete_data(id)
    {
        var id = id;
        var base_url = '<?php echo base_url()?>';

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: 
            {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-success'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.ajax({
                        url     : base_url + "HoteladminController/delete_floor",
                        method  : "post",
                        data    : {id : id},
                        success : function(data)
                                {
                                    // alert(data);
                                    if(data == 1)
                                    {
                                        swalWithBootstrapButtons.fire(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                ).then((result) =>
                                                {
                                                    location.reload();
                                                })
                                    }
                                }

                    });
            } 
            else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })

    }
    </script>
     <script>
    // $('.delete').click(function() {
    function delete_data_room(id)
    {
        var id = id;
        var base_url = '<?php echo base_url()?>';

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: 
            {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-success'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => 
        {
            if (result.isConfirmed) 
            {
                $.ajax({
                        url     : base_url + "HoteladminController/delete_room_type",
                        method  : "post",
                        data    : {id : id},
                        success : function(data)
                                {
                                    // alert(data);
                                    if(data == 1)
                                    {
                                        swalWithBootstrapButtons.fire(
                                                    'Deleted!',
                                                    'Your file has been deleted.',
                                                    'success'
                                                ).then((result) =>
                                                {
                                                    location.reload();
                                                })
                                    }
                                }

                    });
            } 
            else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })

    }
    </script>

            <script>
            // $('.delete').click(function() {
                function delete_data_lost(id)
                {
                    var id = id;
                    var base_url = '<?php echo base_url()?>';

                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: 
                        {
                            confirmButton: 'btn btn-danger',
                            cancelButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => 
                    {
                        if (result.isConfirmed) 
                        {
                            $.ajax({
                                    url     : base_url + "HoteladminController/delete_lost_found_list",
                                    method  : "post",
                                    data    : {id : id},
                                    success : function(data)
                                            {
                                                // alert(data);
                                                if(data == 1)
                                                {
                                                    swalWithBootstrapButtons.fire(
                                                                'Deleted!',
                                                                'Your file has been deleted.',
                                                                'success'
                                                            ).then((result) =>
                                                            {
                                                                location.reload();
                                                            })
                                                }
                                            }

                                });
                        } 
                        else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            )
                        }
                    })

                }
            </script>
                <script>
            function change_status1(id)
            {
                var base_url = '<?php echo base_url()?>';
                var status = $('#status_'+id).children("option:selected").val();
                var id = id;

                if(status != '')
                {
                    $.ajax({
                                url : base_url + "HoteladminController/change_business_center_status",
                                method : "post",
                                data : {status : status,id : id},
                                success : function(data)
                                        {
                                            // alert(data)
                                            if(data == 1)
                                            {
                                                alert('Status changed successfully');
                                                location.reload();
                                            }
                                            else
                                            {
                                                alert('something went wrong');
                                                location.reload();
                                            }
                                        }
                    });
                }
            }
        </script>
         <script>
            function change_status(id)
            {
                
                var base_url = '<?php echo base_url()?>';
                var status = $('#status_'+id).children("option:selected").val();
                var id = id;
                // alert(status);

                if(status != '')
                {
                    $.ajax({
                                url : base_url + "HoteladminController/assign_room_type",
                                method : "post",
                                data : {status : status,id : id},
                                success : function(data)
                                        {
                                            // alert(data)
                                            if(data == 1)
                                            {
                                                alert('Room Assinged successfully');
                                                location.reload();
                                            }
                                            else
                                            {
                                                alert('something went wrong');
                                                location.reload();
                                            }
                                        }
                    });
                }
            }
        </script>
          <script>
         function delete_data_business(id)
        {
            var id = id;
            var base_url = '<?php echo base_url()?>';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: 
                {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    $.ajax({
                            url     : base_url + "HoteladminController/delete_business_center",
                            method  : "post",
                            data    : {id : id},
                            success : function(data)
                                    {
                                        // alert(data);
                                        if(data == 1)
                                        {
                                            swalWithBootstrapButtons.fire(
                                                        'Deleted!',
                                                        'Your file has been deleted.',
                                                        'success'
                                                    ).then((result) =>
                                                    {
                                                        location.reload();
                                                    })
                                        }
                                    }

                        });
                } 
                else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }
        </script>
         <script>
        // $('.delete').click(function() {
        function delete_data_exp(id)
        {
            var id = id;
            var base_url = '<?php echo base_url()?>';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: 
                {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    $.ajax({
                            url     : base_url + "HoteladminController/delete_expenses",
                            method  : "post",
                            data    : {id : id},
                            success : function(data)
                                    {
                                        // alert(data);
                                        if(data == 1)
                                        {
                                            swalWithBootstrapButtons.fire(
                                                        'Deleted!',
                                                        'Your file has been deleted.',
                                                        'success'
                                                    ).then((result) =>
                                                    {
                                                        location.reload();
                                                    })
                                        }
                                    }

                        });
                } 
                else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }
    </script>
     <script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb2').DataTable();
        $('#rejectedOrder_tb2').DataTable();
        $('#completedOrder_tb2').DataTable();
    } );
    var selectedOrderserviceurl = '';
    $('#orderserviceDropdown2').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders2')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewReservation';
            $('.page_header_title12').text('List of New Request');
            $('.new_orders_div2').css('display','block');
            $('.accepted_orders_div2').css('display','none');
            $('.rejected_orders_div2').css('display','none');
           
        }
        if(selected_orderservice == 'accepted_order2')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewReservation';
            $('.page_header_title12').text('List of Accepted Request');
            $('.accepted_orders_div2').css('display','block');
            $('.new_orders_div2').css('display','none');
            $('.rejected_orders_div2').css('display','none');
           
        }
      
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+selectedOrderserviceurl,
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    });

</script>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();
        $('#example11').DataTable();
        $('#example12').DataTable();
        $('#example13').DataTable();
        $('#example14').DataTable();
        $('#example15').DataTable();
    } );
    var selectedOrderserviceurl = '';
    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('All Enquiry Request');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'accepted_order')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('Accepted Enquiry Request');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'rejected_order')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('Rejected Enquiry Request');
            $('.rejected_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            
        }
     
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+selectedOrderserviceurl,
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('input[name="facility[]" ]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('input[name="room_no[]" ]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });

        $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });

    });
    </script>
    <script>
  
   
    function orderserviceview(clicked) {
    
var id = clicked;
var base_url = '<?php echo base_url()?>';
            $('.add_div_view').css('display','none');
            $('.add_div_view2').css('display','block');
            $('.page_header_title1').text('View Room Information');
            if(id != '')
            {
                
             $.ajax({
                            url     : base_url + "HoteladminController/get_id_data",
                            method  : "post",
                            data    : {id : id},
                            success : function(data)
                                    {
                                        
                                    }

                        });
       
            }
    };
    

</script>  
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
        // $('.delete').click(function() {
        function delete_data_rooms(id)
        {
            var id = id;
            var base_url = '<?php echo base_url()?>';

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: 
                {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => 
            {
                if (result.isConfirmed) 
                {
                    $.ajax({
                            url     : base_url + "HoteladminController/delete_room_data",
                            method  : "post",
                            data    : {id : id},
                            success : function(data)
                                    {
                                        // alert(data);
                                        if(data == 1)
                                        {
                                            swalWithBootstrapButtons.fire(
                                                        'Deleted!',
                                                        'Your file has been deleted.',
                                                        'success'
                                                    ).then((result) =>
                                                    {
                                                        location.reload();
                                                    })
                                        }
                                    }

                        });
                } 
                else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })

        }
    </script>
  <script>

$(document).on('click', '.room_id', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('room-id');
        console.log(id);
        
     
       
        // console.log(id);
        // return false;
        $.ajax({
            url         : '<?= base_url('HoteladminController/viewRoomConfig') ?>',
            method      : 'POST',
            data        : {room_type: id,},
            
            success     : function(res) {
                console.log(res);

                $('.view_Room_Id').html(res);

                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>