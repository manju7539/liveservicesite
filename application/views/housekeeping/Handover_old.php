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
         <strong style="color:#fff ;margin-top:10px;">Handover Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Handover updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header><span class="headingtitle">Pending Handover</span></header>
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
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                                              <div class="row mb-3">
                                                <div class="col-md-12 card-body" style="padding-left:31px">
                                                    <form method="POST">
                                                        <div class="input-group">       
                                                                <input type="date" name="created_date" class="form-control" placeholder="2017-06-04"
                                                                    id="mdate" data-dtp="dtp_LG7pB" >
                                                                
 												<div class="new_css" style="border-radius: 5px;">
	
   												 <select class="form-control js-example-disabled-results" name="created_u_name" class="select2">
                                                                   
                                                    <option selected disabled>Choose</option>
                                                    <?php 
                                                    $wh_h = '(is_complete = 0 AND added_by = 2)';
                                                    $details = $this->HouseKeepingModel->getHandover_staff($tbl ='handover_manger',$wh_h);
                                                    foreach ($details as $d) 
                                                    {
                                                        $get_u_reg = '(u_id ="'.$d['create_manager_id'].'")';
                                                        $get_user_handover = $this->HouseKeepingModel->getData('register',$get_u_reg);
                                                        if(!empty($get_user_handover))
                                                        {
                                                           $user_name = $get_user_handover['full_name'];
                                                        }
                                                       
                                                    ?>
                                                        <option value="<?php echo $d["create_manager_id"];?>"><?php echo $user_name;?></option>
                                                                                                                       														 											
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                           </div>
                                                                
                                             <button name="search_1" type="submit" class="btn btn-warning  btn-sm"><i class="fa fa-search"></i></button>         
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button id="addRow1" class="btn btn-info add_handover">
                     Create Handover
                     </button>
                  </div>
                  </div>
   </div>
    </div></div>
    <div class="tab-content">
                  <div class="tab-pane active" id="handover_pending_div">
                     <div class="table-scrollable">
                        <table id="handover_manage_pending" class="display full-width">
                     <thead>
                                                <tr>
                                                    <th><strong>Sr.no.</strong></th>
                                                    <th><strong> Name <br>
                                                            (Created by)</strong></th>
                                                    <th><strong>Description</strong></th>
                                                    <th><strong>Date</strong></th>
                                                    <th><strong> Time </strong></th>
                                                    <th><strong> Status</strong></th>
                                                </tr>
                                            </thead>
                        <tbody class="append_data">
                        <?php 
                                                        if(!empty($pending))
                                                        {
                                                            $i=1;
                                                            foreach($pending as $pen)
                                                            {
                                                                $where ='(u_id="'.$pen['create_manager_id'].'")';
                                                                $user_d = $this->HouseKeepingModel->getData($tbl='register',$where);
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
                                                            data-bs-target="#exampleModalCenter_<?php echo $pen['m_handover_id']?>"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>
                                                    <td><?php echo $pen['date']?></td>                                  
                                                    <td><?php echo date('h:i A', strtotime($pen['time']));?></td>
                                                    
                                                    <?php 
                                                    
                                                        if($pen['is_complete'] == 0) 
                                                        {
                                                    ?>
                                                    <td>
                                                         <a class="badge badge-danger" data-bs-toggle="modal" id="edit_data"
                                                         data-id="<?php echo $pen['m_handover_id']?>" data-bs-target=".update_status_modal">
                                                           
                                                            Pending</a>
                                                    </td>
                                                    <?php

                                                        }
                                                    ?>                                                    
                                                </tr>
                                                <div class="modal fade" id="exampleModalCenter_<?php echo $pen['m_handover_id']?>" style="display: none;" aria-hidden="true">
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
                                                            (Created by)</strong></th>

                                                    <th><strong>Date & Time</strong></th>
                                                    <th><strong> Name <br>
                                                            (Completed by)</strong></th>
                                                    <th><strong> Date & Time </strong></th>
                                                    <th><strong>Description</strong></th>
                                                    <!-- <th><strong> Name <br>
                                                                    (Completed by)</strong></th> -->
                                                    <!-- <th><strong> Time & Date</strong></th> -->
                                                    <th><strong> Status</strong></th>
                                                    <!-- <th><strong>Action</strong></th> -->
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
                                                            $wh ='(u_id="'.$com['create_manager_id'].'")';
                                                            $user_d = $this->HouseKeepingModel->getData($tbl='register',$wh);  
                                                            //print_r($user_d);                                                       
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
                                                            $user_d1 = $this->HouseKeepingModel->getData($tbl='handover_manger',$wh1);                                                         
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

                                                            //completed user name
                                                            $wh2 ='(u_id="'.$com['completed_manger_id'].'")';
                                                            $user_com = $this->HouseKeepingModel->getData($tbl='register',$wh2);  
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
                                                    <td><strong><?php echo $i;?></strong></td>
                                                    <td><?php echo $uname?></td>

                                                    <td><?php echo $date."   ".$time?></td>
                                                    <td><?php echo $c_uname;?></td>
                                                    <td><?php echo $com['complete_date']."  ".date('h:i A', strtotime($com['complete_time']));?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalCenter_<?php echo $com['m_handover_id']?>"><i
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

                                                <div class="modal fade" id="exampleModalCenter_<?php echo $com['m_handover_id']?>" style="display: none;" aria-hidden="true">
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
</div>
 </div>
                                                   
  <!-- edit modal close -->
                                                  <!-- change handover status -->
                                                  <div class="modal fade update_status_modal"  aria-hidden="true">
                                                    <div class="modal-dialog  modal-dialog-centered"  role="document">
                                                        <div class="modal-content">
                                                        <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Handover Status </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="basic-form">
                                                                    <input type="hidden" name="m_handover_id" id="m_handover_id">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-md-12">
                                                                                <label class="form-label">Change Status</label>
                                                                                <select name="sts" id="sts" 
                                                                                    class="default-select form-control wide" required>
                                                                                    <option value ="">Choose...</option>
                                                                                    <!--<option value="0">Pending</option>-->
                                                                                    <option value="1">Completed</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="mb-3 col-md-12">
                                                                                <label class="form-label">Description</label>
                                                                                <textarea class="form-control summernote" row="7"
                                                                                    placeholder="enter description" name="desc" id="desc"></textarea>
                                                                            </div>
                                                                        </div>
                                                                   
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary css_btn">Update</button>
                                                                       
                                                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                         </form>
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
<!-- add service modal  -->

  <!-- add btn modal  -->
  <div class="modal fade add_handover_modal" tabindex="-1"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <form id="frmblock1" method="post" enctype='multipart/form-data'>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Handover</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">    
                                    <?php 
                                          $id = $this->session->userdata('u_id');
                                          $where = '(u_id ="'.$id.'")';
                                          $get_d = $this->HouseKeepingModel->getData($tbl ='register',$where);
                                          if(!empty($get_d))
                                          {
                                             $uname = $get_d['full_name'];
                                          }
                                    ?>                                
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Name</label>
                                                <small>(Created by)</small>
                                                <input type="text" name="name" value="<?php echo $uname?>" class="form-control" placeholder="Enter Name" readonly>
                                            </div>
                                            <div class=" col-md-3 mb-3 form-group">
                                                <label class="form-label">Date</label>

                                                <input type="date" name="date" class="form-control" required>
                                            </div>
                                            <div class="col-md-3 mb-3 form-group">
                                                <label class="form-label">Time</label>
                                                <input type="time" name="time" class="form-control" required>
                                            </div>
                                            <div class="mb-3 col-md-12 form-group">
                                                <label class="form-label"> Description</label>
                                                <textarea class="summernote" name="desc" rows="3" id="comment" required></textarea>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Add
                                Handover</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end add btn modal -->


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
                 
                    
                  
                    $('.headingtitle').text('Pending Handover');
                }   else if (tabId === '#handover_completed_div') {
                    $.get( '<?= base_url('Handover');?>', function( data ) {
                    var resu = $(data).find('#handover_completed_div').html();
                    $('#handover_completed_div').html(resu);
                    setTimeout(function(){
                        $('#handover_manage_completed').DataTable();
                    }, );
                });
                    
                    $('.headingtitle').text('Completed Handover');
                }
   
              
            });
        });
   
     
   
   });
   
   
   
