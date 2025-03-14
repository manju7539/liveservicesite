<?php
      $i = 1;
      
      $admin_id = $this->session->userdata('u_id');
      
      if($facility_list)
      {
      
         foreach($facility_list as $fl)
         {
      
            $total_cat = $this->MainModel->get_food_category($admin_id,$fl['food_facility_id']);
      ?>
   <tr>
      <td>
         <?php echo $i++ ?>
      </td>
      <td>
         <?php echo $fl['facility_name']?>
      </td>
      <td>
      
         <a href="#"><button type="button" class="btn shadow btn-xs btn-warning category_count_btn" food_cat_data__id="<?php echo $fl['food_facility_id']?>"><?php echo count($total_cat)?></button></a>
      </td>
   </tr>
   <?php
      }
      }
      ?>