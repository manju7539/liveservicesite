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
               <div class="page-title">Staff Handover</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">Staff Handover</li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="page_header_title11">All Pending Handover</span></header>
               </div>
               <div class="card-body ">
                  <div class="col-md-12 col-sm-12">
                     <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                           <ul class="nav nav-tabs">
                              <li class="nav-item"><a href="#new_orders_div" data-bs-toggle="tab" class="active">Pending Handover</a>
                              </li>
                              <li class="nav-item"><a href="#accepted_orders_div" data-bs-toggle="tab">Completed Handover</a>
                              </li>
                           </ul>
                        </header>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <form method="POST">
                              <div class="input-group">
                                 <input type="text" name="date" class="form-control wide"
                                 placeholder="Date" onfocus="(this.type = 'date')"
                                 id="date" required>
                                 <select id="inputState" name="staff_id"
                                    class="default-select form-control wide"
                                    >
                                    <option selected disabled>Created By
                                    </option>
                                    <?php
                                       $admin_id = $this->session->userdata('u_id');
                                       $wh_sh = 'hotel_id = "' . $admin_id . '" AND (user_type = 8 or user_type = 9)';
                                       $all_staff = $this->HotelAdminModel->getAllData('register', $wh_sh);
                                       foreach ($all_staff as $a_s) 
                                                {
                                                               ?>
                                    <option value="<?php echo $a_s["u_id"];?>"><?php echo $a_s["full_name"];?></option>
                                    <?php
                                       }
                                       ?>
                                 </select>
                                 <button name="search" type="submit" class="btn btn-warning  btn-sm ">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane active" style="background-color:white;" id="new_orders_div">
                        <div class="table-scrollable">
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong> Name <br>
                                       (Created by)</strong>
                                    </th>
                                    <th><strong>Description</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong> Time </strong></th>
                                    <th><strong> Status</strong></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $i = 1;
                                    if($staff_pending_list)
                                    {
                                        foreach($staff_pending_list as $s_pen)
                                        {
                                            $wh = '(u_id = "'.$s_pen['create_staff_id'].'")';
                                    
                                            $create_manager_data = $this->MainModel->getData('register',$wh);
                                    
                                            $creator_full_name = "";
                                    
                                            if($create_manager_data)
                                            {
                                                $creator_full_name = $create_manager_data['full_name'];
                                            }
                                    
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i++?></strong></td>
                                    <td><?php echo $creator_full_name ?></td>
                                    <td>
                                       <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $s_pen['staff_handover_id'] ?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- decription -->
                                    <div class="modal fade" id="exampleModalCenter_<?php echo $s_pen['staff_handover_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="mb-1">
                                                   <?php echo $s_pen['description'] ?>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- /. -->
                                    <td><?php echo date('d-m-Y',strtotime($s_pen['created_at'])) ?> </td>
                                    <td><?php echo date('h:i a',strtotime($s_pen['created_at'])) ?> </td>
                                    <td>
                                       <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-outline-warning">Pending</a>
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
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong> Name <br>
                                       (Created by)</strong>
                                    </th>
                                    <th><strong>Date & Time</strong></th>
                                    <th><strong> Name <br>
                                       (Completed by)</strong>
                                    </th>
                                    <th><strong> Date & Time </strong></th>
                                    <th><strong>Description</strong></th>
                                    <th><strong> Status</strong></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $i = 1;
                                    if($staff_complete_list)
                                    {
                                        foreach($staff_complete_list as $s_com)
                                        { 
                                            $wh = '(u_id = "'.$s_com['create_staff_id'].'")';
                                    
                                            $create_manager_data = $this->MainModel->getData('register',$wh);
                                    
                                            $creator_full_name = "";
                                    
                                            if($create_manager_data)
                                            {
                                                $creator_full_name = $create_manager_data['full_name'];
                                            }
                                    
                                            $wh1 = '(u_id = "'.$s_com['completed_staff_id'].'")';
                                    
                                            $completed_manger_data = $this->MainModel->getData('register',$wh1);
                                    
                                            $completor_full_name = "";
                                            
                                            if($completed_manger_data)
                                            {
                                                $completor_full_name = $completed_manger_data['full_name'];
                                            }
                                    
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i++?></strong></td>
                                    <td><?php echo $creator_full_name ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($s_com['date']))." ".date('h:i a',strtotime($s_com['time'])) ?></td>
                                    <td><?php echo $completor_full_name ?></td>
                                    <td><?php echo date('d-m-Y',strtotime($s_com['complete_date']))." ".date('h:i a',strtotime($s_com['complete_time'])) ?></td>
                                    <td>
                                       <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter1_<?php echo $s_com['staff_handover_id'] ?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <div class="modal fade" id="exampleModalCenter1_<?php echo $s_com['staff_handover_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="mb-1">
                                                   <?php echo $s_com['description'] ?>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <td>
                                       <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-outline-success">complete</a>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
   
   } );
   var selectedOrderserviceurl = '';
   $('#orderserviceDropdownNew').change(function () {
     
       var selected_orderservice = $(this).val();
      
       if(selected_orderservice == 'new_orders')
       {
           $('.page_header_title11').text('All Pending Handover');
           $('.new_orders_div').css('display','block');
           $('.accepted_orders_div').css('display','none');
          
       }
       if(selected_orderservice == 'accepted_order')
       {
           $('.page_header_title11').text('All Completed Handover');
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
                   $('.page_header_title11').text('All Pending Handover ');
               } else if (tabId === '#accepted_orders_div') {
                   $('.page_header_title11').text('All Completed Handover ');
               } 
   
               // $('.headingtitle').text(title);
           });
       });
</script>