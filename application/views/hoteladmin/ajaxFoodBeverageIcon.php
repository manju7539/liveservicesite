<div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Data Added Successfully..!</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success successmessage_new" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">This Facility already exists..</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
<div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;">Status Updated Succesfully..</strong>
   <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
</div>
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
   #example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
   {
   padding:0px;
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
   .food_bevrage_table .container-fluid{
      padding:0px
   }
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>
<?php if($icon_id == 1){  ?>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header>Facility</header>
         </div>
         <div class="card-body ">
            <div>
               <button style="float:right;" type="button" class="btn btn-primary css_btn"
                  data-bs-toggle="modal" data-bs-target=".add_facility_model">Add Facility</button>
            </div>
            <br><br>
            <!-- add button -->
            <div class="modal fade add_facility_model" tabindex="-1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add Facility</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <form id="food_facility_add_form" method="post" enctype="multipart/form-data">
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
                                       <textarea class="summernote" name="description" id="description1" cols="30" placeholder="Description"
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
            <div class="table-scrollable-food1 table-scrollable food_bevrage_table">
               <table id="foodFacilityTable1" class="display full-width">
                  <thead>
                     <tr>
                        <th>Sr.No.</th>
                        <th> Facility Name</th>
                        <th>Photo</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody class="food_facility_list_new">
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
                              <a href="<?php echo $f_f['icon']?>" target="_blank"
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
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $f_f['food_facility_id']?>" data-bs-target=".update_food_facility_modal"><i class="fa fa-pencil"></i></a> 
                            
                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $f_f['food_facility_id']?>" ><i class="fa fa-trash"></i></a> 
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
         </div>
      </div>
   </div>

   <script>$(document).ready(function (id) {
      $(document).on('click','#edit_data',function(){
         var id = $(this).attr('data-id');
         // alert(id);
         $.ajax({
            url: '<?= base_url('HoteladminController/getEditDataoffoodfacility') ?>',
            type: "post",
            data: {id:id},
            dataType:"json",
            success: function (data) {
                  
                  console.log(data);
                  $('#food_facility_id').val(data.food_facility_id);
                  $('#facility_name').val(data.facility_name);
                  $("#img").attr('src',data.icon);
                  $('#description').summernote('code', data.description);
            }
      
            
            }); 
      })
      });
      
      $(document).unbind('submit').on('submit', '#food_facility_add_form', function(e){
         e.preventDefault(); 
         $(".loader_block").show();
         var form_data = new FormData(this);
         console.log(form_data);
         $.ajax({
            url         : '<?= base_url('HoteladminController/add_food_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
      
               if(res == 1)
               {
                  setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".add_facility_model").modal('hide');
                  $(".successmessage_new").show();
                  }, 2000);
                  setTimeout(function(){  
                     $(".successmessage_new").hide();
                  }, 4000);
               }
            else
            {
               setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".add_facility_model").modal('hide');
                  $(".add_facility_model").on("hidden.bs.modal", function() {
                        $("#food_facility_add_form")[0].reset(); // reset the form fields
                        $('#description1').summernote('reset');
                     });
                  $(".successmessage").show();
                  }, 2000);
                  setTimeout(function(){  
                     $(".successmessage").hide();
                  }, 4000);
      
                  $.get( '<?= base_url('HoteladminController/ajaxFoodVeverageView_n1');?>', function( data ) {
                     var resu = $(data).find('.table-scrollable-food1').html();
                     $('.table-scrollable-food1').html(resu);
      
                     setTimeout(function(){
                           $('#foodFacilityTable1').DataTable();
                     }, 2000);
                  });  
            }
      
            }
         });
      });
      
      $(document).bind('submit').on('submit', '#food_facility_form', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
      url         : '<?= base_url('HoteladminController/edit_food_facility') ?>',
      method      : 'POST',
      data        : form_data,
      processData : false,
      contentType : false,
      cache       : false,
      success     : function(res) {
         $.get( '<?= base_url('HoteladminController/ajaxFoodVeverageView_n1');?>', function( data ) {
                     var resu = $(data).find('.table-scrollable-food1').html();
                     $('.table-scrollable-food1').html(resu);
      
                     setTimeout(function(){
                           $('#foodFacilityTable1').DataTable();
                     }, 2000);
                  });  
         setTimeout(function(){  
         $(".loader_block").hide();
         $(".update_food_facility_modal").modal('hide');
         $(".food_facility_list").html(res);
         $(".updatemessage").show();
         }, 2000);
         setTimeout(function(){  
            $(".updatemessage").hide();
         }, 4000);
      
      }
      });
      });
   </script>
