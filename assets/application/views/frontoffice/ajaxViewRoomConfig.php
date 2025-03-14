<div class="content-body">
            <div class="container-fluid">

            <?php
                if ($this->session->flashdata('msg')) {
                ?>
                    <div class="alert alert-info" id="a" role="alert" style="margin-top: 10px; background-color: #71C56C;">
                        <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }
            ?>
                <div class="row page-titles">
                    <!-- <div class="col-6">
                        <h4>View Configuration</h4>

                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                    href="<?php //echo base_url('index') ?>">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li><i class=""></i>&nbsp;<a class="parent-item"
                                    href="<?php //echo base_url('room_config') ?>">Room Configuration</a>&nbsp;
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li class="active"> View Configuration</li>
                        </ol>
                    </div> -->

                </div>
                <!-- row -->
                <div class="row">
                    <h3 class="text-center"> <?php echo $room_type_data['room_type_name']?> </h3>
                    <?php
                    if($list)
                    {  
			            // $admin_id = $this->session->userdata('admin_id');
                        $u_id= $this->session->userdata('u_id');
                        $where ='(u_id = "'.$u_id.'")';
                        $admin_details = $this->MainModel->getData($tbl ='register', $where);
                        
                       
                        $admin_id = $admin_details['hotel_id'];
               $i=1;
            
                        foreach($list as $r_c)
                        {
                           $i++;
			                $room_imgs = $this->FrontofficeModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                            
			                $room_facility = $this->FrontofficeModel->get_room_facility($admin_id,$r_c['room_configure_id']);

			                $room_number = $this->FrontofficeModel->get_room_numbers($admin_id,$r_c['room_configure_id']);

                ?>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                    <div class="card-body p-4">
                                        <div class="bootstrap-carousel">
                                            <div id="carouselExampleIndicators_<?php echo $i;?>" class="carousel slide"
                                                data-bs-ride="carousel">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                        data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                        data-bs-slide-to="1" aria-label="Slide 2" class="active"
                                                        aria-current="true"></button>
                                                    <button type="button" data-bs-target="#carouselExampleIndicators_<?php echo $i;?>"
                                                        data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                                                </div>
                                                <div class="carousel-inner">
                                                <?php
                                                                if($room_imgs)
                                                                {
                                                                       $j=1;

                                                                    foreach($room_imgs as $ri)
                                                                    {
                                                            ?>
                                                    <div class="carousel-item <?php if($j==1){echo"active";}?>">
                                                        <img class="d-block w-100"
                                                            src="<?php echo $ri['images']?>"
                                                            alt="First slide" style="height:400px;">
                                                    </div>
                                                    <?php
                                                           $j++;
                                                                    }
                                                               }
                                                            ?>
                                                    
                                                </div>
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExampleIndicators_<?php echo $i;?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExampleIndicators_<?php echo $i;?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                    <div class="product-detail-content">

                                        <div class="new-arrival-content pr">

                                            <p class="fs-16"><strong>Description</strong>:&nbsp;&nbsp;
                                            <p class="text-content">
                                            <?php echo $r_c['room_details']?>
                                            </p>

                                            <p class="fs-16 mt-4"><strong>Type of Room:</strong> <span
                                                    class="item fw-500 fs-14"> <?php echo $room_type_data['room_type_name']?></span></p>

                                            <div class="d-flex flex-wrap">
                                                <div class="mt-4 check-status">

                                                    <p class="d-block mb-2 fs-16"><strong>Room No.</strong></p>
                                                 <div class="d-flex">
                                                   <?php
                                                                if($room_number)
                                                                {
                                                                    foreach($room_number as $rn)
                                                                    {
                                                            ?>
                                                    <div class="view_room_card">
                                                        <div class="room_card card red">
                                                            <span class="room_no "><?php echo $rn['room_no']?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                                    }
                                                                }
                                                            ?>
                                                </div>
                                                <div class="mt-4 ms-3">
                                                    <p class="d-block mb-2 text-black fs-16"><strong>Price</strong></p>
                                                    <span class="font-w500 fs-24 text-black">
                                                        <div class="d-table mb-2 mt-2">
                                                            <p class="price float-start d-block">Rs <?php echo $r_c['price']?></p>
                                                            <!-- <p class=""><strong>20% off</strong></p> -->
                                                        </div>
                                                    </span>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="d-flex align-items-end flex-wrap mt-4">
                                                <div class="filtaring-area me-3">
                                                <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p>
                                                </div>
                                            </div>
                                            <div class="facilities">
                                            <?php
                                                            if($room_facility)
                                                            {
                                                                foreach($room_facility as $rf)
                                                                {
                                                        ?>
                                            
                                                <!-- <p class="d-block mb-3  fs-16"><strong>Facilities</strong></p> -->
                                                <a href="javascript:void(0);" class="btn btn-secondary light">
                                                <?php echo $rf['room_facility']?>
                                                </a>
                                                <?php
                                                                }
                                                            }
                                                        ?>
                            
                                           
                                            </div>

                                            <div class="shopping-cart  mb-2 me-3">

                                                <div class="d-flex" style="float:right">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"
                                                        data-bs-toggle="modal" data-bs-target=".bd-example-modal_<?php echo $r_c['room_configure_id']?>"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <!-- <a href="#"
                                                        class="btn btn-danger btn sweet-confirm shadow btn-xs sharp delete"><i
                                                            class="fa fa-trash"></i></a> -->
                                                          
                                                                    <a href="#" id="delete_<?php echo $r_c['room_configure_id']; ?>"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    else
                    {
                        echo '<h6 class="not_found">Data Not Found</h6>';
                    }
                ?>
                
                  
                </div>
            </div>
        </div>
        <?php
                    if($list)
                    {  
			            // $admin_id = $this->session->userdata('admin_id');
                        $u_id= $this->session->userdata('u_id');
                        $where ='(u_id = "'.$u_id.'")';
                        $admin_details = $this->MainModel->getData($tbl ='register', $where);
                        
                       
                        $admin_id = $admin_details['hotel_id'];

                        foreach($list as $r_c)
                        {
			                $room_imgs = $this->FrontofficeModel->get_room_imgs($admin_id,$r_c['room_configure_id']);
                            
			                $room_facility = $this->FrontofficeModel->get_room_facility($admin_id,$r_c['room_configure_id']);

			                $room_number = $this->FrontofficeModel->get_room_numbers($admin_id,$r_c['room_configure_id']);
                            
                ?>
        <!-- Modal -->
        <div class="modal fade bd-example-modal_<?php echo $r_c['room_configure_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">
                        <form action="<?php echo base_url('MainController/update_rooms')?>" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="room_configure_id" value="<?php echo $r_c['room_configure_id']?>">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Floor</label>
                                        <select class="form-control" name="floor_id"  id="active2">
                                        <option value data-isdefault="true">Choose floor...</option>
                                                            <?php
                                                                if($floor_list)
                                                                {
                                                                    foreach($floor_lzist as $f_l)
                                                                    {
                                                            ?>
                                                                        <option <?php if($f_l['floor_id'] == $r_c['floor_id']){echo "Selected";}?> value="<?php echo $f_l['floor_id']?>"><?php echo $f_l['floor']?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Room No</label>
                                        <input type="text" name="room_no[]" value="
                                                        <?php
                                                            $room_no = array();
                  
                                                            foreach($room_number as $rm)
                                                            {
                                                                $room_no[] = $rm['room_no'];
                                                            } 
                                                          
                                                            $room_no11 = implode(',',$room_no);
                                        
                                                            print_r($room_no11);
                                                        ?>" class="form-control" placeholder="">
                                        <small class="form-text text-muted">Separate keywords with a
                                            comma, space bar, or enter key</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label"> Room Type</label>
                                        <!-- <select class="form-control" name="is_active" id="active2">
                                            <option>Choose Room type...</option>

                                            <option>Single</option>
                                            <option>Double</option>
                                            <option>Twin</option>
                                            <option>King</option>

                                        </select> -->
                                        <input type="hidden" name="room_type" value="<?php echo $r_c['room_type']?>" class="form-control" placeholder="">
                                                        <input type="text" value="<?php echo $room_type_data['room_type_name']?>" class="form-control" placeholder="" readonly>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" value="<?php echo $r_c['price']?>" name="price">
                                    </div>
                                    <?php
                                                             
                                                             $j = 0;
 
                                                             
                                                             if($room_imgs)
                                                             { 
                                                         ?>
                                    <div class=" mb-3 col-md-6">
                                        <label class="form-label">Photos</label>
                                        <!-- <input type="file" class="form-control" multiple> -->
                                        <?php
                                            foreach($room_imgs as $rm_i)
                                            {
                                        ?>
                                                <input type="hidden" name="room_img_id[]" value="<?php echo $rm_i['room_img_id']?>">
                                                <input type="file" class="form-control" name="image[<?php echo $j?>]" id="files" accept="image/jpeg, image/png," onchange="pressed()">
                                                <!-- <input accept="image/*" type="file" name="profile_photo" id="admin_profile" class="file_upload "  > -->
                                                 <label id="fileLabel " style="line-height: 26px;"><?php echo basename($rm_i['images']);?></label>
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
                                    <div class=" mb-3 col-md-6">
                                        <label class="form-label">Facilities</label>
                                        <input type="text" name="facility[]" value="
                                                        <?php
                                                            $room_fc = array();
                  
                                                            foreach($room_facility as $rf)
                                                            {
                                                                $room_fc[] = $rf['room_facility'];
                                                            } 
                                                          
                                                            $room_fc11 = implode(',',$room_fc);
                                        
                                                            print_r($room_fc11);
                                                        ?>" class="form-control" placeholder="">
                                        <small class="form-text text-muted">Separate keywords with a
                                            comma, space bar, or enter key</small>
                                    </div>
                                    <div class=" mb-3 col-md-12">
                                        <label class="form-label">Room Details</label>
                                        <!-- <div class="summernote"></div> -->
                                        <textarea class="summernote" rows="4" id="comment" name="room_details"><?php echo $r_c['room_details']?></textarea>

                                    </div>


                                </div>
                                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary css_btn">Save changes</button>
                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>

                    </div>
                            </form>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div> <!-- end of modal  -->
        <?php
                        }
                    }
                ?>
    </div>