<div class="panel tab-border card-box">
    <header class="panel-heading panel-heading-gray custom-tab">
        <ul class="nav nav-tabs">
            <!-- <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">Room Service</a>
            </li> -->
            <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Housekeeping</a>
            </li>
            <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab">Food & Beverage</a>
            </li>
            <!-- <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Room Service Menu</a>
            </li> -->
            <li class="nav-item"><a href="#rejected1_orders_div" data-bs-toggle="tab">Laundry</a>
            </li>
        </ul>
    </header>
    <div class="tab-content">
        <div class="tab-pane" id="accepted_orders_div"  style="background-color:white;">
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
                            // echo "<pre>";print_r($housekeeping_service_completed_order);die;
                            foreach($housekeeping_service_completed_order as $hk_service)
                            {
                                
                        ?>
                        <tr>
                        <th><?php echo $k++?></th>
                        <td><?php echo $hk_service['service_type'] ?></td>
                        <td><?php echo $hk_service['quantity'] ?></td>
                        <td><?php echo $hk_service['price'] * $hk_service['quantity'] ?> Rs</td>
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
        <div class="tab-pane" id="completed_orders_div"  style="background-color:white;">
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
                        <td><?php echo $fb['price'] * $fb['quantity'] ?> Rs</td>
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
        <div class="tab-pane" id="rejected1_orders_div"  style="background-color:white;">
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
                        <td><?php echo $ld['price'] * $ld['quantity'] ?> Rs</td>
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