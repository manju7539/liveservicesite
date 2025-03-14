<style>
   #example1_wrapper{
   padding:0px;
   }
   .css_btn{
   position: absolute;
   bottom: 11px;
   z-index: 999999;
   }
   .service_card {
   box-shadow: 0 4px 7px rgb(0 0 0 / 19%), 0 6px 6px rgb(0 0 0 / 23%) !important;
   background-color: #ffffff;
   transition: all .5s ease-in-out;
   position: relative;
   border: 2px solid #355980;
   border-radius: 5px;
   box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgb(82 63 105 / 5%);
   height: 100px;
   width: 120px;
   transition: all linear 200ms;
   background-color: #355980;
   }
   input[type="checkbox"][id^="cb"] {
   display: none;
   }
   .new_lable {
   border: 1px solid #fff;
   /* padding: 10px; */
   display: block;data
   position: relative !important;
   margin: 10px;
   cursor: pointer;
   -webkit-touch-callout: none;
   -webkit-user-select: none;
   -khtml-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
   }
   input[type=number]::-webkit-inner-spin-button, 
   input[type=number]::-webkit-outer-spin-button { 
   -webkit-appearance: none; 
   }
   input[type=number] {
   -moz-appearance: textfield;
   min:0;
   }
   .departure_block{
      display:flex;
      flex-wrap:wrap
   }

   .toggleDiv {
   display: none
   }
   .fit-image {
   width: 100%;
   object-fit: cover;
   }
   .datepicker {
   border-radius: 4px;
   direction: ltr;
   -webkit-user-select: none;
   -webkit-touch-callout: none;
   }
   /* basicos */
   .datepicker .day {
   border-radius: 4px;
   }
   .datepicker-dropdown {
   top: 0;
   left: 0;
   padding: 5px;
   }
   .datepicker-dropdown:before {
   content: '';
   display: inline-block;
   border-left: 7px solid transparent;
   border-right: 7px solid transparent;
   border-bottom: 7px solid red;
   border-top: 0;
   border-bottom-color: red;
   position: absolute;
   }
   .datepicker-dropdown:after {
   content: '';
   display: inline-block;
   border-left: 6px solid transparent;
   border-right: 6px solid transparent;
   border-bottom: 6px solid #fff;
   border-top: 0;
   position: absolute;
   }
   .datepicker-dropdown.datepicker-orient-left:before {
   left: 6px;
   }
   .datepicker-dropdown.datepicker-orient-left:after {
   left: 7px;
   }
   .datepicker-dropdown.datepicker-orient-right:before {
   right: 6px;
   }
   .datepicker-dropdown.datepicker-orient-right:after {
   right: 7px;
   }
   .datepicker-dropdown.datepicker-orient-bottom:before {
   top: -7px;
   }
   .datepicker-dropdown.datepicker-orient-bottom:after {
   top: -6px;
   }
   .datepicker-dropdown.datepicker-orient-top:before {
   bottom: -7px;
   border-bottom: 0;
   border-top: 7px solid red;
   }
   .datepicker-dropdown.datepicker-orient-top:after {
   bottom: -6px;
   border-bottom: 0;
   border-top: 6px solid red;
   }
   .datepicker table {
   margin: 0;
   user-select: none;
   }
   .datepicker td,
   .datepicker th {
   text-align: center;
   width: 30px;
   height: 30px;
   border: none;
   }
   .datepicker .datepicker-switch,
   .datepicker .prev,
   .datepicker .next,
   .datepicker tfoot tr th {
   cursor: pointer;
   }
   .datepicker .prev .disabled,
   .datepicker .next .disabled {
   visibility: hidden;
   }
   .datepicker .range-start {
   background: #337ab7 url("../images/range-bg-1.png") top right no-repeat;
   color: #fff;
   }
   .datepicker .range-end {
   background: #337ab7 url("../images/range-bg-2.png") top left no-repeat;
   color: #fff;
   }
   .datepicker .range-start.range-end {
   background-image: none;
   }
   .datepicker .range {
   background: #d5e9f7;
   }
   .datepicker .day:hover,
   .datepicker .month:hover,
   .datepicker .year:hover,
   .datepicker .datepicker-switch:hover,
   .datepicker .next:hover,
   .datepicker .prev:hover {
   background-color: #ff8000;
   color: white;
   border-radius: 4px;
   }
   .hover {
   background-color: #ff8000;
   color: white;
   }
   .datepicker .today {
   font-weight: bold;
   color: #1ed443;
   }
   /* Estilos para meses y años */
   .datepicker-months,
   .datepicker-years {
   width: 213px;
   }
   .datepicker-months td,
   .datepicker-years td {
   width: auto;
   height: auto;
   }
   .datepicker-months .month,
   .datepicker-years .year {
   color: #fff;
   background-color: #337ab7;
   border-color: #2e6da4;
   float: left;
   display: block;
   width: 23%;
   height: 46px;
   line-height: 46px;
   margin: 1%;
   cursor: pointer;
   border-radius: 4px;
   }
   .day.active,
   .start-date-active {
   color: #fff;
   background-color: #337ab7;
   border-color: #2e6da4;
   }
   /* Desactivados */
   .day.disabled,
   .month.disabled,
   .year.disabled,
   .start-date-active.disabled {
   cursor: not-allowed;
   filter: alpha(opacity=65);
   -webkit-box-shadow: none;
   box-shadow: none;
   opacity: .65;
   }
   a:active,
   a:hover {
   outline: 0;
   }
   .checkbox_css {
   width: 20px;
   height: 20px;
   }
   .service_card {
   box-shadow: 0 4px 7px rgb(0 0 0 / 19%), 0 6px 6px rgb(0 0 0 / 23%) !important;
   background-color: #ffffff;
   transition: all .5s ease-in-out;
   position: relative;
   border: 2px solid #355980;
   border-radius: 5px;
   box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgb(82 63 105 / 5%);
   height: 100px;
   width: 120px;
   transition: all linear 200ms;
   background-color: #355980;
   }
   input[type="checkbox"][id^="cb"] {
   display: none;
   }
   .new_lable {
   border: 1px solid #fff;
   /* padding: 10px; */
   display: block;
   position: relative;
   margin: 10px;
   cursor: pointer;
   -webkit-touch-callout: none;
   -webkit-user-select: none;
   -khtml-user-select: none;
   -moz-user-select: none;
   -ms-user-select: none;
   user-select: none;
   }
   .new_lable::before {
   background-color: white;
   color: white;
   content: " ";
   display: block;
   border-radius: 50%;
   border: 1px solid grey;
   position: absolute;
   top: -5px;
   left: -5px;
   width: 25px;
   height: 25px;
   text-align: center;
   line-height: 28px;
   /* transition-duration: 0.4s; */
   transform: scale(0);
   }
   .new_lable img {
   height: 100px;
   transition-duration: 0.2s;
   transform-origin: 50% 50%;
   }
   /*:checked+label {
   border-color: #ddd;
   }*/
   :checked+.new_lable::before {
   content: "✓";
   background-color: #FB9F44;
   transform: scale(1);
   z-index: 1;
   margin-left: 102px;
   right: 0;
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title"> Menu Settings</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Hotels</li>
            </ol>
         </div>
      </div>
      <?php
         if($this->session->flashdata('msg'))
                     {
                 ?>
      <div class="alert alert-primary" role="alert">
         <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
      </div>
      <?php
         }
         ?>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">data Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">data Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Users</header>
               </div>
               <div class="card-body ">
                  <div class="">
                    
                     <div class="table-scrollable">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <th>Main Menu</th>
                              <th>Controller Name</th>
                              <th class="text-center">Action Name</th>
                              <th>Tittle</th>
                              <th>is main Menu Selected</th>
                              <th>Role</th>
                             
                              <!-- //<th class="text-center">Status</th> -->
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
    <?php
    $i = 1;
       if (!empty($panel_admin_list)) {
        foreach ($panel_admin_list as $p_ad) {
            $profile_photo = $p_ad['profile_photo'] ?: base_url('assets/upload/blank_img/blankpic.jpg');

            // User Type Handling
            $user_types = [
                3 => "Front Office",
                5 => "House keeping",
                6 => "Room Service",
                7 => "Foods and Beverage"
            ];
            $user_type = $user_types[$p_ad['user_type']] ?? "Unknown";

            // Shift Type Handling
            $shift_types = [
                1 => "Morning",
                2 => "General",
                3 => "Night"
            ];
            $shift_type = $shift_types[$p_ad['shift_type']] ?? "Unknown";
            ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <div class="lightgallery">
                        <a href="<?= $profile_photo ?>" data-exthumbimage="<?= $profile_photo ?>"
                           data-src="assets/dist/images/tab/staff.png" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                            <img src="<?= $profile_photo ?>" class="img-thumbnail"
                                 style="height: 35px; box-shadow: rgba(0,0,0,0.2) 0px 12px 28px 0px;">
                        </a>
                    </div>
                </td>
                <td><?= $user_type ?></td>
                <td><?= $p_ad['full_name'] ?></td>
                <td><?= $p_ad['email_id'] ?></td>
                <td><?= $p_ad['mobile_no'] ?></td>
                <td><?= $shift_type ?></td>
                <td><?= date('h:i a', strtotime($p_ad['shift_start_time'])) ?> to <?= date('h:i a', strtotime($p_ad['shift_end_time'])) ?></td>
                <td>
                    <a href="#" class="badge badge-rounded badge-secondary booking_id<?= $p_ad['user_type'] - 3 ?>"
                       data-bs-toggle="modal" u-id1="<?= $p_ad['u_id'] ?>"
                       data-bs-target=".bd-view-modal-customer-view<?= $p_ad['user_type'] - 3 ?>">
                        <i class="fa fa-check"></i>
                    </a>
                </td>
                <td><?= $p_ad['password_text'] ?></td>
                <td>
                    <select class="default-select form-control wide" id="status_<?= $p_ad['u_id'] ?>"
                            onchange="change_status(<?= $p_ad['u_id'] ?>)">
                        <option value="1" <?= $p_ad['is_active'] == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $p_ad['is_active'] == 0 ? 'selected' : '' ?>>Deactive</option>
                    </select>
                </td>
                <td>
                    <a href="#" class="btn btn-danger shadow btn-xs sharp me-1" id="delete_data"
                       delete-id="<?= $p_ad['u_id'] ?>">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php }
    } ?>
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
<div class="modal fade bd-add-modal add_hotel_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:90%">
      <div class="modal-content">
         <form id="add_hotel_form"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Hotel</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="first" id="first">
                     <div class="row">
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Hotel Name</label>
                           <input type="text" name="hotel_name" class="form-control" required>
                           <span id="hotel_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Admin Name</label>
                           <input type="text" name="full_name" id="full_name" class="form-control" required>
                           <span id="full_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
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
                              <span id="latitude_results" style="display:none;"
                                 class="text-danger"><b>Field is required
                              </b></span>
                              <span id="longitude_results" style="display:none;"
                                 class="text-danger"><b>Field is required
                              </b></span>
                           </div>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Email</label>
                           <input type="email" name="email_id" id="email_id" class="form-control" required>
                           <span id="email_results" style="display:none;"
                              class="text-danger"><b>Email is already
                           exists</b></span>
                           <span id="emai_results" style="display:none;" class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Password</label>
                           <input type="text" name="password" id="password" class="form-control" required>
                           <span id="password_results" style="display:none;"
                              class="text-danger"><b>Field is required</b>
                           </span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Contact number</label>
                           <input type="text"
                              oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                              maxlength="10" name="mobile_no" class="form-control" id="mobile_no"
                              placeholder="Contact Number" required="">
                           <span id="mobile_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Address</label>
                           <input type="text" name="address" id="address" class="form-control" required>
                           <span id="address_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Area</label>
                           <input type="text" name="area" id="area" class="form-control" required>
                           <span id="area_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Pin Code</label>
                           <input type="text"
                              oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                              maxlength="6" name="pincode" id="pincode" class="form-control"
                              placeholder="Pin Code" required="">
                           <span id="pincode_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">City</label>
                           <select
                              class="default-select form-control wide" name="city"
                              id="city" required="">
                              <option value="">Select
                                 City...
                              </option>
                              <?php
                                 $users=$this->MainModel->getAllTableData($tbl='city');
                                 foreach($users as $u)
                                 {
                                 $city=$u['city'];
                                                      
                                 echo '<option value="'. $u['city_id'].'">'.$city.'</option>';
                                 }
                                 ?>
                           </select>
                           <span id="city_result" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">State</label>
                           <input type="text" name="state" id="state" class="form-control" required>
                           <span id="state_results" style="display:none;"
                              class="text-danger"><b>Field is required
                           </b></span>
                        </div>
                        <div class="mb-3 col-md-6">
                           <label class="form-label">Upload Hotel Logo</label>
                           <div class="input-group mb-3">
                              <div class="form-file form-control"
                                 style="border: 0.0625rem solid #ccc7c7;">
                                 <input type="file" name="hotel_logo" required >
                              </div>
                              <span class="input-group-text">Upload</span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="second" id="second" style="display:none">
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
                                 <?php
                                    $department_record = $this->SuperAdmin->getAll_Datadd();
                                    $i = 1;
                                       foreach($department_record as $row)
                                    {?>
                                 <tr>
                                    <td> <?php echo $i;?> </td>
                                    <input type="hidden" name="department_id[]"
                                       id="department_id" value="1">
                                    <td> <?php echo $row['department_name'];?> </td>
                                    <td class="d-flex justify-content-center" >
                                       <div class="form-check custom-checkbox mb-3 checkbox-success check-lg d-flex align-item-center"
                                          style="margin:auto"
                                          data-toggle="collapse"
                                          data-target="#demo2"
                                          class="accordion-toggle">
                                          <input type="checkbox"
                                             class="form-check-input "
                                             value="<?php echo $row['department_id'];?>"
                                             id="dep_<?php echo $row['department_id'];?>"
                                             name="department_status[]"
                                             onclick="Show_hide_Fun(this)">
                                          <input type="hidden" name="department_name[]" id="department_name"  value="<?php echo $row['department_name'];?>"> 
                                          <label class="form-check-label"
                                             for=""></label>
                                       </div>
                                    </td>
                                    <td style="width:300px;">
                                       <div class="input-group input-daterange "
                                          style="width:250px;">
                                          <input type="date" min="<?=date('d-m-Y');?>" class=" form-control"
                                             id="form_date_dep_<?php echo $row['department_id'];?>" name="start_date[]"
                                             autocomplete="off">
                                          <span class="input-group-addon"
                                             style="padding:8px">to</span>
                                          <input type="date" min="<?=date('d-m-Y');?>" class="form-control"
                                             id="to_date_dep_<?php echo $row['department_id'];?>" name="end_date[]"
                                             autocomplete="off">
                                       </div>
                                    </td>
                                    <td>
                                       <input type="number" name="price[]"
                                          id="price_dep_<?php echo $row['department_id'];?>" class="form-control"
                                          style="width:100px;margin:auto">
                                    </td>
                                 </tr>
                                 <?php 
                                    $wh = '(departtment_id = "'.$row['department_id'].'")';
                                    $get_user_adhar_data = $this->SuperAdmin->get_service($wh);
                                    foreach($get_user_adhar_data as $row )
                                    {
                                       if(($row['department_id'] == $row['departtment_id'])){?>
                                 <tr id="dep_<?php echo $row['department_id'];?>_tr"
                                    style="display:none;">
                                    <td colspan="5">
                                       <div id="dep_<?php echo $row['department_id'];?>_box"
                                          style="display:none">
                                          <div class=" departure_block">
                                             <?php 
                                                $wh = '(departtment_id = "'.$row['department_id'].'")';
                                                $serd = $this->SuperAdmin->getAllData($tbs='services_of_department',$wh); 
                                                // echo "<pre>";
                                                // print_r(  $serd );
                                                foreach( $serd as $se){?>
                                             <input type="hidden"
                                                name="services_name[]"
                                                value="<?php echo $se['service_name'];?>">
                                             <input type="hidden"
                                                name="department_id[]"
                                                value="<?php echo $se['departtment_id'];?>">
                                             <!-- <input type="checkbox" value="<?php echo $row['service_id'];?>" class="form-check-input"  name="service_name[]" id="cb1_<?php echo $row['service_id'];?>"/> -->
                                             <input type="checkbox"
                                                value="<?php echo $se['departtment_id']."_".$se['service_id'];?>"
                                                name="services_id[]"
                                                id="cb_<?php echo $se['service_id'];?>" />
                                             <label class="new_lable" for="cb_<?php echo $se['service_id'];?>">
                                                <div class="service_card">
                                                   <div class="card-body"
                                                      style="padding: 1rem;">
                                                      <div
                                                         class="text-center">
                                                         <img src=" <?php echo $se['image'];?>"
                                                            alt=""
                                                            style="height:30px;">
                                                      </div>
                                                      <div
                                                         class="text-center">
                                                         <span
                                                            style="color:white"><?php echo $se['service_name']; ?></span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </label>
                                             <?php
                                                }?>
                                          </div>
                                       </div>
                                    </td>
                                    <?php
                                       }
                                       } ?>
                                 </tr>
                                 <?php
                                    $i++;
                                    }?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn" style="display:none">Add</button>
            </div>
         </form>
         <div class="modal-footer">
            <button class="btn btn-primary next"  >Next</button>
            <button class="btn btn-primary prev" style="display:none">Previous</button>
            <button class="btn btn-primary hide_btn_add" style="visibility:hidden;display:none">Add</button>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->

<!-- edit model start -->
<div class="modal fade" id="hotellist_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Edit Hotel</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="basic-form get_hotellist_data_model">
            </div>
         </div>
      </div>
   </div>
</div>
<!-- edit model end -->
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script>
   $(document).on("click",".add_hotel",function(){
       $(".add_hotel_modal").modal('show');
   });
   // $(document).on("click",".next",function(){
       
   //     $("#first").attr('display:none');
   //     $("#second").attr('display:block');
   // });

   
   $(document).ready(function(){
       $('.next').click(function(){
          
       $("#first").attr('style','display:none');
       $("#second").attr('style','display:block');
       $(".prev").attr('style','display:block');
       $(this).attr('style','display:none');
       $(".css_btn").attr('style','display:block');
       $(".hide_btn_add").attr('style','display:block');
   
       
   
       });
       $('.prev').click(function(){
          
          $("#first").attr('style','display:block');
          $("#second").attr('style','display:none');
          $(".next").attr('style','display:block');
          $(".css_btn").attr('style','display:none');
       $(".hide_btn_add").attr('style','display:none');
   
           $(this).attr('style','display:none');
   
          });
          
   })
   
   // add hotel script
   $(document).on('submit', '#add_hotel_form', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
       var form_data = new FormData(this);
       
       
       $.ajax({
           url         : '<?= base_url('SuperAdminController/add_hotels') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           async:false,
           success     : function(res) {
   
               
               $.get( '<?= base_url('hotelLists');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_hotel_modal").modal('hide');
                $(".add_hotel_modal").on("hidden.bs.modal", function () {
                     $("#add_hotel_form").trigger("reset"); // reset the form fields
                  });
                $(".append_data").html(res);
                 $(".successmessage").show();
              
                   
                 }, 2000);
               setTimeout(function(){ 
                   $(".successmessage").hide();
                 }, 4000);
           }
       });
   });

   // fetch hotel data for eedit
   $(document).on('click','.edit_model_click', function () {
   var id = $(this).attr('data-unic-id');
   var city_name = $(this).attr('city-id-controller');
   // console.log(id);
   // console.log(city_name);
   $('#hotellist_edit_modal').modal('show');
   var base_url = '<?php echo base_url();?>';
   $.ajax({
           type: "POST",
           url: base_url+"SuperAdminController/get_hotellist_data",
           data: {id : id,city_name :city_name},
           success: function (response) {
           $('.get_hotellist_data_model').html(response);
           }
       });
   });

   // update hotel script
   $(document).on('submit', '#edithotellistform', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
    
       var form_data = new FormData(this);
       // console.log(form_data);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/update_hotel') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           // async:false,
           success     : function(res) {
               $.get( '<?= base_url('hotelLists');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#example1').DataTable();
                   }, 1000);
               });
               // console.log(res);
               $(".append_data").html('');
           $('#hotellist_edit_modal').modal('hide');  
           $(".loader_block").hide();
           $(".append_data").append(res)
           setTimeout(function(){  
               $("#edithotellistform")[0].reset();         
               $(".updatemessage").show();
           }, 2000);
           setTimeout(function(){  
               $(".updatemessage").hide();
           }, 4000);
              
           }
         
       });
   });

   // delete hotel script
   $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

            var id = $(this).attr('delete-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Hotel!",
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
                        url: '<?= base_url('SuperAdminController/delete_hotel') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your Hotel has been deleted!", "success");
                            $.get( '<?= base_url('hotelLists');?>', function( data ) {
                              var resu = $(data).find('.table-scrollable').html();
                              $('.table-scrollable').html(resu);
                              setTimeout(function(){
                                 $('#example1').DataTable();
                              }, 1000);
                            });

                            $(".loader_block").hide();
                            $(".append_data").html(res);
                        },
                        complete: function () {
                            // Close the SweetAlert modal when the AJAX request is complete
                            swal.close();
                        }

                    });

                } else {
                    swal(
                        "Cancelled",
                        "Your Hotel is safe!",
                        "error"
                    );
                }
            });
        });



   function Show_hide_Fun(idd) {
   
   
   var check = document.getElementById(idd.id);
   // console.log(check);
   check.addEventListener( "change", () => {
   if ( check.checked )  {
   //console.log("#from_date_",idd.id);
   $('#price_'+idd.id).prop('required',true);
   $('#form_date_'+idd.id).prop('required',true);
   $('#to_date_'+idd.id).prop('required',true);
   document.getElementById(idd.id + '_tr').style.display = "table-row";
   document.getElementById(idd.id + '_box').style.display = "block";
   
   } else {
   $('#price_'+idd.id).prop('required',false);
   $('#form_date_'+idd.id).prop('required',false);
   $('#to_date_'+idd.id).prop('required',false);
   document.getElementById(idd.id + '_tr').style.display = "none";
   document.getElementById(idd.id + '_box').style.display = "none";
   }
   });
   
   }
