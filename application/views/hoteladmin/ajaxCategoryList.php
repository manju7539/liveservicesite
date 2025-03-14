<?php
                        $i = 1;
                        
                        $admin_id = $this->session->userdata('u_id');
                        
                        if($facility_list)
                        {
                        
                           foreach($facility_list as $fl)
                           {
                        
                              $where = '(food_facility_id ="'.$fl['food_facility_id'].'")';
                              $get = $this->MainModel->getCount_total_users('food_category',$where);
                        ?>
                     <tr>
                        <td>
                           <?php echo $i++ ?>
                        </td>
                        <td>
                           <?php echo $fl['facility_name']?>
                        </td>
                        <td>
                        
                        <a href="#"><button type="button" class="btn shadow btn-xs btn-warning category_count_btn" data-id="<?php echo $fl['food_facility_id']?>"><?php echo $get[0]['total_count']?></button></a>
                        </td>
                     </tr>
                     <?php
                        }
                        }
                        ?>