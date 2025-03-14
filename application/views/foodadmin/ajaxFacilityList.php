<?php 
                                        if(!empty($list)){
                                        $i=1;
                                        foreach($list as $l)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $i?></td>
                                            <td><?php echo $l['facility_name']?></td>
                                            <td> <img class="me-2 " src="<?php echo $l['icon']?>"
                                                alt="" style="width:100px;"></td>
                                            <td><?php echo $l['description']?></td>
                                            <td>
                                                <!-- <a href="javascript:void(0)" data-id="<?= $l['food_facility_id']?>" class="btn btn-tbl-edit btn-xs update_facility_modal">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a> -->
                                                <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $l['food_facility_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a>

                                                <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $l['food_facility_id']?>" ><i class="fa fa-trash"></i></a> 
                                            </td>
                                        </tr>
                                        <?php $i++; }  } 
                                    ?>