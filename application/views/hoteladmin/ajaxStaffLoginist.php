<?php

$i = 1;
if($staff_list)
{
    foreach($staff_list as $st)
    {
        
        if($st['profile_photo'])
        {
            $profile_photo = $st['profile_photo'];
        }
        else
        {
            $profile_photo = base_url().'assets/upload/blank_img/blankpic.jpg';
        }

        $user_type = "";
        //user type
        if($st['user_type'] == 8)
        {
            $user_type = "Foods And Beverages";
        }
        else
        {
            if($st['user_type'] == 9)
            {
                $user_type = "House keeping";
            }
            else
            {
                if($st['user_type'] == 10)
                {
                    $user_type = "Room Service";
                }
            }
        }

        $shift_type = "";
        //shift time
        if($st['shift_type'] == 1)
        {
            $shift_type = "Morning";
        }
        else
        {
            if($st['shift_type'] == 2)
            {
                $shift_type = "General";
            }
            else
            {
                if($st['shift_type'] == 3)
                {
                    $shift_type = "Night";
                }
            }
        }
?>

<tr>
    <td><?php echo $i++ ?></td>
    <td>
        <div class="lightgallery">
            <a href="<?php echo $profile_photo ?>" data-exthumbimage="<?php echo $profile_photo ?>" data-src="<?php echo $profile_photo ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">

                <img src="<?php echo $profile_photo ?>" class="img-thumbnail" style="height: 35px;box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
            </a>
        </div>
    </td>
    <td><?php echo $user_type?></td>
    <td>
        <span class="w-space-no"><?php echo $st['full_name'] ?></span>
    </td>
<!-- <td><?php echo $st['password_text'] ?></td>-->
    <td><?php echo $st['email_id'] ?></td>
    <td><?php echo $st['mobile_no'] ?></td>
    <td><?php echo $shift_type?></td>
    <td><?php echo date('h:i a',strtotime($st['shift_start_time'])) ?> to <?php echo date('h:i a',strtotime($st['shift_end_time'])) ?></td>
    <!-- <td>
        <a href="<?php //echo base_url('access_frontOffice') ?>" class="badge badge-rounded badge-secondary"><i class="fa fa-check"></i>
        </a>
    </td> -->

    <!--<td>
        <div class="lightgallery">
            <a href="<?php echo $st['Id_proff_photo'] ?>" data-exthumbimage="<?php echo $st['Id_proff_photo'] ?>" data-src="assets/dist/images/aadhar.jpg" class="col-lg-3 col-md-6 mb-4">
                <img src="<?php echo $st['Id_proff_photo'] ?>" alt="" style="width:50px;">
            </a>
        </div>
    </td>-->
<td><?php echo $st['password_text'] ?></td>
    <td> 
        <select class="default-select form-control wide" id="status_<?php echo $st['u_id'] ?>" onchange="change_status(<?php echo $st['u_id'] ?>)" >
            <option <?php if($st['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
            <option <?php if($st['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
        </select>
    </td>
    </td>
    <td>
    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $st['u_id']?>" ><i class="fa fa-trash"></i></a> 
    </td>
</tr>
<?php
    }
}
?>
