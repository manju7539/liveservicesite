<!-- start page content -->
<?php
   //   echo "<pre>";
   // 	 print_r($leads_plan);
   // 	 exit;
        ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Hotel Plans</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Hotel Plans</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Plan Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List Of Plans</header>
                  
               </div>
               <div class="card-body ">
                  <div class="btn-group r-btn">
                     <button id="addRow1"  class="btn btn-info add_hotel">
                     Create Plan
                     </button>
                  </div>
                  <div class="table-scrollable">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.No.</strong></th>
                              <th><strong>Plan Name</strong></th>
                              <th><strong>Amount</strong></th>
                              <th><strong>Description</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php 
                              if(!empty($leads_plan)){
                                  $i=1;
                                   foreach($leads_plan as $s)
                                  {
                                 ?>
                           <tr>
                              <td><?php echo $i?></td>
                              <td>
                                 <div class="align-items-center"><span
                                    class="w-space-no"><?php echo $s['ledas_name']?></span></div>
                              </td>
                              <td><?php echo $s['amount']?></td>
                              <td>
                                 <a style="margin:auto" data-bs-toggle="modal"
                                    data-bs-target=".bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>"
                                    class="btn btn-secondary shadow btn-xs sharp"><i
                                    class="fa fa-eye"></i></a>
                              </td>
                              <td>
                                 <!-- <a href="javascript:void(0)" data-id="<?php //$s['leads_plan_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                 <i class="fa fa-pencil"></i>
                                 </a> -->
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_plan_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                 <a href="#" id="delete_<?php echo $s['leads_plan_id'] ?>"
                                    class="btn btn-tbl-delete btn-xs"><i
                                    class="fa fa-trash-o"></i></a>
                              </td>
                           </tr>
                           <div class="modal fade bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Description</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <span><?php echo $s['description'] ?></span>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <script>
                              document.getElementById('delete_<?php echo $s['leads_plan_id'] ?>').onclick = function() {
                              var id='<?php echo $s['leads_plan_id'] ?>';
                              // alert(id);
                              var base_url='<?php echo base_url();?>';
                              
                              
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
                                  },
                                  function(isConfirm) {
                                  
                                      if (isConfirm) {
                                          $.ajax({
                                              url:base_url+"SuperAdminController/delete_plan", 
                                              
                                              type: "post",
                                              data: {id:id},
                                              dataType:"HTML",
                                              success: function (data) {
                                                  if(data==1){
                                                  swal(
                                                          "Deleted!",
                                                          "Your  Plan has been deleted!",
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
                                              "Your  staff is safe !",
                                              "error"
                                          );
                                      }
                                  });
                              };
                                                                  
                           </script>
                           
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
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_leads_modal" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-md ">
      <div class="modal-content">
         <form id="addplan"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Create Plan</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Plan Name</label>
                           <input type="text" name="ledas_name" class="form-control" placeholder="Enter Plan Name" required>
                        </div>
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Amount</label>
                           <input type="text" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Amount" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                           <label class="form-label">Description</label>
                           <textarea name="description" class="summernote" cols="30" rows="10"></textarea>
                           
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
               <button type="submit" class="btn btn-primary css_btn" >Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<!-- modal popup for edit  -->
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Plan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="basic-form">
               <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <input type="hidden" name="leads_plan_id" id="leads_plan_id">

                     <div class="mb-3 col-md-6">
                        <label class="form-label">Plan Name</label>
                        <!-- <input type="hidden" name="leads_plan_id" value="<?php //echo $s['leads_plan_id']?>"> -->
                        <input type="text" name="ledas_name" id="ledas_name" class="form-control" placeholder="">
                     </div>
                     <div class="mb-3 col-md-6">
                        <label class="form-label">Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                     </div>
                     <div class="col-md-12 col-sm-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="summernote" id="description" cols="30" rows="10">
                        <?php //echo $s['description']?>
                        </textarea>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary  css_btn">Save changes</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light  css_btn">Close</button>
                     </div>
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
   // $(document).on("click",".update_facility_modal",function(){
   //     var data_id = $(this).attr('data-id');
   //     alert(data_id);
   //     $(".add_facility_modal").modal('show');
   // });
   
   $(document).on('submit', '#addplan', function(e){
       e.preventDefault(); 
       $(".loader_block").show();
       var form_data = new FormData(this);
       console.log(form_data);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/add_plan') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           // dataType    : 'JSON',
           async:false,
           success     : function(res) {
           
                $.get( '<?= base_url('leadsPlan');?>', function( data ) {
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
   $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                    url: '<?= base_url('SuperAdminController/getEditDataofLeadsPlan') ?>',
                    //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                    type: "post",
                    data: {id:id},
                    dataType:"json",
                    success: function (data) {
                        
                        console.log(data);
                        $('#leads_plan_id').val(data.leads_plan_id);
                        $('#ledas_name').val(data.ledas_name);
                        $('#amount').val(data.amount);
                        // $('#description').val(data.description);
                        $('#description').summernote('code', data.description);

                    

                    }
        
                    
                    }); 
            })
        });
   $(document).on('submit', '#frmupdateblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('SuperAdminController/update_plan') ?>',
           method      : 'POST',
           data        : form_data,
           processData : false,
           contentType : false,
           cache       : false,
           success     : function(res) {
            $.get( '<?= base_url('leadsPlan');?>', function( data ) {
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
</script>