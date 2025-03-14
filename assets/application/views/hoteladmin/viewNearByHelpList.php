<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Near By Help</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>
<li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
class="fa fa-angle-right"></i>
</li>
<li class="active">Near By Help</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
<header>List of Near By Help Place</header>
<div class="tools">
<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
</div>
</div>
<div class="card-body ">

<div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="input-group" style="margin-left:4px;">

                                                                <select id="inputState"
                                                                    class="default-select form-control wide"
                                                                   >
                                                                    <option selected="">Select Help Place...</option>
                                                                    <option>General Store</option>
                                                                    <option>Medical</option>
                                                                    <option>Hospital</option>
                                                                    <option value="">Police Station</option>
                                                                </select>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Place Name">
                                                                <button class="btn btn-warning  btn-sm "><i
                                                                        class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Places</button>

                    </div><br><br>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Places</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/add_hotel_near_by_help')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                <label class="form-label">Select Near By Help Place</label>
                                                            <div class="col-md-2">
                                                                <div class="text-center">
                                                                </div>
                                                                <div class="custom-control custom-radio image-checkbox">
                                                                  
                                                                   <input type="radio" name="places_name" value="General Store" id="ck2a" class="radio_shown">
                                                                    <label class="custom-control-label" for="ck2a">
                                                                       
                                                                        <img src="<?php echo base_url();?>assets/dist/images/store.png" alt="#"
                                                                            class="img-fluid"
                                                                            style="height:160px;  width:220px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="text-center">
                                                                </div>
                                                                <div class="custom-control custom-radio image-checkbox">
                                                                   <input type="radio" name="places_name" value="Medical" id="ck2b" class="radio_shown">
                                                                    <label class="custom-control-label" for="ck2b">
                                                                       
                                                                        <img src="<?php echo base_url();?>assets/dist/images/medical.png" alt="#"
                                                                            class="img-fluid"
                                                                            style="height:160px; width:220px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="text-center">
                                                                </div>
                                                                <div class="custom-control custom-radio image-checkbox">
                                                                   <input type="radio" name="places_name" value="Hospital" id="ck2c" class="radio_shown">
                                                                    <label class="custom-control-label" for="ck2c">
                                                                       
                                                                        <img src="<?php echo base_url();?>assets/dist/images/hospital.png" alt="#"
                                                                            class="img-fluid"
                                                                            style="height:160px; width:220px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="text-center">
                                                                </div>
                                                                <div class="custom-control custom-radio image-checkbox">
                                                                   <input type="radio" name="places_name" value="Police" id="ck2d" class="radio_shown">
                                                                    <label class="custom-control-label" for="ck2d">
                                                                       
                                                                        <img src="<?php echo base_url();?>assets/dist/images/police.png" alt="#"
                                                                            class="img-fluid"
                                                                            style="height:160px; width:220px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                          
                                                          
                                                          
                                                          
                                                           <div class="col-md-2">
                                                                <div class="text-center">
                                                                </div>
                                                                <div class="custom-control custom-radio image-checkbox">
                                                                   <input type="radio" name="places_name" value="Medical" id="ck2e" class="radio_shown">
                                                                    <label class="custom-control-label" for="ck2e">
                                                                       
                                                                        <img src="<?php echo base_url();?>assets/dist/images/car_rents.png" alt="#"
                                                                            class="img-fluid"
                                                                            style="height:160px; width:220px;">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                          
                                                       </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Name"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Contact Number</label>
                                                                <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" class="form-control" placeholder="Contact Number"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-3 form-group">
                                                                <label class="form-label">Open Time</label>
                                                                <input type="time" name="open_time" class="form-control" placeholder="Open Time"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-3 form-group">
                                                                <label class="form-label">Close Time</label>
                                                                <input type="time" name="close_time" class="form-control" placeholder="Close Time"
                                                                    required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Upload Photo</label>
                                                                <input type="file" class="form-control" name="image[]"
                                                                    multiple="" required="">
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Address</label>
                                                                <textarea class="summernote" name="place_address" rows="4" id="comment"
                                                                    required=""></textarea>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="summernote" name="description" rows="4" id="comment"
                                                                    required=""></textarea>
                                                            </div>

                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-info">Add
                                                                    Place</button>
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                </form>
                            </div>
                        </div>
                    </div>        
                    </div>        
                    </div>        
            </div>

