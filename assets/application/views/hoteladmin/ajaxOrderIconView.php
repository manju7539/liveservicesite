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
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>

  <?php if($icon_id == 2){  ?>
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
                                                        <th><strong>Order Total</strong></th>
                                                        <th><strong>Name</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Mobile No</strong></th>
                                                        <th><strong>Services</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                                     <?php

                                        $i = 1;
                                        if($list)
                                        {
                                            foreach($list as $hk_o)
                                            {
                                                if($hk_o['order_from'] == 3)
                                                {
                                        ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td>#<?php echo $hk_o['h_k_order_id'] ?></td>
                                                    <td>App</td>
                                                    <td><?php echo $hk_o['order_date'] ?></td>
                                                    <td><?php echo $hk_o['order_total'] ?></td>
                                                    <td><?php echo $hk_o['full_name'] ?></td>
                                                    <td><?php echo $hk_o['mobile_no'] ?></td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $hk_o['h_k_order_id'] ?>"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                                                                class="fa fa-share" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter_<?php echo $hk_o['h_k_order_id'] ?>"></i>
                                                        </a>

                                                        <div class="modal fade" id="exampleModalCenter_<?php echo $hk_o['h_k_order_id'] ?>" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Assign Order</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                </button>
                                                                            </div>
                                                                            <form action="<?php echo base_url('HoteladminController/assign_housekeeping_service_order_to_staff')?>" method="post">
                                                                                <input type="hidden" name="h_k_order_id" value="<?php echo $hk_o['h_k_order_id'] ?>">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="mb-3 col-md-12">
                                                                                            <label class="form-label">Change Order Status</label>
                                                                                            <select id="typeop_<?php echo $hk_o['h_k_order_id'] ?>" name="order_status" onchange="show_typewise(<?php echo $hk_o['h_k_order_id'] ?>)"
                                                                                                class="default-select form-control wide"required>
                                                                                                <option value data-isdefault="true">Choose...</option>
                                                                                                <option value="1">Accept</option>
                                                                                                <option value="3">Reject</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6" style="display: none;" id="type1_<?php echo $hk_o['h_k_order_id'] ?>">
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
            
                                                foreach($list as $hk_o)
                                                {
                                                    if($hk_o['order_from'] == 3)
                                                    {
                                                        $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id,$hk_o['h_k_order_id']);
                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $hk_o['h_k_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg slideInDown animated">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Services</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mt-4">
                                                                    <div class="col-xl-12">

                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class=" table sortable table-bordered  mb-0 text-center table_list">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No.</th>
                                                                                        <th>Service</th>
                                                                                        <th>Oty</th>
                                                                                        <th>Price</th>
                                                                                        <th>Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="geeks">
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($hk_order_details)
                                                                                    {
                                                                                        foreach ($hk_order_details as $hk_o_d) 
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
                                                                                                        <?php echo $hk_o_d['service_type']?>
                                                                                                    </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $hk_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $hk_o_d['price']?></h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $hk_o_d['price'] * $hk_o_d['quantity']?></h5>
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


<div class="accepted_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
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
                        <tbody class="">

                        <?php

                        $i = 1;
                        if($list1)
                        {
                            foreach($list1 as $hk_oacc)
                            {
                                $wh = '(u_id = "'.$hk_oacc['staff_id'].'")';

                                $staff_data = $this->MainModel->getData('register',$wh);

                                $staff_full_name = "";

                                if($staff_data)
                                {
                                    $staff_full_name = $staff_data['full_name'];
                                }

                                //order type 
                                $order_from = "";

                                if($hk_oacc['order_from'] == 1)
                                {
                                    $order_from = "On Call";
                                }
                                else
                                {
                                    if($hk_oacc['order_from'] == 2)
                                    {
                                        $order_from = "From Staff";
                                    }
                                    else
                                    {
                                        if($hk_oacc['order_from'] == 3)
                                        {
                                            $order_from = "App Order";
                                        }
                                    }
                                }

                        ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td>#<?php echo $hk_oacc['h_k_order_id'] ?></td>
                                <td><?php echo $hk_oacc['order_date'] ?></td>
                                <td><?php echo $hk_oacc['accept_date'] ?></td>
                                <td><?php echo $order_from ?></td>
                                <td><?php echo $hk_oacc['full_name'] ?></td>
                                <td><?php echo $hk_oacc['mobile_no'] ?></td>
                                <td>
                                    <a href="#"
                                        class="btn btn-secondary shadow btn-xs sharp me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target=".bd-example-modal-lg_<?php echo $hk_oacc['h_k_order_id'] ?>"><i
                                            class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td><?php echo $staff_full_name ?></td>
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
            
                                                foreach($list1 as $hk_oacc)
                                                {
                                                    $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id,$hk_oacc['h_k_order_id']);
                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $hk_oacc['h_k_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
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
                                                                            <table  id="acceptedOrder_tb1" class="table table-responsive-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No.</th>
                                                                                        <th>Service</th>
                                                                                        <th>Oty</th>
                                                                                        <th>Price</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($hk_order_details)
                                                                                    {
                                                                                        foreach ($hk_order_details as $hk_o_d) 
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
                                                                                                        <?php echo $hk_o_d['service_type']?>
                                                                                                    </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $hk_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $hk_o_d['price']?></h5>
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



<div class="completed_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="completedOrder_tb" class="display full-width">
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
                                                if($list2)
                                                {
                                                    foreach($list2 as $hk_com)
                                                    {
                                                        $wh = '(u_id = "'.$hk_com['staff_id'].'")';

                                                        $staff_data = $this->MainModel->getData('register',$wh);

                                                        $staff_full_name = "";

                                                        if($staff_data)
                                                        {
                                                            $staff_full_name = $staff_data['full_name'];
                                                        }
                                                        
                                                        //order type 
                                                        $order_from = "";

                                                        if($hk_com['order_from'] == 1)
                                                        {
                                                            $order_from = "On Call";
                                                        }
                                                        else
                                                        {
                                                            if($hk_com['order_from'] == 2)
                                                            {
                                                                $order_from = "From Staff";
                                                            }
                                                            else
                                                            {
                                                                if($hk_com['order_from'] == 3)
                                                                {
                                                                    $order_from = "App Order";
                                                                }
                                                            }
                                                        }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++ ?></td>
                                                    <td>#<?php echo $hk_com['h_k_order_id'] ?></td>
                                                    <td><?php echo $hk_com['order_date'] ?></td>
                                                    <td><?php echo $hk_com['complete_date'] ?></td>
                                                    <td><?php echo $order_from ?></td>
                                                    <td><?php echo $hk_com['full_name'] ?></td>
                                                    <td><?php echo $hk_com['mobile_no'] ?></td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-lg_<?php echo $hk_com['h_k_order_id'] ?>"><i
                                                                class="fa fa-eye"></i>
                                                        </a>
                                                    </td>

                                                    <td><?php echo $order_from ?></td>
                                                    <td><span class="badge badge-primary">Completed</span></td>
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
            
                                                foreach($list2 as $hk_com)
                                                {
                                                    $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id,$hk_com['h_k_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $hk_com['h_k_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
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
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php

                                                                                $j = 1;
                                                                                if($hk_order_details)
                                                                                {
                                                                                    foreach ($hk_order_details as $hk_o_d) 
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
                                                                                                    <?php echo $hk_o_d['service_type']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $hk_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $hk_o_d['price']?></h5>
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


<div class="rejected_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
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
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                                <?php

                                        $i = 1;
                                        if($list3)
                                        {
                                            foreach($list3 as $hk_rj)
                                            {
                                                $wh = '(u_id = "'.$hk_rj['staff_id'].'")';

                                                $staff_data = $this->MainModel->getData('register',$wh);

                                                $staff_full_name = "";

                                                if($staff_data)
                                                {
                                                    $staff_full_name = $staff_data['full_name'];
                                                }
                                                
                                                //order type 
                                                $order_from = "";

                                                if($hk_rj['order_from'] == 1)
                                                {
                                                    $order_from = "On Call";
                                                }
                                                else
                                                {
                                                    if($hk_rj['order_from'] == 2)
                                                    {
                                                        $order_from = "From Staff";
                                                    }
                                                    else
                                                    {
                                                        if($hk_rj['order_from'] == 3)
                                                        {
                                                            $order_from = "App Order";
                                                        }
                                                    }
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $i++?></td>
                                            <td>#<?php echo $hk_rj['h_k_order_id'] ?></td>
                                            <td><?php echo $hk_rj['order_date'] ?></td>
                                            <td><?php echo $hk_rj['complete_date'] ?></td>
                                            <td><?php echo $order_from ?></td>
                                            <td><?php echo $hk_rj['full_name'] ?></td>
                                            <td><?php echo $hk_rj['mobile_no'] ?></td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target=".bd-example-modal-lg_<?php echo $hk_rj['h_k_order_id'] ?>"><i
                                                        class="fa fa-eye"></i>
                                                    </a>
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
                </div>

                <?php
                                            
                                            if($list3)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
            
                                                foreach($list3 as $hk_rj)
                                                {
                                                    $hk_order_details = $this->MainModel->get_house_keeping_service_details($admin_id,$hk_rj['h_k_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $hk_rj['h_k_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
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
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php

                                                                                $j = 1;
                                                                                if($hk_order_details)
                                                                                {
                                                                                    foreach ($hk_order_details as $hk_o_d) 
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
                                                                                                    <?php echo $hk_o_d['service_type']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $hk_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $hk_o_d['price']?></h5>
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
   
                                                                
                              <?php  } else if($icon_id == 3){  ?>
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
                                <div class="col-md-6"></div>
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
                                                        <th><strong>Order Total</strong></th>
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Services</strong></th>
                                                        <th><strong>Order Status</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                        <?php

$i = 1;
if($list)
{
    foreach ($list as $fb_p) 
    {
        if($fb_p['order_from'] == 3)
        {
?>
    <tr>
        <td><?php echo $i++?></td>
        <td>#<?php echo $fb_p['food_order_id'] ?></td>
        <td>App</td>
        <td><?php echo $fb_p['order_date'] ?></td>
        <td><?php echo $fb_p['order_total'] ?></td>
        <td><?php echo $fb_p['full_name'] ?></td>
        <td><?php echo $fb_p['mobile_no'] ?></td>
        <td>
            <a href=""
                class="btn btn-secondary shadow btn-xs sharp me-1"
                data-bs-toggle="modal"
                data-bs-target=".bd-example-modal-lg_<?php echo $fb_p['food_order_id'] ?>"><i
                    class="fa fa-eye"></i>
            </a>
        </td>
        <td>
            <div>
                <a href="#">
                    <div class="badge badge-danger"
                        data-bs-toggle="modal" data-bs-target=".status">
                        Pending</div>
                </a>
            </div>
        </td>
        <td>
            <a href="#" class="btn btn-warning shadow btn-xs sharp ">
                <i class="fa fa-share" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_<?php echo $fb_p['food_order_id'] ?>"></i>
            </a>
            <div class="modal fade" id="exampleModalCenter_<?php echo $fb_p['food_order_id'] ?>" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Assign Order</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('HoteladminController/assign_food_order_to_staff')?>" method="post">
                                                                            <input type="hidden" name="food_order_id" value="<?php echo $fb_p['food_order_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-12">
                                                                                        <label class="form-label">Change Order Status</label>
                                                                                        <select id="typeop_<?php echo $fb_p['food_order_id'] ?>" name="order_status" onchange="show_typewise(<?php echo $fb_p['food_order_id'] ?>)"
                                                                                            class="default-select form-control wide"required>
                                                                                            <option value data-isdefault="true">Choose...</option>
                                                                                            <option value="1">Accept</option>
                                                                                            <option value="3">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6" style="display: none;" id="type1_<?php echo $fb_p['food_order_id'] ?>">
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
                </div>


                <?php
                                            
                                            if($list)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
            
                                                foreach($list as $fb_p)
                                                {
                                                    if($fb_p['order_from'] == 3)
                                                    {
                                                        $fb_order_details = $this->MainModel->get_food_details($admin_id,$fb_p['food_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $fb_p['food_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg slideInDown animated">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Services</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mt-4">
                                                                <div class="col-xl-12">

                                                                    <div class="table-responsive">
                                                                        <table
                                                                            class=" table sortable table-bordered  mb-0 text-center table_list">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Sr.No.</th>
                                                                                    <th>Service</th>
                                                                                    <th>Qty</th>
                                                                                    <th>Price</th>
                                                                                    <th>Total</th>
                                                                                </tr>

                                                                            </thead>
                                                                            <tbody id="geeks">
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($fb_order_details)
                                                                                    {
                                                                                        foreach ($fb_order_details as $fb_o_d) 
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
                                                                                                        <?php echo $fb_o_d['items_name']?>
                                                                                                    </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $fb_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $fb_o_d['price']?></h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $fb_o_d['price'] * $fb_o_d['quantity']?></h5>
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


<div class="accepted_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <!-- <th><strong>Floor</strong></th> -->
                                                        <th><strong>Order Id</strong></th>
                                                        <th><strong>Order Date</strong></th>
                                                        <th><strong>Accepted Date</strong></th>
                                                        <th><strong>Order Type</strong></th>
                                                        <!-- <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Name</strong></th>
                                                        <th><strong>Mobile no</strong></th>
                                                        <th><strong>services</strong></th>
                                                        <th><strong>Assign Order</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                        <?php

                                                    $i = 1;
                                                    if($list1)
                                                    {
                                                        foreach ($list1 as $fb_acc) 
                                                        { 
                                                            $wh = '(u_id = "'.$fb_acc['staff_id'].'")';

                                                            $staff_data = $this->MainModel->getData('register',$wh);

                                                            $staff_full_name = "";

                                                            if($staff_data)
                                                            {
                                                                $staff_full_name = $staff_data['full_name'];
                                                            }

                                                            //order type 
                                                            $order_from = "";

                                                            if($fb_acc['order_from'] == 1)
                                                            {
                                                                $order_from = "On Call";
                                                            }
                                                            else
                                                            {
                                                                if($fb_acc['order_from'] == 2)
                                                                {
                                                                    $order_from = "From Staff";
                                                                }
                                                                else
                                                                {
                                                                    if($fb_acc['order_from'] == 3)
                                                                    {
                                                                        $order_from = "App Order";
                                                                    }
                                                                }
                                                            }
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i++?></td>
                                                            <td>#<?php echo $fb_acc['food_order_id'] ?></td>
                                                            <td><?php echo $order_from ?></td>
                                                            <td><?php echo $fb_acc['order_date'] ?></td>
                                                            <td><?php echo $fb_acc['accept_date'] ?></td>
                                                            <td><?php echo $fb_acc['full_name'] ?></td>
                                                            <td><?php echo $fb_acc['mobile_no'] ?></td>
                                                            <td><a href="#"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $fb_acc['food_order_id'] ?>"><i
                                                                        class="fa fa-eye"></i></a></td>

                                                            <td><?php echo $staff_full_name ?></td>
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
            
                                                foreach($list1 as $fb_acc)
                                                {
                                                    $fb_order_details = $this->MainModel->get_food_details($admin_id,$fb_acc['food_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $fb_acc['food_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
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
                                                                                if($fb_order_details)
                                                                                {
                                                                                    foreach ($fb_order_details as $fb_o_d) 
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
                                                                                                    <?php echo $fb_o_d['items_name']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $fb_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $fb_o_d['price']?></h5>
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



<div class="completed_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="completedOrder_tb" class="display full-width">
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
                                        if($list2)
                                        {
                                            foreach ($list2 as $fb_com) 
                                            { 
                                                $wh = '(u_id = "'.$fb_com['staff_id'].'")';

                                                $staff_data = $this->MainModel->getData('register',$wh);

                                                $staff_full_name = "";

                                                if($staff_data)
                                                {
                                                    $staff_full_name = $staff_data['full_name'];
                                                }

                                                //order type 
                                                $order_from = "";

                                                if($fb_com['order_from'] == 1)
                                                {
                                                    $order_from = "On Call";
                                                }
                                                else
                                                {
                                                    if($fb_com['order_from'] == 2)
                                                    {
                                                        $order_from = "From Staff";
                                                    }
                                                    else
                                                    {
                                                        if($fb_com['order_from'] == 3)
                                                        {
                                                            $order_from = "App Order";
                                                        }
                                                    }
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $i++?></td>
                                            <td>#<?php echo $fb_com['food_order_id'] ?></td>
                                            <td><?php echo $order_from ?></td>
                                            <td><?php echo $fb_com['order_date'] ?></td>
                                            <td><?php echo $fb_com['complete_date'] ?></td>
                                            <td><?php echo $fb_com['full_name'] ?></td>
                                            <td><?php echo $fb_com['mobile_no'] ?></td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
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
                </div>
                <?php
                                        
                                        if($list2)
                                        {
                                            $admin_id = $this->session->userdata('u_id');
        
                                            foreach($list2 as $fb_com)
                                            {
                                                $fb_order_details = $this->MainModel->get_food_details($admin_id,$fb_com['food_order_id']);
                                    ?>
                                        <div class="modal fade bd-example-modal-lg_<?php echo $fb_com['food_order_id'] ?>" tabindex="-1" style="display: none;"
                                            aria-hidden="true">
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
                                                                            if($fb_order_details)
                                                                            {
                                                                                foreach ($fb_order_details as $fb_o_d) 
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
                                                                                                <?php echo $fb_o_d['items_name']?>
                                                                                            </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $fb_o_d['quantity']?> </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $fb_o_d['price']?></h5>
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


<div class="rejected_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
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
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                                <?php

                                        $i = 1;
                                        if($list3)
                                        {
                                            foreach ($list3 as $fb_rj) 
                                            { 
                                            
                                                //order type 
                                                $order_from = "";

                                                if($fb_rj['order_from'] == 1)
                                                {
                                                    $order_from = "On Call";
                                                }
                                                else
                                                {
                                                    if($fb_rj['order_from'] == 2)
                                                    {
                                                        $order_from = "From Staff";
                                                    }
                                                    else
                                                    {
                                                        if($fb_rj['order_from'] == 3)
                                                        {
                                                            $order_from = "App Order";
                                                        }
                                                    }
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $i++?></td>
                                            <td>#<?php echo $fb_rj['food_order_id'] ?></td>
                                            <td><?php echo $order_from ?></td>
                                            <td><?php echo $fb_rj['order_date'] ?></td>
                                            <td><?php echo $fb_rj['accept_date'] ?></td>
                                            <td><?php echo $fb_rj['full_name'] ?></td>
                                            <td><?php echo $fb_rj['mobile_no'] ?></td>
                                            <td>
                                                <a href="#"
                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target=".bd-example-modal-lg_<?php echo $fb_rj['food_order_id'] ?>"><i
                                                        class="fa fa-eye"></i>
                                                </a>
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
                </div>

                <?php
                                            
                                            if($list3)
                                            {
                                                $admin_id = $this->session->userdata('u_id');
            
                                                foreach($list3 as $fb_rj)
                                                {
                                                    $fb_order_details = $this->MainModel->get_food_details($admin_id,$fb_rj['food_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $fb_rj['food_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
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
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php

                                                                                $j = 1;
                                                                                if($fb_order_details)
                                                                                {
                                                                                    foreach ($fb_order_details as $fb_o_d) 
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
                                                                                                    <?php echo $fb_o_d['items_name']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $fb_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $fb_o_d['price']?></h5>
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
   
                                                                
                              <?php  }  else if($icon_id == 4){  ?>
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
                                <div class="col-md-6"></div>
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
                        <tbody class="">

                        <?php

                                                    $i = 1;
                                                    if($list)
                                                    {
                                                        foreach ($list as $ld_p) 
                                                        {
                                                            if($ld_p['order_from'] == 3)
                                                            {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i++?></td>
                                                            <td>#<?php echo $ld_p['cloth_order_id'] ?></td>
                                                            <td><?php echo $ld_p['order_date'] ?>/<sub><?php echo date('h:i A',strtotime($ld_p['order_time'])) ?></sub></td>
                                                            <td><?php echo $ld_p['order_total'] ?></td>
                                                            <td>App</td>
                                                            <td><?php echo $ld_p['full_name'] ?></td>
                                                            <td><?php echo $ld_p['mobile_no'] ?></td>
                                                            <td>
                                                                <a href="#"
                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $ld_p['cloth_order_id'] ?>"><i
                                                                        class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-warning shadow btn-xs sharp "><i
                                                                        class="fa fa-share" data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModalCenter_<?php echo $ld_p['cloth_order_id'] ?>"></i></a>
                                                                        <div class="modal fade" id="exampleModalCenter_<?php echo $ld_p['cloth_order_id'] ?>" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Assign Order</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('HoteladminController/assign_laundry_order_to_staff')?>" method="post">
                                                                            <input type="hidden" name="cloth_order_id" value="<?php echo $ld_p['cloth_order_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-12">
                                                                                        <label class="form-label">Change Order Status</label>
                                                                                        <select id="typeop_<?php echo $ld_p['cloth_order_id'] ?>" name="order_status" onchange="show_typewise(<?php echo $ld_p['cloth_order_id'] ?>)"
                                                                                            class="default-select form-control wide" required>
                                                                                            <option value data-isdefault="true">Choose...</option>
                                                                                            <option value="1">Accept</option>
                                                                                            <option value="3">Reject</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6"  id="type1_<?php echo $ld_p['cloth_order_id'] ?>"  style="display: none;">
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
            
                                                foreach($list as $ld_p)
                                                {
                                                    if($ld_p['order_from'] == 3)
                                                    {
                                                        $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id,$ld_p['cloth_order_id']);
                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $ld_p['cloth_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg slideInDown animated">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Services</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mt-4">
                                                                    <div class="col-xl-12">

                                                                        <div class="table-responsive">
                                                                            <table
                                                                                class=" table sortable table-bordered  mb-0 text-center table_list">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr.No.</th>
                                                                                        <th>Service</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Price</th>
                                                                                        <th>Total</th>
                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody id="geeks">
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($ld_order_details)
                                                                                    {
                                                                                        foreach ($ld_order_details as $ld_o_d) 
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
                                                                                                        <?php echo $ld_o_d['cloth_name']?>
                                                                                                    </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $ld_o_d['quantity']?> </h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $ld_o_d['price']?></h5>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div>
                                                                                                    <h5 class="text-nowrap"><?php echo $ld_o_d['price'] * $ld_o_d['quantity']?></h5>
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


<div class="accepted_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
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

                        <?php

                                $i = 1;
                                if($list1)
                                {
                                    foreach ($list1 as $ld_acc) 
                                    {
                                        $wh = '(u_id = "'.$ld_acc['staff_id'].'")';

                                        $staff_data = $this->MainModel->getData('register',$wh);

                                        $staff_full_name = "";

                                        if($staff_data)
                                        {
                                            $staff_full_name = $staff_data['full_name'];
                                        }

                                        //order type 
                                        $order_from = "";

                                        if($ld_acc['order_from'] == 1)
                                        {
                                            $order_from = "On Call";
                                        }
                                        else
                                        {
                                            if($ld_acc['order_from'] == 2)
                                            {
                                                $order_from = "From Staff";
                                            }
                                            else
                                            {
                                                if($ld_acc['order_from'] == 3)
                                                {
                                                    $order_from = "App Order";
                                                }
                                            }
                                        }
                                ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td>#<?php echo $ld_acc['cloth_order_id'] ?></td>
                                    <td><?php echo $ld_acc['order_date'] ?><sub><?php echo date('h:i A',strtotime($ld_acc['order_time'])) ?></sub></td>
                                    <td><?php echo $ld_acc['accept_date'] ?></td>
                                    <td><?php echo $order_from ?></td>
                                    <td><?php echo $ld_acc['full_name'] ?></td>
                                    <td><?php echo $ld_acc['mobile_no'] ?></td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $ld_acc['cloth_order_id'] ?>"><i
                                                class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td><?php echo $staff_full_name ?></td>
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
            
                                                foreach($list1 as $ld_acc)
                                                {
                                                    $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id,$ld_acc['cloth_order_id']);
                                        ?>
                                            <div class="modal fade bd-example-modal-lg_<?php echo $ld_acc['cloth_order_id'] ?>" tabindex="-1" style="display: none;"
                                                aria-hidden="true">
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
                                                                                if($ld_order_details)
                                                                                {
                                                                                    foreach ($ld_order_details as $ld_o_d) 
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
                                                                                                <?php echo $ld_o_d['cloth_name']?>
                                                                                            </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $ld_o_d['quantity']?> </h5>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div>
                                                                                            <h5 class="text-nowrap"><?php echo $ld_o_d['price']?></h5>
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



<div class="completed_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="completedOrder_tb" class="display full-width">
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
                            if($list2)
                            {
                                foreach ($list2 as $ld_com) 
                                {
                                    $wh = '(u_id = "'.$ld_com['staff_id'].'")';

                                    $staff_data = $this->MainModel->getData('register',$wh);

                                    $staff_full_name = "";

                                    if($staff_data)
                                    {
                                        $staff_full_name = $staff_data['full_name'];
                                    }

                                    //order type 
                                    $order_from = "";

                                    if($ld_com['order_from'] == 1)
                                    {
                                        $order_from = "On Call";
                                    }
                                    else
                                    {
                                        if($ld_com['order_from'] == 2)
                                        {
                                            $order_from = "From Staff";
                                        }
                                        else
                                        {
                                            if($ld_com['order_from'] == 3)
                                            {
                                                $order_from = "App Order";
                                            }
                                        }
                                    }
                            ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td>#<?php echo $ld_com['cloth_order_id'] ?></td>
                                <td><?php echo $ld_com['order_date'] ?><sub><?php echo date('h:i A',strtotime($ld_com['order_time'])) ?></sub></td>
                                <td><?php echo $ld_com['complete_date'] ?></td>
                                <td><?php echo $order_from ?></td>
                                <td><?php echo $ld_com['full_name'] ?></td>
                                <td><?php echo $ld_com['mobile_no'] ?></td>
                                <td>
                                    <a href="#"
                                        class="btn btn-secondary shadow btn-xs sharp me-1"
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
                           
                            ?>    </tbody>
                    </table>
                </div>
                <?php
                                            
                                            if($list2)
                                            {
                                                $admin_id = $this->session->userdata('u_ids');
            
                                                foreach($list2 as $ld_com)
                                                {
                                                    $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id,$ld_com['cloth_order_id']);
                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $ld_com['cloth_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
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
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($ld_order_details)
                                                                                    {
                                                                                        foreach ($ld_order_details as $ld_o_d) 
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
                                                                                                    <?php echo $ld_o_d['cloth_name']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $ld_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $ld_o_d['price']?></h5>
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


<div class="rejected_orders_div" style="display: none;">   
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
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
                                                        <!-- <th><strong>Status</strong></th> -->
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                                        $i = 1;
                                        if($list3)
                                        {
                                            foreach ($list3 as $ld_rj) 
                                            {
                                            
                                                //order type 
                                                $order_from = "";

                                                if($ld_rj['order_from'] == 1)
                                                {
                                                    $order_from = "On Call";
                                                }
                                                else
                                                {
                                                    if($ld_rj['order_from'] == 2)
                                                    {
                                                        $order_from = "From Staff";
                                                    }
                                                    else
                                                    {
                                                        if($ld_rj['order_from'] == 3)
                                                        {
                                                            $order_from = "App Order";
                                                        }
                                                    }
                                                }
                                        ?>
                                        <tr>
                                            <td><?php echo $i++?></td>
                                            <td>#<?php echo $ld_rj['cloth_order_id'] ?></td>
                                            <td><?php echo $ld_rj['order_date'] ?><sub><?php echo date('h:i A',strtotime($ld_rj['order_time'])) ?></sub></td>
                                            <td><?php echo $ld_rj['reject_date'] ?></td>
                                            <td><?php echo $order_from ?></td>
                                            <td><?php echo $ld_rj['full_name'] ?></td>
                                            <td><?php echo $ld_rj['mobile_no'] ?></td>
                                            <td><a href="#"
                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target=".bd-example-modal-lg_<?php echo $ld_rj['cloth_order_id'] ?>"><i
                                                        class="fa fa-eye"></i></a></td>


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
            
                                                foreach($list3 as $ld_rj)
                                                {
                                                    $ld_order_details = $this->MainModel->get_laundry_order_details($admin_id,$ld_rj['cloth_order_id']);
                                        ?>
                                                <div class="modal fade bd-example-modal-lg_<?php echo $ld_rj['cloth_order_id'] ?>" tabindex="-1" style="display: none;"
                                                    aria-hidden="true">
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
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php

                                                                                    $j = 1;
                                                                                    if($ld_order_details)
                                                                                    {
                                                                                        foreach ($ld_order_details as $ld_o_d) 
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
                                                                                                    <?php echo $ld_o_d['cloth_name']?>
                                                                                                </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $ld_o_d['quantity']?> </h5>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div>
                                                                                                <h5 class="text-nowrap"><?php echo $ld_o_d['price']?></h5>
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
   
                                                                
                              <?php  }?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();

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
</script>
<script>
        function show_typewise(id) 
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