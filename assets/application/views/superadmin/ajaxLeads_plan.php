
<?php 

if(!empty($leads_plan)){
    $i=1;
     foreach($leads_plan as $s)
    {
   ?>
    <tr>
        <td><?php echo $i?></td>
        <td><div class="align-items-center"><span
                                    class="w-space-no"><?php echo $s['ledas_name']?></span></div></td>
      <td><?php echo $s['amount']?></td>
      <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
         <td>
        
          <!-- <a href="javascript:void(0)" data-id="<?php // $s['leads_plan_id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                                            <i class="fa fa-pencil"></i>
                                                        </a> -->
        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_plan_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
      <a href="#" id="delete_<?php echo $s['leads_plan_id'] ?>"
                                                        class="btn btn-tbl-delete btn-xs"><i
                                                            class="fa fa-trash-o"></i></a>
    </td>

    </tr><script>
                                            
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
    <div class="modal fade bd-terms-modal-sm_<?php echo $s['leads_plan_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Requirement</h5>
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
<!-- end of modal  -->
<?php $i++; }  } ?>
<script>
//     $(document).on('submit', '#frmupdateblock', function(e){
//        e.preventDefault();
//        $(".loader_block").show();
//        var form_data = new FormData(this);
//        $.ajax({
//            url         : '<?php base_url('SuperAdminController/update_plan') ?>',
//            method      : 'POST',
//            data        : form_data,
//            processData : false,
//            contentType : false,
//            cache       : false,
//            success     : function(res) {
//                setTimeout(function(){  
//                 $(".loader_block").hide();
//                 $(".update_staff_modal").modal('hide');
//                 $(".append_data").html(res);
//                  $(".updatemessage").show();
//                  }, 2000);
//                 setTimeout(function(){  
//                    $(".updatemessage").hide();
//                  }, 4000);
              
//            }
//        });
//    });
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
                        $('#description').summernote('code', data.description);
                        // $('#description').val(data.description);

                    

                    }
        
                    
                    }); 
            })
        });
</script>