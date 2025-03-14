<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Notification</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Notification</li>
                </ol>
            </div>
        </div>
           <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
               <strong style="color:#fff ;margin-top:10px;">Notification Created Successfully..!</strong>
              
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
                        <header>List Of Notification</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                    <div class="row my-3">
                    <form method="POST">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control wide" name ="date"
                                            placeholder="Search Date" onfocus="(this.type = 'date')"
                                            id="date">
                                        <button class="btn btn-info  btn-sm "><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div class="btn-group r-btn">
                   
                        <button id="addRow1" class="btn btn-info add_facility">
                        Create Notification
                        </button>  
                        
                    </div>
                                 
                        <div class="table-scrollable">
                        
                            <table id="example1" class="display full-width">
                                <thead>
                                <tr>
                                    <th>Sr.no.</th>
                                    <th>Send To</th>
                                    <th>Notification Type</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date/Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

                                                        $i = 1;
                                                        if(!empty($list))
                                                        {
                                                            foreach($list as $nt)
                                                            {
                                                                $send_to = "";

                                                                if($nt['send_to'] == 1)
                                                                {
                                                                    $send_to = "All";
                                                                }
                                                                else
                                                                {
                                                                    $send_to = "Specific";
                                                                }

                                                                $notification_type = "";

                                                                if($nt['notification_type'] == 1)
                                                                {
                                                                    $notification_type = "Whatsapp Notification";
                                                                }
                                                                else
                                                                {
                                                                    if($nt['notification_type'] == 2)
                                                                    {
                                                                        $notification_type = "Push Notification";
                                                                    }
                                                                    else
                                                                    {
                                                                        if($nt['notification_type'] == 3)
                                                                        {
                                                                            $notification_type = "Email Notification";
                                                                        }
                                                                        else
                                                                        {
                                                                            if($nt['notification_type'] == 4)
                                                                            {
                                                                                $notification_type = "Email and Push Notification";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                        ?>
                                                    <tr>
                                                    <td><strong><?php echo $i++?></strong></td>
                                                    <td>
                                                                <?php echo $send_to?>
                                                            </td>
                                                   <td><?php echo $notification_type?></td>
                                                   <td><?php echo $nt['title']?></td>

                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-secondary shadow btn-xs sharp "
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalCenter_<?php echo $nt['notification_id']?>"><i
                                                                    class="fa fa-envelope"></i></a>
                                                        </td>
                                                        <!-- <td>10/10/2021 / <sub>02:30AM</sub></td> -->
                                                        <td><?php echo $nt['created_at']?></td>

                                                        <!-- <td>
                                                            <div class="">
                                                                <a href="#"
                                                                    class=" send_msg btn btn-info shadow btn-xs sharp me-1">
                                                                    <i class=" fa fa-share"></i>
                                                                </a>
                                                                <a href="#"
                                                                    class="btn btn-warning shadow btn-xs sharp me-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target=".bd-example-modal-lg"><i
                                                                        class="fa fa-pen"></i></a>

                                                                <a href="#" id="delete"
                                                                    class=" btn btn-danger shadow btn-xs sharp"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td> -->
                                                        <td>
                                                                <div class="">
                                                                    <a href="<?php echo base_url('FrontofficeController/resend_notification_to_user/'.$nt['notification_id'])?>"
                                                                        class="btn btn-warning shadow btn-xs sharp me-1"
                                                                        onclick="return confirm('Are you sure you want to Resend the Message');"><i
                                                                            class="fa fa-share"></i></a>
                                                                           
                                                                            <a href="#" id="delete_<?php echo $nt['notification_id']?>"
                                                                        class="btn btn-danger shadow btn-xs sharp delete"><i
                                                                            class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>

                                                    </tr>
                                                    <script>
                                                        
                                                        document.getElementById('delete_<?php echo $nt['notification_id'] ?>').onclick = function() {
                                                        var id='<?php echo $nt['notification_id'] ?>';
                                                        var base_url='<?php echo base_url();?>';
                                                        swal({
                                                        
                                                                
                                                                title: "Are you sure?",
                                                                text: "You will not be able to recover this file!",
                                                                type: "warning",
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#DD6B55',
                                                                confirmButtonText: 'Yes, delete it!',
                                                                cancelButtonText: "No, cancel",
                                                                closeOnConfirm: false,
                                                                closeOnCancel: false
                                                            },
                                                            function(isConfirm) {
                                                            //console.log(id);
                                                                if (isConfirm) {
                                                                    $.ajax({
                                                                        url:base_url+"FrontofficeController/delete_notifications", 
                                                                        type: "post",
                                                                        data: {id:id},
                                                                        dataType:"HTML",
                                                                        success: function (data) {
                                                                            if(data==1){
                                                                            swal(
                                                                                    "Deleted!",
                                                                                    "Your Facility has been deleted!",
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
                                                                        "Your  facility is safe !",
                                                                        "error"
                                                                    );
                                                                }
                                                            });
                                                    };
                                                    </script>
                                        
                                                    <div class="modal fade" id="exampleModalCenter_<?php echo $nt['notification_id']?>" style="display: none;" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Message</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <p><?php echo $nt['description']?></p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light css_btn" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
               <h5 class="modal-title" style="font-weight: bold;font-size: 15px !important;">Add Notification</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal">
               </button>
            </div>
            <div class="modal-body">
            <div class="row">
                                                    <div class=" mb-3 col-md-6 form-group">
                                                        <label class="form-label">Send To</label>
                                                        <select name="send_to" id="" class="default-select form-control wide"
                                                            onchange="send_specific(this.value);">
                                                            <option selected="" disabled=""> Choose...</option>

                                                            <option value="cust">All Customer</option>
                                                            <option value="spe_cust">Specific Customer</option>
                                                            <option value="guest">All Guest</option>
                                                            <option value="spe_guest">Specific Guest</option>


                                                        </select>
                                                    </div>

                                                    <div id="all_customer" class=" mb-3 col-md-6 form-group "
                                                    >
                                                        <label class="form-label">Select Customer</label>
                                                        <!-- <select class="multi-select" name="customers[]"
                                                            multiple="multiple">
                                                            <option value="1">Abita</option>
                                                            <option value="2">Manasi</option>
                                                            <option value="3">Harshada</option>
                                                            <option value="4">Bhushan</option>
                                                        </select> -->
                                                        <select class="default-select form-control wide" name="users[]"
                                                                    >
                                                                    <?php 
                                                                        if($user_list)
                                                                        {
                                                                            foreach($user_list as $us)
                                                                            {
                                                                    ?>
                                                                    
                                                                                <option value="<?php echo $us['u_id']?>"><?php echo $us['full_name']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                    </div>
                                                    <div id="all_guest" class=" mb-3 col-md-6 form-group "
                                                       >
                                                        <label class="form-label">Select Guest</label>
                                                        <!-- <select class="multi-select" name="customers[]"
                                                            multiple="multiple">
                                                            <option value="1">Abita</option>
                                                            <option value="2">Manasi</option>
                                                            <option value="3">Harshada</option>
                                                            <option value="4">Bhushan</option>
                                                        </select> -->
                                                        <select class="default-select form-control wide" name="users[]"
                                                                   >
                                                                    <?php 
                                                                        if($guest_list)
                                                                        {
                                                                            foreach($guest_list as $us)
                                                                            {
                                                                                $wh = '(u_id = "'.$us['u_id'].'")';
                                                                                $guest_name = $this->MainModel->getData('register',$wh);
                                                                                  
                                                                                    if(!empty($guest_name))
                                                                                {
                                                                                    $name = $guest_name['full_name'];
                                                                               }
                                                                                else
                                                                                {
                                                                                    $name = "-";
                                                                                }
                                                                    ?>
                                                                    
                                                                                <option value="<?php echo $us['u_id']?>"><?php echo $name ; ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                    </div>


                                                    <div class=" mb-3 col-md-6 form-group">
                                                        <label class="form-label">Notification</label>
                                                        <!-- <select name="" id="" class=" form-control wide"
                                                            multiple="multiple"> -->
                                                           <!--  <option value="1">Whatsapp class=multi-select</option> -->
                                                           <!-- <option value="3">Email</option> -->

                                                        <!-- </select> -->
                                                        <select name="notification_type" id=""
                                                                        class="default-select form-control wide"
                                                                        required="" >
                                                                        <option value data-isdefault="true">
                                                                            ---select---</option>
                                                                        <option value="4">Both</option>
                                                                        <option value="2">Push Notification</option>
                                                                        <option value="3">Email Notification</option>
                                                                    </select>
                                                    </div>

                                                    <div class="mb-3 col-md-6 form-group">
                                                        <label class="form-label">Subject</label>
                                                        <div class="input-group">
                                                                    <input type="text" name="title" class="form-control"
                                                                        placeholder="enter subject" required>
                                                                </div>
                                                    </div>

                                                    <div class="mb-3 col-md-12 form-group">
                                                        <label class="form-label">Message</label>
                                                        <textarea name="description" class="summernote"></textarea>
                                                    </div>

                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary css_btn">Send</button>
                                                    <button type="button" class="btn btn-light css_btn"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
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
    function send_specific(values) {
        // if (values == "specific") {
        //     document.getElementById('all_user').style.display = "block";
        //     document.getElementById('all_customer').style.display = "none";
        //     document.getElementById('all_guest').style.display = "none"; 
        // }
        if (values == "spe_cust") {
            document.getElementById('all_customer').style.display = "block";
            
            document.getElementById('all_guest').style.display = "none";
        }

        if (values == "spe_guest") {
            document.getElementById('all_guest').style.display = "block";
           
            document.getElementById('all_customer').style.display = "none";
        }
        // if (values == "guest") {
        //     document.getElementById('all_guest').style.display = "block";
        //     document.getElementById('all_user').style.display = "none";
        //     document.getElementById('all_customer').style.display = "none";
        // }
    }
    </script>
    <script>
    function send_specific_new(values) {
        // if (values == "specific_new") {
        //     document.getElementById('all_user_new').style.display = "block";
        //     document.getElementById('all_customer_new').style.display = "none";
        //     document.getElementById('all_guest_new').style.display = "none";
        // }
        if (values == "spe_cust_new") {
            document.getElementById('all_customer_new').style.display = "block";
            document.getElementById('all_guest_new').style.display = "none";
        }
        if (values == "spe_guest_new") {
            document.getElementById('all_guest_new').style.display = "block";
            document.getElementById('all_customer_new').style.display = "none";
        }
    }
    </script>
<script>

    $(document).on("click",".add_facility",function(){
        $(".add_facility_modal").modal('show');
    });

    $(document).on("click",".update_facility_modal",function(){
        var data_id = $(this).attr('data-id');
       
        $(".add_facility_modal_"+data_id).modal('show');
    });

    //  $(document).on('submit', '#frmblock', function(e){
    //     e.preventDefault();
    //     $(".loader_block").show();
    //     var form_data = new FormData(this);
    //     $.ajax({
    //         url         : '<?= base_url('FrontofficeController/sent_notification_to_customers') ?>',
    //         method      : 'POST',
    //         data        : form_data,
    //         processData : false,
    //         contentType : false,
    //         cache       : false,
    //         success     : function(res) {
    //             setTimeout(function(){  
    //              $(".loader_block").hide();
    //              $(".add_facility_modal").modal('hide');
    //              $(".append_data").html(res);
    //               $(".successmessage").show();
    //               }, 2000);
    //              setTimeout(function(){  
    //                 $(".successmessage").hide();
    //               }, 4000);
               
    //         }
    //     });
    // });
    $(document).on('submit', '#frmblock', function(e){
       e.preventDefault();
       $(".loader_block").show();
       var form_data = new FormData(this);
       $.ajax({
           url         : '<?= base_url('FrontofficeController/sent_notification_to_customers') ?>',
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
</script>