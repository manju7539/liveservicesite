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

.green {
    background: #e23428;
}
.form-control:disabled, .form-control[readonly] {
  background-color: white;
}


label {
    margin-right: 15px;
    color:black;
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
<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/pages/summernote/summernote-data.js')?>"></script>

<?php if($sub_icon_id == 1){?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Gym Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
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
                        <tbody class="">
                        <?php

$i = 1;
if($list)
{
    foreach($list as $g_f_s)
    {
        $wh = '(front_ofs_service_id = "'.$g_f_s['front_ofs_service_id'].'")';

        $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
?>

    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $g_f_s['staff_name']?></td>
        <td><?php echo $g_f_s['contact_no']?></td>
        <td><?php echo date('h:i a',strtotime($g_f_s['open_time']))."-".date('h:i a',strtotime($g_f_s['close_time']))?></td>
        <td><?php echo date('h:i a',strtotime($g_f_s['break_start_time']))."-".date('h:i a',strtotime($g_f_s['break_close_time']))?></td>
        <!-- <td>
            <button
                class="btn btn-secondary_<?php echo $g_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                    class="fas fa-eye"></i></button>
        </td> -->
        <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $g_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td><td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo $g_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
        <!-- <td>
            <a href="" data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>">
                <img src="<?php echo base_url('assets/dist/images/term.jpg')?>" alt=""
                    height="40px" width="90px">
            </a>
        </td> -->
        <!-- modal for terms and conditions -->
       
        <!--/. modal for terms and conditions -->
        <td>
            <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
            <div id="gallery" data-toggle="modal"
                data-target="#exampleModal">
                <img class="me-3 " src="<?php echo $services_img['image']?>"
                    alt="" data-bs-toggle="modal" 
                    data-bs-target=".bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>"
                    data-slide-to="0"
                    style="height:30px; width:60px;">
            </div>
        </td>
        <!-- image gallery -->
        <div class="modal fade bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                    <img class="d-block w-100" src="<?php echo $services_img['image']?>"
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
                data-bs-toggle="modal"
                data-bs-target=".bd-example-modal-lg_<?php echo $g_f_s['front_ofs_service_id']?>"><i
                    class="fa fa-pencil"></i></a>
           <!-- <a href="#" onclick="delete_data(<?php echo $g_f_s['front_ofs_service_id'] ?>)"
                class="btn btn-danger shadow btn-xs sharp"><i
                    class="fa fa-trash"></i></a>-->
        </td>
    </tr>
    <div class="modal fade bd-terms-modal-sm_<?php echo $g_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $g_f_s['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade bd-terms-modal-sm1_<?php echo $g_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Terms And Conditions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $g_f_s['t_nd_c'] ?></span>
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

$i = 1;
if($list)
{
    foreach($list as $g_f_s)
    {
?>

        <div class="modal fade bd-example-modal-lg_<?php echo $g_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('HoteladminController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form"> 
                                    <input type="hidden" name="front_ofs_service_id" value="<?php echo $g_f_s['front_ofs_service_id']?>">
                                    <input type="hidden" class="form-control" value="1" name="service_name">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Staff Name</label>
                                                <input type="text" name="staff_name" value="<?php echo $g_f_s['staff_name']?>" class="form-control" value="Amit Sahane" required="">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" name="contact_no" maxlength="10" value="<?php echo $g_f_s['contact_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Open Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="open_time" value="<?php echo $g_f_s['open_time']?>" class="form-control">
                                                    <input type="time" name="close_time" value="<?php echo $g_f_s['close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Break Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="break_start_time" value="<?php echo $g_f_s['break_start_time']?>" class="form-control">
                                                    <input type="time" name="break_close_time" value="<?php echo $g_f_s['break_close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                    required=""><?php echo $g_f_s['description']?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Terms & Conditions</label>
                                                <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                                    required=""><?php echo $g_f_s['t_nd_c']?></textarea>
                                            </div>
                                        </div>
                                  
                                        <?php
                                            $wh1 = '(front_ofs_service_id = "'.$g_f_s['front_ofs_service_id'].'")';

                                            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images',$wh1);
                                            
                                            $j = 0;

                                            if($services_imgs)
                                            {
                                                
                                        ?>
                                             
                                                    <label class="form-label">Pictures of Gym</label>
                                   <div class="row">
                                                    <?php
                                                        foreach($services_imgs as $se_i)
                                                        {
                                                    ?>
                                    <div class="mb-3 col-md-4 ">
                                                            <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id']?>">
                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $se_i['image']?>">
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
        </div>
    </div>
<?php } elseif($sub_icon_id == 2) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Spa Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

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
                                                    <tbody id="searchTable">
                                                        
                                                        <?php

                                                            $i = 1;
                                                            if($list)
                                                            {
                                                                foreach($list as $spa_f_s)
                                                                {
                                                                    $wh = '(front_ofs_service_id = "'.$spa_f_s['front_ofs_service_id'].'")';

                                                                    $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
                                                        ?>

                                                                <tr>
                                                                    <td><?php echo $i++?></td>
                                                                    <td><?php echo $spa_f_s['staff_name']?></td>
                                                                    <td><?php echo $spa_f_s['contact_no']?></td>
                                                                    <td><?php echo date('h:i a',strtotime($spa_f_s['open_time']))."-".date('h:i a',strtotime($spa_f_s['close_time']))?></td>
                                                                    <td><?php echo date('h:i a',strtotime($spa_f_s['break_start_time']))."-".date('h:i a',strtotime($spa_f_s['break_close_time']))?></td>

                                                                    <!-- <td>
                                                                        <button
                                                                            class="btn btn-secondary_<?php echo $spa_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                                                                                class="fas fa-eye"></i></button>
                                                                    </td> -->
                                                                    <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $spa_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                                                    <td>
                                                                        <a href="" data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter1_<?php echo $spa_f_s['front_ofs_service_id']?>"> <img
                                                                                src="assets/dist/images/spa_logo.png" alt=""
                                                                                style="height: 40px;width:50px;">
                                                                        </a>
                                                                    </td>
                                                                    <!-- packages -->
                                                                    <div class="modal fade" id="exampleModalCenter1_<?php echo $spa_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Modal title</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="guest-profile">

                                                                                        <?php

                                                                                            $admin_id = $this->session->userdata('u_id');

                                                                                            $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                                                                                            $spa_images = $this->HotelAdminModel->get_spa_services_images($admin_id,$front_ofs_service_id);
                                                                    
                                                                                            if($spa_images)
                                                                                            {
                                                                                                foreach($spa_images as $s_im)
                                                                                                {   
                                                                                        ?>
                                                                                        
                                                                                                    <div class="d-flex">
                                                                                                        <img src="<?php echo $s_im['spa_photo']?>" alt="" style="height: 50px;width:70px;">
                                                                                                        <div>
                                                                                                            <h5 class="font-w600"><?php echo $s_im['spa_type']?></h5>
                                                                                                            <span class="text-secondary">Rs.<?php echo $s_im['spa_price']?></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <br>
                                                                                        <?php
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/. packages -->
                                                                    <!-- <td>
                                                                        <a href="" data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $spa_f_s['front_ofs_service_id']?>">
                                                                            <img src="<?php echo base_url('assets/dist/images/term.jpg')?>" alt=""
                                                                                height="40px" width="90px">
                                                                        </a>
                                                                    </td> -->
                                                                    <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo $spa_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                                                    <!-- modal for terms and conditions -->
                                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $spa_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Terms And Conditions</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo $spa_f_s['t_nd_c']?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/. modal for terms and conditions -->

                                                                    <td>
                                                                        <div class="">
                                                                            <a href="#"
                                                                                class="btn btn-warning shadow btn-xs sharp me-1"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target=".bd-example-modal-lg_<?php echo $spa_f_s['front_ofs_service_id']?>"><i
                                                                                    class="fa fa-pencil"></i></a>
                                                                           <!-- <a href="#" onclick="delete_data(<?php echo $spa_f_s['front_ofs_service_id'] ?>)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class="fa fa-trash"></i></a>-->
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                <div class="modal fade bd-terms-modal-sm_<?php echo $spa_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $spa_f_s['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade bd-terms-modal-sm1_<?php echo $spa_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Terms And Conditions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $spa_f_s['t_nd_c'] ?></span>
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
                    if($list)
                    {
                        foreach($list as $spa_f_s)
                        {
                ?>
                            <div class="modal fade bd-example-modal-lg_<?php echo $spa_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit schedule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <form action="<?php echo base_url('HoteladminController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="front_ofs_service_id" value="<?php echo $spa_f_s['front_ofs_service_id']?>">
                                            <input type="hidden" class="form-control" value="2" name="service_name"> 
                                            <div class="modal-body">
                                                <div class="col-lg-12">
                                                    <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Staff Name</label>
                                                                <input type="text" name="staff_name" value="<?php echo $spa_f_s['staff_name']?>" class="form-control" value="Amit Sahane" required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Contact Number</label>
                                                                <input type="text" name="contact_no" maxlength="10" value="<?php echo $spa_f_s['contact_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Open Time</label>
                                                                <div class="input-group">
                                                                    <input type="time" name="open_time" value="<?php echo $spa_f_s['open_time']?>" class="form-control">
                                                                    <input type="time" name="close_time" value="<?php echo $spa_f_s['close_time']?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Break Time</label>
                                                                <div class="input-group">
                                                                    <input type="time" name="break_start_time" value="<?php echo $spa_f_s['break_start_time']?>" class="form-control">
                                                                    <input type="time" name="break_close_time" value="<?php echo $spa_f_s['break_close_time']?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                                    required=""><?php echo $spa_f_s['description']?></textarea>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Terms & Conditions</label>
                                                                <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                                                    required=""><?php echo $spa_f_s['t_nd_c']?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                        <?php


                                                            $k = 0;

                                                            $admin_id = $this->session->userdata('u_id');

                                                            $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                                                            $spa_images = $this->MainModel->get_spa_services_images($admin_id,$front_ofs_service_id);

                                                            if($spa_images)
                                                            {
                                                                foreach($spa_images as $s_im)
                                                                {
                                                        ?>
                                                            <input type="hidden" name="front_ofs_spa_service_images_id[]" value="<?php echo $s_im['front_ofs_spa_service_images_id'] ?>" class="form-control" placeholder=""
                                                                    required="">
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label class="form-label">Spa Photo</label>
                                                                <input type="file" name="spa_photo[<?php echo $k?>]" class=" form-control" accept="image/jpeg, image/png," data-default-file="<?php echo $s_im['spa_photo']?>">
                                                            </div>
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label class="form-label">Spa Type</label>
                                                                <input type="text" name="spa_type[<?php echo $k?>]" value="<?php echo $s_im['spa_type'] ?>"  class="form-control"  id="files">
                                                            </div>
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label class="form-label">Price</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="spa_price[<?php echo $k?>]" value="<?php echo $s_im['spa_price'] ?>">
                                                                   <button type="button" id="btnAdd12_<?php echo $spa_f_s['front_ofs_service_id']?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        <?php
                                                                    $k++;
                                                                }
                                                            }
                                                        ?>
                                                        <div class="text-left mb-3">
                                                           <!-- <button type="button" id="btnAdd12_<?php echo $spa_f_s['front_ofs_service_id']?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i></button>-->
                                                            </div>  
                                                        </div>
                                                        <div id="TextBoxContainer12_<?php echo $spa_f_s['front_ofs_service_id']?>" class="mb-1"></div>

                                                        <?php
                                                            $wh1 = '(front_ofs_service_id = "'.$spa_f_s['front_ofs_service_id'].'")';

                                                            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images',$wh1);
                                                            // print_r($services_imgs);die;
                                                            $j = 0;

                                                            if($services_imgs)
                                                            {
                                                                
                                                        ?>
                                                      <div class="row">
                                                        
                                                      
                                                               
                                                                    <label class="form-label">Pictures of Spa</label>
                                                                    <?php
                                                                        foreach($services_imgs as $se_i)
                                                                        {
                                                                    ?>
                                                       <div class=" col-md-6 ">
                                                                            <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id']?>">
                                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $se_i['image']?>">
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
                <?php
                        }
                    }
                ?>
        </div>
    </div>
    <?php }  elseif($sub_icon_id == 3) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Pool Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

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
                <tbody id="searchTable">
                <?php

                    $i = 1;
                    if($list)
                    {
                        foreach($list as $p_f_s)
                        {
                            $wh = '(front_ofs_service_id = "'.$p_f_s['front_ofs_service_id'].'")';

                            $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
                ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td><?php echo $p_f_s['staff_name']?></td>
                                <td><?php echo $p_f_s['contact_no']?></td>
                                <td><?php echo date('h:i a',strtotime($p_f_s['open_time']))."-".date('h:i a',strtotime($p_f_s['close_time']))?></td>
                                <td><?php echo date('h:i a',strtotime($p_f_s['break_start_time']))."-".date('h:i a',strtotime($p_f_s['break_close_time']))?></td>
                                <!-- <td>
                                    <button class="btn btn-secondary_<?php echo $p_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                                        class="fas fa-eye"></i></button>
                                </td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter_<?php echo $p_f_s['front_ofs_service_id']?>">
                                        <img src="assets/dist/images/term.jpg" alt=""
                                            height="40px" width="90px">
                                    </a>
                                </td> -->
                                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $p_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td><td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo $p_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                <td>
                                    <div id="gallery" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <img class="me-3 " src="<?php echo $services_img['image']?>"
                                            alt="" data-bs-toggle="modal"
                                            data-bs-target=".bd-example1-modal-md_<?php echo $p_f_s['front_ofs_service_id']?>"
                                            data-slide-to="0"
                                            style="height:30px; width:60px;">
                                    </div>
                                </td>
                                <!-- image gallery -->
                                <div class="modal fade bd-example1-modal-md_<?php echo $p_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                            <img class="d-block w-100" src="<?php echo $services_img['image']?>"
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
                                    <div class="">
                                        <a href="#"
                                            class="btn btn-warning shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $p_f_s['front_ofs_service_id']?>"><i
                                                class="fa fa-pencil"></i></a>
                                        <!--<a href="#" onclick="delete_data(<?php echo $p_f_s['front_ofs_service_id'] ?>)"
                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>-->
                                    </div>
                                </td>
                            </tr>

<div class="modal fade bd-terms-modal-sm_<?php echo $p_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $p_f_s['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade bd-terms-modal-sm1_<?php echo $p_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Terms And Conditions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $p_f_s['t_nd_c'] ?></span>
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

                <?php

if($list)
{
    foreach($list as $p_f_s)
    {
?>
        <div class="modal fade bd-example-modal-lg_<?php echo $p_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('HoteladminController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form"> 
                                    <input type="hidden" name="front_ofs_service_id" value="<?php echo $p_f_s['front_ofs_service_id']?>">
                                    <input type="hidden" class="form-control" value="3" name="service_name">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Staff Name</label>
                                                <input type="text" name="staff_name" value="<?php echo $p_f_s['staff_name']?>" class="form-control" value="Amit Sahane" required="">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" name="contact_no" maxlength="10" value="<?php echo $p_f_s['contact_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Open Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="open_time" value="<?php echo $p_f_s['open_time']?>" class="form-control">
                                                    <input type="time" name="close_time" value="<?php echo $p_f_s['close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Break Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="break_start_time" value="<?php echo $p_f_s['break_start_time']?>" class="form-control">
                                                    <input type="time" name="break_close_time" value="<?php echo $p_f_s['break_close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                    required=""><?php echo $p_f_s['description']?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Terms & Conditions</label>
                                                <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                                    required=""><?php echo $p_f_s['t_nd_c']?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                            $wh1 = '(front_ofs_service_id = "'.$p_f_s['front_ofs_service_id'].'")';

                                            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images',$wh1);
                                            
                                            $j = 0;

                                            if($services_imgs)
                                            {
                                                
                                        ?>
                                  <div class="row">
                                    
                                 
                                               
                                                    <label class="form-label">Pictures of Pool</label>
                                                    <?php
                                                        foreach($services_imgs as $se_i)
                                                        {
                                                    ?>
                                     <div class="mb-3 col-md-4 form-group">
                                                            <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id']?>">
                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $se_i['image']?>">
                                    </div>
                                                           
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
            </div>
        </div>
    </div>
    <?php }  elseif($sub_icon_id == 'n2') { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>All check out Guest</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="col-md-3">
                                      
                                        <div class="input-group">
                                            <input type="text" name="date" class="form-control wide" placeholder="Check-Out Date"
                                                onfocus="(this.type = 'date')" id="date">

                                            <button type="submit" name="search" class="btn btn-warning  btn-sm "><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                      
                                    </div>
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                    <thead>
                    <tr>
                    <th><strong>Sr. No.</strong></th>
                                            <!-- <th><strong>Room No.</strong></th> -->
                                            <th><strong>Guest Name</strong></th>
                                            <th><strong>Mobile No</strong></th>
                                            <th><strong>Booking ID</strong></th>
                                            <th><strong>Check-Out Date</strong></th>
                                            <th><strong>Adults</strong></th>
                                            <th><strong>Child</strong></th>
                                            <th><strong>No. Of Rooms</strong></th>
                                            <!-- <th><strong>Room Type</strong></th> -->
                                            <th><strong>Total Stay</strong></th>
                                            <th><strong>Total Bill</strong></th>
                                            <th><strong>Invoice</strong></th>
                    </tr>
                </thead>
                <tbody id="searchTable">
                <?php
                                    $i = 1;
                                    
                                    if ($list) 
                                    {
                                        foreach ($list as $gl) 
                                        {
                                            $date1 = $gl['check_in'];
                                            $date2 = $gl['actual_checkout'];

                                            $diff = abs(strtotime($date2) - strtotime($date1));

                                            $years = floor($diff / (365*60*60*24));
                                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                            
                                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                        
                                ?>
                                        <tr>
                                            <td><strong><?php echo $i++?></strong></td>
                                            <td><span class="w-space-no"><?php echo $gl['full_name'] ?></span></td>
                                            <td><span class="w-space-no"><?php echo $gl['mobile_no'] ?></span></td>
                                            <td><?php echo $gl['booking_id'] ?></td>
                                            <td><?php echo $gl['actual_checkout'] ?></td>
                                            <td><?php echo $gl['total_adults'] ?></td>
                                            <td><?php echo $gl['total_child'] ?></td>
                                            <td>
                                                <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php echo $gl['booking_id'] ?>">
                                                <?php echo $gl['no_of_rooms'] ?></a>
                                            </td>
                                            <td><?php echo $days ?></td>
                                            <td>Rs <?php echo $gl['total_bill'] ?></td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                                <a href="<?php echo base_url('HoteladminController/check_out_view/'. $gl['booking_id'].'/'.$gl['u_id'])?>"
                                                    class="btn btn-success shadow btn-xs sharp "><i class="material-icons">receipt</i>
                                            </td>
                                        </tr>
                                <?php
                                        }
                                    }
									else
                                    {
							     ?>
                                  		 <tr>
                                                 <td colspan="9" class="text-center">Data Not Available</td>
                                        </tr>
                                  <?php
                                    }
                                ?>
                                
                    
                </tbody>
</table>
                </div>

                <?php

if ($list) 
{
    $admin_id = $this->session->userdata('u_id');

    foreach ($list as $gl) 
    {
        $user_booking_details = $this->MainModel->get_booking_room_details($gl['booking_id']);
        
?>
    <div class="modal fade bd-example-modal-lg_<?php echo $gl['booking_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg slideInDown animated">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Related Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-xl-12">

                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Room Type</th>
                                            <th>Room No</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $j = 1;
                                            if ($user_booking_details) 
                                            {
                                                foreach ($user_booking_details as $u_bd) 
                                                {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $j++ ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap">
                                                                <?php echo $u_bd['room_type_name'] ?>
                                                            </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['room_no'] ?> </h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-nowrap"><?php echo $u_bd['price'] ?></h5>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}
?>
            </div>
        </div>
    </div>
    <?php } elseif($sub_icon_id == 'n1') { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Todays Arrival</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="row">
            <div class="col-md-3">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control wide"
                                                                placeholder="Check-in Date"
                                                                onfocus="(this.type = 'date')" id="date">

                                                            <button class="btn btn-warning  btn-sm "><i
                                                                    class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                  
    
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceArrival">
                                        <option value="arrival1">Today's Arrival</option>
                                        <option value="arrival2">Upcoming Arrival</option>
                                      
                                    </select>                         
                                </div>
                                </div>
            <div class="arrival1_div">
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Walking Guest</button>
                    
                    <br>
                    <br>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Walking Guest</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                               
                                <form action="<?php echo base_url('HoteladminController/add_walking_guest')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Guest Name</label>
                                                        <input type="text" class="form-control" name="full_name" placeholder="Guest Name" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Mobile No</label>
                                                        <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="mobile_no" placeholder="Mobile No" required>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Check-In(Date/Time)</label>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control" name="check_in" placeholder="Date" required>
                                                            <input type="time" class="form-control" name="check_in_time" placeholder="time" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Check-Out(Date/Time)</label>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control" name="check_out" placeholder="Date" required>
                                                            <input type="time" class="form-control" name="check_out_time" placeholder="Time" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">Id Proof</label>
                                                        <input type="file" name="id_proff_img" class="form-control" placeholder="" required>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <label class="form-label">Adults</label>
                                                        <input type="number" name="total_adults" class="form-control" placeholder="Adults" required>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <label class="form-label">Childs</label>
                                                        <input type="number" name="total_child" class="form-control" placeholder="Childs" required>
                                                    </div>
                                                  
                                                     <div class="mb-3 col-md-6">
                                                        <label class="form-label">Guest Type</label>
															<select name="guest_type" id="" class="default-select form-control wide">
                                                            <option selected="" disabled=""> Choose...</option>

                                                            <option value="1">Regular</option>
                                                            <option value="2">CHG</option>
                                                            <option value="3">VIP</option>
                                                            <option value="4">WHG</option>


                                                        </select>                                                    </div>
                                                  
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label">No.of Guest</label>
                                                        <input type="number" name="no_of_guests" class="form-control" placeholder="No. of Guest " required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label ">No Of Rooms</label>
                                                        <input type="number" name="no_of_rooms" value="1" class="form-control" placeholder="No.of Rooms" readonly>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label"> Room Type</label>
                                                        <div class="input-group ">
                                                            <select class="default-select form-control wide " name="room_type" id="room_type">
                                                                <option>Choose Room type...</option>
                                                                <?php
                                                                    $room_type_list_string="";

                                                                    if($room_type_list)
                                                                    {  
                                                                        $room_type_list_string = json_encode($room_type_list);

                                                                        foreach($room_type_list as $r_t)
                                                                        {
                                                                ?>
                                                                            <option value="<?php echo $r_t['room_type_id']?>"><?php echo $r_t['room_type_name']?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                
                                                            </select>
                                                            <a class="btn btn-primary btn-sm" id="btnAdd2"><i
                                                                    class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                              
                                                <!-- <div id="TextBoxContainer2" class="mb-3"></div> -->

                                                <div class="mb-3 col-md-12">
                                                    <label class="form-label"> Assign Room</label>
                                                    <div class="accordion accordion-rounded-stylish accordion-bordered"
                                                        id="accordion-eleven">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="col-xl-12">
                                                                    <!-- <h4>Available Rooms</h4> -->
                                                                      <div id="display_rooms_no" style="display:flex;"></div>

                                                                    <div class="row row-cols-8 ">
                                                                        <!-- <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                            data-bs-target=".add" class="green">
                                                                            <input name="plan" class="radio" type="radio"
                                                                                value="Green" name="clr">
                                                                            <span
                                                                                class="room_no m-0 room_card  red colored-div">101</span>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                </div>
                                                <div id="TextBoxContainer2" class="mb-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Check-in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                    <thead>
                    <tr>
                    <th>Sr. No.</th>
                                                        <th>Booking ID</th>
                                                        <th>Name</th>
                                                        <th>Date(C_In)</th>
                                                        <th>Date(C_Out)</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Rooms</th>
                                                        <th>Adult</th>
                                                        <th>Child</th>
                                                        <th>Assign Room</th>
                    </tr>
                </thead>
                <tbody id="searchTable">
                <?php
                                                
                                                $j = 1;
                                                if($today_hotel_book_list_by_app)
                                                {
                                                     //echo "<pre>";
                                                     //print_r($today_hotel_book_list_by_app);
                                                    foreach($today_hotel_book_list_by_app as $t_h_b)
                                                    {
                                                        $user_data = $this->MainModel->get_user_data($t_h_b['u_id']);
                                                        
                                                        $full_name = "";
                                                        $mobile_no = "";

                                                        if($user_data)
                                                        {
                                                            $full_name = $user_data['full_name'];
                                                            $mobile_no = $user_data['mobile_no'];
                                                            $email_id = $user_data['email_id'];
                                            ?>
                                            
                                                        <tr>
                                                            <td>
                                                                <?php echo $j++?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['booking_id'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $full_name ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['check_in'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['check_out'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $mobile_no ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $email_id ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['no_of_rooms'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['total_adults'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $t_h_b['total_child'] ?>
                                                            </td>

                                                            <td>
                                                                <button style="margin:auto" data-bs-toggle="modal"
                                                                    data-bs-target=".bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>"
                                                                    class="btn btn-success shadow btn-xs sharp "><i
                                                                        class="fa fa-check"></i></button>
                                                                           <div class="modal fade bd-room-modal-sm_<?php echo $t_h_b['booking_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Room Allocation</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <form action="<?php echo base_url('HoteladminController/assign_rooms')?>" method="post">
                                                                            <input type="hidden" name="booking_id" value="<?php echo $t_h_b['booking_id'] ?>">
                                                                            <div class="modal-body">
                                                                                <div class="basic-form">
                                                                                    <div class="col-xl-12">
                                                                                        <h4>Available Rooms</h4>
                                                                                        <div class="row row-cols-8 ">
                                                                                            <?php
                                                                                            
                                                                                                $admin_id = $this->session->userdata('u_id');

                                                                         $room_no_data = $this->MainModel->get_room_nos($admin_id,$t_h_b['room_type']);
                                                                        
                                                                                                if($t_h_b['no_of_rooms'] == 1)
                                                                                                {
                                                                                                    if($room_no_data)
                                                                                                    {   
                                                                                                      //print_r($room_no_data);
                                                                                                        foreach($room_no_data as $r_no)
                                                                                                        {
                                                                             $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                             $room_avaibility = $this->MainModel->getData('room_status',$wh_r);
                                                                             // print_r($room_avaibility);

                                                                                                            if($room_avaibility)
                                                                                                            {                                                                              

                                                                                            ?>
                                                                                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                                data-bs-target=".add" class="green">
                                                                                                                <input name="room_no" class="radio" type="radio" value="<?php echo $r_no['room_no']?>">
                                                                                                                <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                                <input name="price" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                                <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                                            </div>
                                                                                            <?php
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        echo "Rooms not available";
                                                                                                    }
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    if($t_h_b['no_of_rooms'] >= 2)
                                                                                                    {
                                                                                                        if($room_no_data)
                                                                                                        {   
                                                                                                            foreach($room_no_data as $r_no)
                                                                                                            {
                                                                                                                $wh_r = '(hotel_id = "'.$admin_id.'" AND room_no = "'.$r_no['room_no'].'" AND room_status = 3)';

                                                                                                                $room_avaibility = $this->MainModel->getData('room_status',$wh_r);

                                                                                                                if($room_avaibility)
                                                                                                                {                                                                              

                                                                                            ?>
                                                                                                                <div class="room_card card  p-0" data-bs-toggle="modal"
                                                                                                                    data-bs-target=".add" class="green">
                                                                                                                    <input name="room_no1[]" class="radio" type="checkbox" value="<?php echo $r_no['room_no']?>">
                                                                                                                    <span class="room_no m-0 room_card  red colored-div"><?php echo $r_no['room_no']?></span>
                                                                                                                    <input name="price1[]" value="<?php echo $r_no['price']?>" type="hidden">
                                                                                                                    <input name="room_type" value="<?php echo $t_h_b['room_type']?>" type="hidden">
                                                                                                                </div>
                                                                                                <?php
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            echo "Rooms not available";
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>                      
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary css_btn">Check-in</button>
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </td>
                                                            <!-- Modal -->
                                                         
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





            <div class="arrival2_div" style="display: none;margin-right:20px">
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg1">Add Walking Guest</button>
                  
                    <br>
                    <br>
                    <div class="modal fade bd-room-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Room Allocation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="basic-form">
                                <form>
                                    <div class="col-xl-12">
                                        <h4>Available Rooms</h4>
                                        <div class="row row-cols-8 ">

                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add" class="green">
                                                <input name="plan" class="radio" type="checkbox" value="Green"
                                                    name="clr">
                                                <span class="room_no m-0 room_card  red colored-div">101</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">106</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">107</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">108</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">109</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">110</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">111</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">112</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">113</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">114</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">115</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">116</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">117</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">118</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">119</span>
                                            </div>
                                            <div class="room_card card  p-0" data-bs-toggle="modal"
                                                data-bs-target=".add">
                                                <input name="plan" class="radio" type="radio" value="Green" name="clr">
                                                <span class="room_no m-0 room_card  red colored-div ">120</span>
                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary css_btn">Check-in</button>
                            <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div> <!-- end of modal  -->


            <div class="modal fade bd-example-modal-lg1" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Walking Guest</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="col-lg-12">
                                <div class="basic-form">
                                    <form>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Guest Name</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                        <label class="form-label">Mobile No</label>
                                                        <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" name="mobile_no" placeholder="Mobile No" required>
                                                    </div>
                                          
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Check-In</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" placeholder="Date">
                                                    <input type="time" class="form-control" placeholder="time">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Check-Out</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" placeholder="Date">
                                                    <input type="time" class="form-control" placeholder="time">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Id Proof</label>
                                                <input type="file" class="form-control" placeholder="" multiple="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Adults</label>
                                                <input type="number" class="form-control" placeholder="">
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Childs</label>
                                                <input type="number" class="form-control" placeholder="" multiple="">
                                            </div>


                                        </div>
                                        <div class="row ">

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label ">No Of Rooms</label>
                                                <input type="number" class="form-control" placeholder="No.of Rooms ">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label"> Room Type</label>
                                                <div class="input-group ">
                                                    <select class="default-select form-control wide " name="is_active"
                                                        id="active2">
                                                        <option>Choose Room type...</option>

                                                        <option>Single</option>
                                                        <option>Double</option>
                                                        <option>Twin</option>
                                                        <option>King</option>

                                                    </select>

                                                    <a class="btn btn-primary btn-sm" id="btnAdd2"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                            </div>

                                        </div>

                                        <div id="TextBoxContainer2" class="mb-3"></div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label"> Assign Room</label>
                                            <div class="accordion accordion-rounded-stylish accordion-bordered"
                                                id="accordion-eleven">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="col-xl-12">
                                                            <!-- <h4>Available Rooms</h4> -->
                                                            <div class="row row-cols-8 ">

                                                                <div class="room_card card  p-0"
                                                                    data-bs-target=".add" class="green"
                                                                    for="colored-div">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr" for="colored-div">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div">101</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">106</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">107</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">108</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">109</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">110</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">111</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">112</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">113</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">114</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">115</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">116</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">117</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">118</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">119</span>
                                                                </div>
                                                                <div class="room_card card  p-0" 
                                                                    data-bs-target=".add">
                                                                    <input name="plan" class="radio" type="radio"
                                                                        value="Green" name="clr">
                                                                    <span
                                                                        class="room_no m-0 room_card  red colored-div ">120</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Check-in</button>
                        </div>
                    </div>
                </div>
            </div>
                <div class="table-scrollable">
                    <table id="arrival_tbl" class="display full-width">
                    <thead>
                    <tr>
                    <th>Sr. No.</th>
                                                        <th>Name</th>
                                                        <th>Date(C_In)</th>
                                                        <th>Date(C_Out)</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Rooms</th>
                                                        <th>Adult</th>
                                                        <th>Child</th>
                    </tr>
                </thead>
                <tbody id="searchTable">
                <tr>
                                                        <td>
                                                            1
                                                        </td>

                                                        <td>
                                                            Harshada Gaware
                                                        </td>

                                                        <td>
                                                            12/03/2022
                                                        </td>
                                                        <td>
                                                            14/03/2022
                                                        </td>
                                                        <td>
                                                            9876767654
                                                        </td>
                                                        <td>
                                                            abc@gmail.com
                                                        </td>
                                                        <td>
                                                            2
                                                        </td>

                                                        <td>
                                                            2
                                                        </td>
                                                        <td>
                                                            2
                                                        </td>

                                                      
                                                    </tr>

                                
                    
                </tbody>
</table>
                </div>
                                            </div>
                                            </div>                         <div>
             
            </div>
        </div>
    </div>
    <?php } elseif($sub_icon_id == 4) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Shuttle Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
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
                        </tr>
                    </thead>
                    <tbody id="searchTable">
                    <?php

                        $i = 1;
                        if($list)
                        {
                            foreach($list as $sh_f_s)
                            {
                                $wh = '(front_ofs_service_id = "'.$sh_f_s['front_ofs_service_id'].'")';

                                $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
                    ?>
                        <tr>
                            <td><?php echo $i++?></td>
                            <td><?php echo $sh_f_s['staff_name']?></td>
                            <td><?php echo $sh_f_s['contact_no']?></td>
                            <!-- <td>
                                <button
                                    class="btn btn-secondary_<?php echo $sh_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                                        class="fas fa-eye"></i></button>
                            </td> -->
                            <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $sh_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>      <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo $sh_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                            <!-- <td>
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalCenter_<?php echo $sh_f_s['front_ofs_service_id']?>">
                                    <img src="assets/dist/images/term.jpg" alt=""
                                        height="40px" width="90px">
                                </a>
                            </td> -->
                            <!-- term and conditions -->
                            <div class="modal fade" id="exampleModalCenter_<?php echo $sh_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Terms And Conditions</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $sh_f_s['t_nd_c']?></p>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.term and conditions  -->
                            <td>
                                <div id="gallery" data-toggle="modal"
                                    data-target="#exampleModal">
                                    <img class="me-3 " src="<?php echo $services_img['image']?>"
                                        alt="" data-bs-toggle="modal"
                                        data-bs-target=".bd-example1-modal-md_<?php echo $sh_f_s['front_ofs_service_id']?>"
                                        data-slide-to="0"
                                        style="height:30px; width:60px;">
                                </div>
                            </td>
                            <!-- image gallery -->
                            <div class="modal fade bd-example1-modal-md_<?php echo $sh_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                                        <img class="d-block w-100" src="<?php echo $services_img['image']?>"
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
                                    data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg_<?php echo $sh_f_s['front_ofs_service_id']?>"><i
                                        class="fa fa-pencil"></i></a>

                                <!-- <a href="#" onclick="delete_data(<?php echo $sh_f_s['front_ofs_service_id'] ?>)"
                                    class="btn btn-info shadow btn-xs sharp"><i
                                        class="fa fa-list"></i></a> -->
                                        <a  href="#" title="Availability" 
                                    class="btn btn-info shadow btn-xs sharp" onclick="orderservice1(<?php echo $sh_f_s['front_ofs_service_id'] ?>)" ><i
                                        class="fa fa-list"  ></i></a>
                            </td>
                        </tr>
<div class="modal fade bd-terms-modal-sm_<?php echo $sh_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $sh_f_s['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade bd-terms-modal-sm1_<?php echo $sh_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Tearm & Conditions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $sh_f_s['t_nd_c'] ?></span>
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

if($list)
{
    foreach($list as $sh_f_s)
    {
?>
       <div class="modal fade bd-example-modal-lg_<?php echo $sh_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('HoteladminController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form"> 
                                    <input type="hidden" name="front_ofs_service_id" value="<?php echo $sh_f_s['front_ofs_service_id']?>">
                                    <input type="hidden" class="form-control" value="4" name="service_name">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Staff Name</label>
                                                <input type="text" name="staff_name" value="<?php echo $sh_f_s['staff_name']?>" class="form-control" value="Amit Sahane" required="">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" name="contact_no" maxlength="10" value="<?php echo $sh_f_s['contact_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                    required=""><?php echo $sh_f_s['description']?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Terms & Conditions</label>
                                                <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                                    required=""><?php echo $sh_f_s['t_nd_c']?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                            $wh1 = '(front_ofs_service_id = "'.$sh_f_s['front_ofs_service_id'].'")';

                                            $services_imgs = $this->MainModel->getData('front_ofs_services_images',$wh1);
                                            
                                            // $j = 0;

                                            if($services_imgs)
                                            {
                                                
                                        ?>
                                                <div class="mb-3 col-md-6 form-group">
                                                    <label class="form-label">Pictures</label>
                                                    <?php
                                                        // foreach($services_imgs as $se_i)
                                                        // {
                                                    ?>
                                                            <input type="hidden" name="shuttle_service_image_id" value="<?php echo $services_imgs['front_ofs_service_image_id']?>">
                                                            <input type="file" class="dropify form-control" name="shuttle_img" id="files" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $services_imgs['image']?>">
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
            <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                    <tbody id="searchTable">
                    <?php

                                                                if($sun_list)
                                                                {
                                                                    foreach($sun_list as $sun_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($sun_l['start_time']))." - ".date('h:i a',strtotime($sun_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($sun_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sun_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sun_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
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
                    <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

                               if($mon_list)
                                {
                                    foreach($mon_list as $ml)
                                    {
                                       ?>
                                    <tr>
                                    <td><strong><?php echo date('h:i a',strtotime($ml['start_time']))." - ".date('h:i a',strtotime($ml['end_time'])) ?> </strong></td>
                                    <td>
                                    <div class="container">
                                    <label class="switch">
                                    <?php
                                    if($ml['available_status'] == 1)
                                    {
                                        ?>
                                        <input type="checkbox" value="0" name="available_status" id="status_<?php echo $ml['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $ml['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                        <span class="switch-label" data-on="Available"></span>
                                        <span class="switch-handle"></span>
                                        <?php
                                    }
                                    else
                                    {
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
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

if($tue_list)
{
    foreach($tue_list as $tuel)
    {
?>
        <tr>
            <td><strong><?php echo date('h:i a',strtotime($tuel['start_time']))." - ".date('h:i a',strtotime($tuel['end_time'])) ?> </strong></td>
            <td>
                <div class="container">
                    <label class="switch">
                        <?php
                            if($tuel['available_status'] == 1)
                            {
                        ?>
                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $tuel['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $tuel['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                <span class="switch-label" data-on="Available"></span>
                                <span class="switch-handle"></span>
                        <?php
                            }
                            else
                            {
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
                 <form action="<?php echo base_url('HoteldaminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

                                                                if($wed_list)
                                                                {
                                                                    foreach($wed_list as $wed_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($wed_l['start_time']))." - ".date('h:i a',strtotime($wed_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($wed_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $wed_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $wed_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
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
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

                                                                if($thurs_list)
                                                                {
                                                                    foreach($thurs_list as $thu_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($thu_l['start_time']))." - ".date('h:i a',strtotime($thu_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($thu_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $thu_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $thu_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
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
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

                                                                if($fri_list)
                                                                {
                                                                    foreach($fri_list as $fr_l)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo date('h:i a',strtotime($fr_l['start_time']))." - ".date('h:i a',strtotime($fr_l['end_time'])) ?> </strong></td>
                                                                            <td>
                                                                                <div class="container">
                                                                                    <label class="switch">
                                                                                        <?php
                                                                                            if($fr_l['available_status'] == 1)
                                                                                            {
                                                                                        ?>
                                                                                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $fr_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $fr_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                                                                                <span class="switch-label" data-on="Available"></span>
                                                                                                <span class="switch-handle"></span>
                                                                                        <?php
                                                                                            }
                                                                                            else
                                                                                            {
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
                 <form action="<?php echo base_url('HoteladminController/add_shuttle_service_staff_avaibility')?>" method="post">
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

if($sat_list)
{
    foreach($sat_list as $sat_l)
    {
?>
        <tr>
            <td><strong><?php echo date('h:i a',strtotime($sat_l['start_time']))." - ".date('h:i a',strtotime($sat_l['end_time'])) ?> </strong></td>
            <td>
                <div class="container">
                    <label class="switch">
                        <?php
                            if($sat_l['available_status'] == 1)
                            {
                        ?>
                                <input type="checkbox" value="0" name="available_status" id="status_<?php echo $sat_l['shuttle_service_avaibility_id'] ?>" onchange="change_status(<?php echo $sat_l['shuttle_service_avaibility_id'] ?>)" class="switch-input" checked>
                                <span class="switch-label" data-on="Available"></span>
                                <span class="switch-handle"></span>
                        <?php
                            }
                            else
                            {
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
    
    <?php }  elseif($sub_icon_id == 5) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Baby Care Information</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

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
                <tbody id="searchTable">

                <?php

                    $i = 1;
                    if($list)
                    {
                        foreach($list as $baby_f_s)
                        {
                            $wh = '(front_ofs_service_id = "'.$baby_f_s['front_ofs_service_id'].'")';

                            $services_img = $this->HotelAdminModel->getData('front_ofs_services_images',$wh);
                ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td><?php echo $baby_f_s['staff_name']?></td>
                                <td><?php echo $baby_f_s['contact_no']?></td>
                                <td><?php echo date('h:i a',strtotime($baby_f_s['open_time']))."-".date('h:i a',strtotime($baby_f_s['close_time']))?></td>
                                <td><?php echo date('h:i a',strtotime($baby_f_s['break_start_time']))."-".date('h:i a',strtotime($baby_f_s['break_close_time']))?></td>
                                <!-- <td>
                                    <button class="btn btn-secondary_<?php echo $baby_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                                        class="fas fa-eye"></i></button>
                                </td>
                                <td>
                                    <a href="" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter_<?php echo $baby_f_s['front_ofs_service_id']?>">
                                        <img src="assets/dist/images/term.jpg" alt=""
                                            height="40px" width="60px">
                                    </a>
                                </td> -->
                                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td><td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm1_<?php echo $baby_f_s['front_ofs_service_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                                <!-- modal for terms and conditions -->
                                <td>
                                    <div class="lightgallery"
                                        class="room-list-bx d-flex align-items-center">
                                        <a href="<?php echo $services_img['image']?>"
                                            data-exthumbimage="<?php echo $services_img['image']?>"
                                            data-src="<?php echo $services_img['image']?>"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img class="me-3 "
                                                src="<?php echo $services_img['image']?>"
                                                alt="" style="width:50px; height:40px;">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        <a href="#"
                                            class="btn btn-warning shadow btn-xs sharp me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target=".bd-example-modal-lg_<?php echo $baby_f_s['front_ofs_service_id']?>"><i
                                                class="fa fa-pencil"></i></a>
                                        <!--<a href="#" onclick="delete_data(<?php echo $baby_f_s['front_ofs_service_id'] ?>)"
                                            class="btn btn-danger shadow btn-xs sharp delete"><i
                                                class="fa fa-trash"></i></a>-->
                                    </div>
                                </td>
                            </tr>
<div class="modal fade bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $baby_f_s['description'] ?></span>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<div class="modal fade bd-terms-modal-sm1_<?php echo $baby_f_s['front_ofs_service_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Terms And Conditions</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $baby_f_s['t_nd_c'] ?></span>
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
                <?php

if($list)
{
    foreach($list as $baby_f_s)
    {
?>

        <div class="modal fade bd-example-modal-lg_<?php echo $baby_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form action="<?php echo base_url('HoteladminController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form"> 
                                    <input type="hidden" name="front_ofs_service_id" value="<?php echo $baby_f_s['front_ofs_service_id']?>">
                                    <input type="hidden" class="form-control" value="5" name="service_name">
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Staff Name</label>
                                                <input type="text" name="staff_name" value="<?php echo $baby_f_s['staff_name']?>" class="form-control" value="Amit Sahane" required="">
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Contact Number</label>
                                                <input type="text" name="contact_no" maxlength="10" value="<?php echo $baby_f_s['contact_no']?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" value="9878675645" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Open Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="open_time" value="<?php echo $baby_f_s['open_time']?>" class="form-control">
                                                    <input type="time" name="close_time" value="<?php echo $baby_f_s['close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Break Time</label>
                                                <div class="input-group">
                                                    <input type="time" name="break_start_time" value="<?php echo $baby_f_s['break_start_time']?>" class="form-control">
                                                    <input type="time" name="break_close_time" value="<?php echo $baby_f_s['break_close_time']?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Description</label>
                                                <textarea class="summernote" name="description" rows="3" id="comment"
                                                    required=""><?php echo $baby_f_s['description']?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6 form-group">
                                                <label class="form-label">Terms & Conditions</label>
                                                <textarea class="summernote" name="t_nd_c" rows="3" id="comment"
                                                    required=""><?php echo $baby_f_s['t_nd_c']?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                            $wh1 = '(front_ofs_service_id = "'.$baby_f_s['front_ofs_service_id'].'")';

                                            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images',$wh1);
                                            
                                            $j = 0;

                                            if($services_imgs)
                                            {
                                                
                                        ?>
                                                <div class="mb-3 col-md-6 form-group">
                                                    <label class="form-label">Pictures</label>
                                                    <?php
                                                        foreach($services_imgs as $se_i)
                                                        {
                                                    ?>
                                                            <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id']?>">
                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png, image/gif," data-default-file="<?php echo $se_i['image']?>">
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
            </div>
        </div>
    </div>
    <?php }   elseif($sub_icon_id == 6) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
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
                
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">Car Wash Request</option>
                                        <option value="accepted_order">Accepted Car Wash Request</option>
                                        <option value="rejected_order">Washing Charges</option>
                                     
                                    </select>                         
                                </div>
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
                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                    <thead>
            <tr>
                <th><strong>Sr. No.</strong></th>
                <th><strong>Guest Name</strong></th>
                <th><strong>Phone</strong></th>
                <!-- <th><strong>Email</strong></th> -->
                <th><strong>Select Date</strong></th>
                <th><strong>Select Time</strong></th>
                <th><strong>Vehicle Name</strong></th>
                <th><strong>Vehicle No.</strong></th>
                <th><strong>Photo</strong></th>
                <th><strong>Note</strong></th>
                <!-- <th><strong>Terms</strong></th> -->
                <th><strong>Assign</strong></th>
            </tr>
        </thead>
        <tbody id="searchTable">
        <?php
        
            $j = 1;
            if($vehicle_wash_request)
            {
                foreach($vehicle_wash_request as $v_w_r)
                {
                    $wh = '(u_id = "'.$v_w_r['u_id'].'")';

                    $user_data = $this->HotelAdminModel->getData('register',$wh);

                    if($user_data)
                    {
        ?>
        
                        <tr>
                            <td><strong><?php echo $j++?></strong></td>
                            <td><?php echo $user_data['full_name'] ?></td>
                            <td><?php echo $user_data['mobile_no'] ?></td>
                            <!--<td><?php echo $v_w_r['date'] ?></td>-->
                            <td><?php echo $v_w_r['select_date'] ?></td>
                            <!-- <td>23/12/2022</td> -->
                            <td><?php echo date('h:i a',strtotime($v_w_r['select_time'])) ?></td>
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
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $v_w_r['vehicle_wash_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                            <td>
                                <!-- <a href="#">
                                    <div class="badge badge-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">
                                        Assign</div>
                                </a> -->
                                <?php
                                    if($v_w_r['request_status'] == 1)	
                                    {
                                ?>
                                        <span class="badge badge-danger">Accepted</span>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                        <a onclick="return confirm('Are you sure accept this request?')" href="<?php echo base_url('HoteladminController/request_accept/'.$v_w_r['vehicle_wash_request_id'])?>" class="submit"><span class="badge badge-success">Accept</span> </a>
                                        <a onclick="return confirm('Are you sure reject this request?')" href="<?php echo base_url('HoteladminController/request_reject/'.$v_w_r['vehicle_wash_request_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
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

        <div class="accepted_orders_div" style="display: none;">
                <div class="table-scrollable">
                    <table id="acceptedOrder_tb" class="display full-width">
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
        
        if($vehicle_wash_request1)
        {
            foreach($vehicle_wash_request1 as $v_w_r)
            {
                $wh = '(u_id = "'.$v_w_r['u_id'].'")';

                $user_data = $this->MainModel->getData('register',$wh);

                if($user_data)
                {
    ?>
        <tr>
            <td><strong><?php echo $j++?></strong></td>
            <td><?php echo $user_data['full_name'] ?></td>
            <td><?php echo $user_data['mobile_no'] ?></td>
            <td><?php echo $v_w_r['select_date'] ?></td>
            <td><?php echo date('h:i a',strtotime($v_w_r['select_time'])) ?></td>
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
                <div class="d-flex">
                    <a href="#"><span class="badge badge-success"
                            data-bs-toggle="modal"
                            data-bs-target="">Accepted</span>
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
                                    <form action="<?php echo base_url('HoteladminController/add_vehicle_washing_charges')?>" method="post">
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
                       
                <div class="table-scrollable">
                    <table id="rejectedOrder_tb" class="display full-width">
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

$i =1;

if($vehicle_wash_request2)
{
    foreach($vehicle_wash_request2 as $v_wash_char)
    {
        
?>
        <tr>
            <td>
                <h5 class="text-nowrap"><?php echo $i++?></h5>
            </td>
            <td>
                <h5 class="text-nowrap"><?php echo $v_wash_char['vehicle_type']?></h5>
            </td>
            <td>
                <h5> <i class="fa fa-rupees"><?php echo $v_wash_char['charges']?></i></h5>
            </td>
            <td>
                <div>
                    <a href="#"
                        class="btn btn-warning shadow btn-xs sharp me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter2_<?php echo $v_wash_char['vehicle_washing_charge_id']?>"><i
                            class="fa fa-pencil"></i></a>
                    <a href="#"  onclick="delete_data_car(<?php echo $v_wash_char['vehicle_washing_charge_id'] ?>)"
                        class="btn btn-danger shadow btn-xs sharp"><i
                            class="fa fa-trash"></i></a>
                </div>
                <!-- edit -->
                <div class="modal fade" id="exampleModalCenter2_<?php echo $v_wash_char['vehicle_washing_charge_id']?>" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Washing Charges</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/edit_vehicle_washing_charges')?>" method="post">
                                <input type="hidden" name="vehicle_washing_charge_id" value="<?php echo $v_wash_char['vehicle_washing_charge_id']?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-12 form-group">
                                            <label class="form-label">Vehicle Type</label>
                                            <input type="text" class="form-control" name="vehicle_type" value="<?php echo $v_wash_char['vehicle_type']?>">
                                        </div>
                                        <div class="mb-3 col-md-12 form-group">
                                            <label class="form-label">Charges</label>
                                            <input type="number" class="form-control" name="charges" value="<?php echo $v_wash_char['charges']?>">
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
        </div>
        </div>
    </div>
    <?php }  elseif($sub_icon_id == 7) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
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
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown1">
                                        <option value="new_orders1">Luggage Request</option>
                                        <option value="accepted_order1">Accepted Luggage Request</option>
                                        <option value="rejected_order1">Luggage Charges</option>
                                     
                                    </select>                         
                                </div>
                                <div class="new_orders_div1"><br>
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

                <div class="table-scrollable">
                <table id="example1" class="display full-width">
                <thead>
                <tr>
                    <th><strong>Sr. No.</strong></th>
                    <th><strong>Guest Name</strong></th>
                    <th><strong>Mobile Number</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>Time</strong></th>
                    <th><strong>Type Of Luggage</strong></th>
                    <!-- <th><strong>Luggage Photo</strong></th> -->
                    <th><strong>Qty</strong></th> 
                    <th><strong>Note</strong></th>
                    <th><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody id="searchTable">
            <?php
            
                $j = 1;

                if($luggage_request)
                {
                    foreach($luggage_request as $lug_r)
                    {
                        $wh = '(u_id = "'.$lug_r['u_id'].'")';

                        $user_data = $this->HotelAdminModel->getData('register',$wh);

                        if($user_data)
                        { 
                            

            ?>
                            <tr>
                                <td><strong><?php echo $j++?></strong></td>
                                <td><?php echo $user_data['full_name'] ?></td>
                                <td><?php echo $user_data['mobile_no'] ?></td>
                                <td><?php echo $lug_r['select_date'] ?></td>
                                <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                                <td>
                                    <?php 
                                        
                                        $wh_lr1 = '(luggage_request_id = "'.$lug_r['luggage_request_id'].'")';

                                        $luggage_req_details = $this->HotelAdminModel->getAllData('luggage_req_details',$wh_lr1);

                                        if($luggage_req_details)
                                        { 
                                            foreach ($luggage_req_details as $lrd) 
                                            {
                                                $wh1 = '(luggage_charge_id = "'.$lrd['luggage_type_id'].'")';

                                                $luggage_data = $this->HotelAdminModel->getData('luggage_charges',$wh1);

                                                echo $luggage_data['luggage_type']."<br>";
                                            }
                                        }
                                    
                                    
                                    ?> 
                                </td>
                                <!-- <td>
                                    <div class="lightgallery"
                                        class="room-list-bx  align-items-center">
                                        <a href="<?php //echo $lug_r['luggage_img'] ?>"
                                            data-exthumbimage="<?php //echo $lug_r['luggage_img'] ?>"
                                            data-src="<?php //echo $lug_r['luggage_img'] ?>"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img class="me-3 "
                                                src="<?php //echo $lug_r['luggage_img'] ?>" alt=""
                                                style="width:50px;">
                                        </a>
                                    </div>
                                </td> -->
                                <td>1<?php //echo $lug_r['quantity'] ?></td> 
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
                                    <a href="<?php echo base_url('HoteladminController/accept_cloakroom_service_request/'.$lug_r['luggage_request_id'])?>" class="submit"><span class="badge badge-success">Accept</span></a>
                                    <a href="<?php echo base_url('HoteladminController/reject_cloakroom_service_request/'.$lug_r['luggage_request_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
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
            <div class="accepted_orders_div1" style="display: none;">
                <div class="table-scrollable">
                <table id="acceptedOrder_tb1" class="display full-width">
                <thead>
                <tr>
                <th><strong>Sr. No.</strong></th>
                                                            <th><strong>Guest Name</strong></th>
                                                          <th><strong>Mobile Number</strong></th>
                                                            <th><strong>Date</strong></th>
                                                            <th><strong>Time</strong></th>
                                                            <th><strong>Type Of Luggage</strong></th>
                                                            <th><strong>Qty</strong></th>
                                                            <th><strong>Note</strong></th>
                                                            <th><strong>Status</strong></th>
                </tr>
            </thead>
            <tbody id="searchTable">
            <?php
                                                    
                                                        $j = 1;

                                                        if($luggage_request1)
                                                        {
                                                            foreach($luggage_request1 as $lug_r)
                                                            {
                                                                $wh = '(u_id = "'.$lug_r['u_id'].'")';

                                                                $user_data = $this->MainModel->getData('register',$wh);

                                                                if($user_data)
                                                                { 
                                                    ?>
                                                        <tr>
                                                            <td><strong><?php echo $j++?></strong></td>
                                                            <td><?php echo $user_data['full_name'] ?></td>
                                                            <td><?php echo $user_data['mobile_no'] ?></td>
                                                            <td><?php echo $lug_r['select_date'] ?></td>
                                                            <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                                                            <td>
                                                                <?php 
                                                                    
                                                                    $wh_lr1 = '(luggage_request_id = "'.$lug_r['luggage_request_id'].'")';

                                                                    $luggage_req_details = $this->MainModel->getAllData('luggage_req_details',$wh_lr1);

                                                                    if($luggage_req_details)
                                                                    { 
                                                                        foreach ($luggage_req_details as $lrd) 
                                                                        {
                                                                            $wh1 = '(luggage_charge_id = "'.$lrd['luggage_type_id'].'")';

                                                                            $luggage_data = $this->MainModel->getData('luggage_charges',$wh1);

                                                                            echo $luggage_data['luggage_type']."<br>";
                                                                        }
                                                                    }
                                                                
                                                                
                                                                ?> 
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    foreach ($luggage_req_details as $lrd) 
                                                                    {
                                                                        echo $lrd['quantity']."<br>";
                                                                    }
                                                                ?>
                                                            </td> 
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
                                                            <td><a href="#">
                                                                    <div class="badge badge-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="">
                                                                        Accepted</div>
                                                                </a></td>
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
                                    <form action="<?php echo base_url('HoteladminController/add_luggage_charges')?>" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="mb-3 col-md-12 form-group">
                                                    <label class="form-label">Luggage Type</label>
                                                    <input type="text" name="luggage_type" class="form-control" placeholder="Luggage Type" required="">
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
                <div class="table-scrollable">
                <table id="rejectedOrder_tb1" class="display full-width">
                <thead>
                <tr>
                <th>Sr. No.</th>
                                                                    <th>Luggage Type</th>
                                                                    <th>Charges</th>
                                                                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="searchTable">
            <?php

$i = 1;
if($luggage_request2)
{
    foreach($luggage_request2 as $cl_s)
    {
        
?>
        <tr>
            <td>
                <h5 class="text-nowrap"><?php echo $i++?></h5>
            </td>
            <td>
                <h5 class="text-nowrap"><?php echo $cl_s['luggage_type']?></h5>
            </td>
            <td>
                <h5> <i class="fa fa-rupees"><?php echo $cl_s['charges']?></i></h5>
            </td>
            <td>
                <div>
                    <a href="#"
                        class="btn btn-warning shadow btn-xs sharp me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter2_<?php echo $cl_s['luggage_charge_id']?>"><i
                            class="fa fa-pencil"></i></a>
                    <a href="#" onclick="delete_data_luggage(<?php echo $cl_s['luggage_charge_id'] ?>)"
                        class="btn btn-danger shadow btn-xs sharp"><i
                            class="fa fa-trash"></i></a>
                </div>
                <!-- edit -->
                <div class="modal fade" id="exampleModalCenter2_<?php echo $cl_s['luggage_charge_id']?>" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Luggage Charges</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <form action="<?php echo base_url('HoteladminController/edit_luggage_charges')?>" method="post">
                                <div class="modal-body">
                                    <div class="row">
                                    <input type="hidden" name="luggage_charge_id" value="<?php echo $cl_s['luggage_charge_id']?>">
                                        <div class="mb-3 col-md-12 form-group">
                                            <label class="form-label">luggage Type</label>
                                            <input type="text" class="form-control" name="luggage_type" value="<?php echo $cl_s['luggage_type']?>">
                                        </div>
                                        <div class="mb-3 col-md-12 form-group">
                                            <label class="form-label">Charges</label>
                                            <input type="number" class="form-control" name="charges" value="<?php echo $cl_s['charges']?>">
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
                <!--/. edit -->
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
    <?php }   elseif($sub_icon_id == 8) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
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
            <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown2">
                                        <option value="new_orders2">Cab Service Request</option>
                                        <option value="accepted_order2">Accepted Cab Request</option>
                                     
                                    </select>                         
                                </div>
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
                <tbody id="searchTable">
                <?php

                    $i = 1;
                    if($list)
                    {
                        foreach($list as $c_s)
                        {
                            $user_data = $this->HotelAdminModel->get_user_data($c_s['u_id']);
                            
                            $full_name = "";
                            $mobile_no = "";

                            if($user_data)
                            {
                                $full_name = $user_data['full_name'];
                                $mobile_no = $user_data['mobile_no'];
                            }
                ?>
                
                    <tr>
                        <td><strong><?php echo $i++?></strong></td>
                        <td><?php echo $c_s['total_passanger'] ?></td>
                        <td>
                            <?php echo $c_s['request_date'] ?> /<sub> <?php echo date('h:i a',strtotime($c_s['request_time'])) ?></sub>
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
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                        <td><a href="javascript:void(0)"
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
                                    <form action="<?php echo base_url('HoteladminController/change_cab_service_request')?>" method="post">
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
                                            <!-- <div class="green box">Your
                                                Request has been Cancelled !</div> -->

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
                    <div class="modal fade bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Note</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $c_s['description'] ?></span>
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



                <div class="accepted_orders_div2" style="display: none;">
                <div class="table-scrollable">
                <table id="acceptedOrder_tb2" class="display full-width">
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

                        <!-- <th><strong>Status</strong></th> -->
                    </tr>
                </thead>
                <tbody id="searchTable">
                <?php

                                                    $i = 1;
                                                    if($list1)
                                                    {
                                                        foreach ($list1 as $cb_s) 
                                                        {
                                                            $user_data = $this->MainModel->get_user_data($cb_s['u_id']);
                                                            
                                                            $full_name = "";
                                                            $mobile_no = "";

                                                            if($user_data)
                                                            {
                                                                $full_name = $user_data['full_name'];
                                                                $mobile_no = $user_data['mobile_no'];
                                                            }
                                                ?>
                                                
                                                    <tr>
                                                        <td><strong><?php echo $i++?></strong></td>
                                                        <td><?php echo $cb_s['total_passanger'] ?></td>
                                                        <td>
                                                            <?php echo $cb_s['request_date'] ?> /<sub> <?php echo date('h:i a',strtotime($cb_s['request_time'])) ?></sub>
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
    <?php } ?>
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
     
        var base_url = '<?php echo base_url();?>';
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
    // $('.delete').click(function() {
    function delete_data_car(id)
    {
        var id = id;
        var base_url = '<?php echo base_url()?>';

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
     
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+selectedOrderserviceurl,
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    });

</script>  <script>
            // $('.delete').click(function() {
                function delete_data_luggage(id)
                {
                    var id = id;
                    var base_url = '<?php echo base_url()?>';

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
      
        var base_url = '<?php echo base_url();?>';
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
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
    </script>

<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb5').DataTable();
      
    } );
    var selectedOrderserviceurl = '';
    function orderservice1(clicked) {
       
            selectedOrderserviceurl = 'HoteladminContrller/shuttle_availabilty';
            $('.accepted_orders_div_service').css('display','block');
            $('.new_orders_div_service').css('display','none');
           
       
      
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+selectedOrderserviceurl,
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    };

</script>  

<script>
            function change_status(id)
            {
            var base_url = '<?php echo base_url()?>';
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
        </script>

<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
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
     
        var base_url = '<?php echo base_url();?>';
        $.ajax({
            method: "GET",
            url: base_url+selectedOrderserviceurl,
            success: function (response) {
                $('.append_data').html(response);
            }
        });
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script>
    $('.accordion-toggle').click(function() {
        $('.hiddenRow').hide();
        $(this).next('tr').find('.hiddenRow').show();
    });
    </script>
    <script>
    $('input[type=radio]').on('click', function() {

        $('input[type=radio]').not(this).closest('label').css('background', 'blue');
        $(this).closest('label').css('background', 'red');
    });
    </script>
    <script>
    $(document).ready(function() {
        $('.amt_ch input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            console.log(inputValue);
            if (inputValue == "App") {
                $("#App_Ord").show();
                $("#Walkin_Ord").hide();

            } else {
                $("#Walkin_Ord").show();
                $("#App_Ord").hide();
            }

        });
        // $('input[type="radio"]').click(function() {
        //     var inputValue = $(this).attr("value");
        //     var targetBox = $("." + inputValue);
        //     $(".walkin_guest").not(targetBox).hide();
        //     $(targetBox).show();
        // });
    });
    </script>
  
    <!-- automatic hide session data -->
    <script>
        $(document).ready(function(){
            $('.alert').delay(4000).fadeOut();
        });
    </script>
    <!-- automatic hide session data -->
    <!--onchange function on roomtype and display room type  -->
    <script>

        $(document).ready(function(){
          
            $('#room_type').change(function()
            {
            
                var base_url = '<?php echo base_url()?>';
                var room_type = $('#room_type').val();

                // alert(room_type);

                if(room_type != '')
                {
                    $.ajax({
                        url : base_url +"HoteladminController/get_room_nos",
                        method : "POST",
                        data : {room_type : room_type},
                        success : function(data)
                                    {
                                        //alert(data);
                                        $('#display_rooms_no').html(data);
                                    }

                    });
                }
            });

      });
    </script>
    <script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#arrival_tbl').DataTable();
    } );
 
    $('#orderserviceArrival').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'arrival1')
        {
            $('.arrival1_div').css('display','block');
            $('.arrival2_div').css('display','none');
           
        }
        if(selected_orderservice == 'arrival2')
        {
            $('.arrival2_div').css('display','block');
            $('.arrival1_div').css('display','none');
           
        }
     
    });

</script> 