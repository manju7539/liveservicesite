
<!DOCTYPE html>
<html lang="en">


<head>

   
    <style>
   

    .room_card {

        border-radius: 5px;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px !important;
        margin: 6px;
        height: 50px;
        width: 60px;
        border: 2px solid #09bad9;
    }

    .room_no {
        font-weight: 700;
        color: black;
        text-align: center;
        padding-top: 14px;
        padding-bottom: 14px;
    }

    .red {
   background-color: #35c0f0;
   border: 1px solid #35c0f0;
   }


   .blue {
   background-color: #7cc142;
   border: 1px solid #7cc142;
   }
   .yellow {
   background-color: #a9ada6;
   border: 1px solid #a9ada6;
   }
   .main_rm {
   background-color: #ec1c24;
   border: 1px solid #ec1c24;
  
   }
   .room_no {
   font-weight: 700;
   color: white;
   text-align: center;
   padding-top: 14px;
   padding-bottom: 14px;
   }

    </style>
</head>
<body>
<div class="page-content-wrapper">

<div class="page-content">
   <div class="page-bar">
      <div class="page-title-breadcrumb">
         <div class=" pull-left">
            <div class="page-title">Room Status</div>
         </div>
         <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
               href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Room Status</li>
         </ol>
      </div>
   </div>
   <div class="alert alert-success successmessage" role="alert"  style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Room Status Changed Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
     <!-- for room section  -->
     <div class="row" style="--bs-gutter-x: 13px;">
                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-0 flex-wrap">
                                                <h3 class="card-title">C/Out/Dirty Rooms</h3>
                                            </div>
                                            <div class="card-body" id="dirty_new_room_div">

                                                <div class="row row-cols-8 append_data">
                                                    <?php 
                                                        if(!empty($get_dirty_rooms))
                                                        {
                                                            foreach($get_dirty_rooms as $g)
                                                            {
                                                                //$wh = '("'.$g[''].'")'
                                                    ?>
                                                    <div class="room_card card red open_model" data-bs-toggle="modal" id="edit_data"
                                                    data-id="<?php echo  $g['room_status_id']?>" data-bs-target=".add_dirty_modal">
                                                        
                                                        <span class="room_no "><?php echo $g['room_no']?></span>
                                                    </div>
                                                   
                                                    <?php 
                                                            }
                                                        }
                                                    ?>
                                                    
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-0 flex-wrap">
                                                <h3 class="card-title ">Occupied Rooms</h3>
                                            </div>
                                            <div class="card-body" id="accupied_room_div">
                                                <div class="row row-cols-8 ">
                                                    <?php 
                                                        if(!empty($get_accupied_rooms))
                                                        {
                                                            foreach($get_accupied_rooms as $a)
                                                            {
  
                                                    ?>
                                                    <div class="room_card card blue">
                                                        <span class="room_no "><?php echo $a['room_no']?></span>
                                                    </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-0 flex-wrap">
                                                <h3 class="card-title">Available Guest</h3>
                                            </div>
                                            <div class="card-body" id="available_room_div">
                                                <div class="row row-cols-8 ">
                                                    <?php 
                                                        if(!empty($get_available_rooms))
                                                        {
                                                            foreach($get_available_rooms as $a_room)
                                                            {
                                                              
  
                                                    ?>
                                                    <div class="room_card card yellow">
                                                        <span class="room_no "><?php echo $a_room['room_no']?></span>
                                                    </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card card-rm">
                                            <div class="card-header border-0 flex-wrap">
                                                <h3 class="card-title">Under Maintenance Rooms</h3>
                                            </div>
                                            <div class="card-body" id="rejected_room_div">

                                                <div class="row row-cols-8 append_data1">
                                                    <?php 
                                                        if(!empty($get_under_maintenance_rooms))
                                                        {
                                                            foreach($get_under_maintenance_rooms as $u_room)
                                                            {
  
                                                    ?>
                                                    <div class="room_card card main_rm open_under_model" data-bs-toggle="modal" id="data_edit" 
                                                    data-id1="<?php echo $u_room['room_status_id']?>"
                                                        data-bs-target=".add_under_modal">
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $u_room['room_no']?></span>
                                                    </div>
                                                   
                                                       
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
<div class="modal fade add_under_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"> Under Maintenance Room:</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                        <form  id="frmblock3" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Room NO.</label>
                                                                                        <input type="text" name="room_no" id="room_no1" disabled class="form-control" placeholder="">
                                                                                    </div>
                                                                                
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <input type="hidden" name="room_status_id" id="room_status_id2">
                                                                                        <label class="form-label">Status</label>
                                                                                        <select id="inputState" name="room_status" class="default-select form-control wide" required>
                                                                                            <option value="" selected>Choose...</option>
                                                                                            <option value="3">Open For Guest</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="text-center">
                                                                                        <button type="submit" class="btn btn-primary css_btn" >Save</button>   
                                                                                        <button type="button" class="btn btn-light css_btn"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

<!-- end of modal  -->
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
<!-- add btn modal  -->
 <!-- Modal for checkout rooms-->
 <div class="modal fade add_dirty_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> C/Out/Dirty Room:</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="basic-form">
                                                                         <form  id="frmblock2" method="post" enctype="multipart/form-data">
                                                                         <div class="row">
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label class="form-label">Room NO.</label>
                                                                                    <input type="text" name="room_no" id="room_no" disabled class="form-control">
                                                                                </div>
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label class="form-label">Checkout Time</label>
                                                                                    <input type="#" disabled class="form-control" placeholder="10.00AM">
                                                                                </div>
                                                                                <input type="hidden" name="room_status_id" id="room_status_id1" >
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label class="form-label">Status</label>
                                                                                    <select id="inputState" name="room_status" class="default-select form-control wide" required>
                                                                                        <option value="" selected>Choose</option>
                                                                                        <option value="3">Open For Guest</option>
                                                                                        <option value="4">Under Maintance</option>
                                                                                    </select>
                                                                                </div>         
                                                                                <div class="text-center">
                                                                                    <button type="submit" class="btn btn-primary css_btn">Save</button>    
                                                                                    <button type="button" class="btn btn-light css_btn"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end of checkout rooms modal  -->
                                                    
                                                       

                                                    </body>
                                                    </html>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).on("click",".open_model",function(){
       $(".add_dirty_modal").modal('show');
   });
   $(document).on('submit', '#frmblock2', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/dirty_room_sts_update') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
          
            $.get( '<?= base_url('RmStatus');?>', function( data ) {
                        var resu = $(data).find('#dirty_new_room_div').html();
                        var resu1 = $(data).find('#accupied_room_div').html();
                        var resu2 = $(data).find('#available_room_div').html();
                        var resu3 = $(data).find('#rejected_room_div').html();
                        $('#dirty_new_room_div').html(resu);
                        $('#accupied_room_div').html(resu1);
                        $('#available_room_div').html(resu2);
                        $('#rejected_room_div').html(resu3);
                
                });
              
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_dirty_modal").modal('hide');
                $(".add_dirty_modal").on("hidden.bs.modal", function () {
                     $("#frmblock2")[0].reset(); // reset the form fields
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
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
            //    alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getdirtyData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#room_status_id1').val(data.room_status_id);
                                            $('#room_no').val(data.room_no);
                                            $('#check_time').val(data.check_time);
                                            $('#room_status').val(data.room_status);
                                          
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });
       $(document).ready(function (id) {
           $(document).on('click','#data_edit',function(){
               var id = $(this).attr('data-id1');
            //    alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/getdirtyData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('#room_status_id2').val(data.room_status_id);
                                            $('#room_no1').val(data.room_no);
                                         
                                          
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });


   
   </script>

<script>
   $(document).on("click",".open_under_model",function(){
       $(".add_under_modal").modal('show');
   });
  

   $(document).on('submit', '#frmblock3', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/under_maintainance_room_sts_update') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            $.get( '<?= base_url('RmStatus');?>', function( data ) {
                        var resu = $(data).find('#dirty_new_room_div').html();
                        var resu1 = $(data).find('#accupied_room_div').html();
                        var resu2 = $(data).find('#available_room_div').html();
                        var resu3 = $(data).find('#rejected_room_div').html();
                        $('#dirty_new_room_div').html(resu);
                        $('#accupied_room_div').html(resu1);
                        $('#available_room_div').html(resu2);
                        $('#rejected_room_div').html(resu3);
                
                });
                
          
              
               setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_under_modal").modal('hide');
                $(".append_data1").html(res);
                $(".add_under_modal").on("hidden.bs.modal", function () {
                     $("#frmblock3")[0].reset(); // reset the form fields
                  });
                 $(".successmessage").show();
                 }, 2000);
               setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
                
              
           }
       });
   });
   </script>
