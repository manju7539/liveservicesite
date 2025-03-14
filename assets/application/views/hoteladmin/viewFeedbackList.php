<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="page-bar">
<div class="page-title-breadcrumb">
<div class=" pull-left">
<div class="page-title">Feedback</div>
</div>
<ol class="breadcrumb page-breadcrumb pull-right">
<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
</li>
<li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
class="fa fa-angle-right"></i>
</li>
<li class="active">Feedback</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="card card-topline-aqua">
<div class="card-head">
<header>List of Feedback</header>
<div class="tools">
<a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
<a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
<a class="t-close btn-color fa fa-times" href="javascript:;"></a>
</div>
</div>
<div class="card-body ">

<div class="row mb-3">
                                                <div class="col-md-4">
                                                  <form method="POST">
                                                    <div class="input-group">
                                                        <input type="text" name="date" class="form-control wide"
                                                            placeholder="Feedback Date" onfocus="(this.type = 'date')"
                                                            id="date" required>
                                                        <select id="inputState" name="review_for" class="default-select form-control wide"
                                                         required>
                                                            <option selected="" disabled>Choose Service...</option>
                                                            <option value="3">Room service</option>
                                                            <option value="2">Front-office</option>
                                                            <option value="4">Food service</option>
                                                            <option value="5">housekeeping service</option>
                                                        </select>
                                                        <button type="submit" name="search" class="btn btn-warning  btn-sm "><i
                                                                class="fa fa-search"></i></button>
                                                    </div>
                                                  </form>
                                                </div>
                                              
                                            </div>


<div class="table-scrollable">
<table id="example1" class="display full-width">
<thead>
<tr>
<th><strong>Sr.no.</strong></th>
<th><strong>Date</strong></th>
<th><strong>Guest Name</strong></th>
<!-- <th><strong> Room No.</strong></th> -->
<th><strong>Rate Our Service</strong></th>
<th><strong>Rating</strong></th>
<th><strong>Description</strong></th>
<th><strong>Action</strong></th>
</tr>
</thead>
<tbody>
<?php
        
            $i = 1;
            if($list)
            {
                foreach($list as $feed)
                {
                    if($feed['review_for'] == 1)
                    {
                        $review_for = "Hotel Admin";
                    }
                    else
                    {
                        if($feed['review_for'] == 2)
                        {
                            $review_for = "Front office";
                        }
                        else
                        {
                            if($feed['review_for'] == 3)
                            {
                                $review_for = "House keeping";
                            }
                            else
                            {
                                if($feed['review_for'] == 4)
                                {
                                    $review_for = "Room Service";
                                }
                                else
                                {
                                    if($feed['review_for'] == 5)
                                    {
                                        $review_for = "Food and beverage";
                                    }
                                }
                            }
                        }
                    }

                    $where5 = '(rating="5")';

                    $get_rating_5 = $this->HotelAdminModel->get_ratings($where5);
                                                            
                    $where6 = '(rating="4")';
                    
                    $get_rating_4 = $this->HotelAdminModel->get_ratings($where6);
                    
                    $where7 = '(rating="3")';
                    
                    $get_rating_3 = $this->HotelAdminModel->get_ratings($where7);
                    
                    $where8 = '(rating="2")';
                    
                    $get_rating_2 = $this->HotelAdminModel->get_ratings($where8);
                    
                    $where9 = '(rating="1")';
                    
                    $get_rating_1 = $this->HotelAdminModel->get_ratings($where9);
                    
                    if($get_rating_1 != 0 || $get_rating_2 != 0 || $get_rating_3 != 0 || $get_rating_4 != 0 || $get_rating_5 != 0)
                    {
                        $star_rating1=(5 * $get_rating_5 + 4 * $get_rating_4 + 3 * $get_rating_3 + 2 * $get_rating_2 + 1 * $get_rating_1)/($get_rating_5+$get_rating_4+$get_rating_3+$get_rating_2+$get_rating_1);
                    }
                    else
                    {
                        $star_rating1 = 0;
                    }

                    $star_rating = round($star_rating1);

                    $empty_stars = 5 - $star_rating;   

        ?>
            <tr>
                <td><strong><?php echo $i++ ?></strong></td>
                <td><?php echo $feed['rating_date'] ?></td>
                <td><?php echo $feed['full_name'] ?></td>
                <!-- <td>303</td> -->
                <td><?php echo $review_for ?></td>
                <td>
                    <div class="d-flex flex-wrap">
                        <div class="start_block">
                            <ul class="stars">
                            <?php   
                                $j=1;

                                while($j <= $star_rating)
                                {
                            ?>
                                  <a href="javascript:void(0);"><i class="fa fa-star "></i></a>
                            <?php
                                    $j = $j + 1;
                                }

                                while($j <= 5)
                                {
                            ?>
                               <a href="javascript:void(0);"><i class="fa fa-star text-light" style="color:#c8c8c8 !important;"></i></a>
                            <?php
                                    
                                    $j = $j + 1;
                                }
                            ?>
                            <span> <b>( <?php echo round($feed['rating'],2)?>)</b></span>
                            </ul>
                        </div>
                    </div>
                </td>
                <!-- <td>
                    <button class="btn btn-secondary_<?php echo $feed['review_id'] ?> shadow btn-xs sharp"
                        data-toggle="popover" data-bs-original-title="" title=""><i
                            class="fa fa-eye"></i></button>
                </td> -->
                <td>
        <a style="margin:auto" data-bs-toggle="modal"
            data-bs-target=".bd-terms-modal-sm_<?php echo $feed['review_id'] ?>"
            class="btn btn-secondary shadow btn-xs sharp"><i
                class="fa fa-eye"></i></a>
    </td>
                <td>
                    <a href="#" onclick="delete_data(<?php echo $feed['review_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i
                            class="fa fa-trash"></i></a>
                </td>
            </tr>
            <div class="modal fade bd-terms-modal-sm_<?php echo $feed['review_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Description</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
<div class="modal-body">
    <div class="col-lg-12">
        <span><?php echo $feed['review'] ?></span>
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
                            url     : base_url + "HoteladminController/delete_feedback",
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