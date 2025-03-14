
<?php 
                              if(!empty($leads_recharge)){
                                  $i=1;
                                //   echo "<pre>";
                                //   print_r($leads_recharge);die;
                                  foreach($leads_recharge as $s)
                                  { 
                                      // print_r($s);die;
                                     $wh = '(u_id = "'.$s['hotel_id'].'")';
                                    //    print_r($wh);die;
                                     $catgory = $this->SuperAdmin->getSingleData($tbl='register',$wh);
                              
                                  //    print_r($catgory['city']);
                                  //    exit;
                                     if(isset($catgory['city']) && $catgory['city']  !=0 )
                                     {
                                         $wh = $catgory['city'];
                                         $wh = '(city_id = "'.$wh.'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                         $city111 = $recharg['city'];
                              
                                 
                                     }
                                     else
                                     {
                                         $city111 = "-";
                                         
                                     }
                              
                                     $category_name = "";
                                       $sub_cat_name = ""; 
                              
                                      
                                         $wh = '(city_id = "'.$s['city_name'].'")';
                                         $recharg = $this->SuperAdmin->getSingleData('city',$wh);
                                       
                                       
                                         if(!empty($recharg))
                                         {
                                             $city = $recharg['city'];
                                           
                                         }
                                         else
                                         {
                                             $city = "-";
                                         }
                              
                                         $wh = '(u_id= "'.$s['hotel_admin_id'].'")';
                                         $data = $this->SuperAdmin->getSingleData('register',$wh);
                                     
                                         if(!empty($data))
                                     {
                                         $hotel_name = $data['hotel_name'];
                                         $u_id = $data['u_id'];
                                         $total_amount = $data['wallet_points'];
                                      //    print_r($total_amount);
                                      //    exit;
                              
                                     }
                                     else
                                     {
                                         $hotel_name = "-";
                                         $u_id ="-";
                                         $total_amount ="-";
                              
                                     }
                              
                                     if($s['added_by']==1)
                                     {
                                         $added_by = 'Super Admin';
                              
                                     }
                                     else
                                     {
                                         $added_by = 'Admin';
                                     }
                                 ?>
                           <tr>
                              <td>
                                 <h5><?php echo $i?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $city;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $hotel_name;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $s['amount'];?></h5>
                              </td>
                              <td>
                                 <h5><?php echo  $total_amount ;?></h5>
                              </td>
                              <td>
                                 <h5><?php echo $added_by;?></h5>
                              </td>
                              <td>
                                 <!-- <a href="javascript:void(0)" data-id="<? $s['id']?>" class="btn btn-tbl-edit btn-xs updateStaff">
                                    <i class="fa fa-pencil"></i>
                                    </a> -->
                                 <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['id']?>" city-id="<?= $s['city_name']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                 <a href="#" id="delete_<?php echo $s['id'] ?>"
                                    class="btn btn-tbl-delete btn-xs"><i
                                    class="fa fa-trash-o"></i></a>
                              </td>
                           </tr>
                           <script>
                              document.getElementById('delete_<?php echo $s['id'] ?>').onclick = function() {
                              var id='<?php echo $s['id'] ?>';
                              
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
                                              url:base_url+"SuperAdminController/delete_mng_charge", 
                                              
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
    <div class="modal-dialog  modal-dialog-centered modal-lg slideInRight animated">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Credit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal">
            </button>
        </div>
        <div class="modal-body">
            <div class="basic-form">
                <form id="frmupdateblock" method="POST" enctype="multipart/form-data">
                   
                    <div class="row">
                    <input type="hidden" name="id" id="id">
                        <div class="mb-3 col-md-12">
                        <label class="form-label">City</label>
                        <select class=" form-control " name="city_name" id="city_name" >
                        <option value="<?php echo $city_name;?>" selected="selected"><?php echo $city_name;?></option>

                        </select>
                        
                      
                        
                            </div>
                            <div class=" mb-3 col-md-12">
                                <label class="form-label">Hotel Name</label>
                                <input type="hidden" class="form-control" name="hotel_name" id="hotel_name">
                                
                                        <select class="default-select form-control wide" name="hotel_name" id="hotel_name" >
                                    <option selected="true" disabled="disabled"> <?php echo $hotel_name;?></option>

                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                            <label class="form-label">Enter Amount</label>
                            <input type="number" name="amount"
                                id="amount"
                                class="form-control" placeholder="" required="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-primary css_btn">Save
                            changes</button>

                        <button type="button" class="btn btn-light css_btn"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
<!-- end of modal  -->
<script>
    $(document).ready(function (id) {
            $(document).on('click','#edit_data',function(){
                var id = $(this).attr('data-id');
                var city_id = $(this).attr('city-id');
                // alert(id);
            
                $.ajax({
                        url: '<?= base_url('SuperAdminController/getEditdata_mng_credit') ?>',
                        //url: 'https://aartoon.com/control_panel/MainController/delete_home_slider/13',
                        type: "post",
                        data: {id:id, city_id:city_id},
                        dataType:"json",
                        success: function (data) {
                            // console.log(data.amount);
                            $('#id').val(data.id);
                          
                            $('#city_name option').val(data.city_id).text(data.city_name);
                            $('#hotel_id').val(data.hotel_name);
                            $('#amount').val(data.amount);
              
                            }
                        }); 
            })
    });
    //  $(document).on('submit', '#frmupdateblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
        
    //     $.ajax({
    //         url         : '<?php //base_url('SuperAdminController/update_credit_amount') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".update_staff_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".updatemessage").show();
    //               }, 2000);
    //              setTimeout(function(){  
    //                 $(".updatemessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });
</script>