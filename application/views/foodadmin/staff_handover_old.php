<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Staff Handover</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Staff Handover</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success status_handover" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Handover Changed Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="headingtitle">Pending Staff Handover</span></header>
               </div>
               <div class="card-body">
                  <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                     <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#handover_pending_div" data-bs-toggle="tab" class="active">Pending Handover</a>
                           </li>
                           <li class="nav-item"><a href="#handover_completed_div" data-bs-toggle="tab">Completed Handover</a>
                           </li>
                        </ul>
                     </header>
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane active" id="handover_pending_div">
                        <div class="table-scrollable">
                           <table id="handover_manage_pending" class="display full-width">
                              <thead>
                                 <tr>
                                    <th><strong>Sr.no.</strong></th>
                                    <th><strong> Name <br>
                                       (Created by)</strong>
                                    </th>
                                    <th><strong>Description</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th><strong> Time </strong></th>
                                    <th><strong>Reassign</strong></th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php 
                                    if(!empty($pending))
                                    {
                                        $i=1;
                                        foreach($pending as $pen)
                                        {
                                            $where ='(u_id="'.$pen['create_staff_id'].'")';
                                           
                                            $user_d = $this->FoodAdminModel->getData($tbl='register',$where);
                                            // echo "<pre>";
                                            // print_r($user_d);die;
                                            if(!empty($user_d))
                                            {
                                                $uname = $user_d['full_name'];
                                            }
                                            else
                                            {
                                                $uname ='';
                                            }
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i;?></strong></td>
                                    <td><?php echo $uname;?></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $pen['staff_handover_id']?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($pen['date']));?></td>
                                    <td><?php echo date('h:i A', strtotime($pen['time']));?></td>
                                    <td>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                          id="reassign_data" data-bs-toggle="modal" data-id1="<?php echo $pen['staff_handover_id']?>" 
                                          data-bs-target=".update_reassign_staff_modal"><i class="fa fa-share"></i></a>
                                    </td>
                                 </tr>
                                 <div class="modal fade" id="exampleModalCenter_<?php echo $pen['staff_handover_id']?>" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                                <?php echo $pen['description']?>
                                             </p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    $i++;
                                    }
                                    }
                                    
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="tab-pane" id="handover_completed_div">
                        <div class="table-scrollable1">
                           <table id="handover_manage_completed" class="display full-width">
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
                              <tbody class="append_data1">
                                 <?php 
                                    if(!empty($completed))
                                    {
                                        $i=1;
                                        foreach($completed as $com)
                                        {
                                            //created user name
                                            $wh ='(u_id="'.$com['create_staff_id'].'")';
                                            $user_d = $this->FoodAdminModel->getData($tbl='register',$wh);  
                                            //print_r($user_d);                                                       
                                            if(!empty($user_d))
                                            {
                                                $uname = $user_d['full_name'];                                                  
                                            }
                                            else
                                            {
                                                $uname ='';
                                            }
                                           
                                    
                                            //completed user name
                                            $admin_id = $this->session->userdata('u_id');
                                    
                                            $wh_admin = '(u_id ="'.$admin_id.'")';
                                            $user_com = $this->FoodAdminModel->getData('register',$wh_admin);
                                          
                                            // $wh2 ='(u_id="'.$com['completed_staff_id'].'")';
                                            // $user_com = $this->HouseKeepingModel->getData($tbl='register',$wh2);  
                                            // print_r($user_com);die;                                                     
                                            if(!empty($user_com))
                                            {
                                                $c_uname = $user_com['full_name'];                                                  
                                            }
                                            else
                                            {
                                                $c_uname ='';
                                            }
                                            
                                            
                                    ?>
                                 <tr>
                                    <td><strong><?php echo $i;?></strong></td>
                                    <td><?php echo $uname?></td>
                                    <td><?php echo date('d-m-Y', strtotime($com['date']));?>
                                       <sub><?php echo date('h:i A', strtotime($com['time']));?></sub>
                                    </td>
                                    <td><?php echo  $c_uname?></td>
                                    <td><?php echo date('d-m-Y', strtotime($com['complete_date']));?>
                                       <sub><?php echo date('h:i A', strtotime($com['complete_time']));?></sub>
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $com['staff_handover_id']?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <?php 
                                       if($com['is_complete'] == 1) 
                                       {
                                       ?>
                                    <td>
                                       <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-outline-success">complete</a>
                                    </td>
                                    <?php
                                       }
                                       ?>
                                 </tr>
                                 <div class="modal fade" id="exampleModalCenter_<?php echo $com['staff_handover_id']?>" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                                <?php echo $com['description']?>
                                             </p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    $i++;
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
<div class="modal fade update_reassign_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Re-assign To Staff</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="frmupdateblock1" method="POST" enctype="multipart/form-data">
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <!-- <label class="form-label">Re-assign To Staff</label> -->
                        <!-- <select id="send_user"   name="is_complete"
                           class="default-select form-control wide" required>
                           <option value ="">Choose...</option>
                           <option value="1">Complete</option>
                           
                           </select> -->
                        <input type="hidden" name="staff_handover_id"  id="staff_handover_id">
                        <input type="hidden" name="create_staff_id"  id="create_staff_id">
                        <select id="status" name="staff_u_id" class="default-select form-control wide" >
                           <option value ="">Choose...</option>
                           <?php
                              $admin_id = $this->session->userdata('u_id');
                              
                              $wh_admin = '(u_id ="'.$admin_id.'")';
                              $get_hotel_id = $this->FoodAdminModel->getData('register',$wh_admin);
                              $hotel_id = $get_hotel_id['hotel_id']; 
                              
                              $where = '(user_type = 8 AND hotel_id ="'.$hotel_id.'" )';
                              $staff_details = $this->FoodAdminModel->getAllData1($tbl = 'register', $where);
                              
                              foreach ($staff_details as $d) {
                              ?>
                           <option value="<?php echo $d["u_id"]; ?>"><?php echo $d["full_name"]; ?></option>
                           <?php
                              }
                              ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="card-footer" >
                  <div class="text-center ">
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
<!-- edit modal close -->
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
<!-- add service modal  -->
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).ready(function() {
     $('#handover_manage_pending').DataTable();
     $('#handover_manage_completed').DataTable();
    
     $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';
   
                // Update the title based on the tab ID
                if (tabId === '#handover_pending_div') {
                 
                    
                  
                    $('.headingtitle').text('Pending Staff Handover');
                }   else if (tabId === '#handover_completed_div') {
                   
                    
                    $('.headingtitle').text('Completed Staff Handover');
                }
   
              
            });
        });
   
     
   
   });
   
   
   
