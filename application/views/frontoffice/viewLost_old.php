<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Lost Department</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Lost & Found</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Lost/Found Item Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Lost/Found Item Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success completedmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Lost/Found Item Completed Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Lost & Found</header>
                  <div class="tools">
                     <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                     <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                     <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                  </div>
               </div>
               <div class="card-body ">
                  <div class="col-md-12 col-sm-12">
                     <!-- <div class="panel tab-border card-box"> -->
                     <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                           <li class="nav-item"><a href="#lost_pending_div" data-bs-toggle="tab" class="active">Pending List</a>
                           </li>
                           <li class="nav-item"><a href="#lost_completed_div" data-bs-toggle="tab">Completed List</a>
                           </li>
                        </ul>
                     </header>
                  
                  <br>
                  <div class="btn-group r-btn create_item add_item" >
                     <button id="addRow1" class="btn btn-info add_facility">
                     Create
                     </button>  
                  </div>
</div>
                  <div class="tab-content">
                     <div class="tab-pane active" id="lost_pending_div">
                        <div class="table-scrollable">
                           <table id="lost_manage_pending" class="display full-width">
                              <thead>
                                 <tr>
                                    <th>Sr.No.</th>
                                    <th>Room No</th>
                                    <th>Guest Name</th>
                                    <th>Contact No</th>
                                    <th> Lost /Found  Date</th>
                                    <th>Lost/Found time</th>
                                    <th>Type</th>
                                    <th>Item Name</th>
                                    <!-- <th>Found Item</th> -->
                                    <th>Image</th>
                                    <th style="width:5%">Description</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody class="append_data">
                                 <?php
                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $g_f_s)
                                        {
                                           if($g_f_s['lost_found_flag'] == 1)
                                           {
                                              $type="Lost Item ";
                                              
                                            }
                                           else{
                                            $type="Found Item ";
                                           }
                                           
                                           if($g_f_s['lost_found_flag'] == 1)
                                           {
                                              $item_name=$g_f_s['lost_item_name'];
                                              
                                            }
                                           elseif($g_f_s['lost_found_flag'] == 2)
                                           {
                                               $item_name =$g_f_s['found_item_name'] ;
                                           }
                                           else{
                                                   $item_name ="-";
                                           }
                                    
                                    
                                    
                                           
                                    ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['room_no'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['guest_name'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['contact_no'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['lost_found_date'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $g_f_s['lost_found_time'];?></h5>
                                    </td>
                                    <td>
                                       <h5><?php echo $type;?></h5>
                                    </td>
                                    <td>
                                       <h5> <?php echo  $item_name;?> </h5>
                                    </td>
                                    <!-- <td>
                                       <h5> <?php echo $g_f_s['found_item_name'];?> </h5>
                                       </td> -->
                                    <td>
                                       <div class="lightgallery">
                                          <a href="<?php echo $g_f_s['img'] ?>"
                                             data-exthumbimage="<?php echo $g_f_s['img'] ?>"
                                             data-src="<?php echo $g_f_s['img'] ?>"
                                             class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                          <img class="me-3 rounded"
                                             src="<?php echo $g_f_s['img'] ?>" alt=""
                                             style="width:80px; height:40px;">
                                          </a>
                                       </div>
                                    </td>
                                    <td>
                                    <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".exampleModalCenter"><i class="fa fa-eye"></i></a> 
                                       <!-- <a href="#"
                                          class="btn btn-secondary shadow btn-xs sharp me-1"
                                          data-bs-toggle="modal" id="edit_data" data-id="<?php echo $g_f_s['id'];?>" 
                                          data-bs-target="#"><i
                                          class="fa fa-eye"></i></a> -->
                                    </td>
                                    <td>
                                       <div class="d-flex">
                                          <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 
                                          <a href="#" id="delete" data-id="<?php echo $g_f_s['id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1 delete_lost">
                                          <i class="fa fa-trash "></i> </a>
                                       </div>
                                    </td>
                                    <td>
                                       <?php 
                                          if($g_f_s['is_complete'] == 0) 
                                          {
                                          ?>
                                       <a class="badge badge-danger" data-bs-toggle="modal" id="data_edit"
                                          data-id1="<?php echo $g_f_s['id']?>" data-bs-target=".update_status_modal">
                                       Pending</a>
                                       <?php
                                          }
                                          ?>         
                                    </td>
                                 </tr>
                                 <!-- modal for terms and conditions -->
                                 <div class="modal fade exampleModalCenter" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>
                                               
                                             </p>
                                             <span class="d-block mb-2 description_view"></span>
                                          </div>
                                          <div class="modal-footer">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- model end -->
                                 <!--dlt script start-->  
                      
                        <script>
                           $(document).on('click','.delete_lost',function(){
                           var id = $(this).attr('data-id');  
                           
                           var base_url='<?php echo base_url();?>';
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
                               //console.log(id);
                                   if (isConfirm) {
                                       $.ajax({
                                           url:base_url+"FrontofficeController/delete_lost_found", 
                                           //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                           type: "post",
                                           data: {id:id},
                                           dataType:"HTML",
                                           success: function (data) {
                                               if(data==1){
                                               swal(
                                                       "Deleted!",
                                                       "Your  file has been deleted!",
                                                       "success");
                                                   }
                                               $('.confirm').click(function()
                                                                           {
                                                                                   location.reload();
                                                                               });
                                           }
                           
                                           
                                           });                                                                                                           
                                                       
                                   } else {
                                       swal(
                                           "Cancelled",
                                           "Your  file is safe !",
                                           "error"
                                       );
                                   }
                               });
                           });
                        </script>
                        <!--end dlt script-->  
                        <?php
                           $i++;
                              }
                              
                              }
                              
                              ?>
                        </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="tab-pane" id="lost_completed_div">
                     <div class="table-scrollable">
                        <table id="lost_manage_completed" class="display full-width">
                           <thead>
                              <tr>
                                 <th>Sr.No.</th>
                                 <th>Room No</th>
                                 <th>Guest Name</th>
                                 <th>Contact No</th>
                                 <th> Lost /Found  Date</th>
                                 <th>Lost/Found time</th>
                                 <th>Type</th>
                                 <th>Item Name</th>
                                 <!-- <th>Found Item</th> -->
                                 <th>Image</th>
                                 <th>Description</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                           <tbody class="append_data1">
                              <?php
                                 $i = 1;
                                 if($completed)
                                 {
                                     foreach($completed as $com)
                                     {
                                        if($com['lost_found_flag'] == 1)
                                        {
                                           $type="Lost Item ";
                                           
                                         }
                                        else{
                                         $type="Found Item ";
                                        }
                                        
                                        if($com['lost_found_flag'] == 1)
                                        {
                                           $item_name=$com['lost_item_name'];
                                           
                                         }
                                        elseif($com['lost_found_flag'] == 2)
                                        {
                                            $item_name =$com['found_item_name'] ;
                                        }
                                        else{
                                                $item_name ="-";
                                        }
                                 
                                 
                                 
                                        
                                 ?>
                              <tr>
                                 <td>
                                    <h5><?php echo $i?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $com['room_no'];?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $com['guest_name'];?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $com['contact_no'];?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $com['lost_found_date'];?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $com['lost_found_time'];?></h5>
                                 </td>
                                 <td>
                                    <h5><?php echo $type;?></h5>
                                 </td>
                                 <td>
                                    <h5> <?php echo  $item_name;?> </h5>
                                 </td>
                                 <!-- <td>
                                    <h5> <?php echo $com['found_item_name'];?> </h5>
                                    </td> -->
                                 <td>
                                    <div class="lightgallery">
                                       <a href="<?php echo $com['img'] ?>"
                                          data-exthumbimage="<?php echo $com['img'] ?>"
                                          data-src="<?php echo $com['img'] ?>"
                                          class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                       <img class="me-3 rounded"
                                          src="<?php echo $com['img'] ?>" alt=""
                                          style="width:80px; height:40px;">
                                       </a>
                                    </div>
                                 </td>
                                 <td>
                                    <a href="#"
                                       class="btn btn-secondary shadow btn-xs sharp me-1"
                                       data-bs-toggle="modal" id="edit_data2" 
                                       data-bs-target="#exampleModalCenter_<?php echo $com['id'];?>"><i
                                       class="fa fa-eye"></i></a>
                                 </td>
                                 <!-- <td> -->
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
                                 <!-- </td> -->
                              </tr>
                              <!-- modal for terms and conditions -->
                              <div class="modal fade" id="exampleModalCenter_<?php echo $com['id'];?>"  aria-hidden="true">
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
                                          <!-- <span class="d-block mb-2 description_view"></span> -->
                                       </div>
                                       <div class="modal-footer">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- model end -->
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
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="frmblock"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Lost & Found</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <?php 
                  $user_id = $this->session->userdata('u_id');
                  $wh_h_id = '(u_id = "'.$user_id.'")';
                  $get_user_data = $this->MainModel->getData('register',$wh_h_id);
                  $hotel_id = $get_user_data['hotel_id'];
                  
                  ?>
               <div class="row">
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Room No</label>
                     <select  id="room_no" name="room_no" class="default-select form-control wide  dropdown js-example-disabled-results"
                        required="">
                        <option selected="">Select... </option>
                        <?php 
                           $where = '(hotel_id = "'.$hotel_id.'" AND room_status = 2)';
                           $room_no = $this->MainModel->getAllData($tbl ='room_status',$where);
                           foreach ($room_no as $r_no) 
                           {
                           ?>
                        <option value="<?php echo $r_no["room_no"];?>"><?php echo $r_no["room_no"];?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Guest Name</label>
                     <input type="hidden" class="form-control" placeholder="Enter name" id="id">
                     <input type="hidden" class="form-control" placeholder="" id="mobile_no" name="contact_no">
                     <input type="text" class="form-control" name="user_n" placeholder="Guest Name" id="users_name_new">                                                  
                  </div>
                  <div class=" mb-3 col-md-6 form-group">
                     <label class="form-label">Lost/Found Item</label>
                     <select name="lost_found_flag" id="" class="default-select form-control wide" required=""
                        >
                        <option selected="" disabled="">Select</option>
                        <option value="1">Lost Item</option>
                        <option value="2">Found Item</option>
                     </select>
                  </div>
                  <!-- <div class="mb-3 col-md-6">
                     <label class="form-label">Item Name</label>
                     <input type="text" name="lost_item_name	" id="" class="form-control" placeholder="">
                     
                     </div> -->
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Item Name</label>
                     <input type="text" name="found_item_name" id="found_item_name" class="form-control" placeholder="" required="">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Date</label>
                     <input type="date" name="lost_found_date" id="" class="form-control session-date" placeholder="" required="">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Time</label>
                     <input type="time"  name ="lost_found_time" class="form-control" placeholder="" required="">
                  </div>
                  <!-- <div class="mb-3 col-md-6">
                     <label class="form-label">Image</label> -->
                  <!-- <input type="file" class="form-control" placeholder=""> -->
                  <!-- <input type="file" class="dropify form-control" name="image"
                     id="files" multiple accept="image/jpeg, image/png, image/gif,"
                     placeholder="Personal Traning" required="">
                     </div> -->
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Upload image</label>
                     <input type="file" name="image" accept="image/jpeg, image/png," class="form-control" required="">
                  </div>
                  <div class="mb-3 col-md-6">
                     <label class="form-label">Description</label>
                     <textarea class="summernote" name="description" rows="3" 
                        required="" id="description1"></textarea>
                  </div>
               </div>
               <div class="text-center">
                  <button type="submit" class="btn btn-primary css_btn">Submit
                  </button>
               </div>
         </form>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- modal popup for edit  -->
<div class="modal fade update_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form id="frmupdateblock"  method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" id="id">
                  <div class="row">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Room No</label>
                        <input type="number" class="form-control" name="room_no" id="room_nos"  placeholder="">
                        <!-- <input type="number" class="form-control" name="room_no" id="<?php echo $g_f_s['room_no']?>" placeholder=""> -->
                     </div>
                     <!-- <div class="mb-3 col-md-6">
                        <label class="form-label">Room No</label>
                        <select  id="room_no11" name="room_no" class="default-select form-control wide  dropdown js-example-disabled-results"
                        style="display: none;">
                        
                        <option selected=""> </option>
                        
                        </select>
                        </div> -->
                     <!-- <div class="mb-3 col-md-6">
                        <label class="form-label">Guest Name</label>
                        <input type="text" class="form-control" name="guest_name"  value="<?php echo $g_f_s['guest_name']?>" placeholder="">
                        
                        
                        </div> -->
                        
                        <input type="hidden" class="form-control" placeholder="" id="lost_found_flag" name="lost_found_flag">
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Guest Name</label>
                        <input type="hidden" class="form-control" name="id" placeholder="Enter name" id="ids">
                        <input type="hidden" class="form-control" placeholder="Enter name" id="user_id11">
                        <input type="hidden" class="form-control" placeholder="" id="mobile_no11" name="contact_no">
                        <input type="text" class="form-control" name="user_n" placeholder="Guest Name"  id="user_n">                                                  
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Item Name</label>
                        <input type="text" name="item_name" class="form-control item_name" placeholder="">
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label"> Lost/Found  Date</label>
                        <input type="date" name="lost_found_date" id="lost_found_date" class="form-control session-date" placeholder="">
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" name="lost_found_time"  id="lost_found_time"  placeholder="">
                     </div>
                     <!-- <div class="mb-3 col-md-6">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" placeholder="">
                        </div> -->
                     <div class ="mb-3 col-md-6">
                        <label class="form-label">Upload image</label>
                        <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="">
                        <img src="" id="img" alt="Not Found" height="50" width="50">
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="summernote"
                           name="description" rows="3"
                           id="description"
                           required=""></textarea>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary css_btn">Save changes</button>
                     <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- change handover status -->
<div class="modal fade update_status_modal"  aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered"  role="document">
      <div class="modal-content">
         <form  id="frmupdateblock3" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title">Department Status </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="basic-form">
                  <input type="hidden" name="id" id="lost_id">
                  <div class="row">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Change Status</label>
                        <select name="sts" id="sts" 
                           class="default-select form-control wide" >
                           <option selected disabled >Pending</option>
                           <!--<option value="0">Pending</option>-->
                           <option value="1">Completed</option>
                        </select>
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
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script>
   $(document).ready(function() {
     $('#lost_manage_pending').DataTable();
     $('#lost_manage_completed').DataTable();
     $('.add_item').css('display','block');
   
     $(document).ready(function() {
            $('.nav-tabs a').on('click', function() {
                var tabId = $(this).attr('href'); // Get the ID of the clicked tab
                // var title = '';
   
                // Update the title based on the tab ID
                if (tabId === '#lost_pending_div') {
                 
                    
                  $('.add_item').css('display','block');
                  //   $('.headingtitle').text('Pending List');
                }   else if (tabId === '#lost_completed_div') {
                    $.get( '<?= base_url('lost');?>', function( data ) {
                    var resu = $(data).find('#lost_completed_div').html();
                    $('#lost_completed_div').html(resu);
                    setTimeout(function(){
                    
                     $('.add_item').css('display','none');
                        $('#lost_manage_completed').DataTable();
                    }, );
                });
                    
                  //   $('.headingtitle').text('Completed List');
                }
   
              
            });
        });
   
     
   
   });
   
   
   
</script>
<script>
   $(document).ready(function()
   {
      var base_url = '<?php echo base_url();?>';
   
         $('#room_no11').change(function() 
         {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no11').val();
            //alert(room_no);
            if (room_no != '')
            {
               
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_id",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#user_id11').val(data);
                     }
                  });
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_name",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#users_name11').val(data);
                     }
                  });
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_mobile",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#mobile_no11').val(data);
                     }
                  });
                 
            }
         });
   });   
