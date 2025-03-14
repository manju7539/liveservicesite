<?php
   $i = 1;
   if($room_type_list)
   {
       foreach($room_type_list as $list)
       {
   ?>
<tr>
   <td>
      <?php echo $i?>
   </td>
   <td>
      <h5>
         <?php echo $list['room_type_name'] ?>
      </h5>
   </td>
   <td>
      <h5>
         <?php echo $list['price'] ?>
      </h5>
   </td>
   <td>
      <h5>
         <?php echo $list['lux_tax'] ?>
      </h5>
   </td>
   <td>
      <h5>
         <?php echo $list['serv_tax'] ?>
      </h5>
   </td>
   <td>
      <div class="lightgallery"
         class="room-list-bx d-flex align-items-center">
         <a href="<?php echo $list['images']?>" target="_blank"
            data-exthumbimage="<?php echo $list['images']?>"
            data-src="<?php echo $list['images']?>"
            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
         <img class="me-3  "
            src="<?php echo $list['images'];?>" alt=""
            style="width:40px; height:40px;">
         </a>
      </div>
   </td>
   <td>
      <div>
         <!-- <a href="#" class="btn btn-warning shadow btn-xs sharp me-1"
            data-bs-toggle="modal"
            data-bs-target=".bd-example-modal-lg_<?php echo $list['room_type_id'] ?>"><i
                class="fa fa-pencil"></i></a> -->
         <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?php echo $list['room_type_id'] ?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a>
         <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $list['room_type_id']?>" ><i class="fa fa-trash"></i></a>  
      </div>
   </td>
</tr>
<!--dlt script start-->                                                               
<!--end dlt script-->  
<?php
   $i++;
   }
   }
   ?>