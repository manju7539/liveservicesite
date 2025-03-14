<?php 
    if(!empty($list))
    {
        $i=1;
        foreach($list as $l)
        {
            $where = '(food_facility_id ="'.$l['food_facility_id'].'")';
            $get = $this->MainModel->getCount_total_users('food_category',$where);
            
?>
<tr>
    <td><span><?php echo $i;?></span></td>
    <td><span><?php echo $l['facility_name'];?></span></td>
    <td>
    <a href="#" class="btn btn-warning shadow btn-xs sharp  btn-warning update_menu_modal_btn" id="edit_menu_data" data-bs-toggle="modal" data-id1="<?php echo $l['food_facility_id']?>"><?php echo $get[0]['total_count']?></a>
    </td>
</tr>                                               

<?php 
            $i++;   
        }
    }

?>