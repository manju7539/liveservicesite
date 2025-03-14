 <!-- start page content -->
 <?php
//   echo "<pre>";
// 	 print_r($hotel_data);
// 	 exit;
     ?>
 <div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Plan Purchase Hotels</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                            href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    
                    <li class="active">Plan Purchase Hotels</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Plan Purchase Hotels</header>

                    </div>
                    <div class="card-body ">

                   
                                        
                        <div class="table-scrollable">
                            <table id="example1" class="display full-width">
                            <thead>
                                            <tr>
                                            <th>Sr.No.</th>
                                            <th>Plan Name</th>
                                            <th>Hotel Name</th>
                                            <th>Purchase Price</th>

                                            <th>Date</th>

                                            
                                           
                                            </tr>
                                        </thead>
                                        <tbody id="geeks">
                                            <?php
                                            if(!empty($plan_purchase_list)){

                                                      $i = 1;
                                                          foreach($plan_purchase_list as $row)
                                                          {
                                                            $where1 = '(u_id ="'.$row['hotel_id'].'")';
                                                            $get_hotel_name = $this->SuperAdmin->getData('register',$where1);
                                                           
                                                            if(!empty($get_hotel_name))
                                                            {
                                                                $hotel_name = $get_hotel_name['hotel_name'];
                                                            }
                                                            else
                                                            {
                                                                $hotel_name = '-';
                                                            } 
                                                             $where1 = '(leads_plan_id ="'.$row['leads_plan_id'].'")';
                                                            $get_leads_name = $this->SuperAdmin->getData('leads_plan',$where1);
                                                            if(!empty($get_leads_name))
                                                            {
                                                                $leads_name = $get_leads_name['ledas_name'];
                                                            }
                                                            else
                                                            {
                                                                $leads_name = '';
                                                            } 

                                                            ?>
                                            <tr>
                                                <td>
                                                    <h5><?php echo $i;?></h5>
                                                </td>
                                                <td>
                                                    <h5><?php echo $leads_name;?></h5>
                                                </td>
                                                <td>
                                                    <h5><?php echo $hotel_name;?></h5>
                                                </td>
                                                <td>
                                                    <h5><?php echo $row['purchase_price'];?></h5>
                                                </td>
                                                <td>
                                                    <h5><?php echo $row['created_at'];?></h5>
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
