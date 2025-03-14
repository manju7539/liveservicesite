<style>
   .form-control:disabled, .form-control[readonly] {
   background-color: white!important;
   opacity: 1;
   }
</style>
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
   .list_housekeeping .container-fluid{
   padding:0px
   }
</style>
<?php if($icon_id == 1){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success successmessage11" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Cloth Already Exiest.</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>List Of Service</header>
      </div>
      <div class="card-body" style="padding: 0.3rem 20px;">
         <button style="float:left;" type="button" class="btn btn-primary css_btn"
            data-bs-toggle="modal" id="timing_btn" data-id="<?= $laundry_time['laundry_time_id']?? ''?>" data-bs-target="#exampleModalCenter">
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
         PickUp Timing- <?php echo date('G:i:s',strtotime($pick_up_start_time)) ?> to <?php echo date('G:i:s',strtotime($pick_up_end_time)) ?> <b>/</b> 
         Drop Timing- <?php echo date('G:i:s',strtotime($drop_start_time)) ?> to <?php echo date('G:i:s',strtotime($drop_end_time)) ?>
         <?php
            }
            else
            {
                echo "Add pick and drop time";
            }
            ?>
         </button>
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
                  <form id="adddclothform" method="post" enctype="multipart/form-data">
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
      <div class="table-scrollable1 table-scrollable">
         <table id="laundaryService" class="display full-width">
            <thead>
               <tr>
                  <th><strong>Sr. No.</strong></th>
                  <th><strong>Cloth Icon</strong></th>
                  <th><strong>Cloth Name </strong></th>
                  <th><strong>Price</strong></th>
                  <th><strong>Action</strong></th>
               </tr>
            </thead>
            <tbody class="cloth_data">
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
                        <a href="<?php echo $cl['image']?>" target="_blank"
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
                     <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $cl['cloth_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                     <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $cl['cloth_id']?>" ><i class="fa fa-trash"></i></a> 
                   
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
<?php }else if($icon_id == 2){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="alert alert-success successmessage14" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success updatemessage2" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success successmessage15" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Service Already Exiest.</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>List Of Services</header>
      </div>
      <div class="card-body ">
         <div>
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
               data-bs-toggle="modal" data-bs-target=".add_service_model">Add Service</button>
         </div>
         <br>
         <br>
         <!-- Add Cloth  -->
         <div class="modal fade add_service_model" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Add Service</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form id="adddserviceform" method="post" enctype="multipart/form-data">
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
         <div class="tab-pane" id="house_list_service_div">
         <div class="table-scrollable_listofservice table-scrollable list_housekeeping">
            <table id="listofservice" class="display full-width">
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
               <tbody class="list_of_service_data">
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
                           <a href="<?php echo $hk_s['icon']?>" target="_blank"
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
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data_service" data-id="<?= $hk_s['h_k_services_id']?>" data-bs-target=".update_service_modal"><i class="fa fa-pencil"></i></a> 
                       
                           <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_service" delete-id-service="<?= $hk_s['h_k_services_id']?>" ><i class="fa fa-trash"></i></a> 
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
</div>
<?php }else if($icon_id == 3){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>Room Status</header>
      </div>
      <div class="alert alert-success successmessage" role="alert"  style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Room Status Changed Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
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
                     <div class="row" style="--bs-gutter-x: 13px;" >
                        <div class="col-xl-6">
                           <div class="card card-rm">
                              <div class="card-header border-3 flex-wrap">
                                 <h4 class="card-title text-black"><b>C/Out/Dirty Rooms</b></h4>
                              </div>
                              <div class="card-body" id="dirty_new_room_div">
                                 <div class="row row-cols-8 append_data">
                                    <?php 
                                       if(!empty($get_dirty_rooms))
                                       {
                                           foreach($get_dirty_rooms as $g)
                                           {
                                              
                                       ?>
                                    <div class="room_card card red open_model" data-bs-toggle="modal" id="edit_data5" 
                                       data-id="<?php echo $g['room_status_id']?>"
                                       data-bs-target=".add_dirty_modal">
                                       <span class="room_no ">
                                       <?php echo $g['room_no']?></span>
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
                                 <h4 class="card-title text-black"><b>Occupied Rooms</b></h4>
                              </div>
                              <div class="card-body" id="accupied_room_div">
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
                              <div class="card-body" id="available_room_div">
                                 <div class="row row-cols-8 append_data5">
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
                              <div class="card-body" id="rejected_room_div">
                                 <div class="row row-cols-8 append_data1">
                                    <?php 
                                       if(!empty($get_under_maintenance_rooms))
                                       {
                                           foreach($get_under_maintenance_rooms as $u_room)
                                           {
                                       
                                       ?>
                                    <div class="room_card card main_rm open_under_model" data-bs-toggle="modal" id="data_edit" 
                                       data-id1="<?php echo $u_room['room_status_id']?>"
                                       data-bs-target=".add_under_modal">
                                       <span class="room_no ">
                                       <?php echo $u_room['room_no']?></span>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }?>
<!-- Modal for checkout rooms-->
<div class="modal fade add_dirty_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
               <form  id="frmblock2" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Room NO.</label>
                        <input type="text" name="room_no" id="room_no" disabled class="form-control">
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Checkout Time</label>
                        <input type="#" disabled class="form-control" placeholder="10.00AM">
                     </div>
                     <input type="hidden" name="room_status_id" id="room_status_id1" >
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
<!-- Modal for maintance rooms-->
<div class="modal fade add_under_modal" tabindex="-1" role="dialog" aria-hidden="true">
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
               <form  id="frmblock3" method="post" enctype="multipart/form-data">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Room NO.</label>
                        <input type="text" name="room_no" id="room_no1" disabled class="form-control" placeholder="">
                     </div>
                     <div class="mb-3 col-md-6">
                        <input type="hidden" name="room_status_id" id="room_status_id2">
                        <label class="form-label">Status</label>
                        <select id="inputState" name="room_status" class="default-select form-control wide" required>
                           <option value="" selected>Choose...</option>
                           <option value="3">Open For Guest</option>
                        </select>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary css_btn" >Save</button>   
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
         <form id="timingform"  method="post">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-lg-6">
                        <label class="form-label">Pick Time</label>
                        <div class="input-group">
                           <input type="hidden" name="laundry_time_id" id="laundry_time_id">
                           <input type="time" name="pick_up_start_time" id="pick_up_start_time" class="form-control" required>
                           <input type="time" name="pick_up_end_time" id="pick_up_end_time" class="form-control" required>
                        </div>
                     </div>
                     <div class="mb-3 col-lg-6">
                        <label class="form-label">Drop Time</label>
                        <div class="input-group">
                           <input type="time" name="drop_start_time" id="drop_start_time" class="form-control" required>
                           <input type="time" name="drop_end_time" id="drop_end_time" class="form-control" required>
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
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Update Cloth</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form id="clotheditform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="cloth_id" id="cloth_id">
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-12 form-group">
                           <label class="form-label">Cloth Icon</label>
                           <!-- <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $cl['image']?>"> -->
                           <input type="file" name="image" value="<?php echo $cl['image']?>" class="form-control" placeholder="">
                           <img src="" id="img" alt="Not Found" height="50" width="50">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                           <label class="form-label">Cloth Name</label>
                           <input type="text" name="cloth_name" id="cloth_name" class="form-control" value="saree" required="">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                           <label class="form-label">Price</label>
                           <input type="number" name="price" id="price" class="form-control" value="300" required="">
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
<!-- edit model for service start -->
<div class="modal fade update_service_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form id="serviceeditform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="h_k_services_id" id="h_k_services_id">
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                           <label class="form-label">Service Name</label>
                           <input type="text" name="service_type" id="service_type" class="form-control" placeholder="Service Name">
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Price</label>
                           <input type="number" min="0" class="form-control" name="amount" id="amount">
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Icon</label>
                           <input type="file" name="icon" value="<?php echo $hk_s['icon']?>" class="form-control" placeholder="">
                           <img src="" id="service_icon" alt="Not Found" height="50" width="50">
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
<!-- edit model for service  ennd -->
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script>
    // delete department script
    $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HoteladminController/delete_cloth') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your file has been deleted!", "success");
                        $.get( '<?= base_url('HoteladminController/ajaxclothforpagination');?>', function( data ) {
                       var resu = $(data).find('.table-scrollable1').html();
                   // alert(resu);
                        $('.table-scrollable1').html(resu);
                        setTimeout(function(){
                           $('#laundaryService').DataTable();
                        }, 2000);
                     });

                        $(".loader_block").hide();
                        $(".cloth_data").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }

                });

            } else {
                swal(
                  "Cancelled",
                        "Your imaginary file is safe :)",
                        "error"
                );
            }
        });
    });

   </script>
   <script>
    // delete department script
    $(document).on('click', '#delete_data_service', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id-service');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HoteladminController/delete_house_keeping_service') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your file has been deleted.", "success");
                        $.get( '<?= base_url('HoteladminController/ajaxserviceforpagination');?>', function( data ) {
                        var resu = $(data).find('#house_list_service_div').html();
                        // alert(resu);
                        $('#house_list_service_div').html(resu);
                        setTimeout(function(){
                           $('#listofservice').DataTable();
                        }, 2000);
                     });

                        $(".loader_block").hide();
                        $(".list_of_service_data").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }

                });

            } else {
                swal(
                  "Cancelled",
                        "Your imaginary file is safe :)",
                        "error"
                );
            }
        });
    });

   </script>

