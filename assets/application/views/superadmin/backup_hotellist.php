 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($hotel_data);
// 	 exit;
     ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     <style>
        .next_section_model{
            display:none
        }
     </style>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">New Order</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">New Order</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Manage Order</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                            Create Hotel<i class="fa fa-plus"></i>
                        </button>
                    </div>
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                         <th><strong>Hotel Id</strong></th>
                                        <th><strong>Register Date</strong></th>
                                        <th><strong>Hotel Name</strong></th>
                                        <th><strong>Admin Name</strong></th>
                                        <th><strong>City</strong></th>
                                        <th><strong>Area</strong></th>
                                        <th><strong>Pincode</strong></th>
                                        <th><strong>Wallet Amt</strong></th>
                                        <!-- <th><strong>ClosureLead Count</strong></th> -->
                                        <th><strong>Stauts</strong></th>
                                        <th><strong>Action</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            <?php 
                                if(!empty($hotel_data)){
                                    $i=1;
                                    foreach($hotel_data as $l)
                                    {
                                   ?>
                                    <tr>
                                        <td><?php echo $i?></td>
                                        <td><?php echo $l['register_date']?></td>
                                        <td><?php echo $l['hotel_name']?></td>
                                        <td><?php echo $l['full_name']?></td>
                                        <td><?php echo $l['city']?></td>
                                        <td><?php echo $l['area']?></td>
                                        <td><?php echo $l['pincode']?></td>
                                        <td><?php echo $l['wallet_points']?></td>
                                        <td><?php echo $l['is_active']?></td>
                                        <td>
                                         <a href="javascript:void(0)" data-id="<?= $l['u_id']?>" class="btn btn-tbl-edit btn-xs update_facility_modal">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                       <button class="btn btn-tbl-delete btn-xs">
                                                            <i class="fa fa-trash-o "></i>
                                                        </button>
                                        </td>
                                      
                                    </tr>
                                <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_hotel_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="first_model">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Hotel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Hotel Name</label>
                                                <input type="text" name="hotel_name" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Admin Name</label>
                                                <input type="text" name="full_name" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Hotel Coordinates</label>
                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="latitude" id="latitude"
                                                                        placeholder="Latitude" required="">
                                                                   
                                                                    <input type="text" class="form-control"
                                                                        name="longitude" id="longitude"
                                                                        placeholder="Longitude" required="">
                                                                
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="text" name="email_id" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Password</label>
                                                <input type="text" name="password" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Contact number</label>
                                                <input type="text" name="mobile_no" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Area</label>
                                                <input type="text" name="area" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Pin Code</label>
                                                <input type="text" name="pincode" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">City</label>
                                                <input type="text" name="city" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" name="state" class="form-control" required>
                                            </div> 
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Hotel Logo</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="hotel_logo" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" id="summernote" cols="30" rows="10"></textarea>
                                            </div> -->
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Add</button>
                            <button type="button" class="btn btn-primary next_btn" >next</button>

                        </div>
                    </form>
                </div>      

                </div>
                <div class="next_section_model">
                <div class="tab-content">
                            <div class="tab-pane active show" id="create">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Form step</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="smartwizard" class="form-wizard order-create sw sw-justified sw-theme-default">
                                    
                                            <div class="tab-content" style="height: 438.688px;">
                                                <div id="wizard_Time" class="tab-pane" role="tabpanel" style="display: block;">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Sr.No</th>
                                                                        <th>Name</th>
                                                                        <th>Permission</th>
                                                                        <th>Validity</th>
                                                                        <th>Price</th>
                                                                    </tr>
                                                                </thead>



                                                                <tbody>
                                                                                                                                        <tr>
                                                                        <td> 1 </td>
                                                                        <input type="hidden" name="department_id[]" id="department_id" value="1">

                                                                        <td> Hotel Admin </td>
                                                                        <!-- <input type="hidden" name="department_name[]" id="department_name"  value="Hotel Admin"> -->

                                                                        <td>
                                                                            <div class="form-check custom-checkbox mb-3 checkbox-success check-lg" style="margin:auto" data-toggle="collapse" data-target="#demo2">
                                                                                <input type="checkbox" class="form-check-input" value="1" id="dep_1" name="department_status[]" onclick="Show_hide_Fun(this)">
                                                     <input type="hidden" name="department_name[]" id="department_name" value="Hotel Admin"> 
                                                                                <label class="form-check-label" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                        <!-- <td style="width:300px;">
                                                            <div class="input-group input-daterange " style="width:250px;">
                                                               <input type="date" class="start-date form-control"  id="form_date" name="start_date[]" autocomplete="off">
                                                               <span class="input-group-addon" style="padding:8px">to</span>
                                                               <input type="date" class="end-date form-control" id="to_date" name="end_date[]" autocomplete="off">
                                                            </div>
                                                         </td> -->
                                                                        <td style="width:300px;">
                                                                            <div class="input-group input-daterange " style="width:250px;">
                                                                                <input type="date" min="2023-03-10" class=" form-control" id="form_date_dep_1" name="start_date[]" autocomplete="off">
                                                                                <span class="input-group-addon" style="padding:8px">to</span>
                                                                                <input type="date" min="2023-03-10" class="form-control" id="to_date_dep_1" name="end_date[]" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="price[]" id="price_dep_1" class="form-control" style="width:100px;margin:auto">
                                                                        </td>
                                                                    </tr>

                                                                                                                                        
                                                                                                                                        <tr>
                                                                        <td> 2 </td>
                                                                        <input type="hidden" name="department_id[]" id="department_id" value="1">

                                                                        <td> Front Office </td>
                                                                        <!-- <input type="hidden" name="department_name[]" id="department_name"  value="Front Office"> -->

                                                                        <td>
                                                                            <div class="form-check custom-checkbox mb-3 checkbox-success check-lg" style="margin:auto" data-toggle="collapse" data-target="#demo2">
                                                                                <input type="checkbox" class="form-check-input" value="2" id="dep_2" name="department_status[]" onclick="Show_hide_Fun(this)">
                                                     <input type="hidden" name="department_name[]" id="department_name" value="Front Office"> 
                                                                                <label class="form-check-label" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                        <!-- <td style="width:300px;">
                                                            <div class="input-group input-daterange " style="width:250px;">
                                                               <input type="date" class="start-date form-control"  id="form_date" name="start_date[]" autocomplete="off">
                                                               <span class="input-group-addon" style="padding:8px">to</span>
                                                               <input type="date" class="end-date form-control" id="to_date" name="end_date[]" autocomplete="off">
                                                            </div>
                                                         </td> -->
                                                                        <td style="width:300px;">
                                                                            <div class="input-group input-daterange " style="width:250px;">
                                                                                <input type="date" min="2023-03-10" class=" form-control" id="form_date_dep_2" name="start_date[]" autocomplete="off">
                                                                                <span class="input-group-addon" style="padding:8px">to</span>
                                                                                <input type="date" min="2023-03-10" class="form-control" id="to_date_dep_2" name="end_date[]" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="price[]" id="price_dep_2" class="form-control" style="width:100px;margin:auto">
                                                                        </td>
                                                                    </tr>

                                                                    
                                                                    <tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="1" class="form-check-input"  name="service_name[]" id="cb1_1"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="2" class="form-check-input"  name="service_name[]" id="cb1_2"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="3" class="form-check-input"  name="service_name[]" id="cb1_3"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="4" class="form-check-input"  name="service_name[]" id="cb1_4"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="5" class="form-check-input"  name="service_name[]" id="cb1_5"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="6" class="form-check-input"  name="service_name[]" id="cb1_6"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="7" class="form-check-input"  name="service_name[]" id="cb1_7"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="8" class="form-check-input"  name="service_name[]" id="cb1_8"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_2_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_2_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Bussiness Center">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_1" name="services_id[]" id="cb_1">

                                                                                   


                                                                                        <label class="new_lable" for="cb_1">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_center.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Bussiness Center</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Spa">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_2" name="services_id[]" id="cb_2">

                                                                                   


                                                                                        <label class="new_lable" for="cb_2">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/spa.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Spa</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Gym">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_3" name="services_id[]" id="cb_3">

                                                                                   


                                                                                        <label class="new_lable" for="cb_3">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/gym.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Gym</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Pool">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_4" name="services_id[]" id="cb_4">

                                                                                   


                                                                                        <label class="new_lable" for="cb_4">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/pool.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Pool</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Cab">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_5" name="services_id[]" id="cb_5">

                                                                                   


                                                                                        <label class="new_lable" for="cb_5">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/cab.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Cab</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Clockroom">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_6" name="services_id[]" id="cb_6">

                                                                                   


                                                                                        <label class="new_lable" for="cb_6">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/lockroom.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Clockroom</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Baby Care">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_7" name="services_id[]" id="cb_7">

                                                                                   


                                                                                        <label class="new_lable" for="cb_7">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/baby.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Baby Care</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Wash car">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_8" name="services_id[]" id="cb_8">

                                                                                   


                                                                                        <label class="new_lable" for="cb_8">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/car_wash.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Wash car</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Shuttle Service">
                                                                                    <input type="hidden" name="department_id[]" value="2">
                                                                                    <!-- <input type="checkbox" value="12" class="form-check-input"  name="service_name[]" id="cb1_12"/> -->
                                                                                    <input type="checkbox" value="2_12" name="services_id[]" id="cb_12">

                                                                                   


                                                                                        <label class="new_lable" for="cb_12">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/shuttle.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Shuttle Service</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                                                                                            </tr>
                                                                                                                                        <tr>
                                                                        <td> 3 </td>
                                                                        <input type="hidden" name="department_id[]" id="department_id" value="1">

                                                                        <td> Room Service </td>
                                                                        <!-- <input type="hidden" name="department_name[]" id="department_name"  value="Room Service"> -->

                                                                        <td>
                                                                            <div class="form-check custom-checkbox mb-3 checkbox-success check-lg" style="margin:auto" data-toggle="collapse" data-target="#demo2">
                                                                                <input type="checkbox" class="form-check-input" value="3" id="dep_3" name="department_status[]" onclick="Show_hide_Fun(this)">
                                                     <input type="hidden" name="department_name[]" id="department_name" value="Room Service"> 
                                                                                <label class="form-check-label" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                        <!-- <td style="width:300px;">
                                                            <div class="input-group input-daterange " style="width:250px;">
                                                               <input type="date" class="start-date form-control"  id="form_date" name="start_date[]" autocomplete="off">
                                                               <span class="input-group-addon" style="padding:8px">to</span>
                                                               <input type="date" class="end-date form-control" id="to_date" name="end_date[]" autocomplete="off">
                                                            </div>
                                                         </td> -->
                                                                        <td style="width:300px;">
                                                                            <div class="input-group input-daterange " style="width:250px;">
                                                                                <input type="date" min="2023-03-10" class=" form-control" id="form_date_dep_3" name="start_date[]" autocomplete="off">
                                                                                <span class="input-group-addon" style="padding:8px">to</span>
                                                                                <input type="date" min="2023-03-10" class="form-control" id="to_date_dep_3" name="end_date[]" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="price[]" id="price_dep_3" class="form-control" style="width:100px;margin:auto">
                                                                        </td>
                                                                    </tr>

                                                                                                                                        
                                                                                                                                        <tr>
                                                                        <td> 4 </td>
                                                                        <input type="hidden" name="department_id[]" id="department_id" value="1">

                                                                        <td> Food &amp; Beverages </td>
                                                                        <!-- <input type="hidden" name="department_name[]" id="department_name"  value="Food & Beverages"> -->

                                                                        <td>
                                                                            <div class="form-check custom-checkbox mb-3 checkbox-success check-lg" style="margin:auto" data-toggle="collapse" data-target="#demo2">
                                                                                <input type="checkbox" class="form-check-input" value="4" id="dep_4" name="department_status[]" onclick="Show_hide_Fun(this)">
                                                     <input type="hidden" name="department_name[]" id="department_name" value="Food &amp; Beverages"> 
                                                                                <label class="form-check-label" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                        <!-- <td style="width:300px;">
                                                            <div class="input-group input-daterange " style="width:250px;">
                                                               <input type="date" class="start-date form-control"  id="form_date" name="start_date[]" autocomplete="off">
                                                               <span class="input-group-addon" style="padding:8px">to</span>
                                                               <input type="date" class="end-date form-control" id="to_date" name="end_date[]" autocomplete="off">
                                                            </div>
                                                         </td> -->
                                                                        <td style="width:300px;">
                                                                            <div class="input-group input-daterange " style="width:250px;">
                                                                                <input type="date" min="2023-03-10" class=" form-control" id="form_date_dep_4" name="start_date[]" autocomplete="off">
                                                                                <span class="input-group-addon" style="padding:8px">to</span>
                                                                                <input type="date" min="2023-03-10" class="form-control" id="to_date_dep_4" name="end_date[]" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="price[]" id="price_dep_4" class="form-control" style="width:100px;margin:auto">
                                                                        </td>
                                                                    </tr>

                                                                    
                                                                    <tr id="dep_4_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_4_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Banquet hall">
                                                                                    <input type="hidden" name="department_id[]" value="4">
                                                                                    <!-- <input type="checkbox" value="9" class="form-check-input"  name="service_name[]" id="cb1_9"/> -->
                                                                                    <input type="checkbox" value="4_9" name="services_id[]" id="cb_9">

                                                                                   


                                                                                        <label class="new_lable" for="cb_9">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_hall.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Banquet hall</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Table reserve">
                                                                                    <input type="hidden" name="department_id[]" value="4">
                                                                                    <!-- <input type="checkbox" value="9" class="form-check-input"  name="service_name[]" id="cb1_9"/> -->
                                                                                    <input type="checkbox" value="4_10" name="services_id[]" id="cb_10">

                                                                                   


                                                                                        <label class="new_lable" for="cb_10">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/t_reserve.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Table reserve</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                    </tr><tr id="dep_4_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_4_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Banquet hall">
                                                                                    <input type="hidden" name="department_id[]" value="4">
                                                                                    <!-- <input type="checkbox" value="10" class="form-check-input"  name="service_name[]" id="cb1_10"/> -->
                                                                                    <input type="checkbox" value="4_9" name="services_id[]" id="cb_9">

                                                                                   


                                                                                        <label class="new_lable" for="cb_9">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/b_hall.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Banquet hall</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Table reserve">
                                                                                    <input type="hidden" name="department_id[]" value="4">
                                                                                    <!-- <input type="checkbox" value="10" class="form-check-input"  name="service_name[]" id="cb1_10"/> -->
                                                                                    <input type="checkbox" value="4_10" name="services_id[]" id="cb_10">

                                                                                   


                                                                                        <label class="new_lable" for="cb_10">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/t_reserve.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Table reserve</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                                                                                            </tr>
                                                                                                                                        <tr>
                                                                        <td> 5 </td>
                                                                        <input type="hidden" name="department_id[]" id="department_id" value="1">

                                                                        <td> Housekeeping Service </td>
                                                                        <!-- <input type="hidden" name="department_name[]" id="department_name"  value="Housekeeping Service"> -->

                                                                        <td>
                                                                            <div class="form-check custom-checkbox mb-3 checkbox-success check-lg" style="margin:auto" data-toggle="collapse" data-target="#demo2">
                                                                                <input type="checkbox" class="form-check-input" value="5" id="dep_5" name="department_status[]" onclick="Show_hide_Fun(this)">
                                                     <input type="hidden" name="department_name[]" id="department_name" value="Housekeeping Service"> 
                                                                                <label class="form-check-label" for=""></label>
                                                                            </div>
                                                                        </td>
                                                                        <!-- <td style="width:300px;">
                                                            <div class="input-group input-daterange " style="width:250px;">
                                                               <input type="date" class="start-date form-control"  id="form_date" name="start_date[]" autocomplete="off">
                                                               <span class="input-group-addon" style="padding:8px">to</span>
                                                               <input type="date" class="end-date form-control" id="to_date" name="end_date[]" autocomplete="off">
                                                            </div>
                                                         </td> -->
                                                                        <td style="width:300px;">
                                                                            <div class="input-group input-daterange " style="width:250px;">
                                                                                <input type="date" min="2023-03-10" class=" form-control" id="form_date_dep_5" name="start_date[]" autocomplete="off">
                                                                                <span class="input-group-addon" style="padding:8px">to</span>
                                                                                <input type="date" min="2023-03-10" class="form-control" id="to_date_dep_5" name="end_date[]" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="price[]" id="price_dep_5" class="form-control" style="width:100px;margin:auto">
                                                                        </td>
                                                                    </tr>

                                                                    
                                                                    <tr id="dep_5_tr" style="display:none;">
                                                                        <td colspan="5">
                                                                            <div id="dep_5_box" style="display:none">
                                                                                <div class=" d-flex">

                                                                                                                                                                          <input type="hidden" name="services_name[]" value="Laundry">
                                                                                    <input type="hidden" name="department_id[]" value="5">
                                                                                    <!-- <input type="checkbox" value="11" class="form-check-input"  name="service_name[]" id="cb1_11"/> -->
                                                                                    <input type="checkbox" value="5_11" name="services_id[]" id="cb_11">

                                                                                   


                                                                                        <label class="new_lable" for="cb_11">
                                                                                        <div class="service_card">
                                                                                            <div class="card-body" style="padding: 1rem;">
                                                                                                <div class="text-center">

                                                                                                    <img src=" https://testingsites.in/AtMyTip/Super_Admin/documents/laundry.png" alt="" style="height:30px;">
                                                                                                </div>

                                                                                                <div class="text-center">

                                                                                                    <span style="color:white">Laundry</span>

                                                                                                </div>
                                                                                             
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                                                                                                    </div>
                                                                            </div>
                                                                        </td>
                                                                                                                                            </tr>
                                                                                                                                    </tbody>
                                                            <tfoot></tfoot></table>
                                                            <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                                                                <button class="btn btn-warning css_btn sw-btn-prev" type="button">Previous</button>
                                                                <!-- <button class="btn btn-primary css_btn sw-btn-next disabled" name= "form"
                                                                        type="submit">Next</button> -->
                                                                <input type="submit" class="btn" name="submit" value="Submit">
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div> 
                                                </div>
                                            </div>
                                            <!-- <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                                       <button class="btn btn-warning css_btn sw-btn-prev"
                                          type="button">Previous</button><button
                                          class="btn btn-primary css_btn sw-btn-next disabled"
                                          type="button">Next</button>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
              
                <div>
             <script>
                $(document).ready(function(){
                    $(".next_btn").click(function(){
                       $(".next_section_model").show();
                       $(".first_model").hide();
                    })
                })
             </script>
               
            </div>
        </div>
        <!-- end add btn modal -->

<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    $(document).on("click",".add_hotel",function(){
        $(".add_hotel_modal").modal('show');
    });

    // $(document).on("click",".update_facility_modal",function(){
    //     var data_id = $(this).attr('data-id');
    //     alert(data_id);
    //     $(".add_facility_modal").modal('show');
    // });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdmincontroller/add_hotels') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {

                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_order_modal").modal('hide');
                  $(".successmessage").show();
                //  $(".append_data").html(order_block);
                 // if(res != 'notfound'){
                 //    if(res.success == 1){
                 //        var order_block = res.block != undefined ? res.block : '';
                 //        $(".append_data").html(order_block);
                 //    }else{
                 //        alert(res.block);
                 //    }
                 // }
                    
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);

               
            }
        });
    });

</script>