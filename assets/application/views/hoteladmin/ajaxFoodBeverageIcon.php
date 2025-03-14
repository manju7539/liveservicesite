<style>
input[value="Green"]:checked~.colored-div {
    background-color: #7cc142;
    color: white;
}

.alfabetBox {
    display: none;
}

.room_card {
    border-bottom: 1px solid #242426;
    border-radius: 5px;
    box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
    margin: 7px;
    height: 40px;
    width: 54px;
}

.room_no {
    font-weight: 800;
    color: #202020;
    text-align: center;
    padding-top: 14px;
}

.red {
    background-color: #c8c8c8;
}

.radio {
    font-size: inherit;
    margin: 0;
    position: absolute;
    right: 0;
    top: calc(var(--card-padding) + var(--radio-border-width));
    width: 11px;
    height: 11px;
}

.checkbox_css {
    width: 20px;
    height: 20px;
}
  
   .table-editable {
  position: relative;
}
  .glyphicon {
    font-size: 20px;
  }
.table-remove {
  color: #700;
  cursor: pointer;
}  
.table-remove:hover {
    color: #f00;
  }
.table-add {
  color: #000;
  cursor: pointer;
  position: absolute;
}
  .table-add:hover {
    color: #fff;
  }
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>

  <?php if($icon_id == 1){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Facility</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

            <div>
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Facility</button>

                    </div><br><br>
                    <!-- add button -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Facility</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/add_food_facility')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label"> Name</label>
                                                        <input type="text" name="facility_name"  class="form-control" placeholder="Name" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Upload Icon</label>
                                                        <input type="file" name="icon" class="form-control" accept="image/jpeg, image/png," required>
                                                    </div>
                                                    <div class="mb-3 col-md-12">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="summernote" name="description" id="" cols="30" placeholder="Description"
                                                            rows="10" required></textarea>
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
                        <th>Sr.No.</th>
                                                        <th> Facility Name</th>
                                                        <th>Photo</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                    </tr>
                        </thead>
                        <tbody class="">

                        <?php
                                                 
                                                    $i = 1;

                                                    if($list)
                                                    {
                                                        foreach($list as $f_f)
                                                        {
                                                ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $i++?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $f_f['facility_name']?>
                                                                </td>
                                                                <td>
                                                                    <div class="lightgallery">
                                                                        <a href="<?php echo $f_f['icon']?>"
                                                                            data-exthumbimage="<?php echo $f_f['icon']?>"
                                                                            data-src="<?php echo $f_f['icon']?>"
                                                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                            <img class="me-2 "
                                                                                src="<?php echo $f_f['icon']?>" alt=""
                                                                                style="width:100px;">
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php echo $f_f['description']?>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="#"
                                                                            class="btn btn-warning shadow btn-xs sharp me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target=".bd-example1-modal-lg_<?php echo $f_f['food_facility_id']?>"><i
                                                                                class="fa fa-pencil"></i></a>
                                                                        <a href="#"  onclick="delete_data_facility(<?php echo $f_f['food_facility_id'] ?>)"
                                                                            class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                                class="fa fa-trash"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                            <?php
                                        }
                                    }		
                                ?>
                        </tbody>
                    </table>
                </div>
                <?php
               
               if($list)
               {
                   foreach($list as $f_f)
                   {
           ?>
                   <div class="modal fade bd-example1-modal-lg_<?php echo $f_f['food_facility_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                       <div class="modal-dialog modal-md">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title">Edit Facility</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal">
                                   </button>
                               </div>
                               <form action="<?php echo base_url('HoteladminController/edit_food_facility')?>" method="post" enctype="multipart/form-data">
                               <div class="modal-body">
                                   <div class="col-lg-12">
                                       <div class="basic-form">
                                           <input type="hidden" name="food_facility_id" value="<?php echo $f_f['food_facility_id']?>">
                                           <div class="row">
                                               <div class="mb-3 col-md-12">
                                                   <label class="form-label"> Name</label>
                                                   <input type="text" name="facility_name" value="<?php echo $f_f['facility_name']?>" class="form-control" placeholder="">
                                               </div>
                                               <div class="mb-3 col-md-12">
                                                   <label class="form-label">Upload Icon</label>
                                                   <input type="file" class="dropify form-control" name="icon" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $f_f['icon']?>">
                                               </div>
                                               <div class="mb-3 col-md-12">
                                                   <label class="form-label">Description</label>
                                                   <textarea class="summernote" name="description" id="" cols="30"
                                                       rows="10"><?php echo $f_f['description']?></textarea>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                   <button type="submit" class="btn btn-primary">Update Facility</button>
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
        </div>
    </div>
   
                                                                
                              <?php  }else if($icon_id == 2){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List Of Categories</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div>
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Categories</button>
                    </div><br><br>
                    <!-- add button -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Categories</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/add_food_category')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6 form-group">
                                                        <label class="form-label">Select Facilty</label>
                                                        <select name="food_facility_id" id="inputState" class="default-select form-control wide"
                                                             required>
                                                            <option value data-isdefault="true">Choose...</option>
                                                            <?php
                                                                if($facility_list)
                                                                {
                                                                    foreach($facility_list as $fc)
                                                                    {
                                                            ?>
                                                                        <option value="<?php echo $fc['food_facility_id'] ?> "><?php echo $fc['facility_name'] ?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Category Name</label>
                                                        <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add </button>
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
                                                        <th> Facility Name</th>
                                                        <th>Total Category</th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1;

$admin_id = $this->session->userdata('u_id');

if($facility_list)
{
    foreach($facility_list as $fl)
    {
        $total_cat = $this->MainModel->get_food_category($admin_id,$fl['food_facility_id']);
        // print_r($total_cat);
?>
    <tr>
        <td>
            <?php echo $i++ ?>
        </td>
        <td>
            <?php echo $fl['facility_name']?>
        </td>
        <td>
            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                data-bs-toggle="modal"
                data-bs-target=".bd-example1-modal-lg_<?php echo $fl['food_facility_id']?>"><?php echo count($total_cat) ?></a>
        </td>
    </tr>
<?php
    }
}
?>
                        </tbody>
                    </table>
                </div>
                <?php

$i = 1;

$admin_id = $this->session->userdata('u_id');

if($facility_list)
{
    foreach($facility_list as $fl)
    {
        $total_cat = $this->MainModel->get_food_category($admin_id,$fl['food_facility_id']);
        // print_r($total_cat);
?>
    <div class="modal fade bd-example1-modal-lg_<?php echo $fl['food_facility_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Total Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                       <div id="table" class="table-editable">
                        <table class="table table-stripped text-center">
                            <tbody>
                            <?php
                                
                                $j = 1;
                                if($total_cat)
                                {
                                    foreach($total_cat as $t_c)
                                    {
                            ?>
                                        <tr>
                                            <th contenteditable="true"><?php echo $j++ ?></th>
                                            <th contenteditable="true"><?php echo $t_c['category_name']?></th>
                                            <th>
                            <span class="table-remove glyphicon glyphicon-remove"><i class="fa fa-trash"></i></span>
                      </th>
                                          
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                </div>
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
   
                                                                
                              <?php } else if($icon_id == 3){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of Menu Item</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
       <div class="col-md-12">
                                                <div
                                                    class="d-flex justify-content-between align-items-center flex-wrap">
                                                  
                                                        <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div class="input-group" style="margin-left: 4px;">
                                                                <select id="inputState"
                                                                    class="default-select form-control wide">
                                                                    <option>Restaurant</option>
                                                                    <option>Bar</option>
                                                                </select>
                                                                <select id="inputState"
                                                                    class="default-select form-control wide">
                                                                    <option>Indian</option>
                                                                    <option>Continantal</option>
                                                                </select>
                                                                <select id="inputState"
                                                                    class="default-select form-control wide">
                                                                    <option>Todays Special</option>
                                                                    <option>Breakfast Menu</option>
                                                                    <option>Regular Menu</option>
                                                                </select>
                                                                <button class="btn btn-warning  btn-sm "><i class=" fa fa-filter
                                                                        text-white"></i></button>
                                                            </div>
                                                        </div>
                              </div>
                                                       
                              </div>

                                                   
            <div>
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add New Menu</button>
                    </div><br><br>
                    <!-- add button -->
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/add_food_menu')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                            <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Select Facility</label>
                                                                <select id="food_facility_id" name="food_facility_id"
                                                                    class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">---select---</option>
                                                                    <?php
                                                                        if($facility_list)
                                                                        {
                                                                            foreach($facility_list as $fc)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $fc['food_facility_id'] ?> "><?php echo $fc['facility_name'] ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Select Category</label>
                                                                <!-- <select id="food_category_id" name="food_category_id"
                                                                    class="default-select form-control wide"
                                                                    style="display: none;" required>
                                                                    <option value="">---select---</option>
                                                                </select> -->
                                                                <select class="form-control" name="food_category_id" id="food_category_id">
                                                                <option value="">---select---</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label"> Menus For</label>
                                                                <select id="inputState" name="menus_for"
                                                                    class="default-select form-control wide" required>
                                                                    <option value data-isdefault="true">---select---</option>
                                                                    <option value="1">Regular Menu</option>
                                                                    <option value="2">Breakfast Menue</option>
                                                                    <option value="3">Todays Special</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Item Name</label>
                                                                <input type="text" name="items_name" class="form-control" placeholder="Item Name"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Price</label>
                                                                <input type="number" name="price" class="form-control" placeholder="Price"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Item Photo</label>
                                                                <input type="file" name="item_img" class="form-control" accept="image/jpeg, image/png," required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Offers in ( % )</label>
                                                                <input type="number" name="offer_in_per" id="limit"
                                                                    class="form-control" min="1" max="100"
                                                                    placeholder="Offers in ( % )" required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6">
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
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="summernote" name="description" id="" cols="30"
                                                                    rows="10" required></textarea>
                                                            </div>

                                                            <div class="text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary css_btn">Add
                                                                </button>
                                                                <!-- <button type="button" class="btn btn-light css_btn"
                                                                    data-bs-dismiss="modal">Cancel</button> -->
                                                            </div>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
           
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr. No.</strong></th>
                                                            <th><strong>Item Name</strong></th>
                                                            <th><strong> Price</strong></th>
                                                            <th><strong> Photo</strong></th>
                                                            <th><strong>Offers</strong></th>
                                                            <th><strong> Preparation Time</strong></th>
                                                            <th><strong>Description</strong></th>
                                                            <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                                                        $i = 1;
                                                        if($list)
                                                        {
                                                            foreach($list as $f_m)
                                                            {
                                                    ?>
                                                            <tr>
                                                                <td><strong><?php echo $i++?></strong></td>
                                                                <td><?php echo $f_m['items_name'] ?></td>
                                                                <td><?php echo $f_m['price'] ?>Rs</td>
                                                                <td>
                                                                    <div class="lightgallery"
                                                                        class="room-list-bx d-flex align-items-center">
                                                                        <a href="<?php echo $f_m['item_img'] ?>"
                                                                            data-exthumbimage="<?php echo $f_m['item_img'] ?>"
                                                                            data-src="<?php echo $f_m['item_img'] ?>"
                                                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                            <img class="me-3 rounded"
                                                                                src="<?php echo $f_m['item_img'] ?>"
                                                                                alt="" style="width:60px; height:40px;">
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $f_m['offer_in_per'] ?>% off </td>
                                                                <td><?php echo $f_m['prepartion_time'] ?> <?php echo $f_m['time_in'] ?></td>
                                                                <!-- <td>
                                                                    <button
                                                                        class="btn btn-secondary_<?php echo $f_m['food_item_id'] ?> shadow btn-xs sharp me-1"
                                                                        data-bs-original-title="" title=""><i
                                                                            class="fas fa-eye"></i></button>
                                                                </td> -->
                                                                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $f_m['food_item_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                                                <td>
                                                                    <a href="#"
                                                                        class="btn btn-warning shadow btn-xs sharp me-1"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target=".bd-example-modal-lg_<?php echo $f_m['food_item_id'] ?>"><i
                                                                            class="fa fa-pencil"></i></a>
                                                                    <a href="#" onclick="delete_data_menu(<?php echo $f_m['food_item_id'] ?>)"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></a>

                                                                </td>
                                                            </tr>
<div class="modal fade bd-terms-modal-sm_<?php echo $f_m['food_item_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $f_m['description'] ?></span>
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
                <?php

if($list)
{
    foreach($list as $f_m)
    {
?>
        <div class="modal fade bd-example-modal-lg_<?php echo $f_m['food_item_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg slideInRight animated">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Menu Items</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('HoteladminController/edit_food_menus')?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="food_item_id" value="<?php echo $f_m['food_item_id'] ?>">
                        <div class="col-lg-12"> 
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Facility</label>
                                    <select id="food_facility_id1_<?php echo $f_m['food_item_id']?>" name="food_facility_id" class="default-select form-control wide" required>
                                        <option value data-isdefault="true">---select---</option>
                                        <?php
                                            if($facility_list)
                                            {
                                                foreach($facility_list as $fc)
                                                {
                                        ?>
                                                    <option <?php if($fc['food_facility_id'] == $f_m['food_facility_id']){echo "Selected";}?> value="<?php echo $fc['food_facility_id'] ?> "><?php echo $fc['facility_name'] ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Select Category</label>
                                    <select id="food_category_id1_<?php echo $f_m['food_item_id']?>" name="food_category_id" class="form-control">
                                        <option >---select---</option>
                                        <?php
                                        $admin_id = $this->session->userdata('u_id');
                                            $food_cat_list = $this->MainModel->get_food_category($admin_id,$f_m['food_facility_id']);

                                            if($food_cat_list)
                                            {
                                                foreach($food_cat_list as $fcc)
                                                {
                                                ?>
                                                    <option <?php if($fcc['food_category_id'] == $f_m['food_category_id']){echo "Selected";}?> value="<?php echo $fcc['food_category_id'] ?> "><?php echo $fcc['category_name'] ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label"> Menus For</label>
                                    <select id="inputState" name="menus_for" class="default-select form-control wide">
                                        <option selected="" disabled="">---select---</option>
                                        <option <?php if($f_m['menus_for'] == 1){echo "Selected";}?> value="1">Regular Menu</option>
                                        <option <?php if($f_m['menus_for'] == 2){echo "Selected";}?> value="2">Breakfast Menue</option>
                                        <option <?php if($f_m['menus_for'] == 3){echo "Selected";}?> value="3">Todays Special</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Item Name</label>
                                    <input type="text" class="form-control" placeholder="" name="items_name" value="<?php echo $f_m['items_name'] ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" value="<?php echo $f_m['price'] ?>">
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Offers in ( % )</label>
                                    <input type="number" id="limit" class="form-control"
                                        min="1" max="100" name="offer_in_per" value="<?php echo $f_m['offer_in_per'] ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Preparation time</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="prepartion_time" value="<?php echo $f_m['prepartion_time'] ?>">
                                        <select id="inputState" name="time_in" class="default-select form-control wide">

                                            <option selected="" disabled="">---select---</option>
                                            <option <?php if($f_m['time_in'] == 1){echo "Selected";}?> value="1">Minute</option>
                                            <option <?php if($f_m['time_in'] == 2){echo "Selected";}?> value="2">Hour</option>
                                        </select>
                                    </div>

                                </div>
                               <div class="mb-3 col-md-6">
                                    <label class="form-label">Item Photo</label>
                                    <input type="file" class=" form-control" name="item_img" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $f_m['item_img']?>">
                                    <br>
                                    <output id="Filelist"></output>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea class="summernote" name="description" id="" cols="30"
                                        rows="10"><?php echo $f_m['description'] ?></textarea>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Menu Item</button>
                            </div>
                        </div>
                        </form>
                    </div>
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
   
                                                                
                              <?php  }else if($icon_id == 4){  ?>
    <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header><span class="page_header_title11">All New Orders</span></header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body">
                
            <div class="row">
            <div class="col-md-4">
                                                            <div class="input-group" style="margin-left:3px;">
                                                                <input type="text" class="form-control wide"
                                                                    placeholder="Date" onfocus="(this.type = 'date')"
                                                                    id="date">
                                                                <select id="inputState"
                                                                    class="default-select form-control wide">
                                                                    <option selected=""> Floor</option>
                                                                    <option>1 Floor</option>
                                                                    <option>2 Floor</option>
                                                                   
                                                                </select>

                                                                <button class="btn btn-warning  btn-sm "><i
                                                                        class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Orders</option>
                                        <option value="accepted_order">Accepted Orders</option>
                                        <option value="rejected_order">Rejected Orders</option>
                                     
                                    </select>                         
                                </div>
                              </div>
                                <div class="new_orders_div">
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <th><strong>Req.Date/Time</strong></th>
                                                        <th><strong>Reserve Date</strong></th>
                                                       <th><strong>Guest Name</strong></th>
                                                        <th><strong>Mobile No</strong></th>
                                                        <th><strong>No.of People</strong></th>
                                                        <th><strong>Action</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                            $i = 1;
                            if($list)
                            {
                                foreach($list as $rev_pen)
                                {
                            ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td><span> <?php echo $rev_pen['request_date'] ?>/<sub><?php echo date('h:i a',strtotime($rev_pen['request_time'])) ?></sub></span></td>
                                <td><?php echo $rev_pen['reserve_date'] ?></td>
                                <td><?php echo $rev_pen['full_name'] ?></td>
                                <td><?php echo $rev_pen['mobile_no'] ?></td>
                                <td><?php echo $rev_pen['no_of_people'] ?></td>
                                <td>
                                    <a onclick="return confirm('Do you want to accept this order?')" href="<?php echo base_url('HoteladminController/accept_reserve_order/'.$rev_pen['reserve_table_id'])?>" class="submit">
                                    <span class="badge badge-success"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-sm"><i
                                                class="fa fa-check"></i></span>
                                    </a>&nbsp;&nbsp;
                                    <a onclick="return confirm('Do you want to reject this order?')" href="<?php echo base_url('HoteladminController/reject_reserve_order/'.$rev_pen['reserve_table_id'])?>" class="reject">
                                    <span
                                            class="badge badge-danger"><i
                                                class="fa fa-close"></i></span>
                                    </a>
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

                        <div class="accepted_orders_div" style="display: none;">
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <th><strong>Req.Date/Time</strong></th>
                                                        <th><strong>Reserve Date</strong></th>
                                                        <th><strong>Guest Name</strong></th>
                                                        <th><strong>Mobile No</strong></th>
                                                        <th><strong>No.of People</strong></th>
                                                        <th><strong>Accepted Date</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                            $i = 1;
                            if($list_accepted)
                            {
                                foreach($list_accepted as $rev_acc)
                                {
                            ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td><span> <?php echo $rev_acc['request_date'] ?>/<sub><?php echo date('h:i a',strtotime($rev_acc['request_time'])) ?></sub></span></td>
                                    <td><?php echo $rev_acc['reserve_date'] ?></td>
                                    <td><?php echo $rev_acc['full_name'] ?></td>
                                    <td><?php echo $rev_acc['mobile_no'] ?></td>
                                    <td><?php echo $rev_acc['no_of_people'] ?></td>
                                    <td><?php echo $rev_acc['accept_date'] ?></td>
                                    <td>
                                        <div class="badge badge-success"> Accepted</div>
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
                        
                        <div class="rejected_orders_div" style="display: none;">
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
                        <thead>
                        <tr>
                        <th><strong>Sr.no.</strong></th>
                                                        <th><strong>Req.Date/Time</strong></th>
                                                        <!-- <th><strong>Floor</strong></th>
                                                        <th><strong>Room No.</strong></th> -->
                                                        <th><strong>Reserve Date</strong></th>
                                                        <th><strong>Guest Name</strong></th>
                                                        <th><strong>Mobile No</strong></th>
                                                        <!-- <th><strong>Hotel Name</strong></th> -->
                                                        <th><strong>No.of People</strong></th>
                                                        <th><strong>Rejected Date</strong></th>
                                                        <th><strong>Order Status</strong></th>
                    </tr>
                        </thead>
                        <tbody class="">
                        <?php

                        $i = 1;
                        if($list_rejected)
                        {
                            foreach($list_rejected as $rev_rj)
                            {
                        ?>
                        <tr>
                            <td><?php echo $i++?></td>
                            <td><span> <?php echo $rev_rj['request_date'] ?>/<sub><?php echo date('h:i a',strtotime($rev_rj['request_time'])) ?></sub></span></td>
                            <td><?php echo $rev_rj['reserve_date'] ?></td>
                            <td><?php echo $rev_rj['full_name'] ?></td>
                            <td><?php echo $rev_rj['mobile_no'] ?></td>
                            <td><?php echo $rev_rj['no_of_people'] ?></td>
                            <td><?php echo $rev_rj['accept_date'] ?></td>
                            <td>
                                <div class="badge badge-danger"> rejected</div>
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
   
                                                                
                              <?php  }?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        // $('.delete').click(function() {
        function delete_data_facility(id)
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
                            url     : base_url + "HoteladminController/delete_food_facility",
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
    $('.accordion-toggle').click(function() {
        $('.hiddenRow').hide();
        $(this).next('tr').find('.hiddenRow').show();
    });
    </script>
    <script>
    var $TABLE = $("#table");
    $(".table-add").on("click", function() {
        var $clone = $TABLE.find("tr.hide").clone(true).removeClass('hide');
        $TABLE.find('table').append($clone);
    });

    $(".table-remove").on("click", function() {
        $(this).parents("tr").detach();
    });
    </script>
    <script>
        // $('.delete').click(function() {
        function delete_data_menu(id)
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
                            url     : base_url + "HoteladminController/delete_food_menus",
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
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();
    } );
    var selectedOrderserviceurl = '';
    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders')
        {
            $('.page_header_title11').text('All New Orders');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'accepted_order')
        {
            $('.page_header_title11').text('All Accepted Orders');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.rejected_orders_div').css('display','none');
           
        }
        if(selected_orderservice == 'rejected_order')
        {
           $('.page_header_title11').text('All Rejected Orders');
            $('.rejected_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.accepted_orders_div').css('display','none');
            
        }
     
        
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
    <script>
            $(document).ready(function()
            {
                debugger;
                $('#food_facility_id').change(function()
                {
                    var base_url = '<?php echo base_url()?>';
                    var food_facility_id = $('#food_facility_id').val();

                    if(food_facility_id != '')
                    {
                        $.ajax({
                                url : base_url + "HoteladminController/changeFoodCat",
                                method : "POST",
                                data : {food_facility_id : food_facility_id},
                                success : function(data)
                                        {
                                            // alert(data);
                                            $('#food_category_id').html(data);
                                        }
                                });
                    }
                });
            });
        </script>
