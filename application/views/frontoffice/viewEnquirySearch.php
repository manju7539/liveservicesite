<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Enquiry Request</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard') ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">Enquiry Request</li>
                </ol>
            </div>
        </div>
        <?php
        if ($this->session->flashdata('msg')) {
        ?>
            <div class="alert alert-primary" role="alert">
                <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
            </div>
        <?php
        }
        ?>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
            <strong style="color:#fff ;margin-top:10px;">Data Created Successfully..!</strong>

            <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>

        </div>
        <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
            <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>

            <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Enquiry Request</header>
                    </div>
                    <div class="card-body ">
                        <div class="row mb-3">

                            <div class="row mb-3 ">

                                <!-- <div class="col-md-4"> -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="panel tab-border card-box">
                                        <header class="panel-heading panel-heading-gray custom-tab">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">New Enquiry Request</a>
                                                </li>
                                                <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Accepted By User</a>
                                                </li>
                                                <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">Rejected By User</a>
                                                </li>
                                            </ul>
                                        </header>
                                    </div>

                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" style="background-color:white;" id="arrival3_div">
                                        <div class="col-md-5">
                                            <form method="POST">
                                                <div class="d-flex">
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" class="form-control wide" placeholder="dd-mm-yyyy" name="check_in_date"
                                                            onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group input_field_space">
                                                        <input type="text" class="form-control wide"
                                                            placeholder="dd-mm-yyyy" onfocus="(this.type = 'date')" name="check_out_date"
                                                            id="date">
                                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!--  hemali add :: Rejected Order-->

                                        <div class="table-scrollable enquary_field">
                                            <table id="rejectedOrder_tb" class="display full-width">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>CheckIn</th>
                                                        <th>CheckOut</th>
                                                        <th>enquiry id</th>
                                                        <th>Requirement</th>
                                                        <th>Room Names</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $i = 1;
                                                    if (!empty($list2)) {
                                                        foreach ($list2 as $e_req) {

                                                            if ($e_req['room_type_name']) {
                                                                $room_type_name = $e_req['room_type_name'];
                                                            } else {
                                                                $room_type_name = "-";
                                                            }
                                                            $user_data = $this->MainModel->get_user_data($e_req['u_id']);
                                                            //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
                                                            if ($user_data) {
                                                    ?>
                                                                <tr>
                                                                    <td>
                                                                        <h5><?php echo $i++ ?></h5>
                                                                    </td>

                                                                    <td>
                                                                        <h5><?php echo $user_data['full_name'] ?></h5>
                                                                    </td>

                                                                    <td>
                                                                        <h5><?php echo $user_data['mobile_no'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5><?php echo $user_data['email_id'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_in_date'])) ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_out_date'])) ?></h5>
                                                                    </td>
                                                                    <!-- <td><?php echo $e_req['total_adults'] ?></td>
                                    <td><?php echo $e_req['total_childs'] ?></td> -->
                                                                    <td>
                                                                        <h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <a style="margin:auto" data-bs-toggle="modal"
                                                                            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                                                                            class="btn btn-secondary shadow btn-xs sharp"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <h5>
                                                                            <?php echo  $room_type_name ?></h5>
                                                                        <!-- modal for requirment  -->
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
                                                                    </td>


                                                                </tr>

                                                                <!-- modal for accept  -->
                                                                <!-- <div class="modal fade example_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Accept Request</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="basic-form">
                                                <form action="<?php echo base_url('MainController/accept_enquiry_request') ?>" method="post">
                                                                    <input type="hidden" name="hotel_enquiry_request_id" value="<?php echo $e_req['hotel_enquiry_request_id'] ?>">                                                                <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Accpet Enquired Request</label>

                                                                <select id="typeop" name="request_status" onchange="show_typewise()"
                                                                    class="default-select form-control wide">

                                                                    <option selected="">Choose...</option>
                                                                    <option value="1">Accept</option>
                                                                    <option value="2">Reject</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6" style="display:none;" id="type1">
                                                                <label class="form-label">Room Charges /<sub> Night</sub></label>
                                                                <input type="number" name="room_charges" class="form-control" required="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary css_btn">Send</button>

                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                            </div>
                                                    </form>
                                                </div>

                                            </div>
                                        
                                        </div>
                                    </div>
                                    </div> -->
                                                                <!-- end accept  -->
                                                    <?php

                                                            }
                                                        }
                                                    }

                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!--  hemali end :: Rejected Order-->
                                    <!-- accept -->
                                    <div class="tab-pane" style="background-color:white;" id="arrival2_div">
                                        <div class="col-md-5">
                                            <form method="POST">
                                                <div class="d-flex">
                                                    <div class="col-md-6 col-sm-6">
                                                        <input type="text" class="form-control wide" placeholder="dd-mm-yyyy" name="check_in_date"
                                                            onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group input_field_space">
                                                        <input type="text" class="form-control wide"
                                                            placeholder="dd-mm-yyyy" onfocus="(this.type = 'date')" name="check_out_date"
                                                            id="date">
                                                        <button name="search" type="submit" class="btn btn-info btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">
                                            <div class="table-scrollable enquary_field">
                                                <table id="acceptedOrder_tb" class="display full-width">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr.No.</th>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                            <th>Email</th>
                                                            <th>CheckIn</th>
                                                            <th>CheckOut</th>
                                                            <th>enquiry id</th>
                                                            <th>Requirement</th>
                                                            <th>Room Names</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $i = 1;
                                                        if (!empty($list1)) {
                                                            foreach ($list1 as $e_req) {

                                                                if ($e_req['room_type_name']) {
                                                                    $room_type_name = $e_req['room_type_name'];
                                                                } else {
                                                                    $room_type_name = "-";
                                                                }
                                                                $user_data = $this->MainModel->get_user_data($e_req['u_id']);
                                                                //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
                                                                if ($user_data) {
                                                        ?>
                                                                    <tr>
                                                                        <td>
                                                                            <h5><?php echo $i++ ?></h5>
                                                                        </td>

                                                                        <td>
                                                                            <h5><?php echo $user_data['full_name'] ?></h5>
                                                                        </td>

                                                                        <td>
                                                                            <h5><?php echo $user_data['mobile_no'] ?></h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5><?php echo $user_data['email_id'] ?></h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_in_date'])) ?></h5>
                                                                        </td>
                                                                        <td>
                                                                            <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_out_date'])) ?></h5>
                                                                        </td>
                                                                        <!-- <td><?php echo $e_req['total_adults'] ?></td>
                                        <td><?php echo $e_req['total_childs'] ?></td> -->
                                                                        <td>
                                                                            <h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5>
                                                                        </td>
                                                                        <td>
                                                                            <a style="margin:auto" data-bs-toggle="modal"
                                                                                data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                                                                                class="btn btn-secondary shadow btn-xs sharp"><i
                                                                                    class="fa fa-eye"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <h5>
                                                                                <?php echo  $room_type_name ?></h5>
                                                                            <!-- modal for requirment  -->
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
                                    <!-- endaccept -->
                                    <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
                                        <div class="table-scrollable enquary_field">
                                            <div class="col-md-5">
                                                <form method="POST">
                                                    <div class="d-flex" style="margin-bottom: 10px;">
                                                        <div class="col-md-6 col-sm-6">
                                                            <input type="text" class="form-control wide" placeholder="dd-mm-yyyy" name="check_in_date"
                                                                onfocus="(this.type = 'date')" id="date">
                                                        </div>
                                                        <div class="input-group input_field_space">
                                                            <input type="text" class="form-control wide"
                                                                placeholder="dd-mm-yyyy" onfocus="(this.type = 'date')" name="check_out_date"
                                                                id="date">
                                                            <button name="search" type="submit" class="btn btn-info btn-sm"><i
                                                                    class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <table id="example1" class="display full-width">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>CheckIn</th>
                                                        <th>CheckOut</th>
                                                        <th>enquiry id</th>
                                                        <th>Requirement</th>
                                                        <th>Room Names</th>
                                                        <th>Select Room Type</th>
                                                        <th width="15%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="append_data" id="encquery_auto_load">
                                                    <?php
                                                    $i = 1;
                                                    if (!empty($list)) {
                                                        foreach ($list as $e_req) {
                                                            if ($e_req['room_type_name']) {
                                                                $room_type_name = $e_req['room_type_name'];
                                                            } else {
                                                                $room_type_name = "-";
                                                            }
                                                            $user_data = $this->FrontofficeModel->get_user_data($e_req['u_id']);
                                                            // print_r($user_data);exit;
                                                            //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
                                                            if ($user_data) {
                                                    ?>
                                                                <tr>
                                                                    <td>
                                                                        <h5><?php echo $i++ ?></h5>
                                                                    </td>

                                                                    <td>
                                                                        <h5><?php echo $user_data['full_name'] ?></h5>
                                                                    </td>

                                                                    <td>
                                                                        <h5><?php echo $user_data['mobile_no'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5><?php echo $user_data['email_id'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_in_date'])) ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5 style="white-space: nowrap;"><?php echo date('d-m-Y', strtotime($e_req['check_out_date'])) ?></h5>
                                                                    </td>
                                                                    <!-- <td><?php echo $e_req['total_adults'] ?></td>
                                            <td><?php echo $e_req['total_childs'] ?></td> -->
                                                                    <td>
                                                                        <h5><?php echo $e_req['hotel_enquiry_request_id'] ?></h5>
                                                                    </td>
                                                                    <td>
                                                                        <a style="margin:auto" data-bs-toggle="modal"
                                                                            data-bs-target=".bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                                                                            class="btn btn-secondary shadow btn-xs sharp"><i
                                                                                class="fa fa-eye"></i></a>
                                                                    </td>
                                                                    <td>
                                                                        <h5> <?php echo  $room_type_name ?></h5>
                                                                    </td>


                                                                    <td>
                                                                        <select name="room_type" class="nice-select default-select form-control wide dropdown" onchange="change_status(<?php echo $e_req['hotel_enquiry_request_id'] ?>)" data-id="" id="status_<?php echo $e_req['hotel_enquiry_request_id'] ?>">

                                                                            <?php
                                                                            $wh_room_type = '(hotel_id = "' . $e_req['hotel_id'] . '" AND room_type_id = "' . $e_req['room_type'] . '")';

                                                                            //    print($wh_room_type);
                                                                            $room_type_exist = $this->MainModel->getAllData('room_type', $wh_room_type);


                                                                            if ($room_type_exist) {

                                                                                echo "<option selected disabled>-Room Type is Available in our Hotel-</option>";
                                                                            } else { ?>
                                                                                <?php
                                                                                $wh_room_type = '(hotel_id = "' . $e_req['hotel_id'] . '")';


                                                                                $room_type_exist11 = $this->MainModel->getAllData('room_type', $wh_room_type);

                                                                                echo "<option selected disabled>--Select room--</option>";
                                                                                foreach ($room_type_exist11 as $u) {
                                                                                    $name = $u['room_type_name'];

                                                                                    echo '<option value="' . $u['room_type_id'] . '" >' . $name . '</option>';
                                                                                } ?>
                                                                        </select>
                                                                    <?php
                                                                            }
                                                                    ?>


                                                                    </td>

                                                                    <?php
                                                                    $wh_room_type = '(room_type_id = "' . $e_req['room_type'] . '" AND hotel_id="' . $e_req['hotel_id'] . '" )';

                                                                    $room_type_exist = $this->MainModel->getData('room_type', $wh_room_type);
                                                                    // print_r($room_type_exist);exit;

                                                                    ?>
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <!-- <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                                            data-bs-toggle="modal"
                                                            data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>" 
                                                            data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp; -->
                                                                            <a href="#"><span class="badge badge-success"
                                                                                    data-bs-toggle="modal" id="edit_data" data-id="<?php echo $e_req['hotel_enquiry_request_id'] ?>"
                                                                                    data-bs-target=".bd-example-modal-sm">Accept</span>
                                                                            </a>&nbsp;&nbsp;
                                                                            <a href="<?php echo base_url('FrontofficeController/reject_enquiry_request/' . $e_req['hotel_enquiry_request_id']) ?>"><span class="badge badge-danger">Reject</span></a>
                                                                            <!-- <a href="#"><span id="reject_data" data-id="<?php //echo $e_req['hotel_enquiry_request_id'] 
                                                                                                                                ?>" class="badge badge-danger">Reject</span></a> -->
                                                                        </div>
                                                                        <!-- accept modal  -->
                                                                        <div class="modal fade close_enquiry_request_modal bd-example-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-sm custome_model_block">
                                                                                <div class="modal-content">
                                                                                    <!-- <div class="modal-header">
                                                                                    <h5 class="modal-title">Accepted Request</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div> -->
                                                                                    <?php

                                                                                    if ($room_type_exist) {
                                                                                    ?>
                                                                                        <form id="enquiry_accept" method="post">
                                                                                            <input type="hidden" name="hotel_enquiry_request_id" id="hotel_enquiry_request_id">
                                                                                            <input type="hidden" name="enquiry_u_id" id="enquiry_u_id">
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
                                                                                    } else {

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
                                                                <!-- modal for requirment  -->
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
                                                                <!-- modal for accept  -->
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
            <!-- add btn modal  -->
            <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="frmblock" method="post" enctype="multipart/form-data">
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
                                <button type="submit" class="btn btn-primary css_btn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add btn modal -->
<script>
    $(document).ready(function() {
        $('#rejectedOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();

    });
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>