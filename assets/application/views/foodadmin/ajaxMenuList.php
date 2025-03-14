 <?php 
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
                                                    <!--  <button class="btn btn-tbl-delete btn-xs">
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
                    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
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
                                   