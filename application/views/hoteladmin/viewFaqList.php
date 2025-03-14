<style>
   .faq_list .container-fluid{
   padding:0px
   }
</style>
<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">FAQ</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                  href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i></li>
               <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                  class="fa fa-angle-right"></i></li>
               <li class="active">FAQ</li>
            </ol>
         </div>
      </div>
      <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;" class="status_change">FAQ Created Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">FAQ Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="card card-topline-aqua">
               <div class="card-head">
                  <header>List of FAQ</header>
               </div>
               <div class="card-body ">
                  <!--  <div class="btn-group r-btn">
                     <button id="addRow1" class="btn btn-info">
                     Create Order<i class="fa fa-plus"></i>
                     </button>
                     </div> -->
                  <div class="btn-group r-btn">
                     <a class="btn btn-info add_faq" href="javascript:void(0)">Add FAQ </a>
                  </div>
                  <div class="table-scrollable faq_list">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr.no.</strong></th>
                              <th><strong>Question</strong></th>
                              <th><strong>Answer</strong></th>
                              <th><strong>Status</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody class="append_data">
                           <?php
                              $i = 1;
                              
                              if($list)
                              {
                              
                              foreach($list as $f)
                              {
                              ?>
                           <tr>
                              <td><strong><?php echo $i++ ?></strong></td>
                              <td><?php echo $f['question'] ?></td>
                              <td class="job-desk3">
                                 <p class="mb-0"><?php echo $f['answer'] ?></p>
                              </td>
                              <td>
                                 <select id="status_<?php echo $f['faq_id'] ?>" onchange="change_status(<?php echo $f['faq_id'] ?>)"
                                    class=" form-control "
                                    >
                                    <option <?php if($f['is_active'] == 1) { echo "Selected";}?> value="1">Active</option>
                                    <option <?php if($f['is_active'] == 0) { echo "Selected";}?> value="0">Deactive</option>
                                 </select>
                               
                              </td>
                              <td>
                                 <div class="d-flex">
                                   
                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="<?= $f['faq_id']?>" data-bs-target=".update_faq_modal"><i class="fa fa-pencil"></i></a> 

                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $f['faq_id']?>" ><i class="fa fa-trash"></i></a>
                                 </div>
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
<div class="modal fade update_faq_modal" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg slideInRight animated">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Update FAQ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
         </div>
         <div class="modal-body">
            <div class="col-md-12">
               <form id="frmupdateblock" methed="POST">
                  <input type="hidden" name="faq_id"  id="faq_id">
                  <div class="row ">
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Question?</label>
                        <input type="text" name="question" id="question" class="form-control" placeholder="">
                     </div>
                  </div>
                  <div class="mb-3 col-md-12">
                     <label class="form-label">Anwser</label>
                     <textarea class="summernote" name="answer" rows="4" id="answer"><?php echo $f['answer'] ?></textarea>
                  </div>
                  <div class="text-left">
                     <button type="submit" class="btn btn-info">Update FAQ</button>
                     <button type="button" class="btn btn-light"
                        data-bs-dismiss="modal">Cancel</button>
                  </div>
               </form>
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
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add FAQ</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-12">
                           <label class="form-label">Question?</label>
                           <input type="text" name="question" class="form-control" placeholder="Question?"
                              required>
                        </div>
                     </div>
                     <div class="mb-3 col-md-12">
                        <label class="form-label">Answer</label>
                        <textarea name="answer" class="summernote"  rows="4" id="comment"
                           required></textarea>
                     </div>
                     <div class="text-left">
                        <button type="submit" class="btn btn-info">Add FAQ</button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
   $(document).on("click",".add_faq",function(){
      $(".add_facility_modal").modal('show');
   });
      
    //    Add FAQ
   $(document).on('submit', '#frmblock', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?= base_url('HoteladminController/add_faq') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {
              $.get( '<?= base_url('HoteladminController/faqList');?>', function( data ) {
                  var resu = $(data).find('.table-scrollable').html();
                  $('.table-scrollable').html(resu);
                  setTimeout(function(){
                      $('#example1').DataTable();
                  }, 2000);
              });
              setTimeout(function(){  
               $(".loader_block").hide();
               $(".add_facility_modal").modal('hide');
               $(".add_facility_modal").on("hidden.bs.modal", function () {
                  $("#frmblock")[0].reset(); // reset the form fields
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

    //    Fetch Edit Data
   $(document).ready(function (id) {
        $(document).on('click','#edit_data',function(){
            var id = $(this).attr('data-id');
            // alert(id);
            $.ajax({
                url: '<?= base_url('HoteladminController/getFAQData') ?>',
                type: "post",
                data: {id:id},
                dataType:"json",
                success: function (data) {
                    
                    console.log(data);
                    $('#faq_id').val(data.faq_id);
                    $('#question').val(data.question);
                    $('#answer').summernote('code', data.answer);
                }
            }); 
        })
    });
   
    //  Update FAQ
    $(document).on('submit', '#frmupdateblock', function(e){
          // alert('hi');die;
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
        $.ajax({
          url         : '<?= base_url('HoteladminController/edit_faq') ?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {
              $.get( '<?= base_url('HoteladminController/faqList');?>', function( data ) {
                  var resu = $(data).find('.table-scrollable').html();
                 
                  $('.table-scrollable').html(resu);
                  setTimeout(function(){
                      $('#example1').DataTable();
                  }, 2000);
              });
              setTimeout(function(){  
               $(".loader_block").hide();
               $(".update_faq_modal").modal('hide');
               $(".append_data").html(res);
                $(".updatemessage").show();
                }, 2000);
               setTimeout(function(){  
                  $(".updatemessage").hide();
                }, 4000);
             
          }
      });
   });
   
    //  CHange Status
   function change_status(id)
   {
        $(".loader_block").show();
        var base_url = '<?php echo base_url()?>';
        var status = $('#status_'+id).children("option:selected").val();
        var id = id;
   
        if(status != '')
        {
            $.ajax({
                url : base_url + "HoteladminController/change_faq_status",
                method : "post",
                data : {status : status,id : id},
                success : function(data){
                    setTimeout(function(){  
                        $(".loader_block").hide();
                            $(".successmessage").show();
                        $(".status_change").text("Status changed successfully");
                        $(".append_data").html(data);
                    }, 2000);
                    setTimeout(function(){  
                        $(".successmessage").hide();
                    }, 4000);
                    
                }
            });
        }
   }

    //    Delete FAQ Ajax
    $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

        var id = $(this).attr('delete-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this File!",
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
                        url: '<?= base_url('HoteladminController/delete_faq') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your Faq has been deleted!", "success");
                            $.get('<?= base_url('HoteladminController/faqList');?>', function (data) {
                                var resu = $(data).find('.table-scrollable').html();
                                $('.table-scrollable').html(resu);
                                setTimeout(function () {
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
                        "Your Faq is safe!",
                        "error"
                    );
                }
        });
    });
</script>