</script>
<script>
   $(document).ready(function()
   {
      var base_url = '<?php echo base_url();?>';
   
         $('#room_no').change(function() 
         {
            var $hotel_id = '<?php echo $hotel_id?>';
            var room_no = $('#room_no').val();
            //alert(room_no);
            if (room_no != '')
            {
               
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_id",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#user_id').val(data);
                     }
                  });
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_name",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#users_name_new').val(data);
                     }
                  });
                  $.ajax({
                     
                     url: base_url + "FrontofficeController/get_user_mobile",
                     method: "POST",
                     data: {
                         room_no: room_no , hotel_id: $hotel_id
                     },
                     success: function(data)
                     {
                        //alert(data);
                        $('#mobile_no').val(data);
                     }
                  });
                 
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
           url         : '<?= base_url('FrontofficeController/add_lost_found_record') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
   
               $.get( '<?= base_url('lost');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#lost_manage_pending').DataTable();
                   }, 2000);
               });
               setTimeout(function(){  
                $(".loader_block").hide();
                $("#frmblock")[0].reset();
               $('#description1').summernote('reset');
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
           url         : '<?= base_url('FrontofficeController/edit_lost_found') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            
            $.get( '<?= base_url('lost');?>', function( data ) {
                   var resu = $(data).find('.table-scrollable').html();
                   $('.table-scrollable').html(resu);
                   setTimeout(function(){
                       $('#lost_manage_pending').DataTable();
                   }, 2000);
               });
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
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('FrontofficeController/getLostData') ?>',
                                         //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                         type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                            console.log(data);
                                            $('.description_view').html(data.description);
                                            
                                            $('#ids').val(data.id);
                                            $('#room_nos').val(data.room_no);
                                            $('#user_n').val(data.guest_name);
                                            $('#lost_item_name').val(data.lost_item_name);
                                            $('.item_name').val(data.item_name);
                                            $('#lost_found_flag').val(data.lost_found_flag);
                                            $('#lost_found_date').val(data.lost_found_date);
                                            $('#lost_found_time').val(data.lost_found_time);
                                            $('#description').summernote('code', data.description);
                                           //  $('#img').val(data.img);
                                           $("#img").attr('src',data.img);
                                         }
                             
                                         
                                         }); 
           })
       });
