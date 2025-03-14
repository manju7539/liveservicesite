<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Service Reviews</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Service Reviews</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Staff Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Staff Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Reviews</header>
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
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Time</th>

                                    <th>Rating</th>
                                    <th class="text-center">Comment</th>

                                    
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                             if($review_list){
                                                             $i = 1+$this->uri->segment(2);
                                                              foreach($review_list as $row){
                                                                
                                                                $where ='(u_id="'.$row['u_id'].'")';
                                                                $user_d = $this->MainModel->getData($tbl='register',$where);
                                                                if(!empty($user_d))
                                                                {
                                                                    $uname = $user_d['full_name'];
                                                                }
                                                                else
                                                                {
                                                                    $uname ='';
                                                                }
    
                                                                $date= strtotime($row['rating_date']);
                                                                $rating_date = date('M d Y', $date);
                                                                
                                                                ?>
                                                        <td>
                                                            <h5><?php echo $i?></h5>

                                                        </td>
                                                        
                                                        <td>
                                                            <h5><?php echo $uname;?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $rating_date;?></h5>
                                                        </td>
                                                        <td>
                                                    <span class="text-nowrap"><?php echo date('h:i A', strtotime($row['rating_time']));?></span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <ul class="stars">
                                                            <?php 
                                                                if($row['rating'] == 1)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($row['rating'] == 2)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($row['rating'] == 3)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php
                                                                }
                                                                elseif($row['rating'] == 4)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php 
                                                                }
                                                                elseif($row['rating'] == 5)
                                                                {
                                                            ?>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                                    <li><a href="javascript:void(0);"><i
                                                                                class="fas fa-star text-secondary"></i></a>
                                                                    </li>
                                                            <?php 
                                                                }
                                                            ?>
                                                        </ul>
                                                    </span>
                                                </td>
                                                        <!-- <td class="job-desk1">
                                                            <h5>
                                                          
                                                                <p class="fs-16">
                                                                <?php echo $row ['review'] ?>
                                                                </p>
                                                           
                                                              </h5>
                                                        </td> -->
                                                        <td> <a href="#" class="badge badge-info" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalCenter_<?php echo $row['review_id']?>">view</a>
                                                </td>
                                                        
                                                    </tr>
                                                    <!-- Modal popup for view-->
                                            <div class="row">
                                                <div class="modal fade" id="exampleModalCenter_<?php echo $row['review_id']?>" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Comment:</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="model_view"><?php echo $row['review']?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                    <?php
                                                    $i++;
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
<!-- inside view model -->
<?php 
            if (!empty($order_data)) 
            {
                $i=1;
                foreach ($order_data as $l1) 
                {
                    $wh1 = '(room_service_menu_order_id ="'.$l1['room_service_menu_order_id'].'")';
                    $get_h_orders_data = $this->MainModel->getAllData1('room_service_menu_details',$wh1);
                    
                   // print_r($get_h_orders_data);die;
        ?>    
            <div class="modal fade example_<?php echo $l1['room_service_menu_order_id'];?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Orders</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mt-4">
                                <div class="col-xl-12">

                                    <div class="table-responsive">
                                        <table
                                            class="table-responsive-lg table sortable table-bordered  mb-0 text-center table_list">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Category</th>

                                                    <th>Photo</th>
                                                    <th> Item</th>
                                                    <th> Quantity</th>
                                                    <th>Price</th>

                                                </tr>
                                            </thead>
                                            <tbody id="geeks">
                  
                                                    <!-- // $wh11 = '(room_serv_menu_id ="' . $g1['room_serv_menu_id'] . '")';
                                                   
                                                    // $get_menu_name = $this->MainModel->getAllData1('room_serv_menu_list', $wh11);
                                          
                                                    // $wh12 = '(room_servs_category_id ="' . $g1['room_service_cat_id'] . '")';
                                                    // $get_category_name = $this->MainModel->getData('room_servs_category', $wh12);
                                             -->

<?php  
                                                $i=1;
                                                foreach($get_h_orders_data as $g1)
                                                {
                                                    //print_r($g1);
                                                    $wh11 = '(room_serv_menu_id ="'.$g1['room_serv_menu_id'].'")';
                                                    $menu_namee = $this->MainModel->getData('room_serv_menu_list',$wh11); 
                                                    
                                                    $wh11 = '(room_servs_category_id ="'.$g1['room_service_cat_id'].'")';
                                                    $category_namee = $this->MainModel->getData('room_servs_category',$wh11); 

                                                    if(!empty($menu_namee))
                                                    {
                                                       	$menu_name = $menu_namee['menu_name'];
                                                        $amount = $menu_namee['price'] * $g1['quantity'];
                                                        $image = $menu_namee['image'];
                                                    }
                                                    else
                                                    {
                                                        $menu_name ='';
                                                        $amount = '0';
                                                        $image ='-';

                                                    }

                                                    if(!empty($category_namee))
                                                    {
                                                       	$category_name = $category_namee['category_name'];
                                                           
                                                    }
                                                    else
                                                    {
                                                    	$category_name ='-';
                                                      
                                                    }
                                            ?>
                                                <tr>
                                                  
                                                        <td><?php echo $i; ?></td>
                                                  
                                                <td>
                                                        <div>
                                                        <h5 class="text-nowrap"><?php echo $category_name?></h5>
                                                        </div>
                                                    </td> 

                                                    <td>
                                                        <div class="lightgallery"
                                                            class="room-list-bx d-flex align-items-center">
                                                            <a href="<?php echo $image?>"
                                                                data-exthumbimage="<?php echo $image?>"
                                                                data-src="<?php echo $image?>"
                                                                class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                <img class="me-3  " src="<?php echo $image?>"
                                                                    alt="" style="width:40px; height:40px;">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                            <div>
                                                                <h5 class="text-nowrap"><?php echo $menu_name?></h5>
                                                            </div>
                                                        </td>
                                                    <td>
                                                        <div>
                                                        <h5 class="text-nowrap"><?php echo $g1['quantity'] ?></h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                        <h5 class="text-nowrap"><?php echo $amount;?></h5>
                                                        </div>
                                                    </td>


                                                </tr>
                                            
                                                <?php 
                                                
                                                $i++;
                                            }
                                        
                                            ?>
                                     
                                            </tbody>
                                        </table>

                                        <nav style="float:right;">
                                            <!-- <ul class="pagination pagination-circle">
                                                <li class="page-item page-indicator">
                                                    <a class="page-link" href="javascript:void(0)">
                                                        <i class="la la-angle-left"></i></a>
                                                </li>
                                                <li class="page-item active"><a class="page-link"
                                                        href="javascript:void(0)">1</a>
                                                </li>
                                                <li class="page-item"><a class="page-link"
                                                        href="javascript:void(0)">2</a></li>
                                                <li class="page-item"><a class="page-link"
                                                        href="javascript:void(0)">3</a></li>

                                                <li class="page-item page-indicator">
                                                    <a class="page-link" href="javascript:void(0)">
                                                        <i class="la la-angle-right"></i></a>
                                                </li>
                                            </ul> -->
                                        </nav>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end of view modal  -->
            <?php 
                    $i++;
                }
            }
        ?>


        </div>



