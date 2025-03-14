
<?php

                                                             $i = 1;
                                                              foreach($departement as $row){?>
                                                  <tr>
        <td><?php echo $i?></td>
        <td><h5><img src="<?php echo $row['icon'];?>" alt="" style="width: 25px; height: 25px;"></h5></td>
        <td><div class="align-items-center"><span
                                    class="w-space-no"><?php echo $row['department_name']?></span></div></td>
     
         <td>
        
         <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $row['department_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

    </td>

    </tr>
                                         
                                           
                                
    <!-- modal popup for edit  -->
    <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Edit Department</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="department_id" id="department_id">

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Icon</label>  
                            <input type="file" name="icon" value="<?php echo $row['icon']?>" class="form-control" placeholder="">
                            <img src="" id="img" alt="Not Found" height="50" width="50">
                         
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Department Name</label>
                            <input type="text" name="department_name" id="department_name" class="form-control"  >
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save Changes</button>
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
<?php $i++; }   ?>

<script>
     $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('SuperAdminController/getDepartmentData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('#department_id').val(data[0].department_id);
                                             $('#department_name').val(data[0].department_name);
                                             $("#img").attr('src',data[0].icon);

                                             
                                            

                                          }
                              
                                          
                                          }); 
            })
        }); 
    //     $(document).on('submit', '#frmupdateblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?php // base_url('SuperAdminController/update_departments') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".update_staff_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".updatemessage").show();
    //               }, 2000);
    //              setTimeout(function(){  
    //                 $(".updatemessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });
</script>