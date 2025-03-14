<?php
    if($edited_data){
            $i = 1;
            foreach($edited_data as $row){ ?>
    <tr>
        <td><h5><?php echo $i?></h5></td>
        <td>
            <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                <a href="" data-exthumbimage="" data-src="" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                    <img class="me-3" src="<?php echo $row['icon_img'];?>" alt="" style="width:40px; height:40px;">
                </a>
            </div>
        </td>
        <td><h5><?php echo $row['item_name'];?></h5></td>  
        <td><h5><?php echo $row['price'];?></h5></td>  
        <td><h5><?php echo $row['description'];?></h5></td>
        <td>
            <div class="">
                <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['r_s_min_bar_id']?>"><i class="fa fa-pencil"></i></a>
            
                <!-- <a href="#" id="delete_<?php echo $row['r_s_min_bar_id']?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> -->
                <a href="#"  data-delete-id="<?php echo $row['r_s_min_bar_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>
            </div>
        </td>
    </tr>                                                    
    <?php
        $i++;
    } 
}
?>