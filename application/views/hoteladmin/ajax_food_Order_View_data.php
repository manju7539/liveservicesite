<?php
    $j = 1;
    if($fb_order_details)
    {
        foreach ($fb_order_details as $fb_o_d) 
        {
?>
<tr>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $j++?> </h5>
        </div>
    </td>
    <td>
        <div>
        <h5 class="text-nowrap">
            <?php echo $fb_o_d['items_name']?>
        </h5>
        </div>
    </td>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $fb_o_d['quantity']?> </h5>
        </div>
    </td>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $fb_o_d['price']?></h5>
        </div>
    </td>
    <td>
        <div>
        <h5 class="text-nowrap"><?php echo $fb_o_d['price'] * $fb_o_d['quantity']?></h5>
        </div>
    </td>
</tr>
<?php
        }
    }
?>