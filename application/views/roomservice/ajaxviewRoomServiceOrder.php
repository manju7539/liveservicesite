
<?php 

if(!empty($list))
{
    $i=1;
    foreach($list as $l)
    {  $where1 = '(u_id ="'.$l['u_id'].'")';
        $get_guest_type = $this->MainModel->getData('register',$where1);
        // print_r( $get_guest_name );
        if(!empty($get_guest_type))
        {
            $get_guest_typee = $get_guest_type['guest_type'];
            $mobile_n = $get_guest_type['mobile_no'];
        }
        else
        {
            $get_guest_typee = '';
            $mobile_n='';
        } 

    //get guest name
    $where1 = '(u_id ="'.$l['u_id'].'")';
    $get_guest_name = $this->MainModel->getData('register',$where1);
    if(!empty($get_guest_name))
    {
        $guest_name = $get_guest_name['full_name'];
    }
    else
    {
        $guest_name = '';
    } 
       $where = '(booking_id ="'.$l['booking_id'].'")';
     $get_room = $this->MainModel->getData('user_hotel_booking_details',$where);
     if(!empty($get_room))
     {
         $room_no_data = $get_room['room_no'];
     }
     else
     {
         $room_no_data = '';
     }
     $user_id = $this->session->userdata('u_id');
     $wh_h_id = '(u_id = "'.$user_id.'")';
     $get_user_data = $this->MainModel->getData('register',$wh_h_id);
     $hotel_id = $get_user_data['hotel_id'];
   //get room number  
    $r_c_id = '';
    $rm_floor = '';
    $r_no = '';
    $booking_id = '';
  
      $wh_rm_no_s1 = '(booking_id ="'.$l['booking_id'].'" AND hotel_id ="'.$hotel_id.'")';
    $get_rm_no_s1 = $this->MainModel->getData('user_hotel_booking',$wh_rm_no_s1);
    if(!empty($get_rm_no_s1))
    {
      $booking_id = $get_rm_no_s1['booking_id'];
    }
  
    $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
    $get_rm_no_s = $this->MainModel->getData('user_hotel_booking_details',$wh_rm_no_s);
    if(!empty($get_rm_no_s))
    {
      $r_no = $get_rm_no_s['room_no'];
    }
  
    $wh1 = '(room_no ="'.$r_no.'" AND hotel_id ="'.$hotel_id.'")';
    $g_rm_number = $this->MainModel->getData('room_nos',$wh1);
    if(!empty($g_rm_number))
    {
      $r_c_id = $g_rm_number['room_configure_id'];
    }

    $wh2 = '(room_configure_id  ="'.$r_c_id.'" AND hotel_id ="'.$hotel_id.'")';
    $g_rm_confug = $this->MainModel->getData('room_configure',$wh2);
    if(!empty($g_rm_confug))
    {
      $rm_floor = $g_rm_confug['floor_id'];
    }

    $wh3 = '(floor_id ="'.$rm_floor.'" AND hotel_id ="'.$hotel_id.'")';
    $g_rm_floors = $this->MainModel->getData('floors',$wh3);
    if(!empty($g_rm_floors))
    {
      $floor_no = $g_rm_floors['floor'];
    }
    else
    {
      $floor_no = '';
    }
        ?>
<tr>
<td>
<h5><?php echo $i;?><h5></td>
<td><h5><?php echo $l['rmservice_services_order_id'];?></h5></td>

<td>

<h5><?php echo $floor_no;?></h5>
</td>

<?php 
 
 if($l['order_from'] == 1)
 {
    $order_type = 'On Call';
 }
 elseif($l['order_from'] == 2)
 {
    $order_type = 'From Staff';
 }
 elseif($l['order_from'] == 3)
 {
    $order_type = 'App';
 }
  else{
        $order_type = '-';

    }
?>
<td><h5><?php echo $order_type;?></h5></td>  
<td>
<h5><?php echo $l['order_date'];?></h5>
</td>
<td>
<h5>
    <div class="room-list-bx">
        <div>
            <span class=" fs-16 font-w500 ">
                <?php echo $room_no_data ;?></span>
        </div>
    </div>
    <h5>
</td>
<td>
<h5><?php echo $guest_name?></h5>
</td>
<td><a href="#"
    class="btn btn-secondary shadow btn-xs sharp me-1"
    data-bs-toggle="modal"
    data-bs-target=".bd-example-modal-lg_<?php echo $l['rmservice_services_order_id'];?>"><i
        class="fa fa-eye"></i></a>

</td>

<td>
<h5><?php

if($get_guest_typee == 1)
{
echo"Regular";

}
elseif($get_guest_typee== 2)
{
echo "VIP";
}
elseif($get_guest_typee == 3)
{
echo "Complete House Guest";
}
elseif($get_guest_typee== 4)
{
echo "WHC";
}
else{
echo"-";

}
?></span></h5>
</td>
     <td>
<div>
    <a href="#">
        <div class="badge badge-info" data-bs-toggle="modal"
            data-bs-target=".order_desc_<?php echo $l['rmservice_services_order_id']?>">
            view</div>
    </a>
</div>
</td>
<td>
<h5> <?php echo $mobile_n;?></span></h5>
</td>

<!-- <td>
<a href="#" class="btn btn-warning shadow btn-xs sharp "><i
        class="fa fa-share" data-bs-toggle="modal"
        data-bs-target="#exampleModalCenter"></i></a>
</td> -->
<td>
<a href="#" class="btn btn-warning btn-xs sharp me-1"
    data-bs-toggle="modal"
    data-bs-target=".status_<?php echo $l['rmservice_services_order_id']?>"><i
        class="fa fa-share"></i></a>
</td>
</tr>
<script>
                                            
    document.getElementById('delete_<?php //echo $s['city_id'] ?>').onclick = function() {
    var id='<?php //echo $s['city_id'] ?>';
    var base_url='<?php echo base_url();?>';
    swal({
    
            
            title: "Are you sure?",
            text: "You will not be able to recover this Staff!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
        
            if (isConfirm) {
                $.ajax({
                    url:base_url+"HomeController/delete_staff", 
                    
                    type: "post",
                    data: {id:id},
                    dataType:"HTML",
                    success: function (data) {
                        if(data==1){
                        swal(
                                "Deleted!",
                                "Your  staff has been deleted!",
                                "success");
                            }
                        $('.confirm').click(function()
                                                    {
                                                            location.reload();
                                                        });
                    }

                    
                    });                                                                                                           
                                
            } else {
                swal(
                    "Cancelled",
                    "Your  staff is safe !",
                    "error"
                );
            }
        });
};
                                        </script>
    <!-- modal popup for edit  -->

<!-- end of modal  -->
<?php $i++; }  } ?>