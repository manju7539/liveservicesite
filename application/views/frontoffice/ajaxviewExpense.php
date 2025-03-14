<?php

$i = 1;
if($list)
{
    foreach($list as $exp)
    {
?>
    <tr>
    <td><h5><?php echo $i++?></h5></td>
    <td><h5><?php echo date('d-m-Y',strtotime($exp['date']))?></h5></td>
    <td><h5><?php echo $exp['guest_name']?></h5></td>
    <td><h5><?php echo $exp['mobile_no']?></h5></td>
  <td><h5><?php echo $exp['expense_amt']?> Rs</h5></td>

        <td>
            <a href="#"
                class="btn btn-secondary shadow btn-xs sharp me-1"
                data-bs-toggle="modal" id="edit_data" data-id="<?php echo $exp['expense_id'] ?>"
                data-bs-target=".bd-discription-modal-lg"><i
                    class="fa fa-eye"></i></a>
        </td>
        <td>
            <div>
            <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $exp['expense_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 

                <!-- <a href="#"
                    class="btn btn-warning shadow btn-xs sharp me-1"
                    data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-lg_<?php echo $exp['expense_id']?>"><i
                        class="fa fa-pencil"></i></a> -->
                        
               
                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $exp['expense_id']?>" ><i class="fa fa-trash"></i></a>  
            </div>
        </td>
    </tr>
      
<?php

}

}

?>