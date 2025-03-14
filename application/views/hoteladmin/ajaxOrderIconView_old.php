<div class="alert alert-success updatemessage" role="alert" id="a"
    style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
    <strong style="color:#fff ;margin-top:10px;">Order Accepted Successfully..!</strong>
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success updatemessage1" role="alert" id="a"
    style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
    <strong style="color:#fff ;margin-top:10px;">Order Status Change Successfully..!</strong>
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success status_completed" role="alert" id="a"
    style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
    <strong style="color:#fff ;margin-top:10px;">Order Status Changed Successfully..!</strong>
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<style>
input[value="Green"]:checked~.colored-div {
    background-color: #7cc142;
    color: white;
}

.alfabetBox {
    display: none;
}

.room_card {
    border-bottom: 1px solid #242426;
    border-radius: 5px;
    box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
    margin: 7px;
    height: 40px;
    width: 54px;
}

.room_no {
    font-weight: 800;
    color: #202020;
    text-align: center;
    padding-top: 14px;
}

.red {
    background-color: #c8c8c8;
}

.radio {
    font-size: inherit;
    margin: 0;
    position: absolute;
    right: 0;
    top: calc(var(--card-padding) + var(--radio-border-width));
    width: 11px;
    height: 11px;
}

.checkbox_css {
    width: 20px;
    height: 20px;
}

.table-editable {
    position: relative;
}

.glyphicon {
    font-size: 20px;
}

.table-remove {
    color: #700;
    cursor: pointer;
}

.table-remove:hover {
    color: #f00;
}

.table-add {
    color: #000;
    cursor: pointer;
    position: absolute;
}

.table-add:hover {
    color: #fff;
}

#example1_wrapper,
#acceptedOrder_tb_wrapper,
#completedOrder_tb_wrapper,
#rejectedOrder_tb_wrapper {
    padding: 0px;
}

.order_manmagement .container-fluid {
    padding: 0px
}
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js') ?>"></script>

