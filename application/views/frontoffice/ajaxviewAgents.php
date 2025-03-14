<?php
    $i = 1;
    if($agents_list)
    {
        foreach($agents_list as $list)
        {
    ?>

    <tr>

        <td>
        <?php echo $i?>
        </td>
        <td>
        <?php echo $list['name'] ?>
        </td>
        <td>
        <?php echo $list['email'] ?>
        </td>
        <td>
        <?php echo $list['phone'] ?>
        </td>
        <td>
        <?php echo $list['agency_name'] ?>
        </td>
        <td>
            <a href="#"
                class="btn btn-secondary shadow btn-xs sharp me-1"
                data-bs-toggle="modal" id="edit_data" 
                data-id="<?php echo $list['id'] ?>" 
                data-bs-target="#exampleModalCenter"><i
                    class="fa fa-eye"></i></a>

        </td>

                    <!-- modal for terms and conditions -->
                    <div class="modal fade" id="exampleModalCenter_<?php echo $list['id']?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Description</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $list['description']?></p>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
        <td>
            <div>
            <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" 
            data-bs-toggle="modal" id="edit_data" 
            data-id="<?php echo $list['id'] ?>" 
            data-bs-target=".update_modal"><i class="fa fa-pencil"></i></a> 

            <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $list['id']?>" ><i class="fa fa-trash"></i></a>  
            </div>
        </td>
   
    </tr>
                   
                                    
 
                          
                           <?php
                            $i++;
                              }
                            }
   ?>
                                