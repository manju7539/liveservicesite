<?php 
                                                        if(!empty($get_under_maintenance_rooms))
                                                        {
                                                            foreach($get_under_maintenance_rooms as $u_room)
                                                            {
  
                                                    ?>
                                                    <div class="room_card card main_rm open_under_model" data-bs-toggle="modal" id="data_edit"
                                                    data-id1="<?php echo $u_room['room_status_id']?>" data-bs-target=".add_under_modal">
                                                        
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $u_room['room_no']?></span>
                                                    </div>
                                                    <?php 
                                                             }
                                                        }
                                                    ?>

                                                    