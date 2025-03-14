<?php 
                                       if(!empty($get_dirty_rooms))
                                       {
                                           foreach($get_dirty_rooms as $g)
                                           {
                                              
                                       ?>
                                       <div class="room_card card open_model" data-bs-toggle="modal" id="edit_data5"
                                                    data-id="<?php echo  $g['room_status_id']?>" data-bs-target=".add_dirty_modal">
                                           </div>
                                    <?php 
                                       }
                                       }
                                       ?>