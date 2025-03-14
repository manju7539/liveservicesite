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
<!--default-select style="display: none; <div class="nice-select default-select form-control wide" tabindex="0"><span class="current">Active</span><ul class="list"><li data-value="Active" class="option selected">Active</li><li data-value="Deactive" class="option">Deactive</li></ul></div> -->
</td>
<td>
<div class="">
      <a href="javascript:void(0)" data-id="<?= $f['faq_id']?>" class="btn btn-tbl-edit btn-xs update_faq_modal">
    <i class="fa fa-pencil"></i>
</a>

<a href="#" id="delete_<?php echo $f['faq_id']?>"
class="btn btn-danger shadow btn-xs sharp"><i
class="fa fa-trash"></i></a>
</div>
</td>



                       <script>
                    
                    document.getElementById('delete_<?php echo $f['faq_id']?>').onclick = function() {
                    var id='<?php echo $f['faq_id'] ?>';
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
                                    url:base_url+"HoteladminController/delete_faq", 
                                    //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                    type: "post",
                                    data: {id:id},
                                    dataType:"HTML",
                                    success: function (data) {
                                        if(data==1){
                                        swal(
                                                "Deleted!",
                                                "Your Faq has been deleted!",
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
                                    "Your  Faq is safe !",
                                    "error"
                                );
                            }
                        });
                };
                </script>


<!-- edit modal -->
<div class="modal fade updateFaq" id="update_faq_<?php echo $f['faq_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
        <input type="hidden" name="faq_id" value="<?php echo $f['faq_id'] ?>">
       
        <div class="row ">
            <div class="mb-3 col-md-12">
                <label class="form-label">Question?</label>
                <input type="text" name="question" value="<?php echo $f['question'] ?>" class="form-control" placeholder="">
            </div>
        </div>
        <div class="mb-3 col-md-12">
            <label class="form-label">Anwser</label>
            <textarea class="form-control" name="answer" value="<?php echo $f['answer'] ?>" rows="4" id="comment"><?php echo $f['answer'] ?></textarea>
        </div>
        <div class="text-left">
            <button type="submit" class="btn btn-info">Update FAQ</button>
           <!--  <button type="button" class="btn btn-light"
                data-bs-dismiss="modal">Cancel</button> -->
        </div>
    </form>
</div>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!--/. edit modal -->
</tr>
<?php
}
}

?>