<style>
   #example1_wrapper, #acceptedOrder_tb_wrapper, #completedOrder_tb_wrapper, #rejectedOrder_tb_wrapper
   {
      padding:0px;
   }
   .compalint_management .container-fluid{
      padding:0px
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Order Complaint Management</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Order Complaint Management</li>
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
                  <header><span class="page_header_title11">Open Complaints</span></header>
               </div>
               <div class="card-body">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">Open Complaints</a>
                              </li>
                              <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Closed Complaints</a>
                              </li>
                           </ul>
                        </header>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane active" style="background-color:white;" id="new_orders_div">
                        <div class="table-scrollable compalint_management">
                           <table id="newOrder_tb" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Order Description</strong></th>
                                    <th><strong>Detail Issue</strong></th>
                                    <th><strong>Photo</strong></th>
                                    <th><strong>Status</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="abc">
                                 <?php
                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $cm)
                                        {
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i++?></strong></td>
                                    <td>
                                       <?php echo $cm['complaint_for'] ?>
                                    </td>
                                    <td>
                                       <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-outline-danger"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $cm['complaint_id'] ?>"><i
                                          class="fa fa-eye">View </i></a>
                                    </td>
                                    <!-- view modal -->
                                    <div class="modal fade" id="exampleModalCenter_<?php echo $cm['complaint_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Order Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="basic-form">
                                                   <form class="form-valide-with-icon needs-validation" novalidate="">
                                                      <div class="mb-3">
                                                         <p><?php echo $cm['order_description'] ?></p>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /. -->
                                    <td>
                                       <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter1_<?php echo $cm['complaint_id'] ?>"><i
                                          class="fa fa-comments"></i></a>
                                    </td>
                                    <!-- details issue  -->
                                    <div class="modal fade" id="exampleModalCenter1_<?php echo $cm['complaint_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Write in detail about issue</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="basic-form">
                                                   <form class="form-valide-with-icon needs-validation" novalidate="">
                                                      <div class="mb-3">
                                                         <p><?php echo $cm['issue_details'] ?></p>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /. details issue  -->
                                    <td>
                                       <div class="lightgallery"
                                          class="room-list-bx  align-items-center">
                                          <a href="<?php echo $cm['image'] ?>" target="_blank"
                                             data-exthumbimage="<?php echo $cm['image'] ?>"
                                             data-src="<?php echo $cm['image'] ?>"
                                             class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                          <img class="me-3 "
                                             src="<?php echo $cm['image'] ?>"
                                             alt="" style="width:50px;">
                                          </a>
                                       </div>
                                    </td>
                                    <input type="hidden" name="user_id" id="uid<?php echo $cm['complaint_id'];?>" value="<?php echo $cm['complaint_id'];?>">
                                    <td>
                                       <!-- <b class="text-success">Open</b> -->
                                       <select onchange="change_status(<?php echo $cm['complaint_id']?>)" id="status<?php echo $cm['complaint_id']?>"
                                          class="default-select form-control wide">
                                          <option <?php if($cm['complaint_status'] == 0){echo "Selected";}?> value="0">Pending</option>
                                          <option <?php if($cm['complaint_status'] == 1){echo "Selected";}?> value="1">Solved</option>
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
                        <div class="table-scrollable compalint_management">
                           <table id="acceptedOrder_tb" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong>Services</strong></th>
                                    <th><strong>Order Description</strong></th>
                                    <th><strong>Detail Issue</strong></th>
                                    <th><strong>Photo</strong></th>
                                    <th><strong>Status</strong></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $i = 1;
                                    if($list1)
                                    {
                                        foreach($list1 as $cm)
                                        {
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i++?></strong></td>
                                    <td>
                                       <?php echo $cm['complaint_for'] ?>
                                    </td>
                                    <td>
                                       <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-outline-danger"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $cm['complaint_id'] ?>"><i
                                          class="fa fa-eye">View </i></a>
                                    </td>
                                    <!-- view -->
                                    <div class="modal fade" id="exampleModalCenter_<?php echo $cm['complaint_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Order Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="basic-form">
                                                   <form class="form-valide-with-icon needs-validation" novalidate="">
                                                      <div class="mb-3">
                                                         <p><?php echo $cm['order_description'] ?></p>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /. view -->
                                    <td>
                                       <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter1_<?php echo $cm['complaint_id'] ?>"><i
                                          class="fa fa-comments"></i></a>
                                    </td>
                                    <!-- details issue  -->
                                    <div class="modal fade" id="exampleModalCenter1_<?php echo $cm['complaint_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Write in detail about issue</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="basic-form">
                                                   <form class="form-valide-with-icon needs-validation" novalidate="">
                                                      <div class="mb-3">
                                                         <p><?php echo $cm['issue_details'] ?></p>
                                                      </div>
                                                   </form>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /. details issue  -->
                                    <td>
                                       <div class="lightgallery"
                                          class="room-list-bx  align-items-center">
                                          <a href="<?php echo $cm['image'] ?>" target="_blank"
                                             data-exthumbimage="<?php echo $cm['image'] ?>"
                                             data-src="<?php echo $cm['image'] ?>"
                                             class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                          <img class="me-3 "
                                             src="<?php echo $cm['image'] ?>"
                                             alt="" style="width:50px;">
                                          </a>
                                       </div>
                                    </td>
                                    <td>
                                       <b class="text-warning" style="color:red!important;">closed</b>
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
         <!-- <p>loader 3</p> -->
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
       $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
   
   } );
   var selectedOrderserviceurl = '';
   $('#orderserviceDropdownNew').change(function () {
     
       var selected_orderservice = $(this).val();
      
       if(selected_orderservice == 'new_orders')
       {
           $('.page_header_title11').text('Open Complaints');
           $('.new_orders_div').css('display','block');
           $('.accepted_orders_div').css('display','none');
          
       }
       if(selected_orderservice == 'accepted_order')
       {
           $('.page_header_title11').text('All Closed Complaints');
           $('.accepted_orders_div').css('display','block');
           $('.new_orders_div').css('display','none');
          
       }  
   });
</script>
<script>
   $(document).ready(function() {
           $('.nav-tabs a').on('click', function() {
               var tabId = $(this).attr('href'); // Get the ID of the clicked tab
               // var title = '';
   
               // Update the title based on the tab ID
               if (tabId === '#new_orders_div') {
                   $('.page_header_title11').text('Open Complaints');
               } else if (tabId === '#accepted_orders_div') {
                   $('.page_header_title11').text('Closed Complaints');
               } 
   
               // $('.headingtitle').text(title);
           });
       });
</script>
<script>
     function change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#status'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
               //  alert(uid);

              if (status != '') {

                  $.ajax({
                      url: base_url + "HoteladminController/order_complaints_status",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                        $.get( '<?= base_url('HoteladminController/order_complaints');?>', function( data ) {
                    var resu = $(data).find('#new_orders_div').html();
                    var resu1 = $(data).find('#accepted_orders_div').html();
                    $('#new_orders_div').html(resu);
                    $('#accepted_orders_div').html(resu1);

                    setTimeout(function(){
                        $('#newOrder_tb').DataTable();
                        $('#acceptedOrder_tb').DataTable();
                    },2000);
                    });
                    setTimeout(function(){  
                    $(".loader_block").hide();
                    $('a[href="#accepted_orders_div"]').tab('show');
                  
                    $(".status_completed").show();
                    // $(".abc").html(res);
                
                    }, 2000);
                    setTimeout(function(){  
                        $(".status_completed").hide();
                    }, 4000);
                      }
                  });
              }
          }
</script>