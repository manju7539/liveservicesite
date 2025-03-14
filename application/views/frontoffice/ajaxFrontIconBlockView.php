<?php if($icon_id == 1){?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>All Enquiry Request</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Departed Guest</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                            <tr>
                                    <th><strong>Sr.no.</strong></th>
                                <th><strong>Guest Name</strong></th>
                                <th><strong>Phone No.</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Check-in</strong></th>
                                <th><strong>Check-out</strong></th>
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
                    <td>
                        <button class="btn btn-secondary_<?php echo $e_req['hotel_enquiry_request_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i class="fa fa-eye"></i></button>

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
                            <a href="<?php echo base_url('HoteladminController/reject_enquiry_request/'.$e_req['hotel_enquiry_request_id'])?>"><span class="badge badge-danger">Reject</span></a>
                        </div>
                        <!-- accept modal  -->
                        <div class="modal fade close_enquiry_request_modal bd-example-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Accepted Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <?php
                                    
                                        if($room_type_exist)
                                        {
                                            ?>
                                                    <form id="frmblock" method="post">
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
<?php } elseif($icon_id == 2) { ?>
    
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
                            <i class="fa fa-chevron-down ms-3"></i>
                        </div>
                    </div>
                    <div id="example3_filter" class="dataTables_filter" style="float:right;">
                        <label>
                            <input id="abc" type="search" placeholder="Search"
                                class=" form-control search-input" aria-controls="example3"
                                data-table="table_list"></label>
                    </div>

                </div>
                <table
                    class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list card-table display  shadow-hover table-responsive-lg  no-footer">
                    <thead>
                        <tr>
                            <th>Floor No.</th>
                            <th>Booked Rooms</th>
                            <th>Available Rooms</th>
                            <th>Dirty Rooms</th>
                            <th>Under Maintance</th>
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
                                            <div class="room_card card" style="background:#7cc142">
                                                <span class="room_no "><?php echo $room_status['room_no']?></span>
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
                                            <div class="room_card card" style="background:#a9ada6">
                                                <span class="room_no "><?php echo $room_status1['room_no']?></span>
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
                                            <div class="room_card card" style="background:#35c0f0">
                                                <span class="room_no "><?php echo $room_status2['room_no']?></span>
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
                                            <div class="room_card card" style="background:#ec1c24">
                                                <span class="room_no "><?php echo $room_status3['room_no']?></span>
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
                <header>Floor Management</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                                        <th><strong>Sr.no.</strong></th>
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
                                            <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
                                            <a href="#" onclick="delete_data(<?php echo $fl['floor_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>

                                        </td>
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
                                                            <form action="<?php echo base_url('FrontofsController/edit_floor')?>" method="post">
                                                                <input type="hidden" name="floor_id" value="<?php echo $fl['floor_id'] ?>">
                                                                <div class="col-md-12 form-group">
                                                                    <label class="form-label">Floor No.</label>
                                                                    <input type="number" name="floor" id="floor1" onkeyup="check_entry1()" value="<?php echo $fl['floor'] ?>" class="form-control" placeholder="" required>
                                                                </div>
                                                                <br>
                                                                <div class="text-right">
                                                                    <button type="submit" class="btn btn-info">Update Floor</button>
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
                <header>Floor Management</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
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
                                                    class="fa fa-pencil-alt"></i></a>
                                            <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
                                            <a href="#" onclick="delete_data(<?php echo $r_m['room_type_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                                                    class="fa fa-trash"></i></a>

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
            <?php } elseif($icon_id == 7){?>
                <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Business Center</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th>Sr.No.</th>
                        <th>Photo</th>
                        <th>Center Type</th>
                        <th> Capacity</th>
                        <th>Price(₹)</th>
                        <th>facilities</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>action</th>
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
            <td>
                <button class="btn btn-secondary_<?php echo $bus_c['business_center_id']?> shadow btn-xs sharp"
                    data-toggle="popover"><i
                        class="fa fa-eye"></i></button>

            </td>
            <td>
                <select onchange="change_status(<?php echo $bus_c['business_center_id']?>)" id="status_<?php echo $bus_c['business_center_id']?>"
                    class="default-select form-control wide"
                    style="display: none;">
                    <option <?php if($bus_c['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                    <option <?php if($bus_c['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                </select>
            </td>
            <td>
                <a href="#"
                    class="btn btn-warning shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $bus_c['business_center_id']?>"><i
                        class="fa fa-pencil-alt"></i></a>
                <a href="#" onclick="delete_data(<?php echo $bus_c['business_center_id'] ?>)"
                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
            </td>
            <!-- edit modal -->
                <div class="modal fade bd-example-modal-lg_<?php echo $bus_c['business_center_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Center</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('FrontofsController/edit_business_center')?>" method="post" enctype="multipart/form-data">
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
            <!--/. edit modal -->
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
                <?php } elseif($icon_id == 8){?>
                    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Floor Management</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
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
                                                                            class="fa fa-pencil-alt"></i></a>
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
                    <?php } elseif($icon_id == 9){?>
                        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of request</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
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
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
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
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
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
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
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
                                                        <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-pencil-alt"></i></a> -->
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
        <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Gym Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.No.</strong></th>
                        <th><strong>Staff Name</strong></th>
                        <th><strong>Contact No.</strong></th>
                        <th><strong>Open Time </strong></th>
                        <th><strong>Break Time</strong></th>
                        <th><strong>Description</strong></th>
                        <th><strong>Terms & Condition</strong></th>
                        <th><strong>Pictures</strong></th>
                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $g_f_s)
    {
        $wh = '(front_ofs_service_id = "'.$g_f_s['front_ofs_service_id'].'")';

        $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
?>

    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $g_f_s['staff_name']?></td>
        <td><?php echo $g_f_s['contact_no']?></td>
        <td><?php echo date('h:i a',strtotime($g_f_s['open_time']))."-".date('h:i a',strtotime($g_f_s['close_time']))?></td>
        <td><?php echo date('h:i a',strtotime($g_f_s['break_start_time']))."-".date('h:i a',strtotime($g_f_s['break_close_time']))?></td>
        <td>
            <button
                class="btn btn-secondary_<?php echo $g_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                    class="fa fa-eye"></i></button>
        </td>
        <td>
            <a href="" data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>">
                <img src="assets/dist/images/term.jpg" alt=""
                    height="40px" width="90px">
            </a>
        </td>
        <!-- modal for terms and conditions -->
        <div class="modal fade" id="exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Terms And Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $g_f_s['t_nd_c']?></p>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!--/. modal for terms and conditions -->
        <td>
            <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
            <div id="gallery" data-toggle="modal"
                data-target="#exampleModal">
                <img class="me-3 " src="<?php echo $services_img['image']?>"
                    alt="" data-bs-toggle="modal" 
                    data-bs-target=".bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>"
                    data-slide-to="0"
                    style="height:30px; width:60px;">
            </div>
        </td>
        <!-- image gallery -->
        <div class="modal fade bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pictures of Pool</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <!-- <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="0" class="active" aria-label="Slide 1"
                                    aria-current="true"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                            </div> -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?php echo $services_img['image']?>"
                                        alt="First slide">
                                </div>
                                <!-- <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                        alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                        alt="Third slide">
                                </div> -->
                            </div>
                            <!-- <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/. image gallery -->
        <td>
            <a href="#"
                class="btn btn-warning shadow btn-xs sharp me-1"
                data-bs-toggle="modal"
                data-bs-target=".bd-example-modal-lg_<?php echo $g_f_s['front_ofs_service_id']?>"><i
                    class="fa fa-pencil-alt"></i></a>
           <!-- <a href="#" onclick="delete_data(<?php echo $g_f_s['front_ofs_service_id'] ?>)"
                class="btn btn-danger shadow btn-xs sharp"><i
                    class="fa fa-trash"></i></a>-->
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

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th>Sr.No.</th>
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
            <td>
                <button class="btn btn-secondary_<?php echo $lost_f['id'] ?> shadow btn-xs sharp"
                    data-toggle="popover"><i class="fa fa-eye"></i></button>
            </td>
            <td>

                <a href="#" onclick="delete_data(<?php echo $lost_f['id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
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

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.No.</strong></th>
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
            <td>
                <button class="btn btn-secondary_<?php echo $exp['expense_id']?> shadow btn-xs sharp"
                    data-toggle="popover"><i
                        class="fa fa-eye"></i></button>
            </td>
            <td>
                <a href="#"
                    class="btn btn-warning shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $exp['expense_id']?>"><i
                        class="fa fa-pencil-alt"></i></a>
                <a href="#" onclick="delete_data(<?php echo $exp['expense_id'] ?>)"
                    class="btn btn-danger shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
            </td>
            <!-- edit schedule -->
            <div class="modal fade bd-example-modal-lg_<?php echo $exp['expense_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Expenses</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="<?php echo base_url('FrontofsController/edit_expenses')?>" method="post">
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
            <!--/. edit schedule   -->
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
                                <?php } elseif($icon_id == 13){ ?>
                                    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Visitors Management</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
                <div class="btn-group r-btn">
                <a class="btn btn-info add_staff" href="<?php echo base_url('HoteladminController/departed_guest') ?>">Add Floor</a>
            
            </div>
                                
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
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
                            <form action="<?php echo base_url('FrontofsController/check_visitor_otp')?>" method="post">
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
                                    <?php } ?>