<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Offers</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>
<li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
class="fa fa-angle-right"></i>
</li>
<li class="active">Offers</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
<header>List of Offers</header>
<div class="tools">
<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
</div>
</div>
<?php
                    if($this->session->flashdata('msg'))
                    {
                ?>
                    <div class="alert alert-primary" role="alert">
                        <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                    </div>
                <?php
                    }
                ?>
<div class="card-body ">

<div>
                        <button style="float:right;" type="button" class="btn btn-primary css_btn"
                            data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Add Offers</button>

                    </div><br><br>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Offers</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <form action="<?php echo base_url('HoteladminController/add_offer')?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="basic-form">
                                                <div class="row">
                                                <div class="mb-3 col-md-6">
                                                                <label class="form-label">Offer Name</label>
                                                           <!--<input type="text" name="offer_name" class="form-control alphanumericOnly" onkeyup="this.value=this.value.replace(/[^a-zA-Z]/g, '')"
                                                                    placeholder="offer name" required>-->
                                                              
                                                              
                                                                   <input type="text" name="offer_name" class="form-control "
                                                                    placeholder="offer name" required>
                                                              
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Offer For</label>
                                                                <select id="ddlPassport" class="default-select form-control wide" name="offer_for" required>
                                                                    <option value data-isdefaul="true">Choose Any One</option>
                                                                    <option value="1">Over All</option>
                                                                    <option value="2">Front Ofs</option>
                                                                    <option value="3">Bar And Restaurant</option>
                                                                </select>
                                                            </div>
                                                            <!-- <div class="mb-3 col-md-6">
                                                                <label class="form-label">Minimum amount</label>
                                                                <input type="number" name="min_amount" class="form-control"
                                                                    placeholder="amount" required>
                                                            </div> -->
                                                           
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Amount in Percentage
                                                                    (%)</label>
                                                                <input type="number" name="amt_in_per" class="form-control"
                                                                    placeholder="percentage" required>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Start Date</label>
                                                                <input type="date" name="start_date" class="form-control" id="s_date"  
                                                                    placeholder="date" required>
                                                            </div>
                                                          
                                                            <div class="mb-3 col-md-6">
                                                                <label class="form-label">Expiry Date</label>
                                                                <input type="date" name="end_date" class="form-control" id="e_date"
                                                                    placeholder="date" required>
                                                            </div>
                                                            <div class="mb-3 col-md-6 form-group">
                                                                <label class="form-label">Upload photo</label>

                                                                <input type="file" name="image" accept=".jpg,.jpeg,.png,/application" class="form-control"
                                                                    data-height="80" required>

                                                            </div>
                                                            <div class="mb-3 col-md-12">
                                                                <label class="form-label">Offer Description</label>
                                                                <textarea class="summernote" name="description" rows="4" id="comment"
                                                                    required=""></textarea>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <div class="text-center">
                                                                <button type="submit" class="btn btn-info">Add
                                                                    Offer</button>
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
<th><strong>Sr.no.</strong></th>
<!-- <th><strong>Coupon Code</strong></th>-->
<th><strong>Offer Name</strong></th>
<th><strong>Offer For</strong></th>
<!--<th><strong>Minimum Amount</strong></th>-->
<th><strong> percentage(%)</strong></th>
<th><strong>Start Date</strong></th>
<th><strong>Expiry Date</strong></th>
<th><strong> Image</strong></th>
<!-- <th><strong>Description</strong></th> -->
<th><strong>Action</strong></th>
</tr>
</thead>
<tbody>
<?php

