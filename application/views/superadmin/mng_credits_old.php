<!-- start page content -->
<?php
   //   echo "<pre>";
   // 	 print_r($leads_recharge);
   // 	 exit;
        ?>
<style>
   #city_name{
   background-color: white;
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Manage Credits Amount</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               
               <li class="active">Manage Credits Amount</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Wallet Amount Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Credits Amount</header>
               </div>
               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button id="addRow1"  class="btn btn-info add_hotel">
                     Add Credits
                     </button>
                  </div>
                  <div class="table-scrollable" >
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th>
                                 Sr.No.
                              </th>
                              <th>City</th>
                              <th>Hotel Name</th>
                              <th>Added Amount</th>
                              <th>Total Amount</th>
                              <th>Added_by</th>
                              <!--  <th>Amount</th>-->
                              <!-- <th>Date and time</th> -->
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php 
                              if(!empty($leads_recharge)){
                                  $i=1;
                                //   echo "<pre>";
                                //   print_r($leads_recharge);die;
                                  foreach($leads_recharge as $s)
                                  { 
                                      // print_r($s);die;
                                     $wh = '(u_id = "'.$s['hotel_id'].'")';
                                    //    print_r($wh);die;
                                     $catgory = $this->SuperAdmin->getSingleData($tbl='register',$wh);
                              
                                  //    print_r($catgory['city']);
                                  //    exit;
                                     if(isset($catgory['city']) && $catgory['city']  !=0 )
                                     {
                                         $wh = $catgory['city'];
                                         $wh = '(city_id = "'.$wh.'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                         $city111 = $recharg['city'];
                              
                                 
                                     }
                                     else
                                     {
                                         $city111 = "-";
                                         
                                     }
                              
                                     $category_name = "";
                                       $sub_cat_name = ""; 
                              
                                      
                                         $wh = '(city_id = "'.$s['city_name'].'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                       
                                       
                                         if(!empty($recharg))
                                         {
                                             $city = $recharg['city'];
                                           
                                         }
                                         else
                                         {
                                             $city = "-";
                                         }
                              
                                         $wh = '(u_id= "'.$s['hotel_id'].'")';
                                         $data = $this->SuperAdmin->getSingleData('register',$wh);
                                     
                                         if(!empty($data))
                                     {
                                         $hotel_name = $data['hotel_name'];
                                         $u_id = $data['u_id'];
                                         $total_amount = $data['wallet_points'];
                                      //    print_r($total_amount);
                                      //    exit;
                              
                                     }
                                     else
                                     {
                                         $hotel_name = "-";
                                         $u_id ="-";
                                         $total_amount ="-";
                              
                                     }
                              
                                    //  if($s['added_by']==1)
                                    //  {
                                    //      $added_by = 'Super Admin';
                              
                                    //  }
                                    //  else
                                    //  {
                                    //      $added_by = 'Admin';
                                    //  }
                                 ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $city;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $hotel_name;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $s['amount'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $total_amount ;?></h5>
                              </td>
                              <td>
                                 <h5><?php //echo $added_by;?></h5>
                              </td>
                              <td>
                               
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['id']?>" city-id="<?= $s['city_name']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['id']?>" ><i class="fa fa-trash"></i></a> 
                              </td>
                           </tr>
                           <?php $i++; }  } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   $where='(user_type = 2)';
   $city_list = $this->SuperAdmin->group_city($tbl='register',$where);
   //     echo '<pre>';
   //    print_r($city_list);
   //      echo '</pre>';
   ?>
<!-- add btn modal  -->
<div class="modal fade add_leads_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-md ">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Add Credit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <form id="addplan" method="POST" enctype="multipart/form-data">
               <div class="row">
                  <div class="mb-3 col-md-12">
                     <label class="form-label">City</label>
                     <select class="form-control " name="city" id="main_cat" required="">
                        <option value="">No Selected</option>
                        <?php 
                           foreach($city_list as $c)
                           {
                               // print_r($c);
                               $wh = '(city_id = "'.$c['city'].'")';
                               // print_r($wh);
                               // exit;
                               $cities = $this->SuperAdmin->getSingleData('city',$wh);
                              
                               if(!empty($cities))
                           {
                               $city2 = $cities['city'];
                               $city3 = $cities['city_id'];
                           
                           
                           }
                           else
                           {
                               $city2 = "-";
                               $city3 = "-";
                           
                           }
                           ?>
                        <option value="<?php echo $city3 ?>"><?php echo $city2  ?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
                  <div class=" mb-3 col-md-12">
                     <label class="form-label">Hotel Name</label>
                     <!-- <select class="form-control select" id="city" name="hotel_id">
                        <option value="">Please Select:-</option>
                        <?php
                           //  foreach($category3 as $cat3)
                           //  {
                           //      $name=$cat3['brand_name'];
                                
                           //  echo '<option value="'. $cat3['b_id'].'">'.$name.'</option>';
                           //  }
                           ?>	
                        </select> -->
                     <select class="form-control" name="hotel_name" id="sub_cat" required="">
                        <option value="">---Choose Hotel--</option>
                     </select>
                  </div>
                  <div class="mb-3 col-md-12">
                     <label class="form-label">Enter Amount</label>
                     <input type="number" name="amount" class="form-control" placeholder="Enter Amount" required="">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary css_btn">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- modal popup for edit  -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Edit Credit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <input type="hidden" name="id" id="id">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">City</label>
                        <select  class="default-select form-control wide" name="city_name" id="city_name" >
                           <?php
                              
                              $city_data= $this->MainModel->getAllTableData($tbl='city');
                              // print_r($city_data);die;
                              foreach($city_data as $c_d)
                              {
                                       $city_name = $c_d['city'];
                              ?>
                           <option <?php if($c_d['city_id'] == $s['city_name']) { echo "Selected";}?> value="<?php echo $c_d['city_id']?>"><?php echo $city_name?></option>
                           <?php 
                              }
                              ?>                    
                        </select>
                     </div>
                     <div class=" mb-3 col-md-12">
                        <label class="form-label">Hotel Name</label>
                        <!-- <input type="hidden" class="form-control" name="hotel_name" id="hotel_name"> -->
                        <select  class="default-select form-control wide" name="hotel_name1" id="hotel_name" >
                           <?php
                              $wh_hotel = '(user_type = 2)';
                              $hotel_data= $this->MainModel->getAllData($tbl='register', $wh_hotel);
                              // print_r($hotel_data);die;
                              foreach($hotel_data as $h_d)
                              {
                                       $hotel_name = $h_d['hotel_name'];
                              ?>
                           <option <?php if($h_d['u_id'] == $s['hotel_id']) { echo "Selected";}?> value="<?php echo $h_d['u_id']?>"><?php echo $hotel_name?></option>
                           <?php 
                              }
                              ?>                    
                        </select>
                      
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Enter Amount</label>
                        <input type="number" name="amount"
                           id="amount"
                           class="form-control" placeholder="" required="">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit"
                        class="btn btn-primary css_btn">Save
                     changes</button>
                     <button type="button" class="btn btn-light css_btn"
                        data-bs-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end of edit modal  -->
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
<script>
   $(document).on("click",".add_hotel",function(){
       $(".add_leads_modal").modal('show');
   });
   $(document).on("click",".updateStaff",function(){
       var data_id = $(this).attr('data-id');
       $(".add_staff_modal_"+data_id).modal('show');
   });

   // add hotel credit script
   $(document).on('submit', '#addplan', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
       var form_data = new FormData(this);
       console.log(form_data);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/mng_credits_add') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           async:false,
           success     : function(res) {
            $.get( '<?= base_url('mng_credits');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
   
               setTimeout(function(){  
                  $(".loader_block").hide();
                  $(".add_leads_modal").modal('hide');
                  $(".add_leads_modal").on("hidden.bs.modal", function () {
                  $("#addplan").trigger("reset"); // reset the form fields
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

   // fetch hotel credit details for edit
   $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               var city_id = $(this).attr('city-id');
               // alert(id);
           
               $.ajax({
                     url: '<?= base_url('SuperAdminController/getEditdata_mng_credit') ?>',
                     //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                     type: "post",
                     data: {id:id, city_id:city_id},
                     dataType:"json",
                     success: function (data) {
                        // console.log(data.amount);
                        $('#id').val(data.id);
                        $('#city_name option[value="' + data.city_id + '"]').prop('selected', true);
                        $('#hotel_name option[value="' + data.hotel_id + '"]').prop('selected', true);
                        
                        // $('#city_name option').val(data.city_id).text(data.city_name);
                        // $('#city_name').val(data.city_name);
                        // $('#hotel_name').val(data.hotel_id);
                        $('#amount').val(data.amount);
            
                        }
               }); 
           })
   });

   // update hotel credit script
   $(document).on('submit', '#frmupdateblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       // var id  =  $(this).attr('data-id');
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/update_credit_amount') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            $.get( '<?= base_url('mng_credits');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });

               setTimeout(function(){  
                $(".loader_block").hide();
                $(".update_staff_modal").modal('hide');
                $(".append_data").html(res);
                 $(".updatemessage").show();
                 }, 2000);
                setTimeout(function(){  
                   $(".updatemessage").hide();
                 }, 4000);
              
           }
       });
   });

   // delete city script
   $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

            var id = $(this).attr('delete-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Staff!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {

                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('SuperAdminController/delete_mng_charge') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your Plan has been deleted!", "success");
                            $.get( '<?= base_url('mng_credits');?>', function( data ) {
                              var resu = $(data).find('.table-scrollable').html();
                              $('.table-scrollable').html(resu);
                              setTimeout(function(){
                                    $('#example1').DataTable();
                              }, 2000);
                           });

                            $(".loader_block").hide();
                            $(".append_data").html(res);
                        },
                        complete: function () {
                            // Close the SweetAlert modal when the AJAX request is complete
                            swal.close();
                        }

                    });

                } else {
                    swal(
                        "Cancelled",
                        "Your  staff is safe!",
                        "error"
                    );
                }
            });
        });
   
   $(document).ready(function() {
       $('#main_cat').change(function() {
   
           var base_url = '<?php echo base_url()?>';
           var cat = $('#main_cat').val();
   
   
           if (cat) {
               $.ajax({
                   url: base_url + "SuperAdminController/changeSubcategory",
                   method: "post",
                   data: {
                       cat: cat
                   },
                   success: function(data) {
                       //  alert(data);
                       $('#sub_cat').html(data);
                   }
   
               });
           } else {
               $('#sub_cat').html('<option>Select Hotel</option>');
           }
       });
   });
   
   $(document).ready(function() {
       $('#city').change(function() {
   
           var base_url = '<?php echo base_url()?>';
           var cat = $('#city').val();
           //    alert(cat);
   
           if (cat) {
               $.ajax({
                   url: base_url + "SuperAdminController/editsubhotels",
                   method: "post",
                   data: {
                       cat: cat
                   },
                   success: function(data) {
                       //  alert(data);
                       $('#hotels').html(data);
                   }
   
               });
           } else {
               $('#hotels').html('<option>Select Hotel</option>');
           }
       });
   });
</script>