<table class="table table-stripped text-center">
    <tbody>
        <?php 
            $i=1;
            foreach ($get_facility_category as $g) 
            {
        ?>
        <tr id="close_<?php echo $g['food_category_id'];?>">
            <th ><?php echo $i;?></th>
            <th contenteditable="true">
            <input type="hidden" value="<?php echo $g['food_category_id'];?>" class="delete_ids" name="food_category_id[]"> <!--food_category_id[]-->
            <input class="form-control text-center" value="<?php echo $g['category_name']?>" style="border: none;"  name="food_category_name[]"> 
            </th>
        <th>
            <span class="table-remove glyphicon glyphicon-remove category_delete" id="<?php echo $g['food_category_id'];?>"><i class="fa fa-trash"></i></span>
            <!-- <input type="hidden" name="deleted_ids[]" id="deleted_ids" value=""> -->
        </th>
        </tr>
        <?php
            $i++;
            }
        ?>
    </tbody>
</table>