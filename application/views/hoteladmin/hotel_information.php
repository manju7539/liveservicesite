<style>
   /* .default-select{
   border-radius:5px;
   height:2.7rem;
   } */
   .card {
   height: calc(100% - 15px);
   }
   .row {
   --bs-gutter-x: 15px;
   }
   .card-body {
   padding: 0.875rem;
   }
   #map_wrapper_div {
   height: 400px;
   }
   #map_tuts {
   width: 100%;
   height: 100%;
   }
   .chartjs-render-monitor {
   animation: chartjs-render-animation 1ms;
   }
   .chartjs-size-monitor,
   .chartjs-size-monitor-expand,
   .chartjs-size-monitor-shrink {
   position: absolute;
   direction: ltr;
   left: 0;
   top: 0;
   right: 0;
   bottom: 0;
   overflow: hidden;
   pointer-events: none;
   visibility: hidden;
   z-index: -1;
   }
   .chartjs-size-monitor-expand>div {
   position: absolute;
   width: 1000000px;
   height: 1000000px;
   left: 0;
   top: 0;
   }
   .chartjs-size-monitor-shrink>div {
   position: absolute;
   width: 350%;
   height: 350%;
   left: 0;
   top: 0;
   }
   #map_hotels {
   display: table;
   width: 100vw;
   height: 100vh;
   }
   .rooms{
   height:769px;
   }
   .item img{
   min-height:100%
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
</style>
<style>
   #owl-demo .item img {
   display: block;
   width: 100%;
   height: auto;
   }
   #owl-demo2 .item {
   margin: 3px;
   }
   .room_no {
   margin:10px;
   }

   .bootstrap-tagsinput {
    margin: 0;
    width: 100%;
    padding: 0.5rem 0.75rem 0;
    font-size: 1rem;
    line-height: 1.25;
    transition: border-color 0.15s ease-in-out;
    border: 1px solid #ccc;
  }
  .bootstrap-tagsinput.has-focus {
    background-color: #fff;
    border-color: #5cb3fd;
  }
  .bootstrap-tagsinput .label-info {
    display: inline-block;
    background-color: #636c72;
    /* padding: 0 0.em 0.15em; */
    border-radius: 0.25rem;
    margin-bottom: 0.4em;
    color: #fff;
    font-size: 20px;
  }
  .bootstrap-tagsinput input {
    margin-bottom: 0.5em;
    border: none;
    outline: none;
  }
  .bootstrap-tagsinput .tag [data-role="remove"]:after {
    content: "\00d7";
  }

  .input-group {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .text-entry {
    flex: 1;
    padding: 5px;
  }

  .remove-icon {
    margin-left: 10px;
    padding: 5px 10px;
    cursor: pointer;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 5px;
  }
</style>
<style>
   .modal-dialog {
   max-width: 1000px;
   margin: 1.75rem auto;
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">
               Add Hotel Information
            </div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
               class="fa fa-angle-right"></i>
            </li>
            <li class="active">
               Add Hotel Information
            </li>
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
   <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card card-topline-aqua">
            <div class="card-head">
               <header><span class="page_header_title11">Hotel Information</span></header>
            </div>
            <div class="card-body ">
               <div>
                  <button style="float:right" type="button" class="btn btn-primary css_btn"
                     data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">
                  Update Hotel Information
                  </button>
               </div>
               <br><br>
               <div class="modal fade" id="exampleModalCenter1"  aria-hidden="true">
                  <div class="modal-dialog ">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title"><b>Add Hotel Information</b></h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                           </button>
                        </div>
                        <form action="<?php echo base_url('HoteladminController/add_hotel_info')?>" method="post" enctype="multipart/form-data">
                           <div class="modal-body">
                           <div class="basic-form">
                              <div class="row">
                                 <div class="mb-3 col-md-3 form-group">
                                 <label class="form-label">Hotel Logo</label>
                                    <div class="avatar-upload">
                                       <div class="avatar-edit form-control">
                                          <input type='file' name="hotel_logo" id="imageUpload"
                                             accept=".png, .jpg, .jpeg" class="form-control"/>
                                             <img src="<?php echo $data['hotel_logo']?>" class="img-fluid" alt="">

                                          <label for="imageUpload"></label>
                                       </div>
                                       <div class="avatar-preview">
                                          <div id="imagePreview"
                                             style="background-image: url(<?php echo $data['hotel_logo']?>);">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="mb-3 col-md-9 form-group">
                                    <label class="form-label">Hotel Important Information</label>
                                    <textarea name="hotel_importans" class="summernote"><?php echo $data['hotel_importans']?></textarea>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Hotel Name</label>
                                    <input type="text" name="hotel_name" value="<?php echo $data['hotel_name']?>" class="form-control" placeholder="Hotel Name">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Hotel Coordinates</label>
                                    <div class="input-group">
                                       <input type="text" value="<?php echo $data['latitude']?>" name="latitude" class="form-control"
                                          placeholder="Enter Latitude">
                                       <input type="text" value="<?php echo $data['longitude']?>" name="longitude" class="form-control"
                                          placeholder=" Enter Longitude">
                                    </div>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Address</label>
                                    <input type="address" value="<?php echo $data['address']?>" name="address" class="form-control"
                                       placeholder="Address">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Area</label>
                                    <input type="text" value="<?php echo $data['area']?>" name="area" class="form-control" placeholder="Area">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">Pin Code</label>
                                    <input type="number" value="<?php echo $data['pincode']?>" name="pincode" class="form-control"
                                       placeholder="Pin Code">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">City</label>
                                    <!--<select id="inputState" name="city"
                                       class="default-select form-control wide"
                                       style="display: none;">-->
                                    <select  name="city" class="form-control ">
                                       <option disable> --Select--</option>
                                       <?php
                                          $city_list = $this->MainModel->getData1('city');
                                          
                                          if($city_list)
                                          {
                                            //echo "<pre>";
                                            //print_r($city_list);
                                            foreach ($city_list as $ct) 
                                            {
                                          ?>
                                       <option  <?php if( $data['city'] == $ct['city_id']){echo "selected";}?>   value="<?php echo $ct['city_id']?>"><?php echo $ct['city']?></option>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </select>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                    <label class="form-label">State</label>
                                    <input type="text" value="<?php echo $data['state']?>" name="state" class="form-control" placeholder="">
                                 </div>
                                 <div class="col-xl-3 col-xxl-6 col-md-6 mb-3 form-group">
                                    <label class="form-label">Facilities Name</label>
                                    <input type="text" name="facility_name[]" data-role="tagsinput" value=" 
                                       <?php
                                          if($facility_list)
                                          {
                                              $facility_name = array();
                                          
                                              foreach($facility_list as $rm)
                                              {
                                                  $facility_name[] = $rm['facility_name'];
                                              } 
                                          
                                              $facility_name11 = implode(',',$facility_name);
                                          
                                              print_r($facility_name11);
                                          }
                                          ?>" class="form-control" placeholder="Facilities Name multiples">
                                 </div>
                                
                                 <div class="row" style="">
                                    <?php
                                       $j = 0;
                                       
                                       if($hotels_pics)
                                       {
                                       ?>
                                    <label class="form-label">Upload Photos</label>
                                    <?php
                                       foreach($hotels_pics as $h_p)
                                       {
                                       ?>
                                        <div class="col-md-4 d-flex align-items-center mb-4" >
                                                <input type="hidden" name="hotel_photo_id[]" value="<?php echo $h_p['hotel_photo_id']?>">
                                                <img src="<?php echo $h_p['images'] ?>"  height="70px" width="70px">
                                                <input name="h_image[<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify form-control" data-default-file="<?php echo $h_p['images']?>"/>
                                            
                                                <a onclick="return confirm('Do you want to delete?')" href="<?php echo base_url('HoteladminController/delete_hotel_pht/'.$h_p['hotel_photo_id'])?>" class="btn btn-danger remove_img"><i class="fa fa-trash m-0"></i></a>
                                        </div>
                                    <?php
                                       $j++;
                                       }
                                       }
                                       ?>
                                    <div class="col-md-4">
                                       <input type="file"  name="images[]" accept=".jpg,.jpeg,.png,/application" class="dropify form-control"
                                          placeholder="" multiple />
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn btn-info">Update
                              </button>
                             
                           </div>
                           </div>

                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-xl-12">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="card overflow-hidden">
                           <div class="row m-0 hotel_info">
                              <div class="col-xl-6 p-0">
                                 <div class="card-body ">
                                    <div class="guest-profiles">
                                       <div class="d-flex">
                                          <div class=" check-status">
                                             <!-- <span class="d-block mb-2">Log In</span> -->
                                             <span class="font-w700 fs-22"
                                                style="color:#4bd7ef"><?php echo $data['hotel_name']?>
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <?php 
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_rt = '(hotel_id ="'.$admin_id.'")';
                                       $get_ratings = $this->MainModel->getData('hotel_ratings',$wh_rt);
                                       if(!empty($get_ratings))
                                           {
                                       ?>
                                    <div class="d-flex flex-wrap">
                                       <div class="">
                                          <ul class="stars">
                                             <?php 
                                                if($get_ratings['rating'] == 1)
                                                    {
                                                      
                                                    
                                                ?>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <?php
                                                }
                                                elseif($get_ratings['rating'] == 2)
                                                {
                                                  
                                                ?>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <?php
                                                }
                                                elseif($get_ratings['rating'] == 3)
                                                {
                                                  
                                                ?>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <?php 
                                                }
                                                elseif($get_ratings['rating'] == 4)
                                                {
                                                ?>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <?php 
                                                }
                                                elseif($get_ratings['rating'] == 5)
                                                {
                                                ?>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <a href="javascript:void(0);"><i
                                                class="fa fa-star "></i></a>
                                             <?php 
                                                } 
                                                                                                                   
                                                ?>
                                          </ul>
                                       </div>
                                    </div>
                                    <?php 
                                       }
                                                                                    ?>
                                    <span class="d-block mb-3 font-w600">Hotel Information</span>
                                    <p class="mt-2"><?php echo $data['hotel_importans']?></p>
                                    <!-- -->
                                    <span class="d-block mb-3 font-w600">Address</span>
                                    <p class="mt-2"><?php echo $data['address']?></p>
                                    <div class="facilities font-w500 fs-19">
                                       <div class="mb-3 ">
                                          <span
                                             class="d-block mb-3 font-w600">Facilities</span>
                                          <?php
                                             if($facility_list)
                                             {
                                                 foreach($facility_list as $fc)
                                                 {
                                             ?>
                                          <a href="javascript:void(0);"
                                             class="btn btn-secondary light ">
                                          <?php echo $fc['facility_name']?>
                                          </a>
                                          <?php  
                                             }
                                             }
                                             ?>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <?php
                                          $i = 1;
                                          if($leads_purchase_list)
                                          {
                                              foreach($leads_purchase_list as $l_p)
                                              {
                                          ?>
                                       <div class="col-md-4">
                                          <ul class="list-group row mb-3">
                                             <div class="col-md-12">
                                                <li
                                                   class="list-group-item d-flex justify-content-between lh-condensed">
                                                   <div>
                                                      <h6 class="my-0"
                                                         style="color: #d515b6;">
                                                         <?php echo $l_p['ledas_name'] ?>
                                                      </h6>
                                                      <small
                                                         class="text-black">Plan
                                                      <?php echo $i++ ?></small>
                                                   </div>
                                                   <span class="text-black"
                                                      style="font-size: 13px;">Rs
                                                   <?php echo $l_p['purchase_price'] ?>
                                                   </span>
                                                </li>
                                             </div>
                                          </ul>
                                       </div>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </div>
                                    <div class="accordion-item">
                                       <div id="collapse5Two" class="accordion__body " aria-labelledby="accord-5Two"
                                          data-bs-parent="#accordion-five" style="padding:0px;">
                                          <div class="accordion-body-text" style="padding:0px;">
                                             <div id="map_wrapper_div">
                                                <div id="map-canvas" style="width: 100%; height: 400px;">
                                                </div>
                                             </div>
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
                                          <img src="<?php echo $h_pic['images']?>"
                                             alt="">
                                          <div class="booked">
                                          </div>
                                        
                                       </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script async defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDHyEaFsZ7UWCWz0gBrN_1BsowFQKHen7Y&callback=initialize"></script>
<script>

// update Hotel
// add leads plan script
// $(document).on('submit', '#add_hotel_information', function(e){
//        e.preventDefault(); 
//        $(".loader_block").show();
//        var form_data = new FormData(this);
//        console.log(form_data);
//        $.ajax({
//            url         : '<?= base_url('HoteladminController/add_hotel_info') ?>',
//            method      : 'POST',
//            data        : form_data,
//            processData : false,
//            contentType : false,
//            cache       : false,
//            // dataType    : 'JSON',
//            async:false,
//            success     : function(res) {
           
//                 $.get( '<?= base_url('HoteladminController/hotel_information');?>', function( data ) {
//                     var resu = $(data).find('.hotel_info').html();
//                     $('.hotel_info').html(resu);
//                 });
   
//                setTimeout(function(){  
//                   $(".loader_block").hide();
//                   $("#exampleModalCenter1").modal('hide');
                 
//                   // $(".append_data").html(res);
//                   $(".successmessage").show();
//                }, 2000);
//                setTimeout(function(){  
//                   $(".successmessage").hide();
//                }, 4000);
//            }
//        });
//    });


// Map Script
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