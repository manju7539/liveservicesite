<div class="content-body">
            <!-- row -->
            <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-6">
                        <h4>Customer Details</h4>

                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                    href="<?php echo base_url('dashboard')?>">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li><i class=""></i>&nbsp;<a class="parent-item"
                                    href="<?php echo base_url('customer_list')?>">Customers</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                            </li>
                            <li class="active">View</li>
                        </ol>
                    </div>

                </div>
                <?php
                
                $admin_id =$u_id ;
                // $admin_id = $u_id;

// print_r($admin_id);die;
                $admin_data = $this->SuperAdmin->get_user_dataa($admin_id);

                if(isset($admin_data['profile_photo'] ))
                {
                    $profile_photo = $admin_data['profile_photo'];
                }
                else
                {
                    $profile_photo = base_url().'documents/logo16.png';
                }
            ?>
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class=" col-md-12 ">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card=-body">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <img style="margin-top:60px"
                                                        class="profile-user-img img-responsive img-circle"
                                                        src="<?php echo $profile_photo?>"
                                                        alt="Admin" class="rounded-circle" width="150">
                                                    <div class="mt-3">
                                                        <?php echo $data['full_name']??'' ?>
                                                        <!-- <p class="text-secondary mb-1">VIP</p> -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6" >
                                                                <h6 class="mb-0">Full Name</h6>
                                                            </div>
                                                            <div class="col-md-6 text-secondary" style="white-space: nowrap;">
                                                              <?php echo $data['full_name']??'';?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                </div>
                                              <hr>
                                              <div class="row">
                                                   <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6 class="mb-0">Email</h6>
                                                            </div>
                                                            <div class="col-md-6 text-secondary"  style="white-space: nowrap;">
                                                              <?php echo $data['email_id']??''?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6 class="mb-0">Phone</h6>
                                                            </div>
                                                            <div class="col-md-6 text-secondary">
                                                               <?php echo $data['mobile_no']??''?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    

                                                </div>
                                                <hr>
                                                <div class="row">
                                                   
                                                    <?php
                
                                                    $admin_id = $this->uri->segment(2);

                                                    $admin_data = $this->SuperAdmin->get_user_dataa($admin_id);
                                                    if(!empty($admin_data['Id_proff_photo']) && isset($admin_data['Id_proff_photo']))
                                                    // if($admin_data['Id_proff_photo'])
                                                    {
                                                        $Id_proff_photo = $admin_data['Id_proff_photo'];
                                                    }
                                                    else
                                                    {
                                                        $Id_proff_photo = base_url().'documents/logo16.png';
                                                    }
                                                ?>
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6 class="mb-0">Id</h6>
                                                            </div>
                                                            <div class="col-md-6 text-secondary">
                                                              
                                                            <img src="<?php echo $Id_proff_photo ; ?>" alt="" style="width: 50px; height: 50px;">
                                                  
                                                        </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Booking History</h4>
                            </div>

                            <div class="card-body">

                                <div class="table-responsive">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div class="guest-calendar">
                                            <div id="reportrange" class="pull-right reportrange" style="width: 100%">
                                                <span></span><b class="caret"></b>
                                               
                                            </div>
                                        </div>
                                        <div id="example3_filter" class="dataTables_filter" style="float:right;">
                                            <label>
                                                <input type="search" placeholder="Search"
                                                    class="form-control search-input" data-table="table_list"></label>
                                        </div>

                                    </div>
                                    <table
                                        class="table-bordered shadow-hover table-responsive-lg table sortable mb-0 text-center table_list">
                                        <thead>
                                            <tr>
                                                <th>Sr.No.</th>
                                                <th>Booking Date</th>
                                                <th> Hotel Name</th>
                                                <!--<th>Address</th>-->
                                                <th>Check In</th>
                                                <th>Check Out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="geeks">
                                        <?php
                                           if(!empty($get_customer_booking_history))
                                           {
                                                        //   $i = 1+ $this->uri->segment(2);
                                                        $i=1;
                                                          foreach($get_customer_booking_history as $row)
                                                          {
                                                            $wh = '(u_id = "'.$row['hotel_id'].'")';
                                                            $hotel_data = $this->MainModel->getSingleData('register',$wh);
                                                          //   print_r($recharge_data );
                                                             if(!empty($hotel_data))
                                                           {
                                                             $hotel_name = $hotel_data['hotel_name'];
        
                                                           }
                                                           else
                                                           {
                                                             $hotel_name = "-";
                                                           }

                                                           $wh = '(u_id = "'.$row['u_id'].'")';
                                                           $address_data = $this->MainModel->getSingleData('register',$wh);
                                                        //    print_r( $address_data);
                                                            if(!empty($address_data))
                                                          {
                                                            $address = $address_data['address'];
                                                            $register_date = date('d-m-Y', strtotime($address_data['register_date']));
       
                                                          }
                                                          else
                                                          {
                                                            $address = "-";
                                                            $register_date = "-";

                                                          }
                                                       
                                                    
                                                            ?>
                                            <tr>
                                            <td><h5><?php echo $i++; ?></h5></td>
                                            <td><h5><?php echo $register_date ; ?></h5></td>

                                            <td><h5><?php echo $hotel_name; ?></h5></td>

                                            <!--<td><h5><?php echo $address; ?></h5></td>-->
                                            <td><h5><?php echo date('d-m-Y', strtotime($row['check_in'])); ?></h5></td>
                                            <td><h5><?php echo date('d-m-Y', strtotime($row['check_out'])); ?></h5></td>



                                                <td>
                                                <a href="<?php echo base_url('SuperAdminController/add_checkout_details/' .$row['booking_id'].'/'.$row['u_id']) ?>" class="btn btn-success shadow btn-xs sharp  "><i class="fa fa-file"></i>
                                                                        </a>
                                                   
                                                                        <!-- <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1 cancelbooking_invoice" data-bs-toggle="modal" booking-id=<?php //$row['booking_id']?> u-id1=<?php //$row['u_id']?> data-bs-target=".bd-view-modal-cancel-booking-invoice"><i class="fa fa-file"></i>
                                                                        </a> -->



                                                </td>
                                            </tr>
                                         <?php
                                            }
                                          } 
                                          else
                                          {?>
                                            <tr>
                                                <td colspan="9"
                                                    style="color:red;text-align:center;font-size:14px"
                                                    class="text-center">Data Not Available</td>
                                            </tr>
                                            <?php }
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                    

                                    <nav style="float:right;">
                                    
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade  bd-view-modal-cancel-booking-invoice " tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width:90%">
                <div class="modal-content">
                    <form id="frmblock"  method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body guest_history">

                        </div>
                    </form>
                </div>
            </div>
        </div>
       


