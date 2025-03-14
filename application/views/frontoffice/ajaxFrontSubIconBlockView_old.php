<link href="<?php echo base_url('assets/css/pages/formlayout.css') ?>" rel="stylesheet">
<style>
   .toggle.btn-xs {
   min-width: 35px;
   min-height: 35px;
   }
   .box {
   color: #fff;
   padding: 20px;
   display: none;
   margin-top: 20px;
   }
   .red {
   background: #fff;
   }
   .paginate_button{
   background-color: white !important;
   }
   /* .green {
   background: #e23428;
   } */
   .form-control:disabled, .form-control[readonly] {
   background-color: white;
   }
   label {
   margin-right: 15px;
   color:black;
   }
   .switchToggle {
   width: 56px;
   height: 32px;
   }
</style>
<style>
   input[value="Green"]:checked~.colored-div {
   background-color: #7cc142;
   color: white;
   }
   .alfabetBox {
   display: none;
   }
   .room_card {
   border-bottom: 1px solid #242426;
   border-radius: 5px;
   box-shadow: 0 3px 5px rgba(0, 0, 0, .16), 0 1px 3px rgba(0, 0, 0, .23) !important;
   margin: 7px;
   height: 40px;
   width: 54px;
   }
   .room_no {
   font-weight: 800;
   color: #202020;
   text-align: center;
   padding-top: 14px;
   }
   .red {
   background-color: #c8c8c8;
   }
   .radio {
   font-size: inherit;
   margin: 0;
   position: absolute;
   right: 0;
   top: calc(var(--card-padding) + var(--radio-border-width));
   width: 11px;
   height: 11px;
   }
   .checkbox_css {
   width: 20px;
   height: 20px;
   }
</style>
<style>
   .invoice-container {
   margin: 15px auto;
   padding: 70px;
   max-width: 650px;
   background-color: #fff;
   border: 1px solid #ccc;
   -moz-border-radius: 6px;
   -webkit-border-radius: 6px;
   -o-border-radius: 6px;
   border-radius: 6px;
   }
   .invoice-container .card1 {
   position: relative;
   display: flex;
   flex-direction: column;
   min-width: 0;
   word-wrap: break-word;
   background-color: #fff;
   background-clip: border-box;
   border: 1pxsolidrgba(0, 0, 0, .125);
   border-radius: 0.25rem;
   }
   @media (max-width: 767px) {
   .invoice-container {
   padding: 35px 20px 70px 20px;
   margin-top: 0px;
   border: none;
   border-radius: 0px;
   }
   }
