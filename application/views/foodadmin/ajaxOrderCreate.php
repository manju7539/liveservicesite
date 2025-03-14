 <?php 
    if(!empty($list)){
        $i=1;
        foreach($list as $l)
        {
       ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $l['facility_name']?></td>
            <td> <img class="me-2 " src="<?php echo $l['icon']?>"
                alt="" style="width:100px;"></td>
            <td><?php echo $l['description']?></td>
            <td>
             <a href="javascript:void(0)" data-id="<?= $l['food_facility_id']?>" class="btn btn-tbl-edit btn-xs update_facility_modal">
                                <i class="fa fa-pencil"></i>
                            </a>
           <button class="btn btn-tbl-delete btn-xs">
                                <i class="fa fa-trash-o "></i>
                            </button>
            </td>
          
        </tr>
    <?php $i++; }  } ?>