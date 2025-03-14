 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($leads_recharge);
// 	 exit;
     ?>
     <style>
    /* th{
            text-align: center;
        } */
        </style>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">

                

                    <div class="page-title">Lead Recharge</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Lead Recharge</li>
                </ol>
            </div>
        </div>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Lead Recharge added Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>

      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Updated Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Lead Recharges</header>
                     
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                        <button id="addRow1"  class="btn btn-info add_hotel">
                        Add Lead Recharge
                        </button>
                    </div>
                                        
                        <div class="table-scrollable" >
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                                    <th>
                                                        Sr.No.
                                                    </th>
                                                    
                                                    <th>Hotel</th>

                                                    <th>Lead Cost</th>
                                                    <th>Lead conversion percentage</th>
                                                    <th>Action</th>
                                                </tr>
                                </thead>
                                <tbody class="append_data">
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
                                    <td style="text-align: center;"><h5><?php echo $i;?></h5></td>
                                                <td><h5><?php echo $hotel_name ;?></h5></td>
                                                <td style="text-align: center;"><h5><?php echo $s['lead_cost'];?></h5></td>
                                                <td style="text-align: center;"><h5><?php echo $s['lead_percentage'];?>%</h5></td>
                                         <td>
                                        
                                           

                                                        <a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" data-bs-toggle="modal" id="edit_data" data-id="<?= $s['leads_recharge_id']?>" data-bs-target=".update_staff_modal"><i class="fa fa-pencil"></i></a> 
                                                        
                                                        <a href="#"  class="btn btn-danger shadow btn-xs sharp me-1"  id="delete_data" delete-id="<?= $s['leads_recharge_id']?>" ><i class="fa fa-trash"></i></a> 
                                    </td>
                    
                                    </tr>
                                    <?php $i++; }  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- add btn modal  -->
        <div class="modal fade add_leads_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Recharge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                <form id="addplan"
                      method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Hotel</label>
                                <select id="inputState" class="default-select form-control wide" name="city" > <option selected="true" disabled="disabled">Select
                                        Hotel....</option>

                                    <?php 
                                $where = '(user_type = 2)';
                                $hotel_data = $this->SuperAdmin->getAllDatat($tbl='register',$where);
                                foreach($hotel_data as $u)
                                {
                                    $name=$u['hotel_name'];
                                    echo '<option value="'. $u['u_id'].'">'.$name.'</option>';
                                }
                                    ?></select>
                            </div>
                                          
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead Cost</label>
                                <!--<input type="number" name="lead_cost" class="form-control" placeholder="Enter a Lead Cost " required="">-->
                              <input type="text" minlength="1" maxlength="20" name="lead_cost" id="lead_cost" class="form-control <?php echo (form_error('lead_cost') !="") ? 'is-invalid' : ''; ?>"  placeholder="Lead Cost" onkeypress="return onlyNumberKey(event)" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead conversion percentage </label>
                               <!-- <input type="number" name="lead_percentage" class="form-control" placeholder="Enter Lead Percentage" required="">-->
                                 <input type="text" minlength="1" maxlength="15" name="lead_percentage" id="lead_percentage" class="form-control <?php echo (form_error('lead_percentage') !="") ? 'is-invalid' : ''; ?>"  placeholder="lead Percentage" onkeypress="return onlyNumberKey(event)" required>

                            </div>
                        </div>
                        <div class="modal-footer">
                    <button type="submit" class="btn btn-primary css_btn">Add</button>
                </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
<!-- end add btn modal -->
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
                                <select id="inputState" class="default-select form-control wide" name="city" id="city1" data-hotelid="<?php echo $city ?>">
                               
<?php
    $where = '(user_type = 2)';
    $hotel_data = $this->SuperAdmin->getAllDatat($tbl='register',$where);
    foreach($hotel_data as $u)
    {
        $name = $u['hotel_name'];
        $id = $u['u_id'];
        $selected = '';
        if($id == $city) {
            $selected = 'selected';
        }
        echo '<option value="'.$id.'" '.$selected.'>'.$name.'</option>';
    }