<script>
   $(document).ready(function() {
    $('#laundaryService').DataTable();
    $('#listofservice').DataTable();
   
    
   });
</script>
<script>
   $('#adddclothform').submit( function(e){
   
      e.preventDefault(); 
      $(".loader_block").show();
      var form_data = new FormData(this);
      console.log(form_data);
      $.ajax({
          url         : '<?= base_url('HoteladminController/add_cloth') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          // dataType    : 'JSON',
          async:false,
          success     : function(res) {
          
               $.get( '<?= base_url('HoteladminController/ajaxclothforpagination');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable1').html();
                   // alert(resu);
                   $('.table-scrollable1').html(resu);
                   setTimeout(function(){
                       $('#laundaryService').DataTable();
                   }, 2000);
               });
               if(res == 1)
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".bd-example-modal-lg").modal('hide');
                $(".bd-example-modal-lg").on("hidden.bs.modal", function () {
                $("#adddclothform").trigger("reset"); // reset the form fields
                });
                 $(".successmessage11").show();
                 }, 2000);
                 setTimeout(function(){  
                   $(".successmessage11").hide();
                 }, 4000);
               }
               else
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".bd-example-modal-lg").modal('hide');
                $(".bd-example-modal-lg").on("hidden.bs.modal", function() {
                     $("#adddclothform")[0].reset();
                   
                  });
   
                $(".cloth_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
                 setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
            
          }
      });
   });
