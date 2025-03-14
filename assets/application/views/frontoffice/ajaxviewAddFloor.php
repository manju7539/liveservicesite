<?php
     $i = 1;
     if($floor_data)
     {
         foreach($floor_data as $fl)
         {
     ?>
 <tr>
 <td><strong><?php echo $i++?></strong></td>

     <td>
         <h5 class="text-nowrap"><?php echo $fl['floor'] ?></h5>
     </td>
     <td>
         <div>
         <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $fl['floor_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

             <!-- <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
                 data-bs-toggle="modal"
                 data-bs-target=".bd-example-modal-lg_<?php echo $fl['floor_id'] ?>"><i
                     class="fa fa-pencil"></i></a> -->

                     <a href="#" id="delete" data-id="<?php echo $fl['floor_id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1 delete_floor">
                             <i class="fa fa-trash "></i> </a>
         </div>
     </td>

                        </tr>       
                        <!-- edit model -->
                                      <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Floor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-lg-12">
                                                                <div class="basic-form">
                                                                <form id="frmupdateblock" method="post">
                                                                <input type="hidden" name="floor_id" id="floor_id">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-md-12 form-group">
                                                                                <label class="form-label">Floor No</label>
                                                                                <input type="number" name="floor" id="floor1" onkeyup="check_entry1()" class="form-control" placeholder="Enter Floor No." required="">

                                                                            </div>
                                                                         </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary css_btn">Save changes</button>

                                                            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!-- end of modal  -->
                          
                           <?php
                            $i++;
                              }
                            }
   ?>
   <script>
                                            
                                            $(document).on('click','.delete_floor',function(){
                                             var id = $(this).attr('data-id');  
                                            //  alert(id);
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
                                                                                 url:base_url+"FrontofficeController/delete_floor", 
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
                                     });
                                                                             </script>
   <script>
      function check_entry1()
    {
        var base_url = '<?php echo base_url()?>';
        var floor = $('#floor1').val();
        // alert(floor);

        $.ajax({
                url    : base_url + 'FrontofficeController/prevent_double_entry',
                method : "post",
                data   : {
                    floor : floor},
                success :   function(data)
                            {
                                // alert(data);
                                if(data == 1)
                                {
                                    alert('Floor already exits..');
                                    document.getElementById('floor').value = '';
                                }
                            }
        });
    }
     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/edit_floor') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
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
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getFloorData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                            
                                             $('#floor_id').val(data.floor_id);
                                             $('#floor1').val(data.floor);
                                            //  $('#guest_name').val(data.guest_name);
                                            //  $('#expense_amt').val(data.expense_amt);
                                            //  $('#description').val(data.description);
                                            //  $('#mobile_nos').val(data.mobile_no);
                                            //  $('#description').val(data.description);

                                          }
                              
                                          
                                          }); 
            });
            // $(document).on('click','#delete',function(){
            //     var id = $(this).attr('data-id');
            //     alert(id);
            //     $.ajax({
            //                               url: '<?= base_url('FrontofficeController/delete_floor') ?>',
            //                               //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
            //                               type: "post",
            //                               data: {id:id},
            //                               dataType:"json",
            //                               success: function (data) {
                                             
            //                                  console.log(data);
                                            
            //                                 //  $('#floor_id').val(data.floor_id);
            //                                 //  $('#floor1').val(data.floor);
            //                                 //  $('#guest_name').val(data.guest_name);
            //                                 //  $('#expense_amt').val(data.expense_amt);
            //                                 //  $('#description').val(data.description);
            //                                 //  $('#mobile_nos').val(data.mobile_no);
            //                                 //  $('#description').val(data.description);

            //                               }
                              
                                          
            //                               }); 
            // })
        });
    </script>
<!-- end of modal  -->
