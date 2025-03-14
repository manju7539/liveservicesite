<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<?php if($icon_id == 1){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>List of Services</header>
      </div>
      <div class="card-body">
         <div>
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
               data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Room Services</button>
         </div>
         <br><br>
         <!-- add button -->
         <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Add Room Services</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form action="<?php echo base_url('HoteladminController/add_room_services')?>" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                        <div class="col-lg-12">
                           <div class="basic-form">
                              <div class="row">
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Service Name</label>
                                    <input type="text" name="service_name" class="form-control" placeholder="Service Name"
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="amount" class="form-control" placeholder="Price"
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Icons</label>
                                    <input type="file" name="icon_img" accept=".png,.jpg,.jpeg,/application" class=" dropify form-control"
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Additional Note</label>
                                    <textarea class="summernote" name="additional_note" rows="3" id="comment"
                                       required=""></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Facility</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th><strong>Sr.no.</strong></th>
                     <th><strong>Service Name</strong></th>
                     <th><strong>Price</strong></th>
                     <th><strong>Icon</strong></th>
                     <th><strong>Note</strong></th>
                     <th><strong>Action</strong></th>
                  </tr>
               </thead>
               <tbody class="">
                  <?php
                     $i = 1;
                     if($list)
                     {
                         foreach($list as $rms)
                         {
                     ?>
                  <tr>
                     <td><strong><?php echo $i++?></strong></td>
                     <td>
                        <?php echo $rms['service_name'] ?>
                     </td>
                     <td><?php echo $rms['amount'] ?> Rs</td>
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $rms['icon_img'] ?>"
                              data-exthumbimage="<?php echo $rms['icon_img'] ?>"
                              data-src="<?php echo $rms['icon_img'] ?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3  "
                              src="<?php echo $rms['icon_img'] ?>"
                              alt="" style="width:20px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <!-- <td>
                        <button class="btn btn-secondary_<?php //echo $rms['r_s_services_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i
                                class="fa fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $rms['r_s_services_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a href="#"
                           class="btn btn-warning shadow btn-xs sharp me-1"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModalCenter_<?php echo $rms['r_s_services_id'] ?>"><i
                           class="fa fa-pencil"></i></a>
                        <a href="#" onclick="delete_data_service(<?php echo $rms['r_s_services_id'] ?>)"
                           class="btn btn-danger shadow btn-xs sharp"><i
                           class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $rms['r_s_services_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo strip_tags($rms['additional_note']) ?></span>
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
                     
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php
   $i = 1;
   if($list)
   {
       foreach($list as $rms)
       {
   ?>
<div class="modal fade" id="exampleModalCenter_<?php echo $rms['r_s_services_id'] ?>" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Services</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form action="<?php echo base_url('HoteladminController/edit_room_services')?>" method="post" enctype="multipart/form-data" class="form-valide-with-icon needs-validation" novalidate="">
            <input type="hidden" name="r_s_services_id" value="<?php echo $rms['r_s_services_id'] ?>">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="mb-3">
                     <label class="text-label form-label">Service Name</label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="service_name" value="<?php echo $rms['service_name'] ?>">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-label form-label">Price</label>
                     <div class="input-group">
                        <input type="number" class="form-control" name="amount" value="<?php echo $rms['amount'] ?>">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-label form-label">Icon</label>
                     <div class="input-group">
                        <input type="file" class="dropify form-control" name="icon_img" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $rms['icon_img']?>">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-label form-label">Addtional Note</label>
                     <div class="input-group">
                        <textarea class="form-control" name="additional_note" id="" cols="30" rows="10"><?php echo strip_tags($rms['additional_note']) ?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-info">Update Service</button>
               <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
<?php  }else if($icon_id == 2){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>Add Menu Items</header>
      </div>
      <div class="add_div_view2" style="display:none;">
         <div class="card-body">
            <div class="row">
               <div class="col-md-9">
               </div>
               <div class="col-md-3">
                  <button style="float:right;" type="button" class="btn btn-primary css_btn"
                     data-bs-toggle="modal" data-bs-target="#create_login_new">Add Categories</button>
               </div>
            </div>
            <div class="modal fade"  id="create_login_new" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="card-title">Add Categories</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <form action="<?php echo base_url('HoteladminController/add_room_service_cat')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="mb-3 col-md-12 form-group">
                              <label class="form-label">Categories Name</label>
                              <input type="text" class="form-control" name="category_name" placeholder="Categories Name"
                                 required>
                           </div>
                           <div class="mb-3 col-md-12 form-group">
                              <label class="form-label">Photo</label>
                              <input type="file" name="image" class="form-control" accept=".png,.jpg,.jpeg,/application" required>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="table-scrollable">
               <table id="example1" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Sr.no.</strong></th>
                        <th><strong>Category Name</strong></th>
                        <th><strong>Photo</strong></th>
                        <th><strong>Action</strong></th>
                     </tr>
                  </thead>
                  <tbody class="">
                     <?php
                        $i = 1;
                        if($list)
                        {
                            foreach($list as $rmsc)
                            {
                        ?>
                     <tr>
                        <td><strong><?php echo $i++?></strong></td>
                        <td>
                           <?php echo $rmsc['category_name'] ?>
                        </td>
                        <td>
                           <div class="lightgallery"
                              class="room-list-bx d-flex align-items-center">
                              <a href="<?php echo $rmsc['image'] ?>"
                                 data-exthumbimage="<?php echo $rmsc['image'] ?>"
                                 data-src="<?php echo $rmsc['image'] ?>"
                                 class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                              <img class="me-3  "
                                 src="<?php echo $rmsc['image'] ?>"
                                 alt="" style="width:40px; height:40px;">
                              </a>
                           </div>
                        </td>
                        <td>
                           <a href="#"
                              class="btn btn-info shadow btn-xs sharp me-1"
                              data-bs-toggle="modal"
                              data-bs-target="#exampleModalCenter_<?php echo $rmsc['room_servs_category_id'] ?>"><i
                              class="fa fa-pencil"></i></a>
                           <a href="#" onclick="delete_data_cat(<?php echo $rmsc['room_servs_category_id'] ?>)"
                              class="btn btn-danger shadow btn-xs sharp delete"><i
                              class="fa fa-trash"></i></a>
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
         <?php
            if($list)
            {
                foreach($list as $rmsc)
                {
            ?>
         <div class="modal fade" id="exampleModalCenter_<?php echo $rmsc['room_servs_category_id'] ?>" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Edit Category</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form action="<?php echo base_url('HoteladminController/edit_room_service_cat')?>" method="post" enctype="multipart/form-data" class="form-valide-with-icon needs-validation" novalidate="">
                     <input type="hidden" name="room_servs_category_id" value="<?php echo $rmsc['room_servs_category_id'] ?>">
                     <div class="modal-body">
                        <div class="basic-form">
                           <div class="mb-3">
                              <label class="text-label form-label">Category Name</label>
                              <div class="input-group">
                                 <input type="text" class="form-control" name="category_name" value="<?php echo $rmsc['category_name'] ?>">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="text-label form-label">Photo</label>
                              <div class="input-group">
                                 <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $rmsc['image']?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Update category</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <?php
            }
            }
            ?>
      </div>
      <div class="add_div_view">
         <div class="card-body">
            <div class="col-md-12 col-sm-12">
               <div class="panel tab-border card-box">
                  <header class="panel-heading panel-heading-gray custom-tab">
                     <ul class="nav nav-tabs">
                        <?php
                           foreach ($room_servs_cat_list as $row) {
                               ?>
                        <li class="nav-item"><a href="#new_orders_div_<?php echo $row['room_servs_category_id']?>" data-bs-toggle="tab" id="<?php echo $row['room_servs_category_id']?>"> <?php echo $row['category_name'] ?></a>
                        </li>
                        <?php
                           }
                           ?>
                     </ul>
                  </header>
               </div>
            </div>
            <div class="row" style="margin-bottom:5px;">
               <div class="col-md-3">
               </div>
               <div class="col-md-6"></div>
               <div class="col-md-3">
                  <button type="submit" style="float:right;" class="btn btn-primary css_btn" onclick="orderserviceview()"  data-bs-toggle="modal"
                     data-bs-target="#exampleModalCenter"><i class="fa fa-plus">
                  </i>Add Category</button>
               </div>
            </div>
         </div>
      </div>
      </div>
   
   <div class="tab-content">
   <?php
      if($room_servs_cat_list)
      {
          foreach($room_servs_cat_list as $rmscl)
          {
          ?>
           <div class="tab-pane active" style="background-color:white;" id="new_orders_div_<?php echo $rmscl['room_servs_category_id']?>">
    <div class="row">
        <div class="col-md-9">
        </div>
        <div class="col-md-3">
            <button style="float:right;margin-right:20px" type="button" class="btn btn-primary css_btn"
               data-bs-toggle="modal" data-bs-target="#create_login_<?php echo $rmscl['room_servs_category_id']?>">Create Items</button>
        </div>
    </div>
    <br>
    <div class="modal fade"  id="create_login_<?php echo $rmscl['room_servs_category_id']?>" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="card-title">Add Items of <?php echo $rmscl['category_name']?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <form action="<?php echo base_url('HoteladminController/add_room_service_menus')?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="room_servs_category_id" value="<?php echo $rmscl['room_servs_category_id']?>">   
            <div class="modal-body">
                <div class="mb-3 col-md-12 form-group">
                    <label class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="menu_name" placeholder="Item Name"
                           required>
                </div>
                <div class="mb-3 col-md-12 form-group">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Price"
                           required>
                </div>
                <div class="mb-3 col-md-12 form-group">
                    <label class="form-label">Photo</label>
                    <input type="file" name="image" class="form-control" accept=".png,.jpeg,.jpg,/application"
                           required>
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label">Preparation time</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="prepartion_time"
                              placeholder="Preparation time" required="">
                        <select id="inputState" name="time_in"
                              class="default-select form-control wide"
                              >
                              <option value data-isdefault="true">---select---</option>
                              <option value="1">Minute</option>
                              <option value="2">Hour</option>
                           </select>
                    </div>
                </div>
                <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Offer</label>
                        <input type="number" class="form-control" name="offer_in_per"
                           placeholder="Offer" required="">
                </div>
                <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Details</label>
                        <textarea class="form-control" name="details" rows="4" id="facilities"
                           required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="tab-pane active show" id="new_orders_div_<?php echo $rmscl['room_servs_category_id']?>_1">
    <div class="card">
        <div class="card-header">
            <div>
                <h4 class="card-title">List of <?php echo $rmscl['category_name']?> Items</h4>
            </div>
            <div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-scrollable">
                <table id="acceptedOrder_tb<?php echo $rmscl['room_servs_category_id']?>" class="display full-width">
                    <thead>
                        <tr>
                           <th><strong>Sr.no.</strong></th>
                           <th><strong>Item Name</strong></th>
                           <th><strong>Price</strong></th>
                           <th><strong>Photo</strong></th>
                           <th><strong>Offer</strong></th>
                           <th><strong>Details</strong></th>
                           <th><strong>Action</strong></th>
                        </tr>
                     </thead>
                     <tbody class="">
                        <?php
                           $i = 1;
                           
                           $admin_id = $this->session->userdata('u_id');
                           
                           $room_service_menu_list = $this->MainModel->get_room_service_menu_list($rmscl['room_servs_category_id'],$admin_id);
                           
                           if($room_service_menu_list)
                           {
                               foreach($room_service_menu_list as $rsm)
                               {
                           ?>
                        <tr>
                           <td><strong><?php echo $i++?></strong></td>
                           <td><?php echo $rsm['menu_name'] ?></td>
                           <td><?php echo $rsm['price'] ?> Rs</td>
                           <td>
                              <div class="lightgallery"
                                 class="room-list-bx d-flex align-items-center">
                                 <a href="<?php echo $rsm['image'] ?>"
                                    data-exthumbimage="<?php echo $rsm['image'] ?>"
                                    data-src="<?php echo $rsm['image'] ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class="me-3  "
                                    src="<?php echo $rsm['image'] ?>"
                                    alt="" style="width:40px; height:40px;">
                                 </a>
                              </div>
                           </td>
                           <td>
                              <?php echo $rsm['offer_in_per'] ?>% off on <?php echo $rsm['menu_name'] ?>
                           </td>
                           <td> <?php echo $rsm['details'] ?> </td>
                           <td>
                              <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                                 data-bs-toggle="modal"
                                 data-bs-target=".bd-example-modal-lg_<?php echo $rsm['room_serv_menu_id'] ?>"><i
                                 class="fa fa-pencil"></i></a>
                              <a href="#" onclick="delete_data_item(<?php echo $rsm['room_serv_menu_id'] ?>)"
                                 class="btn btn-danger shadow btn-xs sharp"><i
                                 class="fa fa-trash"></i></a>
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
   </div>
</div>
</div>
</div>
</div>
<!-- edit modal-->
<?php
   if($room_service_menu_list)
   {
       foreach($room_service_menu_list as $rsm)
       {
   ?>
<div class="modal fade bd-example-modal-lg_<?php echo $rsm['room_serv_menu_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form action="<?php echo base_url('HoteladminController/edit_room_service_menu')?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="room_serv_menu_id" value="<?php echo $rsm['room_serv_menu_id'] ?>">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Category name</label>
                        <input type="text" name="" class="form-control" value="<?php echo $rmscl['category_name']?>" readonly>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="menu_name" value="<?php echo $rsm['menu_name'] ?>" class="form-control" placeholder="" required>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" value="<?php echo $rsm['price'] ?>" class="form-control" placeholder="" required>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Offers in ( % )</label>
                        <input type="number" id="limit" class="form-control"
                           min="1" max="100" name="offer_in_per" value="<?php echo $rsm['offer_in_per'] ?>">
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Preparation time</label>
                        <div class="input-group">
                           <input type="number" class="form-control" name="prepartion_time" value="<?php echo $rsm['prepartion_time'] ?>">
                           <select id="inputState" name="time_in" class="default-select form-control wide"
                              style="display: none;">
                              <option selected="" disabled="">---select---</option>
                              <option <?php if($rsm['time_in'] == 1){echo "Selected";}?> value="1">Minute</option>
                              <option <?php if($rsm['time_in'] == 2){echo "Selected";}?> value="2">Hour</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Photo</label>
                        <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $rsm['image']?>">
                        <br>
                        <output id="Filelist"></output>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Details</label>
                        <textarea class="form-control" rows="4" name="details" id="facilities" required><?php echo $rsm['details'] ?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-info">Update Items</button>
               <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
<!--/. edit modal-->
<?php
   }
   }
   
   ?>    
   </div>                                                 
<?php  }else if($icon_id == 3){  ?>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>List of Mini Bar Menu</header>
      </div>
      <div class="card-body">
         <div>
            <button style="float:right;" type="button" class="btn btn-primary css_btn"
               data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Mini Bar Services</button>
         </div>
         <br><br>
         <!-- add button -->
         <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Add Mini Bar Services</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form action="<?php echo base_url('HoteladminController/add_room_service_minibar')?>" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                        <div class="col-lg-12">
                           <div class="basic-form">
                              <div class="row">
                                 <div class="mb-3 col-md-4 form-group">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" name="item_name" class="form-control" placeholder="Item Name"
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-4 form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Price"
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-4 form-group">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="icon_img" accept=".png,.jpg,.jpeg,/application" class="form-control" placeholder=""
                                       required>
                                 </div>
                                 <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Description</label>
                                    <textarea class="summernote" rows="3" id="comment" name="description"
                                       required=""></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Facility</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th><strong>Sr.no.</strong></th>
                     <th><strong>Item Name</strong></th>
                     <th><strong>Price</strong></th>
                     <th><strong>Photo</strong></th>
                     <th><strong>Description</strong></th>
                     <th><strong>Action</strong></th>
                  </tr>
               </thead>
               <tbody class="">
                  <?php
                     $i = 1;
                     if($list)
                     {
                         foreach($list as $rm_mbr)
                         {
                     ?>
                  <tr>
                     <td><strong><?php echo $i++?></strong></td>
                     <td>
                        <?php echo $rm_mbr['item_name'] ?>
                     </td>
                     <td><?php echo $rm_mbr['price'] ?> Rs</td>
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $rm_mbr['icon_img'] ?>"
                              data-exthumbimage="<?php echo $rm_mbr['icon_img'] ?>"
                              data-src="<?php echo $rm_mbr['icon_img'] ?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3  "
                              src="<?php echo $rm_mbr['icon_img'] ?>" alt=""
                              style="width:50px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <!-- <td>
                        <button class="btn btn-secondary_<?php //echo $rm_mbr['r_s_min_bar_id'] ?> shadow btn-xs sharp"
                            data-toggle="popover"><i
                                class="fa fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $rm_mbr['r_s_min_bar_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a href="#"
                           class="btn btn-warning shadow btn-xs sharp me-1"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModalCenter_<?php echo $rm_mbr['r_s_min_bar_id'] ?>"><i
                           class="fa fa-pencil"></i></a>
                        <a href="#" onclick="delete_data_minibar(<?php echo $rm_mbr['r_s_min_bar_id'] ?>)"
                           class="btn btn-danger shadow btn-xs sharp"><i
                           class="fa fa-trash"></i></a>
                     </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $rm_mbr['r_s_min_bar_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo strip_tags($rm_mbr['description']) ?></span>
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
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php
   if($list)
   {
       foreach($list as $rm_mbr)
       {
   ?>
<div class="modal fade" id="exampleModalCenter_<?php echo $rm_mbr['r_s_min_bar_id'] ?>" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form action="<?php echo base_url('HoteladminController/edit_room_service_minibar')?>" method="post" enctype="multipart/form-data" class="form-valide-with-icon needs-validation" novalidate="">
            <input type="hidden" name="r_s_min_bar_id" value="<?php echo $rm_mbr['r_s_min_bar_id'] ?>">
            <div class="modal-body">
               <div class="basic-form">
                  <div class="mb-3">
                     <label class="text-label form-label">Item Name</label>
                     <div class="input-group">
                        <input type="text" class="form-control" name="item_name" value="<?php echo $rm_mbr['item_name'] ?>">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-label form-label">Price</label>
                     <div class="input-group">
                        <input type="number" class="form-control" name="price" value="<?php echo $rm_mbr['price'] ?>">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-label form-label">Photo</label>
                     <div class="input-group">
                        <input type="file" class="dropify form-control" name="icon_img" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $rm_mbr['icon_img']?>">
                        <br>
                        <output id="Filelist"></output>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Description</label>
                     <textarea class="summernote" rows="3" id="comment" name="description"><?php echo $rm_mbr['description'] ?></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-info">Update </button>
               <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php
   }
   }
   ?>
<?php  }?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   // $('.delete').click(function() {
   function delete_data_service(id)
   {
       var id = id;
       var base_url = '<?php echo base_url()?>';
   
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: 
           {
               confirmButton: 'btn btn-danger',
               cancelButton: 'btn btn-success'
           },
           buttonsStyling: false
       })
   
       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) => 
       {
           if (result.isConfirmed) 
           {
               $.ajax({
                       url     : base_url + "HoteladminController/delete_room_services",
                       method  : "post",
                       data    : {id : id},
                       success : function(data)
                               {
                                   // alert(data);
                                   if(data == 1)
                                   {
                                       swalWithBootstrapButtons.fire(
                                                   'Deleted!',
                                                   'Your file has been deleted.',
                                                   'success'
                                               ).then((result) =>
                                               {
                                                   location.reload();
                                               })
                                   }
                               }
   
                   });
           } 
           else if (
               /* Read more about handling dismissals below */
               result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
                   'Cancelled',
                   'Your imaginary file is safe :)',
                   'error'
               )
           }
       })
   
   }
</script>
<script>
   // $('.delete').click(function() {
   function delete_data_minibar(id)
   {
       var id = id;
       var base_url = '<?php echo base_url()?>';
   
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: 
           {
               confirmButton: 'btn btn-danger',
               cancelButton: 'btn btn-success'
           },
           buttonsStyling: false
       })
   
       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) => 
       {
           if (result.isConfirmed) 
           {
               $.ajax({
                       url     : base_url + "HoteladminController/delete_room_service_minibar",
                       method  : "post",
                       data    : {id : id},
                       success : function(data)
                               {
                                   // alert(data);
                                   if(data == 1)
                                   {
                                       swalWithBootstrapButtons.fire(
                                                   'Deleted!',
                                                   'Your file has been deleted.',
                                                   'success'
                                               ).then((result) =>
                                               {
                                                   location.reload();
                                               })
                                   }
                               }
   
                   });
           } 
           else if (
               /* Read more about handling dismissals below */
               result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
                   'Cancelled',
                   'Your imaginary file is safe :)',
                   'error'
               )
           }
       })
   
   }
</script>
<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
       $('#new_orders_div1').css('display','block');
   } );
    $('#categoryDropdown').change(function () {
       var selected_orderservice = $(this).val();
       $('#test_'+selected_orderservice).DataTable();
       
           $('.page_header_title11').text('All Enquiry Request');
           $('[id^="new_orders_div_"]').css('display', 'none');
           $('#new_orders_div1').css('display','none');
           $('#new_orders_div_'+selected_orderservice).css('display','block');
   
          
           
        
    
   });
</script>
<script>
    $(document).ready(function() {
        $('#acceptedOrder_tb').DataTable();
        $('[id^="manage_login_"]').css('display', 'none');
                $('[id^="new_orders_div_"]').css('display', 'none');
            $('.nav-tabs a').on('click', function() {
               
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                var tabId1 = $(this).attr('id');
                $('#acceptedOrder_tb'+tabId1).DataTable();
                $('[id^="manage_login_"]').css('display', 'none');
                $('[id^="new_orders_div_"]').css('display', 'none');
                $(tabId).css('display','block');
                $(tabId+'_1').css('display','block');
               
            });
        });
    </script>
<script>
   // $('.delete').click(function() {
   function delete_data_item(id)
   {
       var id = id;
       var base_url = '<?php echo base_url()?>';
   
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: 
           {
               confirmButton: 'btn btn-danger',
               cancelButton: 'btn btn-success'
           },
           buttonsStyling: false
       })
   
       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) => 
       {
           if (result.isConfirmed) 
           {
               $.ajax({
                       url     : base_url + "HoteladminController/delete_room_service_menu",
                       method  : "post",
                       data    : {id : id},
                       success : function(data)
                               {
                                   // alert(data);
                                   if(data == 1)
                                   {
                                       swalWithBootstrapButtons.fire(
                                                   'Deleted!',
                                                   'Your file has been deleted.',
                                                   'success'
                                               ).then((result) =>
                                               {
                                                   location.reload();
                                               })
                                   }
                               }
   
                   });
           } 
           else if (
               /* Read more about handling dismissals below */
               result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
                   'Cancelled',
                   'Your imaginary file is safe :)',
                   'error'
               )
           }
       })
   
   }