</script>
<script>
   $(document).ready(function (id) {
           $(document).on('click','#timing_btn',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                   url: '<?= base_url('HoteladminController/getEditDataoftiming') ?>',
                  
                   type: "post",
                   data: {id:id},
                   dataType:"json",
                   success: function (data) {
                       
                       // console.log(data);
                       $('#laundry_time_id').val(data.laundry_time_id);
                       $('#pick_up_start_time').val(data.pick_up_start_time);
                       $('#pick_up_end_time').val(data.pick_up_end_time);
                       $('#drop_start_time').val(data.drop_start_time);
                       $('#drop_end_time').val(data.drop_end_time);
                   }
                   }); 
           })
       });
</script>
<script>
   
      $('#timingform').submit( function(e){
        e.preventDefault();
        
        $(".loader_block").show();
        var form_data = new FormData(this);
      $.ajax({
         url         : '<?= base_url('HoteladminController/set_laundry_picup_drop_time') ?>',
         method      : 'POST',
         data        : form_data,
         processData : false,
         contentType : false,
         cache       : false,
         success: function(res) {
   
            setTimeout(function() {  
               $(".loader_block").hide();
               $("#exampleModalCenter").modal('hide');
               $(".updatemessage").show();
            }, 2000);
   
            setTimeout(function() {  
               $(".updatemessage").hide();
               if (res !== '') {
                  var jsonres = JSON.parse(res) ;
               
                     var updatedContent = "PickUp Timing- " + jsonres.laundry_time.pick_up_start_time + " to " + jsonres.laundry_time.pick_up_end_time + " <b>/</b> Drop Timing- " + jsonres.laundry_time.drop_start_time + " to " + jsonres.laundry_time.drop_end_time;
                     console.log(updatedContent);
                     $("#timing_btn").html(updatedContent);
               }
               else{
                  console.log("Some Thing Is Wrong");
               }
            }, 4000);
         }
      });
   });
