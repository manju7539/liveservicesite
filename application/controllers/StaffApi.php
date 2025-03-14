<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class StaffApi extends CI_Controller
    {
        function __construct()
        {
            parent :: __construct();
            date_default_timezone_set('Asia/Kolkata');
            $this->load->model('ApiModel');
            $this->load->helper('notification_helper');

        }
       
        //get department list // 22-11-2022 //Ravina
        public function get_department_list()
        {
         
			$get_dept_list = $this->ApiModel->getAllData1('departement');
            if(!empty($get_dept_list))
            {
              	   
                
                 $data[] = array(
                                   'department_id' => $get_dept_list[1]['department_id'],
                                   'department_name' => $get_dept_list[1]['department_name']                  
                                );
                 $data[] = array(
                                   'department_id' => $get_dept_list[2]['department_id'],
                                   'department_name' => $get_dept_list[2]['department_name']                  
                                );
                //  $data[] = array(
                //                    'department_id' => $get_dept_list[4]['department_id'],
                //                    'department_name' => $get_dept_list[4]['department_name']                  
                //                );	
            	  
              
              	  $response['error_code'] = "200";
                  $response['message'] = "Data Found";
                  $response['data'] = $data;
                  echo json_encode($response);
                  exit();
            }
            else
            {
              $response['error_code'] = "404";
              $response['message'] = "Department list Not Found";
              echo json_encode($response);
              exit();
            }
        }
        // public function get_department_list()
        // {
         
		// 	$get_dept_list = $this->ApiModel->getAllData1('departement');
        //     if(!empty($get_dept_list))
        //     {
        //         $data = array();
        //     	   foreach($get_dept_list as $g_d_l)
        //         {
        //             $data[] = array(
        //                 'department_id' => $g_d_l['department_id'],
        //                 'department_name' => $g_d_l['department_name']                  
        //              );
        //         }
              
        //       	  $response['error_code'] = "200";
        //           $response['message'] = "Data Found";
        //           $response['data'] = $data;
        //           echo json_encode($response);
        //           exit();
        //     }
        //     else
        //     {
        //       $response['error_code'] = "404";
        //       $response['message'] = "Department list Not Found";
        //       echo json_encode($response);
        //       exit();
        //     }
        // }
      
        //staff login //Ravina
      
    //     public function staff_login()
    //     {
    //       if(!empty($this->input->post('mobile')) && !empty($this->input->post('department_id')))
    //       { 
    //       		$mobile = $this->input->post('mobile');
    //             $department_id = $this->input->post('department_id');
				// $user_type = '';
    //             $wh = '(department_id = "'.$department_id.'")';

    //             $depart_data = $this->ApiModel->getData('departement',$wh);
				// if(!empty($depart_data))
    //             {
    //               	  if($depart_data['department_name'] == "Room Service")
    //                   {
    //                       $user_type = 10;
    //                   }
    //                   else
    //                   {
    //                       if($depart_data['department_name'] == "Food & Beverages")
    //                       {
    //                           $user_type = 8;
    //                       }
    //                       else
    //                       {
    //                           if($depart_data['department_name'] == "Housekeeping Service")
    //                           {
    //                               $user_type = 9;
    //                           }
    //                       }
    //                   }
    //             }
               

    //             $wh1 = '(user_type = "'.$user_type.'" AND mobile_no = "'.$mobile.'")';
				// $staff = $this->ApiModel->getData('register',$wh1);
    //             if($staff)
    //             {
    //               	$rand_no = rand('1111','9999');
                  
    //               	if($staff['is_active'] == 1)
    //                 {
    //                   	$send_data = array(
    //                                             'u_id' => $staff['u_id'],
    //                       						'department_id' => $department_id,
    //                                             'hotel_id' => $staff['hotel_id'],

    //                                         );
                      
    //                   	$arr = array(
    //                                   'otp' => $rand_no,
    //                                 );
                      
				// 		$wh_mob = '(mobile_no ="'.$mobile.'")';
    //                     $up = $this->ApiModel->edit_data('register',$wh_mob,$arr);

						
    //                     $response['error_code'] = "200";
    //                     $response['message'] = "You Have Successfully Logged in";
    //                     $response['data'] = $send_data;
    //                     $response['otp'] = $rand_no;
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //                 else
    //                 {
    //                     $response['error_code'] = "401";
    //                     $response['message'] = "Your Account is deactivated";
    //                     echo json_encode($response);
    //                     exit();
    //                 }
    //             }
    //             else
    //             {
    //                 $response['error_code'] = "401";
    //                 $response['message'] = "Mobile OR department id Doesn't Match. Please Check";
    //                 echo json_encode($response);
    //                 exit();
    //             }
                  
                
    //       }
    //       else
    //       {
    //           $response['error_code'] = "406";
    //           $response['message'] = "Required Parameter Missing..!";
    //           echo json_encode($response);
    //           exit();
    //       }
    //     }
    
    
    
           public function staff_login()
{
    // Validate input parameters
    $mobile = $this->input->post('mobile', true);
    $department_id = $this->input->post('department_id', true);

    if (empty($mobile) || empty($department_id)) {
        echo json_encode([
            'error_code' => "406",
            'message' => "Required Parameter Missing..!"
        ]);
        exit();
    }

    // Fetch department data
    $depart_data = $this->ApiModel->getData('departement', ['department_id' => $department_id]);

    if (empty($depart_data)) {
        echo json_encode([
            'error_code' => "401",
            'message' => "Invalid department ID. Please check."
        ]);
        exit();
    }

    // Assign user type based on department name
    $department_mapping = [
        "Room Service" => 10,
        "Food & Beverages" => 8,
        "Housekeeping Service" => 9
    ];

    $user_type = $department_mapping[$depart_data['department_name']] ?? null;

    if (!$user_type) {
        echo json_encode([
            'error_code' => "401",
            'message' => "Invalid department mapping. Please contact admin."
        ]);
        exit();
    }

    // Fetch staff data
    $staff = $this->ApiModel->getData('register', [
        'user_type' => $user_type,
        'mobile_no' => $mobile
    ]);

    if (!$staff) {
        echo json_encode([
            'error_code' => "401",
            'message' => "Mobile number or department ID doesn't match. Please check."
        ]);
        exit();
    }

    // Check if account is active
    if ($staff['is_active'] != 1) {
        echo json_encode([
            'error_code' => "401",
            'message' => "Your account is deactivated. Please contact support."
        ]);
        exit();
    }

    // Generate OTP and update it in the database
    $rand_no = rand(1111, 9999);
    $this->ApiModel->edit_data('register', ['mobile_no' => $mobile], ['otp' => $rand_no]);

    // Prepare response data
    $send_data = [
        'u_id' => $staff['u_id'],
        'department_id' => $department_id,
        'hotel_id' => $staff['hotel_id']
    ];

    echo json_encode([
        'error_code' => "200",
        'message' => "You have successfully logged in.",
        'data' => $send_data,
        'otp' => $rand_no
    ]);
    exit();
}
    
    
      
        public function get_hotel_logo()
        {
          	if(!empty($this->input->post('mobile')))
            {
              	$mobile = $this->input->post('mobile');
                $check_mobile_number = $this->ApiModel->check_mobile($mobile);
                if($check_mobile_number)
                {
                    foreach($check_mobile_number as $c)
                    {
                        //$hotel_logo = "";
                      	$wh = '(u_id ="'.$c['hotel_id'].'")';
                        $get_hotel_name = $this->ApiModel->getData('register',$wh);
                        if(!empty($get_hotel_name))
                        {
                          	$hotel_logo = $get_hotel_name['hotel_logo'];
                        } 
                        else
                        {
                            $hotel_logo = "";
                        }
                      
                        $arr = array(
                                    	'hotel_logo' => $hotel_logo 
                                    );
 
                    }
                  
                    $response['error_code'] = "200";
                    $response['message'] = "Success";
                    $response['data'] = $arr;
                    echo json_encode($response);
                    exit();
                	
                }
              	else
                {
                    $response['error_code'] = "401";
                    $response['message'] = "Data Not Found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Required Parameter Missing..!";
                echo json_encode($response);
                exit();
            }
        }

		//verify otp //Ravina
        public function verify_otp()
        {
          	if(!empty($this->input->post('mobile')) && !empty($this->input->post('otp')))
            {
              	$mobile = $this->input->post('mobile');
                $otp = $this->input->post('otp');
              
              	$wh = '(mobile_no ="'.$mobile.'" AND otp = "'.$otp.'")';
              	$get_user = $this->ApiModel->getData('register',$wh);
                if($get_user)
                {
                  	$arr = array(
                                    'is_otp_verified' => 1    
                                );

                    $up = $this->ApiModel->edit_data('register',$wh,$arr);

                    if($up)
                    {
                        $send_data[] = array(
                                                'u_id' => $get_user['u_id']
                                            );

                        $response['error_code'] = "200";
                        $response['message'] = "OTP verified successfully..";
                        $response['data'] = $send_data;
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
                else
                {
                    $response['error_code'] = "401";
                    $response['message'] = "Mobile no and OTP Doest not match";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Required Parameter Missing..!";
                echo json_encode($response);
                exit();
            }
        }

		//get staff details //Ravina
      
        public function get_staff_details()
        {
           if(!empty($this->input->post('u_id')))
           {
                 $u_id = $this->input->post('u_id');
         
                 $wh = '(u_id ="'.$u_id.'")';
                 $get_user_data = $this->ApiModel->getData('register',$wh);
                 //print_r($get_user_data);
                 if(!empty($get_user_data))
                 {
                     $wh = '(u_id ="'.$get_user_data['hotel_id'].'")';
                     $get_hotel_name = $this->ApiModel->getData('register',$wh);
                     if(!empty($get_hotel_name))
                     {
                         $hotel_name = $get_hotel_name['hotel_name'];
                         $hotel_img = $get_hotel_name['hotel_logo'];
                     }
                     else
                     {
                         $hotel_name = '';
                         $hotel_img = '';
                     }
                 }
                 else
                 {
                     $response['error_code'] = "403";
                     $response['message'] = "Data Not Available";
                     echo json_encode($response);
                     exit();
                 }

                 $send_data = array(
                                       'u_id' =>$u_id,
                                       'full_name' => $get_user_data['full_name'],  
                                       'hotel_name' =>$hotel_name,
                                       'hotel_logo' =>$hotel_img,
                                       'hotel_id' => $get_user_data['hotel_id'],
                                   );

                 $response['error_code'] = "200";
                 $response['message'] = "Success";
                 $response['data'] = $send_data;
                 echo json_encode($response);
                 exit();
           }
           else
           {
              $response['error_code'] = "406";
              $response['message'] = "Required Parameter Missing..!";
              echo json_encode($response);
              exit();
           }
        }
      
      	//get staff all orders //Ravina
        public function get_all_staff_orders()
        {
           if(!empty($this->input->post('u_id')))
           {
                $data = array();
                $send_data = array();
             	$u_id = $this->input->post('u_id');
                //$department_id = $this->input->post('department_id');
                $todays_date = date('Y-m-d');
             
               
                    $user_type = '';
                    $wh_dept = '(u_id = "'.$u_id.'")';

                    $depart_data = $this->ApiModel->getData('register',$wh_dept);
                    //print_r($depart_data);die;
                    if(!empty($depart_data))
                    {
                          if($depart_data['user_type'] == "10") //Room Service
                          {
                              $user_type = 10;
                          }
                          else
                          {
                              if($depart_data['user_type'] == "8") //Food & Beverages
                              {
                                  $user_type = 8;
                              }
                              else
                              {
                                  if($depart_data['user_type'] == "9") //Housekeeping Service
                                  {
                                      $user_type = 9;
                                  }
                              }
                          }
                    }
             
              		if($user_type == 9) 
                    {
                        $wh = '(staff_id ="'.$u_id.'" AND accept_date ="'.$todays_date.'" AND order_status = 1)';
                        $get_house_keeping_staff_orders = $this->ApiModel->getAllData('house_keeping_orders', $wh);                                            
                        if(!empty($get_house_keeping_staff_orders))
                        {

                           foreach($get_house_keeping_staff_orders as $h_s_order)
                           {
                                 //$date = $h_s_order['accept_date'];                         
                                 //$date_time =date('d M | g:i A',strtotime($date));
                                
                                 $date = $h_s_order['accept_date'];    //g:i A
                                 $time = $h_s_order['accept_time'];
                                 $date_time =date('d M',strtotime($date));
                                 $time_1=date('g:i A',strtotime($time));
                             
                                 //get room number
                             
                                 $booking_id = '';
                                 $r_no = '';

                                 $wh_rm_no_s1 = '(booking_id ="'.$h_s_order['booking_id'].'" AND hotel_id ="'.$h_s_order['hotel_id'].'")';
                                 $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                 //print_r($get_rm_no_s1);
                                 if(!empty($get_rm_no_s1))
                                 {
                                   $booking_id = $get_rm_no_s1['booking_id'];
                                 }

                                 $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                 $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                 {
                                   $r_no = $get_rm_no_s['room_no'];
                                 } 

                                //get all order details
                                $wh_o_details = '(h_k_order_id ="'.$h_s_order['h_k_order_id'].'")';
                                $get_orders_details = $this->ApiModel->getAllData('house_keeping_order_details',$wh_o_details);
                                if(!empty($get_orders_details))
                                {
                                  	$send_data = array();
                                    foreach($get_orders_details as $o_details)
                                    {
                                        $wh_service = '(h_k_services_id ="'.$o_details['h_k_service_id'].'")';
                                        $get_all_services = $this->ApiModel->getData('house_keeping_services',$wh_service);
                                        if(!empty($get_all_services))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_services['h_k_services_id'],
                                                                    'service_type' =>$get_all_services['service_type'],
                                              						'image' =>$get_all_services['icon'],
                                              						'quantity' => $o_details['quantity']                                          						
                                                                );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $h_s_order['h_k_order_id'],
                                                    'room_no' => $r_no,	
                                                    'additional_note' => $h_s_order['additional_note'],              
                                                    'date' => $date_time." | ".$time_1,
                                  					//'quantity' => $o_details['quantity'],
                                                    'services' =>$send_data,
                                                    'order_flag' =>1
                                               );
                           }          
                        }
                        
                        //laundry orders
                        $wh1 = '(staff_id ="'.$u_id.'" AND  accept_date ="'.$todays_date.'" AND order_status = 1)';
                        $get_laundry_orders = $this->ApiModel->getAllData('cloth_orders', $wh1);

                        if(!empty($get_laundry_orders)) 
                        {

                             foreach($get_laundry_orders as $laundry_order)
                             {
                                  //$date1 = $laundry_order['accept_date'];                         
                                  //$date_time1 =date('d M | g:i A',strtotime($date1));
                               
                                  $date = $laundry_order['accept_date'];    //g:i A
                                  $time = $laundry_order['accept_date'];
                                  $date_time =date('d M',strtotime($date));
                                  $time_1=date('g:i A',strtotime($time));
                               
                                  //get room number
                                  
                                   $booking_id = '';
                                   $r_no = '';

                                   $wh_rm_no_s1 = '(booking_id ="'.$laundry_order['booking_id'].'" AND hotel_id ="'.$laundry_order['hotel_id'].'")';
                                   $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                   //print_r($get_rm_no_s1);
                                   if(!empty($get_rm_no_s1))
                                   {
                                     $booking_id = $get_rm_no_s1['booking_id'];
                                   }

                                   $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                   $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                   if(!empty($get_rm_no_s))
                                   {
                                     $r_no = $get_rm_no_s['room_no'];
                                   } 


                                  //get all laundry order details
                                  $wh_o_details_laundry = '(cloth_order_id ="'.$laundry_order['cloth_order_id'].'")';
                                  $get_laundry_orders_details = $this->ApiModel->getAllData('cloth_order_details',$wh_o_details_laundry);
                                  if(!empty($get_laundry_orders_details))
                                  {
                                      $send_data = array();
                                      foreach($get_laundry_orders_details as $o_laundry_details)
                                      {
                                          $wh_l_service = '(cloth_id ="'.$o_laundry_details['cloth_id'].'")';
                                          $get_all_cloths = $this->ApiModel->getData('cloth',$wh_l_service);
                                          if(!empty($get_all_cloths))
                                          {

                                              $send_data1[] = array(
                                                                      'services_id'=>$get_all_cloths['cloth_id'],
                                                					  'image' =>$get_all_cloths['image'],
                                                                      'service_type' =>$get_all_cloths['cloth_name'],
                                                					  'quantity' => $o_laundry_details['quantity'],
                                                					  
                                                                );
                                          }
                                      }

                                  }

                                  $data[] = array(
                                                      'order_id' => $laundry_order['cloth_order_id'],
                                                      'room_no' => $r_no,
                                                      'additional_note' => $laundry_order['additional_note'],
                                                      'date' => $date_time." | ".$time_1,
                                                      'services' =>$send_data1,
                                                      'order_flag' =>2
                                                  );
                             }
                        }
                      
                        $get_house_keeping_staff_orders_count = $this->ApiModel->getCount_housekeeping_orders('house_keeping_orders',$wh); 
                        $get_laundry_staff_orders_count = $this->ApiModel->getCount_housekeeping_cloth_orders('cloth_orders', $wh1);
                        $total_orders_count = $get_house_keeping_staff_orders_count[0]['total_count'] + $get_laundry_staff_orders_count[0]['total_count'];
                        
                        
                    }
                    elseif($user_type == 8)
                    {
                         // $send_data = array();
                      	  //services orders
                          $wh = '(staff_id ="'.$u_id.'" AND  accept_date ="'.$todays_date.'" AND order_status = 1)';
                          $get_food_staff_orders = $this->ApiModel->getAllData('food_orders', $wh);
                          //print_r( $get_food_staff_orders);die;
                          if(!empty($get_food_staff_orders))
                          {
                              foreach($get_food_staff_orders as $food_order)
                              {
                                  //$date = $food_order['accept_date'];                         
                                  //$date_time =date('d M | g:i A',strtotime($date));
                                
                                  $date = $food_order['accept_date'];    //g:i A
                                  $time = $food_order['accept_time'];
                                  $date_time =date('d M',strtotime($date));
                                  $time_1=date('g:i A',strtotime($time));
                                
                                  //get room number
                                 
                                  $booking_id = '';
                                  $r_no = '';

                                  $wh_rm_no_s1 = '(booking_id ="'.$food_order['booking_id'].'" AND hotel_id ="'.$food_order['hotel_id'].'")';
                                  $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                   //print_r($get_rm_no_s1);
                                  if(!empty($get_rm_no_s1))
                                  {
                                     $booking_id = $get_rm_no_s1['booking_id'];
                                  }

                                  $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                  $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                //   print_r($get_rm_no_s);
                                  if(!empty($get_rm_no_s))
                                  {
                                     $r_no = $get_rm_no_s['room_no'];
                                  } 

                                  //get all order details
                                  $wh_o_details = '(food_order_id ="'.$food_order['food_order_id'].'")';
                                  $get_orders_details = $this->ApiModel->getAllData('food_order_details',$wh_o_details); //getAllData
                                  //print_r($get_orders_details);
                                  if(!empty($get_orders_details))
                                  {
                                      $send_data = array();
                                      foreach($get_orders_details as $ord_details)
                                      {
                                          
                                          $wh_menu = '(food_item_id ="'.$ord_details['food_items_id'].'")';
                                          $get_all_menus = $this->ApiModel->getData('food_menus',$wh_menu);
                                          //print_r($get_all_menus);
                                          if(!empty($get_all_menus))
                                          {

                                              $send_data[] = array(
                                                                      'services_id'=>$get_all_menus['food_item_id'],
                                                					  'image' =>$get_all_menus['item_img'],
                                                                      'service_type' =>$get_all_menus['items_name'],
                                                					  'quantity' => $ord_details['quantity'],
                                                                  );
                                          }
                                      }

                                  }

                                  $data[] = array(
                                                    'order_id' => $food_order['food_order_id'],
                                                    'room_no' => $r_no,
                                                    'additional_note' => $food_order['additional_note'],
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data,
                                    				'order_flag' =>1
                                                 );
                              }
                          }
                         $total_orders_count = $this->ApiModel->getCount_food_orders('food_orders', $wh);
                         //print_r($total_orders_count);
                    }
             		elseif($user_type == 10)
                    {
                        //menus orders of room services
                        $wh = '(staff_id ="'.$u_id.'" AND accept_date ="'.$todays_date.'" AND order_status = 1)';
                        $get_rm_menus_staff_orders = $this->ApiModel->getAllData('room_service_menu_orders', $wh); 
                        if(!empty($get_rm_menus_staff_orders))
                        {

                           foreach($get_rm_menus_staff_orders as $r_s_order)
                           {
                                $date = $r_s_order['accept_date'];    //g:i A
                                $time = $r_s_order['accept_time'];
                                $date_time =date('d M',strtotime($date));
                                $time_1=date('g:i A',strtotime($time));                                                            
                             
                             	//get room number
                             	
                                 $booking_id = '';
                                 $r_no = '';

                                 $wh_rm_no_s1 = '(booking_id ="'.$r_s_order['booking_id'].'" AND hotel_id ="'.$r_s_order['hotel_id'].'")';
                                 $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                 //print_r($get_rm_no_s1);
                                 if(!empty($get_rm_no_s1))
                                 {
                                   $booking_id = $get_rm_no_s1['booking_id'];
                                 }

                                 $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                 $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                 {
                                   $r_no = $get_rm_no_s['room_no'];
                                 } 

                                //get all order details
                                $wh_o_details = '(room_service_menu_order_id ="'.$r_s_order['room_service_menu_order_id'].'")';
                                $get_rm_orders_details = $this->ApiModel->getAllData('room_service_menu_details',$wh_o_details);
                                if(!empty($get_rm_orders_details))
                                {
                                  	$send_data = array();
                                    foreach($get_rm_orders_details as $o_details)
                                    {
                                        $wh_menu = '(room_serv_menu_id ="'.$o_details['room_serv_menu_id'].'")';
                                        $get_all_menu = $this->ApiModel->getData('room_serv_menu_list',$wh_menu);
                                        if(!empty($get_all_menu))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_menu['room_serv_menu_id'],
                                                                    'service_type' =>$get_all_menu['menu_name'],
                                              						'image'=>$get_all_menu['image'],
                                              						'quantity' => $o_details['quantity'] 
                                                              );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $r_s_order['room_service_menu_order_id'],
                                                    'room_no' => $r_no, 					
                                                    'additional_note' => $r_s_order['additional_note'],            
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data,
                                                    'order_flag' =>1
                                               );
                           }          
                        }

                        //services orders
                        $wh_service = '(staff_id ="'.$u_id.'" AND accept_date ="'.$todays_date.'" AND order_status = 1)';
                        $get_rm_service_staff_orders = $this->ApiModel->getAllData('rmservice_services_orders', $wh_service); 
                        if(!empty($get_rm_service_staff_orders))
                        {

                           foreach($get_rm_service_staff_orders as $r_service_order)
                           {
                                 //$date = $r_service_order['accept_date'];                         
                                 //$date_time =date('d M | g:i A',strtotime($date));
                             
                                $date = $r_service_order['accept_date'];    //g:i A
                                $time = $r_service_order['accept_time'];
                                $date_time =date('d M',strtotime($date));
                                $time_1=date('g:i A',strtotime($time));
                             
                                //get room number
                             	
                                $booking_id = '';
                                $r_no = '';

                                 $wh_rm_no_s1 = '(booking_id ="'.$r_service_order['booking_id'].'" AND hotel_id ="'.$r_service_order['hotel_id'].'")';
                                 $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                 //print_r($get_rm_no_s1);
                                 if(!empty($get_rm_no_s1))
                                 {
                                   $booking_id = $get_rm_no_s1['booking_id'];
                                 }

                                 $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                 $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                 {
                                   $r_no = $get_rm_no_s['room_no'];
                                 } 

                                //get all order details
                                $wh_o_details = '(rmservice_services_order_id ="'.$r_service_order['rmservice_services_order_id'].'")';
                                $get_rm_service_details = $this->ApiModel->getAllData('rmservice_services_details',$wh_o_details);
                                if(!empty($get_rm_service_details))
                                {
                                  	$send_data = array();
                                    foreach($get_rm_service_details as $o_details_service)
                                    {
                                        $wh_menu = '(r_s_services_id ="'.$o_details_service['room_serv_service_id'].'")';
                                        $get_all_menu = $this->ApiModel->getData('room_servs_services',$wh_menu);
                                        if(!empty($get_all_menu))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_menu['r_s_services_id'],
                                                                    'service_type' =>$get_all_menu['service_name'],
                                              						'image' =>$get_all_menu['icon_img'],
                                              						'quantity' => $o_details_service['quantity'],
                                                                );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $r_service_order['rmservice_services_order_id'],
                                                    'room_no' => $r_no, 					
                                                    'additional_note' => $r_service_order['additional_note'],            
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data,
                                                    'order_flag' =>2
                                               );
                           }          
                        }
                      
                        $get_rm_menus_staff_menu_orders = $this->ApiModel->getCount_room_service_menu_orders('room_service_menu_orders', $wh); 
                        $get_rm_service_orders = $this->ApiModel->getCount_room_service_orders('rmservice_services_orders', $wh_service); 
                        $total_orders_count = $get_rm_menus_staff_menu_orders[0]['total_count'] + $get_rm_service_orders[0]['total_count'];
                      
                    }
                      	 
                    if(!empty($get_house_keeping_staff_orders) || !empty($get_laundry_orders) || !empty($get_food_staff_orders) || !empty($get_rm_menus_staff_orders) || !empty($get_rm_service_staff_orders))
                    {
                      	$response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $data;
                        $response['total_orders'] = $total_orders_count;
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }           
                
           }
           else
           {
              $response['error_code'] = "406";
              $response['message'] = "Required Parameter Missing..!";
              echo json_encode($response);
              exit();
           }
        
        }
     
        public function view_order_details()
        {
            if(!empty($this->input->post('u_id')) && !empty($this->input->post('order_id')) && !empty($this->input->post('flag')))
            {
                    $u_id = $this->input->post('u_id');
                    $order_id = $this->input->post('order_id');
                    $flag = $this->input->post('flag');
              
              		$send_data = array();
                    $send_data1 = array();
              
                    $user_type = '';
                    $wh_dept = '(u_id = "'.$u_id.'")';

                    $depart_data = $this->ApiModel->getData('register',$wh_dept);
                    //print_r($depart_data);die;
                    if(!empty($depart_data))
                    {
                        if($depart_data['user_type'] == "10") //Room Service
                        {
                            $user_type = 10;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "8") //Food & Beverages
                            {
                                $user_type = 8;
                            }
                            else
                            {
                                if($depart_data['user_type'] == "9") //Housekeeping Service
                                {
                                    $user_type = 9;
                                }
                            }
                        }
                    }

                    if($user_type == 9)
                    {
                        if($flag == 1)
                        {
                            $wh_h_ord = '(h_k_order_id ="'.$order_id.'")';
                            $get_house_keeping_staff_orders = $this->ApiModel->getAllData('house_keeping_orders', $wh_h_ord);                   
                            if(!empty($get_house_keeping_staff_orders))
                            {                   
                                foreach($get_house_keeping_staff_orders as $h_s_order)
                                {
                                    //$date = $h_s_order['accept_date'];                         
                                    //$date_time =date('d M | g:i A',strtotime($date));
                                  
                                    $date = $h_s_order['accept_date'];    //g:i A
                                    $time = $h_s_order['accept_time'];
                                    $date_time =date('d M',strtotime($date));
                                    $time_1=date('g:i A',strtotime($time));

                                    //get room number
                                    
                                     $booking_id = '';
                                     $r_no = '';

                                     $wh_rm_no_s1 = '(booking_id ="'.$h_s_order['booking_id'].'" AND hotel_id ="'.$h_s_order['hotel_id'].'")';
                                     $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                     //print_r($get_rm_no_s1);
                                     if(!empty($get_rm_no_s1))
                                     {
                                       $booking_id = $get_rm_no_s1['booking_id'];
                                     }

                                     $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                     $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                     if(!empty($get_rm_no_s))
                                     {
                                       $r_no = $get_rm_no_s['room_no'];
                                     } 


                                    //get all order details
                                    $wh_o_details = '(h_k_order_id ="'.$h_s_order['h_k_order_id'].'")';
                                    $get_orders_details = $this->ApiModel->getAllData('house_keeping_order_details',$wh_o_details);
                                    if(!empty($get_orders_details))
                                    {
                                        
                                        foreach($get_orders_details as $o_details)
                                        {
                                            $wh_service = '(h_k_services_id ="'.$o_details['h_k_service_id'].'")';
                                            $get_all_services = $this->ApiModel->getData('house_keeping_services',$wh_service);
                                            if(!empty($get_all_services))
                                            {

                                                $send_data[] = array(
                                                                        'services_id'=>$get_all_services['h_k_services_id'],                                   
                                                                        'service_type' =>$get_all_services['service_type'],
                                                  						'image' =>$get_all_services['icon'],
                                                  						'quantity' => $o_details['quantity'],
                                                                );
                                            }
                                        }

                                    }

                                    $data = array(
                                                    'order_id' => $h_s_order['h_k_order_id'],
                                                    'room_no' => $r_no,
                                                    'additional_note' => $h_s_order['additional_note'],
                                                    //'quantity' => $o_details['quantity'],
                                                    'date' => $date_time."|".$time_1,
                                                    'services' =>$send_data,             
                                                );
                                }

                            }
                         }
                        //laundry orders
                        if($flag == 2)
                        {
                            $wh1 = '(cloth_order_id ="'.$order_id.'")';
                            $get_laundry_orders = $this->ApiModel->getAllData('cloth_orders', $wh1);
                            if(!empty($get_laundry_orders)) 
                            {

                                    foreach($get_laundry_orders as $laundry_order)
                                    {
                                        //$date1 = $laundry_order['accept_date'];                         
                                        //$date_time1 =date('d M | g:i A',strtotime($date1));
                                      
                                        $date = $laundry_order['accept_date'];    //g:i A
                                        $time = $laundry_order['accept_time'];
                                        $date_time =date('d M',strtotime($date));
                                        $time_1=date('g:i A',strtotime($time));
                                      
                                        //get room number
                                        
                                         $booking_id = '';
                                         $r_no = '';

                                         $wh_rm_no_s1 = '(booking_id ="'.$laundry_order['booking_id'].'" AND hotel_id ="'.$laundry_order['hotel_id'].'")';
                                         $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                         //print_r($get_rm_no_s1);
                                         if(!empty($get_rm_no_s1))
                                         {
                                           $booking_id = $get_rm_no_s1['booking_id'];
                                         }

                                         $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                         $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                         if(!empty($get_rm_no_s))
                                         {
                                           $r_no = $get_rm_no_s['room_no'];
                                         } 


                                        //get all laundry order details
                                        $wh_o_details_laundry = '(cloth_order_id ="'.$laundry_order['cloth_order_id'].'")';
                                        $get_laundry_orders_details = $this->ApiModel->getAllData('cloth_order_details',$wh_o_details_laundry);
                                        if(!empty($get_laundry_orders_details))
                                        {
                                            foreach($get_laundry_orders_details as $o_laundry_details)
                                            {
                                                $wh_l_service = '(cloth_id ="'.$o_laundry_details['cloth_id'].'")';
                                                $get_all_cloths = $this->ApiModel->getData('cloth',$wh_l_service);
                                                if(!empty($get_all_cloths))
                                                {

                                                    $send_data1[] = array(
                                                                            'services_id'=>$get_all_cloths['cloth_id'],
                                                                            'service_type' =>$get_all_cloths['cloth_name'],
                                                      						'image' =>$get_all_cloths['image'],
                                                      						'quantity' => $o_laundry_details['quantity'],
                                                                    );
                                                }
                                            }

                                        }

                                        $data = array(
                                                            'order_id' => $laundry_order['cloth_order_id'],
                                                            'room_no' => $r_no, 
                                          					'additional_note' => $laundry_order['additional_note'], 
                                                            'date' => $date_time."|".$time_1,
                                                            'services' =>$send_data1
                                                        );
                                    }

                            }
                        }

                    }
                    elseif($user_type == 8)
                    {
                        $wh_f_ord = '(food_order_id ="'.$order_id.'")';
                        $get_menu_order_details = $this->ApiModel->getAllData('food_orders',$wh_f_ord);
                        if(!empty($get_menu_order_details))
                        {
                            foreach($get_menu_order_details as $food_order)
                            {
                                //$date = $food_order['accept_date'];                         
                                //$date_time =date('d M | g:i A',strtotime($date));
                              
                                $date = $food_order['accept_date'];    //g:i A
                                $time = $food_order['accept_time'];
                                $date_time =date('d M',strtotime($date));
                                $time_1=date('g:i A',strtotime($time));
                              
                                //get room number
                                
                                $booking_id = '';
                                $r_no = '';

                                $wh_rm_no_s1 = '(booking_id ="'.$food_order['booking_id'].'" AND hotel_id ="'.$food_order['hotel_id'].'")';
                                $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                //print_r($get_rm_no_s1);
                                if(!empty($get_rm_no_s1))
                                {
                                  $booking_id = $get_rm_no_s1['booking_id'];
                                }

                                $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                if(!empty($get_rm_no_s))
                                {
                                  $r_no = $get_rm_no_s['room_no'];
                                } 


                                //get all order details
                                $wh_o_details = '(food_order_id ="'.$food_order['food_order_id'].'")';
                                $get_orders_details = $this->ApiModel->getAllData('food_order_details',$wh_o_details);
                                if(!empty($get_orders_details))
                                {
                                    foreach($get_orders_details as $ord_details)
                                    {
                                        $wh_menu = '(food_item_id ="'.$ord_details['food_items_id'].'")';
                                        $get_all_menus = $this->ApiModel->getData('food_menus',$wh_menu);
                                        if(!empty($get_all_menus))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_menus['food_item_id'],
                                                                    'service_type' =>$get_all_menus['items_name'],
                                              						'image' =>$get_all_menus['item_img'],
                                              						'quantity' => $ord_details['quantity']
                                                                );
                                        }
                                    }
                                
                                }
                            
                                $data = array(
                                                'order_id' => $food_order['food_order_id'],
                                                'room_no' => $r_no,  
                                  				'additional_note' => $food_order['additional_note'], 
                                                'date' => $date_time."|".$time_1,
                                                'services' =>$send_data,
                                            );
                            }
        
                        }
                    }   
              		elseif($user_type == 10)
                    {
                            if($flag == 1)
                            {
                                //menus orders of room services
                                $wh = '(room_service_menu_order_id ="'.$order_id.'")';
                                $get_rm_menus_staff_orders = $this->ApiModel->getAllData('room_service_menu_orders', $wh); 
                                if(!empty($get_rm_menus_staff_orders))
                                {
                                    foreach($get_rm_menus_staff_orders as $r_s_order)
                                    {
                                            //$date = $r_s_order['accept_date'];                         
                                            //$date_time =date('d M | g:i A',strtotime($date));
                                        	$date = $r_s_order['accept_date'];    //g:i A
                                            $time = $r_s_order['accept_time'];
                                            $date_time =date('d M',strtotime($date));
                                            $time_1=date('g:i A',strtotime($time));
                                      
                                            //get room number
                                           
                                       		$booking_id = '';
                                            $r_no = '';

                                            $wh_rm_no_s1 = '(booking_id ="'.$r_s_order['booking_id'].'" AND hotel_id ="'.$r_s_order['hotel_id'].'")';
                                            $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                            //print_r($get_rm_no_s1);
                                            if(!empty($get_rm_no_s1))
                                            {
                                              $booking_id = $get_rm_no_s1['booking_id'];
                                            }

                                            $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                            $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                            if(!empty($get_rm_no_s))
                                            {
                                              $r_no = $get_rm_no_s['room_no'];
                                            } 

                                            //get all order details
                                            $wh_o_details = '(room_service_menu_order_id ="'.$r_s_order['room_service_menu_order_id'].'")';
                                            $get_rm_orders_details = $this->ApiModel->getAllData('room_service_menu_details',$wh_o_details);
                                            if(!empty($get_rm_orders_details))
                                            {
                                                foreach($get_rm_orders_details as $o_details)
                                                {
                                                    $wh_menu = '(room_serv_menu_id ="'.$o_details['room_serv_menu_id'].'")';
                                                    $get_all_menu = $this->ApiModel->getData('room_serv_menu_list',$wh_menu);
                                                    if(!empty($get_all_menu))
                                                    {
            
                                                        $send_data[] = array(
                                                                                'services_id'=>$get_all_menu['room_serv_menu_id'],
                                                                                'service_type' =>$get_all_menu['menu_name'],
                                                          						'image' =>$get_all_menu['image'],
                                                          						'quantity' => $o_details['quantity'], 
                                                                            );
                                                    }
                                                }
            
                                            }
            
                                            $data = array(
                                                                'order_id' => $r_s_order['room_service_menu_order_id'],
                                                                'room_no' => $r_no, 					
                                                                'additional_note' => $r_s_order['additional_note'],             
                                                                'date' => $date_time."|".$time_1,
                                                                'services' =>$send_data      
                                                        );
                                    }          
                                }
                            }
                            elseif($flag == 2)
                            {
                                //services orders
                                $wh_service = '(rmservice_services_order_id  ="'.$order_id.'")';
                                $get_rm_service_staff_orders = $this->ApiModel->getAllData('rmservice_services_orders', $wh_service); 
                                if(!empty($get_rm_service_staff_orders))
                                {
                                    foreach($get_rm_service_staff_orders as $r_service_order)
                                    {
                                        //$date = $r_service_order['accept_date'];                         
                                        //$date_time =date('d M | g:i A',strtotime($date));
										$date = $r_service_order['accept_date'];    //g:i A
                                        $time = $r_service_order['accept_time'];
                                        $date_time =date('d M',strtotime($date));
                                        $time_1=date('g:i A',strtotime($time));
                                      
                                      
                                      	//get room number
                                       
                                      	$booking_id = '';
                                        $r_no = '';

                                        $wh_rm_no_s1 = '(booking_id ="'.$r_service_order['booking_id'].'" AND hotel_id ="'.$r_service_order['hotel_id'].'")';
                                        $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                        //print_r($get_rm_no_s1);
                                        if(!empty($get_rm_no_s1))
                                        {
                                          $booking_id = $get_rm_no_s1['booking_id'];
                                        }

                                        $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                        $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                        if(!empty($get_rm_no_s))
                                        {
                                          $r_no = $get_rm_no_s['room_no'];
                                        } 

                                      
                                        //get all order details
                                        $wh_o_details = '(rmservice_services_order_id ="'.$r_service_order['rmservice_services_order_id'].'")';
                                        $get_rm_service_details = $this->ApiModel->getAllData('rmservice_services_details',$wh_o_details);
                                        if(!empty($get_rm_service_details))
                                        {
                                            foreach($get_rm_service_details as $o_details_service)
                                            {
                                                $wh_menu = '(r_s_services_id ="'.$o_details_service['room_serv_service_id'].'")';
                                                $get_all_menu = $this->ApiModel->getData('room_servs_services',$wh_menu);
                                                if(!empty($get_all_menu))
                                                {

                                                    $send_data[] = array(
                                                                            'services_id'=>$get_all_menu['r_s_services_id'],
                                                                            'service_type' =>$get_all_menu['service_name'],
                                                      						'image' =>$get_all_menu['icon_img'],
                                                      						'quantity' => $o_details_service['quantity'],  
                                                                        );
                                                }
                                            }

                                        }

                                        $data = array(
                                                            'order_id' => $r_service_order['rmservice_services_order_id'],
                                                            'room_no' => $r_no, 					
                                                            'additional_note' => $r_service_order['additional_note'],           
                                                            'date' => $date_time."|".$time_1,
                                                            'services' =>$send_data
                                                    );
                                    }          
                                }
                            }
                    }
              
              
                    if(!empty($get_house_keeping_staff_orders) || !empty($get_laundry_orders) || !empty($get_menu_order_details) || !empty($get_rm_menus_staff_orders) || !empty($get_rm_service_staff_orders))
                    {
                        $response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $data;
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }  
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Required Parameter Missing..!";
                echo json_encode($response);
                exit();
            }
        }
      		
        //staff verify otp for service order //Ravina
      	
		public function staff_verify_otp()  
        {
            if(!empty($this->input->post('u_id')) && !empty($this->input->post('order_id')) && !empty($this->input->post('otp')) && !empty($this->input->post('flag')))
            {
                $u_id = $this->input->post('u_id');
                $order_id = $this->input->post('order_id');
                $otp = $this->input->post('otp');
                $flag = $this->input->post('flag');

                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    //services orders
                    if($flag == 1)
                    {
                        $where = '(h_k_order_id ="'.$order_id.'" AND otp = "'.$otp.'")';
 
                        $check_otp = $this->ApiModel->getData('house_keeping_orders',$where);

                        if($check_otp)
                        {
                            $arr = array(
                                            'is_otp_verified' => 1,
                                            'order_status' => 2,
                              				'complete_date' => date('Y-m-d'),
                              				'complete_time' => date('H:i:s')
                                        );

                            $up = $this->ApiModel->edit_data('house_keeping_orders',$where,$arr);

                            if($up)
                            {
                               //add checkout bill
                                $wh_hk_c = '(hotel_id = "'.$check_otp['hotel_id'].'" AND u_id = "'.$check_otp['u_id'].'" AND booking_id = "'.$check_otp['booking_id'].'")';
                                
                                $c_o_data = $this->ApiModel->getData('user_checkout_data',$wh_hk_c);

                                $arr_ch_d = array(
                                                    'total_bill'=> $c_o_data['total_bill'] + $check_otp['order_total'],       
                                                );

                                $add_chk_data = $this->ApiModel->edit_data('user_checkout_data',$wh_hk_c,$arr_ch_d);
                                
                                if($add_chk_data)
                                {
                                    $description_hk = "Housekeeping";

                                    $booking_details = $this->ApiModel->get_user_booking_details_1($check_otp['hotel_id'],$check_otp['booking_id']);
            
                                    $date1 = $booking_details['check_in'];
                                    $date2 = $booking_details['check_out'];
                                    
                                    $check_out = $booking_details['check_out'];

                                    $check_in = $booking_details['check_in'];
     
                                    $diff = abs(strtotime($date2) - strtotime($date1));

                                    $years = floor($diff / (365*60*60*24));
                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    
                                    for($i = 0;$i < $days; $i++)
                                    {
                                        $wh_d = '(hotel_id = "'.$check_otp['hotel_id'].'" AND description = "'.$description_hk.'" AND date = "'.date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')).'" AND user_checkout_data_id = "'.$c_o_data['user_checkout_data_id'].'")'; 
                                       
                                        $chk_o_details = $this->ApiModel->getData('user_checkout_details',$wh_d); 

										$add_user_checkout_details = ""; 

                                        if($chk_o_details) 
                                        {
                                            if(date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) == date('Y-m-d'))
                                            {
                                                $amount1 = $chk_o_details['amount'] + $check_otp['order_total'];
                                            }
                                            else
                                            {
                                                $amount1 = 0;
                                            }

                                            $arr_ch_det = array(
                                                                'amount'=> $amount1,       
                                                                );

                                            $add_user_checkout_details = $this->ApiModel->edit_data('user_checkout_details',$wh_d,$arr_ch_det);
                                        }
                                        else
                                        {
                                            if(date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')) == date('Y-m-d'))
                                            {
                                                $amount2 = $check_otp['order_total'];
                                            }
                                            else
                                            {
                                                $amount2 = 0;
                                            }
                                            
                                            $arr_ch_det1 = array(
                                                                    'user_checkout_data_id'=> $c_o_data['user_checkout_data_id'],       
                                                                    'hotel_id'=> $check_otp['hotel_id'],       
                                                                    'description'=> $description_hk,       
                                                                    'date'=> date('Y-m-d',strtotime($booking_details['check_in']. '+'.$i. 'days')),
                                                                    'amount'=> $amount2
                                                                );

                                            $add_user_checkout_details = $this->ApiModel->insert_data('user_checkout_details',$arr_ch_det1);
                                        }
                                    }

                                    if($add_user_checkout_details)
                                    {
                                        $wh12 = '(hotel_id = "'.$check_otp['hotel_id'].'" AND user_checkout_data_id = "'.$c_o_data['user_checkout_data_id'].'" AND description_name = "'.$description_hk.'")';

                                        $user_checkout_sub_total1 = $this->ApiModel->getData('user_checkout_sub_total',$wh12);
                                        
                                        //add subtotal
                                        if($user_checkout_sub_total1)
                                        {
                                            $st_arr12 = array(
                                                            'sub_total' => $user_checkout_sub_total1['sub_total'] + $check_otp['order_total']
                                                            );
                
                                            $this->ApiModel->edit_data('user_checkout_sub_total',$wh12,$st_arr12);
                                        }
                                        else
                                        {
                                            //edit subtotal
                                            $st_arr22 = array(
                                                            'hotel_id' => $check_otp['hotel_id'],
                                                            'user_checkout_data_id' => $c_o_data['user_checkout_data_id'],
                                                            'description_name' => $description_hk,
                                                            'sub_total' => $check_otp['order_total']
                                                            );
                
                                            $this->ApiModel->insert_data('user_checkout_sub_total',$st_arr22);
                                        }
                                    }

                                }

                                // push notification for user
                                $wh = '(h_k_order_id = "' . $order_id . '")';
                                $get_u_id = $this->ApiModel->getData($tbl = 'house_keeping_orders', $wh);
                                $wh_i = '(u_id = "' . $get_u_id['hotel_id'] . '")';
                                $hotel_info = $this->ApiModel->getData($tbl = 'register', $wh_i);
                                $hotel_name = $hotel_info['hotel_name'];
                                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                                $get_dt = $this->ApiModel->getData($tbl = 'user_firebase_tokens', $wh1);
                                $title = "";
                                if(!empty($get_dt)){
                                    $deviceToken = $get_dt['token'];
                                    $title = 'Housekeeping Order Is Completed';
                                    $body = 'Your Housekeeping Order ID is "'.$order_id.'"';
                                    $result = send_push_notification($deviceToken, $title, $body);
                                }

                                // inside user app notification
                                $subject = $title;
                                $description = "$title In $hotel_name And Your Order Id Is $order_id";
                                $arr_noti = array(
                                                    'hotel_id' => $get_u_id['hotel_id'],
                                                    'u_id' => $get_u_id['u_id'],
                                                    'subject' => $subject,
                                                    'description' => $description,
                                                    'clear_flag' => 1,
                                                    'count_flag' => 1,
                                                );
                                //  print_r($arr_noti);die;
                                $this->ApiModel->insert_data('user_notification',$arr_noti);

                               //add notification
                                $arr = array(
                                              'u_id'=>$u_id,
                                              'hotel_id' => $depart_data['hotel_id'],
                                              'subject'=> 'Order Completed',
                                              'description' =>'Your Order is completed successfully',
                                              'notification_order_flag' =>0,       
                                           );

                                $add = $this->ApiModel->insert_data('staff_notification',$arr);

                                $response['error_code'] = "200";
                                $response['message'] = "You have successfully completed Order..";
                                //$response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                        else
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "OTP Doest not match";
                            echo json_encode($response);
                            exit();
                        }
                    }
                    elseif($flag == 2)
                    {
                        //laundry orders
                        $where_c_ord = '(cloth_order_id ="'.$order_id.'" AND otp = "'.$otp.'")';

                        $check_otp_cloth = $this->ApiModel->getData('cloth_orders',$where_c_ord);

                        if($check_otp_cloth)
                        {
                            $arr = array(
                                            'is_otp_verified' => 1,
                                            'order_status' => 2,
                              				'complete_date' => date('Y-m-d'),
                              				'complete_time' => date('H:i:s')
                                        );

                            $up = $this->ApiModel->edit_data('cloth_orders',$where_c_ord,$arr);

                            if($up)
                            {
                                //add checkout bill
                                $wh_ld_c = '(hotel_id = "'.$check_otp_cloth['hotel_id'].'" AND u_id = "'.$check_otp_cloth['u_id'].'" AND booking_id = "'.$check_otp_cloth['booking_id'].'")';
                                
                                $ld_c_o_data = $this->ApiModel->getData('user_checkout_data',$wh_ld_c);

                                $arr_ch_d_ld = array(
                                                    'total_bill'=> $ld_c_o_data['total_bill'] + $check_otp_cloth['order_total'],       
                                                );

                                $add_chk_data_ld = $this->ApiModel->edit_data('user_checkout_data',$wh_ld_c,$arr_ch_d_ld);
                                
                                if($add_chk_data_ld)
                                {
                                    $description_ld = "Laundry";

                                    $booking_details_1 = $this->ApiModel->get_user_booking_details_1($check_otp_cloth['hotel_id'],$check_otp_cloth['booking_id']);
            
                                    $date11 = $booking_details_1['check_in'];
                                    $date21 = $booking_details_1['check_out'];
                                    
                                    $check_out_1 = $booking_details_1['check_out'];

                                    $check_in_1 = $booking_details_1['check_in'];
     
                                    $diff_1 = abs(strtotime($date21) - strtotime($date11));

                                    $years_1 = floor($diff_1 / (365*60*60*24));
                                    $months_1 = floor(($diff_1 - $years_1 * 365*60*60*24) / (30*60*60*24));
                                    $days_1 = floor(($diff_1 - $years_1 * 365*60*60*24 - $months_1*30*60*60*24)/ (60*60*24));
                                    
                                    $days_1 = floor(($diff_1 - $years_1 * 365*60*60*24 - $months_1*30*60*60*24)/ (60*60*24));
                                    
                                    for($j = 0;$j < $days_1; $j++)
                                    {
                                        $wh_d1 = '(hotel_id = "'.$check_otp_cloth['hotel_id'].'" AND description = "'.$description_ld.'" AND date = "'.date('Y-m-d',strtotime($booking_details_1['check_in']. '+'.$j. 'days')).'" AND user_checkout_data_id = "'.$ld_c_o_data['user_checkout_data_id'].'")'; 

                                        $chk_o_details1 = $this->ApiModel->getData('user_checkout_details',$wh_d1); 

                                        $add_user_checkout_details1 = ""; 

                                        if($chk_o_details1) 
                                        {
                                            if(date('Y-m-d',strtotime($booking_details_1['check_in']. '+'.$j. 'days')) == date('Y-m-d'))
                                            {
                                                $amount1_ld = $chk_o_details1['amount'] + $check_otp_cloth['order_total'];
                                            }
                                            else
                                            {
                                                $amount1_ld = 0;
                                            }

                                            $arr_ch_det_ld = array(
                                                                'amount'=> $amount1_ld,       
                                                                );

                                            $add_user_checkout_details1 = $this->ApiModel->edit_data('user_checkout_details',$wh_d1,$arr_ch_det_ld);
                                        }
                                        else
                                        {
                                            if(date('Y-m-d',strtotime($booking_details_1['check_in']. '+'.$j. 'days')) == date('Y-m-d'))
                                            {
                                                $amount2_ld = $check_otp_cloth['order_total'];
                                            }
                                            else
                                            {
                                                $amount2_ld = 0;
                                            }
                                            
                                            $arr_ch_det1_ld = array(
                                                                    'user_checkout_data_id'=> $ld_c_o_data['user_checkout_data_id'],       
                                                                    'hotel_id'=> $check_otp_cloth['hotel_id'],       
                                                                    'description'=> $description_ld,       
                                                                    'date'=> date('Y-m-d',strtotime($booking_details_1['check_in']. '+'.$j. 'days')),
                                                                    'amount'=> $amount2_ld
                                                                );

                                            $add_user_checkout_details1 = $this->ApiModel->insert_data('user_checkout_details',$arr_ch_det1_ld);
                                        }
                                    }

                                    if($add_user_checkout_details1)
                                    {
                                        $wh12_ld = '(hotel_id = "'.$check_otp_cloth['hotel_id'].'" AND user_checkout_data_id = "'.$ld_c_o_data['user_checkout_data_id'].'" AND description_name = "'.$description_ld.'")';

                                        $user_checkout_sub_total1_ld = $this->ApiModel->getData('user_checkout_sub_total',$wh12_ld);
                                        
                                        //add subtotal
                                        if($user_checkout_sub_total1_ld)
                                        {
                                            $st_arr12_ld = array(
                                                                'sub_total' => $user_checkout_sub_total1_ld['sub_total'] + $check_otp_cloth['order_total']
                                                                );
                
                                            $this->ApiModel->edit_data('user_checkout_sub_total',$wh12_ld,$st_arr12_ld);
                                        }
                                        else
                                        {
                                            //edit subtotal
                                            $st_arr22_ld = array(
                                                                'hotel_id' => $check_otp_cloth['hotel_id'],
                                                                'user_checkout_data_id' => $ld_c_o_data['user_checkout_data_id'],
                                                                'description_name' => $description_ld,
                                                                'sub_total' => $check_otp_cloth['order_total']
                                                                );
                
                                            $this->ApiModel->insert_data('user_checkout_sub_total',$st_arr22_ld);
                                        }
                                    }
                                }

                                // push notification for user
                                $wh = '(cloth_order_id = "' . $order_id . '")';
                                $get_u_id = $this->ApiModel->getData($tbl = 'cloth_orders', $wh);
                                $wh_i = '(u_id = "' . $get_u_id['hotel_id'] . '")';
                                $hotel_info = $this->ApiModel->getData($tbl = 'register', $wh_i);
                                $hotel_name = $hotel_info['hotel_name'];
                                $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                                $get_dt = $this->ApiModel->getData($tbl = 'user_firebase_tokens', $wh1);
                                $title = "";
                                if(!empty($get_dt)){
                                    $deviceToken = $get_dt['token'];
                                    $title = 'Laundry Order Is Completed';
                                    $body = 'Your Laundry Order ID is "'.$order_id.'"';
                                    $result = send_push_notification($deviceToken, $title, $body);
                                }

                                // inside user app notification
                                $subject = $title;
                                $description = "$title In $hotel_name And Your Order Id Is $order_id";
                                $arr_noti = array(
                                                    'hotel_id' => $get_u_id['hotel_id'],
                                                    'u_id' => $get_u_id['u_id'],
                                                    'subject' => $subject,
                                                    'description' => $description,
                                                    'clear_flag' => 1,
                                                    'count_flag' => 1,
                                                );
                                //  print_r($arr_noti);die;
                                $this->ApiModel->insert_data('user_notification',$arr_noti);


                                //add notification
                               $arr = array(
                                              'u_id'=>$u_id,
                                              'hotel_id' => $depart_data['hotel_id'],
                                              'subject'=> 'Order Completed',
                                              'description' =>'Your Order is completed successfully',
                                              'notification_order_flag' =>0,       
                                           );

                               $add = $this->ApiModel->insert_data('staff_notification',$arr);


                                $response['error_code'] = "200";
                                $response['message'] = "You have successfully completed Order..";
                                //$response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                        else
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "OTP Doest not match";
                            echo json_encode($response);
                            exit();
                        }
                    }
                }
                elseif($user_type == 8)
                {
                    $where_food = '(food_order_id ="'.$order_id.'" AND otp = "'.$otp.'")';

                    $check_otp_food_ord = $this->ApiModel->getData('food_orders',$where_food);

                    if($check_otp_food_ord)
                    {
                        $arr = array(
                                        'is_otp_verified' => 1,
                                        'order_status' => 2,
                                        'complete_date' => date('Y-m-d'),
                                        'complete_time' => date('H:i:s')
                                    );

                        $up = $this->ApiModel->edit_data('food_orders',$where_food,$arr);

                        if($up)
                        {
                            //add checkout bill 
                            $wh_fd_c = '(hotel_id = "'.$check_otp_food_ord['hotel_id'].'" AND u_id = "'.$check_otp_food_ord['u_id'].'" AND booking_id = "'.$check_otp_food_ord['booking_id'].'")';
                                
                            $fd_c_o_data = $this->ApiModel->getData('user_checkout_data',$wh_fd_c);
                            
                            $arr_ch_d_fd = array(
                                                'total_bill'=> $fd_c_o_data['total_bill'] + $check_otp_food_ord['order_total'],       
                                            );

                            $add_chk_data_fd = $this->ApiModel->edit_data('user_checkout_data',$wh_fd_c,$arr_ch_d_fd);
                            
                            if($add_chk_data_fd)
                            {
                                $description_fd = "Bar And Restaurant";

                                $booking_details_2 = $this->ApiModel->get_user_booking_details_1($check_otp_food_ord['hotel_id'],$check_otp_food_ord['booking_id']);
        
                                $date12 = $booking_details_2['check_in'];
                                $date22 = $booking_details_2['check_out'];
                                
                                $check_out_2 = $booking_details_2['check_out'];

                                $check_in_2 = $booking_details_2['check_in'];
 
                                $diff_2 = abs(strtotime($date22) - strtotime($date12));

                                $years_2 = floor($diff_2 / (365*60*60*24));
                                $months_2 = floor(($diff_2 - $years_2 * 365*60*60*24) / (30*60*60*24));
                                $days_2 = floor(($diff_2 - $years_2 * 365*60*60*24 - $months_2*30*60*60*24)/ (60*60*24));
                                
                                $days_2 = floor(($diff_2 - $years_2 * 365*60*60*24 - $months_2*30*60*60*24)/ (60*60*24));
                                
                                for($k = 0;$k < $days_2; $k++)
                                {
                                    $wh_d2 = '(hotel_id = "'.$check_otp_food_ord['hotel_id'].'" AND description = "'.$description_fd.'" AND date = "'.date('Y-m-d',strtotime($booking_details_2['check_in']. '+'.$k. 'days')).'" AND user_checkout_data_id = "'.$fd_c_o_data['user_checkout_data_id'].'")'; 

                                    $chk_o_details2 = $this->ApiModel->getData('user_checkout_details',$wh_d2); 

                                    $add_user_checkout_details2 = ""; 

                                    if($chk_o_details2) 
                                    {
                                        // if(date('Y-m-d',strtotime($booking_details_2['check_in']. '+'.$k. 'days')) == $check_otp_food_ord['complete_date'])
                                        if(date('Y-m-d',strtotime($booking_details_2['check_in']. '+'.$k. 'days')) == date('Y-m-d'))
                                        {
                                            $amount1_fd = $chk_o_details2['amount'] + $check_otp_food_ord['order_total'];
                                        }
                                        else
                                        {
                                            $amount1_fd = 0;
                                        }

                                        $arr_ch_det_fd = array(
                                                            'amount'=> $amount1_fd,       
                                                            );

                                        $add_user_checkout_details2 = $this->ApiModel->edit_data('user_checkout_details',$wh_d2,$arr_ch_det_fd);
                                    }
                                    else
                                    {
                                        if(date('Y-m-d',strtotime($booking_details_2['check_in']. '+'.$k. 'days')) == date('Y-m-d'))
                                        {
                                            $amount2_fd = $check_otp_food_ord['order_total'];
                                        }
                                        else
                                        {
                                            $amount2_fd = 0;
                                        }
                                        
                                        $arr_ch_det1_fd = array(
                                                                'user_checkout_data_id'=> $fd_c_o_data['user_checkout_data_id'],       
                                                                'hotel_id'=> $check_otp_food_ord['hotel_id'],       
                                                                'description'=> $description_fd,       
                                                                'date'=> date('Y-m-d',strtotime($booking_details_2['check_in']. '+'.$k. 'days')),
                                                                'amount'=> $amount2_fd
                                                            );

                                        $add_user_checkout_details2 = $this->ApiModel->insert_data('user_checkout_details',$arr_ch_det1_fd);
                                    }
                                }

                                if($add_user_checkout_details2)
                                {
                                    $wh12_fd = '(hotel_id = "'.$check_otp_food_ord['hotel_id'].'" AND user_checkout_data_id = "'.$fd_c_o_data['user_checkout_data_id'].'" AND description_name = "'.$description_fd.'")';

                                    $user_checkout_sub_total1_fd = $this->ApiModel->getData('user_checkout_sub_total',$wh12_fd);
                                    
                                    //add subtotal
                                    if($user_checkout_sub_total1_fd)
                                    {
                                        $st_arr12_fd = array(
                                                            'sub_total' => $user_checkout_sub_total1_fd['sub_total'] + $check_otp_food_ord['order_total']
                                                            );
            
                                        $this->ApiModel->edit_data('user_checkout_sub_total',$wh12_fd,$st_arr12_fd);
                                    }
                                    else
                                    {
                                        //edit subtotal
                                        $st_arr22_fd = array(
                                                            'hotel_id' => $check_otp_food_ord['hotel_id'],
                                                            'user_checkout_data_id' => $fd_c_o_data['user_checkout_data_id'],
                                                            'description_name' => $description_fd,
                                                            'sub_total' => $check_otp_food_ord['order_total']
                                                            );
            
                                        $this->ApiModel->insert_data('user_checkout_sub_total',$st_arr22_fd);
                                    }
                                }
                            }
                            
                            // push notification for user
                            $wh = '(food_order_id = "' . $order_id . '")';
                            $get_u_id = $this->ApiModel->getData($tbl = 'food_orders', $wh);
                            $wh_i = '(u_id = "' . $get_u_id['hotel_id'] . '")';
                            $hotel_info = $this->ApiModel->getData($tbl = 'register', $wh_i);
                            $hotel_name = $hotel_info['hotel_name'];
                            $wh1 = '(u_id = "' . $get_u_id['u_id'] . '")';
                            $get_dt = $this->ApiModel->getData($tbl = 'user_firebase_tokens', $wh1);
                            $title = "";
                            if(!empty($get_dt)){
                                $deviceToken = $get_dt['token'];
                                $title = 'Food Order Is Completed';
                                $body = 'Your Food Order ID is "'.$order_id.'"';
                                $result = send_push_notification($deviceToken, $title, $body);
                            }

                            // inside user app notification
                            $subject = $title;
                            $description = "$title In $hotel_name And Your Order Id Is $order_id";
                            $arr_noti = array(
                                                'hotel_id' => $get_u_id['hotel_id'],
                                                'u_id' => $get_u_id['u_id'],
                                                'subject' => $subject,
                                                'description' => $description,
                                                'clear_flag' => 1,
                                                'count_flag' => 1,
                                            );
                            //  print_r($arr_noti);die;
                            $this->ApiModel->insert_data('user_notification',$arr_noti);

                            //add notification
                            $arr = array(
                                            'u_id'=>$u_id,
                                            'hotel_id' => $depart_data['hotel_id'],
                                            'subject'=> 'Order Completed',
                                            'description' =>'Your Order is completed successfully',
                                            'notification_order_flag' =>0,       
                                        );

                            $add = $this->ApiModel->insert_data('staff_notification',$arr);

                            $response['error_code'] = "200";
                            $response['message'] = "You have successfully completed Order..";
                            //$response['data'] = $send_data;
                            echo json_encode($response);
                            exit();
                        }
                        else
                        {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                    else
                    {
                        $response['error_code'] = "401";
                        $response['message'] = "OTP Doest not match";
                        echo json_encode($response);
                        exit();
                    }
                }
              	elseif($user_type == 10)
                {
                    if($flag == 1)
                    {
                        $where = '(room_service_menu_order_id ="'.$order_id.'" AND otp = "'.$otp.'")';
                        
                        $check_rs_menu_otp = $this->ApiModel->getData('room_service_menu_orders',$where);
                        
                        if($check_rs_menu_otp)
                        {
                            $arr = array(
                                            'is_otp_verified' => 1,
                                            'order_status' => 2,
                                            'complete_date' => date('Y-m-d'),
                                            'complete_time' => date('H:i:s')
                                        );

                            //$where1 = '(h_k_order_id ="'.$order_id.'")';
                            $up = $this->ApiModel->edit_data('room_service_menu_orders',$where,$arr);

                            if($up)
                            {
                                //add checkout bill 
                                $wh_rs_m_c = '(hotel_id = "'.$check_rs_menu_otp['hotel_id'].'" AND u_id = "'.$check_rs_menu_otp['u_id'].'" AND booking_id = "'.$check_rs_menu_otp['booking_id'].'")';
                                                                
                                $rsm_c_o_data = $this->ApiModel->getData('user_checkout_data',$wh_rs_m_c);
                                
                                $arr_ch_d_rsm = array(
                                                    'total_bill'=> $rsm_c_o_data['total_bill'] + $check_rs_menu_otp['order_total'],       
                                                    );

                                $add_chk_data_rsm = $this->ApiModel->edit_data('user_checkout_data',$wh_rs_m_c,$arr_ch_d_rsm);

                                if($add_chk_data_rsm)
                                {
                                    $description_rsm = "Room Service Menu";

                                    $booking_details_3 = $this->ApiModel->get_user_booking_details_1($check_rs_menu_otp['hotel_id'],$check_rs_menu_otp['booking_id']);

                                    $date13 = $booking_details_3['check_in'];
                                    $date23 = $booking_details_3['check_out'];
                                    
                                    $check_out_3 = $booking_details_3['check_out'];

                                    $check_in_3 = $booking_details_3['check_in'];

                                    $diff_3 = abs(strtotime($date23) - strtotime($date13));

                                    $years_3 = floor($diff_3 / (365*60*60*24));
                                    $months_3 = floor(($diff_3 - $years_3 * 365*60*60*24) / (30*60*60*24));
                                    $days_3 = floor(($diff_3 - $years_3 * 365*60*60*24 - $months_3*30*60*60*24)/ (60*60*24));
                                    
                                    $days_3 = floor(($diff_3 - $years_3 * 365*60*60*24 - $months_3*30*60*60*24)/ (60*60*24));
                                    
                                    for($l = 0;$l < $days_3; $l++)
                                    {
                                        $wh_d3 = '(hotel_id = "'.$check_rs_menu_otp['hotel_id'].'" AND description = "'.$description_rsm.'" AND date = "'.date('Y-m-d',strtotime($booking_details_3['check_in']. '+'.$l. 'days')).'" AND user_checkout_data_id = "'.$rsm_c_o_data['user_checkout_data_id'].'")'; 

                                        $chk_o_details3 = $this->ApiModel->getData('user_checkout_details',$wh_d3); 

                                        $add_user_checkout_details3 = ""; 

                                        if($chk_o_details3) 
                                        {
                                            if(date('Y-m-d',strtotime($booking_details_3['check_in']. '+'.$l. 'days')) == date('Y-m-d'))
                                            {
                                                $amount1_rsm = $chk_o_details3['amount'] + $check_rs_menu_otp['main_total'];
                                            }
                                            else
                                            {
                                                $amount1_rsm = 0;
                                            }

                                            $arr_ch_det_rsm = array(
                                                                'amount'=> $amount1_rsm,       
                                                                );

                                            $add_user_checkout_details3 = $this->ApiModel->edit_data('user_checkout_details',$wh_d3,$arr_ch_det_rsm);
                                        }
                                        else
                                        {
                                            if(date('Y-m-d',strtotime($booking_details_3['check_in']. '+'.$l. 'days')) == date('Y-m-d'))
                                            {
                                                $amount2_rsm = $check_rs_menu_otp['main_total'];
                                            }
                                            else
                                            {
                                                $amount2_rsm = 0;
                                            }
                                            
                                            $arr_ch_det1_rsm = array(
                                                                    'user_checkout_data_id'=> $rsm_c_o_data['user_checkout_data_id'],       
                                                                    'hotel_id'=> $check_rs_menu_otp['hotel_id'],       
                                                                    'description'=> $description_rsm,       
                                                                    'date'=> date('Y-m-d',strtotime($booking_details_3['check_in']. '+'.$l. 'days')),
                                                                    'amount'=> $amount2_rsm
                                                                );

                                            $add_user_checkout_details3 = $this->ApiModel->insert_data('user_checkout_details',$arr_ch_det1_rsm);
                                        }
                                    }

                                    if($add_user_checkout_details3)
                                    {
                                        $wh12_rsm = '(hotel_id = "'.$check_rs_menu_otp['hotel_id'].'" AND user_checkout_data_id = "'.$rsm_c_o_data['user_checkout_data_id'].'" AND description_name = "'.$description_rsm.'")';

                                        $user_checkout_sub_total1_rsm = $this->ApiModel->getData('user_checkout_sub_total',$wh12_rsm);
                                        
                                        //add subtotal
                                        if($user_checkout_sub_total1_rsm)
                                        {
                                            $st_arr12_rsm = array(
                                                                'sub_total' => $user_checkout_sub_total1_rsm['sub_total'] + $check_rs_menu_otp['order_total']
                                                                );

                                            $this->ApiModel->edit_data('user_checkout_sub_total',$wh12_rsm,$st_arr12_rsm);
                                        }
                                        else
                                        {
                                            //edit subtotal
                                            $st_arr22_rsm = array(
                                                                'hotel_id' => $check_rs_menu_otp['hotel_id'],
                                                                'user_checkout_data_id' => $rsm_c_o_data['user_checkout_data_id'],
                                                                'description_name' => $description_rsm,
                                                                'sub_total' => $check_rs_menu_otp['order_total']
                                                                );

                                            $this->ApiModel->insert_data('user_checkout_sub_total',$st_arr22_rsm);
                                        }
                                    }
                                }

                                //add notification
                                $arr = array(
                                            'u_id'=>$u_id,
                                            'hotel_id' => $depart_data['hotel_id'],
                                            'subject'=> 'Order Completed',
                                            'description' =>'Your Order is completed successfully',
                                            'notification_order_flag' =>0,       
                                            );

                                $add = $this->ApiModel->insert_data('staff_notification',$arr);

                                $response['error_code'] = "200";
                                $response['message'] = "You have successfully completed Order..";
                                //$response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                        else
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "OTP Doest not match";
                            echo json_encode($response);
                            exit();
                        }
                    }
                    elseif($flag == 2)
                    {
                        //laundry orders
                        $where_c_ord = '(rmservice_services_order_id ="'.$order_id.'" AND otp = "'.$otp.'")';
                        
                        $check_otp_cloth = $this->ApiModel->getData('rmservice_services_orders',$where_c_ord);
                        
                        if($check_otp_cloth)
                        {
                            $arr = array(
                                            'is_otp_verified' => 1,
                                            'order_status' => 2,
                                            'complete_date' => date('Y-m-d'),
                                            'complete_time' => date('H:i:s')	
                                        );

                            $up = $this->ApiModel->edit_data('rmservice_services_orders',$where_c_ord,$arr);

                            if($up)
                            {
                                
                                //add notification
                                    $arr = array(
                                                'u_id'=>$u_id,
                                                'hotel_id' => $depart_data['hotel_id'],
                                                'subject'=> 'Order Completed',
                                                'description' =>'Your Order is completed successfully',
                                                'notification_order_flag' =>0,       
                                                );

                                    $add = $this->ApiModel->insert_data('staff_notification',$arr);


                                $response['error_code'] = "200";
                                $response['message'] = "You have successfully completed Order..";
                                $response['data'] = $send_data;
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                        else
                        {
                            $response['error_code'] = "401";
                            $response['message'] = "OTP Doest not match";
                            echo json_encode($response);
                            exit();
                        }
                    }
                }
            }
            else
            {
                $response['error_code'] = "406";
                $response['message'] = "Required Parameter Missing..!";
                echo json_encode($response);
                exit();
            }
        }  
	
      
      	//staff add services orders
        public function staff_add_services_orders()
        {
          	if(!empty($this->input->post('u_id')) && !empty($this->input->post('description')) && !empty($this->input->post('room_no')) && !empty($this->input->post('dept_id')))
            {
                $todays_date = date('Y-m-d');
               	$u_id = $this->input->post('u_id');
                $description = $this->input->post('description');
                $room_no = $this->input->post('room_no');
                $dept_id = $this->input->post('dept_id');
                
                $wh_user = '(u_id ="'.$u_id.'")';
                $user = $this->ApiModel->getData('register',$wh_user);  
                

                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                // $wh_room = '(room_no = "'.$room_no.'")';
                $hotel_id = $user['hotel_id'];
                
                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                $room_data = $this->ApiModel->get_room_no_data1($hotel_id,$room_no,$todays_date);
                $wh = '(u_id = "'.$room_data['u_id'].'")';

				$user_data = $this->ApiModel->getData('register',$wh);
				
				$name = $user_data['full_name'];
            //    print_r($name);exit;
                // print_r(isset($user['full_name']) ? $user['full_name'] : "");die;
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    if($dept_id == 4)
                    {
                            $arr_serv = array(
                                            'hotel_id'=> $user['hotel_id'],
                                            'room_no' => $room_no,
                                            'requirement'=> $description,
                                            'send_to'=> 4,
                                            'u_id' => $u_id,
                                            'guest_name' => isset($name) ? $name : ""
                                            
                                        );
                            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);
                            
                      
                           	$arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description            
                                        );

                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
								$arr1 = array(
                                                'notification_id' => $add,
                                                'department_id' => 4
                                             );

                        		$this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";           
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    elseif($dept_id == 5)
                    {
                            $arr_serv = array(
                                'hotel_id'=> $user['hotel_id'],
                                'room_no' => $room_no,
                                'requirement'=> $description,
                                'send_to'=> 5,
                                'u_id' => $u_id,
                                'guest_name' => isset($name) ? $name : ""
                            );

                            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);

                      		$arr = array(
                                           'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description              
                                        );
                            
                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
                                $arr1 = array(
                                                'notification_id' => $add,
                                                'department_id' => 5
                                             );
                               $this->ApiModel->insert_data('notifictions_department_id',$arr1);

                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    } 
                    elseif($dept_id == 2)
                    {
                            $arr_serv = array(
                                'hotel_id'=> $user['hotel_id'],
                                'room_no' => $room_no,
                                'requirement'=> $description,
                                'send_to'=> 2,
                                'u_id' => $u_id,
                                'guest_name' => isset($name) ? $name : ""
                            );

                            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);

                            $arr = array(
                                           'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description                
                                        );

                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {

                              	 $arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 2
                                              );
                                 $this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    } 
                    elseif($dept_id == 3)
                    {
                            /*$arr = array(
                                          'added_by_u_id'=>$u_id,
                                          'room_no' => $room_no,
                                          'order_description'=> $description,
                                          'order_from' =>2,
                                          'order_status' =>0,
                              			  'added_by' =>4,
                                          'hotel_id' => $user['hotel_id'],
                                          'order_date' => date('Y-m-d'),
                                        );*/
                      

                            $arr = array(
                                           'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'description'=> $description                
                                        );


                            $add = $this->ApiModel->insert_data('notifications',$arr);
                            if($add)
                            {

                              	 $arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 3
                                              );
                                 $this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }  
                } 
                elseif($user_type == 8)
                {
                    if($dept_id == 4)
                    {
                            $arr_serv = array(
                                'hotel_id'=> $user['hotel_id'],
                                'room_no' => $room_no,
                                'requirement'=> $description,
                                'send_to'=> 4,
                                'u_id' => $u_id,
                                'guest_name' => isset($name) ? $name : ""
                            );
                            
				            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);
                            $arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description                
                                        );

                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {

                              	$arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 4
                                              );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";           
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    elseif($dept_id == 5)
                    {
                            $arr_serv = array(
                                'hotel_id'=> $user['hotel_id'],
                                'room_no' => $room_no,
                                'requirement'=> $description,
                                'send_to'=> 5,
                                'u_id' => $u_id,
                                'guest_name' => isset($name) ? $name : ""
                            );

                            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);

                            $arr = array(
                                           'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description               
                                        );

                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
                              	$arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 5
                                              );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              

                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    elseif($dept_id == 2)
                    {
                            $arr_serv = array(
                                'hotel_id'=> $user['hotel_id'],
                                'room_no' => $room_no,
                                'requirement'=> $description,
                                'send_to'=> 2,
                                'u_id' => $u_id,
                                'guest_name' => isset($name) ? $name : ""
                            );

                            $add_serv_data = $this->ApiModel->insert_data('service_request',$arr_serv);

                            $arr = array(
                                           'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'ser_id' => $add_serv_data,
                                            'title' => "Service Request",
                                            'description'=> $description                
                                        );

                            $add = $this->ApiModel->insert_data('notifications',$arr);
                            if($add)
                            {

                              	 $arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 2
                                              );
                                 $this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    } 
                    elseif($dept_id == 3)
                    {
                            /*$arr = array(
                                          'added_by_u_id'=>$u_id,
                                          'room_no' => $room_no,
                                          'order_description'=> $description,
                                          'order_from' =>2,
                                          'order_status' =>0,
                              			  'added_by' =>4,
                                          'hotel_id' => $user['hotel_id'],
                                          'order_date' => date('Y-m-d'),
                                        );

                            $add = $this->ApiModel->insert_data('room_service_menu_orders',$arr);*/
                      
                            $arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'description'=> $description               
                                        );


                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
                              	$arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 3
                                              );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              

                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }  
                }
                elseif($user_type == 10)
                {
                    if($dept_id == 4)
                    {
                            /*$arr = array(
                                          'added_by_u_id'=> $u_id,
                                          'room_no' => $room_no,
                                          'order_description'=> $description,
                                          'order_from'=> 2,
                                          'order_status' =>0,
                                          'hotel_id'=> $user['hotel_id'],
                                          'order_date'=> date('Y-m-d'),
                                        );

                            $add = $this->ApiModel->insert_data('house_keeping_orders',$arr);*/
                      
                            $arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'description'=> $description               
                                        );


                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
								$arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 4
                                              );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);
                              
                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";           
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    elseif($dept_id == 5)
                    {
                           /* $arr = array(
                                          'added_by_u_id'=>$u_id,
                                          'room_no' => $room_no,
                                          'order_description'=> $description,
                                          'order_from' =>2,
                                          'order_status' =>0,
                                          'hotel_id' => $user['hotel_id'],
                                          'order_date' => date('Y-m-d'),
                                        );

                            $add = $this->ApiModel->insert_data('food_orders',$arr);*/
                      
                            $arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'description'=> $description             
                                        );


                            $add = $this->ApiModel->insert_data('notifications',$arr);

                            if($add)
                            {
                                $arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 5
                                              );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);

                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    elseif($dept_id == 3)
                    {
                            /*$arr = array(
                                          'added_by_u_id'=>$u_id,
                                          'room_no' => $room_no,
                                          'order_description'=> $description,
                                          'order_from' =>2,
                                          'order_status' =>0,
                              			  'added_by' =>4,
                                          'hotel_id' => $user['hotel_id'],
                                          'order_date' => date('Y-m-d'),
                                        );

                            $add = $this->ApiModel->insert_data('room_service_menu_orders',$arr);*/
                      		$arr = array(
                                            'send_by_id'=> $user['hotel_id'],
                              				'added_by_id'=> $u_id,
                                            'room_no' => $room_no,
                                            'send_for' => 7,
                                            'description'=> $description               
                                        );


                            $add = $this->ApiModel->insert_data('notifications',$arr);
                        

                            if($add)
                            {
                              	$arr1 = array(
                                                  'notification_id' => $add,
                                                  'department_id' => 3
                                             );
                              
                              	$this->ApiModel->insert_data('notifictions_department_id',$arr1);


                                $response['error_code'] = "200";
                                $response['message'] = "Your Request has been sent successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }  
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
        
        public function staff_service_req_history()
        {
            if(!empty($this->input->post('u_id')))
            {
                $u_id = $this->input->post('u_id');
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }

                if($user_type == 9)
                {
                    $wh_data = '(added_by_id ="'.$u_id.'") ORDER BY notification_id DESC'; //'added_by_id'=> $u_id,
                    $get_all_orders_housekeeping = $this->ApiModel->getAllData('notifications', $wh_data);
                    if(!empty($get_all_orders_housekeeping))
                    {
                         foreach($get_all_orders_housekeeping as $h_orders)
                         {
                                $data[] = array(
                                                  'order_id' => $h_orders['notification_id'],
                                                  'room_no' => $h_orders['room_no'],
                                                  'order_description' => $h_orders['description'],
                                                  'order_status' => $h_orders['order_status']
                                               );
                         }
                    }
                }
                
                elseif($user_type == 8)
                {
                    $wh_f_ord = '(added_by_id = "'.$u_id.'") ORDER BY notification_id DESC';
                
                    $get_all_orders_food = $this->ApiModel->getAllData('notifications', $wh_f_ord);
                    if(!empty($get_all_orders_food))
                    {
                         foreach($get_all_orders_food as $f_orders)
                         {
                                $data[] = array(
                                                  'order_id' => $f_orders['notification_id'],
                                                  'room_no' => $f_orders['room_no'],
                                                  'order_description' => $f_orders['description'],
                                                  'order_status' => $f_orders['order_status']
                                               );
                         }
                    }
                }
              	elseif($user_type == 10)
                {
                    $wh_f_ord = '(added_by_id ="'.$u_id.'" ) ORDER BY notification_id DESC'; //AND added_by = 4
                    $get_all_orders_room_service = $this->ApiModel->getAllData('notifications', $wh_f_ord);
                    if(!empty($get_all_orders_room_service))
                    {
                         foreach($get_all_orders_room_service as $rm_orders)
                         {
                                $data[] = array(
                                                  'order_id' => $rm_orders['notification_id'],
                                                  'room_no' => $rm_orders['room_no'],
                                                  'order_description' => $rm_orders['description'],
                                                  'order_status' => $rm_orders['order_status']
                                               );
                         }
                    }
                }

               

                if(!empty($get_all_orders_housekeeping) || !empty($get_all_orders_food) || !empty($get_all_orders_room_service))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }  

            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function staff_add_handover()
        {
            if(!empty($this->input->post('u_id')) && !empty($this->input->post('description')))
            {
                $u_id = $this->input->post('u_id');
                $description = $this->input->post('description');
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }

                if($user_type == 9)
                {
                    $arr = array(
                                    'hotel_id'=> $depart_data['hotel_id'],
                                    'create_staff_id' => $u_id,
                                    'date' => date('Y-m-d'),
                                    'time' => date('H:i A'),
                                    'description'=> $description,
                                    'is_complete'=> 0,
                                    'added_by' =>2,
                                    'added_by_u_id'=> $u_id,
                                );

                    $add = $this->ApiModel->insert_data('handover_staff',$arr);

                    if($add)
                    {

                        $response['error_code'] = "200";
                        $response['message'] = "Handover Request has been sent successfully...!";           
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
                elseif($user_type == 8)
                {
                    $arr = array(
                                    'hotel_id'=> $depart_data['hotel_id'],
                                    'create_staff_id' => $u_id,
                                    'date' => date('Y-m-d'),
                                    'time' => date('H:i A'),
                                    'description'=> $description,
                                    'is_complete'=> 0,
                                    'added_by' =>4,
                                    'added_by_u_id'=> $u_id,
                                );

                    $add = $this->ApiModel->insert_data('handover_staff',$arr);

                    if($add)
                    {

                        $response['error_code'] = "200";
                        $response['message'] = "Handover Request has been sent successfully...!";           
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
                elseif($user_type == 10)
                {
                    $arr = array(
                                    'hotel_id'=> $depart_data['hotel_id'],
                                    'create_staff_id' => $u_id,
                                    'date' => date('Y-m-d'),
                                    'time' => date('h:i:s'),
                                    'description'=> $description,
                                    'is_complete'=> 0,
                                    'added_by' =>2,
                                    'added_by_u_id'=> $u_id,
                                );

                    $add = $this->ApiModel->insert_data('handover_staff',$arr);

                    if($add)
                    {

                        $response['error_code'] = "200";
                        $response['message'] = "Handover Request has been sent successfully...!";           
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something went wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }

        public function get_staff_handover_history()
        {
          	if(!empty($this->input->post('u_id')))
            {
                $u_id = $this->input->post('u_id');
             
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    $wh_f_ord = '(create_staff_id ="'.$u_id.'")';
                    $housekeeping_handover = $this->ApiModel->get_handover_desc('handover_staff', $wh_f_ord);
                    if(!empty($housekeeping_handover))
                    {
                         foreach($housekeeping_handover as $h_h_over)
                         {
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  //'time' => $d_time
                                               );
                         }
                    }
                }
                elseif($user_type == 10)
                {
                    $wh_f_ord = '(create_staff_id ="'.$u_id.'")';
                    $rm_service_handover = $this->ApiModel->get_handover_desc('handover_staff', $wh_f_ord);
                    if(!empty($rm_service_handover))
                    {
                         foreach($rm_service_handover as $h_h_over)
                         {
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  //'time' => $d_time
                                               );
                         }
                    }
                }
                elseif($user_type == 8)
                {
                    $wh_f_ord = '(create_staff_id ="'.$u_id.'")';
                    $food_handover = $this->ApiModel->get_handover_desc('handover_staff', $wh_f_ord);
                    if(!empty($food_handover))
                    {
                         foreach($food_handover as $h_h_over)
                         {
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  //'time' => $d_time
                                               );
                         }
                    }
                }


                if(!empty($housekeeping_handover) || !empty($rm_service_handover) || !empty($food_handover))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function get_count_pending_orders()
        {
          	if(!empty($this->input->post('u_id')))
            {
              	  $u_id = $this->input->post('u_id');

                  $user_type = '';
                  $wh_dept = '(u_id = "'.$u_id.'")';

                  $depart_data = $this->ApiModel->getData('register',$wh_dept);
                  if(!empty($depart_data))
                  {
                      if($depart_data['user_type'] == "10") //Room Service
                      {
                          $user_type = 10;
                      }
                      else
                      {
                          if($depart_data['user_type'] == "8") //Food & Beverages
                          {
                              $user_type = 8;
                          }
                          else
                          {
                              if($depart_data['user_type'] == "9") //Housekeeping Service
                              {
                                  $user_type = 9;
                              }
                          }
                      }
                  }
                  
                  if($user_type == 9) 
                  {
                      $todays_date = date('Y-m-d');
              		  //Pending Orders
                      $wh_pending = '(staff_id = "'.$u_id.'" AND order_status = 0)';
                      $house_keeping_pending_orders = $this->ApiModel->getCount_complete_orders($tbl = 'house_keeping_orders',$wh_pending);

                      $wh_p_laundry = '(order_status = 0 AND staff_id = "'.$u_id.'")';
                      $laundry_pending_orders = $this->ApiModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_p_laundry);

                      $get_h_l_pending_order = $house_keeping_pending_orders[0]['total_count'] + $laundry_pending_orders[0]['total_count'];
                    
                      //Completed Orders for over all
                    
                      //service
                      $wh = '(staff_id = "'.$u_id.'" AND order_status = 2)';
                      $completed_orders = $this->ApiModel->getCount_complete_orders($tbl = 'house_keeping_orders',$wh);
					  
                      //laundry orders
                      $wh_laundry = '(staff_id = "'.$u_id.'" AND order_status = 2)';
                      $laundry_completed_orders = $this->ApiModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_laundry);
					  
                      $get_h_l_complete_order = $completed_orders[0]['total_count'] + $laundry_completed_orders[0]['total_count'];
                    
                      //completed orders of todays
                     
                      $wh_todays = '(staff_id = "'.$u_id.'" AND complete_date = "'.$todays_date.'" AND order_status = 2)';
                      $completed_orders_todays_date = $this->ApiModel->getCount_complete_orders($tbl = 'house_keeping_orders',$wh_todays);
					  
                      //laundry orders
                      $wh_laundry_todays = '(staff_id = "'.$u_id.'" AND complete_date = "'.$todays_date.'" AND order_status = 2)';
                      $laundry_completed_orders_todays = $this->ApiModel->getCount_laundry_complete_orders($tbl = 'cloth_orders',$wh_laundry_todays);
					  
                      $get_h_l_complete_order_todays = $completed_orders_todays_date[0]['total_count'] + $laundry_completed_orders_todays[0]['total_count'];
                      //print_r($get_h_l_complete_order_todays);die;
                    
                      $data = array(
                        				'Pending_Order' =>$get_h_l_pending_order,
                        				'Completed_Order' => $get_h_l_complete_order,
                        				'Completed_Order_todays' => $get_h_l_complete_order_todays
                      			   );      
                    
                     
                  }
              	  elseif($user_type == 8)
                  {
                      $todays_date = date('Y-m-d');
                      //Pending Orders
                      $wh_pending_food = '(staff_id = "'.$u_id.'" AND order_status = 0)';
                      $food_pending_orders = $this->ApiModel->food_Count_complete_orders($tbl = 'food_orders',$wh_pending_food);
                      $food_pending_ord =  $food_pending_orders[0]['total_count'];
                      
                      //Completed Orders overall
                      $wh_c_food = '(staff_id = "'.$u_id.'" AND order_status = 2)';
                      $food_complete_orders = $this->ApiModel->food_Count_complete_orders($tbl='food_orders',$wh_c_food);
                      $food_complete_ord =  $food_complete_orders[0]['total_count'];
                    
                      //Completed Orders todays
                      $wh_c_food_todays = '(staff_id = "'.$u_id.'" AND complete_date = "'.$todays_date.'" AND order_status = 2)';
                      $food_complete_orders_todays = $this->ApiModel->food_Count_complete_orders($tbl='food_orders',$wh_c_food_todays);
                      $food_complete_ord_todys =  $food_complete_orders_todays[0]['total_count'];
                    
                      $data = array(
                        			  'Pending_Order' =>$food_pending_ord,
                        			  'Completed_Order' => $food_complete_ord,
                        			  'Completed_Order_todays' => $food_complete_ord_todys
                      			   );  
                  }
                  elseif($user_type == 10)
                  {
                       $todays_date = date('Y-m-d');
                      //Pending Orders
                      $wh_pending = '(staff_id = "'.$u_id.'" AND order_status = 0)';
                      $rm_servics_pending_orders = $this->ApiModel->getCount_room_service_ord($tbl = 'room_service_menu_orders',$wh_pending);

                      $wh_p_laundry = '(staff_id = "'.$u_id.'" AND order_status = 0)';
                      $rm_servive_pending_orders = $this->ApiModel->getCount_rm_service_complete_orders($tbl = 'rmservice_services_orders',$wh_p_laundry);

                      $get_room_serv_pending_order = $rm_servics_pending_orders[0]['total_count'] + $rm_servive_pending_orders[0]['total_count'];
                    
                      //completed orders
                      $wh_cmpl = '(staff_id = "'.$u_id.'" AND order_status = 2)';
                      $rm_servics_cmpl_orders = $this->ApiModel->getCount_room_service_ord($tbl = 'room_service_menu_orders',$wh_cmpl);

                      $wh_cmpl_orders = '(staff_id = "'.$u_id.'" AND order_status = 2)';
                      $rm_servive_cmpl_orders = $this->ApiModel->getCount_rm_service_complete_orders($tbl = 'rmservice_services_orders',$wh_cmpl_orders);

                      $get_room_serv_complete_order = $rm_servics_cmpl_orders[0]['total_count'] + $rm_servive_cmpl_orders[0]['total_count'];
                    
                       //completed orders todays
                      $wh_cmpl_todays = '(staff_id = "'.$u_id.'" AND complete_date = "'.$todays_date.'" AND order_status = 2)';
                      $rm_servics_cmpl_orders_todays = $this->ApiModel->getCount_room_service_ord($tbl = 'room_service_menu_orders',$wh_cmpl_todays);

                      $wh_cmpl_orders_todays = '(staff_id = "'.$u_id.'" AND complete_date = "'.$todays_date.'" AND order_status = 2)';
                      $rm_servive_cmpl_orders_todays = $this->ApiModel->getCount_rm_service_complete_orders($tbl = 'rmservice_services_orders',$wh_cmpl_orders_todays);

                      $get_room_serv_complete_order_todays = $rm_servics_cmpl_orders_todays[0]['total_count'] + $rm_servive_cmpl_orders_todays[0]['total_count'];
                    
                      $data = array(
                        			  'Pending_Order' =>$get_room_serv_pending_order,
                        			  'Completed_Order' => $get_room_serv_complete_order,
                        			  'Completed_Order_todays' => $get_room_serv_complete_order_todays
                      			   ); 
                      
                  }
               
                   if(!empty($get_h_l_pending_order) || !empty($get_h_l_complete_order) || !empty($food_pending_ord) || !empty($food_complete_ord) || !empty($get_room_serv_pending_order) || !empty($get_room_serv_complete_order))
                   {
                       $response['error_code'] = "200";
                       $response['message'] = "Data found";
                       $response['data'] = $data;
                       echo json_encode($response);
                       exit();
                   }
                   else
                   {
                      $response['error_code'] = "404";
                      $response['message'] = "Data Not found";
                      echo json_encode($response);
                      exit();
                   }

            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function get_all_handover()
        {
          	if(!empty($this->input->post('u_id')))
            {
                $u_id = $this->input->post('u_id');
             
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                $hotel_id = $depart_data['hotel_id']; 

              
              
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    $wh_f_ord = '(create_staff_id !="'.$u_id.'" AND hotel_id ="'.$hotel_id.'" AND is_complete = 0)';
                    $housekeeping_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    //print_r($housekeeping_handover);
                    if(!empty($housekeeping_handover))
                    {
                         foreach($housekeeping_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array( 
                                  				  //'hotel_id' => $h_h_over['hotel_id'],   
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }
                elseif($user_type == 10)
                {
                    $wh_f_ord = '(create_staff_id !="'.$u_id.'" AND hotel_id ="'.$hotel_id.'" AND is_complete = 0)';
                    $rm_service_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    if(!empty($rm_service_handover))
                    {
                         foreach($rm_service_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }
                elseif($user_type == 8)
                {
                    $wh_f_ord = '(create_staff_id !="'.$u_id.'" AND hotel_id ="'.$hotel_id.'" AND is_complete = 0)';
                    $food_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    if(!empty($food_handover))
                    {
                         foreach($food_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data[] = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }


                if(!empty($housekeeping_handover) || !empty($rm_service_handover) || !empty($food_handover))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function view_handover_details()
        {
          	if(!empty($this->input->post('u_id')) && !empty($this->input->post('handover_id')))
            {
                $u_id = $this->input->post('u_id');
                $handover_id = $this->input->post('handover_id');
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $housekeeping_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    if(!empty($housekeeping_handover))
                    {
                         foreach($housekeeping_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data = array(  		
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }
                elseif($user_type == 10)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $rm_service_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    if(!empty($rm_service_handover))
                    {
                         foreach($rm_service_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }
                elseif($user_type == 8)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $food_handover = $this->ApiModel->getAllData('handover_staff', $wh_f_ord);
                    if(!empty($food_handover))
                    {
                         foreach($food_handover as $h_h_over)
                         {
                           		$wh_d = '(u_id = "'.$h_h_over['create_staff_id'].'")';
                                $get_created_user_name = $this->ApiModel->getData('register',$wh_d);
                            	if(!empty($get_created_user_name))
                                {
                                  $name = $get_created_user_name['full_name'];
                                }
                           		else
                                {
                                  $name = '';
                                }
                           
                                $date = $h_h_over['date'];                         
                                $date_time =date('d M',strtotime($date));
                                $time = $h_h_over['time'];
                                $d_time =date('g:i A',strtotime($time));
                                $data = array(
                                                  'handover_id' => $h_h_over['staff_handover_id'],          
                                                  'description' => $h_h_over['description'],
                                                  'status' => $h_h_over['is_complete'],
                                   				  'date' => $date_time." | ".$d_time,
                                  				  'created_by' => $name
                                               );
                         }
                    }
                }


                if(!empty($housekeeping_handover) || !empty($rm_service_handover) || !empty($food_handover))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function staff_complete_handover_order()
        {
          	if(!empty($this->input->post('u_id')) && !empty($this->input->post('handover_id')))
            {
                $u_id = $this->input->post('u_id');
                $handover_id = $this->input->post('handover_id');
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $housekeeping_handover = $this->ApiModel->getData('handover_staff', $wh_f_ord);
                    if(!empty($housekeeping_handover))
                    {
                        $arr = array(
                                        'completed_staff_id' => $u_id,
                                        'is_complete' => 1,
                                        'complete_date' => date('Y-m-d'),
                                        'complete_time' => date('h:i:s'),
                                    );

                        $up = $this->ApiModel->edit_data('handover_staff',$wh_f_ord,$arr);
                        if($up)
                        {        
                            $response['error_code'] = "200";
                            $response['message'] = "Success..";
                            echo json_encode($response);
                            exit();
                        }
                        else
                        {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                }
                elseif($user_type == 10)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $food_handover = $this->ApiModel->getData('handover_staff', $wh_f_ord);
                    if(!empty($food_handover))
                    {
                        $arr = array(
                                        'completed_staff_id' => $u_id,
                                        'is_complete' => 1,
                                        'complete_date' => date('Y-m-d'),
                                        'complete_time' => date('h:i:s'),
                                    );

                        $up = $this->ApiModel->edit_data('handover_staff',$wh_f_ord,$arr);
                        if($up)
                        {        
                            $response['error_code'] = "200";
                            $response['message'] = "Success..";
                            echo json_encode($response);
                            exit();
                        }
                        else
                        {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                }
                elseif($user_type == 8)
                {
                    $wh_f_ord = '(staff_handover_id ="'.$handover_id.'")';
                    $services_handover = $this->ApiModel->getData('handover_staff', $wh_f_ord);
                    if(!empty($services_handover))
                    {
                        $arr = array(
                                        'completed_staff_id' => $u_id,
                                        'is_complete' => 1,
                                        'complete_date' => date('Y-m-d'),
                                        'complete_time' => date('h:i:s'),
                                    );

                        $up = $this->ApiModel->edit_data('handover_staff',$wh_f_ord,$arr);
                        if($up)
                        {        
                            $response['error_code'] = "200";
                            $response['message'] = "Success..";
                            echo json_encode($response);
                            exit();
                        }
                        else
                        {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                }


                if(!empty($housekeeping_handover) || !empty($food_handover) || !empty($services_handover))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }

        //get staff all notifications
		public function get_all_staff_notification()
        {
          	if(!empty($this->input->post('u_id')))
            {
                $u_id = $this->input->post('u_id');
             
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              
                if($user_type == 9)
                {
                    $wh = '(u_id ="'.$u_id.'" AND notification_order_flag = 0) ORDER BY s_notification_id DESC';
                    $housekeeping_staff_details = $this->ApiModel->getAllData('staff_notification', $wh);
                    if(!empty($housekeeping_staff_details))
                    {
                         $notification_staff_count = $this->ApiModel->getCount_housekeeping_notification('staff_notification', $wh);
                         $get_notification_count = $notification_staff_count[0]['total_count'];
                         foreach($housekeeping_staff_details as $h_staff_d)
                         {
                                            
                                $date_time =date('d M | g:i A',strtotime($h_staff_d['created_at']));
                               
                                $data[] = array(  		
                                                  'notification_id' => $h_staff_d['s_notification_id'],          
                                                  'description' => $h_staff_d['description'],
                                   				  'date' => $date_time,
                                  				  'image' =>$h_staff_d['image'],
                                  				  'notification_order_flag' =>$h_staff_d['notification_order_flag']
                                               );
                         }
                    }
                }
                elseif($user_type == 10)
                {
                    $wh = '(u_id ="'.$u_id.'")';
                    $rm_service_staff = $this->ApiModel->getAllData('staff_notification', $wh);
                    if(!empty($rm_service_staff))
                    {
                         $notification_staff_count = $this->ApiModel->getCount_housekeeping_notification('staff_notification', $wh);
                         $get_notification_count = $notification_staff_count[0]['total_count'];
                         foreach($rm_service_staff as $rm_staf)
                         {
                           		$date_time =date('d M | g:i A',strtotime($rm_staf['created_at']));
                               
                                $data[] = array(  		
                                                  'notification_id' => $rm_staf['s_notification_id'],          
                                                  'description' => $rm_staf['description'],
                                   				  'date' => $date_time,
                                  				  'image' =>$rm_staf['image'],
                                  				  'notification_order_flag' =>$rm_staf['notification_order_flag']
                                               );
                         }
                    }
                }
                elseif($user_type == 8)
                {
                    $wh = '(u_id ="'.$u_id.'" AND notification_order_flag = 0) ORDER BY s_notification_id DESC';
                    $food_staff = $this->ApiModel->getAllData('staff_notification', $wh);
                    if(!empty($food_staff))
                    {
                         $notification_staff_count = $this->ApiModel->getCount_housekeeping_notification('staff_notification', $wh);
                         $get_notification_count = $notification_staff_count[0]['total_count'];
                         foreach($food_staff as $food_staff)
                         {
                           		$date_time =date('d M | g:i A',strtotime($food_staff['created_at']));
                               
                                $data[] = array(  		
                                                  'notification_id' => $food_staff['s_notification_id'],          
                                                  'image' => $food_staff['image'],
                                  				  'description' => $food_staff['description'],
                                   				  'date' => $date_time,
                                  				  'image' =>$food_staff['image'],
                                  				  'notification_order_flag' =>$food_staff['notification_order_flag']
                                               );
                         }
                    }
                }


                if(!empty($housekeeping_staff_details) || !empty($rm_service_staff) || !empty($food_staff))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    $response['data'] = $data;
                    $response['notification_count'] = $get_notification_count;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }
      
        public function read_unread_notifications()
        {
            if(!empty($this->input->post('u_id')) && !empty($this->input->post('notification_id')) && !empty($this->input->post('flag')))
            {
                $u_id = $this->input->post('u_id');
                $notification_id = $this->input->post('notification_id');
                $flag = $this->input->post('flag');
             
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);
                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }
              	
                if($user_type == 9)
                {
                    $wh = '(s_notification_id  ="'.$notification_id.'")';
                    $housekeeping_staff_details = $this->ApiModel->getData('staff_notification', $wh);
                    if(!empty($housekeeping_staff_details))
                    {
                            $arr = array(
                                            'notification_order_flag' => $flag      
                                        );

                            $up = $this->ApiModel->edit_data('staff_notification',$wh,$arr);

                            if($up)
                            {
                              	$response['error_code'] = "200";
                                $response['message'] = "Success...";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }
                }
                elseif($user_type == 10)
                {
                    $wh = '(s_notification_id  ="'.$notification_id.'")';
                    $rm_service_staff = $this->ApiModel->getData('staff_notification', $wh);
                    if(!empty($rm_service_staff))
                    {
                            $arr = array(
                                            'notification_order_flag' => $flag      
                                        );

                            $up = $this->ApiModel->edit_data('staff_notification',$wh,$arr);

                            if($up)
                            {
                              	$response['error_code'] = "200";
                                $response['message'] = "Success...";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }
                }
                elseif($user_type == 8)
                {
                    $wh = '(s_notification_id  ="'.$notification_id.'")';
                    $food_staff = $this->ApiModel->getData('staff_notification', $wh);
                    if(!empty($food_staff))
                    {
                            $arr = array(
                                            'notification_order_flag' => $flag      
                                        );

                            $up = $this->ApiModel->edit_data('staff_notification',$wh,$arr);

                            if($up)
                            {
                              	$response['error_code'] = "200";
                                $response['message'] = "Success...";
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }
                }


                if(!empty($housekeeping_staff_details) || !empty($rm_service_staff) || !empty($food_staff))
                {
                    $response['error_code'] = "200";
                    $response['message'] = "Data found";
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "404";
                    $response['message'] = "Data Not found";
                    echo json_encode($response);
                    exit();
                }
              	      
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }        
      
        public function getall_staff_completed_order_history()
        {
           if(!empty($this->input->post('u_id')) && !empty($this->input->post('complete_date')))
           {
                $data = array();
                $send_data = array();
             	$u_id = $this->input->post('u_id');
                $complete_date = $this->input->post('complete_date');
                
                $todays_date = date('Y-m-d');
             
               
                    $user_type = '';
                    $wh_dept = '(u_id = "'.$u_id.'")';

                    $depart_data = $this->ApiModel->getData('register',$wh_dept);
                    //print_r($depart_data);die;
                    if(!empty($depart_data))
                    {
                          if($depart_data['user_type'] == "10") //Room Service
                          {
                              $user_type = 10;
                          }
                          else
                          {
                              if($depart_data['user_type'] == "8") //Food & Beverages
                              {
                                  $user_type = 8;
                              }
                              else
                              {
                                  if($depart_data['user_type'] == "9") //Housekeeping Service
                                  {
                                      $user_type = 9;
                                  }
                              }
                          }
                    }
             
              		if($user_type == 9) 
                    {
                        $wh = '(staff_id ="'.$u_id.'" AND complete_date ="'.$complete_date.'" AND order_status = 2)';
                        $get_house_keeping_staff_orders1 = $this->ApiModel->getData_Orders_housekeeping_history('house_keeping_orders',$wh);                                            
                        if(!empty($get_house_keeping_staff_orders1))
                        {

                           foreach($get_house_keeping_staff_orders1 as $h_s_orders)
                           {                                
                                
                                 $date = $h_s_orders['complete_date'];    //g:i A
                                 $time = $h_s_orders['complete_time'];
                                 $date_time =date('d M',strtotime($date));
                                 $time_1=date('g:i A',strtotime($time));
                                                           
                                                             
                                 $booking_id = '';
                                 $r_no = '';

                                 $wh_rm_no_s1 = '(booking_id ="'.$h_s_orders['booking_id'].'" AND hotel_id ="'.$h_s_orders['hotel_id'].'")';
                                 $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                 //print_r($get_rm_no_s1);
                                 if(!empty($get_rm_no_s1))
                                 {
                                   $booking_id = $get_rm_no_s1['booking_id'];
                                 }

                                 $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                 $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                 if(!empty($get_rm_no_s))
                                 {
                                   $r_no = $get_rm_no_s['room_no'];
                                 }        

                                //get all order details
                                $wh_o_details_1 = '(h_k_order_id ="'.$h_s_orders['h_k_order_id'].'")';
                                $get_orders_details_1 = $this->ApiModel->getAllData('house_keeping_order_details',$wh_o_details_1);
                                if(!empty($get_orders_details_1))
                                {
                                  	$send_data = array();
                                    foreach($get_orders_details_1 as $o_details_h)
                                    {
                                        $wh_service = '(h_k_services_id ="'.$o_details_h['h_k_service_id'].'")';
                                        $get_all_services = $this->ApiModel->getData('house_keeping_services',$wh_service);
                                        if(!empty($get_all_services))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_services['h_k_services_id'],
                                                                    'service_type' =>$get_all_services['service_type'],
                                              						'image' =>$get_all_services['icon'],
                                              						'quantity' => $o_details_h['quantity']                                          						
                                                                );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $h_s_orders['h_k_order_id'],
                                                    'room_no' => $r_no,	                                                                 
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data,
                                                   
                                               );
                           }          
                        }
                        
                        //laundry orders
                        $wh1 = '(staff_id ="'.$u_id.'" AND complete_date ="'.$complete_date.'" AND order_status = 2)';
                        $get_laundry_orders_his = $this->ApiModel->getData_Orders_cloth_history('cloth_orders', $wh1);

                        if(!empty($get_laundry_orders_his)) 
                        {

                             foreach($get_laundry_orders_his as $laundry_order_hs)
                             {                                  
                                  $date = $laundry_order_hs['complete_date'];    //g:i A
                                  $time = $laundry_order_hs['complete_time'];
                                  $date_time =date('d M',strtotime($date));
                                  $time_1=date('g:i A',strtotime($time));
                               
                                  //get room number
                                 
                               	  $booking_id = '';
                                  $r_no = '';

                                  $wh_rm_no_s1 = '(booking_id ="'.$laundry_order_hs['booking_id'].'" AND hotel_id ="'.$laundry_order_hs['hotel_id'].'")';
                                  $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                   //print_r($get_rm_no_s1);
                                  if(!empty($get_rm_no_s1))
                                  {
                                     $booking_id = $get_rm_no_s1['booking_id'];
                                  }

                                  $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                  $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                  if(!empty($get_rm_no_s))
                                  {
                                     $r_no = $get_rm_no_s['room_no'];
                                  }    

                                  //get all laundry order details
                                  $wh_o_details_laundry = '(cloth_order_id ="'.$laundry_order_hs['cloth_order_id'].'")';
                                  $get_laundry_orders_details_his1 = $this->ApiModel->getAllData('cloth_order_details',$wh_o_details_laundry);
                                  if(!empty($get_laundry_orders_details_his1))
                                  {
                                      $send_data = array();
                                      foreach($get_laundry_orders_details_his1 as $o_laundry_details_his)
                                      {
                                          $wh_l_service = '(cloth_id ="'.$o_laundry_details_his['cloth_id'].'")';
                                          $get_all_cloths = $this->ApiModel->getData('cloth',$wh_l_service);
                                          if(!empty($get_all_cloths))
                                          {

                                              $send_data1[] = array(
                                                                      'services_id'=>$get_all_cloths['cloth_id'],
                                                					  'image' =>$get_all_cloths['image'],
                                                                      'service_type' =>$get_all_cloths['cloth_name'],
                                                					  'quantity' => $o_laundry_details_his['quantity'],
                                                					  
                                                                );
                                          }
                                      }

                                  }

                                  $data[] = array(
                                                      'order_id' => $laundry_order_hs['cloth_order_id'],
                                                      'room_no' => $r_no,
                                                      'date' => $date_time." | ".$time_1,
                                                      'services' =>$send_data1
                                                  );
                             }
                        }
                                              
                        
                    }
                    elseif($user_type == 8)
                    {
                         // $send_data = array();
                      	  //services orders
                          $wh = '(staff_id ="'.$u_id.'" AND complete_date ="'.$complete_date.'" AND order_status = 2)';
                          $get_food_staff_orders_history = $this->ApiModel->getData_Orders_food_history('food_orders', $wh);
                          //print_r( $get_food_staff_orders_history);die;
                          if(!empty($get_food_staff_orders_history))
                          {
                              foreach($get_food_staff_orders_history as $food_order_history)
                              {
                                  
                                  $date = $food_order_history['complete_date'];    //g:i A
                                  $time = $food_order_history['complete_time'];
                                  $date_time =date('d M',strtotime($date));
                                  $time_1=date('g:i A',strtotime($time));
                                
                                  //get room number
                                 
                                  $booking_id = '';
                                  $r_no = '';

                                  $wh_rm_no_s1 = '(booking_id ="'.$food_order_history['booking_id'].'" AND hotel_id ="'.$food_order_history['hotel_id'].'")';
                                  $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                   //print_r($get_rm_no_s1);
                                  if(!empty($get_rm_no_s1))
                                  {
                                     $booking_id = $get_rm_no_s1['booking_id'];
                                  }

                                  $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                  $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                  if(!empty($get_rm_no_s))
                                  {
                                     $r_no = $get_rm_no_s['room_no'];
                                  }   

                                  //get all order details
                                  $wh_o_details = '(food_order_id ="'.$food_order_history['food_order_id'].'")';
                                  $get_orders_details_history = $this->ApiModel->getAllData('food_order_details',$wh_o_details); //getAllData
                                  //print_r($get_orders_details_history);
                                  if(!empty($get_orders_details_history))
                                  {
                                      $send_data = array();
                                      foreach($get_orders_details_history as $ord_details_his)
                                      {
                                          
                                          $wh_menu = '(food_item_id ="'.$ord_details_his['food_items_id'].'")';
                                          $get_all_menus = $this->ApiModel->getData('food_menus',$wh_menu);
                                          //print_r($get_all_menus);
                                          if(!empty($get_all_menus))
                                          {

                                              $send_data[] = array(
                                                                      'services_id'=>$get_all_menus['food_item_id'],
                                                					  'image' =>$get_all_menus['item_img'],
                                                                      'service_type' =>$get_all_menus['items_name'],
                                                					  'quantity' => $ord_details_his['quantity'],
                                                                  );
                                          }
                                      }

                                  }

                                  $data[] = array(
                                                    'order_id' => $food_order_history['food_order_id'],
                                                    'room_no' => $r_no,
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data
                                                 );
                              }
                          }
                        
                    }
             		elseif($user_type == 10)
                    {
                        //menus orders of room services
                        $wh = '(staff_id ="'.$u_id.'" AND complete_date ="'.$complete_date.'" AND order_status = 2)';
                        $get_rm_menus_staff_orders_history = $this->ApiModel->getData_Orders_rm_menus_history('room_service_menu_orders', $wh); 
                        if(!empty($get_rm_menus_staff_orders_history))
                        {

                           foreach($get_rm_menus_staff_orders_history as $r_s_order_history)
                           {
                                $date = $r_s_order_history['complete_date'];    //g:i A
                                $time = $r_s_order_history['complete_time'];
                                $date_time =date('d M',strtotime($date));
                                $time_1=date('g:i A',strtotime($time));
                             
                             	//get room number
                             	
                                $booking_id = '';
                                $r_no = '';

                                $wh_rm_no_s1 = '(booking_id ="'.$r_s_order_history['booking_id'].'" AND hotel_id ="'.$r_s_order_history['hotel_id'].'")';
                                $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                //print_r($get_rm_no_s1);
                                if(!empty($get_rm_no_s1))
                                {
                                  $booking_id = $get_rm_no_s1['booking_id'];
                                }

                                $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                if(!empty($get_rm_no_s))
                                {
                                  $r_no = $get_rm_no_s['room_no'];
                                }  

                                //get all order details
                                $wh_o_details_hist = '(room_service_menu_order_id ="'.$r_s_order_history['room_service_menu_order_id'].'")';
                                $get_rm_orders_details_history = $this->ApiModel->getAllData('room_service_menu_details',$wh_o_details_hist);
                                if(!empty($get_rm_orders_details_history))
                                {
                                  	$send_data = array();
                                    foreach($get_rm_orders_details_history as $o_details_history)
                                    {
                                        $wh_menu = '(room_serv_menu_id ="'.$o_details_history['room_serv_menu_id'].'")';
                                        $get_all_menu = $this->ApiModel->getData('room_serv_menu_list',$wh_menu);
                                        if(!empty($get_all_menu))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_menu['room_serv_menu_id'],
                                                                    'service_type' =>$get_all_menu['menu_name'],
                                              						'image'=>$get_all_menu['image'],
                                              						'quantity' => $o_details_history['quantity'] 
                                                              );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $r_s_order_history['room_service_menu_order_id'],
                                                    'room_no' => $r_no, 					           
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data
                                               );
                           }          
                        }

                        //services orders
                        $wh_service = '(staff_id ="'.$u_id.'" AND complete_date ="'.$complete_date.'" AND order_status = 2)';
                        $get_rm_service_staff_orders_history = $this->ApiModel->getData_Orders_rm_services_history('rmservice_services_orders', $wh_service); 
                        if(!empty($get_rm_service_staff_orders_history))
                        {

                           foreach($get_rm_service_staff_orders_history as $r_service_order_history)
                           {
                                 
                                $date = $r_service_order_history['complete_date'];    //g:i A
                                $time = $r_service_order_history['complete_time'];
                                $date_time =date('d M',strtotime($date));
                                $time_1=date('g:i A',strtotime($time));
                             
                                //get room number
                             	
                                $booking_id = '';
                                $r_no = '';

                                $wh_rm_no_s1 = '(booking_id ="'.$r_service_order_history['booking_id'].'" AND hotel_id ="'.$r_service_order_history['hotel_id'].'")';
                                $get_rm_no_s1 = $this->ApiModel->getData('user_hotel_booking',$wh_rm_no_s1);
                                //print_r($get_rm_no_s1);
                                if(!empty($get_rm_no_s1))
                                {
                                  $booking_id = $get_rm_no_s1['booking_id'];
                                }

                                $wh_rm_no_s = '(booking_id ="'.$booking_id.'")';
                                $get_rm_no_s = $this->ApiModel->getData('user_hotel_booking_details',$wh_rm_no_s);
                                if(!empty($get_rm_no_s))
                                {
                                  $r_no = $get_rm_no_s['room_no'];
                                }  

                                //get all order details
                                $wh_o_details = '(rmservice_services_order_id ="'.$r_service_order_history['rmservice_services_order_id'].'")';
                                $get_rm_service_details_history = $this->ApiModel->getAllData('rmservice_services_details',$wh_o_details);
                                if(!empty($get_rm_service_details_history))
                                {
                                  	$send_data = array();
                                    foreach($get_rm_service_details_history as $o_details_service_hist)
                                    {
                                        $wh_menu = '(r_s_services_id ="'.$o_details_service_hist['room_serv_service_id'].'")';
                                        $get_all_menu = $this->ApiModel->getData('room_servs_services',$wh_menu);
                                        if(!empty($get_all_menu))
                                        {

                                            $send_data[] = array(
                                                                    'services_id'=>$get_all_menu['r_s_services_id'],
                                                                    'service_type' =>$get_all_menu['service_name'],
                                              						'image' =>$get_all_menu['icon_img'],
                                              						'quantity' => $o_details_service_hist['quantity'],
                                                                );
                                        }
                                    }

                                }

                                $data[] = array(
                                                    'order_id' => $r_service_order_history['rmservice_services_order_id'],
                                                    'room_no' => $r_no, 					          
                                                    'date' => $date_time." | ".$time_1,
                                                    'services' =>$send_data,                                                    
                                               );
                           }          
                        }
                                              
                      
                    }
                      	 
                    if(!empty($get_house_keeping_staff_orders1) || !empty($get_laundry_orders_his) || !empty($get_food_staff_orders_history) || !empty($get_rm_menus_staff_orders_history) || !empty($get_rm_service_staff_orders_history))
                    {
                      	$response['error_code'] = "200";
                        $response['message'] = "Data found";
                        $response['data'] = $data;                       
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "404";
                        $response['message'] = "Data Not found";
                        echo json_encode($response);
                        exit();
                    }           
                
           }
           else
           {
              $response['error_code'] = "406";
              $response['message'] = "Required Parameter Missing..!";
              echo json_encode($response);
              exit();
           }
        
        }


        // code by vivek
        // public function ()
        // {
        //    if(!empty($this->input->post('u_id')) && !empty($this->input->post('department_id')))
        //    {
        //          $u_id = $this->input->post('u_id');
        //          $department_id = $this->input->post('department_id');
        //          $is_active = '1';
        //         $user_type = ''; 
        //         $wh = '(department_id = "'.$department_id.'")';
        //         $depart_data = $this->ApiModel->getData('departement',$wh);
        //         if(!empty($depart_data))
        //         {
        //             if($depart_data['department_name'] == "Room Service")
        //             {
        //                 $user_type = 10;
        //             }
        //             else
        //             {
        //                 if($depart_data['department_name'] == "Food & Beverages")
        //                 {
        //                     $user_type = 8;
        //                 }
        //                 else
        //                 {
        //                     if($depart_data['department_name'] == "Housekeeping Service")
        //                     {
        //                         $user_type = 9;
        //                     }
        //                 }
        //             }
        //         }
        //         if(!empty($depart_data))
        //         {

        //             $wh_admin = '(u_id ="'.$u_id.'")';
        //             $get_hotel_id = $this->ApiModel->getData('register',$wh_admin);
        //             $hotel_id = $get_hotel_id['hotel_id'];
        //             $wh = '(hotel_id = "'.$hotel_id.'" AND user_type = "'.$user_type.'" AND is_active = "'.$is_active.'")';
        //             $get_user_data = $this->ApiModel->getstaffdata('register',$wh);

        //             if(!empty($get_user_data))
        //             {
        //                 foreach($get_user_data as $g_u_d)
        //                 {
        //                 //  $staff_id = $g_u_d['u_id'];
        //                     $send_data[] = array(
        //                         'staff_name' =>$g_u_d['full_name'],
        //                         'u_id' => $g_u_d['u_id']
        //                     );
        //                 }
        //                 $response['error_code'] = "200";
        //                 $response['message'] = "Success";
        //                 $response['data'] = $send_data;
        //                 echo json_encode($response);
        //                 exit();
        //             }
        //             else
        //             {
        //                 $response['error_code'] = "403";
        //                 $response['message'] = "Data Not Available";
        //                 echo json_encode($response);
        //                 exit();
        //             }
        //         }
        //         else
        //         {
        //             $response['error_code'] = "401";
        //             $response['message'] = "department id Doesn't Match. Please Check";
        //             echo json_encode($response);
        //             exit();
        //         }
        //    }
        //    else
        //    {
        //       $response['error_code'] = "406";
        //       $response['message'] = "Required Parameter Missing..!";
        //       echo json_encode($response);
        //       exit();
        //    }
        // }
       
        public function assign_handover()
        {
            if(!empty($this->input->post('u_id')) && !empty($this->input->post('staff_u_id')))
            {
                // $a=$this->input->post();
                $u_id = $this->input->post('u_id');
                $staff_u_id = $this->input->post('staff_u_id');
                $todays_date = date('Y-m-d');
                $user_type = '';
                $wh_dept = '(u_id = "'.$u_id.'")';

                $depart_data = $this->ApiModel->getData('register',$wh_dept);

                if(!empty($depart_data))
                {
                    if($depart_data['user_type'] == "10") //Room Service
                    {
                        $user_type = 10;
                    }
                    else
                    {
                        if($depart_data['user_type'] == "8") //Food & Beverages
                        {
                            $user_type = 8;
                        }
                        else
                        {
                            if($depart_data['user_type'] == "9") //Housekeeping Service
                            {
                                $user_type = 9;
                            }
                        }
                    }
                }

                    if($user_type == 9)
                    {
                        $wh1 = '(staff_id ="' . $u_id . '" AND accept_date ="' . $todays_date . '" AND order_status = 1)';
                        $get_housekeeping_staff_orders = $this->ApiModel->getAllData('house_keeping_orders', $wh1);
                        $get_cloth_staff_orders = $this->ApiModel->getAllData('cloth_orders', $wh1);
                        // print_r($get_housekeeping_staff_orders);
                        // print_r($get_cloth_staff_orders);die;
                        
                        // Check if either housekeeping or cloth orders exist
                        if ($get_housekeeping_staff_orders || $get_cloth_staff_orders) {
                            $arr = array(
                                'hotel_id' => $depart_data['hotel_id'],
                                'staff_id' => $staff_u_id,
                                'added_by_u_id' => $u_id,
                            );
            
                            $add = $this->ApiModel->edit_data_assign_handover('house_keeping_orders', $arr, $wh1);
                            // print_r($add);echo "first";
                            $add1 = $this->ApiModel->edit_data_assign_handover('cloth_orders', $arr, $wh1);
            
                            if ($add && $add1) {
                                // echo "hi";
                                $response['error_code'] = "200";
                                $response['message'] = "Handover assign successfully...!";
                                echo json_encode($response);
                                exit();
                            }else if(($add || $add1)){
                                // echo "hello";
                                $response['error_code'] = "200";
                                $response['message'] = "Handover assign successfully...!";
                                echo json_encode($response);
                                exit();
                            }
                            else{
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        } else {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                    elseif($user_type == 8)
                    {

                        $wh = '(staff_id ="'.$u_id.'" AND  accept_date ="'.$todays_date.'" AND order_status = 1)';
                        $get_food_staff_orders = $this->ApiModel->getAllData('food_orders', $wh);
                        // print_r($get_food_staff_orders);die;
                        if($get_food_staff_orders)
                        {
                                        $arr = array(
                                        'hotel_id'=> $depart_data['hotel_id'],
                                        'staff_id' => $staff_u_id,
                                        'added_by_u_id'=> $u_id,
                                        
                                    );
                            $wh1 = '(staff_id ="'.$u_id.'" AND accept_date ="'.$todays_date.'" AND order_status = 1)';

                            $add = $this->ApiModel->edit_data_assign_handover('food_orders',$arr,$wh1);
                            if($add)           
                            {
                                $response['error_code'] = "200";
                                $response['message'] = "Handover assign successfully...!";           
                                echo json_encode($response);
                                exit();
                            }
                            else
                            {
                                $response['error_code'] = "403";
                                $response['message'] = "Something went wrong";
                                echo json_encode($response);
                                exit();
                            }
                        }
                        else
                        {
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        }
                    }
                    elseif($user_type == 10)
                    {
                        
                            $response['error_code'] = "403";
                            $response['message'] = "Something went wrong";
                            echo json_encode($response);
                            exit();
                        
                    }
                else
                {
                     $response['error_code'] = "403";
                     $response['message'] = "Data Not Available";
                     echo json_encode($response);
                     exit();
                }
            }
            else
            {
                 $response['error_code'] = "406";
                 $response['message'] = "Required Parameter Missing..!";
                 echo json_encode($response);
                 exit();
            }
        }

        // room number
        public function occupied_room()
        {
           if(!empty($this->input->post('hotel_id')))
           { 
           		$hotel_id = $this->input->post('hotel_id');

                $room_info = $this->ApiModel->get_occupied_rooms_staff($hotel_id);
              
                if($room_info)
                {
                  
                    $response['error_code'] = "200";
                    $response['message'] = "You Have Successfully Logged in";
                    $response['data'] = $room_info;
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['error_code'] = "401";
                    $response['message'] = "currently No Room Occupancy";
                    echo json_encode($response);
                    exit();
                }
           }
           else
           {
              $response['error_code'] = "406";
              $response['message'] = "Required Parameter Missing..!";
              echo json_encode($response);
              exit();
           }
        }
        
        // reset token of staff users
        public function reset_staff_token()
        {
           if(!empty($this->input->post('u_id')))
           {
                $u_id = $this->input->post('u_id');
        
                $wh = '(u_id ="'.$u_id.'")';
                $user = $this->ApiModel->getData('register',$wh);
                //print_r($get_user_data);
                if(!empty($user))
                {
                    $arr = array(
                        'token'=> "",
                    );

                    $reset_token = $this->ApiModel->edit_data('user_firebase_tokens',$wh,$arr);
                    if($reset_token)
                    {
                        $response['error_code'] = "200";
                        $response['message'] = "Token Reset successfully";
                        echo json_encode($response);
                        exit();
                    }
                    else
                    {
                        $response['error_code'] = "403";
                        $response['message'] = "Something Went Wrong";
                        echo json_encode($response);
                        exit();
                    }
                }
                else
                {
                    $response['error_code'] = "403";
                    $response['message'] = "User not found";
                    echo json_encode($response);
                    exit();
                }
           }
           else
           {
              $response['error_code'] = "406";
              $response['message'] = "Required Parameter Missing..!";
              echo json_encode($response);
              exit();
           }
        }
	   
    }
?>