</script>
<script>
   $(document).on("click",".updateStaff",function(){
       var data_id = $(this).attr('data-id');
       $(".edit_hotel"+data_id).modal('show');
   });
   
   $(document).on('click', '.booking_id', function(){
      
      //$(".loader_block").show();
     
      var uid1= $(this).attr('u-id1');
     
      
      console.log(uid1);
   
      // return false;
      $.ajax({
          url         : '<?= base_url('SuperAdminController/closer_cound_leads') ?>',
          method      : 'POST',
          data        : {u_id1: uid1},
          
          success     : function(res) {
              // console.log(res);
   
              $('.closer_cound').html(res);
   
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

   

   

   function change_status_1(cnt) {
                    //alert('hi');
                     var base_url = '<?php echo base_url();?>';
                     var status = $('#active'+cnt).children("option:selected").val();
                     var uid = $('#uid'+cnt).val();
     				//alert(cid);
                     if (status != '') {
     
                         $.ajax({
                             url: base_url + "SuperAdminController/change_user_status",
                             method: "POST",
                             data: {
                                 active: status,
                                 uid: uid
                             },
                             dataType: "json",
                             success: function(data) {
                                 //alert(data);
                                 if (data == true) {
                                     alert('Status Changed Sucessfully !..');
                                 } else {
                                     alert('Something Went Wrong !...')
                                 }
                             }
                         });
                     }
                 }
  
      
   
</script>