
<?php 
// print_r($service);exit;

if($service){
    $i = 1;
     foreach($service as $row){ 
        // print_r($row);exit;
        ?>
     
<tr>
<td><h5><?php echo $i?></h5></td>
<td><h5><?php echo $row['service_name'];?></h5></td>
<td>
   <div class="lightgallery">
       <a href=""
           data-exthumbimage="<?php echo $row['icon_img'];?>"
           data-src="<?php echo $row['icon_img'];?>"
           class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
           <img class="me-3  "
               src="<?php echo $row['icon_img'];?>" alt=""
               style="width:30px; height:40px;">
       </a>
   </div>
</td>
<td> <h5> <i class="fa fa-rupee"></i> <?php echo $row['amount'];?></h5></td>

<td>
   <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['r_s_services_id']?>"><i class="fa fa-pencil"></i></a>
   <!-- Delete -->
   <a href="#"  data-delete-id="<?php echo $row['r_s_services_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>
</td>
</tr>
<?php $i++; }  } ?>