</script>
<script>
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                   url: '<?= base_url('HoteladminController/getEditDataofcloth') ?>',
                   type: "post",
                   data: {id:id},
                   dataType:"json",
                   success: function (data) {
                       console.log(data);
                       $('#cloth_id').val(data.cloth_id);
                       $("#img").attr('src',data.image);
                       $('#cloth_name').val(data.cloth_name);
                       $('#price').val(data.price);
                   }
                   }); 
           })
       });
</script>
<script>
     
      $('#clotheditform').submit( function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HoteladminController/edit_cloth') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('HoteladminController/ajaxclothforpagination');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable1').html();
                   // alert(resu);
                   $('.table-scrollable1').html(resu);
                   setTimeout(function(){
                       $('#laundaryService').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".update_staff_modal").modal('hide');
               //  $("#laundaryService").html(res);
                $(".cloth_data").html(res);
                 $(".updatemessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".updatemessage").hide();
                 }, 4000);
   
           }
       });
   });
</script>
<script>
   function change_status(id)
   {
       var base_url = '<?php echo base_url()?>';
       var status = $('#status_'+id).children("option:selected").val();
       var id = id;
    console.log(status);
       if(status != '')
       {
           $.ajax({
                       url : base_url + "HoteladminController/change_housekeeping_service_status",
                       method : "post",
                       data : {status : status,id : id},
                       dataType: "json",
                       success : function(data)
                               {
                                   // alert(data)
                                   if(data == true)
                                   {
                                       alert('Status changed successfully');
                                   }
                                   else
                                   {
                                       alert('something went wrong');
                                   }
                               }
                   });
       }
   }
</script>
<script>
   $(document).ready(function (id) {
           $(document).on('click','#edit_data_service',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                   url: '<?= base_url('HoteladminController/getEditDataofservice') ?>',
                   //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                   type: "post",
                   data: {id:id},
                   dataType:"json",
                   success: function (data) {
                       
                       console.log(data);
                       $('#h_k_services_id').val(data.h_k_services_id);
                       $('#service_type').val(data.service_type);
                       $('#amount').val(data.amount);
                       $("#service_icon").attr('src',data.icon);
   
                       
   
                   }
       
                   
                   }); 
           })
       });
</script>
<script>
   //  $(document).unbind('submit').on('submit', '#serviceeditform', function(e){
   // $(document).on('submit', '#serviceeditform', function(e){
      $('#serviceeditform').submit( function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HoteladminController/edit_housekeeping_service') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".update_service_modal").modal('hide');
               //  $("#laundaryService").html(res);
                $(".list_of_service_data").html(res);
                 $(".updatemessage2").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".updatemessage2").hide();
                 }, 4000);
                  
           }
       });
   });
