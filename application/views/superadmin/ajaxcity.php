<?php 
    $i=1;
    foreach($get_city_list as $s)
    {
?>
        <tr>
            <td><?php echo $i?></td>
            <td><div class="align-items-center"><span class="w-space-no"><?php echo $s['city']?></span></div></td>
            <td>
                <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['city_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
            
                <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['city_id']?>" ><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
<?php $i++;  
    } 
?>