<?php  }else if($icon_id == 2){  ?>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header>List Of Categories</header>
         </div>
         <div class="card-body ">
            <div>
               <button style="float:right;" type="button" class="btn btn-primary css_btn"
                  data-bs-toggle="modal" data-bs-target=".add_food_categories">Add Categories</button>
            </div>
            <br><br>
            <!-- add button -->
            <div class="modal fade add_food_categories" tabindex="-1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add Categories</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <form id="add_food_category_form" method="post" enctype="multipart/form-data">
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
            <div class="food_category">
               <div class="table-scrollable-new table-scrollable food_bevrage_table">
                  <table id="foodCategoriesTable" class="display full-width">
                     <thead>
                        <tr>
                           <th>Sr.No.</th>
                           <th> Facility Name</th>
                           <th>Total Category</th>
                        </tr>
                     </thead>
                     <tbody class="append_data">
                        <?php
                           $i = 1;
                           
                           $admin_id = $this->session->userdata('u_id');
                           
                           if($facility_list)
                           {
                           
                              foreach($facility_list as $fl)
                              {
                           
                                 $where = '(food_facility_id ="'.$fl['food_facility_id'].'")';
                                 $get = $this->MainModel->getCount_total_users('food_category',$where);
                           ?>
                        <tr>
                           <td>
                              <?php echo $i++ ?>
                           </td>
                           <td>
                              <?php echo $fl['facility_name']?>
                           </td>
                           <td>
                           
                           <a href="#"><button type="button" class="btn shadow btn-xs btn-warning category_count_btn" data-id="<?php echo $fl['food_facility_id']?>"><?php echo $get[0]['total_count']?></button></a>
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

            
            <div class="modal fade" id="category_count_modal" tabindex="-1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-lg slideInRight animated">
                  <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title"><b>Total Categories</b></h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                           </button>
                        </div>
                        <form id="category_count_form_id" method="post" enctype="multipart/form-data">
                           <div class="modal-body">
                              <input type="hidden" name="category_count" id="category_count" value="">
                              <div class="col-lg-12">
                                    <div id="table" class="table-editable append_table">
                                    </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <div class="text-center">
                                    <button type="submit" class="btn btn-primary cet_delete_update">Update</button>
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Cancel</button>
                              </div>
                           </div>
                        </form>
                  </div>
               </div>
            </div>
      </div>
   </div>


   <!-- end add btn modal -->
   <div class="loader_block" style="display: none;">
      <div class="row" style="position: absolute;left: 50%;top: 40%;">
         <div class="col-sm-6 text-center">
            <!-- <p>loader 3</p> -->
            <div class="loader3">
               <span></span>
               <span></span>
            </div>
         </div>
      </div>
   </div>
   <script>
      $(document).on("click",".category_count_btn", function (e) {
         e.preventDefault();
         $('.append_table').html('');
         var id = $(this).attr('data-id');
         $('#category_count').val(id);
         $("#category_count_modal").modal('show');
         $.ajax({
               method: "POST",
               url: '<?= base_url('HoteladminController/food_category_data_modal') ?>',
               data: {id : id},
               success: function (response) {
               console.log(response);
               $('.append_table').append(response);
               }
         });
      });
      $(document).on("click",".category_count_btn",function(){
            $("#category_count_modal").modal('show');
      });
      
         $('#category_count_form_id').submit( function(e){

      //  $(document).on('submit', '#category_count_form_id', function(e){
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
               url         : '<?= base_url('HoteladminController/get_food_cat_count') ?>',
               method      : 'POST',
               data        : form_data,
               processData : false,
               contentType : false,
               cache       : false,
               success     : function(res) {
                  $.get( '<?= base_url('HoteladminController/ajaxfoodcategoryforpagination');?>', function( data ) {
                     var resu = $(data).find('.table-scrollable-new').html();
                     var modals = $(data).find('.category-modals').html();
                     $('.table-scrollable-new').html(resu);
                     $('.category-modals').html(modals);
                     setTimeout(function(){
                           $('#foodCategoriesTable').DataTable();
                     }, 2000);
                  });
                  setTimeout(function(){  
                     $(".loader_block").hide();
                     $("#category_count_modal").modal('hide');
                     $("#category_count_modal").on("hidden.bs.modal", function () {
                     $("#category_count_form_id")[0].reset(); // reset the form fields
                  });
                     $(".append_table").html(res);
                     $(".updatemessage").show();
                     }, 2000);
                  setTimeout(function(){  
                     $(".updatemessage").hide();
                     }, 4000);
               }
         });
      });
      //  delete category

      $(document).on("click", ".category_delete", function(event) {         
         var cat_id=  event.currentTarget.id;
         var base_url='<?php echo base_url()?>';
         console.log(cat_id);
      //         return false;
         $.ajax({
            url     : base_url +"HoteladminController/delete_facility_category",
            method  : "post",
            data    : {cat_id : cat_id},
            success : function(res) {
               $.get( '<?= base_url('HoteladminController/ajaxfoodcategoryforpagination');?>', function( data ) {
                     var resu = $(data).find('.food_category').html();
                     $('.food_category').html(resu);
                     setTimeout(function(){
                        $('#foodCategoriesTable').DataTable();
                     }, 2000);
                  });
            if(res==1){
               $("#close_"+cat_id).css("display","none");
               // console.log(cat_id);
               // return false;
               $('#delete_ids').val(cat_id);
            }
            else{
               alert("Category not deleted...!");
            }
            }
         });
      });
      
      $(document).unbind('submit').on('submit', '#add_food_category_form', function(e){
         e.preventDefault(); 
         $(".loader_block").show();
         var form_data = new FormData(this);
         console.log(form_data);
         $.ajax({
            url         : '<?= base_url('HoteladminController/add_food_category') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
            
                  $.get( '<?= base_url('HoteladminController/ajaxfoodcategoryforpagination');?>', function( data ) {
                     var resu = $(data).find('.food_category').html();
                     $('.food_category').html(resu);
                     setTimeout(function(){
                        $('#foodCategoriesTable').DataTable();
                     }, 2000);
                  });
      
               setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".add_food_categories").modal('hide');
                  $(".add_food_categories").on("hidden.bs.modal", function () {
      $("#add_food_category_form").trigger("reset"); // reset the form fields
      });
                  $(".food_categories_list").html(res);
                  $(".successmessage").show();
                  }, 2000);
                  setTimeout(function(){  
                     $(".successmessage").hide();
                  }, 4000);
            }
         });
      });
   </script>
