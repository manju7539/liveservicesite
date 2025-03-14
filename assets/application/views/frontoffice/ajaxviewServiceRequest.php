
<?php
     if(!empty($list))
     {
         $i=1;
         foreach($list as $f_l)
         {
             $wh = '(department_id  = "'.$f_l['send_to'].'")';
             $depart_name = $this->MainModel->getData(' departement',$wh);
             if(!empty($depart_name))
         {
             $department_name = $depart_name['department_name'];
     
     
         }
         else
         {
             $department_name = "-";
     
         }
     
     
     
     ?>
  <tr>
     <td>
        <h5>
        <?php echo $i++;?>
     </td>
     <!-- <td>
        10/10/2022 / <sub> 02:30 AM</sub>
        </td> -->
     <td>
        <h5><?php echo $f_l['created_at']?></h5>
     </td>
     <td>
        <h5><?php echo $f_l['room_no']?></h5>
     </td>
     <td>
        <h5><?php echo $f_l['guest_name']?></h5>
     </td>
     <td>
        <h5><?php echo $f_l['requirement']?></h5>
     </td>
     <td>
        <h5><?php echo $department_name ?></h5>
     </td>
  </tr>
<script>

    document.getElementById('delete_<?php echo $s['city_id'] ?>').onclick = function() {
    var id='<?php echo $s['city_id'] ?>';
    var base_url='<?php echo base_url(); ?>';
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
                    url:base_url+"HomeController/delete_staff",

                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
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
    <!-- modal popup for edit  -->
<div class="modal fade update_staff_modal add_staff_modal_<?php echo $s['city_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-lg slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Details:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">City</label>
                            <input type="hidden" name="city_id" value="<?php echo $s['city_id'] ?>">
                            <input type="text" name="city" value="<?php echo $s['city'] ?>" class="form-control" placeholder="">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save</button>
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
<?php $i++;}}?>