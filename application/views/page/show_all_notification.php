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
        <!-- Start :: notifications for penal -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-body ">
                        <div class="col-lg-12 p-t-10">
                            <?php
                                $department_id = '';
                                if($userType == 7)
                                {
                                    $department_id = 4;
                                }
                                else
                                {
                                    $department_id = 3;
                                }
                                if($get_rs_notifications)
                                {
                                    foreach($get_rs_notifications as $rs_nt)
                                    {
                                        $wh = '(notification_id = "'.$rs_nt['notification_id'].'" AND department_id = "'.$department_id.'")';

                                        $notifictions_department_id = $this->MainModel->getAllData1('notifictions_department_id',$wh);

                                        if($notifictions_department_id)
                                        {
                                            //                 echo "<pre>";
                                            // print_r($this->db->last_query());
                            ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                
                                                <h5 class="fw-bold"><?php echo $rs_nt['title']?></h5>
                                                <span><?php echo $rs_nt['description']?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <h5><?php echo date('d-m-Y - h:i A',strtotime($rs_nt['created_at']))?></h5>
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
                                    echo "Notifications not available";
                                }
                            ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End :: notifications for penal -->

        <!-- Start:: notifications for staff -->
        <?php
            if(!empty($get_staff_orders)){
        ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <!-- <div class="card-head">
                        <header>Modals Size </header>
                    </div> -->
                    <div class="card-body">
                        <div class="col-lg-12 p-t-10">
                            <?php
                                if($get_staff_orders)
                                {
                                    foreach($get_staff_orders as $st_o)
                                    {
                                        // echo "<pre>";
                                        //     print_r($this->db->last_query());
                            ?>
                            <div class="card ad_<?php echo $st_o['notification_id']?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4 class="fw-bold">
                                            Room No:<?php echo $st_o['room_no']?>
                                            </h4>
                                            <h5 class="fw-bold">Subject</h5>
                                            <span><?php echo $st_o['title']?></span>
                                            <span><?php echo $st_o['description']?></span>
                                            <div class="mt-2 d-flex">
                                            <!-- <button style="padding: 8px;"  class="btn btn-success css_btn">Accept -->
                                            <button id="accept_notice" data-id="<?php echo $st_o['notification_id']?>" style="padding: 8px;" class="btn btn-success css_btn"  name="order_status">Accept</button>&nbsp;

                                            <button id="reject_notice" data-id="<?php echo $st_o['notification_id']?>" style="padding: 8px;"class="btn btn-danger css_btn"  name="order_status">Reject</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <!-- <h5><?php echo $st_o['date']?> - <?php echo $st_o['time']?></h5> -->
                                            <h5><?php echo $st_o['created_at']?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- End :: notifications for staff -->
    </div>
</div>

<!-- Start :: Accept notice modal -->
<div class="modal fade" id="accepted_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="accepted_form" method="post">
            <div class="modal-body">
                <input type="hidden" name="accep_id" id="accep_id" value="">
                <p> Are you sure you want to Assign order? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="accep_btn">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- End :: Accept notice modal -->
<!-- Start :: Reject notice modal -->
<div class="modal fade" id="Rejected_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="reject_form" method="post">
            <div class="modal-body">
            <input type="hidden" name="rejec_id" id="rejec_id" value="">
                <p> Are you sure you want to Reject order? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reject_btn">Save changes</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- End :: Reject notice modal -->

<script>
    // accept button
    $(document).on("click",'#accept_notice', function () {
        var data_id = $(this).attr('data-id');
        $('#accep_id').val(data_id);
        $("#accepted_Modal").modal('show');
    });  
    $(document).on("click",'#accep_btn', function () {
        var id = $('#accep_id').val();
        $.ajax({
            url         : '<?= base_url('RoomserviceController/assign_order') ?>',
            method      : 'POST',
            data        : { id : id},
            success     : function(res) {
                // console.log(res);
                $("#accepted_Modal").modal('hide');
                $('.ad_'+id).html('');
                // setTimeout(function(){  
                // //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);

                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
            }
        });
    });

    // Reject button
    $(document).on('click','#reject_notice', function () {
        var data_id = $(this).attr('data-id');
        $('#rejec_id').val(data_id);
        $("#Rejected_Modal").modal('show');
    });
    $(document).on("click",'#reject_btn', function (e) {
        e.preventDefault();
        var id = $('#rejec_id').val();
        $.ajax({
            url         : '<?= base_url('RoomserviceController/reject_order') ?>',
            method      : 'POST',
            data        : { id : id},
            success     : function(res) {
                $("#Rejected_Modal").modal('hide');
                $('.ad_'+id).html('');
                // setTimeout(function(){  
                // //  $(".append_data").html(res);
                //   $(".successmessage").show();
                //   }, 2000);

                // setTimeout(function(){  
                //     $(".successmessage").hide();
                //   }, 4000);
            }
        });
    });

    $(document).on("click",'.close_modal', function () {      
        $("#accepted_Modal").modal('hide');
        $("#Rejected_Modal").modal('hide');
    });
</script>