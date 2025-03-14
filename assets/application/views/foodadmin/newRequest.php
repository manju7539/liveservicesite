 <!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Banquet Hall Request</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Banquet Hall Request</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="headingtitle">New Request</span></header>
                    </div>
                    <div class="card-body ">

                    <div class="row ">
                        <div class="col-md-4">
                            <select class="form-control" id="banquethallrequestdropdown">
                                <option value="new_request">New Request</option>
                                <option value="manage_request">Manage Request</option>
                                
                            </select>  
                            </div>
                            <div class="col-md-4 new_req_filter">
                                <form method="POST">
                                        <div class="input-group">
                                            <input type="date" name="date" class="form-control"
                                                placeholder="2017-06-04" id="mdate"
                                                data-dtp="dtp_LG7pB">
                                            <select id="inputState"
                                                class="default-select form-control wide"
                                                style="" name="hall_name">
                                                <option selected="true" disabled="disabled"> <!-- -->
                                                    Type Of Hall
                                                </option>
                                            
                                                <?php 
                                                    $admin_id = $this->session->userdata('u_id');
                                                    $wh_admin = '(u_id ="'.$admin_id.'")';
                                                    $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
                                                    $hotel_id = $get_hotel_id['hotel_id'];

                                                    $wh = '(request_status = 0 AND hotel_id ="'.$hotel_id.'")';
                                                    $hall_type = $this->FoodAdminModel->getAllDataFilter($tbl='banquet_hall_orders',$wh);
                                                    foreach($hall_type as $h)
                                                    {
                                                        $wh_hall = '(banquet_hall_id  ="'.$h['banquet_hall_id'].'")';
                                                        $get_hall_name =  $this->MainModel->getData('banquet_hall',$wh_hall);
                                                        
                                                    
                                                ?>
                                                <option value="<?php echo $h["banquet_hall_id"];?>"><?php echo $get_hall_name["banquet_hall_name"];?></option>
                                                <?php 
                                                        }
                                                ?>
                                            </select>
                                            <button name="search" type="submit" class="btn btn-info btn-sm "><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                </form>

                                
                            </div>  
                            <div class="col-md-8 mng_req_filter" style="display:none;">
                                <form method="POST">
                                    <div class="d-flex justify-content-between  ">                                          
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <input type="date" name="date" class="form-control"
                                                    placeholder="2017-06-04" id="mdate"
                                                    data-dtp="dtp_LG7pB">
                                                <select id="inputState"
                                                    class="default-select form-control wide"
                                                    style="" name="order_sts">
                                                    <option selected="true" disabled="disabled">Select
                                                        Status
                                                    </option>
                                                    <option value="1">Accepted</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                                <button name="search" type="submit" class="btn btn-info btn-sm "><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div id="example3_filter" class="dataTables_filter "
                                            style="float:right;">
                                            <label>
                                                <input type="submit" name="submit" placeholder="Search"
                                                    class="form-control search-input"
                                                    data-table="table_list">
                                            </label>
                                        </div>
                                        </div>

                                        
                                    </div>
                                </form> 
                            </div>                    
                        <!-- </div> -->
                        <!-- <a id="addRow1" class="btn btn-info" href="<?php //echo base_url('HomeController/baq_reser')?>">Manage Request <i class="fa fa-plus"></i></a> -->
                      <!--   <button id="addRow1" class="btn btn-info">
                            Manage Request <i class="fa fa-plus"></i>
                        </button> -->

                    </div>
                    <div class="new_req">               
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                    <tr>
                                        <th><strong> Sr.No.</strong></th>
                                        <th><strong>Guest Name</strong></th>
                                        <th> <strong>Contact No</strong></th>
                                        <th><strong>Req.Date / Time</strong></th>
                                        <th><strong>Type of hall</strong></th>
                                        <th><strong>Limit / Quantity (Persons)</strong></th>
                                        <th> <strong>Status</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                            <?php 
                                if(!empty($list)){
                                    $i=1;
                                    foreach($list as $l)
                                    {
                                         $wh = '(u_id ="'.$l['u_id'].'")';
                                       $get_user = $this->MainModel->getData('register',$wh);
                                       if(!empty($get_user))
                                       {
                                            $guest_name = $get_user['full_name'];
                                            $mobile_no = $get_user['mobile_no'];
                                       }
                                       else
                                       {
                                            $guest_name = '';
                                            $mobile_no = '';
                                       }

                                       $wh1 = '(banquet_hall_id ="'.$l['banquet_hall_id'].'")';
                                       $get_hall = $this->MainModel->getData('banquet_hall',$wh1);
                                       if(!empty($get_hall))
                                       {
                                            $hall_name = $get_hall['banquet_hall_name'];
                                       }
                                       else
                                       {
                                            $hall_name ='';
                                       }
                                   ?>
                                    <tr>
                                        <td>
                                            <?php echo $i;?>
                                        </td>
                                       <td>
                                            <span><?php echo $guest_name?></span>
                                        </td>
                                        <td><?php echo $mobile_no?></td>
                                        <td>
                                            <span><?php echo $l['request_date']?> / <sub><?php echo date('h:i A', strtotime($l['request_time']));?></sub></span>
                                        </td>
                                        <td>
                                            <span><?php echo $hall_name;?></span>
                                        </td>
                                        <td><span><?php echo $l['no_of_people']?>  <i class="fa fa-users"></i></span></td>
                                        <td>  
                                            <div>
                                                        <input type="hidden" name="banquet_hall_orders_id" value="<?php echo $l['banquet_hall_orders_id']?>">
                                                        <a href="javascript:void(0)" data-id="<?php echo $l['banquet_hall_orders_id'] ?>" class="accept_request">
                                                    <div class="badge badge-success"> Accept</div>
                                                </a>
                                                <a href="javascript:void(0)" data-id="<?php echo $l['banquet_hall_orders_id'] ?>" class="cancel_request">
                                                    <div class="badge badge-danger"> Reject</div>
                                                </a>
                                            </div>
                                        </td>
                                      
                                    </tr>
                                <?php $i++; }  } ?>
                                   
                                  
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="mng_req" style="display:none;">
                        <div class="table-scrollable">
                            <table id="mngreq" class="display full-width">
                                <thead>
                                    <tr>
                                        <th><strong> Sr.No.</strong></th>
                                        <th><strong>Guest Name</strong></th>
                                        <th> <strong>Contact No</strong></th>
                                        <th><strong>Req.Date / Time</strong></th>
                                        <th><strong>Type of hall</strong></th>
                                        <th><strong>Limit / Quantity (Persons)</strong></th>
                                        <th> <strong>Status</strong></th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="append_data">
                             <?php 
                if(!empty($list1))
                {
                    $i=1;
                    foreach($list1 as $l)
                    {
                       $wh = '(u_id ="'.$l['u_id'].'")';
                       $get_user = $this->MainModel->getData('register',$wh);
                       if(!empty($get_user))
                       {
                            $guest_name = $get_user['full_name'];
                            $mobile_no = $get_user['mobile_no'];
                       }
                       else
                       {
                            $guest_name = '';
                            $mobile_no = '';
                       }

                       $wh1 = '(banquet_hall_id ="'.$l['banquet_hall_id'].'")';
                       $get_hall = $this->MainModel->getData('banquet_hall',$wh1);
                       if(!empty($get_hall))
                       {
                            $hall_name = $get_hall['banquet_hall_name'];
                       }
                       else
                       {
                            $hall_name ='';
                       }
                       
            ?>
            <tr>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                    <span><?php echo $guest_name?></span>
                </td>
                <td><?php echo $mobile_no?></td>
                <td>
                    <span><?php echo $l['request_date']?> / <sub><?php echo date('h:i A', strtotime($l['request_time']));?></sub></span>
                </td>
                <td>
                    <span><?php echo $hall_name;?></span>
                </td>
                <td><span><?php echo $l['no_of_people']?> <i class="fa fa-users"></i></span></td>
                <td>
                    
                <?php 
                    if($l['request_status'] == 1) 
                    {
                ?>
                <div>
                    <a href="#">
                        <div class="badge badge-success"> Accepted</div>
                    </a>
                </div>
                <?php
                    }
                    elseif($l['request_status'] == 2)
                    {
                ?>
                <div>
                    <a href="#">
                        <div class="badge badge-danger"> Rejected</div>
                    </a>
                </div>
                <?php 
                    }
                ?>
                </td>
            </tr>
           
            <?php 
                     $i++;
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
</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.accept_request', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var data_id = $(this).attr('data-id');
        $.ajax({
            url         : '<?= base_url('HomeController/banq_hall_req_accept') ?>',
            method      : 'POST',
            data: {data_id: data_id},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
    });

    $(document).on('click', '.cancel_request', function(e){
        e.preventDefault();
        $(".loader_block").show();
        var data_id = $(this).attr('data-id');
        $.ajax({
            url         : '<?= base_url('HomeController/banq_hall_req_reject') ?>',
            method      : 'POST',
            data: {data_id: data_id},
            async:false,
            success     : function(res) {
                setTimeout(function(){  
                 $(".loader_block").hide();
                 $(".append_data").html(res);
                  }, 2000);
               
            }
        });
    });  

        
</script>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
       
        $('#example1').DataTable();
        $('#mngreq').DataTable();
    } );
    // var selectedOrderserviceurl = '';
    $('#banquethallrequestdropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_request')
        {
            // selectedOrderserviceurl = 'HomeContrller/ajaxSubIconBlockViewEnquiry';
            $('.headingtitle').text('New Request');
            $('.new_req').css('display','block');
            $('.mng_req').css('display','none');
            $('.new_req_filter').css('display','block');
            $('.mng_req_filter').css('display','none');
           
           
        }
        if(selected_orderservice == 'manage_request')
        {
            // selectedOrderserviceurl = 'HomeContrller/ajaxSubIconBlockViewEnquiry';
            $('.headingtitle').text('List Of Request');
            $('.mng_req').css('display','block');
            $('.new_req').css('display','none');
            $('.new_req_filter').css('display','none');

            $('.mng_req_filter').css('display','block');

           
            $.get( '<?= base_url('newRequest');?>', function( data ) {
                    var resu = $(data).find('.mng_req').html();
                    $('.mng_req').html(resu);
                    setTimeout(function(){
                        $('#mngreq').DataTable();
                    }, );
                });
        }
       
     
        // var base_url = '<?php echo base_url();?>';
        // $.ajax({
        //     method: "GET",
        //     url: base_url+selectedOrderserviceurl,
        //     success: function (response) {
        //         $('.append_data').html(response);
        //     }
        // });
    });
</script>