$i = 1;
if($list)
{
foreach($list as $off)
{
$offer_for = "";

if($off['offer_for'] == 1)
{
$offer_for = "Over All";
}
else
{
if($off['offer_for'] == 2)
{
$offer_for = "Front Office Services";
}
else
{
if($off['offer_for'] == 3)
{
$offer_for = "Bar and Restaurant";
}
}
}
?>

<tr>
<td><strong><?php echo $i++ ?></strong></td>
<!-- <td><?php //echo $off['offer_code'] ?></td>-->
<td><?php echo $off['offer_name'] ?></td>
<td><?php echo $offer_for?></td>
<!--<td><?php echo $off['min_amount'] ?></td>-->
<td><?php echo $off['amt_in_per'] ?> </td>
<td><?php echo $off['start_date'] ?></td>
<td><?php echo $off['end_date'] ?></td>
<td>
<div class="lightgallery"
class="room-list-bx d-flex align-items-center">
<a href="<?php echo $off['image'] ?>"
data-exthumbimage="<?php echo $off['image'] ?>"
data-src="<?php echo $off['image'] ?>"
class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
<img class="me-2 "
src="<?php echo $off['image'] ?>"
alt="" style="width:70px;">
</a>
</div>
</td>
<!-- <td>Special offer available</td> -->
<td>
<div class="">
<a href="#"
class="btn btn-warning shadow btn-xs sharp me-1"
data-bs-toggle="modal"
data-bs-target=".bd-example-modal-lg_<?php echo $off['offer_id'] ?>"><i
class="fa fa-pencil"></i></a>
<a href="#" onclick="delete_data(<?php echo $off['offer_id'] ?>)"
class="btn btn-danger shadow btn-xs sharp"><i
class="fa fa-trash"></i></a>
</div>
</td>
</tr>
<!-- edit modal -->
<div class="modal fade bd-example-modal-lg_<?php echo $off['offer_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-lg slideInRight animated">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Offers</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal">
</button>
</div>
<form action="<?php echo base_url('HoteladminController/edit_offer')?>" method="post" enctype="multipart/form-data">
<div class="modal-body">
<div class="col-lg-12">
<input type="hidden" name="offer_id" value="<?php echo $off['offer_id'] ?>">
<div class="row">
   <!-- <div class="mb-3 col-md-6">
        <label class="form-label">Coupon code</label>
        <input type="textt" name="offer_code" value="<?php echo $off['offer_code'] ?>" class="form-control" placeholder="coupon code" readonly>
    </div>-->
    <div class="mb-3 col-md-6">
        <label class="form-label">Offer Name</label>
        <input type="text" name="offer_name" value="<?php echo $off['offer_name'] ?>" class="form-control" placeholder="offer name">
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Offer For</label>
        <?php
            if($off['offer_for'] == 1)
            {
                $offer_for = "Over All";
        ?>
                <input type="text" value="<?php echo $offer_for ?>" class="form-control" readonly>
        <?php
            }
            else
            {
        ?>
                <select id="ddlPassport" class="default-select form-control wide" name="offer_for">
                    <option value>Choose Any One</option>
                    <option <?php if($off['offer_for'] == 2){ echo "Selected";}?> value="2">Front Ofs</option>
                    <option <?php if($off['offer_for'] == 3){ echo "Selected";}?> value="3">Bar And Restaurant</option>
                </select>
        <?php
            }
        ?>
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Amount in Percentage (%)</label>
        <input type="number" name="amt_in_per" value="<?php echo $off['amt_in_per'] ?>" class="form-control" placeholder="percentage">
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Start Date</label>
        <input type="date" name="start_date" value="<?php echo $off['start_date'] ?>" id="s_date" class="form-control" placeholder="date">
    </div>
    <div class="mb-3 col-md-6">
        <label class="form-label">Expiry Date</label>
        <input type="date" name="end_date" value="<?php echo $off['end_date'] ?>" id="e_date" class="form-control" placeholder="date">
    </div>
    <div class="mb-3 col-md-12 form-group">
        <label class="form-label">Upload photo</label>
        <input type="file" name="image" accept=".jpg,.jpeg,.png,/application" class="dropify" data-height="80" data-default-file="<?php echo $off['image']?>"/>

    </div>
    <div class="mb-3 col-md-12">
        <label class="form-label">Offer Description</label>
        <textarea name="description"  class="summernote" rows="4" id="comment"
            required=""><?php echo $off['description'] ?></textarea>
    </div>
</div>

</div>
<div class="modal-footer">
<div class="text-center">
<button type="button" class="btn btn-light"
    data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update Offer</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!--/. edit modal -->
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
                                url     : base_url + "HoteladminController/delete_offer",
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