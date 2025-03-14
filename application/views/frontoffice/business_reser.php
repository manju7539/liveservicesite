 <!-- start page content -->
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Business Center Reservation</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Business Center Reservation</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Business Center Request Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Business Center Request Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            <div class="alert alert-success updatemessage1" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Business Center Request Changed Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="page_header_title">List of New Request</span></header>
                    </div>
                    <div class="card-body ">
                            <div class="row mb-3 ">
    
                                <!-- <div class="col-md-4"> -->
                                <div class="col-md-12 col-sm-12">
                                <div class="panel tab-border card-box">
                                <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">New Request</a>
                                    </li>
                                    <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">List Of Accepted Request</a>
                                    </li>
                                    <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">List Of Rejected Request</a>
                                    </li>
                                </ul>
                            </header>
                            </div>
                                    <!-- <select class="form-control" id="categoryDropdown">
                                        <option value="">Select Option</option>
                                        <option value="0"><a href="#" style="color:white;">New Request</a></option>
                                        <option value="1"><a href="#" style="color:white;">List Of Accepted Request</a></option>
                                        <option value="2"><a href="#" style="color:white;">List Of Rejected Request</a></option>
                                           
                                    </select> -->
                                <!-- </div> -->

                                <div class="col-md-12 d-flex  justify-content-end add_facility ">
                                    <button id="addRow1" class="btn btn-info ">
                                        Add Request 
                                    </button>
                                </div>

                            </div>
                    </div>
                    <div class="tab-content">        
                   
 <div class="tab-pane" style="background-color:white;" id="arrival2_div"> 
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                        <div class="col-md-6 col-sm-6">
                                        <input type="date" class="form-control wide" name="event_date"
                                                            placeholder="" onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group">
                                                        <select id="inputState" name="business_center_type" class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                        <button name="search" type="submit"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                             
                                </div>
                            <div class="col-md-3"></div>
                            </div>
                           
                            <div class="">
                                <div class="table-scrollable accept_record reservation_block">
                                    <table id="acceptedOrder_tb" class="display full-width">
                                        <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                                        <th>Guest Name</th>
                                                        <th>Guest Mobile No</th>

                                                        <th>Business center Type</th>
                                                        <th>Capacity</th>
                                                        <th>Event Name</th>

                                                        <th>Event Date</th>
                                                        <th>Event start time</th>
                                                        <th>Event End time</th>
                                                        <th>Note</th>
                                                        <th>Id Proof</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data" >
                                        <?php