<?php } else if($icon_id == 3){  ?>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header>List of Menu Item</header>
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
                  data-bs-toggle="modal" data-bs-target=".add_menu_model">Add New Menu</button>
            </div>
            <br><br>
            <!-- add button -->
            <div class="modal fade add_menu_model" tabindex="-1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add New Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <form id="add_menu_form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="col-lg-12">
                              <div class="basic-form">
                                 <div class="row">
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Select Facility</label>
                                       <!-- <select id="food_facility_id1" name="food_facility_id"
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
                                       </select> -->
                                       <select class="form-control" id="facilities" name="facilities" onchange="getCatList(this)" required>
                              <option value="" selected disabled>---select---</option>
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
                                       <!-- <select class="form-control" name="food_category_id" id="food_category_id">
                                          <option value="">---select---</option>
                                       </select> -->
                                       <select class="form-control" id="categories" name="categories" required="">
                                       <option value="" selected="" disabled="">-- Select --</option>
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
            <div class="food_menu_div">
            <div class="table-scrollable">
               <table id="foodmenu" class="display full-width">
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
                  <tbody class="foodmenudata">
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
                              <a href="<?php echo $f_m['item_img'] ?>" target="_blank"
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
                        <?php 
                           if($f_m['time_in']=="1")
                           {
                              $data = "Minute";
                           }
                           else{
                              $data = "Hour";
                           }
                           ?>
                        <td><?php echo $f_m['prepartion_time'] ?> <?php echo $data ?></td>
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

                           <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_menu_data" data-id="<?= $f_m['food_item_id']?>" data-bs-target=".update_menu_model"><i class="fa fa-pencil"></i></a> 
                           <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_menu" delete-id-menu="<?= $f_m['food_item_id']?>" ><i class="fa fa-trash"></i></a> 
                          
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
            </div>
         
            <!-- update model start -->

            <div class="modal fade update_menu_model" tabindex="-1" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-lg slideInRight animated">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Edit Menu Items</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="col-lg-12">
                           <div class="basic-form">
                              <form id="editMenuForm" method="POST" enctype="multipart/form-data">
                                 <div class="row">
                                    <input type="hidden" name="food_item_id" id="food_item_id">
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Select Facility</label>
                                       <select  class="default-select form-control wide" name="facility1" id="facility1" >
                                          <?php
                                             $admin_id = $this->session->userdata('u_id');
                                             $wh_facility = '(hotel_id = "'.$admin_id.'")';
                                             $facility= $this->MainModel->getAllData1($tbl='food_facility',$wh_facility);
                                             //print_r($category);die;
                                             foreach($facility as $fac)
                                             {
                                                      $fac_name = $fac['facility_name'];
                                             ?>
                                          <option <?php if($fac['food_facility_id'] == $f_m['food_facility_id']) { echo "Selected";}?> value="<?php echo $fac['food_facility_id']?>"><?php echo $fac_name?></option>
                                          <?php 
                                             }
                                             ?>                    
                                       </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Select Category</label>
                                       <select class="form-control" name="food_category1" id="food_category1">
                                          <option value data-isdefault="true" readonly>---select---</option>
                                          <?php
                                             $category= $this->MainModel->getAllTableData($tbl='food_category');
                                             foreach($category as $cat1)
                                             {
                                                      $cat_name = $cat1['category_name'];
                                          ?>
                                          <option <?php if($cat1['food_category_id'] == $l['food_category_id']) { echo "Selected";}?> value="<?php echo $cat1['food_category_id']?>"><?php echo $cat_name?>
                                          </option>
                                          <?php 
                                             }
                                          ?> 
                                       </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label"> Menus For</label> 
                                       <select  class="default-select form-control wide" name="menu_for" id="menu_for">
                                          <option <?php if($f_m['menus_for']=="1") {echo "Selected";}?> value="1" selected>Regular Menu</option>
                                          <option <?php if($f_m['menus_for']=="2") {echo "Selected";}?> value="2">Breakfast Menu</option>
                                          <option <?php if($f_m['menus_for']=="3") {echo "Selected";}?> value="3">Todays Special</option>
                                       </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Item Name</label>
                                       <input type="text" name="items_name" id="items_name" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Price</label>
                                       <input type="text" name="price" id="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Item Photo</label>
                                       <div class="input-group transparent-append" style="border: 1px solid #ced4da;padding: 5px 5px; border-radius:3px; display:flex;align-items:center;">
                                       
                                          <input type="file" name="item_img" value="<?php echo $f_m['item_img']?>" class="form-control me-1" placeholder="">
                                       <img src="" id="img" alt="Not Found" height="50" width="50">
                                       </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Offers in ( % )</label>
                                       <input type="text" id="offer_in_per" name="offer_in_per" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="limit" class="form-control" min="1"
                                          max="100">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                       <label class="form-label">Preperation time</label>
                                       <div class="input-group">
                                          <input type="text" name="prepartion_time" id="prepartion_time" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control">
                                          <select  class="default-select form-control wide" name="time_in" id="time_in" >
                                             <option <?php if($f_m['time_in']=="1") {echo "Selected";}?> value="1" selected>Minute</option>
                                             <option <?php if($f_m['time_in']=="2") {echo "Selected";}?> value="2">Hour</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                       <label class="form-label">Description</label>
                                       <textarea class="summernote" name="description" id="descriptionfood"></textarea>
                                    </div>
                                    <div class="text-center">
                                       <button type="submit" class="btn btn-primary  css_btn">Save Changes</button>
                                       <button type="button" data-bs-dismiss="modal" class="btn btn-light  css_btn">Close</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- update model end -->
         </div>
      </div>
   </div>
   </div>

   <script>
      $(document).unbind('submit').on('submit', '#add_menu_form', function(e){
         e.preventDefault(); 
         $(".loader_block").show();
         var form_data = new FormData(this);
         console.log(form_data);
         $.ajax({
            url         : '<?= base_url('HoteladminController/add_food_menu') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {
               $.get( '<?= base_url('HoteladminController/ajaxFoodVeveragefoodpagination');?>', function( data ) {
                     var resu = $(data).find('.food_menu_div').html();
                     $('.food_menu_div').html(resu);
      
                     setTimeout(function(){
                           $('#foodmenu').DataTable();
                     }, 2000);
                  });  
            
               setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".add_menu_model").modal('hide');
                  $(".foodmenudata").html(res);
                  $(".successmessage").show();
                  }, 2000);
                  setTimeout(function(){  
                     $(".successmessage").hide();
                  }, 4000);
            }
         });
      });
      // edit data fetch
      $(document).on('click','#edit_menu_data',function(){
         var id = $(this).attr('data-id');
         // alert(id);
         $.ajax({
               url: '<?= base_url('HoteladminController/getmenufetchdata') ?>',
               //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
               type: "post",
               data: {id:id},
               dataType:"json",
               success: function (data) {
                  console.log(data);
                  $('#food_item_id').val(data.food_item_id);
                  $('#facility1 option[value="' + data.food_facility_id + '"]').prop('selected', true);
                  // $('#category option[value="' + data.food_category_id + '"]').prop('selected', true);
                  $('#menu_for option[value="' + data.menus_for + '"]').prop('selected', true);
                  $('#items_name').val(data.items_name);
                  $('#price').val(data.price);
                  $("#img").attr('src',data.item_img);
                  $('#offer_in_per').val(data.offer_in_per);
                  $('#prepartion_time').val(data.prepartion_time);
                  $('#time_in').val(data.time_in);
                  $('#descriptionfood').summernote('code', data.description);

                  $('#food_category1').empty();
                  $('#food_category1').append('<option value="" data-isdefault="true" readonly>---select---</option>');
                  for (var i = 0; i < data.category.length; i++) 
                  {
                     var category = data.category[i];

                     $('#food_category1').append('<option value="' + category.food_category_id + '">' + category.category_name + '</option>');

                     if (category.food_category_id == data.food_category_id)
                     {
                           $('#food_category1 option[value="' + category.food_category_id + '"]').prop('selected', true);
                     }
                  }
               }
            }); 
      })

      // APPEND facility wise category data
      $(document).ready(function()
      {
         var base_url = '<?php echo base_url();?>';
      
            $('#facility1').change(function() 
            {
               var food_facility_id = $('#facility1').val();
               // alert(food_facility_id);
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
                           $('#food_category1').html(data);
                        }
                     });
               }
               else
               {
                  $('#food_category1').html('<option value="">Choose sub category</option>');
               }
            });
      });

      // update ajax code
      $(document).bind('submit').on('submit', '#editMenuForm', function(e){
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
            url         : '<?= base_url('HoteladminController/edit_food_menus') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
               $.get( '<?= base_url('HoteladminController/ajaxFoodVeveragefoodpagination');?>', function( data ) {
                     var resu = $(data).find('.food_menu_div').html();
                     $('.food_menu_div').html(resu);

                     setTimeout(function(){
                        $('#foodmenu').DataTable();
                     }, 2000);
                  });  
                  setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".update_menu_model").modal('hide');
                  //  $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                  
                  setTimeout(function(){  
                     $(".updatemessage").hide();
                  }, 4000);
               
            }
         });
      });

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
   </script>
