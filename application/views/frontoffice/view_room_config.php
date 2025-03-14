<?php //echo "<pre>"; print_r($list);exit;?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
   .bootstrap-tagsinput {
   margin: 0;
   width: 100%;
   padding: 0.5rem 0.75rem 0;
   font-size: 1rem;
   line-height: 1.25;
   transition: border-color 0.15s ease-in-out;
   border: 1px solid #ccc;
   }
   .bootstrap-tagsinput.has-focus {
   background-color: #fff;
   border-color: #5cb3fd;
   }
   .bootstrap-tagsinput .label-info {
   display: inline-block;
   background-color: #636c72;
   /* padding: 0 0.em 0.15em; */
   border-radius: 0.25rem;
   margin-bottom: 0.4em;
   color: #fff;
   font-size: 20px;
   }
   .bootstrap-tagsinput input {
   margin-bottom: 0.5em;
   border: none;
   outline: none;
   }
   .bootstrap-tagsinput .tag [data-role="remove"]:after {
   content: "\00d7";
   }
   .input-group {
   display: flex;
   align-items: center;
   margin-bottom: 10px;
   }
   .text-entry {
   flex: 1;
   padding: 5px;
   }
   .remove-icon {
   margin-left: 10px;
   padding: 5px 10px;
   cursor: pointer;
   background-color: #f44336;
   color: white;
   border: none;
   border-radius: 5px;
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">View Configuration</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">View Configuration</li>
            </ol>
         </div>
         <?php
            if ($this->session->flashdata('msg')) {
            ?>
         <div class="alert alert-info" id="a" role="alert" style="margin-top: 10px; background-color: #71C56C;">
            <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
         </div>
         <?php
            }
            ?>
      </div>
      <h3 class="text-center"> <?php echo $room_type_data['room_type_name']?> </h3>
      <?php
         if($list)
         {  
         // $admin_id = $this->session->userdata('admin_id');
             $u_id= $this->session->userdata('u_id');
             $where ='(u_id = "'.$u_id.'")';
             $admin_details = $this->MainModel->getData($tbl ='register', $where);
             
            
             $admin_id = $admin_details['hotel_id'];
         $i=1;
         
             foreach($list as $r_c)
             {
                $i++;
         $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                 
         $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);
         
         $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
         
         ?>
      <div class="card">
         <div class="card-body">
         <div class="table-scrollable">
            <div class="row">
               <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                  <div class="card-body p-4">
                  <img src="<?php echo $room_type_data['images'];?>" class="img-fluid" alt="" >
                     
                  </div>
               </div>
               <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                  <div class="product-detail-content">
                     <div class="new-arrival-content pr">
                        <p class="fs-16"><strong>Description</strong></p>
                        :&nbsp;&nbsp;
                        <p class="text-content">
                           <?php echo $r_c['room_details']?>
                        </p>
                        <p class="fs-16 mt-4"><strong>Type of Room:</strong> <span
                           class="item fw-500 fs-14"> <?php echo $room_type_data['room_type_name']?></span></p>
                        <div class="d-flex flex-wrap">
                           <div class="mt-4 check-status">
                              <p class="d-block mb-2 fs-16"><strong>Room No.</strong></p>
                              <div class="d-flex">
                                 <?php
                                    if($room_number)
                                    {
                                        foreach($room_number as $rn)
                                        {
                                    ?>
                                 <div class="view_room_card">
                                    <div class="room_card card red">
                                       <span class="room_no "><?php echo $rn['room_no']?></span>
                                    </div>
                                 </div>
                                 <?php
                                    }
                                    }
                                    ?>
                              </div>
                              <div class="mt-4 ms-3">
                                 <p class="d-block mb-2 text-black fs-16"><strong>Price</strong></p>
                                 <span class="font-w500 fs-24 text-black">
                                    <div class="d-table mb-2 mt-2">
                                       <p class="price float-start d-block">Rs <?php echo $r_c['price']?></p>
                                       <!-- <p class=""><strong>20% off</strong></p> -->
                                    </div>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="d-flex align-items-end flex-wrap mt-4">
                           <div class="filtaring-area me-3">
                              <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p>
                           </div>
                        </div>
                        <div class="facilities">
                           <?php
                              if($room_facility)
                              {
                                  foreach($room_facility as $rf)
                                  {
                              ?>
                           <!-- <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p> -->
                           <a href="javascript:void(0);" class="btn btn-secondary light">
                           <?php echo $rf['room_facility']?>
                           </a>
                           <?php
                              }
                              }
                              ?>
                        </div>
                        <div class="shopping-cart  mb-2 me-3">
                           <div class="d-flex" style="float:right">
                              <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_roomconfig_data" 
                                 data-id="<?= $r_c['room_configure_id']?>" data-bs-target=".update_roomconfig_modal">
                              <i class="fa fa-pencil"></i></a> 
                              <!-- <a href="#"
                                 class="btn btn-danger btn sweet-confirm shadow btn-xs sharp delete"><i
                                     class="fa fa-trash"></i></a> -->
                              <a href="#" id="delete_<?php echo $r_c['room_configure_id']; ?>"
                                 class="btn btn-danger shadow btn-xs sharp"><i
                                 class="fa fa-trash"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <?php
         }
         }
         else
         {
         echo '<h6 class="not_found">Data Not Found</h6>';
         }
         ?>
   </div>
