
<?php
$i = 1;
if ($list) {
    foreach ($list as $businness_data) {
        $wh = '(business_center_id = "' . $businness_data['business_center_id'] . '")';

        $business_center_img = $this->MainModel->getData('business_center_images', $wh);

        if ($business_center_img) {
            $img = $business_center_img['image'];
        } else {
            $img = base_url() . 'documents/logo16.png';

        }
        // $wh1 = '(business_center_id = "'.$businness_data['business_center_id '].'")';

        $business_center_facility = $this->FrontofficeModel->getAllData('business_center_facility', $wh);
        //  print_r($business_center_facility);
        ?>
                        <tr>
                           <td>
                              <h5><?php echo $i++ ?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['business_center_type'] ?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['no_of_people'] ?></h5>
                           </td>
                           <td>
                              <h5 class="text-nowrap"><i class="fa fa-rupee"> </i> <?php echo $businness_data['price'] ?>
                              </h5>
                           </td>
                           <td>
                              <select onchange="change_status(<?php echo $businness_data['business_center_id'] ?>)" id="status_<?php echo $businness_data['business_center_id']; ?>" class="form-control">
                                 <option <?php if ($businness_data['is_active'] == 1) {echo "Selected";}?> value="1">Active</option>
                                 <option <?php if ($businness_data['is_active'] == 0) {echo "Selected";}?> value="0">Deactive</option>
                              </select>
                           </td>
                           <td>
                              <div class="">
                              <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".bd-example-modal-lg_view"><i class="fa fa-eye"></i></a>
                                 <!-- <a href="<?php echo base_url('business_center_view/' . $businness_data['business_center_id']) ?>"
                                    class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                        class="fa fa-eye"></i></a> -->
                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <!-- <a id="delete"
                                    class="btn btn-danger shadow btn-xs sharp "><i
                                        class="fa fa-trash"></i></a> -->
                                 <!-- <a href="#"  id="delete_<?php echo $businness_data['business_center_id']; ?>"
                                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                                        class="fa fa-trash"></i></a> -->
                                 <a href="#" id="delete" data-id="<?php echo $businness_data['business_center_id']; ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                                 <i class="fa fa-trash "></i> </a>
                              </div>
                              <!-- view model -->
                        <div class="modal fade bd-example-modal-lg_view" tabindex="-1" role="dialog" aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                 <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Business Center View </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                <div class="modal-body">
                                    <div class="row mt-4">
                                       <div class="col-xl-12">
                                          <div class="row">
                                             <div class="col-xl-12">
                                                <div class="card overflow-hidden">
                                                   <div class="row m-0">
                                                      <div class="col-xl-6 p-0">
                                                         <div class="card-body">
                                                            <div class="guest-profiles">
                                                               <!-- <div class="d-flex">
                                                                  <div class="mt-4 check-status">
                                                                      <span class="d-block mb-2">Log In</span>
                                                                      <span class="font-w500 fs-16">October 30th, 2021 | 08:23
                                                                          AM</span>
                                                                  </div>
                                                                  
                                                                  </div> -->
                                                            </div>
                                                            <div class="d-flex flex-wrap">
                                                               <div class="mt-4 check-status">
                                                                  <span class="d-block mb-2">Bussiness Type</span>
                                                                  <span class="d-block mb-2 business_type_test"></span>
                                                                  <!-- <h4 class="font-w500 fs-24"><span id="price"></span></h4> -->
                                                               </div>
                                                               <div class="mt-4 ms-3">
                                                                  <span class="d-block mb-2 text-black">Price</span>
                                                                  <span class="d-block mb-2 business_type_price"></span>
                                                               </div>
                                                              
                                                            </div>
                                                            <div class="d-flex flex-wrap">
                                                               <div class="mt-4 check-status">
                                                               <span class="d-block mb-3">Facilities</span>
                                                                  <button class="btn btn-dark"><span class="d-block mb-2 facility"></span></button>
                                                                  <!-- <h4 class="font-w500 fs-24"><span id="price"></span></h4> -->
                                                               </div>
                                                               <div class="mt-4 ms-3">
                                                               <span class="d-block mb-3">Decription</span>
                                                                  <span class="d-block mb-2 description_view"></span>
                                                               </div>
                                                              
                                                            </div>
                                                   
                                                           
                                                         </div>
                                                      </div>
                                                      <div class="col-xl-6 p-0 d-flex align-items-center">
                                                         <div id="owl-demo2" class="owl-carousel">
                                                            
                                                            <div class="items">
                                                            <img src="" id="img" alt="Not Found" height="200px" width="300px" style="margin-top:20px">
                                                               <div class="" style="height:150px;width:200px">
                                                                  
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
                           </div>
                           </div>
                           <!-- view model end -->
                           </td>
                        </tr>
<script>

$(document).on('click','#delete',function(id){
   var id = $(this).attr('data-id');
    var base_url='<?php echo base_url(); ?>';
   //  alert(base_url);
    swal({

            title: "Are you sure?",
            text: "You will not be able to recover this Staff!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
        
            if (isConfirm) {
                $.ajax({
                    url:base_url+"FrontofficeController/delete_services",

                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                     console.log(data);
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
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
                    "Your  staff is safe !",
                    "error"
                );
            }
        });
});
                                        </script>
    <!-- modal popup for edit  -->
    <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Edit Business Center</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="basic-form">
                                          <form id="frmupdateblock"  method="post" enctype="multipart/form-data">
                                             <input type="hidden" name="business_center_id" value="<?php echo $businness_data['business_center_id']?>" id="business_center_id">
                                             <div class="row">
                                                <div class="mb-3 col-md-6">
                                                   <label class="form-label">Business Center Type</label>
                                                   <input type="text" class="form-control" name="business_center_type" id="business_center_type" >
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                   <label class="form-label">Business Center capacity</label>
                                                   <input type="text" class="form-control" name="no_of_people" id="no_of_people" >
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                   <label class="form-label">Price</label>
                                                   <div class="input-group">
                                                      <input type="text" class="form-control" name="price" id="price">
                                                      <!-- <div class="input-group-append">
                                                         <span class="input-group form-control">/ Hrs</span>
                                                         </div> -->
                                                   </div>
                                                </div>
                                                <div class=" mb-3 col-md-6">
                                                   <label class="form-label">Photos</label>
                                                   <!-- <input type="file" class="form-control"> -->
                                                   <input accept="image/*" type="file" name="image" id="image" class="form-control " onchange="pressed()" >
                                                   <label id="fileLabel " style="line-height: 26px;"><?php echo basename($img);?></label>
                                                </div>
                                                <div class="mb-3 col-md-12 form-group">
                                                   <?php
                                                      $j = 0;
                                                      $business_center_imgs = $this->FrontofficeModel->getAllData('business_center_images',$wh);
                                                      
                                                      if($business_center_imgs)
                                                      {
                                                      ?>
                                                   <label class="form-label">Upload Photos</label>
                                                   <?php
                                                      foreach($business_center_imgs as $bus_im)
                                                      {
                                                      ?>
                                                   <input type="hidden" name="business_center_image_id[]" value="<?php echo $bus_im['business_center_image_id']?>">
                                                   <input name="image[<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" data-default-file="<?php echo $bus_im['image']?>"/>
                                                   <?php
                                                      $j++;
                                                      }
                                                      }
                                                      ?>
                                                </div>
                                                <div class="mb-3 col-md-12 form-group">
                                                   <label class="form-label">Facilties</label>
                                                   <input type="text" name="facility_name[]" id="facility_name" class="form-control"
                                                      >
                                                </div>
                                                <div class=" mb-3 col-md-12">
                                                   <label class="form-label"> Details</label>
                                                   <textarea class="summernote" name="description" id="description" rows="3" id="comment" required=""></textarea>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary css_btn">Save changes</button>
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end of modal  -->
<?php $i++;}}?>
<script>

$(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/edit_business_center') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
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
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
               //   alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getEditData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('.business_type_test').html(data.business_center_type);
                                             $('.business_type_price').html(data.price);
                                             $('.facility').html(data.facility_name);
                                             $('.description_view').html(data.description);
                                             $("#img").attr('src',data.image);

                                             $('#business_center_id').val(data.business_center_id);
                                             $('#business_center_type').val(data.business_center_type);
                                             $('#no_of_people').val(data.no_of_people);
                                             $('#price').val(data.price);
                                             $('#facility_name').val(data.facility_name);
                                             $('#description').summernote('code', data.description);

                                          }
                              
                                          
                                          }); 
            })
        });
</script>