</script>
<script>
   //  $(document).ready(function (id) {
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
   //  });
    $(document).on('submit', '#frmupdateblock3', function(e){
      //   alert('hi');die;
    e.preventDefault();
    $(".loader_block").show();
    var form_data = new FormData(this);
    $.ajax({
        url         : '<?= base_url('FrontofficeController/update_hand_sts') ?>',
        method      : 'POST',
        data        : form_data,
        processData : false,
        contentType : false,
        cache       : false,
        success     : function(res) {
         console.log(res);
         $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_lost');?>', function( data ) {
                           var resu = $(data).find('#lost_completed_div').html();
                           var resu1 = $(data).find('#lost_pending_div').html();

                           $('#lost_completed_div').html(resu);
                           $('#lost_pending_div').html(resu1);
                           setTimeout(function(){
                              $('#lost_manage_completed').DataTable();
                              $('#lost_manage_pending').DataTable();
                              
                           }, 2000);
                           $('a[href="#lost_completed_div"]').tab('show');
                     });
            setTimeout(function(){  
            
               $(".loader_block").hide(); 
            $(".update_status_modal").modal('hide');
              $(".completedmessage").show();
              }, 2000);
             setTimeout(function(){ 
                $(".completedmessage").hide();
              }, 4000);
           
        }
    });
   });
   
   
</script>