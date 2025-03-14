
<?php 

$i = 1;
if($list)
{
    foreach($list as $bu_r)
    {
        $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
        $no_of_people1 = $this->MainModel->getData('business_center',$where1);
        if(!empty($no_of_people1))
        {
            $no_of_people = $no_of_people1['no_of_people'];
            $type_name= $no_of_people1['business_center_type'];

        }
        else
        {
            $no_of_people = '-';
            $type_name = '-';
        } 
?>
<tr>
<td>
    <h5><?php echo $i++?></h5>
</td>
<td>
    <h5><?php echo $bu_r['client_name']?></h5>
</td>
<td>
    <h5><?php echo  $type_name ?></h5>
</td>
<td>
    <h5><?php echo $no_of_people ?></h5>
</td>
<td>
    <h5><?php echo $bu_r['event_date']?></h5>
</td>
<td>
    <h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?> </h5>
</td>
<td>
    <h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?> </h5>
</td>
<td>
                                    <div>
                                   
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $bu_r['b_c_reserve_id'];?>" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a>
                                    </div>
                                  
                                 </td>

<td>
    <a href="#"
        class="btn btn-secondary shadow btn-xs sharp me-1"
        data-bs-toggle="modal"
        data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
            class="fa fa-eye"></i></a>
</td>

</tr>
<script>
                                            
    document.getElementById('delete_<?php echo $s['city_id'] ?>').onclick = function() {
    var id='<?php echo $s['city_id'] ?>';
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
<div class="modal fade update_staff_modal add_staff_modal_<?php echo $s['city_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <input type="hidden" name="city_id" value="<?php echo $s['city_id']?>">
                            <input type="text" name="city" value="<?php echo $s['city']?>" class="form-control" placeholder="">
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
<?php  }  } ?>