?>    
</select>

                            </div>
                                          
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead Cost</label>
                                <!--<input type="number" name="lead_cost" class="form-control" placeholder="Enter a Lead Cost " required="">-->
                              <input type="text" minlength="1" maxlength="20" name="lead_cost" id="lead_cost_edit"  class="form-control <?php echo (form_error('lead_cost') !="") ? 'is-invalid' : ''; ?>"  placeholder="Lead Cost" onkeypress="return onlyNumberKey(event)" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label">Lead conversion percentage </label>
                               <!-- <input type="number" name="lead_percentage" class="form-control" placeholder="Enter Lead Percentage" required="">-->
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
</div>
<!-- end of edit  modal   -->
<div class="loader_block" style="display: none;">
   <div class="row" style="position: absolute;left: 50%;top: 40%;">
      <div class="col-sm-6 text-center">
         <p>loader 3</p>
         <div class="loader3">
            <span></span>
            <span></span>
         </div>
      </div>
   </div>
</div>

<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>

<script>
    $(document).on("click",".add_hotel",function(){
        $(".add_leads_modal").modal('show');
    });
    $(document).on("click",".updateStaff",function(){
        var data_id = $(this).attr('data-id');
        $(".add_staff_modal_"+data_id).modal('show');
    });
    
    // lead rechage add script
    $(document).on('submit', '#addplan', function(e){
        e.preventDefault(); 
        $(".loader_block").show();
        var form_data = new FormData(this);
        console.log(form_data);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/lead_recharge') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            // dataType    : 'JSON',
            async:false,
            success     : function(res) {

               
                $.get( '<?= base_url('leadRecharge');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                    $(".loader_block").hide();
                    $(".add_leads_modal").modal('hide');
                    $(".add_leads_modal").on("hidden.bs.modal", function () {
                        $("#addplan").trigger("reset"); // reset the form fields
                    });
                    $(".append_data").html(res);
                    $(".successmessage").show();

                }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                }, 4000);
            }
        });
    });

    // fetch lead recharge data for edit
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

    // update lead recharge script
    $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('SuperAdminController/update_lead_recharge') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                $.get( '<?= base_url('leadRecharge');?>', function( data ) {
                    var resu = $(data).find('.table-scrollable').html();
                    $('.table-scrollable').html(resu);
                    setTimeout(function(){
                        $('#example1').DataTable();
                    }, 2000);
                });
                setTimeout(function(){  
                    $(".loader_block").hide();
                    $(".update_staff_modal").modal('hide');
                    $(".append_data").html(res);
                    $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });

    // delete lead rechage script
    $(document).on('click', '#delete_data', function (event) {
        event.preventDefault(); // Prevent the default behavior of the form submit button

            var id = $(this).attr('delete-id');
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
            }, function (isConfirm) {

                if (isConfirm) {
                    $.ajax({
                        url: '<?= base_url('SuperAdminController/delete_lead_recharge') ?>',
                        method: "POST",
                        data: { id: id },
                        dataType: "html",
                        success: function (data) {
                            swal("Deleted!", "Your Plan has been deleted!", "success");
                            $.get( '<?= base_url('leadRecharge');?>', function( data ) {
                                var resu = $(data).find('.table-scrollable').html();
                                $('.table-scrollable').html(resu);
                                setTimeout(function(){
                                    $('#example1').DataTable();
                                }, 2000);
                            });

                            $(".loader_block").hide();
                            $(".append_data").html(res);
                        },
                        complete: function () {
                            // Close the SweetAlert modal when the AJAX request is complete
                            swal.close();
                        }

                    });

                } else {
                    swal(
                        "Cancelled",
                        "Your  staff is safe!",
                        "error"
                    );
                }
            });
        });
</script>