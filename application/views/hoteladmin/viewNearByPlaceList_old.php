
<style>
   .nearplace_list .container-fluid{
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
               <div class="page-title">Near Places</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Near Places</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of Near Places</header>
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
                           <select id="inputState" class="default-select form-control wide ">
                              <option selected="">Must See Place...</option>
                              <option>Shopping</option>
                              <option>Mouments</option>
                              <option>Fun</option>
                           </select>
                           <input type="text" class="form-control" placeholder="Place Name">
                           <button class="btn btn-warning  btn-sm ">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div>
                           <button style="float:right;" type="button" class="btn btn-primary css_btn"
                              data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Places</button>
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
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Must see places</label>
                                                   <select name="places" id="inputState" class="default-select form-control wide" required>
                                                      <option value data-isdefault="true">Choose...</option>
                                                      <option value="Monuments">Monuments</option>
                                                      <option value="Shopping">Shopping</option>
                                                      <option value="Fun">Fun </option>
                                                   </select>
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Place Name</label>
                                                   <input type="text" name="places_name" class="form-control" placeholder="Place Name" required="">
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Contact Number</label>
                                                   <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" class="form-control" placeholder="Contact Number" required="">
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Upload Photo</label>
                                                   <input type="file" class="form-control" name="image[]" multiple="" required="">
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Address</label>
                                                   <textarea class="summernote" name="place_address" rows="4" id="comment" required=""></textarea>
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Description</label>
                                                   <textarea class="summernote newsummernote" name="description" rows="4" id="comment" required=""></textarea>
                                                </div>
                                                <div class="mb-3 col-md-3 form-group">
                                                   <label class="form-label">Latitude</label>
                                                   <input type="text" name="latitute" class="form-control" placeholder="Latitude" required="">
                                                </div>
                                                <div class="mb-3 col-md-3 form-group">
                                                   <label class="form-label">Longtitude</label>
                                                   <input type="text" name="longitude" class="form-control" placeholder="Longtitude" required="">
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Website link</label>
                                                   <input type="text" name="website_link" class="form-control" placeholder="Website link" required="">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Add Place</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="table-scrollable nearplace_list">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th>
                                 <strong>Sr.no.</strong>
                              </th>
                              <th>
                                 <strong>Must See Place</strong>
                              </th>
                              <th>
                                 <strong>Place Name</strong>
                              </th>
                              <th>
                                 <strong>Contact</strong>
                              </th>
                              <th>
                                 <strong>Address</strong>
                              </th>
                              <th>
                                 <strong>Photo</strong>
                              </th>
                              <th>
                                 <strong>Latitude</strong>
                              </th>
                              <th>
                                 <strong>Longtitude</strong>
                              </th>
                              <th>
                                 <strong>Description</strong>
                              </th>
                              <th>Website link</th>
                              <th>
                                 <strong>Action</strong>
                              </th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php
                              $i = 1;
                              if($list)
                              {
                              foreach($list as $h_ne_pl)
                              {
                              
                              $wh = '(hotel_near_by_place_id = "'.$h_ne_pl['hotel_near_by_place_id'].'")';
                              
                              $hotel_near_by_place_image = $this->HotelAdminModel->getData('hotel_near_by_place_images',$wh);
                              
                              if(!empty($hotel_near_by_place_image))
                              {
                              $hotel_near_img = $hotel_near_by_place_image['images'];
                              }
                              else
                              {
                              $hotel_near_img = '';
                              }
                              
                              ?> 
                           <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                              <td>
                                 <strong> <?php echo $i++ ?> </strong>
                              </td>
                              <td> <?php echo $h_ne_pl['places']?> </td>
                              <td> <?php echo $h_ne_pl['places_name']?> </td>
                              <td> <?php echo $h_ne_pl['contact_no']?> </td>
                              <td class="job-desk3">
                                 <p class="mb-0"> <?php echo $h_ne_pl['place_address']?> </p>
                              </td>
                              <td>
                                 <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                    <a href="
                                       <?php echo $hotel_near_img?>" data-exthumbimage="
                                       <?php echo $hotel_near_img?>" data-src="
                                       <?php echo $hotel_near_img?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                    <img class="me-3" src="
                                       <?php echo $hotel_near_img?>" alt="" style="width:80px;">
                                    </a>
                                 </div>
                              </td>
                              <td> <?php echo $h_ne_pl['latitute']?> </td>
                              <td> <?php echo $h_ne_pl['longitude']?> </td>
                            
                              <td>
                                    <a style="margin:auto" data-bs-toggle="modal"
                                    data-bs-target=".bd-terms-modal-sm_<?php echo $h_ne_pl['hotel_near_by_place_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i
                                    class="fa fa-eye"></i></a>
                              </td>
                              <td> <?php echo $h_ne_pl['website_link']?> </td>
                              <td>
                                 <div class="d-flex">
                                  
                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $h_ne_pl['hotel_near_by_place_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 


                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $h_ne_pl['hotel_near_by_place_id']?>" ><i class="fa fa-trash"></i></a>
                                 </div>
                              </td>
                             
                           </tr>

                           <div class="modal fade bd-terms-modal-sm_<?php echo $h_ne_pl['hotel_near_by_place_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Description</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <span><?php echo $h_ne_pl['description'] ?></span>
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
<!-- edit model-->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-sm slideInRight animated" style="max-width:90%">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Places</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
            <input type="hidden" name="hotel_near_by_place_id" id="hotel_near_by_place_id">
            <div class="modal-body">
                <div class="col-12 ">
                  <div class="row">
                      <div class="mb-3 col-md-4 form-group">
                        <label class="form-label">Must see places</label>
                        <select  class="default-select form-control wide" name="places" id="placesdd" >
                        <?php
                        $admin_id = $this->session->userdata('u_id');
                        $wh= '(hotel_id = "'.$admin_id.'")';
                        // print_r($wh);die;
                                 $facility= $this->HotelAdminModel->getAllData($tbl='hotel_near_by_place',$wh);
                                 // print_
                                 // r($facility);die;
                                 foreach($facility as $fac)
                                 {
                                          $fac_name = $fac['places'];
                                //  print_r($fac_name);die;

                                 ?>
                                 <option <?php if($fac['hotel_near_by_place_id'] == $h_ne_pl['hotel_near_by_place_id']) { echo "Selected";}?> value="<?php echo $fac['places']?>"><?php echo $fac_name?></option>
                              <?php 
                                 }
                                 ?>   
                      
                        </select>
                      </div>
                      <div class="mb-3 col-md-4 form-group">
                        <label class="form-label">Place Name</label>
                        <input type="text" name="places_name" id="places_name" class="form-control" placeholder="" required="">
                      </div>
                      <div class="mb-3 col-md-4 form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" id="contact_no" class="form-control" placeholder="" required="">
                      </div>
                      <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Upload Photo</label>
                        <!-- <input type="file" class="form-control" name="file1" multiple=""> -->
                        <div class="row">
                            <?php
                              $j = 0;
                              
                         
                              ?> 
                          
                            <div class="col-md-6 d-flex align-items-center" >
                            <input type="file" name="image" value="" class="form-control" placeholder="">
                                <img src="" id="images" class=" ms-1" alt="Not Found" height="30" width="30">
                             
                            </div>
                          
                              
                        </div>
                      </div>
                      <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Address</label>
                        <textarea class="summernote" name="place_address" id="place_address" rows="4"   required="">
                        </textarea>
                      </div>
                      <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Description</label>
                        <textarea class="summernote" name="description" rows="4" id="description" required="">
                        </textarea>
                      </div>
                      <div class="mb-3 col-md-3 form-group">
                        <label class="form-label">Latitude</label>
                        <input type="text" class="form-control" name="latitute" id="latitute" placeholder="">
                      </div>
                      <div class="mb-3 col-md-3 form-group">
                        <label class="form-label">Longtitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="">
                      </div>
                      <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Website link</label>
                        <input type="text" class="form-control" name="website_link" id="website_link" placeholder="">
                      </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Update Place</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>

    </div>
</div>
</div>
<!-- end of edit modal  -->
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
   
   // Add Near By Place
    $(document).on('submit', '#frmblock', function(e){
     // alert('hi');
     e.preventDefault();
     $(".loader_block").show();
     var form_data = new FormData(this);
     $.ajax({
         url         : '<?= base_url('HoteladminController/add_hotel_near_by_places') ?>',
         method      : 'POST',
         data        : form_data,
         processData : false,
         contentType : false,
         cache       : false,
         success     : function(res) {
            $.get( '<?= base_url('HoteladminController/nearByPlace');?>', function( data ) {
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
   $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                url: '<?= base_url('HoteladminController/getListOfNearPlaces') ?>',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                    
                    console.log(data);
                    $('#hotel_near_by_place_id').val(data.hotel_near_by_place_id);
                    $('#placesdd option[value="' + data.places + '"]').prop('selected', true);
                    $('#places_name').val(data.places_name);
                    $('#contact_no').val(data.contact_no);
                    $("#images").attr('src',data.hotel_near_by_place_images[0].images);
                    $('#place_address').summernote('code', data.place_address);
                    $('#description').summernote('code', data.description);
                    $('#latitute').val(data.latitute);
                    $('#longitude').val(data.longitude);
                    $('#website_link').val(data.website_link);
                }
                }); 
            })
        });

   // Update Near By Place
   $(document).on('submit', '#frmupdateblock', function(e){
     e.preventDefault();
     $(".loader_block").show();
     var form_data = new FormData(this);
     $.ajax({
         url         : '<?= base_url('HoteladminController/edit_hotel_near_by_places') ?>',
         method      : 'POST',
         data        : form_data,
         processData : false,
         contentType : false,
         cache       : false,
         success     : function(res) {
            $.get( '<?= base_url('HoteladminController/nearByPlace');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
             setTimeout(function(){  
              $(".loader_block").hide();
              $(".update_staff_modal").modal('hide');
              $(".append_data").html(res);
               $(".updatemessage").show();
               }, 2000);
              setTimeout(function(){  
                 $(".updatemessage").hide();
               }, 4000);
            
         }
     });
   });
   
   // delete Near By Place script
   $(document).on('click', '#delete_data', function (event) {
         event.preventDefault(); // Prevent the default behavior of the form submit button

         var id = $(this).attr('delete-id');
         swal({
               title: "Are you sure?",
               text: "You will not be able to recover this Near By Place!",
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
                     url: '<?= base_url('HoteladminController/delete_hotel_near_by_places') ?>',
                     method: "POST",
                     data: { id: id },
                     dataType: "html",
                     success: function (data) {
                           swal("Deleted!", "Near By Place has been deleted!", "success");
                           $.get( '<?= base_url('HoteladminController/nearByPlace');?>', function( data ) {
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
                        "Near By Place is safe!",
                        "error"
                  );
               }
         });
      });

</script>