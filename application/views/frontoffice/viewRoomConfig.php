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

  .demo1 {
   /* color:green; */
   font-size: smaller;
   margin-left: -12px;
   position: absolute;
   margin-top: -9px;
   }
   .dropify-wrapper {
   height: 84px;
   }
   .form-control:disabled, .form-control[readonly] {
   background-color: white;
   }
   .room_card {
   height: 239px;
   box-shadow: 0 10px 20px rgba(0, 0, 0, .19), 0 6px 6px rgba(0, 0, 0, .23) !important;
   border-radius: 20px;
   margin-bottom: 1.875rem;
   background-color: #fff;
   transition: all .5s ease-in-out;
   position: relative;
   border: 0rem solid transparent;
   border-radius: 0.75rem;
   box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgb(82 63 105 / 5%);
   /* height: calc(100% - 30px); */
   }
   #example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
   {
   padding:0px;
   }
   .overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0);
   transition: background 0.5s ease;
   }
   .demo:hover .overlay {
   display: block;
   background: rgba(0, 0, 0, .3);
   }
   .demo .button {
   position: absolute;
   /* width: 270px; */
   left: 27%;
   top: 111px;
   text-align: center;
   opacity: 0;
   transition: opacity .35s ease;
   }
   .demo .button a {
   /* width: 200px; */
   padding: 12px 48px;
   text-align: center;
   color: white;
   border: solid 2px white;
   z-index: 1;
   }
   .demo:hover .button {
   opacity: 1;
   }
   .icon_table_list .container-fluid{
      padding:0px
   }
    </style>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Room Configuration</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Room Configuration</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>Room Configuration</header>
                    </div>
                    <div class="card-body ">

                        
                        <?php
                if ($this->session->flashdata('msg')) {
                ?>
                    <div class="alert alert-info" id="a" role="alert" style="margin-top: 10px; background-color: #71C56C;">
                        <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                <?php
                }
            ?>
                <div class="m-4">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php
                          
                            

                            $u_id = $this->session->userdata('u_id');
                            $where ='(u_id = "'.$u_id.'")';
                            $admin_details = $this->MainModel->getData($tbl ='register', $where);
                            $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                            $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                            
                                $admin_id = $admin_details['hotel_id'];
                            if($room_type)
                            {
                                foreach($room_type as $r_m)
                                {
                                    $total_rooms = $this->FrontofficeModel->get_total_room_count($admin_id,$r_m['room_type_id']);
                        ?>
                                    <div class="col">

                                                
                                              
                                                

                                        <div class="room_card">
                                            <div class="demo">
                                                <img src="<?php echo $r_m['images']?>"
                                                    class="card-img-top" alt="..." height="151px;">
                                                <div class="card-body" style="position:unset !important">
                                                    <div class="overlay" ></div>
                                                    <div class="button" style="top:41px"><a href="#" data-bs-toggle="modal"
                                                            data-bs-target=".bd-example-modal-xl_<?php echo $r_m['room_type_id']?>"> Add </a>
                                                        </div>
                                                        <div class="button ">

                                                            <a href="<?php echo base_url('FrontofficeController/view_config/'.$r_m['room_type_id'])?>" class="btn btn-secondary shadow btn-xs sharp me-1" >View
                                                                        </a>
                                                        </div>
                                                    <h4><?php echo $r_m['room_type_name']?></h4>
                                                    <h6>Total Rooms: <?php echo $total_rooms[0]['total_room']?></h6>
                                                </div>
                                                <!-- <div class="card-footer">
                                            <small class="text-muted">Last updated 5 mins ago</small>
                                            </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- add mmodel -->
               <div class="modal fade bd-example-modal-xl_<?php echo $r_m['room_type_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Add Room</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                           </button>
                        </div>
                        <div class="modal-body">
                           <form action="<?php echo base_url('FrontofficeController/add_room')?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="mb-3 col-md-3 form-group">
                                    <label class="form-label">Select Floor No.</label>
                                    <select id="inputState" name="floor_id" class="default-select form-control wide" required>
                                       <option value data-isdefault="true">Choose...</option>
                                       <?php
                                          if($floor_list)
                                          {
                                              foreach($floor_list as $f_l)
                                              {
                                          ?>
                                       <option value="<?php echo $f_l['floor_id']?>"><?php echo $f_l['floor']?></option>
                                       <?php
                                          }
                                          }
                                          ?>
                                    </select>
                                 </div>
                                 <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Room No.</label>
                                    <input type="text" name="room_no" class="form-control" id="add_room_no" data-role="tagsinput" required="">
                                 </div>
                                 <div class="mb-3 col-md-3 form-group">
                                    <label class="form-label">Type of room</label>
                                    <input type="hidden" name="room_type" value="<?php echo $r_m['room_type_id']?>" class="form-control" placeholder="">
                                    <input type="text" value="<?php echo $r_m['room_type_name']?>" class="form-control" placeholder="" readonly>
                                    <!-- <select id="inputState" class="default-select form-control wide" style="display: none;">
                                       <option selected="">Choose...</option>
                                       <option>Single Room</option>
                                       <option>Double Room</option>
                                       <option>Deluxe Room </option>
                                       <option>Duplex Room </option>
                                       </select> -->
                                 </div>
                                 <div class="mb-3 col-md-3 form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" value="<?php echo $r_m['price']?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="mb-3 col-md-9 form-group">
                                    <label class="form-label">Facilties</label>
                                    <!-- Add a unique identifier to the input box for targeting -->
                                    <input type="text" name="facility" id="facility-input" class="form-control" placeholder="" data-role="tagsinput" required="">

                                 </div>
                                 <div class="mb-3 col-md-12 form-group">
                                    <label class="form-label">Room Details</label>
                                    <textarea class="summernote" name="room_details" rows="4" id="comment" required=""></textarea>
                                    <!-- <textarea class="form-control" rows="4" id="comment" required></textarea> -->
                                 </div>
                                 <!-- <div class="mb-3 col-md-6 form-group">
                                    <label class="form-label">Upload Photos</label>
                                    <input name="images[]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" multiple="multiple" />
                                 </div> -->
                                 <div class="text-center">
                                    <!-- <button type="submit" class="btn btn-info" id="toastr-warning-top-right">Add
                                       Room</button> -->
                                    <button type="submit" class="btn btn-info">Add
                                    Room</button>
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <!--/. add mmodel  -->
                        <?php
                                }
                            }
                        ?>
                       
                    </div>
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
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="facility_name" class="form-control" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->
        <!-- room-id -->
        <!-- view model -->
        <div class="modal fade bd-view-modal <?php echo $r_m['room_type_id'] ?? '' ?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">View Configuration</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body view_Room_Id">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        
                       
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>

$(document).on('click', '.room_id', function(){
       
        //$(".loader_block").show();
        // var id = $(this).attr('room-id');
        // console.log(id);
        
     
       
        // console.log(id);
        // return false;
        $.ajax({
            url         : '<?= base_url('FrontofficeController/viewRoomConfig') ?>',
            method      : 'POST',
            data        : {room_type: id,},
            
            success     : function(res) {
                console.log(res);

                $('.view_Room_Id').html(res);

                // setTimeout(function(){  
                //  $(".loader_block").hide();
                //  $(".add_facility_modal").modal('hide');
                //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);
                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
               
            }
            
        });
    });
</script>

<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $("#frmblock")[0].reset();
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
            url         : '<?= base_url('HomeController/update_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });
</script>
<script>
       $(document).ready(function() {
    // Initialize the tagsinput plugin on the input element
    $("#add_room_no").tagsinput();

    // Capture the keypress event on the input element
    $("#add_room_no").on("keypress", function(event) {
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
</script>



