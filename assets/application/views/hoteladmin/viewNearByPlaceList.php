<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Near Places</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>
<li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
class="fa fa-angle-right"></i>
</li>
<li class="active">Near Places</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
<header>List of Near Places</header>
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
                                    <select id="inputState" class="default-select form-control wide ">
                                      <option selected="">Must See Place...</option>
                                      <option>Shopping</option>
                                      <option>Mouments</option>
                                      <option>Fun</option>
                                    </select>
                                    <input type="text" class="form-control" placeholder="Place Name">
                                    <button class="btn btn-warning  btn-sm ">
                                      <i class="fa fa-search"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                <div>
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
                                <form action="<?php echo base_url('HoteladminController/add_hotel_near_by_places')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Must see places</label>
                                  <select name="places" id="inputState" class="default-select form-control wide" required>
                                    <option value data-isdefault="true">Choose...</option>
                                    <option value="Monuments">Monuments</option>
                                    <option value="Shopping">Shopping</option>
                                    <option value="Fun">Fun </option>
                                  </select>
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Place Name</label>
                                  <input type="text" name="places_name" class="form-control" placeholder="Place Name" required="">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Contact Number</label>
                                  <input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" class="form-control" placeholder="Contact Number" required="">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Upload Photo</label>
                                  <input type="file" class="form-control" name="image[]" multiple="" required="">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Address</label>
                                  <textarea class="summernote" name="place_address" rows="4" id="comment" required=""></textarea>
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Description</label>
                                  <textarea class="summernote" name="description" rows="4" id="comment" required=""></textarea>
                                </div>
                                <div class="mb-3 col-md-3 form-group">
                                  <label class="form-label">Latitude</label>
                                  <input type="text" name="latitute" class="form-control" placeholder="Latitude" required="">
                                </div>
                                <div class="mb-3 col-md-3 form-group">
                                  <label class="form-label">Longtitude</label>
                                  <input type="text" name="longitude" class="form-control" placeholder="Longtitude" required="">
                                </div>
                                <div class="mb-3 col-md-6 form-group">
                                  <label class="form-label">Website link</label>
                                  <input type="text" name="website_link" class="form-control" placeholder="Website link" required="">
                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Place</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>        
            
</div>
                              </div>



<div class="table-scrollable">
<table id="example1" class="display full-width">
<thead>
<tr>
<th>
<strong>Sr.no.</strong>
</th>
<th>
<strong>Must See Place</strong>
</th>
<th>
<strong>Place Name</strong>
</th>
<th>
<strong>Contact</strong>
</th>
<th>
<strong>Address</strong>
</th>
<th>
<strong>Photo</strong>
</th>
<th>
<strong>Latitude</strong>
</th>
<th>
<strong>Longtitude</strong>
</th>
<th>
<strong>Description</strong>
</th>
<th>Website link</th>
<th>
<strong>Action</strong>
</th>
</tr>
</thead>
<tbody>
<?php

