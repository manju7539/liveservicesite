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
        <!-- Start :: notifications 1 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                        <?php 
  									$admin_id = $this->session->userdata('u_id');

                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                    $hotel_id = $get_hotel_id['hotel_id']; 
                                    //$wh = '(department_id = 4)';
			                        $today_date = date('Y-m-d');
                                    $get_notification_data = $this->HouseKeepingModel->get_notifications_for_housekeeping($hotel_id,$today_date);
                                    if(!empty($get_notification_data))
                                    {  
                                        foreach($get_notification_data as $g)
                                        {
                                            $wh = '(notification_id = "'.$g['notification_id'].'" AND department_id = 5)';

                                            $notifictions_department_id = $this->HouseKeepingModel->getAllData1('notifictions_department_id',$wh);

                                            if($notifictions_department_id)
                                          	{ 
                            ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5 class="fw-bold"><?php echo $g['title']?></h5>
                                                <span><?php echo $g['description']?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <h5><?php echo date('d-m-Y',strtotime($g['created_at']))." - ".date('h:i a',strtotime($g['created_at'])) ?></h5>
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
                                echo "Data Not Available";
                            }
                        ?>
                        <?php

// if(!empty($get_staff_orders))
// {
//     foreach($get_staff_orders as $st_o)
//     {
//           $wh = '(notification_id = "'.$st_o['notification_id'].'" AND department_id = 5)';

//           $notifictions_department_id = $this->HouseKeepingModel->getAllData1('notifictions_department_id',$wh);

//           if($notifictions_department_id)
//             { 
?>
<!-- <div class="card">                          		
                                <div class="card-body">
                                  
                                    <div class="row">      
                                        <div class="col-md-10">
                                          
                                             <h5 class="fw-bold">Room No.:<?php echo $st_o['room_no']?></h5>
                                            <h5 class="fw-bold">Subject</h5>
                                            <span><?php echo $st_o['description']?></span>
                                            <div class=" d-flex mt-2">
                                             <form method="post" action="HouseKeepingController/assign_order">
                                        <input type="hidden" name="notification_id" value="<?php echo $st_o['notification_id']?>" />
                                        <button type="submit"  onclick="return confirm('Are you sure you want to Assign order');"   style="padding: 8px;"  class="btn btn-success css_btn"  name="order_status">Accept</button>
                                    </form> &nbsp;
                                    <form method="post" action="MainController/reject_order">
                                        <input type="hidden" name="notification_id" value="<?php echo $st_o['notification_id']?>" />
                                        <button type="submit"  onclick="return confirm('Are you sure you want to Reject order');"   style="padding: 8px;"class="btn btn-danger css_btn"  name="order_status">Reject</button>
                                    </form>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <h5><?php echo $st_o['created_at']?></h5>
                                        </div>
                                    </div>                                 
                                </div>                           		
                              </div> -->
                      			
							<?php
                                    //         }
                                    //     }
                                    // }
                                    // else
                                    // {
                                    //     echo "Notifications not available";
                                    // }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

