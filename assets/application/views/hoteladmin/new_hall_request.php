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
                    <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Banquet Hall Request</li>
                </ol>
            </div>
        </div>
        <?php
                    if($this->session->flashdata('msg'))
                    {
                ?>
                    <div class="alert alert-primary" role="alert">
                        <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                    </div>
                <?php
                    }
                ?>
        <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
   <strong style="color:#fff ;margin-top:10px;" class="status_change">Data Added Successfully..!</strong>
  
    <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
  
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header><span class="page_header_title11">New Request</span></header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-3">
                                    <select class="form-control" id="orderserviceDropdown">
                                        <option value="new_orders">New Request</option>
                                        <option value="accepted_order">Manage Request</option>
                                       </select>                         
                                </div>
                    <div class="col-md-5">
                </div>

                    <div class="col-md-4">
                        <div class="test1">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control wide"
                                                                            placeholder=" Date"
                                                                            onfocus="(this.type = 'date')" id="date">
                                                                        <select id="inputState"
                                                                            class="default-select form-control wide"
                                                                            >
                                                                            <option selected="">Select Type of Hall
                                                                            </option>
                                                                            <option>Hall 1</option>
                                                                            <option>Hall 1</option>

                                                                        </select>
                                                                        <button class="btn btn-warning  btn-sm "><i
                                                                                class="fa fa-search"></i></button>
                                                                    </div>
                                                                </div>

                                                                <div class="test2" style="display:none;">
                                                                    <div class="input-group">
                                                                    <input type="date" class="form-control"
                                                                            placeholder="2017-06-04" id="">
                                                                        <select id="inputState"
                                                                            class="default-select form-control wide"
                                                                       >
                                                                            <option selected="true" disabled="disabled">
                                                                                Select
                                                                                Status
                                                                            </option>
                                                                            <option value="">Accepted</option>
                                                                            <option>Rejected</option>
                                                                        </select>

                                                                        <button class="btn btn-warning  btn-sm "><i
                                                                                class="fa fa-search"></i></button>
                                                                        
                                                                    </div>
                                                                </div>
                </div>
                </div>

                <div class="new_orders_div">  
                            <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                                <thead>
                                                        <tr>
                                                        <th><strong>Sr.no.</strong></th>
                                                                    <th><strong>Guest Name</strong></th>
                                                                    <th><strong>Contact No.</strong></th>
                                                                    <th><strong>Req.Date/Time</strong></th>
                                                                    <th><strong>Hall Type</strong></th>
                                                                    <th><strong>Limit / Quantity (Persons)</strong></th>

                                                                    <th><strong> Status</strong></th>
                                                        </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

                                                                $i = 1;
                                                                if($list)
                                                                {
                                                                    foreach($list as $b_h_r)
                                                                    {
                                                            ?>
                                                                        <tr>
                                                                            <td><strong><?php echo $i++?></strong></td>
                                                                            <td><?php echo $b_h_r['full_name']?></td>
                                                                            <td><?php echo $b_h_r['mobile_no']?></td>
                                                                            <td>
                                                                                <span><?php echo $b_h_r['request_date']?> / <sub><?php echo date('h:i A',strtotime($b_h_r['request_time']))?></sub></span>
                                                                            </td>
                                                                            <td><?php echo $b_h_r['banquet_hall_name']?></td>
                                                                            <td><span><?php echo $b_h_r['no_of_people']?> <i class="fa fa-users"></i></span></td>
                                                                            <td>
                                                                                <div>
                                                                                    <a href="<?php echo base_url('HoteladminController/request_accept1/'.$b_h_r['banquet_hall_orders_id'])?>" class="submit"><span class="badge badge-success">Accept</span> </a>
                                                                                    <a href="<?php echo base_url('HoteladminController/request_reject1/'.$b_h_r['banquet_hall_orders_id'])?>" class="submit"><span class="badge badge-warning">Reject</span></a>
                                                                                </div>
                                                                            </td>


                                                                        </tr>
                                                            <?php
                                                                    }
                                                                }
																
                                                            ?>
                                  
                                </tbody>
                            </table>
                        </div>
            </div>


                                                            
            <div class="accepted_orders_div" style="display: none;">  
                            <div class="table-scrollable">
                            <table id="acceptedOrder_tb" class="display full-width">
                                <thead>
                                                        <tr>
                                                        <th><strong>Sr.no.</strong></th>
                                                                    <th><strong>Guest Name</strong></th>
                                                                    <th><strong>Contact No.</strong></th>
                                                                    <th><strong>Req.Date/Time</strong></th>
                                                                    <th><strong>Hall Type</strong></th>
                                                                    <th><strong>Limit / Quantity (Persons)</strong></th>

                                                                    <th><strong> Status</strong></th>
                                                        </tr>
                                </thead>
                                <tbody class="append_data">
                                <?php

$i = 1;
if($list1)
{
    foreach($list1 as $b_h_r)
    {
        $request_status = "";
        
        if($b_h_r['request_status'] == 1)
        {
            $request_status = '<div class="badge badge-success">Accepted</div>';
        }
        else
        {
            if($b_h_r['request_status'] == 2)
            {
                $request_status = '<div class="badge badge-danger">Rejected</div>';
            }
        }
        if($b_h_r['request_status'] == 1 || $b_h_r['request_status'] == 2)
        {
?>
            <tr>
                <td><strong><?php echo $i++?></strong></td>
                <td><?php echo $b_h_r['full_name']?></td>
                <td><?php echo $b_h_r['mobile_no']?></td>
                <td>
                    <span><?php echo $b_h_r['request_date']?> / <sub><?php echo date('h:i A',strtotime($b_h_r['request_time']))?></sub></span>
                </td>
                <td><?php echo $b_h_r['banquet_hall_name']?></td>
                <td><span><?php echo $b_h_r['no_of_people']?> <i class="fa fa-users"></i></span></td>
                <td>
                    <div>
                        <a href="#"><?php echo $request_status ?></div>
                        </a>
                    </div>
                </td>
            </tr>
<?php
        }
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // $('#newOrder_tb').DataTable();
        $('#acceptedOrder_tb').DataTable();
        $('#rejectedOrder_tb').DataTable();
    } );
    $('#orderserviceDropdown').change(function () {
        var selected_orderservice = $(this).val();
        if(selected_orderservice == 'new_orders')
        {
            $('.page_header_title11').text('New Request');
            $('.new_orders_div').css('display','block');
            $('.test1').css('display','block');
            $('.test2').css('display','none');
            $('.accepted_orders_div').css('display','none');     
        }
        if(selected_orderservice == 'accepted_order')
        {
            $('.page_header_title11').text('List Of Request');
            $('.accepted_orders_div').css('display','block');
            $('.test1').css('display','none');
            $('.test2').css('display','block');
            $('.new_orders_div').css('display','none');
           
        }
       
    });
    </script>