<?php if ($icon_id == 2) {  ?>
<input type="hidden" name="room_num" id="room_num1" value="<?= !empty($room_num) ? $room_num : ''; ?>">
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>">
</script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header><span class="page_header_title11">All New Orders</header>
            </span>
        </div>
        <div class="card-body">
            <div class="col-md-12 col-sm-12">
                <div class="panel tab-border card-box">
                    <header class="panel-heading panel-heading-gray custom-tab">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab"
                                    class="<?= (empty($type) || $type == 'new_orders') ? 'active' : ''; ?>">New
                                    Orders</a>
                            </li>
                            <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Orders</a>
                            </li>
                            <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab"
                                    class="<?= ($type == 'completed') ? 'active' : ''; ?>">Completed Orders</a>
                            </li>
                            <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab"
                                    class="<?= ($type == 'reject_orders') ? 'active' : ''; ?>">Rejected Orders</a>
                            </li>
                        </ul>
                    </header>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group" style="margin-left:3px;">
                            <select id="inputState" class="default-select form-control wide">
                                <option selected=""> Floor</option>
                                <option>1 Floor</option>
                                <option>2 Floor</option>
                                <option>3 Floor</option>
                                <option>4 Floor</option>
                            </select>
                            <select id="inputState" class="default-select form-control wide">
                                <option selected="">Order Type</option>
                                <option>App</option>
                                <option>On Call</option>
                            </select>
                            <button class="btn btn-warning  btn-sm "><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="tab-content">
                <div class="tab-pane<?= (empty($type) || $type == 'new_orders') ? ' active' : ''; ?>"
                    style="background-color:white;" id="new_orders_div">
                    <div class="table-scrollable11 table-scrollable order_manmagement">
                        <table id="fb_house_ord_tbl_id" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Order Total</strong></th>
                                    <th><strong>Name</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Mobile No</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="append_data11_1">


                            </tbody>
                        </table>
                      
                    </div>
                </div>
                <div class="modal fade update_faq_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Assign Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form id="frmupdateblock" method="post">
                                <input type="hidden" name="h_k_order_id" id="h_k_order_id">
                                <input type="hidden" name="house_user_id" id="house_user_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Change Order Status</label>
                                            <select id="send_user" name="order_status"
                                                class="default-select form-control wide" required>
                                                <option value data-isdefault="true">Choose...</option>
                                                <option value="1">Accept</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12" style="display: none;" id="select_id_n1">
                                            <label class="form-label">Assign To</label>
                                            <select id="staffdddd" name="staff_id"
                                                class="default-select form-control wide">
                                                <option selected="">Choose...</option>
                                                <?php
                                       if ($staff_list) {
                                          foreach ($staff_list as $st) {
                                       ?>
                                                <option value="<?php echo $st['u_id'] ?>"><?php echo $st['full_name'] ?>
                                                </option>
                                                <?php
                                          }
                                       }
                                       ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12 rejectreasonddd" style="display:none">
                                            <label class="form-label">Reason For Rejecting</label>
                                            <select id="reason" name="reject_reason"
                                                class="default-select form-control wide">
                                                <option value="">Choose</option>
                                                <option value="1">Out of stock</option>
                                                <option value="2">We do not serve</option>
                                                <option value="3">Out of time</option>
                                                <option value="4">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="accepted_orders_div" style="background-color:white;">
                    <div class="table-scrollable12 table-scrollable order_manmagement">
                        <table id="acceptedOrder_tb1" class="display full-width p-0">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Accept Date</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile No</strong></th>
                                    <th><strong>services</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="append_data11_12">
                             
                            </tbody>
                        </table>
                     
                    </div>
                </div>
                <div class="tab-pane<?= ($type == 'completed') ? ' active' : ''; ?>" id="completed_orders_div"
                    style="background-color:white;">
                    <div class="table-scrollable13 table-scrollable order_manmagement">
                        <table id="completedOrder_tb1" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Completed Date</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>Requirement</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list2) {
                              foreach ($list2 as $hk_com) {
                                 $wh = '(u_id = "' . $hk_com['staff_id'] . '")';

                                 $staff_data = $this->MainModel->getData('register', $wh);

                                 $staff_full_name = "";

                                 if ($staff_data) {
                                    $staff_full_name = $staff_data['full_name'];
                                 }

                                 //order type 
                                 $order_from = "";

                                 if($hk_com['order_from'] == 1)
                                    {
                                        $order_from = "On Call Order";
                                    }
                                    else if($hk_com['order_from'] == 2)
                                    {
                                        $order_from = "From Staff Order";
                                    }
                                    else if($hk_com['order_from'] == 3)
                                    {
                                        $order_from = "App Order";
                                    }
                                    else if($hk_com['order_from'] == 4)
                                    {
                                        $order_from = "Walking Order";
                                    }

                                //completed  date
                                $house_completed_date = "";

                                if ($hk_com['complete_date'] != "0000-00-00" && strtotime($hk_com['complete_date']) !== false) {
                                    $house_completed_date = date('d-m-Y', strtotime($hk_com['complete_date'])); 
                                } else {
                                    // Handle the case where both dates are invalid
                                    $house_completed_date = "00-00-0000"; // or any other appropriate action
                                }
                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $hk_com['h_k_order_id'] ?></td>
                                    <td><?php echo $order_from ?></td>

                                    <td><?php echo date('d-m-Y', strtotime($hk_com['order_date']));?></td>
                                    <td><?php echo $house_completed_date?></td>


                                    <td><?php echo $hk_com['full_name'] ?></td>
                                    <td><?php echo $hk_com['mobile_no'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $hk_com['h_k_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $staff_full_name ?></td>
                                    <td><span class="badge badge-primary">Completed</span></td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list2) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list2 as $hk_com) {
                           $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id, $hk_com['h_k_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $hk_com['h_k_order_id'] ?>" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Oty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($hk_order_details) {
                                                         foreach ($hk_order_details as $hk_o_d) {
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
                                                                            <?php echo $hk_o_d['service_type'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['price'] * $hk_o_d['quantity'] ?></h5>
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
                                            <button type="button" class="btn btn light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
                <div class="tab-pane <?= ($type == 'reject_orders') ? ' active' : ''; ?>" id="rejected_orders_div"
                    style="background-color:white;">
                    <div class="table-scrollable14">
                        <table id="rejectedOrder_tb1" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Rejected Date</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Reject Reason</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list3) {
                              foreach ($list3 as $hk_rj) {
                                 $wh = '(u_id = "' . $hk_rj['staff_id'] . '")';

                                 $staff_data = $this->MainModel->getData('register', $wh);

                                 $staff_full_name = "";

                                 if ($staff_data) {
                                    $staff_full_name = $staff_data['full_name'];
                                 }

                                  //order type 
                                  $order_from = "";

                                  if($hk_rj['order_from'] == 1)
                                     {
                                         $order_from = "On Call Order";
                                     }
                                     else if($hk_rj['order_from'] == 2)
                                     {
                                         $order_from = "From Staff Order";
                                     }
                                     else if($hk_rj['order_from'] == 3)
                                     {
                                         $order_from = "App Order";
                                     }
                                     else if($hk_rj['order_from'] == 4)
                                     {
                                         $order_from = "Walking Order";
                                     }

                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $hk_rj['h_k_order_id'] ?></td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($hk_rj['order_date']));?></td>
                                    <td><?php echo date('d-m-Y', strtotime($hk_rj['reject_date'])); ?></td>
                                  
                                    <td><?php echo $hk_rj['full_name'] ?></td>
                                    <td><?php echo $hk_rj['mobile_no'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $hk_rj['h_k_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                       if ($hk_rj['reject_reason'] == 1) {
                                          $order_status = 'Out of stock';
                                       } elseif ($hk_rj['reject_reason'] == 2) {
                                          $order_status = 'We do not serve';
                                       } elseif ($hk_rj['reject_reason'] == 3) {
                                          $order_status = 'Out of time';
                                       } elseif ($hk_rj['reject_reason'] == 4) {
                                          $order_status = 'Others';
                                       }
                                       ?>
                                        <span><?php echo $order_status ?></span>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <div class="badge badge-danger">Rejected</div>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list3) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list3 as $hk_rj) {
                           $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id, $hk_rj['h_k_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $hk_rj['h_k_order_id'] ?>" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Oty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($hk_order_details) {
                                                         foreach ($hk_order_details as $hk_o_d) {
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
                                                                            <?php echo $hk_o_d['service_type'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $hk_o_d['price'] * $hk_o_d['quantity'] ?></h5>
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
                                            <button type="button" class="btn btn light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
        </div>
    </div>
</div>
<!-- Start :: modal for food admin -->
<div class="modal fade bd-example-modal-lg" id="house_modal_class" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg slideInDown animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <input type="hidden" name="h_k_order_id" id="h_k_order_id" value="">
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class=" table sortable table-bordered  mb-0 text-center table_list">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Service</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="geeks_get_data_house">
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
<div class="modal fade bd-example-modal-lg" id="accept_house_class" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                        <input type="hidden" name="h_k_order_id" id="h_k_order_id" value="">
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-4">
                                            <div class="col-xl-12">
                                                <div class="table-responsive">
                                                <table class=" table sortable table-bordered  mb-0 text-center table_list">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.No.</th>
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="geeks_get_house_accept">
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<script type="text/javascript">
$(document).ready(function() {
    order_listing();
         function order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HouseKeepingController/get_out_of_time_huk_orders') ?>",
               dataType: "json",
               success: function (response) {
               }
            });
         }

    // example11_2
    var room_num = $('#room_num1').val();
    table_visiters = $('#fb_house_ord_tbl_id').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?= base_url() ?>' + 'HoteladminController/get_house_new_ord_data',
            type: "POST",
            // data : {filter_data : function() { return $('#filter-form-id').serialize();}
            data: {
                room_num: function() {
                    return $('#room_num1').val();
                }
            },
        },
        'columns': [{
                data: 'Sr_No'
            },
            {
                data: 'Order Id'
            },
            {
                data: 'Order Type'
            },
            {
                data: 'Order Date'
            },
            {
                data: 'Order Total'
            },
            {
                data: 'Name'
            },
            {
                data: 'Mobile No'
            },
            {
                data: 'Services'
            },
            {
                data: 'Action'
            }
        ],
        'columnDefs': [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8], // your case first column
            "className": "text-center",
        }, ]
    });

    table_visiters.on('draw', function() {
            $('#fb_house_ord_tbl_id tbody tr').each(function() {
                  var hiddenValue = $(this).find('.time_out_id').val();
                  if (hiddenValue === '1') {
                     $(this).css('color', 'red'); 
                  }
            });
         });


    setInterval(function() {
        order_listing();
        table_visiters.ajax.reload();
    }, 30000);
  // Start :: accepted order datatable autoload
  out_of_time_order_listing();
         function out_of_time_order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HoteladminController/out_of_time_house_orders_of_accepted') ?>",
               dataType: "json",
               success: function(response) {}
            });
         }
         accepted_house_order_datatable = $('#acceptedOrder_tb1').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
               "url": '<?= base_url() ?>' + 'HoteladminController/accepted_order_of_house',
            },
            'columns': [
              
               {data: 'sr_no'},
               {data: 'order_id'},
               {data: 'ord_date'},
               {data: 'accepted_date'},
               {data: 'ord_type'},
               {data: 'guest_name'},
               {data: 'Mobile_no'},
               {data: 'Services'},
               {data: 'Assign_Order'},
               {data: 'Order_Status'}
               
           ],
            'columnDefs': [{
               "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
               "className": "text-center",
            },
          ]
         });
         accepted_house_order_datatable.on('draw', function() {
            $('#acceptedOrder_tb1 tbody tr').each(function() {
               var hiddenValue = $(this).find('.time_out_id').val();
               if (hiddenValue === '2') {
                  $(this).css('color', 'red');
               }
            });
         });
         setInterval(function() {
            out_of_time_order_listing();
            accepted_house_order_datatable.ajax.reload();
         }, 30000);
         // End :: accepted order datatable autoload
        });
