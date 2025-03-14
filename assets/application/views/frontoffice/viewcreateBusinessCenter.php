<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Business Center</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Business Center</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Created Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
              <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Facility Updated Successfully..!</strong>
              
                <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
              
            </div>
            
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>List Of Business Center</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                    <div class="btn-group r-btn">
                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('ManageBusinessCenter')?>" style="color:white;">List Of Business Center</a></button> 
                    
                    <button type="button" class="btn btn-secondary "><a href="<?php echo base_url('listOfAcceptedRequest')?>" style="color:white;">Create Business Center</a></button> 

                   
                        <button id="addRow1" class="btn btn-info add_facility">
                            Add Walking Guest <i class="fa fa-plus"></i>
                        </button>
                        
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Guest Name</th>
                                    <th>Business center Type</th>
                                    <th>Capacity</th>
                                    <!-- <th>Check In</th>
                                    <th>Check Out</th> -->
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Status</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                        $i = 1+$this->uri->segment(2);
                                                        if($list)
                                                        {
                                                            foreach($list as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->MainModel->getData('business_center',$where1);
                                                                if(!empty($no_of_people1))
                                                                {
                                                                    $no_of_people = $no_of_people1['no_of_people'];
                                                                    $type_name= $no_of_people1['business_center_type'];

                                                                }
                                                                else
                                                                {
                                                                    $no_of_people = '-';
                                                                    $type_name = '-';
                                                                } 
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <h5><?php echo $i++?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $bu_r['client_name']?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo  $type_name ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $no_of_people ?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo $bu_r['event_date']?></h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?> </h5>
                                                        </td>
                                                        <td>
                                                            <h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?> </h5>
                                                        </td>
                                                        <input type="hidden" name="b_c_reserve_id" id="b_c_reserve_id<?php echo $bu_r['b_c_reserve_id'];?>" value="<?php echo $bu_r['b_c_reserve_id'];?>">

                                                        <td>
                                                        <select class="form-control" name="request_status" id="request_status<?php echo $bu_r['b_c_reserve_id'];?>" onchange="change_status_1(<?php echo $bu_r['b_c_reserve_id']?>);">
                                                       
                                                          <?php 
                                                            if($bu_r['request_status']=="1") 
                                                            {
                                                                ?>
                                                                    <option value=" 1" selected>Accept</option>
                                                                    <option value="2">Reject</option>
                                                                <?php }
                                                                if($bu_r['request_status']=="0") 
                                                                {
                                                                    ?>
                                                                     <!-- <option value="0">New Order</option> -->
                                                                         <option value="0" selected>New Order</option>
                                                                         <option value="1">Accept</option>
                                                                        <option value="2">Reject</option>
                                                                    <?php }
                                                                if($bu_r['request_status']=="2")
                                                                { 
                                                                    ?>
                                                                    <option value="1">Accept</option>
                                                                    <option value="2" selected>Reject</option>
                                                                <?php } ?>
                                                                
                                                          </select>
                                                     </td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>

                                                    </tr>
                                                     <!-- Modal -->
            <div class="modal fade bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <p>
                                <?php echo $bu_r['additional_note'];?>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary css_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div> <!-- end of modal  -->
                                                    <?php 
                                                    }
                                                 } 
                                                
                                                 ?>
                                  
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
        <div class="modal fade bd-add-modal add_facility_modal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Facility</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="basic-form">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="facility_name" class="form-control" required>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Upload Icon</label>
                                                <div class="input-group mb-3">
                                                    <div class="form-file form-control"
                                                        style="border: 0.0625rem solid #ccc7c7;">
                                                          <input type="file" name="File" accept="image/png, image/gif, image/jpeg" required>
                                                    </div>
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                 <label class="form-label">Description</label>
                                                <textarea name="desc" class="summernote" cols="30" rows="10"></textarea>
                                            </div>
                                          <!--   <div class="mb-3 col-md-12">
                                                <label class="form-label">Description</label>
                                              
                                                <textarea class="summernote" name="desc"  required=""></textarea>
                                            </div> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add btn modal -->

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


<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    $(document).on('submit', '#frmblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/add_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".add_facility_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".successmessage").show();
                  }, 2000);
                setTimeout(function(){  
                    $(".successmessage").hide();
                  }, 4000);
               
            }
        });
    });

     $(document).on('submit', '#frmupdateblock', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var form_data = new FormData(this);
        $.ajax({
            url         : '<?= base_url('HomeController/update_facility') ?>',
            method      : 'POST',
            data        : form_data,
            processData : false,
            contentType : false,
            cache       : false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".update_modal").modal('hide');
                 $(".append_data").html(res);
                  $(".updatemessage").show();
                  }, 2000);
                 setTimeout(function(){  
                    $(".updatemessage").hide();
                  }, 4000);
               
            }
        });
    });
</script>