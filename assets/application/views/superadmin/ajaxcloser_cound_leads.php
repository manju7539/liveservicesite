<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>



<script src="<?php echo base_url('assets/js/pages/table/table_data.js')?>"></script>

<div class="container-fluid">
               
 
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    
                <div class="alert alert-success successmessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">City Added Sucessfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>

      <div class="alert alert-success updatemessage" role="alert" id="a" style="margin-top:10px; margin-top: 10px;background-color: #4e8759;padding: 4px;border-radius:3px ;display: none;">
         <strong style="color:#fff ;margin-top:10px;">Data Update Successfully..!</strong>
         <span style="  float: right;font-size: 29px;line-height: 0.8;top: 9;color: #fff;" aria-hidden="true">&times;</span>
      </div>
                    <div class="page-title">Leads</div>
                </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                    href="<?php echo base_url('dashboard')?>">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li><a class="parent-item"
                                    href="<?php echo base_url('hotelLists')?>">Hotel</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">Leads</li>
                        </ol>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-topline-aqua">
                    <div class="card-head">
                        <header>All Closure Lead Count</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">

                   
                                        
                        <div class="table-scrollable" >
                            <table id="example7" class="display full-width">
                            <thead>
                            <tr>
                                                <th> Sr.No. </th>
                                                <th>Guest Name</th>
                                               <th>Hotel Name</th>
                                                <!-- <th>Guest City</th> -->
                                                <th>Hotel City</th>

                                                <th>Lead Amount</th>
                                                <th>Convert(%)</th>
                                                <th>Lead Conversion</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody class="append_data">
                                            <tr>
                                            <?php
                                                     if(!empty($closer_lead_list))
                                                     {
                                                            // $i= 1 + $this->uri->segment(2);
                                                            $i=1;
                                                            foreach($closer_lead_list as $row)  
                                                            { 
                                                                $wh = '(u_id = "'.$row['u_id'].'")';
                                                               $request_list = $this->MainModel->getSingleData('register',$wh);
                                                            //    print_r( $request_list );
                                                                if(!empty($request_list))
                                                              {
                                                                $name = $request_list['full_name'];
                                               
                                                              }
                                                              else
                                                              {
                                                                $name = "-";

                                                              }
                                                              
                                                                $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                          $hotel_name = $this->MainModel->getSingleData('register',$wh);
                                                       

                                                           // $citydata11 =  $this->MainModel->getData('city',$wh1);
                                                           if(!empty($hotel_name))
                                                         {
                                                           $hotel_name11 = $hotel_name['hotel_name'];

                                                         }
                                                         else
                                                         {
                                                           $hotel_name11 = "-";
                                                         } 

                                                             $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                             $citydataa = $this->MainModel->getSingleData('register',$wh);
                                                        
                                                            $wh1 = '(city = "'.$citydataa['u_id'].'")';
                                                             $recharg = $this->MainModel->getSingleData('leads_recharge',$wh1);
                                                              if(!empty($recharg))
                                                            {
                                                              $cost = $recharg['lead_cost'];
                                                                
                                                              $lead_conversion = $recharg['lead_percentage'];


                                                            }
                                                            else
                                                            {
                                                              $cost = "-";
                                                              $lead_conversion = "0";

                                                            }

                                                           $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                           $citydata = $this->MainModel->getSingleData('register',$wh);
                                                        
                                                            $wh1 = '(city_id = "'.$citydata['city'].'")';

                                                            $citydata11 =  $this->MainModel->getData('city',$wh1);
                                                            if(!empty($citydata11))
                                                          {
                                                            $citydata1 = $citydata11['city'];

                                                          }
                                                          else
                                                          {
                                                            $citydata1 = "-";
                                                          }


                                                          $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                           $room_cahrge = $this->MainModel->getSingleData('hotel_enquiry_request',$wh);
                                                        

                                                            // $citydata11 =  $this->MainModel->getData('city',$wh1);
                                                            if(!empty($room_cahrge))
                                                          {
                                                            $room_charges = $room_cahrge['room_charges'];

                                                          }
                                                          else
                                                          {
                                                            $room_charges = "-";
                                                          }

                                                          $allowance  = ((($row['room_charges'])* ($lead_conversion))/100);
                                                        //   print_r($allowance);

                                                                ?>
                                                <td>
                                                        <h5 class="text-nowrap"><?php echo $i;?></h5>
                                                </td>
                                                <td><h5>
                                                  <?php echo $name;?></h5>
                                                </td>
                                               <td><h5>
                                                  <?php echo $hotel_name11;?></h5>
                                                </td>
                                                <td><h5>
                                                  <?php echo $citydata1;?></h5>
                                                </td>
                                                <td>
                                                        <h5><i class="fa">&#xf156;</i><?php echo $cost;?></h5>
                                                </td>
                                                <td>
                                                        <h5 class=""><?php echo $lead_conversion;?>% </h5>
                                                </td>
                                                <td>
                                                        <h5><i class="fa">&#xf156;</i><?php echo $allowance;?></h5>
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