$(document).unbind('click').on("click", '.accept_house_btn', function(e) {
    e.preventDefault();
         $('#geeks_get_house_accept').html('');
         var id = $(this).attr('data-houseaccept-id');
         var base_url = '<?php echo base_url(); ?>';
        //  $("#accept_house_class").modal('show');
        $.ajax({
        url: base_url + "HoteladminController/accept_order_view_house",
        method: "POST",
        data: {
            ord_id: ord_id
        },
            success: function(response) {
               console.log(response);
            //    $('#geeks_get_house_accept').append(response);
               $('#geeks_get_house_accept').html(response);
                $('#accept_house_class').modal('show');
            }
         });
      });

$(document).unbind('click').on('click', '.house_modal_btn', function(e) {
    e.preventDefault();
    $('#geeks_get_data_house').html('');
    var ord_id = $(this).attr('data-house-id');
    var base_url = '<?php echo base_url(); ?>';
    $.ajax({
        url: base_url + "HoteladminController/house_order_view",
        method: "POST",
        data: {
            ord_id: ord_id
        },
        success: function(response) {
            $('#geeks_get_data_house').html(response);
            $('#house_modal_class').modal('show');
        }
    });
});





// for mng accept reject dropdown
$('#send_user').on('change', function() {

    if (this.value == 1) {
        //   $('#user_list').
        $('#select_id_n1').css('display', 'block');
        $('.rejectreasonddd').css('display', 'none');
        $('#staffdddd').prop('required', true);


        $('#reason').prop('required', false);
        $('#staffdddd').prop('required', true);

        //   $('.assignto').css('display','block');

    } else if (this.value == 3) {
        $('#select_id_n1').css('display', 'none');
        $('.rejectreasonddd').css('display', 'block');
        $('#reason').prop('required', true);
        $('#staffdddd').prop('required', false);
    }
});
</script>
<?php  } else if ($icon_id == 3) {  ?>

<input type="hidden" name="room_num" id="room_num" value="<?= !empty($room_num) ? $room_num : ''; ?>">
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>">
</script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12 me-0">
    <div class="card card-topline-aqua me-0">
        <div class="card-head">
            <header><span class="page_header_title11">All New Orders</header>
            </span>
        </div>
        <div class="card-body ">
            <div class="col-md-12 col-sm-12">
                <div class="panel tab-border card-box">
                    <header class="panel-heading panel-heading-gray custom-tab">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#food_new_orders_div" data-bs-toggle="tab"
                                    class="<?= (empty($type) || $type == 'new_orders') ? 'active' : ''; ?>">New
                                    Orders</a>
                            </li>
                            <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Orders</a>
                            </li>
                            <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab"
                                    class="<?= ($type == 'completed') ? 'active' : ''; ?>">Completed Orders</a>
                            </li>
                            <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab"
                                    class="<?= ($type == 'reject_orders') ? 'active' : ''; ?>">Rejected Orders</a>
                            </li>
                        </ul>
                    </header>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group" style="margin-left:3px;">
                            <select id="inputState" class="default-select form-control wide">
                                <option selected=""> Floor</option>
                                <option>1 Floor</option>
                                <option>2 Floor</option>
                                <option>3 Floor</option>
                                <option>4 Floor</option>
                            </select>
                            <select id="inputState" class="default-select form-control wide">
                                <option selected="">Order Type</option>
                                <option>App</option>
                                <option>On Call</option>
                            </select>
                            <button class="btn btn-warning  btn-sm "><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane<?= (empty($type) || $type == 'new_orders') ? ' active' : ''; ?>"
                    style="background-color:white;" id="food_new_orders_div">
                    <div class="table-scrollable21 table-scrollable order_manmagement">
                        <!-- example11_2 -->
                        <table id="fb_new_ord_tbl_id" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Order Total</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Order Status</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="append_data11_2">
                                
                            </tbody>
                        </table>
                      
                    </div>
                </div>
                <div class="modal fade update_faq_modal1" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Assign Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form id="frmupdateblock1" method="post">
                                <input type="hidden" name="food_order_id" id="food_order_id">
                                <input type="hidden" name="food_user_id" id="food_user_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Change Order Status</label>
                                            <select id="send_user1" name="order_status"
                                                class="default-select form-control wide" required>
                                                <option value data-isdefault="true">Choose...</option>
                                                <option value="1">Accept</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12" style="display: none;" id="select_id_n2">
                                            <label class="form-label">Assign To</label>
                                            <select id="staffdd1" name="staff_id"
                                                class="default-select form-control wide">
                                                <option selected="">Choose...</option>
                                                <?php
                                       if ($staff_list) {
                                          foreach ($staff_list as $st) {
                                       ?>
                                                <option value="<?php echo $st['u_id'] ?>"><?php echo $st['full_name'] ?>
                                                </option>
                                                <?php
                                          }
                                       }
                                       ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12 rejectreasonddd1" style="display:none">
                                            <label class="form-label">Reason For Rejecting</label>
                                            <select id="reason1" name="reject_reason"
                                                class="default-select form-control wide">
                                                <option value="">Choose</option>
                                                <option value="1">Out of stock</option>
                                                <option value="2">We do not serve</option>
                                                <option value="3">Out of time</option>
                                                <option value="4">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="accepted_orders_div" style="background-color:white;">
                    <div class="table-scrollable22 table-scrollable order_manmagement ">
                        <table id="acceptedOrder_tb2" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Accepted Date</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>services</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="append_data11_6">
                           
                            </tbody>
                        </table>
                       
                    </div>
                </div>
                <div class="tab-pane<?= ($type == 'completed') ? ' active' : ''; ?>" id="completed_orders_div"
                    style="background-color:white;">
                    <!-- <div class="tab-pane"  style="background-color:white;"> -->
                    <div class="table-scrollable23 table-scrollable order_manmagement ">
                        <table id="completedOrder_tb2" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Completed Date</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>Requirement</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list2) {
                              foreach ($list2 as $fb_com) {
                                 $wh = '(u_id = "' . $fb_com['staff_id'] . '")';
                               
                                 $staff_data = $this->MainModel->getData('register', $wh);
                                //  echo "<pre>";
                                //  print_r($staff_data);die;
                                 $staff_full_name = "";

                                 if ($staff_data) {
                                    $staff_full_name = $staff_data['full_name'];
                                 }

                                //order type 
                                $order_from = "";

                                if($fb_com['order_from'] == 1)
                                   {
                                       $order_from = "On Call Order";
                                   }
                                   else if($fb_com['order_from'] == 2)
                                   {
                                       $order_from = "From Staff Order";
                                   }
                                   else if($fb_com['order_from'] == 3)
                                   {
                                       $order_from = "App Order";
                                   }
                                   else if($fb_com['order_from'] == 4)
                                   {
                                       $order_from = "Walking Order";
                                   }
                                 
                                //completed date
                                $food_completed_date = "";

                                if ($fb_com['complete_date'] != "0000-00-00" && strtotime($fb_com['complete_date']) !== false) {
                                    $food_completed_date = date('d-m-Y', strtotime($fb_com['complete_date'])); 
                                } else {
                                    // Handle the case where both dates are invalid
                                    $food_completed_date = "00-00-0000"; // or any other appropriate action
                                }
                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $fb_com['food_order_id'] ?></td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($fb_com['order_date'])); ?></td>
                                    <td><?php echo $food_completed_date; ?></td>
                                    <td><?php echo $fb_com['full_name'] ?></td>
                                    <td><?php echo $fb_com['mobile_no'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $fb_com['food_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $staff_full_name ?></td>
                                    <td><span class="badge badge-primary">Completed</span></td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list2) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list2 as $fb_com) {
                           $fb_order_details = $this->MainModel->get_food_details($admin_id, $fb_com['food_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $fb_com['food_order_id'] ?>" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($fb_order_details) {
                                                         foreach ($fb_order_details as $fb_o_d) {
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
                                                                            <?php echo $fb_o_d['items_name'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['total'] ?></h5>
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
                                            <button type="button" class="btn btn light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
                <div class="tab-pane<?= ($type == 'reject_orders') ? ' active' : ''; ?>" id="rejected_orders_div"
                    style="background-color:white;">
                    <div class="table-scrollable24 table-scrollable order_manmagement">
                        <table id="rejectedOrder_tb2" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <th><strong>Order Date</strong></th>
                                    <th><strong>Rejected Date</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile No</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Reject Reason</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list3) {
                              foreach ($list3 as $fb_rj) {

                                 //order type 
                                 $order_from = "";

                                 if($fb_rj['order_from'] == 1)
                                    {
                                        $order_from = "On Call Order";
                                    }
                                    else if($fb_rj['order_from'] == 2)
                                    {
                                        $order_from = "From Staff Order";
                                    }
                                    else if($fb_rj['order_from'] == 3)
                                    {
                                        $order_from = "App Order";
                                    }
                                    else if($fb_rj['order_from'] == 4)
                                    {
                                        $order_from = "Walking Order";
                                    }
                                 $order_status = '';
                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $fb_rj['food_order_id'] ?></td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($fb_rj['order_date'])); ?></td>
                                    <td><?php echo  date('d-m-Y', strtotime($fb_rj['reject_date'])); ?></td>
                                    
                                    <td><?php echo $fb_rj['full_name'] ?></td>
                                    <td><?php echo $fb_rj['mobile_no'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $fb_rj['food_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                       if ($fb_rj['reject_reason'] == 1) {
                                          $order_status = 'Out of stock';
                                       } elseif ($fb_rj['reject_reason'] == 2) {
                                          $order_status = 'We do not serve';
                                       } elseif ($fb_rj['reject_reason'] == 3) {
                                          $order_status = 'Out of time';
                                       } elseif ($fb_rj['reject_reason'] == 4) {
                                          $order_status = 'Others';
                                       }
                                       ?>
                                        <span><?php echo $order_status ?></span>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <div class="badge badge-danger">Rejected</div>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list3) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list3 as $fb_rj) {
                           $fb_order_details = $this->MainModel->get_food_details($admin_id, $fb_rj['food_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $fb_rj['food_order_id'] ?>" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Oty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($fb_order_details) {
                                                         foreach ($fb_order_details as $fb_o_d) {
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
                                                                            <?php echo $fb_o_d['items_name'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $fb_o_d['total'] ?></h5>
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
                                            <button type="button" class="btn btn light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
        </div>
    </div>
</div>
<!-- Start :: modal for food admin -->
<div class="modal fade" id="food_modal_class" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg slideInDown animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <input type="hidden" name="food_order_id" id="food_order_id" value="">
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class=" table sortable table-bordered  mb-0 text-center table_list">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Service</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="geeks_get_data">
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
            
                        <div class="modal fade" id="accept_modal_class" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="geeks_get_data_accept">
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
<!-- End :: modal for food admin -->
<script type="text/javascript">
$(document).ready(function() {
    // example11_2
    var room_num = $('#room_num').val();
    table_fb_new_tbl = $('#fb_new_ord_tbl_id').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?= base_url() ?>' + 'HoteladminController/get_food_new_ord_data',
            type: "POST",
            // data : {filter_data : function() { return $('#filter-form-id').serialize();}
            data: {
                room_num: function() {
                    return $('#room_num').val();
                }
            },
        },
        'columns': [{
                data: 'sr_no'
            },
            {
                data: 'Order_Id'
            },
            {
                data: 'Order_Type'
            },
            {
                data: 'Order_Date'
            },
            {
                data: 'Order_Total'
            },
            {
                data: 'Name'
            },
            {
                data: 'Mobile_No'
            },
            {
                data: 'Services'
            },
            {
                data: 'Order_Status'
            },
            {
                data: 'Action'
            }
        ],
        'columnDefs': [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], // your case first column
            "className": "text-center",
        }, ]
    });

    table_fb_new_tbl.on('draw', function() {
        $('#fb_new_ord_tbl_id tbody tr').each(function() {
            var hiddenValue = $(this).find('.time_out_id').val();
            if (hiddenValue === '1') {
                $(this).css('color', 'red');
            }
        });
    });

    setInterval(function() {
        table_fb_new_tbl.ajax.reload();
    }, 30000);

     // Start :: accepted order datatable autoload
    out_of_time_order_listing();
         function out_of_time_order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HomeController/out_of_time_food_orders_of_accepted') ?>",
               dataType: "json",
               success: function(response) {}
            });
         }
         accepted_order_datatable = $('#acceptedOrder_tb2').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
               "url": '<?= base_url() ?>' + 'HoteladminController/accepted_order_of_food',
            },
            'columns': [
              
               {data: 'sr_no'},
               {data: 'order_id'},
               {data: 'ord_type'},
               {data: 'ord_date'},
               {data: 'accepted_date'},
               {data: 'guest_name'},
               {data: 'Mobile_no'},
               {data: 'Services'},
               {data: 'Assign_Order'},
               {data: 'Order_Status'}
              
              
             
            ],
            'columnDefs': [{
               "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
               "className": "text-center",
            },
          ]
         });
         accepted_order_datatable.on('draw', function() {
            $('#acceptedOrder_tb2 tbody tr').each(function() {
               var hiddenValue = $(this).find('.time_out_id').val();
               if (hiddenValue === '2') {
                  $(this).css('color', 'red');
               }
            });
         });
         setInterval(function() {
            out_of_time_order_listing();
            accepted_order_datatable.ajax.reload();
         }, 30000);
         // End :: accepted order datatable autoload
});