<div class="table-scrollable">
<table id="example1" class="display full-width">
<thead>
<tr>
 <th><strong>Sr.no.</strong></th>
<th><strong> Help Place</strong></th>
<th><strong> Name</strong></th>
<th><strong>Contact</strong></th>
<th><strong>Photo</strong></th>
<th><strong>Address</strong></th>
<th><strong>Open time</strong></th>
<th><strong>Close time</strong></th>
<th><strong>Description</strong></th>
<th><strong>Action</strong></th>
</tr>
</thead>
<tbody>
 <?php

            $i = 1;

            if($list)
            {
                foreach($list as $n_h)
                {
                    $wh = '(hotel_near_by_help_id = "'.$n_h['hotel_near_by_help_id'].'")';

                    $hotel_near_by_help_image = $this->HotelAdminModel->getData('hotel_near_by_help_images',$wh);
                    if(!empty($hotel_near_by_help_image))
                    {
                        $hotel_near_img = $hotel_near_by_help_image['images'];
                    }
                    else
                    {
                        $hotel_near_img = '';
                    }

        ?>
        
            <tr data-toggle="collapse" data-target="#demo1"
                class="accordion-toggle">
                <td><strong><?php echo $i++; ?></strong></td>
                <td><?php echo $n_h['places_name'] ?></td>
                <td><?php echo $n_h['name'] ?></td>
                <td><?php echo $n_h['contact_no'] ?></td>
                <td>
                    <div class="lightgallery"
                        class="room-list-bx d-flex align-items-center">
                        <a href="<?php echo $hotel_near_img; ?>"
                            data-exthumbimage="<?php echo $hotel_near_img ?>"
                            data-src="<?php echo $hotel_near_img ?>"
                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                            <img class=""
                                src="<?php echo $hotel_near_img ?>" alt=""
                                style="width:40px;height:40px;">
                        </a>
                    </div>
                </td>
                <td> <span><?php echo $n_h['place_address'] ?></span></td>
                <td><?php echo date('h:i a',strtotime($n_h['open_time'])) ?></td>
                <td><?php echo date('h:i a',strtotime($n_h['close_time'])) ?></td>
               
                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $n_h['hotel_near_by_help_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
               
                <td>
                    <div class="d-flex">
                        <a href="#"
                            class="btn btn-warning shadow btn-xs sharp me-1"
                            data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-xl_<?php echo $n_h['hotel_near_by_help_id'] ?>"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" onclick="delete_data(<?php echo $n_h['hotel_near_by_help_id'] ?>)"
                            class="btn btn-danger shadow btn-xs sharp"><i
                                class="fa fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-terms-modal-sm_<?php echo  $n_h['hotel_near_by_help_id']?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $n_h['description'] ?></span>
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
<?php

if($list)
{
    foreach($list as $n_h)
    {
?>
<div class="modal fade bd-example-modal-xl_<?php echo $n_h['hotel_near_by_help_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xl slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Places</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <form action="<?php echo base_url('HoteladminController/edit_hotel_near_by_help')?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="hotel_near_by_help_id" value="<?php echo $n_h['hotel_near_by_help_id'] ?>">
            <div class="modal-body">
                                                                    <div class="col-md-12 " >

                    <div class="row">
                        <label class="form-label">Select Near By Help Place</label>
                        <div class="col-md-2">
                            <div class="text-center">
                            </div>
                            <div class="custom-control custom-radio image-checkbox">
                                <input type="radio" name="places_name" id="ck2aa" class="radio_shown" value="General Store" <?php if($n_h['places_name'] == "General Store"){echo "checked";}?>>
                                <label class="custom-control-label" for="ck2aa">
                                  
                                    <img src='<?php echo base_url();?>assets/dist/images/store.png' alt="#"
                                        class="img-fluid"
                                        style="height:160px;  width:220px;">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                            </div>
                            <div class="custom-control custom-radio image-checkbox">
                               <input type="radio" name="places_name" id="ck2bb" class="radio_shown" value="Medical" <?php if($n_h['places_name'] == "Medical"){echo "checked";}?>>
                                <label class="custom-control-label" for="ck2bb">
                                   
                                    <img src="<?php echo base_url();?>assets/dist/images/medical.png" alt="#"
                                        class="img-fluid"
                                        style="height:160px; width:220px;">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                            </div>
                            <div class="custom-control custom-radio image-checkbox">
                                <input type="radio" name="places_name" id="ck2cc" class="radio_shown" value="Hospital" <?php if($n_h['places_name'] == "Hospital"){echo "checked";}?>>
                                <label class="custom-control-label" for="ck2cc">
                                  
                                    <img src="<?php echo base_url();?>assets/dist/images/hospital.png" alt="#"
                                        class="img-fluid"
                                        style="height:160px; width:220px;">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                            </div>
                            <div class="custom-control custom-radio image-checkbox">
                                <input type="radio" name="places_name" id="ck2dd" class="radio_shown"  value="Police" <?php if($n_h['places_name'] == "Police"){echo "checked";}?>>
                                <label class="custom-control-label" for="ck2dd">
                                  
                                    <img src="<?php echo base_url();?>assets/dist/images/police.png" alt="#"
                                        class="img-fluid"
                                        style="height:160px; width:220px;">
                                </label>
                            </div>
                        </div>
                      
                      
                       <div class="col-md-2">
                            <div class="text-center">
                            </div>
                            <div class="custom-control custom-radio image-checkbox">
                                <input type="radio" name="places_name" id="ck2dd" class="radio_shown"  value="Police" <?php if($n_h['places_name'] == "Police"){echo "checked";}?>>
                                <label class="custom-control-label" for="ck2dd">
                                  
                                    <img src="<?php echo base_url();?>assets/dist/images/car_rents.png" alt="#"
                                        class="img-fluid"
                                        style="height:160px; width:220px;">
                                </label>
                            </div>
                        </div>
                      
                                                                
                      
                      
                    </div>
                    <div class="row mt-3">
                        <div class="mb-3 col-md-3 form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="<?php echo $n_h['name'] ?>" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                            <label class="form-label">Contact Number</label>
                            <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" value="<?php echo $n_h['contact_no'] ?>" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                            <label class="form-label">Open Time</label>
                            <input type="time" name="open_time" value="<?php echo $n_h['open_time'] ?>" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-3 form-group">
                            <label class="form-label">Close Time</label>
                            <input type="time" name="close_time" value="<?php echo $n_h['close_time'] ?>" class="form-control" placeholder="">
                        </div>
                        <div class="mb-3 col-md-12 form-group">
                            <label class="form-label">Upload Photo</label>
                          <div class="row">
                            
                         
                          
                            <!-- <input type="file" class="form-control" name="file1" multiple=""> -->
                            <?php

                                $j = 0;

                                $wh = '(hotel_near_by_help_id = "'.$n_h['hotel_near_by_help_id'].'")';

                                $hotel_near_by_help_images = $this->MainModel->getAllData('hotel_near_by_help_images',$wh);

                                if($hotel_near_by_help_images)
                                {
                            ?>
                                <!--<label class="form-label">Upload Photos</label>-->
                            <?php
                                    foreach($hotel_near_by_help_images as $h_img)
                                    {
                            ?>
                                    <input type="hidden" name="id[]" value="<?php echo $h_img['id']?>">
                          
                          <div class="col-md-3">
                            
                           
                            
                                    <input name="image[<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" data-default-file="<?php echo $h_img['images']?>"/>
                             </div>
                            <?php
                                        $j++;
                                    }
                                }
                            ?>
                        </div>
</div>
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label">Address</label>
                            <textarea class="summernote" name="place_address" rows="4" id="comment"
                                required=""><?php echo $n_h['place_address'] ?></textarea>
                        </div>
                        <div class="mb-3 col-md-6 form-group">
                            <label class="form-label">Description</label>
                            <textarea class="summernote" name="description" rows="4" id="comment"
                                required=""><?php echo $n_h['description'] ?></textarea>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Update Place</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
                                url     : base_url + "HoteladminController/delete_hotel_near_by_help",
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