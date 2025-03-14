<style>
   .leads_plan .container-fluid {
      padding:0px
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Leads</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard') ?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Leads</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>All Leads</header>
                 
               </div>
               <div class="card-body ">
                 
                  <div class="table-scrollable" >
                     <div class="d-flex justify-content-between align-items-center flex-wrap"style="margin-bottom: 8px;">
                        <div class="col-md-8">
                           <form method="POST">
                              <div class="input-group">
                                 <input type="date" class="form-control"
                                    placeholder="" name="check_in_date" id="main_cat"
                                    data-dtp="dtp_LG7pB">
                                 <select class="form-control" id="hotel_list" name="hotel_id">
                                    <option selected="true" disabled="disabled">Select
                                       Hotel
                                    </option>
                                    <?php
                                       $users = $this->SuperAdmin->get_hotels_id();
                                       
                                       foreach ($users as $u) {
                                           $name = $u['hotel_name'];
                                       
                                           echo '<option value="' . $u['u_id'] . '">' . $name . '</option>';
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
                     <div class="leads_plan ">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th> Sr.No.</th>
                              <th>Date</th>
                              <th> Name</th>
                              <th> Phone</th>
                              <th>Email</th>
                              <th>Area</th>
                              <th>City</th>
                              <th>Requested Hotels</th>
                              <th>Request Accepted Hotels</th>
                           </tr>
                        </thead>
                        <tbody id="geeks">
                           <?php
                              if (!empty($all_lead_list)) 
                              {
                                  $i = 1;
                                  if ($all_lead_list) 
                                  {
                                      foreach ($all_lead_list as $vis) {
                              //           $where1 = '(u_id ="'.$vis['u_id'].'" AND request_status=1)';
                              //  $get_facility_category = $this->MainModel->get_reuest_accept_list('hotel_enquiry_request',$where1);

                              //  echo "<pre>";
                              //  print_r($get_facility_category);die;
                              
                              $wh = '(u_id= "' . $vis['u_id'] . '")';
                              $city_data = $this->SuperAdmin->getSingleData('register', $wh);
                              // echo "<pre>";
                              // print_r($city_data);die;
                              $wh = '(city_id= "' . $city_data['city'] . '")';
                              $city_data11 = $this->SuperAdmin->getSingleData('city', $wh);
                              // echo "<pre>";
                              // print_r($city_data11);die;
                              if (!empty($city_data11)) {
                              
                              $city_name = $city_data11['city'];
                              // echo "<pre>";
                              // print_r($city_name);die;
                              } else {
                              $city_name = "-";
                              }
                              
                              
                              $wh = '(u_id= "' . $vis['u_id'] . '")';
                              $accept_hotel_name = $this->SuperAdmin->getSingleData('register', $wh);
                              // echo "<pre>";
                              // print_r($accept_hotel_name);die;
                              //  //   print_r($recharge_data );
                              if (!empty($accept_hotel_name)) {
                              $hotel_name = $accept_hotel_name['hotel_name'];
                              $area = $accept_hotel_name['area'];
                              $full_name = $accept_hotel_name['full_name'];
                              $mobile_no = $accept_hotel_name['mobile_no'];
                              $email_id = $accept_hotel_name['email_id'];
                              // echo "<pre>";
                              // print_r($hotel_name);
                              // print_r($area);
                              // print_r($full_name);
                              // print_r($mobile_no);
                              // print_r($email_id);die;
                              } else {
                              $hotel_name = "-";
                              $area = "-";
                              $full_name = "-";
                              $mobile_no = "-";
                              $email_id = "-";
                              }
                              
                              ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i++; ?></h5>
                              </td>
                              <td>
                                 <h5 class="text-nowrap"><?php echo $vis['check_in_date'] ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $full_name ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $mobile_no ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $email_id ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $area ?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $city_name ?></h5>
                              </td>
                         
                              <td>
                                 <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-sm_<?php echo $vis['u_id'] ?>">
                                 <i class="fa fa-eye"></i>
                                 </a>
                              </td>
                              <td>
                                 <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-hotel-modal-sm_<?php echo $vis['u_id'] ?>">
                                 <i class="fa fa-eye"></i>
                                 </a>
                              </td>
                             
                           </tr>
                       
                           <?php 
                                                  
                              }
                              }}?>
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
<?php 
               $i=1;                                              
               foreach ($all_lead_list as $vis) 
               {
             
                 $where1 = '(u_id ="'.$vis['u_id'].'" AND request_status=0)';
                $get_facility_category = $this->MainModel->get_reuest_accept_list('hotel_enquiry_request',$where1);
               
               //   echo "<pre>";
               //    print_r($get_facility_category);die;
               ?>
            <div class="modal fade bd-example-modal-sm_<?php echo $vis['u_id']?>" tabindex="-1" role="dialog"
               aria-hidden="true">
               <div class="modal-dialog modal-md">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Requested Hotels</h5>

                        <!-- <h5 class="modal-title">Requested Hotels</h5> -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <div class="modal-body" style="height:300px;overflow-y:scroll">
                        <!-- <ul class="list-group">
                           <li class="list-group-item"><?php echo $get_facility_category['hotel_id']?></li> -->
                        <!-- <li class="list-group-item">BlueStar</li>
                           <li class="list-group-item">Cilentro</li>
                           <li class="list-group-item"> OpenSky</li> -->
                        <!-- </ul> -->
                        <table class="table table-stripped text-center">
                           <tbody>
                              <?php 
                                 $i=1;
                                   foreach ($get_facility_category as $g) 
                                   {
                                       $wh = '(u_id = "'.$g['hotel_id'].'")';
                                       $hotel_name = $this->MainModel->getSingleData('register',$wh);
                                       if(!empty($hotel_name))
                                   {
                                       $hotel_name = $hotel_name['hotel_name'];
                                 
                                   }
                                   else
                                   {
                                       $hotel_name = "-";
                                   }
                                 ?>
                              <tr>
                                 <th><?php echo $hotel_name?></th>
                              </tr>
                              <?php
                                 $i++;
                                 }
                                 ?>
                           </tbody>
                        </table>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end of modal  -->
            <?php
               $i++;
               }
               
               ?>
            <!-- Modal -->
            <?php 
               $i=1;                                              
               foreach ($all_lead_list as $vis) 
               {
                 
                  $where2 = '(u_id ="'.$vis['u_id'].'" AND request_status = 1)';
                  // echo "<pre>";
                  // print_r($where1);die;
                   $get_facility_category = $this->MainModel->get_reuest_accept_list('hotel_enquiry_request',$where2);
                  //  echo "<pre>";
                  //  print_r($get_facility_category);die;
                                               ?>
            <div class="modal fade bd-hotel-modal-sm_<?php echo $vis['u_id']?>" tabindex="-1" role="dialog"
               aria-hidden="true">
               <div class="modal-dialog modal-md slideInRight animated">
                  <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Request Accepted Hotels</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <div class="modal-body" style="height:300px;overflow-y:scroll">
                        <!-- <ul class="list-group">
                           <li class="list-group-item"><?php echo $vis['hotel_name']?></li>
                           </ul> -->
                        <table class="table table-stripped text-center">
                           <tbody>
                              <?php 
                              //   echo "<pre>";
                              //   print_r($get_facility_category);
                               
                                 $i=1;
                                 foreach ($get_facility_category as $g) 
                                 {
                                    // print_r($g['hotel_id']);die; 
                                     $wh = '(u_id = "'.$g['hotel_id'].'")';
                                     $hotel_name = $this->MainModel->getSingleData('register',$wh);
                                 //  print_r($cities  );
                                     if(!empty($hotel_name))
                                 {
                                     $hotel_name = $hotel_name['hotel_name'];
                                 
                                 }
                                 else
                                 {
                                     $hotel_name = "-";
                                 }
                                 ?>
                              <tr>
                                 <th><?php echo $hotel_name?></th>
                              </tr>
                              <?php
                                 $i++;
                                 }
                                 ?>
                           </tbody>
                        </table>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end of modal  -->
            <?php
               $i++;
               }
               
               ?>

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

<script>
   $(document).on("click",".add_hotel",function(){
       $(".add_leads_modal").modal('show');
   });
   $(document).on("click",".updateStaff",function(){
       var data_id = $(this).attr('data-id');
       $(".add_staff_modal_"+data_id).modal('show');
   });
   
   $(document).ready(function() {
       $('#main_cat').change(function() {
   
           var base_url = '<?php echo base_url() ?>';
           var cat = $('#main_cat').val();
   
   
           if (cat) {
               $.ajax({
                   url: base_url + "SuperAdminController/changeSubcategory",
                   method: "post",
                   data: {
                       cat: cat
                   },
                   success: function(data) {
                       //  alert(data);
                       $('#sub_cat').html(data);
                   }
   
               });
           } else {
               $('#sub_cat').html('<option>Select Hotel</option>');
           }
       });
   });
   
   $(document).ready(function() {
       $('#city').change(function() {
   
           var base_url = '<?php echo base_url() ?>';
           var cat = $('#city').val();
           //    alert(cat);
   
           if (cat) {
               $.ajax({
                   url: base_url + "SuperAdminController/editsubhotels",
                   method: "post",
                   data: {
                       cat: cat
                   },
                   success: function(data) {
                       //  alert(data);
                       $('#hotels').html(data);
                   }
   
               });
           } else {
               $('#hotels').html('<option>Select Hotel</option>');
           }
       });
   });
</script>