$(document).unbind('click').on("click", '.accept_modal_btn', function() {
         $('#geeks_get_data_accept').html('');
         var id = $(this).attr('data-accept-id');
         $("#accept_modal_class").modal('show');
         $.ajax({
            method: "POST",
            url: '<?= base_url('HoteladminController/accept_order_view') ?>',
            data: {
               id: id
            },
            success: function(response) {
               console.log(response);
               $('#geeks_get_data_accept').append(response);
            }
         });
      });




$(document).on('click', '.food_modal_btn', function(e) {
    e.preventDefault();
    $('#geeks_get_data').html('');
    var ord_id = $(this).attr('data-food-id');
    var base_url = '<?php echo base_url(); ?>';
    $.ajax({
        url: base_url + "HoteladminController/food_order_view",
        method: "POST",
        data: {
            ord_id: ord_id
        },
        success: function(response) {
            $('#geeks_get_data').html(response);
            $('#food_modal_class').modal('show');
        }
    });
});



// food order accept reject dropdown
$('#send_user1').on('change', function() {
    if (this.value == 1) {
        //   $('#user_list').
        $('#select_id_n2').css('display', 'block');
        $('.rejectreasonddd1').css('display', 'none');
        $('#staffdd1').prop('required', true);

        $('#reason1').prop('required', false);
        $('#staffdd1').prop('required', true);
    } else if (this.value == 3) {
        $('#select_id_n2').css('display', 'none');
        $('.rejectreasonddd1').css('display', 'block');
        $('#reason1').prop('required', true);
        $('#staffdd1').prop('required', false);
    }
});
</script>
<?php  } else if ($icon_id == 4) {  ?>
<input type="hidden" name="room_num" id="room_num5" value="<?= !empty($room_num) ? $room_num : ''; ?>">
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>">
</script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
    <div class="card card-topline-aqua">
        <div class="card-head">
            <header><span class="page_header_title11">All New Orders</header>
            </span>
        </div>
        <div class="card-body ">
            <div class="col-md-12 col-sm-12">
                <div class="panel tab-border card-box">
                    <header class="panel-heading panel-heading-gray custom-tab">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">New
                                    Orders</a>
                            </li>
                            <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Orders</a>
                            </li>
                            <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab">Completed
                                    Orders</a>
                            </li>
                            <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Rejected Orders</a>
                            </li>
                        </ul>
                    </header>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group" style="margin-left:3px;">
                            <select id="inputState" class="default-select form-control wide">
                                <option selected=""> Floor</option>
                                <option>1 Floor</option>
                                <option>2 Floor</option>
                                <option>3 Floor</option>
                                <option>4 Floor</option>
                            </select>
                            <select id="inputState" class="default-select form-control wide">
                                <option selected="">Order Type</option>
                                <option>App</option>
                                <option>On Call</option>
                            </select>
                            <button class="btn btn-warning  btn-sm "><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="tab-content">
                <div class="tab-pane active" style="background-color:white;" id="new_orders_div">
                    <div class="table-scrollable31 table-scrollable order_manmagement">
                        <table id="fb_laundry_ord_tbl_id" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.No</strong></th>
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Date/Time</strong></th>
                                    <th><strong>Order Total</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Type</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Guest Mobile no</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody class="append_data11_3">
                             
                            </tbody>
                        </table>
                      
                    </div>
                </div>
                <div class="modal fade update_faq_modal2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md slideInRight animated">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Assign Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form id="frmupdateblock2" method="post">
                                <input type="hidden" name="cloth_order_id" id="cloth_order_id">
                                <input type="hidden" name="cloth_user_id" id="cloth_user_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Change Order Status</label>
                                            <select id="select_id3" name="order_status"
                                                class="default-select form-control wide" required>
                                                <option value data-isdefault="true">Choose...</option>
                                                <option value="1">Accept</option>
                                                <option value="3">Reject</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12" id="select_id_n3" style="display: none;">
                                            <label class="form-label">Assign To</label>
                                            <select id="
                                            .0" name="staff_id" class="default-select form-control wide">
                                                <option selected="">Choose...</option>
                                                <?php
                                       if ($staff_list) {
                                          foreach ($staff_list as $st) {
                                       ?>
                                                <option value="<?php echo $st['u_id'] ?>"><?php echo $st['full_name'] ?>
                                                </option>
                                                <?php
                                          }
                                       }
                                       ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-12 rejectreasonddd2" style="display:none">
                                            <label class="form-label">Reason For Rejecting</label>
                                            <select id="reason2" name="reject_reason"
                                                class="default-select form-control wide">
                                                <option value="">Choose</option>
                                                <option value="1">Out of stock</option>
                                                <option value="2">We do not serve</option>
                                                <option value="3">Out of time</option>
                                                <option value="4">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="accepted_orders_div" style="background-color:white;">
                    <div class="table-scrollable32 table-scrollable order_manmagement ">
                        <table id="acceptedOrder_tb3" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.No</strong></th>
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Date/Time</strong></th>
                                    <th><strong>Accepted Date</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Guest Mobile no</strong></th>
                                    <th><strong>services</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                              
                            </tbody>
                        </table>
                        <?php
                     if ($list1) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list1 as $ld_acc) {
                           $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id, $ld_acc['cloth_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $ld_acc['cloth_order_id'] ?>"
                            tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($ld_order_details) {
                                                         foreach ($ld_order_details as $ld_o_d) {
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
                                                                            <?php echo $ld_o_d['cloth_name'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['price'] ?></h5>
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
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
                <div class="tab-pane" id="completed_orders_div" style="background-color:white;">
                    <div class="table-scrollable33 table-scrollable order_manmagement">
                        <table id="completedOrder_tb3" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.No</strong></th>
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Date/Time</strong></th>
                                    <th><strong>Completed Date/Time</strong></th>
                                    <th><strong>Order Type</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Name</strong></th>
                                    <th><strong>Mobile no</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Assign Order</strong></th>
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list2) {
                              foreach ($list2 as $ld_com) {
                                 $wh = '(u_id = "' . $ld_com['staff_id'] . '")';

                                 $staff_data = $this->MainModel->getData('register', $wh);

                                 $staff_full_name = "";

                                 if ($staff_data) {
                                    $staff_full_name = $staff_data['full_name'];
                                 }

                                 //order type 
                                 $order_from = "";

                                 if($ld_com['order_from'] == 1)
                                    {
                                        $order_from = "On Call Order";
                                    }
                                    else if($ld_com['order_from'] == 2)
                                    {
                                        $order_from = "From Staff Order";
                                    }
                                    else if($ld_com['order_from'] == 3)
                                    {
                                        $order_from = "App Order";
                                    }
                                    else if($ld_com['order_from'] == 4)
                                    {
                                        $order_from = "Walking Order";
                                    }


                                  //completed date
                                $laundry_completed_date = "";

                                if ($ld_com['complete_date'] != "0000-00-00" && strtotime($ld_com['complete_date']) !== false) {
                                    $laundry_completed_date = date('d-m-Y', strtotime($ld_com['complete_date'])); 
                                } else {
                                    // Handle the case where both dates are invalid
                                    $laundry_completed_date = "00-00-0000"; // or any other appropriate action
                                }
                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $ld_com['cloth_order_id'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($ld_com['order_date'])); ?><sub><?php echo date('h:i A', strtotime($ld_com['order_time'])) ?></sub>
                                    </td>
                                    <td><?php echo $laundry_completed_date; ?><sub><?php echo date('h:i A', strtotime($ld_com['updated_at'])); ?></sub>
                                    </td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo $ld_com['full_name'] ?></td>
                                    <td><?php echo $ld_com['mobile_no'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $ld_com['cloth_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $staff_full_name ?></td>
                                    <td><span class="badge badge-primary">Completed</span></td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list2) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list2 as $ld_com) {
                           $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id, $ld_com['cloth_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $ld_com['cloth_order_id'] ?>"
                            tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($ld_order_details) {
                                                         foreach ($ld_order_details as $ld_o_d) {
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
                                                                            <?php echo $ld_o_d['cloth_name'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['price'] * $ld_o_d['quantity'] ?></h5>
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
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
                <div class="tab-pane" id="rejected_orders_div" style="background-color:white;">
                    <div class="table-scrollable34 table-scrollable34 order_manmagement">
                        <table id="rejectedOrder_tb3" class="display full-width">
                            <thead>
                                <tr>
                                    <th><strong>Sr.No</strong></th>
                                    <th><strong>Order Id</strong></th>
                                    <th><strong>Order Date/Time</strong></th>
                                    <th><strong>Rejected Date</strong></th>
                                    <!-- <th><strong>Floor</strong></th> -->
                                    <th><strong>Order Type</strong></th>
                                    <!-- <th><strong>Room No.</strong></th> -->
                                    <th><strong>Guest Name</strong></th>
                                    <th><strong>Guest Mobile No</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Reject Reason</strong></th>
                                    <!-- <th><strong>Status</strong></th> -->
                                    <th><strong>Order Status</strong></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <?php
                           $i = 1;
                           if ($list3) {
                              foreach ($list3 as $ld_rj) {

                                   //order type 
                                   $order_from = "";

                                   if($ld_rj['order_from'] == 1)
                                      {
                                          $order_from = "On Call Order";
                                      }
                                      else if($ld_rj['order_from'] == 2)
                                      {
                                          $order_from = "From Staff Order";
                                      }
                                      else if($ld_rj['order_from'] == 3)
                                      {
                                          $order_from = "App Order";
                                      }
                                      else if($ld_rj['order_from'] == 4)
                                      {
                                          $order_from = "Walking Order";
                                      }
  
                                 $order_status = '';
                           ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td>#<?php echo $ld_rj['cloth_order_id'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($ld_rj['order_date'])); ?><sub><?php echo date('h:i A', strtotime($ld_rj['order_time'])) ?></sub>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($ld_rj['reject_date'])); ?></td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo $ld_rj['full_name'] ?></td>
                                    <td><?php echo $ld_rj['mobile_no'] ?></td>
                                    <td><a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $ld_rj['cloth_order_id'] ?>"><i
                                                class="fa fa-eye"></i></a></td>
                                    <td>
                                        <?php
                                       if ($ld_rj['reject_reason'] == 1) {
                                          $order_status = 'Out of stock';
                                       } elseif ($ld_rj['reject_reason'] == 2) {
                                          $order_status = 'We do not serve';
                                       } elseif ($ld_rj['reject_reason'] == 3) {
                                          $order_status = 'Out of time';
                                       } elseif ($ld_rj['reject_reason'] == 4) {
                                          $order_status = 'Others';
                                       }
                                       ?>
                                        <span><?php echo $order_status ?></span>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <div class="badge badge-danger">Rejected</div>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                              }
                           }

                           ?>
                            </tbody>
                        </table>
                        <?php
                     if ($list3) {
                        $admin_id = $this->session->userdata('u_id');

                        foreach ($list3 as $ld_rj) {
                           $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id, $ld_rj['cloth_order_id']);
                     ?>
                        <div class="modal fade bd-example-modal-lg_<?php echo $ld_rj['cloth_order_id'] ?>" tabindex="-1"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg slideInDown animated">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Requirement</h5>
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
                                                                <th>Service</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                      $j = 1;
                                                      if ($ld_order_details) {
                                                         foreach ($ld_order_details as $ld_o_d) {
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
                                                                            <?php echo $ld_o_d['cloth_name'] ?>
                                                                        </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['quantity'] ?> </h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['price'] ?></h5>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <h5 class="text-nowrap">
                                                                            <?php echo $ld_o_d['price'] *  $ld_o_d['quantity']; ?></h5>
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
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
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
        </div>
    </div>
</div>
<div class="modal fade" id="laundry_modal_class" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg slideInDown animated">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Services</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                <input type="hidden" name="cloth_order_id" id="cloth_order_id" value="">
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class=" table sortable table-bordered  mb-0 text-center table_list">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Service</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="geeks_get_data_laundry">

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
<script type="text/javascript">
$(document).ready(function() {
    order_listing();
         function order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HoteladminController/get_out_of_time_laundry_orders') ?>",
               dataType: "json",
               success: function (response) {
               }
            });
         }
    // example11_2
    var room_num = $('#room_num5').val();
    table_laundry = $('#fb_laundry_ord_tbl_id').DataTable({
        "order": [],
        'processing': true,
        'serverSide': true,
        "bDestroy": true,
        'serverMethod': 'post',
        'ajax': {
            'url': '<?= base_url() ?>' + 'HoteladminController/get_laundry_new_ord_data',
            type: "POST",
            // data : {filter_data : function() { return $('#filter-form-id').serialize();}
            data: {
                room_num: function() {
                    return $('#room_num5').val();
                }
            },
        },
        'columns': [{
                data: 'Sr_No'
            },
            {
                data: 'Order Id'
            },
            {
                data: 'Order Date'
            },
            {
                data: 'Order Total'
            },
            {
                data: 'Order Type'
            },
            {
                data: 'Name'
            },
            {
                data: 'Mobile No'
            },
            {
                data: 'Services'
            },
            {
                data: 'Action'
            }
        ],
        'columnDefs': [{
            "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8], // your case first column
            "className": "text-center",
        }, ]
    });

    table_laundry.on('draw', function() {
            $('#fb_laundry_ord_tbl_id tbody tr').each(function() {
                  var hiddenValue = $(this).find('.time_out_id').val();
                  if (hiddenValue === '1') {
                     $(this).css('color', 'red'); 
                  }
            });
         });

    setInterval(function() {
        table_laundry.ajax.reload();
    }, 30000);
 // Start :: accepted order datatable autoload
 out_of_time_order_listing();
         function out_of_time_order_listing() {
            $.ajax({
               type: "GET",
               url: "<?= base_url('HoteladminController/out_of_time_laundry_orders_of_accepted') ?>",
               dataType: "json",
               success: function(response) {}
            });
         }
         accepted_laundry_order_datatable = $('#acceptedOrder_tb3').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
               "url": '<?= base_url() ?>' + 'HoteladminController/accepted_order_of_laundry',
            },
            'columns': [
              
               {data: 'sr_no'},
               {data: 'order_id'},
               {data: 'ord_date'},
               {data: 'accepted_date'},
               {data: 'ord_type'},
               {data: 'guest_name'},
               {data: 'Mobile_no'},
               {data: 'Services'},
               {data: 'Assign_Order'},
               {data: 'Order_Status'}
               
           ],
            'columnDefs': [{
               "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
               "className": "text-center",
            },
          ]
         });
         accepted_laundry_order_datatable.on('draw', function() {
            $('#acceptedOrder_tb3 tbody tr').each(function() {
               var hiddenValue = $(this).find('.time_out_id').val();
               if (hiddenValue === '2') {
                  $(this).css('color', 'red');
               }
            });
         });
         setInterval(function() {
            out_of_time_order_listing();
            accepted_laundry_order_datatable.ajax.reload();
         }, 30000);
         // End :: accepted order datatable autoload
        });

$(document).on('click', '.laundry_modal_btn', function(e) {
    e.preventDefault();
    $('#geeks_get_data_laundry').html('');
    var ord_id = $(this).attr('data-laundry-id');
    var base_url = '<?php echo base_url(); ?>';
    $.ajax({
        url: base_url + "HoteladminController/laundry_order_view",
        method: "POST",
        data: {
            ord_id: ord_id
        },
        success: function(response) {
            $('#geeks_get_data_laundry').html(response);
            $('#laundry_modal_class').modal('show');
        }
    });
});





$('#select_id3').on('change', function() {

    if (this.value == 1) {
        //   $('#user_list').
        $('#select_id_n3').css('display', 'block');
        $('.rejectreasonddd2').css('display', 'none');
        $('#staffdd2').prop('required', true);

        $('#reason2').prop('required', false);
        $('#staffdd2').prop('required', true);


    } else if (this.value == 3) {
        $('#select_id_n3').css('display', 'none');
        $('.rejectreasonddd2').css('display', 'block');
        $('#reason2').prop('required', true);
        $('#staffdd2').prop('required', false);
    }
});
</script>
<?php  } ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // $('#newOrder_tb').DataTable();
    $('#acceptedOrder_tb').DataTable();
    $('#rejectedOrder_tb').DataTable();
    $('#completedOrder_tb').DataTable();
    // $('#acceptedOrder_tb1').DataTable();
    $('#rejectedOrder_tb1').DataTable();
    $('#completedOrder_tb1').DataTable();
    // $('#acceptedOrder_tb2').DataTable();
    $('#rejectedOrder_tb2').DataTable();
    $('#completedOrder_tb2').DataTable();
    // $('#acceptedOrder_tb3').DataTable();
    $('#rejectedOrder_tb3').DataTable();
    $('#completedOrder_tb3').DataTable();
    //  $('#example11_1').DataTable();
    //  $('#example11_2').DataTable();
    // table_visiters.ajax.reload();
    // table_fb_new_tbl.ajax.reload();
    // table_laundry.ajax.reload();
    // accepted_order_datatable.ajax.reload();
    // accepted_house_order_datatable.ajax.reload();

    //  $('#example11_3').DataTable();
});
var selectedOrderserviceurl = '';
// $('#orderserviceDropdown').change(function () {
//     var selected_orderservice = $(this).val();
//     if(selected_orderservice == 'new_orders')
//     {
//         selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
//         $('.page_header_title11').text('All New Orders');
//         $('.new_orders_div').css('display','block');
//         $('.accepted_orders_div').css('display','none');
//         $('.rejected_orders_div').css('display','none');
//         $('.completed_orders_div').css('display','none');

//     }
//     if(selected_orderservice == 'accepted_order')
//     {
//         selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
//         $('.page_header_title11').text('All Accepted Orders');
//         $('.accepted_orders_div').css('display','block');
//         $('.new_orders_div').css('display','none');
//         $('.rejected_orders_div').css('display','none');
//         $('.completed_orders_div').css('display','none');

//     }
//     if(selected_orderservice == 'completed_order')
//     {
//         selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
//         $('.page_header_title11').text('All Completed Orders');
//         $('.rejected_orders_div').css('display','none');
//         $('.new_orders_div').css('display','none');
//         $('.accepted_orders_div').css('display','none');
//         $('.completed_orders_div').css('display','block');

//     }
//     if(selected_orderservice == 'rejected_order')
//     {
//         selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
//         $('.page_header_title11').text('All Rejected Orders');
//         $('.rejected_orders_div').css('display','block');
//         $('.new_orders_div').css('display','none');
//         $('.accepted_orders_div').css('display','none');
//         $('.completed_orders_div').css('display','none');

//     }

//     var base_url = '<?php echo base_url(); ?>';
//     $.ajax({
//         method: "GET",
//         url: base_url+selectedOrderserviceurl,
//         success: function (response) {
//             $('.append_data').html(response);
//         }
//     });
// });
</script>


<script>
$(document).ready(function() {
    $('.nav-tabs a').on('click', function() {
        var tabId = $(this).attr('href'); // Get the ID of the clicked tab
        // var title = '';

        // Update the title based on the tab ID
        if (tabId === '#new_orders_div') {
            $('.page_header_title11').text('All New Orders');
        } else if (tabId === '#accepted_orders_div') {
            $('.page_header_title11').text('All Accepted Orders');
        } else if (tabId === '#rejected_orders_div') {
            $('.page_header_title11').text('All Rejected Orders');
        } else if (tabId === '#completed_orders_div') {
            $('.page_header_title11').text('All Completed Orders');
        }
        // $('.headingtitle').text(title);
    });
});
</script>
<script>
$(document).ready(function(id) {
    $(document).on('click', '#edit_data', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?= base_url('HoteladminController/getHKData') ?>',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#h_k_order_id').val(data.h_k_order_id);
                $('#house_user_id').val(data.u_id);
            }
        });
    })
});
</script>
<script>
function show_typewise() {
    var id = id;
    var e = document.getElementById("select_id1");
    var strUser = e.options[e.selectedIndex].value;
    var div1 = document.getElementById("select_id_n1");

    if (strUser == 1) {
        div1.style.display = "block";
    }

    if (strUser == 3) {
        div1.style.display = "none";
    }
}
</script>
<script>
$(document).ready(function(id) {
    $(document).on('click', '#edit_data1', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?= base_url('HoteladminController/getFBData') ?>',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#food_order_id').val(data.food_order_id);
                $('#food_user_id').val(data.u_id);
            }
        });
    })
});
</script>
<script>
$(document).ready(function(id) {
    $(document).on('click', '#edit_data2', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?= base_url('HoteladminController/getLaundryData') ?>',
            type: "post",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#cloth_order_id').val(data.cloth_order_id);
                $('#cloth_user_id').val(data.u_id);

                
            }
        });
    })
});
</script>




