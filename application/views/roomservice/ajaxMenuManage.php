
<?php 

if($menu_list){
    $i = 1;
    
    foreach($menu_list as $row){
      
     
      if($row['time_in'] == 1)
      {
          $time_in = "Min";

      }
      elseif($row['time_in'] == 2)
      {
          $time_in = "Hrs";
      }
      else
      {
          $time_in ="-";
      }
      ?>
<tr>
  <td><h5><?php echo $i?></h5></td>
  <td><h5><?php echo $row['menu_name'];?></h5></td>
<td><h5> <i class="fa fa-rupee"></i><?php echo $row['price'];?></h5></td>

  <td>
      <div class="lightgallery"
          class="room-list-bx d-flex align-items-center">
          <!-- <a href="assets/icons/breakfast.png"
              data-exthumbimage="assets/icons/breakfast.png"
              data-src="assets/icons/breakfast.png"
              class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6"> -->
              <img class="me-3  "
                  src="<?php echo $row['image'];?>" alt=""
                  style="width:40px; height:40px;">
          </a>
      </div>
  </td>
  <td><h5><?php echo $row['prepartion_time'];
          if($row['time_in'] == 1)
          {
          echo "Min ";

          }
          elseif($row['time_in'] == 2)
          {
              echo "Hrs";
          }
          else{
              echo"-";

          }?>
          </h5>
  </td>
  <td><h5><?php echo $row['details'];?></h5></td>
  <td>
      <div class="d-flex">
         <!-- edit -->
         <a href="#" class="btn btn-warning btn-xs edit_model_click" data-unic-id="<?php echo $row['room_serv_menu_id']?>" ><i class="fa fa-pencil"></i></a>
        <!-- Delete -->
        <a href="#"  data-delete-id="<?php echo $row['room_serv_menu_id']; ?>"class="btn btn-danger btn-xs delete_click_modal"><i class="fa fa-trash"></i></a>
      </div>
  </td>
</tr>
    <!-- <script>
                                                
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
    </script> -->
    <!-- modal popup for edit  -->

<!-- end of modal  -->
<?php $i++; }  } ?>