<?php 
                                       if(!empty($get_dirty_rooms))
                                       {
                                           foreach($get_dirty_rooms as $g)
                                           {
                                              
                                       ?>
                                      <div class="room_card card red open_model" data-bs-toggle="modal" id="edit_data5" 
                                                    data-id="<?php echo $g['room_status_id']?>"
                                                        data-bs-target=".add_dirty_modal">
                                                        <span class="room_no ">
                                                        
                                                        <?php echo $g['room_no']?></span>
                                                    </div>
                                    <?php 
                                       }
                                       }
                                       ?>