<?php  }else if($icon_id == 4){  ?>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header><span class="page_header_title11">All New Orders</span></header>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 col-sm-12">
                  <div class="panel tab-border card-box">
                     <header class="panel-heading panel-heading-gray custom-tab">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="<?= (empty($type) || $type == 'new') ? 'active' : ''; ?>">New Orders</a>
                           </li>
                           <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Orders</a>
                           </li>
                           <li class="nav-item"><a href="#rejected_orders_div" data-bs-toggle="tab">Rejected Orders</a>
                           </li>
                        </ul>
                     </header>
                  </div>
                  <div class="col-md-4">
                     <form method="POST" id="reserve_table_filter">
                        <div class="input-group" style="margin-left:3px;">
                           <input type="text" class="form-control wide"
                              placeholder="Date" onfocus="(this.type = 'date')"
                              id="date">
                           <select id="inputState"
                              class="default-select form-control wide">
                              <option selected disabled>Select Floor</option>
                              <?php
                                 $admin_id = $this->session->userdata('u_id');
                                 $wh_f = 'hotel_id = "' . $admin_id . '"';
                                 $all_floor = $this->HotelAdminModel->getAllData('floors', $wh_f);
                                 foreach ($all_floor as $a_f) 
                                          {
                                                         ?>
                              <option value="<?php echo $a_f["floor_id"];?>"><?php echo $a_f["floor"];?></option>
                              <?php
                                 }
                                       ?>
                           </select>
                           <button class="btn btn-warning  btn-sm ">
                              <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="tab-content">
               <div class="tab-pane<?= (empty($type) || $type == 'new') ? ' active' : ''; ?>" style="background-color:white;" id="new_orders_div">
                  <div class="table-scrollable food_bevrage_table">
                     <table id="reserve_tables_tbl_id" class="display full-width">
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
                        <!-- <tbody class="">
                           <?php
                              $i = 1;
                              if($list)
                              {
                                 foreach($list as $rev_pen)
                                 {
                           ?>
                           <tr>
                              <td><?php echo $i++?></td>
                              <td>
                                 <span> <?php echo $rev_pen['request_date'] ?>/<sub><?php echo date('h:i a',strtotime($rev_pen['request_time'])) ?></sub></span>
                              </td>
                              <td><?php echo $rev_pen['reserve_date'] ?></td>
                              <td><?php echo $rev_pen['full_name'] ?></td>
                              <td><?php echo $rev_pen['mobile_no'] ?></td>
                              <td><?php echo $rev_pen['no_of_people'] ?></td>
                              <td>
                                 <div>
                                    <a href="javascript:void(0)" data-id="352" class="btn btn-success btn-tbl-edit btn-xs resendNoti">
                                    <i class="fa fa-check"></i>
                                    </a>

                                    <a href="#" class="btn btn-danger shadow btn-xs sharp me-1" id="delete_data" delete-id="352"><i class="fa fa-close"></i></a>

                                 </div>
                                 <a onclick="return confirm('Do you want to accept this order?')" href="<?php echo base_url('HoteladminController/accept_reserve_order/'.$rev_pen['reserve_table_id'])?>" class="submit">
                                    <span class="badge badge-success" data-bs-toggle="modal" data-bs-target = ".bd-example-modal-sm"><i class="fa fa-check"></i></span>
                                 </a>&nbsp;&nbsp;
                                 <a onclick="return confirm('Do you want to reject this order?')" href="<?php echo base_url('HoteladminController/reject_reserve_order/'.$rev_pen['reserve_table_id'])?>" class="reject">
                                    <span  class="badge badge-danger"><i class="fa fa-close"></i></span>
                                 </a>
                              </td>
                           </tr>
                           <?php
                                 }
                              }
                           ?>
                        </tbody> -->
                     </table>
                  </div>
               </div>
               <div class="tab-pane" id="accepted_orders_div"  style="background-color:white;">
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
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" id="rejected_orders_div"  style="background-color:white;">
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
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script>
      $(document).ready(function () {
         // var table_visiters = $('#visiters_tb').DataTable();
         reserve_tables_new_ord = $('#reserve_tables_tbl_id').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                  'url': '<?=base_url()?>'+'HoteladminController/get_reserve_table_new_data',
                  },
            'columns': [
                  { data: 'sr_no' },
                  { data: 'Req_Date_Time' },
                  { data: 'Reserve_Date' },
                  { data: 'Guest_Name' },
                  { data: 'Mobile_No' },
                  { data: 'No_of_people' },
                  { data: 'Action' }
            ],
            'columnDefs': [
                     {
                  "targets": [0,1,2,3,4,5,6], // your case first column
                  "className": "text-center",
               },
            ]
         });

         reserve_tables_accepted_ord = $('#acceptedOrder_tb').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                  'url': '<?=base_url()?>'+'HoteladminController/get_reserve_table_accepted_data',
                  },
            'columns': [
                  { data: 'sr_no' },
                  { data: 'Req_Date_Time' },
                  { data: 'Reserve_Date' },
                  { data: 'Guest_Name' },
                  { data: 'Mobile_No' },
                  { data: 'No_of_people' },
                  { data: 'Accepted_Date' },
                  { data: 'Order_Status' }
            ],
            'columnDefs': [
                     {
                  "targets": [0,1,2,3,4,5,6,7], // your case first column
                  "className": "text-center",
               },
            ]
         });
         
         reserve_tables_rejected_ord = $('#rejectedOrder_tb').DataTable({
            "order": [],
            'processing': true,
            'serverSide': true,
            "bDestroy": true,
            'serverMethod': 'post',
            'ajax': {
                  'url': '<?=base_url()?>'+'HoteladminController/get_reserve_table_rejected_data',
                  },
            'columns': [
                  { data: 'sr_no' },
                  { data: 'Req_Date_Time' },
                  { data: 'Reserve_Date' },
                  { data: 'Guest_Name' },
                  { data: 'Mobile_No' },
                  { data: 'No_of_people' },
                  { data: 'Rejected_Date' },
                  { data: 'Order_Status' }
            ],
            'columnDefs': [
                     {
                  "targets": [0,1,2,3,4,5,6,7], // your case first column
                  "className": "text-center",
               },
            ]
         });

         //Acept order
         $(document).on('click', '.acp_req', function (e) {
            e.preventDefault(); 

            var id = $(this).attr('data-id');
            var base_url = '<?php echo base_url()?>';

            const swalWithBootstrapButtons = Swal.mixin({
               customClass: 
               {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-Primary'
               },
            })
            swalWithBootstrapButtons.fire({
               title: 'Are you sure?',
               text: "Do you want to accept this order?",
               icon: 'success',
               showCancelButton: true,
               confirmButtonText: 'Yes, accept it!',
               cancelButtonText: 'No, cancel!',
               reverseButtons: true
            }).then((result) => 
            {
               if (result.isConfirmed) 
               {
                  $.ajax({
                     url     : base_url + "HoteladminController/accept_reserve_order",
                     method  : "post",
                     data    : {id : id},
                     success : function(data)
                     {
                        // console.log("chiragi"+data);
                        // return false;
                        if(data == 1)
                        {
                           reserve_tables_new_ord.ajax.reload();
                           reserve_tables_accepted_ord.ajax.reload();
                           setTimeout(function(){
                                 swalWithBootstrapButtons.fire(
                                    'accept order!',
                                    'Your order has been accepted.',
                                    'success'
                                 )
                                 $('[href="#accepted_orders_div"]').tab('show');
                           }, 200);
                        }
                     }
                  });
               } 
               else if (result.dismiss === Swal.DismissReason.cancel) 
               {
                     swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your order is safe :)',
                        'error'
                     )
               }
            })
         });

         // reject order
         $(document).on('click', '.rej_req', function (e) {
            e.preventDefault(); 

            var id = $(this).attr('delete-id');
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
               text: "Do you want to reject this order?",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Yes, reject it!',
               cancelButtonText: 'No, cancel!',
               reverseButtons: true
            }).then((result) => 
            {
               if (result.isConfirmed) 
               {
                  $.ajax({
                     url     : base_url + "HoteladminController/reject_reserve_order",
                     method  : "post",
                     data    : {id : id},
                     success : function(data)
                     {
                     // console.log("chiragi"+data);
                     // return false;
                        if(data == 1)
                        {
                           reserve_tables_new_ord.ajax.reload();
                           reserve_tables_rejected_ord.ajax.reload();
                           setTimeout(function(){
                              swalWithBootstrapButtons.fire(
                                 'reject order!',
                                 'Your order has been rejected.',
                                 'info'
                              )
                              $('[href="#rejected_orders_div"]').tab('show');
                           }, 200);
                        }
                     }
                  });
               } 
               else if (result.dismiss === Swal.DismissReason.cancel) 
               {
                     swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your order is safe :)',
                        'error'
                     )
               }
            })
         });

         setInterval( function () {
            reserve_tables_new_ord.ajax.reload();
         }, 30000 );

      });
   </script>
