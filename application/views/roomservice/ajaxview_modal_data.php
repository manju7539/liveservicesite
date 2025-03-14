<?php  
    if(!empty($get_h_orders_data)){
        $i=1;
        foreach($get_h_orders_data as $g1)
        {
            //print_r($g1);
            $wh11 = '(room_serv_menu_id ="'.$g1['room_serv_menu_id'].'")';
            $menu_namee = $this->MainModel->getData('room_serv_menu_list',$wh11); 
            
            $wh11 = '(room_servs_category_id ="'.$g1['room_service_cat_id'].'")';
            $category_namee = $this->MainModel->getData('room_servs_category',$wh11); 

            if(!empty($menu_namee))
            {
                $menu_name = $menu_namee['menu_name'];
                $amount = $menu_namee['price'] * $g1['quantity'];
                $image = $menu_namee['image'];
            }
            else
            {
                $menu_name ='';
                $amount = '0';
                $image ='-';
            }

            if(!empty($category_namee))
            {
                $category_name = $category_namee['category_name'];
            }
            else
            {
                $category_name ='-';
            }
?>
    <tr>  
        <td><h5><?php echo $i; ?></h5></td>
        <td>
            <h5 class=""> <?php echo $category_name; ?></h5>
            </td>
        <td>
            <div class="lightgallery" class="room-list-bx d-flex align-items-center">
                <a href="<?php echo $image; ?>" data-exthumbimage="<?php echo $image; ?>" data-src="<?php echo $image; ?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6"><img class="me-3  " src="<?php echo $image; ?>" alt="" style="width:40px; height:40px;"></a>
            </div>
        </td>
        <td>
            <div>
                <h5 class=""><?php echo $menu_name ?></h5>
            </div>
        </td>
        <td>
            <div>
            <h5 class=""><?php echo $g1['quantity'] ?></h5>
            </div>
        </td>
        <td>
            <h5 class=""><?php echo $amount; ?></h5>
        </td>
    </tr>
<?php
            $i++;
        }
    } else
    {
?>
    <tr>
        <td colspan="12" style="color:red;text-align:center;font-size:14px" class="text-center">Data Not Available</td>
    </tr>
<?php }?>