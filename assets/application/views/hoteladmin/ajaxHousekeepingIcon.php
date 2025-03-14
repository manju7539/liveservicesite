<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
    <style>
.payment {
    /* width: 50%; */
    margin-left: 60px;
}

.room_card {

    border-radius: 5px;
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
    margin: 6px;
    height: 50px;
    width: 60px;
    border: 2px solid #09bad9;
}

.room_no {
    font-weight: 700;
    color: white;
    text-align: center;
    padding-top: 14px;
    padding-bottom: 14px;
}

.card-header {
  padding: .5rem 1rem;
  margin-bottom: 0;
  background-color: rgba(124, 99, 99, 0.18);
  border-bottom: 1px solid rgba(0,0,0,.125);
    border-bottom-width: 1px;
}

.green {
    background-color: green;
}

.gray {
    background-color: gray;
}

.orange {
    background-color: orange;
}

.card-body {
    padding: 0.3rem 2.2rem;
}

.border {
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
    margin: 14px 0px;
    width: 100%;
    padding: 12px
}

.card-rm {
    /* margin: 15px; */
    height: calc(100% - 30px);
}

.red {
    background-color: #35c0f0;
    border: 1px solid #35c0f0;
}

.blue {
    background-color: #7cc142;
    border: 1px solid #7cc142;
}

.yellow {
    background-color: #a9ada6;
    border: 1px solid #a9ada6;
}

.main_rm {
    background-color: #ec1c24;
    border: 1px solid #ec1c24;
}

