<div class="notification-list mail-list not-list small-slimscroll-style ajaxnotifications" style="height:620px">
    <?php
        if($get_front_ofs_notifications)
        {
        foreach($get_front_ofs_notifications as $f_nt)
        {
            // echo "<pre>";
            // print_r($f_nt);
            if(isset($f_nt['all_hotels_resent_not']))
            {
                if($f_nt['all_hotels_resent_not'] > 0)
                {
                    for ($x = 1; $x <= $f_nt['all_hotels_resent_not']; $x++)
                    {
                    ?>
                    <a href="javascript:;" class="single-mail"> <span class="icon bg-primary"> 
                        <i class="fa fa-user-o"></i>
                        </span> <span class="text-purple"><?php echo $f_nt['title'] ?></span>
                        <span class="notificationtime">
                            <small><?php echo date('m F Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?></small>
                        </span>
                    </a>
                    <?php  
                    }  
                } 
            } 
            if (isset($f_nt['specific_hotel_resent_not']))
            { 
                if($f_nt['specific_hotel_resent_not'] > 0)
                {
                    for ($x = 1; $x <= $f_nt['specific_hotel_resent_not']; $x++) 
                    {
                    ?>
                    <a href="javascript:;" class="single-mail"> <span class="icon bg-primary"> 
                        <i class="fa fa-user-o"></i>
                        </span> <span class="text-purple"><?php echo $f_nt['title'] ?></span>
                        <span class="notificationtime">
                            <small><?php echo date('m F Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?></small>
                        </span>
                    </a>
                    <?php 
                    } 
                } 
            }
            else 
            { 
                ?>
                    <a href="javascript:;" class="single-mail"> <span class="icon bg-primary"> 
                    <i class="fa fa-user-o"></i>
                    </span> <span class="text-purple"><?php echo $f_nt['title'] ?></span>
                    <span class="notificationtime">
                        <small><?php echo date('m F Y',strtotime($f_nt['created_at']))." - ".date('h:i a',strtotime($f_nt['created_at'])) ?></small>
                    </span>
                    </a>
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