</div>
<?php
   if($list)
   {  
   // $admin_id = $this->session->userdata('admin_id');
       $u_id= $this->session->userdata('u_id');
       $where ='(u_id = "'.$u_id.'")';
       $admin_details = $this->MainModel->getData($tbl ='register', $where);
       
      
       $admin_id = $admin_details['hotel_id'];
   
       foreach($list as $r_c)
       {
   $room_imgs = $this->MainModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
           
   $room_facility = $this->MainModel->get_room_facility($admin_id,$r_c['room_configure_id']);
   
   $room_number = $this->MainModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
           
   ?>
<!-- Modal -->
<div class="modal fade update_roomconfig_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Room</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form action="<?php echo base_url('FrontofficeController/update_room')?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="room_configure_id" id="room_configure_id">
                  <div class="row">
                     <div class="mb-3 col-md-3 form-group">
                        <label class="form-label">Select Floor No.</label>
                        <input type="hidden" name="floor_id" id="edit_floor_id">
                        <input type="number" class="form-control" id="edit_floor" name="floor" readonly>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Room No.</label>
                        <input type="text" name="room_no" data-role="tagsinput"
                           class="form-control" id="edit_room_no">
                     </div>
                     <div class="mb-3 col-md-3 form-group">
                        <label class="form-label">Type of room</label>
                        <input type="hidden" name="room_type" id="room_type" class="form-control" placeholder="">
                        <input type="text" class="form-control" id="edit_room_type_name" name="room_type_name" readonly>
                     </div>
                     <div class="mb-3 col-md-3 form-group">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" id="roomconfigureprice" name="price" readonly>
                     </div>
                     <div class="mb-3 col-md-9 form-group">
                        <label class="form-label">Facilties</label>
                        <input type="text"  data-role="tagsinput" id="edit_facility"  name="facility" class="form-control">
                     </div>
      
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Room Details</label>
                       <textarea  name="description" class="summernote" id="description" rows="4" ></textarea>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-info">Update
                        Room</button>
                        <button type="button" class="btn btn-light"
                           data-bs-dismiss="modal">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end of modal  -->
<?php
   }
   }
   ?>
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
<!-- <script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js') ?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>var jq = jQuery.noConflict();</script>
<script>
   <?php
      foreach($list as $r_c)  { ?>
        document.getElementById('delete_<?php echo $r_c['room_configure_id']; ?>').onclick = function() {
        var id = $("#<?php echo $r_c['room_configure_id']; ?>").val();
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
              if (isConfirm) {
                  $.ajax({
                      url: '<?php echo base_url().'FrontofficeController/delete_room_config/'.$r_c['room_configure_id']; ?>',
                      type: "POST",
                      data: {
                          id: id
                      },
                      dataType: "HTML",
                      success: function() {
                          swal(
                                  "Deleted!",
                                  "Your file has been deleted!",
                                  "success"
                              ),
                              $('.confirm').click(function() {
                                  location.reload();
                              });
                      },
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
   <?php } ?>   
</script>
<script>
      $(document).ready(function(){
      (function($){
    


         $(document).ready(function (id) {
       $(document).on('click','#edit_roomconfig_data',function(){
          var id = $(this).attr('data-id');
          // alert(id);
          $.ajax({
                url: '<?= base_url('FrontofficeController/getEditRoomConfigData') ?>',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                   console.log(data.room_details);
                   $('#edit_room_no').tagsinput('removeAll');
                   $('#edit_facility').tagsinput('removeAll');
                  // Add the room numbers to the tagsinput
                  if (data.room_number) {
                        data.room_number.forEach(function (room) {
                            $('#edit_room_no').tagsinput('add', room.room_no);
                        });
                   }
                   if (data.room_facility) {
                        data.room_facility.forEach(function (facility) {
                            $('#edit_facility').tagsinput('add', facility.room_facility);
                        });
                   }
   
                   $('#room_configure_id').val(data.room_configure_id);
                   $('#edit_floor_id').val(data.floor_id);
                   $('#edit_floor').val(data.floor.floor);
                   $('#room_type').val(data.room_type);
                   $('#edit_room_type_name').val(data.room_name.room_type_name);
                   $('#roomconfigureprice').val(data.price);
                   $('#description').summernote('code', data.room_details);
                }
          }); 
       });
    }); 
   
    $(document).ready(function() {
   // Initialize the tagsinput plugin on the input element
   $("#edit_room_no").tagsinput();
   
   // Capture the keypress event on the input element
   $("#edit_room_no").on("keypress", function(event) {
      // Check if the pressed key is either the space key (key code 32) or the enter key (key code 13)
      if (event.which === 32 || event.which === 13) {
          event.preventDefault(); // Prevent the default space key or enter key behavior (e.g., scrolling down)
   
          // Get the current value of the input element
          const inputValue = $(this).val();
   
          // Trim leading and trailing spaces and check if the value is not empty
          if (inputValue.trim() !== "") {
              // Check if the tag already exists
              const tags = $(this).tagsinput('items');
              if (tags.includes(inputValue.trim())) {
                  // Tag already exists, clear the input element
                  $(this).val('');
              } else {
                  // Add the tag to the tagsinput
                  $(this).tagsinput('add', inputValue.trim());
   
                  // Clear the input element after adding the tag
                  $(this).val('');
              }
          }
      }
   });
   });



})(jq);
    });
   </script>