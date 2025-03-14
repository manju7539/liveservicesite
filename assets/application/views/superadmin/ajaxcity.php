
<?php 

if(!empty($city)){
    $i=1;
     foreach($city as $s)
    {
   ?>
    <tr>
        <td><?php echo $i?></td>
        <td><div class="align-items-center"><span
                                    class="w-space-no"><?php echo $s['city']?></span></div></td>
         <td>
        
          <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['city_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
      
        <a href="#" id="delete_<?php echo $s['city_id'] ?>"
                                                        class="btn btn-tbl-delete btn-xs"><i
                                                            class="fa fa-trash-o"></i></a>
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
                    url:base_url+"SuperAdminController/delete_city", 
                    
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
   
<div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog  modal-dialog-centered modal-sm slideInRight animated">
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
                       
                        <input type="text" name="city_id" id="city_id">
                        <div class="mb-3 col-md-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-control"  >
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
<?php $i++; }  } ?>
<script>
    //   $(document).on('submit', '#frmupdateblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?php //base_url('SuperAdmincontroller/update_city') ?>',
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
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('SuperAdminController/getLostData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('#city_id').val(data.city_id);
                                             $('#city').val(data.city);
                                            

                                          }
                              
                                          
                                          }); 
            })
        });  
</script>

