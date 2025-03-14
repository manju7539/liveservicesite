<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
 <style>
    .concierge-bx{
        height: 2.813rem;
    width: 2.813rem;
    }
    .concierge-bx img{
        max-width:100%;
        min-width:100%
    }
 </style>
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Staff History</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('staffManage')?>">Staff</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Staff History</li>
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
            
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List of Staff</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    
                        <div class="btn-group r-btn">
                                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('staffManage')?>" style="color:white;">Manage Staff</a></button>  
                                    <button id="addRow1" class="btn btn-info add_facility">
                                        Add Staff 
                                    </button> 
                        </div>
                   
                        <div class="table-scrollable">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- row -->
        <?php 
                        if(!empty($list))
                        {
                            $full_name = $list['full_name'];
                            $u_id = $list['u_id'];
                            $mobile_no = $list['mobile_no'];
                            $email_id = $list['email_id'];
                            $address = $list['address'];
                            $city = $list['city'];
                            $status = $list['is_active'];

                            $register_date = date('F d, Y',strtotime($list['register_date']));
                            
                        }
                        else
                        {
                            $full_name = "-";
                            $u_id = "-";
                            $mobile_no = "-";
                            $email_id = "-";
                            $address = "-";
                            $register_date = "-";
                            $city ="-";
                        }

                        //for image													
                        if(!empty($list['profile_photo']))
                        {
                            $img =$list['profile_photo'];
                            
                        }
                        else
                        {
                        
                            $img = base_url()."documents/profile_photo.png";
                        }       
                    ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo $img?>" alt="Admin"
                                        class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $full_name;?></h4>
                                        <p class="text-secondary mb-1"><?php echo $email_id;?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php echo $address?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php 
                                    if( $status = 1) 
                                    
                                    echo "Active";

                                    else{
                                        echo "Inactive"; 
                                    }
                                    
                                    ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php echo $mobile_no?> 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Deparment</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        Room Service
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Location</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <?php echo $city; ?>
                                    </div>
                                </div>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    $u_id = $this->uri->segment(2);
                ?>
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="card-action coin-tabs mb-2">
                    <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <!-- <a class="nav-link active" data-bs-toggle="tab" href="<?php echo base_url('staff_history/').$u_id?>">Placed
                                    Order</a> -->
                                    <a class="nav-link "  href="<?php echo base_url('staff_history/').$u_id?>">Menu Accepted
                                    Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="<?php echo base_url('staff_accept_order/').$u_id?>"> Menu Completed
                                    Order</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"  href="<?php echo base_url('staff_reject_order/').$u_id?>">Service Accepted
                                    order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="<?php echo base_url('staff_complete_order/').$u_id?>">Service Completed
                                    order</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- row  -->
    </div>
</div>



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

<!-- <script src="<?php //echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<!-- script for hide show  -->

<script></script>
</body>

</html>
