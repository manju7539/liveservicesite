 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($leads_recharge);
// 	 exit;
     ?>
     <style>
    /* th{
            text-align: center;
        } */
        .customer_list_block{
                margin-right:0px
            }
        </style>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Customer List</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                
                    <li class="active">Customers</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua customer_list_block">
                    <div class="card-head">
                        <header>All Customers</header>
                       
                    </div>
                    <div class="card-body ">

                    <!-- <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add Credits<i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                                        
                        <div class="table-scrollable" >
                        <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 10px;">
                                      
                        <?php
                                $where='(user_type = 0)';
                                $city_list = $this->SuperAdmin->get_customer_citywise($tbl='register',$where);

                               
                               
                       
                                // echo '<pre>';
                                // print_r($city_list);
                                //  echo '</pre>';
                                ?>
  
                                      <div class="col-md-5">
                                      <form method="POST">
                                <div class="input-group">
                                    <input type="date" class="form-control"
                                        placeholder="" name="register_date" id=""
                                        data-dtp="dtp_LG7pB" required="">
                                    
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
 

                                  </div>
                                  <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                            <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Name</th>
                                                <!-- <th>Hotel</th> -->
                                                <th>mobile</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>Preferences</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="geeks">
                                        <?php
                                        if($customer_list){
                                                          $i = 1+$this->uri->segment(2);
                                                          foreach($customer_list as $row)
                                                          {
                                                            $wh = '(city_id = "'.$row['city'].'")';
                                                            $recharge_data = $this->SuperAdmin->getSingleData('city',$wh);
                                                            // print_r($recharge_data );
                                                             if(!empty($recharge_data))
                                                           {
                                                             $city_name = $recharge_data['city'];

                                                           }
                                                           else
                                                           {
                                                             $city_name = "-";
                                                           }
                                                            
                                                             if(!empty($row['email_id']))
                                                           {
                                                             $email_id = $row['email_id'];

                                                           }
                                                           else
                                                           {
                                                             $email_id = "-";
                                                           }
                                                           
                                                            ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><h5><?php echo $row['full_name']; ?></h5></td>
                                                <!-- <td><?php echo $row['hotel_name']; ?></td> -->
                                               <td> <h5><?php echo $row['mobile_no']; ?></h5></td>
                                                <td><h5><?php echo $email_id; ?></h5></td>
                                                <td><h5><?php echo $city_name; ?></h5></td>
                                                <th>

                                                    <a href="#">
                                                        <div class="badge badge-primary" data-bs-toggle="modal"
                                                            data-bs-target=".example_<?php echo $row['u_id']; ?>">view</div>
                                                    </a>
                                                    <!-- <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php //echo $e_req['hotel_enquiry_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a> -->

                                                </th>

                                                <td>
                                                    <!-- <a href="<?php //echo base_url('customer_view/'.$row['u_id'])?>">
                                                        <button class="btn btn-secondary shadow btn-xs sharp me-1">
                                                            <i class="fa fa-eye"></i> -->

                                                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 booking_id" data-bs-toggle="modal" u-id1=<?= $row['u_id']?> data-bs-target=".bd-view-modal-customer-view"><i class="fa fa-eye"></i>
                                                                        </a>
                                                </td>
                                            </tr>
    <div class="modal fade example_<?php echo $row['u_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">All Preferences</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div>
               <ul>
                  <li>
                     <?php 
                        if($get_facility_category){
                                                     
                                                        foreach ($get_facility_category as $g) 
                                                        {
                                                          
                                                        if($g['smoking_room'] == 1)
                                                        {
                                                            $pref_data = 'Smoking Room  , ';
                                                        }
                                                   
                                                        if($g['non_smoking_room'] == 1)
                                                        {
                                                            echo "Non Smoking Room , ";
                                                        }
                        
                                                        if($g['king_bed'] == 1)
                                                        {
                                                            echo "King Bed , ";
                                                        }
                                                        
                                                        if($g['twin_bed'] == 1)
                                                        {
                                                            echo "Twin Bed , ";
                                                        }
                        
                                                        if($g['mountain_view'] == 1)
                                                        {
                                                            echo "Mountain View , ";
                                                        }
                        
                                                        if($g['city_view'] == 1)
                                                        {
                                                            echo "City View , ";
                                                        }
                        
                                                        if($g['top_floors'] == 1)
                                                        {
                                                            echo "Top Floors , ";
                                                        }
                        
                                                        if($g['lower_floors'] == 1)
                                                        {
                                                            echo "Lower Floors , ";
                                                        }
                                                        // else{
                                                        //     $pref_data = '-';
                                                        // }
                                                    ?>
                  </li>
               </ul>
               <?php
                  }
                  }
                  ?>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
                                           
                                    
<!-- modal popup for edit  -->

<!-- end of modal  -->
                                    <?php $i++; 
                                    } 
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
   
    <!-- model gor view -->
    <div class="modal fade  bd-view-modal-customer-view <?php echo $row['u_id']??'' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Guest Information</h5> -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body customer_view">

                        </div>
                    </form>
                </div>
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script> -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>


<script>

$(document).on('click', '.booking_id', function(){
       
        //$(".loader_block").show();
        var id = $(this).attr('booking-id');
        var uid1= $(this).attr('u-id1');
       
        // console.log(id);
        // return false;
        $.ajax({
            url         : '<?= base_url('SuperAdminController/customer_view') ?>',
            type      : 'POST',
            data        : {booking_id: id,u_id1: uid1},
            
            success     : function(res) {
                console.log(res);

                $('.customer_view').html(res);

               
            }
            
        });
    });
</script>
