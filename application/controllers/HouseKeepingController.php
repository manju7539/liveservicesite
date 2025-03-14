<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HouseKeepingController extends CI_Controller 
{
    function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		 $this->load->model('MainModel');
		  $this->load->model('FrontofficeModel');
		  $this->load->model('HotelAdminModel');
		  $this->load->model('HouseKeepingModel');
		  $this->load->model('FoodAdminModel');
          $this->load->helper('notification_helper');
		 if(empty($this->session->userdata('u_id')))
         {
		 	redirect('/');
		 } 
    }
		
    
	public function OnCallOrder()
	{
		$postArr = $this->input->post();
        $admin_id = $this->session->userdata('u_id');
        // print_r($postArr);die;
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
  // print_r($hotel_id);die;
        $order_type = $this->input->post('order_type');
        // print_r($order_type);die;
        $floor_no = $this->input->post('floor');
        $room_no = $this->input->post('room_non');
        $order_date = $this->input->post('date_picker');
       
        
        $todays_date = date('Y-m-d');
        if(!empty($order_date) && !empty($floor_no) && !empty($room_no) && !empty($order_type)) 
				{   
                    // echo "hi";die;
               
                    $data['new_order_list'] = $this->HouseKeepingModel->search_all_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type);
                    // echo "<pre>";
                    // print_r( $data['new_order_list']);die;
                    $data["accept_order_list"] = $this->HouseKeepingModel->search_all_accepted_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type);
                    //   echo "<pre>";
                    // print_r( $data['accept_order_list']);die;
                    $data["complete_order_list"] = $this->HouseKeepingModel->search_all_completed_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type);
              
                    $data["reject_order_list"] = $this->HouseKeepingModel->search_all_rejected_order_data($hotel_id,$order_date,$floor_no,$room_no,$order_type);
                    $this->load->view('include/header');
                    $this->load->view('housekeeping/view_search_order',$data);
                    $this->load->view('include/footer');
				}

                else if(!empty($order_date) && !empty($floor_no) && !empty($room_no) && empty($order_type)) 
				{
                    echo "coming soon";
                    
				}
                else if(!empty($order_date) && !empty($floor_no) && !empty($order_type) && empty($room_no))
                {
                    echo "coming soon";
                }
                else if(!empty($floor_no) && !empty($room_no) && !empty($order_type) && empty($order_date))
                {
                    echo "coming soon";
                }
                else if(!empty($room_no) && !empty($order_type) && !empty($order_date) && empty($floor_no))
                {
                    echo "coming soon";
                }

                else if(!empty($order_date) && !empty($floor_no) && empty($room_no) && empty($order_type))
                {
                    echo "coming soon";
                }
                else if(!empty($order_date) && !empty($room_no) && empty($floor_no) && empty($order_type))
                {
                    echo "coming soon";
                }
                else if(!empty($order_date) && !empty($order_type) && empty($floor_no) && empty($room_no))
                {
                    echo "coming soon";
                }
                else if(!empty($floor_no) && !empty($room_no) && empty($order_date) && empty($order_type))
                {
                    echo "coming soon";
                }
                else if(!empty($floor_no) && !empty($order_type) && empty($order_date) && empty($room_no))
                {
                    echo "coming soon";
                }
                else if(!empty($room_no) && !empty($order_type) && empty($order_date) && empty($floor_no))
                {
                    echo "coming soon";
                }
                else if(!empty($order_date))
                {
                    $data['new_order_list'] = $this->HouseKeepingModel->search_date_order_data($hotel_id,$order_date);
                    //  print_r( $data['new_order_list']);die;
                   $data["accept_order_list"] = $this->HouseKeepingModel->search_date_accepted_order_data($hotel_id,$order_date);
                    //   print_r( $data['accept_order_list']);die;
                   $data["complete_order_list"] = $this->HouseKeepingModel->search_date_completed_order_data($hotel_id,$order_date);
                //  print_r( $data['complete_order_list']);die;
                   $data["reject_order_list"] = $this->HouseKeepingModel->search_date_rejected_order_data($hotel_id,$order_date);
                    //   print_r( $data['reject_order_list']);die;
                    $data["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
                    $this->load->view('include/header');
                    $this->load->view('housekeeping/view_search_order',$data);
                    $this->load->view('include/footer');
                }
                else if(!empty($order_type))
                {
                    $data['new_order_list'] = $this->HouseKeepingModel->search_order_data($hotel_id,$order_type,$todays_date);
             
                   $data["accept_order_list"] = $this->HouseKeepingModel->search_accepted_order_data($hotel_id,$order_type);
           
                   $data["complete_order_list"] = $this->HouseKeepingModel->search_completed_order_data($hotel_id,$order_type);
              
                   $data["reject_order_list"] = $this->HouseKeepingModel->search_rejected_order_data($hotel_id,$order_type);
             
                    $data["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
                    $this->load->view('include/header');
                    $this->load->view('housekeeping/view_search_order',$data);
                    $this->load->view('include/footer');
                }
                else if(!empty($floor_no))
                {
                    $data['new_order_list'] = $this->HouseKeepingModel->search_floor_order_data($hotel_id,$todays_date,$floor_no);
             
                    $data["accept_order_list"] = $this->HouseKeepingModel->search_floor_accepted_order_data($hotel_id,$floor_no);
            
                    $data["complete_order_list"] = $this->HouseKeepingModel->search_floor_completed_order_data($hotel_id,$floor_no);
               
                    $data["reject_order_list"] = $this->HouseKeepingModel->search_floor_rejected_order_data($hotel_id,$floor_no);
             
                    $data["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
                    $this->load->view('include/header');
                    $this->load->view('housekeeping/view_search_order',$data);
                    $this->load->view('include/footer');
                }
                else if(!empty($room_no))
                {
                    //  echo "hi";
                    // die;
                    $data['new_order_list'] = $this->HouseKeepingModel->search_room_order_data($hotel_id,$todays_date,$room_no);
                    $data["accept_order_list"] = $this->HouseKeepingModel->search_room_accepted_order_data($hotel_id,$room_no);
              
                    $data["complete_order_list"] = $this->HouseKeepingModel->search_room_completed_order_data($hotel_id,$room_no);
                    $data["reject_order_list"] = $this->HouseKeepingModel->search_room_rejected_order_data($hotel_id,$room_no);
                    
                    $data["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
                   
                    $this->load->view('include/header');
                    $this->load->view('housekeeping/view_search_order',$data);
                    $this->load->view('include/footer');
                }
                else{
                    // echo "hello";
                    // die;
                  $data["new_order_list"] = $this->HouseKeepingModel->get_new_order_list_pagination($todays_date,$hotel_id);
        $data["accept_order_list"] = $this->HouseKeepingModel->get_all_accepted_orders_pagination($hotel_id);
        $data["complete_order_list"] = $this->HouseKeepingModel->get_service_completed_list_pagination($hotel_id);
        $data["reject_order_list"] = $this->HouseKeepingModel->get_service_rejected_list_pagination($hotel_id);
      
        $data["type"]  = !empty($postArr['type']) ? $postArr['type'] : '';
      
        $this->load->view('include/header');
        $this->load->view('housekeeping/OnCallOrder', $data);
        $this->load->view('include/footer');
				}
   
    }
    
    public function get_out_of_time_huk_orders()
	{
		log_message('DEBUG', 'housekeepingtimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HouseKeepingModel->outof_time_housekeeping_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'h_k_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(h_k_order_id = "'.$val_time.'" AND order_status = 0)';
            $arr= array(
                'out_of_time_status'=>1,
            );
            $out_of_time_status_update = $this->HouseKeepingModel->editData($tbl="house_keeping_orders",$where,$arr);
            $result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function get_manage_order_data()
	{   
        //  echo "hi";die;
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }

        $visiter_data = $this->HouseKeepingModel->get_visiter_data($rowperpage,$row,$search, $hotel_id);
        $total_get_visiter_data = $this->HouseKeepingModel->get_total_visiter_data($search, $hotel_id);

        $totalRecords = $total_get_visiter_data->total_record;

        $data = array();
        $i=1;
        foreach($visiter_data AS $val)
        {
            if($val['booking_status'] == 1)
            {
                $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['h_k_order_id'].'</span></div>';
            
                $req_time = date('h:i A', strtotime($val['order_time']));
                $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';
    
                $order_type ='';
                if($val['order_from'] == 1)
                {
                    $order_type = 'On Call Order';
                }
                elseif($val['order_from'] == 2)
                {
                    $order_type = 'From Staff Order';
                }
                elseif($val['order_from'] == 3)
                {
                    $order_type = 'App Order';
                }
                //   $floor_no = $val['floor'];
                //     $floor_no = $val['floor'];
                //   $r_no = $val['room_no'];
                $guest_name = $val['full_name'];
    
                $services = '  <a href="#" class="badge badge-info edit_model_click"  data-unic-id="' .$val['h_k_order_id'].'">view</a>';
                 
                $orderstatus =  '<a href="#" class="badge badge-info new_house_ord_req" data-id1="'.$val['h_k_order_id'].'">view</a>';
    
                $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="edit_data" data-bs-toggle="modal" data-id="'.$val['h_k_order_id'].'" data-bs-target=".update_staff_modal"><i class="fa fa-share"></i></a> ';	
                
    
                $data[] = array(
                    "Sr_No"			=>	$row+$i++ ,
                    "Order ID"	=>  $order_id,
                    "Date_Time"	=>  $Req_Date_Time,
                    "Order Type"	=> $order_type ,
                    "Floor"	=>  $val['floor'],
                    "Room_Number"	=>   $val['room_no'],
                    "Guest_Name"	=>$val['full_name'],
                    "Note"		=>  $services,
                    "Services"	=>  $orderstatus,
                    "Action"	=>   $action
                );
            }
        }
       
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
       
        echo json_encode($response);
        
        // $this->load->view('roomservice/ajaxnewroomServiceAcceptedOrder', $data);
    }
    public function auto_load_menuorder_data()
	{
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->HouseKeepingModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');
		$data["new_order_list"] = $this->HouseKeepingModel->get_visitor_pagination($admin_id,$todays_date);
		$this->load->view('housekeeping/auto_load_menuorder',$data);
	}

    public function change_new_order_status()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $todays_date = date('Y-m-d');
        $otp = rand('1111','9999');
    
        $wh = '(u_id = "'.$admin_id.'")';
        $get_data = $this->HouseKeepingModel->getData('register', $wh);
    
        $h_k_order_id = $this->input->post('h_k_order_id');
        $order_status = $this->input->post('order_status');
        $time = $this->input->post('time');
        $staff_id =$this->input->post('staff_id');
        $user_id = $this->input->post('u_id');
        $booking_id = $this->input->post('booking_id');
            //staff name
        $staff_name = '';
        $where1 = '(u_id ="' . $staff_id. '")';
        $get_staff_name = $this->MainModel->getData('register', $where1);
        if (!empty($get_staff_name)) {
            $staff_name = $get_staff_name['full_name'];
        } else {
            $staff_name = '';
        }

        $get_hotel = '(u_id = "' . $hotel_id . '")';
        $hotel_data = $this->MainModel->getData('register',$get_hotel);
        $hotel_name = $hotel_data['hotel_name'];

        if ($order_status == 1) 
        {
            $arr = array(
                        'order_status' =>1,
                        'staff_id' =>$staff_id,
                        'staff_name'=>$staff_name,
                        'approx_time' =>$time,
                        'accept_date'=>date('Y-m-d'),
                        'accept_time' =>date('G:i:s'),
                        'order_status'=>$_POST['order_status'],
                        'otp' =>$otp
                        );

            $wh = '(h_k_order_id = "'.$h_k_order_id.'")';
            $add = $this->HouseKeepingModel->editData($tbl='house_keeping_orders', $wh, $arr);
            if ($add) 
            {
                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl='house_keeping_orders', $wh);
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $title = "";
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                if(!empty($get_dt))
                {
                    $deviceToken = $get_dt['token'];
                    $title = 'Housekeeping Order Is Accepted';
                    $body = 'Your HouseKeeping Order ID is "' . $h_k_order_id . '"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $h_k_order_id";
                $arr_noti = array(
                                'hotel_id' => $hotel_id,
                                'u_id' => $user_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );

                $this->MainModel->insert_data('user_notification',$arr_noti);

                // push notification for staff
                $wh_s = '(u_id = "'.$get_u_id['staff_id'].'")';
                $get_staff_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_s);
                $title1 = "";
                if(!empty($get_staff_dt)){
                
                    $deviceToken1= $get_staff_dt['token'];
                    $title1 = 'New Order Assign ';
                    $body1 = 'HouseKeeping Order ID is "' . $h_k_order_id . '"';
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }

                // inside staff app notification
                $subject1 = $title1;
                $description1 = "$title1 And Order Id Is $h_k_order_id";
                $arr_staff_noti = array(
                                    'u_id'=>$staff_id,
                                    'hotel_id' => $hotel_id,
                                    'subject' => $subject1,
                                    'description' => $description1,
                                    'notification_order_flag' =>0,    
                                );
                // print_r($arr_staff_noti);die;
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti);

            //     $arr2 = array(
            //                    'hotel_id' =>$get_data['hotel_id'],
            //                    'u_id'=>$user_id,
            //                    'subject' => 'Request Accept',
            //                    'description' => 'user order request accept by housekeeping and assign their staff',
            //                );
            //    $insert_id3 = $this->HouseKeepingModel->insertData($tbl="user_notification", $arr2);
                
                $arr3= array(
                                'hotel_id' => $get_data['hotel_id'],
                                'staff_id'=>$staff_id,
                                'u_id'=>$user_id,
                                'booking_id'=>$booking_id,                                       
                                'description' => 'Order Assing to the staff',
                                'activity_for' => 2                    
                            );

                $add1 = $this->HouseKeepingModel->insertData($tbl="activity_of_hotel",$arr3);
                
                // $data["new_order_list"] = $this->HouseKeepingModel->get_new_order_list_pagination( $todays_date,$hotel_id);
                $data["new_order_list"] = $this->HouseKeepingModel->get_new_order_list_pagination( $todays_date,$hotel_id);
                $data["accept_order_list"] = $this->HouseKeepingModel->get_all_accepted_orders_pagination($hotel_id);
                $data["complete_order_list"] = $this->HouseKeepingModel->get_service_completed_list_pagination($hotel_id);
                $data["reject_order_list"] = $this->HouseKeepingModel->get_service_rejected_list_pagination($hotel_id);
                // $data['page']= 'accept';
                // print_r($data);die;
                $this->load->view('housekeeping/ajaxoncallorderlist', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('OnCallOrder'));
            }
        }
        elseif($order_status == 3)
        {
            $arr = array(
                            'order_status' =>3, 
                            'order_status'=>$_POST['order_status'],
                            'reject_reason'=>$_POST['reject_reason'],
                            'staff_id' =>0,
                            'reject_date' =>date('Y-m-d')   
                        );

            $wh = '(h_k_order_id = "'.$h_k_order_id.'")';
            $add = $this->HouseKeepingModel->editData($tbl='house_keeping_orders', $wh, $arr);
            if ($add) 
            {
                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl='house_keeping_orders', $wh);
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                $title ="";
                $reason ='';

                if($get_u_id['reject_reason'] == 1)
                {
                    $reason = "Out of stock";
                }
                else if($get_u_id['reject_reason'] == 2)
                {
                    $reason = "We Do Not Serve";
                }
                else if($get_u_id['reject_reason'] == 3)
                {
                    $reason = "Out Of Time";
                }
                else if($get_u_id['reject_reason'] == 4)
                {
                    $reason = "Others";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Housekeeping Order Is Rejected';
                    $body = 'Your HouseKeeping Order ID is "'.$h_k_order_id.'" And Your Order is Rejected Because OF "'.$reason.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside user app notification
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Order Id Is $h_k_order_id";
                $arr_noti = array(
                                'hotel_id' => $hotel_id,
                                'u_id' => $user_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
                // print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);
                
                $data["new_order_list"] = $this->HouseKeepingModel->get_new_order_list_pagination( $todays_date,$hotel_id);
                $data["accept_order_list"] = $this->HouseKeepingModel->get_all_accepted_orders_pagination($hotel_id);
                $data["complete_order_list"] = $this->HouseKeepingModel->get_service_completed_list_pagination($hotel_id);
                $data["reject_order_list"] = $this->HouseKeepingModel->get_service_rejected_list_pagination($hotel_id);
            //    $data['page']= 'reject';
                $this->load->view('housekeeping/ajaxoncallorderlist', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('OnCallOrder'));
            }
        }
    }

    public function Accepted()
    {

        $admin_id = $this->session->userdata('u_id');

        $wh_admin = '(u_id ="'.$admin_id.'")';  
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
                
        $order_type = $this->input->post('order_type');
        
            
        $data["list"] = $this->HouseKeepingModel->get_all_accepted_orders_pagination($hotel_id);
        //echo "<pre>";
        //print_r($data["list"]);die;
        $this->load->view('include/header');
        $this->load->view('housekeeping/OnCallOrder',$data);
        $this->load->view('include/footer');
    }

    public function Completed_orders()
	{
		
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $order_type = $this->input->post('order_type');
    
        $wh = '(order_status = 2 AND hotel_id ="'.$hotel_id.'")';
        $data["list"] = $this->HouseKeepingModel->get_service_completed_list_pagination($hotel_id);
        $this->load->view('include/header');
        $this->load->view('housekeeping/OnCallOrder',$data);
        $this->load->view('include/footer');
        
    }

    public function Rejected_orders()
	{
        $admin_id = $this->session->userdata('u_id');

        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $order_type = $this->input->post('order_type');
            
        $wh = '(order_status = 3 AND hotel_id ="'.$hotel_id.'")';
        $data["list"] = $this->HouseKeepingModel->get_service_rejected_list_pagination($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/OnCallOrder',$data);
        $this->load->view('include/footer');
	}
	
    public function add_housekeeping_order()
    {
        $otp = rand('1111','9999');
        $u_id = $this->session->userdata('u_id');
        $wh = '(u_id = "'.$u_id.'")';
        $get_data = $this->HouseKeepingModel->getData('register', $wh);

        $orders_type = $this->input->post('orders_type');
        $room_no = $this->input->post('room_no');
        $user_name = $this->input->post('guest_id'); 
        // $order_time = $this->input->post('order_time');
        // $staff_id = $this->input->post('staff_id');
        $additional_note = $this->input->post('additional_note');
        $srvice_type = $this->input->post('srvice_type');
        $service_amt = $this->input->post('service_amt');
        $qty = $this->input->post('qty'); 

        $service_type2 = $this->input->post('service_type2');
        $price = $this->input->post('price');
        $qty1 = $this->input->post('qty1');
      
        //calculate service total amount
        $service_amount = $service_amt * $qty;
        
        $enquiry_id = $this->input->post('enquiry_id');
        $date= date('Y-m-d');
        $booking_id = '';
        $wh11 = '(u_id = "'.$user_name.'" AND check_out >= "'.$date.'" AND enquiry_id="'. $enquiry_id.'")';
        $get_data_booking_id = $this->HouseKeepingModel->getData('user_hotel_booking', $wh11);
        // var_dump( $get_data_booking_id);die;
        if(!empty($get_data_booking_id))
        {
            $booking_id = $get_data_booking_id['booking_id'];
        }

        $arr= array(
                        'hotel_id'=>$get_data['hotel_id'],
                        'u_id' =>$user_name,
                        'booking_id' =>$booking_id,
                        'room_no'=>$room_no,
                        // 'staff_id'=>$staff_id,
                        'order_from'=>$orders_type,
                        // 'accept_date' =>date('Y-m-d'),
                        //   'accept_time' =>date('G:i:s'),
                        'order_date' =>date('Y-m-d'),
                        'order_time' =>date('G:i:s'),
                        'additional_note'=>$additional_note,
                        'order_status'=>0,
                        'order_total' => $service_amount,
                        'added_by' =>1,
                        'otp' => $otp,
                        'added_by_u_id' =>$get_data['u_id']
                    );
        $add = $this->HouseKeepingModel->insertData($tbl="house_keeping_orders", $arr);
        if ($add) 
        {
            $arr2 = array(
                            'hotel_id' =>$get_data['hotel_id'],
                            'h_k_order_id'=>$add,
                            'h_k_service_id' => $srvice_type,
                            'price' => $service_amt,
                            'quantity' => $qty,
                        );
            $insert_id2 = $this->HouseKeepingModel->insertData($tbl="house_keeping_order_details", $arr2);

            if (!empty($service_type2)) 
            {
                $count = count($service_type2);
                for ($i = 0; $i < $count; $i++) 
                {
                    $arr3 = array(
                                    'hotel_id' =>$get_data['hotel_id'],
                                    'h_k_order_id'=>$add,
                                    'h_k_service_id' => $service_type2[$i],
                                    'price' => $price[$i],
                                    'quantity' => $qty1[$i],
                                );
                    $insert_id3 = $this->HouseKeepingModel->insertData($tbl="house_keeping_order_details", $arr3);
                }
            }

            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];
            $todays_date = date('Y-m-d');

            $data["new_order_list"] = $this->HouseKeepingModel->get_new_order_list_pagination( $todays_date,$hotel_id);
            $this->load->view('housekeeping/ajaxoncallorderlist', $data);
        } 
     
    }
          

    public function get_user_id_on_call()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $room_no = $this->input->post('room_no');
       
        $guest_data = $this->HouseKeepingModel->get_room_no_data($hotel_id, $room_no,$todays_date);
        if (!empty($guest_data)) 
        {
            $output = '';
            $output .= $guest_data['u_id'];
            echo $output;
        }
    }

    public function get_user_name()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $room_no = $this->input->post('room_no');

        $guest_data = $this->HouseKeepingModel->get_room_no_data($hotel_id, $room_no,$todays_date);
        if (!empty($guest_data)) 
        {
            $wh = '(u_id = "'.$guest_data['u_id'].'")';
            $user_data = $this->HouseKeepingModel->getData('register', $wh);
            $output = '';
            $output .= $user_data['full_name'];

            echo $output;
        }
    }

    public function get_user_id_data()
    {
      	$todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $room_no = $this->input->post('room_no');

        $guest_data = $this->HouseKeepingModel->get_room_no_data($hotel_id,$room_no,$todays_date);
        if(!empty($guest_data ))
        {
            $wh = '(u_id = "'.$guest_data['u_id'].'")';
            $user_data = $this->HouseKeepingModel->getData('register',$wh);
            $output = ''; 
            $output .= $user_data['u_id'];

            echo $output;
        }

    }
    public function get_enquiry_id()
    {
        $todays_date=date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $room_no = $this->input->post('room_no');
        
        $guest_data = $this->HouseKeepingModel->get_room_no_data($hotel_id,$room_no,$todays_date);
        if(!empty($guest_data ))
        {
            $output = ''; 
            $output .= $guest_data['enquiry_id'];
            
            echo $output;
        }  
    }
    public function get_service_type_amt()
    {
        $srvice_type_id = $this->input->post('srvice_type');
        $where = '(h_k_services_id = "'.$srvice_type_id.'")';
        $service_amount = $this->HouseKeepingModel->getData('house_keeping_services', $where);
        $output = '';
        $output .= $service_amount['amount'];

        echo $output;
    }

    public function Staff_mang()
	{
		
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $data["staff_list"] = $this->HouseKeepingModel->get_staff_list($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/Staff_mang', $data);
        $this->load->view('include/footer');
	    
	}	
    public function getStaffData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getregdata($tbl ='register', $wh);

        echo json_encode($data);
       
    }
    public function add_staff()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
      
        $s_name = $this->input->post('s_name');
        $s_mobile = $this->input->post('s_mobile');
        $s_email = $this->input->post('s_email');
        $s_address = $this->input->post('s_address');
      
      	$file="";
        if (!empty($_FILES['File']['name'])) 
        {
            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/staff_profile/';
            // print_r($path);die;
            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file'))
            {
                $file_data = $this->upload->data();
                //$this->resize_image($file_data);

                $file_path_url = $path . $file_data['file_name'];

                $file=$file_path_url;
            }
            else
            {
              	$file="";
            }
        } 
      
        
        $arr= array(
                        'full_name'=>$s_name,
                        'mobile_no'=>$s_mobile,
                        'email_id'=>$s_email,
                        'address'=>$s_address,
                        'register_date'=>date('Y-m-d'),
                        'user_type'=>9,
                        'user_is'=>2,
                        'is_active'=>1,
                        'hotel_id' => $get_hotel_id['hotel_id'],
                        'profile_photo' =>base_url().$file
                    );
        $wh = '(mobile_no ="'.$s_mobile.'")';
        $mobile_exist = $this->HouseKeepingModel->getAllData1('register', $wh);
        $wh1 = '(email_id ="'.$s_email.'")';
        $email_exist = $this->HouseKeepingModel->getAllData1('register', $wh1);
        if ($mobile_exist) 
        {
            echo 1;
            // $this->session->set_flashdata('exist', 'Mobile Number Already Exist');
            // redirect(base_url('Staff_mang'));
        } 
        elseif($email_exist) 
        {
            echo 2;
            // $this->session->set_flashdata('exist', 'Email Allready Exist');
            // redirect(base_url('Staff_mang'));
        } 
        else 
        {
            $add = $this->HouseKeepingModel->insertData($tbl="register", $arr);
            if($add) 
            {
                $data["staff_list"] = $this->HouseKeepingModel->get_staff_list($hotel_id);
                $this->load->view('housekeeping/ajaxStaffList', $data);
            }
        }
      
    }

    public function delete_staff()
    {
        $id=$this->input->post('id');
        $where = '(u_id = "'.$id.'")';
        $result= $this->HouseKeepingModel->deleteData($tbl="register", $where);
        if ($result) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id']; 
          	$data["staff_list"] = $this->HouseKeepingModel->get_staff_list($hotel_id);
            $this->load->view('housekeeping/ajaxStaffList', $data);
        } else {
            echo "0";
        }
    }

    
    public function update_staff()
    {
        $u_id = $this->input->post('u_id');
        $where='(u_id ="'.$u_id.'")';
        $profile_img= $this->HouseKeepingModel->getData($tbl='register', $where);
        $img=$profile_img['profile_photo'];

        if (!empty($_FILES['File']['name']))
        {

            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/staff_profile/';

            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('my_uploaded_file'))
            {
            
                $file_data = $this->upload->data();
                //$this->resize_image($file_data);

                $file_path_url = $path . $file_data['file_name'];

                $file=$file_path_url;

            }
            else
            {
            
            
                $error = array('error' => $this->upload->display_errors());

            //   print_r($error);die;
            }
        } 
        else
        {
        
            $file=$img;
        }
    
        $arr = array(
                       
                     'full_name' =>$this->input->post('full_name'),
                     'mobile_no' =>$this->input->post('mobile_no'),
                     'email_id' =>$this->input->post('email_id'),
                     'address' =>$this->input->post('address'),
                     'profile_photo'=> base_url().$file
                    );
        
        $where = '(u_id = "'.$u_id.'")';
        $edit= $this->HouseKeepingModel->editData($tbl='register', $where, $arr);
        if($edit)
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id']; 
          	$data["staff_list"] = $this->HouseKeepingModel->get_staff_list($hotel_id);
            
            $this->load->view('housekeeping/ajaxStaffList', $data);
        }      
    }

    public function update_status_user()
    {
        $arr=array(
                    'is_active'=>$_POST['active']
                    );
        
        $u_id=$_POST['uid'];
        $where = '(u_id="' . $u_id . '")';
        $id=$this->HouseKeepingModel->editData($tbl="register",$where,$arr); 
        if($id)
        {
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }	
    }
   
    public function staffdetails()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];
    
        $u_id = $this->input->post('u_id1');
        $where = '(u_id = "'.$u_id.'")';
        $data['staff_data'] = $this->HouseKeepingModel->getData($tbl ='register', $where);
        $data["user_complete_orders"] = $this->HouseKeepingModel->get_all_user_completed_orders_pagination($u_id);
        $data["user_laundry_complete_orders"] = $this->HouseKeepingModel->get_all_user_Laundry_completed_orders_pagination($u_id);
				
        $this->load->view('housekeeping/ajaxStaffView', $data);
	}

    public function services()
	{   
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];

        $u_id = $this->input->post('u_id1');
        $where = '(u_id = "'.$u_id.'")';
        $data['staff_data'] = $this->HouseKeepingModel->getData($tbl ='register', $where);
        $data["user_laundry_complete_orders"] = $this->HouseKeepingModel->get_all_user_Laundry_completed_orders_pagination($u_id);
           
        $this->load->view('housekeeping/ajaxStaffView', $data);
	}

    public function Laundry()
	{
		
        $admin_id = $this->session->userdata('u_id');
        // print_r($admin_id);die;
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 	
        
        $order_type = $this->input->post('order_type');
        $todays_date = date('Y-m-d');

        $data["manage_cloth"] = $this->HouseKeepingModel->get_cloth_list_pagination($hotel_id);
        $data['laundry_time'] = $this->HouseKeepingModel->get_laundry_time($hotel_id);
        $data["laundry_order"] = $this->HouseKeepingModel->get_laundry_new_list_pagination($todays_date,$hotel_id);
        $data["laundry_accepted"] = $this->HouseKeepingModel->get_laundry_list_accepted_pagination($hotel_id);
        $data["laundry_completed"] = $this->HouseKeepingModel->get_laundry_list_completes_pagination($hotel_id);
        $data["laundry_rejected"] = $this->HouseKeepingModel->get_laundry_rejected_list_pagination($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/Laundry', $data);
        $this->load->view('include/footer');
    }

    public function get_laundry_order_data()
	{   
        //  Start :: datatable code 
        $draw = $this->input->post('draw');
        $row = $this->input->post('start');
        $rowperpage = $this->input->post('length');
        $search_array = $this->input->post('search');
        $search = !empty($search_array['value']) ? $search_array['value'] : '';
        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }
        $visiter_data = $this->HouseKeepingModel->get_laundry_data($rowperpage,$row,$search,$hotel_id);
        $total_get_visiter_data = $this->HouseKeepingModel->get_total_laundry_data($search, $hotel_id);
        $totalRecords = $total_get_visiter_data->total_record;
 
        $data = array();
        $i=1;
        foreach($visiter_data AS $val)
        {
            if($val['booking_status'] == 1)
            {
                $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['cloth_order_id'].'</span></div>';

                $req_time = date('h:i A', strtotime($val['order_time']));
                $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';
                
                $order_type ='';
                if($val['order_from'] == 1)
                {
                    $order_type = 'On Call';
                }
                elseif($val['order_from'] == 2)
                {
                    $order_type = 'From Staff';
                }
                elseif($val['order_from'] == 3)
                {
                    $order_type = 'App Order';
                }
                //   $floor_no = $val['floor'];
                // $floor_no = $val['floor'];
                //   $r_no = $val['room_no'];
                $guest_name = $val['full_name'];

                $services = '  <a href="#" class="badge badge-info edit_model_click"  data-unic-id="'.$val['cloth_order_id'].'">view</a>';
            
                $orderstatus =  ' <a href="#" class="badge badge-info new_laundry_ord_req"  data-id5="'.$val['cloth_order_id'].'">view</a>';

                $action = '<a href="#"  class="btn btn-warning shadow btn-xs sharp me-1" id="laun_data" data-bs-toggle="modal" data-id1="'.$val['cloth_order_id'].'" data-bs-target=".update_laun_staff_modal"><i class="fa fa-share"></i></a> ';	

                $data[] = array(
                    "Sr_No"			=>	$row+$i++ ,
                    "Order ID"	=>  $order_id,
                    "Date_Time"	=>  $Req_Date_Time,
                    "Order Type"	=> $order_type ,
                    "Floor"	=> $val['floor'],
                    "Room_Number"	=>  $val['room_no'],
                    "Guest_Name"	=>$val['full_name'],
                    "Note"		=>  $services,
                    "Services"	=>  $orderstatus,
                    "Action"	=>   $action
                );
            }
        }
       

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        );
       
        echo json_encode($response);
        
        // $this->load->view('roomservice/ajaxnewroomServiceAcceptedOrder', $data);
    }
    public function auto_load_laundryorder_data()
	{
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->HouseKeepingModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
        $todays_date = date('Y-m-d');
        $data["laundry_order"] = $this->HouseKeepingModel->get_laundry_pagination($admin_id,$todays_date);
		$this->load->view('housekeeping/auto_load_laundryorder',$data);
	}

    public function mng_loundry()
	{
	
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
    
        $order_type = $this->input->post('order_type');
        $todays_date = date('Y-m-d');
    
        $data["laundry_order"] = $this->HouseKeepingModel->get_laundry_new_list_pagination($todays_date,$hotel_id);
       
        $this->load->view('include/header');
        $this->load->view('housekeeping/Laundry', $data);
        $this->load->view('include/footer');
	}

    public function loundry_acc_req()
	{
	
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $data["laundry_accepted"] = $this->HouseKeepingModel->get_laundry_list_accepted_pagination($hotel_id);
       
        $this->load->view('include/header');
        $this->load->view('housekeeping/Laundry', $data);
        $this->load->view('include/footer');
    }

    public function loundry_cmpl_order()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
             
        $data["laundry_completed"] = $this->HouseKeepingModel->get_laundry_list_completes_pagination($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/Laundry', $data);
        $this->load->view('include/footer');
	}
    public function loundry_rej_order()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $data["laundry_rejected"] = $this->HouseKeepingModel->get_laundry_rejected_list_pagination($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/Laundry', $data);
        $this->load->view('include/footer');
	}

    public function add_cloths()
    {   
        $u_id = $this->session->userdata('u_id');
        $wh = '(u_id = "'.$u_id.'")';
        $get__info = $this->HouseKeepingModel->getData('register', $wh);

        $cloth_name = $this->input->post('cloth_name');
        $price = $this->input->post('price');
      
        $file="";
        if (!empty($_FILES['File']['name'])) 
        {
            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/cloth_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file'))
            {
                $file_data = $this->upload->data();

                $file_path_url = $path . $file_data['file_name'];

                $file=$file_path_url;
            }
            else
            {
                $file="";
            }
        }

        $arr= array(
                            'cloth_name'=>$cloth_name,
                            'price'=>$price,
                            'added_by'=>2,
                            'added_by_u_d'=>$get__info['u_id'],
                            'hotel_id' =>$get__info['hotel_id'],
                            'image' => base_url().$file
                   );

        $add = $this->HouseKeepingModel->insertData($tbl="cloth", $arr);

        if ($add) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];

            $data["manage_cloth"] = $this->HouseKeepingModel->get_cloth_list_pagination($hotel_id);
            $this->load->view('housekeeping/ajaxlaundrylist', $data);
        }
    }
    public function delete_cloths()
    {
        $id=$this->input->post('id');
        $where = '(cloth_id = "'.$id.'")';
        $result= $this->HouseKeepingModel->deleteData($tbl="cloth", $where);
        
        if ($result) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];
            
            $data["manage_cloth"] = $this->HouseKeepingModel->get_cloth_list_pagination($hotel_id);
            $this->load->view('housekeeping/ajaxlaundrylist', $data);
        } 
        else 
        {
            echo "0";
        }
    }

    public function getClothData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdatareg($tbl ='cloth', $wh);

        echo json_encode($data);
       
    }
    // public function getdemoData()
    // {
    //     $wh = $this->input->post('id');
               
    //             $data = $this->HouseKeepingModel->getdemoreg($tbl ='house_keeping_orders', $wh);
    //             // echo "<pre>";print_r($data);die;
    //             echo json_encode($data);
       
    // }
    public function update_laundry_list()
    {
        $cloth_id = $this->input->post('cloth_id');
        $cloth_name = $this->input->post('cloth_name');
        $price =$this->input->post('price');
		$wh = '(cloth_id = "'.$cloth_id.'")';
      	$get_img= $this->HouseKeepingModel->getData($tbl='cloth', $wh);
        $img=$get_img['image'];

        if (!empty($_FILES['File']['name']))
        {

            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/cloth_img/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file'))
            {
                $file_data = $this->upload->data();

                $file_path_url = $path . $file_data['file_name'];

                $file=$file_path_url;

            }
            else
            {
                $error = array('error' => $this->upload->display_errors());

                return $error;
            }
        } 
        else
        {
          	$file=$img;
        }
      
        $arr = array(
                         'cloth_name' =>$cloth_name,
                         'price' =>$price,
          				 'image' =>$file
                     );

        $add = $this->HouseKeepingModel->editData($tbl='cloth', $wh, $arr);
        if ($add) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];
            
            $data["manage_cloth"] = $this->HouseKeepingModel->get_cloth_list_pagination($hotel_id);
            $this->load->view('housekeeping/ajaxlaundrylist', $data);
        }
    }

    public function add_laundry_order()
    {
        $otp = rand(1111,9999);
        $u_id = $this->session->userdata('u_id');
        $wh = '(u_id = "'.$u_id.'")';
        $get_data = $this->HouseKeepingModel->getData('register', $wh);

        $order_typ = $this->input->post('order_from');
        $room_no = $this->input->post('room_no');
        $cloth_name = $this->input->post('cloth_name');
        $price = $this->input->post('cloth_price');
        $qty = $this->input->post('qty');
        // $staff_name = $this->input->post('staff');
        $user_id = $this->input->post('user_n'); 
        $guest_id = $this->input->post('guest_id');
        $additional_note = $this->input->post('additional_note');
        
        $cloths_name = $this->input->post('cloths_name');
        $cloths_price = $this->input->post('price');
        $qty1 = $this->input->post('qty1');
      
      	//get total order total of cloths
        $total_price = $price * $qty;
      
        //get booking id
        $enquiry_id = $this->input->post('enquiry_id');
        $date= date('Y-m-d');
        $booking_id = '';
        $wh11 = '(u_id = "'.$guest_id.'" AND check_out >= "'.$date.'" AND enquiry_id="'. $enquiry_id.'")';
        $get_data_booking_id = $this->HouseKeepingModel->getData('user_hotel_booking', $wh11);
        // var_dump( $get_data_booking_id);die;
        if(!empty($get_data_booking_id))
        {
          $booking_id = $get_data_booking_id['booking_id'];
        }

        $arr= array(
                        'hotel_id' =>$get_data['hotel_id'],
                        'order_from'=>$order_typ,
                        'room_no'=>$room_no,
          				'booking_id'=>$booking_id,
          				'u_id'=>$guest_id,
                        // 'staff_id'=>$staff_name,
                        'additional_note'=>$additional_note,
                        'order_date' =>date('Y-m-d'),
                        'order_time' =>date('G:i:s'),
                        'order_status'=>0,
          				'order_total' => $total_price,
                        'added_by'=>1,
                        'added_by_u_id' =>$get_data['u_id'],
                        'otp' =>$otp
                   );

        $insert_id = $this->HouseKeepingModel->insertData($tbl="cloth_orders", $arr);
        if ($insert_id) 
        {
            //add user notification data
            $arr3 = array(
                            'hotel_id'=>$get_data['hotel_id'],
                            'u_id' =>0,
                            'subject' => 'OTP for laundry Order',
                            'description'=> 'Your OTP for Order ID : is '.$otp
                         );
            $insert_notificatin = $this->HouseKeepingModel->insertData($tbl="user_notification", $arr3);
            $arr2 = array(
                            'hotel_id' =>$get_data['hotel_id'],
                            'cloth_order_id'=>$insert_id,
                            'cloth_id'=>$cloth_name,
                            'price' =>$price,
                            'quantity' =>$qty
                        );
            $insert_id2 = $this->HouseKeepingModel->insertData($tbl="cloth_order_details", $arr2);
            
            if (!empty($cloths_name)) 
            {
                $count = count($cloths_name);
                for ($i = 0; $i < $count; $i++) 
                {
                    $arr2 = array(
                                    'hotel_id' =>$get_data['hotel_id'],
                                    'cloth_order_id'=>$insert_id,
                                    'cloth_id' => $cloths_name[$i],
                                    'price' => $cloths_price[$i],
                                    'quantity' => $qty1[$i]
                                );
                    $insert_id3 = $this->HouseKeepingModel->insertData($tbl="cloth_order_details", $arr2);
                }     
            }
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];
            $todays_date = date('Y-m-d');
            $data["laundry_order"] = $this->HouseKeepingModel->get_manageorder_new($hotel_id,$todays_date);
            $this->load->view('housekeeping/ajaxlaundryorderlist', $data);
        } 
       
    }

    public function get_user_id()
    {
        $todays_date = date('Y-m-d');
        $hotel_id = $this->input->post('hotel_id');
        $room_no = $this->input->post('room_no');

        $guest_data = $this->HouseKeepingModel->get_room_no_data($hotel_id, $room_no,$todays_date);
        if (!empty($guest_data)) 
        {
            $output = '';

            $output .= $guest_data['u_id'];

            echo $output;
        }
    }
    public function get_cloths_price()
    {   
        $cloths_name = $this->input->post('cloths_name');
        $where = '(cloth_id = "'.$cloths_name.'")';
        $cloth_price = $this->HouseKeepingModel->getData('cloth', $where);
        $output = '';
        $output .= $cloth_price['price'];

        echo $output;
    }

    public function change_order_status()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $todays_date = date('Y-m-d');
        $otp = rand('1111','9999');
        $cloth_order_id = $this->input->post('cloth_order_id');
        $order_status = $this->input->post('order_status');
        $staff_id =$this->input->post('staff_id');
        // $hotel_id =$this->input->post('hotel_id');
        $u_id =$this->input->post('u_id');
        $booking_id =$this->input->post('booking_id');
        //staff name
        $staff_name = '';
        $where1 = '(u_id ="' . $staff_id. '")';
        $get_staff_name = $this->MainModel->getData('register', $where1);
        if (!empty($get_staff_name)) 
        {
            $staff_name = $get_staff_name['full_name'];
        } 
        else 
        {
            $staff_name = '';
        }

        $get_hotel = '(u_id = "' . $hotel_id . '")';
        $hotel_data = $this->MainModel->getData('register',$get_hotel);
        $hotel_name = $hotel_data['hotel_name'];
       
        if ($order_status == 1) 
        {
            $arr = array(
                            'order_status' =>1,
                            'staff_id' =>$staff_id,
                            'staff_name'=>$staff_name,
                                'accept_date' => date('Y-m-d'),
                                'accept_time' =>date('G:i:s'),
                                'order_status'=>$_POST['order_status'],
                                'otp'=>$otp
                        );

            $wh = '(cloth_order_id = "'.$cloth_order_id.'")';
            $add = $this->HouseKeepingModel->editData($tbl='cloth_orders', $wh, $arr);
            
            if ($add) 
            {
                // push notification for user
                $get_u_id = $this->MainModel->getData($tbl='cloth_orders', $wh);
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $title = '';
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Laundry Order Is Accpeted';
                    $body = 'Your Laundry Order ID is "' . $cloth_order_id . '"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }
                
                // inside user app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $cloth_order_id";
                $arr_noti = array(
                                'hotel_id' => $hotel_id,
                                'u_id' => $u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
                // print_r($arr_noti);die;
                $this->MainModel->insert_data('user_notification',$arr_noti);
            
                // notification for staff
                $wh_s = '(u_id = "'.$get_u_id['staff_id'].'")';
                $get_staff_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_s);
                $title1 = "";
                if(!empty($get_staff_dt)){
                    $deviceToken1= $get_staff_dt['token'];
                    $title1 = 'New Laundry Order Assign ';
                    $body1 = 'Laundry Order ID is "' . $cloth_order_id . '"';
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }

                // inside staff app notification
                $subject1 = $title1;
                $description1 = "$title1 And Order Id Is $cloth_order_id";
                $arr_staff_noti = array(
                                    'u_id'=>$staff_id,
                                    'hotel_id' => $hotel_id,
                                    'subject' => $subject1,
                                    'description' => $description1,
                                    'notification_order_flag' =>0,    
                                );
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti);
                
                $arr3= array(
                            'hotel_id' => $hotel_id,
                            'staff_id'=>$staff_id,
                            'u_id'=>$u_id,
                            'booking_id'=>$booking_id,                                       
                            'description' => 'Order Assing to the staff',
                            'activity_for' => 2                    
                        );

                $add1 = $this->HouseKeepingModel->insertData($tbl="activity_of_hotel",$arr3);
                
                $data["laundry_order"] = $this->HouseKeepingModel->get_laundry_new_list_pagination($todays_date,$hotel_id);
                $this->load->view('housekeeping/ajaxlaundryorderlist', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url(' Laundry'));
            }
        }
        elseif($order_status == 3)
        {
            $arr = array(
                            'order_status' => $order_status,
                        //    'request_status'=>$_POST['request_status'],
                            'reject_reason'=>$_POST['reject_reason'],
                            'staff_id' =>0,
                                'reject_date' => date('Y-m-d')
                            
                        );

            $wh = '(cloth_order_id = "'.$cloth_order_id.'")';
            $add = $this->HouseKeepingModel->editData($tbl='cloth_orders', $wh, $arr);
            if ($add) 
            {
                // push notification for staff
                $get_u_id = $this->MainModel->getData($tbl='cloth_orders', $wh);
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                $title ="";
        
                $reason ='';

                if($get_u_id['reject_reason'] == 1)
                {
                    $reason = "Out of stock";
                }
                else if($get_u_id['reject_reason'] == 2)
                {
                    $reason = "We Do Not Serve";
                }
                else if($get_u_id['reject_reason'] == 3)
                {
                    $reason = "Out Of Time";
                }
                else if($get_u_id['reject_reason'] == 4)
                {
                    $reason = "Others";
                }
                if(!empty($get_dt)){
                    $deviceToken = $get_dt['token'];
                    $title = 'Laundry Order Is Rejected';
                    $body = 'Your Laundry Order ID is "'.$cloth_order_id.'" And Your Order is Rejected Because OF "'.$reason.'"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside app notification
                $subject = $title;
                $description = "$title In $hotel_name Because Of $reason And Your Order Id Is $cloth_order_id";
                $arr_noti = array(
                                'hotel_id' => $hotel_id,
                                'u_id' => $u_id,
                                'subject' => $subject,
                                'description' => $description,
                                'clear_flag' => 1,
                                'count_flag' => 1,
                            );
                $this->MainModel->insert_data('user_notification',$arr_noti);
                    
                $data["laundry_order"] = $this->HouseKeepingModel->get_laundry_new_list_pagination($todays_date,$hotel_id);
                $this->load->view('housekeeping/ajaxlaundryorderlist', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('Laundry'));
            }
        }
    }

    // code by vivek
    public function HouseDashNotification()
	{
		if ($this->session->userdata('u_id')) 
		{
          	$u_id = $this->session->userdata('u_id');
			$where ='(u_id = "'.$u_id.'")';
			$admin_details = $this->MainModel->getData($tbl ='register', $where);
			$admin_id = $admin_details['hotel_id'];
          
          	$all_room_notification['get_staff_orders'] = $this->HouseKeepingModel->get_staff_orderss($admin_id);
            $this->load->view('include/header');
	    	$this->load->view('housekeeping/panel_notification',$all_room_notification);
            $this->load->view('include/footer');

		}
		else
		{
            $this->load->view('pages/Login_page');
        }
	}
    public function assign_order()
    {
        $notification_id = $this->input->post('notification_id');
        $wh = '(notification_id = "'.$notification_id.'")';
        $arr = array(
                      'order_status' => 1,

                    );

        $up = $this->MainModel->editData('notifications',$wh,$arr);
        if($up)
        {
            $this->session->set_flashdata('msg','Request accepted Successfully');
            redirect(base_url('HouseDashNotification'));
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('HouseDashNotification'));
        }
    }
    // code by nishan 30/05/2023 start
    public function Staff_review()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $data["review_staff"] = $this->HouseKeepingModel->get_user_review_pagination($hotel_id);

        $this->load->view('include/header');
        $this->load->view('housekeeping/Staff_review', $data);
        $this->load->view('include/footer');
    }

    public function RmStatus()
	{
        // $date = date('Y-m-d');  
        $admin_id = $this->session->userdata('u_id');

        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        
        //get dirty rooms
        $wh = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
        $data['get_dirty_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh);
 
        //get accupied rooms
        $wh1 = '(room_status = 2 AND hotel_id ="'.$hotel_id.'")';
        $data['get_accupied_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh1);

        //get available rooms
        // $wh2 = '(room_status = 3 AND hotel_id ="'.$hotel_id.'")';
        $data['get_available_rooms'] = $this->HouseKeepingModel->get_daily_report_available_rooms($hotel_id);
        
        //get under maintainance rooms
        $wh3 = '(room_status = 4 AND hotel_id ="'.$hotel_id.'")';
        $data['get_under_maintenance_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh3);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/RmStatus', $data);
        $this->load->view('include/footer');
    }

    public function dirty_room_sts_update()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $room_status_id = $this->input->post('room_status_id');
        $room_status = $this->input->post('room_status');
        //  $date = date('Y-m-d h:i:s');
        if($room_status == 3) 
        {
            $arr = array(
                            'room_status' =>$room_status,  
                            //  'created_at' => $date
                        );

            $wh = '(room_status_id = "'.$room_status_id.'")';
            $update = $this->HouseKeepingModel->editData($tbl='room_status', $wh, $arr);
            // $wh1 = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
            if ($update) 
            {
                $wh1 = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
                $data['get_dirty_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh1);
                $wh2 = '(room_status = 2 AND hotel_id ="'.$hotel_id.'")';
                $data['get_accupied_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh2);
                $data['get_available_rooms'] = $this->HouseKeepingModel->get_daily_report_available_rooms($hotel_id);
                $wh3 = '(room_status = 4 AND hotel_id ="'.$hotel_id.'")';
                $data['get_under_maintenance_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh3);
                // $data['get_available_rooms'] = $this->HouseKeepingModel->get_daily_report_available_rooms($date,$hotel_id);
               
                $this->load->view('housekeeping/ajaxdirty_room', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('RmStatus'));
            }
        }
        elseif($room_status == 4) 
        {
            $arr1 = array(
                            'room_status' =>$room_status,  
                        );

            $wh2 = '(room_status_id = "'.$room_status_id.'")';

            $update = $this->HouseKeepingModel->editData($tbl='room_status', $wh2, $arr1);
            
            if ($update) 
            {
                $wh4 = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
                $data['get_dirty_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh4);
                $wh5 = '(room_status = 2 AND hotel_id ="'.$hotel_id.'")';
                $data['get_accupied_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh5);
                $data['get_available_rooms'] = $this->HouseKeepingModel->get_daily_report_available_rooms($hotel_id);
                $wh6 = '(room_status = 4 AND hotel_id ="'.$hotel_id.'")';
                $data['get_under_maintenance_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh6);
                $this->load->view('housekeeping/ajaxdirty_room', $data);
            } 
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('RmStatus'));
            }
        }

    }

    public function under_maintainance_room_sts_update()
    {
        
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $room_status_id = $this->input->post('room_status_id');
        $room_status = $this->input->post('room_status');
        // $date = date('Y-m-d h:i:s');
        if($room_status) 
        {
            $arr = array(
                            'room_status' =>$room_status,  
                            //  'created_at' => $date
                        );

            $wh = '(room_status_id = "'.$room_status_id.'")';
            $update = $this->HouseKeepingModel->editData($tbl='room_status', $wh, $arr);
            
            if ($update) 
            {
                $wh4 = '(room_status = 1 AND hotel_id ="'.$hotel_id.'")';
                $data['get_dirty_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh4);
                $wh5 = '(room_status = 2 AND hotel_id ="'.$hotel_id.'")';
                $data['get_accupied_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh5);
                $data['get_available_rooms'] = $this->HouseKeepingModel->get_daily_report_available_rooms($hotel_id);
                $wh6 = '(room_status = 4 AND hotel_id ="'.$hotel_id.'")';
                $data['get_under_maintenance_rooms'] = $this->HouseKeepingModel->getAllData1('room_status',$wh6);
                $this->load->view('housekeeping/ajaxunder_maintance', $data);
            }
            else 
            {
                $this->session->set_flashdata('add', 'Something went Wrong');
                redirect(base_url('RmStatus'));
            }
        }

    }

    public function getdirtyData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdatadirty($tbl ='room_status', $wh);
        
        echo json_encode($data);
        
    }
    public function getunderData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdataunder($tbl ='room_status', $wh);
        
        echo json_encode($data);
        
    }
    
    public function service_mang()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $data["service_list"] = $this->HouseKeepingModel->get_service_list($hotel_id);

        $this->load->view('include/header');
        $this->load->view('housekeeping/service_mang', $data);
        $this->load->view('include/footer');
    }
    public function delete_services()
    {
        $id=$this->input->post('id');
        $where = '(h_k_services_id = "'.$id.'")';
        $result= $this->HouseKeepingModel->deleteData($tbl="house_keeping_services", $where);

        if ($result) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id']; 
            $data["service_list"] = $this->HouseKeepingModel->get_service_list($hotel_id);
            $this->load->view('housekeeping/ajaxservicelist', $data);
        } 
        else 
        {
            echo "0";
        }
    }

    public function update_status_services()
    {
        $arr=array(
                    'is_active'=>$_POST['active']
                    );
        
        $u_id=$_POST['uid'];
        $where = '(h_k_services_id ="' . $u_id . '")';
        $id=$this->HouseKeepingModel->editData($tbl="house_keeping_services",$where,$arr); 
        if($id)
        {
            echo json_encode(TRUE);
        }
        else
        {
            echo json_encode(FALSE);
        }	
    }

    public function add_services()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 

        $type = $this->input->post('type');
        $amount = $this->input->post('amount');
        $remark = $this->input->post('remark');
       
        $file="";
        if (!empty($_FILES['File']['name'])) 
        {
            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/housekeeping_service_icon/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file'))
            {
            $file_data = $this->upload->data();
            //$this->resize_image($file_data);

            $file_path_url = $path . $file_data['file_name'];

            $file=$file_path_url;
            }
            else
            {
            $file="";
            }
        } 

        $arr= array(
                        'service_type'=>$type,
                        'amount'=>$amount,
                        'description'=>$remark,
                        'added_by_u_id'=>$get_hotel_id['u_id'],
                        'hotel_id'=> $get_hotel_id['hotel_id'],
                        'added_by'=>2,
          				'is_active' =>1,
          				'icon' =>base_url().$file
                   );

        $add = $this->HouseKeepingModel->insertData($tbl="house_keeping_services", $arr);
                   
        if ($add) 
        {
            $data["service_list"] = $this->HouseKeepingModel->get_service_list($hotel_id);
            $this->load->view('housekeeping/ajaxservicelist', $data);
        } 
        else 
        {
            $this->session->set_flashdata('add', 'Something went Wrong');
            redirect(base_url('service_mang'));
        }
    }
    public function getServiceData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdataser($tbl ='house_keeping_services', $wh);

        echo json_encode($data);
       
    }

    public function update_services()
    {
       
        $u_id = $this->input->post('u_id');
        $type = $this->input->post('service_type');
        $amount =$this->input->post('amount');
        $remark =$this->input->post('description');
      
        $wh = '(h_k_services_id = "'.$u_id.'")';
        $get_img= $this->HouseKeepingModel->getData($tbl='house_keeping_services', $wh);
        $img=$get_img['icon'];

        if (!empty($_FILES['File']['name']))
        {

            $_FILES['my_uploaded_file']['name'] = $_FILES['File']['name'];
            $_FILES['my_uploaded_file']['type'] = $_FILES['File']['type'];
            $_FILES['my_uploaded_file']['tmp_name'] = $_FILES['File']['tmp_name'];
            $_FILES['my_uploaded_file']['error'] = $_FILES['File']['error'];
            $_FILES['my_uploaded_file']['size'] = $_FILES['File']['size'];

            $path = 'assets/upload/housekeeping_service_icon/';
            $file_path = './' . $path;
            $config['allowed_types'] = '*';

            $config['upload_path'] = $file_path;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('my_uploaded_file'))
            {
                $file_data = $this->upload->data();

                $file_path_url = $path . $file_data['file_name'];

                $file=$file_path_url;

            }
            else
            {
                $error = array('error' => $this->upload->display_errors());

                return $error;
            }
        } 
        else
        {
          	$file=$img;

        }

        $arr = array(
                         'service_type' =>$type,
                         'amount' =>$amount,
                         'description' =>$remark,
          				 'icon' =>$file
                    );

        $add = $this->HouseKeepingModel->editData($tbl='house_keeping_services', $wh, $arr);
        if($add) 
        {
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id']; 
            $data["service_list"] = $this->HouseKeepingModel->get_service_list($hotel_id);
            $this->load->view('housekeeping/ajaxservicelist', $data);
        } 
        else 
        {
            $this->session->set_flashdata('add', 'Something went Wrong');
            redirect(base_url('service_mang'));
        }
    }

    public function Handover()
	{
	
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];
        
        $created_date = $this->input->post('created_date');
        $created_u_name = $this->input->post('created_u_name');
    
        $data["pending"] = $this->HouseKeepingModel->get_handover_list_pagination($hotel_id);
        $data["completed"] = $this->HouseKeepingModel->get_completed_handover_list_pagination($hotel_id);
     
        $this->load->view('include/header');
        $this->load->view('housekeeping/Handover', $data);
        $this->load->view('include/footer');
    }

    public function add_handover()
    {
        $id = $this->session->userdata('u_id');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $desc = $this->input->post('desc');

        $where = '(u_id ="'.$id.'")';
        $get_d = $this->HouseKeepingModel->getData($tbl ='register', $where);
        if(!empty($get_d)) 
        {
            $u_id = $get_d['u_id'];
            $hotel_id = $get_d['hotel_id'];
        }

        $arr= array(
                        'create_manager_id'=>$u_id,
                        'date'=>$date,
                        'time'=>$time,
                        'added_by_u_id'=>$u_id,
                        'hotel_id' =>$hotel_id,
                        'description'=>$desc,
                        'added_by'=>2,
                        'is_complete'=>0
                    );

        $add = $this->HouseKeepingModel->insertData($tbl="handover_manger", $arr);

        if ($add) 
        {
            $data["pending"] = $this->HouseKeepingModel->get_handover_list_pagination($hotel_id);
            $this->load->view('housekeeping/ajaxhandoverlist', $data);

        } 
        else 
        {
            $this->session->set_flashdata('add', 'Something went Wrong');
            redirect(base_url('Handover'));
        }
    }
			
    public function handover_update()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];
        
        $created_date = $this->input->post('created_date');
        $created_u_name = $this->input->post('created_u_name');
        
        $data["completed"] = $this->HouseKeepingModel->get_completed_handover_list_pagination($hotel_id);
        
        $this->load->view('include/header');
        $this->load->view('housekeeping/Handover', $data);
        $this->load->view('include/footer');
    }

    public function update_hand_sts()
    {
    
        $id = $this->session->userdata('u_id');
        $where = '(u_id ="'.$id.'")';
        $get_d = $this->HouseKeepingModel->getData($tbl ='register',$where);
    
        $m_handover_id = $this->input->post('m_handover_id');
        $sts = $this->input->post('sts');
        $desc = $this->input->post('desc'); 

        $wh = '(m_handover_id = "'.$m_handover_id.'")';
        $arr = array(
                    'is_complete' => $sts,
                    'description' => $desc,
                    'completed_manger_id' => $get_d['u_id'],
                    'complete_date' => date('Y-m-d'),
                    'complete_time' => date('G:i:s')
                    );
        $up = $this->HouseKeepingModel->editData('handover_manger',$wh,$arr);

        if($up)
        {
            // $this->session->set_flashdata('msg','Success');
            // redirect(base_url('Handover'));
            $admin_id = $this->session->userdata('u_id');
            $wh_admin = '(u_id ="'.$admin_id.'")';
            $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
            $hotel_id = $get_hotel_id['hotel_id'];
            $data["pending"] = $this->HouseKeepingModel->get_handover_list_pagination($hotel_id);
            $data["completed"] = $this->HouseKeepingModel->get_completed_handover_list_pagination($hotel_id);
                
            $this->load->view('housekeeping/ajaxhandoverlist', $data);
        }
        else
        {
            $this->session->set_flashdata('msg','Something went wrong');
            redirect(base_url('Handover'));
        }
    }

    public function gethandoverData()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->gethandata($tbl ='handover_manger', $wh);

        echo json_encode($data);
        
    }

    public function getlanMan()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdatalaun($tbl ='cloth_orders', $wh);
                
        echo json_encode($data);
    }

    public function housekeeping_change_status()
    {
        $arr=array(
            'order_status'=>$_POST['status'],
            'complete_date'=>date('Y-m-d'),
            'complete_time' =>date('G:i:s')
        );
        
        $h_k_order_id=$_POST['uid'];
        $where = '(h_k_order_id="' . $h_k_order_id . '")';
        $id=$this->MainModel->editData($tbl="house_keeping_orders",$where,$arr); 
        $u_id=$_POST['useruid'];
		$hotel_id =$_POST['userhotelid'];
		$get_hotel = '(u_id = "' . $hotel_id . '")';
        $hotel_data = $this->MainModel->getData('register',$get_hotel);
        $hotel_name = $hotel_data['hotel_name'];
        if($id)
        {
            // push notification for user
            $get_u_id = $this->MainModel->getData($tbl='house_keeping_orders', $where);
            $wh_booking = '(booking_id = "'.$get_u_id['booking_id'].'")';
			$booking_details = $this->MainModel->getData($tbl='user_hotel_booking', $wh_booking);
            if($booking_details['booking_status'] == 1)
			{
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt))
                {
                    $deviceToken = $get_dt['token'];
                    $title = 'Housekeeping Order Is Completed';
                    $body = 'Your HouseKeeping Order ID is "' . $h_k_order_id . '" ';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside user app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $h_k_order_id";
                
                $arr_noti = array(
                                    'hotel_id' => $hotel_id,
                                    'u_id' => $u_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                $this->MainModel->insert_data('user_notification',$arr_noti);
            }
            echo json_encode(TRUE);
        }
        else
        {
         echo json_encode(FALSE);
        }	
    }
    public function housekeeping_laundry_status()
    {
        $arr=array(
            'order_status'=>$_POST['status'],
            'complete_date'=>date('Y-m-d'),
            'complete_time' =>date('G:i:s')
        );
        
        $cloth_order_id=$_POST['uid'];
        $where = '(cloth_order_id="' . $cloth_order_id . '")';
        $id=$this->MainModel->editData($tbl="cloth_orders",$where,$arr); 
        $u_id=$_POST['useruid'];
		$hotel_id =$_POST['userhotelid'];
		$get_hotel = '(u_id = "' . $hotel_id . '")';
        $hotel_data = $this->MainModel->getData('register',$get_hotel);
        $hotel_name = $hotel_data['hotel_name'];
        if($id)
        {
            // push notification for user
            $get_u_id = $this->MainModel->getData($tbl='cloth_orders', $where);
            $wh_booking = '(booking_id = "'.$get_u_id['booking_id'].'")';
			$booking_details = $this->MainModel->getData($tbl='user_hotel_booking', $wh_booking);
            if($booking_details['booking_status'] == 1)
			{
                $wh1 = '(u_id = "'.$get_u_id['u_id'].'")';
                $get_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh1);
                $title = "";
                if(!empty($get_dt))
                {
                    $deviceToken = $get_dt['token'];
                    $title = 'Laundry Order Is Completed';
                    $body = 'Your Laundry Order ID is "' . $cloth_order_id . '"';
                    $result = send_push_notification($deviceToken, $title, $body);
                }

                // inside app notification
                $subject = $title;
                $description = "$title In $hotel_name And Your Order Id Is $cloth_order_id";
                
                $arr_noti = array(
                                    'hotel_id' => $hotel_id,
                                    'u_id' => $u_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'clear_flag' => 1,
                                    'count_flag' => 1,
                                );
                $this->MainModel->insert_data('user_notification',$arr_noti);
            }
            echo json_encode(TRUE);
        }
        else
        {
         echo json_encode(FALSE);
        }	
    }
		
    public function new_order_service()
	{
		$h_k_order_id = $this->input->post('id');
		$wh_l = '(h_k_order_id = "' . $h_k_order_id . '")';
	   	$data['new_order_list'] = $this->HouseKeepingModel->getAllData1('house_keeping_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxnewhouseservice', $data);
	}

    public function accept_order_service()
	{
		$h_k_order_id = $this->input->post('id');
		$wh_l = '(h_k_order_id = "' . $h_k_order_id . '")';
	   	$data['accept_order_list'] = $this->HouseKeepingModel->getAllData1('house_keeping_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxaccepthouseservice', $data);
	}
    public function complete_order_service()
	{
		$h_k_order_id = $this->input->post('id');
		$wh_l = '(h_k_order_id = "' . $h_k_order_id . '")';
	   	$data['complete_order_list'] = $this->HouseKeepingModel->getAllData1('house_keeping_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxcompletehouseservice', $data);
	}

    public function reject_order_service()
	{
		$h_k_order_id = $this->input->post('id');
		$wh_l = '(h_k_order_id = "' . $h_k_order_id . '")';
	   	$data['reject_order_list'] = $this->HouseKeepingModel->getAllData1('house_keeping_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxrejecthouseservice', $data);
	}

    public function new_order_laundry()
	{
		$cloth_order_id = $this->input->post('id');
		$wh_l = '(cloth_order_id = "' . $cloth_order_id . '")';
	   	$data['laundry_order'] = $this->HouseKeepingModel->getAllData1('cloth_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxnewlaundryservice', $data);
	}

    public function accept_order_laundry()
	{
		$cloth_order_id = $this->input->post('id');
		$wh_l = '(cloth_order_id = "' . $cloth_order_id . '")';
	   	$data['laundry_accepted'] = $this->HouseKeepingModel->getAllData1('cloth_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxacceptlaundryservice', $data);
	}
    public function complete_order_laundry()
	{
		$cloth_order_id = $this->input->post('id');
		$wh_l = '(cloth_order_id = "' . $cloth_order_id . '")';
	   	$data['laundry_completed'] = $this->HouseKeepingModel->getAllData1('cloth_order_details', $wh_l);
	
		$this->load->view('housekeeping/ajaxcompletelaundryservice', $data);
	}
    public function reject_order_laundry()
	{   
		$cloth_order_id = $this->input->post('id');
		$wh_l = '(cloth_order_id = "' . $cloth_order_id . '")';
	   	$data['laundry_rejected'] = $this->HouseKeepingModel->getAllData1('cloth_order_details', $wh_l);
		
		$this->load->view('housekeeping/ajaxrejectlaundryservice', $data);
	}
    public function getrequirement()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdataneworder($tbl ='house_keeping_orders', $wh);
        
        echo json_encode($data);
	}
    public function get_discri_name_data_house()
    {
        $id =$this->input->post('id');//print_r($id);die;
        $wh = '(h_k_order_id ="'.$id.'")';
        $guest_mng["list"] = $this->HouseKeepingModel->getData($tbl ='house_keeping_orders',$wh);

        $this->load->view('housekeeping/ajaxhousenote',$guest_mng);
    }
    public function get_discri_name_data_laundry()
    {
        $id =$this->input->post('id');
        $wh = '(cloth_order_id ="'.$id.'")';
        $guest_mng["list"] = $this->HouseKeepingModel->getData($tbl ='cloth_orders',$wh);

        $this->load->view('housekeeping/ajaxlaundrynote',$guest_mng);
    }

    public function getEditDataoftiming()
    {
        $where = $this->input->post('id');
        $wh = '(laundry_time_id ="' . $where . '")';
        $data = $this->HouseKeepingModel->getSingleData($tbl = 'laundry_time', $wh);

        echo json_encode($data);
    }
    public function set_laundry_picup_drop_time()
    {   
        $pick_up_start_time = $this->input->post('pick_up_start_time');
        $pick_up_end_time = $this->input->post('pick_up_end_time');
        $drop_start_time = $this->input->post('drop_start_time');
        $drop_end_time = $this->input->post('drop_end_time');
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id']; 
        $wh = '(hotel_id = "' . $hotel_id . '")';
        $laundry_time = $this->HouseKeepingModel->getData('laundry_time', $wh);
        $add = "";
        $up = "";
        if ($laundry_time) 
        {
            $arr_up = array(
                'pick_up_start_time' => $pick_up_start_time,
                'drop_start_time' => $drop_start_time,
                'pick_up_end_time' => $pick_up_end_time,
                'drop_end_time' => $drop_end_time,
                'updated_by' => 1,
                'updated_by_u_id' => $hotel_id,
            );

            $add = $this->HouseKeepingModel->edit_data('laundry_time', $wh, $arr_up);
        } 
        else 
        {
            $arr_add = array(
                'hotel_id' => $hotel_id,
                'pick_up_start_time' => $pick_up_start_time,
                'drop_start_time' => $drop_start_time,
                'pick_up_end_time' => $pick_up_end_time,
                'drop_end_time' => $drop_end_time,
                'added_by' => 1,
                'added_by_u_id' => $hotel_id,
            );

            $up = $this->HouseKeepingModel->insert_data('laundry_time', $arr_add);
        }

        if ($add || $up) 
        {
            // $this->session->set_flashdata('msg','Laundry time set Successfully...');
            // redirect(base_url('HoteladminController/HouseKeepingList'));
            // $guest_mng['icon_id'] =1;
            // $guest_mng["list"] = $this->HotelAdminModel->get_cloth_list_pagination($admin_id);
            $guest_mng['laundry_time'] = $this->HouseKeepingModel->get_laundry_time($hotel_id);
           
            echo json_encode($guest_mng);
            // $this->load->view('hoteladmin/ajaxlaundrytimeedit',$guest_mng);
        } 
        else 
        {
            $this->session->set_flashdata('msg', 'Something went wrong');
            redirect(base_url('HouseKeepingController/Laundry'));
        }
    }

    public function get_out_of_time_orders()
	{
		log_message('DEBUG', 'newtimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HouseKeepingModel->outof_time_house_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'h_k_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(h_k_order_id = "'.$val_time.'" AND order_status = 0)';
			$arr= array(
				'out_of_time_status'=>1,
			);
			$out_of_time_status_update = $this->HouseKeepingModel->editData($tbl="house_keeping_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function out_of_time_house_orders_of_accepted()
	{
		log_message('DEBUG', 'acceptdetimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HouseKeepingModel->outof_time_accepted_house_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'h_k_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(h_k_order_id = "'.$val_time.'" AND order_status = 1)';
			$arr= array(
				'out_of_time_status'=>2,
			);
			$out_of_time_status_update = $this->HouseKeepingModel->editData($tbl="house_keeping_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}

    public function accepted_order_of_housekeeping()
    {
        $draw  = $this->input->post('draw');
        $row  = $this->input->post('start');
        $rowperpage  = $this->input->post('length');
        $search_array  = $this->input->post('search');
        $search = !empty($search_array['value'])?$search_array['value']: '' ;

        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }

        $accepted_house_Order_list = $this->HouseKeepingModel->accepted_house_Order_list($rowperpage,$row,$search, $hotel_id);
        $total_accepted_house_list_data = $this->HouseKeepingModel->total_accepted_house_list_data($search, $hotel_id);
        $totalRecords = $total_accepted_house_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_house_Order_list AS $val)
        {
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['h_k_order_id'].'</span></div>';

            $req_time = date('h:i A', strtotime($val['order_time']));
            $Req_Date_Time = '<span> '.date('d-m-Y',strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';

            $order_type = '';

            if ($val['order_from'] == 1) 
            {  
                $order_type = 'On Call Order';
            } 
            elseif ($val['order_from'] == 2) 
            {
                $order_type = 'From Staff Order';
            } 
            elseif ($val['order_from'] == 3) 
            {
                $order_type = 'App Order';
            } 
            elseif ($val['order_from'] == 4) 
            {
            $order_type = 'Walking Order';
            }
            else
            {
            $order_type = "-";
        }

            $Requirements = '<div><a href="#"><div class="badge badge-info accept_house_ord_req"  data-id2="'.$val['h_k_order_id'].'" data-bs-toggle="modal">view</div></a></div>';

           
            $order_status = '<div>
            <input type="hidden" name="users_id" id="housekeeoingorderid'.$val['h_k_order_id'].'" value="'.$val['h_k_order_id'].'">
            <input type="hidden" name="useruid" id="useruid'.$val['h_k_order_id'].'" value="'.$val['u_id'].'">
            <input type="hidden" name="userhotelid" id="userhotelid'.$val['h_k_order_id'].'" value="'.$val['hotel_id'].'">
            <select class="form-control" name="status" id="housekeepingstatus'.$val['h_k_order_id'].'" onchange="change_status('.$val['h_k_order_id'].');" style="min-width:85px;text-align:center">
                <option value="1" selected>Accepted</option>
                <option value="2">Completed</option>
            </select>
            </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "req_date_time" =>  $Req_Date_Time,
                "ord_type"      =>  $order_type,
                "floor"	        =>  $val['floor'],
                "room_no"	    =>  $val['room_no'],
                "guest_name"	=>  $val['full_name'],
                "Services"	=>  $Requirements,
                "Approx Time"	=>  $Req_Date_Time,
                "Assign_Order"  => $val['staff_name'],
                
                "Order_Status"  =>  $order_status,
            );
        }
       
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" =>$totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }
    public function get_out_of_time_orders_laundry()
	{
		log_message('DEBUG', 'newtimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HouseKeepingModel->outof_time_laundry_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'cloth_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(cloth_order_id = "'.$val_time.'" AND order_status = 0)';
			$arr= array(
				'out_of_time_status'=>1,
			);
			$out_of_time_status_update = $this->HouseKeepingModel->editData($tbl="cloth_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}
    public function out_of_time_laundry_orders_of_accepted()
	{
		log_message('DEBUG', 'acceptdetimeout_order--'.json_encode('newTime_out_color change_log'));
		$ord_to_15min = date('Y-m-d H:i:s', (time() - 60 * 14));
		$time_out_ord = $this->HouseKeepingModel->outof_time_accepted_laundry_order($ord_to_15min);
		$arr_to_string = array_column($time_out_ord,'cloth_order_id');
		$result =[];
		foreach($arr_to_string as $val_time)
		{
			$where = '(cloth_order_id = "'.$val_time.'" AND order_status = 1)';
			$arr= array(
				'out_of_time_status'=>2,
			);
			$out_of_time_status_update = $this->HouseKeepingModel->editData($tbl="cloth_orders",$where,$arr);
			$result[]= $val_time;
		}
		$data = $result;
		echo json_encode($data); 
	}
    public function accepted_order_of_laundry()
    {
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        $draw  = $this->input->post('draw');
        $row  = $this->input->post('start');
        $rowperpage  = $this->input->post('length');
        $search_array  = $this->input->post('search');
        $search = !empty($search_array['value'])?$search_array['value']: '' ;

        $admin_id = $this->session->userdata('u_id');
		$wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->MainModel->getData('register',$wh_admin);
      	if($this->session->userdata('userType') == 2)
        {
            $hotel_id = $get_hotel_id['u_id']; 
        }
        else
        {
            $hotel_id = $get_hotel_id['hotel_id']; 
        }

        $accepted_laundry_Order_list = $this->HouseKeepingModel->accepted_laundry_Order_list($rowperpage,$row,$search, $hotel_id);
        
        // echo "<pre>";
        // print_r($accepted_laundry_Order_list);
        // exit;
        $total_accepted_laundry_list_data = $this->HouseKeepingModel->total_accepted_laundry_list_data($search, $hotel_id);
        
        $totalRecords = $total_accepted_laundry_list_data->total_record;

        $data = array();
        $i=1;
        foreach($accepted_laundry_Order_list AS $val)
        {
            // print_r($val);die;
            $order_id = '<div><input type="hidden" name="time_out_id" class="time_out_id" value="'.$val['out_of_time_status'].'"><span> '.$val['cloth_order_id'].'</span></div>';

            $req_time = date('h:i A', strtotime($val['order_time']));
            $Req_Date_Time = '<span> '.date('d-m-Y', strtotime($val['order_date'])).'/<sub>'.$req_time.'</sub></span>';

           
          
            $order_type = '';

            if ($val['order_from'] == 1) {  
                $order_type = 'On Call Order';
             } elseif ($val['order_from'] == 2) {
                $order_type = 'From Staff Order';
             } elseif ($val['order_from'] == 3) {
                $order_type = 'App Order';
             } elseif ($val['order_from'] == 4) {
                $order_type = 'Walking Order';
             }else{
                $order_type = "-";
            }

            $Requirements = '<div><a href="#"><div class="badge badge-info accept_laundry_ord_req"   data-id2="'.$val['cloth_order_id'].'" data-bs-toggle="modal">view</div></a></div>';

           
            $order_status = '<div>
            <input type="hidden" name="users_id" id="uid'.$val['cloth_order_id'].'" value="'.$val['cloth_order_id'].'">
            <input type="hidden" name="useruid" id="useruid'.$val['cloth_order_id'].'" value="'.$val['u_id'].'">
            <input type="hidden" name="userhotelid" id="userhotelid'.$val['cloth_order_id'].'" value="'.$val['hotel_id'].'">
            <select class="form-control" name="status" id="status'.$val['cloth_order_id'].'" onchange="change_status('.$val['cloth_order_id'].');" style="min-width:85px;text-align:center">
                <option value="1" selected>Accepted</option>
                <option value="2">Completed</option>
            </select>
            </div>';	

            $data[] = array(
                "sr_no"			=>	$row+$i++ ,
                "order_id"	    =>  $order_id,
                "req_date_time" =>  $Req_Date_Time,
                "ord_type"      =>  $order_type,
                "floor"	        =>  $val['floor'],
                "room_no"	    =>  $val['room_no'],
                "guest_name"	=>  $val['full_name'],
                "Services"	=>  $Requirements,
              
                "Assign_Order"  => $val['staff_name'],
                
                "Order_Status"  =>  $order_status,
            );
        }
       
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" =>$totalRecords,
            "aaData" => $data
        );
        echo json_encode($response);
    }
    public function Service_request()
	{ 
		$u_id = $this->session->userdata('u_id');
		$where ='(u_id = "'.$u_id.'")';
		$admin_details = $this->MainModel->getData($tbl ='register', $where);
		$admin_id = $admin_details['hotel_id'];
        $today_date = date('Y-m-d');
		$service_request['list'] = $this->HouseKeepingModel->get_service_request($u_id);
        $service_request['list1'] = $this->HouseKeepingModel->get_house_service_request($admin_id,$today_date);
        $service_request['list2'] = $this->HouseKeepingModel->get_accepted_service_request($admin_id);
        $service_request['list4'] = $this->HouseKeepingModel->get_rejected_service_request($admin_id);
       
		$this->load->view('include/header');
		$this->load->view('housekeeping/viewServiceRequest',$service_request);
		$this->load->view('include/footer');
	}
    public function add_service_request()
    {   
        $room_no = $this->input->post('room_no');
        $guest_id = $this->input->post('user_n');
        $user_n = $this->input->post('user_name');
        $send_to111 = $this->input->post('send_to');
        $requirement = $this->input->post('requirement');
        
        $u_id= $this->session->userdata('u_id');
        $where ='(u_id = "'.$u_id.'")';
        $admin_details = $this->MainModel->getData($tbl ='register', $where);
        
        $wh = '(u_id ="'.$admin_details['hotel_id'].'")';
        
        $get_hotel_name = $this->MainModel->getData($tbl ='register', $wh);
        
        $admin_id = $admin_details['hotel_id'];
        $u_id11 = $admin_details['u_id'];
        $description = ''.strip_tags($requirement).' from room no is '.$room_no.'';
        $user_data = $this->HouseKeepingModel->get_user_data_by_username($user_n);
        if(!empty($user_data ))
        {
            $arr = array(
                            'hotel_id'    => $admin_id,
                            'room_no'      => $room_no,
                            'u_id' => $u_id11,
                            'guest_name' => $user_n,
                            'send_to' => $send_to111,
                            'send_to_u_id'=>$guest_id,
                            'requirement' => $description,
                            'date' => date('Y-m-d'),
                            'time' =>date("h:i:s"),
                        );
                        
            $add = $this->HouseKeepingModel->insert_data('service_request',$arr);
            if($add)
            {
                $send_for = 7;
                $send_to = 2;
                $title ="Service Request";
                $arr = array(
                            'ser_id'      => $add,
                            'send_to'     => $send_to,
                            'send_for'    => $send_for,
                            'title'       =>$title,
                            'room_no'     => $room_no,
                            'description'  => $description,
                        //    'send_by'      => 3,
                            'send_by_id'   => $admin_id,
                            'added_by_id' => $u_id11,
                        );
            
                $add11 = $this->HouseKeepingModel->insert_data('notifications',$arr);
                if($add11)
                {
                    
                    $arr = array(
                                'notification_id' => $add11,
                                'department_id' => $send_to111
                            );

                    $add11 = $this->HouseKeepingModel->insert_data('notifictions_department_id',$arr);

                    $u_id = $this->session->userdata('u_id');
                    $where ='(u_id = "'.$u_id.'")';
                    $admin_details = $this->MainModel->getData($tbl ='register', $where);
                    $admin_id = $admin_details['hotel_id'];
            
                    $service_request['list'] = $this->HouseKeepingModel->get_service_request($u_id);
                
                    $this->load->view('housekeeping/ajaxviewServiceRequest',$service_request);
                            
                }
            }
            else
            {
                $this->session->set_flashdata('msg','Something went wrong');
                redirect(base_url('Service_request'));
            }
        }
        else
        {
            $this->session->set_flashdata('msg','User not exit');
            redirect(base_url('Service_request'));
        }	   
    }

    public function staff_handover()
	{
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];
        
        $created_date = $this->input->post('created_date');
        $created_u_name = $this->input->post('created_u_name');
    
        $todays_date = date('Y-m-d');

        $data["pending"] = $this->HouseKeepingModel->get_staff_list_pagination($hotel_id,$todays_date);
        $data["completed"] = $this->HouseKeepingModel->get_completed_staff_list_pagination($hotel_id);
       
        $this->load->view('include/header');
        $this->load->view('housekeeping/staff_handover',$data);
        $this->load->view('include/footer');
    }

    public function getreassigndata()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->getdatareassign($tbl ='handover_staff', $wh);
                
        echo json_encode($data);
    }

    public function reassign_status()
    {
        $admin_id = $this->session->userdata('u_id');
        $wh_admin = '(u_id ="'.$admin_id.'")';
        $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
        $hotel_id = $get_hotel_id['hotel_id'];
        $created_staff_id = $this->input->post('create_staff_id');
        $staff_handover_id = $this->input->post('staff_handover_id');
        $staff_u_id = $this->input->post('staff_u_id');
        $completed_staff = $this->input->post('completed_staff_id');
        $todays_date = date('Y-m-d');

        //new staff reassign id 
        $staff_assign = '(u_id ="'.$staff_u_id.'")';
        $get_staff_id = $this->HouseKeepingModel->getData('register',$staff_assign);
        // print_r($get_staff_id);die;
        $wh1 = '(staff_id ="' . $created_staff_id . '" AND accept_date ="' . $todays_date . '" AND order_status = 1)';
        // print_r($wh1);die;
        $get_housekeeping_staff_orders = $this->HouseKeepingModel->getAllData1('house_keeping_orders', $wh1);
                // print_r($get_housekeeping_staff_orders);die;
        $get_cloth_staff_orders = $this->HouseKeepingModel->getAllData1('cloth_orders', $wh1);
    
        if ($get_housekeeping_staff_orders || $get_cloth_staff_orders) 
        {
            $arr = array(
                'hotel_id' => $get_hotel_id['hotel_id'],
                'staff_id' => $staff_u_id,
                'staff_name'=>$get_staff_id['full_name'],
                'added_by_u_id' => $admin_id,
            );

            $add = $this->HouseKeepingModel->edit_data_assign_handover('house_keeping_orders', $arr, $wh1);
            
            $add1 = $this->HouseKeepingModel->edit_data_assign_handover('cloth_orders', $arr, $wh1);
            if(($add || $add1))
            {
                // push notification for assign handover to staff
                $wh_s = '(u_id = "'.$staff_u_id.'")';
                $get_staff_dt = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_s);
                $title = "";
                if(!empty($get_staff_dt)){
                
                    $deviceToken= $get_staff_dt['token'];
                    $title = 'New Handover Arrival';
                    $body = "Handover Assign By Manager And Handover Id is $staff_handover_id";
                    $result = send_push_notification_for_staff($deviceToken, $title, $body);
                }

                 // handover asssign to staff inside app notification
                $subject = $title;
                $description = "Handover Assign By Manager And Handover Id is $staff_handover_id";
                $arr_staff_noti = array(
                                    'u_id'=>$staff_u_id,
                                    'hotel_id' => $hotel_id,
                                    'subject' => $subject,
                                    'description' => $description,
                                    'notification_order_flag' =>0,    
                                );
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti);

                $arr_2= array(
                    'is_complete' => 1,
                    'completed_staff_id' => $get_hotel_id['u_id'],
                    'complete_date' => date('Y-m-d'),
                    'complete_time' =>date('G:i:s'),
                );
                $wh_hando = '(staff_handover_id ="' . $staff_handover_id  . '")';
                $up = $this->HouseKeepingModel->edit_data('handover_staff',$wh_hando,$arr_2);
                if($up)
                {
                    // push notification for completed handover of staff
                    $wh_c_s = '(u_id = "'.$created_staff_id.'")';
                    $get_hc_staff_token = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_c_s);
                    $title1 = "";
                    if(!empty($get_hc_staff_token)){
                    
                        $deviceToken1= $get_hc_staff_token['token'];
                        $title1 = 'Your Handover Is Completed';
                        $body1 = "Your Handover Is Completed And Handover Id is $staff_handover_id";
                        $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                    }

                    // handover completed of staff inside app notification
                    $subject1 = $title1;
                    $description1 = $body1;
                    $arr_staff_noti1 = array(
                                        'u_id'=>$created_staff_id,
                                        'hotel_id' => $hotel_id,
                                        'subject' => $subject1,
                                        'description' => $description1,
                                        'notification_order_flag' =>0,    
                                    );
                    $this->MainModel->insert_data('staff_notification',$arr_staff_noti1);

                    // pagel load and listing part
                    $admin_id = $this->session->userdata('u_id');
                    $wh_admin = '(u_id ="'.$admin_id.'")';
                    $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                    $hotel_id = $get_hotel_id['hotel_id'];
                    $data["pending"] = $this->HouseKeepingModel->get_staff_list_pagination($hotel_id,$todays_date);
                    $data["completed"] = $this->HouseKeepingModel->get_completed_staff_list_pagination($hotel_id);
                    $this->load->view('housekeeping/ajaxstaffreassign',$data);
                }
                else
                {
                    // error redirect to main root
                    redirect(base_url('staff_handover'));
                }
            }
            else
            {
                // error redirect to main root
                redirect(base_url('staff_handover'));
            }
        }
        else
        {
            // no order is pending 
            $arr_2= array(
                'is_complete' => 1,
                'completed_staff_id' =>  $get_hotel_id['u_id'],
                'complete_date' => date('Y-m-d'),
                'complete_time' =>date('G:i:s'),
            );
            $wh_hando = '(staff_handover_id ="' . $staff_handover_id  . '")';
            $up = $this->HouseKeepingModel->edit_data('handover_staff',$wh_hando,$arr_2);
            // print_r($up);die;
            if($up)
            {
                // push notification for completed handover of staff
                $wh_c_s = '(u_id = "'.$created_staff_id.'")';
                $get_hc_staff_token = $this->MainModel->getData($tbl='user_firebase_tokens', $wh_c_s);
                $title1 = "";
                if(!empty($get_hc_staff_token)){
                
                    $deviceToken1= $get_hc_staff_token['token'];
                    $title1 = 'Your Handover Is Completed';
                    $body1 = "Your Handover Is Completed And Handover Id is $staff_handover_id";
                    $result1 = send_push_notification_for_staff($deviceToken1, $title1, $body1);
                }

                // handover completed of staff inside app notification
                $subject1 = $title1;
                $description1 = $body1;
                $arr_staff_noti1 = array(
                                    'u_id'=>$created_staff_id,
                                    'hotel_id' => $hotel_id,
                                    'subject' => $subject1,
                                    'description' => $description1,
                                    'notification_order_flag' =>0,    
                                );
                $this->MainModel->insert_data('staff_notification',$arr_staff_noti1);
                
                // pagel load and listing part
                $admin_id = $this->session->userdata('u_id');
                $wh_admin = '(u_id ="'.$admin_id.'")';
                $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                $hotel_id = $get_hotel_id['hotel_id'];
                $data["pending"] = $this->HouseKeepingModel->get_staff_list_pagination($hotel_id,$todays_date);
                $data["completed"] = $this->HouseKeepingModel->get_completed_staff_list_pagination($hotel_id);
                $this->load->view('housekeeping/ajaxstaffreassign',$data);
            }
            else
            {
                // error redirect to main root
                redirect(base_url('staff_handover'));
            }
        }
    }

    public function get_service_request()
    {
        $wh = $this->input->post('id');
        $data = $this->HouseKeepingModel->get_data_service($tbl = 'service_request', $wh);

        echo json_encode($data);
    }

    public function change_service_request_status()
    {
        $admin_id = $this->session->userdata('u_id');
        $service_request_id = $this->input->post('service_request_id');
        $request_status = $this->input->post('request_status');

        if ($request_status == 1) 
        {
            $arr = array(
                'request_status' => $request_status,
                
            );
            $arr2 = array(
                'order_status'=>$_POST['request_status'],
            );
            $wh = '(service_request_id = "' . $service_request_id . '")';
            $where2 = '(ser_id ="' . $service_request_id . '")';

            $up = $this->HouseKeepingModel->edit_data('service_request', $wh, $arr);
            $up = $this->HouseKeepingModel->edit_data($tbl="notifications",$where2,$arr2);
            if ($up) 
            {
                $admin_id = $this->session->userdata('u_id');
                $wh_admin = '(u_id ="'.$admin_id.'")';
                $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                $hotel_id = $get_hotel_id['hotel_id'];
                $todays_date = date('Y-m-d');
            
                $service_request['list1'] = $this->HouseKeepingModel->get_house_service_request($admin_id ,$todays_date);
                $service_request['list2'] = $this->HouseKeepingModel->get_accepted_service_request($admin_id);
                $service_request['list4'] = $this->HouseKeepingModel->get_rejected_service_request($admin_id);
                $this->load->view('housekeeping/ajax_service_request', $service_request);
            } 
            else 
            {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HouseKeepingController/Service_request'));
            }
        } 
        elseif ($request_status == 2) 
        {
            $arr1 = array(
                'request_status' => $request_status,
                
            );
            $arr2 = array(
                'order_status'=>$_POST['request_status'],
            );
            $wh1 = '(service_request_id = "' . $service_request_id . '")';
            $where2 = '(ser_id ="' . $service_request_id . '")';
            $up = $this->HouseKeepingModel->edit_data('service_request', $wh1, $arr1);
            $up = $this->HouseKeepingModel->edit_data($tbl="notifications",$where2,$arr2);
            if ($up) 
            {
                $admin_id = $this->session->userdata('u_id');
                $wh_admin = '(u_id ="'.$admin_id.'")';
                $get_hotel_id = $this->HouseKeepingModel->getData('register',$wh_admin);
                $hotel_id = $get_hotel_id['hotel_id'];
                $todays_date = date('Y-m-d');
                
                $service_request['list1'] = $this->HouseKeepingModel->get_house_service_request($admin_id ,$todays_date);
                $service_request['list2'] = $this->HouseKeepingModel->get_accepted_service_request($admin_id);
                $service_request['list4'] = $this->HouseKeepingModel->get_rejected_service_request($admin_id);
                
                $this->load->view('housekeeping/ajax_service_request', $service_request);
            } 
            else 
            {
                $this->session->set_flashdata('msg', 'Something went wrong');
                redirect(base_url('HouseKeepingController/Service_request'));
            }
        }
    }
 
}

