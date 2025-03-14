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
                            </tr>
                        </thead>
                        <tbody class="">
                        <?php

$i = 1; //+$this->uri->segment(2);
if($list)
{
    foreach($list as $g_f_s)
    {
        $wh = '(front_ofs_service_id = "'.$g_f_s['front_ofs_service_id'].'")';

        $services_img = $this->MainModel->getData('front_ofs_services_images',$wh);
?>

<tr>
<td><h5><?php echo $i++?></h5></td>
<td>
    <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
    <div id="gallery" data-toggle="modal"
        data-target="#exampleModal">
        <img class="me-3 "
            src="<?php echo $services_img['image']?>" alt=""
            data-bs-toggle="modal"
            data-bs-target=".bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>"
            data-slide-to="0" style="height:30px; width:60px;">
    </div>
</td>
<td><h5><?php echo $g_f_s['staff_name']?></h5></td>
<td><h5><?php echo $g_f_s['contact_no']?></h5></td>
<td><h5><?php echo date('h:i a',strtotime($g_f_s['open_time']))."-".date('h:i a',strtotime($g_f_s['close_time']))?></h5>
</td>
<td><h5><?php echo date('h:i a',strtotime($g_f_s['break_start_time']))."-".date('h:i a',strtotime($g_f_s['break_close_time']))?>
    </h5>  </td>
<td>
   

            <a href="#"
        class="btn btn-secondary shadow btn-xs sharp me-1"
        data-bs-toggle="modal"
        data-bs-target="#exampleModalCenter12_<?php echo $g_f_s['front_ofs_service_id']?>"><i
            class="fa fa-eye"></i></a>

</td>
 <!-- modal for terms and conditions -->
 <div class="modal fade" id="exampleModalCenter12_<?php echo  $g_f_s['front_ofs_service_id'] ?>" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Description</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $g_f_s['description']?></p>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
            <!--/. modal for terms and conditions -->
<!-- <td>
            <a href="" data-bs-toggle="modal"
                data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>">
                <img src="assets/dist/images/term.jpg" alt=""
                    height="40px" width="90px">
            </a>
        </td> -->
<td>
    <div>
        <span class="badge light badge-warning"
            data-bs-toggle="modal"
            data-bs-target="#exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>">View</span>
    </div>
</td>
<!-- modal for terms and conditions -->
<div class="modal fade"
    id="exampleModalCenter_<?php echo $g_f_s['front_ofs_service_id']?>"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms And Conditions
                </h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $g_f_s['t_nd_c']?></p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--/. modal for terms and conditions -->

<!-- image gallery -->
<div class="modal fade bd-example1-modal-md_<?php echo $g_f_s['front_ofs_service_id']?>"
    tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pictures of Pool</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">

                <div id="carouselExampleIndicators"
                    class="carousel slide"
                    data-bs-ride="carousel">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"
                                src="<?php echo $services_img['image']?>"
                                alt="First slide">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/. image gallery -->
<td>
    <a href="#" class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
        data-bs-toggle="modal" data-id="<?php echo $g_f_s['front_ofs_service_id']?>"
        data-bs-target=".bd-example-modal-lg_<?php echo $g_f_s['front_ofs_service_id']?>"><i
            class="fa fa-pencil"></i></a>

         <!--   <a href="#" id="delete_<?php echo $g_f_s['front_ofs_service_id']  ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                <i class="fa fa-trash "></i> </a> -->
                <div class="modal fade bd-example-modal-lg_<?php echo $g_f_s['front_ofs_service_id']?>"
tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit schedule</h5>
            <button type="button" class="btn-close"
                data-bs-dismiss="modal">
            </button>
        </div>
        <form
            action="<?php echo base_url('FrontofficeController/edit_front_ofs_services')?>"
            method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="basic-form">
                        <input type="hidden"
                            name="front_ofs_service_id"
                            value="<?php echo $g_f_s['front_ofs_service_id']?>">
                        <input type="hidden"
                            class="form-control" value="1"
                            name="service_name">
                        <div class="row">
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label class="form-label">Staff
                                    Name</label>
                                <input type="text"
                                    name="staff_name"
                                    value="<?php echo $g_f_s['staff_name']?>"
                                    class="form-control"
                                    value="Amit Sahane"
                                    required="">
                            </div>
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label
                                    class="form-label">Contact
                                    Number</label>
                                <input type="text"
                                    name="contact_no"
                                    maxlength="10"
                                    value="<?php echo $g_f_s['contact_no']?>"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    class="form-control"
                                    value="9878675645"
                                    required="">
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label class="form-label">Open
                                    Time</label>
                                <div class="input-group">
                                    <input type="time"
                                        name="open_time"
                                        value="<?php echo $g_f_s['open_time']?>"
                                        class="form-control">
                                    <input type="time"
                                        name="close_time"
                                        value="<?php echo $g_f_s['close_time']?>"
                                        class="form-control">
                                </div>
                            </div>
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label class="form-label">Break
                                    Time</label>
                                <div class="input-group">
                                    <input type="time"
                                        name="break_start_time"
                                        value="<?php echo $g_f_s['break_start_time']?>"
                                        class="form-control">
                                    <input type="time"
                                        name="break_close_time"
                                        value="<?php echo $g_f_s['break_close_time']?>"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label
                                    class="form-label">Description</label>
                                <textarea class="summernote"
                                    name="description" rows="3"
                                    id="comment"
                                    required=""><?php echo $g_f_s['description']?></textarea>
                            </div>
                            <div
                                class="mb-3 col-md-6 form-group">
                                <label class="form-label">Terms
                                    & Conditions</label>
                                <textarea class="summernote"
                                    name="t_nd_c" rows="3"
                                    id="comment"
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
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label">Pictures
                                of Gym</label>
                            <?php
                foreach($services_imgs as $se_i)
                {
            ?>
                            <input type="hidden"
                                name="front_ofs_service_image_id[]"
                                value="<?php echo $se_i['front_ofs_service_image_id']?>">
                            <input type="file"
                                class="dropify form-control"
                                name="image[<?php echo $j?>]"
                                id="files"
                                accept="image/jpeg, image/png,"
                                data-default-file="<?php echo $se_i['image']?>">
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
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit"
                    class="btn btn-primary css_btn">Save
                    changes</button>
            </div>
        </form>
    </div>
</div>
</div>
    </td>
</tr>


<!--dlt script start-->                                                               
<script>

document.getElementById('delete_<?php echo $g_f_s['front_ofs_service_id']  ?>').onclick = function() {
var id='<?php echo $g_f_s['front_ofs_service_id'] ?>';
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
        url:base_url+"MainController/delete_front_ofs_services", 
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
};
</script>

<!--end dlt script-->  
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
                                                            <th><strong>Sr.No.</strong></th>
                                                            <th><strong>Staff Name</strong></th>
                                                            <th><strong>Contact No.</strong></th>
                                                            <th><strong>Open Time </strong></th>
                                                            <th><strong>Break Time</strong></th>

                                                            <th><strong>Description</strong></th>
                                                            <th><Strong>Spa Types</Strong></th>
                                                            <th><strong>Terms & Condition</strong></th>
                                                            <!-- <th><strong>Pictures</strong></th> -->
                                                            <th><strong>Action</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="searchTable">
                                            
                                                        <?php

                                                            $i = 1; // + $this->uri->segment(2);
                                                            
                                                            if(!empty($list))
                                                            {
                                                                foreach($list as $spa_f_s)
                                                                {
                                                                    $wh = '(front_ofs_service_id = "'.$spa_f_s['front_ofs_service_id'].'")';

                                                                    $services_img = $this->MainModel->getData('front_ofs_services_images',$wh);
                                                        ?>

                                                                <tr>
                                                                    <td><h5><?php echo $i++?></h5></td>
                                                                    <td><h5><?php echo $spa_f_s['staff_name']?></h5></td>
                                                                    <td><h5><?php echo $spa_f_s['contact_no']?></h5></td>
                                                                    <!-- <td><h5><?php echo date('h:i a',strtotime($spa_f_s['open_time']))."-".date('h:i a',strtotime($spa_f_s['close_time']))?></h5></td>
                                                                    <td><h5><?php echo date('h:i a',strtotime($spa_f_s['break_start_time']))."-".date('h:i a',strtotime($spa_f_s['break_close_time']))?></h5></td> -->
                                                                    <td><?php echo $spa_f_s['open_time']?> - <?php echo $spa_f_s['close_time']?></td>
                                                                    <td><?php echo $spa_f_s['break_start_time']?> - <?php echo $spa_f_s['break_close_time']?></td>
                                                                    <td>
                                                                    <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#description_model_<?php echo $spa_f_s['front_ofs_service_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                                    </td>
                                                                    <!-- modal forDescription -->
                                                                    <div class="modal fade" id="description_model_<?php echo $spa_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Description</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo $spa_f_s['description']?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/. modal for Description-->
                                                                    <!-- <td>
                                                                        <a href="" data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter1_<?php echo $spa_f_s['front_ofs_service_id']?>"> <img
                                                                                src="assets/images/card/2.png" alt=""
                                                                                style="height: 40px;width:50px;">
                                                                        </a>
                                                                    </td> -->
                                                                    <td>
                                                                        <div>
                                                                        <span class="badge light badge-warning"
                                                                        data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter1_<?php echo $spa_f_s['front_ofs_service_id']?>">View</span>
                                                                        </div>
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

                                                                                            // $admin_id = $this->session->userdata('admin_id');
                                                                                            $u_id= $this->session->userdata('u_id');
                                                                                            $where ='(u_id = "'.$u_id.'")';
                                                                                            $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                                                            
                                                                                            $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                                                                            $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                                                                            
                                                                                           $admin_id = $admin_details['hotel_id'];

                                                                                            $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                                                                                            $spa_images = $this->FrontofficeModel->get_spa_services_images($admin_id,$front_ofs_service_id);

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
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/. packages -->
                                                                    <!-- <td>
                                                                        <a href="" data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $spa_f_s['front_ofs_service_id']?>">
                                                                            <img src="assets/images/card/3.png" alt=""
                                                                                height="40px" width="90px">
                                                                        </a>
                                                                    </td> -->
                                                                    <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter_<?php echo $spa_f_s['front_ofs_service_id']?>"><i
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
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!--/. modal for terms and conditions -->

                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <a href="#"
                                                                                class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                                                                data-bs-toggle="modal" data-id="<?php echo $spa_f_s['front_ofs_service_id']?>"
                                                                                data-bs-target=".bd-example-modal-lg"><i
                                                                                    class="fa fa-pencil"></i></a>
                                                                                    <!-- <a href="#" id="delete_<?php echo  $spa_f_s['front_ofs_service_id'] ?>" class="btn btn-danger shadow btn-xs sharp me-1">
                                                                        <i class="fa fa-trash "></i> </a> -->
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                                        <!--dlt script start-->                                                               
                                            <script>
                                            
                                            document.getElementById('delete_<?php echo $spa_f_s['front_ofs_service_id'] ?>').onclick = function() {
                                            var id='<?php echo  $spa_f_s['front_ofs_service_id']?>';
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
                                                            url:base_url+"MainController/delete_sservices", 
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
                                        };
                                        </script>
                            
                                        <!--end dlt script-->  
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
                    if($list)
                    {
                        foreach($list as $spa_f_s)
                        {
                ?>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit schedule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <form action="<?php echo base_url('FrontofficeController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
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

                                                            // $admin_id = $this->session->userdata('front_id');
                                                            $u_id= $this->session->userdata('u_id');
                                                            $where ='(u_id = "'.$u_id.'")';
                                                            $admin_details = $this->MainModel->getData($tbl ='register', $where);
                                                            
                                                            $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
                                                            $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
                                                            $admin_id = $admin_details['hotel_id'];
                                                            $front_ofs_service_id = $spa_f_s['front_ofs_service_id'];

                                                            $spa_images = $this->FrontofficeModel->get_spa_services_images($admin_id,$front_ofs_service_id);

                                                            if($spa_images)
                                                            {
                                                                foreach($spa_images as $s_im)
                                                                {
                                                        ?>
                                                            <input type="hidden" name="front_ofs_spa_service_images_id[]" value="<?php echo $s_im['front_ofs_spa_service_images_id'] ?>" class="form-control" placeholder=""
                                                                    required="">
                                                            <div class="mb-3 col-md-4 form-group">
                                                                <label class="form-label">Spa Photo</label>
                                                                <input type="file" name="spa_photo[<?php echo $k?>]" class="dropify form-control" accept="image/jpeg, image/png," data-default-file="<?php echo $s_im['spa_photo']?>">
                                                                <span><?php echo basename($s_im['spa_photo']);?></span>
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
                                                            <!-- <button type="button" id="btnAdd12_<?php echo $spa_f_s['front_ofs_service_id']?>" class="btn btn-primary css_btn"> <i class="fa fa-plus"></i>Add Spa Packages</button> -->
                                                            </div>  
                                                        </div>
                                                        <div id="TextBoxContainer12_<?php echo $spa_f_s['front_ofs_service_id']?>" class="mb-1"></div>

                                                        <?php
                                                            $wh1 = '(front_ofs_service_id = "'.$spa_f_s['front_ofs_service_id'].'")';

                                                            $services_imgs = $this->MainModel->getAllData('front_ofs_services_images',$wh1);
                                                            
                                                            $j = 0;

                                                            if($services_imgs)
                                                            {
                                                                
                                                        ?>
                                                                <div class="mb-3 col-md-6 form-group">
                                                                    <label class="form-label">Pictures of Spa</label>
                                                                    <?php
                                                                        foreach($services_imgs as $se_i)
                                                                        {
                                                                    ?>
                                                                            <input type="hidden" name="front_ofs_service_image_id[]" value="<?php echo $se_i['front_ofs_service_image_id']?>">
                                                                            <input type="file" class="dropify form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," data-default-file="<?php echo $se_i['image']?>">
                                                                            <span><?php echo basename($se_i['image']);?></span>
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
                                            <div class="text-center">
                                                            <button type="submit" class="btn btn-primary css_btn">Save Changes
                                                            </button>
                                                            <button type="button" class="btn btn-light css_btn"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
    <!-- edit model end -->

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
                        <th>Sr.No.</th>
                        
                        <th>Picture</th>
                        <th>Staff Name</th>
                        <th>Contact No</th>
                        <th>Open Time</th>
                        <th>Break Time</th>
                        <th>Description</th>
                        <th>Terms</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="searchTable">
                <?php

                                    $i = 1; //+$this->uri->segment(2);
                                    if($list)
                                    {
                                        foreach($list as $p_f_s)
                                        {
                                            $wh = '(front_ofs_service_id = "'.$p_f_s['front_ofs_service_id'].'")';

                                            $services_img = $this->MainModel->getData('front_ofs_services_images',$wh);
                                    ?>
                                                    <tr>
                                                    <td><?php echo $i++?></td>


                                                       
                                                    <td>
                                                                    <!-- <div id="gallery" data-toggle="modal" data-target="#exampleModal"><img class="me-3 " src="" alt="" data-bs-toggle="modal" data-bs-target=".bd-example1-modal-md" data-slide-to="0" style="height:30px; width:60px;"> </div> -->
                                                                    <div id="gallery" data-toggle="modal"
                                                                        data-target="#exampleModal">
                                                                        <img class="me-3 " src="<?php echo $services_img['image']?>"
                                                                            alt="" data-bs-toggle="modal" 
                                                                            data-bs-target=".bd-example1-modal-md_<?php echo $p_f_s['front_ofs_service_id']?>"
                                                                            data-slide-to="0"
                                                                            style="height:30px; width:60px;">
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $p_f_s['staff_name']?></td>

                                                                <td><?php echo $p_f_s['contact_no']?></td>
                                                                    <td><?php echo date('h:i a',strtotime($p_f_s['open_time']))."-".date('h:i a',strtotime($p_f_s['close_time']))?></td>
                                                                    <td><?php echo date('h:i a',strtotime($p_f_s['break_start_time']))."-".date('h:i a',strtotime($p_f_s['break_close_time']))?></td>
                                                                    <td>
                                                           

                                                                    <div>
                                                                <span class="badge light badge-warning"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalCenter13_<?php echo $p_f_s['front_ofs_service_id']?>">View</span>
                                                            </div>

                                               </td>
                                                <!-- modal for terms and conditions -->
                                                <div class="modal fade" id="exampleModalCenter13_<?php echo  $p_f_s['front_ofs_service_id'] ?>" style="display: none;" aria-hidden="true">
                                                               <div class="modal-dialog modal-dialog-centered" role="document">
                                                                   <div class="modal-content">
                                                                       <div class="modal-header">
                                                                           <h5 class="modal-title">Description</h5>
                                                                           <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                           </button>
                                                                       </div>
                                                                       <div class="modal-body">
                                                                           <p><?php echo $p_f_s['description']?></p>
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
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-terms-modal-sm_<?php echo $p_f_s['front_ofs_service_id']?>"><i
                                                                        class="fa fa-eye"></i></a>
                                                                                                                         
                                                        </td>
                                                       
                                                        <td>
                                                            <div class="">
                                                                <a href="#"
                                                                    class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                                                    data-bs-toggle="modal" data-id="<?php echo $p_f_s['front_ofs_service_id']?>"
                                                                    data-bs-target=".bd-example-modal-lg_<?php echo $p_f_s['front_ofs_service_id']?>"><i
                                                                        class="fa fa-pencil"></i></a>
                                                                <!-- <a href="#" id="delete"
                                                                    class="btn btn-danger shadow btn-xs sharp"><i
                                                                        class="fa fa-trash"></i></a> -->
                                                                      <!--  <a href="#" id="delete_<?php echo $p_f_s['front_ofs_service_id']?>"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></a> -->
                                                            </div>
                                                            <div class="modal fade bd-example-modal-lg_<?php echo $p_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit schedule</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <form action="<?php echo base_url('FrontofficeController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
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
                                                                <div class="mb-3 col-md-6 form-group">
                                                                    <label class="form-label">Pictures of Pool</label>
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
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                                                        </td>

                                                    </tr>
                                          <!-- modal for terms  -->
                                        <div class="modal fade bd-terms-modal-sm_<?php echo $p_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Terms & Conditions</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg-12">
                                                        <span><?php echo $p_f_s['t_nd_c']?></span>
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
    <?php } elseif($sub_icon_id == 4)
     { ?>
     <?php //print_r($sun_list);exit;?>
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

                                $services_img = $this->FrontofficeModel->getData('front_ofs_services_images',$wh);
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
                    <form action="<?php echo base_url('FrontofficeController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
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
            <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                    <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                 <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                 <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                 <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                 <form action="<?php echo base_url('FrontofficeController/add_shuttle_service_staff_avaibility')?>" method="post">
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
                    </tr>
                </thead>
                <tbody id="searchTable">

                <?php

                                                        $i = 1 ; //+ $this->uri->segment(2);
                                                        if($list)
                                                        {
                                                            foreach($list as $baby_f_s)
                                                            {
                                                                $wh = '(front_ofs_service_id = "'.$baby_f_s['front_ofs_service_id'].'")';

                                                                $services_img = $this->MainModel->getData('front_ofs_services_images',$wh);
                                                    ?>
                                                                <tr>
                                                                    <td><?php echo $i++?></td>
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
                                                                    <td><?php echo $baby_f_s['staff_name']?></td>
                                                                    <td><?php echo $baby_f_s['contact_no']?></td>
                                                                    <td><?php echo $baby_f_s['open_time']?> - <?php echo $baby_f_s['close_time']?></td>
                                                                    <td><?php echo $baby_f_s['break_start_time']?> - <?php echo $baby_f_s['break_close_time']?></td>
                                                                    <!-- <td><?php echo date('h:i a',strtotime($baby_f_s['open_time']))."-".date('h:i a',strtotime($baby_f_s['close_time']))?></td> -->
                                                                    <!-- <td><?php echo date('h:i a',strtotime($baby_f_s['break_start_time']))."-".date('h:i a',strtotime($baby_f_s['break_close_time']))?></td> -->
                                                                    <!-- <td>
                                                                        <button class="btn btn-secondary_<?php echo $baby_f_s['front_ofs_service_id']?> shadow btn-xs sharp me-1"><i
                                                                            class="fa fa-eye"></i></button>
                                                                    </td> -->
                                                                    <td>
                                                                        <a href="#"
                                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target=".bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id']?>"><i
                                                                                class="fa fa-eye"></i></a>

                                                                    </td>
                                                                 
                                                                    <td>
                                                                        <div>
                                                                        <span class="badge light badge-warning"
                                                                        data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $baby_f_s['front_ofs_service_id']?>">View</span>
                                                                        </div>
                                                                    </td>
                                                                    <!-- modal for terms and conditions -->
                                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $baby_f_s['front_ofs_service_id']?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Terms And Conditions</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo $baby_f_s['t_nd_c']?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <td>
                                                                        <div class="d-flex">
                                                                            <a href="#"
                                                                                class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data"
                                                                                data-bs-toggle="modal" data-id="<?php echo $baby_f_s['front_ofs_service_id']?>"
                                                                                data-bs-target=".bd-example-modal-lg_<?php echo $baby_f_s['front_ofs_service_id']?>"><i
                                                                                    class="fa fa-pencil"></i></a>
                                                                                   <!-- <a href="#" id="delete_<?php echo $baby_f_s['front_ofs_service_id']?>"
                                                                        class="btn btn-danger shadow btn-xs sharp"><i
                                                                            class="fa fa-trash"></i></a> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <!-- modal for terms  -->
                                                            <div class="modal fade bd-terms-modal-sm_<?php echo $baby_f_s['front_ofs_service_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Description</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="col-lg-12">
                                                                                <span><?php echo $baby_f_s['description']?></span>
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
                                    <form action="<?php echo base_url('FrontofficeController/edit_front_ofs_services')?>" method="post" enctype="multipart/form-data">
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
            <?php
                    }
                }
            ?>
    <!-- edit model end -->

    
    <?php }   elseif($sub_icon_id == 6) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Car Wash Request</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="d-flex  align-items-center flex-wrap">
                <div class="col-md-5 d-flex">
                        <input type="date" class="form-control">                  
                    <div class="input-group">
                    <select id="inputState" class="default-select form-control wide"
                            >
                            <option selected="true" disabled="disabled">Select
                            Vehical Type...</option>
                            <option>Two Wheeler</option>
                            <option>Four Wheeler</option>
                            <!-- <option>103</option> -->
                        </select>
                        <button name="search" type="submit"
                            class="btn btn-info btn-sm"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-3 d-flex ms-4">
                                    
                    <div class="input-group">
                    <select id="inputState" class="default-select form-control wide">
                            <option selected="true" disabled="disabled">
                            Select Option...</option>
                            <option>Car Wash Request</option>
                            <option>Accepted Car Wash Request</option>
                            <option>Washing Charges</option>
                            <!-- <option>103</option> -->
                        </select>
                        
                    </div>
                </div>
                

            </div>

                <div class="table-scrollable">
                    <table id="example1" class="display full-width">
                    <thead>
           
                        <tr>
                            <th>Sr.No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email </th>
                            <th>Request Date</th>
                            <th>Request Time</th>

                            <th>vehicle type</th>
                            <th>vehicle No</th>
                            
                            
                            <th>Photo </th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
           
        </thead>
        <tbody id="searchTable">
        <?php
                                                    
                                                        $j = 1; // + $this->uri->segment(2);
                                                        if($vehicle_wash_request)
                                                        {
                                                            foreach($vehicle_wash_request as $v_w_r)
                                                            {
                                                             

                                                                if($v_w_r['vehicle_img'])
                                                                {
                                                                    $vehicle_img = $v_w_r['vehicle_img'];
                                                                }
                                                                else
                                                                {
                                                                    $vehicle_img = base_url().'documents/blankpic.jpg';
                                                                }
                                                         
                                                                $wh = '(u_id = "'.$v_w_r['u_id'].'")';

                                                                $user_data = $this->MainModel->getData('register',$wh);

                                                                if($user_data)
                                                                {


                                                    ?>
                                                    
                                                                    <tr>
                                                                        <td><strong><?php echo $j++?></strong></td>
                                                                        <td><?php echo $user_data['full_name'] ?></td>
                                                                        <td><?php echo $user_data['mobile_no'] ?></td>
                                                                        <td><?php echo $user_data['email_id'] ?></td>

                                                                        <td><?php echo $v_w_r['select_date'] ?></td>
                                                                        <td><?php echo date('h:i a',strtotime($v_w_r['select_time'])) ?></td>
                                                                        <td><?php echo $v_w_r['vehicle_name'] ?></td>
                                                                        <td><?php echo $v_w_r['vehicle_no'] ?></td>
                                                                        <td>
                                                                            <div id="lightgallery"
                                                                                class="room-list-bx  align-items-center">
                                                                                <a href="<?php echo $vehicle_img ?>"
                                                                                    data-exthumbimage="<?php echo $vehicle_img  ?>"
                                                                                    data-src="<?php echo $vehicle_img?>"
                                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                    <img class="me-3 "
                                                                                        src="<?php echo $vehicle_img ?>" alt=""
                                                                                        style="width:50px;">
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <!-- <button class="exampleModalCenter_<?php echo $v_w_r['vehicle_wash_request_id'] ?> shadow btn-xs sharp"
                                                                                data-toggle="popover"><i
                                                                                    class="fa fa-eye"></i></button> -->
                                                                                    <a href="#"
                                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exampleModalCenter_<?php echo $v_w_r['vehicle_wash_request_id']?>"><i
                                                                                        class="fa fa-eye"></i></a>
                                                                                  

                                                                        </td>
                                                                         <!-- modal for terms and conditions -->
                                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $v_w_r['vehicle_wash_request_id'] ?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Note</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo $v_w_r['note']?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                        <td>
                                                                            <!-- <a href="#">
                                                                                <div class="badge badge-warning"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#exampleModalCenter">
                                                                                    Assign</div>
                                                                            </a> -->

                                                                            <a href="<?php echo base_url('MainController/request_accept/'.$v_w_r['vehicle_wash_request_id'])?>" class="submit"><span class="badge badge-success">Accept</span> </a>
                                                                            <a href="<?php echo base_url('MainController/request_reject/'.$v_w_r['vehicle_wash_request_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
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
    </div>
    <?php }  elseif($sub_icon_id == 7) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>List of Luggage</header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">

            <div class="d-flex justify-content-between  align-items-center flex-wrap">
                
                <div class="col-md-3 d-flex ms-4">
                                    
                    <div class="input-group">
                    <select id="categoryDropdown" class="default-select form-control wide">
                            <option selected="true" disabled="disabled">
                            Select Option...</option>
                            <option value = "0">Luggage Request</option>
                            <option value = "1">Luggage Accepted Request</option>
                            <option value = "2">Luggage Charges</option>
                            <!-- <option>103</option> -->
                        </select>
                        
                    </div>
                </div>
                <div class="col-md-3 d-flex ms-4 d-flex justify-content-end">
                    <button style="float:right" type="button" class="btn btn-primary css_btn"
                    data-bs-toggle="modal" data-bs-target="#exampleModalCenter1">Luggage
                    Charges</button>
                </div>

                <div class="modal fade add_facility_modal" id="exampleModalCenter1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Luggage Charges</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                        <form id="luggage_add" method="post">
                                       
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
                                       
                                        <div class="modal-footer text-center">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                       
                                    </form>
                        </div>
                    
                    </div>
                </div>
            </div>

                
                

            </div>
            <div class="accepted_orders_div" style="display:none">
            <br>
<table id="acceptedOrder_tb"
                                                    class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list card-table display  shadow-hover table-responsive-lg  no-footer">
                                                    <thead>
                                                        <tr>
                                                        <th><strong>Sr.no.</strong></th>
                                                            <th><strong>Guest Name</strong></th>
                                                            <th><strong>Mobile number</strong></th>
                                                            <th><strong>Date</strong></th>
                                                            <th><strong>Time</strong></th>
                                                            <th><strong>Type of Luggage</strong></th>
                                                            <!-- <th><strong>Luggage Photo</strong></th> -->
                                                            <th><strong>Qty</strong></th>
                                                            <th><strong>Note</strong></th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody id="searchTable">
                                                    <?php
                                                    
                                                    $j = 1 ;
                                                    if($luggage_request)
                                                    {
                                                        foreach($luggage_request as $lug_r)
                                                        {
                                                             $wh1 = '(luggage_request_id  = "'.$lug_r['luggage_request_id'].'")';

                                                                $luggage_data = $this->MainModel->getData('luggage_req_details',$wh1);

                                                                $wh2 = '(luggage_charge_id  = "'.$luggage_data['luggage_type_id'].'")';

                                                                $luggge_type = $this->MainModel->getData('luggage_charges',$wh2);
                                                               
                                                                
                                                            $wh = '(u_id = "'.$lug_r['u_id'].'")';

                                                            $user_data = $this->MainModel->getData('register',$wh);

                                                            if($user_data)
                                                            {
                                                               

                                                ?>
                                                        <tr>
                                                        <td> <strong> <?php echo $j++ ?> </strong></td>
                                                        <td><?php echo $user_data['full_name'] ?></td>
                                                        <td><?php echo $user_data['mobile_no'] ?></td>
                                                        <td><?php echo $lug_r['select_date'] ?></td>
                                                        <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                                                          <td><h5><?php echo $luggge_type['luggage_type'] ?> </h5></td>
                                                        <!-- <td>
                                                                            <div class="lightgallery"
                                                                                class="room-list-bx  align-items-center">
                                                                                <a href="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-exthumbimage="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-src="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                    <img class="me-3 "
                                                                                        src="<?php echo $lug_r['luggage_img'] ?>" alt=""
                                                                                        style="width:50px;">
                                                                                </a>
                                                                            </div>
                                                                        </td> -->
                                                        <td><?php echo $luggage_data['quantity'] ?></td>
                                                        <td>
                                                                <a href="#"
                                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $lug_r['luggage_request_id']  ?>"><i
                                                                                class="fa fa-eye"></i></a>
                                                            </td>

                                                             <!-- modal for terms and conditions -->
                                                             <div class="modal fade" id="exampleModalCenter_<?php echo $lug_r['luggage_request_id']  ?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Description</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo$lug_r['note']  ?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                

                                                      
                                                        </tr>
                                                        <?php
                                                                }
                                                            }
                                                        }
else{?>
        <tr>
             <td colspan="9"
                 style="color:red;text-align:center;font-size:14px"
                    class="text-center">Data Not Available</td>
       </tr>
  <?php }
                                                    ?>
                                                    </tbody>
                                                </table>
</div>
<div class="completed_orders_div" style="display:none">
    <!-- Amisha -->
</div>
<div class ="new_orders_div">
                <div class="table-scrollable">
                <table id="example1" class="display full-width">
                <thead>
                <tr>
                    <th><strong>Sr.no.</strong></th>
                    <th><strong>Guest Name</strong></th>
                    <th><strong>Mobile number</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>Time</strong></th>
                    <th><strong>Type of Luggage</strong></th>
                    <!-- <th><strong>Luggage Photo</strong></th> -->
                    <th><strong>Qty</strong></th>
                    <th><strong>Note</strong></th>
                    <th><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody id="append_data2">
            <?php
                //  print_r($luggage_request);exit;                                   
                                                    $j = 1; // +$this->uri->segment(2);
                                                    if($luggage_request)
                                                    {
                                                        foreach($luggage_request as $lug_r)
                                                        {
                                                             $wh1 = '(luggage_request_id  = "'.$lug_r['luggage_request_id'].'")';
                                                            //  print_r($wh1);die;
                                                                $luggage_data = $this->MainModel->getData('luggage_req_details',$wh1);
                                                               
                                                                    if(!empty($luggage_data['luggage_type_id']))
                                                                    {
                                                                        $wh2 = '(luggage_charge_id  = "'.$luggage_data['luggage_type_id'].'")';
                                                                    }
                                                                    else{
                                                                        $wh2 = '(luggage_charge_id  = 0)';
                                                                    }
                                                                   
                                                            //    print_r($wh2);
                                                               

                                                                $luggge_type = $this->MainModel->getData('luggage_charges',$wh2);
                                                               
                                                                
                                                            $wh = '(u_id = "'.$lug_r['u_id'].'")';

                                                            $user_data = $this->MainModel->getData('register',$wh);

                                                            if($user_data)
                                                            {
                                                               

                                                ?>
                                                        <tr>
                                                        <td> <strong> <?php echo $j++ ?> </strong></td>
                                                        <td><?php echo $user_data['full_name'] ?></td>
                                                        <td><?php echo $user_data['mobile_no'] ?></td>
                                                        <td><?php echo $lug_r['select_date'] ?></td>
                                                        <td><?php echo date('h:i a',strtotime($lug_r['select_time'])) ?></td>
                                                          <td><h5><?php echo $luggge_type['luggage_type']??'' ?> </h5></td>
                                                        <!-- <td>
                                                                            <div class="lightgallery"
                                                                                class="room-list-bx  align-items-center">
                                                                                <a href="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-exthumbimage="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    data-src="<?php echo $lug_r['luggage_img'] ?>"
                                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                                    <img class="me-3 "
                                                                                        src="<?php echo $lug_r['luggage_img'] ?>" alt=""
                                                                                        style="width:50px;">
                                                                                </a>
                                                                            </div>
                                                                        </td> -->
                                                        <td><?php echo $luggage_data['quantity']??'' ?></td>
                                                        <td>
                                                                <a href="#"
                                                                            class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModalCenter_<?php echo $lug_r['luggage_request_id']  ?>"><i
                                                                                class="fa fa-eye"></i></a>
                                                            </td>

                                                             <!-- modal for terms and conditions -->
                                                             <div class="modal fade" id="exampleModalCenter_<?php echo $lug_r['luggage_request_id']  ?>" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Description</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p><?php echo$lug_r['note']  ?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                

                                                        <td>
                                                            <a href="<?php echo base_url('FrontofficeController/accept_cloakroom_service_request/'.$lug_r['luggage_request_id'])?>" class="submit"><span class="badge badge-success">Accept</span></a>
                                                            <a href="<?php echo base_url('FrontofficeController/reject_cloakroom_service_request/'.$lug_r['luggage_request_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
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
    </div>
                                                    </div>
    <?php }   elseif($sub_icon_id == 8) { ?>
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
	  <script src="<?php echo base_url('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>
    <div class="col-md-12">
        <div class="card card-topline-aqua">
            <div class="card-head">
                <header>Cab Service </header>
                <div class="tools">
                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                </div>
            </div>
            <div class="card-body ">
            <div class="d-flex justify-content-between  align-items-center flex-wrap">
                
                <div class="col-md-3 d-flex ms-4">
                                    
                    <div class="input-group">
                    <select class="default-select form-control wide">
                            <option selected="true" disabled="disabled">
                            Select Option...</option>
                            <option value="0">Cab Service Request</option>
                            <option value="1">Accepted Cab Service Request</option>
                            
                        </select>
                        
                    </div>
                </div>
               
                
                
               
            </div>

                <div class="table-scrollable">
                <table id="example1" class="display full-width">
                <thead>
                    <tr>
                        <th>Sr.no.</th>
                        <th>Passengers</th>
                        <th>Request Date</th>
                        <th>Guest Name</th>
                        <th>Phone</th>
                        <th>Vehicle Type</th>
                        <th>Destination</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="searchTable">
                <?php

                                                $i = 1; //+$this->uri->segment(2);
                                                if($list)
                                                {
                                                    foreach($list as $c_s)
                                                    {
                                                        $user_data = $this->MainModel->get_user_data($c_s['u_id']);
                                                        
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
                                                            <?php echo $c_s['request_date'] ?> /<sub>
                                                                <?php echo date('h:i a',strtotime($c_s['request_time'])) ?></sub>
                                                        </td>
                                                        <td><?php echo $full_name ?></td>
                                                        <td><?php echo $mobile_no ?></td>
                                                        <td><?php echo $c_s['request_vehicle_type'] ?></td>
                                                        <td><?php echo $c_s['destination_name'] ?></td>
                                                        <td>
                                                        <a href="#"
                                                                                    class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target=".bd-terms-modal-sm_<?php echo $c_s['cab_service_request_id'] ?>"><i
                                                                                        class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <a href="#">
                                                                <div class="badge badge-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#assign_<?php echo $c_s['cab_service_request_id'] ?>">
                                                                    Assign</div>
                                                            </a>
                                                        </td>
                                                        <!-- modal for assign  -->
                                                        <div class="modal fade example"
                                                            id="assign_<?php echo $c_s['cab_service_request_id'] ?>"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Cab Request </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="basic-form">
                                                                            <form
                                                                                action="<?php echo base_url('MainController/change_cab_service_request')?>"
                                                                                method="post">
                                                                                <input type="hidden"
                                                                                    name="cab_service_request_id"
                                                                                    value="<?php echo $c_s['cab_service_request_id'] ?>">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label">Change
                                                                                            Order Status</label>

                                                                                        <select id="typeop"
                                                                                            name="request_status"
                                                                                            onchange="show_typewise()"
                                                                                            class="default-select form-control wide">

                                                                                            <option selected="">
                                                                                                Choose...</option>
                                                                                            <option value="1">Accept
                                                                                            </option>
                                                                                            <option value="2">Reject
                                                                                            </option>


                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6"
                                                                                        style="display:none;"
                                                                                        id="type1">

                                                                                        <div class="row">
                                                                                            <div class="mb-3 col-md-12">
                                                                                                <label
                                                                                                    class="form-label">Driver
                                                                                                    Name</label>
                                                                                                <input type="text"
                                                                                                    name="driver_name"
                                                                                                    class="form-control">
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="mb-3 col-md-12">
                                                                                                    <label
                                                                                                        class="form-label">Phone</label>
                                                                                                    <input type="text"
                                                                                                        maxlength="10"
                                                                                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                                                        name="driver_contact_no"
                                                                                                        class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="mb-3 col-md-12">
                                                                                                    <label
                                                                                                        class="form-label">Vehical
                                                                                                        Type</label>
                                                                                                    <input type="text"
                                                                                                        name="assign_vehicle_type"
                                                                                                        class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="mb-3 col-md-12">
                                                                                                    <label
                                                                                                        class="form-label">Vehical
                                                                                                        No</label>
                                                                                                    <input type="text"
                                                                                                        name="vehicle_no"
                                                                                                        class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary css_btn">Submit</button>

                                                                                        <button type="button"
                                                                                            class="btn btn-light css_btn"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end assign modal  -->
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
        </div>
    </div>
    <?php } ?>


    <script>
          $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
        $('#completedOrder_tb').DataTable();
        var selectedOrderserviceurl = '';
        var base_url = '<?php echo base_url();?>';
    $('#categoryDropdown').change(function () {
        var selected_orderservice = $(this).val();
        // alert(selected_orderservice);
        if(selected_orderservice == 0)
        {
            // selectedOrderserviceurl = 'todayfrontArrival';
            $('.page_header_title').text('All New Orders ');
            $('.new_orders_div').css('display','block');
            $('.accepted_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 1)
        {
            // selectedOrderserviceurl = 'upcomingfrontaArrival';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','block');
            $('.new_orders_div').css('display','none');
            $('.completed_orders_div').css('display','none');
        }
        if(selected_orderservice == 2)
        {
            // selectedOrderserviceurl = 'upcomingfrontaArrival';
            $('.page_header_title').text('All Accepted Orders ');
            $('.accepted_orders_div').css('display','none');
            $('.new_orders_div').css('display','none');
            $('.completed_orders_div').css('display','block');
        }
      
       
    });
        </script>
    <script>
            <?php
                
                if($list)
                {
                    foreach($list as $spa_f_s)
                    { 
            ?>
                        $(function() {
            
                        $("#btnAdd12_<?php echo $spa_f_s['front_ofs_service_id']?>").bind("click", function() {
                            var div = $("<div class=''/>");
                            div.html(GetDynamicTextBox(""));
                            $("#TextBoxContainer12_<?php echo $spa_f_s['front_ofs_service_id']?>").append(div);
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
                    '<i class="fa fa-times"></i></button></div></div>'

            }
           
            <?php
                    }
                }   
            ?>
        </script>
        <!-- /. for edit -->
        <script>
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

        <!-- <?php include 'common_file/footer.php'?> -->

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
        
        $(document).on('submit', '#luggage_add', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('FrontofficeController/add_luggage_charges') ?>',
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
           
       
      
        var base_url = '<?php echo base_url();?>';
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