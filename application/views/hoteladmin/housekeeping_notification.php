<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">All Notification</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li>
                        <i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">All Notification</li>
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
        <!-- Start :: notifications 1 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                        <?php
                              if($get_hk_notifications)
                              {
                                foreach($get_hk_notifications as $gnt)
                                {
                                  	$wh = '(notification_id = "'.$gnt['notification_id'].'" AND department_id = 5)';

                                    $notifictions_department_id = $this->HotelAdminModel->getAllData('notifictions_department_id',$wh);

                                    if($notifictions_department_id)
                                    {
                         ?>
                                <div class="card">
                                          <div class="card-body">
                                              <div class="row">
                                                  <div class="col-md-10">
                                                      <h5 class="fw-bold"><?php echo $gnt['title'] ?></h5>
                                                      <span><?php echo $gnt['description'] ?></span>
                                                  </div>
                                                  <div class="col-md-2">
                                                      <h5><?php echo date('d-m-Y',strtotime($gnt['created_at']))." - ".date('h:i a',strtotime($gnt['created_at'])) ?></h5>
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
                                echo "No Notifications";
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

