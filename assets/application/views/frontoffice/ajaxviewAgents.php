<?php
    $i = 1;
    if($agents_list)
    {
        foreach($agents_list as $list)
        {
    ?>

    <tr>

        <td>
        <?php echo $i?>
        </td>
        <td>
        <?php echo $list['name'] ?>
        </td>
        <td>
        <?php echo $list['email'] ?>
        </td>
        <td>
        <?php echo $list['phone'] ?>
        </td>
        <td>
        <?php echo $list['agency_name'] ?>
        </td>
        <td>
            <a href="#"
                class="btn btn-secondary shadow btn-xs sharp me-1"
                data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter_<?php echo $list['id']?>"><i
                    class="fa fa-eye"></i></a>

        </td>

                    <!-- modal for terms and conditions -->
                    <div class="modal fade" id="exampleModalCenter_<?php echo $list['id']?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Description</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $list['description']?></p>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
        <td>
            <div>
            <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
            data-bs-toggle="modal" id="edit_data" 
            data-id="<?php echo $list['id'] ?>" 
            data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 

                <a href="#" id="delete" data-id="<?php echo $list['id'] ?>"
                    class="btn btn-danger shadow btn-xs sharp"><i
                        class="fa fa-trash"></i></a>
            </div>
        </td>
   
    </tr>
                   <!-- modal popup for edit  -->
          
                   <div class="modal fade update_modal" tabindex="-1" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Agent</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-lg-12">
                                                                            <div class="basic-form">
                                                                            <form  id="frmupdateblock" method="post" enctype="multipart/form-data">
                                                                            <input type="hidden" name="id" id="id">                                        
                                                                            <div class="row">
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Name</label>
                                                                                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Email</label>
                                                                                            <input type="email" class="form-control" name="email" id="email"  placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Phone</label>
                                                                                            <!-- <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $list['phone']?>"  placeholder=""> -->
                                                                                            <input type="text" minlength="10" maxlength="10" name="phone" id="phone" class="form-control <?php echo (form_error('phone') !="") ? 'is-invalid' : ''; ?>" placeholder="Enter Mobile Number" onkeypress="return onlyNumberKey(event)" required >

                                                                                        </div>
                                                                                        <div class="mb-3 col-md-6 form-group">
                                                                                            <label class="form-label">Agency/Company Name</label>
                                                                                            <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="">
                                                                                        </div>
                                                                                        <div class="mb-3 col-md-12 form-group">
                                                                                            <label class="form-label">Discription</label>
                                                                                            <!-- <div class="summernote"></div> -->
                                                                                            <textarea class="summernote" name="description" id="description" style="min-height: 400px;"></textarea>

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
                                            
                                            $(document).on('click','#delete',function(id){
                                                var id='<?php echo $list['id'] ?>';
                                                // alert(id);
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
                                                        url:base_url+"FrontofficeController/delete_agents",
                                        
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
                                        });
                                                                                </script>
   <script>
      $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/update_agents') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
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
                                          url: '<?= base_url('FrontofficeController/getAgentData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {

                                              $('#id').val(data.id);
                                             $('#name').val(data.name);
                                             $('#email').val(data.email);
                                             $('#agency_name').val(data.agency_name);
                                             $('#phone').val(data.phone);
                                             $('#description').summernote('code', data.description);
                                          }
                              
                                          
                                          }); 
            })
        });
    </script>
<!-- end of modal  -->