</style>
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js') ?>"></script>
<?php if ($sub_icon_id == 1) {?>
   <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header>Gym Information</header>
         </div>
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th><strong>Sr. No.</strong></th>
                     <th><strong>Staff Name</strong></th>
                     <th><strong>Contact No.</strong></th>
                     <th><strong>Open Time </strong></th>
                     <th><strong>Break Time</strong></th>
                     <th><strong>Description</strong></th>
                     <th><strong>Terms & Condition</strong></th>
                     <th><strong>Pictures</strong></th>
                     <th><strong>Action</strong></th>
                  </tr>
               </thead>
               <tbody class="gym_new_data">
                  <?php
                  $i = 1;
                  if ($list) {
                     foreach ($list as $g_f_s) {
                        $wh = '(front_ofs_service_id = "' . $g_f_s['front_ofs_service_id'] . '")';

                        $services_img = $this->FrontofficeModel->getData('front_ofs_services_images', $wh);
                  ?>
                        <tr>
                           <td><?php echo $i++ ?></td>
                           <td><?php echo $g_f_s['staff_name'] ?></td>
                           <td><?php echo $g_f_s['contact_no'] ?></td>
                           <td><?php echo date('h:i a', strtotime($g_f_s['open_time'])) . "-" . date('h:i a', strtotime($g_f_s['close_time'])) ?></td>
                           <td><?php echo date('h:i a', strtotime($g_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($g_f_s['break_close_time'])) ?></td>
                           <!-- <td>
                     <button
                         class="btn btn-secondary_<?php echo $g_f_s['front_ofs_service_id'] ?> shadow btn-xs sharp me-1"><i
                             class="fas fa-eye"></i></button>
                     </td> -->
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" id="edit_gym_data" data-bs-target=".bd-terms-modal-sm" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                           </td>
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" id="edit_gym_data" data-bs-target=".bd-terms-modal-sm1" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                           </td>
                           <!-- <td>
                     <a href="" data-bs-toggle="modal"
                         data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id'] ?>">
                         <img src="<?php echo base_url('assets/dist/images/term.jpg') ?>" alt=""
                             height="40px" width="90px">
                     </a>
                     </td> -->
                           <!-- modal for terms and conditions -->
                           <!--/. modal for terms and conditions -->
                           <td>
                           <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                           </td>
                           <!-- image gallery -->
                           <div class="modal fade bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Pictures of Pool</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                          <!-- <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-label="Slide 1"
                                        aria-current="true"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                    </div> -->
                                          <div class="carousel-inner">
                                             <div class="carousel-item active">
                                                <img class="d-block w-100" src="<?php echo $services_img['image'] ?>" alt="First slide">
                                             </div>
                                             <!-- <div class="carousel-item">
                                       <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                           alt="Second slide">
                                       </div>
                                       <div class="carousel-item">
                                       <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                           alt="Third slide">
                                       </div> -->
                                          </div>
                                          <!-- <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button> -->
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--/. image gallery -->
                           <td>
                              <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_gym_data" data-bs-toggle="modal" data-idgym="<?= $g_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_gym_model"><i class="fa fa-pencil"></i></a>
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
                  <?php
                     }
                  }

                  ?>
               </tbody>
            </table>
         </div>
      </div>

      <div class="modal fade" id="edit_gym_model" tabindex="-1" style="display: none;" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Edit schedule</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <form id="editgymCenterForm" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                     <div class="col-lg-12">
                        <div class="basic-form">
                           <input type="hidden" name="front_ofs_service_id" id="front_ofs_service_id">
                           <input type="hidden" class="form-control" value="1" name="service_name">
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
                                 <textarea class="summernote" name="description" rows="3" id="comment1" required=""></textarea>
                              </div>
                              <div class="mb-3 col-md-6 form-group">
                                 <label class="form-label">Terms & Conditions</label>
                                 <textarea class="summernote" name="t_nd_c" rows="3" id="comment" required=""></textarea>
                              </div>
                           </div>
                           <?php
                           $wh1 = '(front_ofs_service_id = "' . $g_f_s['front_ofs_service_id'] . '")';

                           $services_imgs = $this->MainModel->getAllData('front_ofs_services_images', $wh1);

                           $j = 0;

                           if ($services_imgs) {

                           ?>
                              <label class="form-label">Pictures of Gym</label>
                              <span class="img2"></span>
                              <div class="row">
                                 <?php
                                 foreach ($services_imgs as $se_i) {
                                 ?>
                                    <div class="mb-3 col-md-4 ">
                                    <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id'] ?>">
                                       <input type="file" class="dropify form-control" name="image[<?php echo $j ?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $se_i['image'] ?>">
                                    </div>
                                    <br>
                                    <!--<output id="Filelist"></output>-->
                                 <?php
                                    $j++;
                                 }
                                 ?>
                                 <div>
                                 <?php
                              }
                                 ?>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-info" data-bs-dismiss="modal">Save changes</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </div>
   </div>

   <script>
      $(document).ready(function(id) {
         $(document).unbind('click').on('click', '#edit_gym_data', function() {
            var id = $(this).attr('data-idgym');
            // alert(id);
            $.ajax({
               url: '<?= base_url('FrontofficeController/geteditgymData') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {

                  // console.log(data);
                  $('#front_ofs_service_id').val(data.front_ofs_service_id);
                  $('#staff_name1').val(data.staff_name);
                  $('#contact_no').val(data.contact_no);
                  $('#open_time').val(data.open_time);
                  $('#close_time').val(data.close_time);
                  $('#break_start_time').val(data.break_start_time);
                  $('#break_close_time').val(data.break_close_time);
                  // $('#comment1').val(data.comment);
                  $('#comment1').summernote('code', data.description);
                  $('#comment').summernote('code', data.t_nd_c);

                  // $("#img").val(data.front_ofs_service_image_id[0].image);
  
                  $('.t_nd_c_view').html(data.t_nd_c);
                  $('.description_view').html(data.description);
                  $(".img2").html("<img src='" + data.image + "' height='50px' width='50px' />");

               }


            });
         })
      });

      //  update business center data
      $(document).bind('submit').on('submit', '#editgymCenterForm', function(e) {
         //   alert('hi');die;
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
               setTimeout(function() {
                  $(".loader_block").hide();
                  $(".edit_gym_model").modal('hide');
                  $(".gym_new_data").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
   </script>
<?php } elseif ($sub_icon_id == 2) {?>
   <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
   <div class="col-md-12">
      <div class="card card-topline-aqua">
         <div class="card-head">
            <header class="page_header_title_spa">Spa Information</header>
         </div>
         <div class="card-body ">
            <div class="col-md-12 col-sm-12">
               <div class="panel tab-border card-box">
                  <header class="panel-heading panel-heading-gray custom-tab">
                     <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#arrival1_div_spa" data-bs-toggle="tab" class="active">Spa Information</a>
                        </li>
                        <li class="nav-item"><a href="#arrival2_div1_spa" data-bs-toggle="tab">Spa Request</a>
                        </li>
                        <li class="nav-item"><a href="#arrival3_div_spa" data-bs-toggle="tab">Accept Spa Request</a>
                        </li>
                        <li class="nav-item"><a href="#arrival5_div_spa" data-bs-toggle="tab">Completed Spa Request</a>
                        </li>
                        <li class="nav-item"><a href="#arrival4_div_spa" data-bs-toggle="tab">Reject Spa Request</a>
                        </li>
                     </ul>
                  </header>
               </div>
            </div>
            <div class="btn-group r-btn add_spa_require" >
               <button style="float:right;" type="button" class="btn btn-primary css_btn added_spa_request" data-bs-toggle="modal">Add Request</button>
            </div>
            <div class="tab-content">
               <!-- upcoming guest -->
               <div class="tab-pane active" style="background-color:white;" id="arrival1_div_spa">
                  <div class="table-scrollable">
                     <table id="example1" class="display full-width">
                        <thead>
                           <tr class="table-heading">
                              <th><strong>Sr. No.</strong></th>
                              <th><strong>Staff Name</strong></th>
                              <th><strong>Contact No.</strong></th>
                              <th><strong>Open Time </strong></th>
                              <th><strong>Break Time</strong></th>
                              <th><strong>Description</strong></th>
                              <th><Strong>Packages</Strong></th>
                              <th><strong>Terms & Condition</strong></th>
                              <!-- <th><strong>Pictures</strong></th> -->
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody class="spa_new_data">
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
                                                                        data-bs-toggle="modal"  id="edit_gym_data1" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>"
                                                                            data-bs-target="#exampleModalCenter1">View</span>
                                    </td>
                                    <!-- packages -->
                                    <div class="modal fade" id="exampleModalCenter1" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>" style="display: none;" aria-hidden="true">
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
                                       <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_gym_data" data-bs-toggle="modal" data-idgym="<?= $spa_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_spa_model"><i class="fa fa-pencil"></i></a>
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
                           <?php
                              }
                           }

                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" style="background-color:white;" id="arrival2_div1_spa">
                  <div class="table-scrollable spa_added">
                     <table id="requestOrder_tb_spa" class="display full-width">
                        <thead>
                           <tr>
                              <th><strong>Sr. No.</strong></th>
                              <th><strong>Guest Name</strong></th>
                              <th><strong>Phone</strong></th>
                              <!-- <th><strong>Email</strong></th> -->
                              <th><strong>Request Date</strong></th>
                              <th><strong>Request Time</strong></th>
                              <th><strong>Spa Type</strong></th>
                              <th><strong>Note</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody id="searchTable" class="append_data11">
                           <?php
                           $i = 1; // + $this->uri->segment(2);

                           if (!empty($spa_request)) {
                              foreach ($spa_request as $spa_r_s) {

                                 $wh = '(u_id = "' . $spa_r_s['u_id'] . '")';
                                 // print_r($wh);die;
                                 $user_data = $this->FrontofficeModel->getData('register', $wh);


                                 $wh2 = '(front_ofs_spa_service_images_id="' . $spa_r_s['spa_type'] . '")';
                                 $spa_type1 = $this->FrontofficeModel->getData($tbl = 'front_ofs_spa_service_images', $wh2);
                                 //    print_r($spa_type1);exit;                                                      
                                 if (!empty($spa_type1)) {
                                    $spa_type = $spa_type1['spa_type'];
                                 } else {
                                    $spa_type = '';
                                 }
                                    // print_r($spa_r_s);exit;
                           ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++ ?></h5>
                                    </td>
                                    <td><?php echo $user_data['full_name'] ?></td>
                                    <td><?php echo $user_data['mobile_no'] ?></td>
                                    <td><?php echo $spa_r_s['select_date'] ?></td>
                                    <!-- <td>23/12/2022</td> -->
                                    <td><?php echo date('h:i a', strtotime($spa_r_s['select_time'])) ?></td>
                                    <td><?php echo $spa_type; ?></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit" data-id="<?php echo $spa_r_s['spa_service_request_id'] ?>" data-bs-target="#description_model1"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- modal forDescription -->
                                    <div class="modal fade" id="description_model1" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <span class="description_view"></span>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. modal for Description-->
                                    <td>
                                       <div>
                                          <a href="#" class="btn btn-warning shadow btn-xs sharp me-1 update_spa_modal_btn" id="edit_spa_data" data-id1="<?= $spa_r_s['spa_service_request_id'] ?>"><i class="fa fa-share"></i></a>
                                       </div>

                                    </td>
                                 </tr>
                           <?php
                              }
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" style="background-color:white;" id="arrival3_div_spa">
                  <div class="table-scrollable spa_change_record1">
                     <table id="acceptedOrder_tb_spa" class="display full-width">
                        <thead>
                           <tr class="table-heading">
                              <th><strong>Sr. No.</strong></th>
                              <th><strong>Guest Name</strong></th>
                              <th><strong>Phone</strong></th>
                              <!-- <th><strong>Email</strong></th> -->
                              <th><strong>Request Date</strong></th>
                              <th><strong>Request Time</strong></th>
                              <th><strong>Spa Type</strong></th>
                              <th><strong>Note</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody id="searchTable">
                           <?php
                           $i = 1; // + $this->uri->segment(2);

                           if (!empty($spa_request1)) {
                              foreach ($spa_request1 as $spa_r_s) {

                                 $wh = '(u_id = "' . $spa_r_s['u_id'] . '")';

                                 $user_data = $this->FrontofficeModel->getData('register', $wh);


                                 $wh2 = '(front_ofs_spa_service_images_id="' . $spa_r_s['spa_type'] . '")';
                                 $spa_type1 = $this->FrontofficeModel->getData($tbl = 'front_ofs_spa_service_images', $wh2);
                                 //   print_r($spa_type1);exit;                                                      
                                 if (!empty($spa_type1)) {
                                    $spa_type = $spa_type1['spa_type'];
                                 } else {
                                    $spa_type = '';
                                 }
                                 //    print_r($spa_type);exit;


                           ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++ ?></h5>
                                    </td>
                                    <td><?php echo $user_data['full_name'] ?></td>
                                    <td><?php echo $user_data['mobile_no'] ?></td>
                                    <td><?php echo $spa_r_s['select_date'] ?></td>
                                    <!-- <td>23/12/2022</td> -->
                                    <td><?php echo date('h:i a', strtotime($spa_r_s['select_time'])) ?></td>
                                    <td><?php echo $spa_type; ?></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#description_model_<?php echo $spa_r_s['spa_service_request_id'] ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- modal forDescription -->
                                    <div class="modal fade" id="description_model_<?php echo $spa_r_s['spa_service_request_id'] ?>" style="display: none;" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p><?php echo $spa_r_s['note'] ?></p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. modal for Description-->
                                    <input type="hidden" name="user_id" id="uid<?php echo $spa_r_s['spa_service_request_id']; ?>" value="<?php echo $spa_r_s['spa_service_request_id']; ?>">
                                    <td>
                                       <!-- <a href="#">
                                 <div class="badge badge-warning"
                                     data-bs-toggle="modal"
                                     data-bs-target="#exampleModalCenter">
                                     Assign</div>
                                 </a> -->
                                       <select class="form-control" name="status" id="spastatus<?php echo $spa_r_s['spa_service_request_id']; ?>" onchange="spa_change_status(<?php echo $spa_r_s['spa_service_request_id'] ?>);" style="min-width:85px;text-align:center;">
                                          <?php
                                          if ($spa_r_s['request_status'] == "1") {
                                          ?>
                                             <option value="1" selected>Accepted</option>
                                             <option value="4">Completed</option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                       <!-- <span class="badge badge-success">Accepted</span> -->
                                    </td>
                                 </tr>
                           <?php
                              }
                           }

                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" style="background-color:white;" id="arrival5_div_spa">
                  <div class="table-scrollable spa_change_record2">
                     <table id="completedOrder_tb_spa" class="display full-width">
                        <thead>
                           <tr class="table-heading">
                              <th><strong>Sr. No.</strong></th>
                              <th><strong>Guest Name</strong></th>
                              <th><strong>Phone</strong></th>
                              <!-- <th><strong>Email</strong></th> -->
                              <th><strong>Request Date</strong></th>
                              <th><strong>Request Time</strong></th>
                              <th><strong>Spa Type</strong></th>
                              <th><strong>Note</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody id="searchTable" class="append_spa_data2">
                           <?php
                           $i = 1; // + $this->uri->segment(2);

                           if (!empty($spa_request6)) {
                              foreach ($spa_request6 as $spa_c_s) {

                                 $wh = '(u_id = "' . $spa_c_s['u_id'] . '")';

                                 $user_data = $this->FrontofficeModel->getData('register', $wh);


                                 $wh2 = '(front_ofs_spa_service_images_id="' . $spa_c_s['spa_type'] . '")';
                                 $spa_type1 = $this->FrontofficeModel->getData($tbl = 'front_ofs_spa_service_images', $wh2);
                                 //    print_r($spa_type1);exit;                                                      
                                 if (!empty($spa_type1)) {
                                    $spa_type = $spa_type1['spa_type'];
                                 } else {
                                    $spa_type = '';
                                 }
                                 //    print_r($spa_type);exit;
                           ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++ ?></h5>
                                    </td>
                                    <td><?php echo $user_data['full_name'] ?></td>
                                    <td><?php echo $user_data['mobile_no'] ?></td>
                                    <td><?php echo $spa_c_s['select_date'] ?></td>
                                    <!-- <td>23/12/2022</td> -->
                                    <td><?php echo date('h:i a', strtotime($spa_c_s['select_time'])) ?></td>
                                    <td><?php echo $spa_type; ?></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#description_model_<?php echo $spa_c_s['spa_service_request_id'] ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- modal forDescription -->
                                    <div class="modal fade" id="description_model_<?php echo $spa_c_s['spa_service_request_id'] ?>" style="display: none;" aria-hidden="true">
                                       <!-- <?php print_r($spa_c_s['spa_service_request_id']); ?> -->
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p><?php echo $spa_c_s['note'] ?></p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. modal for Description-->
                                    <!-- <a href="#">
                              <div class="badge badge-warning"
                                  data-bs-toggle="modal"
                                  data-bs-target="#exampleModalCenter">
                                  Assign</div>
                              </a> -->
                                    <td><span class="badge badge-primary">Completed</span></td>
                                 </tr>
                           <?php
                              }
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="tab-pane" style="background-color:white;" id="arrival4_div_spa">
                  <div class="table-scrollable spa_change_record3">
                     <table id="rejectedOrder_tb_spa" class="display full-width">
                        <thead>
                           <tr class="table-heading">
                              <th><strong>Sr. No.</strong></th>
                              <th><strong>Guest Name</strong></th>
                              <th><strong>Phone</strong></th>
                              <!-- <th><strong>Email</strong></th> -->
                              <th><strong>Request Date</strong></th>
                              <th><strong>Request Time</strong></th>
                              <th><strong>Reject Reason</strong></th>
                              <th><strong>Spa Type</strong></th>
                              <th><strong>Note</strong></th>
                              <th><strong>Action</strong></th>
                           </tr>
                        </thead>
                        <tbody id="searchTable" class="append_spa_data">
                           <?php
                           $i = 1; // + $this->uri->segment(2);

                           if (!empty($spa_request2)) {
                              foreach ($spa_request2 as $spa_r_s) {

                                 $wh = '(u_id = "' . $spa_r_s['u_id'] . '")';

                                 $user_data = $this->FrontofficeModel->getData('register', $wh);


                                 $wh2 = '(front_ofs_spa_service_images_id="' . $spa_r_s['spa_type'] . '")';
                                 $spa_type1 = $this->FrontofficeModel->getData($tbl = 'front_ofs_spa_service_images', $wh2);
                                 //    print_r($spa_type1);exit;                                                      
                                 if (!empty($spa_type1)) {
                                    $spa_type = $spa_type1['spa_type'];
                                 } else {
                                    $spa_type = '';
                                 }
                                 //    print_r($spa_type);exit;
                           ?>
                                 <tr>
                                    <td>
                                       <h5><?php echo $i++ ?></h5>
                                    </td>
                                    <td><?php echo $user_data['full_name'] ?></td>
                                    <td><?php echo $user_data['mobile_no'] ?></td>
                                    <td><?php echo $spa_r_s['select_date'] ?></td>
                                    <!-- <td>23/12/2022</td> -->
                                    <td><?php echo date('h:i a', strtotime($spa_r_s['select_time'])) ?></td>
                                    <td>
                                    <?php 
                                   
                                    // print_r($spa_r_s['reject_reason']);
                                    // exit;
                                       if($spa_r_s['reject_reason'] == 0)
                                       {
                                          $reject_reason = '';
                                       }
                                       elseif($spa_r_s['reject_reason'] == 1)
                                       {
                                          $reject_reason = 'Please Try After Sometime';
                                       }
                                       elseif($spa_r_s['reject_reason'] == 2)
                                       {
                                          $reject_reason = 'Temporarily Unavailable';
                                       }
                                       elseif($spa_r_s['reject_reason'] == 3)
                                       {
                                          $reject_reason = 'Slots Not Available';
                                       }
                                       elseif($spa_r_s['reject_reason'] == 4)
                                       {
                                          $reject_reason = 'Please Contact Front Office';
                                       }
                                    ?>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo  $reject_reason;?></h5>
                                    </div>
                                 </td>
                                    <td><?php echo $spa_type; ?></td>
                                    <td>
                                       <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#description_model_<?php echo $spa_r_s['spa_service_request_id'] ?>"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <!-- modal forDescription -->
                                    <div class="modal fade" id="description_model_<?php echo $spa_r_s['spa_service_request_id'] ?>" style="display: none;" aria-hidden="true">
                                       <!-- <?php print_r($spa_r_s['spa_service_request_id']); ?> -->
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title">Description</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <p><?php echo $spa_r_s['note'] ?></p>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <!--/. modal for Description-->
                                    <td>
                                       <!-- <a href="#">
                                 <div class="badge badge-warning"
                                     data-bs-toggle="modal"
                                     data-bs-target="#exampleModalCenter">
                                     Assign</div>
                                 </a> -->
                                       <?php
                                       if ($spa_r_s['request_status'] == 1) {
                                       ?>
                                          <span class="badge badge-info">Accepted</span>
                                       <?php
                                       } elseif ($spa_r_s['request_status'] == 2) {
                                       ?>
                                          <span class="badge badge-danger">Rejected</span>
                                       <?php
                                       }
                                       ?>
                                    </td>
                                 </tr>
                           <?php
                              }
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="edit_spa_model" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                    <div class="row">
                                       <?php
                                       $k = 0;

                                       $u_id = $this->session->userdata('u_id');
                                       $where = '(u_id = "' . $u_id . '")';
                                       $admin_details = $this->MainModel->getData($tbl = 'register', $where);
                           
                                       $wh = '(u_id ="' . $admin_details['hotel_id'] . '")';
                                       $get_hotel_name = $this->MainModel->getData($tbl = 'register', $wh);
                                       $admin_id = $admin_details['hotel_id'];

                                       $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                                       $spa_images = $this->MainModel->get_spa_services_images($admin_id, $front_ofs_service_id);
// print_r($spa_images);exit;
                                       if ($spa_images) {
                                          foreach ($spa_images as $s_im) {
                                       ?>
                                             <input type="hidden" name="front_ofs_spa_service_images_id[]" value="<?php echo $s_im['front_ofs_spa_service_images_id'] ?>" class="form-control" placeholder="" required="">
                                             <div class="mb-3 col-md-4 form-group">
                                                <label class="form-label">Spa Photo</label>
                                               
                                                <input type="file" name="spa_photo[<?php echo $k ?>]" class=" form-control" accept="image/jpeg, image/png," data-default-file="<?php echo $s_im['spa_photo'] ?>">
                                                <span class="img<?php echo $k ?>"></span>
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
                                             </div>
                                       <?php
                                             $k++;
                                          }
                                       }
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


   <div class="modal fade bd-add-modal add_spa_request_model" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <form id="spa_request" method="post" enctype="multipart/form-data">
               <div class="modal-header">
                  <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Spa Request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                 
               </div>
               <div class="modal-body">
                  <div class="row">
                     <!-- <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Guest Name</label>
                     <input type="text" class="form-control"  name="name" id="name" placeholder="Enter agent name">
                     </div> -->
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number" required="">
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Booking ID</label>
                        <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID" required="" disable>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Request Date</label>
                        <input type="date" class="form-control minDate" name="request_date" placeholder="Date" required>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Request Time</label>
                        <input type="time" class="form-control minDate" name="request_time" placeholder="time" required>
                     </div>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Spa Type</label>
                        <select id="spa_type" name="spa_type" class="default-select form-control wide  dropdown js-example-disabled-results" required="">
                           <option selected="">Select... </option>
                           <?php
                           $u_id = $this->session->userdata('u_id');
                           $where = '(u_id = "' . $u_id . '")';
                           $admin_details = $this->FrontofficeModel->getData($tbl = 'register', $where);

                           $wh = '(u_id ="' . $admin_details['hotel_id'] . '")';
                           $get_hotel_name = $this->FrontofficeModel->getData($tbl = 'register', $wh);

                           $admin_id = $admin_details['hotel_id'];

                           $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                           $spa_images = $this->FrontofficeModel->get_spa_services_images($admin_id, $front_ofs_service_id);
                           foreach ($spa_images as $s_im) {
                           ?>
                              <option value="<?php echo $s_im['front_ofs_spa_service_images_id'] ?>"><?php echo $s_im['spa_type'] ?></option>
                           <?php
                           }
                           ?>
                        </select>
                     </div>
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Note</label>
                        <!-- <div class="summernote"></div> -->
                        <textarea class="summernote" id="description1" name="additional_note" style="min-height: 400px;"></textarea>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary css_btn">Add
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- end add btn modal -->
   <div class="modal fade update_spa_modal_change" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit Order status</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="frmupdateblock_spa" method="post" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="basic-form">
                     <div class="row">
                        <div class="mb-3 col-md-12">
                           <input type="hidden" name="spa_service_request_id" id="spa_service_request_id1">

                           <label class="form-label">Change Order Status</label>
                           <select id="send_user" name="request_status" class="default-select form-control wide" required>
                              <option value="">Choose...</option>
                              <option value="1">Accept</option>
                              <option value="2">Reject</option>
                           </select>
                        </div>
                     </div>
                     <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                        <label class="form-label">Reason For Rejecting</label>
                        <select id="reason" name="reject_reason" class="default-select form-control wide">
                           <option value="">Choose</option>
                           <option value="1">Please Try After Sometime</option>
                           <option value="2">Temporarily Unavailable</option>
                           <option value="3">Slots Not Available</option>
                           <option value="4">Please Contact Front Office</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary css_btn">Save</button>
                  <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                  <!-- <button type="button" class="btn-close btn-light css_btn" data-dismiss="modal">Close</button> -->
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- add btn modal  -->
   <script>
   $('#send_user').on('change', function() {
       
       if (this.value == 1) {
         //   $('#user_list').
           $('.assignto').css('display','block');
           $('.rejectreasonddd').css('display','none');
           $('#status').prop('required', true);

           $('#reason').prop('required', false);
           $('#status').prop('required', true);

         //   $('.assignto').css('display','block');
         
       }
       else if(this.value == 2)  {
           $('.assignto').css('display','none');
           $('.rejectreasonddd').css('display','block');
           $('#reason').prop('required', true);
           $('#status').prop('required', false);
       }
   });
</script>
   <script>

$(document).ready(function(id) {
         $(document).on('click', '#edit_gym_data', function() {
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

                  // console.log(Object.keys(data).length++);
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
                  $(".img").html("<img src='" + data[0].image + "' height='50px' width='50px' />");
                  
                  for(var i=0; i<Object.keys(data).length; ++i) {
                     //  console.log(data[i].spa_photo);
                     $(".img"+[i]).html("<img src='" + data[i].spa_photo + "' height='50px' width='50px' />");
                  }
                 
                  // $(".img1").html("<img src='" + data[1].spa_photo + "' height='50px' width='50px' />");
                  // $(".img0").html("<img src='" + data[2].spa_photo + "' height='50px' width='50px' />");
                 
                  // $('#res').html(row);
               }


            });
         })
      });
   
      
      //  update business center data
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
                  $("#edit_spa_model").modal('hide');
                  $(".spa_new_data").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
   
         $(document).unbind('click').on('click', '#edit_gym_data1', function() {
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
                  // console.log(data);
                  $.each(data, function (i, data) {
                $('#myTable').append('<tr>\
                <td><img src="' + data.spa_photo + '" height="50px" width="100px"></td></tr>\
                <tr><td>Type:' + data.spa_type + '</td></tr>\
                <td>Rs.' + data.spa_price + '</td>\
                </tr>');   
            });
            // $('#myTable').html(str);
               }

            });
         })
   
      function spa_change_status(cnt) {
         $(".loader_block").show();
         var base_url = '<?php echo base_url(); ?>';
         var status = $('#spastatus' + cnt).children("option:selected").val();
         var uid = $('#uid' + cnt).val();

         if (status != '') {
            $.ajax({
               url: base_url + "FrontofficeController/spa_status",
               method: "POST",
               data: {
                  status: status,
                  uid: uid
               },
               dataType: "json",
               success: function(data) {
                  $.get('<?= base_url('FrontofficeController/ajaxOrderIconView_v2'); ?>', function(data) {
                     var resu = $(data).find('#arrival2_div1_spa').html();
                  var resu1 = $(data).find('#arrival3_div_spa').html();
                  var resu2 = $(data).find('#arrival5_div_spa').html();
                  var resu3 = $(data).find('#arrival4_div_spa').html();

                  $('#arrival2_div1_spa').html(resu);
                  $('#arrival3_div_spa').html(resu1);
                  $('#arrival5_div_spa').html(resu2);
                  $('#arrival4_div_spa').html(resu3);

                     setTimeout(function() {
                        $(".loader_block").hide();
                        $('.page_header_title_spa').text('Complete Spa Request');
                        $(".status_completed").show();
                        $('#requestOrder_tb_spa').DataTable();
                        $('#acceptedOrder_tb_spa').DataTable();
                        $('#completedOrder_tb_spa').DataTable();
                        $('#rejectedOrder_tb_spa').DataTable();
                        $('a[href="#arrival5_div_spa"]').tab('show');

                        setTimeout(function() {
                           $(".status_completed").hide();
                        }, 4000);
                     }, 2000);
                  });
               }
            });
         }
      }
   </script>
   <script>
      $(document).ready(function() {
         $('#requestOrder_tb_spa').DataTable();
         $('#acceptedOrder_tb_spa').DataTable();
         $('#completedOrder_tb_spa').DataTable();
         $('#rejectedOrder_tb_spa').DataTable();


         $(document).on("click", ".added_spa_request", function() {
            $(".add_spa_request_model").modal('show');
         });
         $(document).unbind('submit').on('submit', '#spa_request', function(e) {
            e.preventDefault();
            $(".loader_block").show();
            var form_data = new FormData(this);
            //  var data_id = $(this).attr('data-id');
            $.ajax({
               url: '<?= base_url('FrontofficeController/add_spa_request') ?>',
               method: 'POST',
               data: form_data,
               processData: false,
               contentType: false,
               cache: false,
               success: function(res) {

                  $.get('<?= base_url('FrontofficeController/ajaxspaIconView_v1'); ?>', function(data) {
                     var resu = $(data).find('#arrival2_div1_spa').html();
                     $('#arrival2_div1_spa').html(resu);
                     setTimeout(function() {
                        $('#requestOrder_tb_spa').DataTable();
                     }, 2000);
                     $('a[href="#arrival2_div1_spa"]').tab('show');
                  });

                  setTimeout(function() {
                     $(".loader_block").hide();
                     $(".add_spa_request_model").modal('hide');
                     $(".add_spa_request_model").on("hidden.bs.modal", function() {
                     $("#spa_request")[0].reset(); 
                     $('#description1').summernote('reset');// reset the form fields
                  });
                 
                     $(".append_data11").html(res);
                     $(".successmessage11").show();
                  }, 2000);
                  setTimeout(function() {
                     $(".successmessage11").hide();
                  }, 4000);

               }
            });
         });



      });
   </script>
   <script>
      $(document).on('click', '#edit_spa_data', function() {
         var id = $(this).attr('data-id1');
         // alert(id);
         $.ajax({
            url: '<?= base_url('FrontofficeController/getrequirement') ?>',
            //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
            type: "post",
            data: {
               id: id
            },
            dataType: "json",
            success: function(data) {
               console.log(data);
               $('#spa_service_request_id1').val(data.spa_request[0].spa_service_request_id);

            }
         });
      })
      $(document).on('click', '#edit', function() {
         var id = $(this).attr('data-id');
         // alert(id);
         $.ajax({
            url: '<?= base_url('FrontofficeController/getData1') ?>',
            //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
            type: "post",
            data: {
               id: id
            },
            dataType: "json",
            success: function(data) {
               // console.log(data.list.note);
               $('.description_view').html(data.list.note);
            }
         });
      })
   </script>
   <script>
      $('#send_user').on('change', function() {

         if (this.value == 1) {
            //   $('#user_list').
            //   $('.assignto').css('display','block');
            //   $('.rejectreasonddd').css('display','none');
            //   $('.demo').prop('required', true);

            //   $('#reason').prop('required', false);
            //   $('#status').prop('required', true);

            //   $('.assignto').css('display','block');

         } else if (this.value == 2) {
            //   $('.assignto').css('display','none');
            //   $('.rejectreasonddd').css('display','block');
            //   $('#reason').prop('required', true);
            //   $('#status').prop('required', false);
            // $('.demo').prop('required', true);

         }
      });
   </script>

   <script>
      $(document).on("click", ".update_spa_modal_btn", function() {
         $(".update_spa_modal_change").modal('show');
      });

      $('#frmupdateblock_spa').submit(function(e) {
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         var base_url = '<?php echo base_url() ?>';
         //   console.log(base_url);
         //   return false;
         $.ajax({
            url: base_url + "FrontofficeController/change_new_spa_status",
            type: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               console.log(res)
               $.get('<?= base_url('FrontofficeController/ajaxOrderIconView_v2'); ?>', function(data) {
                  var resu = $(data).find('#arrival2_div1_spa').html();
                  var resu1 = $(data).find('#arrival3_div_spa').html();
                  var resu2 = $(data).find('#arrival5_div_spa').html();
                  var resu3 = $(data).find('#arrival4_div_spa').html();


                  $('#arrival2_div1_spa').html(resu);
                  $('#arrival3_div_spa').html(resu1);
                  $('#arrival5_div_spa').html(resu2);
                  $('#arrival4_div_spa').html(resu3);

                  setTimeout(function() {
                     $('#requestOrder_tb_spa').DataTable();
                     $('#acceptedOrder_tb_spa').DataTable();
                     $('#completedOrder_tb_spa').DataTable();
                     $('#rejectedOrder_tb_spa').DataTable();
                  }, 2000);
               });
               setTimeout(function() {
                  $(".loader_block").hide();
                  $(".update_spa_modal_change").modal('hide');
                  $(".update_spa_modal_change").on("hidden.bs.modal", function() {
                     $("#frmupdateblock_spa")[0].reset(); // reset the form fields
                  });
                  $(".updatemessage").show();
                  // $(".append_data11").html(res);

                  var request_status = form_data.get('request_status');
                  //  console.log(requestStatus); // Log the requestStatus value to the console

                  if (request_status === "1") {
                     $('a[href="#arrival3_div_spa"]').tab('show');
                     $('.page_header_title_spa').text('Accept Spa Request');
                  } else if (request_status === "2") {
                     $('a[href="#arrival4_div_spa"]').tab('show');
                     $('.page_header_title_spa').text('Reject Spa Request');

                  }

               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);
            }

         });
      });
   </script>
<!-- end add btn modal -->
<!-- edit model end -->
<?php } elseif ($sub_icon_id == 3) {?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>Pool Information</header>
         <!-- <div class="tools">
            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div> -->
      </div>
      <div class="card-body ">
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th>Sr.No.</th>
                     <th>Picture</th>
                     <th>Staff Name</th>
                     <th>Contact No</th>
                     <th>Open Time</th>
                     <th>Break Time</th>
                     <th>Description</th>
                     <th>Terms</th>
                     <th>Action</th>
                     <!-- <th>Status</th> -->
                  </tr>
               </thead>
               <tbody class="pool_new_data">
                  <?php
$i = 1; //+$this->uri->segment(2);
    if ($list) {
        foreach ($list as $p_f_s) {
            $wh = '(front_ofs_service_id = "' . $p_f_s['front_ofs_service_id'] . '")';

            $services_img = $this->MainModel->getData('front_ofs_services_images', $wh);
            ?>
                  <tr>
                     <td><?php echo $i++ ?></td>
                     <td>
                        <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
                        <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                     </td>
                     <td><?php echo $p_f_s['staff_name'] ?></td>
                     <td><?php echo $p_f_s['contact_no'] ?></td>
                     <td><?php echo date('h:i a', strtotime($p_f_s['open_time'])) . "-" . date('h:i a', strtotime($p_f_s['close_time'])) ?></td>
                     <td><?php echo date('h:i a', strtotime($p_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($p_f_s['break_close_time'])) ?></td>
                     <td>
                        <div>
                           <span class="badge light badge-warning"
                              data-bs-toggle="modal" id="edit_pool_data" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>"
                              data-bs-target="#exampleModalCenter13">View</span>
                        </div>
                     </td>
                     <!-- modal for terms and conditions -->
                     <div class="modal fade" id="exampleModalCenter13" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Description</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <p><span class="description_view"></span></p>
                              </div>
                              <div class="modal-footer">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--/. modal for terms and conditions -->
                     <td>
                        <a href="#"
                           class="btn btn-secondary shadow btn-xs sharp me-1"
                           data-bs-toggle="modal" id="edit_pool_data" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>"
                           data-bs-target=".bd-terms-modal-sm"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div class="">
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_pool_data" data-bs-toggle="modal" data-idpool="<?= $p_f_s['front_ofs_service_id'] ?>" 
                        data-bs-target="#edit_pool_model"><i class="fa fa-pencil"></i></a>
                        </div>
                     </td>
                  </tr>
                  <!-- modal for terms  -->
                  <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Terms & Conditions</h5>
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
                  <?php
}
    }
    ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="edit_pool_model" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Edit schedule</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <form id="editpoolCenterForm" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                       <div class="col-lg-12">
                                          <div class="basic-form">
                                             <input type="hidden" name="front_ofs_service_id" id="front_ofs_service_id">
                                             <input type="hidden" class="form-control" value="3" name="service_name">
                                             <div class="row">
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Staff Name</label>
                                                   <input type="text" name="staff_name" id="staff_name" class="form-control" value="Amit Sahane" required="">
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
                                                   <textarea class="summernote" name="description" rows="3" id="description"
                                                      required="">description</textarea>
                                                </div>
                                                <div class="mb-3 col-md-6 form-group">
                                                   <label class="form-label">Terms & Conditions</label>
                                                   <textarea class="summernote" name="t_nd_c" rows="3" id="t_nd_c"
                                                      required="">t_nd_c</textarea>
                                                </div>
                                             </div>
                                             <?php
$wh1 = '(front_ofs_service_id = "' . $p_f_s['front_ofs_service_id'] . '")';

            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images', $wh1);

            $j = 0;

            if ($services_imgs) {

                ?>
                                             <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Pictures of Pool</label>
                                                <span class="img2"></span>
                                                <?php
foreach ($services_imgs as $se_i) {
                    ?>
                                                <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id'] ?>">
                                                <input type="file" class="dropify form-control" name="image[<?php echo $j ?>]" id="" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $se_i['image'] ?>">
                                                <br>
                                                <output id="Filelist"></output>
                                                <?php
$j++;
                }
                ?>
                                             </div>
                                             <?php
}
            ?>
                                             <div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
<script>
      $(document).ready(function(id) {
         $(document).on('click', '#edit_pool_data', function() {
            var id = $(this).attr('data-idpool');
            // alert(id);
            $.ajax({
               url: '<?= base_url('FrontofficeController/geteditpoolData') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {

                  // console.log(data);
                  $('#front_ofs_service_id').val(data.front_ofs_service_id);
                  $('#staff_name').val(data.staff_name);
                  $('#contact_no').val(data.contact_no);
                  $('#open_time').val(data.open_time);
                  $('#close_time').val(data.close_time);
                  $('#break_start_time').val(data.break_start_time);
                  $('#break_close_time').val(data.break_close_time);
                  // $('#comment1').val(data.comment);
                  $('#description').summernote('code', data.description);
                  $('#t_nd_c').summernote('code', data.t_nd_c);

                  
                  $('.t_nd_c_view').html(data.t_nd_c);
                  $('.description_view').html(data.description);
                  // $("#img2").val(data.front_ofs_service_image_id[0].image);
                  $(".img2").html("<img src='" + data.image + "' height='50px' width='50px' />");


               }


            });
         })
      });
      //  update business center data
      $(document).bind('submit').on('submit', '#editpoolCenterForm', function(e) {
         //   alert('hi');die;
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
               setTimeout(function() {
                  $(".loader_block").hide();
                  $("#edit_pool_model").modal('hide');
                  $(".pool_new_data").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
   </script>
<?php } elseif ($sub_icon_id == 4) {?>
<?php //print_r($sun_list);exit;?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
<div class="card card-topline-aqua">
   <div class="card-head">
      <header>Shuttle Information</header>
      <!-- <div class="tools">
         <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
         <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
         <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
         </div> -->
   </div>
   <div class="card-body ">
      <div class="new_orders_div_service">
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th>Sr. No.</th>
                     <th><strong>Staff Name</strong></th>
                     <th><strong>Contact Number</strong></th>
                     <th><strong>Description</strong></th>
                     <th><strong>Terms & conditions</strong></th>
                     <th><strong>Picture</strong></th>
                     <th><strong>Action</strong></th>
                     <!-- <th><strong>Status</strong></th> -->
                  </tr>
               </thead>
               <tbody class="shuttle_new_data">
                  <?php
$i = 1;
    if ($list) {
        foreach ($list as $sh_f_s) {
            $wh = '(front_ofs_service_id = "' . $sh_f_s['front_ofs_service_id'] . '")';

            $services_img = $this->FrontofficeModel->getData('front_ofs_services_images', $wh);
            ?>
                  <tr>
                     <td><?php echo $i++ ?></td>
                     <td><?php echo $sh_f_s['staff_name'] ?></td>
                     <td><?php echo $sh_f_s['contact_no'] ?></td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm" id="edit_shuttle_data" data-idshuttle="<?= $sh_f_s['front_ofs_service_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm1" id="edit_shuttle_data" data-idshuttle="<?= $sh_f_s['front_ofs_service_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <!-- <td>
                        <a href="" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                            <img src="assets/dist/images/term.jpg" alt=""
                                height="40px" width="90px">
                        </a>
                        </td> -->
                     <!-- term and conditions -->
                     <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Terms And Conditions</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <span class="t_nd_c_view"></span>
                              </div>
                              <div class="modal-footer">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.term and conditions  -->
                     <td>
                     <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                                          <a href="<?php echo $services_img['image'] ?>" target="_blank" data-exthumbimage="<?php echo $services_img['image'] ?>" data-src="<?php echo $services_img['image'] ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                             <img class="me-3 " src="<?php echo $services_img['image'] ?>" alt="" style="width:50px; height:40px;">
                                          </a>
                                       </div>
                     </td>
                     <!-- image gallery -->
                     <div class="modal fade bd-example1-modal-md_<?php echo $sh_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Pictures of Shuttle</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <!-- <div class="carousel-indicators">
                                       <button type="button" data-bs-target="#carouselExampleIndicators"
                                           data-bs-slide-to="0" class="active" aria-label="Slide 1"
                                           aria-current="true"></button>
                                       <button type="button" data-bs-target="#carouselExampleIndicators"
                                           data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                                       <button type="button" data-bs-target="#carouselExampleIndicators"
                                           data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                       </div> -->
                                    <div class="carousel-inner">
                                       <div class="carousel-item active">
                                          <img class="d-block w-100" src="<?php echo $services_img['image'] ?>"
                                             alt="First slide">
                                       </div>
                                       <!-- <div class="carousel-item">
                                          <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                              alt="Second slide">
                                          </div>
                                          <div class="carousel-item">
                                          <img class="d-block w-100" src="assets/dist/images/pool33.jpg"
                                              alt="Third slide">
                                          </div> -->
                                    </div>
                                    <!-- <button class="carousel-control-prev" type="button"
                                       data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                       <span class="visually-hidden">Previous</span>
                                       </button>
                                       <button class="carousel-control-next" type="button"
                                       data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                       <span class="visually-hidden">Next</span>
                                       </button> -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--/. image gallery -->
                     <td>
                        <a href="#"
                           class="btn btn-warning shadow btn-xs sharp me-1"
                           id="edit_shuttle_data" data-bs-toggle="modal" data-idshuttle="<?= $sh_f_s['front_ofs_service_id'] ?>" 
                           data-bs-target="#edit_shuttle_model"><i
                           class="fa fa-pencil"></i></a>
                        <!-- <a href="#" onclick="delete_data(<?php echo $sh_f_s['front_ofs_service_id'] ?>)"
                           class="btn btn-info shadow btn-xs sharp"><i
                               class="fa fa-list"></i></a> -->
                        <a  href="#" title="Availability"
                           class="btn btn-info shadow btn-xs sharp" onclick="orderservice1(<?php echo $sh_f_s['front_ofs_service_id'] ?>)" ><i
                           class="fa fa-list"  ></i></a>
                     </td>
                     <!-- <td>
                        <div class="active_deactive"><label class="switchToggle">
                           <input type="hidden" name="sub_icon_id" class="active_deactive_subid" value="<?php echo $sub_icon_id; ?>">
                           <input type="checkbox" name="yes_no" active-deactive-subid="<?php echo $sub_icon_id; ?>" class="yes_no" data-id="<?php echo $sh_f_s['front_ofs_service_id'] ?>" <?php if ($sh_f_s['status'] == 1) {echo "checked='checked'";}?>>
                           <span class="slider yellow round"></span></label>
                        </div>
                     </td> -->
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
                              <h5 class="modal-title">Tearm & Conditions</h5>
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
                  <?php
}
    }

    ?>
               </tbody>
            </table>
         </div>
      </div>
      <?php
if ($list) {
        foreach ($list as $sh_f_s) {
            ?>
     
     <div class="modal fade" id="edit_shuttle_model" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Edit schedule</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                           </button>
                        </div>
                        <form id="editshuttleCenterForm" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                     <div class="col-lg-12">
                        <div class="basic-form">
                           <input type="hidden" name="front_ofs_service_id" value="<?php echo $sh_f_s['front_ofs_service_id'] ?>">
                           <input type="hidden" class="form-control" value="4" name="service_name">
                           <div class="row">
                              <div class="mb-3 col-md-6 form-group">
                                 <label class="form-label">Staff Name</label>
                                 <input type="text" name="staff_name" value="<?php echo $sh_f_s['staff_name'] ?>" class="form-control" value="Amit Sahane" required="">
                              </div>
                              <div class="mb-3 col-md-6 form-group">
                                 <label class="form-label">Contact Number</label>
                                 <input type="text" name="contact_no" maxlength="10" value="<?php echo $sh_f_s['contact_no'] ?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                              </div>
                           </div>
                           <div class="row">
                              <div class="mb-3 col-md-6 form-group">
                                 <label class="form-label">Description</label>
                                 <textarea class="summernote" name="description" rows="3" id="comment"
                                    required=""><?php echo $sh_f_s['description'] ?></textarea>
                              </div>
                              <div class="mb-3 col-md-6 form-group">
                                 <label class="form-label">Terms & Conditions</label>
                                 <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                    required=""><?php echo $sh_f_s['t_nd_c'] ?></textarea>
                              </div>
                           </div>
                           <?php
$wh1 = '(front_ofs_service_id = "' . $sh_f_s['front_ofs_service_id'] . '")';

            $services_imgs = $this->MainModel->getData('front_ofs_services_images', $wh1);

            // $j = 0;

            if ($services_imgs) {

                ?>
                           <div class="mb-3 col-md-6 form-group">
                              <label class="form-label">Pictures</label>
                              <span class="img2"></span>
                              <?php
// foreach($services_imgs as $se_i)
                // {
                ?>
                              <input type="hidden" name="shuttle_service_image_id" value="<?php echo $services_imgs['front_ofs_service_image_id'] ?>">
                              <input type="file" class="dropify form-control" name="shuttle_img" id="files" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $services_imgs['image'] ?>">
                              <br>
                              <output id="Filelist"></output>
                              <?php
//     $j++;
                // }
                ?>
                           </div>
                           <?php
}
            ?>
                           <div>
                           </div>
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
      <?php
}
    }
    ?>
      <div class="accepted_orders_div_service"style="display: none;">
         <div class="col-md-3">
            <select class="form-control" id="days">
               <option value="Sunday">Sunday</option>
               <option value="Monday">Monday</option>
               <option value="Tuesday">Tuesday</option>
               <option value="Wednesday">Wednesday</option>
               <option value="Thursday">Thursday</option>
               <option value="Friday">Friday</option>
               <option value="Saturday">Saturday</option>
            </select>
         </div>
         <div class="sunday_div">
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Sunday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Sunday Availability</b></h4>
            <div class="table-scrollable">
               <table id="acceptedOrder_tb5" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable" class="append_data">
                     <?php
if ($sun_list) {
        foreach ($sun_list as $sun_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($sun_l['start_time'])) . " - " . date('h:i a', strtotime($sun_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($sun_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="monday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Monday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Monday Availability</b></h4>
            <div class="table-scrollable">
               <table id="monday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($mon_list) {
        foreach ($mon_list as $ml) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($ml['start_time'])) . " - " . date('h:i a', strtotime($ml['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($ml['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $ml['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $ml['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $ml['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $ml['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="tuesday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Tuesday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Tuesday Availability</b></h4>
            <div class="table-scrollable">
               <table id="tuesday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($tue_list) {
        foreach ($tue_list as $tuel) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($tuel['start_time'])) . " - " . date('h:i a', strtotime($tuel['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($tuel['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $tuel['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $tuel['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $tuel['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $tuel['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="wednesday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Wednesday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Wednesday Availability</b></h4>
            <div class="table-scrollable">
               <table id="wednesday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($wed_list) {
        foreach ($wed_list as $wed_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($wed_l['start_time'])) . " - " . date('h:i a', strtotime($wed_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($wed_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $wed_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $wed_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="thursday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Thursday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Thursday Availability</b></h4>
            <div class="table-scrollable">
               <table id="thursday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($thurs_list) {
        foreach ($thurs_list as $thu_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($thu_l['start_time'])) . " - " . date('h:i a', strtotime($thu_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($thu_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $thu_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $thu_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $thu_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="friday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Friday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Friday Availability</b></h4>
            <div class="table-scrollable">
               <table id="friday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($fri_list) {
        foreach ($fri_list as $fr_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($fr_l['start_time'])) . " - " . date('h:i a', strtotime($fr_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($fr_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $fr_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $fr_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $fr_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $fr_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="saturday_div" style="display: none;" >
            <br>
            <form id="editshuttleCenterForm12" method="post">
               <input type="hidden" name="day" value="Saturday">
               <input type="hidden" name="front_ofs_service_id" value="1">
               <div class="row ">
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">Start Time</label>
                     <div class="input-group">
                        <input type="time" name="start_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mb-3 col-md-3 form-group">
                     <label class="form-label">End Time</label>
                     <div class="input-group">
                        <input type="time" name="end_time" class="form-control" required>
                     </div>
                  </div>
                  <div class="mt-4 col-md-3 form-group">
                     <button type="submit" class="btn btn-info"
                        style="margin-top: 7px;">Add
                     </button>
                  </div>
               </div>
            </form>
            <h4 class="card-title"><b>Saturday Availability</b></h4>
            <div class="table-scrollable">
               <table id="saturday_tbl" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Timing</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
if ($sat_list) {
        foreach ($sat_list as $sat_l) {
            ?>
                     <tr>
                        <td><strong><?php echo date('h:i a', strtotime($sat_l['start_time'])) . " - " . date('h:i a', strtotime($sat_l['end_time'])) ?> </strong></td>
                        <td>
                           <div class="container">
                              <label class="switch">
                              <?php
if ($sat_l['available_status'] == 1) {
                ?>
                              <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sat_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sat_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                              <span class="switch-label" data-on="Available"></span>
                              <span class="switch-handle"></span>
                              <?php
} else {
                ?>
                              <input type="checkbox" value="1" name="available_status" id="status_<?php echo $sat_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sat_l['shuttle_service_avaibility_id'] ?>)" class="switch-input">
                              <span class="switch-label" data-off="Unavailable"></span>
                              <span class="switch-handle"></span>
                              <?php
}
            ?>
                              </label>
                           </div>
                        </td>
                     </tr>
                     <?php
}
    }
    ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function(id) {
         $(document).on('click', '#edit_shuttle_data', function() {
            var id = $(this).attr('data-idshuttle');
            // alert(id);
            $.ajax({
               url: '<?= base_url('FrontofficeController/geteditshuttleData') ?>',
               type: "post",
               data: {
                  id: id
               },
               dataType: "json",
               success: function(data) {

                  console.log(data.data.image);
                  $('#front_ofs_service_id3').val(data.data.front_ofs_service_id);
                  $('#staff_name3').val(data.data.staff_name);
                  $('#contact_no3').val(data.data.contact_no);

                  $('#comment3').summernote('code', data.data.description);
                  $('#comment4').summernote('code', data.data.t_nd_c);
                  // $('#front_ofs_service_image').val(data.images.front_ofs_service_image_id);
                  $(".img2").html("<img src='" + data.data.image + "' height='50px' width='50px' />");

                  $('.t_nd_c_view').html(data.data.t_nd_c);
                  $('.description_view').html(data.data.description);
                  // $("#img3").attr('src',data.images.image);

               }

            });
         })
      });
      
      $(document).unbind('submit').on('submit', '#editshuttleCenterForm12', function(e) {
         //   alert('hi');die;
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
            url: '<?= base_url('FrontofficeController/add_shuttle_service_staff_avaibility') ?>',
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               console.log(res);
               setTimeout(function() {
                  $(".loader_block").hide();
                  $(".sunday_div").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
      //  update business center data
      $(document).bind('submit').on('submit', '#editshuttleCenterForm', function(e) {
         //   alert('hi');die;
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
               setTimeout(function() {
                  $(".loader_block").hide();
                  $("#edit_shuttle_model").modal('hide');
                  $(".shuttle_new_data").html(res);
                  $(".updatemessage").show();
               }, 2000);
               setTimeout(function() {
                  $(".updatemessage").hide();
               }, 4000);



            }
         });
      });
   </script>
<?php } elseif ($sub_icon_id == 5) {?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header>Baby Care Information</header>
         <!-- <div class="tools">
            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div> -->
      </div>
      <div class="card-body ">
         <div class="table-scrollable">
            <table id="example1" class="display full-width">
               <thead>
                  <tr>
                     <th>Sr.No.</th>
                     <th>Picture</th>
                     <th>Staff Name</th>
                     <th>Phone</th>
                     <!-- <th>Start Time</th> -->
                     <th>Open Time</th>
                     <th>Break Time</th>
                     <!-- <th>End Time</th> -->
                     <th>Description</th>
                     <th>Terms</th>
                     <th>Action</th>
                     <!-- <th>Status</th> -->
                  </tr>
               </thead>
               <tbody class="baby_new_data">
                  <?php
$i = 1; //+ $this->uri->segment(2);
    if ($list) {
        foreach ($list as $baby_f_s) {
            $wh = '(front_ofs_service_id = "' . $baby_f_s['front_ofs_service_id'] . '")';

            $services_img = $this->MainModel->getData('front_ofs_services_images', $wh);
            ?>
                  <tr>
                     <td><?php echo $i++ ?></td>
                     <td>
                        <div class="lightgallery"
                           class="room-list-bx d-flex align-items-center">
                           <a href="<?php echo $services_img['image'] ?>"
                              data-exthumbimage="<?php echo $services_img['image'] ?>"
                              data-src="<?php echo $services_img['image'] ?>"
                              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                           <img class="me-3 "
                              src="<?php echo $services_img['image'] ?>"
                              alt="" style="width:50px; height:40px;">
                           </a>
                        </div>
                     </td>
                     <td><?php echo $baby_f_s['staff_name'] ?></td>
                     <td><?php echo $baby_f_s['contact_no'] ?></td>
                     <!-- <td><?php //echo $baby_f_s['open_time'] ?> - <?php //echo $baby_f_s['close_time'] ?></td>
                     <td><?php //echo $baby_f_s['break_start_time'] ?> - <?php //echo $baby_f_s['break_close_time'] ?></td> -->
                     <td><?php echo date('h:i a', strtotime($baby_f_s['open_time'])) . "-" . date('h:i a', strtotime($baby_f_s['close_time'])) ?></td> 
                     <td><?php echo date('h:i a', strtotime($baby_f_s['break_start_time'])) . "-" . date('h:i a', strtotime($baby_f_s['break_close_time'])) ?></td>
                     <!-- <td>
                        <button class="btn btn-secondary_<?php echo $baby_f_s['front_ofs_service_id'] ?> shadow btn-xs sharp me-1"><i
                            class="fa fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a href="#"
                           class="btn btn-secondary shadow btn-xs sharp me-1"
                           data-bs-toggle="modal" id="edit_baby_data" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>"
                           data-bs-target=".bd-terms-modal-sm"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div>
                           <span class="badge light badge-warning"
                              data-bs-toggle="modal" id="edit_baby_data" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>"
                              data-bs-target="#exampleModalCenter">View</span>
                        </div>
                     </td>
                     <!-- modal for terms and conditions -->
                     <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Terms And Conditions</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <span class="t_nd_c_view"></span>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <td>
                        <div class="d-flex">
                        <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_baby_data" data-bs-toggle="modal" data-idbaby="<?= $baby_f_s['front_ofs_service_id'] ?>" data-bs-target="#edit_baby_model"><i class="fa fa-pencil"></i></a>

                           <!-- <a href="#" id="delete_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
                              class="btn btn-danger shadow btn-xs sharp"><i
                                  class="fa fa-trash"></i></a> -->
                        </div>
                     </td>
                     <!-- <td>
                        <div class="active_deactive"><label class="switchToggle">
                           <input type="hidden" name="sub_icon_id" class="active_deactive_subid" value="<?php echo $sub_icon_id; ?>">
                           <input type="checkbox" name="yes_no" active-deactive-subid="<?php echo $sub_icon_id; ?>" class="yes_no" data-id="<?php echo $baby_f_s['front_ofs_service_id'] ?>" <?php if ($baby_f_s['status'] == 1) {echo "checked='checked'";}?>>
                           <span class="slider yellow round"></span></label>
                        </div>
                     </td> -->
                  </tr>
                  <!-- modal for terms  -->
                  <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
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
                  <?php
}
    }

    ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- edit model start -->
<?php
if ($list) {
        foreach ($list as $baby_f_s) {
            ?>
<div class="modal fade " id="edit_baby_model" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Edit schedule</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form id="editbabyCenterForm" method="post" enctype="multipart/form-data">
            <div class="modal-body">
               <div class="col-lg-12">
                  <div class="basic-form">
                     <input type="hidden" name="front_ofs_service_id" id="front_ofs_service_id">
                     <input type="hidden" class="form-control" value="5" name="service_name">
                     <div class="row">
                        <div class="mb-3 col-md-6 form-group">
                           <label class="form-label">Staff Name</label>
                           <input type="text" name="staff_name" id="staff_name" class="form-control" value="Amit Sahane" required="">
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
                           <textarea class="summernote" name="description" rows="3" id="description"
                              required=""></textarea>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                           <label class="form-label">Terms & Conditions</label>
                           <textarea class="summernote" name="t_nd_c" rows="3" id="t_nd_c"
                              required=""></textarea>
                        </div>
                     </div>
                     <?php
$wh1 = '(front_ofs_service_id = "' . $baby_f_s['front_ofs_service_id'] . '")';

            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images', $wh1);

            $j = 0;

            if ($services_imgs) {

                ?>
                     <div class="mb-3 col-md-6 form-group">
                        <label class="form-label">Pictures</label>
                        <span class="img2"></span>
                        <?php
foreach ($services_imgs as $se_i) {
                    ?>
                        <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id'] ?>">
                        <input type="file" class="dropify form-control" name="image[<?php echo $j ?>]" id="files" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $se_i['image'] ?>">
                        <br>
                        <output id="Filelist"></output>
                        <?php
$j++;
                }
                ?>
                     </div>
                     <?php
}
            ?>
                     <div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
    $(document).ready(function(id) {
               $(document).on('click', '#edit_baby_data', function() {
                  var id = $(this).attr('data-idbaby');
                  // alert(id);
                  $.ajax({
                     url: '<?= base_url('FrontofficeController/geteditbabyData') ?>',
                     type: "post",
                     data: {
                        id: id
                     },
                     dataType: "json",
                     success: function(data) {

                        console.log(data);
                        $('#front_ofs_service_id').val(data.front_ofs_service_id);
                        $('#staff_name').val(data.staff_name);
                        $('#contact_no').val(data.contact_no);
                        $('#open_time').val(data.open_time);
                        $('#close_time').val(data.close_time);
                        $('#break_start_time').val(data.break_start_time);
                        $('#break_close_time').val(data.break_close_time);
                        // $('#comment1').val(data.comment);
                        $('#description').summernote('code', data.description);
                        $('#t_nd_c').summernote('code', data.t_nd_c);

                        $('.t_nd_c_view').html(data.t_nd_c);
                        $('.description_view').html(data.description);
                        $(".img2").html("<img src='" + data.image + "' height='50px' width='50px' />");
                        // $("#img4").val(data.image);



                     }


                  });
               })
            });

            //  update business center data
            $(document).bind('submit').on('submit', '#editbabyCenterForm', function(e) {
               //   alert('hi');die;
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
                     setTimeout(function() {
                        $(".loader_block").hide();
                        $("#edit_baby_model").modal('hide');
                        $(".baby_new_data").html(res);
                        $(".updatemessage").show();
                     }, 2000);
                     setTimeout(function() {
                        $(".updatemessage").hide();
                     }, 4000);



                  }
               });
            });
   </script>
<?php
}
    }
    ?>
<!-- edit model end -->
<?php } elseif ($sub_icon_id == 6) {?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
   <header><span class="page_header_title">Car Wash Request</span></header>
   <div class="tools">
      <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
      <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
      <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
   </div>
</div>
<div class="card-body ">
<div class="col-md-12 col-sm-12">
   <div class="panel tab-border card-box">
      <header class="panel-heading panel-heading-gray custom-tab">
         <ul class="nav nav-tabs">
            <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Car Wash Request</a>
            </li>
            <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Accepted Car Wash Request</a>
            </li>
            <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">Rejected Car Wash Request</a>
            </li>
            <li class="nav-item"><a href="#completed_orders_div_new" data-bs-toggle="tab">Completed Car Request</a>
            </li>
            <li class="nav-item"><a href="#arrival4_div" data-bs-toggle="tab">Washing Charges</a>
            </li>
         </ul>
      </header>
   </div>
</div>
<div class="btn-group r-btn">
   <button id="addRow1" class="btn btn-info add_car_request">
   Add Request
   </button>
</div>
<!-- <div class="col-md-3">
   <select class="form-control" id="orderserviceDropdown">
       <option value="new_orders">Car Wash Request</option>
       <option value="accepted_order">Accepted Car Wash Request</option>
       <option value="rejected_order">Washing Charges</option>

   </select>
   </div> -->
<div class="new_orders_div">
<br>
<div class="col-md-6">
   <div class="input-group">
      <input type="date" class="form-control"
         placeholder="2017-06-04">
      <input type="time" class="form-control"
         placeholder="2017-06-04">
      <input type="text" class="form-control"
         placeholder="Vehicle Name">
      <button class="btn btn-warning  btn-sm "><i
         class="fa fa-search"></i></button>
   </div>
</div>
<div class="tab-content">
   <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
      <div class="table-scrollable1">
         <table id="example1" class="display full-width">
            <thead>
               <tr>
                  <th><strong>Sr. No.</strong></th>
                  <th><strong>Guest Name</strong></th>
                  <th><strong>Phone</strong></th>
                  <!-- <th><strong>Email</strong></th> -->
                  <th><strong>Request Date</strong></th>
                  <th><strong>Request Time</strong></th>
                  <th><strong>Vehicle Name</strong></th>
                  <th><strong>Vehicle No.</strong></th>
                  <th><strong>Photo</strong></th>
                  <th><strong>Note</strong></th>
                  <!-- <th><strong>Terms</strong></th> -->
                  <th><strong>Assign</strong></th>
                  <!-- <th><strong>Status</strong></th> -->
               </tr>
            </thead>
            <tbody id="searchTable" class="append_carwash">
               <?php
$j = 1;
    if ($vehicle_wash_request) {
        foreach ($vehicle_wash_request as $v_w_r) {
            $wh = '(u_id = "' . $v_w_r['u_id'] . '")';

            $user_data = $this->FrontofficeModel->getData('register', $wh);

            if ($user_data) {
                ?>
               <tr>
                  <td><strong><?php echo $j++ ?></strong></td>
                  <td><?php echo $user_data['full_name'] ?></td>
                  <td><?php echo $user_data['mobile_no'] ?></td>
                  <td><?php echo $v_w_r['select_date'] ?></td>
                  <!-- <td>23/12/2022</td> -->
                  <td><?php echo date('h:i a', strtotime($v_w_r['select_time'])) ?></td>
                  <!-- <td>07:50 PM</td> -->
                  <td><?php echo $v_w_r['vehicle_name'] ?></td>
                  <td><?php echo $v_w_r['vehicle_no'] ?></td>
                  <td>
                     <div id="lightgallery"
                        class="room-list-bx  align-items-center">
                        <a href="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-exthumbimage="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-src="<?php echo $v_w_r['vehicle_img'] ?>"
                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                           src="<?php echo $v_w_r['vehicle_img'] ?>" alt=""
                           style="width:50px;">
                        </a>
                     </div>
                  </td>
                  <!-- <td>
                     <button class="btn btn-secondary_<?php echo $v_w_r['vehicle_wash_request_id'] ?> shadow btn-xs sharp"
                         data-toggle="popover"><i
                             class="fa fa-eye"></i></button>

                     </td> -->
                  <td>
                  <!-- <a href="#"  class="btn btn-secondary shadow btn-xs sharp me-1" 
                                             data-bs-toggle="modal" id="edit_data" 
                                             data-id="<?php echo $g_f_s['id'];?>" 
                                             data-bs-target=".exampleModalCenter"><i class="fa fa-eye"></i></a>  -->
                     <a style="margin:auto" data-bs-toggle="modal" id="edit_data"
                        data-bs-target=".bd-terms-modal-sm" data-id="<?php echo $v_w_r['vehicle_wash_request_id'] ?>"
                        class="btn btn-secondary shadow btn-xs sharp"><i
                        class="fa fa-eye"></i></a>
                  </td>
                  <td>
                  <div>
                                                   <a href="#" class="btn btn-warning shadow btn-xs sharp update_car_modal_btn" id="edit_car_data" data-id2="<?= $v_w_r['vehicle_wash_request_id'] ?>"><i class="fa fa-share"></i></a>
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
                           <span class="d-block mb-2 description_view"></span>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
}
        }
    }
    ?>
            </tbody>
         </table>
      </div>
   </div>
  
   <div class="tab-pane" id="completed_orders_div_new"  style="background-color:white;">
               <div class="table-scrollable7">
                  <table id="completedOrder_tb" class="display full-width">
                     <thead>
                        <tr>
                           <th><strong>Sr. No.</strong></th>
                           <th><strong>Guest Name</strong></th>
                           <th><strong>Phone</strong></th>
                           <!-- <th><strong>Email</strong></th> -->
                           <th><strong>Request Date</strong></th>
                           <th><strong>Request Time</strong></th>
                           <th><strong>Vehicle Type</strong></th>
                           <th><strong>Vehicle No.</strong></th>
                           <th><strong>Photo</strong></th>
                           <th><strong>Status</strong></th>
                        </tr>
                     </thead>
                     <tbody id="searchTable">
                     <?php
$j = 1;

    if ($vehicle_wash_request7) {
        foreach ($vehicle_wash_request7 as $v_w_c) {
            $wh = '(u_id = "' . $v_w_c['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            if ($user_data) {
                ?>
                        <tr>
                           <td><strong><?php echo $j++ ?></strong></td>
                           <td><?php echo $user_data['full_name'] ?></td>
                           <td><?php echo $user_data['mobile_no'] ?></td>
                           <td><?php echo $v_w_c['select_date'] ?></td>
                           <td><?php echo date('h:i a', strtotime($v_w_c['select_time'])) ?></td>
                           <td><?php echo $v_w_c['vehicle_name'] ?></td>
                           <td><?php echo $v_w_c['vehicle_no'] ?></td>
                           <td>
                              <div id="lightgallery"
                                 class="room-list-bx  align-items-center">
                                 <a href="<?php echo $v_w_c['vehicle_img'] ?>"
                                    data-exthumbimage="<?php echo $v_w_c['vehicle_img'] ?>"
                                    data-src="<?php echo $v_w_c['vehicle_img'] ?>"
                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                 <img class="me-3 "
                                    src="<?php echo $v_w_c['vehicle_img'] ?>" alt=""
                                    style="width:50px;">
                                 </a>
                              </div>
                           </td>
                           <td>
                              <div class="d-flex">
                                 <a href="#"><span class="badge badge-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="">Completed</span>
                                 </a>
                              </div>
                           </td>
                        </tr>
                        <?php
}
        }
    }
    ?>
                        </tbody>
                        </table>
                        </div>
                     </div>
   <div class="tab-pane" style="background-color:white;" id="arrival3_div">
      <div class="table-scrollable1">
         <table id="acceptedOrder_tb3"  class="display full-width">
            <thead>
               <tr>
                  <th><strong>Sr. No.</strong></th>
                  <th><strong>Guest Name</strong></th>
                  <th><strong>Phone</strong></th>
                  <!-- <th><strong>Email</strong></th> -->
                  <th><strong>Request Date</strong></th>
                  <th><strong>Request Time</strong></th>
                  <th><strong>Reject Reason</strong></th>
                  <th><strong>Vehicle Name</strong></th>
                  <th><strong>Vehicle No.</strong></th>
                  <th><strong>Photo</strong></th>
                  <!-- <th><strong>Terms</strong></th> -->
                  <th><strong>Assign</strong></th>
                  <!-- <th><strong>Status</strong></th> -->
               </tr>
            </thead>
            <tbody id="searchTable" class="append_carwash">
               <?php
$j = 1;
    if ($vehicle_wash_request3) {
        foreach ($vehicle_wash_request3 as $v_w_r) {
            $wh = '(u_id = "' . $v_w_r['u_id'] . '")';

            $user_data = $this->FrontofficeModel->getData('register', $wh);

            if ($user_data) {
                ?>
               <tr>
                  <td><strong><?php echo $j++ ?></strong></td>
                  <td><?php echo $user_data['full_name'] ?></td>
                  <td><?php echo $user_data['mobile_no'] ?></td>
                  <td><?php echo $v_w_r['select_date'] ?></td>
                  <td><?php echo date('h:i a', strtotime($v_w_r['select_time'])) ?></td>
                  <td>
                                    <?php 
                                   
                                    // print_r($spa_r_s['reject_reason']);
                                    // exit;
                                       if($v_w_r['reject_reason'] == 0)
                                       {
                                          $reject_reason = '';
                                       }
                                       elseif($v_w_r['reject_reason'] == 1)
                                       {
                                          $reject_reason = 'Please Try After Sometime';
                                       }
                                       elseif($v_w_r['reject_reason'] == 2)
                                       {
                                          $reject_reason = 'Temporarily Unavailable';
                                       }
                                       elseif($v_w_r['reject_reason'] == 3)
                                       {
                                          $reject_reason = 'Vehicle Not Identified';
                                       }
                                       elseif($v_w_r['reject_reason'] == 4)
                                       {
                                          $reject_reason = 'Please Contact Front Office';
                                       }
                                    ?>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo  $reject_reason;?></h5>
                                    </div>
                                 </td>
                  <td><?php echo $v_w_r['vehicle_name'] ?></td>
                  <td><?php echo $v_w_r['vehicle_no'] ?></td>
                  <td>
                     <div id="lightgallery"
                        class="room-list-bx  align-items-center">
                        <a href="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-exthumbimage="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-src="<?php echo $v_w_r['vehicle_img'] ?>"
                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                           src="<?php echo $v_w_r['vehicle_img'] ?>" alt=""
                           style="width:50px;">
                        </a>
                     </div>
                  </td>
                 
                  <td>
                     <?php
if ($v_w_r['request_status'] == 1) {
                    ?>
                     <span class="badge badge-success">Accepted</span>
                     <?php
} elseif ($v_w_r['request_status'] == 2) {
                    ?>
                     <span class="badge badge-danger">Rejected</span>
                     <?php
}
                ?>
                  </td>
               </tr>
               <div class="modal fade bd-terms-modal-sm_<?php echo $v_w_r['vehicle_wash_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Description</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                           </button>
                        </div>
                        <div class="modal-body">
                           <div class="col-lg-12">
                              <span><?php echo $v_w_r['note'] ?></span>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
}
        }
    }
    ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="tab-pane" style="background-color:white;" id="arrival4_div">
      <div class="table-scrollable">
         <table id="acceptedOrder_tb" class="display full-width">
            <thead>
               <tr>
                  <th>Sr. No.</th>
                  <th>Vehicle Type</th>
                  <th>Charges</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody id="searchTable">
               <?php
$i = 1;

    if ($vehicle_wash_request2) {
        foreach ($vehicle_wash_request2 as $v_wash_char) {

            ?>
               <tr>
                  <td>
                     <h5 class="text-nowrap"><?php echo $i++ ?></h5>
                  </td>
                  <td>
                     <h5 class="text-nowrap"><?php echo $v_wash_char['vehicle_type'] ?></h5>
                  </td>
                  <td>
                     <h5> <i class="fa fa-rupees"><?php echo $v_wash_char['charges'] ?></i></h5>
                  </td>
                  <td>
                     <div>
                        <a href="#"
                           class="btn btn-warning shadow btn-xs sharp me-1"
                           data-bs-toggle="modal"
                           data-bs-target="#exampleModalCenter2_<?php echo $v_wash_char['vehicle_washing_charge_id'] ?>"><i
                           class="fa fa-pencil"></i></a>
                        <a href="#"  onclick="delete_data_car(<?php echo $v_wash_char['vehicle_washing_charge_id'] ?>)"
                           class="btn btn-danger shadow btn-xs sharp"><i
                           class="fa fa-trash"></i></a>
                     </div>
                     <!-- edit -->
                     <div class="modal fade" id="exampleModalCenter2_<?php echo $v_wash_char['vehicle_washing_charge_id'] ?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Update Washing Charges</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <form action="<?php echo base_url('FrontofficeController/edit_vehicle_washing_charges') ?>" method="post">
                                 <input type="hidden" name="vehicle_washing_charge_id" value="<?php echo $v_wash_char['vehicle_washing_charge_id'] ?>">
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Vehicle Type</label>
                                          <input type="text" class="form-control" name="vehicle_type" value="<?php echo $v_wash_char['vehicle_type'] ?>">
                                       </div>
                                       <div class="mb-3 col-md-12 form-group">
                                          <label class="form-label">Charges</label>
                                          <input type="number" class="form-control" name="charges" value="<?php echo $v_wash_char['charges'] ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <!-- /. edit -->
                  </td>
               </tr>
               <?php
}
    }
    ?>
            </tbody>
         </table>
      </div>
   </div>
   <div class="tab-pane" style="background-color:white;" id="arrival2_div">
      <div class="table-scrollable">
         <table id="completedOrder_tb2" class="display full-width">
            <thead>
               <tr>
                  <th><strong>Sr. No.</strong></th>
                  <th><strong>Guest Name</strong></th>
                  <th><strong>Phone</strong></th>
                  <!-- <th><strong>Email</strong></th> -->
                  <th><strong>Request Date</strong></th>
                  <th><strong>Request Time</strong></th>
                  <th><strong>Vehicle Type</strong></th>
                  <th><strong>Vehicle No.</strong></th>
                  <th><strong>Photo</strong></th>
                  <th><strong>Status</strong></th>
               </tr>
            </thead>
            <tbody id="searchTable">
               <?php
$j = 1;

    if ($vehicle_wash_request1) {
        foreach ($vehicle_wash_request1 as $v_w_r) {
            $wh = '(u_id = "' . $v_w_r['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            if ($user_data) {
                ?>
               <tr>
                  <td><strong><?php echo $j++ ?></strong></td>
                  <td><?php echo $user_data['full_name'] ?></td>
                  <td><?php echo $user_data['mobile_no'] ?></td>
                  <td><?php echo $v_w_r['select_date'] ?></td>
                  <td><?php echo date('h:i a', strtotime($v_w_r['select_time'])) ?></td>
                  <td><?php echo $v_w_r['vehicle_name'] ?></td>
                  <td><?php echo $v_w_r['vehicle_no'] ?></td>
                  <td>
                     <div id="lightgallery"
                        class="room-list-bx  align-items-center">
                        <a href="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-exthumbimage="<?php echo $v_w_r['vehicle_img'] ?>"
                           data-src="<?php echo $v_w_r['vehicle_img'] ?>"
                           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                        <img class="me-3 "
                           src="<?php echo $v_w_r['vehicle_img'] ?>" alt=""
                           style="width:50px;">
                        </a>
                     </div>
                  </td>
                  <input type="hidden" name="user_id" id="uid<?php echo $v_w_r['vehicle_wash_request_id'];?>" value="<?php echo $v_w_r['vehicle_wash_request_id'];?>">
                           <td>
                           <select class="form-control" name="status" id="carwashstatus<?php echo $v_w_r['vehicle_wash_request_id'];?>" onchange="car_change_status(<?php echo $v_w_r['vehicle_wash_request_id']?>);" style="min-width:85px;text-align:center">
                          <?php 
                                if($v_w_r['request_status']== "1") 
                                {
                          ?>
                                <option value="1" selected>Accepted</option>
                                <option value="4">Completed</option>
                          <?php 
                                }
                          ?>
                       </select>
                           </td>
               </tr>
               <?php
}
        }
    }
    ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<div class="rejected_orders_div" style="display: none;">
   <div>
      <button style="float:right" type="button" class="btn btn-primary css_btn"
         data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">Add Washing
      Charges</button>
   </div>
   <br><br>
   <!-- add -->
   <div class="modal fade" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Washing Charges</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <form action="<?php echo base_url('FrontofficeController/add_vehicle_washing_charges') ?>" method="post">
               <div class="modal-body">
                  <div class="row">
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Vehicle Type</label>
                        <input type="text" name="vehicle_type" class="form-control" placeholder="Vehicle Type" required="">
                     </div>
                     <div class="mb-3 col-md-12 form-group">
                        <label class="form-label">Charges</label>
                        <input type="number" name="charges" class="form-control" placeholder="Charges" required="">
                     </div>
                  </div>
               </div>
               <div class="modal-footer text-center">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal_car" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="car_wash_request"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Car Wash Request</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Contact Number</label>
                     <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number"
                        required="">
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Booking ID</label>
                     <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID"
                        required="" disable>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Date</label>
                     <input type="date"   class="form-control minDate" name="request_date" placeholder="Date" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Timcar_we</label>
                     <input type="time" class="form-control minDate" name="request_time" placeholder="time" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Vehicle Name</label>
                     <input type="text"   class="form-control minDate" name="vehicle_name" placeholder="Vehicle Name" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Vehicle No.</label>
                     <input type="text"   class="form-control minDate" name="vehicle_no" placeholder="Vehicle No" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Vehicle Type</label>
                     <select  id="vehicle_washing_charge_id" name="vehicle_washing_charge_id" class="default-select form-control wide  dropdown js-example-disabled-results"
                        required="">
                        <option selected="">Select... </option>
                        <?php
$u_id = $this->session->userdata('u_id');
    $where = '(u_id = "' . $u_id . '")';
    $admin_details = $this->MainModel->getData($tbl = 'register', $where);
    $admin_id = $admin_details['hotel_id'];

    $vehicle_washing_charges = $this->ApiModel->get_hotel_vehicle_wash_charges($admin_id);

    foreach ($vehicle_washing_charges as $s_im) {
        ?>
                        <option value="<?php echo $s_im['vehicle_washing_charge_id'] ?>"><?php echo $s_im['vehicle_type'] ?></option>
                        <?php
}
    ?>
                     </select>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Upload image</label>
                     <input type="file" name="image" accept="image/jpeg, image/png," class="form-control" required="">
                  </div>
                  <div class="mb-3 col-md-12 form-group">
                     <label class="form-label">Note</label>
                     <!-- <div class="summernote"></div> -->
                     <textarea class="summernote" id="description1" name="additional_note" style="min-height: 400px;"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add
               </button>
            </div>
         </form>
      </div>
   </div>
</div>
 <!-- end add btn modal -->
 <div class="modal fade update_car_modal_change" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Edit Order status</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form id="frmupdateblock_car" method="post" enctype="multipart/form-data">
                     <div class="modal-body">
                        <div class="basic-form">
                           <div class="row">
                              <div class="mb-3 col-md-12">
                                 <input type="hidden" name="vehicle_wash_request_id" id="vehicle_wash_request_id1">

                                 <label class="form-label">Change Order Status</label>
                                 <select id="send_user1" name="request_status" class="default-select form-control wide" required>
                                    <option value="">Choose...</option>
                                    <option value="1">Accept</option>
                                    <option value="2">Reject</option>
                                 </select>
                              </div>
                           </div>
                           <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                        <label class="form-label">Reason For Rejecting</label>
                        <select id="reason" name="reject_reason" class="default-select form-control wide">
                           <option value="">Choose</option>
                           <option value="1">Please Try After Sometime</option>
                           <option value="2">Temporarily Unavailable</option>
                           <option value="3">Vehicle Not Identified</option>
                           <option value="4">Please Contact Front Office</option>
                        </select>
                     </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary css_btn">Save</button>
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- add btn modal  -->
         <script>
   $('#send_user1').on('change', function() {
       
       if (this.value == 1) {
         //   $('#user_list').
           $('.assignto').css('display','block');
           $('.rejectreasonddd').css('display','none');
           $('#status').prop('required', true);

           $('#reason').prop('required', false);
           $('#status').prop('required', true);

         //   $('.assignto').css('display','block');
         
       }
       else if(this.value == 2)  {
           $('.assignto').css('display','none');
           $('.rejectreasonddd').css('display','block');
           $('#reason').prop('required', true);
           $('#status').prop('required', false);
       }
   });
</script>
<script>
    $(document).on('click', '#edit_car_data', function() {
               var id = $(this).attr('data-id2');
               // alert(id);
               $.ajax({
                  url: '<?= base_url('FrontofficeController/getrequirement_car') ?>',
                  //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                  type: "post",
                  data: {
                     id: id
                  },
                  dataType: "json",
                  success: function(data) {
                     console.log(data.vehicle_wash_request[0]);
                     $('#vehicle_wash_request_id1').val(data.vehicle_wash_request[0].vehicle_wash_request_id);

                  }
               });
            })
    $(document).on("click", ".update_car_modal_btn", function() {
               $(".update_car_modal_change").modal('show');
            }); 
   $(document).unbind('submit').on('submit', '#car_wash_request', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?=base_url('FrontofficeController/add_carwash_request')?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {

              $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v1');?>', function( data ) {
                  var resu = $(data).find('.table-scrollable1').html();
                  $('.table-scrollable1').html(resu);
                  setTimeout(function(){
                      $('#example1').DataTable();
                  }, 2000);
              });
              setTimeout(function(){
               $(".loader_block").hide();
               $("#car_wash_request")[0].reset();
               $('#description1').summernote('reset');
               $(".add_facility_modal_car").modal('hide');
               $(".append_carwash").html(res);
                $(".successmessage").show();
                }, 2000);
              setTimeout(function(){
                  $(".successmessage").hide();
                }, 4000);

          }
      });
   });
   function car_change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#carwashstatus'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
               //  alert(uid);

              if (status != '') {

                  $.ajax({
                      url: base_url + "FrontofficeController/carwash_status",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                        console.log(data);
                        $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v1');?>', function( data ) {
                           var resu = $(data).find('#completed_orders_div_new').html();
                           $('#completed_orders_div_new').html(resu);
                           setTimeout(function(){
                              $('#completedOrder_tb').DataTable();
                              
                           }, 2000);
                           $('a[href="#completed_orders_div_new"]').tab('show');
                     });
                        setTimeout(function(){
                             
                              $(".successmessage").show();
                           }, 2000);
                        setTimeout(function(){
                              $(".loader_block").hide();
                              $(".successmessage").hide();
                           }, 4000); 
                        }
                  });
              }
          }
          $('#frmupdateblock_car').submit(function(e) {
               e.preventDefault();
               $(".loader_block").show();
               var form_data = new FormData(this);
               var base_url = '<?php echo base_url() ?>';
               //   console.log(base_url);
               //   return false;
               $.ajax({
                  url: base_url + "FrontofficeController/change_new_car_status",
                  type: 'POST',
                  data: form_data,
                  processData: false,
                  contentType: false,
                  cache: false,
                  success: function(res) {
                     console.log(res)
                     $.get('<?= base_url('FrontofficeController/ajaxOrderIconView_v1'); ?>', function(data) {
                        var resu = $(data).find('#arrival1_div').html();
                        var resu1 = $(data).find('#arrival2_div').html();
                        var resu2 = $(data).find('#arrival3_div').html();

                        $('#arrival1_div').html(resu);
                        $('#arrival2_div').html(resu1);
                        $('#arrival3_div').html(resu2);

                        setTimeout(function() {
                           $('#example1').DataTable();
                           $('#completedOrder_tb2').DataTable();
                           $('#acceptedOrder_tb3').DataTable();
                           // $('#rejectedOrder_tb_new').DataTable();
                        }, 2000);
                     });
                     setTimeout(function() {
                        $(".loader_block").hide();
                        $(".update_car_modal_change").modal('hide');
                        $(".update_car_modal_change").on("hidden.bs.modal", function() {
                           $("#frmupdateblock_car")[0].reset(); // reset the form fields
                        });
                        $(".updatemessage").show();
                        // $(".append_data12").html(res);

                        var request_status = form_data.get('request_status');
                         console.log(request_status); // Log the requestStatus value to the console

                        if (request_status === "1") {
                           $('a[href="#arrival2_div"]').tab('show');
                        $('.page_header_title_spa').text('Accept Spa Request');
                     } else if (request_status === "2") {
                        $('a[href="#arrival3_div"]').tab('show');
                        $('.page_header_title_spa').text('Reject Spa Request');

                     } }, 2000);
                     setTimeout(function() {
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
                                         url: '<?= base_url('FrontofficeController/getCarData') ?>',
                                         //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                         type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                            
                                          //   console.log(data);
                                            $('.description_view').html(data.note);
                                            
                                          //   $('#ids').val(data.id);
                                          //   $('#room_nos').val(data.room_no);
                                          //   $('#user_n').val(data.guest_name);
                                          //   $('#lost_item_name').val(data.lost_item_name);
                                          //   $('.item_name').val(data.item_name);
                                          //   $('#lost_found_flag').val(data.lost_found_flag);
                                          //   $('#lost_found_date').val(data.lost_found_date);
                                          //   $('#lost_found_time').val(data.lost_found_time);
                                          //   $('#description').summernote('code', data.description);
                                          //  //  $('#img').val(data.img);
                                          //  $("#img").attr('src',data.img);
                } 
            }); 
           })
       });
   </script>
<?php } elseif ($sub_icon_id == 7) {?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
<div class="card card-topline-aqua">
   <div class="card-head">
      <header><span class="page_header_title1">Luggage Request</span></header>
      <div class="tools">
         <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
         <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
         <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
      </div>
   </div>
   <div class="card-body ">
   <div class="col-md-12 col-sm-12">
            <div class="panel tab-border card-box">
               <header class="panel-heading panel-heading-gray custom-tab">
                  <ul class="nav nav-tabs">
                     <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Luggage Request</a>
                     </li>
                     <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Accepted Luggage Request</a>
                     </li>
                     <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">Rejected Luggage Request</a>
                     </li>
                     <li class="nav-item"><a href="#completed_orders_div1_new" data-bs-toggle="tab">Luggage Return</a>
                  </li>
                  </ul>
               </header>
            </div>
         </div>
      <div class="btn-group r-btn">
         <button id="addRow1" class="btn btn-info add_luggage">
         Add Request
         </button>
      </div>
      <div class="new_orders_div1">
         <br>
         <div class="col-md-6">
            <div class="input-group">
               <input type="date" class="form-control"
                  placeholder="2017-06-04">
               <input type="time" class="form-control"
                  placeholder="2017-06-04">
               <input type="text" class="form-control"
                  placeholder="Luggage Type">
               <button class="btn btn-warning  btn-sm "><i
                  class="fa fa-search"></i></button>
            </div>
         </div>
      <div class="tab-content">
         <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
            <div class="table-scrollable">
               <table id="example1" class="display full-width">
                  <thead>
                     <tr>
                     <th><strong>Sr. No.</strong></th>
                     <th><strong>Guest Name</strong></th>
                     <th><strong>Mobile Number</strong></th>
                     <th><strong>Date</strong></th>
                     <th><strong>Time</strong></th>
                     <th><strong>Qty</strong></th>
                     <th><strong>Note</strong></th>
                     <th><strong>Action</strong></th>
                  </tr>
               </thead>
               <tbody id="searchTable" class="append_luggage_data">
                  <?php
$j = 1;

    if ($luggage_request) {
        foreach ($luggage_request as $lug_r) {
            $wh = '(u_id = "' . $lug_r['u_id'] . '")';

            $user_data = $this->FrontofficeModel->getData('register', $wh);

            if ($user_data) {

                ?>
                  <tr>
                     <td><strong><?php echo $j++ ?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo $lug_r['select_date'] ?></td>
                     <td><?php echo date('h:i a', strtotime($lug_r['select_time'])) ?></td>
                     <td><?php echo $lug_r['quantity'] ?></td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <div>
                           <a href="#" class="btn btn-warning shadow btn-xs sharp me-1 update_luggage_modal_btn" id="edit_luggage_data" data-id3="<?= $lug_r['luggage_request_id'] ?>"><i class="fa fa-share"></i></a>
                        </div>
                     </td>
                  </tr>
                  
                  <div class="modal fade bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $lug_r['note'] ?></span>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
}
        }
    }
    ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="tab-pane" id="completed_orders_div1_new"  style="background-color:white;">
            <div class="table-scrollable14">
               <table id="completedOrder_tb1" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Guest Name</strong></th>
                        <th><strong>Mobile Number</strong></th>
                        <th><strong>Date</strong></th>
                        <th><strong>Time</strong></th>
                        <!-- <th><strong>Type Of Luggage</strong></th> -->
                        <th><strong>Qty</strong></th>
                        <th><strong>Note</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody class="append_luggage1" >
                  <?php
$j = 1;

    if ($luggage_request4) {
        foreach ($luggage_request4 as $lug_c) {
            $wh = '(u_id = "' . $lug_c['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            if ($user_data) {
                ?>
                     <tr>
                     <td><strong><?php echo $j++ ?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo $lug_c['select_date'] ?></td>
                     <td><?php echo date('h:i a', strtotime($lug_c['select_time'])) ?></td>
                     <!-- <td><?php //echo $lug_c['luggage_type'] ?></td> -->
                     <td><?php echo $lug_c['quantity'] ?></td>
                     <!-- <td>
                        <button
                            class="btn btn-secondary_<?php echo $lug_r['luggage_request_id'] ?> shadow btn-xs sharp me-1"><i
                                class="fas fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $lug_c['luggage_request_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a href="#">
                           <div class="badge badge-primary"
                              data-bs-toggle="modal"
                              data-bs-target="">
                                    Luggage Return
                           </div>
                        </a>
                     </td>
                  </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $lug_c['luggage_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Description</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $lug_c['note'] ?></span>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
}
        }
    }
    ?>
                     </tbody>
                     </table>
                     </div>
                     </div>
      <div class="tab-pane" style="background-color:white;" id="arrival3_div">
         <div class="table-scrollable">
            <table id="acceptedOrder_tb1" class="display full-width">
               <thead>
                  <tr>
                     <th><strong>Sr. No.</strong></th>
                     <th><strong>Guest Name</strong></th>
                     <th><strong>Mobile Number</strong></th>
                     <th><strong>Date</strong></th>
                     <th><strong>Time</strong></th>
                     <th><strong>Reject Reason</strong></th>
                     <th><strong>Qty</strong></th>
                     <th><strong>Note</strong></th>
                     <th><strong>Status</strong></th>
                  </tr>
               </thead>
               <tbody id="searchTable">
                  <?php
$j = 1;

    if ($luggage_request2) {
        foreach ($luggage_request2 as $lug_r) {
            $wh = '(u_id = "' . $lug_r['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            if ($user_data) {
                ?>
                  <tr>
                     <td><strong><?php echo $j++ ?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo $lug_r['select_date'] ?></td>
                     <td><?php echo date('h:i a', strtotime($lug_r['select_time'])) ?></td>
                     <td>
                                    <?php 
                                    // print_r($r['reject_reason']);
                                    // exit;
                                       if($lug_r['reject_reason'] == 0)
                                       {
                                          $reject_reason = '';
                                       }
                                       elseif($lug_r['reject_reason'] == 1)
                                       {
                                          $reject_reason = 'Temporarily Unavailable';
                                       }
                                       elseif($lug_r['reject_reason'] == 2)
                                       {
                                          $reject_reason = 'Space Not Available';
                                       }
                                       elseif($lug_r['reject_reason'] == 3)
                                       {
                                          $reject_reason = 'Please Contact Front Office';
                                       }
                                       elseif($lug_r['reject_reason'] == 4)
                                       {
                                          $reject_reason = 'Available Post Checkout';
                                       }
                                    ?>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo  $reject_reason;?></h5>
                                    </div>
                                 </td>
                                 
                     <td><?php echo $lug_r['quantity'] ?></td>
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a href="#">
                           <div class="badge badge-danger"
                              data-bs-toggle="modal"
                              data-bs-target="">
                              Rejected
                           </div>
                        </a>
                     </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $lug_r['note'] ?></span>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
}
        }
    }
    ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="tab-pane" style="background-color:white;" id="arrival2_div">
         <div class="table-scrollable">
            <table id="rejectedOrder_tb" class="display full-width">
               <thead>
                  <tr>
                     <th><strong>Sr. No.</strong></th>
                     <th><strong>Guest Name</strong></th>
                     <th><strong>Mobile Number</strong></th>
                     <th><strong>Date</strong></th>
                     <th><strong>Time</strong></th>
                     <!-- <th><strong>Type Of Luggage</strong></th> -->
                     <th><strong>Qty</strong></th>
                     <th><strong>Note</strong></th>
                     <th><strong>Status</strong></th>
                     <th><strong>Action</strong></th>
                  </tr>
               </thead>
               <tbody class="append_luggage">
                  <?php
$j = 1;

    if ($luggage_request1) {
        foreach ($luggage_request1 as $lug_r) {
            $wh = '(u_id = "' . $lug_r['u_id'] . '")';

            $user_data = $this->MainModel->getData('register', $wh);

            if ($user_data) {
                ?>
                  <tr>
                     <td><strong><?php echo $j++ ?></strong></td>
                     <td><?php echo $user_data['full_name'] ?></td>
                     <td><?php echo $user_data['mobile_no'] ?></td>
                     <td><?php echo $lug_r['select_date'] ?></td>
                     <td><?php echo date('h:i a', strtotime($lug_r['select_time'])) ?></td>
                     <!-- <td><?php //echo $lug_r['luggage_type'] ?></td> -->
                     <td><?php echo $lug_r['quantity'] ?></td>
                     <!-- <td>
                        <button
                            class="btn btn-secondary_<?php echo $lug_r['luggage_request_id'] ?> shadow btn-xs sharp me-1"><i
                                class="fas fa-eye"></i></button>
                        </td> -->
                     <td>
                        <a style="margin:auto" data-bs-toggle="modal"
                           data-bs-target=".bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>"
                           class="btn btn-secondary shadow btn-xs sharp"><i
                           class="fa fa-eye"></i></a>
                     </td>
                     <td>
                        <a href="#">
                           <div class="badge badge-success"
                              data-bs-toggle="modal"
                              data-bs-target="">
                              Accepted
                           </div>
                        </a>
                     </td>  
                     <td>
                     <?php
if ($lug_r['is_completed'] == "0") {
                    ?>
                     <input type="hidden" name="user_id" id="uid<?php echo $lug_r['luggage_request_id']; ?>" value="<?php echo $lug_r['luggage_request_id']; ?>">
                         
                           <select class="form-control" name="status" id="luggagestatus<?php echo $lug_r['luggage_request_id']; ?>" onchange="luggage_change_status(<?php echo $lug_r['luggage_request_id'] ?>);" style="min-width:85px;text-align:center">
                     
                                <option value="0" selected>Pending</option>
                                <option value="1">Luggage Return</option>
                                </select>
                          <?php
}elseif($lug_r['is_completed'] == "1"){
   ?>
   <a href="#">
   <div class="badge badge-primary"
      data-bs-toggle="modal"
      data-bs-target="">
      Luggage Return
   </div>
</a>
<?php
              }  ?>
                       
                           </td>
                  </tr>
                  <div class="modal fade bd-terms-modal-sm_<?php echo $lug_r['luggage_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal">
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="col-lg-12">
                                 <span><?php echo $lug_r['note'] ?></span>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
}
        }
    }
    ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
      <div class="rejected_orders_div1" style="display: none;">
         <div>
            <button style="float:right" type="button" class="btn btn-primary css_btn"
               data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">Add Luggage
            Charges</button>
         </div>
         <br><br>
         <div class="modal fade" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Add Luggage Charges</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal">
                     </button>
                  </div>
                  <form action="<?php echo base_url('FrontofficeController/add_luggage_charges') ?>" method="post">
                     <div class="modal-body">
                        <div class="row">
                           <div class="mb-3 col-md-12 form-group">
                              <label class="form-label">Luggage Type</label>
                              <input type="text" name="luggage_type" class="form-control" placeholder="Luggage ajaxluggageIconView_v1Type" required="">
                           </div>
                           <div class="mb-3 col-md-12 form-group">
                              <label class="form-label">Charges</label>
                              <input type="number" name="charges" class="form-control" placeholder="Charges" required="">
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer text-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!--  -->
      </div>
   </div>
</div>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal_luggage" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="luggage_request"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Luggage Request</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <!-- <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Guest Name</label>
                     <input type="text" class="form-control"  name="name" id="name" placeholder="Enter agent name">
                  </div> -->
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Contact Number</label>
                     <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number"
                        required="">
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Booking ID</label>
                     <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID"
                        required="" disable>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Date</label>
                     <input type="date"   class="form-control minDate" name="request_date" placeholder="Date" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Time</label>
                     <input type="time" class="form-control minDate" name="request_time" placeholder="time" required>
                  </div>
                  <!-- <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Type Of Luggage</label>
                     <input type="text" class="form-control minDate" name="luggage_type" placeholder="Luggage" required>
                  </div> -->
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Qty</label>
                     <input type="number" class="form-control minDate" name="quantity" placeholder="Qty" required>
                  </div>
                  <div class="mb-3 col-md-12 form-group">
                     <label class="form-label">Note</label>
                     <!-- <div class="summernote"></div> -->
                     <textarea class="summernote" id="description1" name="additional_note" style="min-height: 400px;"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add
               </button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<div class="modal fade update_luggage_modal_change" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-md">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Edit Order status</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                           </div>
                           <form id="frmupdateblock_luggage" method="post" enctype="multipart/form-data">
                              <div class="modal-body">
                                 <div class="basic-form">
                                    <div class="row">
                                       <div class="mb-3 col-md-12">
                                          <input type="hidden" name="luggage_request_id" id="luggage_request_id1">

                                          <label class="form-label">Change Order Status</label>
                                          <select id="send_user3" name="request_status" class="default-select form-control wide" required>
                                             <option value="">Choose...</option>
                                             <option value="1">Accept</option>
                                             <option value="2">Reject</option>
                                          </select>
                                       </div>
                                       <div class="mb-3 col-md-12 rejectreasonddd" style="display:none" >
                                       <label class="form-label">Reason For Rejecting</label>
                                       <select id="reason" name="reject_reason" class="default-select form-control wide">
                                          <option value="">Choose</option>
                                          <option value="1">Temporarily unavailable</option>
                                          <option value="2">Space Not Available</option>
                                          <option value="3">Please Contact Front Office</option>
                                          <option value="4">Available Post Checkout</option>
                                       </select>
                                    </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" class="btn btn-primary css_btn">Save</button>
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
<script>
   $('#send_user3').on('change', function() {

       if (this.value == 1) {
         //   $('#user_list').
           $('.assignto').css('display','block');
           $('.rejectreasonddd').css('display','none');
           $('#status').prop('required', true);

           $('#reason').prop('required', false);
           $('#status').prop('required', true);

         //   $('.assignto').css('display','block');
         
       }
       else if(this.value == 2)  {
           $('.assignto').css('display','none');
           $('.rejectreasonddd').css('display','block');
           $('#reason').prop('required', true);
           $('#status').prop('required', false);
       }
   });
</script>
                  <!-- add btn modal  -->
                  <script>
                      $(document).on("click", ".update_luggage_modal_btn", function() {
                        $(".update_luggage_modal_change").modal('show');
                     });
                     $('#frmupdateblock_luggage').submit(function(e) {
                        e.preventDefault();
                        $(".loader_block").show();
                        var form_data = new FormData(this);
                        var base_url = '<?php echo base_url() ?>';
                        //   console.log(base_url);
                        //   return false;
                        $.ajax({
                           url: base_url + "FrontofficeController/change_new_luggage_status",
                           type: 'POST',
                           data: form_data,
                           processData: false,
                           contentType: false,
                           cache: false,
                           success: function(res) {
                              console.log(res)
                              $.get('<?= base_url('FrontofficeController/ajaxOrderIconView_v4'); ?>', function(data) {
                                 var resu = $(data).find('#arrival1_div').html();
                                 var resu1 = $(data).find('#arrival2_div').html();
                                 var resu2 = $(data).find('#completed_orders_div1_new').html();
                                 var resu3 = $(data).find('#arrival3_div').html();


                                 $('#arrival1_div').html(resu);
                                 $('#arrival2_div').html(resu1);
                                 $('#completed_orders_div1_new').html(resu2);
                                 $('#arrival3_div').html(resu3);

                                 setTimeout(function() {
                                    $('#example1').DataTable();
                                    $('#acceptedOrder_tb1').DataTable();
                                    $('#completedOrder_tb1').DataTable();
                                    $('#rejectedOrder_tb').DataTable();
                                 }, 2000);
                              });
                              setTimeout(function() {
                                 $(".loader_block").hide();
                                 $(".update_luggage_modal_change").modal('hide');
                                 $(".update_luggage_modal_change").on("hidden.bs.modal", function() {
                                    $("#frmupdateblock_luggage")[0].reset(); // reset the form fields
                                 });
                                 $(".updatemessage").show();
                                 $(".append_data13").html(res);

                                 var request_status = form_data.get('request_status');
                                  console.log(request_status); // Log the requestStatus value to the console

                                 if (request_status === "1") {
                                    $('a[href="#arrival2_div"]').tab('show');
                                    $('.page_header_title_spa').text('Accept Luggage Request');
                                 } else if (request_status === "2") {
                                    $('a[href="#arrival3_div"]').tab('show');
                                    $('.page_header_title_spa').text('Reject Luggage Request');

                                 }

                              }, 2000);
                              setTimeout(function() {
                                 $(".updatemessage").hide();
                              }, 4000);
                           }

                        });
                     });
                     $(document).on('click', '#edit_luggage_data', function() {
                        var id = $(this).attr('data-id3');
                        // alert(id);
                        $.ajax({
                           url: '<?= base_url('FrontofficeController/getrequirement_luggage') ?>',
                           //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                           type: "post",
                           data: {
                              id: id
                           },
                           dataType: "json",
                           success: function(data) {
                              console.log(data);
                              $('#luggage_request_id1').val(data.luggage_request[0].luggage_request_id);

                           }
                        });
                     })
                  </script>
<script>
    $(document).unbind('submit').on('submit', '#luggage_request', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?=base_url('FrontofficeController/add_luggage_request')?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {
            $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v4');?>', function( data ) {
                  var resu = $(data).find('#arrival1_div').html();
                  $('#arrival1_div').html(resu);
                  setTimeout(function(){
                      $('#example1').DataTable();
                  }, 2000);
              });
              setTimeout(function(){
               $(".loader_block").hide();
               $("#luggage_request")[0].reset();
               $('#description1').summernote('reset');
               $(".add_facility_modal_luggage").modal('hide');
               $(".append_luggage_data").html(res);
                $(".successmessage").show();
                }, 2000);
              setTimeout(function(){
                  $(".successmessage").hide();
                }, 4000);

          }
      });
   });
   function luggage_change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url(); ?>';
              var status = $('#luggagestatus'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
               //  alert(uid);

              if (status != '') {

                  $.ajax({
                      url: base_url + "FrontofficeController/luggage_status",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                        // console.log(data);
                        $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v4');?>', function( data ) {
                           var resu = $(data).find('#completed_orders_div1_new').html();
                           $('#completed_orders_div1_new').html(resu);
                           setTimeout(function(){
                              $('#completedOrder_tb1').DataTable();
                           }, 2000);
                           $('a[href="#completed_orders_div1_new"]').tab('show');
                     });
                     // $(".append_luggage").html(res);
                        setTimeout(function(){
                           $(".loader_block").hide();
                           $("#luggage_request")[0].reset();
                           $('#description1').summernote('reset');
                           $(".add_facility_modal_luggage").modal('hide');
                           $(".append_luggage1").html(res);
                           $(".successmessage").show();
                           }, 2000);
                        setTimeout(function(){
                              $(".successmessage").hide();
                           }, 4000);
                      }
                  });
              }
          }
   </script>

<!-- end add btn modal -->
<?php } elseif ($sub_icon_id == 8) {?>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pages/table/table_data.js') ?>"></script>
<div class="col-md-12">
   <div class="card card-topline-aqua">
      <div class="card-head">
         <header><span class="page_header_title2">Cab Service Request</span></header>
         <div class="tools">
            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
         </div>
      </div>
      <div class="card-body ">
      <div class="col-md-12 col-sm-12">
            <div class="panel tab-border card-box">
               <header class="panel-heading panel-heading-gray custom-tab">
                  <ul class="nav nav-tabs">
                     <li class="nav-item"><a href="#arrival1_div" data-bs-toggle="tab" class="active">Cab Service Request</a>
                     </li>
                     <li class="nav-item"><a href="#arrival2_div" data-bs-toggle="tab">Accepted Cab Request</a>
                     </li>
                     <li class="nav-item"><a href="#arrival3_div" data-bs-toggle="tab">Rejected Cab Request</a>
                     </li>
                     <li class="nav-item"><a href="#completed_orders_div2" data-bs-toggle="tab">Completed Cab Request</a>
                     </li>
                     <li class="nav-item"><a href="#cancle_orders_div2" data-bs-toggle="tab">Cancel Cab Request</a>
                     </li>
                  </ul>
               </header>
            </div>
         </div>
         <div class="btn-group r-btn">
            <button id="addRow1" class="btn btn-info add_cab_request">
            Add Request
            </button>
         </div>
         <!-- <div class="col-md-3">
            <select class="form-control" id="orderserviceDropdown2">
               <option value="new_orders2">Cab Service Request</option>
               <option value="accepted_order2">Accepted Cab Request</option>
            </select>
         </div> -->
         <div class="new_orders_div2">
            <br>
            <div class="col-md-6">
               <div class="input-group">
                  <input type="date" class="form-control"
                     placeholder="2017-06-04">
                  <input type="time" class="form-control" placeholder="">
                  <input type="text" class="form-control"
                     placeholder="Vehicle Type">
                  <button class="btn btn-warning  btn-sm "><i
                     class="fa fa-search"></i></button>
               </div>
            </div>
            <div class="tab-content">
            <!-- upcoming guest -->
            <div class="tab-pane active" style="background-color:white;" id="arrival1_div">
            <div class="table-scrollable">
               <table id="example1" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Passengers</strong></th>
                        <th><strong>Requested Date</strong></th>
                        <th><strong>Guest Name</strong></th>
                        <th><Strong>Phone</Strong></th>
                        <th><strong>Vehicle Type</strong></th>
                        <th><strong>Destination</strong></th>
                        <th><strong>Note</strong></th>
                        <th><strong>Assign</strong></th>
                        <!-- <th><strong>Status</strong></th> -->
                     </tr>
                  </thead>
                  <tbody id="searchTable" class="append_cab">
                     <?php
$i = 1;
    if ($list) {
        foreach ($list as $c_s) {
            $user_data = $this->FrontofficeModel->get_user_data($c_s['u_id']);

            $full_name = "";
            $mobile_no = "";

            if ($user_data) {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
            }
            ?>
                     <tr>
                        <td><strong><?php echo $i++ ?></strong></td>
                        <td><?php echo $c_s['total_passanger'] ?></td>
                        <td>
                           <?php echo $c_s['request_date'] ?> /<sub> <?php echo date('h:i a', strtotime($c_s['request_time'])) ?></sub>
                        </td>
                        <td><?php echo $full_name ?></td>
                        <td><?php echo $mobile_no ?></td>
                        <td><?php echo $c_s['request_vehicle_type'] ?></td>
                        <td><?php echo $c_s['destination_name'] ?></td>
                        <!-- <td>
                           <button
                               class="btn btn-secondary_<?php echo $c_s['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                                   class="fas fa-eye"></i></button>
                           </td> -->
                        <td>
                        <a style="margin:auto" data-bs-toggle="modal" id="edit_data"
                              data-bs-target=".bd-terms-modal-sm" data-id= "<?php echo $c_s['cab_service_request_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td>
                           <a href="javascript:void(0)"
                              class="badge badge-rounded badge-warning"
                              data-bs-toggle="modal"
                              data-bs-target=".bd-example-modal-md_<?php echo $c_s['cab_service_request_id'] ?>">Assign</a>
                           <div class="modal fade bd-example-modal-md_<?php echo $c_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Cab Details</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                                       </button>
                                    </div>
                                    <form action="<?php echo base_url('FrontofficeController/change_cab_service_request') ?>" method="post">
                                       <input type="hidden" name="cab_service_request_id" value="<?php echo $c_s['cab_service_request_id'] ?>">
                                       <div class="modal-body">
                                          <div class="row offset-md-1">
                                             <div class="col-md-6">
                                                <label><input type="radio" name="request_status" value="red" required> Accept <img
                                                   src="assets/dist/images/download.png" alt="" height="26px;"></label>
                                             </div>
                                             <div class="col-md-6">
                                                <label><input type="radio" name="request_status" value="green" required> Reject <img
                                                   src="assets/dist/images/cross.png" alt="" height="22px;"></label>
                                             </div>
                                          </div>
                                          <div class="red box">
                                             <div class="mb-3 col-md-12" style="display: block;" id="">
                                                <label class="form-label">Assign To</label>
                                                <div class="row">
                                                   <div class="mb-3 col-md-12">
                                                      <label class="form-label">Driver Name</label>
                                                      <input type="text" name="driver_name" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="mb-3 col-md-12">
                                                      <label class="form-label">Phone</label>
                                                      <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="driver_contact_no" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="mb-3 col-md-12">
                                                      <label class="form-label">Vehicle Type</label>
                                                      <input type="text" name="assign_vehicle_type" class="form-control">
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="mb-3 col-md-12">
                                                      <label class="form-label">Vehicle No</label>
                                                      <input type="text" name="vehicle_no" class="form-control">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="green box">
                                             <div class="mb-3 col-md-12 rejectreasonddd">
                                             <label class="form-label">Reason For Rejecting</label>
                                             <select id="reason" name="reject_reason" class="default-select form-control wide">
                                                <option value="">Choose</option>
                                                <option value="1">Please Try After Sometime</option>
                                                <option value="2">Temporarily Unavailable</option>
                                                <option value="3">Slots Not Available</option>
                                                <option value="4">Please Contact Front Office</option>
                                             </select>
                                          </div></div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Submit</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <!-- assign modal -->
                        <!--/.  assign modal  -->
                     </tr>
                     <div class="modal fade bd-terms-modal-sm" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Note</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <p>
                                 <span class="d-block mb-2 description_view"></span>
         </p>
                                 <!-- <span><?php //echo $c_s['description'] ?></span> -->
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
}
    }

    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="tab-pane" style="background-color:white;" id="arrival3_div">
            <div class="table-scrollable">
               <table id="rejectedOrder_tb2" class="display full-width">
                  <thead>
                     <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Passengers</strong></th>
                        <th><strong>Requested Date</strong></th>
                        <th><strong>Guest Name</strong></th>
                        <th><Strong>Phone</Strong></th>
                        <th><strong>Vehicle Type</strong></th>
                        <th><strong>Destination</strong></th>
                        <th><strong>Reject Reason</strong></th>
                        <th><strong>Note</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
$i = 1;
    if ($list2) {
        foreach ($list2 as $cb_s) {
            $user_data = $this->MainModel->get_user_data($cb_s['u_id']);

            $full_name = "";
            $mobile_no = "";

            if ($user_data) {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
            }
            ?>
                     <tr>
                        <td><strong><?php echo $i++ ?></strong></td>
                        <td><?php echo $cb_s['total_passanger'] ?></td>
                        <td>
                           <?php echo $cb_s['request_date'] ?> /<sub> <?php echo date('h:i a', strtotime($cb_s['request_time'])) ?></sub>
                        </td>
                        <td><?php echo $full_name ?></td>
                        <td><?php echo $mobile_no ?></td>
                        <td><?php echo $cb_s['request_vehicle_type'] ?></td>
                        <td><?php echo $cb_s['destination_name'] ?></td>
                        <td>
                                    <?php 
                                   
                                    // print_r($r['reject_reason']);
                                    // exit;
                                       if($cb_s['reject_reason'] == 0)
                                       {
                                          $reject_reason = '';
                                       }
                                       elseif($cb_s['reject_reason'] == 1)
                                       {
                                          $reject_reason = 'Please Try After Sometime';
                                       }
                                       elseif($cb_s['reject_reason'] == 2)
                                       {
                                          $reject_reason = 'Temporarily Unavailable';
                                       }
                                       elseif($cb_s['reject_reason'] == 3)
                                       {
                                          $reject_reason = 'Slots Not Available';
                                       }
                                       elseif($cb_s['reject_reason'] == 4)
                                       {
                                          $reject_reason = 'Please Contact Front Office';
                                       }
                                    ?>
                                    <div>
                                       <h5 class="text-nowrap"><?php echo  $reject_reason;?></h5>
                                    </div>
                                 </td>
                        <td>
                           <a style="margin:auto" data-bs-toggle="modal"
                              data-bs-target=".bd-terms-modal-sm_<?php echo $cb_s['cab_service_request_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td>
                              <div class="d-flex">
                                 <a href="#"><span class="badge badge-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="">rejected</span>
                                 </a>
                              </div>
                           </td>
                     </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $cb_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Note</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $cb_s['description'] ?></span>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
}
    }

    ?>
                  </tbody>
               </table>
            </div>
         </div>
         <div class="tab-pane" id="completed_orders_div2"  style="background-color:white;">
               <div class="table-scrollable">
                  <table id="completedOrder_tb2" class="display full-width">
                     <thead>
                        <tr>
                           <th><strong>Sr. No.</strong></th>
                           <th><strong>Passengers</strong></th>
                           <th><strong>Requested Date</strong></th>
                           <th><strong>Guest Name</strong></th>
                           <th><Strong>Phone</Strong></th>
                           <th><strong>Vehicle Type</strong></th>
                           <th><strong>Destination</strong></th>
                           <th><strong>Note</strong></th>
                           <th><strong>Driver</strong></th>
                           <th><strong>Driver Phone</strong></th>
                           <th><strong>Vehicle Type</strong></th>
                           <th><strong>Vehicle No.</strong></th>
                           <th><strong>Status</strong></th>
                        </tr>
                     </thead>
                     <tbody id="searchTable">

                     <?php
$i = 1;
    if ($list3) {
        foreach ($list3 as $cb_c) {
            $user_data = $this->MainModel->get_user_data($cb_c['u_id']);

            $full_name = "";
            $mobile_no = "";

            if ($user_data) {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
            }
            ?>
                        <tr>
                           <td><strong><?php echo $i++ ?></strong></td>
                           <td><?php echo $cb_c['total_passanger'] ?></td>
                           <td>
                              <?php echo $cb_c['request_date'] ?> /<sub> <?php echo date('h:i a', strtotime($cb_c['request_time'])) ?></sub>
                           </td>
                           <td><?php echo $full_name ?></td>
                           <td><?php echo $mobile_no ?></td>
                           <td><?php echo $cb_c['request_vehicle_type'] ?></td>
                           <td><?php echo $cb_c['destination_name'] ?></td>
                           <!-- <td>
                              <button
                                  class="btn btn-secondary_<?php echo $cb_c['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                                      class="fas fa-eye"></i></button>
                              </td> -->
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal"
                                 data-bs-target=".bd-terms-modal-sm_<?php echo $cb_c['cab_service_request_id'] ?>"
                                 class="btn btn-secondary shadow btn-xs sharp"><i
                                 class="fa fa-eye"></i></a>
                           </td>
                           <td><?php echo $cb_c['driver_name'] ?></td>
                           <td><?php echo $cb_c['driver_contact_no'] ?></td>
                           <td><?php echo $cb_c['assign_vehicle_type'] ?></td>
                           <td><?php echo $cb_c['vehicle_no'] ?></td>
                           <td>
                              <div class="d-flex">
                                 <a href="#"><span class="badge badge-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="">Completed</span>
                                 </a>
                              </div>
                           </td>
                        </tr>
                        <div class="modal fade bd-terms-modal-sm_<?php echo $cb_c['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span><?php echo $cb_c['description'] ?></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
}
    }

    ?>
                        </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="cancle_orders_div2"  style="background-color:white;">
               <div class="table-scrollable">
                  <table id="completedOrder_tb1" class="display full-width">
                     <thead>
                        <tr>
                           <th><strong>Sr. No.</strong></th>
                           <th><strong>Passengers</strong></th>
                           <th><strong>Requested Date</strong></th>
                           <th><strong>Guest Name</strong></th>
                           <th><Strong>Phone</Strong></th>
                           <th><strong>Vehicle Type</strong></th>
                           <th><strong>Destination</strong></th>
                           <th><strong>Note</strong></th>
                           <th><strong>Driver</strong></th>
                           <th><strong>Driver Phone</strong></th>
                           <th><strong>Vehicle Type</strong></th>
                           <th><strong>Vehicle No.</strong></th>
                           <th><strong>Status</strong></th>
                        </tr>
                     </thead>
                     <tbody id="searchTable">

                     <?php
$i = 1;
    if ($list4) {
        foreach ($list4 as $cb_c) {
            $user_data = $this->MainModel->get_user_data($cb_c['u_id']);

            $full_name = "";
            $mobile_no = "";

            if ($user_data) {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
            }
            ?>
                        <tr>
                           <td><strong><?php echo $i++ ?></strong></td>
                           <td><?php echo $cb_c['total_passanger'] ?></td>
                           <td>
                              <?php echo $cb_c['request_date'] ?> /<sub> <?php echo date('h:i a', strtotime($cb_c['request_time'])) ?></sub>
                           </td>
                           <td><?php echo $full_name ?></td>
                           <td><?php echo $mobile_no ?></td>
                           <td><?php echo $cb_c['request_vehicle_type'] ?></td>
                           <td><?php echo $cb_c['destination_name'] ?></td>
                           <!-- <td>
                              <button
                                  class="btn btn-secondary_<?php echo $cb_c['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                                      class="fas fa-eye"></i></button>
                              </td> -->
                           <td>
                              <a style="margin:auto" data-bs-toggle="modal"
                                 data-bs-target=".bd-terms-modal-sm_<?php echo $cb_c['cab_service_request_id'] ?>"
                                 class="btn btn-secondary shadow btn-xs sharp"><i
                                 class="fa fa-eye"></i></a>
                           </td>
                           <td><?php echo $cb_c['driver_name'] ?></td>
                           <td><?php echo $cb_c['driver_contact_no'] ?></td>
                           <td><?php echo $cb_c['assign_vehicle_type'] ?></td>
                           <td><?php echo $cb_c['vehicle_no'] ?></td>
                           <td>
                              <div class="d-flex">
                                 <a href="#"><span class="badge badge-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="">Cancel</span>
                                 </a>
                              </div>
                           </td>
                        </tr>
                        <div class="modal fade bd-terms-modal-sm_<?php echo $cb_c['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title">Note</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="col-lg-12">
                                       <span><?php echo $cb_c['description'] ?></span>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
}
    }

    ?>
                        </tbody>
                        </table>
                        </div>
                        </div>
         <div class="tab-pane" style="background-color:white;" id="arrival2_div">
            <div class="table-scrollable">
               <table id="acceptedOrder_tb2" class="display full-width acceptedOrder_tb2">
                  <thead>
                     <tr>
                        <th><strong>Sr. No.</strong></th>
                        <th><strong>Passengers</strong></th>
                        <th><strong>Requested Date</strong></th>
                        <th><strong>Guest Name</strong></th>
                        <th><Strong>Phone</Strong></th>
                        <th><strong>Vehicle Type</strong></th>
                        <th><strong>Destination</strong></th>
                        <th><strong>Note</strong></th>
                        <th><strong>Driver</strong></th>
                        <th><strong>Driver Phone</strong></th>
                        <th><strong>Vehicle Type</strong></th>
                        <th><strong>Vehicle No.</strong></th>
                        <th><strong>Status</strong></th>
                     </tr>
                  </thead>
                  <tbody id="searchTable">
                     <?php
$i = 1;
    if ($list1) {
        foreach ($list1 as $cb_s) {
            $user_data = $this->MainModel->get_user_data($cb_s['u_id']);

            $full_name = "";
            $mobile_no = "";

            if ($user_data) {
                $full_name = $user_data['full_name'];
                $mobile_no = $user_data['mobile_no'];
            }
            ?>
                     <tr>
                        <td><strong><?php echo $i++ ?></strong></td>
                        <td><?php echo $cb_s['total_passanger'] ?></td>
                        <td>
                           <?php echo $cb_s['request_date'] ?> /<sub> <?php echo date('h:i a', strtotime($cb_s['request_time'])) ?></sub>
                        </td>
                        <td><?php echo $full_name ?></td>
                        <td><?php echo $mobile_no ?></td>
                        <td><?php echo $cb_s['request_vehicle_type'] ?></td>
                        <td><?php echo $cb_s['destination_name'] ?></td>
                        <!-- <td>
                           <button
                               class="btn btn-secondary_<?php echo $cb_s['cab_service_request_id'] ?> shadow btn-xs sharp me-1"><i
                                   class="fas fa-eye"></i></button>
                           </td> -->
                        <td>
                           <a style="margin:auto" data-bs-toggle="modal"
                              data-bs-target=".bd-terms-modal-sm_<?php echo $cb_s['cab_service_request_id'] ?>"
                              class="btn btn-secondary shadow btn-xs sharp"><i
                              class="fa fa-eye"></i></a>
                        </td>
                        <td><?php echo $cb_s['driver_name'] ?></td>
                        <td><?php echo $cb_s['driver_contact_no'] ?></td>
                        <td><?php echo $cb_s['assign_vehicle_type'] ?></td>
                        <td><?php echo $cb_s['vehicle_no'] ?></td>
                        <input type="hidden" name="user_id" id="uid<?php echo $cb_s['cab_service_request_id'];?>" value="<?php echo $cb_s['cab_service_request_id'];?>">
                           <td>
                           <select class="form-control" name="status" id="cabstatus<?php echo $cb_s['cab_service_request_id'];?>" onchange="cab_change_status(<?php echo $cb_s['cab_service_request_id']?>);" style="min-width:85px;text-align:center">
                          <?php 
                                if($cb_s['request_status']== "1") 
                                {
                          ?>
                                <option value="1" selected>Accepted</option>
                                <option value="4">Completed</option>
                          <?php 
                                }
                          ?>
                       </select>
                           </td>
                     </tr>
                     <div class="modal fade bd-terms-modal-sm_<?php echo $cb_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Note</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal">
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="col-lg-12">
                                    <span><?php echo $cb_s['description'] ?></span>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
}
    }

    ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
                     </div>
                     </div>
<!-- add btn modal  -->
<div class="modal fade bd-add-modal add_facility_modal_cab" tabindex="-1" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <form id="cab_request"  method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Cab Service Request</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Contact Number</label>
                     <input type="text" maxlength="10" name="mobile_no" id="mobile_no" onkeyup="add_booking_id()" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" placeholder="Contact Number"
                        required="">
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Booking ID</label>
                     <input type="number" name="booking_id" class="form-control" id="booking_id" placeholder="Booking ID"
                        required="" disable>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Date</label>
                     <input type="date"   class="form-control minDate" name="request_date" placeholder="Date" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Request Time</label>
                     <input type="time" class="form-control minDate" name="request_time" placeholder="time" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Passengers</label>
                     <input type="number" class="form-control"  name="total_passanger" id="name" placeholder="Passengers">
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Vehicle Type</label>
                     <input type="text" class="form-control minDate" name="vehicle_type" placeholder="Vehicle Type" required>
                  </div>
                  <div class="mb-3 col-md-6 form-group">
                     <label class="form-label">Destination</label>
                     <input type="text" class="form-control minDate" name="destination" placeholder="Destination" required>
                  </div>
                  <div class="mb-3 col-md-12 form-group">
                     <label class="form-label">Note</label>
                     <!-- <div class="summernote"></div> -->
                     <textarea class="summernote" id="description1" name="additional_note" style="min-height: 400px;"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary css_btn">Add
               </button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- end add btn modal -->
<script>
$(document).on('submit', '#frmupdateblock', function(e) {
         // alert('hi');die;
         e.preventDefault();
         $(".loader_block").show();
         var form_data = new FormData(this);
         $.ajax({
            url: '<?= base_url('HoteladminController/change_cab_service_request') ?>',
            method: 'POST',
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(res) {
               console.log(res);
               $.get('<?= base_url('HoteladminController/ajaxSubIconBlockView3'); ?>', function(data) {
                  // var resu = $(data).find('#new_orders_div2').html();
                  var resu1 = $(data).find('#accepted_orders_div2').html();
                  var resu2 = $(data).find('#completed_orders_div2').html();
                  var resu3 = $(data).find('#rejected_orders_div2').html();
   
                  // $('#new_orders_div2').html(resu);
                  $('#accepted_orders_div2').html(resu1);
                  $('#completed_orders_div2').html(resu2);
                  $('#rejected_orders_div2').html(resu3);
                  table_cab.ajax.reload();
                  setTimeout(function() {
                     // $('#example1').DataTable();
                     $('#acceptedOrder_tb2').DataTable();
                     $('#completedOrder_tb2').DataTable();
                     $('#rejectedOrder_tb2').DataTable();
                  }, 2000);
               });
            }
         });
         setTimeout(function() {
            // debugger;
            $(".loader_block").hide();
            //  $(".updateFaq").modal('hide');
            $(".change_cab_action").modal('hide');
            // $(".append_data14").html(res);
            $(".successmessage15").show();
            var request_status = form_data.get('request_status');
            //  console.log(requestStatus); // Log the requestStatus value to the console
   
            if (request_status === "red") {
               $('a[href="#accepted_orders_div2"]').tab('show');
               $('.page_header_title_spa').text('Accept Cab Request');
            } else if (request_status === "green") {
               $('a[href="#rejected_orders_div2"]').tab('show');
               $('.page_header_title_spa').text('Reject Cab Request');
   
            }
   
         }, 2000);
   
         setTimeout(function() {
            $(".successmessage15").hide();
         }, 4000);
      });
   </script>
<script>
    $(document).unbind('submit').on('submit', '#cab_request', function(e){
      e.preventDefault();
      $(".loader_block").show();
      var form_data = new FormData(this);
      $.ajax({
          url         : '<?=base_url('FrontofficeController/add_cab_request')?>',
          method      : 'POST',
          data        : form_data,
          processData : false,
          contentType : false,
          cache       : false,
          success     : function(res) {

              $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v3');?>', function( data ) {
                  var resu = $(data).find('#arrival1_div').html();
                  $('#arrival1_div').html(resu);
                  setTimeout(function(){
                      $('#example1').DataTable();
                  }, 2000);
              });
           $(".add_facility_modal_cab").modal('hide');
              setTimeout(function(){
               $(".loader_block").hide();
               $("#cab_request")[0].reset();
               $('#description1').summernote('reset');
               $(".append_cab").html(res);
                $(".successmessage").show();
                }, 2000);
              setTimeout(function(){
                  $(".successmessage").hide();
                }, 4000);

          }
      });
   });
   function cab_change_status(cnt) {
             //alert('hi');
             $(".loader_block").show();
              var base_url = '<?php echo base_url();?>';
              var status = $('#cabstatus'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
               //  alert(uid);

              if (status != '') {

                  $.ajax({
                      url: base_url + "FrontofficeController/cab_status",
                      method: "POST",
                      data: {
                        status: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                        console.log(data);
                        $.get( '<?=base_url('FrontofficeController/ajaxOrderIconView_v3');?>', function( data ) {
                           var resu = $(data).find('#arrival5_div').html();
                           $('#arrival5_div').html(resu);
                           setTimeout(function(){
                              $('#completedOrder_tb').DataTable();
                              
                           }, 2000);
                           $('a[href="#arrival5_div"]').tab('show');
                     });
                        setTimeout(function(){
                             
                              $(".successmessage").show();
                           }, 2000);
                        setTimeout(function(){
                              $(".loader_block").hide();
                              $(".successmessage").hide();
                           }, 4000);  
                      }
                  });
              }
          }
          $(document).ready(function (id) {
           $(document).on('click','#edit_data',function(){
               var id = $(this).attr('data-id');
               // alert(id);
               $.ajax({
                                         url: '<?= base_url('FrontofficeController/getCabData') ?>',
                                         //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                         type: "post",
                                         data: {id:id},
                                         dataType:"json",
                                         success: function (data) {
                                           
                                            $('.description_view').html(data.description);
                                          
                                         }  
                                         }); 
           })
       });
   </script>
<?php }?>
<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb2').DataTable();
       $('#rejectedOrder_tb2').DataTable();
       $('#completedOrder_tb2').DataTable();
   } );
   var selectedOrderserviceurl = '';
   $('#orderserviceDropdown2').change(function () {
       var selected_orderservice = $(this).val();
       if(selected_orderservice == 'new_orders2')
       {
           selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView3';
           $('.page_header_title2').text('Cab Service Request');
           $('.new_orders_div2').css('display','block');
           $('.accepted_orders_div2').css('display','none');
           $('.rejected_orders_div2').css('display','none');

       }
       if(selected_orderservice == 'accepted_order2')
       {
           selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView3';
           $('.page_header_title2').text('Accepted Cab Request');
           $('.accepted_orders_div2').css('display','block');
           $('.new_orders_div2').css('display','none');
           $('.rejected_orders_div2').css('display','none');

       }

       var base_url = '<?php echo base_url(); ?>';
       $.ajax({
           method: "GET",
           url: base_url+selectedOrderserviceurl,
           success: function (response) {
               $('.append_data').html(response);
           }
       });
   });

</script>
<script>
   $(document).ready(function() {
       // $('#newOrder_tb').DataTable();
       $('#acceptedOrder_tb').DataTable();
       $('#rejectedOrder_tb').DataTable();
       $('#completedOrder_tb').DataTable();
   } );
   var selectedOrderserviceurl = '';
   $('#orderserviceDropdown').change(function () {
       var selected_orderservice = $(this).val();
       if(selected_orderservice == 'new_orders')
       {
           selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView2';
           $('.page_header_title').text('Car Wash Request');
           $('.new_orders_div').css('display','block');
           $('.accepted_orders_div').css('display','none');
           $('.rejected_orders_div').css('display','none');

       }
       if(selected_orderservice == 'accepted_order')
       {
           selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView2';
           $('.page_header_title').text('Accepted Car Wash Request ');
           $('.accepted_orders_div').css('display','block');
           $('.new_orders_div').css('display','none');
           $('.rejected_orders_div').css('display','none');

       }
       if(selected_orderservice == 'rejected_order')
       {
           selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView2';
           $('.page_header_title').text('Washing Charges');
           $('.rejected_orders_div').css('display','block');
           $('.new_orders_div').css('display','none');
           $('.accepted_orders_div').css('display','none');

       }

       var base_url = '<?php echo base_url(); ?>';
       $.ajax({
           method: "GET",
           url: base_url+selectedOrderserviceurl,
           success: function (response) {
               $('.append_data').html(response);
           }
       });
   });

</script>
<script>
   $(document).ready(function() {
   // $('#newOrder_tb').DataTable();
   $('#acceptedOrder_tb1').DataTable();
   $('#rejectedOrder_tb1').DataTable();
   $('#completedOrder_tb1').DataTable();
   $('#spa_tbl').DataTable();
   } );
   var selectedOrderserviceurl = '';
   $('#orderserviceDropdown1').change(function () {
   var selected_orderservice = $(this).val();
   if(selected_orderservice == 'new_orders1')
   {
    selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView1';
    $('.page_header_title1').text('Luggage Request');
    $('.new_orders_div1').css('display','block');
    $('.accepted_orders_div1').css('display','none');
    $('.rejected_orders_div1').css('display','none');

   }
   if(selected_orderservice == 'accepted_order1')
   {
    selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView1';
    $('.page_header_title1').text('Accepted Luggage Request');
    $('.accepted_orders_div1').css('display','block');
    $('.new_orders_div1').css('display','none');
    $('.rejected_orders_div1').css('display','none');

   }
   if(selected_orderservice == 'rejected_order1')
   {
    selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView1';
    $('.page_header_title1').text('Manage Luggage Charges');
    $('.rejected_orders_div1').css('display','block');
    $('.new_orders_div1').css('display','none');
    $('.accepted_orders_div1').css('display','none');

   }

   var base_url = '<?php echo base_url(); ?>';
   $.ajax({
    method: "GET",
    url: base_url+selectedOrderserviceurl,
    success: function (response) {
        $('.append_data').html(response);
    }
   });
   });

</script>
<script>
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
           '<div class="input-group">' +
           '<input type="text" name="spa_price12[]" class="form-control" placeholder="Price" required="">' +

           '<button type="button" value="Remove" id="DeleteRow1" class="remove btn btn-danger btn-sm">' +
           '<i class="fa fa-times"></i></button></div></div>'+
      '</div>'
   }

   <?php
}
}
?>
</script>
</script>
<!-- /. for edit -->
<script>
   $(document).ready(function() {
   $('#acceptedOrder_tb').DataTable();
   $('#rejectedOrder_tb').DataTable();
   $('#arrival_tbl').DataTable();
   } );
   $(".exploder").click(function() {

   // $(this).toggleClass("");

   $(this).children("span").toggleClass("glyphicon-search glyphicon-zoom-out");

   $(this).closest("tr").next("tr").toggleClass("hide");

   if ($(this).closest("tr").next("tr").hasClass("hide")) {
       $(this).closest("tr").next("tr").children("td").slideUp();
   } else {
       $(this).closest("tr").next("tr").children("td").slideDown(350);
   }
   });
</script>
<!-- automatic hide session data -->
<script>
   $(document).ready(function(){
       $('.alert').delay(4000).fadeOut();
   });
</script>
<!-- automatic hide session data -->
<!-- delete -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
           // $('.delete').click(function() {
           function delete_data(id)
           {
               var id = id;
               var base_url = '<?php echo base_url() ?>';

               const swalWithBootstrapButtons = Swal.mixin({
                   customClass:
                   {
                       confirmButton: 'btn btn-danger',
                       cancelButton: 'btn btn-success'
                   },
                   buttonsStyling: false
               })

               swalWithBootstrapButtons.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonText: 'Yes, delete it!',
                   cancelButtonText: 'No, cancel!',
                   reverseButtons: true
               }).then((result) =>
               {
                   if (result.isConfirmed)
                   {
                       $.ajax({
                               url     : base_url + "MainController/delete_front_ofs_services",
                               method  : "post",
                               data    : {id : id},
                               success : function(data)
                                       {
                                           // alert(data);
                                           if(data == 1)
                                           {
                                               swalWithBootstrapButtons.fire(
                                                           'Deleted!',
                                                           'Your file has been deleted.',
                                                           'success'
                                                       ).then((result) =>
                                                       {
                                                           location.reload();
                                                       })
                                           }
                                       }

                           });
                   }
                   else if (
                       /* Read more about handling dismissals below */
                       result.dismiss === Swal.DismissReason.cancel
                   ) {
                       swalWithBootstrapButtons.fire(
                           'Cancelled',
                           'Your imaginary file is safe :)',
                           'error'
                       )
                   }
               })

           }
</script>
<script>
   $(document).on("click",".add_car_request",function(){
   $(".add_facility_modal_car").modal('show');
   });
   $(document).on("click",".add_facility",function(){
   $(".add_facility_modal_spa").modal('show');
   });
   $(document).on("click",".add_luggage",function(){
   $(".add_facility_modal_luggage").modal('show');
   });
   $(document).on("click",".add_cab_request",function(){
   $(".add_facility_modal_cab").modal('show');
   });

   $(document).on('submit', '#luggage_add', function(e){
   e.preventDefault();
   $(".loader_block").show();
   var form_data = new FormData(this);
   $.ajax({
   url         : '<?=base_url('FrontofficeController/add_luggage_charges')?>',
   method      : 'POST',
   data        : form_data,
   processData : false,
   contentType : false,
   cache       : false,
   success     : function(res) {
      setTimeout(function(){
       $(".loader_block").hide();
       $(".add_facility_modal").modal('hide');
       $(".append_data2").html(res);
        $(".successmessage").show();
        }, 2000);
      setTimeout(function(){
          $(".successmessage").hide();
        }, 4000);

   }
   });
   });

   $(document).ready(function() {
   // $('#newOrder_tb').DataTable();
   $('#acceptedOrder_tb5').DataTable();

   } );
   var selectedOrderserviceurl = '';
   function orderservice1(clicked) {

   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.accepted_orders_div_service').css('display','block');
   $('.new_orders_div_service').css('display','none');



   var base_url = '<?php echo base_url(); ?>';
   $.ajax({
   method: "GET",
   url: base_url+selectedOrderserviceurl,
   success: function (response) {
      $('.append_data').html(response);
   }
   });
   };
   $(document).ready(function() {
   // $('#newOrder_tb').DataTable();
   $('#acceptedOrder_tb5').DataTable();
   $('#monday_tbl').DataTable();
   $('#tuesday_tbl').DataTable();
   $('#wednesday_tbl').DataTable();
   $('#thursday_tbl').DataTable();
   $('#friday_tbl').DataTable();
   $('#saturday_tbl').DataTable();
   } );
   var selectedOrderserviceurl = '';
   $('#days').change(function () {
   var selected_orderservice = $(this).val();
   if(selected_orderservice == 'Sunday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/ajaxSubIconBlockView1';
   $('.sunday_div').css('display','block');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','none');
   }

   if(selected_orderservice == 'Monday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','block');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','none');
   }
   if(selected_orderservice == 'Tuesday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','block');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','none');
   }
   if(selected_orderservice == 'Wednesday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','block');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','none');
   }
   if(selected_orderservice == 'Thursday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','block');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','none');
   }
   if(selected_orderservice == 'Friday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','block');
   $('.saturday_div').css('display','none');
   }
   if(selected_orderservice == 'Saturday')
   {
   selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
   $('.sunday_div').css('display','none');
   $('.monday_div').css('display','none');
   $('.tuesday_div').css('display','none');
   $('.wednesday_div').css('display','none');
   $('.thursday_div').css('display','none');
   $('.friday_div').css('display','none');
   $('.saturday_div').css('display','block');
   }

   var base_url = '<?php echo base_url(); ?>';
   $.ajax({
   method: "GET",
   url: base_url+selectedOrderserviceurl,
   success: function (response) {
      $('.append_data').html(response);
   }
   });
   });

   function change_status(id)
   {
   var base_url = '<?php echo base_url() ?>';
   var status = $('#status_'+id).val();
   var id = id;

   // alert(status);
   if(status != '')
   {
      $.ajax({
              url     : base_url + 'HoteladminController/change_available_status',
              method  : "post",
              data    : {status : status,id : id},
              success : function(data)
                          {
                          if(data == 1)
                          {
                              alert('Status Changed successfully');
                              location.reload();
                          }
                          else
                          {
                              alert('Something went wrong');
                              location.reload();
                          }
                          }

      });
   }
   }
   function delete_data_luggage(id)
      {
          var id = id;
          var base_url = '<?php echo base_url() ?>';

          const swalWithBootstrapButtons = Swal.mixin({
              customClass:
              {
                  confirmButton: 'btn btn-danger',
                  cancelButton: 'btn btn-success'
              },
              buttonsStyling: false
          })

          swalWithBootstrapButtons.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
          }).then((result) =>
          {
              if (result.isConfirmed)
              {
                  $.ajax({
                          url     : base_url + "HoteladminController/delete_luggage_charge",
                          method  : "post",
                          data    : {id : id},
                          success : function(data)
                                  {
                                      // alert(data);
                                      if(data == 1)
                                      {
                                          swalWithBootstrapButtons.fire(
                                                      'Deleted!',
                                                      'Your file has been deleted.',
                                                      'success'
                                                  ).then((result) =>
                                                  {
                                                      location.reload();
                                                  })
                                      }
                                  }

                      });
              }
              else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
              ) {
                  swalWithBootstrapButtons.fire(
                      'Cancelled',
                      'Your imaginary file is safe :)',
                      'error'
                  )
              }
          })

      }
