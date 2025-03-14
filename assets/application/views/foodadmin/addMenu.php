<div class="page-content-wrapper">
   <div class="page-content">
      <div class="row">
         <div class="col-md-12 col-sm-12">
            <div class="card card-box">
               <div class="card-head">
                  <header>Add Menu Item</header>
               </div>
               <div class="card-body " id="bar-parent">
                  <form action="<?php echo base_url('HomeController/add_menus')?>" method="post" enctype="multipart/form-data">
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
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>