</script>
<script>
   function orderserviceview() 
   {
           $('.add_div_view').css('display','none');
           $('.add_div_view2').css('display','block');
           $('[id^="new_orders_div_"]').css('display', 'none');
           $('.page_header_title1').text('View Room Information');
         
   };
</script>  
<script>
   // $('.delete').click(function() {
   function delete_data_cat(id)
   {
       var id = id;
       var base_url = '<?php echo base_url()?>';
   
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: 
           {
               confirmButton: 'btn btn-danger',
               cancelButton: 'btn btn-success'
           },
           buttonsStyling: false
       })
   
       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) => 
       {
           if (result.isConfirmed) 
           {
               $.ajax({
                       url     : base_url + "HoteladminController/delete_room_service_cat",
                       method  : "post",
                       data    : {id : id},
                       success : function(data)
                               {
                                   // alert(data);
                                   if(data == 1)
                                   {
                                       swalWithBootstrapButtons.fire(
                                                   'Deleted!',
                                                   'Your file has been deleted.',
                                                   'success'
                                               ).then((result) =>
                                               {
                                                   location.reload();
                                               })
                                   }
                               }
   
                   });
           } 
           else if (
               /* Read more about handling dismissals below */
               result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
                   'Cancelled',
                   'Your imaginary file is safe :)',
                   'error'
               )
           }
       })
   
   }
</script>
