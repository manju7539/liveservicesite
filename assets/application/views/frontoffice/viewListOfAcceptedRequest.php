<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Business Center Reservation</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Business Center Reservation</li>
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
                        <header>List of Accepted Request</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                            <div class="row mb-3 ">
                                
                                    <div class="col-md-4"> 
                                        <form method="POST">                          
                                            <div class="input-group">
                                                <input type="text" class="form-control wide" name ="check_in"
                                                    placeholder="Check-in Date" onfocus="(this.type = 'date')"
                                                    id="date">

                                                <select class="form-control" id="categoryDropdown">
                                                    <option value data-isdefault="true">Choose...</option>
                                                    <?php
                                                        if($business_center)
                                                        {
                                                            foreach($business_center as $bus_c)
                                                            {
                                                    ?>
                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                
                                                </select>

                                                <button class="btn btn-info  btn-sm " type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </form>                     
                                    </div>
                                <div class="col-md-4">
                                    <select class="form-control" id="categoryDropdown">
                                        <option value="">Select Option</option>
                                        <option value=""><a href="<?php echo base_url('businessCenterRequest')?>" style="color:white;">New Request</a></option>
                                        <option value=""><a href="<?php echo base_url('listOfAcceptedRequest')?>" style="color:white;">List Of Accepted Request</a></option>
                                        <option value=""><a href="<?php echo base_url('listOfRejectedRequest')?>" style="color:white;">List Of Rejected Request</a></option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex  justify-content-end">
                                    <button id="addRow1" class="btn btn-info add_facility">
                                        Add Request 
                                    </button>
                                </div>
                        </div>
                   

                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Guest Name</th>
                                    <th>Guest Mobile No</th>

                                    <th>Business center Type</th>
                                    <th>Capacity</th>
                                    <th>Event Name</th>

                                    <th>Event Date</th>
                                    <th>Event start time</th>
                                    <th>Event End time</th>
                                    <th>Note</th>
                                    <th>Id Proof</th>

                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php
                                                        $i = 1+$this->uri->segment(2);
                                                    // $data=    $this->MainModel->get_active_business_center($admin_id)
                                                        if($list)
                                                        {
                                                            foreach($list as $bu_r)
                                                            {
                                                                $where1 = '(business_center_id ="'.$bu_r['business_center_type'].'")';
                                                                $no_of_people1 = $this->FrontofficeModel->getData('business_center',$where1);
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
                                                    <td><h5><?php echo $i++?></h5></td>
                                                    <td>
                                                      <h5><?php echo $bu_r['client_name']?></h5>
                                                   </td>
                                                     <td><h5><?php echo $bu_r['client_mobile_no']?></h5></td>
                                                    <td><h5><?php echo $type_name ?></h5></td>
                                                    <td><h5><?php echo $no_of_people ?>people</h5></td>
                                                    <td><h5><?php echo $bu_r['event_name']?></h5></td>


                                                    <td><h5><?php echo $bu_r['event_date']?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['start_time']))?></h5></td>
                                                    <td><h5><?php echo date('h:i a',strtotime($bu_r['end_time']))?></h5></td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-note-modal-lg_<?php echo $bu_r['b_c_reserve_id']?>"><i
                                                                    class="fa fa-eye"></i></a>
                                                        </td>
                                                        <td>
                                                            <div class="lightgallery"
                                                                class="room-list-bx d-flex align-items-center">
                                                                <!-- <a href="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-exthumbimage="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    data-src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                    class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                                                    <img class="me-3 rounded"
                                                                        src="<?php echo base_url()?>assets/images/profile/id.png"
                                                                        alt="" style="width:80px; height:40px;">
                                                                </a> -->
                                                                <img class="me-3 rounded" src="<?php echo $bu_r['id_proof_photo'];?>"     alt="" style="width:80px; height:40px;">
                                                            </div>
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
                            <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Business Center Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Guest Name</label>
                                            <input type=""  name="client_name" class="form-control"
                                                                    placeholder="Name of client" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Business Center Type</label>
                                            <select id="inputState"  name="business_center_type" class="default-select form-control wide"  required>
                                                                    <option value data-isdefault="true">Choose...</option>
                                                                    <?php
                                                                        if($business_center)
                                                                        {
                                                                            foreach($business_center as $bus_c)
                                                                            {
                                                                    ?>
                                                                                <option value="<?php echo $bus_c['business_center_id']?>"><?php echo $bus_c['business_center_type']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                        </div>

                                       
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Date</label>
                                            <input type="date" name="event_date" class="form-control" placeholder=""
                                                                    required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Event</label>
                                                                <input type="text" name="event_name" class="form-control"
                                                                    placeholder="Event" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                                                <label class="form-label">Mobile number</label>
                                                                <input type="text" name="client_mobile_no" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                                                    placeholder="Mobile number" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time In</label>
                                            <input type="time"  name="start_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-lable">Time Out</label>
                                            <input type="Time"  name="end_time" class="form-control"
                                                                    placeholder="Check time" required>
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label class="form-label">Id Proof</label>
                                            <input type="file"name="id_proof_photo" class=" dropify  form-control"
                                                                    data-height="90" required>

                                        </div>

                                        <div class=" mb-3 col-md-12">
                                            <label class="form-label">Additional Note</label>
                                            <textarea class="summernote" name="additional_note" style="min-height: 400px;"></textarea>

                                            <!-- <div class="summernote"></div> -->

                                        </div>                                    
                               
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary css_btn" >Submit</button>
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