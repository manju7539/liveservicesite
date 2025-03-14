<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
 <style>
    .feed_back .container-fluid{
        padding:0px
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Guest Feedback</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Guest Feedback</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Feedback</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                    
                        
                    </div>
                                 
                        <div class="table-scrollable feed_back">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <th>Date</th>
                                    <th>Guest Name</th>
                                    <!-- <th>Phone</th> -->
                                    <th>Rate Our Service</th>
                                    <!-- <th>Room No</th> -->
                                    <th>Rating</th>
                                    <th>Feedback</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                            
                                            $i = 1+$this->uri->segment(2);

                                            if(!empty($list))
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
                            
                                                    $get_rating_5 = $this->FrontofficeModel->get_ratings($where5);
                                                                                            
                                                    $where6 = '(rating="4")';
                                                    
                                                    $get_rating_4 = $this->FrontofficeModel->get_ratings($where6);
                                                    
                                                    $where7 = '(rating="3")';
                                                    
                                                    $get_rating_3 = $this->FrontofficeModel->get_ratings($where7);
                                                    
                                                    $where8 = '(rating="2")';
                                                    
                                                    $get_rating_2 = $this->FrontofficeModel->get_ratings($where8);
                                                    
                                                    $where9 = '(rating="1")';
                                                    
                                                    $get_rating_1 = $this->FrontofficeModel->get_ratings($where9);
                                                    
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

                                                         $wh = '(booking_id= "'.$feed['u_id'].'")';
                                                        $room = $this->MainModel->getData('user_hotel_booking_details',$wh);
                                                        // print_r(  $room );
                                                        if(!empty($room))
                                                        {
                                                            $room_no = $room['room_no'];

                                                        }
                                                        else
                                                        {
                                                            $room_no = "-";
                                                        }
                              
                                        ?>
                                                <tr>
                                                <td><h5><?php echo $i++ ?></h5></td>
                                                <td><h5><?php echo $feed['rating_date'] ?></h5></td>
                                                <td><h5><?php echo $feed['full_name'] ?></h5></td>
                                                <td><?php echo $review_for ?></td>
                                                <!-- <td><h5><?php echo $room_no ?></h5></td> -->
                                                    <!-- <td>
                                                        <span>
                                                            <ul class="stars" style="justify-content: center;">
                                                                <li><a href="javascript:void(0);"><i
                                                                            class="fa fa-star text-secondary"></i></a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i
                                                                            class="fa fa-star text-secondary"></i></a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i
                                                                            class="fa fa-star text-secondary"></i></a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i
                                                                            class="fa fa-star text-secondary"></i></a>
                                                                </li>
                                                                <li><a href="javascript:void(0);"><i
                                                                            class="fa fa-star text-secondary"></i></a>
                                                                </li>
                                                            </ul>
                                                        </span>
                                                    </td> -->
                                                   <!--- <td>
                                                        <div class="d-flex flex-wrap">
                                                            <div class="text-center">
                                                                <ul class="stars">
                                                                <?php   
                                                                    $j=1;

                                                                    while($j <= $star_rating)
                                                                    {
                                                                ?>
                                                                        <li><a href="javascript:void(0);"><i class="fa fa-star "></i></a></li>
                                                                <?php
                                                                        $j = $j + 1;
                                                                    }

                                                                    while($j <= 5)
                                                                    {
                                                                ?>
                                                                    <li><a href="javascript:void(0);"><i class="fa fa-star text-light"></i></a></li>
                                                                <?php
                                                                        
                                                                        $j = $j + 1;
                                                                    }
                                                                ?>
                                                                <span> <b>( <?php echo round($feed['rating'],2)?>)</b></span>
                                                                </ul>
                                                            </div> ---->
                                                            <td>
                                                    <span>
                                                        <ul class="stars">
                                                            <?php 
                                                                if($feed['rating'] == 1)
                                                                {
                                                            ?>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                                
                                                                    
                                                            <?php
                                                                }
                                                                elseif($feed['rating'] == 2)
                                                                {
                                                            ?>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                            <?php
                                                                }
                                                                elseif($feed['rating'] == 3)
                                                                {
                                                            ?>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                            <?php
                                                                }
                                                                elseif($feed['rating'] == 4)
                                                                {
                                                            ?>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                            <?php 
                                                                }
                                                                elseif($feed['rating'] == 5)
                                                                {
                                                            ?>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    <a href="javascript:void(0);"><i
                                                                                class="fa fa-star text-secondary"></i></a>
                                                                    
                                                            <?php 
                                                                }
                                                            ?>
                                                                <span> <b>( <?php echo round($feed['rating'],2)?>)</b></span>
                                                        </ul>
                                                    </span>
                                                </td>
                                                        <!-- </div> -->
                                                    <!-- </td> -->
                                                    <td>
                                                        <a href="#" class="btn btn-success shadow btn-xs sharp me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".bd-discription-modal-lg_<?php echo $feed['review_id'] ?>"><i
                                                                class="fa fa-eye"></i></a>
                                                    </td>

                                                </tr>
                                                 <!-- modal popup for discription  -->
                                                <div class="modal fade bd-discription-modal-lg_<?php echo $feed['review_id'] ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Discription</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-lg-12">
                                                                    <p><?php echo $feed['review'] ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end of modal  -->
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
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="facility_name" class="form-control" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->

<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>


<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_facility_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });

     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_facility') ?>',
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
</script>