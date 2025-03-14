<style>
.toggle.btn-xs {
    min-width: 35px;
    min-height: 35px;
}

.box {
    color: #fff;
    padding: 20px;
    display: none;
    margin-top: 20px;
}

.red {
    background: #fff;
}

.green {
    background: #e23428;
}
.form-control:disabled, .form-control[readonly] {
  background-color: white;
}


label {
    margin-right: 15px;
    color:black;
}
</style>
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
</style>
<style>
.invoice-container {
    margin: 15px auto;
    padding: 70px;
    max-width: 650px;
    background-color: #fff;
    border: 1px solid #ccc;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    -o-border-radius: 6px;
    border-radius: 6px;
}


.invoice-container .card1 {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1pxsolidrgba(0, 0, 0, .125);
    border-radius: 0.25rem;
}

@media (max-width: 767px) {
    .invoice-container {
        padding: 35px 20px 70px 20px;
        margin-top: 0px;
        border: none;
        border-radius: 0px;
    }
}
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>

<?php if($sub_icon_id == 1){?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
            <header><span class="page_header_title11">All New Orders</header></span>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Orders</option>
                                        <option value="accepted_order">Accepted Orders</option>
                                        <option value="completed_order">Completed Orders</option>
                                        <option value="rejected_order">Rejected Orders</option>
                                     
                                    </select>                         
                                </div>
                               

                                <div class="col-md-6">
</div>
                                                        <div class="col-md-3">
                                                            <div class="input-group" style="margin-left:3px;">
                                                                <select id="inputState"
                                                                    class="default-select form-control wide"
                                                                    >
                                                                    <option selected=""> Floor</option>
                                                                    <option>1 Floor</option>
                                                                    <option>2 Floor</option>
                                                                    <option>3 Floor</option>
                                                                    <option>4 Floor</option>
                                                                </select>
                                                                <select id="inputState"
                                                                    class="default-select form-control wide"
                                                                    >
                                                                    <option selected="">Order Type</option>
                                                                    <option>App</option>
                                                                    <option>On Call</option>

                                                                </select>
                                                                <button class="btn btn-warning  btn-sm "><i
                                                                        class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                </div>

                                                   
                                <div class="new_orders_div">  
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Order Type</strong></th>
                                                        <th><strong>Order Date</strong></th>
                                                        <th><strong>Total Order</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Phone</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list)
                                                {
                                                    foreach($list as $rs_p)
                                                    {
                                                        $guest_type = "";
                                                        
                                                        if($rs_p['order_from'] == 3)
                                                        {
                                                            if($rs_p['guest_type'] == 1)
                                                            {
                                                                $guest_type = "Regular";
                                                            }
                                                            else
                                                            {
                                                                if($rs_p['guest_type'] == 2)
                                                                {
                                                                    $guest_type = "VIP";
                                                                }
                                                                else
                                                                {
                                                                    if($rs_p['guest_type'] == 3)
                                                                    {
                                                                        $guest_type = "CHG";
                                                                    }
                                                                    else
                                                                    {
                                                                        if($rs_p['guest_type'] == 4)
                                                                        {
                                                                            $guest_type = "WHC";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                            ?>
                                                    <tr>
                                                    <td><?php echo $i++?></td>
                                                            <td>#<?php echo $rs_p['rmservice_services_order_id'] ?></td>
                                                            <td>App</td>
                                                            <td><?php echo $rs_p['order_date'] ?></td>
                                                            <td><?php echo $rs_p['order_total'] ?></td>
                                                            <td><?php echo $rs_p['full_name'] ?></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $rs_p['rmservice_services_order_id'] ?>"><i
                                                                    class="fa fa-eye"></i></a></td>
                                                            
                                                        <td><?php echo $guest_type ?></td>
                                                        <td><?php echo $rs_p['mobile_no'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                                                                    class="fa fa-share" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalCenter_<?php echo $rs_p['rmservice_services_order_id'] ?>"></i></a>
                                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $rs_p['rmservice_services_order_id'] ?>" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Assign Order</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('HoteladminController/assign_room_serv_services_order_to_staff')?>" method="post">
                                                                            <input type="hidden" name="rmservice_services_order_id" value="<?php echo $rs_p['rmservice_services_order_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Change Order Status</label>
                                                                                        <select id="typeop_<?php echo $rs_p['rmservice_services_order_id'] ?>" name="order_status" onchange="show_typewise(<?php echo $rs_p['rmservice_services_order_id'] ?>)"
                                                                                            class="default-select form-control wide"  required>
                                                                                            <option value data-isdefault="true">Choose...</option>
                                                                                            <option value="1">Accept</option>
                                                                                            <option value="3">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6" style="display: none;" id="type1_<?php echo $rs_p['rmservice_services_order_id'] ?>">
                                                                                        <label class="form-label">Assign To</label>
                                                                                        <select id="inputState" name="staff_id" class="default-select form-control wide">
                                                                                            <option selected="">Choose...</option>
                                                                                            <?php
                                                                                                if($staff_list)
                                                                                                {
                                                                                                    foreach($staff_list as $st)
                                                                                                    {
                                                                                            ?>
                                                                                                        <option value="<?php echo $st['u_id']?>"><?php echo $st['full_name']?></option>
                                                                                            <?php
                                                                                                    }
                                                                                                }
                                                                                            ?>
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
                                                                </td>
                                                     
                                                    </tr>
                                            <?php
                                                        }
                                                    }
                                                }
                                               
                                            ?>
                        </tbody>
                    </table>

                    <?php
                                            
                                            if($list)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
			
                                                foreach($list as $rm_p)
                                                {
                                                    if($rm_p['order_from'] == 3)
                                                    {
                                                        $rm_order_details = $this->MainModel->get_room_service_order_services_details($admin_id,$rm_p['rmservice_services_order_id']);

                                        ?>
                                        <div class="modal fade bd-example-modal-lg_<?php echo $rm_p['rmservice_services_order_id'] ?>" tabindex="-1" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                    <table
                                                                        class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No.</th>
                                                                                <th>Service</th>
                                                                                <th>Photo</th>
                                                                                <th> Qty</th>
                                                                                <th>Price</th>
                                                                                <th>Total</th>

                                                                            </tr>

                                                                        </thead>
                                                                        <tbody id="geeks">
                                                                        <?php

                                                                            $j = 1;
                                                                            if($rm_order_details)
                                                                            {
                                                                                foreach ($rm_order_details as $rm_o_d) 
                                                                                {
                                                                        ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['service_name']?></h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="lightgallery">
                                                                                            <a href="<?php echo $rm_o_d['icon_img']?>"
                                                                                                data-exthumbimage="<?php echo $rm_o_d['icon_img']?>"
                                                                                                data-src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                <img class="me-3  "
                                                                                                    src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                    alt=""
                                                                                                    style="width:40px; height:40px;">
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['price'] * $rm_o_d['quantity']?></h5>
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
                                            }
                                        ?>
                </div>
                                            </div>
            
            <div class="accepted_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Accepted Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Assign To</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list1)
                                                {
                                                    foreach($list1 as $rm_acc)
                                                    {
                                                        $wh = '(u_id = "'.$rm_acc['staff_id'].'")';

                                                        $staff_data = $this->MainModel->getData('register',$wh);

                                                        $staff_full_name = "";

                                                        $guest_type = "";

                                                        if($staff_data)
                                                        {
                                                            $staff_full_name = $staff_data['full_name'];
                                                        }

                                                        if($rm_acc['guest_type'] == 1)
                                                        {
                                                            $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($rm_acc['guest_type'] == 2)
                                                            {
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($rm_acc['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_acc['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td>#<?php echo $rm_acc['rmservice_services_order_id'] ?></td>
                                                    <td><?php echo $rm_acc['order_date'] ?></td>
                                                    <td><?php echo $rm_acc['accept_date'] ?></td>
                                                    <td><?php echo $rm_acc['full_name'] ?></td>
                                                    <td><?php echo $rm_acc['mobile_no'] ?></td>
                                                    <td><a href="#"
                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $rm_acc['rmservice_services_order_id'] ?>"><i
                                                                class="fa fa-eye"></i></a></td>

                                                    <td><?php echo $guest_type ?></td>
                                                    <td><?php echo $staff_full_name ?></td>
                                                    <td><span class="badge badge-success">Accepted</span></td>
                                                </tr>
                                            <?php
                                                    }
                                                }
                                               
                                            ?>
                        </tbody>
                    </table>
                    <?php
                                            
                                            if($list1)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
			
                                                foreach($list1 as $rm_p)
                                                {
                                                    $rm_order_details = $this->MainModel->get_room_service_order_services_details($admin_id,$rm_p['rmservice_services_order_id']);

                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $rm_p['rmservice_services_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                            <table id="acceptedOrder_tb1"
                                                                                class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Service</th>
                                                                                        <th>Photo</th>
                                                                                        <th> Qty</th>
                                                                                        <th>Price</th>

                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody id="geeks">
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($rm_order_details)
                                                                                    {
                                                                                        foreach ($rm_order_details as $rm_o_d) 
                                                                                        {
                                                                                ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['service_name']?></h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="lightgallery">
                                                                                                    <a href="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        data-exthumbimage="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        data-src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                        <img class="me-3  "
                                                                                                            src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                            alt=""
                                                                                                            style="width:40px; height:40px;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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

            <div class="completed_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="completedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Completed Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Assign To</strong></th>
                                                        <th><strong>Order Status</strong></th>
                                                        <th><strong>Bill Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list2)
                                                {
                                                    foreach($list2 as $rm_com)
                                                    {
                                                        $wh = '(u_id = "'.$rm_com['staff_id'].'")';

                                                        $staff_data = $this->MainModel->getData('register',$wh);

                                                        $staff_full_name = "";

                                                        $guest_type = "";

                                                        if($staff_data)
                                                        {
                                                            $staff_full_name = $staff_data['full_name'];
                                                        }

                                                        //guest type
                                                        if($rm_com['guest_type'] == 1)
                                                        {
                                                            $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($rm_com['guest_type'] == 2)
                                                            {
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($rm_com['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_com['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        // amount paid or not
                                                        if($rm_com['payment_status'] == 1)
                                                        {
                                                            $payment_status = '<span class="badge badge-success">Paid</span>';
                                                        }
                                                        else
                                                        {
                                                            $payment_status = '<span class="badge badge-warning">Unpaid</span>';
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++?></td>
                                                        <td>#<?php echo $rm_com['rmservice_services_order_id'] ?></td>
                                                        <td><?php echo $rm_com['order_date'] ?></td>
                                                        <td><?php echo $rm_com['accept_date'] ?></td>
                                                        <td><?php echo $rm_com['full_name'] ?></td>
                                                        <td><?php echo $rm_com['mobile_no'] ?></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $rm_com['rmservice_services_order_id'] ?>"><i
                                                                    class="fa fa-eye"></i></a></td>

                                                        <td><?php echo $guest_type ?></td>
                                                        <td><?php echo $staff_full_name ?></td>
                                                        <td><span class="badge badge-primary">Completed</span></td>
                                                        <td><?php echo $payment_status?></td>
                                                    </tr>
                                            <?php
                                                    }
                                                }
												
                                            ?>
                        </tbody>
                    </table>
                    <?php
                                               
                                               if($list2)
                                               {
                                                   $admin_id = $this->session->userdata('u_id');
               
                                                   foreach($list2 as $rm_com)
                                                   {
   
                                                       $rm_order_details = $this->MainModel->get_room_service_order_services_details($admin_id,$rm_com['rmservice_services_order_id']);
                                           ?>
                                                   <div class="modal fade bd-example-modal-lg_<?php echo $rm_com['rmservice_services_order_id']?>" tabindex="-1" style="display: none;"
                                                       aria-hidden="true">
                                                       <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                               <table id="completedOrder_tb1" 
                                                                                   class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                   <thead>
                                                                                       <tr>
                                                                                           <th>No.</th>
                                                                                           <th>Service</th>
                                                                                           <th>Photo</th>
                                                                                           <th> Qty</th>
                                                                                           <th>Price</th>
   
                                                                                       </tr>
   
                                                                                   </thead>
                                                                                   <tbody id="geeks">
                                                                                   <?php
   
                                                                                       $j = 1;
                                                                                       if($rm_order_details)
                                                                                       {
                                                                                           foreach ($rm_order_details as $rm_o_d) 
                                                                                           {
                                                                                   ?>
                                                                                           <tr>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['service_name']?></h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div class="lightgallery">
                                                                                                       <a href="<?php echo $rm_o_d['icon_img']?>"
                                                                                                           data-exthumbimage="<?php echo $rm_o_d['icon_img']?>"
                                                                                                           data-src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                           <img class="me-3  "
                                                                                                               src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                               alt=""
                                                                                                               style="width:40px; height:40px;">
                                                                                                       </a>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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


            <div class="rejected_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Rejected Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list3)
                                                {
                                                    foreach($list3 as $rm_rj)
                                                    {
                                                        $guest_type = "";
                                                        
                                                        if($rm_rj['guest_type'] == 1)
                                                        {
                                                            $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($rm_rj['guest_type'] == 2)
                                                            {
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($rm_rj['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_rj['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++?></td>
                                                        <td>#<?php echo $rm_rj['rmservice_services_order_id'] ?></td>
                                                        <td><?php echo $rm_rj['order_date'] ?></td>
                                                        <td><?php echo $rm_rj['accept_date'] ?></td>
                                                        <td><?php echo $rm_rj['full_name'] ?></td>
                                                        <td><?php echo $rm_rj['mobile_no'] ?></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $rm_rj['rmservice_services_order_id'] ?>"><i
                                                                    class="fa fa-eye"></i></a></td>

                                                        <td><?php echo $guest_type ?></td>
                                                        <td><a href="#">
                                                                <div class="badge badge-danger">Rejected</div>
                                                            </a></td>
                                                    </tr>
                                            <?php
                                                    }
                                                }
                                                
                                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                                            
                                            if($list3)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
			
                                                foreach($list3 as $rm_rj)
                                                {
                                                    $rm_order_details = $this->MainModel->get_room_service_order_services_details($admin_id,$rm_rj['rmservice_services_order_id']);

                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $rm_rj['rmservice_services_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                            <table id="rejectedOrder_tb1" 
                                                                                class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Service</th>
                                                                                        <th>Photo</th>
                                                                                        <th> Qty</th>
                                                                                        <th>Price</th>

                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody id="geeks">
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($rm_order_details)
                                                                                    {
                                                                                        foreach ($rm_order_details as $rm_o_d) 
                                                                                        {
                                                                                ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['service_name']?></h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="lightgallery">
                                                                                                    <a href="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        data-exthumbimage="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        data-src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                        class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                        <img class="me-3  "
                                                                                                            src="<?php echo $rm_o_d['icon_img']?>"
                                                                                                            alt=""
                                                                                                            style="width:40px; height:40px;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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
<?php } if($sub_icon_id == 2){?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
            <header><span class="page_header_title11">All New Orders</header></span>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Orders</option>
                                        <option value="accepted_order">Accepted Orders</option>
                                        <option value="completed_order">Completed Orders</option>
                                        <option value="rejected_order">Rejected Orders</option>
                                     
                                    </select>                         
                                </div>
                                <div class="new_orders_div">  
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Order Type</strong></th>
                                                        <th><strong>Order Date</strong></th>
                                                        <th><strong>Order Total</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Phone</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list)
                                                {
                                                    foreach($list as $rm_p)
                                                    {
                                                        $guest_type = "";
                                                        
                                                        if($rm_p['order_from'] == 3)
                                                        {
                                                            if($rm_p['guest_type'] == 1)
                                                            {
                                                                $guest_type = "Regular";
                                                            }
                                                            else
                                                            {
                                                                if($rm_p['guest_type'] == 2)
                                                                {
                                                                    $guest_type = "VIP";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_p['guest_type'] == 3)
                                                                    {
                                                                        $guest_type = "CHG";
                                                                    }
                                                                    else
                                                                    {
                                                                        if($rm_p['guest_type'] == 4)
                                                                        {
                                                                            $guest_type = "WHC";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                            ?>
                                                        <tr>
                                                            <td><?php echo $i++?></td>
                                                            <td>#<?php echo $rm_p['room_service_menu_order_id'] ?></td>
                                                            <td>App</td>
                                                            <td><?php echo $rm_p['order_date'] ?></td>
                                                            <td><?php echo $rm_p['order_total'] ?></td>
                                                            <td><?php echo $rm_p['full_name'] ?></td>
                                                            <td>
                                                                <a href="" class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $rm_p['room_service_menu_order_id'] ?>"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>

                                                            <td><?php echo $guest_type ?></td>
                                                            <td><?php echo $rm_p['mobile_no'] ?></td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                                                                        class="fa fa-share" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModalCenter_<?php echo $rm_p['room_service_menu_order_id'] ?>"></i></a>
                                                                        <div class="modal fade" id="exampleModalCenter_<?php echo $rm_p['room_service_menu_order_id'] ?>" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Assign Order</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('HoteladminController/assign_room_serv_menu_order_to_staff')?>" method="post">
                                                                            <input type="hidden" name="room_service_menu_order_id" value="<?php echo $rm_p['room_service_menu_order_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Change Order Status</label>
                                                                                        <select id="typeop_<?php echo $rm_p['room_service_menu_order_id'] ?>" name="order_status" onchange="show_typewise1(<?php echo $rm_p['room_service_menu_order_id'] ?>)"
                                                                                            class="default-select form-control wide" required>
                                                                                            <option value data-isdefault="true">Choose...</option>
                                                                                            <option value="1">Accept</option>
                                                                                            <option value="3">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6"  id="type1_<?php echo $rm_p['room_service_menu_order_id'] ?>" style="display:none">
                                                                                        <label class="form-label">Assign To</label>

                                                                                        <select id="inputState" name="staff_id" class="default-select form-control wide"
                                                                                           >
                                                                                            <option selected="">Choose...</option>
                                                                                            <?php
                                                                                                if($staff_list)
                                                                                                {
                                                                                                    foreach($staff_list as $st)
                                                                                                    {
                                                                                            ?>
                                                                                                        <option value="<?php echo $st['u_id']?>"><?php echo $st['full_name']?></option>
                                                                                            <?php
                                                                                                    }
                                                                                                }
                                                                                            ?>
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
                                                                    </td>
                                                            <!-- assign order -->
                                                          
                                                            <!--/.assign order  -->
                                                        </tr>
                                            <?php
                                                        }
                                                    }
                                                }
                                                
                                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
                                            
                                            if($list)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
			
                                                foreach($list as $rm_p)
                                                {
                                                    if($rm_p['order_from'] == 3)
                                                    {
                                                        $rm_order_details = $this->MainModel->get_room_service_order_menu_details($admin_id,$rm_p['room_service_menu_order_id']);

                                        ?>
                                                    <div class="modal fade bd-example-modal-lg_<?php echo $rm_p['room_service_menu_order_id'] ?>" tabindex="-1" style="display: none;"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                                <table
                                                                                    class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>No.</th>
                                                                                            <th>Category</th>
                                                                                            <!-- <th>Id</th> -->
                                                                                            <th>Photo</th>
                                                                                            <th> Service</th>
                                                                                            <th> Qty</th>
                                                                                            <th>Price</th>
                                                                                            <th>Total</th>
                                                                                        </tr>

                                                                                    </thead>
                                                                                    <tbody id="geeks">
                                                                                    <?php

                                                                                        $j = 1;
                                                                                        if($rm_order_details)
                                                                                        {
                                                                                            foreach ($rm_order_details as $rm_o_d) 
                                                                                            {
                                                                                    ?>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap">
                                                                                                                <?php echo $rm_o_d['category_name']?>
                                                                                                            </h5>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="lightgallery">
                                                                                                            <a href="<?php echo $rm_o_d['image']?>"
                                                                                                                data-exthumbimage="<?php echo $rm_o_d['image']?>"
                                                                                                                data-src="<?php echo $rm_o_d['image']?>"
                                                                                                                class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                                <img class="me-3  "
                                                                                                                    src="<?php echo $rm_o_d['image']?>"
                                                                                                                    alt=""
                                                                                                                    style="width:40px; height:40px;">
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['menu_name']?></h5>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div>
                                                                                                            <h5 class="text-nowrap"><?php echo $rm_o_d['price'] *$rm_o_d['quantity']?></h5>
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
                                            }
                                        ?>
                                            </div>
            
            <div class="accepted_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Accepted Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Assign To</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list1)
                                                {
                                                    foreach($list1 as $rm_acc)
                                                    {
                                                        $wh = '(u_id = "'.$rm_acc['staff_id'].'")';

                                                        $staff_data = $this->MainModel->getData('register',$wh);

                                                        $staff_full_name = "";

                                                        $guest_type = "";

                                                        if($staff_data)
                                                        {
                                                            $staff_full_name = $staff_data['full_name'];
                                                        }

                                                        if($rm_acc['guest_type'] == 1)
                                                        {
                                                            $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($rm_acc['guest_type'] == 2)
                                                            {
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($rm_acc['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_acc['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++?></td>
                                                        <!-- <td>1 Floor</td> -->
                                                        <td>#<?php echo $rm_acc['room_service_menu_order_id'] ?></td>
                                                        <td><?php echo $rm_acc['order_date'] ?></td>
                                                        <td><?php echo $rm_acc['accept_date'] ?></td>
                                                        <!-- <td><strong>104</strong></td> -->
                                                        <td><?php echo $rm_acc['full_name'] ?></td>
                                                        <td><?php echo $rm_acc['mobile_no'] ?></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $rm_acc['room_service_menu_order_id'] ?>"><i
                                                                    class="fa fa-eye"></i></a></td>

                                                        <td><?php echo $guest_type ?></td>
                                                        <td><?php echo $staff_full_name?></td>
                                                        <td><span class="badge badge-success">Accepted</span></td>

                                                    </tr>
                                            <?php
                                                    }
                                                }
                                               
                                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                                               
                                               if($list1)
                                               {
                                                   $admin_id = $this->session->userdata('u_id');
               
                                                   foreach($list1 as $rm_acc)
                                                   {
                                                       $rm_order_details = $this->MainModel->get_room_service_order_menu_details($admin_id,$rm_acc['room_service_menu_order_id']);
                                           ?>
                                                   <div class="modal fade bd-example-modal-lg_<?php echo $rm_acc['room_service_menu_order_id'] ?>" tabindex="-1" style="display: none;"
                                                       aria-hidden="true">
                                                       <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                               <table id="acceptedOrder_tb1"
                                                                                   class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                   <thead>
                                                                                       <tr>
                                                                                           <th>No.</th>
                                                                                           <th>Category</th>
                                                                                           <!-- <th>Id</th> -->
                                                                                           <th>Photo</th>
                                                                                           <th> Service</th>
                                                                                           <th> Qty</th>
                                                                                           <th>Price</th>
                                                                                       </tr>
                                                                                   </thead>
                                                                                   <tbody id="geeks">
                                                                                   <?php
   
                                                                                       $j = 1;
                                                                                       if($rm_order_details)
                                                                                       {
                                                                                           foreach ($rm_order_details as $rm_o_d) 
                                                                                           {
                                                                                   ?>
                                                                                           <tr>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap">
                                                                                                           <?php echo $rm_o_d['category_name']?>
                                                                                                       </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div class="lightgallery">
                                                                                                       <a href="<?php echo $rm_o_d['image']?>"
                                                                                                           data-exthumbimage="<?php echo $rm_o_d['image']?>"
                                                                                                           data-src="<?php echo $rm_o_d['image']?>"
                                                                                                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                           <img class="me-3  "
                                                                                                               src="<?php echo $rm_o_d['image']?>"
                                                                                                               alt=""
                                                                                                               style="width:40px; height:40px;">
                                                                                                       </a>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['menu_name']?></h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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

                                            <div class="completed_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="completedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Completed Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Assign To</strong></th>
                                                        <!-- <th><strong>Status</strong></th> -->
                                                        <th><strong>Order Status</strong></th>
                                                        <th><strong>Bill Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                $i = 1;
                                                if($list2)
                                                {
                                                    foreach($list2 as $rm_com)
                                                    {
                                                        $wh = '(u_id = "'.$rm_com['staff_id'].'")';

                                                        $staff_data = $this->MainModel->getData('register',$wh);

                                                        $staff_full_name = "";

                                                        $guest_type = "";

                                                        if($staff_data)
                                                        {
                                                            $staff_full_name = $staff_data['full_name'];
                                                        }

                                                        //guest type
                                                        if($rm_com['guest_type'] == 1)
                                                        {
                                                            $guest_type = "Regular";
                                                        }
                                                        else
                                                        {
                                                            if($rm_com['guest_type'] == 2)
                                                            {
                                                                $guest_type = "VIP";
                                                            }
                                                            else
                                                            {
                                                                if($rm_com['guest_type'] == 3)
                                                                {
                                                                    $guest_type = "CHG";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_com['guest_type'] == 4)
                                                                    {
                                                                        $guest_type = "WHC";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        
                                                        // amount paid or not
                                                        if($rm_com['payment_status'] == 1)
                                                        {
                                                            $payment_status = '<span class="badge badge-success">Paid</span>';
                                                        }
                                                        else
                                                        {
                                                            $payment_status = '<span class="badge badge-warning">Unpaid</span>';
                                                        }
                                            ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <!-- <td>1 Floor</td> -->
                                                    <td>#<?php echo $rm_com['room_service_menu_order_id'] ?></td>
                                                    <td><?php echo $rm_com['order_date'] ?></td>
                                                    <td><?php echo $rm_com['complete_date'] ?></td>
                                                    <!-- <td><strong>104</strong></td> -->
                                                    <td><?php echo $rm_com['full_name'] ?></td>
                                                    <td><?php echo $rm_com['mobile_no'] ?></td>
                                                    <td><a href="#"
                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $rm_com['room_service_menu_order_id'] ?>"><i
                                                                class="fa fa-eye"></i></a></td>

                                                    <td><?php echo $guest_type ?></td>
                                                    <td><?php echo $staff_full_name?></td>
                                                    <td><span class="badge badge-primary">Completed</span></td>
                                                    <td><?php echo $payment_status?></td>
                                                </tr>
                                            <?php
                                                    }
                                                }
                                              
                                            ?>  
                        </tbody>
                    </table>
                </div>

                <?php
                                               
                                               if($list2)
                                               {
                                                   $admin_id = $this->session->userdata('u_id');
               
                                                   foreach($list2 as $rm_com)
                                                   {
   
                                                       $rm_order_details = $this->MainModel->get_room_service_order_menu_details($admin_id,$rm_com['room_service_menu_order_id']);
                                           ?>
                                                   <div class="modal fade bd-example-modal-lg_<?php echo $rm_com['room_service_menu_order_id'] ?>" tabindex="-1" style="display: none;"
                                                       aria-hidden="true">
                                                       <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                               <table id="completedOrder_tb"
                                                                                   class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                                   <thead>
                                                                                       <tr>
                                                                                           <th>No.</th>
                                                                                           <th>Category</th>
                                                                                           <!-- <th>Id</th> -->
                                                                                           <th>Photo</th>
                                                                                           <th> Service</th>
                                                                                           <th> Qty</th>
                                                                                           <th>Price</th>
   
                                                                                       </tr>
   
                                                                                   </thead>
                                                                                   <tbody id="geeks">
                                                                                   <?php
   
                                                                                       $j = 1;
                                                                                       if($rm_order_details)
                                                                                       {
                                                                                           foreach ($rm_order_details as $rm_o_d) 
                                                                                           {
                                                                                   ?>
                                                                                       <tr>
                                                                                           <td>
                                                                                               <div>
                                                                                                   <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                               </div>
                                                                                           </td>
                                                                                           <td>
                                                                                               <div>
                                                                                                   <h5 class="text-nowrap">
                                                                                                       <?php echo $rm_o_d['category_name']?>
                                                                                                   </h5>
                                                                                               </div>
                                                                                           </td>
                                                                                           <td>
                                                                                               <div class="lightgallery">
                                                                                                   <a href="<?php echo $rm_o_d['image']?>"
                                                                                                       data-exthumbimage="<?php echo $rm_o_d['image']?>"
                                                                                                       data-src="<?php echo $rm_o_d['image']?>"
                                                                                                       class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                       <img class="me-3  "
                                                                                                           src="<?php echo $rm_o_d['image']?>"
                                                                                                           alt=""
                                                                                                           style="width:40px; height:40px;">
                                                                                                   </a>
                                                                                               </div>
                                                                                           </td>
                                                                                           <td>
                                                                                               <div>
                                                                                                   <h5 class="text-nowrap"><?php echo $rm_o_d['menu_name']?></h5>
                                                                                               </div>
                                                                                           </td>
                                                                                           <td>
                                                                                               <div>
                                                                                                   <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                               </div>
                                                                                           </td>
                                                                                           <td>
                                                                                               <div>
                                                                                                   <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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

                                            <div class="rejected_orders_div" style="display: none;">  
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Date</strong></th>
                                                        <th><strong>Rejected Date</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>Requirement</strong></th>
                                                        <th><strong>Guest Type</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php
                                                
                                                    $i = 1;
                                                    if($list3)
                                                    {
                                                        foreach($list3 as $rm_rj)
                                                        { 
                                                            if($rm_rj['guest_type'] == 1)
                                                            {
                                                                $guest_type = "Regular";
                                                            }
                                                            else
                                                            {
                                                                if($rm_rj['guest_type'] == 2)
                                                                {
                                                                    $guest_type = "VIP";
                                                                }
                                                                else
                                                                {
                                                                    if($rm_rj['guest_type'] == 3)
                                                                    {
                                                                        $guest_type = "CHG";
                                                                    }
                                                                    else
                                                                    {
                                                                        if($rm_rj['guest_type'] == 4)
                                                                        {
                                                                            $guest_type = "WHC";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i++?></td>
                                                        <!-- <td>1 Floor</td> -->
                                                        <td>#<?php echo $rm_rj['room_service_menu_order_id'] ?></td>
                                                        <td><?php echo $rm_rj['order_date'] ?></td>
                                                        <td><?php echo $rm_rj['reject_date'] ?></td>
                                                        <!-- <td><strong>104</strong></td> -->
                                                        <td><?php echo $rm_rj['full_name'] ?></td>
                                                        <td><?php echo $rm_rj['mobile_no'] ?></td>
                                                        <td><a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg_<?php echo $rm_rj['room_service_menu_order_id'] ?>"><i
                                                                    class="fa fa-eye"></i></a></td>

                                                        <td><?php echo $guest_type ?></td>
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
                </div>
                <?php
                                               
                                               if($list3)
                                               {
                                                   $admin_id = $this->session->userdata('u_id');
               
                                                   foreach($list3 as $rm_rj)
                                                   {
                                                       $rm_order_details = $this->MainModel->get_room_service_order_menu_details($admin_id,$rm_rj['room_service_menu_order_id']);
                                           ?>
                                                    <div class="modal fade bd-example-modal-lg_<?php echo $rm_rj['room_service_menu_order_id'] ?>" tabindex="-1" style="display: none;"
                                                       aria-hidden="true">
                                                       <div class="modal-dialog modal-xl slideInDown animated">
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
                                                                               <table id="rejectedOrder_tb1"
                                                                                   class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                            
                                                                                   <thead>
                                                                                       <tr>
                                                                                           <th>No.</th>
                                                                                           <th>Category</th>
                                                                                           <!-- <th>Id</th> -->
                                                                                           <th>Photo</th>
                                                                                           <th> Service</th>
                                                                                           <th> Qty</th>
                                                                                           <th>Price</th>
                                                                                       </tr>
   
                                                                                   </thead>
                                                                                   <tbody id="geeks">
                                                                                   <?php
   
                                                                                       $j = 1;
                                                                                       if($rm_order_details)
                                                                                       {
                                                                                           foreach ($rm_order_details as $rm_o_d) 
                                                                                           {
                                                                                   ?>
                                                                                           <tr>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $j++?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap">
                                                                                                           <?php echo $rm_o_d['category_name']?>
                                                                                                       </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div class="lightgallery">
                                                                                                       <a href="<?php echo $rm_o_d['image']?>"
                                                                                                           data-exthumbimage="<?php echo $rm_o_d['image']?>"
                                                                                                           data-src="<?php echo $rm_o_d['image']?>"
                                                                                                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                                           <img class="me-3  "
                                                                                                               src="<?php echo $rm_o_d['image']?>"
                                                                                                               alt=""
                                                                                                               style="width:40px; height:40px;">
                                                                                                       </a>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['menu_name']?></h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['quantity']?> </h5>
                                                                                                   </div>
                                                                                               </td>
                                                                                               <td>
                                                                                                   <div>
                                                                                                       <h5 class="text-nowrap"><?php echo $rm_o_d['price']?></h5>
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
<?php }  ?>
   
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#acceptedOrder_tb1').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#rejectedOrder_tb1').DataTable();
        $('#completedOrder_tb').DataTable();
        $('#completedOrder_tb1').DataTable();

    } );
    var selectedOrderserviceurl = '';
    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('All New Orders');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'accepted_order')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('All Accepted Orders');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'completed_order')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('All Completed Orders');
            $('.rejected_orders_div').css('display','none');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            $('.completed_orders_div').css('display','block');
            
        }
        if(selected_orderservice == 'rejected_order')
        {
            selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockViewEnquiry';
            $('.page_header_title11').text('All Rejected Orders');
            $('.rejected_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
            
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

    function show_typewise(id) {
            var id = id;
            var e = document.getElementById("typeop_"+id);
            var strUser = e.options[e.selectedIndex].value;
            var div1 = document.getElementById("type1_"+id);

            if (strUser == 1) {
                div1.style.display = "block";
            }

            if (strUser == 2) {
                div1.style.display = "none";
            }
        }
        function show_typewise1(id) 
        {
            var id = id;
            var e = document.getElementById("typeop_"+id);
            var strUser = e.options[e.selectedIndex].value;
            var div1 = document.getElementById("type1_"+id);

            if (strUser == 1) {
                div1.style.display = "block";
            }

            if (strUser == 2) {
                div1.style.display = "none";
            }
        }
</script>