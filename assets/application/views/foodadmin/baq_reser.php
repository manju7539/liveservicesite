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
       
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>New Request</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                  
                                        
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
                if(!empty($list))
                {
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