// print_r($list);exit;
                                                        $i = 1;
                                                    // $data=    $this->MainModel->get_active_business_center($admin_id)
                                                        if($list1)
                                                        {
                                                            foreach($list1 as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->MainModel->getData('business_center',$where1);
                                                                if(!empty($no_of_people1))
                                                                {
                                                                    $no_of_people = $no_of_people1['no_of_people'];
                                                                    $type_name= $no_of_people1['business_center_type'];
                                                                    // print_r($type_name);exit;
                                                                }
                                                                else
                                                                {
                                                                    $no_of_people = '-';
                                                                    $type_name = '-';
                                                                }
                                                              
                                                              
                                                    ?>
                                                    <tr>
                                                    <td><h5><?php echo $i++?></h5></td>
                                                    <td>
                                                      <h5><?php echo $bu_r['client_name']?></h5>
                                                   </td>
                                                     <td><h5><?php echo $bu_r['client_mobile_no']?></h5></td>
                                                    <td><h5><?php echo $type_name ?></h5></td>
                                                    <td><h5><?php echo $no_of_people ?>people</h5></td>
                                                    <td><h5><?php echo $bu_r['event_name']?></h5></td>


                                                    <td><h5><?php echo date('d-m-Y',strtotime($bu_r['event_date']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?></h5></td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="lightgallery"
                                                                class="room-list-bx d-flex align-items-center">
                                                                <!-- <a href="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-exthumbimage="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                    <img class="me-3 rounded"
                                                                        src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                        alt="" style="width:80px; height:40px;">
                                                                </a> -->
                                                                <img class="me-3 rounded" src="<?php echo $bu_r['id_proof_photo'];?>"     alt="" style="width:80px; height:40px;">
                                                            </div>
                                                            <!-- Modal -->
                     <div class="modal fade bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Business Center Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <p>
                                                                <?php echo $bu_r['additional_note'];?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end of modal  -->
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
                        <!--  hemali end :: accept Order-->
                        <!-- endaccept   -->
                          <!--  hemali add :: Rejected Order-->
                          <div class="tab-pane" style="background-color:white;" id="arrival3_div"> 
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <form  method="post">
                                        <div class="d-flex">
                                        <div class="col-md-6 col-sm-6">
                                        <input type="date" class="form-control wide" name="event_date"
                                                            placeholder="" onfocus="(this.type = 'date')" id="date">
                                                    </div>
                                                    <div class="input-group">
                                                        <select id="inputState" name="business_center_type" class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                        <button name="search" type="submit"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fa fa-search"></i></button>
                                        </div>
                                    </form> 
                             
                                </div>
                            <div class="col-md-3"></div>
                            </div>
                           
                            <div class="">
                                <div class="table-scrollable accept_record reservation_block">
                                    <table id="rejectedOrder_tb" class="display full-width">
                                        <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                                        <th>Guest Name</th>
                                                        <th>Guest Mobile No</th>

                                                        <th>Business center Type</th>
                                                        <th>Capacity</th>
                                                        <th>Event Name</th>

                                                        <th>Event Date</th>
                                                        <th>Event start time</th>
                                                        <th>Event End time</th>
                                                        <th>Reject Reason</th>
                                                        <th>Note</th>
                                                        <th>Id Proof</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_data1"> 
                                        <?php
                                                        $i = 1;
                                                    // $data=    $this->MainModel->get_active_business_center($admin_id)
                                                        if($list2)
                                                        {
                                                            foreach($list2 as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->MainModel->getData('business_center',$where1);
                                                                if(!empty($no_of_people1))
                                                                {
                                                                    $no_of_people = $no_of_people1['no_of_people'];
                                                                    $type_name= $no_of_people1['business_center_type'];

                                                                }
                                                                else
                                                                {
                                                                    $no_of_people = '-';
                                                                    $type_name = '-';
                                                                }
                                                              
                                                              
                                                    ?>
                                                    <tr>
                                                    <td><h5><?php echo $i++?></h5></td>
                                                    <td>
                                                      <h5><?php echo $bu_r['client_name']?></h5>
                                                   </td>
                                                     <td><h5><?php echo $bu_r['client_mobile_no']?></h5></td>
                                                    <td><h5><?php echo $type_name ?></h5></td>
                                                    <td><h5><?php echo $no_of_people ?>people</h5></td>
                                                    <td><h5><?php echo $bu_r['event_name']?></h5></td>


                                                    <td><h5><?php echo date('d-m-Y',strtotime($bu_r['event_date']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?></h5></td>
                                                    <td>
                                                    <?php 
                                     if($bu_r['reject_reason'] == 1)
                                     {
                                       $request_status = 'Please Try After Sometime';
                                     }
                                     elseif($bu_r['reject_reason'] == 2)
                                     {
                                       $request_status = 'Temporarily unavailable';
                                    }
                                    elseif($bu_r['reject_reason'] == 3)
                                     {
                                      $request_status = 'Slots not available';
                                    }
                                 elseif($bu_r['reject_reason'] == 4)
                                    {
                                  $request_status = 'Please contact Front office';
                                    }
                                    ?>
                                
                                    <span><?php echo $request_status ?></span>
                                 </td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="lightgallery"
                                                                class="room-list-bx d-flex align-items-center">
                                                                <!-- <a href="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-exthumbimage="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                    <img class="me-3 rounded"
                                                                        src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                        alt="" style="width:80px; height:40px;">
                                                                </a> -->
                                                                <img class="me-3 rounded" src="<?php echo $bu_r['id_proof_photo'];?>"     alt="" style="width:80px; height:40px;">
                                                            </div>
                                                             <!-- Modal -->
                                        <div class="modal fade bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Business Center Request</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <p>
                                                                <?php echo $bu_r['additional_note'];?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end of modal  -->
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
                        <!--  hemali end :: reject Order-->
                      
                    <div class="tab-pane active" style="background-color:white;" id="arrival1_div"> 
                    <div class="table-scrollable new_record reservation_block">
                                                                    
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Guest Name</th>
                                    <th>Business center Type</th>
                                    <th>Capacity</th>
                                    <!-- <th>Check In</th>
                                    <th>Check Out</th> -->
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody class="append_data3">
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
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Guest Name</label>
                                            <input type=""  name="client_name" class="form-control"
                                                                    placeholder="Name of client" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Business Center Type</label>
                                            <select id="inputState"  name="business_center_type" class="default-select form-control wide"  required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                        </div>

                                       
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Date</label>
                                            <input type="date" name="event_date" class="form-control" placeholder=""
                                                                    required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Event</label>
                                                                <input type="text" name="event_name" class="form-control"
                                                                    placeholder="Event" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Mobile number</label>
                                                                <input type="text" name="client_mobile_no" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                                                    placeholder="Mobile number" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time In</label>
                                            <input type="time"  name="start_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time Out</label>
                                            <input type="Time"  name="end_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label class="form-label">Id Proof</label>
                                            <input type="file"name="id_proof_photo" class=" dropify  form-control"
                                                                    data-height="90" required>

                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label class="form-label">Additional Note</label>
                                            <textarea class="summernote" id="description1" name="additional_note" style="min-height: 400px;"></textarea>

                                            <!-- <div class="summernote"></div> -->

                                        </div>                                    
                               
                                    </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary css_btn">Submit</button>
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
<div class="modal fade bd-note-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Note</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <p>
                                                            <span class="d-block mb-2 description_view"></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end of modal  -->
                                                        </td>

                                                    </tr>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
        <!-- end add btn modal -->
        <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Order status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <!-- <input type="hidden" name="b_c_reserve_id" id="b_c_reserve_id"> -->
                        <input type="hidden" name="b_c_reserve_id" id="b_c_reserve_id">
                       
                        <label class="form-label">Change Order Status</label>
                        <select  id="send_user"  name="request_status" class="default-select form-control wide" required>
                           <option value="">Choose...</option>
                           <option value="1">Accept</option>
                           <option value="2">Reject</option>
                        </select>
                     </div>
                    
                     <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                        <label class="form-label">Reason For Rejecting</label>
                        <select id="reason" name="reject_reason" class="default-select form-control wide">
                           <option value="">Choose</option>
                           <option value="1">Please Try After Sometime</option>
                           <option value="2">Temporarily unavailable</option>
                           <option value="3">Slots not available</option>
                           <option value="4">Please contact Front office</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Save</button>
               <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
    $(document).ready(function() {
        $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
       
    } );
    </script>