<?php
$i = 1;
if($list)
{
    foreach($list as $g_f_s)
    {

       if($g_f_s['lost_found_flag'] == 1)
       {
          $type="Lost Item ";
          
        }
       else{
        $type="Found Item ";
       }
       
       if($g_f_s['lost_found_flag'] == 1)
       {
          $item_name=$g_f_s['lost_item_name'];
          
        }
       elseif($g_f_s['lost_found_flag'] == 2)
       {
           $item_name =$g_f_s['found_item_name'] ;
       }
       else{
               $item_name ="-";
       }



       
?>

        <tr>
        <td><h5><?php echo $i++?></h5></td>

          
            <td>
                    <h5><?php echo $g_f_s['room_no'];?></h5>
            </td>
           <td>
                    <h5><?php echo $g_f_s['guest_name'];?></h5>
            </td>
            <td>
                    <h5><?php echo $g_f_s['contact_no'];?></h5>
            </td>
            <td>
                    <h5><?php echo $g_f_s['lost_found_date'];?></h5>
            </td>
            <td>
                    <h5><?php echo $g_f_s['lost_found_time'];?></h5>
            </td>
            <td>
                    <h5><?php echo $type;?></h5>
            </td>
            <td>
                    <h5> <?php echo  $item_name;?> </h5>
            </td>
            <!-- <td>
                    <h5> <?php echo $g_f_s['found_item_name'];?> </h5>
            </td> -->
            <td>
                    <div class="lightgallery">
                        <a href="<?php echo $g_f_s['img'] ?>"
                            data-exthumbimage="<?php echo $g_f_s['img'] ?>"
                            data-src="<?php echo $g_f_s['img'] ?>"
                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                            <img class="me-3 rounded"
                                src="<?php echo $g_f_s['img'] ?>" alt=""
                                style="width:80px; height:40px;">
                        </a>
                    </div>
                </td>
            
          
            <!-- <td>
                    <h5>3.40 PM</h5>
            </td> -->
<!--                                                        
            <td>
                    <h5>Mobile</h5>
            </td> -->
<!--                                                       
            <td>
                <div id="lightgallery"
                    class="room-list-bx d-flex align-items-center">
                    <a href="<?php //echo base_url()?>assets/images/room/room5.jpg"
                        data-exthumbimage="http://localhost/supriya_front_office/AtmyTip_FrontOffice_updated/assets/images/room/room5.jpg"
                        data-src="http://localhost/supriya_front_office/AtmyTip_FrontOffice_updated/assets/images/room/room5.jpg"
                        class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                            src="http://localhost/supriya_front_office/AtmyTip_FrontOffice_updated/assets/images/room/room5.jpg"
                            alt=""
                            style="width: 5.375rem; height: 2.813rem;">
                    </a>
                </div>
            </td> -->
            <td>
               

               <a href="#"
           class="btn btn-secondary shadow btn-xs sharp me-1"
           data-bs-toggle="modal"
           data-bs-target="#exampleModalCenter12_<?php echo $g_f_s['id']?>"><i
               class="fa fa-eye"></i></a>

   </td>
   <td>
                <div class="d-flex">

                <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
                data-bs-toggle="modal" id="edit_data" 
                data-id="<?php echo $g_f_s['id'];?>" 
                data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 

                            <a href="#" id="delete_<?php echo $g_f_s['id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                            <i class="fa fa-trash "></i> </a>
                </div>
<!-- Modal -->
<div class="modal fade update_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal">
</button>
</div>
<div class="modal-body">
<div class="basic-form">
<form id="frmupdateblock"  method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="id">
<div class="row">
<div class="mb-3 col-md-6">
<label class="form-label">Room No</label>
<input type="number" class="form-control" name="room_no" id="room_nos" placeholder="">
</div>
<!-- <div class="mb-3 col-md-6">
            <label class="form-label">Room No</label>
            <select  id="room_no11" name="room_no" class="default-select form-control wide  dropdown js-example-disabled-results"
    style="display: none;">
 
    <option selected=""> <?php echo$g_f_s['room_no'];?> </option>
  
</select>
        </div> -->
<!-- <div class="mb-3 col-md-6">
<label class="form-label">Guest Name</label>
<input type="text" class="form-control" name="guest_name"  value="<?php echo $g_f_s['guest_name']?>" placeholder="">


</div> -->
<div class="mb-3 col-md-6">
            <label class="form-label">Guest Name</label>
            <input type="hidden" class="form-control" name="id" placeholder="Enter name" id="ids">
            <input type="hidden" class="form-control" placeholder="Enter name" id="user_id11">
            <input type="hidden" class="form-control" placeholder="" id="mobile_no11" name="contact_no">
            <input type="text" class="form-control" name="user_n" placeholder="Guest Name"  id="user_n">                                                  
        </div>
<div class="mb-3 col-md-6">
<label class="form-label">Item Name</label>
<input type="text" name="found_item_name" class="form-control" id="found_item_name" placeholder="">

</div>
<!-- <div class="mb-3 col-md-6">
<label class="form-label">Found Item</label>
<input type="text" class="form-control" name="found_item_name" value="<?php echo $g_f_s['found_item_name']?>"  placeholder="">

</div> -->
<div class="mb-3 col-md-6">
<label class="form-label"> Lost/Found  Date</label>
<input type="date" name="lost_found_date" id="lost_found_date" class="form-control session-date" placeholder="">
</div>
<div class="mb-3 col-md-6">
<label class="form-label">Time</label>
<input type="time" class="form-control" name="lost_found_time"  id="lost_found_time"  placeholder="">
</div> 
<!-- <div class="mb-3 col-md-6">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" placeholder="">
        </div> -->
        <div class ="mb-3 col-md-6">
            <label class="form-label">Upload image</label>
            <input type="file" class="dropify form-control" name="image" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $g_f_s['img']?>">
        </div>
        <div class="mb-3 col-md-12">
            <label class="form-label">Description</label>
            <textarea class="summernote"
            name="description" rows="3"
            id="description"
            required=""><?php echo $g_f_s['description']?></textarea>
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
</div> <!-- end of modal  -->
            </td>
    </tr>
                  
                              <script>
                                            
    document.getElementById('delete_<?php echo $s['m_handover_id'] ?>').onclick = function() {
    var id='<?php echo $s['m_handover_id'] ?>';
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
            url         : '<?= base_url('FrontofficeController/edit_lost_found') ?>',
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
                                          url: '<?= base_url('FrontofficeController/getLostData') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
                                             
                                             console.log(data);
                                             $('#ids').val(data.id);
                                             $('#room_nos').val(data.room_no);
                                             $('#user_n').val(data.guest_name);
                                             $('#lost_item_name').val(data.lost_item_name);
                                             $('#found_item_name').val(data.found_item_name);
                                            //  $('#img').val(data.img);
                                             $('#lost_found_date').val(data.lost_found_date);
                                             $('#lost_found_time').val(data.lost_found_time);
                                             $('#description').summernote('code', data.description);
                                          }
                              
                                          
                                          }); 
            })
        });
    </script>
<!-- end of modal  -->
