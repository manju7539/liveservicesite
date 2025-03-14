<!-- start page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Guest Panel</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Guests</li>
         </ol>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card card-topline-aqua">
            <div class="card-head">
               <header>All Guests</header>
            </div>
            <div class="card-body ">
               <div class="" >
                  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 10px; padding-left: var(--bs-gutter-x,.75rem);">
                        <form method="POST">
                           <div class="input-group">
                              <div class="d-flex">
                                 <div id="reportrange"  class="form-control wide order_abc" style="min-width: 39%;font-size: 14px;">
                                    <input type="hidden" id="date_picker" name="date_picker">
                                    <input type="hidden" id="start_date" name="start_date" value="">
                                    <input type="hidden" id="end_date" name="end_date" value="">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                 </div>
                                 <select class="form-control" name="hotel_id" id="sub_cat" >
                                    <!-- <option selected="true" disabled="disabled">Select
                                       Hotel</option> -->
                                    <option value="">Select Hotel</option>
                                    <?php
                                       $users=$this->SuperAdmin->get_hotels_id();
                                       
                                       foreach($users as $u)
                                           {
                                               $name=$u['hotel_name'];
                                               
                                               echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                                           }
                                       ?>
                                 </select>
                                 <select class="form-control " name="city" id="main_cat" >
                                    <option value="">Select City</option>
                                    <?php 
                                       $where='(user_type = 0)';
                                       $city_list = $this->SuperAdmin->getAllDataofcity($tbl='city',$where);
                                       foreach($city_list as $c)
                                       {
                                                $city2 = $c['city'];
                                                $city3 = $c['city_id'];
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
                     <div class="table-scrollable">
                        <table id="example1" class="display full-width">
                           <thead>
                              <tr>
                                 <th>
                                    Sr.No.
                                 </th>
                                 <th>Name</th>
                                 <th>Guest Type</th>
                                 <th>Hotel Name</th>
                                 <th>Phone</th>
                                 <th>Email</th>
                                 <th>Address</th>
                                 <th>History</th>
                              </tr>
                           </thead>
                           <tbody id="geeks">
                              <?php
                                 $i = 1;
                                 
                                 if ($list) 
                                 {
                                     foreach ($list as $gl) 
                                     {
                                         $wh = '(u_id = "'.$gl['hotel_id'].'")';
                                         $get = $this->SuperAdmin->getData('register',$wh);
                                    
                                         if(!empty($get))
                                         {
                                         $hotel_name = $get['hotel_name'];
                                         $full_name = $get['full_name'];
                                 
                                         $address = $get['city'];
                                         
                                 
                                 
                                         }
                                         else
                                         {
                                         $hotel_name = "-";
                                         $address = "-";
                                 
                                         }
                                 
                                         $wh = '(u_id = "'.$gl['u_id'].'")';
                                         $get = $this->SuperAdmin->getData('register',$wh);
                                     
                                         if(!empty($get))
                                         {
                                         $guest_type = $get['guest_type'];
                                         $full_name = $get['full_name'];
                                         $email_id = $get['email_id'];
                                         $mobile_no = $get['mobile_no'];
                                       
                                         }
                                         else
                                         {
                                         $guest_type = "-";
                                         $full_name = "-";
                                         $mobile_no = "-";
                                 
                                 
                                         }
                                         $wh1 = '(u_id = "'.$gl['hotel_id'].'")';
                                         $get = $this->SuperAdmin->getData('register',$wh1);
                                 
                                         
                                     if(isset($get['city']) && !empty($get['city']))
                                     {
                                         $wh1 = '(city_id = "'.$get['city'].'")';
                                     }
                                     else
                                     {
                                         $wh1 = '(city_id = "0")';
                                     }
                                         $get = $this->SuperAdmin->getData('city',$wh1);
                                       
                                         if(!empty($get))
                                         {
                                         $address = $get['city'];
                                 
                                 
                                         }
                                         else
                                         {
                                         $address = "-";
                                 
                                         }
                                         
                                 ?>
                              <tr>
                                 <td>
                                    <h5><?php echo $i ?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $full_name ?></h5>
                                 </td>
                                 <td>
                                    <h5>
                                       <?php
                                          if($guest_type == 1)
                                          {
                                            echo"Regular";
                                          
                                          }
                                          elseif($guest_type  == 2)
                                          {
                                              echo "CHG";
                                          }
                                          elseif($guest_type  == 3)
                                          {
                                              echo "VIP";
                                          }
                                          elseif($guest_type  == 4)
                                          {
                                              echo "WHG";
                                          }
                                          else{
                                              echo"-";
                                          
                                          }
                                          ?>
                                    </h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $hotel_name ;?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $mobile_no?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $email_id?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $address ?></h5>
                                 </td>
                                 <td class="d-flex">
                                    <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" booking-id=<?= $gl['booking_id']?> u-id1=<?= $gl['u_id']?> data-bs-target=".bd-view-modal-superadmin-guest"><i class="fa fa-eye"></i>
                                    </a>
                                    <a href="<?php echo base_url('SuperAdminController/add_checkout_details/' . $gl['booking_id'].'/'.$gl['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                    </a>
                                    <!-- <a href="#" class="btn btn-success shadow btn-xs sharp me-1  guest_invoice" data-bs-toggle="modal" booking-id=<?php // $gl['booking_id']?> u-id1=<?php // $gl['u_id']?> data-bs-target=".bd-view-modal-invoice-guest"><i class="fa fa-file"></i>
                                       </a> -->
                                 </td>
                                 </td>
                              </tr>
                              <!-- end of modal  -->
                              <?php $i++; 
                                 } 
                                 }?>
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
   $where='(user_type = 2)';
   $city_list = $this->SuperAdmin->group_city($tbl='register',$where);
   //     echo '<pre>';
   //    print_r($city_list);
   //      echo '</pre>';
   ?>
<!-- add btn modal  -->
<div class="modal fade add_leads_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md ">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Recharge</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="addplan" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="mb-3 col-md-12">
                     <label class="form-label">City</label>
                     <select class="form-control " name="city" id="main_cat" required="">
                        <option value="">No Selected</option>
                        <?php 
                           foreach($city_list as $c)
                           {
                               $wh = '(city_id = "'.$c['city'].'")';
                               // print_r($wh);
                               // exit;
                               $cities = $this->SuperAdmin->getSingleData('city',$wh);
                              
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
                  </div>
                  <div class=" mb-3 col-md-12">
                     <label class="form-label">Hotel Name</label>
                     <!-- <select class="form-control select" id="city" name="hotel_id">
                        <option value="">Please Select:-</option>
                        <?php
                           //  foreach($category3 as $cat3)
                           //  {
                           //      $name=$cat3['brand_name'];
                                
                           //  echo '<option value="'. $cat3['b_id'].'">'.$name.'</option>';
                           //  }
                           ?>	
                        </select> -->
                     <select class="form-control" name="hotel_name" id="sub_cat" required="">
                        <option value="">---Choose Hotel--</option>
                     </select>
                  </div>
                  <div class="mb-3 col-md-12">
                     <label class="form-label">Enter Amount</label>
                     <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required="">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary css_btn">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- sub popup view -->
<div class="modal fade  bd-view-modal-superadmin-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:90%">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body guest_history">
            </div>
         </form>
      </div>
   </div>
</div>
<!-- invoice view -->
<div class="modal fade  bd-view-modal-invoice-guest <?php echo $gl['booking_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="max-width:90%">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body guest_invoice_view">
            </div>
         </form>
      </div>
   </div>
</div>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script>
   $(document).on('click', '.booking_id', function(){
          
           //$(".loader_block").show();
           var id = $(this).attr('booking-id');
           var uid1= $(this).attr('u-id1');
          
           console.log(id);
           console.log(uid1);
   
           // return false;
           $.ajax({
               url         : '<?= base_url('SuperAdminController/guest_history') ?>',
               method      : 'POST',
               data        : {booking_id: id,u_id1: uid1},
               
               success     : function(res) {
                   // console.log(res);
   
                   $('.guest_history').html(res);
   
               }
               
           });
       });
</script>
<!-- guest_invoice -->
<script>
   $(document).on('click', '.guest_invoice', function(){
          
           //$(".loader_block").show();
           var id = $(this).attr('booking-id');
           var uid1= $(this).attr('u-id1');
          
           console.log(id);
           console.log(uid1);
           // return false;
           $.ajax({
               url         : '<?= base_url('SuperAdminController/add_checkout_details') ?>',
               method      : 'POST',
               data        : {booking_id: id,u_id1: uid1},
               
               success     : function(res) {
                   // console.log(res);
   
                   $('.guest_invoice_view').html(res);
   
               }
               
           });
       });
</script>