<!-- start page content -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
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
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Offers</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Offers</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of Offers</header>
               </div>
               <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="alert alert-success successmessage1" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;" class="status_change">Already this offer exiest..</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
                  <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
                  <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
               </div>
               <div class="card-body">
                  <div>
                     <button style="float:right;" type="button" class="btn btn-primary css_btn"
                        data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Add Offers</button>
                  </div>
                 
                  <div class="modal fade bd-add-modal update_login_modal" id="exampleModalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Add Offers</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <form  id="frmblock"  method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <div class="basic-form">
                                       <div class="row">
                                          <div class="mb-3 col-md-6">
                                             <label class="form-label">Offer Name</label>
                                             <!--<input type="text" name="offer_name" class="form-control alphanumericOnly" onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g, '')"
                                                placeholder="offer name" required>-->
                                             <input type="text" name="offer_name" class="form-control "
                                                placeholder="offer name" required>
                                          </div>
                                          <div class="mb-3 col-md-6">
                                             <label class="form-label">Offer For</label>
                                             <select id="ddlPassport" class="default-select form-control wide" name="offer_for" required>
                                                <option value data-isdefaul="true">Choose Any One</option>
                                                <option value="1">Over All</option>
                                                <option value="2">Front Ofs</option>
                                                <option value="3">Bar And Restaurant</option>
                                             </select>
                                          </div>
                                          <!-- <div class="mb-3 col-md-6">
                                             <label class="form-label">Minimum amount</label>
                                             <input type="number" name="min_amount" class="form-control"
                                                 placeholder="amount" required>
                                             </div> -->
                                          <div class="mb-3 col-md-6">
                                             <label class="form-label">Amount in Percentage
                                             (%)</label>
                                             <input type="number" name="amt_in_per" class="form-control"
                                                placeholder="percentage" required>
                                          </div>
                                          <div class="mb-3 col-md-6">
                                             <label class="form-label">Start Date</label>
                                             <input type="date" name="start_date" class="form-control" id="s_date"  
                                                placeholder="date" required>
                                          </div>
                                          <div class="mb-3 col-md-6">
                                             <label class="form-label">Expiry Date</label>
                                             <input type="date" name="end_date" class="form-control" id="e_date"
                                                placeholder="date" required>
                                          </div>
                                          <div class="mb-3 col-md-6 form-group">
                                             <label class="form-label">Upload photo</label>
                                             <input type="file" name="image" accept=".jpg,.jpeg,.png,/application" class="form-control"
                                                data-height="80" required>
                                          </div>
                                          <div class="mb-3 col-md-12">
                                             <label class="form-label">Offer Description</label>
                                             <textarea class="summernote" name="description" rows="4" id="comment"
                                                required=""></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="text-center">
                                    <button type="submit" class="btn btn-info">Add
                                    Offer</button>
                                 </div>
                           </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="table-scrollable">
                  <table id="example1" class="display full-width">
                     <thead>
                        <tr>
                           <th><strong>Sr.no.</strong></th>
                           <!-- <th><strong>Coupon Code</strong></th>-->
                           <th><strong>Offer Name</strong></th>
                           <th><strong>Offer For</strong></th>
                           <!--<th><strong>Minimum Amount</strong></th>-->
                           <th><strong> Percentage(%)</strong></th>
                           <th><strong>Start Date</strong></th>
                           <th><strong>Expiry Date</strong></th>
                           <th><strong> Image</strong></th>
                           <!-- <th><strong>Description</strong></th> -->
                           <th><strong>Action</strong></th>
                        </tr>
                     </thead>
                     <tbody class="append_data">
                        <?php 
                           $i = 1;
                           if($list)
                           {
                           foreach($list as $off)
                           {
                           $offer_for = "";
                           
                           if($off['offer_for'] == 1)
                           {
                           $offer_for = "Over All";
                           }
                           else
                           {
                           if($off['offer_for'] == 2)
                           {
                           $offer_for = "Front Office Services";
                           }
                           else
                           {
                           if($off['offer_for'] == 3)
                           {
                           $offer_for = "Bar and Restaurant";
                           }
                           }
                           }
                           ?>
                        <tr>
                           <td><strong><?php echo $i++ ?></strong></td>
                           <!-- <td><?php //echo $off['offer_code'] ?></td>-->
                           <td><?php echo $off['offer_name'] ?></td>
                           <td><?php echo $offer_for?></td>
                           <!--<td><?php echo $off['min_amount'] ?></td>-->
                           <td><?php echo $off['amt_in_per'] ?> </td>
                           <td><?php echo date('d-m-Y', strtotime($off['start_date'])); ?></td>
                           <td><?php echo date('d-m-Y', strtotime($off['end_date'])); ?></td>
                           <td>
                              <div class="lightgallery"
                                 class="room-list-bx d-flex align-items-center">
                                 <a href="<?php echo $off['image'] ?>" target="_blank"
                                    data-exthumbimage="<?php echo $off['image'] ?>"
                                    data-src="<?php echo $off['image'] ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class="me-2 "
                                    src="<?php echo $off['image'] ?>"
                                    alt="" style="width:70px;">
                                 </a>
                              </div>
                           </td>
                           <!-- <td>Special offer available</td> -->
                           <td>
                              <div class="">
                               
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $off['offer_id']?>" data-bs-target=".update_offer_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $off['offer_id']?>" ><i class="fa fa-trash"></i></a> 
                                
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
</div>
</div>
</div>
 <!-- modal popup for edit  -->
     
 <div class="modal fade update_offer_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md" style="min-width:70%">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Offers</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<form id="frmupdateblock" method="post" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="col-lg-12">
                <input type="hidden" name="offer_id" id="offer_id">
                <div class="row">
                   
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Offer Name</label>
                    <input type="text" name="offer_name" id="offer_name" class="form-control" placeholder="offer name">
                    </div>
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Offer For</label>
                    <select id="inputState" class="default-select form-control wide" name="offer_for"  data-hotelid="">
                        <?php
                        $hotel_data = $this->HotelAdminModel->getUniqueOfferFromData();
                        foreach($hotel_data as $u) {
                           $id = $u['offer_for'];
                           $name = '';
                           if ($id == '1') {
                                 $name = "Over All";
                           } else if ($id == '2') {
                                 $name = "Front Ofs";
                           } else {
                                 $name = "Bar And Restaurant";
                           }
                           
                           $selected = '';
                           // Check if the current option should be selected
                        //   if ($id == $selected_option_value) {
                        //          $selected = 'selected';
                        //   }
                           
                           echo '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
                        }
                        ?>
                     </select>


                    </div>
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Amount in Percentage (%)</label>
                    <input type="number" name="amt_in_per" id="amt_in_per" class="form-control" placeholder="percentage">
                    </div>
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="date">
                    </div>
                    <div class="mb-3 col-md-6">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="date">
                    </div>
                    <div class="mb-3 col-md-12 form-group">
                                        <label class="form-label">Upload photo</label>
                                        <div class="form-file form-control"
                              style="border: 0.0625rem solid #ccc7c7;">
                                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg">
                                        <img src="" id="img" alt="Not Found" height="50" width="50">
                                </div>
                    <!-- <div class="mb-3 col-md-12 form-group">
                    <label class="form-label">Upload photo</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,/application" class="dropify" data-height="80" data-default-file="<?php //echo $off['image']?>"/>
                    </div> -->
                    <div class="mb-3 col-md-12">
                    <label class="form-label">Offer Description</label>
                    <textarea name="description" id="description"  class="summernote" rows="4" id="comment"
                        required=""></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Offer</button>
                </div>
            </div>
        </div>
        </form>

    </div>
</div>
</div>
<!-- end of edit modal  -->

<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>
   $(document).on("click",".update_faq_modal",function(){
   var data_id = $(this).attr('data-id');
   
   $("#update_faq_"+data_id).modal('show');
   });

   // Add Offer
   $(document).on('submit', '#frmblock', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
      url         : '<?= base_url('HoteladminController/add_offer') ?>',
      method      : 'POST',
      data        : form_data,
      processData : false,
      contentType : false,
      cache       : false,
      success     : function(res) {
            $.get('<?= base_url('HoteladminController/offerList');?>', function (data) {
                  var resu = $(data).find('.table-scrollable').html();
                  $('.table-scrollable').html(resu);
                  setTimeout(function () {
                     $('#example1').DataTable();
                  }, 2000);
            });
            if(res == 1)
            {
               setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".update_login_modal").modal('hide');
                  $(".update_login_modal").on("hidden.bs.modal", function () {
                    $("#frmblock").trigger("reset"); // reset the form fields
                  });
                  $('.summernote').summernote('reset');

                  $(".successmessage1").show();
               }, 2000);
               setTimeout(function(){  
                     $(".successmessage1").hide();
               }, 4000);
            }
            else
            {
               setTimeout(function(){  
               $(".loader_block").hide();
               $(".update_login_modal").modal('hide');
               $(".update_login_modal").on("hidden.bs.modal", function () {
                    $("#frmblock").trigger("reset"); // reset the form fields
                  });
                  $('.summernote').summernote('reset');
               $(".append_data").html(res);
               $(".successmessage").show();
               }, 2000);
               setTimeout(function(){  
                  $(".successmessage").hide();
               }, 4000);
            }
         }
      });
   });

   // Fetch Edit Data
   $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                url: '<?= base_url('HoteladminController/getofferdata') ?>',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                    
                    console.log(data);
                    $('#offer_id').val(data.offer_id);
                    $('#offer_name').val(data.offer_name);
                    $('#inputState option[value="' + data.offer_for + '"]').prop('selected', true);
                    $('#amt_in_per').val(data.amt_in_per);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    $('#description').summernote('code', data.description);
                    $("#img").attr('src',data.image);
                }
                }); 
            })
        }); 

   // Update Offer
   $(document).on('submit', '#frmupdateblock', function(e){
   e.preventDefault();
   $(".loader_block").show();
   var form_data = new FormData(this);
   $.ajax({
   url         : '<?= base_url('HoteladminController/edit_offer') ?>',
   method      : 'POST',
   data        : form_data,
   processData : false,
   contentType : false,
   cache       : false,
   success     : function(res) {
      $.get('<?= base_url('HoteladminController/offerList');?>', function (data) {
            var resu = $(data).find('.table-scrollable').html();
            $('.table-scrollable').html(resu);
            setTimeout(function () {
               $('#example1').DataTable();
            }, 2000);
      });

     setTimeout(function(){  
      $(".loader_block").hide();
      $(".update_offer_modal").modal('hide');
      $(".append_data").html(res);
       $(".updatemessage").show();
       }, 2000);
      setTimeout(function(){  
         $(".updatemessage").hide();
       }, 4000);
    
   }
   });
   });

   // delete Offer script
   $(document).on('click', '#delete_data', function (event) {
    event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Offer!",
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
                    url: '<?= base_url('HoteladminController/delete_offer') ?>',
                    method: "POST",
                    data: { id: id },
                    dataType: "html",
                    success: function (data) {
                        swal("Deleted!", "Your Offer has been deleted!", "success");
                        $.get('<?= base_url('HoteladminController/offerList');?>', function (data) {
                            var resu = $(data).find('.table-scrollable').html();
                            $('.table-scrollable').html(resu);
                            setTimeout(function () {
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
                    "Your Offer is safe!",
                    "error"
                );
            }
        });
    });

    
</script>