<?php  }?>
<div class="modal fade update_food_facility_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Facility</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form id="food_facility_form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <input type="hidden" name="food_facility_id" id="food_facility_id">
                     <div class="row">
                        <div class="mb-3 col-md-12">
                           <label class="form-label"> Name</label>
                           <input type="text" name="facility_name" id="facility_name" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Upload Icon</label>
                           <input type="file" name="icon"  class="form-control" placeholder="">
                           <img src="" id="img" alt="Not Found" height="50" width="50">
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Description</label>
                           <textarea class="summernote" name="description" id="description" cols="30"
                              rows="10"></textarea>
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

<script>
    // delete department script
    $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HoteladminController/delete_food_facility') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your file has been deleted.", "success");
                        $.get( '<?= base_url('HoteladminController/ajaxFoodVeverageView_n1');?>', function( data ) {
                        var resu = $(data).find('.table-scrollable-food1').html();
                        $('.table-scrollable-food1').html(resu);
      
                     setTimeout(function(){
                           $('#foodFacilityTable1').DataTable();
                     }, 2000);
                  });  
                        $(".loader_block").hide();
                        $(".food_facility_list_new").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }

                });

            } else {
                swal(
                  "Cancelled",
                        "Your imaginary file is safe :)",
                        "error"
                );
            }
        });
    });

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
    // delete department script
    $(document).on('click', '#delete_data_menu', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id-menu');
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: '<?= base_url('HoteladminController/delete_food_menus') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your file has been deleted.", "success");
                        $.get( '<?= base_url('HoteladminController/ajaxFoodVeveragefoodpagination');?>', function( data ) {
                        var resu = $(data).find('.food_menu_div').html();
                        $('.food_menu_div').html(resu);

                        setTimeout(function(){
                           $('#foodmenu').DataTable();
                        }, 2000);
                     });  
                        $(".loader_block").hide();
                        $(".foodmenudata").html(res);
                    },
                    complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                    }

                });

            } else {
                swal(
                  "Cancelled",
                        "Your imaginary file is safe :)",
                        "error"
                );
            }
        });
    });

   </script>