.card {
    height: calc(100% - 10px);
}
</style>

  <?php if($icon_id == 1){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Service</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

        
            <button style="float:left;" type="button" class="btn btn-primary css_btn"
                                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                <?php
                                    $pick_up_start_time = "";
                                    $drop_start_time = "";
                                    $pick_up_end_time = "";
                                    $drop_end_time = "";

                                    if($laundry_time)
                                    {
                                        $pick_up_start_time = "";
                                        $drop_start_time = "";
                                        $pick_up_end_time = "";
                                        $drop_end_time = "";

                                        if($laundry_time['pick_up_start_time'])
                                        {
                                            $pick_up_start_time = $laundry_time['pick_up_start_time'];
                                        }
                                        
                                        if($laundry_time['drop_start_time'])
                                        {
                                            $drop_start_time = $laundry_time['drop_start_time'];
                                        }

                                        if($laundry_time['pick_up_end_time'])
                                        {
                                            $pick_up_end_time = $laundry_time['pick_up_end_time'];
                                        }

                                        if($laundry_time['drop_end_time'])
                                        {
                                            $drop_end_time = $laundry_time['drop_end_time'];
                                        }
                                    }
                                ?>
                                <?php
                                    if($laundry_time)
                                    { 
                                ?>
                                        PickUp Timing- <?php echo date('h:i a',strtotime($pick_up_start_time)) ?> to <?php echo date('h:i a',strtotime($pick_up_end_time)) ?> <b>/</b> 
                                        Drop Timing- <?php echo date('h:i a',strtotime($drop_start_time)) ?> to <?php echo date('h:i a',strtotime($drop_end_time)) ?>
                                <?php
                                    }
                                    else
                                    {
                                        echo "Add pick and drop time";
                                    }
                                ?>
                                </button>
                            <!-- modal for update pickup drop time -->
                            <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <?php
                                            if($laundry_time)
                                            {
                                        ?>
                                                <h5 class="modal-title">Update PickUp/Drop Time :</h5>
                                        <?php
                                            }
                                            else
                                            {
                                        ?>
                                                <h5 class="modal-title">Add PickUp/Drop Time :</h5>
                                        <?php
                                            }
                                        ?>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?php echo base_url('HoteladminController/set_laundry_picup_drop_time')?>" method="post">
                                            <div class="modal-body">
                                                <div class="basic-form">
                                                    <div class="row">
                                                        <div class="mb-3 col-lg-6">
                                                            <label class="form-label">Pick Time</label>
                                                            <div class="input-group">
                                                                <input type="time" name="pick_up_start_time" value="<?php echo $pick_up_start_time?>" class="form-control" required>
                                                                <input type="time" name="pick_up_end_time" value="<?php echo $pick_up_end_time?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-lg-6">
                                                            <label class="form-label">Drop Time</label>
                                                            <div class="input-group">
                                                                <input type="time" name="drop_start_time" value="<?php echo $drop_start_time?>" class="form-control" required>
                                                                <input type="time" name="drop_end_time" value="<?php echo $drop_end_time?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary css_btn">Update</button>
                                                    <button type="button" data-bs-dismiss="modal"
                                                        class="btn btn-light css_btn">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--/. modal for update pickup drop time -->
                        
                        <div>
                            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Cloths</button>
                        </div>
                        <!-- Add Cloth  -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Cloth</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('HoteladminController/add_cloth')?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <div class="basic-form">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Cloth Icon</label>
                                                            <input type="file" name="image" class="form-control" accept="image/jpeg, image/png," required="">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Cloth Name</label>
                                                            <input type="text" name="cloth_name" class="form-control" placeholder="Cloth Name" required="">
                                                        </div>
                                                        <div class="mb-3 col-md-12 form-group">
                                                            <label class="form-label">Price</label>
                                                            <input type="number" name="price" class="form-control" placeholder="Price"
                                                                required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    <br>
                                            
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                    <th><strong>Cloth Icon</strong></th>

                                                    <th><strong>Cloth Name </strong></th>

                                                    <th><strong>Price</strong></th>

                                                    <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                        <?php
                                                 
                                                 $i = 1;
 
                                                 if($list)
                                                 {
                                                     foreach($list as $cl)
                                                     {
                                             ?>
                                                         <tr>
                                                             <td> <?php echo $i++?></td>
                                                             <td>
                                                                 <div class="lightgallery">
                                                                     <a href="<?php echo $cl['image']?>"
                                                                         data-exthumbimage="<?php echo $cl['image']?>"
                                                                         data-src="<?php echo $cl['image']?>"
                                                                         class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                         <img class="me-3  "
                                                                             src="<?php echo $cl['image']?>" alt=""
                                                                             style="width:40px; height:40px;">
                                                                     </a>
                                                                 </div>
                                                             </td>
                                                             <td><?php echo $cl['cloth_name']?></td>
                                                             <td><?php echo $cl['price']?></td>
                                                             <td>
                                                                 <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                                     data-bs-toggle="modal"
                                                                     data-bs-target=".bd-example1-modal-lg_<?php echo $cl['cloth_id'] ?>"><i
                                                                         class="fa fa-pencil"></i></a>
                                                                 <a href="#" onclick="delete_data_laundry(<?php echo $cl['cloth_id'] ?>)"   class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
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
    <?php
                                                 
                                                 $i = 1;
                             
                                                 if($list)
                                                 {
                                                     foreach($list as $cl)
                                                     {
                                             ?>
                                                         <div class="modal fade bd-example1-modal-lg_<?php echo $cl['cloth_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                                             <div class="modal-dialog modal-md">
                                                                 <div class="modal-content">
                                                                     <div class="modal-header">
                                                                         <h5 class="modal-title">Update Cloth</h5>
                                                                         <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                         </button>
                                                                     </div>
                                                                     <form action="<?php echo base_url('HoteladminController/edit_cloth')?>" method="post" enctype="multipart/form-data">
                                                                         <input type="hidden" name="cloth_id" value="<?php echo $cl['cloth_id'] ?>">
                                                                         <div class="modal-body">
                                                                             <div class="col-lg-12">
                                                                                 <div class="basic-form">
                                                                                     <div class="row">
                                                                                         <div class="mb-3 col-md-12 form-group">
                                                                                             <label class="form-label">Cloth Icon</label>
                                                                                             <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $cl['image']?>">
                                                                                         </div>
                                                                                         <div class="mb-3 col-md-12 form-group">
                                                                                             <label class="form-label">Cloth Name</label>
                                                                                             <input type="text" name="cloth_name" value="<?php echo $cl['cloth_name'] ?>" class="form-control" value="saree" required="">
                                                                                         </div>
                                                                                         <div class="mb-3 col-md-12 form-group">
                                                                                             <label class="form-label">Price</label>
                                                                                             <input type="number" name="price" value="<?php echo $cl['price'] ?>" class="form-control" value="300" required="">
                                                                                         </div>
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>
                                                                         <div class="modal-footer">
                                                                             <div class="text-center">
                                                                                 <button type="submit" class="btn btn-primary css_btn">Update</button>
                                                                                 <button type="button" data-bs-dismiss="modal" class="btn btn-light css_btn">Close</button>
                                                                             </div>
                                                                         </div>
                                                                     </form>
                                                                 </div>
                                                             </div>
                                                         </div>
                                             <?php
                                                     }
                                                 }
                                             ?>
                                                                
                              <?php }else if($icon_id == 2){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Services</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body "> 
            <div>
                            <button style="float:right;" type="button" class="btn btn-primary css_btn"
                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Service</button>
                        </div>
                        <br>
                        <br>
                        <!-- Add Cloth  -->
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Service</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('HoteladminController/add_housekeeping_service')?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <div class="basic-form">
                                                    <div class="row">
                                                    <div class="mb-3 col-md-12 form-group">
                                                                <label class="form-label">Service Name</label>
                                                                <input type="text" name="service_type" class="form-control" placeholder="Service Name" required>
                                                            </div>
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label">Icon</label>
                                                                <input type="file" name="icon" class="form-control" accept="image/jpeg, image/png," required>
                                                            </div>
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" name="amount" min="0" class="form-control" placeholder="Price" required>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-info">Add</button>
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
                                                        <th><strong>Service Name</strong></th>
                                                        <th><strong>Icon</strong></th>
                                                        <th><strong>Price</strong></th>
                                                        <th><strong>Status</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">

                        <?php
                                                 
                                                 $i = 1;
 
                                                 if($list)
                                                 {
                                                     foreach($list as $hk_s)
                                                     {
                                             ?>
                                                 <tr>
                                                     <td><strong><?php echo $i++?></strong></td>
                                                     <td><?php echo $hk_s['service_type']?></td>
                                                     <td>
                                                         <div class="lightgallery">
                                                             <a href="<?php echo $hk_s['icon']?>"
                                                                 data-exthumbimage="<?php echo $hk_s['icon']?>"
                                                                 data-src="<?php echo $hk_s['icon']?>"
                                                                 class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                 <img class="me-3 "
                                                                     src="<?php echo $hk_s['icon']?>"
                                                                     alt="" style="width:60px; height:40px;">
                                                             </a>
                                                         </div>
                                                     </td>
                                                     <td>
                                                         <?php echo $hk_s['amount']?>
                                                     </td>
                                                     <td>
                                                         <select  id="status_<?php echo $hk_s['h_k_services_id']?>" onchange="change_status(<?php echo $hk_s['h_k_services_id']?>)"
                                                             class="default-select form-control wide">
                                                             <option <?php if($hk_s['is_active'] == 1) {echo "Selected";}?> value="1">Active</option>
                                                             <option <?php if($hk_s['is_active'] == 0) {echo "Selected";}?> value="0">Deactive</option>
                                                         </select>
                                                     </td>
                                                     <td>
                                                         <!-- <div class="d-flex"> -->
                                                         <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                                             data-bs-toggle="modal"
                                                             data-bs-target=".bd-example1-modal-lg_<?php echo $hk_s['h_k_services_id']?>"><i
                                                                 class="fa fa-pencil"></i></a>
                                                         <a href="#" onclick="delete_data_service(<?php echo $hk_s['h_k_services_id'] ?>)"
                                                             class="btn btn-danger shadow btn-xs sharp"><i
                                                                 class="fa fa-trash"></i></a>
                                                         <!-- </div> -->
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
    <?php
            
            if($list)
            {
                foreach($list as $hk_s)
                {
        ?>
                <div class="modal fade bd-example1-modal-lg_<?php echo $hk_s['h_k_services_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/edit_housekeeping_service')?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="h_k_services_id" value="<?php echo $hk_s['h_k_services_id']?>">
                                <div class="modal-body">
                                    <div class="col-lg-12">
                                        <div class="basic-form">
                                            <div class="row">
                                                <div class="mb-3 col-md-6 form-group">
                                                    <label class="form-label">Service Name</label>
                                                    <input type="text" name="service_type" value="<?php echo $hk_s['service_type']?>" class="form-control" placeholder="Service Name">
                                                </div>
                                               
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" min="0" class="form-control" name="amount" value="<?php echo $hk_s['amount']?>">
                                                </div>  
                                               <div class="mb-3 col-md-6">
                                                    <label class="form-label">Icon</label>
                                                    <input type="file" class="dropify form-control" name="icon" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $hk_s['icon']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">Update </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
                }
            }
        ?>
   
                                                                
                              <?php }else if($icon_id == 3){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Room Status</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body "> 
           
                        <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="tab-content">
                            <div id="All_rooms" class="tab-pane active">
                                <!-- <div class="card"> -->
                                <!-- <div class="card-header border-0 flex-wrap">
                                    <h1 class="card-title">All Rooms</h1>
                                </div> -->

                                <!-- for room section  -->
                                <div class="row" style="--bs-gutter-x: 13px;">
                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-3 flex-wrap">
                                                <h4 class="card-title text-black"><b>C/Out/Dirty Rooms</b></h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row row-cols-8 ">
                                      				 <?php 
                                                        if(!empty($get_dirty_rooms))
                                                        {
                                                            foreach($get_dirty_rooms as $g)
                                                            {
                                                               
                                                     ?>
                                                        <div class="room_card card red" data-bs-toggle="modal"
                                                            data-bs-target=".add_<?php echo $g['room_status_id']?>">
                                                            <span class="room_no "><?php echo $g['room_no']?></span>
                                                        </div>
                                                  
                                                        <!-- Modal for checkout rooms-->
                                                          <div class="modal fade add_<?php echo $g['room_status_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                              <div class="modal-dialog modal-lg">
                                                                  <div class="modal-content">
                                                                      <div class="modal-header">
                                                                          <h5 class="modal-title"> C/Out/Dirty Room:</h5>
                                                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                          </button>
                                                                      </div>
                                                                      <div class="modal-body">

                                                                          <!-- <div class="card">
                                                                          <div class="card-body"> -->
                                                                          <div class="basic-form">
                                                                              <form action="<?php echo base_url('HoteladminController/dirty_room_sts_update')?>" method="POST">
                                                                                  <div class="row">
                                                                                      <div class="mb-3 col-md-6">
                                                                                          <label class="form-label">Room NO.</label>
                                                                                          <input type="text" value="<?php echo $g['room_no']?>" disabled class="form-control">
                                                                                      </div>
                                                                                      <div class="mb-3 col-md-6">
                                                                                          <label class="form-label">Checkout Time</label>
                                                                                          <input type="#" disabled class="form-control" placeholder="10.00AM">
                                                                                      </div>
                                                                                     <input type="hidden" name="room_status_id" value="<?php echo $g['room_status_id']?>">
                                                                                      <div class="mb-3 col-md-6">
                                                                                          <label class="form-label">Status</label>
                                                                                          <select id="inputState" name="room_status" class="default-select form-control wide" required>
                                                                                              <option value="" selected>Choose</option>
                                                                                              <option value="3">Open For Guest</option>
                                                                                              <option value="4">Under Maintance</option>
                                                                                          </select>
                                                                                      </div>
                                                                                      
                                                                                      <div class="text-center">
                                                                                          <button type="submit" class="btn btn-primary css_btn">Save</button>
                                                                                              
                                                                                          <button type="button" class="btn btn-light css_btn"
                                                                                              data-bs-dismiss="modal">Close</button>
                                                                                      </div>
                                                                                  </div>
                                                                            </form>
                                                                          </div>
                                                                          <!-- </div>
                                                                      </div> -->
                                                                      </div>

                                                                  </div>
                                                              </div>
                                                          </div>
                                                          <!-- end of checkout rooms modal  -->
                                                     <?php 
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-3 flex-wrap">
                                                <h4 class="card-title text-black"><b>Occupied Rooms</b></h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row row-cols-8 ">
                                                    <?php 
                                                        if(!empty($get_accupied_rooms))
                                                        {
                                                            foreach($get_accupied_rooms as $a)
                                                            {
  
                                                    ?>
                                                      <div class="room_card card blue">
                                                          <span class="room_no "><?php echo $a['room_no']?></span>
                                                      </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-3 flex-wrap">
                                                <h4 class="card-title text-black"><b>Available Guest</b></h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row row-cols-8 ">
                                                  	<?php 
                                                        if(!empty($get_available_rooms))
                                                        {
                                                            foreach($get_available_rooms as $a_room)
                                                            {
                                                              
  
                                                    ?>
                                                        <div class="room_card card yellow">
                                                            <span class="room_no "><?php echo $a_room['room_no']?></span>
                                                        </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-3 flex-wrap">
                                                <h4 class="card-title text-black"><b>Under Maintenance Rooms</b></h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="row row-cols-8 ">
                                                  <?php 
                                                        if(!empty($get_under_maintenance_rooms))
                                                        {
                                                            foreach($get_under_maintenance_rooms as $u_room)
                                                            {
  
                                                    ?>
                                                    <div class="room_card card main_rm" data-bs-toggle="modal"
                                                        data-bs-target=".remove_<?php echo $u_room['room_status_id']?>">
                                                        <span class="room_no" data-bs-toggle="modal"
                                                            data-bs-target=".remove_<?php echo $u_room['room_status_id']?>"><?php echo $u_room['room_no']?></span>
                                                    </div>
                                                  
                                                      <!-- Modal for maintance rooms-->
                                                            <div class="modal fade remove_<?php echo $u_room['room_status_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"> Under Maintenance Room:</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <!-- <div class="card">
                                                                            <div class="card-body"> -->
                                                                            <div class="basic-form">
                                                                       <form action="<?php echo base_url('HoteladminController/under_maintainance_room_sts_update')?>" method="POST">
                                                                                    <div class="row">
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Room NO.</label>
                                                                                            <input type="text" value="<?php echo $u_room['room_no']?>" disabled class="form-control" placeholder="101">
                                                                                        </div>
                                                                                        <!-- <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Checkout Time</label>
                                                                                        <input type="#" disabled class="form-control" placeholder="10.00AM">
                                                                                    </div> -->
                                                                                        <div class="mb-3 col-md-6">
                                                                                           <input type="hidden" name="room_status_id" value="<?php echo $u_room['room_status_id']?>">
                                                                                            <label class="form-label">Status</label>
                                                                                             <select id="inputState" name="room_status" class="default-select form-control wide" required>
                                                                                                <option value="" selected>Choose...</option>
                                                                                            	<option value="3">Open For Guest</option>
                                                                                                
                                                                                            </select>
                                                                                        </div>
                                                                                       
                                                                                        <div class="text-center">
                                                                                            <button type="submit" class="btn btn-primary css_btn">Save</button>
                                                                                               
                                                                                            <button type="button" class="btn btn-light css_btn"
                                                                                                data-bs-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <!-- </div>
                                                                        </div> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                     <!-- </div>-->
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
                </div>
            
                
            </div>
        </div>
    </div>
   
                                                                
                              <?php }?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
       function delete_data_laundry(id)
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
                            url     : base_url + "HoteladminController/delete_cloth",
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
        function delete_data_service(id)
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
                            url     : base_url + "HoteladminController/delete_house_keeping_service",
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
        function change_status(id)
        {
            var base_url = '<?php echo base_url()?>';
            var status = $('#status_'+id).children("option:selected").val();
            var id = id;
        
            if(status != '')
            {
                $.ajax({
                            url : base_url + "HoteladminController/change_housekeeping_service_status",
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