</script>
<script>
   $(document).unbind('submit').on('submit', '#adddserviceform', function(e){
      e.preventDefault(); 
      $(".loader_block").show();
      var form_data = new FormData(this);
      console.log(form_data);
      $.ajax({
          url         : '<?= base_url('HoteladminController/add_housekeeping_service') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          // dataType    : 'JSON',
          async:false,
          success     : function(res) {
          
               $.get( '<?= base_url('HoteladminController/ajaxserviceforpagination');?>', function( data ) {
                   var resu = $(data).find('#house_list_service_div').html();
                   // alert(resu);
                   $('#house_list_service_div').html(resu);
                   setTimeout(function(){
                       $('#listofservice').DataTable();
                   }, 2000);
               });
               if(res == 1)
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_service_model").modal('hide');
                $(".add_service_model").on("hidden.bs.modal", function () {
                $("#adddserviceform").trigger("reset"); // reset the form fields
                });
                 $(".successmessage15").show();
                 }, 2000);
                 setTimeout(function(){  
                   $(".successmessage15").hide();
                 }, 4000);
               }
               else
               {
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_service_model").modal('hide');
                $(".add_service_model").on("hidden.bs.modal", function() {
                     $("#adddserviceform")[0].reset();
                   
                  });
   
                $(".list_of_service_data").html(res);
                 $(".successmessage14").show();
                 }, 2000);
                 setTimeout(function(){  
                   $(".successmessage14").hide();
                 }, 4000);
               }
   
             
          }
      });
   });
</script>
<script>
   $(document).ready(function (id) {
   $(document).on("click",".open_model",function(){
       $(".add_dirty_modal").modal('show');
   });
   $(document).on("click",".open_under_model",function(){
       $(".add_under_modal").modal('show');
   });
   $(document).on('submit', '#frmblock2', function(e){
      
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HoteladminController/dirty_room_sts_update') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
          
          
               $.get( '<?= base_url('HoteladminController/ajaxstatusdirty');?>', function( data ) {
                  var resu = $(data).find('#dirty_new_room_div').html();
                        var resu1 = $(data).find('#accupied_room_div').html();
                        var resu2 = $(data).find('#available_room_div').html();
                        var resu3 = $(data).find('#rejected_room_div').html();
                        $('#dirty_new_room_div').html(resu);
                        $('#accupied_room_div').html(resu1);
                        $('#available_room_div').html(resu2);
                        $('#rejected_room_div').html(resu3);
                      
                
                });
              
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_dirty_modal").modal('hide');
                     // $(".append_data").html(res);
                     $(".add_dirty_modal").on("hidden.bs.modal", function () {
                     $("#frmblock2")[0].reset(); // reset the form fields
                  });
                 $(".successmessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
            
              
           }
       });
   });
   
           $(document).on('click','#edit_data5',function(){
               var id = $(this).attr('data-id');
            //    alert(id);
               $.ajax({
                                         url: '<?= base_url('HoteladminController/getdirtyData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#room_status_id1').val(data.room_status_id);
                                            $('#room_no').val(data.room_no);
                                          //   $('#check_time').val(data.check_time);
                                            $('#room_status').val(data.room_status);
                                          
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       
     
           $(document).on('click','#data_edit',function(){
               var id = $(this).attr('data-id1');
            //    alert(id);
               $.ajax({
                                         url: '<?= base_url('HoteladminController/getunderData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#room_status_id2').val(data.room_status_id);
                                            $('#room_no1').val(data.room_no);
                                         
                                          
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
     
   
   
   
   
   
   
   $(document).on('submit', '#frmblock3', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HoteladminController/under_maintainance_room_sts_update') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
           
                
               $.get( '<?= base_url('HoteladminController/ajaxstatusdirty');?>', function( data ) {
                  var resu = $(data).find('#dirty_new_room_div').html();
                        var resu1 = $(data).find('#accupied_room_div').html();
                        var resu2 = $(data).find('#available_room_div').html();
                        var resu3 = $(data).find('#rejected_room_div').html();
                        $('#dirty_new_room_div').html(resu);
                        $('#accupied_room_div').html(resu1);
                        $('#available_room_div').html(resu2);
                        $('#rejected_room_div').html(resu3);
                
                });
          
              
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_under_modal").modal('hide');
                $(".append_data5").html(res);
                $(".add_under_modal").on("hidden.bs.modal", function () {
                     $("#frmblock3")[0].reset(); // reset the form fields
                  });
               
                 $(".successmessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
                
              
           }
       });
   });
   });
</script>