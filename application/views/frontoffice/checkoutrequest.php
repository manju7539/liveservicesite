<style>
   #example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
   {
   padding:0px;
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">CheckOut Request</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success status_completed" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
        <strong style="color:#fff ;margin-top:10px;">Order Status Changed Successfully..!</strong>
        <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="page_header_title11">All Pending CheckOut Request</span></header>
               </div>
               <div class="card-body ">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">pending Request</a>
                              </li>
                              <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Accepted Request</a>
                              </li>
                              <li class="nav-item"><a href="#completed_orders_div" data-bs-toggle="tab">Completed Request</a>
                              </li>
                           </ul>
                        </header>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="input-group">
                              <input type="date" class="form-control"
                                 placeholder="2017-06-04" id="mdate"
                                 data-dtp="dtp_LG7pB">
                              <input type="text" class="form-control"
                                 placeholder="Created By" id="mdate"
                                 data-dtp="dtp_LG7pB">
                              <button class="btn btn-warning  btn-sm "><i
                                 class="fa fa-search"></i></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane active" style="background-color:white;" id="new_orders_div">
                        <div class="table-scrollable">
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Booking Id</th>
                                    <th>CheckIn</th>
                                    <th>CheckOut</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                                    $i=1;
                                    if(!empty($list)){
                                       foreach($list as $checkout_req)
                                       {
                                          // print_r($checkout_req);die;
                                    ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['full_name'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['mobile_no'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['email_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['booking_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['check_in'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req['check_out'] ?></h5>
                                    </td>
                                    <input type="hidden" name="user_id" id="checkout_request_id<?php echo $checkout_req['checkout_request_id'];?>" value="<?php echo $checkout_req['checkout_request_id'];?>">
                                    <td>
                                       <select class="form-control" name="status" id="checkout_status<?php echo $checkout_req['checkout_request_id'];?>" onchange="action_status(<?php echo $checkout_req['checkout_request_id']?>);" style="min-width:85px;text-align:center">
                                       <?php 
                                          if($checkout_req['request_status']=="0") 
                                          {
                                       ?>
                                          <option value="0" selected>New</option>
                                          <option value="1">Accepted</option>
                                       <?php 
                                          }
                                       ?>
                                       </select>
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
                     <div class="tab-pane" id="accepted_orders_div"  style="background-color:white;">
                        <div class="table-scrollable">
                           <table id="acceptedOrder_tb" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Booking Id</th>
                                    <th>CheckIn</th>
                                    <th>CheckOut</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody id="geeks">
                                 <?php
                                    $i=1;

                                    if(!empty($list1)){
                                       foreach($list1 as $checkout_req_accept)
                                       {
		   // echo "<pre>"; print_r($list1); echo "</pre>";die;
                                       
                                    ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['full_name'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['mobile_no'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['email_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['booking_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['check_in'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_accept['check_out'] ?></h5>
                                    </td>
                                    <input type="hidden" name="user_id" id="uid<?php echo $checkout_req_accept['checkout_request_id'];?>" value="<?php echo $checkout_req_accept['checkout_request_id'];?>">
                                    <td>
                                 
                                       <select class="form-control" name="status" id="status<?php echo $checkout_req_accept['checkout_request_id'];?>" onchange="change_status(<?php echo $checkout_req_accept['checkout_request_id']?>);" style="min-width:85px;text-align:center">
                                       <?php 
                                             if($checkout_req_accept['request_status']=="1") 
                                             {
                                       ?>
                                             <option value="1" selected>Accepted</option>
                                             <option value="2">Completed</option>
                                       <?php 
                                             }
                                       ?>
                                       </select>
                                    
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
                     <div class="tab-pane" id="completed_orders_div"  style="background-color:white;">
                        <div class="table-scrollable">
                           <table id="completeorder_tb" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Booking Id</th>
                                    <th>CheckIn</th>
                                    <th>CheckOut</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                                    $i=1;

                                    if(!empty($list2)){
                                       foreach($list2 as $checkout_req_reject)
                                       {
		   // echo "<pre>"; print_r($list1); echo "</pre>";die;
                                       
                                    ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['full_name'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['mobile_no'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['email_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['booking_id'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['check_in'] ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $checkout_req_reject['check_out'] ?></h5>
                                    </td>
                                   
                                    <td>
                                       <div class="badge badge-success">Completed</div>
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
   </div>
</div>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
       $('#completeorder_tb').DataTable();
       
   } );
   

    function change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#status'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
               //  alert(uid);

              if (status != '') {

                  $.ajax({
                      url: base_url + "FrontofficeController/change_status_of_checkout_request",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(res) {
                       
                        //   alert(data);
                        $.get( '<?= base_url('checkOutRequest');?>', function( data ) {
                           var resu = $(data).find('#new_orders_div').html();
                           var resu1 = $(data).find('#accepted_orders_div').html();
                           var resu2 = $(data).find('#completed_orders_div').html();
                           $('#new_orders_div').html(resu);
                           $('#accepted_orders_div').html(resu1);
                           $('#completed_orders_div').html(resu2);
                        setTimeout(function(){
                           $('#example1').DataTable();
                                 $('#acceptedOrder_tb').DataTable();
                                 $('#completeorder_tb').DataTable();
                        }, 2000);
                        });
                        setTimeout(function(){  
                        $(".loader_block").hide();
                        //  $(".update_staff_modal").modal('hide');
                        //  $(".append_data").html(res);
                           $(".status_completed").show();
                           }, 2000);
                           
                        setTimeout(function(){  
                           $(".status_completed").hide();
                           }, 4000);
                        $('a[href="#completed_orders_div"]').tab('show');

                          
                      }
                  });
              }
          }

   $(document).ready(function() {
           $('.nav-tabs a').on('click', function() {
               var tabId = $(this).attr('href'); // Get the ID of the clicked tab
               // var title = '';
   
               // Update the title based on the tab ID
               if (tabId === '#new_orders_div') {
                   $('.page_header_title11').text('All Pending CheckOut Request');
               } else if (tabId === '#accepted_orders_div') {
                   $('.page_header_title11').text('All Accepted CheckOut Request ');
               } else {
                  $('.page_header_title11').text('All Completed CheckOut Request ');

               }
   
           });
       });



       function action_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#checkout_status'+cnt).children("option:selected").val();
              var uid = $('#checkout_request_id'+cnt).val();
               //  alert(uid);
              if (status != '') {
                  $.ajax({
                      url: base_url + "FrontofficeController/checkout_action_change",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(res) {


                        $.get( '<?= base_url('checkOutRequest');?>', function( data ) {
                           var resu = $(data).find('#new_orders_div').html();
                           var resu1 = $(data).find('#accepted_orders_div').html();
                           var resu2 = $(data).find('#completed_orders_div').html();
                           $('#new_orders_div').html(resu);
                           $('#accepted_orders_div').html(resu1);
                           $('#completed_orders_div').html(resu2);
                           
                           setTimeout(function(){
                                 $('#example1').DataTable();
                                 $('#acceptedOrder_tb').DataTable();
                                 $('#completeorder_tb').DataTable();
                           }, 2000);
                        });
                        setTimeout(function(){  
                        $(".loader_block").hide();
                        $(".status_completed").show();
                       
                           setTimeout(function(){  
                              $(".status_completed").hide();
                              }, 4000);
                        }, 2000);
                       
                        $('a[href="#accepted_orders_div"]').tab('show');
                          


                        
                      }
                  });
              }
          }
          

</script>