<?php

if (!empty($service_list)) {
    $i = 1;
    foreach ($service_list as $l) 
    {
       if(!empty($l['icon']))
       {
             $img= $l['icon'];
       }
       else
       {
            $img="";
       }

?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <span><?php echo $l['service_type'] ?></span>
            </td>
         
           <td> <img class="me-2 " target="_blank"  src="<?php echo $l['icon']?>"
                                                alt="" style="width:100px;"></td>
    
            <td><?php echo $l['amount'] ?></td>

            <td> <a href="#" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#exampleModalCenter_<?php echo $l['h_k_services_id'] ?>">view</a>
            </td>
      <input type="hidden" name="user_id" id="uid<?php echo $l['h_k_services_id'];?>" value="<?php echo $l['h_k_services_id'];?>">
          <td>
                     
<select class="default-select form-control wide" name="is_active" id="active<?php echo $l['h_k_services_id'];?>" onchange="change_status(<?php echo $l['h_k_services_id']?>);">
                    <?php 
                        if($l['is_active']=="1") 
                        {
                    ?>
                        <option value=" 1" selected>Active</option>
                        <option value="0">Deactive</option>
                    <?php 
                        }
                        if($l['is_active']=="0")
                        { 
                    ?>
                        <option value="1">Active</option>
                        <option value="0" selected>Deactive</option>
                    <?php 
                        } 
                    ?>
                </select>
          </td>
            <td class="text-center">
            <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                                                data-bs-toggle="modal"
                                                                data-id="<?php echo $l['h_k_services_id']?>" data-bs-target=".update_service_modal"><i
                                                                    class="fa fa-pencil"></i></a>

                <a href="#" id="delete_<?php echo $l['h_k_services_id'] ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                    <i class="fa fa-trash "></i> </a>

            </td>
        </tr>
 <!-- Modal popup for view-->
 <div class="row">
                                                                <div class="modal fade" id="exampleModalCenter_<?php echo $l['h_k_services_id'] ?>" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Note:</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p><?php echo $l['description'] ?></p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- modal popup for edit  -->
      
      
<!--dlt script start-->                                                               
<script>

document.getElementById('delete_<?php echo $l['h_k_services_id'] ?>').onclick = function() {
var id='<?php echo $l['h_k_services_id'] ?>';
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
            url:base_url+"HouseKeepingController/delete_services", 
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
};
</script>

<!--end dlt script-->  

<?php
        $i++;
       }
      }
     
?>

 <!-- modal popup for edit  -->
                                                        <!-- Modal -->
                                                        <div class="modal fade update_service_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered  modal-lg slideInRight animated">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Order Details:</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                        <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-4">
                                                                                        <label class="form-label">Service Type:</label>
                                                                                        <input type="hidden" name="u_id" id="id">
                                                                                        <input type="text" name="type" id="type" class="form-control" placeholder="">
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-4">
                                                                                        <label class="form-label">Icon</label>
                                                                                        <div class="input-group mb-3">
                                                                                        <div class="form-file form-control"
                                                                                            style="border: 0.0625rem solid #ccc7c7;">
                                                                                            <input type="file" name="File" id="File" value="<?php echo $l['icon']?>" accept="image/png, image/gif, image/jpeg" >
                                                                                        </div>
                                                                                        <span class="input-group-text">Upload</span>
                                                                                    </div>
                                                                                  </div>
                                                                                  <div class="mb-3 col-md-4">
                                                                                        <label class="form-label">Amount:</label>
                                                                                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="">
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-12">
                                                                                        <label class="form-label">Remark:</label>
                                                                                        <!--<div id="summernote1"></div>-->
                                                                                        <textarea class="summernote" name="description" id="description"><?php echo $l['description']?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <button type="submit" class="btn btn-primary css_btn">Save</button>
                                                                                    <button type="button" class="btn btn-light css_btn"  data-bs-dismiss="modal">Cancel</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end of modal  -->
                                                        <script>
                                                              $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('HouseKeepingController/getServiceData') ?>',
                                            type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                          
                                            console.log(data);
                                            $('#id').val(data.h_k_services_id);
                                            // $('#id').val(data.u_id);
                                            $('#service_type').val(data.service_type);
                                             $('#amount').val(data.amount);
                                            
                                            //  $('#File').val(data.File);
                                              $('#description').summernote('code', data.address);
                                           
                                            

                                          }
                              
                                          
                                          }); 
            })
        });
                                                            </script>