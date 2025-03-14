<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Menu Management</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Menu Management</li>
            </ol>
         </div>
      </div>
      <?php
         if($this->session->flashdata('add'))
         {
         ?>
      <div class="alert alert-success" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;">
         <strong style="color:#fff ;margin-top:10px;"><?php echo $this->session->flashdata('add') ?></strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <?php
         }
         ?>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Menu Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Menu Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Menu Item</header>
               </div>
               <div class="card-body ">
                  <div class="col-md-6 offset-md-3">
                     <!-- <div class="card card-body"> -->
                     <div class="form-group">
                        <form method="POST">
                           <div>
                              <div class="input-group">
                                 <select class="form-control" name="facilities" id="facilities" required="" onchange="getCatList(this)">
                                    <option value="" selected="" disabled="">Facility</option>
                                    <option value="3">Thali</option>
                                    <option value="4">Punjabi Dishes </option>
                                 </select>
                                 <select class="form-control" id="categories" name="categories" required="">
                                    <option value="" selected="" disabled="">-- Select --</option>
                                 </select>
                                 <select class="form-control" name="menu_for_1" id="menus" required="">
                                    <option value="" selected="" disabled="">-- Select --</option>
                                    <option value="1">Regular Menu</option>
                                    <option value="2">Breakfast Menu</option>
                                    <option value="3">Todays Special</option>
                                 </select>
                                 <!--<a class="btn btn-primary btn-md"><i
                                    class="fa fa-filter text-white"></i></a>-->
                                 <button name="search_1" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <!-- </div> -->
                  </div>
                  <div class="btn-group r-btn">
                     <!--  <a href="<?php // base_url('HomeController/addMenu')?>" id="addRow1" class="btn btn-info">
                        Add New Menu <i class="fa fa-plus"></i>
                        </a> -->
                     <a href="javascript:void(0)" id="addRow1" class="btn btn-info add_menu">
                     Add New Menu 
                     </a>
                  </div>
                  <div class="table-scrollable">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.no.</strong></th>
                              <th><strong>Facility</strong></th>
                              <th><strong>Category</strong></th>
                              <th><strong>Menu</strong></th>
                              <th><strong>Item Name</strong></th>
                              <th><strong>Price</strong></th>
                              <th><strong>Photo</strong></th>
                              <th><strong>Offers</strong></th>
                              <th><strong>Preparation time</strong></th>
                              <th><strong>Description</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php 
                                 // print_r($list);exit;

                              if(!empty($list)){
                                  $i=1;
                                  foreach($list as $l)
                                  {
                                 ?>
                           <tr>
                              <td><?php echo $i?></td>
                              <td>
                                 <?php
                                    $where='(food_facility_id="'.$l['food_facility_id'].'")';
                                    $facility_name= $this->MainModel->facility_name($tbl='food_facility',$where);
                                     if(!empty($facility_name)){
                                        echo $facility_name['facility_name'];
                                     }
                                     else{
                                       echo " ";
                                     }
                                    
                                    ?>
                              </td>
                              <td>
                                 <?php
                                    $where='(food_category_id="'.$l['food_category_id'].'")';
                                    $food_cat_name= $this->MainModel->get_cat_name($tbl='food_category',$where);
                                     if(!empty($food_cat_name)){
                                        echo $food_cat_name['category_name'];
                                     }
                                     else{
                                       echo " ";
                                     }
                                    
                                    ?>
                              </td>
                              <td>
                                 <?php 
                                    if($l['menus_for'] == 1)
                                          {
                                             $menus_for = 'Regular Menu';
                                          }
                                          elseif($l['menus_for'] == 2)
                                          {
                                             $menus_for = 'Breakfast Menu';
                                          }                                                                  
                                          elseif($l['menus_for'] == 3)
                                          {
                                             $menus_for = 'Todays Special Menu';
                                          }
                                    ?>
                                 <p>
                                    <?php echo $menus_for;?>
                                 </p>
                              </td>
                              <td>
                                 <p><?php echo $l['items_name']?></p>
                              </td>
                              <td>
                                 <p><?php echo $l['price']?> Rs</p>
                              </td>
                              <td>
                                 <div class="lightgallery">
                                    <a href="<?php echo $l['item_img']?>"
                                       data-exthumbimage="<?php echo $l['item_img']?>"
                                       data-src=""
                                       class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                    <img class="me-3 rounded"
                                       src="<?php echo $l['item_img']?>" alt=""
                                       style="width:60px; height:40px;">
                                    </a>
                                 </div>
                              </td>
                              <td>
                                 <p><?php echo $l['offer_in_per']?> % Offer</p>
                              </td>
                              <?php 
                                 if($l['time_in'] == 1)
                                 {
                                     $time_in = 'Min';
                                 }
                                 elseif($l['time_in'] == 2)
                                 {
                                     $time_in = 'Hours';
                                 }
                                 else{
                                    $time_in ="";
                                 }
                                 ?>
                              <td><?php echo $l['prepartion_time']?> <?php echo $time_in;?></td>
                              <td>
                                 <div>
                                    <a href="#">
                                       <div class="badge badge-info"
                                          data-bs-toggle="modal"
                                          data-bs-target="#desc_m_<?php echo $l['food_item_id']?>">
                                          view
                                       </div>
                                    </a>
                                 </div>
                              </td>
                              <td>
                                 <a href="javascript:void(0)" class="btn btn-tbl-edit btn-xs updateMenu" data-id="<?php echo $l['food_item_id']?>">
                                 <i class="fa fa-pencil"></i>
                                 </a>
                                 <a href="#" id="delete_<?php echo $l['food_item_id']?>"
                                    class="btn btn-tbl-delete btn-xs">
                                 <i class="fa fa-trash"></i>
                                 </a>
                                 <!--   <button class="btn btn-tbl-delete btn-xs">
                                    <i class="fa fa-trash-o "></i>
                                    </button> -->
                              </td>
                           </tr>
                           <script>
                              document.getElementById('delete_<?php echo $l['food_item_id'] ?>').onclick = function() {
                              var id='<?php echo $l['food_item_id'] ?>';
                              var base_url='<?php echo base_url();?>';
                              swal({
                              
                                      
                                      title: "Are you sure?",
                                      text: "You will not be able to recover this file!",
                                      type: "warning",
                                      showCancelButton: true,
                                      confirmButtonColor: '#DD6B55',
                                      confirmButtonText: 'Yes, delete it!',
                                      cancelButtonText: "No, cancel",
                                      closeOnConfirm: false,
                                      closeOnCancel: false
                                  },
                                  function(isConfirm) {
                                  //console.log(id);
                                      if (isConfirm) {
                                          $.ajax({
                                              url:base_url+"HomeController/delete_menus", 
                                              //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                              type: "post",
                                              data: {id:id},
                                              dataType:"HTML",
                                              success: function (data) {
                                                  if(data==1){
                                                  swal(
                                                          "Deleted!",
                                                          "Your Menu has been deleted!",
                                                          "success");
                                                      }
                                                  $('.confirm').click(function()
                                                                              {
                                                                                  location.reload();
                                                                              });
                                              }
                              
                                              });                                                                                                           
                                                          
                                      } else {
                                          swal(
                                              "Cancelled",
                                              "Your  Menu is safe !",
                                              "error"
                                          );
                                      }
                                  });
                              };
                           </script>
                           <!-- add btn modal  -->
                           <div class="modal fade bd-add-modal update_modal update_menu_modal_<?php echo $l['food_item_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                    <form id="frmupdateblock"  method="post" enctype="multipart/form-data">
                                       <div class="modal-header">
                                          <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Update Menu</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <input type="hidden" name="food_item_id" value="<?php echo $l['food_item_id']?>">
                                          <div class="col-lg-12">
                                             <div class="basic-form">
                                                <div class="row">
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Select Facility</label>
                                                      <select class="form-control" id="facility1_<?php echo $l['food_item_id']?>" name="facility1">
                                                         <?php
                                                            $facility= $this->MainModel->getAllTableData($tbl='food_facility');
                                                            //print_r($category);die;
                                                            foreach($facility as $fac)
                                                            {
                                                                    $fac_name = $fac['facility_name'];
                                                            ?>
                                                         <option <?php if($fac['food_facility_id'] == $l['food_facility_id']) { echo "Selected";}?> value="<?php echo $fac['food_facility_id']?>"><?php echo $fac_name?></option>
                                                         <?php 
                                                            }
                                                            ?>                    
                                                      </select>
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Select Category</label>
                                                      <select class="form-control" id="category1_<?php echo $l['food_item_id']?>" name="category">
                                                         <option value="0">-- Select --</option>
                                                         <?php
                                                            $category= $this->MainModel->getAllTableData($tbl='food_category');
                                                            foreach($category as $cat1)
                                                            {
                                                                    $cat_name = $cat1['category_name'];
                                                            ?>
                                                         <option <?php if($cat1['food_category_id'] == $l['food_category_id']) { echo "Selected";}?> value="<?php echo $cat1['food_category_id']?>"><?php echo $cat_name?></option>
                                                         <?php 
                                                            }
                                                            ?>  
                                                      </select>
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label"> Menus For</label>   
                                                      <select class="form-control" name="menu_for" id="active<?php echo $l['food_item_id'];?>">
                                                         <option <?php if($l['menus_for']=="1") {echo "Selected";}?> value="1" selected>Regular Menu</option>
                                                         <option <?php if($l['menus_for']=="2") {echo "Selected";}?> value="2">Breakfast Menu</option>
                                                         <option <?php if($l['menus_for']=="3") {echo "Selected";}?> value="3">Todays Special</option>
                                                      </select>
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Item Name</label>
                                                      <input type="text" name="items_name" value="<?php echo $l['items_name']?>" class="form-control">
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Price</label>
                                                      <input type="text" name="price" value="<?php echo $l['price']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Item Photo</label>
                                                      <div class="input-group transparent-append" style="border: 1px solid #ced4da;padding: 5px 5px; border-radius:                                                                                                       3px;">
                                                         <span class="input-group-text"> <i class="fa fa-file"></i> </span>
                                                         <input accept="image/*" type="file" name="profile_photo" id="admin_profile" class="file_upload"                                                                                                             onchange="pressed()">
                                                         <label id="fileLabel " style="line-height: 26px;"><?php echo basename($l['item_img']);?></label>
                                                      </div>
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Offers in ( % )</label>
                                                      <input type="text" value="<?php echo $l['offer_in_per']?>" name="offer_in_per" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="limit" class="form-control" min="1"
                                                         max="100">
                                                   </div>
                                                   <div class="mb-3 col-md-6">
                                                      <label class="form-label">Preperation time</label>
                                                      <div class="input-group">
                                                         <input type="text" name="prepartion_time" value="<?php echo $l['prepartion_time']?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">                 
                                                         <select class="form-control" name="time_in" id="active1<?php echo $l['food_item_id'];?>">
                                                            <option <?php if($l['time_in']=="1") {echo "Selected";}?> value="1" selected>Minute</option>
                                                            <option <?php if($l['time_in']=="2") {echo "Selected";}?> value="2">Hour</option>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="mb-3 col-md-12">
                                                      <label class="form-label">Description</label>
                                                      <textarea class="summernote" name="description" value="<?php echo $l['description']?>"><?php echo $l['description']?></textarea>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary css_btn" >Add</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <!-- end add btn modal -->
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
<!-- description model start -->
<?php 
   foreach($list as $l)
          {
             //echo "<pre>";
             //print_r($l);
   
   ?>
<div class="modal fade desc_m" id="desc_m_<?php echo $l['food_item_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"><b>Menu Description</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <p>
               <?php echo $l['description']?>
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary css_btn" data-bs-dismiss="modal">close</button>
         </div>
      </div>
   </div>
</div>
<?php 
   }
   
   ?>
<!-- description model end -->
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
<div class="modal fade bd-example1-modal-lg add_menu_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg slideInRight animated">
   <form id="addMenuInfo" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Menu Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <!-- <input type="hidden" name="food_item_id" value="<?php echo $list['food_item_id']?>"> -->
            <div class="col-12 ">
               <div class="row">
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Select Facility</label>
                     <select class="form-control" id="facility" name="food_facility" required>
                        <option value="" selected disabled>---select---</option>
                        <?php 
                           $admin_id = $this->session->userdata('u_id');
                           $wh_admin = '(u_id ="'.$admin_id.'")';
                           $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                           $hotel_id = $get_hotel_id['hotel_id']; 
                           
                                            $where = '(hotel_id ="'.$hotel_id.'")';
                                            $facility_d = $this->MainModel->getAllData1($tbl ='food_facility',$where);
                                            foreach ($facility_d as $f) 
                                            {
                                                         ?>
                        <option value="<?php echo $f["food_facility_id"];?>"><?php echo $f["facility_name"];?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Select Category</label>
                     <select class="form-control" name="food_category" id="category">
                        <option value data-isdefault="true" readonly>---select---</option>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label"> Menus For</label>
                     <select class="form-control" name="menu_for" required>
                        <option value="" selected disabled>---select---</option>
                        <option value="1">Regular Menu</option>
                        <option value="2">Breakfast Menu</option>
                        <option value="3">Today's Special</option>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Item Name</label>
                     <input type="text" name="items_name" class="form-control" placeholder="Item Name" required>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Price</label>
                     <input type="text" name="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control"
                        placeholder="Price" required>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Item Photo</label>
                     <input type="file" name="file" class="form-control" required style="width:100%;">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Offers in ( % )</label>
                     <input type="text" name="offer" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="quantity" id="limit"
                        class="form-control" min="1" max="100" value=""
                        placeholder="Offer">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Preperation time</label>
                     <div class="input-group">
                        <input type="text" name="prepartion_time" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control"
                           placeholder="Preperation Time" required>
                        <select class="form-control" name="time_in" required>
                           <option value="" selected disabled>---select---</option>
                           <option value="1">Minute</option>
                           <option value="2">Hour</option>
                        </select>
                     </div>
                  </div>
                  <div class="mb-3 col-md-12">
                     <label class="form-label">Description</label>
                     <textarea class="summernote" name="description" required></textarea>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-primary css_btn">Add </button>
         </div>
   </form>
   </div>
</div>
<script>
   $(document).on("click",".add_menu",function(){
       $(".add_menu_modal").modal('show');
   });
   $(document).on("click",".updateMenu",function(){
       var data_id = $(this).attr('data-id');
       $(".update_menu_modal_"+data_id).modal('show');
   });
   
   $(document).on('submit', '#addMenuInfo', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HomeController/add_menus') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_menu_modal").modal('hide');
                $(".append_data").html(res);
                $(".successmessage").show();
                 }, 2000);
              setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
           }
       });
   });
   $(document).on('submit', '#frmupdateblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HomeController/update_menus') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               setTimeout(function(){  
                $(".loader_block").hide();
               $(".update_modal").modal('hide');
               $(".append_data").html(res);
               $(".updatemessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".updatemessage").hide();
                 }, 4000);
              
           }
       });
   });
   
     window.pressed = function()
        {
          var a = document.getElementById('admin_profile');
          if(a.value == "")
          {
            fileLabel.innerHTML = "Choose file";
          }
          else
          {
            var theSplit = a.value.split('\\');
            fileLabel.innerHTML = theSplit[theSplit.length-1];
          }
        };


      //   for filter option
      function getCatList(idd){
            var food_facility_id=idd.value;
            var base_url='<?php echo base_url()?>';
             $.ajax({
                        
                        url: base_url + "HomeController/get_selected_category",
                        method: "POST",
                        data: {
                            food_facility_id: food_facility_id
                        },
                        success: function(data)
                        {
                           //alert(data);
                          if(data !=0){
                           $('#categories').html('<option disabled>---Select--</option>');
                           $('#categories').append(data);
                          }
                          else{
                            $('#categories').html('<option selected disabled value="">---Select--</option>');
                          }
                        }
                     });
            
            
          }
          $(document).ready(function()
            {
                var base_url = '<?php echo base_url()?>';
                <?php
                    
                foreach($list as $l)
                {
                ?>
                $('#facilities_<?php echo $l['food_item_id']?>').change(function()
                {
                var facilities_1 = $('#facilities_<?php echo $l['food_item_id']?>').val();
                //alert(category);
                if(facilities_1 != '')
                {
                    $.ajax({
                            url     : base_url +"HomeController/changeUpCategory_for_search_data",
                            method  : "post",
                            data    : {facilities_1 : facilities_1},
                            success : function(data)
                                        {
                                        //alert(data);
                                        $('#categories_<?php echo $l['food_item_id']?>').html(data);
                                        $('#categories_<?php echo $l['food_item_id']?>').html(data);
                                        }
                    });
                }
                else
                {
                    $('#categories_<?php echo $l['food_item_id']?>').html('<option value="">--Select--</option>')
                }
                });
                <?php
                    }
                ?>
            });
</script>
<script>
      $(document).ready(function()
      {
         var base_url = '<?php echo base_url();?>';

            $('#facility').change(function() 
            {
               var food_facility_id = $('#facility').val();
               //alert(facility_id);
               if (food_facility_id != '')
               {
                  
                     $.ajax({
                        
                        url: base_url + "HomeController/get_selected_category",
                        method: "POST",
                        data: {
                            food_facility_id: food_facility_id
                        },
                        success: function(data)
                        {
                           //alert(data);
                           $('#category').html(data);
                        }
                     });
               }
               else
               {
                  $('#category').html('<option value="">Choose sub category</option>');
               }
            });
      });   
   </script>
   