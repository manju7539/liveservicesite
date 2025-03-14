
<?php 

if(!empty($leads_recharge)){
    $i=1;
     foreach($leads_recharge as $s)
    {
        $wh = '(u_id = "'.$s['city'].'")';
        $get = $this->SuperAdmin->getAllDatat('register',$wh);
        //   $hotel_name = array_column($get, 'hotel_name');
        //  print_r( $get);
        //  exit;
        if(!empty($get))
        {
          $hotel_name = $get[0]['hotel_name'];

        }
        else
        {
          $hotel_name = "-";
        }
   ?>
    <tr>
    <td><h5><?php echo $i;?></h5></td>
                <td><h5><?php echo $hotel_name ;?></h5></td>
                <td><h5><?php echo $s['lead_cost'];?></h5></td>
                <td><h5><?php echo $s['lead_percentage'];?>%</h5></td>
         <td>
       
           
                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_recharge_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                        <a href="#" id="delete_<?php echo $s['leads_recharge_id'] ?>"
                        class="btn btn-tbl-delete btn-xs"><i
                            class="fa fa-trash-o"></i></a>
    </td>

    </tr>
    <script>
            
            document.getElementById('delete_<?php echo $s['leads_recharge_id'] ?>').onclick = function() {
            var id='<?php echo $s['leads_recharge_id'] ?>';
            // alert(id);
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
                            url:base_url+"SuperAdminController/delete_lead_recharge", 
                            
                            type: "post",
                            data: {id:id},
                            dataType:"HTML",
                            success: function (data) {
                                if(data==1){
                                swal(
                                        "Deleted!",
                                        "Your  Plan has been deleted!",
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

<?php $i++; }  } ?>

    <!-- modal popup for edit  -->
    <div class="modal fade update_staff_modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title">Edit Lead Recharges</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal">
    </button>
</div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <input type="hidden" name="leads_recharge_id" id="leads_recharge_id">

                    <div class="mb-3 col-md-12">
                                <label class="form-label">Hotel</label>
                                <select id="inputState" class="default-select form-control wide" name="city" id="city1" data-hotelid="<?php echo $s['city'] ?>">

<?php
    $where = '(user_type = 2)';
    $hotel_data = $this->SuperAdmin->getAllDatat($tbl='register',$where);
    foreach($hotel_data as $u)
    {
        $name = $u['hotel_name'];
        $id = $u['u_id'];
        $selected = '';
        if($id == $s['city']) {
            $selected = 'selected';
        }
        echo '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
    }
    
?>
</select>

                            </div>
                                          
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead Cost</label>
                             
                              <input type="text" minlength="1" maxlength="20" name="lead_cost" id="lead_cost_edit"  class="form-control <?php echo (form_error('lead_cost') !="") ? 'is-invalid' : ''; ?>"  placeholder="Lead Cost" onkeypress="return onlyNumberKey(event)" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead conversion percentage </label>
                            
                                 <input type="text" minlength="1" maxlength="15" name="lead_percentage" id="lead_percentage_edit"  class="form-control <?php echo (form_error('lead_percentage') !="") ? 'is-invalid' : ''; ?>"  placeholder="lead Percentage" onkeypress="return onlyNumberKey(event)" required>

                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary  css_btn">Save Changes</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-light  css_btn">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div><!-- end of modal  -->
<script>
$(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                // alert(id);
                $.ajax({
                                          url: '<?= base_url('SuperAdminController/getEditdata_lead_recharge') ?>',
                                          //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                                          type: "post",
                                          data: {id:id},
                                          dataType:"json",
                                          success: function (data) {
    $('#leads_recharge_id').val(data.leads_recharge_id);
    $('#lead_cost_edit').val(data.lead_cost);
    $('#lead_percentage_edit').val(data.lead_percentage);

    // Set the selected option in the dropdown
    $('#inputState option[value="' + data.city + '"]').prop('selected', true);
}

                              
                                          
                                          }); 
            })
        });

</script>