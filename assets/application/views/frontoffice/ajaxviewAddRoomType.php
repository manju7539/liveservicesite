<?php
$i = 1;
if($room_type_list)
{
    foreach($room_type_list as $list)
    {
?>
<tr>
    <td>
    <?php echo $i?>
    </td>
    <td><h5>
      <?php echo $list['room_type_name'] ?></h5>
    </td>
   <td><h5>
    <?php echo $list['price'] ?></h5>
    </td>
    <td><h5>
    <?php echo $list['lux_tax'] ?></h5>
    </td>
    <td><h5>
    <?php echo $list['serv_tax'] ?></h5>
    </td>
     <td>
                    <div class="lightgallery"
                        class="room-list-bx d-flex align-items-center">
                        <a href="<?php echo $list['images']?>"
                            data-exthumbimage="<?php echo $list['images']?>"
                            data-src="<?php echo $list['images']?>"
                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                            <img class="me-3  "
                                src="<?php echo $list['images'];?>" alt=""
                                style="width:40px; height:40px;">
                        </a>
                    </div>
                </td> 
    <td>
        <div>
        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $list['room_type_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a>

            <a href="#" id="delete" data-id="<?php echo $list['room_type_id']; ?>"
                class="btn btn-danger shadow btn-xs sharp"><i
                    class="fa fa-trash"></i></a>
        </div>
    </td>


                        </tr>
                              <script>
                                            
                                            $(document).on('click','#delete',function(id){
var id = $(this).attr('data-id');
var base_url='<?php echo base_url();?>';
// alert(id);
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
                url:base_url+"FrontofficeController/delete_room_type", 
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
                          
                          
            <!-- Modal -->
      <div class="modal fade update_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Edit Room Type</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal">
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-lg-12">
                          <div class="basic-form">
                          <form id="frmupdateblock" method="post">
                                                          <input type="hidden" name="room_type_id" id="room_type_id">                                                                                      <div class="row">

                                                          <div class="mb-3 col-md-12 form-group">
                                                                          <label class="form-label">Room Type</label>
                                                                          <input type="text" name="room_type_name" id="room_type_name" class="form-control" placeholder="">

                                                                      </div>
                             <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Room Type Price</label>
                                          <input type="number" name="price" min="1" id="price" class="form-control" placeholder=""  required="">
                                      </div>
                                      <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Luxurious tax (%)</label>
                                          <input type="number" name="lux_tax" min="1" max="100" step="1" class="form-control myform" placeholder="" id="lux_tax" required="">
                                      </div>  
                                      <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Service tax (%)</label>
                                          <input type="number" name="serv_tax" min="1" max="100" step="1" class="form-control myform" placeholder="" id="serv_tax" required="">
                                      </div>

                                        <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Upload image</label>
                                          <input type="file" name="image" class="form-control">
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
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/update_room_type') ?>',
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
                                          url: '<?= base_url('FrontofficeController/getRoomData') ?>',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                            
                                             $('#room_type_id').val(data.room_type_id);
                                             $('#room_type_name').val(data.room_type_name);
                                             $('#price').val(data.price);
                                             $('#lux_tax').val(data.lux_tax);
                                             $('#serv_tax').val(data.serv_tax);
                                            

                                          }
                              
                                          
                                          }); 
            })
        });
    </script>
<!-- end of modal  -->
