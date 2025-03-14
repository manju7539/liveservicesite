<?php
    $i = 1;
    
    if($list)
    {
    
        foreach($list as $f)
        {
?>
<tr>
    <td><strong><?php echo $i++ ?></strong></td>
    <td><?php echo $f['question'] ?></td>
    <td class="job-desk3">
        <p class="mb-0"><?php echo $f['answer'] ?></p>
    </td>
    <td>
        <select id="status_<?php echo $f['faq_id'] ?>" onchange="change_status(<?php echo $f['faq_id'] ?>)"
        class=" form-control "
        >
        <option <?php if($f['is_active'] == 1) { echo "Selected";}?> value="1">Active</option>
        <option <?php if($f['is_active'] == 0) { echo "Selected";}?> value="0">Deactive</option>
        </select>
    
    </td>
    <td>
        <div class="d-flex">
        
        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="<?= $f['faq_id']?>" data-bs-target=".update_faq_modal"><i class="fa fa-pencil"></i></a> 

        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $f['faq_id']?>" ><i class="fa fa-trash"></i></a>
        </div>
    </td>
    
</tr>
<?php
        }
    }
    
?>