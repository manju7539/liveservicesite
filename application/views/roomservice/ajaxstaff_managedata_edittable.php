<?php
    if($edited_data)
    {
                $i = 1;
                foreach($edited_data as $row){
                
                $where ='(city_id="'.$row['city'].'")';
                $user_d = $this->MainModel->getData($tbl='city',$where);
                if(!empty($user_d))
                {
                    $city = $user_d['city'];
                }
                else
                {
                    $city ='';
                }
?>
    <tr>
        <td><h5><?php echo $i?></h5></td>
        <td>
            <div class="concierge-bx">
                <img class="me-3 rounded"
                    src="<?php echo $row['profile_photo']?>"
                    alt="" class="img-fluid">
                <div>
        </td>
        <td><h5><?php echo $row['full_name'];?></h5></td>
        <td><h5><?php echo $row['mobile_no'];?></h5></td>
        <td><h5><?php echo $row['email_id'];?></h5></td>
        <td><h5><?php echo $row['address'];?></h5></td>
        <td>
            <div class="lightgallery">
                <a href="" data-exthumbimage="<?php echo $row['Id_proff_photo']?>" data-src="<?php echo $row['Id_proff_photo']?>" class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                    <img class="me-3  " src="<?php echo $row['Id_proff_photo']?>" alt="" style="width:30px; height:40px;">
                </a>
            </div>
        </td>                          
        <input type="hidden" name="user_id" id="uid<?php echo $row['u_id'];?>" value="<?php echo $row['u_id'];?>">
        <td>                                                                  
            <select class="nice-select default-select form-control wide" name="is_active" id="active<?php echo $row['u_id'];?>" onchange="change_status(<?php echo $row['u_id']?>);">
                <?php  if($row['is_active']=="1")  { ?>
                    <option value=" 1" selected>Active</option>
                    <option value="0">Deactive</option>
                <?php   }
                    if($row['is_active']=="0") {   ?>
                    <option value="1">Active</option>
                    <option value="0" selected>Deactive</option>
                <?php 
                    } 
                ?>
            </select>
        </td>
        <td>
            <div class="">
                <!-- view button -->
                <a href="<?php echo base_url('staff_history/').$row['u_id']?>" id="" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>

                <!-- edit button -->
                <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['u_id']?>" ><i class="fa fa-pencil"></i></a>

                <!-- Delete button -->
                <a href="#"  data-delete-id="<?php echo $row['u_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>
            </div>
        </td>
    </tr>                                        
<?php
        $i++;
    } 
}  ?>