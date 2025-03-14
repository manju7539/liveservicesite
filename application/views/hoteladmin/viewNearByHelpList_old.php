<style>
   .panel_listing .container-fluid{
   padding:0px
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Near By Help</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Near By Help</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of Near By Help Place</header>
               </div>
               <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="card-body ">
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="input-group" style="margin-left:4px;">
                           <select id="inputState"
                              class="default-select form-control wide"
                              >
                              <option selected="">Select Help Place...</option>
                              <option>General Store</option>
                              <option>Medical</option>
                              <option>Hospital</option>
                              <option value="">Police Station</option>
                           </select>
                           <input type="text" class="form-control"
                              placeholder="Place Name">
                           <button class="btn btn-warning  btn-sm "><i
                              class="fa fa-search"></i></button>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <button style="float:right;" type="button" class=" btn btn-info nearbyhelp "
                           >Add Places</button>
                     </div>
                     <br><br>
                     <div class="modal fade bd-add-modal update_login_modal" id="exampleModalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Add Places</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <form  id="frmblock" method="post" enctype="multipart/form-data">
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <div class="basic-form">
                                          <div class="row">
                                             <label class="form-label">Select Near By Help Place</label>
                                             <div class="col-md-2">
                                                <div class="text-center">
                                                </div>
                                                <div class="custom-control custom-radio image-checkbox">
                                                   <input type="radio" name="places_name" value="General Store" id="ck2a" class="radio_shown">
                                                   <label class="custom-control-label" for="ck2a">
                                                   <img src="<?php echo base_url();?>assets/dist/images/store.png" alt="#"
                                                      class="img-fluid"
                                                      style="height:160px;  width:220px;">
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                <div class="text-center">
                                                </div>
                                                <div class="custom-control custom-radio image-checkbox">
                                                   <input type="radio" name="places_name" value="Medical" id="ck2b" class="radio_shown">
                                                   <label class="custom-control-label" for="ck2b">
                                                   <img src="<?php echo base_url();?>assets/dist/images/medical.png" alt="#"
                                                      class="img-fluid"
                                                      style="height:160px; width:220px;">
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                <div class="text-center">
                                                </div>
                                                <div class="custom-control custom-radio image-checkbox">
                                                   <input type="radio" name="places_name" value="Hospital" id="ck2c" class="radio_shown">
                                                   <label class="custom-control-label" for="ck2c">
                                                   <img src="<?php echo base_url();?>assets/dist/images/hospital.png" alt="#"
                                                      class="img-fluid"
                                                      style="height:160px; width:220px;">
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                <div class="text-center">
                                                </div>
                                                <div class="custom-control custom-radio image-checkbox">
                                                   <input type="radio" name="places_name" value="Police" id="ck2d" class="radio_shown">
                                                   <label class="custom-control-label" for="ck2d">
                                                   <img src="<?php echo base_url();?>assets/dist/images/police.png" alt="#"
                                                      class="img-fluid"
                                                      style="height:160px; width:220px;">
                                                   </label>
                                                </div>
                                             </div>
                                             <div class="col-md-2">
                                                <div class="text-center">
                                                </div>
                                                <div class="custom-control custom-radio image-checkbox">
                                                   <input type="radio" name="places_name" value="Medical" id="ck2e" class="radio_shown">
                                                   <label class="custom-control-label" for="ck2e">
                                                   <img src="<?php echo base_url();?>assets/dist/images/car_rents.png" alt="#"
                                                      class="img-fluid"
                                                      style="height:160px; width:220px;">
                                                   </label>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row mt-3">
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Name</label>
                                             <input type="text" name="name" class="form-control" placeholder="Name"
                                                required="">
                                          </div>
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Contact Number</label>
                                             <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" class="form-control" placeholder="Contact Number"
                                                required="">
                                          </div>
                                          <div class="mb-3 col-md-3 form-group">
                                             <label class="form-label">Open Time</label>
                                             <input type="time" name="open_time" class="form-control" placeholder="Open Time"
                                                required="">
                                          </div>
                                          <div class="mb-3 col-md-3 form-group">
                                             <label class="form-label">Close Time</label>
                                             <input type="time" name="close_time" class="form-control" placeholder="Close Time"
                                                required="">
                                          </div>
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Upload Photo</label>
                                             <input type="file" class="form-control" name="image[]"
                                                multiple="" required="">
                                          </div>
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Address</label>
                                             <textarea class="summernote" name="place_address" rows="4" id="comment"
                                                required=""></textarea>
                                          </div>
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Description</label>
                                             <textarea class="summernote newsummernote" name="description" rows="4" id="comment"
                                                required=""></textarea>
                                          </div>
                                          <div class="text-center">
                                             <button type="submit" class="btn btn-info">Add
                                             Place</button>
                                             <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Cancel</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="table-scrollable panel_listing">
                        <table id="example1" class="display full-width">
                           <thead>
                              <tr>
                                 <th><strong>Sr.no.</strong></th>
                                 <th><strong> Help Place</strong></th>
                                 <th><strong> Name</strong></th>
                                 <th><strong>Contact</strong></th>
                                 <th><strong>Photo</strong></th>
                                 <th><strong>Address</strong></th>
                                 <th><strong>Open time</strong></th>
                                 <th><strong>Close time</strong></th>
                                 <th><strong>Description</strong></th>
                                 <th><strong>Action</strong></th>
                              </tr>
                           </thead>
                           <tbody class="append_data">
                              <?php
                                 $i = 1;
                                 
                                 if($list)
                                 {
                                     foreach($list as $n_h)
                                     {
                                         $wh = '(hotel_near_by_help_id = "'.$n_h['hotel_near_by_help_id'].'")';
                                 
                                         $hotel_near_by_help_image = $this->HotelAdminModel->getData('hotel_near_by_help_images',$wh);
                                         if(!empty($hotel_near_by_help_image))
                                         {
                                             $hotel_near_img = $hotel_near_by_help_image['images'];
                                         }
                                         else
                                         {
                                             $hotel_near_img = '';
                                         }
                                 
                                 ?>
                              <tr data-toggle="collapse" data-target="#demo1"
                                 class="accordion-toggle">
                                 <td><strong><?php echo $i++; ?></strong></td>
                                 <td><?php echo $n_h['places_name'] ?></td>
                                 <td><?php echo $n_h['name'] ?></td>
                                 <td><?php echo $n_h['contact_no'] ?></td>
                                 <td>
                                    <div class="lightgallery"
                                       class="room-list-bx d-flex align-items-center">
                                       <a href="<?php echo $hotel_near_img; ?>"
                                          data-exthumbimage="<?php echo $hotel_near_img ?>"
                                          data-src="<?php echo $hotel_near_img ?>"
                                          class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                       <img class=""
                                          src="<?php echo $hotel_near_img ?>" alt=""
                                          style="width:40px;height:40px;">
                                       </a>
                                    </div>
                                 </td>
                                 <td> <span><?php echo $n_h['place_address'] ?></span></td>
                                 <td><?php echo date('h:i a',strtotime($n_h['open_time'])) ?></td>
                                 <td><?php echo date('h:i a',strtotime($n_h['close_time'])) ?></td>
                                 <td>
                                    <a style="margin:auto" data-bs-toggle="modal"
                                       data-bs-target=".bd-terms-modal-sm_<?php echo $n_h['hotel_near_by_help_id'] ?>"
                                       class="btn btn-secondary shadow btn-xs sharp"><i
                                       class="fa fa-eye"></i></a>
                                 </td>
                                 <td>
                                    <div class="d-flex">
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $n_h['hotel_near_by_help_id']?>" data-bs-target=".update_nearbyhelp_modal"><i class="fa fa-pencil"></i></a> 
                                       <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $n_h['hotel_near_by_help_id']?>" ><i class="fa fa-trash"></i></a>
                                    </div>
                                 </td>
                              </tr>
                              <div class="modal fade bd-terms-modal-sm_<?php echo  $n_h['hotel_near_by_help_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                 <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title">Description</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal">
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="col-lg-12">
                                             <span><?php echo $n_h['description'] ?></span>
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
         </div>
      </div>
   </div>
</div>
<!-- modal popup for edit  -->
<div class="modal fade update_nearbyhelp_modal" tabindex="-1" style="display:none" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md" style="max-width:90%;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title"><b>Update Places</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
            <div class="basic-form">
               <input type="hidden" name="hotel_near_by_help_id" id="hotel_near_by_help_id">
               <div class="modal-body">
                  <div class="col-md-12 " >
                     <div class="row" style="padding-left:50%; padding-right:50%">
                        <label class="form-label">Select Near By Help Place</label>
                        <div class="col-md-2" >
                           <div class="custom-control custom-radio image-checkbox" >
                              <input type="radio" name="places_name" id="ck2aa" class="radio_shown" value="General Store">
                              <label class="custom-control-label" for="ck2aa">
                              <img src='<?php echo base_url();?>assets/dist/images/store.png' alt="#"
                                 class="img-fluid"
                                 style="height:160px;  width:220px;">
                              </label>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="custom-control custom-radio image-checkbox">
                              <input type="radio" name="places_name" id="ck2bb" class="radio_shown" value="Medical">
                              <label class="custom-control-label" for="ck2bb">
                              <img src="<?php echo base_url();?>assets/dist/images/medical.png" alt="#"
                                 class="img-fluid"
                                 style="height:160px; width:220px;">
                              </label>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="custom-control custom-radio image-checkbox">
                              <input type="radio" name="places_name" id="ck2cc" class="radio_shown" value="Hospital">
                              <label class="custom-control-label" for="ck2cc">
                              <img src="<?php echo base_url();?>assets/dist/images/hospital.png" alt="#"
                                 class="img-fluid"
                                 style="height:160px; width:220px;">
                              </label>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="custom-control custom-radio image-checkbox">
                              <input type="radio" name="places_name" id="ck2dd" class="radio_shown"  value="Police">
                              <label class="custom-control-label" for="ck2dd">
                              <img src="<?php echo base_url();?>assets/dist/images/police.png" alt="#"
                                 class="img-fluid"
                                 style="height:160px; width:220px;">
                              </label>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="custom-control custom-radio image-checkbox">
                              <input type="radio" name="places_name" id="ck2ee" class="radio_shown"  value="car & bike rental">
                              <label class="custom-control-label" for="ck2ee">
                              <img src="<?php echo base_url();?>assets/dist/images/car_rents.png" alt="#"
                                 class="img-fluid"
                                 style="height:160px; width:220px;">
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="mb-3 col-md-3 form-group">
                           <label class="form-label">Name</label>
                           <input type="text" name="name" id="name" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                           <label class="form-label">Contact Number</label>
                           <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" id="contact_no" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                           <label class="form-label">Open Time</label>
                           <input type="time" name="open_time" id="open_time" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                           <label class="form-label">Close Time</label>
                           <input type="time" name="close_time" id="close_time" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                           <label class="form-label">Upload Photo</label>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-file form-control"
                                    style="border: 0.0625rem solid #ccc7c7;">
                                    <input type="hidden" name="id[]" id="imgid">
                                    <input type="file" name="image" class="form-control" placeholder="">
                                    <img src="" id="img" alt="Not Found" height="50" width="50">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mb-0 col-md-6 form-group">
                           <label class="form-label">Address</label>
                           <textarea class="summernote" name="place_address" rows="4" id="place_address"
                              ></textarea>
                        </div>
                        <div class="mb-0 col-md-6 form-group">
                           <label class="form-label">Description</label>
                           <textarea class="summernote" name="description" rows="4" id="description"
                              ></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="model-footer r-btn">
                  <button type="submit" class="btn btn-info">Update Place</button>
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end of edit  modal   -->
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
   $(document).on("click",".nearbyhelp",function(){
        $("#exampleModalCenter").modal('show');
    });
   
   // $(document).on("click",".update_faq_modal",function(){
   // var data_id = $(this).attr('data-id');
   
   // $("#update_faq_"+data_id).modal('show');
   // });
   
   // Add Near By Help
   $(document).on('submit', '#frmblock', function(e){
   e.preventDefault();
   $(".loader_block").show();
   var form_data = new FormData(this);
   $.ajax({
   url         : '<?= base_url('HoteladminController/add_hotel_near_by_help') ?>',
   method      : 'POST',
   data        : form_data,
   processData : false,
   contentType : false,
   cache       : false,
   success     : function(res) {
      $.get( '<?= base_url('HoteladminController/nearByHelp');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
     setTimeout(function(){  
      $(".loader_block").hide();
      $(".update_login_modal").modal('hide');
      $(".update_login_modal").on("hidden.bs.modal", function() {
      $("#frmblock")[0].reset(); // reset the form fields
      $('#comment').summernote('reset');
      $('.newsummernote').summernote('reset');
   });
      $(".append_data").html(res);
       $(".successmessage").show();
       }, 2000);
     setTimeout(function(){  
         $(".successmessage").hide();
       }, 4000);
    
   }
   });
   });
   
   // Fetch Edit Data
   $(document).ready(function() {
    $(document).on('click', '#edit_data', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?= base_url('HoteladminController/getEditdata_NearByHelp') ?>',
            type: "post",
            data: { id: id },
            dataType: "json",
            success: function(data) {
                $('#hotel_near_by_help_id').val(data.list.hotel_near_by_help_id);
                $('#name').val(data.list.name);
                $('#contact_no').val(data.list.contact_no);
                $('#open_time').val(data.list.open_time);
                $('#close_time').val(data.list.close_time);
                $('#place_address').summernote('code', data.list.place_address);
                $('#description').summernote('code', data.list.description);
                $("#img").attr('src', data.hotel_near_by_help_images[0].images);
                $('#imgid').val(data.hotel_near_by_help_images[0].id);
   
                // Uncheck all radio buttons first
                $('input[name="places_name"]').prop('checked', false);
               // alert(data);return false;
                // Check the radio button with the corresponding value
                $('input[name="places_name"][value="' + data.list.places_name + '"]').prop('checked', true);
            }
        });
    });
   });
   
   
   // Update Near By Help
   $(document).on('submit', '#frmupdateblock', function(e){
   e.preventDefault();
   $(".loader_block").show();
   var form_data = new FormData(this);
   $.ajax({
   url         : '<?= base_url('HoteladminController/edit_hotel_near_by_help') ?>',
   type      : 'POST',
   data        : form_data,
   processData : false,
   contentType : false,
   cache       : false,
   success     : function(res) {
      $.get( '<?= base_url('HoteladminController/nearByHelp');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
     setTimeout(function(){  
      $(".loader_block").hide();
      $(".update_nearbyhelp_modal").modal('hide');
      $(".append_data").html(res);
       $(".updatemessage").show();
       }, 2000);
      setTimeout(function(){  
         $(".updatemessage").hide();
       }, 4000);
    
   }
   });
   });
   
   
   // Delete Near By Help
   $(document).on('click', '#delete_data', function (event) {
      event.preventDefault(); // Prevent the default behavior of the form submit button
   
      var id = $(this).attr('delete-id');
      swal({
            title: "Are you sure?",
            text: "You will not be able to recover this near by help!",
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
                  url: '<?= base_url('HoteladminController/delete_hotel_near_by_help') ?>',
                  method: "POST",
                  data: { id: id },
                  dataType: "html",
                  success: function (data) {
                        swal("Deleted!", "Near by help has been deleted!", "success");
                        $.get( '<?= base_url('HoteladminController/nearByHelp');?>', function( data ) {
                           var resu = $(data).find('.table-scrollable').html();
                           $('.table-scrollable').html(resu);
                           setTimeout(function(){
                                 $('#example1').DataTable();
                           }, 2000);
                        });
   
                        $(".loader_block").hide();
                        $(".append_data").html(res);
                  },
                  complete: function () {
                        // Close the SweetAlert modal when the AJAX request is complete
                        swal.close();
                  }
   
               });
   
            } else {
               swal(
                     "Cancelled",
                     "Near by help is safe!",
                     "error"
               );
            }
      });
   });
   
</script>