<?php 
                                       if(!empty($get_available_rooms))
                                       {
                                           foreach($get_available_rooms as $a_room)
                                           {
                                             
                                       
                                       ?>
                                    <div class="room_card card yellow">
                                       <span class="room_no "><?php echo $a_room['room_no']?></span>
                                    </div>
                                    <?php 
                                       }
                                       }
                                       ?>