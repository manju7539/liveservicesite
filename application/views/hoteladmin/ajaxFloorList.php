<?php

                                    $i = 1;
                                    if($list)
                                    {
                                        foreach($list as $fl)
                                        {
                                ?>
                                
                                    <tr>
                                        <td><strong><?php echo $i++?></strong></td>
                                        <td>
                                            <span class="w-space-no"><?php echo $fl['floor'] ?></span>
                                        </td>
                                        <td>
                                           
                                                    <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="<?= $fl['floor_id']?>" data-bs-target=".update_floor_modal"><i class="fa fa-pencil"></i></a> 

                                            <!-- <a href="#" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fas fa-pencil-alt"></i></a> -->
                                            <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data_floor" delete-id-floor="<?= $fl['floor_id']?>" ><i class="fa fa-trash"></i></a> 
                                      
                                        <!-- edit modal -->
                                       
                                        </td>
                                        <!-- /. edit modal -->
                                    </tr>
                                <?php
                                        }
                                    }
									
                                    ?>