$i = 1;
if($list)
{
foreach($list as $h_ne_pl)
{

$wh = '(hotel_near_by_place_id = "'.$h_ne_pl['hotel_near_by_place_id'].'")';

$hotel_near_by_place_image = $this->HotelAdminModel->getData('hotel_near_by_place_images',$wh);

if(!empty($hotel_near_by_place_image))
{
$hotel_near_img = $hotel_near_by_place_image['images'];
}
else
{
$hotel_near_img = '';
}

?> <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
<td>
<strong> <?php echo $i++ ?> </strong>
</td>
<td> <?php echo $h_ne_pl['places']?> </td>
<td> <?php echo $h_ne_pl['places_name']?> </td>
<td> <?php echo $h_ne_pl['contact_no']?> </td>
<td class="job-desk3">
<p class="mb-0"> <?php echo $h_ne_pl['place_address']?> </p>
</td>
<td>
<div class="lightgallery" class="room-list-bx d-flex align-items-center">
<a href="
<?php echo $hotel_near_img?>" data-exthumbimage="
<?php echo $hotel_near_img?>" data-src="
<?php echo $hotel_near_img?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
<img class="me-3" src="
<?php echo $hotel_near_img?>" alt="" style="width:80px;">
</a>
</div>
</td>
<td> <?php echo $h_ne_pl['latitute']?> </td>
<td> <?php echo $h_ne_pl['longitude']?> </td>
<!-- <td>
<a href="#" class="btn btn-secondary shadow btn-xs sharp " data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="
<?php echo strip_tags($h_ne_pl['description'])?>" title="" data-bs-original-title="Description">
<i class="fa fa-eye"></i>
</a>
</td> -->
<td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $h_ne_pl['hotel_near_by_place_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
<td> <?php echo $h_ne_pl['website_link']?> </td>
<td>
<div class="d-flex">
<a href="#" class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl_<?php echo $h_ne_pl['hotel_near_by_place_id']?>">
<i class="fa fa-pencil"></i>
</a>
<a href="#" onclick="delete_data(<?php echo $h_ne_pl['hotel_near_by_place_id'] ?>)" class="btn btn-danger shadow btn-xs sharp">
<i class="fa fa-trash"></i>
</a>
</div>
</td>
<!-- edit modal -->
<div class="modal fade bd-example-modal-xl_<?php echo $h_ne_pl['hotel_near_by_place_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xl slideInRight animated">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Update Places</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form action="
<?php echo base_url('HoteladminController/edit_hotel_near_by_places')?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="hotel_near_by_place_id" value="
<?php echo $h_ne_pl['hotel_near_by_place_id']?>">
<div class="modal-body">
<div class="col-12 ">
<div class="row">
<div class="mb-3 col-md-4 form-group">
<label class="form-label">Must see places</label>
<select name="places" id="inputState" class="default-select form-control wide">
<option selected>Choose...</option>
<option <?php if($h_ne_pl['places'] == "Monuments"){echo "Selected";}?> value="Monuments">Monuments </option>
<option <?php if($h_ne_pl['places'] == "Shopping"){echo "Selected";}?> value="Shopping">Shopping </option>
<option <?php if($h_ne_pl['places'] == "Fun"){echo "Selected";}?> value="Fun">Fun </option>
</select>
</div>
<div class="mb-3 col-md-4 form-group">
<label class="form-label">Place Name</label>
<input type="text" name="places_name" value="
<?php echo $h_ne_pl['places_name']?>" class="form-control" placeholder="" required="">
</div>
<div class="mb-3 col-md-4 form-group">
<label class="form-label">Contact Number</label>
<input type="text" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="contact_no" value="
<?php echo $h_ne_pl['contact_no']?>" class="form-control" placeholder="" required="">
</div>
<div class="mb-3 col-md-12 form-group">
<label class="form-label">Upload Photo</label>
<!-- <input type="file" class="form-control" name="file1" multiple=""> -->
<div class="row">


<?php

$j = 0;

$hotel_near_by_place_images = $this->HotelAdminModel->getAllData('hotel_near_by_place_images',$wh);

if($hotel_near_by_place_images)
{
?> 
<!--<label class="form-label">Upload Photos</label> -->
<?php
foreach($hotel_near_by_place_images as $h_img)
{
?> <input type="hidden" name="id[]" value="
<?php echo $h_img['id']?>">
<div class="col-md-3">


<input name="image[
<?php echo $j?>]" type="file" accept=".jpg,.jpeg,.png,/application" class="dropify" data-default-file="
<?php echo $h_img['images']?>" /> </div>
<?php
$j++;
}
}
?>
</div>
</div>
<div class="mb-3 col-md-6 form-group">
<label class="form-label">Address</label>
<textarea class="summernote" name="place_address" rows="4" id="comment" required="">
            <?php echo $h_ne_pl['place_address']?>
        </textarea>
</div>
<div class="mb-3 col-md-6 form-group">
<label class="form-label">Description</label>
<textarea class="summernote" name="description" rows="4" id="comment" required="">
            <?php echo $h_ne_pl['description']?>
        </textarea>
</div>
<div class="mb-3 col-md-3 form-group">
<label class="form-label">Latitude</label>
<input type="text" class="form-control" name="latitute" value="
            <?php echo $h_ne_pl['latitute']?>" placeholder="">
</div>
<div class="mb-3 col-md-3 form-group">
<label class="form-label">Longtitude</label>
<input type="text" class="form-control" name="longitude" value="
                <?php echo $h_ne_pl['longitude']?>" placeholder="">
</div>
<div class="mb-3 col-md-6 form-group">
<label class="form-label">Website link</label>
<input type="text" class="form-control" name="website_link" value="
                    <?php echo $h_ne_pl['website_link']?>" placeholder="">
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
<!--/. edit modal  -->
</tr> 
<div class="modal fade bd-terms-modal-sm_<?php echo $h_ne_pl['hotel_near_by_place_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $h_ne_pl['description'] ?></span>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      // $('.delete').click(function() {
      function delete_data(id) {
        var id = id;
        var base_url = '<?php echo base_url() ?>';
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
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
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: base_url + "HoteladminController/delete_hotel_near_by_places",
              method: "post",
              data: {
                id: id
              },
              success: function(data) {
                // alert(data);
                if (data == 1) {
                  swalWithBootstrapButtons.fire('Deleted!', 'Your file has been deleted.', 'success').then((result) => {
                    location.reload();
                  })
                }
              }
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire('Cancelled', 'Your imaginary file is safe :)', 'error')
          }
        })
      }
    </script>