</script>
<script>
   $(document).on('click','.yes_no', function () {
       var check = $('.yes_no').is(':checked');
       var id = $(this).attr('data-id');
       var active_deactive_subid = $(this).attr('active-deactive-subid');
       var event_status = '';
       if(check == true)
       {
           event_status = 1;
       }
       else
       {
           event_status = 0;
       }
       var base_url = '<?php echo base_url() ?>';
       $.ajax({
           url : base_url + "FrontofficeController/event_active_deactive",
           method : "post",
           data : {
               id : id ,
               event_status : event_status,
               active_deactive_subid : active_deactive_subid
           },
           success :function(data){
               console.log(data)
               // $('#booking_id').val(data)
           }
       });
   });
   function add_booking_id()
   {
       var base_url = '<?php echo base_url() ?>';
       var mobile_no = $('#mobile_no').val();

       $.ajax({
               url : base_url + "FrontofficeController/add_booking_id",
               method : "post",
               data : {mobile_no : mobile_no},
               success :function(data)
                       {
                           $('#booking_id').val(data)
                       }
       });
   }
</script>
<script>
   $(document).ready(function() {
       $('input[type="radio"]').click(function() {
           var inputValue = $(this).attr("value");
           var targetBox = $("." + inputValue);
           $(".box").not(targetBox).hide();
           $(targetBox).show();
       });
   });
   function delete_data_car(id)
   {
       var id = id;
       var base_url = '<?php echo base_url() ?>';

       const swalWithBootstrapButtons = Swal.mixin({
           customClass:
           {
               confirmButton: 'btn btn-danger',
               cancelButton: 'btn btn-success'
           },
           buttonsStyling: false
       })

       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           reverseButtons: true
       }).then((result) =>
       {
           if (result.isConfirmed)
           {
               $.ajax({
                       url     : base_url + "HoteladminController/delete_vehicle_washing_charges",
                       method  : "post",
                       data    : {id : id},
                       success : function(data)
                               {
                                   // alert(data);
                                   if(data == 1)
                                   {
                                       swalWithBootstrapButtons.fire(
                                                   'Deleted!',
                                                   'Your file has been deleted.',
                                                   'success'
                                               ).then((result) =>
                                               {
                                                   location.reload();
                                               })
                                   }
                               }

                   });
           }
           else if (
               /* Read more about handling dismissals below */
               result.dismiss === Swal.DismissReason.cancel
           ) {
               swalWithBootstrapButtons.fire(
                   'Cancelled',
                   'Your imaginary file is safe :)',
                   'error'
               )
           }
       })

   }
   $(document).ready(function() {
       $('#acceptedOrder_tb').DataTable();
       $('#rejectedOrder_tb').DataTable();
       $('#arrival_tbl').DataTable();
       $('#acceptedOrder_tb3').DataTable();

   } );

   $('#orderserviceArrival').change(function () {
       var selected_orderservice = $(this).val();
       if(selected_orderservice == 'arrival1')
       {
           $('.arrival1_div').css('display','block');
           $('.arrival2_div').css('display','none');
           $('.arrival3_div').css('display','none');
       }
       if(selected_orderservice == 'arrival2')
       {
           $('.arrival2_div').css('display','block');
           $('.arrival1_div').css('display','none');
           $('.arrival3_div').css('display','none');
       }
       if(selected_orderservice == 'arrival3')
       {
           $('.arrival1_div').css('display','none');
           $('.arrival2_div').css('display','none');
           $('.arrival3_div').css('display','block');
       }
   });
</script>