<script>
   // $(document).ready(function() {
   //     // $('#newOrder_tb').DataTable();
   //    //  $('#acceptedOrder_tb').DataTable();
   //    //  $('#rejectedOrder_tb').DataTable();
   //    //  $('#completedOrder_tb').DataTable();
   // } );
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
   //    $(document).ready(function()
   //    {
   //        debugger;
   //        $('#food_facility_id1').change(function()
   //        {
   //            var base_url = '<?php echo base_url()?>';
   //            var food_facility_id = $('#food_facility_id1').val();
      
   //            if(food_facility_id != '')
   //            {
   //                $.ajax({
   //                        url : base_url + "HoteladminController/changeFoodCat",
   //                        method : "POST",
   //                        data : {food_facility_id : food_facility_id},
   //                        success : function(data)
   //                                {
   //                                    // alert(data);
   //                                    $('#food_category_id1').html(data);
   //                                }
   //                        });
   //            }
   //        });
   //    });
</script>
<script>
   $(document).ready(function() {
      $('.nav-tabs a').on('click', function() {
         var tabId = $(this).attr('href'); // Get the ID of the clicked tab
         // var title = '';

         // Update the title based on the tab ID
         if (tabId === '#new_orders_div') {
               $('.page_header_title11').text('All New Orders');
         } else if (tabId === '#accepted_orders_div') {
               $('.page_header_title11').text('All Accepted Orders');
         } else if (tabId === '#rejected_orders_div') {
               $('.page_header_title11').text('All Rejected Orders');
         }
         // $('.headingtitle').text(title);
      });
   });

   $(".table-remove").on("click", function(event) {         
      var cat_id=  event.currentTarget.id;
      var base_url='<?php echo base_url()?>';
      $.ajax({
        url     : base_url +"HoteladminController/delete_facility_category",
        method  : "post",
        data    : {cat_id : cat_id},
        success : function(data)
        {
          if(data==1){
            console.log("yes deleted");
            $("#close_"+cat_id).css("display","none");
          }
          else{
            alert("Category not deleted...!");
          }
         
        }
      });
   });
</script>
<script>
   $(document).ready(function() {
      $('#foodFacilityTable').DataTable();
      $('#foodFacilityTable1').DataTable();
      $('#foodCategoriesTable').DataTable();
      $('#foodmenu').DataTable();
   });
</script>