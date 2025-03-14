<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<style>
   .hand_over_page .container-fluid{
      padding:0px
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Handover</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Handover</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Handover Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Handover Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Pending Handover</header>
                  <!-- <div class="tools">
                     <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                     <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                     <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div> -->
               </div>
               <div class="card-body ">
                  <div class="row">
                     <!-- <div class="col-md-4"> -->
                     <div class="col-md-12 col-sm-12">
                        <div class="panel tab-border card-box">
                           <header class="panel-heading panel-heading-gray custom-tab">
                              <ul class="nav nav-tabs">
                                 <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Pending Handover</a>
                                 </li>
                                 <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Completed Handover</a>
                                 </li>
                              </ul>
                           </header>
                        </div>
                     </div>
                     <div class="col d-flex justify-content-end">
                        <button id="addRow1" class="btn btn-info add_facility">
                        Add Handover
                        </button>  
                     </div>
                  </div>
                  <div class="tab-content">
                     <!-- accept -->
                     <div class="tab-pane" style="background-color:white;" id="arrival2_div">
                        <div class="row">
                           <div class="table-scrollable hand_over_page">
                              <table id="acceptedOrder_tb" class="display full-width">
                                 <thead>
                                    <tr>
                                       <th>Sr.no.</th>
                                       <th> Name <br>
                                          (Created by)
                                       </th>
                                       <th>Date</th>
                                       <th> Time</th>
                                       <th>Name <br>
                                          (Completed by)
                                       </th>
                                       <th>Description</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $i = 1;
                                        foreach($completed_handover as $row){
                                           //created user name
                                       $wh ='(u_id="'.$row['create_manager_id'].'")';
                                       $user_d = $this->MainModel->getData($tbl='register',$wh);  
                                       // print_r($row);                                                       
                                       if(!empty($user_d))
                                       {
                                          $uname = $user_d['full_name'];                                                  
                                       }
                                       else
                                       {
                                          $uname ='';
                                       }
                                       //created user date & time
                                       $wh1 ='(create_manager_id="'.$user_d['u_id'].'" )';
                                       $user_d1 = $this->MainModel->getData($tbl='handover_manger',$wh1);                                                         
                                       if(!empty($user_d1))
                                       {
                                          $date = $user_d1['date'];
                                         
                                          $time = date('h:i A', strtotime($user_d1['time']));
                                       }
                                       else
                                       {
                                          $date = '';
                                          $time = '';
                                       }
                                       // print_r($user_d1);exit;
                                       //completed user name
                                       $wh2 ='(u_id="'.$row['completed_manger_id'].'")';
                                       $user_com = $this->MainModel->getData($tbl='register',$wh2);  
                                       //print_r($user_d);                                                       
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
                                       <td><?php echo $i++?></td>
                                       <td><?php echo  $uname ?></td>
                                       <td>
                                          <h5>
                                             <?php echo date('d-m-Y',strtotime($row['date'])) ?>
                                       </td>
                                       <td> <?php echo $row['time'] ?></h5></td>
                                       <td><?php echo $c_uname;?></td>
                                       <!-- <td><?php echo date('d-m-Y',strtotime($row['date']))?><b> | </b> <?php echo date('h-i A',strtotime($row['time']));?></td> -->
                                       <td>
                                          <a href="#"
                                             class="btn btn-secondary shadow btn-xs sharp me-1"
                                             data-bs-toggle="modal"
                                             data-bs-target="#exampleModalCenter_<?php echo $row['m_handover_id'];?>"><i
                                             class="fa fa-eye"></i></a>
                                          <div class="modal fade" id="exampleModalCenter_<?php echo $row['m_handover_id'];?>" style="display: none;" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered " role="document">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h5 class="modal-title">Description</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <div class="mb-1">
                                                         <!-- <b><?php echo $name;?>( <?php echo $row['date'];?> / <?php echo $row['time'];?> )</b> -->
                                                         <p>
                                                            <?php echo $row['description'];?>
                                                         </p>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <!-- modal for order status  -->
                                       </td>
                                       <?php 
                                          if($row['is_complete'] == 1) 
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
                                    <div class="modal fade" id="edit_<?php echo $row['m_handover_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog  modal-dialog-centered  modal-md">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Handover Status </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <form action="<?php echo base_url('MainController/update_completed_handover');?>" method="post" enctype="multipart/form-data">
                                                   <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>"> 
                                                   <div class="basic-form">
                                                      <div class="row">
                                                         <div class="mb-3 col-md-12">
                                                            <label class="form-label">Change Status</label>

                                                            <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>">
                                                            <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id'];?>" onchange="change_status_1(<?php echo $row['m_handover_id']?>);">
                                                               <option <?php if($row['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                                                               <option <?php if($row['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
                                                            </select>
                                                         </div>
                                                         <div class="mb-3 col-md-12">
                                                            <label class="form-label">Description</label>
                                                            <!-- <textarea class="form-control" row="7"
                                                               placeholder="enter description"></textarea> -->
                                                            <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>
                                                         </div>
                                                      </div>
                                                      <div class="card-footer">
                                                         <div class="text-center">
                                                            <button type="submit" class="btn btn-primary css_btn"
                                                               >Update</button>
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
                                    <?php
                                      
                                        }
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
                        <div class="table-scrollable hand_over_page">
                           <table id="example1" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.no.</th>
                                    <th> Name <br>
                                       (Created by)
                                    </th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th> Time</th>
                                    <!-- <th><strong> Name <br>
                                       (Completed by)</strong></th> -->
                                    <!-- <th><strong> Time & Date</strong></th> -->
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody class="append_data1">
                                 <?php
                                    $i = 1;
                                     foreach($pending_handover as $row){
                                       $wh = '(u_id = "'.$row['create_manager_id'].'")';
                                       $get = $this->MainModel->getData('register',$wh);
                                       if(!empty($get))
                                       {
                                         $name = $get['full_name'];
                                    
                                       }
                                       else
                                       {
                                         $name = "-";
                                       }
                                       
                                       ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++;  ?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo  $name ?></h5>
                                    </td>
                                    <td>
                                       <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleModalCenter_<?php echo $row['m_handover_id'];?>"><i
                                          class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                       <h5><?php echo date('d-m-Y',strtotime($row['date']))?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo date('h-i A',strtotime($row['time']));?></h5>
                                    </td>
                                    <!-- <td>Vijay Sharma</td>
                                       <td>24-01-22 Wednesday</td> -->
                                    <td>
                                       <!-- <a href="javascript:void(0)"
                                          class="badge badge-rounded badge-danger">Pending</a> -->
                                       <a class="badge badge-danger" data-bs-toggle="modal"
                                          data-bs-target="#edit_" id="edit_data" 
                                          data-id="<?php echo $row['m_handover_id'] ?>">
                                       Pending </a></h5>
                                    </td>
                                 </tr>
                                 <div class="modal fade" id="exampleModalCenter_<?php echo $row['m_handover_id'];?>" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="mb-1">
                                                <p>
                                                   <?php echo $row['description'];?>
                                                </p>
                                             </div>
                                             <!-- <div class="mb-1">
                                                <b>Ajay Shqarma ( 11-10-2021 / 02:30AM )</b>
                                                
                                                <p>
                                                    Handover to Vijay sharma of food and bevergaes departments order
                                                </p>
                                                </div> -->
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn light" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- modal for order status  -->
                                 <div class="modal fade update_modal" id="edit_" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered  modal-md">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Handover Status </h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <form id="change_status" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="m_handover_id" id="m_handover_id"> 
                                                <div class="basic-form">
                                                   <div class="row">
                                                      <div class="mb-3 col-md-12">
                                                         <label class="form-label">Change Status</label>
                                                         <input type="hidden" name="m_handover_id" id="m_handover_id1" >
                                                         <select class="default-select form-control wide" name="is_complete">
                                                            <option value="0" selected>Pending</option>
                                                            <option value="1">Completed</option>
                                                         </select>
                                                         <!-- </select> -->
                                                      </div>
                                                      <div class="mb-3 col-md-12">
                                                         <label class="form-label">Description</label>
                                                         <textarea class="summernote" name="description"  id="description" style="min-height: 400px;"></textarea>
                                                      </div>
                                                   </div>
                                                   <div class="card-footer">
                                                      <div class="text-center">
                                                         <button type="submit" class="btn btn-primary css_btn"
                                                            >Update</button>
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
                                 <?php 
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
   <!-- add btn modal  -->
   <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <form id="frmblock"  method="post" enctype="multipart/form-data">
               <div class="modal-header">
                  <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Create Handover</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <div class="modal-body">
                  <?php 
                     $u_id= $this->session->userdata('u_id');
                     $where ='(u_id = "'.$u_id.'")';
                     $admin_details = $this->MainModel->getData($tbl ='register', $where);
                     
                     $admin_id = $admin_details['hotel_id'];
                     $u_id11 = $admin_details['u_id'];
                         if(!empty($admin_details))
                         {
                            $uname = $admin_details['full_name'];
                         }
                     ?> 
                  <div class="row">
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Name</label>
                        <small>(Created by)</small>
                        <input type="text" name="name" value="<?php echo $uname?>" class="form-control" placeholder="Enter Name" readonly>
                     </div>
                     <div class=" col-md-6 mb-3 form-group">
                        <label class="form-label">Date</label>
                        <input type="date"  name ="date"   id="session-date" class="form-control" placeholder="" required>
                     </div>
                     <div class="col-md-6 mb-3 form-group">
                        <label class="form-label">Time</label>
                        <input type="time" name="time" id="time" class="form-control" placeholder="" required>
                     </div>
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label"> Description</label>
                        <!-- <textarea class="summernote" rows="3" id="comment" required=""></textarea> -->
                        <!-- <textarea class="summernote" name="description"  id="description" value="" style="min-height: 400px;"></textarea> -->
                        <textarea class="summernote" name="description" id="description1"  style="min-height: 400px;"></textarea>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
<!-- end add btn modal -->
<!-- modal for order status  -->
<!-- <div class="modal fade update_modal" id="edit_<?php echo $row['m_handover_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered  modal-md">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Handover Status </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="change_status" method="post" enctype="multipart/form-data">
               <input type="hidden" name=" " id="m_handover_id" > 
               <div class="basic-form">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Change Status</label> -->
                        <!-- <select id="typeop" onchange="show_typewise()"
                           class="default-select form-control wide">
                           <option selected disabled>Pending</option>
                           <option value="1">Complated</option>
                           
                           
                           
                           </select> -->
                        <!-- <input type="hidden" name="m_handover_id" id="m_handover_id<?php echo $row['m_handover_id'];?>" value="<?php echo $row['m_handover_id'];?>">
                        <select class="default-select form-control wide" name="is_complete" id="active<?php echo $row['m_handover_id'];?>">
                           <option <?php if($row['is_complete']=="0") {echo "Selected";}?> value="0" selected>Pending</option>
                           <option <?php if($row['is_complete']=="1") {echo "Selected";}?> value="1">Completed</option>
                        </select> -->
                        <!-- </select> -->
                     <!-- </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label> -->
                        <!-- <textarea class="form-control" row="7"
                           placeholder="enter description"></textarea> -->
                        <!-- <textarea class="summernote" name="description"  id="description" value="<?php echo $row['description']; ?>" style="min-height: 400px;"></textarea>
                     </div>
                  </div>
                  <div class="card-footer">
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary css_btn"
                           >Update</button>
                        <button type="button" class="btn btn-light css_btn"
                           data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div> -->
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
<script>
   $(document).on('click','#data_edit',function(){
            var id = $(this).attr('data-id1');
         //    alert(id);
            $.ajax({
                                      url: '<?= base_url('FrontofficeController/gethandoverData') ?>',
                                        type: "post",
                                      data: {id:id},
                                      dataType:"json",
                                      success: function (data) {
                                         
                                         console.log(data);
                                         
                                         $('#lost_id').val(data.id);
                                        // $('#id').val(data.u_id);
                                       
                                       
                                        
   
                                      }
                          
                                      
                                      }); 
        })
   </script>
<script>
   
   $(document).ready(function() {
           $('#acceptedOrder_tb').DataTable();
          
      } );
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
              url         : '<?= base_url('FrontofficeController/add_pending_handover') ?>',
              method      : 'POST',
              data        : form_data,
              processData : false,
              contentType : false,
              cache       : false,
              success     : function(res) {
               $.get( '<?=base_url('FrontofficeController/ajax_handover');?>', function( data ) {
                  var resu = $(data).find('#arrival2_div').html();
                  var resu1 = $(data).find('#arrival1_div').html();
                     
                     $('#arrival2_div').html(resu);
                     $('#arrival1_div').html(resu1);
                     setTimeout(function(){
                        $('#acceptedOrder_tb').DataTable();
                        $('#example1').DataTable();
                     }, 2000);
                   });
                  setTimeout(function(){  
                   $(".loader_block").hide();
                   $("#frmblock")[0].reset();
                   $('#description1').summernote('reset');
                   $(".add_facility_modal").modal('hide');
                   $(".append_data1").html(res);
                  //  location.reload();
                    $(".successmessage").show();
                    }, 2000);
                   setTimeout(function(){  
                      $(".successmessage").hide();
                    }, 4000);
                 
              }
          });
      });
      $(document).on('submit', '#change_status', function(e){
          e.preventDefault();
          $(".loader_block").show();
          var form_data = new FormData(this);
         //  console.log(form_data);
          $.ajax({
              url         : '<?= base_url('FrontofficeController/update_pending_handover') ?>',
              method      : 'POST',
              data        : form_data,
              processData : false,
              contentType : false,
              cache       : false,
              success     : function(res) {
               //  console.log(res);
               $(".update_modal").modal('hide');
               $.get( '<?=base_url('FrontofficeController/ajax_handover');?>', function( data ) {
                  var resu = $(data).find('#arrival2_div').html();
                  var resu1 = $(data).find('#arrival1_div').html();
                     
                     $('#arrival2_div').html(resu);
                     $('#arrival1_div').html(resu1);
                     setTimeout(function(){
                        $('#acceptedOrder_tb').DataTable();
                        $('#example1').DataTable();
                     }, 2000);
                  $('a[href="#arrival2_div"]').tab('show');
              });
                  setTimeout(function(){  
                   $(".loader_block").hide();
                   $(".append_data1").html(res);
                    $(".updatemessage").show();
                    }, 2000);
                  //   location.reload();
                   setTimeout(function(){  
                      $(".updatemessage").hide();
                    }, 4000);
                 
              }
          });
      });
      $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/gethandover') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                            console.log(data.m_handover_id)
                                          //   $('.description_view').html(data.description);

                                             $('#m_handover_id').val(data.m_handover_id);
                                             $('#m_handover_id1').val(data.m_handover_id);
                                          //    $('#email').val(data.email);
                                          //    $('#agency_name').val(data.agency_name);
                                          //    $('#phone').val(data.phone);
                                             $('#description').summernote('code', data.description);
                                          }
                              
                                          
                                          }); 
            })
        });
</script>