<?php
    $i=1;
    foreach ($get_f_orders_data as $g1) 
    {
        $wh11 = '(food_item_id ="'.$g1['food_items_id'].'")';
        $get_menu_name = $this->MainModel->getData('food_menus', $wh11);
?>
<tr>
    <td><?php echo $i;?></td>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $get_menu_name['items_name']?></h5>
        </div>
    </td>
    <td>
        <div>
            <h5 class="text-nowrap"><?php echo $g1['quantity']?></h5>
        </div>
    </td>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $get_menu_name['price']?></h5>
        </div>
    </td>
</tr>
<?php
    $i++;
    }
?>