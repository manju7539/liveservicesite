<style>
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
   display: block;
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
</style>
<style type="text/css">
   #map-canvas {
   height: 50%;
   }
   #iw_container .iw_title {
   font-size: 16px;
   font-weight: bold;
   }
   .iw_content {
   padding: 15px 15px 15px 0;
   }
   .hotel_information{
      width: 100%;
   }
   .hotel_information img{
      max-width:100%
   }
   .rooms{
      height:278px
   }
   .rooms img{
      max-height:100%;
      min-height:100%
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
   <div class="page-title-breadcrumb">
      <div class=" pull-left">
         <div class="page-title">Hotel Information</div>
      </div>
      <ol class="breadcrumb page-breadcrumb pull-right">
         <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
         </li>
         <li class="active">Hotel Information</li>
      </ol>
   </div>
</div>
<div class="row mt-4">
<div class="col-xl-12">
   <div class="row">
      <div class="col-xl-12">
         <div class="card overflow-hidden">
            <div class="row m-0">
               <div class="col-xl-6 p-0">
                  <div class="card-body">
                     <div class="guest-profile">
                        <div class="hotel_information">
                           <?php
                              if($data['hotel_logo'])
                              {
                                  $hotel_logo = $data['hotel_logo'];
                              }
                              else
                              {
                                  $hotel_logo = base_url().'documents/h_image.jpg';
                              
                              }
                              ?>
                           <img src="<?php echo $hotel_logo ?>" alt="">
                           <div>
                              <h2 class="font-w600"><?php echo $data['hotel_name']?></h2>
                              <!-- <span class="text-secondary">ID 1234124512551</span><br> -->
                              <div class="mt-2 check-status">
                                 <?php
                                    if($data['city'])
                                    {
                                    $where ='(city_id="'.$data['city'].'")';
                                    $city = $this->MainModel->getData($tbl='city',$where);
                                    // print_r($city);die();
                                    if(!empty($city))
                                    {
                                        $city_d = $city['city'];
                                    }
                                    else
                                    {
                                        $city_d ='-';
                                    }
                                    
                                    }else{
                                      $city_d ='-';
                                    }
                                    
                                    ?>
                                 <span class=" mb-2 fw-bold">City :</span> 
                                 <span class="font-w500 fs-16"><?php echo $city_d?></span>
                              </div>
                              <div class="mt-2 check-status">
                                 <span class=" mb-2 fw-bold">State :</span>
                                 <span class="font-w500 fs-16"><?php echo $data['state']?></span>
                              </div>
                              <div class="mt-2 check-status">
                                 <span class=" mb-2 fw-bold">Created :</span>
                                 <span class="font-w500 fs-16"><?php echo date('d-m-Y', strtotime($data['created_at'])); ?> <?php echo date('h:i A', strtotime($data['created_at'])) ?></span>
                              </div>
                              <div class="mt-1 check-status d-flex">
                                 <span class=" mb-2 fw-bold">Rating :</span>
                                 <span>
                                    <ul class="stars" style="list-style-type: none;">
                                       <div class="d-flex">
                                          <li><a href="javascript:void(0);"><i
                                             class="fa fa-star text-secondary"></i></a>
                                          </li>
                                          <li><a href="javascript:void(0);"><i
                                             class="fa fa-star text-secondary"></i></a>
                                          </li>
                                          <li><a href="javascript:void(0);"><i
                                             class="fa fa-star text-secondary"></i></a>
                                          </li>
                                          <li><a href="javascript:void(0);"><i
                                             class="fa fa-star text-secondary"></i></a>
                                          </li>
                                          <li><a href="javascript:void(0);"><i
                                             class="fa fa-star text-secondary"></i></a>
                                          </li>
                                       </div>
                                    </ul>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <span class=" mb-2 fw-bold">Map:</span>
                        <!-- <div id ="map" style ="width:500px;height:200px">
                           </div> -->
                        <div id="map-canvas" style="width: 500px; height: 200px;">
                        </div>
                        <div class="d-flex flex-wrap">
                           <div class="mt-4 check-status">
                              <!-- <span class="d-block mb-2">Hotel Info</span> -->
                              <h4 class="font-w500 fs-24 fw-bold"> Hotel Information</h4>
                           </div>
                        </div>
                        <p class="mt-2">
                           <?php if(!empty($data['hotel_importans']))
                              {
                                 $info = $data['hotel_importans'];
                              }
                              else
                              {
                                  $info ='Information is not provided';
                              }
                              ?>
                           <?php echo $info;?>
                        </p>
                        <div class="facilities">
                           <div class="mb-3 ">
                              <span class="d-block mb-3 fw-bold">Facilities</span>
                              <?php
                                 if($facility_list)
                                 {
                                     foreach($facility_list as $fc)
                                     {
                                     
                                 ?>
                              <a href="javascript:void(0);"
                                 class="btn btn-secondary light ">
                              <?php echo $fc['facility_name'] ?>
                              </a>
                              <?php  
                                 }
                                 
                                 }
                                 else{
                                   echo "Facilities not provided";
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
                  <div class="col-xl-6 p-0">
                     <div id="owl-demo3" class="owl-carousel">
                        <?php
                           if($hotels_pics)
                           {
                               foreach($hotels_pics as $h_pic)
                               {
                           ?>
                        <div class="item">
                           <div class="rooms">
                              <img class="img-fluid" src="<?php echo $h_pic['images']?>"
                                 alt="">
                              <div class="booked">
                                 <!--<p class="fs-20 font-w500">BOOKED</p>-->
                              </div>
                              <!--<div class="img-content">
                                 <h4 class="fs-24 font-w600 text-white">Bed
                                     Room</h4>
                                 <p class="text-white">Lorem ipsum dolor sit
                                     amet, consectetur adipiscing elit, sed
                                     do eiusmod tempor incididunt ut labore
                                     et dolore magna aliqua. Ut enim ad minim
                                     veniam, quis nostrud exerci</p>
                                 </div>-->
                           </div>
                        </div>
                        <?php
                           }
                           }
                           ?>
                     </div>
                  </div>
               
               <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;">Data updated Successfully...!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="col-xl-12">
                  <div class="">
                     <div class="card-header ">
                        <h4 class="card-title">Departments</h4>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table
                              class="shadow-hover table-responsive-lg table sortable mb-0 text-center table_list">
                              <thead>
                                 <tr>
                                    <th>
                                       Sr.No.
                                    </th>
                                    <th class="text-center">
                                       Icon
                                    </th>
                                    <th> Deparment Name</th>
                                    <th>Validity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="geeks">
                                 <?php
                                    $i = 1;
                                    $u_id =  $this->uri->segment(3);
                                    //  echo "hii";
                                    //    echo($u_id);
                                    //  exit;
                                    $info = $this->MainModel->get_listt($u_id);
                                    //  echo "<pre>";
                                    //   print_r($info);
                                    if( !empty($info)){
                                    
                                      foreach($info as $row)
                                     {
                                       $where1='(department_id="'.$row['department_id'].'")';
                                       $departement =$this->MainModel->getSingleData($tbl='departement',$where1);
                                    
                                       if(!empty($departement))
                                       {
                                          $name = $departement['department_name'];
                                    
                                       }
                                       else
                                       {
                                          $name = "";
                                       }
                                       
                                       // $where2='(department_id="'.$row['department_id'].'")';
                                       $icon =$this->MainModel->getSingleData($tbl='departement',$where1);
                                    
                                    
                                       if($icon){
                                           
                                           $icon_name= $icon['icon'];
                                    
                                       }
                                       else{
                                           $icon_name="";
                                       }
                                       ?>
                                 <tr>
                                    <td> <?php echo $i?> </td>
                                    <td> <img src="<?php echo $icon_name;?>" alt="" style="width: 30px; height: 30px;"></td>
                                    <td> <?php echo  $name ?></td>
                                    <td> <span class="fs-16 text-nowrap"><?php echo date('d-m-Y', strtotime($row['start_date']));?><span style="color:#09bad9"> to </span> <?php echo date('d-m-Y', strtotime($row['end_date']));?></span> </td>
                                    <td><i class= "fa fa-rupee"><?php echo $row['price'];?> </td>
                                    <td>
                                       <!-- <a href="javascript:void(0)" data-id="<?php // $row['id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                          <i class="fa fa-pencil"></i> -->
                                       <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['id']?>" data-admin-id="<?php echo $row['admin_id']?>"><i class="fa fa-pencil"></i></a>
                                       </a>
                                    </td>
                                 </tr>
                                 <!-- Modal -->
                                 <!-- end of modal  -->
                                 <?php
                                    $i++;
                                      }
                                    }
                                    else
                                         {?>
                                 <tr>
                                    <td colspan="9"
                                       style="text-align:center;font-size:14px"
                                       class="text-center">Data Not Available</td>
                                 </tr>
                                 <?php }
                                    ?>
                              </tbody>
                           </table>
                           <nav style="float:right;">
                           </nav>
                        </div>
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
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
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
                                 <input type="file" name="hotel_logo" required>
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
                                    <!-- <input type="hidden" name="department_name[]" id="department_name"  value="<?php echo $row['department_name'];?>"> -->
                                    <td>
                                       <div class="form-check custom-checkbox mb-3 checkbox-success check-lg"
                                          style="margin:auto"
                                          data-toggle="collapse"
                                          data-target="#demo2"
                                          class="accordion-toggle">
                                          <input type="checkbox"
                                             class="form-check-input"
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
                                          <input type="date" min="<?=date('Y-m-d');?>" class=" form-control"
                                             id="form_date_dep_<?php echo $row['department_id'];?>" name="start_date[]"
                                             autocomplete="off">
                                          <span class="input-group-addon"
                                             style="padding:8px">to</span>
                                          <input type="date" min="<?=date('Y-m-d');?>" class="form-control"
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
                                          <div class=" d-flex">
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
            <button class="btn btn-primary next" >Next</button>
            <button class="btn btn-primary prev" style="display:none">Previous</button>
            <button class="btn btn-primary hide_btn_add" style="visibility:hidden;display:none">Add</button>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- edit model start-->
<div class="modal fade" id="servicemanage_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="basic-form get_data_model">
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
<script>
   $(document).on('click','.edit_model_click', function () {
   var id = $(this).attr('data-unic-id');
   var admin_id = $(this).attr('data-admin-id');
   $('#servicemanage_edit_modal').modal('show');
   var base_url = '<?php echo base_url();?>';
   $.ajax({
           method: "POST",
           url: base_url+"SuperAdminController/hotel_info_sub_edit",
           data: {id : id,admin_id:admin_id},
           success: function (response) {
           $('.get_data_model').html(response);
           }
       });
   });
   $(document).on("click",".add_hotel",function(){
       $(".add_hotel_modal").modal('show');
   
   });
   $(document).on("click",".updateStaff",function(){
       var data_id = $(this).attr('data-id');
       $("#edit_"+data_id).modal('show');
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
   
   
   
   
   $(document).on('submit', '#hotel_sub_view_edit', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var data_id =  $("input:hidden").val();
       console.log(data_id);
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/update_vality_department') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               // setTimeout(function(){  
               //  $(".loader_block").hide();
               //  $("#edit_"+data_id).modal('hide');
               //  $(".append_data").html(res);
               //   $(".updatemessage").show();
               //   }, 2000);
               //  setTimeout(function(){  
               //     $(".updatemessage").hide();
               //   }, 4000);
                 $("#geeks").html('');
           $('#servicemanage_edit_modal').modal('hide');  
           $(".loader_block").hide();
           $("#geeks").append(res)
           setTimeout(function(){  
               $("#hotel_sub_view_edit")[0].reset();         
               $(".updatemessage").show();
           }, 4000);
           setTimeout(function(){  
               $(".updatemessage").hide();
           }, 4000);
              
           }
       });
   });
   function Show_hide_Fun(idd) {
   
   
   var check = document.getElementById(idd.id);
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
   function change_status_1(cnt) {
       //alert('hi');
       var base_url = '<?php echo base_url();?>';
       var status = $('#active'+cnt).children("option:selected").val();
       var uid = $('#uid'+cnt).val();
       // console.log(uid);
       // return false;
   // alert(cid);
       if (status != '') {
   
       //     console.log(status);
       // return false;
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
<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDHyEaFsZ7UWCWz0gBrN_1BsowFQKHen7Y&callback=initialize"></script>
<script>
   var map;
   var infoWindow;
   var markers = [];
   
   var markersData = [];
   
   function initialize() {
       var mapOptions = {
           center: new google.maps.LatLng(40.601203,-8.668173),
           zoom: 9,
           mapTypeId: 'roadmap'
       };
   
       map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
   
       infoWindow = new google.maps.InfoWindow();
   
       google.maps.event.addListener(map, 'click', function() {
           infoWindow.close();
       });
   
       getMarkers();
   }
   
   function getMarkers() {
       var base_url = '<?php echo base_url() ?>';
       $.ajax({
           url: base_url + "HomeController/get_lat_long",
           method: "post",
           data: {},
           success: function(data) {
               var markersData = JSON.parse(data);
               displayMarkers(markersData);
           },
           error: function(error) {
               console.log(error);
           }
       });
   }
   
   function displayMarkers(markersData) {
       var bounds = new google.maps.LatLngBounds();
   
       for (var i = 0; i < markersData.length; i++) {
           var hotel_name = markersData[i][0];
           var latlng = new google.maps.LatLng(markersData[i][1], markersData[i][2]);
           var hotel_description = markersData[i][3];
   
           createMarker(latlng, hotel_name, hotel_description);
   
           bounds.extend(latlng);
       }
   
       map.fitBounds(bounds);
   }
   
   function createMarker(latlng, hotel_name, hotel_description) {
       var marker = new google.maps.Marker({
           map: map,
           position: latlng,
           title: hotel_name
       });
   
       markers.push(marker);
   
       google.maps.event.addListener(marker, 'click', function() {
           infoWindow.setContent(hotel_description);
           infoWindow.open(map, marker);
       });
   }
</script>