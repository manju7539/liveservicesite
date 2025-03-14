<?php
                    $i = 1;
                    if(!empty($list))
                    {
                        foreach($list as $vis) 
                        {
                            $user_data = $this->FrontofficeModel->get_user_data($vis['u_id']);

                            if($user_data)
                            {
                    ?>
                    <tr>
                        <td><h5 id="check"><?php echo $i++?></h5></td>
                        <td><h5><?php echo $vis['visitor_name']?></h5></td>
                            <td><h5><?php echo $vis['no_of_visitor']?></h5></td>
                            <td><h5><?php echo date('d-m-Y',strtotime($vis['visit_date']))?></h5></td>
                            <td><h5><?php echo date('h:i a',strtotime($vis['visit_time']))?></h5></td>
                        <td><h5><?php echo $user_data['mobile_no']?></h5></td>
                        <td><h5><?php echo $user_data['full_name']?></h5></td>
                        <td><h5><?php echo $vis['room_no']?></td>
                        <td>
                            <?php
                                if($vis['is_otp_verified'] == 0)
                                {
                            ?>
                            
                                                   
                            <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 open_model"
                                    id="edit_data" data-bs-toggle="modal" data-id1="<?php echo $vis['visitor_id']?>"
                                     data-bs-target=".check_otp_modal"><i class="fa fa-unlock-alt text-white"></i></a>
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
                               <span class="badge badge-danger open_model"  id="edit_data" data-bs-toggle="modal" data-id1="<?php echo $vis['visitor_id']?>" data-bs-target=".check_otp_modal">Fail</span>
                            <?php
                                        }
                                    }
                                }
                            ?>
                         
                            <!--  -->
                        </td>
                    </tr>
                    <?php
                            }
                        }
                    } 
                ?>