<?php
                                                $i = 1;
                                                if($panel_admin_list)
                                                {
                                                    foreach($panel_admin_list as $p_ad)
                                                    {
                                                        
                                                        if($p_ad['profile_photo'])
                                                        {
                                                            $profile_photo = $p_ad['profile_photo'];
                                                        }
                                                        else
                                                        {
                                                            $profile_photo = base_url().'assets/upload/blank_img/blankpic.jpg';
                                                        }
                                                
                                                        $user_type = "";
                                                        //user type
                                                        if($p_ad['user_type'] == 3)
                                                        {
                                                            $user_type = "Front Office";
                                                        }
                                                        else
                                                        {
                                                            if($p_ad['user_type'] == 5)
                                                            {
                                                                $user_type = "House keeping";
                                                            }
                                                            else
                                                            {
                                                                if($p_ad['user_type'] == 6)
                                                                {
                                                                    $user_type = "Room Service";
                                                                }
                                                                else
                                                                {
                                                                    if($p_ad['user_type'] == 7)
                                                                    {
                                                                        $user_type = "Foods and Beverage";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                
                                                        $shift_type = "";
                                                        //shift time
                                                        if($p_ad['shift_type'] == 1)
                                                        {
                                                            $shift_type = "Morning";
                                                        }
                                                        else
                                                        {
                                                            if($p_ad['shift_type'] == 2)
                                                            {
                                                                $shift_type = "General";
                                                            }
                                                            else
                                                            {
                                                                if($p_ad['shift_type'] == 3)
                                                                {
                                                                    $shift_type = "Night";
                                                                }
                                                            }
                                                        }
                                                ?>
                                             <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td>
                                                   <div class="lightgallery">
                                                      <a href="<?php echo $profile_photo ?>" data-exthumbimage="<?php echo $profile_photo ?>" data-src="assets/dist/images/tab/staff.png" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                      <img src="<?php echo $profile_photo ?>" class="img-thumbnail" style="height: 35px;box-shadow: rgba(0, 0, 0, 0.2) 0px 12px 28px 0px, rgba(0, 0, 0, 0.1) 0px 2px 4px 0px, rgba(255, 255, 255, 0.05) 0px 0px 0px 1px inset;">
                                                      </a>
                                                   </div>
                                                </td>
                                                <td><?php echo $user_type?></td>
                                                <td>
                                                   <span class="w-space-no"><?php echo $p_ad['full_name'] ?></span>
                                                </td>
                                                <!--<td><?php echo $p_ad['password_text'] ?></td>-->
                                                <td><?php echo $p_ad['email_id'] ?></td>
                                                <td><?php echo $p_ad['mobile_no'] ?></td>
                                                <td><?php echo $shift_type?></td>
                                                <td><?php echo date('h:i a',strtotime($p_ad['shift_start_time'])) ?> to <?php echo date('h:i a',strtotime($p_ad['shift_end_time'])) ?></td>
                                                <td>
                                                   <?php
                                                      if($p_ad['user_type'] == 3)
                                                      {
                                                          $user_type = "Front Office";
                                                      ?>
                                                 
                                                   <a href="#" class="badge badge-rounded badge-secondary booking_id" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 5)
                                                          {
                                                              $user_type = "House keeping";
                                                      ?>
                                                    <a href="#" class="badge badge-rounded badge-secondary booking_id1" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view1"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 6)
                                                          {
                                                              $user_type = "Room Service";
                                                      ?>
                                                   
                                                   <a href="#" class="badge badge-rounded badge-secondary booking_id2" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view2"><i class="fa fa-check"></i></a>
                                                   <?php
                                                      }
                                                      else
                                                      {
                                                          if($p_ad['user_type'] == 7)
                                                          {
                                                              $user_type = "Foods and Beverage";
                                                      ?>
                                                       <a href="#" class="badge badge-rounded badge-secondary booking_id3" data-bs-toggle="modal" u-id1=<?= $p_ad['u_id']?> data-bs-target=".bd-view-modal-customer-view3"><i class="fa fa-check"></i></a>
                                                   <!-- <a href="<?php //echo base_url('HoteladminController/access_food/'.$p_ad['u_id']) ?>" class="badge badge-rounded badge-secondary"><i class="fa fa-check"></i></a> -->
                                                   <?php
                                                      }
                                                      }
                                                      }
                                                      }
                                                      ?>
                                                </td>
                                               <!-- <td>
                                                   <div class="lightgallery">
                                                      <a href="<?php echo $p_ad['Id_proff_photo'] ?>" data-exthumbimage="<?php echo $p_ad['Id_proff_photo'] ?>" data-src="<?php echo $p_ad['Id_proff_photo'] ?>" class="col-lg-3 col-md-6 mb-4">
                                                      <img src="<?php echo $p_ad['Id_proff_photo'] ?>" alt="" style="width:50px;">
                                                      </a>
                                                   </div>
                                                </td>-->
                                               <td><?php echo $p_ad['password_text'] ?></td>
                                                <td>
                                                   <select class="default-select form-control wide" id="status_<?php echo $p_ad['u_id'] ?>" onchange="change_status(<?php echo $p_ad['u_id'] ?>)" >
                                                      <option <?php if($p_ad['is_active'] == 1){echo "Selected";}?> value="1">Active</option>
                                                      <option <?php if($p_ad['is_active'] == 0){echo "Selected";}?> value="0">Deactive</option>
                                                   </select>
                                                </td>
                                                <td>
                                                   <a href="#" onclick="delete_data(<?php echo $p_ad['u_id'] ?>)" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                </td>
                                             </tr>
                                             <?php
                                                }
                                                }
                                                ?>
                                                <script>

$(document).on('click', '.booking_id', function(){
       
    var uid1= $(this).attr('u-id1');
        $.ajax({
            url         : '<?= base_url('HoteladminController/access_frontOffice') ?>',
            type      : 'POST',
            data        : {u_id1: uid1},
            success     : function(res) {
                console.log(res);

                $('.customer_view').html(res);  
            }
            
        });
    });


    $(document).on('click', '.booking_id1', function(){
       
        var uid1= $(this).attr('u-id1');
      $.ajax({
           url         : '<?= base_url('HoteladminController/access_housekeeping') ?>',
           type      : 'POST',
           data        : {u_id1: uid1},
           
           success     : function(res) {
               console.log(res);

               $('.customer_view1').html(res);
           }
           
       });
   });

   $(document).on('click', '.booking_id2', function(){
       
       var uid1= $(this).attr('u-id1');
     $.ajax({
          url         : '<?= base_url('HoteladminController/access_room') ?>',
          type      : 'POST',
          data        : {u_id1: uid1},
          
          success     : function(res) {
              console.log(res);

              $('.customer_view2').html(res);
          }
          
      });
  });

  $(document).on('click', '.booking_id3', function(){
       
       var uid1= $(this).attr('u-id1');
     $.ajax({
          url         : '<?= base_url('HoteladminController/access_food') ?>',
          type      : 'POST',
          data        : {u_id1: uid1},
          
          success     : function(res) {
              console.log(res);

              $('.customer_view3').html(res);
          }
          
      });
  });
</script>