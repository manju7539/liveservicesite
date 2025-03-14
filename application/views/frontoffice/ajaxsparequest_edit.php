<?php
                           $i = 1;
                           if ($list) {
                              foreach ($list as $spa_f_s) {
                                 $wh = '(front_ofs_service_id = "' . $spa_f_s['front_ofs_service_id'] . '")';

                                 $services_img = $this->FrontofficeModel->getData('front_ofs_services_images', $wh);
                                 // print_r($services_img);exit;
                           ?>
                                 <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $spa_f_s['staff_name'] ?></td>
                                    <td><?php echo $spa_f_s['contact_no'] ?></td>
                                    <td><?php echo date('h:i a', strtotime($spa_f_s['open_time'])) . "-" . date('h:i a', strtotime($spa_f_s['close_time'])) ?></td>
                                    <td><?php echo date('h:i a', strtotime($spa_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($spa_f_s['break_close_time'])) ?></td>
                                    <td>
                                       <a style="margin:auto" data-bs-toggle="modal" id="edit_gym_data" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>" data-bs-target=".bd-terms-modal-sm" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                    <span class="badge light badge-warning"
                                                                        data-bs-toggle="modal"  id="edit_gym" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>"
                                                                            data-bs-target="#exampleModalCenter1">View</span>
                                    </td>
                                    <td>
                                       <a style="margin:auto" data-bs-toggle="modal" data-bs-target=".bd-terms-modal-sm1" id="edit_gym_data" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- modal for terms and conditions -->
                                    <div class="modal fade" id="exampleModalCenter_<?php echo $spa_f_s['front_ofs_service_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Terms And Conditions</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p><?php echo $spa_f_s['t_nd_c'] ?></p>
                                             </div>
                                             <div class="modal-footer">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. modal for terms and conditions -->
                                    <td>
                                       <div class="">
                                       <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_gym_data" data-bs-toggle="modal" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_spa_model1"><i class="fa fa-pencil"></i></a>
                                       </div>
                                       <div class="modal fade" id="edit_spa_model1" tabindex="-1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Edit schedule</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <form id="editspaCenterForm" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="front_ofs_service_id" id="front_ofs_service_id">
                           <input type="hidden" class="form-control" value="2" name="service_name">
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <div class="basic-form">
                                    <div class="row">
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Staff Name</label>
                                          <input type="text" name="staff_name" id="staff_name1" class="form-control" value="Amit Sahane" required="">
                                       </div>
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Contact Number</label>
                                          <input type="text" name="contact_no" maxlength="10" id="contact_no" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Open Time</label>
                                          <div class="input-group">
                                             <input type="time" name="open_time" id="open_time" class="form-control">
                                             <input type="time" name="close_time" id="close_time" class="form-control">
                                          </div>
                                       </div>
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Break Time</label>
                                          <div class="input-group">
                                             <input type="time" name="break_start_time" id="break_start_time" class="form-control">
                                             <input type="time" name="break_close_time" id="break_close_time" class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Description</label>
                                          <textarea class="summernote" name="description" rows="3" id="comment1" required=""><?php echo $spa_f_s['description'] ?></textarea>
                                       </div>
                                       <div class="mb-3 col-md-6 form-group">
                                          <label class="form-label">Terms & Conditions</label>
                                          <textarea class="summernote" name="t_nd_c" rows="3" id="comment" required=""><?php echo $spa_f_s['t_nd_c'] ?></textarea>
                                       </div>
                                    </div>
                                    <div id="spaImagesContainer" class="row"></div>
                                    <div class="row">
                                       <?php
//                                        $k = 0;

//                                        $u_id = $this->session->userdata('u_id');
//                                        $where = '(u_id = "' . $u_id . '")';
//                                        $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                           
//                                        $wh = '(u_id ="' . $admin_details['hotel_id'] . '")';
//                                        $get_hotel_name = $this->MainModel->getData($tbl = 'register', $wh);
//                                        $admin_id = $admin_details['hotel_id'];

//                                        $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

//                                        $spa_images = $this->MainModel->get_spa_services_images($admin_id, $front_ofs_service_id);
// // print_r($spa_images);exit;
//                                        if ($spa_images) {
//                                           foreach ($spa_images as $s_im) {
                                       ?>
                                            <!-- <input type="hidden" name="front_ofs_spa_service_images_id[]" value="<?php echo $s_im['front_ofs_spa_service_images_id'] ?>" class="form-control" placeholder="" required="">
                                       <div class="mb-3 col-md-4 form-group">
                                          <label class="form-label">Spa Photo</label>
                                          <img src="<?php echo $s_im['spa_photo'] ?>" height="30px" width="30px">
                                          <input type="file" name="spa_photo[<?php echo $k ?>]" class=" form-control" accept="image/jpeg, image/png," data-default-file="<?php echo $s_im['spa_photo'] ?>">
                                       </div>
                                       <div class="mb-3 col-md-4 form-group">
                                          <label class="form-label">Spa Type</label>
                                          <input type="text" name="spa_type[<?php echo $k ?>]" value="<?php echo $s_im['spa_type'] ?>" class="form-control" id="files">
                                       </div>
                                       <div class="mb-3 col-md-4 form-group">
                                          <label class="form-label">Price</label>
                                          <div class="input-group">
                                             <input type="text" class="form-control" name="spa_price[<?php echo $k ?>]" value="<?php echo $s_im['spa_price'] ?>">
                                             <button type="button" id="btnAdd12_<?php echo $spa_f_s['front_ofs_service_id'] ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i></button>
                                          </div>
                                       </div> -->
                                       <?php
                                       //       $k++;
                                       //    }
                                       // }
                                       ?>
                                       <div class="text-left mb-3">
                                       </div>
                                    </div>
                                   
                                    <div id="TextBoxContainer12_<?php echo $spa_f_s['front_ofs_service_id'] ?>" class="mb-1"></div>
                                    <?php
                                    $wh1 = '(front_ofs_service_id = "' . $spa_f_s['front_ofs_service_id'] . '")';

                                    $services_imgs = $this->MainModel->getAllData('front_ofs_services_images', $wh1);
                                    // print_r($services_imgs);die;
                                    $j = 0;

                                    if ($services_imgs) {

                                    ?>
                                       <div class="row">
                                          <label class="form-label">Pictures of Spa</label>
                                          <?php
                                          foreach ($services_imgs as $se_i) {
                                          ?>
                                             <div class=" col-md-6 ">
                                                <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id'] ?>">
                                                <input type="file" class="dropify form-control" name="image[<?php echo $j ?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $se_i['image'] ?>">
                                                <span class="img"></span>
                                             </div>
                                          <?php
                                             $j++;
                                          }
                                          ?>
                                       </div>
                                    <?php
                                    }
                                    ?>
                                 </div>
                                 <div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-info">Save changes</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
       
      </div>
   </div>

                                    </td>
                                 </tr>
                                 <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Description</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="col-lg-12">
                                                <span class="description_view"></span>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal fade bd-terms-modal-sm1" tabindex="-1" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Terms And Conditions</h5>
                                             <button type="button" class="btn-close" data-bs-dismiss="modal">
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="col-lg-12">
                                                <span class="t_nd_c_view"></span>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- packages -->
                                 <div class="modal fade" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Spa Types</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <div class="guest-profile">
                                                   
                                                         <div id="myTable">
                                                           
                                                         </div>
                                                         <br>
                                                   
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. packages -->
                           <?php
                              }
                           }

                           ?>
                            <script>
$(document).ready(function() {
    $('#spaImagesContainer').on('click', '.btn-primary', function() {
        // Handle the button click here
        <?php
if ($list) {
    foreach ($list as $spa_f_s) {
        ?>
               $(function() {

               $("#btnAdd12_<?php echo $spa_f_s['front_ofs_service_id'] ?>").bind("click", function() {
                   var div = $("<div class=''/>");
                   div.html(GetDynamicTextBox("")); 
                   $("#TextBoxContainer12_<?php echo $spa_f_s['front_ofs_service_id'] ?>").append(div);
               });
               $("body").on("click", "#DeleteRow1", function() {
                   $(this).parents("#row1").remove();
               })
           });


   function GetDynamicTextBox(value)
   {
      return ' <div id="row1" class="row">' +
           '<div class="mb-3 col-md-4 form-group">' +
           '<label class="form-label">Spa Photo</label>' +
           '<input type="file" name="spa_photo12[]" class="form-control" placeholder="" required=""></div>' +
           '<div class="mb-3 col-md-4 form-group">' +
           '<label class="form-label">Spa Type</label>' +
           '<input type="text" name="spa_type12[]" class="form-control" placeholder="Spa Type" required=""></div>' +
           '<div class="mb-3 col-md-4 form-group">' +
           '<label class="form-label">Price</label>' +
           '<input type="text" name="spa_price12[]" class="form-control" placeholder="Price" required=""></div>' +
           '<div class="mb-3 col-md-4 form-group">' +
           '<label class="form-label">Spa Description</label>' +
           '<div class="form-group d-flex justify-content-between">' +
           '<textarea class="summernote" name="spa_description12[]" placeholder="description" required=""></textarea>'+
           '<button type="button" value="Remove" id="DeleteRow1" class="remove btn btn-danger btn-sm ms-2">' +
           '<i class="fa fa-times"></i></button></div></div>'+
          
      '</div>'
   }

   <?php
}
}
?>
        // You can access the specific button that was clicked using $(this)
    });
});
$(document).ready(function(id) {
         $(document).unbind('click').on('click', '#edit_gym_data', function() {
            var id = $(this).attr('data-idgym');
            // alert(id);
            $.ajax({
               url: '<?= base_url('FrontofficeController/geteditspaData') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {

                  console.log(data.data);
                  $('#front_ofs_service_id').val(data.list[0].front_ofs_service_id);
                  $('#staff_name1').val(data.list[0].staff_name);
                  $('#contact_no').val(data.list[0].contact_no);
                  $('#open_time').val(data.list[0].open_time);
                  $('#close_time').val(data.list[0].close_time);
                  $('#break_start_time').val(data.list[0].break_start_time);
                  $('#break_close_time').val(data.list[0].break_close_time);
                  // $('#comment1').val(data.comment);
                  $('#comment1').summernote('code', data.list[0].description);
                  $('#comment').summernote('code', data.list[0].t_nd_c);

                  $('.t_nd_c_view').html(data.list[0].t_nd_c);
                  $('.description_view').html(data.list[0].description);
                  $(".img").html("<img src='" + data.data[0].image + "' height='50px' width='50px' />");
                  
                  // for(var i=0; i<Object.keys(data).length; ++i) {
                  //    //  console.log(data[i].spa_photo);
                  //    $(".img"+[i]).html("<img src='" + data[i].spa_photo + "' height='50px' width='50px' />");
                  // }
                  $('#spaImagesContainer').empty();
                  $.each(data.data, function(index, s_im) {
                  // Create the HTML elements
                  var html = '<div class="spa-item col-md-12">'; // Apply col-md-4 class
                  html += '<div class="spa-row">';
                  html += '<input type="hidden" name="front_ofs_spa_service_images_id[]" value="' + s_im.front_ofs_spa_service_images_id + '" class="form-control" placeholder="" required="">';
                  html += '<div class="spa-photo">';
                  html += '   <label class="form-label">Spa Photo</label>';
                  html += '   <img src="' + s_im.spa_photo + '" height="30px" width="30px">';
                  html += '   <input type="file" name="spa_photo[' + index + ']" class="form-control" accept="image/jpeg, image/png," data-default-file="' + s_im.spa_photo + '">';
                  html += '</div>';
                  html += '<div class="spa-type">';
                  html += '   <label class="form-label">Spa Type</label>';
                  html += '   <input type="text" name="spa_type[' + index + ']" value="' + s_im.spa_type + '" class="form-control" id="files">';
                  html += '</div>';
                  html += '<div class="spa-price">';
                  html += '   <label class="form-label">Price</label>';
                  html += '   <div class="input-group">';
                  html += '      <input type="text" class="form-control" name="spa_price[' + index + ']" value="' + s_im.spa_price + '">';
                  html += '   </div>';
                  html += '</div>';
                  html += '<div class="spa-description">';
                  html += '   <label class="form-label">description</label>';
                  html += '   <div class="input-group">';
                  html += '      <textarea class="summernote" name="spa_description[' + index + ']">' + s_im.spa_description + '</textarea>';
                  html += '      <button type="button" id="btnAdd12_' + s_im.front_ofs_service_id + '" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i></button>';
                  html += '   </div>';
                  html += '</div>'; // Close spa-row container
                  html += '</div>'; // Close spa-item container
                  // Append the HTML to the container
                  $('#spaImagesContainer').append(html); 
               });
                  // $(".img1").html("<img src='" + data[1].spa_photo + "' height='50px' width='50px' />");
                  // $(".img0").html("<img src='" + data[2].spa_photo + "' height='50px' width='50px' />");
                 
                  // $('#res').html(row);
                  // loadSpaImages();
               }


            });
         })
      });
   </script>
                           <script>
                               $('#editspaCenterForm').on('submit', function(e) {
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
            url: '<?= base_url('FrontofficeController/edit_front_ofs_services') ?>',
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               console.log(res);
               setTimeout(function() {
                  $(".loader_block").hide();
                  $("#edit_spa_model1").modal('hide');
                  $(".spa_new_data").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
</script>
<script>
  $(document).ready(function() {
   $(document).on('click', '#edit_gym', function() {
            var id = $(this).attr('data-idgym');
            // alert(id);
            $.ajax({
               url: '<?= base_url('FrontofficeController/geteditspatype') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {
                  $('#myTable').empty();
                  console.log(data);
                  $.each(data, function (i, data) {
                $('#myTable').append('<tr>\
                <td><img src="' + data.spa_photo + '" height="50px" width="100px"></td></tr>\
                <tr><td>Type:' + data.spa_type + '</td></tr>\
                <td>Rs.' + data.spa_price + '</td>\
                <tr><td>description: ' + data.spa_description + '</td></tr>\
                </tr>');   
            });
            // $('#myTable').html(str);
               }

            });
         })
  });
</script>