</script>
<script>
   $('#send_user').on('change', function() {
          
          if (this.value == 1) {
           
             
              $('#status').prop('required', true);
            }
        
    });
</script>
<script>
   $(document).ready(function (id) {
              $(document).on('click','#reassign_data',function(){
                  var id = $(this).attr('data-id1');
               //    alert(id);
                  $.ajax({
                                            url: '<?= base_url('HomeController/getreassigndata') ?>',
                                              type: "post",
                                            data: {id:id},
                                            dataType:"json",
                                            success: function (data) {
                                               
                                               console.log(data);
                                               $('#staff_handover_id').val(data.staff_handover_id);
                                               $('#create_staff_id').val(data.create_staff_id);
                                               
                                            }
                                
                                            
                            }); 
   })
   });
   $(document).on('submit', '#frmupdateblock1', function(e){
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
             url         : '<?php echo base_url('HomeController/reassign_status') ?>',
             type      : 'POST',
             data        : form_data,
             processData : false,
             contentType : false,
             cache       : false,
             success     : function(res) {
               $.get( '<?= base_url('handover_staff');?>', function( data ) {
                 var resu2 = $(data).find('#handover_pending_div').html();
                 var resu3 = $(data).find('#handover_completed_div').html();
                   
                       $('#handover_pending_div').html(resu2);
                       $('#handover_completed_div').html(resu3);
                       setTimeout(function(){
                       
                           $('#handover_manage_pending').DataTable();
                           $('#handover_manage_completed').DataTable();
                         },2000);
                 });
              
                 setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".update_reassign_staff_modal").modal('hide');
                  $(".update_reassign_staff_modal").on("hidden.bs.modal", function () {
                  $("#frmupdateblock1")[0].reset(); // reset the form fields
                  
                });
                $('a[href="#handover_completed_div"]').tab('show');
                  $(".status_handover").show();
                
                }, 2000);
                   setTimeout(function(){  
                     $(".status_handover").hide();
                   }, 4000);
             }
            
         });
      });     
</script>     
                
      
               
                 
                                            
                                             
                                             
                                              
      