<!-- end -->
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
  <!-- add btn modal  -->
        <div class="modal fade bd-add-modal add_staff_modal" tabindex="-1" style="display: none;" aria-hidden="true">
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
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="full_name" class="form-control" placeholder="Enter Name" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mobile No.</label>
                                            <input type="text" name="mobile" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Enter Mobile No" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Email_Id</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                                        </div>
                                      
                                         <div class="mb-3 col-md-6">
                                             <label class="form-label">Profile Photo</label>
                                               <input type="file" name="File" accept="image/png, image/gif, image/jpeg" class="form-control" required>
                                          </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Address</label>
                                                <textarea name="address" class="summernote" cols="30" rows="10"></textarea>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script>

    $(document).on("click",".add_staff",function(){
        $(".add_staff_modal").modal('show');
    });

    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });

$(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_staff') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_staff_modal").modal('hide');
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
            url         : '<?= base_url('HomeController/update_staff_details') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_staff_modal").modal('hide');
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

<script type="text/javascript">
    function change_status(cnt) {
             //alert('hi');
              var base_url = '<?php echo base_url();?>';
              var status = $('#active'+cnt).children("option:selected").val();
              var uid = $('#uid'+cnt).val();
                //alert(cid);
              if (status != '') {

                  $.ajax({
                      url: base_url + "HomeController/update_status_user",
                      method: "POST",
                      data: {
                          active: status,
                          uid: uid
                      },
                      dataType: "json",
                      success: function(data) {
                          //alert(data);
                          if (data == true) {
                              alert('Status Changed Sucessfully !..');
                          } else {
                              alert('Something Went Wrong !...')
                          }
                      }
                  });
              }
          }
</script>