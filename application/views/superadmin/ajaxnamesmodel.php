<table class="table table-stripped text-center">
               <tbody>
                  <?php 

                //   echo "<pre>";
                //   print_r($row);exit;
                     if($row[0]['send_for'] == 1 || $row[0]['send_for'] == 2){
                         $where1 = '(notification_id ="'.$row[0]['notification_id'].'" )';
                         $get_data1 = $this->MainModel->get_requestet_list_hotels('notifictions_u_id',$where1);
                                                  
                                                 $i=1;
                                                     foreach ($get_data1 as $g) 
                                                     {
                                                         $wh = '(u_id = "'.$g['user_id'].'")';
                                                         $hotel_name = $this->MainModel->getSingleData('register',$wh);
                                                         if(!empty($hotel_name))
                                                     {
                                                         $hotel_name = $hotel_name['hotel_name'];
                     
                     
                                                     }
                                                     else
                                                     {
                                                         $hotel_name = "-";
                                                     }
                                                 ?>
                  <tr>
                     <th><?php echo $hotel_name?></th>
                  </tr>
                  <?php
                     $i++;
                     }
                     }
                     
                     elseif($row[0]['send_for'] == 3 || $row[0]['send_for'] == 4){
                     $where1 = '(notification_id ="'.$row[0]['notification_id'].'" )';
                     $get_data2 = $this->MainModel->get_requestet_list_hotels('notifictions_u_id',$where1);
                     $i=1;
                     foreach ($get_data2 as $g) 
                     {
                     $wh = '(u_id = "'.$g['user_id'].'")';
                     $hotel_name = $this->MainModel->getSingleData('register',$wh);
                     if(!empty($hotel_name))
                     {
                     $full_name = $hotel_name['full_name'];
                     
                     
                     }
                     else
                     {
                     $full_name = "-";
                     }
                     ?>
                  <tr>
                     <th><?php echo $full_name?></th>
                  </tr>
                  <?php
                     $i++;
                     }
                     }
                     
                     
                     elseif($row[0]['send_for'] == 5){
                     $where1 = '(notification_id ="'.$row[0]['notification_id'].'" )';
                     $get_data3 = $this->MainModel->get_requestet_list_hotels('notifictions_u_id',$where1);
                     $i=1;
                     foreach ($get_data3 as $g) 
                     {
                     $wh = '(u_id = "'.$g['user_id'].'")';
                     $hotel_name = $this->MainModel->getSingleData('register',$wh);
                     if(!empty($hotel_name))
                     {
                     $wh = '(city_id = "'.$hotel_name['city'].'")';
                     $cities = $this->MainModel->getSingleData('city',$wh);
                     if(!empty($cities))
                     {
                     $location = $cities['city'];
                     }
                     }
                     else
                     {
                     $location = "-";
                     }
                     ?>
                  <tr>
                     <th><?php echo $location?></th>
                  </tr>
                  <?php
                     $i++;
                     }
                     }
                     
                     
                     
                                 ?>
               </tbody>
            </table>