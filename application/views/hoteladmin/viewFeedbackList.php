<!-- start page content -->
<style>
   .feed_backlist .container-fluid{
   padding:0px
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Feedback</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Feedback</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of Feedback</header>
               </div>
               <div class="card-body ">
                  <div class="row mb-3">
                     <div class="col-md-4">
                        <form method="POST">
                           <div class="input-group">
                              <input type="text" name="date" class="form-control wide"
                                 placeholder="Feedback Date" onfocus="(this.type = 'date')"
                                 id="date" required>
                              <select id="inputState" name="review_for" class="default-select form-control wide"
                                 required>
                                 <option selected="" disabled>Choose Service...</option>
                                 <option value="3">Room service</option>
                                 <option value="2">Front-office</option>
                                 <option value="4">Food service</option>
                                 <option value="5">housekeeping service</option>
                              </select>
                              <button type="submit" name="search" class="btn btn-warning  btn-sm "><i
                                 class="fa fa-search"></i></button>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="table-scrollable feed_backlist">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.no.</strong></th>
                              <th><strong>Date</strong></th>
                              <th><strong>Guest Name</strong></th>
                              <!-- <th><strong> Room No.</strong></th> -->
                              <th><strong>Rate Our Service</strong></th>
                              <th><strong>Rating</strong></th>
                              <th><strong>Description</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $i = 1;
                              if($list)
                              {
                                  foreach($list as $feed)
                                  {
                                      if($feed['review_for'] == 1)
                                      {
                                          $review_for = "Hotel Admin";
                                      }
                                      else
                                      {
                                          if($feed['review_for'] == 2)
                                          {
                                              $review_for = "Front office";
                                          }
                                          else
                                          {
                                              if($feed['review_for'] == 3)
                                              {
                                                  $review_for = "House keeping";
                                              }
                                              else
                                              {
                                                  if($feed['review_for'] == 4)
                                                  {
                                                      $review_for = "Room Service";
                                                  }
                                                  else
                                                  {
                                                      if($feed['review_for'] == 5)
                                                      {
                                                          $review_for = "Food and beverage";
                                                      }
                                                  }
                                              }
                                          }
                                      }
                              
                              ?>
                           <tr>
                              <td><strong><?php echo $i++ ?></strong></td>
                              <td><?php echo date('d-m-Y', strtotime($feed['rating_date'])); ?></td>
                              <td><?php echo $feed['full_name'] ?></td>
                              <!-- <td>303</td> -->
                              <td><?php echo $review_for ?></td>
                              <td>
                                 <div class="d-flex flex-wrap">
                                    <div class="start_block">
                                       <ul class="stars">
                                          <?php 
                                             if($feed['rating'] != 0)
                                             {
                                                 for($x = 1; $x <= $feed['rating']; $x++)
                                                 {
                                                     ?>
                                          <a href="javascript:void(0);"><i class="fa fa-star "></i></a>
                                          <?php 
                                             }
                                             ?>
                                          <span> <b>(<?php echo round($feed['rating'],2)?>)</b></span>
                                          <?php 
                                             }
                                             else {
                                                 ?>
                                          <p>No Rating</p>
                                          <?php 
                                             }
                                             ?>
                                       </ul>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <a style="margin:auto" data-bs-toggle="modal" data-bs-target=".bd-terms-modal-sm_<?php echo $feed['review_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                              </td>
                              <td>
                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $feed['review_id']?>" ><i class="fa fa-trash"></i></a>
                              </td>
                           </tr>
                           <div class="modal fade bd-terms-modal-sm_<?php echo $feed['review_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Description</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <span><?php echo $feed['review'] ?></span>
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
<script>

    // Delete Feedback Script
   $(document).on('click', '#delete_data', function (event) {
         event.preventDefault(); // Prevent the default behavior of the form submit button

         var id = $(this).attr('delete-id');
         swal({
               title: "Are you sure?",
               text: "You will not be able to recover this Feedback!",
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
                     url: '<?= base_url('HoteladminController/delete_feedback') ?>',
                     method: "POST",
                     data: { id: id },
                     dataType: "html",
                     success: function (data) {
                           swal("Deleted!", "Feedback has been deleted!", "success");
                           $.get( '<?= base_url('HoteladminController/feedbackList');?>', function( data ) {
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
                        "Feedback is safe!",
                        "error"
                  );
               }
         });
      });

</script>