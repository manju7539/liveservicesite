<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Business Center</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Business Center</li>
         </ol>
      </div>
   </div>
   <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Business Center Created Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
      <strong style="color:#fff ;margin-top:10px;">Business Center Updated Successfully..!</strong>
      <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="card card-topline-aqua">
            <div class="card-head">
               <header>List Of Business Center</header>
               <div class="tools">
                  <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                  <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                  <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
               </div>
            </div>
            <div class="card-body ">
               <div class="btn-group r-btn">
                  <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('ManageBusinessCenter')?>" style="color:white;">List Of Business Center</a></button> 
                  <button id="addRow1" class="btn btn-info add_facility">
                  Create Business Center
                  </button>
               </div>
               <div class="table-scrollable">
                  <table id="example1" class="display full-width">
                     <thead>
                        <tr>
                           <th>Sr.No.</th>
                           <th>Business center Type</th>
                           <th>Capacity</th>
                           <th>Price</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody class="append_data">
                        <?php
                           $i = 1;
                           if($list)
                           {
                               foreach($list as $businness_data)
                               {
                                   $wh = '(business_center_id = "'.$businness_data['business_center_id'].'")';
                           
                                   $business_center_img = $this->MainModel->getData('business_center_images',$wh);
                                   
                                   if($business_center_img)
                                    {
                                       $img = $business_center_img['image'];
                                    }
                                   else
                                   {
                                       $img = base_url().'documents/logo16.png';
                           
                                    }
                                   // $wh1 = '(business_center_id = "'.$businness_data['business_center_id '].'")';
                           
                                   $business_center_facility = $this->FrontofficeModel->getAllData('business_center_facility',$wh);
                                   //  print_r($business_center_facility);
                           ?>
                        <tr>
                           <td>
                              <h5><?php echo $i++ ?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['business_center_type']?></h5>
                           </td>
                           <td>
                              <h5><?php echo $businness_data['no_of_people']?></h5>
                           </td>
                           <td>
                              <h5 class="text-nowrap"><i class="fa fa-rupee"> </i> <?php echo $businness_data['price']?>
                              </h5>
                           </td>
                           <td>
                              <select onchange="change_status(<?php echo $businness_data['business_center_id']?>)" id="status_<?php echo $businness_data['business_center_id'] ;?>" class="form-control">
                                 <option <?php if($businness_data['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                                 <option <?php if($businness_data['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                              </select>
                           </td>
                           <td>
                              <div class="">
                                 <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".bd-example-modal-lg_view"><i class="fa fa-eye"></i></a>
                                 <!-- <a href="<?php echo base_url('business_center_view/'.$businness_data['business_center_id'])?>"
                                    class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                        class="fa fa-eye"></i></a> -->
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $businness_data['business_center_id']; ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                 <!-- <a id="delete"
                                    class="btn btn-danger shadow btn-xs sharp "><i
                                        class="fa fa-trash"></i></a> -->
                                 <!-- <a href="#"  id="delete_<?php echo $businness_data['business_center_id']; ?>"
                                    class="btn btn-danger btn sweet-confirm shadow btn-xs sharp"><i
                                        class="fa fa-trash"></i></a> -->
                                 <a href="#" id="delete_<?php echo $businness_data['business_center_id']; ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                                 <i class="fa fa-trash "></i> </a>
                              </div>
                           </td>
                        </tr>
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
                           <!-- Edit Modal -->
                           <!-- <div class="modal fade update_staff_modal add_staff_modal_<?php echo $s['leads_plan_id']?>" tabindex="-1" role="dialog" aria-hidden="true"> -->
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
                           <script>
                              document.getElementById('delete_<?php echo $businness_data['business_center_id']; ?>').onclick = function() {
                              
                              var id='<?php echo $businness_data['business_center_id'] ?>';
                              console.log("idd=",id);
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
                                          url:base_url+"FrontofficeController/delete_services", 
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"HTML",
                                          success: function (data) {
                                              if(data==1){
                                              swal(
                                                      "Deleted!",
                                                      "Your  file has been deleted!",
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
                                          "Your  file is safe !",
                                          "error"
                                      );
                                  }
                              });
                              };
                           </script>
                           <!--end dlt script-->  
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
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Business Center</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
            <div class="row">

<div class="mb-3 col-md-6">
    <label class="form-label">Business Center Type</label>
    <input type="text" name="business_center_type"  class="form-control" placeholder="" required>

</div>
<div class="mb-3 col-md-6">
    <label class="form-label">Business Center capacity</label>
    <input type="number"  name="no_of_people"  class="form-control" placeholder="" required >

  
</div>
<div class="mb-3 col-md-6">
    <label class="form-label">Price</label>
    <div class="input-group">
        <input type="number" name="price"   class="form-control" placeholder="" required >
        <!-- <div class="input-group-append">
            <span class="input-group form-control">/ Hr</span>
        </div> -->

    </div>
</div>
<!-- <div class=" mb-3 col-md-6">
    <label class="form-label">Photos</label>
    <input  type="file" name="image[]" accept=".jpg,.jpeg,.png,/application" class="dropify" multiple >

</div> -->
<div class="mb-3 col-md-6">
            <label class="form-label">Photos</label>

            <input type="file" name="image[]" accept=".jpg,.jpeg,.png,/application" class=" dropify  form-control"
                data-height="90" required=""   multiple>

</div>
        
<div class=" mb-3 col-md-12">
    <label class="form-label">Facilities</label>
    <input type="text" name="facility_name[]" class="form-control"
        placeholder="" required >
    <!-- <small class="form-text text-muted">Separate keywords with a
        comma, space bar, or enter key</small> -->
</div>
<div class=" mb-3 col-md-12">
    <label class="form-label"> Details</label>
    <textarea class="summernote" rows="3" name="description" id="comment"
                required=""></textarea>
    <!-- <div class="summernote"></div> -->

</div>


</div>
            </div>
            <div class="modal-footer d-flex justify-content-center mb-5">
               <button type="submit" class="btn btn-primary css_btn" >Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
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
<script>
   $(document).on("click",".add_facility",function(){
       $(".add_facility_modal").modal('show');
   });
   
   $(document).on("click",".update_facility_modal",function(){
       var data_id = $(this).attr('data-id');
      
       $(".add_staff_modal_"+data_id).modal('show');
   });
   
   // $(document).on('submit', '#frmblock', function(e){
   //     e.preventDefault();
   //     $(".loader_block").show();
   //     var form_data = new FormData(this);
   //     $.ajax({
   //         url         : '<?= base_url('FrontofficeController/add_business_center') ?>',
   //         method      : 'POST',
   //         data        : form_data,
   //         processData : false,
   //         contentType : false,
   //         cache       : false,
   //         success     : function(res) {
   //             setTimeout(function(){  
   //              $(".loader_block").hide();
   //              $(".add_facility_modal").modal('hide');
   //              $(".append_data").html(res);
   //               $(".successmessage").show();
   //               }, 2000);
   //             setTimeout(function(){  
   //                 $(".successmessage").hide();
   //               }, 4000);
              
   //         }
   //     });
   // });
   function change_status(id)
            {
                var base_url = '<?php echo base_url()?>';
                var status = $('#status_'+id).children("option:selected").val();
                var id = id;

                if(status != '')
                {
                    $.ajax({
                                url : base_url + "FrontofficeController/change_business_center_status",
                                method : "post",
                                data : {status : status,id : id},
                                success : function(data)
                                        {
                                            // alert(data)
                                            if(data == 1)
                                            {
                                                alert('Status changed successfully');
                                                location.reload();
                                            }
                                            else
                                            {
                                                alert('something went wrong');
                                                location.reload();
                                            }
                                        }
                    });
                }
            }
    $(document).on('submit', '#frmblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('FrontofficeController/add_business_center') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            $.get( '<?= base_url('ManageBusinessCenter');?>', function( data ) {
                    var res = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(res);
                    $('#example1').DataTable();
                });
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_facility_modal").modal('hide');
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
               //  alert(id);
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