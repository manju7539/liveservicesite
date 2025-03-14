<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Notification</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Notification</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">data Created Successfully..!</strong>
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
        </div>
        <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
            <strong style="color:#fff ;margin-top:10px;">data Updated Successfully..!</strong>
            <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
        </div>
        <!-- chiragi Start :: super admin notification for all hotels -->
        <?php if($all_hotel_notis_from_SA) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                        <?php foreach ($all_hotel_notis_from_SA as $sa_n) 
                        {
                            if($sa_n['all_hotels_resent_not'] > 0)
                            {
                                for ($x = 1; $x <= $sa_n['all_hotels_resent_not']; $x++)
                                {
                                    ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5 class="fw-bold"><?php echo $sa_n['title']?></h5>
                                                    <span><?php echo $sa_n['description']?></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <h5><?php echo date('d-m-Y',strtotime($sa_n['created_at']))." - ".date('h:i a',strtotime($sa_n['created_at'])) ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                }
                            }
                        } 
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Chiragi End :: super admin notification for all hotels -->
        <!-- chiragi Start :: super admin notificatio for specific hotel --> 
        <?php if($specific_hotel_notis_from_SA) { ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                        <?php foreach ($specific_hotel_notis_from_SA as $sa_n) 
                        {
                            if($sa_n['specific_hotel_resent_not'] > 0)
                            {
                                for ($x = 1; $x <= $sa_n['specific_hotel_resent_not']; $x++)
                                {
                                ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5 class="fw-bold"><?php echo $sa_n['title']?></h5>
                                            <span><?php echo $sa_n['description']?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <h5><?php echo date('d-m-Y',strtotime($sa_n['created_at']))." - ".date('h:i a',strtotime($sa_n['created_at'])) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            }
                        } 
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- Chiragi End :: super admin notificatio for specific hotel -->
        <!-- Start :: notifications 1 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                        <?php
                            if($see_all_notification)
                            {
                                foreach ($see_all_notification as $all_n) 
                                {
                                    $wh = '(notification_id = "'.$all_n['notification_id'].'" AND department_id = 2)';

                                    $notifictions_department_id = $this->MainModel->getAllData('notifictions_department_id',$wh);

                                    if($notifictions_department_id)
                                    {
                                    ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5 class="fw-bold"><?php echo $all_n['title']?></h5>
                                                    <span><?php echo $all_n['description']?></span>
                                                </div>
                                                <div class="col-md-2">
                                                    <h5><?php echo date('d-m-Y',strtotime($all_n['created_at']))." - ".date('h:i a',strtotime($all_n['created_at'])) ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            else
                            {
                                echo "Notifications Not Available";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

