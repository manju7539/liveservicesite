<?php

$i = 1;
if($list)
{
    foreach($list as $vis) 
    {
        $user_data = $this->HotelAdminModel->get_user_data($vis['u_id']);

        if($user_data)
        {

?>
        <tr>
            <td><strong><?php echo $i++?></strong></td>
            <td><?php echo $vis['visitor_name']?></td>
            <td><?php echo $vis['no_of_visitor']?></td>
            <td><?php echo $vis['visit_date']?></td>
            <td><?php echo date('h:i a',strtotime($vis['visit_time']))?></td>
            <td><?php echo $user_data['mobile_no']?></td>
            <td><?php echo $user_data['full_name']?></td>
            <td><?php echo $vis['room_no']?></td>
            <td>
                <?php
                    if($vis['is_otp_verified'] == 0)
                    {
                        
                ?>
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data1" data-bs-toggle="modal" data-id="<?= $vis['visitor_id']?>" data-bs-target=".update_faq_modal"><i class="fa fa-unlock-alt text-white"></i></a> 

                <?php
                    }
                    else
                    {
                        if($vis['is_otp_verified'] == 1 && $vis['is_otp_correct'] == 1)
                        {
                ?>
                            <span class="badge badge-success">Success</span>
                <?php
                        }
                        else
                        {
                            if($vis['is_otp_verified'] == 2 && $vis['is_otp_correct'] == 2)
                            {
                ?>
                                <!-- <span class="badge badge-danger" data-bs-toggle="modal"
                                    data-bs-target=".bd-example-modal-lg_<?php echo $vis['visitor_id']?>">Fail</span> -->
                                    <span  class="badge badge-danger" id="edit_data1" data-bs-toggle="modal" data-id="<?= $vis['visitor_id']?>" data-bs-target=".update_faq_modal">Fail</span> 
                <?php
                            }
                        }
                    }
                ?>
                <!-- edit modal -->
              
                <!--  -->
            </td>
        </tr>
<?php
        }
    }
}

  ?>