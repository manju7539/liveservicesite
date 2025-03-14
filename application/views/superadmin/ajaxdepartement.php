
<?php

                                                             $i = 1;
                                                              foreach($departement as $row){?>
                                                  <tr>
        <td><?php echo $i?></td>
        <td><h5><img src="<?php echo $row['icon'];?>" alt="" style="width: 25px; height: 25px;"></h5></td>
        <td><div class="align-items-center"><span
                                    class="w-space-no"><?php echo $row['department_name']?></span></div></td>
     
         <td>
        
         <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $row['department_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

         <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $row['department_id']?>" ><i class="fa fa-trash"></i></a> 

    </td>

    </tr>
<!-- end of modal  -->
<?php $i++; }   ?>

