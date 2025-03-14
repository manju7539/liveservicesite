<!-- start page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Enquiry Request</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Enquiry Request</li>
            </ol>
         </div>
      </div>
      <?php
         $where='(request_status = 0)';
         $enqui_list = $this->MainModel->get_en_req($tbl='hotel_enquiry_request',$where);
         
         // echo '<pre>';
         // print_r($enqui_list);
         //  echo '</pre>';
         ?>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>All Enquiry Request</header>
               </div>
               <div class="card-body ">
                  <!-- <div class="btn-group r-btn">
                     <button id="addRow1"  class="btn btn-info add_hotel">
                     Add Credits<i class="fa fa-plus"></i>
                     </button>
                     </div> -->
                  <div class="table-scrollable" >
                     <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 10px;">
                        <div class="col-md-5">
                           <form method="POST">
                              <div class="input-group">
                                 <input type="date" class="form-control"
                                    placeholder="" name="register_date" id=""
                                    data-dtp="dtp_LG7pB" required="">
                                 <select class="form-control" name="hotel_id" id="sub_cat" required="">
                                    <!-- <option selected="true" disabled="disabled">Select
                                       Hotel</option> -->
                                    <option value="">No Selected</option>
                                    <?php
                                       $users=$this->SuperAdmin->get_hotels_id();
                                       
                                       foreach($users as $u)
                                           {
                                               $name=$u['hotel_name'];
                                               
                                               echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                                           }
                                       ?>
                                 </select>
                                 <select class="form-control " name="city" id="main_cat" required="">
                                    <option value="">No Selected</option>
                                    <?php 
                                       $where='(user_type = 0)';
                                       $city_list = $this->SuperAdmin->get_customer_citywise($tbl='register',$where);
                                       foreach($city_list as $c)
                                       {
                                           $wh = '(city_id = "'.$c['city'].'")';
                                           $cities = $this->SuperAdmin->getSingleData('city',$wh);
                                       
                                           $where1 = '(u_id ="'.$c['u_id'].'")';
                                           // print_r()
                                           $get_facility_category = $this->MainModel->get_preference('preferences',$where1);
                                           // print_r($cities);exit;
                                           if(!empty($cities))
                                       {
                                           $city2 = $cities['city'];
                                           $city3 = $cities['city_id'];
                                       
                                       
                                       }
                                       
                                       else
                                       {
                                           $city2 = "-";
                                           $city3 = "-";
                                       
                                       }
                                       ?>
                                    <option value="<?php echo $city3 ?>"><?php echo $city2  ?></option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                                 <button type="submit" name="search_1" class="btn btn-info  btn-sm ">
                                 <i class="fa fa-search">
                                 </i>
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th>Sr.No.</th>
                              <!-- <th>City</th> -->
                              <th>Hotel</th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Room Charges</th>
                              <th>Lead Cost</th>
                              <th>CheckIn</th>
                              <th>CheckOut</th>
                              <th>enquiry id</th>
                              <th width="5%">Required</th>
                              <th>Room Type</strong></th>
                              <!-- <th>Select Room Type</th>
                                 <th width="15%">Action</th> -->
                           </tr>
                        </thead>
                        <tbody id="geeks">
                           <?php
                              $i = 1+$this->uri->segment(2);
                              // $admin_id = $this->session->userdata('front_id');
                              // $u_id= $this->session->userdata('u_id');
                              // $where ='(u_id = "'.$u_id.'")';
                              // $admin_details = $this->MainModel->getData($tbl ='register', $where);
                              
                              // $admin_id = $admin_details['hotel_id'];
                              // print_r($admin_id);
                              // $user_data = $this->MainModel->get_user_dataa($admin_id);
                              
                              
                              if(!empty($list)){
                                  foreach($list as $e_req)
                                  {
                                      //   echo "<pre>";
                                      //             print_r($list);
                                      //             exit;
                                      $wh = '(u_id = "'.$e_req['hotel_id'].'")';
                                      $data = $this->MainModel->getSingleData('register',$wh);
                                    
                                      // $wh = '(city_id = "'.$data['city'].'")';
                                      // $data11 = $this->MainModel->getSingleData('city',$wh);
                                      // print_r($data11 );
                                       if(!empty($data))
                                     {
                                       
                                      //  $city = $data11['city'];
                                       $hotel_name = $data['hotel_name'];
                              
                                     }
                                     else
                                     {
                                      //  $city = "-";
                                       $hotel_name = "-";
                                     }
                              
                                     $wh = '(city = "'.$e_req['hotel_id'].'")';
                                     $lead_cost = $this->MainModel->getSingleData('leads_recharge',$wh);
                                     
                                      if(!empty($lead_cost))
                                    {
                                      
                                     //  $city = $data11['city'];
                                      $lead_cost1 = $lead_cost['lead_cost'];
                              
                                    }
                                    else
                                    {
                                     //  $city = "-";
                                      $lead_cost1 = "-";
                                    }
                                     
                                   
                                    if($e_req['room_type_name'] ){
                                      $room_type_name = $e_req['room_type_name'];
                              
                              
                                    }else{
                                      $room_type_name = "-";
                                    }
                              
                              
                                  //    if(!empty($data11))
                                  //    {
                                       
                                  //      $city = $data11['city'];
                                       
                              
                                  //    }
                                  //    else
                                  //    {
                                  //      $city = "-";
                                       
                                  //    }
                                     
                                     
                                      // $user_data = $this->MainModel->get_user_dataa($e_req['hotel_id']);
                                      $user_data = $this->SuperAdmin->get_user_dataa($e_req['u_id']);
                                      //  $listt = $this->MainModel->get_hotel_enquiry_details_request($e_req['u_id']);
                                      if($user_data)
                                      {
                              
                              
                                          
                              ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i++?></h5>
                              </td>
                              <!-- <td><h5><?php echo $city ?></h5></td> -->
                              <td>
                                 <h5><?php echo $hotel_name ?></h5>
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
                                 <h5><?php echo $e_req['room_charges'] ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $lead_cost1 ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo date('d-m-Y', strtotime($e_req['check_in_date'])) ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo date('d-m-Y', strtotime($e_req['check_out_date'])) ?></h5>
                              </td>
                              <!-- <td><?php echo $e_req['total_adults'] ?></td>
                                 <td><h5><?php echo $e_req['total_childs'] ?><h5></td> -->
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
                                 <?php echo  $room_type_name ?>
                                 <h5>
                              </td>
                           </tr>
                           <!-- modal for requirment  -->
                           <div class="modal fade bd-terms-modal-sm_<?php echo $e_req['hotel_enquiry_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Requirement</h5>
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
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->