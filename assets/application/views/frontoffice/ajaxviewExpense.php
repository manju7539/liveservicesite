<?php
                           $i = 1;
                           if($list)
                           {
                               foreach($list as $exp)
                               {
                           ?>
                               <tr>
                               <td><h5><?php echo $i++?></h5></td>
                               <td><h5><?php echo $exp['date']?></h5></td>
                               <td><h5><?php echo $exp['guest_name']?></h5></td>
                               <td><h5><?php echo $exp['mobile_no']?></h5></td>
                             <td><h5><?php echo $exp['expense_amt']?> Rs</h5></td>

                                   <td>
                                       <a href="#"
                                           class="btn btn-secondary shadow btn-xs sharp me-1"
                                           data-bs-toggle="modal"
                                           data-bs-target=".bd-discription-modal-lg_<?php echo $exp['expense_id']?>"><i
                                               class="fa fa-eye"></i></a>
                                   </td>
                                   <td>
                                       <div>
                                       <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $exp['expense_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                                           <a href="#" id="delete_<?php echo $exp['expense_id']?>"
                                               class="btn btn-danger shadow btn-xs sharp"><i
                                                   class="fa fa-trash"></i></a>
                                       </div>
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
                              <!-- Modal -->
                              <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Expense</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <div class="basic-form">
                                                                            <form id="frmupdateblock" method="post">
                                                                                <input type="hidden" name="expense_id" id="expense_id">                                        <div class="row">
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Date</label>
                                                                                            <input type="date" name="date" id="date" class="form-control session-date">

                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Name</label>
                                                                                            <input type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Name">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Contact Number</label>
                                                                                                    <input type="text" maxlength="10" name="mobile_no" 
                                                                                                    id="mobile_nos" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
                                                                                    </div>
                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Expense Amount
                                                                                            </label>
                                                                                            <input type="number" name="expense_amt" id="expense_amt" class="form-control">

                                                                                        </div>

                                                                                        <div class="mb-3 col-md-6">
                                                                                            <label class="form-label">Expense Details</label>
                                                                                            <!-- <textarea class="summernote" required></textarea> -->
                                                                                            <textarea class="summernote" name="description" rows="4" id="description"></textarea>

                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" class="btn btn-primary css_btn">Save changes</button>

                                                                                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                </div>
                                                            </div>
                                                        </div> <!-- end of modal  -->

    <?php
    $i++;
      }
    }
   ?>
   <script>
     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/edit_expenses') ?>',
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
               //  alert(id);
                $.ajax({
                                          url: '<?= base_url('FrontofficeController/getExpenseData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                            
                                             $('#expense_id').val(data.expense_id);
                                             $('#date').val(data.date);
                                             $('#guest_name').val(data.guest_name);
                                             $('#expense_amt').val(data.expense_amt);
                                             $('#mobile_nos').val(data.mobile_no);
                                             $('#description').summernote('code', data.description);

                                          }
                              
                                          
                                          }); 
            })
        });
    </script>
<!-- end of modal  -->
                                                  
                                                  