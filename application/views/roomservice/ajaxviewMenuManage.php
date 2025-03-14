<?php
    if($menu_list){
    $i = 1;
    
    foreach($menu_list as $row){
        
    //  print_r($row);die;
        if($row['time_in'] == 1)
        {
            $time_in = "Min";

        }
        elseif($row['time_in'] == 2)
        {
            $time_in = "Hrs";
        }
        else
        {
            $time_in ="-";
        }
?>
<tr>
    <td><h5><?php echo $i?></h5></td>
    <td><h5><?php echo $row['menu_name'];?></h5></td>
    <td><h5> <i class="fa fa-rupee"></i><?php echo $row['price'];?></h5></td>
    <td>
        <div class="lightgallery"
            class="room-list-bx d-flex align-items-center">
                <img class="me-3" src="<?php echo $row['image'];?>" alt="" style="width:40px; height:40px;">
        </div>
    </td>
    <td><h5><?php echo $row['prepartion_time'];
            if($row['time_in'] == 1)
            {
            echo "Min ";

            }
            elseif($row['time_in'] == 2)
            {
                echo "Hrs";
            }
            else{
                echo"-";

            }?>
            </h5>
    </td>
    <td><h5><?php echo $row['details'];?></h5></td>
    <td>
        <div class="d-flex">
            <!-- edit -->
            <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['room_serv_menu_id']?>" ><i class="fa fa-pencil"></i></a>
            <!-- Delete -->
            <a href="#"  data-delete-id="<?php echo $row['room_serv_menu_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>
        </div>
    </td>
</tr>
<?php
    $i++;
    }
    }
?>