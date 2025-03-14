<?php

                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $r_m)
                                        {
                                ?>
                                
                                    <tr>
                                        <td><strong><?php echo $i++ ?></strong></td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['room_type_name'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['price'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['lux_tax'] ?></span>
                                        </td>
                                        <td>
                                            <span class="w-space-no"><?php echo $r_m['serv_tax'] ?></span>
                                        </td>
                                        <td>
                                            <div class="lightgallery"
                                                class="room-list-bx d-flex align-items-center">
                                                <a href="<?php echo $r_m['images']?>" target="_blank"
                                                    data-exthumbimage="<?php echo $r_m['images']?>"
                                                    data-src="<?php echo $r_m['images']?>"
                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                    <img class="me-3 "
                                                        src="<?php echo $r_m['images']?>"
                                                        alt="" style="width:50px; height:40px;">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-warning shadow btn-xs sharp me-1"
                                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg_<?php //echo $r_m['room_type_id'] ?>"><i
                                                    class="fa fa-pencil"></i></a> -->

                                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_roomtype_data" data-bs-toggle="modal" data-id="<?= $r_m['room_type_id']?>" data-bs-target=".update_roomtype_modal"><i class="fa fa-pencil"></i></a>
                                          
                                                    <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_room" delete-id-room="<?= $r_m['room_type_id']?>" ><i class="fa fa-trash"></i></a> 
                                                   
                                        </td>
                                    </tr>
                                <?php
                                        }
                                    }
									
                                    ?>