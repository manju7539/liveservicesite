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
        <a href="#"><button type="button" class="btn shadow btn-xs btn-warning category_count_btn" data-id="<?php echo $l['food_facility_id']?>"><?php echo $get[0]['total_count']?></button></a>
    </td>
</tr>                                               

<?php 
            $i++;   
        }
    }

?>