</script>
<script>
   $(document).on("click",".add_handover",function(){
       $(".add_handover_modal").modal('show');
   
   
   $(document).on('submit', '#frmblock1', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/add_handover') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
              
                   $.get( '<?= base_url('Handover');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                  
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#handover_manage_pending').DataTable();
                   }, 2000);
               });
                   
                   
                   setTimeout(function(){  
                $(".loader_block").hide();
                $(".add_handover_modal").modal('hide');
                $(".add_handover_modal").on("hidden.bs.modal", function() {
                     $("#frmblock1")[0].reset(); // reset the form fields
                  });
                  $('#comment').summernote('reset');
                $(".append_data").html(res);
                 $(".successmessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".successmessage").hide();
                 }, 4000);
               }
              
              
           });
       });
    });
</script>
    <script>
       $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
            //    alert(id);
               $.ajax({
                                         url: '<?= base_url('HouseKeepingController/gethandoverData') ?>',
                                           type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            
                                            $('#m_handover_id').val(data.m_handover_id);
                                           // $('#id').val(data.u_id);
                                            $('#sts').val(data.sts);
                                        
                                           //  $('#File').val(data.File);
                                             $('#desc').summernote('code', data.desc);
                                          
                                           
   
                                         }
                             
                                         
                                         }); 
           })
       });
       $(document).on('submit', '#frmupdateblock', function(e){
           // alert('hi');die;
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('HouseKeepingController/update_hand_sts') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
               $.get( '<?= base_url('Handover');?>', function( data ) {
                   var resu = $(data).find('#handover_pending_div').html();
                   var resu1 = $(data).find('#handover_completed_div').html();
                  
                  
                   $('#handover_pending_div').html(resu);
                   $('#handover_completed_div').html(resu1);
                   setTimeout(function(){
                       $('#handover_manage_pending').DataTable();
                        $('#handover_manage_completed').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
               //  $(".updateFaq").modal('hide');
                $(".update_status_modal").modal('hide');
                // $(".append_data1").html(res);
                 $(".updatemessage").show();
             
                 var orderStatus = form_data.get('sts');
               //  console.log(requestStatus); // Log the requestStatus value to the console

                if (orderStatus === "1") {
                $('a[href="#handover_completed_div"]').tab('show');
                $('.headingtitle').text('Completed Handover');
                }
                 }, 2000);
                setTimeout(function(){  
                   $(".updatemessage").hide();
                 }, 4000);
              
           }
       });
   });
   
   
</script>


