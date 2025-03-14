<div class="notification-list mail-list not-list small-slimscroll-style" style="height:620px">
    <?php
        if($get_front_ofs_notifications)
        {
            // echo "<pre>";print_r($get_front_ofs_notifications);die;
        foreach($get_front_ofs_notifications as $f_nt)
        {
        $wh = '(notification_id = "'.$f_nt['notification_id'].'" AND department_id = 2)';
        
        $notifictions_department_id = $this->FrontofficeModel->getAllData('notifictions_department_id',$wh);
        // print_r($notifictions_department_id);
        if($notifictions_department_id)
        {
        ?>
        <div class="row">
        <div class="col-2">
        <a href="javascript:;" class="single-mail"> 
            <span class="icon bg-primary"> 
                <i class="fa fa-user-o"></i> 
            </span>
        </a>
        </div>
        <div class="col-10 d-flex flex-column ">
            <span class="text-purple pt-1"><?php echo $f_nt['title'] ?>
            </span>
            <span class=""><?php echo $f_nt['description'] ?>
            </span>
            <span class="notificationtime">
                <small>
                    <?php echo date('d-m-Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?>
                </small>
            </span>
        </div>
        </div>
    <?php
        }
        }
        }
        else
        {
        echo "No Notifications Available";
        }
        ?>  
</div>